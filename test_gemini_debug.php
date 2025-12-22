<?php
/**
 * Direct Gemini API Test - Detailed Debug
 * Test langsung ke Gemini API dengan error logging lengkap
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// API Configuration
$api_key = 'AIzaSyCfy861YO8gAMQRTUBk1-vFLAmHecHuVwY';
// Using gemini-2.0-flash as consistent with config
$api_url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

echo "<h1>🔍 Detailed Gemini API Debug Test</h1>";
echo "<p>Testing Endpoint: <code>$api_url</code></p>";

echo "<style>
    body { font-family: monospace; max-width: 1200px; margin: 20px auto; padding: 20px; background: #f5f5f5; }
    .success { background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; margin: 10px 0; border-radius: 5px; }
    .error { background: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; margin: 10px 0; border-radius: 5px; }
    .info { background: #d1ecf1; border: 1px solid #bee5eb; padding: 15px; margin: 10px 0; border-radius: 5px; }
    pre { background: #fff; padding: 15px; border: 1px solid #ddd; border-radius: 5px; overflow-x: auto; white-space: pre-wrap; }
    h2 { color: #333; border-bottom: 2px solid #007bff; padding-bottom: 5px; }
</style>";

// Test 1: Simple prompt
echo "<h2>Test 1: Simple Test Prompt</h2>";
$simple_prompt = "Halo! Balas dengan 'OK' jika kamu menerima pesan ini.";

$request_body = [
    'contents' => [
        [
            'parts' => [
                ['text' => $simple_prompt]
            ]
        ]
    ],
    'generationConfig' => [
        'temperature' => 0.7,
        'maxOutputTokens' => 100
    ]
];

echo "<div class='info'>";
echo "<strong>Request URL:</strong><br>";
echo htmlspecialchars($api_url . '?key=' . substr($api_key, 0, 10) . '...' . substr($api_key, -5));
echo "</div>";

// Make request
$ch = curl_init($api_url . '?key=' . $api_key);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode($request_body),
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_VERBOSE => true
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
$curl_info = curl_getinfo($ch);
curl_close($ch);

echo "<div class='info'>";
echo "<strong>HTTP Status Code:</strong> " . $http_code . "<br>";
echo "<strong>Response Time:</strong> " . round($curl_info['total_time'], 2) . " seconds<br>";
echo "</div>";

if ($curl_error) {
    echo "<div class='error'>";
    echo "<strong>cURL Error:</strong><br>";
    echo htmlspecialchars($curl_error);
    echo "</div>";
}

if ($http_code === 200) {
    $decoded = json_decode($response, true);
    if ($decoded) {
        echo "<div class='success'>";
        echo "<h3>✅ SUCCESS! API Connected!</h3>";
        
        if (isset($decoded['candidates'][0]['content']['parts'][0]['text'])) {
            echo "<h3>AI Response:</h3>";
            echo "<div style='background: #e8f5e9; padding: 20px; border-radius: 5px; font-size: 16px;'>";
            echo nl2br(htmlspecialchars($decoded['candidates'][0]['content']['parts'][0]['text']));
            echo "</div>";
        }
        echo "</div>";
    }
} else {
    echo "<div class='error'>";
    echo "<h3>❌ API Error (HTTP $http_code)</h3>";
    echo "<pre>" . htmlspecialchars($response) . "</pre>";
    echo "</div>";
}
