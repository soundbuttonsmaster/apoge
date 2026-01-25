<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = $this->generateSitemap();
        
        return response($sitemap, 200)
            ->header('Content-Type', 'text/xml');
    }

    private function generateSitemap()
    {
        $baseUrl = config('app.url');
        $currentDate = now()->toAtomString();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        $xml .= '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"' . "\n";
        $xml .= '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
        $xml .= '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n";
        $xml .= '        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n\n";

        // Home Page
        $xml .= $this->addUrl($baseUrl . '/', $currentDate, '1.0', 'daily');
        
        // Static Pages
        $staticPages = [
            ['url' => '/company/about-us', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => '/company/time-line', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/media/image-gallery', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => '/media/video-gallery', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => '/media/blog', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => '/network/become-dealer', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/network/find-a-dealer', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => '/testimonials', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => '/contact-us', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => '/farmer-registration', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => '/find-a-farmer-card', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => '/privacy-policy', 'priority' => '0.5', 'changefreq' => 'yearly'],
        ];

        foreach ($staticPages as $page) {
            $lastmod = $currentDate;
            $xml .= $this->addUrl($baseUrl . $page['url'], $lastmod, $page['priority'], $page['changefreq']);
        }

        // Categories
        $categories = Category::where('status', 1)->get();
        foreach ($categories as $category) {
            $lastmod = $category->updated_at ? $category->updated_at->toAtomString() : $currentDate;
            $xml .= $this->addUrl($baseUrl . '/p/' . $category->slug, $lastmod, '0.9', 'weekly');
            
            // Subcategories
            $subcategories = SubCategory::where('category_id', $category->id)->where('status', 1)->get();
            foreach ($subcategories as $subcategory) {
                $lastmod = $subcategory->updated_at ? $subcategory->updated_at->toAtomString() : $currentDate;
                $xml .= $this->addUrl($baseUrl . '/p/' . $category->slug . '/' . $subcategory->slug, $lastmod, '0.85', 'weekly');
            }
        }

        // Products
        $products = Product::where('status', 1)->get();
        foreach ($products as $product) {
            $lastmod = $product->updated_at ? $product->updated_at->toAtomString() : $currentDate;
            $url = $baseUrl . '/product-details/' . $product->slug;
            $xml .= $this->addUrl($url, $lastmod, '0.8', 'weekly');
            
            // Add product image if available
            if (!empty($product->product_image)) {
                $images = json_decode($product->product_image);
                if (!empty($images) && isset($images[0])) {
                    $imageUrl = $baseUrl . '/uploads/products/list/' . $images[0];
                    $xml .= $this->addUrlWithImage($url, $lastmod, '0.8', 'weekly', $imageUrl, $product->product_name);
                }
            }
        }

        // Blogs
        $blogs = Blog::where('status', 1)->get();
        foreach ($blogs as $blog) {
            $lastmod = $blog->updated_at ? $blog->updated_at->toAtomString() : $currentDate;
            $xml .= $this->addUrl($baseUrl . '/blog-details/' . $blog->slug, $lastmod, '0.7', 'monthly');
        }

        $xml .= '</urlset>';

        return $xml;
    }

    private function addUrl($url, $lastmod, $priority, $changefreq)
    {
        return "  <url>\n" .
               "    <loc>" . htmlspecialchars($url) . "</loc>\n" .
               "    <lastmod>" . $lastmod . "</lastmod>\n" .
               "    <priority>" . $priority . "</priority>\n" .
               "    <changefreq>" . $changefreq . "</changefreq>\n" .
               "  </url>\n\n";
    }

    private function addUrlWithImage($url, $lastmod, $priority, $changefreq, $imageUrl, $imageTitle)
    {
        return "  <url>\n" .
               "    <loc>" . htmlspecialchars($url) . "</loc>\n" .
               "    <lastmod>" . $lastmod . "</lastmod>\n" .
               "    <priority>" . $priority . "</priority>\n" .
               "    <changefreq>" . $changefreq . "</changefreq>\n" .
               "    <image:image>\n" .
               "      <image:loc>" . htmlspecialchars($imageUrl) . "</image:loc>\n" .
               "      <image:title>" . htmlspecialchars($imageTitle) . "</image:title>\n" .
               "    </image:image>\n" .
               "  </url>\n\n";
    }
}
