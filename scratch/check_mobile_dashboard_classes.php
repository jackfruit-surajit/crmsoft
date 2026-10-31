<?php
$html = file_get_contents(__DIR__ . '/dashboard.html');

// Let's check any elements with class containing white, light, or dropdown
preg_match_all('/class="([^"]*(?:dropdown|mobile|menu|white|navbar)[^"]*)"/i', $html, $m);
$unique = array_unique($m[1]);
sort($unique);
foreach ($unique as $c) {
    echo "$c\n";
}

