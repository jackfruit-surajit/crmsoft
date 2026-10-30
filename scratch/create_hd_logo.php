<?php
$origPath = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';
$src = imagecreatefrompng($origPath);
$sw = imagesx($src);
$sh = imagesy($src);

// Let's create high-res version: 4x scale = 640 x 260
$scale = 4;
$dw = $sw * $scale;
$dh = $sh * $scale;

$dst = imagecreatetruecolor($dw, $dh);
imagealphablending($dst, false);
imagesavealpha($dst, true);
$trans = imagecolorallocatealpha($dst, 0, 0, 0, 127);
imagefill($dst, 0, 0, $trans);

imagecopyresampled($dst, $src, 0, 0, 0, 0, $dw, $dh, $sw, $sh);

$outPath = 'uploads/company/logo_hd.png';
imagepng($dst, $outPath, 9);
echo "Created HD logo: {$dw}x{$dh} at $outPath\n";

