<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;

class GenerateBlogFeaturedImages extends Command
{
    protected $signature = 'blogs:generate-featured-images {--slug= : Generate for a single blog slug}';

    protected $description = 'Generate plain Apogee featured images with blog title only';

    public function handle()
    {
        $bgPath = public_path('front/images/apogee-blog-featured.webp');
        if (!file_exists($bgPath)) {
            $bgPath = public_path('front/images/laser-land-leveller.png');
        }
        if (!file_exists($bgPath)) {
            $this->error('Background image missing: front/images/apogee-blog-featured.webp');
            return 1;
        }

        $this->info('Using background: ' . $bgPath);

        $fontBold = $this->resolveFont(true);
        if (!$fontBold) {
            $this->error('No TTF font found. On Linux install: apt-get install -y fonts-dejavu-core');
            return 1;
        }
        $this->info('Using font: ' . $fontBold);

        $query = Blog::query();
        if ($slug = $this->option('slug')) {
            $query->where('slug', $slug);
        }

        $blogs = $query->get();
        if ($blogs->isEmpty()) {
            $this->warn('No blogs found.');
            return 0;
        }

        // OG / social card only — do not overwrite uploaded datels/list/thumb
        $sizes = [
            ['dir' => 'featured', 'w' => 1200, 'h' => 630, 'titleSize' => 42],
        ];

        foreach ($blogs as $blog) {
            if (empty($blog->image) && empty($blog->title)) {
                continue;
            }

            // Match HomeController OG lookup: {basename of blog.image}.jpg
            $stem = !empty($blog->image)
                ? pathinfo($blog->image, PATHINFO_FILENAME)
                : $blog->slug;
            $filename = $stem . '.jpg';

            foreach ($sizes as $size) {
                $dir = public_path('uploads/blog/' . $size['dir']);
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                $this->generatePlainTitleCard(
                    $bgPath,
                    $fontBold,
                    $blog->title,
                    $dir . DIRECTORY_SEPARATOR . $filename,
                    $size
                );
            }

            $this->info('Generated: ' . $filename);
        }

        $this->info('Done. ' . $blogs->count() . ' image(s) created.');
        return 0;
    }

    /**
     * Prefer project fonts, then common OS paths (Windows + Linux).
     */
    private function resolveFont(bool $bold = true): ?string
    {
        $candidates = $bold
            ? [
                storage_path('fonts/DejaVuSans-Bold.ttf'),
                base_path('resources/fonts/DejaVuSans-Bold.ttf'),
                'C:\\Windows\\Fonts\\arialbd.ttf',
                'C:\\Windows\\Fonts\\arial.ttf',
                '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf',
                '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf',
                '/usr/share/fonts/truetype/liberation/LiberationSans-Bold.ttf',
                '/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf',
                '/usr/share/fonts/truetype/freefont/FreeSansBold.ttf',
                '/usr/share/fonts/truetype/freefont/FreeSans.ttf',
                '/usr/share/fonts/TTF/DejaVuSans-Bold.ttf',
                '/usr/share/fonts/TTF/DejaVuSans.ttf',
            ]
            : [
                storage_path('fonts/DejaVuSans.ttf'),
                base_path('resources/fonts/DejaVuSans.ttf'),
                'C:\\Windows\\Fonts\\arial.ttf',
                '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf',
                '/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf',
                '/usr/share/fonts/truetype/freefont/FreeSans.ttf',
                '/usr/share/fonts/TTF/DejaVuSans.ttf',
            ];

        foreach ($candidates as $path) {
            if ($path && is_readable($path)) {
                return $path;
            }
        }

        return null;
    }

