<?php
$logo = imagecreatefrompng('uploads/company/logo.png');
$w = imagesx($logo);
$h = imagesy($logo);

// Check if logo emblem (the "B" symbol on the left) is high quality
$minX = $w; $minY = $h; $maxX = 0; $maxY = 0;
// Just the "B" symbol, which is roughly first 40% of width
for ($x = 0; $x < $w * 0.45; $x++) {
    for ($y = 0; $y < $h; $y++) {
        $alpha = (imagecolorat($logo, $x, $y) >> 24) & 0x7F;
        if ($alpha < 120) {
            if ($x < $minX) $minX = $x;
            if ($x > $maxX) $maxX = $x;
            if ($y < $minY) $minY = $y;
            if ($y > $maxY) $maxY = $y;
        }
    }
}
echo "Logo 'B' emblem bounds: ($minX, $minY) to ($maxX, $maxY), width=" . ($maxX - $minX + 1) . ", height=" . ($maxY - $minY + 1) . "\n";

