<?php
$f = 'uploads/company/favicon.png';
$info = getimagesize($f);
echo "Favicon size: {$info[0]}x{$info[1]}, mime: {$info['mime']}\n";

