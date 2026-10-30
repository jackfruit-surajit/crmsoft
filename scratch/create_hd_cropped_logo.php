<?php
$origPath = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';
$src = imagecreatefrompng($origPath);

// Tight bounds: X: 4 to 155 (152px), Y: 10 to 55 (46px)
$cropX = 3;
$cropY = 9;
$cropW = 154;
$cropH = 48;

// Create 4x HD version for crisp rendering on Retina / 4K / mobile
$scale = 4;
$hdW = $cropW * $scale; // 616
$hdH = $cropH * $scale; // 192

$hd = imagecreatetruecolor($hdW, $hdH);
imagealphablending($hd, false);
imagesavealpha($hd, true);
$trans = imagecolorallocatealpha($hd, 0, 0, 0, 127);
imagefill($hd, 0, 0, $trans);

imagecopyresampled($hd, $src, 0, 0, $cropX, $cropY, $hdW, $hdH, $cropW, $cropH);

// Save to uploads/company/logo.png and logo-dark.png
imagepng($hd, 'uploads/company/logo.png', 9);
imagepng($hd, 'uploads/company/logo-dark.png', 9);

echo "HD Crisp Logo created: {$hdW}x{$hdH}\n";

