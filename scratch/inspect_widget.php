<?php
$html = file_get_contents(__DIR__ . '/dashboard.html');
preg_match('/<div class="widget[^"]*"[^>]*>.*?<div class="panel_s[^"]*".*?<\/div>\s*<\/div>/s', $html, $m);
echo substr($m[0] ?? 'None', 0, 800);

