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

$ch3 = curl_init('http://localhost/crmsoft/admin/clients');
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch3, CURLOPT_HTTPHEADER, [
    "Cookie: $cookies; $sessionCookies"
]);
$clientsHtml = curl_exec($ch3);
curl_close($ch3);

preg_match_all('/<button[^>]*class="([^"]*)"[^>]*>/i', $clientsHtml, $btnMatches);
preg_match_all('/<a[^>]*class="([^"]*btn[^"]*)"[^>]*>/i', $clientsHtml, $aBtnMatches);

$allBtnClasses = array_merge($btnMatches[1], $aBtnMatches[1]);
$uniqueBtnClasses = array_unique($allBtnClasses);
sort($uniqueBtnClasses);

echo "All Button Classes found in Clients page:\n";
foreach ($uniqueBtnClasses as $c) {
    echo " - $c\n";
}

