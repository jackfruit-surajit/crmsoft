<?php
$html = file_get_contents(__DIR__ . '/dashboard.html');

preg_match_all('/<button[^>]*class="([^"]*)"[^>]*>/i', $html, $btnMatches);
preg_match_all('/<a[^>]*class="([^"]*btn[^"]*)"[^>]*>/i', $html, $aBtnMatches);

$allBtnClasses = array_merge($btnMatches[1], $aBtnMatches[1]);
$uniqueBtnClasses = array_unique($allBtnClasses);
sort($uniqueBtnClasses);

echo "All Button Classes found in Dashboard:\n";
foreach ($uniqueBtnClasses as $c) {
    echo " - $c\n";
}

