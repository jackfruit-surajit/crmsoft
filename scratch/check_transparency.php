<?php
$orig = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';
$im = imagecreatefrompng($orig);
$w = imagesx($im);
$h = imagesy($im);

$transparentCount = 0;
$whiteCount = 0;
$total = $w * $h;

for ($x = 0; $x < $w; $x++) {
    for ($y = 0; $y < $h; $y++) {
        $c = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        if ($c['alpha'] == 127) {
            $transparentCount++;
        } elseif ($c['red'] > 240 && $c['green'] > 240 && $c['blue'] > 240) {
            $whiteCount++;
        }
    }
}

echo "Total pixels: $total\n";
echo "Transparent (alpha=127): $transparentCount\n";
echo "Near white: $whiteCount\n";

