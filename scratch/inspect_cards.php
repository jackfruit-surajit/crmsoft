<?php
$html = file_get_contents(__DIR__ . '/dashboard.html');

// Let's find all divs with panel_s or widget or top_stats_wrapper or card
preg_match_all('/<div[^>]*class="([^"]*(?:panel_s|widget|top_stats_wrapper|card|panel-body)[^"]*)"[^>]*>/i', $html, $matches);

$uniqueClasses = array_unique($matches[1]);
foreach ($uniqueClasses as $c) {
    echo $c . "\n";
}

