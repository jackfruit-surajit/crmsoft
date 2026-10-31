<?php
$img = imagecreatefromjpeg('C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/beetrx_logo_vector_hd_1793360483377.jpg');
$w = imagesx($img);
$h = imagesy($img);

// Scan for non-white pixels (it's white bg)
$minX = $w; $minY = $h; $maxX = 0; $maxY = 0;
for ($x = 0; $x < $w * 0.45; $x += 2) {
    for ($y = 0; $y < $h; $y += 2) {
        $rgb = imagecolorat($img, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        if ($r < 240 || $g < 240 || $b < 240) {
            if ($x < $minX) $minX = $x;
            if ($x > $maxX) $maxX = $x;
            if ($y < $minY) $minY = $y;
            if ($y > $maxY) $maxY = $y;
        }
    }
}
echo "Vector HD B emblem: ($minX, $minY) to ($maxX, $maxY), width=" . ($maxX - $minX + 1) . ", height=" . ($maxY - $minY + 1) . "\n";

