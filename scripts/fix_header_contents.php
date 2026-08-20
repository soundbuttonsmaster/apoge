<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$baseUrl = 'https://www.apogeeagrotech.com';
$cookieFile = storage_path('app/admin_fix_cookies.txt');
@unlink($cookieFile);

function request(string $method, string $url, array $post = [], string $cookieFile = ''): ?string
{
    $ch = curl_init($url);
    $opts = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_COOKIEJAR => $cookieFile,
        CURLOPT_COOKIEFILE => $cookieFile,
        CURLOPT_USERAGENT => 'ApogeeFix/1.0',
        CURLOPT_TIMEOUT => 60,
        CURLOPT_FOLLOWLOCATION => $method === 'GET',
    ];
    if ($method === 'POST') {
        $opts[CURLOPT_POST] = true;
        $opts[CURLOPT_POSTFIELDS] = http_build_query($post);
        $opts[CURLOPT_FOLLOWLOCATION] = false;
    }
    curl_setopt_array($ch, $opts);
    $body = curl_exec($ch);
    curl_close($ch);
    return $body === false ? null : $body;
}

$loginHtml = request('GET', "$baseUrl/admin-login", [], $cookieFile);
if (!$loginHtml || !preg_match('/name="_token" value="([^"]+)"/', $loginHtml, $m)) {
    fwrite(STDERR, "Login page failed\n");
    exit(1);
}
request('POST', "$baseUrl/admin-login", [
    'email' => 'admin@gmail.com',
    'password' => '1234567',
    '_token' => $m[1],
], $cookieFile);

foreach (['home', 'photo_gallery', 'video_gallery'] as $pageName) {
    $json = request('GET', "$baseUrl/admin/header-content/get?page_name=" . urlencode($pageName), [], $cookieFile);
    $parsed = json_decode($json ?? '', true);
    if (empty($parsed['status']) || empty($parsed['data'])) {
        echo "Skip: $pageName\n";
        continue;
    }
    $data = $parsed['data'];
    DB::table('header_contents')->updateOrInsert(
        ['page_name' => $pageName],
        [
            'url' => $data['url'] ?? '/',
            'head_content' => $data['head_content'] ?? '.',
            'status' => (string) ($data['status'] ?? '1'),
            'meta_title' => $data['meta_title'] ?? null,
            'meta_keywords' => $data['meta_keywords'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'updated_at' => now(),
            'created_at' => now(),
        ]
    );
    echo "Fixed: $pageName => " . ($data['meta_title'] ?? '') . "\n";
}

echo "Done.\n";
