<?php
$origPath = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';
$src = imagecreatefrompng($origPath);

// B mark bounds: X: 13 to 49 (w=37), Y: 21 to 49 (h=29)
$cropX = 12;
$cropY = 20;
$cropW = 38;
$cropH = 30;

$favSize = 128;
$fav = imagecreatetruecolor($favSize, $favSize);
imagealphablending($fav, false);
imagesavealpha($fav, true);
$trans = imagecolorallocatealpha($fav, 0, 0, 0, 127);
imagefill($fav, 0, 0, $trans);

// Keep aspect ratio
$maxDim = max($cropW, $cropH);
$targetDim = (int)($favSize * 0.85); // 85% with margin
$dstW = (int)($cropW * ($targetDim / $maxDim));
$dstH = (int)($cropH * ($targetDim / $maxDim));
$dstX = (int)(($favSize - $dstW) / 2);
$dstY = (int)(($favSize - $dstH) / 2);

imagecopyresampled($fav, $src, $dstX, $dstY, $cropX, $cropY, $dstW, $dstH, $cropW, $cropH);

imagepng($fav, 'uploads/company/favicon.png', 9);
echo "Favicon updated successfully: 128x128\n";

