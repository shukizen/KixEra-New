<?php
/**
 * Quick Gemini API Test
 * Test koneksi langsung ke Gemini API
 */

// API Configuration
$api_key = 'AIzaSyCfy861YO8gAMQRTUBk1-vFLAmHecHuVwY';
$api_url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';

// Simple test prompt
$prompt = "Halo, ini adalah test. Balas dengan 'OK' jika kamu menerima pesan ini.";

// Build request
$request_body = [
    'contents' => [
        [
            'parts' => [
                ['text' => $prompt]
            ]
        ]
    ],
    'generationConfig' => [
        'temperature' => 0.7,
        'maxOutputTokens' => 100
    ]
];

// Make request
$ch = curl_init($api_url . '?key=' . $api_key);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode($request_body),
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYPEER => true
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

// Display results
echo "<h1>Gemini API Direct Test</h1>";
echo "<hr>";

echo "<h2>Request Info:</h2>";
echo "<p><strong>API URL:</strong> " . htmlspecialchars($api_url) . "</p>";
echo "<p><strong>API Key:</strong> " . substr($api_key, 0, 10) . "..." . substr($api_key, -5) . "</p>";

echo "<h2>Response:</h2>";
echo "<p><strong>HTTP Code:</strong> " . $http_code . "</p>";

if ($curl_error) {
    echo "<p style='color: red;'><strong>cURL Error:</strong> " . htmlspecialchars($curl_error) . "</p>";
}

echo "<h3>Raw Response:</h3>";
echo "<pre style='background: #f5f5f5; padding: 15px; border-radius: 5px; overflow-x: auto;'>";
echo htmlspecialchars($response);
echo "</pre>";

if ($http_code === 200) {
    $decoded = json_decode($response, true);
    if ($decoded) {
        echo "<h3>Parsed Response:</h3>";
        echo "<pre style='background: #e8f5e9; padding: 15px; border-radius: 5px;'>";
        print_r($decoded);
        echo "</pre>";
        
        if (isset($decoded['candidates'][0]['content']['parts'][0]['text'])) {
            echo "<h3 style='color: green;'>✓ Success! AI Response:</h3>";
            echo "<p style='background: #c8e6c9; padding: 15px; border-radius: 5px;'>";
            echo htmlspecialchars($decoded['candidates'][0]['content']['parts'][0]['text']);
            echo "</p>";
        }
    }
} else {
    echo "<h3 style='color: red;'>✗ API Error</h3>";
    $error_data = json_decode($response, true);
    if ($error_data) {
        echo "<pre style='background: #ffebee; padding: 15px; border-radius: 5px;'>";
        print_r($error_data);
        echo "</pre>";
    }
}
