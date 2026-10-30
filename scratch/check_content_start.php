<?php
$html = file_get_contents(__DIR__ . '/dashboard.html');

// Let's find elements before the first widget
preg_match('/<div class="content">(.*?)<div id="widget-/s', $html, $m);
echo substr($m[1] ?? 'None', 0, 1000);

