<?php 
// Cek cURL dan konfigurasi PHP
echo "<h2>PHP Configuration Check</h2>";

echo "<p><strong>Loaded php.ini:</strong> " . php_ini_loaded_file() . "</p>";
echo "<p><strong>Extension dir:</strong> " . ini_get('extension_dir') . "</p>";

echo "<h3>cURL Status:</h3>";
if (function_exists('curl_init')) {
    echo "<p style='color:green'> cURL is ENABLED</p>";
    echo "<p>cURL Version: " . curl_version()['version'] . "</p>";
} else {
    echo "<p style='color:red'> cURL is DISABLED</p>";
    
    // Check if dll exists
    $ext_dir = ini_get('extension_dir');
    $curl_dll = $ext_dir . '/php_curl.dll';
    echo "<p>Looking for: " . $curl_dll . "</p>";
    echo "<p>File exists: " . (file_exists($curl_dll) ? 'YES' : 'NO') . "</p>";
}

echo "<h3>Loaded Extensions:</h3>";
echo "<pre>" . implode("\n", get_loaded_extensions()) . "</pre>";

phpinfo(INFO_MODULES);
