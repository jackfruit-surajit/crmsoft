<?php
$files = ['assets/css/style.css', 'assets/builds/tailwind.css', 'assets/css/style.min.css'];
foreach ($files as $f) {
    $c = file_get_contents($f);
    preg_match_all('/([^{}]+loader[^{}]*)\{([^}]+)\}/i', $c, $matches);
    echo "In $f:\n";
    foreach ($matches[1] as $sel) {
        echo trim($sel) . "\n";
    }
}

