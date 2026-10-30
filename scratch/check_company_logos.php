<?php
$files = ['uploads/company/logo.png', 'uploads/company/logo-dark.png'];
foreach ($files as $f) {
    $info = getimagesize($f);
    echo "$f: {$info[0]}x{$info[1]}, mime: {$info['mime']}\n";
}

