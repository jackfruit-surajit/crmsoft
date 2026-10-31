<?php
$file = 'application/views/admin/includes/header.php';
$content = file_get_contents($file);

// 1. Mobile icon menu
if (strpos($content, 'pwa-install-mobile-icon') === false) {
    $target = '<ul class="mobile-icon-menu tw-inline-flex tw-mt-5">';
    $inject = $target . "\r\n" . '                    <li class="header-pwa-mobile ltr:tw-mr-2 rtl:tw-ml-2" id="pwa-install-mobile-icon" style="display: none;">
                        <a href="#" class="btn-install-pwa-trigger tw-block" data-toggle="tooltip" title="Install App">
                            <i class="fa-solid fa-download fa-lg" style="color: #d4af37;"></i>
                        </a>
                    </li>';
    $content = str_replace($target, $inject, $content);
}

// 2. Mobile navbar drop-down
if (strpos($content, 'pwa-install-mobile-menu') === false) {
    $target = '<div class="mobile-navbar collapse" id="mobile-collapse" aria-expanded="false" style="height: 0px;"
                    role="navigation">
                    <ul class="nav navbar-nav">';
    if (strpos($content, $target) !== false) {
        $inject = $target . "\r\n" . '                        <li class="header-pwa-install-menu" id="pwa-install-mobile-menu" style="display: none;">
                            <a href="#" class="btn-install-pwa-trigger" style="color: #ffd700 !important; font-weight: 600;">
                                <i class="fa-solid fa-download tw-mr-2" style="color: #d4af37;"></i> Install BEETRX Web App
                            </a>
                        </li>';
        $content = str_replace($target, $inject, $content);
    } else {
        // Alternative match
        $targetAlt = '<div class="mobile-navbar collapse" id="mobile-collapse"';
        $findUl = strpos($content, '<ul class="nav navbar-nav">', strpos($content, $targetAlt));
        if ($findUl !== false) {
            $endUl = $findUl + strlen('<ul class="nav navbar-nav">');
            $content = substr($content, 0, $endUl) . "\r\n" . '                        <li class="header-pwa-install-menu" id="pwa-install-mobile-menu" style="display: none;">
                            <a href="#" class="btn-install-pwa-trigger" style="color: #ffd700 !important; font-weight: 600;">
                                <i class="fa-solid fa-download tw-mr-2" style="color: #d4af37;"></i> Install BEETRX Web App
                            </a>
                        </li>' . substr($content, $endUl);
        }
    }
}

// 3. Desktop navbar-right
if (strpos($content, 'pwa-install-nav') === false) {
    $target = '<ul class="nav navbar-nav navbar-right">';
    $inject = $target . "\r\n" . '                <li class="icon header-pwa-install tw-relative ltr:tw-mr-2 rtl:tw-ml-2" id="pwa-install-nav" style="display: none;">
                    <a href="#" class="btn-install-pwa-trigger !tw-px-2 tw-group tw-inline-flex tw-items-center" data-toggle="tooltip" title="Install BEETRX Web App" data-placement="bottom">
                        <span class="pwa-header-pill">
                            <i class="fa-solid fa-download tw-mr-1.5"></i> <span>Install App</span>
                        </span>
                    </a>
                </li>';
    $content = str_replace($target, $inject, $content);
}

file_put_contents($file, $content);
echo "Updated header.php successfully\n";

