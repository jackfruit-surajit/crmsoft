<?php
$path = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';
$im = imagecreatefrompng($path);
$w = imagesx($im);
$h = imagesy($im);
echo "Width: $w, Height: $h\n";

$cornerColors = [
    '0,0' => imagecolorat($im, 0, 0),
    'w-1,0' => imagecolorat($im, $w-1, 0),
    '0,h-1' => imagecolorat($im, 0, $h-1),
    'w-1,h-1' => imagecolorat($im, $w-1, $h-1),
];

foreach ($cornerColors as $pos => $c) {
    $rgba = imagecolorsforindex($im, $c);
    echo "$pos: R={$rgba['red']}, G={$rgba['green']}, B={$rgba['blue']}, Alpha={$rgba['alpha']}\n";
}
