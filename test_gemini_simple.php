<!DOCTYPE html>
<html>
<head>
    <title>Gemini API Simple Test</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: green; background: #e8f5e9; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .error { color: red; background: #ffebee; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .info { background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 10px 0; }
        pre { background: #f5f5f5; padding: 10px; border-radius: 5px; overflow-x: auto; }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        button:hover { background: #45a049; }
        button:disabled { background: #ccc; cursor: not-allowed; }
    </style>
</head>
<body>
    <h1>🧪 Gemini API Simple Test</h1>
    
    <div class="info">
        <strong>Test ini akan:</strong>
        <ol>
            <li>Cek apakah API key valid</li>
            <li>Cek apakah model name sudah benar</li>
            <li>Test koneksi ke Gemini API</li>
            <li>Tampilkan response dari AI</li>
        </ol>
    </div>

    <button onclick="testAPI()" id="testBtn">🚀 Test Gemini API</button>
    
    <div id="result"></div>

    <script>
        async function testAPI() {
            const btn = document.getElementById('testBtn');
            const resultDiv = document.getElementById('result');
            
            btn.disabled = true;
            btn.textContent = '⏳ Testing...';
            resultDiv.innerHTML = '<div class="info">Menghubungi Gemini API...</div>';
            
            try {
                const response = await fetch('<?= base_url("pemilik/rekomendasi/generate") ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                const text = await response.text();
                console.log('Raw response:', text);
                
                let result;
                try {
                    result = JSON.parse(text);
                } catch (e) {
                    throw new Error('Invalid JSON response: ' + text.substring(0, 200));
                }
                
                if (result.success) {
                    resultDiv.innerHTML = `
                        <div class="success">
                            <h3>✅ SUCCESS! Gemini API Working!</h3>
                            <p><strong>Recommendation:</strong></p>
                            <p>${result.data.recommendation.substring(0, 300)}...</p>
                            <p><strong>Insights:</strong></p>
                            <ul>
                                ${result.data.insights.map(i => '<li>' + i + '</li>').join('')}
                            </ul>
                            <p><strong>Impact Prediction:</strong></p>
                            <ul>
                                <li>Revenue: +${result.data.impact.revenue}%</li>
                                <li>Retention: +${result.data.impact.retention}%</li>
                                <li>Efficiency: +${result.data.impact.efficiency}%</li>
                            </ul>
                        </div>
                    `;
                } else {
                    throw new Error(result.message || 'Unknown error');
                }
                
            } catch (error) {
                console.error('Error:', error);
                resultDiv.innerHTML = `
                    <div class="error">
                        <h3>❌ Error</h3>
                        <p><strong>Message:</strong> ${error.message}</p>
                        <p><strong>Kemungkinan penyebab:</strong></p>
                        <ul>
                            <li>File <code>gemini.php</code> belum diupdate ke model <code>gemini-1.5-flash</code></li>
                            <li>API key tidak valid atau expired</li>
                            <li>Koneksi internet bermasalah</li>
                            <li>Tabel database belum dibuat</li>
                        </ul>
                        <p><strong>Solusi:</strong></p>
                        <ol>
                            <li>Pastikan file <code>application/config/gemini.php</code> line 18 menggunakan <code>gemini-1.5-flash</code></li>
                            <li>Refresh halaman (Ctrl+F5)</li>
                            <li>Cek console untuk detail error</li>
                        </ol>
                    </div>
                `;
            } finally {
                btn.disabled = false;
                btn.textContent = '🚀 Test Gemini API';
            }
        }
    </script>
</body>
</html>
