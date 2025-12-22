<?php
/**
 * Gemini API Test Script
 * 
 * Script untuk test koneksi dan konfigurasi Gemini API
 * 
 * Cara menggunakan:
 * 1. Pastikan API key sudah dikonfigurasi di application/config/gemini.php
 * 2. Akses via browser: http://localhost/KixEra/test_gemini_api.php
 * 3. Atau jalankan via CLI: php test_gemini_api.php
 */

// Load CodeIgniter
define('BASEPATH', TRUE);
$system_path = 'system';
$application_folder = 'application';

// Bootstrap CodeIgniter
require_once BASEPATH.'../index.php';

// Get CI instance
$CI =& get_instance();

// Load Gemini library
$CI->load->library('gemini_library');

echo "<h1>Gemini API Test</h1>";
echo "<hr>";

// Test 1: Connection Test
echo "<h2>Test 1: Connection Test</h2>";
$result = $CI->gemini_library->test_connection();

if ($result['success']) {
    echo "<p style='color: green;'>✓ Connection successful!</p>";
    echo "<pre>" . print_r($result, true) . "</pre>";
} else {
    echo "<p style='color: red;'>✗ Connection failed!</p>";
    echo "<p>Error: " . $result['message'] . "</p>";
}

echo "<hr>";

// Test 2: Business Insights Generation
echo "<h2>Test 2: Business Insights Generation</h2>";

$test_business_data = [
    'total_orders_today' => 25,
    'total_orders_month' => 150,
    'monthly_revenue' => 35000000,
    'revenue_growth' => 12.5,
    'active_customers' => 450,
    'pending_pickups' => 8,
    'top_services' => ['Deep Cleaning', 'Whitening', 'Repair'],
    'branch_performance' => [
        ['label' => 'Seturan', 'value' => 15000000],
        ['label' => 'Condongcatur', 'value' => 12000000],
        ['label' => 'Gejayan', 'value' => 8000000]
    ],
    'avg_order_value' => 233333
];

echo "<p>Testing with sample business data...</p>";
echo "<pre>" . print_r($test_business_data, true) . "</pre>";

$insights = $CI->gemini_library->generate_business_insights($test_business_data);

if ($insights !== false) {
    echo "<p style='color: green;'>✓ Insights generated successfully!</p>";
    
    echo "<h3>Recommendation:</h3>";
    echo "<p>" . nl2br(htmlspecialchars($insights['recommendation'])) . "</p>";
    
    echo "<h3>Key Insights:</h3>";
    echo "<ol>";
    foreach ($insights['insights'] as $insight) {
        echo "<li>" . htmlspecialchars($insight) . "</li>";
    }
    echo "</ol>";
    
    echo "<h3>Impact Prediction:</h3>";
    echo "<ul>";
    echo "<li>Revenue Increase: " . $insights['impact']['revenue'] . "%</li>";
    echo "<li>Customer Retention: " . $insights['impact']['retention'] . "%</li>";
    echo "<li>Operational Efficiency: " . $insights['impact']['efficiency'] . "%</li>";
    echo "</ul>";
} else {
    echo "<p style='color: red;'>✗ Failed to generate insights!</p>";
    echo "<p>Check application/logs for error details.</p>";
}

echo "<hr>";
echo "<p><strong>Test completed!</strong></p>";
echo "<p>Check the results above to verify Gemini API integration.</p>";