    private function generatePlainTitleCard($bgPath, $fontBold, $title, $outPath, array $size)
    {
        $width = $size['w'];
        $height = $size['h'];
        $titleSize = $size['titleSize'];

        $canvas = imagecreatetruecolor($width, $height);
        imagealphablending($canvas, true);
        $fill = imagecolorallocate($canvas, 20, 55, 30);
        imagefilledrectangle($canvas, 0, 0, $width, $height, $fill);

        $bg = $this->loadImage($bgPath);
        $this->coverImage($canvas, $bg, $width, $height);
        imagedestroy($bg);

        // Even dark overlay for readable white title
        for ($y = 0; $y < $height; $y++) {
            $color = imagecolorallocatealpha($canvas, 8, 32, 16, 55);
            imageline($canvas, 0, $y, $width, $y, $color);
        }

        $white = imagecolorallocate($canvas, 255, 255, 255);

        // Wide horizontal padding; leave top clear for CSS date badge (~80px)
        $padX = (int) ($width * 0.10);
        $maxTextW = $width - (2 * $padX);
        $safeTop = (int) ($height * 0.34);   // clear of date badge / crop
        $safeBottom = (int) ($height * 0.92);

        $lines = $this->wrapText($title, $fontBold, $titleSize, $maxTextW);
        // Shrink font if title is too tall for safe zone
        $lineH = (int) ($titleSize * 1.35);
        $blockH = count($lines) * $lineH;
        $safeH = $safeBottom - $safeTop;
        while ($blockH > $safeH && $titleSize > 16) {
            $titleSize -= 2;
            $lines = $this->wrapText($title, $fontBold, $titleSize, $maxTextW);
            $lineH = (int) ($titleSize * 1.35);
            $blockH = count($lines) * $lineH;
        }

        $startY = $safeTop + (int) (($safeH - $blockH) / 2) + $titleSize;

        foreach ($lines as $i => $line) {
            $box = imagettfbbox($titleSize, 0, $fontBold, $line);
            $textW = abs($box[2] - $box[0]);
            $x = (int) (($width - $textW) / 2);
            imagettftext($canvas, $titleSize, 0, $x, $startY + ($i * $lineH), $white, $fontBold, $line);
        }

        imagejpeg($canvas, $outPath, 90);
        imagedestroy($canvas);
    }

    private function loadImage($path)
    {
        $info = @getimagesize($path);
        if ($info === false) {
            throw new \RuntimeException('Cannot read image: ' . $path);
        }
        switch ($info[2]) {
            case IMAGETYPE_JPEG:
                $img = @imagecreatefromjpeg($path);
                break;
            case IMAGETYPE_PNG:
                $img = @imagecreatefrompng($path);
                break;
            case IMAGETYPE_WEBP:
                $img = @imagecreatefromwebp($path);
                break;
            default:
                throw new \RuntimeException('Unsupported image type: ' . $path);
        }
        if (!$img) {
            throw new \RuntimeException('Failed to load image: ' . $path);
        }
        return $img;
    }

    private function coverImage($canvas, $src, $width, $height)
    {
        $sw = imagesx($src);
        $sh = imagesy($src);

        // Fit full source into the card (no top crop — APOGEE.webp has no label band)
        $scale = max($width / $sw, $height / $sh);
        $dw = (int) ceil($sw * $scale);
        $dh = (int) ceil($sh * $scale);
        $dx = (int) (($width - $dw) / 2);
        $dy = (int) (($height - $dh) / 2);
        imagecopyresampled($canvas, $src, $dx, $dy, 0, 0, $dw, $dh, $sw, $sh);
    }

    private function wrapText($text, $font, $size, $maxWidth)
    {
        $words = preg_split('/\s+/', trim($text));
        $lines = [];
        $current = '';
        foreach ($words as $word) {
            $test = $current === '' ? $word : $current . ' ' . $word;
            $box = imagettfbbox($size, 0, $font, $test);
            $w = abs($box[2] - $box[0]);
            if ($w > $maxWidth && $current !== '') {
                $lines[] = $current;
                $current = $word;
            } else {
                $current = $test;
            }
        }
        if ($current !== '') {
            $lines[] = $current;
        }
        return array_slice($lines, 0, 4);
    }
}
