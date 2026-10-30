<?php
$f1 = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793359611150_070bd94d.png';
$f2 = 'C:/Users/user/.gemini/antigravity/brain/ded3f4a4-3a90-4235-b867-9623f9c333ee/.user_uploaded/media_1793365607886_36b97fc7.png';

echo "F1 md5: " . md5_file($f1) . " (size: " . filesize($f1) . ")\n";
echo "F2 md5: " . md5_file($f2) . " (size: " . filesize($f2) . ")\n";

