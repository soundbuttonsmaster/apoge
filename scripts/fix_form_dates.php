<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$baseUrl = 'https://www.apogeeagrotech.com';
$cookieFile = __DIR__ . '/../storage/app/fix_form_dates_cookies.txt';
@unlink($cookieFile);

function request(string $url, string $cookieFile, array $post = []): ?string
{
    $ch = curl_init($url);
    $opts = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_COOKIEJAR => $cookieFile,
        CURLOPT_COOKIEFILE => $cookieFile,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 180,
        CURLOPT_USERAGENT => 'ApogeeFix/1.0',
    ];
    if ($post) {
        $opts[CURLOPT_POST] = true;
        $opts[CURLOPT_POSTFIELDS] = http_build_query($post);
    }
    curl_setopt_array($ch, $opts);
    $body = curl_exec($ch);
    curl_close($ch);

    return $body === false ? null : $body;
}

function parseAdminTableRows(string $html): array
{
    if (!preg_match('#<tbody>(.*?)</tbody>#si', $html, $tbodyMatch)) {
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
        $rows[] = array_map(
            fn ($t) => trim(html_entity_decode(strip_tags($t), ENT_QUOTES | ENT_HTML5)),
            $tdm[1]
        );
    }

    return $rows;
}

function parseDate(string $date): ?\Carbon\Carbon
{
    try {
        return \Carbon\Carbon::createFromFormat('d F Y', trim($date));
    } catch (\Throwable $e) {
        try {
            return \Carbon\Carbon::parse($date);
        } catch (\Throwable $e2) {
            return null;
        }
    }
}

function applyNullableMatch($query, string $column, ?string $value)
{
    $value = trim((string) $value);
    if ($value === '') {
        return $query->where(function ($q) use ($column) {
            $q->whereNull($column)->orWhere($column, '');
        });
    }

    return $query->where($column, $value);
}

function updateFormDates(string $table, array $rows, callable $matcher): int
{
    $updated = 0;
    foreach ($rows as $tds) {
        $createdAt = parseDate($tds[1]);
        if (!$createdAt) {
            continue;
        }
        $query = DB::table($table);
        $matcher($query, $tds);
        $updated += $query->update(['created_at' => $createdAt, 'updated_at' => $createdAt]);
    }

    return $updated;
}

$loginHtml = request($baseUrl . '/admin-login', $cookieFile);
if (!$loginHtml || !preg_match('/name="_token" value="([^"]+)"/', $loginHtml, $tokenMatch)) {
    fwrite(STDERR, "Failed to load admin login page\n");
    exit(1);
}

request($baseUrl . '/admin-login', $cookieFile, [
    'email' => 'admin@gmail.com',
    'password' => '1234567',
    '_token' => $tokenMatch[1],
]);

$dash = request($baseUrl . '/admin/dashboard', $cookieFile);
if (!$dash || !str_contains($dash, 'Dashboard')) {
    fwrite(STDERR, "Admin login failed\n");
    exit(1);
}

$enquiryHtml = request($baseUrl . '/admin/enquiry', $cookieFile);
$findHtml = request($baseUrl . '/admin/find-a-dealer', $cookieFile);
$becomeHtml = request($baseUrl . '/admin/become-a-dealer', $cookieFile);

$updates = [
    'enquiries' => updateFormDates('enquiries', parseAdminTableRows($enquiryHtml ?? ''), function ($query, $tds) {
        if (count($tds) < 7) {
            return;
        }
        $query->where('name', $tds[2])
            ->where('email', $tds[3])
            ->where('phone', $tds[4])
            ->where('location', $tds[5]);
    }),
    'find_a_dealers' => updateFormDates('find_a_dealers', parseAdminTableRows($findHtml ?? ''), function ($query, $tds) {
        if (count($tds) < 7) {
            return;
        }
        $query->where('name', $tds[2])
            ->where('email', $tds[3])
            ->where('phone', $tds[4]);
        applyNullableMatch($query, 'state', $tds[5] ?? '');
        applyNullableMatch($query, 'district', $tds[6] ?? '');
    }),
    'become_a_dealers' => updateFormDates('become_a_dealers', parseAdminTableRows($becomeHtml ?? ''), function ($query, $tds) {
        if (count($tds) < 9) {
            return;
        }
        $query->where('name', $tds[2])
            ->where('email', $tds[3])
            ->where('phone', $tds[4])
            ->where('state', $tds[5])
            ->where('district', $tds[6])
            ->where('village', $tds[7]);
    }),
];

echo "Updated enquiry dates: {$updates['enquiries']}\n";
echo "Updated find-a-dealer dates: {$updates['find_a_dealers']}\n";
echo "Updated become-a-dealer dates: {$updates['become_a_dealers']}\n";
