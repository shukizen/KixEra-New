<?php
/**
 * List Gemini Models
 * 
 * Script to list available models from Gemini API
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// API Key (Hardcoded for testing - using the one from config)
$api_key = 'AIzaSyCfy861YO8gAMQRTUBk1-vFLAmHecHuVwY';

// Endpoint to list models
$url = 'https://generativelanguage.googleapis.com/v1beta/models?key=' . $api_key;

echo "<h1>📋 Gemini Model List</h1>";
echo "<p>Checking available models for API Key: " . substr($api_key, 0, 10) . "...</p>";

// Initialize cURL
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYPEER => true
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

if ($curl_error) {
    echo "<h3 style='color: red'>cURL Error: $curl_error</h3>";
    exit;
}

echo "<h3>HTTP Status: $http_code</h3>";

$data = json_decode($response, true);

if ($http_code === 200 && isset($data['models'])) {
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background: #eee;'><th>Model Name</th><th>Version</th><th>Supported Methods</th><th>Description</th></tr>";
    
    foreach ($data['models'] as $model) {
        // Highlight models that support generateContent
        $supports_generation = in_array('generateContent', $model['supportedGenerationMethods'] ?? []);
        $bg_style = $supports_generation ? 'background: #e8f5e9;' : '';
        $name_style = $supports_generation ? 'font-weight: bold; color: green;' : '';
        
        echo "<tr style='$bg_style'>";
        echo "<td style='$name_style'>{$model['name']}</td>";
        echo "<td>{$model['version']}</td>";
        echo "<td>" . implode(', ', $model['supportedGenerationMethods'] ?? []) . "</td>";
        echo "<td>{$model['description']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h2>Recommended Configuration:</h2>";
    echo "<p>Copy one of the green model names above (e.g. <code>models/gemini-1.5-flash</code>) into your config file.</p>";
    
} else {
    echo "<h3 style='color: red'>Error Response:</h3>";
    echo "<pre>" . htmlspecialchars($response) . "</pre>";
}
