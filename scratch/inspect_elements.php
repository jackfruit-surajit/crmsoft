<?php
$html = file_get_contents(__DIR__ . '/dashboard.html');

// Let's check all texts, headings, and tables inside panels
preg_match_all('/<h[1-6][^>]*class="([^"]*)"[^>]*>/i', $html, $hMatches);
echo "Headings in dashboard:\n";
print_r(array_slice(array_unique($hMatches[0]), 0, 10));

// Check tables
preg_match_all('/<table[^>]*class="([^"]*)"[^>]*>/i', $html, $tMatches);
echo "\nTables in dashboard:\n";
print_r(array_unique($tMatches[0]));

// Check top_stats
preg_match_all('/<div class="top_stats_wrapper[^"]*"[^>]*>(.*?)<\/div>/s', $html, $statMatches);
echo "\nTop stats count: " . count($statMatches[0]) . "\n";
if (isset($statMatches[0][0])) {
    echo "Sample top stat:\n" . substr(strip_tags($statMatches[0][0]), 0, 100) . "\n";
}

