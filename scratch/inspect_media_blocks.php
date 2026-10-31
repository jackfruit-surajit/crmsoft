<?php
$style = file_get_contents('assets/css/style.css');

preg_match_all('/@media\s*\([^)]*768px[^)]*\)\s*\{((?:[^{}]+|\{[^{}]*\})*)\}/s', $style, $matches);
foreach ($matches[1] as $idx => $content) {
    echo "=== MEDIA QUERY BLOCK $idx ===\n";
    if (strpos($content, 'wrapper') !== false || strpos($content, 'sidebar') !== false || strpos($content, 'menu') !== false || strpos($content, 'rgba') !== false) {
        echo substr($content, 0, 1000) . "\n...\n";
    }
}

