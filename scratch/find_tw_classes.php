<?php
$tw = file_get_contents('assets/builds/tailwind.css');
preg_match_all('/\.([a-zA-Z0-9_\-]+(?:panel|card|widget|box)[a-zA-Z0-9_\-]*)\s*\{/i', $tw, $m);
$classes = array_unique($m[1]);
sort($classes);
echo "Card-related classes in tailwind.css:\n";
print_r(array_slice($classes, 0, 30));

