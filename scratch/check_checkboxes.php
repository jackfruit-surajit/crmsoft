<?php
$html = file_get_contents(__DIR__ . '/dashboard.html');

preg_match_all('/<input[^>]*type="checkbox"[^>]*>/i', $html, $cbMatches);
echo "Checkboxes count: " . count($cbMatches[0]) . "\n";

preg_match_all('/<div class="checkbox[^"]*"[^>]*>/i', $html, $cbDivs);
echo "Checkbox wrapper count: " . count($cbDivs[0]) . "\n";

