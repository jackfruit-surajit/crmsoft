<?php
$fav = imagecreatefrompng('uploads/company/favicon.png');
echo "Favicon: " . imagesx($fav) . "x" . imagesy($fav) . "\n";

$logo = imagecreatefrompng('uploads/company/logo.png');
echo "Logo: " . imagesx($logo) . "x" . imagesy($logo) . "\n";

// Let's also check if there are other images in brain artifacts
$artifacts = glob('C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/*.*');
foreach ($artifacts as $a) {
    if (preg_match('/\.(png|jpg|jpeg)$/i', $a)) {
        $sz = getimagesize($a);
        echo basename($a) . ": " . $sz[0] . "x" . $sz[1] . "\n";
    }
}
$userUploads = glob('C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/*.*');
foreach ($userUploads as $a) {
    if (preg_match('/\.(png|jpg|jpeg)$/i', $a)) {
        $sz = getimagesize($a);
        echo "user_uploaded/" . basename($a) . ": " . $sz[0] . "x" . $sz[1] . "\n";
    }
}

