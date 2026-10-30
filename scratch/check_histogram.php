<?php
$orig = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';
$im = imagecreatefrompng($orig);
$w = imagesx($im);
$h = imagesy($im);

$histogram = [];
for ($x = 0; $x < $w; $x++) {
    for ($y = 0; $y < $h; $y++) {
        $c = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        if ($c['alpha'] < 50) {
            $hex = sprintf('#%02X%02X%02X', $c['red'], $c['green'], $c['blue']);
            $histogram[$hex] = ($histogram[$hex] ?? 0) + 1;
        }
    }
}
arsort($histogram);
echo "Top 20 colors:\n";
$i = 0;
foreach ($histogram as $hex => $count) {
    echo "$hex: $count\n";
    if (++$i >= 20) break;
}

