<?php
$ch = curl_init('http://localhost/crmsoft/admin/authentication');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
$res = curl_exec($ch);
curl_close($ch);

preg_match('/name="csrf_token_name" value="([^"]+)"/', $res, $matches);
$csrf = $matches[1] ?? '';

preg_match_all('/Set-Cookie:\s*([^;]+)/i', $res, $cookieMatches);
$cookies = implode('; ', $cookieMatches[1]);

$ch2 = curl_init('http://localhost/crmsoft/admin/authentication');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_HEADER, true);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_HTTPHEADER, [
    "Cookie: $cookies",
    "Referer: http://localhost/crmsoft/admin/authentication"
]);
curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query([
    'csrf_token_name' => $csrf,
    'email' => 'admin@admin.com',
    'password' => '123456',
    'remember' => '1'
]));
$res2 = curl_exec($ch2);
curl_close($ch2);

preg_match_all('/Set-Cookie:\s*([^;]+)/i', $res2, $cookieMatches2);
$sessionCookies = implode('; ', $cookieMatches2[1]);

$pages = [
    'Dashboard' => 'http://localhost/crmsoft/admin/',
    'Clients' => 'http://localhost/crmsoft/admin/clients',
    'Invoices' => 'http://localhost/crmsoft/admin/invoices',
    'Tasks' => 'http://localhost/crmsoft/admin/tasks',
    'Settings' => 'http://localhost/crmsoft/admin/settings',
];

foreach ($pages as $name => $url) {
    $c = curl_init($url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, [
        "Cookie: $cookies; $sessionCookies"
    ]);
    $html = curl_exec($c);
    $code = curl_getinfo($c, CURLINFO_HTTP_CODE);
    curl_close($c);

    $hasCustomCss = (strpos($html, 'custom.css') !== false);
    echo "$name ($url) -> HTTP $code | Has custom.css: " . ($hasCustomCss ? 'YES' : 'NO') . "\n";
}

