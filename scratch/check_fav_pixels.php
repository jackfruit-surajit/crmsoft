<?php
$fav = imagecreatefrompng('uploads/company/favicon.png');
// Let's sample some pixels
$w = imagesx($fav);
$h = imagesy($fav);
echo "Favicon size: {$w}x{$h}\n";

// Let's see if it's transparent or has dark background
$transparent = 0;
$dark = 0;
$gold = 0;
for ($x = 0; $x < $w; $x += 10) {
    for ($y = 0; $y < $h; $y += 10) {
        $rgb = imagecolorat($fav, $x, $y);
        $alpha = ($rgb >> 24) & 0x7F;
        if ($alpha > 60) $transparent++;
        else {
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            if ($r > 150 && $g > 100 && $b < 50) $gold++;
            if ($r < 40 && $g < 40 && $b < 40) $dark++;
        }
    }
}
echo "Sampled: transparent=$transparent, dark=$dark, gold=$gold\n";

