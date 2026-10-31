<?php
$fav = imagecreatefrompng('uploads/company/favicon.png');
$w = imagesx($fav);
$h = imagesy($fav);

// Find non-transparent bounding box
$minX = $w; $minY = $h; $maxX = 0; $maxY = 0;
for ($x = 0; $x < $w; $x++) {
    for ($y = 0; $y < $h; $y++) {
        $alpha = (imagecolorat($fav, $x, $y) >> 24) & 0x7F;
        if ($alpha < 120) {
            if ($x < $minX) $minX = $x;
            if ($x > $maxX) $maxX = $x;
            if ($y < $minY) $minY = $y;
            if ($y > $maxY) $maxY = $y;
        }
    }
}

echo "Favicon content bounds: ($minX, $minY) to ($maxX, $maxY), width=" . ($maxX - $minX + 1) . ", height=" . ($maxY - $minY + 1) . "\n";

