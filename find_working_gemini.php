<?php
/**
 * Auto-Discover Gemini Models
 * 
 * Script to try multiple model names until one works.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuration
$api_key = 'AIzaSyCfy861YO8gAMQRTUBk1-vFLAmHecHuVwY'; // Hardcoded from user config
$base_url = 'https://generativelanguage.googleapis.com/v1beta/models/';

// List of models to try
$candidates = [
    'gemini-1.5-flash',
    'gemini-1.5-flash-latest',
    'gemini-1.5-pro',
    'gemini-1.5-pro-latest',
    'gemini-1.0-pro',
    'gemini-pro',
    'gemini-1.0-pro-vision-latest' // Just in case
];

echo "<h1>🔍 Gemini Model Auto-Discovery</h1>";

$working_model = null;

foreach ($candidates as $model) {
    echo "<div style='margin-bottom: 10px; padding: 10px; border: 1px solid #ccc;'>";
    echo "<strong>Testing:</strong> $model ... ";
    
    $url = $base_url . $model . ':generateContent?key=' . $api_key;
    
    $data = [
        'contents' => [
            ['parts' => [['text' => 'Hello']]]
        ]
    ];
    
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => true
    ]);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code === 200) {
        echo "<span style='color: green; font-weight: bold;'>✅ WORKS! (HTTP 200)</span>";
        $working_model = $model;
        
        // Show response snippet
        $json = json_decode($response, true);
        $text = $json['candidates'][0]['content']['parts'][0]['text'] ?? 'No text';
        echo "<br>Response: " . substr(htmlspecialchars($text), 0, 50) . "...";
        
        echo "</div>";
        break; // Stop after finding first working model
    } else {
        echo "<span style='color: red;'>❌ Failed (HTTP $http_code)</span>";
        echo "</div>";
    }
}

echo "<hr>";

if ($working_model) {
    echo "<div style='background: #d4edda; padding: 20px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
    echo "<h2>🎉 Working Model Found: <span style='color: green'>$working_model</span></h2>";
    echo "<p>Please update your <code>application/config/gemini.php</code>:</p>";
    echo "<pre style='background: #fff; padding: 10px;'>";
    echo "\$config['gemini_api_url'] = 'https://generativelanguage.googleapis.com/v1beta/models/$working_model:generateContent';\n";
    echo "\$config['gemini_model'] = '$working_model';";
    echo "</pre>";
    echo "</div>";
} else {
    echo "<div style='background: #f8d7da; padding: 20px; border: 1px solid #f5c6cb; border-radius: 5px;'>";
    echo "<h2>❌ No working models found.</h2>";
    echo "<p>Possible issues:</p>";
    echo "<ul>";
    echo "<li>API Key might be restricted or invalid (Status Free Tier?)</li>";
    echo "<li>Region restrictions</li>";
    echo "<li>API Quota exceeded</li>";
    echo "</ul>";
    echo "</div>";
}
