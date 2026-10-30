<?php
$html = file_get_contents(__DIR__ . '/dashboard.html');
preg_match('/<div class="top_stats_wrapper[^"]*"[^>]*>(.*?)<\/div>\s*<\/div>/s', $html, $m);
echo $m[0] ?? 'Not found';

