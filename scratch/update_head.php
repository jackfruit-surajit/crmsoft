<?php
$file = 'application/views/admin/includes/head.php';
$content = file_get_contents($file);

$pwaMeta = '
    <!-- Progressive Web App (PWA) Meta & Manifest -->
    <link rel="manifest" href="<?php echo base_url(\'manifest.json\'); ?>">
    <meta name="theme-color" content="#0b0d14">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="BEETRX CRM">
    <link rel="apple-touch-icon" href="<?php echo base_url(\'assets/images/icons/apple-touch-icon.png\'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(\'assets/images/icons/icon-152x152.png\'); ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?php echo base_url(\'assets/images/icons/icon-192x192.png\'); ?>">
';

if (strpos($content, 'manifest.json') === false) {
    $target = '<meta name="viewport" content="width=device-width, initial-scale=1.0" />';
    $replacement = $target . "\r\n" . trim($pwaMeta);
    $content = str_replace($target, $replacement, $content);
    file_put_contents($file, $content);
    echo "Updated head.php successfully\n";
} else {
    echo "head.php already contains manifest.json\n";
}

