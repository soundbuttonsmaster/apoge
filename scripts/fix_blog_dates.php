<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$html = @file_get_contents('https://www.apogeeagrotech.com/media/blog', false, stream_context_create([
    'http' => ['timeout' => 60, 'user_agent' => 'ApogeeFix/1.0'],
]));

if (!$html) {
    fwrite(STDERR, "Failed to fetch blog listing\n");
    exit(1);
}

$updated = 0;
if (preg_match_all(
    '#/blog-details/([a-z0-9-]+)".*?<p class="day">\s*(\d+)\s*</p>\s*<p class="month-year">\s*([^<]+?)\s*</p>#si',
    $html,
    $matches,
    PREG_SET_ORDER
)) {
    foreach ($matches as $match) {
        $slug = $match[1];
        try {
            $createdAt = \Carbon\Carbon::createFromFormat('j M y', trim($match[2]) . ' ' . trim($match[3]));
        } catch (\Throwable $e) {
            continue;
        }

        $count = DB::table('blogs')->where('slug', $slug)->update([
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);
        if ($count) {
            $updated++;
        }
    }
}

echo "Updated {$updated} blog created_at dates.\n";
