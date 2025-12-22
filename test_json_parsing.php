<?php
/**
 * Test Gemini JSON Response Parsing
 * Simulate different response formats to test parsing
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Test JSON Response Parsing</h1>";
echo "<style>body{font-family:monospace;padding:20px;background:#f5f5f5;}</style>";

// Test cases
$test_cases = [
    'Valid JSON' => '{"recommendation":"Test recommendation","insights":["A","B","C"],"impact":{"revenue":10,"retention":15,"efficiency":12}}',
    
    'JSON with markdown' => '```json
{"recommendation":"Test","insights":["A","B","C"],"impact":{"revenue":10,"retention":15,"efficiency":12}}
```',
    
    'JSON with control chars' => '{"recommendation":"Test\x00\x01\x02","insights":["A","B","C"],"impact":{"revenue":10,"retention":15,"efficiency":12}}',
    
    'JSON with newlines' => '{"recommendation":"Test\nwith\nnewlines","insights":["A","B","C"],"impact":{"revenue":10,"retention":15,"efficiency":12}}',
];

foreach ($test_cases as $name => $json) {
    echo "<div style='margin:20px 0;padding:15px;background:white;border:1px solid #ddd;'>";
    echo "<h3>$name</h3>";
    
    // Show original
    echo "<strong>Original:</strong><br>";
    echo "<pre>" . htmlspecialchars($json) . "</pre>";
    
    // Clean like Gemini library does
    $cleaned = preg_replace('/```json\s*/', '', $json);
    $cleaned = preg_replace('/```\s*$/', '', $cleaned);
    $cleaned = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $cleaned);
    $cleaned = trim($cleaned);
    
    echo "<strong>After Cleaning:</strong><br>";
    echo "<pre>" . htmlspecialchars($cleaned) . "</pre>";
    
    // Try to parse
    $parsed = json_decode($cleaned, true);
    $error = json_last_error_msg();
    
    if ($parsed) {
        echo "<strong style='color:green'>✅ Parse SUCCESS</strong><br>";
        echo "<pre>" . print_r($parsed, true) . "</pre>";
    } else {
        echo "<strong style='color:red'>❌ Parse FAILED: $error</strong><br>";
    }
    
    echo "</div>";
}
