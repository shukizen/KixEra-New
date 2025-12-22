<?php
/**
 * Check Rekomendasi AI Table Structure
 */

// Connect to database
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'kixera_db';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h1>📊 Table Structure Check</h1>";
echo "<style>body{font-family:monospace;margin:20px;}table{border-collapse:collapse;width:100%;}th,td{border:1px solid #ddd;padding:8px;}th{background:#4CAF50;color:white;}</style>";

// Check if table exists
$result = $conn->query("SHOW TABLES LIKE 'rekomendasi_ai'");
if ($result->num_rows == 0) {
    echo "<p style='color:red;'>❌ Table 'rekomendasi_ai' DOES NOT EXIST!</p>";
    echo "<p>Please run: <code>database/create_rekomendasi_ai_table.sql</code></p>";
    exit;
}

echo "<p style='color:green;'>✅ Table 'rekomendasi_ai' exists</p>";

// Show structure
echo "<h2>Current Structure:</h2>";
$result = $conn->query("DESCRIBE rekomendasi_ai");

echo "<table>";
echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";

while ($row = $result->fetch_assoc()) {
    // Highlight if column name doesn't match expected
    $style = '';
    if ($row['Field'] == 'rekomendasi_text') {
        $style = 'background:#ffebee;'; // Red if Indonesian name
    } elseif ($row['Field'] == 'recommendation_text') {
        $style = 'background:#e8f5e9;'; // Green if English name
    }
    
    echo "<tr style='$style'>";
    echo "<td><strong>{$row['Field']}</strong></td>";
    echo "<td>{$row['Type']}</td>";
    echo "<td>{$row['Null']}</td>";
    echo "<td>{$row['Key']}</td>";
    echo "<td>{$row['Default']}</td>";
    echo "<td>{$row['Extra']}</td>";
    echo "</tr>";
}

echo "</table>";

// Check which column exists
$has_recommendation = $conn->query("SHOW COLUMNS FROM rekomendasi_ai LIKE 'recommendation_text'")->num_rows > 0;
$has_rekomendasi = $conn->query("SHOW COLUMNS FROM rekomendasi_ai LIKE 'rekomendasi_text'")->num_rows > 0;

echo "<hr>";
echo "<h2>Diagnosis:</h2>";

if ($has_recommendation) {
    echo "<p style='color:green;'>✅ Column 'recommendation_text' exists - Model is CORRECT</p>";
} elseif ($has_rekomendasi) {
    echo "<p style='color:red;'>❌ Column is 'rekomendasi_text' (Indonesian) - Need to rename or update model</p>";
    echo "<h3>Quick Fix SQL:</h3>";
    echo "<pre>ALTER TABLE rekomendasi_ai CHANGE rekomendasi_text recommendation_text TEXT NOT NULL COMMENT 'Teks rekomendasi lengkap dari AI';</pre>";
} else {
    echo "<p style='color:red;'>❌ Neither column exists! Table structure is wrong!</p>";
}

$conn->close();
