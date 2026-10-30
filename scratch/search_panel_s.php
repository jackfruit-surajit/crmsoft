<?php
$files = glob('assets/css/*.css');
$files = array_merge($files, glob('assets/builds/*.css'));
foreach ($files as $file) {
    $content = file_get_contents($file);
    if (preg_match_all('/([^{}]+panel_s[^{}]*)\{([^}]+)\}/', $content, $m)) {
        echo "Found in $file:\n";
        foreach ($m[0] as $rule) {
            echo substr($rule, 0, 150) . "...\n";
        }
    }
}

