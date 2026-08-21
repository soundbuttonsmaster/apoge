<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$html = DB::table('products')->where('slug', 'sumo-rotavator')->value('features_advantages');
if ($html === null) {
    fwrite(STDERR, "Product not found\n");
    exit(1);
}

$patterns = [
    '#<p>\s*<strong>\s*<span[^>]*>\s*<span[^>]*>\s*MRP OF\s*ROTAVATORS:\s*</span>\s*</span>\s*</strong>\s*</p>#si',
    '#<p>\s*<strong>\s*<span[^>]*>\s*<span[^>]*>\s*<span[^>]*>\s*ROTAVATOR(?:&nbsp;|\s)+SUMO 6FT\s*-\s*131040\s*</span>\s*</span>\s*</span>\s*</strong>\s*</p>#si',
    '#<p>\s*<strong>\s*<span[^>]*>\s*<span[^>]*>\s*<span[^>]*>\s*ROTAVATOR(?:&nbsp;|\s)+SUMO 7FT\s*-\s*144000\s*</span>\s*</span>\s*</span>\s*</strong>\s*</p>#si',
];

$clean = preg_replace($patterns, '', $html);
$clean = preg_replace("/(\r?\n){3,}/", "\n\n", $clean);

DB::table('products')->where('slug', 'sumo-rotavator')->update([
    'features_advantages' => $clean,
    'updated_at' => now(),
]);

$stillHas = stripos($clean, 'MRP OF') !== false || stripos($clean, '131040') !== false;
echo $stillHas ? "Still present after replace\n" : "Removed MRP block from local DB\n";
echo 'Length before: ' . strlen($html) . ' after: ' . strlen($clean) . "\n";
