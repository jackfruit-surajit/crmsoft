<?php
echo "=== TESTING PWA ASSETS VIA HTTP ===\n";

$urls = [
    'Manifest' => 'http://localhost/crmsoft/manifest.json',
    'Service Worker' => 'http://localhost/crmsoft/sw.js',
    'Offline Fallback' => 'http://localhost/crmsoft/offline.html',
    'PWA Install JS' => 'http://localhost/crmsoft/assets/js/pwa-install.js',
    'Icon 192' => 'http://localhost/crmsoft/assets/images/icons/icon-192x192.png',
    'Icon 512' => 'http://localhost/crmsoft/assets/images/icons/icon-512x512.png',
    'Maskable 512' => 'http://localhost/crmsoft/assets/images/icons/maskable-icon-512x512.png',
    'Admin Head' => 'http://localhost/crmsoft/admin/authentication',
];

foreach ($urls as $label => $url) {
    $ctx = stream_context_create(['http' => ['ignore_errors' => true]]);
    $content = @file_get_contents($url, false, $ctx);
    $status = isset($http_response_header[0]) ? $http_response_header[0] : 'UNKNOWN';
    echo "$label ($url) -> $status (Length: " . strlen($content) . " bytes)\n";
    if ($label === 'Manifest') {
        $json = json_decode($content, true);
        echo "   -> Valid JSON: " . ($json ? "YES (App: {$json['name']}, Icons: " . count($json['icons']) . ")" : "NO") . "\n";
    }
}

