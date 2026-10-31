<?php
$file = 'application/views/admin/includes/scripts.php';
$content = file_get_contents($file);

if (strpos($content, 'pwa-install.js') === false) {
    $target = '<?php app_admin_footer(); ?>';
    $pwaScript = '<script src="<?php echo base_url(\'assets/js/pwa-install.js?v=\' . filemtime(FCPATH . \'assets/js/pwa-install.js\')); ?>"></script>' . "\r\n";
    $replacement = $pwaScript . $target;
    $content = str_replace($target, $replacement, $content);
    file_put_contents($file, $content);
    echo "Updated scripts.php successfully\n";
} else {
    echo "scripts.php already contains pwa-install.js\n";
}

