<?php
// Script to generate high-resolution PWA icons
$src = imagecreatefrompng('uploads/company/logo.png');
$srcW = imagesx($src);
$srcH = imagesy($src);

// The "B" emblem bounds in logo.png: (4, 4) to (277, 187), width=274, height=184
$emblemW = 274;
$emblemH = 184;
$emblemX = 4;
$emblemY = 4;

$sizes = [72, 96, 128, 144, 152, 192, 384, 512];
$outDir = 'assets/images/icons';
if (!is_dir($outDir)) {
    mkdir($outDir, 0777, true);
}

foreach ($sizes as $size) {
    $dst = imagecreatetruecolor($size, $size);
    // Dark background #0b0d14
    $bg = imagecolorallocate($dst, 11, 13, 20);
    imagefill($dst, 0, 0, $bg);
    
    // Subtle gold border
    $goldBorder = imagecolorallocatealpha($dst, 212, 175, 55, 60);
    imagesetthickness($dst, max(1, (int)($size / 64)));
    imagerectangle($dst, 1, 1, $size - 2, $size - 2, $goldBorder);
    
    // Calculate scaling for emblem inside icon (safe zone: 65% of icon size)
    $targetSize = $size * 0.70;
    $scale = min($targetSize / $emblemW, $targetSize / $emblemH);
    $scaledW = (int)($emblemW * $scale);
    $scaledH = (int)($emblemH * $scale);
    $posX = (int)(($size - $scaledW) / 2);
    $posY = (int)(($size - $scaledH) / 2);
    
    imagealphablending($dst, true);
    imagesavealpha($dst, false);
    
    imagecopyresampled($dst, $src, $posX, $posY, $emblemX, $emblemY, $scaledW, $scaledH, $emblemW, $emblemH);
    
    imagepng($dst, $outDir . "/icon-{$size}x{$size}.png", 9);
    imagedestroy($dst);
    echo "Generated icon-{$size}x{$size}.png\n";
}

// Maskable 512x512 icon (Safe zone: center 60% of icon size)
$maskSize = 512;
$dstMask = imagecreatetruecolor($maskSize, $maskSize);
$bgMask = imagecolorallocate($dstMask, 11, 13, 20);
imagefill($dstMask, 0, 0, $bgMask);

$targetSizeMask = $maskSize * 0.58; // 58% safe zone for circular/adaptive crops
$scaleMask = min($targetSizeMask / $emblemW, $targetSizeMask / $emblemH);
$scaledWMask = (int)($emblemW * $scaleMask);
$scaledHMask = (int)($emblemH * $scaleMask);
$posXMask = (int)(($maskSize - $scaledWMask) / 2);
$posYMask = (int)(($maskSize - $scaledHMask) / 2);

imagealphablending($dstMask, true);
imagecopyresampled($dstMask, $src, $posXMask, $posYMask, $emblemX, $emblemY, $scaledWMask, $scaledHMask, $emblemW, $emblemH);
imagepng($dstMask, $outDir . "/maskable-icon-512x512.png", 9);
imagedestroy($dstMask);
echo "Generated maskable-icon-512x512.png\n";

// Apple Touch Icon 180x180
$appleSize = 180;
$dstApple = imagecreatetruecolor($appleSize, $appleSize);
$bgApple = imagecolorallocate($dstApple, 11, 13, 20);
imagefill($dstApple, 0, 0, $bgApple);
$targetSizeApple = $appleSize * 0.70;
$scaleApple = min($targetSizeApple / $emblemW, $targetSizeApple / $emblemH);
$scaledWApple = (int)($emblemW * $scaleApple);
$scaledHApple = (int)($emblemH * $scaleApple);
$posXApple = (int)(($appleSize - $scaledWApple) / 2);
$posYApple = (int)(($appleSize - $scaledHApple) / 2);

imagealphablending($dstApple, true);
imagecopyresampled($dstApple, $src, $posXApple, $posYApple, $emblemX, $emblemY, $scaledWApple, $scaledHApple, $emblemW, $emblemH);
imagepng($dstApple, $outDir . "/apple-touch-icon.png", 9);
imagedestroy($dstApple);
echo "Generated apple-touch-icon.png\n";

imagedestroy($src);

