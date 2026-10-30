<?php
$orig = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';
$im = imagecreatefrompng($orig);
$w = imagesx($im);
$h = imagesy($im);

// Map the image: '.' for transparent, 'W' for white/near-white, '#' for dark/colored content
$grid = [];
for ($y = 0; $y < $h; $y += 2) {
    $line = "";
    for ($x = 0; $x < $w; $x += 2) {
        $c = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        if ($c['alpha'] > 100) {
            $line .= " "; // transparent
        } elseif ($c['red'] > 240 && $c['green'] > 240 && $c['blue'] > 240) {
            $line .= "."; // white background
        } else {
            $line .= "#"; // logo mark/text
        }
    }
    $grid[] = $line;
}

echo implode("\n", $grid);

