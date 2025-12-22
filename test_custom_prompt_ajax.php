<?php
/**
 * Test Custom Prompt Endpoint
 * Simulasi request AJAX untuk test custom prompt
 */

// Simulate AJAX request
$_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

// Test data
$test_prompt = "Bagaimana cara meningkatkan customer retention di bulan depan?";

echo "<h1>Test Custom Prompt Endpoint</h1>";
echo "<style>body{font-family:monospace;padding:20px;background:#f5f5f5;}</style>";

echo "<h2>Test 1: Simulate JSON Body</h2>";

// Create JSON body
$json_body = json_encode(['custom_prompt' => $test_prompt]);
echo "<strong>JSON Body:</strong><br>";
echo "<pre>" . htmlspecialchars($json_body) . "</pre>";

// Simulate reading JSON
$decoded = json_decode($json_body, true);
echo "<strong>Decoded:</strong><br>";
echo "<pre>";
print_r($decoded);
echo "</pre>";

echo "<strong>Custom Prompt Value:</strong><br>";
$custom_prompt = isset($decoded['custom_prompt']) ? trim($decoded['custom_prompt']) : '';
echo htmlspecialchars($custom_prompt) . "<br>";
echo "Empty check: " . (empty($custom_prompt) ? "EMPTY (akan pakai AUTO)" : "NOT EMPTY (akan pakai CUSTOM)") . "<br>";

echo "<hr>";
echo "<h2>Test 2: Direct AJAX Call</h2>";
echo "<button onclick='testAjax()'>Test AJAX Call</button>";
echo "<div id='result' style='margin-top:20px;padding:15px;background:white;border:1px solid #ddd;'></div>";

?>
<script>
async function testAjax() {
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = '<p>Loading...</p>';
    
    try {
        const response = await fetch('<?= base_url("pemilik/rekomendasi/generate") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                custom_prompt: '<?= addslashes($test_prompt) ?>'
            })
        });
        
        const data = await response.json();
        
        resultDiv.innerHTML = '<h3>Response:</h3><pre>' + JSON.stringify(data, null, 2) + '</pre>';
        
    } catch (error) {
        resultDiv.innerHTML = '<p style="color:red">Error: ' + error.message + '</p>';
    }
}
</script>
