<?php
/**
 * Debug Custom Prompt
 * Script untuk cek apakah custom_prompt terkirim ke backend
 */

// Simulate POST request
$_POST['custom_prompt'] = 'Test custom prompt dari debug script';

echo "<h1>Debug Custom Prompt</h1>";
echo "<style>body{font-family:monospace;padding:20px;}</style>";

echo "<h2>1. POST Data:</h2>";
echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<h2>2. Input Post Test:</h2>";
$custom_prompt = isset($_POST['custom_prompt']) ? $_POST['custom_prompt'] : null;
echo "Custom Prompt: " . ($custom_prompt ? htmlspecialchars($custom_prompt) : "NULL/EMPTY") . "<br>";

echo "<h2>3. JSON Body Test:</h2>";
$json_input = '{"custom_prompt":"Test dari JSON body"}';
$_POST = json_decode($json_input, true);
echo "Decoded JSON:<br>";
echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<h2>4. Empty Check:</h2>";
$test_empty = '';
$test_filled = 'Ada isinya';

echo "empty(''): " . (empty($test_empty) ? "TRUE" : "FALSE") . "<br>";
echo "empty('Ada isinya'): " . (empty($test_filled) ? "TRUE" : "FALSE") . "<br>";

echo "<hr>";
echo "<h2>Kesimpulan:</h2>";
echo "<p>Jika custom_prompt terdeteksi di POST data, berarti frontend sudah kirim dengan benar.</p>";
echo "<p>Jika tidak terdeteksi, berarti ada masalah di pengiriman AJAX.</p>";
