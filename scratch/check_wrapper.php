<?php
$html = file_get_contents(__DIR__ . '/dashboard.html');

preg_match('/<body[^>]*class="([^"]*)"/', $html, $b);
echo "Body class: " . ($b[1] ?? '') . "\n";

preg_match('/<div id="wrapper"[^>]*class="([^"]*)"/', $html, $w);
echo "Wrapper class: " . ($w[1] ?? '') . "\n";

preg_match('/<div id="content"[^>]*class="([^"]*)"/', $html, $c);
echo "Content class: " . ($c[1] ?? '') . "\n";

