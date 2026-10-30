<?php
$ch = curl_init('https://system.beetrx.com/admin/authentication');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
$res = curl_exec($ch);
curl_close($ch);

preg_match('/name="csrf_token_name" value="([^"]+)"/', $res, $matches);
$csrf = $matches[1] ?? '';

preg_match_all('/Set-Cookie:\s*([^;]+)/i', $res, $cookieMatches);
$cookies = implode('; ', $cookieMatches[1]);

$ch2 = curl_init('https://system.beetrx.com/admin/authentication');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_HEADER, true);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_HTTPHEADER, [
    "Cookie: $cookies",
    "Referer: https://system.beetrx.com/admin/authentication"
]);
curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query([
    'csrf_token_name' => $csrf,
    'email' => 'admin@admin.com',
    'password' => '123456',
    'remember' => '1'
]));
$res2 = curl_exec($ch2);
$httpCode = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
curl_close($ch2);

preg_match('/Location:\s*([^\r\n]+)/i', $res2, $loc);
echo "HTTP Code: $httpCode\n";
echo "Redirect Location: " . ($loc[1] ?? 'None') . "\n";
