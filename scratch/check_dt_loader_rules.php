<?php
$tw = file_get_contents('assets/builds/tailwind.css');
if (preg_match('/\.dt-loader[^{]*\{[^}]+\}/', $tw, $m)) {
    echo $m[0] . "\n";
}
if (preg_match_all('/\.dt-loader[^{]*\{[^}]+\}/', $tw, $mAll)) {
    foreach ($mAll[0] as $r) {
        echo $r . "\n\n";
    }
}

