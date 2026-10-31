<?php
$info = getimagesize('uploads/company/logo.png');
echo "logo.png: " . $info[0] . "x" . $info[1] . " (" . $info['mime'] . ")\n";
$infoFav = getimagesize('uploads/company/favicon.png');
echo "favicon.png: " . $infoFav[0] . "x" . $infoFav[1] . " (" . $infoFav['mime'] . ")\n";

if (file_exists('C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png')) {
    $infoUpload = getimagesize('C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png');
    echo "uploaded logo: " . $infoUpload[0] . "x" . $infoUpload[1] . " (" . $infoUpload['mime'] . ")\n";
}

