<?php
$orig = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';
$im = imagecreatefrompng($orig);
$w = imagesx($im);
$h = imagesy($im);

$minX = $w; $minY = $h; $maxX = 0; $maxY = 0;
$colors = [];

for ($x = 0; $x < $w; $x++) {
    for ($y = 0; $y < $h; $y++) {
        $c = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        if ($c['alpha'] < 120) { // non-transparent
            if ($x < $minX) $minX = $x;
            if ($x > $maxX) $maxX = $x;
            if ($y < $minY) $minY = $y;
            if ($y > $maxY) $maxY = $y;
        }
    }
}

echo "Content bounds: X: $minX to $maxX, Y: $minY to $maxY\n";
echo "Content size: " . ($maxX - $minX + 1) . " x " . ($maxY - $minY + 1) . "\n";

