<?php
$html = file_get_contents(__DIR__ . '/dashboard.html');

// Let's search for classes related to cards, panels, widgets, bg-white, etc.
preg_match_all('/class="([^"]*)"/', $html, $matches);
$allClasses = [];
foreach ($matches[1] as $classStr) {
    $parts = preg_split('/\s+/', trim($classStr));
    foreach ($parts as $p) {
        if ($p !== '') {
            $allClasses[$p] = ($allClasses[$p] ?? 0) + 1;
        }
    }
}

$interesting = [
    'panel', 'panel-body', 'panel-default', 'panel-heading', 'panel-footer',
    'widget', 'widget-dragger', 'card', 'bg-white', 'tw-bg-white',
    'tw-border', 'tw-rounded', 'tw-shadow', 'top_stats_wrapper', 'quick-stats',
    'tw-bg-neutral', 'tw-bg-slate', 'tw-bg-gray', 'dataTables_wrapper'
];

foreach ($interesting as $cl) {
    if (isset($allClasses[$cl])) {
        echo "$cl: {$allClasses[$cl]}\n";
    }
}

// Also check any tw-bg-*
echo "\nAll tw-bg-* classes:\n";
foreach ($allClasses as $cl => $count) {
    if (strpos($cl, 'tw-bg-') === 0 || strpos($cl, 'panel') !== false || strpos($cl, 'widget') !== false) {
        echo "$cl: $count\n";
    }
}

