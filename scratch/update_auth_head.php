<?php
$file = 'application/views/authentication/includes/head.php';
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
    <script src="<?php echo base_url(\'assets/js/pwa-install.js\'); ?>" defer></script>
';

if (strpos($content, 'manifest.json') === false) {
    $target = '</title>';
    $replacement = $target . "\r\n" . trim($pwaMeta);
    $content = str_replace($target, $replacement, $content);
    file_put_contents($file, $content);
    echo "Updated authentication/includes/head.php successfully\n";
} else {
    echo "authentication/includes/head.php already contains manifest.json\n";
}

