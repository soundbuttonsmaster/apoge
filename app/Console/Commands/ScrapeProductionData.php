<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ScrapeProductionData extends Command
{
    protected $signature = 'scrape:production
                            {--base-url=https://www.apogeeagrotech.com : Production site base URL}
                            {--dry-run : Scrape and report without writing to database}
                            {--skip-images : Skip downloading images}';

    protected $description = 'Scrape admin-managed content from production and replace local database + uploads';

    private string $baseUrl;

    /** @var array<string, bool> */
    private array $downloadedImages = [];

    /** @var array<string, array{category_id:int, subcategory_id:int}> */
    private array $productCategoryMap = [];

    /** @var array<string, bool> */
    private array $homeProductSlugs = [];

    public function handle(): int
    {
        $this->baseUrl = rtrim($this->option('base-url'), '/');
        $dryRun = (bool) $this->option('dry-run');
        $skipImages = (bool) $this->option('skip-images');

        $this->info('Fetching homepage from ' . $this->baseUrl);
        $homeHtml = $this->fetch($this->baseUrl . '/');
        if ($homeHtml === null) {
            $this->error('Could not fetch production homepage.');

            return 1;
        }

        $categories = $this->parseCategoriesFromNav($homeHtml);
        $this->homeProductSlugs = $this->parseHomeProductSlugs($homeHtml);
        $testimonials = $this->parseTestimonials($homeHtml);
        $headerHome = $this->parseMetaTags($homeHtml);

        $this->info('Categories: ' . count($categories));
        $this->info('Home products: ' . count($this->homeProductSlugs));
        $this->info('Testimonials: ' . count($testimonials));

        $categories = $this->mergeDiscoveredSubcategories($categories, $homeHtml);

        $productSlugs = [];
        foreach ($categories as $category) {
            $categoryUrl = $this->baseUrl . '/p/' . $category['slug'];
            $listingHtml = $this->fetch($categoryUrl);
            if ($listingHtml) {
                $productSlugs = array_merge($productSlugs, $this->parseProductSlugsFromListing($listingHtml));
            }

            foreach ($category['subcategories'] as $subcategory) {
                $subUrl = $this->baseUrl . '/p/' . $category['slug'] . '/' . $subcategory['slug'];
                $subHtml = $this->fetch($subUrl);
                if (!$subHtml) {
                    continue;
                }

                foreach ($this->parseProductSlugsFromListing($subHtml) as $slug) {
                    $productSlugs[] = $slug;
                    $this->productCategoryMap[$slug] = [
                        'category_slug' => $category['slug'],
                        'subcategory_slug' => $subcategory['slug'],
                    ];
                }
            }
        }

        $productSlugs = array_values(array_unique($productSlugs));
        $this->info('Products to scrape: ' . count($productSlugs));

        $products = [];
        foreach ($productSlugs as $slug) {
            $this->line('  Product: ' . $slug);
            $url = $this->baseUrl . '/product-details/' . $slug;
            $html = $this->fetch($url);
            if (!$html) {
                $this->warn('    Failed to fetch product page: ' . $slug);
                continue;
            }

            $product = $this->parseProductDetail($html, $slug);
            if ($product) {
                $products[] = $product;
            }
        }

        $blogHtml = $this->fetch($this->baseUrl . '/media/blog');
        $blogSlugs = $blogHtml ? $this->parseBlogSlugs($blogHtml) : [];
        $this->info('Blogs to scrape: ' . count($blogSlugs));

        $blogs = [];
        foreach ($blogSlugs as $slug) {
            $this->line('  Blog: ' . $slug);
            $html = $this->fetch($this->baseUrl . '/blog-details/' . $slug);
            if (!$html) {
                continue;
            }

            $blog = $this->parseBlogDetail($html, $slug);
            if ($blog) {
                $blogs[] = $blog;
            }
        }

        $areasHtml = $this->fetch($this->baseUrl . '/areas-we-cover');
        $areaSlugs = $areasHtml ? $this->parseAreaSlugs($areasHtml) : [];
        $this->info('Areas to scrape: ' . count($areaSlugs));

        $areas = [];
        foreach ($areaSlugs as $slug) {
            $this->line('  Area: ' . $slug);
            $html = $this->fetch($this->baseUrl . '/areas-we-cover/' . $slug);
            if (!$html) {
                continue;
            }

            $area = $this->parseAreaDetail($html, $slug);
            if ($area) {
                $areas[] = $area;
            }
        }

        $videoHtml = $this->fetch($this->baseUrl . '/media/video-gallery');
        $videos = $videoHtml ? $this->parseVideos($videoHtml) : [];
        $this->info('Videos: ' . count($videos));

        $gallery = $this->parseImageGallery($this->fetch($this->baseUrl . '/media/image-gallery') ?? '');
        $this->info('Gallery sessions: ' . count($gallery['sessions']));

        if ($dryRun) {
            $this->info('Dry run complete. No database changes made.');
            $this->table(
                ['Type', 'Count'],
                [
                    ['Categories', count($categories)],
                    ['Subcategories', collect($categories)->sum(fn ($c) => count($c['subcategories']))],
                    ['Products', count($products)],
                    ['Blogs', count($blogs)],
                    ['Testimonials', count($testimonials)],
                    ['Areas', count($areas)],
                    ['Videos', count($videos)],
                    ['Gallery images', count($gallery['images'])],
                ]
            );

            return 0;
        }

        if (!$skipImages) {
            $this->info('Clearing local upload directories...');
            $this->clearUploadDirectories();
        }

        try {
            $this->info('Clearing admin content tables...');
            $this->clearContentTables();

            $categoryIds = [];
            $subcategoryIds = [];

            foreach ($categories as $category) {
                $categoryMeta = $this->fetchCategoryMeta($category['slug']);
                $categoryId = DB::table('categories')->insertGetId([
                    'name' => $category['name'],
                    'image' => null,
                    'slug' => $category['slug'],
                    'status' => '1',
                    'show_in_home' => '0',
                    'meta_title' => $categoryMeta['meta_title'],
                    'meta_keywords' => $categoryMeta['meta_keywords'],
                    'meta_description' => $categoryMeta['meta_description'],
                    'head_content' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $categoryIds[$category['slug']] = $categoryId;

                foreach ($category['subcategories'] as $subcategory) {
                    $subMeta = $this->fetchSubcategoryMeta($category['slug'], $subcategory['slug']);
                    $subId = DB::table('sub_categories')->insertGetId([
                        'category_id' => (string) $categoryId,
                        'name' => $subcategory['name'],
                        'slug' => $subcategory['slug'],
                        'status' => '1',
                        'meta_title' => $subMeta['meta_title'],
                        'meta_keywords' => $subMeta['meta_keywords'],
                        'meta_description' => $subMeta['meta_description'],
                        'head_content' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $subcategoryIds[$category['slug'] . '/' . $subcategory['slug']] = $subId;
                }
            }

            foreach ($products as $product) {
                $map = $this->productCategoryMap[$product['slug']] ?? null;
                $categoryId = $map ? ($categoryIds[$map['category_slug']] ?? null) : null;
                $subcategoryId = $map
                    ? ($subcategoryIds[$map['category_slug'] . '/' . $map['subcategory_slug']] ?? null)
                    : null;

                if (!$categoryId || !$subcategoryId) {
                    $breadcrumb = $this->resolveCategoryFromBreadcrumb($product['breadcrumb']);
                    if ($breadcrumb) {
                        $categoryId = $categoryIds[$breadcrumb['category_slug']] ?? $categoryId;
                        if (!empty($breadcrumb['subcategory_slug'])) {
                            $subcategoryId = $subcategoryIds[$breadcrumb['category_slug'] . '/' . $breadcrumb['subcategory_slug']] ?? $subcategoryId;
                        }
                    }
                }

                if (!$categoryId || !$subcategoryId) {
                    $fallback = $this->resolveProductCategoryFallback($product, $categoryIds, $subcategoryIds, $categories);
                    $categoryId = $fallback['category_id'] ?? $categoryId;
                    $subcategoryId = $fallback['subcategory_id'] ?? $subcategoryId;
                }

                if (!$categoryId || !$subcategoryId) {
                    $this->warn('Skipping product without category mapping: ' . $product['slug']);
                    continue;
                }

                if (!$skipImages) {
                    $this->downloadProductImages($product);
                }

                DB::table('products')->insert([
                    'category_id' => $categoryId,
                    'subcategory_id' => $subcategoryId,
                    'product_name' => $product['product_name'],
                    'slug' => $product['slug'],
                    'short_description' => $product['short_description'],
                    'features_advantages' => $product['features_advantages'],
                    'technical_specifications' => $product['technical_specifications'],
                    'product_image' => json_encode($product['product_images']),
                    'brochure' => $product['brochure'],
                    'status' => '1',
                    'show_in_home' => isset($this->homeProductSlugs[$product['slug']]) ? '1' : '0',
                    'meta_title' => $product['meta_title'],
                    'meta_keywords' => $product['meta_keywords'],
                    'meta_description' => $product['meta_description'],
                    'head_content' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($blogs as $blog) {
                if (!$skipImages && !empty($blog['image'])) {
                    $this->downloadBlogImages($blog['image']);
                }

                DB::table('blogs')->insert([
                    'title' => $blog['title'],
                    'slug' => $blog['slug'],
                    'image' => $blog['image'],
                    'short_description' => $blog['short_description'],
                    'full_description' => $blog['full_description'],
                    'status' => '1',
                    'meta_title' => $blog['meta_title'],
                    'meta_keywords' => $blog['meta_keywords'],
                    'meta_description' => $blog['meta_description'],
                    'head_content' => null,
                    'created_at' => $blog['created_at'] ?? now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($testimonials as $testimonial) {
                if (!$skipImages && !empty($testimonial['image'])) {
                    $this->downloadFile(
                        $this->baseUrl . '/uploads/testimonial/' . rawurlencode($testimonial['image']),
                        public_path('uploads/testimonial/' . $testimonial['image']),
                        true
                    );
                }

                DB::table('testimonials')->insert([
                    'testimonial_name' => $testimonial['testimonial_name'],
                    'city' => $testimonial['city'],
                    'rating' => (string) $testimonial['rating'],
                    'content' => $testimonial['content'],
                    'image' => $testimonial['image'],
                    'status' => '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($areas as $area) {
                if (!$skipImages && !empty($area['image'])) {
                    $this->downloadFile(
                        $this->baseUrl . '/uploads/areas/' . rawurlencode($area['image']),
                        public_path('uploads/areas/' . $area['image']),
                        true
                    );
                }

                DB::table('areas')->insert([
                    'name' => $area['name'],
                    'slug' => $area['slug'],
                    'image' => $area['image'],
                    'short_description' => $area['short_description'],
                    'full_description' => $area['full_description'],
                    'meta_title' => $area['meta_title'],
                    'meta_keywords' => $area['meta_keywords'],
                    'meta_description' => $area['meta_description'],
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($videos as $video) {
                DB::table('video_galleries')->insert([
                    'url' => $video,
                    'status' => '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $sessionIds = [];
            foreach ($gallery['sessions'] as $sessionName) {
                $sessionIds[$sessionName] = DB::table('sessions')->insertGetId([
                    'session' => $sessionName,
                    'status' => '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $groupIds = [];
            foreach ($gallery['groups'] as $group) {
                $sessionId = $sessionIds[$group['session']] ?? null;
                if (!$sessionId) {
                    continue;
                }

                $key = $group['session'] . '::' . $group['name'];
                $groupIds[$key] = DB::table('groups')->insertGetId([
                    'session_id' => (string) $sessionId,
                    'group' => $group['name'],
                    'status' => '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($gallery['images'] as $imageRow) {
                $sessionId = $sessionIds[$imageRow['session']] ?? null;
                $groupKey = $imageRow['session'] . '::' . $imageRow['group'];
                $groupId = $groupIds[$groupKey] ?? null;
                if (!$sessionId || !$groupId) {
                    continue;
                }

                if (!$skipImages) {
                    $this->downloadGalleryImages($imageRow['filename']);
                }

                DB::table('galleries')->insert([
                    'session_id' => (string) $sessionId,
                    'group_id' => (string) $groupId,
                    'image' => $imageRow['filename'],
                    'status' => '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('header_contents')->insert([
                'page_name' => 'home',
                'url' => '/',
                'head_content' => '.',
                'status' => '1',
                'meta_title' => $headerHome['meta_title'],
                'meta_keywords' => $headerHome['meta_keywords'],
                'meta_description' => $headerHome['meta_description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->info('Production scrape import completed successfully.');
        } catch (\Throwable $e) {
            $this->error('Import failed: ' . $e->getMessage());
            $this->error($e->getTraceAsString());

            return 1;
        }

        return 0;
    }

    private function fetch(string $url): ?string
    {
        $context = stream_context_create([
            'http' => [
                'timeout' => 90,
                'user_agent' => 'ApogeeLocalScraper/1.0',
                'follow_location' => 1,
            ],
            'ssl' => [
                'verify_peer' => true,
                'verify_peer_name' => true,
            ],
        ]);

        $html = @file_get_contents($url, false, $context);

        return $html === false ? null : $html;
    }

    private function parseCategoriesFromNav(string $html): array
    {
        $categories = [];
        if (!preg_match_all(
            '#href="' . preg_quote($this->baseUrl, '#') . '/p/([^"/]+)"[^>]*>\s*<span>([^<]+)</span>\s*</a>\s*<ul class="sub-sub-nav">(.*?)</ul>#si',
            $html,
            $matches,
            PREG_SET_ORDER
        )) {
            return $categories;
        }

        foreach ($matches as $match) {
            $category = [
                'slug' => $match[1],
                'name' => html_entity_decode(trim($match[2]), ENT_QUOTES | ENT_HTML5),
                'subcategories' => [],
            ];

            if (preg_match_all(
                '#href="' . preg_quote($this->baseUrl, '#') . '/p/' . preg_quote($category['slug'], '#') . '/([^"/]+)"[^>]*>\s*<span>([^<]+)</span>#si',
                $match[3],
                $subMatches,
                PREG_SET_ORDER
            )) {
                foreach ($subMatches as $subMatch) {
                    $category['subcategories'][] = [
                        'slug' => $subMatch[1],
                        'name' => html_entity_decode(trim($subMatch[2]), ENT_QUOTES | ENT_HTML5),
                    ];
                }
            }

            $categories[] = $category;
        }

        return $categories;
    }

    /** @param array<int, array{slug:string,name:string,subcategories:array<int, array{slug:string,name:string}>}> $categories */
    private function mergeDiscoveredSubcategories(array $categories, string $html): array
    {
        $indexed = [];
        foreach ($categories as $category) {
            $indexed[$category['slug']] = $category;
        }

        if (!preg_match_all(
            '#href="' . preg_quote($this->baseUrl, '#') . '/p/([^"/]+)/([^"/]+)"#i',
            $html,
            $matches,
            PREG_SET_ORDER
        )) {
            return array_values($indexed);
        }

        foreach ($matches as $match) {
            $categorySlug = $match[1];
            $subSlug = $match[2];

            if (!isset($indexed[$categorySlug])) {
                continue;
            }

            $exists = false;
            foreach ($indexed[$categorySlug]['subcategories'] as $subcategory) {
                if ($subcategory['slug'] === $subSlug) {
                    $exists = true;
                    break;
                }
            }

            if ($exists) {
                continue;
            }

            $subHtml = $this->fetch($this->baseUrl . '/p/' . $categorySlug . '/' . $subSlug);
            $subName = $subSlug;
            if ($subHtml && preg_match('#<h1>\s*([^<]+?)\s*</h1>#si', $subHtml, $nameMatch)) {
                $subName = html_entity_decode(trim($nameMatch[1]), ENT_QUOTES | ENT_HTML5);
            }

            $indexed[$categorySlug]['subcategories'][] = [
                'slug' => $subSlug,
                'name' => $subName,
            ];
        }

        return array_values($indexed);
    }

    /** @return array<string, bool> */
    private function parseHomeProductSlugs(string $html): array
    {
        $slugs = [];
        if (preg_match_all('#/product-details/([a-z0-9-]+)#i', $html, $matches)) {
            foreach ($matches[1] as $slug) {
                $slugs[$slug] = true;
            }
        }

        return $slugs;
    }

    private function parseProductSlugsFromListing(string $html): array
    {
        preg_match_all('#/product-details/([a-z0-9-]+)#i', $html, $matches);

        return array_values(array_unique($matches[1] ?? []));
    }

    private function parseTestimonials(string $html): array
    {
        $testimonials = [];
        if (!preg_match_all(
            '#class="testimonial style-3".*?<img\s+src="[^"]+/uploads/testimonial/([^"]+)".*?<p class="caption[^"]*">\s*(.*?)\s*</p>.*?<a[^>]*>\s*([^<]+?)\s*</a>.*?class="wg-rating">(.*?)</div>.*?<p class="duty">\s*([^<]+?)\s*</p>#si',
            $html,
            $matches,
            PREG_SET_ORDER
        )) {
            return $testimonials;
        }

        foreach ($matches as $match) {
            $stars = substr_count($match[4], 'fa-star');
            $testimonials[] = [
                'image' => urldecode(basename($match[1])),
                'content' => html_entity_decode(trim(strip_tags($match[2])), ENT_QUOTES | ENT_HTML5),
                'testimonial_name' => html_entity_decode(trim($match[3]), ENT_QUOTES | ENT_HTML5),
                'rating' => max(1, $stars),
                'city' => html_entity_decode(trim($match[5]), ENT_QUOTES | ENT_HTML5),
            ];
        }

        return $testimonials;
    }

    private function parseMetaTags(string $html): array
    {
        return [
            'meta_title' => $this->matchMeta($html, 'title') ?? $this->matchMeta($html, 'name', 'title'),
            'meta_keywords' => $this->matchMeta($html, 'name', 'keywords'),
            'meta_description' => $this->matchMeta($html, 'name', 'description'),
        ];
    }

    private function matchMeta(string $html, string $attr, ?string $value = null): ?string
    {
        if ($attr === 'title' && preg_match('#<title>([^<]+)</title>#i', $html, $m)) {
            return html_entity_decode(trim($m[1]), ENT_QUOTES | ENT_HTML5);
        }

        if ($value && preg_match('#<meta[^>]+' . $attr . '="' . preg_quote($value, '#') . '"[^>]+content="([^"]*)"#i', $html, $m)) {
            return html_entity_decode(trim($m[1]), ENT_QUOTES | ENT_HTML5);
        }

        if ($value && preg_match('#<meta[^>]+content="([^"]*)"[^>]+' . $attr . '="' . preg_quote($value, '#') . '"#i', $html, $m)) {
            return html_entity_decode(trim($m[1]), ENT_QUOTES | ENT_HTML5);
        }

        return null;
    }

    private function parseProductDetail(string $html, string $slug): ?array
    {
        $meta = $this->parseMetaTags($html);

        if (!preg_match('#<h1>\s*([^<]+?)\s*</h1>#si', $html, $nameMatch)) {
            return null;
        }

        $shortDescription = '';
        if (preg_match('#class="content-inner"[^>]*>.*?<h1>.*?</h1>\s*<p>\s*(.*?)\s*</p>#si', $html, $shortMatch)) {
            $shortDescription = html_entity_decode(trim(strip_tags($shortMatch[1])), ENT_QUOTES | ENT_HTML5);
        }

        $features = '';
        if (preg_match('#class="featuer_contant"[^>]*>(.*?)(?=</div>\s*</div>\s*</div>\s*<div class="col-lg-12">|<div class="col-lg-12">\s*<div class="table_content")#si', $html, $featMatch)) {
            $features = preg_replace('#<h3[^>]*>Features & Advantages</h3>#i', '', $featMatch[1]);
            $features = trim($features);
        }

        $specs = '';
        if (preg_match('#class="table_content"[^>]*>(.*?</table>)#si', $html, $specMatch)) {
            $specs = preg_replace('#<h3[^>]*>Technical Specifications</h3>#i', '', $specMatch[1]);
            $specs = trim($specs);
        } elseif (preg_match('#class="table_content"[^>]*>(.*?)</div>\s*</div>\s*</div>\s*</div>\s*</section>#si', $html, $specMatch)) {
            $specs = preg_replace('#<h3[^>]*>Technical Specifications</h3>#i', '', $specMatch[1]);
            $specs = trim($specs);
        }

        $images = [];
        if (preg_match_all('#/uploads/products/large/([^"?]+)#i', $html, $imageMatches)) {
            foreach ($imageMatches[1] as $filename) {
                $images[] = urldecode($filename);
            }
        }
        $images = array_values(array_unique($images));

        $brochure = null;
        if (preg_match('#/uploads/products/brochure/([^"?]+)#i', $html, $brochureMatch)) {
            $brochure = urldecode($brochureMatch[1]);
        }

        $breadcrumb = [];
        if (preg_match('#"itemListElement"\s*:\s*(\[.*?\])\s*\}#s', $html, $bcMatch)) {
            $decoded = json_decode(str_replace('\\/', '/', $bcMatch[1]), true);
            if (is_array($decoded)) {
                $breadcrumb = $decoded;
            }
        }

        return [
            'slug' => $slug,
            'product_name' => html_entity_decode(trim($nameMatch[1]), ENT_QUOTES | ENT_HTML5),
            'short_description' => $shortDescription,
            'features_advantages' => $features,
            'technical_specifications' => $specs,
            'product_images' => $images,
            'brochure' => $brochure,
            'meta_title' => $meta['meta_title'],
            'meta_keywords' => $meta['meta_keywords'],
            'meta_description' => $meta['meta_description'],
            'breadcrumb' => $breadcrumb,
        ];
    }

    /** @return array<string, string>|null */
    private function resolveCategoryFromBreadcrumb(array $breadcrumb): ?array
    {
        $categorySlug = null;
        foreach ($breadcrumb as $item) {
            $url = $item['item'] ?? '';
            if (preg_match('#/p/([^/]+)(?:/([^/]+))?#', $url, $m)) {
                $categorySlug = $m[1];
                if (!empty($m[2])) {
                    return ['category_slug' => $m[1], 'subcategory_slug' => $m[2]];
                }
            }
        }

        return $categorySlug ? ['category_slug' => $categorySlug, 'subcategory_slug' => null] : null;
    }

    /**
     * @param array<string, int> $categoryIds
     * @param array<string, int> $subcategoryIds
     * @param array<int, array{slug:string,name:string,subcategories:array<int,array{slug:string,name:string}>}> $categories
     * @return array{category_id?:int,subcategory_id?:int}
     */
    private function resolveProductCategoryFallback(array $product, array $categoryIds, array &$subcategoryIds, array $categories): array
    {
        $breadcrumb = $this->resolveCategoryFromBreadcrumb($product['breadcrumb'] ?? []);
        if (!$breadcrumb || empty($breadcrumb['category_slug'])) {
            return [];
        }

        $categorySlug = $breadcrumb['category_slug'];
        $categoryId = $categoryIds[$categorySlug] ?? null;
        if (!$categoryId) {
            return [];
        }

        if (!empty($breadcrumb['subcategory_slug'])) {
            $subKey = $categorySlug . '/' . $breadcrumb['subcategory_slug'];

            return [
                'category_id' => $categoryId,
                'subcategory_id' => $subcategoryIds[$subKey] ?? null,
            ];
        }

        $subSlug = $this->inferSubcategorySlug($product['slug'], $categorySlug);
        if (!$subSlug) {
            foreach ($categories as $category) {
                if ($category['slug'] === $categorySlug && !empty($category['subcategories'])) {
                    $subSlug = $category['subcategories'][0]['slug'];
                    break;
                }
            }
        }

        if (!$subSlug) {
            return ['category_id' => $categoryId];
        }

        $subKey = $categorySlug . '/' . $subSlug;
        if (!isset($subcategoryIds[$subKey])) {
            $subId = DB::table('sub_categories')->insertGetId([
                'category_id' => (string) $categoryId,
                'name' => Str::title(str_replace('-', ' ', $subSlug)),
                'slug' => $subSlug,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $subcategoryIds[$subKey] = $subId;
        }

        return [
            'category_id' => $categoryId,
            'subcategory_id' => $subcategoryIds[$subKey],
        ];
    }

    private function inferSubcategorySlug(string $productSlug, string $categorySlug): ?string
    {
        if ($categorySlug === 'laser-land-leveller') {
            if (preg_match('#^(rl-|ld-receiver|hd-receiver|control-box)#', $productSlug)) {
                return 'laser-equipment-kit';
            }

            if (str_contains($productSlug, 'dual-slope')) {
                return 'hd-series-laser-land-leveller';
            }

            return 'ld-series-laser-land-leveller';
        }

        if ($categorySlug === 'gnss-land-leveller') {
            return str_contains($productSlug, '3d') ? '3d-gnss-land-leveller' : '2d-gnss-land-leveller';
        }

        if ($categorySlug === 'rotavator') {
            return 'sumo-rotavator';
        }

        if ($categorySlug === 'gyrovator') {
            return 'maxx-gyrovator';
        }

        return null;
    }

    private function parseBlogSlugs(string $html): array
    {
        preg_match_all('#/blog-details/([a-z0-9-]+)#i', $html, $matches);

        return array_values(array_unique($matches[1] ?? []));
    }

    private function parseBlogDetail(string $html, string $slug): ?array
    {
        $meta = $this->parseMetaTags($html);

        if (!preg_match('#class="title-name[^"]*"[^>]*>\s*(.*?)\s*</h3>#si', $html, $titleMatch)) {
            return null;
        }

        $image = null;
        if (preg_match('#uploads/blog/datels/([^"?]+)#i', $html, $imageMatch)) {
            $image = urldecode($imageMatch[1]);
        }

        $shortDescription = $meta['meta_description'];
        $createdAt = now();
        if (preg_match('#class="entry date".*?<a[^>]*>\s*(\d{1,2}\s+[A-Za-z]+\s+\d{4})\s*</a>#si', $html, $dateMatch)) {
            try {
                $createdAt = \Carbon\Carbon::parse($dateMatch[1]);
            } catch (\Throwable $e) {
                // keep now()
            }
        }

        $fullDescription = '';
        if (preg_match('#class="entry-image"[^>]*>.*?</div>(.*?)<div class="col-lg-4">#si', $html, $contentMatch)) {
            $fullDescription = trim($contentMatch[1]);
        }

        return [
            'slug' => $slug,
            'title' => html_entity_decode(trim(strip_tags($titleMatch[1])), ENT_QUOTES | ENT_HTML5),
            'image' => $image,
            'short_description' => $shortDescription,
            'full_description' => $fullDescription,
            'meta_title' => $meta['meta_title'],
            'meta_keywords' => $meta['meta_keywords'],
            'meta_description' => $meta['meta_description'],
            'created_at' => $createdAt,
        ];
    }

    private function parseAreaSlugs(string $html): array
    {
        preg_match_all('#/areas-we-cover/([a-z0-9-]+)#i', $html, $matches);
        $slugs = array_values(array_unique($matches[1] ?? []));

        return array_values(array_filter($slugs, fn ($slug) => $slug !== 'areas-we-cover'));
    }

    private function parseAreaDetail(string $html, string $slug): ?array
    {
        $meta = $this->parseMetaTags($html);

        $name = null;
        if (preg_match('#<h2 class="heading">\s*([^<]+?)\s*</h2>#si', $html, $nameMatch)) {
            $name = html_entity_decode(trim($nameMatch[1]), ENT_QUOTES | ENT_HTML5);
        }

        $image = null;
        if (preg_match('#uploads/areas/([^"?]+)#i', $html, $imageMatch)) {
            $image = urldecode($imageMatch[1]);
        }

        $fullDescription = '';
        if (preg_match('#class="content-area"[^>]*>(.*?)</div>\s*<div class="mt-5 text-center">#si', $html, $contentMatch)) {
            $fullDescription = trim($contentMatch[1]);
        }

        $shortDescription = Str::limit(strip_tags($fullDescription), 250);

        return [
            'slug' => $slug,
            'name' => $name ?? Str::title(str_replace('-', ' ', $slug)),
            'image' => $image,
            'short_description' => $shortDescription,
            'full_description' => $fullDescription,
            'meta_title' => $meta['meta_title'],
            'meta_keywords' => $meta['meta_keywords'],
            'meta_description' => $meta['meta_description'],
        ];
    }

    /** @return list<string> */
    private function parseVideos(string $html): array
    {
        preg_match_all('#https?://(?:www\.)?youtube\.com/embed/([A-Za-z0-9_-]+)#', $html, $matches);
        $urls = [];
        foreach ($matches[0] ?? [] as $embedUrl) {
            $videoId = basename(parse_url($embedUrl, PHP_URL_PATH) ?? '');
            $urls[] = 'https://youtu.be/' . $videoId;
        }

        return array_values(array_unique($urls));
    }

    /** @return array{sessions: list<string>, groups: list<array{session:string,name:string}>, images: list<array{session:string,group:string,filename:string}>} */
    private function parseImageGallery(string $html): array
    {
        $result = ['sessions' => [], 'groups' => [], 'images' => []];
        if ($html === '') {
            return $result;
        }

        if (preg_match_all('#class="btn-tab">(\d{4})</a>#', $html, $sessionMatches)) {
            $result['sessions'] = array_values(array_unique($sessionMatches[1]));
        }

        if (preg_match_all('#class="exhibition_h"><h2>([^<]+)</h2>#', $html, $groupMatches)) {
            foreach ($groupMatches[1] as $index => $groupName) {
                $session = $result['sessions'][$index] ?? ($result['sessions'][0] ?? '2025');
                $result['groups'][] = ['session' => $session, 'name' => trim($groupName)];
            }
        }

        if (preg_match_all('#/uploads/gallery/(?:large|small)/([^"?]+)#i', $html, $imageMatches)) {
            foreach ($imageMatches[1] as $filename) {
                $filename = urldecode($filename);
                $result['images'][] = [
                    'session' => $result['sessions'][0] ?? '2025',
                    'group' => $result['groups'][0]['name'] ?? 'Gallery',
                    'filename' => $filename,
                ];
            }
        }

        return $result;
    }

    private function fetchCategoryMeta(string $slug): array
    {
        $html = $this->fetch($this->baseUrl . '/p/' . $slug);

        return $html ? $this->parseMetaTags($html) : ['meta_title' => null, 'meta_keywords' => null, 'meta_description' => null];
    }

    private function fetchSubcategoryMeta(string $categorySlug, string $subSlug): array
    {
        $html = $this->fetch($this->baseUrl . '/p/' . $categorySlug . '/' . $subSlug);

        return $html ? $this->parseMetaTags($html) : ['meta_title' => null, 'meta_keywords' => null, 'meta_description' => null];
    }

    private function clearContentTables(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ([
            'galleries',
            'groups',
            'sessions',
            'products',
            'sub_categories',
            'categories',
            'blogs',
            'testimonials',
            'areas',
            'video_galleries',
            'header_contents',
        ] as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    private function clearUploadDirectories(): void
    {
        $paths = [
            public_path('uploads/products/large'),
            public_path('uploads/products/big'),
            public_path('uploads/products/list'),
            public_path('uploads/products/thumb'),
            public_path('uploads/products/brochure'),
            public_path('uploads/blog/datels'),
            public_path('uploads/blog/list'),
            public_path('uploads/blog/thumb'),
            public_path('uploads/testimonial'),
            public_path('uploads/areas'),
            public_path('uploads/gallery/large'),
            public_path('uploads/gallery/small'),
        ];

        foreach ($paths as $path) {
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
                continue;
            }

            foreach (glob($path . '/*') as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
        }
    }

    /** @param array<string, mixed> $product */
    private function downloadProductImages(array $product): void
    {
        foreach ($product['product_images'] as $filename) {
            $sizes = ['large', 'big', 'list', 'thumb'];
            $downloadedAny = false;
            $fallbackPath = null;

            foreach ($sizes as $size) {
                $remote = $this->baseUrl . '/uploads/products/' . $size . '/' . $this->encodePath($filename);
                $local = public_path('uploads/products/' . $size . '/' . $filename);
                if ($this->downloadFile($remote, $local, true)) {
                    $downloadedAny = true;
                    $fallbackPath = $local;
                }
            }

            if (!$downloadedAny && $fallbackPath) {
                foreach ($sizes as $size) {
                    $local = public_path('uploads/products/' . $size . '/' . $filename);
                    if (!file_exists($local)) {
                        @copy($fallbackPath, $local);
                    }
                }
            }
        }

        if (!empty($product['brochure'])) {
            $this->downloadFile(
                $this->baseUrl . '/uploads/products/brochure/' . $this->encodePath($product['brochure']),
                public_path('uploads/products/brochure/' . $product['brochure']),
                true
            );
        }
    }

    private function downloadBlogImages(string $filename): void
    {
        foreach (['datels', 'list', 'thumb'] as $folder) {
            $this->downloadFile(
                $this->baseUrl . '/uploads/blog/' . $folder . '/' . $this->encodePath($filename),
                public_path('uploads/blog/' . $folder . '/' . $filename),
                true
            );
        }
    }

    private function downloadGalleryImages(string $filename): void
    {
        foreach (['large', 'small'] as $folder) {
            $this->downloadFile(
                $this->baseUrl . '/uploads/gallery/' . $folder . '/' . $this->encodePath($filename),
                public_path('uploads/gallery/' . $folder . '/' . $filename),
                true
            );
        }
    }

    private function encodePath(string $filename): string
    {
        return implode('/', array_map('rawurlencode', explode('/', $filename)));
    }

    private function downloadFile(string $url, string $destPath, bool $quiet = false): bool
    {
        if (isset($this->downloadedImages[$destPath]) && file_exists($destPath)) {
            return true;
        }

        $dir = dirname($destPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $content = @file_get_contents($url, false, stream_context_create([
            'http' => ['timeout' => 120, 'user_agent' => 'ApogeeLocalScraper/1.0'],
            'ssl' => ['verify_peer' => true, 'verify_peer_name' => true],
        ]));

        if ($content === false) {
            if (!$quiet) {
                $this->warn('Failed download: ' . $url);
            }

            return false;
        }

        file_put_contents($destPath, $content);
        $this->downloadedImages[$destPath] = true;

        return true;
    }
}
