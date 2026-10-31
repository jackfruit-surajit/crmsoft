<?php
$style = file_get_contents('assets/css/style.css');
$custom = file_get_contents('assets/css/custom.css');

echo "=== STYLE.CSS RULES FOR SHOW-SIDEBAR & MOBILE WRAPPER ===\n";
preg_match_all('/([^{]+)\{([^}]+)\}/', $style, $matches, PREG_SET_ORDER);
foreach ($matches as $m) {
    $sel = trim($m[1]);
    $body = trim($m[2]);
    if (stripos($sel, 'show-sidebar') !== false || stripos($sel, 'page-small') !== false) {
        echo "SELECTOR: " . $sel . "\n";
        echo "BODY: " . $body . "\n\n";
    }
}

