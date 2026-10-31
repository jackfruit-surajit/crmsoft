<?php
$css = file_get_contents('assets/css/style.css');
preg_match_all('/@media[^{]+\{(?:[^{}]*\{[^{}]*\})*[^{}]*\}/i', $css, $matches);
foreach ($matches[0] as $mediaBlock) {
    if (strpos($mediaBlock, 'max-width') !== false && (strpos($mediaBlock, 'background') !== false || strpos($mediaBlock, 'dropdown') !== false || strpos($mediaBlock, 'header') !== false || strpos($mediaBlock, 'navbar') !== false)) {
        echo substr($mediaBlock, 0, 500) . "\n---\n";
    }
}

