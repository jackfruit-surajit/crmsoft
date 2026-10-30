<?php
$orig = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';
$dark = 'uploads/company/logo-dark.png';
$light = 'uploads/company/logo.png';

$imOrig = imagecreatefrompng($orig);
$imDark = imagecreatefrompng($dark);
$imLight = imagecreatefrompng($light);

// Sample some pixel colors across the letters
// In original 160x65:
// X center approx:
// B: x=28, y=32
// EE: x=55, y=32
// TR: x=95, y=32
// X: x=140, y=32
echo "Original 160x65:\n";
$c1 = imagecolorsforindex($imOrig, imagecolorat($imOrig, 28, 32));
$c2 = imagecolorsforindex($imOrig, imagecolorat($imOrig, 55, 32));
$c3 = imagecolorsforindex($imOrig, imagecolorat($imOrig, 95, 32));
$c4 = imagecolorsforindex($imOrig, imagecolorat($imOrig, 140, 32));
echo "B: R={$c1['red']} G={$c1['green']} B={$c1['blue']} A={$c1['alpha']}\n";
echo "EE: R={$c2['red']} G={$c2['green']} B={$c2['blue']} A={$c2['alpha']}\n";
echo "TR: R={$c3['red']} G={$c3['green']} B={$c3['blue']} A={$c3['alpha']}\n";
echo "X: R={$c4['red']} G={$c4['green']} B={$c4['blue']} A={$c4['alpha']}\n";

echo "\nLogo-Dark (1280x520):\n";
$c1 = imagecolorsforindex($imDark, imagecolorat($imDark, (int)(28*8), (int)(32*8)));
$c2 = imagecolorsforindex($imDark, imagecolorat($imDark, (int)(55*8), (int)(32*8)));
$c3 = imagecolorsforindex($imDark, imagecolorat($imDark, (int)(95*8), (int)(32*8)));
$c4 = imagecolorsforindex($imDark, imagecolorat($imDark, (int)(140*8), (int)(32*8)));
echo "B: R={$c1['red']} G={$c1['green']} B={$c1['blue']} A={$c1['alpha']}\n";
echo "EE: R={$c2['red']} G={$c2['green']} B={$c2['blue']} A={$c2['alpha']}\n";
echo "TR: R={$c3['red']} G={$c3['green']} B={$c3['blue']} A={$c3['alpha']}\n";
echo "X: R={$c4['red']} G={$c4['green']} B={$c4['blue']} A={$c4['alpha']}\n";

