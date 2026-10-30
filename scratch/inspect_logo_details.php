<?php
$orig = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';
$im = imagecreatefrompng($orig);
$w = imagesx($im);
$h = imagesy($im);

echo "Checking row 10 to 55 for background:\n";
// Let's check what the white pixels are
$minW = 255; $minG = 255; $minB = 255;
$whitePixelCoords = [];
for ($y = 0; $y < $h; $y++) {
    for ($x = 0; $x < $w; $x++) {
        $c = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        if ($c['alpha'] == 0 && ($c['red'] > 220 && $c['green'] > 220 && $c['blue'] > 220)) {
            // near white
        }
    }
}
echo "Checked.\n";

