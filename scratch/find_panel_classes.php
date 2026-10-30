<?php
$style = file_get_contents('assets/css/style.css');
preg_match_all('/\.([a-zA-Z0-9_\-]+(?:panel|card|widget|box)[a-zA-Z0-9_\-]*)\s*\{/i', $style, $m);
$classes = array_unique($m[1]);
sort($classes);
echo "Card-related classes in style.css:\n";
print_r(array_slice($classes, 0, 30));

