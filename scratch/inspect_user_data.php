<?php
$html = file_get_contents(__DIR__ . '/dashboard.html');
preg_match('/<div class="panel_s user-data[^"]*".*?<\/div>\s*<\/div>/s', $html, $m);
echo substr($m[0] ?? 'None', 0, 800);

