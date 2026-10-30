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

// Now request admin dashboard
$ch3 = curl_init('http://localhost/crmsoft/admin/');
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch3, CURLOPT_HTTPHEADER, [
    "Cookie: $cookies; $sessionCookies"
]);
$dashHtml = curl_exec($ch3);
curl_close($ch3);

echo "Dashboard HTML length: " . strlen($dashHtml) . "\n";
// Save dashboard HTML to scratch/dashboard.html to analyze classes
file_put_contents(__DIR__ . '/dashboard.html', $dashHtml);
echo "Saved to scratch/dashboard.html\n";

