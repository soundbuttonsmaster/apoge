<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ScrapeAdminPanel extends Command
{
    protected $signature = 'scrape:admin
                            {--base-url=https://www.apogeeagrotech.com : Production base URL}
                            {--email=admin@gmail.com : Admin email}
                            {--password=1234567 : Admin password}
                            {--skip-images : Do not re-download images}
                            {--skip-cards : Skip farmer card detail pages}
                            {--dry-run : Scrape only, do not write DB}';

    protected $description = 'Scrape all admin-panel CMS + form data from production and replace local DB';

    private string $baseUrl;
    private string $cookieFile;
    private array $downloaded = [];

    public function handle(): int
    {
        $this->baseUrl = rtrim($this->option('base-url'), '/');
        $this->cookieFile = storage_path('app/admin_scrape_cookies.txt');
        @unlink($this->cookieFile);

        $this->info('Logging into admin...');
        if (!$this->login()) {
            $this->error('Admin login failed.');
            return 1;
        }
        $this->info('Login OK');

        $data = [
            'categories' => $this->scrapeCategories(),
            'subcategories' => $this->scrapeSubcategories(),
            'products' => $this->scrapeProducts(),
            'blogs' => $this->scrapeBlogs(),
            'testimonials' => $this->scrapeTestimonials(),
            'sessions' => $this->scrapeSessions(),
            'groups' => $this->scrapeGroups(),
            'galleries' => $this->scrapeGalleries(),
            'videos' => $this->scrapeVideos(),
            'areas' => $this->scrapeAreas(),
            'header_contents' => $this->scrapeHeaderContents(),
            'dealers' => $this->scrapeDealers(),
            'enquiries' => $this->scrapeEnquiriesFromAdminList(),
            'become_a_dealers' => $this->scrapeBecomeADealersFromAdminList(),
            'find_a_dealers' => $this->scrapeFindADealersFromAdminList(),
            'subscribes' => $this->scrapeSubscribes(),
            'farmers' => $this->scrapeFarmers(),
        ];

        $this->table(['Type', 'Count'], [
            ['Categories', count($data['categories'])],
            ['Subcategories', count($data['subcategories'])],
            ['Products', count($data['products'])],
            ['Blogs', count($data['blogs'])],
            ['Testimonials', count($data['testimonials'])],
            ['Sessions', count($data['sessions'])],
            ['Groups', count($data['groups'])],
            ['Galleries', count($data['galleries'])],
            ['Videos', count($data['videos'])],
            ['Areas', count($data['areas'])],
            ['Header contents', count($data['header_contents'])],
            ['Dealers', count($data['dealers'])],
            ['Enquiries', count($data['enquiries'])],
            ['Become dealers', count($data['become_a_dealers'])],
            ['Find dealers', count($data['find_a_dealers'])],
            ['Subscribes', count($data['subscribes'])],
            ['Farmers', count($data['farmers'])],
        ]);

        if ($this->option('dry-run')) {
            $this->info('Dry run complete.');
            return 0;
        }

        if (!$this->option('skip-images')) {
            $this->info('Downloading images...');
            $this->downloadAllImages($data);
        }

        $this->info('Importing into local database...');
        $this->importAll($data);
        $this->info('Admin scrape import completed successfully.');

        return 0;
    }

    private function login(): bool
    {
        $loginHtml = $this->request('GET', '/admin-login');
        if (!$loginHtml || !preg_match('/name="_token" value="([^"]+)"/', $loginHtml, $m)) {
            return false;
        }

        $this->request('POST', '/admin-login', [
            'email' => $this->option('email'),
            'password' => $this->option('password'),
            '_token' => $m[1],
        ], false);

        $dash = $this->request('GET', '/admin/dashboard');
        return $dash && str_contains($dash, 'Dashboard') && !str_contains($dash, 'Admin Login');
    }

    private function request(string $method, string $path, array $post = [], bool $follow = true): ?string
    {
        $url = str_starts_with($path, 'http') ? $path : ($this->baseUrl . $path);
        $ch = curl_init($url);
        $opts = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIEJAR => $this->cookieFile,
            CURLOPT_COOKIEFILE => $this->cookieFile,
            CURLOPT_USERAGENT => 'ApogeeAdminScraper/1.0',
            CURLOPT_TIMEOUT => 120,
            CURLOPT_FOLLOWLOCATION => $follow,
            CURLOPT_SSL_VERIFYPEER => true,
        ];
        if (strtoupper($method) === 'POST') {
            $opts[CURLOPT_POST] = true;
            $opts[CURLOPT_POSTFIELDS] = http_build_query($post);
            if (!$follow) {
                $opts[CURLOPT_FOLLOWLOCATION] = false;
            }
        }
        curl_setopt_array($ch, $opts);
        $body = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($body === false || $code >= 400) {
            return null;
        }
        return $body;
    }

    private function extractEditIds(string $html, string $pattern): array
    {
        preg_match_all($pattern, $html, $m);
        return array_values(array_unique(array_map('intval', $m[1] ?? [])));
    }

    private function inputValue(string $html, string $name): ?string
    {
        if (preg_match('/name="' . preg_quote($name, '/') . '"[^>]*value="([^"]*)"/i', $html, $m)) {
            return html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5);
        }
        if (preg_match('/value="([^"]*)"[^>]*name="' . preg_quote($name, '/') . '"/i', $html, $m)) {
            return html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5);
        }
        return null;
    }

    private function textareaValue(string $html, string $name): ?string
    {
        if (preg_match('/<textarea[^>]*name="' . preg_quote($name, '/') . '"[^>]*>(.*?)<\/textarea>/si', $html, $m)) {
            return html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5);
        }
        return null;
    }

    private function selectedOption(string $html, string $name): ?array
    {
        if (!preg_match('/<select[^>]*name="' . preg_quote($name, '/') . '"[^>]*>(.*?)<\/select>/si', $html, $sel)) {
            return null;
        }
        if (preg_match('/<option[^>]*value="([^"]+)"[^>]*selected[^>]*>(.*?)<\/option>/si', $sel[1], $m)
            || preg_match('/<option[^>]*selected[^>]*value="([^"]+)"[^>]*>(.*?)<\/option>/si', $sel[1], $m)) {
            return [
                'id' => trim($m[1]),
                'name' => html_entity_decode(trim(strip_tags($m[2])), ENT_QUOTES | ENT_HTML5),
            ];
        }
        return null;
    }

    private function checkboxChecked(string $html, string $name): bool
    {
        return (bool) preg_match('/name="' . preg_quote($name, '/') . '"[^>]*checked/i', $html)
            || (bool) preg_match('/checked[^>]*name="' . preg_quote($name, '/') . '"/i', $html);
    }

    private function scrapeCategories(): array
    {
        $this->info('Scraping categories...');
        $list = $this->request('GET', '/admin/category/create') ?? '';
        $ids = $this->extractEditIds($list, '#/admin/category/edit/(\d+)#');
        $rows = [];
        foreach ($ids as $id) {
            $html = $this->request('GET', "/admin/category/edit/{$id}");
            if (!$html) continue;
            $name = $this->inputValue($html, 'name') ?? '';
            $rows[] = [
                'id' => $id,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => $this->checkboxChecked($html, 'status') ? '1' : '0',
                'show_in_home' => '0',
                'meta_title' => $this->inputValue($html, 'meta_title'),
                'meta_keywords' => $this->textareaValue($html, 'meta_keywords'),
                'meta_description' => $this->textareaValue($html, 'meta_description'),
                'head_content' => $this->textareaValue($html, 'head_content'),
                'image' => null,
            ];
            $this->line("  category #{$id}: {$name}");
        }
        return $rows;
    }

    private function scrapeSubcategories(): array
    {
        $this->info('Scraping subcategories...');
        $list = $this->request('GET', '/admin/sub-category/create') ?? '';
        $ids = $this->extractEditIds($list, '#/admin/sub-category/edit/(\d+)#');
        $rows = [];
        foreach ($ids as $id) {
            $html = $this->request('GET', "/admin/sub-category/edit/{$id}");
            if (!$html) continue;
            $cat = $this->selectedOption($html, 'category_id');
            $name = $this->inputValue($html, 'name') ?? '';
            $rows[] = [
                'id' => $id,
                'category_id' => $cat['id'] ?? null,
                'category_name' => $cat['name'] ?? null,
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => $this->checkboxChecked($html, 'status') ? '1' : '0',
                'meta_title' => $this->inputValue($html, 'meta_title'),
                'meta_keywords' => $this->textareaValue($html, 'meta_keywords'),
                'meta_description' => $this->textareaValue($html, 'meta_description'),
                'head_content' => $this->textareaValue($html, 'head_content'),
            ];
            $this->line("  subcategory #{$id}: {$name}");
        }
        return $rows;
    }

    private function scrapeProducts(): array
    {
        $this->info('Scraping products...');
        $list = $this->request('GET', '/admin/product/list') ?? '';
        $listMeta = [];
        if (preg_match_all('#<tr>(.*?)</tr>#si', $list, $trs)) {
            foreach ($trs[1] as $tr) {
                if (!preg_match('#/admin/product/edit/(\d+)#', $tr, $idm)) continue;
                $tds = [];
                if (preg_match_all('#<td[^>]*>(.*?)</td>#si', $tr, $tdm)) {
                    $tds = array_map(fn ($t) => trim(html_entity_decode(strip_tags($t), ENT_QUOTES | ENT_HTML5)), $tdm[1]);
                }
                $listMeta[(int) $idm[1]] = [
                    'category_name' => $tds[1] ?? null,
                    'subcategory_name' => $tds[2] ?? null,
                    'show_in_home' => str_contains($tr, 'checked') ? '1' : '0',
                    'status' => (isset($tds[7]) && stripos($tds[7], 'Active') !== false) ? '1' : '0',
                ];
            }
        }

        $ids = $this->extractEditIds($list, '#/admin/product/edit/(\d+)#');
        $rows = [];
        foreach ($ids as $id) {
            $html = $this->request('GET', "/admin/product/edit/{$id}");
            if (!$html) continue;
            $name = $this->inputValue($html, 'product_name') ?? '';
            $cat = $this->selectedOption($html, 'category_id');
            $images = [];
            if (preg_match_all('#/uploads/products/thumb/([^"\']+)#i', $html, $im)) {
                foreach ($im[1] as $f) {
                    $images[] = urldecode($f);
                }
                $images = array_values(array_unique($images));
            }
            $brochure = null;
            if (preg_match('#/uploads/products/brochure/([^"\']+)#i', $html, $bm)) {
                $brochure = urldecode($bm[1]);
            }
            $meta = $listMeta[$id] ?? [];
            $rows[] = [
                'id' => $id,
                'category_id' => $cat['id'] ?? null,
                'category_name' => $meta['category_name'] ?? ($cat['name'] ?? null),
                'subcategory_name' => $meta['subcategory_name'] ?? null,
                'product_name' => $name,
                'slug' => Str::slug($name),
                'short_description' => $this->textareaValue($html, 'short_description'),
                'features_advantages' => $this->textareaValue($html, 'features_advantages'),
                'technical_specifications' => $this->textareaValue($html, 'technical_specifications'),
                'product_images' => $images,
                'brochure' => $brochure,
                'status' => $meta['status'] ?? ($this->checkboxChecked($html, 'status') ? '1' : '0'),
                'show_in_home' => $meta['show_in_home'] ?? '0',
                'meta_title' => $this->inputValue($html, 'meta_title'),
                'meta_keywords' => $this->textareaValue($html, 'meta_keywords'),
                'meta_description' => $this->textareaValue($html, 'meta_description'),
                'head_content' => $this->textareaValue($html, 'head_content'),
            ];
            $this->line("  product #{$id}: {$name}");
        }
        return $rows;
    }

    private function scrapeBlogs(): array
    {
        $this->info('Scraping blogs...');
        $publishedDates = $this->parseBlogDatesFromFront();
        $list = $this->request('GET', '/admin/blog/create') ?? '';
        $ids = $this->extractEditIds($list, '#/admin/blog/edit/(\d+)#');
        $rows = [];
        foreach ($ids as $id) {
            $html = $this->request('GET', "/admin/blog/edit/{$id}");
            if (!$html) continue;
            $title = $this->inputValue($html, 'title') ?? '';
            $slug = Str::slug($title);
            $image = null;
            if (preg_match('#/uploads/blog/(?:thumb|list|datels)/([^"\']+)#i', $html, $im)) {
                $image = urldecode($im[1]);
            }
            $rows[] = [
                'id' => $id,
                'title' => $title,
                'slug' => $slug,
                'image' => $image,
                'short_description' => $this->textareaValue($html, 'short_description'),
                'full_description' => $this->textareaValue($html, 'full_description'),
                'status' => $this->checkboxChecked($html, 'status') ? '1' : '0',
                'meta_title' => $this->inputValue($html, 'meta_title'),
                'meta_keywords' => $this->textareaValue($html, 'meta_keywords'),
                'meta_description' => $this->textareaValue($html, 'meta_description'),
                'head_content' => $this->textareaValue($html, 'head_content'),
                'created_at' => $publishedDates[$slug] ?? now(),
            ];
            $this->line("  blog #{$id}: {$title}");
        }
        return $rows;
    }

    /** @return array<string, \Carbon\Carbon> */
    private function parseBlogDatesFromFront(): array
    {
        $html = $this->request('GET', '/media/blog') ?? '';
        $dates = [];
        if (!preg_match_all(
            '#/blog-details/([a-z0-9-]+)".*?<p class="day">\s*(\d+)\s*</p>\s*<p class="month-year">\s*([^<]+?)\s*</p>#si',
            $html,
            $matches,
            PREG_SET_ORDER
        )) {
            return $dates;
        }

        foreach ($matches as $match) {
            $slug = $match[1];
            $day = trim($match[2]);
            $monthYear = trim($match[3]);
            try {
                $dates[$slug] = \Carbon\Carbon::createFromFormat('j M y', $day . ' ' . str_replace(' ', ' ', $monthYear));
            } catch (\Throwable $e) {
                try {
                    $dates[$slug] = \Carbon\Carbon::parse($day . ' ' . $monthYear);
                } catch (\Throwable $e2) {
                    // keep default
                }
            }
        }

        return $dates;
    }

    private function scrapeTestimonials(): array
    {
        $this->info('Scraping testimonials...');
        $list = $this->request('GET', '/admin/testimonial/create') ?? '';
        $ids = $this->extractEditIds($list, '#/admin/testimonial/edit/(\d+)#');
        $rows = [];
        foreach ($ids as $id) {
            $html = $this->request('GET', "/admin/testimonial/edit/{$id}");
            if (!$html) continue;
            $image = null;
            if (preg_match('#/uploads/testimonial/([^"\']+)#i', $html, $im)) {
                $image = urldecode($im[1]);
            }
            $name = $this->inputValue($html, 'testimonial_name') ?? '';
            $rows[] = [
                'id' => $id,
                'testimonial_name' => $name,
                'city' => $this->inputValue($html, 'city'),
                'rating' => $this->inputValue($html, 'rating') ?? $this->selectedOption($html, 'rating')['id'] ?? '5',
                'content' => $this->textareaValue($html, 'content'),
                'image' => $image,
                'status' => $this->checkboxChecked($html, 'status') ? '1' : '0',
            ];
            $this->line("  testimonial #{$id}: {$name}");
        }
        return $rows;
    }

    private function scrapeSessions(): array
    {
        $this->info('Scraping sessions...');
        $list = $this->request('GET', '/admin/session/create') ?? '';
        $ids = $this->extractEditIds($list, '#/admin/session/edit/(\d+)#');
        $rows = [];
        foreach ($ids as $id) {
            $html = $this->request('GET', "/admin/session/edit/{$id}");
            if (!$html) continue;
            $rows[] = [
                'id' => $id,
                'session' => $this->inputValue($html, 'session') ?? '',
                'status' => $this->checkboxChecked($html, 'status') ? '1' : '0',
            ];
        }
        return $rows;
    }

    private function scrapeGroups(): array
    {
        $this->info('Scraping groups...');
        $list = $this->request('GET', '/admin/group/create') ?? '';
        $ids = $this->extractEditIds($list, '#/admin/group/edit/(\d+)#');
        $rows = [];
        foreach ($ids as $id) {
            $html = $this->request('GET', "/admin/group/edit/{$id}");
            if (!$html) continue;
            $session = $this->selectedOption($html, 'session_id');
            $rows[] = [
                'id' => $id,
                'session_id' => $session['id'] ?? null,
                'group' => $this->inputValue($html, 'group') ?? '',
                'status' => $this->checkboxChecked($html, 'status') ? '1' : '0',
            ];
        }
        return $rows;
    }

    private function scrapeGalleries(): array
    {
        $this->info('Scraping galleries...');
        $list = $this->request('GET', '/admin/gallery/create') ?? '';
        $ids = $this->extractEditIds($list, '#/admin/gallery/edit/(\d+)#');
        $rows = [];
        foreach ($ids as $id) {
            $html = $this->request('GET', "/admin/gallery/edit/{$id}");
            if (!$html) continue;
            $session = $this->selectedOption($html, 'session_id');
            $group = $this->selectedOption($html, 'group_id');
            $image = null;
            if (preg_match('#/uploads/gallery/(?:small|large)/([^"\']+)#i', $html, $im)) {
                $image = urldecode($im[1]);
            }
            $rows[] = [
                'id' => $id,
                'session_id' => $session['id'] ?? null,
                'group_id' => $group['id'] ?? null,
                'image' => $image,
                'status' => $this->checkboxChecked($html, 'status') ? '1' : '0',
            ];
        }
        return $rows;
    }

    private function scrapeVideos(): array
    {
        $this->info('Scraping videos...');
        $list = $this->request('GET', '/admin/video-gallery/create') ?? '';
        $ids = $this->extractEditIds($list, '#/admin/video-gallery/edit/(\d+)#');
        $rows = [];
        foreach ($ids as $id) {
            $html = $this->request('GET', "/admin/video-gallery/edit/{$id}");
            if (!$html) continue;
            $rows[] = [
                'id' => $id,
                'url' => $this->inputValue($html, 'url') ?? '',
                'status' => $this->checkboxChecked($html, 'status') ? '1' : '0',
            ];
        }
        return $rows;
    }

    private function scrapeAreas(): array
    {
        $this->info('Scraping areas...');
        $list = $this->request('GET', '/admin/area/index') ?? '';
        $ids = $this->extractEditIds($list, '#/admin/area/edit/(\d+)#');
        $rows = [];
        foreach ($ids as $id) {
            $html = $this->request('GET', "/admin/area/edit/{$id}");
            if (!$html) continue;
            $name = $this->inputValue($html, 'name') ?? '';
            $image = null;
            if (preg_match('#/uploads/areas/([^"\']+)#i', $html, $im)) {
                $image = urldecode($im[1]);
            }
            $rows[] = [
                'id' => $id,
                'name' => $name,
                'slug' => Str::slug($name),
                'image' => $image,
                'short_description' => $this->textareaValue($html, 'short_description'),
                'full_description' => $this->textareaValue($html, 'full_description'),
                'meta_title' => $this->inputValue($html, 'meta_title'),
                'meta_keywords' => $this->textareaValue($html, 'meta_keywords'),
                'meta_description' => $this->textareaValue($html, 'meta_description'),
                'status' => $this->checkboxChecked($html, 'status') ? 1 : 0,
            ];
            $this->line("  area #{$id}: {$name}");
        }
        return $rows;
    }

    private function scrapeHeaderContents(): array
    {
        $this->info('Scraping header contents...');
        $rows = [];
        $pageNames = ['home', 'photo_gallery', 'video_gallery'];

        foreach ($pageNames as $pageName) {
            $get = $this->request('GET', '/admin/header-content/get?page_name=' . urlencode($pageName));
            if (!$get || !str_starts_with(trim($get), '{')) {
                continue;
            }

            $json = json_decode($get, true);
            if (!is_array($json) || empty($json['status']) || empty($json['data'])) {
                continue;
            }

            $data = $json['data'];
            $rows[] = [
                'id' => (int) ($data['id'] ?? 0),
                'page_name' => $data['page_name'] ?? $pageName,
                'url' => $data['url'] ?? '/',
                'head_content' => $data['head_content'] ?? '.',
                'status' => (string) ($data['status'] ?? '1'),
                'meta_title' => $data['meta_title'] ?? null,
                'meta_keywords' => $data['meta_keywords'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
            ];
            $this->line("  header content: {$pageName}");
        }

        if ($rows) {
            return $rows;
        }

        // Fallback: parse list table (columns: sl, page_name, meta_title, meta_keywords, meta_description, status, delete)
        $list = $this->request('GET', '/admin/header-content/create') ?? '';
        if (preg_match_all('#<tr>(.*?)</tr>#si', $list, $trs)) {
            foreach ($trs[1] as $tr) {
                if (!preg_match('#/admin/header-content/delete/(\d+)#', $tr, $idm)) {
                    continue;
                }
                $tds = [];
                if (preg_match_all('#<td[^>]*>(.*?)</td>#si', $tr, $tdm)) {
                    $tds = array_map(fn ($t) => trim(html_entity_decode(strip_tags($t), ENT_QUOTES | ENT_HTML5)), $tdm[1]);
                }
                if (count($tds) < 6) {
                    continue;
                }
                $rows[] = [
                    'id' => (int) $idm[1],
                    'page_name' => $tds[1] ?? '',
                    'url' => '/',
                    'head_content' => '.',
                    'status' => (stripos($tds[5], 'Active') !== false) ? '1' : '0',
                    'meta_title' => $tds[2] ?? null,
                    'meta_keywords' => $tds[3] ?? null,
                    'meta_description' => $tds[4] ?? null,
                ];
            }
        }

        return $rows;
    }

    private function scrapeDealers(): array
    {
        $this->info('Scraping dealers...');
        $list = $this->request('GET', '/admin/dealer/create') ?? '';
        $ids = $this->extractEditIds($list, '#/admin/dealer/edit/(\d+)#');
        $rows = [];
        foreach ($ids as $id) {
            $html = $this->request('GET', "/admin/dealer/edit/{$id}");
            if (!$html) continue;
            $rows[] = [
                'id' => $id,
                'name' => $this->inputValue($html, 'name'),
                'email' => $this->inputValue($html, 'email'),
                'phone' => $this->inputValue($html, 'phone'),
                'state' => $this->inputValue($html, 'state'),
                'district' => $this->inputValue($html, 'district'),
                'location' => $this->inputValue($html, 'location'),
                'status' => $this->checkboxChecked($html, 'status') ? '1' : '0',
            ];
        }
        // Fallback from list table if edit empty
        if (!$rows && preg_match_all('#<tr>(.*?)</tr>#si', $list, $trs)) {
            foreach ($trs[1] as $tr) {
                if (!preg_match('#/admin/dealer/edit/(\d+)#', $tr, $idm)) continue;
                $tds = [];
                if (preg_match_all('#<td[^>]*>(.*?)</td>#si', $tr, $tdm)) {
                    $tds = array_map(fn ($t) => trim(html_entity_decode(strip_tags($t), ENT_QUOTES | ENT_HTML5)), $tdm[1]);
                }
                $rows[] = [
                    'id' => (int) $idm[1],
                    'name' => $tds[1] ?? '',
                    'email' => $tds[2] ?? '',
                    'phone' => $tds[3] ?? '',
                    'state' => $tds[4] ?? '',
                    'district' => $tds[5] ?? '',
                    'location' => $tds[6] ?? '',
                    'status' => (isset($tds[7]) && stripos($tds[7], 'Active') !== false) ? '1' : '0',
                ];
            }
        }
        return $rows;
    }

    private function scrapeExcelExport(string $path, string $label): array
    {
        $this->info("Downloading Excel: {$label}...");
        $url = $this->baseUrl . $path;
        $tmp = storage_path("app/scrape_{$label}.xlsx");
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIEJAR => $this->cookieFile,
            CURLOPT_COOKIEFILE => $this->cookieFile,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 180,
            CURLOPT_USERAGENT => 'ApogeeAdminScraper/1.0',
        ]);
        $bin = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($bin === false || $code >= 400) {
            $this->warn("Failed excel download: {$label}");
            return [];
        }
        file_put_contents($tmp, $bin);

        $sheet = IOFactory::load($tmp)->getActiveSheet()->toArray(null, true, true, false);
        if (!$sheet || count($sheet) < 2) {
            return [];
        }
        $header = array_map(fn ($h) => strtolower(trim((string) $h)), $sheet[0]);
        $rows = [];
        for ($i = 1; $i < count($sheet); $i++) {
            $row = $sheet[$i];
            $assoc = [];
            foreach ($header as $idx => $key) {
                $assoc[$key] = $row[$idx] ?? null;
            }
            $rows[] = $assoc;
        }
        return $rows;
    }

    private function parseAdminTableRows(string $path): array
    {
        $html = $this->request('GET', $path) ?? '';
        if (!$html || !preg_match('#<tbody>(.*?)</tbody>#si', $html, $tbodyMatch)) {
            return [];
        }

        $rows = [];
        if (!preg_match_all('#<tr>(.*?)</tr>#si', $tbodyMatch[1], $trs)) {
            return $rows;
        }

        foreach ($trs[1] as $tr) {
            if (!preg_match_all('#<td[^>]*>(.*?)</td>#si', $tr, $tdm)) {
                continue;
            }
            $tds = array_map(
                fn ($t) => trim(html_entity_decode(strip_tags($t), ENT_QUOTES | ENT_HTML5)),
                $tdm[1]
            );
            if ($tds) {
                $rows[] = $tds;
            }
        }

        return $rows;
    }

    private function parseScrapedDate(?string $date): ?\Carbon\Carbon
    {
        if (empty($date)) {
            return null;
        }

        $date = trim($date);
        try {
            return \Carbon\Carbon::createFromFormat('d F Y', $date);
        } catch (\Throwable $e) {
            try {
                return \Carbon\Carbon::parse($date);
            } catch (\Throwable $e2) {
                return null;
            }
        }
    }

    private function scrapeEnquiriesFromAdminList(): array
    {
        $this->info('Scraping enquiries from admin list...');
        $rows = [];
        foreach ($this->parseAdminTableRows('/admin/enquiry') as $tds) {
            if (count($tds) < 7) {
                continue;
            }
            $rows[] = [
                'date' => $tds[1],
                'name' => $tds[2],
                'email' => $tds[3],
                'mobile' => $tds[4],
                'phone' => $tds[4],
                'location' => $tds[5],
                'message' => $tds[6],
            ];
        }

        return $rows;
    }

    private function scrapeBecomeADealersFromAdminList(): array
    {
        $this->info('Scraping become-a-dealer from admin list...');
        $rows = [];
        foreach ($this->parseAdminTableRows('/admin/become-a-dealer') as $tds) {
            if (count($tds) < 9) {
                continue;
            }
            $rows[] = [
                'date' => $tds[1],
                'name' => $tds[2],
                'email' => $tds[3],
                'mobile' => $tds[4],
                'state' => $tds[5],
                'district' => $tds[6],
                'village' => $tds[7],
                'interested' => $tds[8],
                'intersted_in' => $tds[8],
            ];
        }

        return $rows;
    }

    private function scrapeFindADealersFromAdminList(): array
    {
        $this->info('Scraping find-a-dealer from admin list...');
        $rows = [];
        foreach ($this->parseAdminTableRows('/admin/find-a-dealer') as $tds) {
            if (count($tds) < 7) {
                continue;
            }
            $rows[] = [
                'date' => $tds[1],
                'name' => $tds[2],
                'email' => $tds[3],
                'mobile' => $tds[4],
                'state' => $tds[5],
                'district' => $tds[6],
            ];
        }

        return $rows;
    }

    private function scrapeSubscribes(): array
    {
        $this->info('Scraping subscribers...');
        $html = $this->request('GET', '/admin/subscribe/subscribe') ?? '';
        $rows = [];
        if (preg_match_all('#<tr>\s*<td[^>]*>\d+</td>\s*<td[^>]*>([^<]+)</td>\s*<td[^>]*>.*?delete-subscribe/(\d+)#si', $html, $m, PREG_SET_ORDER)) {
            foreach ($m as $match) {
                $rows[] = [
                    'id' => (int) $match[2],
                    'email' => trim(html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5)),
                ];
            }
        }
        return $rows;
    }

    private function scrapeFarmers(): array
    {
        $this->info('Scraping farmer registrations...');
        $rows = [];
        $page = 1;
        while (true) {
            $html = $this->request('GET', '/admin/farmer-registration?page=' . $page);
            if (!$html) break;
            $found = 0;
            if (preg_match_all('#<tr>(.*?)</tr>#si', $html, $trs)) {
                foreach ($trs[1] as $tr) {
                    if (!preg_match('#/admin/view-farmer-card/(\d+)#', $tr, $idm)) continue;
                    $tds = [];
                    if (preg_match_all('#<td[^>]*>(.*?)</td>#si', $tr, $tdm)) {
                        $tds = array_map(fn ($t) => trim(html_entity_decode(strip_tags($t), ENT_QUOTES | ENT_HTML5)), $tdm[1]);
                    }
                    // columns: sl, customer_id, name, mobile, state, district, city, address, manufacturer, model, date, action
                    $id = (int) $idm[1];
                    $purchase = null;
                    if (!empty($tds[10])) {
                        try {
                            $purchase = \Carbon\Carbon::parse($tds[10])->format('Y-m-d');
                        } catch (\Throwable $e) {
                            $purchase = null;
                        }
                    }
                    $farmer = [
                        'id' => $id,
                        'customer_id' => $tds[1] ?? null,
                        'name' => $tds[2] ?? '',
                        'phone' => $tds[3] ?? '',
                        'state' => $tds[4] ?? null,
                        'district' => $tds[5] ?? null,
                        'city' => $tds[6] ?? null,
                        'address' => $tds[7] ?? null,
                        'leveller_manufacturer' => $tds[8] ?? null,
                        'leveller_model_no' => $tds[9] ?? null,
                        'leveller_purchase_date' => $purchase,
                        'card_number' => null,
                        'expiry_date' => null,
                        'card_ganrate_status' => '1',
                    ];
                    if (!$this->option('skip-cards')) {
                        $cardHtml = $this->request('GET', "/admin/view-farmer-card/{$id}");
                        if ($cardHtml && preg_match('#<h2>([0-9\s]{16,})</h2>#', $cardHtml, $cm)) {
                            $farmer['card_number'] = preg_replace('/\s+/', '', $cm[1]);
                        }
                        if ($cardHtml && preg_match('#<h5>(\d{2}-\d{4})</h5>#', $cardHtml, $em)) {
                            try {
                                $farmer['expiry_date'] = \Carbon\Carbon::createFromFormat('m-Y', $em[1])->endOfMonth()->format('Y-m-d H:i:s');
                            } catch (\Throwable $e) {
                            }
                        }
                    }
                    $rows[$id] = $farmer;
                    $found++;
                }
            }
            $this->line("  farmer page {$page}: {$found} rows");
            if ($found === 0 || !preg_match('#farmer-registration\?page=' . ($page + 1) . '#', $html)) {
                break;
            }
            $page++;
            if ($page > 50) break;
        }
        return array_values($rows);
    }

    private function downloadAllImages(array $data): void
    {
        $this->ensureUploadDirs();
        foreach ($data['products'] as $p) {
            foreach ($p['product_images'] as $img) {
                foreach (['large', 'big', 'list', 'thumb'] as $size) {
                    $this->downloadUpload("uploads/products/{$size}/{$img}", public_path("uploads/products/{$size}/{$img}"));
                }
            }
            if (!empty($p['brochure'])) {
                $this->downloadUpload('uploads/products/brochure/' . $p['brochure'], public_path('uploads/products/brochure/' . $p['brochure']));
            }
        }
        foreach ($data['blogs'] as $b) {
            if (empty($b['image'])) continue;
            foreach (['datels', 'list', 'thumb'] as $folder) {
                $this->downloadUpload("uploads/blog/{$folder}/{$b['image']}", public_path("uploads/blog/{$folder}/{$b['image']}"));
            }
        }
        foreach ($data['testimonials'] as $t) {
            if (!empty($t['image'])) {
                $this->downloadUpload('uploads/testimonial/' . $t['image'], public_path('uploads/testimonial/' . $t['image']));
            }
        }
        foreach ($data['areas'] as $a) {
            if (!empty($a['image'])) {
                $this->downloadUpload('uploads/areas/' . $a['image'], public_path('uploads/areas/' . $a['image']));
            }
        }
        foreach ($data['galleries'] as $g) {
            if (empty($g['image'])) continue;
            foreach (['large', 'small'] as $folder) {
                $this->downloadUpload("uploads/gallery/{$folder}/{$g['image']}", public_path("uploads/gallery/{$folder}/{$g['image']}"));
            }
        }
    }

    private function ensureUploadDirs(): void
    {
        foreach ([
            'uploads/products/large', 'uploads/products/big', 'uploads/products/list', 'uploads/products/thumb', 'uploads/products/brochure',
            'uploads/blog/datels', 'uploads/blog/list', 'uploads/blog/thumb',
            'uploads/testimonial', 'uploads/areas', 'uploads/gallery/large', 'uploads/gallery/small',
        ] as $rel) {
            $path = public_path($rel);
            if (!is_dir($path)) mkdir($path, 0755, true);
        }
    }

    private function downloadUpload(string $remoteRel, string $localPath): bool
    {
        if (isset($this->downloaded[$localPath]) && is_file($localPath)) return true;
        $dir = dirname($localPath);
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $parts = explode('/', $remoteRel);
        $encoded = implode('/', array_map('rawurlencode', $parts));
        $url = $this->baseUrl . '/' . $encoded;
        $bin = @file_get_contents($url, false, stream_context_create([
            'http' => ['timeout' => 120, 'user_agent' => 'ApogeeAdminScraper/1.0'],
            'ssl' => ['verify_peer' => true, 'verify_peer_name' => true],
        ]));
        if ($bin === false) return false;
        file_put_contents($localPath, $bin);
        $this->downloaded[$localPath] = true;
        return true;
    }

    private function importAll(array $data): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ([
            'galleries', 'groups', 'sessions', 'products', 'sub_categories', 'categories', 'blogs',
            'testimonials', 'areas', 'video_galleries', 'header_contents', 'dealers',
            'enquiries', 'become_a_dealers', 'find_a_dealers', 'subscribes', 'farmer_registrations',
        ] as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $now = now();
        $catByName = [];
        foreach ($data['categories'] as $c) {
            DB::table('categories')->insert([
                'id' => $c['id'],
                'name' => $c['name'],
                'image' => null,
                'slug' => $c['slug'],
                'status' => $c['status'],
                'show_in_home' => '0',
                'meta_title' => $c['meta_title'],
                'meta_keywords' => $c['meta_keywords'],
                'meta_description' => $c['meta_description'],
                'head_content' => $c['head_content'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $catByName[strtolower($c['name'])] = $c['id'];
        }

        $subByName = [];
        foreach ($data['subcategories'] as $s) {
            $catId = $s['category_id'] ?: ($catByName[strtolower((string) $s['category_name'])] ?? null);
            DB::table('sub_categories')->insert([
                'id' => $s['id'],
                'category_id' => (string) $catId,
                'name' => $s['name'],
                'slug' => $s['slug'],
                'status' => $s['status'],
                'meta_title' => $s['meta_title'],
                'meta_keywords' => $s['meta_keywords'],
                'meta_description' => $s['meta_description'],
                'head_content' => $s['head_content'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $subByName[strtolower($s['name'])] = $s['id'];
        }

        foreach ($data['products'] as $p) {
            $catId = $p['category_id'] ?: ($catByName[strtolower((string) $p['category_name'])] ?? null);
            $subId = $subByName[strtolower((string) $p['subcategory_name'])] ?? null;
            if (!$catId || !$subId) {
                $this->warn('Skip product without category map: ' . $p['product_name']);
                continue;
            }
            DB::table('products')->insert([
                'id' => $p['id'],
                'category_id' => $catId,
                'subcategory_id' => $subId,
                'product_name' => $p['product_name'],
                'slug' => $p['slug'],
                'short_description' => $p['short_description'],
                'features_advantages' => $p['features_advantages'],
                'technical_specifications' => $p['technical_specifications'],
                'product_image' => json_encode($p['product_images']),
                'brochure' => $p['brochure'],
                'status' => $p['status'],
                'show_in_home' => $p['show_in_home'],
                'meta_title' => $p['meta_title'],
                'meta_keywords' => $p['meta_keywords'],
                'meta_description' => $p['meta_description'],
                'head_content' => $p['head_content'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        foreach ($data['blogs'] as $b) {
            DB::table('blogs')->insert([
                'id' => $b['id'],
                'title' => $b['title'],
                'slug' => $b['slug'],
                'image' => $b['image'],
                'short_description' => $b['short_description'],
                'full_description' => $b['full_description'],
                'status' => $b['status'],
                'meta_title' => $b['meta_title'],
                'meta_keywords' => $b['meta_keywords'],
                'meta_description' => $b['meta_description'],
                'head_content' => $b['head_content'],
                'created_at' => $b['created_at'] ?? $now,
                'updated_at' => $now,
            ]);
        }

        foreach ($data['testimonials'] as $t) {
            DB::table('testimonials')->insert([
                'id' => $t['id'],
                'testimonial_name' => $t['testimonial_name'],
                'city' => $t['city'],
                'rating' => (string) $t['rating'],
                'content' => $t['content'],
                'image' => $t['image'],
                'status' => $t['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        foreach ($data['sessions'] as $s) {
            DB::table('sessions')->insert([
                'id' => $s['id'],
                'session' => $s['session'],
                'status' => $s['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        foreach ($data['groups'] as $g) {
            DB::table('groups')->insert([
                'id' => $g['id'],
                'session_id' => (string) $g['session_id'],
                'group' => $g['group'],
                'status' => $g['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        foreach ($data['galleries'] as $g) {
            if (empty($g['image'])) continue;
            DB::table('galleries')->insert([
                'id' => $g['id'],
                'session_id' => (string) $g['session_id'],
                'group_id' => (string) $g['group_id'],
                'image' => $g['image'],
                'status' => $g['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        foreach ($data['videos'] as $v) {
            DB::table('video_galleries')->insert([
                'id' => $v['id'],
                'url' => $v['url'],
                'status' => $v['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        foreach ($data['areas'] as $a) {
            DB::table('areas')->insert([
                'id' => $a['id'],
                'name' => $a['name'],
                'slug' => $a['slug'],
                'image' => $a['image'],
                'short_description' => $a['short_description'],
                'full_description' => $a['full_description'],
                'meta_title' => $a['meta_title'],
                'meta_keywords' => $a['meta_keywords'],
                'meta_description' => $a['meta_description'],
                'status' => $a['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        foreach ($data['header_contents'] as $h) {
            DB::table('header_contents')->insert([
                'id' => $h['id'],
                'page_name' => $h['page_name'],
                'url' => $h['url'],
                'head_content' => $h['head_content'] ?? '.',
                'status' => $h['status'] ?? '1',
                'meta_title' => $h['meta_title'] ?? null,
                'meta_keywords' => $h['meta_keywords'] ?? null,
                'meta_description' => $h['meta_description'] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
        foreach ($data['dealers'] as $d) {
            DB::table('dealers')->insert([
                'id' => $d['id'],
                'name' => $d['name'],
                'email' => $d['email'],
                'phone' => $d['phone'],
                'state' => $d['state'],
                'district' => $d['district'],
                'location' => $d['location'],
                'status' => $d['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        foreach ($data['enquiries'] as $e) {
            $created = $this->parseScrapedDate($e['date'] ?? null) ?? $now;
            DB::table('enquiries')->insert([
                'name' => $e['name'] ?? '',
                'email' => $e['email'] ?? '',
                'phone' => $e['mobile'] ?? ($e['phone'] ?? ''),
                'location' => $e['location'] ?? '',
                'message' => $e['message'] ?? '',
                'created_at' => $created,
                'updated_at' => $created,
            ]);
        }

        foreach ($data['become_a_dealers'] as $e) {
            $created = $this->parseScrapedDate($e['date'] ?? null) ?? $now;
            DB::table('become_a_dealers')->insert([
                'name' => $e['name'] ?? '',
                'email' => $e['email'] ?? '',
                'phone' => $e['mobile'] ?? '',
                'state' => $e['state'] ?? '',
                'district' => $e['district'] ?? '',
                'village' => $e['village'] ?? '',
                'intersted_in' => $e['interested'] ?? ($e['intersted_in'] ?? ''),
                'created_at' => $created,
                'updated_at' => $created,
            ]);
        }

        foreach ($data['find_a_dealers'] as $e) {
            $created = $this->parseScrapedDate($e['date'] ?? null) ?? $now;
            DB::table('find_a_dealers')->insert([
                'name' => $e['name'] ?? '',
                'email' => $e['email'] ?? '',
                'phone' => $e['mobile'] ?? '',
                'state' => $e['state'] ?? null,
                'district' => $e['district'] ?? null,
                'created_at' => $created,
                'updated_at' => $created,
            ]);
        }

        foreach ($data['subscribes'] as $s) {
            DB::table('subscribes')->insert([
                'id' => $s['id'],
                'email' => $s['email'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        foreach ($data['farmers'] as $f) {
            DB::table('farmer_registrations')->insert([
                'id' => $f['id'],
                'customer_id' => $f['customer_id'],
                'name' => $f['name'],
                'phone' => $f['phone'],
                'state' => $f['state'],
                'district' => $f['district'],
                'city' => $f['city'],
                'address' => $f['address'],
                'leveller_manufacturer' => $f['leveller_manufacturer'],
                'leveller_model_no' => $f['leveller_model_no'],
                'leveller_purchase_date' => $f['leveller_purchase_date'],
                'card_number' => $f['card_number'],
                'expiry_date' => $f['expiry_date'],
                'card_ganrate_status' => $f['card_ganrate_status'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
