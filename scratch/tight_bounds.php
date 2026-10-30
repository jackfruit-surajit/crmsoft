<?php
$orig = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';
$im = imagecreatefrompng($orig);
$w = imagesx($im);
$h = imagesy($im);

// Let's find any pixel with alpha < 127 (meaning it has content)
$minX = $w; $minY = $h; $maxX = 0; $maxY = 0;
for ($x = 0; $x < $w; $x++) {
    for ($y = 0; $y < $h; $y++) {
        $c = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        if ($c['alpha'] < 127) {
            if ($x < $minX) $minX = $x;
            if ($x > $maxX) $maxX = $x;
            if ($y < $minY) $minY = $y;
            if ($y > $maxY) $maxY = $y;
        }
    }
}

echo "Tight content bounds:\n";
echo "X: $minX to $maxX (width: " . ($maxX - $minX + 1) . ")\n";
echo "Y: $minY to $maxY (height: " . ($maxY - $minY + 1) . ")\n";

