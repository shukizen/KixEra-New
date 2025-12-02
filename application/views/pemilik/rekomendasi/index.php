<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KixEra - AI Recommendation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-emerald {
            background: linear-gradient(to right, #10b981, #34d399);
        }
        
        .gradient-red {
            background: linear-gradient(to right, rgba(185, 28, 28, 0.7), rgba(185, 28, 28, 0.7));
        }
        
        @keyframes pulse-dot {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }
        
        .loading-dot {
            animation: pulse-dot 1.4s ease-in-out infinite;
        }
        
        .loading-dot:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .loading-dot:nth-child(3) {
            animation-delay: 0.4s;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        
        
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">AI Recommendation</h1>
                        <p class="text-sm text-gray-500 mt-1">Dapatkan insight dan rekomendasi berbasis AI untuk bisnis Anda</p>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <!-- Notification Bell -->
                        <div class="relative">
                            <i class="fas fa-bell text-gray-600 text-xl"></i>
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </div>
                        
                        <!-- User Profile -->
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-800">
                                    <?php echo $this->session->userdata('nama') ? $this->session->userdata('nama') : 'Syafrudin'; ?>
                                </div>
                                <div class="text-xs text-gray-500">Owner</div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- AI Recommendation Content -->
            <div class="p-6">
                
                <!-- Action Bar -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 gradient-emerald rounded-xl flex items-center justify-center">
                            <i class="fas fa-robot text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">KixEra AI Assistant</h2>
                            <p class="text-sm text-gray-500">Powered by ChatGPT</p>
                        </div>
                    </div>
                    
                    <button id="generateBtn" onclick="generateRecommendation()" class="gradient-emerald text-white px-6 py-3 rounded-xl hover:opacity-90 transition flex items-center gap-2 font-medium shadow-lg">
                        <i class="fas fa-magic"></i>
                        Generate New Recommendation
                    </button>
                </div>
                
                <!-- Loading State -->
                <div id="loadingState" class="hidden bg-white rounded-2xl shadow-lg border border-emerald-100 p-8 mb-6">
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-16 h-16 gradient-emerald rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-brain text-white text-2xl animate-pulse"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">AI sedang menganalisis data bisnis Anda...</h3>
                        <p class="text-sm text-gray-500 mb-4">Mohon tunggu sebentar</p>
                        <div class="flex gap-2">
                            <div class="w-3 h-3 bg-emerald-500 rounded-full loading-dot"></div>
                            <div class="w-3 h-3 bg-emerald-500 rounded-full loading-dot"></div>
                            <div class="w-3 h-3 bg-emerald-500 rounded-full loading-dot"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Latest Recommendation Card -->
                <div id="recommendationCard" class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-lightbulb text-emerald-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Latest Recommendation</h3>
                                <p class="text-xs text-gray-500" id="recommendationDate">-</p>
                            </div>
                        </div>
                        <span id="recommendationBadge" class="bg-emerald-100 text-emerald-700 px-4 py-1 rounded-full text-sm font-medium">
                            New
                        </span>
                    </div>
                    
                    <!-- Recommendation Content -->
                    <div id="recommendationContent" class="bg-emerald-50 rounded-xl p-6 mb-4">
                        <div class="text-center text-gray-500 py-8">
                            <i class="fas fa-robot text-5xl text-emerald-300 mb-4"></i>
                            <p class="text-lg font-medium mb-2">Belum ada rekomendasi</p>
                            <p class="text-sm">Klik tombol "Generate New Recommendation" untuk mendapatkan insight AI</p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div id="actionButtons" class="hidden grid grid-cols-1 md:grid-cols-3 gap-3">
                        <button onclick="implementRecommendation()" class="gradient-emerald text-white py-3 rounded-xl hover:opacity-90 transition flex items-center justify-center gap-2 font-medium">
                            <i class="fas fa-check-circle"></i>
                            Implement
                        </button>
                        <button onclick="saveRecommendation()" class="border-2 border-emerald-500 text-emerald-600 py-3 rounded-xl hover:bg-emerald-50 transition flex items-center justify-center gap-2 font-medium">
                            <i class="fas fa-bookmark"></i>
                            Save for Later
                        </button>
                        <button onclick="shareRecommendation()" class="border-2 border-gray-300 text-gray-700 py-3 rounded-xl hover:bg-gray-50 transition flex items-center justify-center gap-2 font-medium">
                            <i class="fas fa-share-alt"></i>
                            Share
                        </button>
                    </div>
                </div>
                
                <!-- Analysis & Insights -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Key Insights -->
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-chart-line text-emerald-500"></i>
                            Key Insights
                        </h3>
                        <div id="keyInsights" class="space-y-3">
                            <!-- Insights will be populated here -->
                            <div class="text-center text-gray-400 py-8">
                                <i class="fas fa-chart-bar text-4xl mb-3"></i>
                                <p>Generate recommendation untuk melihat insights</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Impact Prediction -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-bullseye text-emerald-500"></i>
                            Predicted Impact
                        </h3>
                        <div id="impactChart" class="h-64 flex items-center justify-center">
                            <canvas id="impactCanvas"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Recommendation History -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-history text-emerald-500"></i>
                            Recommendation History
                        </h3>
                        <button class="text-emerald-600 text-sm font-medium hover:text-emerald-700 transition">
                            View All
                        </button>
                    </div>
                    
                    <div id="historyList" class="space-y-4">
                        <!-- History items will be populated here -->
                        <div class="text-center text-gray-400 py-8">
                            <i class="fas fa-folder-open text-4xl mb-3"></i>
                            <p>Belum ada riwayat rekomendasi</p>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Include Footer disini -->
            <?php include 'footer.php'; ?>
            
        </main>
    </div>
    
    <script>
        // Simulated business data - replace with actual data from your backend
        const businessData = {
            totalOrders: 127,
            monthlyRevenue: 45000000,
            activeCustomers: 1842,
            pendingPickups: 23,
            topServices: ['Deep Cleaning', 'Whitening', 'Repair'],
            branches: ['Seturan', 'Condongcatur', 'Gejayan']
        };
        
        let currentRecommendation = null;
        let impactChartInstance = null;
        
        // Function to call ChatGPT API
        async function generateRecommendation() {
            const generateBtn = document.getElementById('generateBtn');
            const loadingState = document.getElementById('loadingState');
            const recommendationCard = document.getElementById('recommendationCard');
            
            // Show loading state
            generateBtn.disabled = true;
            generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating...';
            loadingState.classList.remove('hidden');
            
            try {
                // Prepare prompt for ChatGPT
                const prompt = `Sebagai AI business consultant untuk bisnis laundry sepatu "KixEra", analisis data berikut dan berikan rekomendasi strategis:

Data Bisnis:
- Total pesanan hari ini: ${businessData.totalOrders}
- Pendapatan bulanan: Rp ${businessData.monthlyRevenue.toLocaleString('id-ID')}
- Pelanggan aktif: ${businessData.activeCustomers}
- Pending pickups: ${businessData.pendingPickups}
- Layanan terpopuler: ${businessData.topServices.join(', ')}
- Cabang: ${businessData.branches.join(', ')}

Berikan:
1. Rekomendasi strategis (2-3 paragraf)
2. 3 Key insights dengan format bullet point
3. Prediksi dampak dalam persentase (revenue increase, customer retention, efficiency)

Format response dalam JSON:
{
  "recommendation": "text...",
  "insights": ["insight 1", "insight 2", "insight 3"],
  "impact": {
    "revenue": 15,
    "retention": 23,
    "efficiency": 18
  }
}`;
                
                // Call ChatGPT API
                const response = await fetch('https://api.openai.com/v1/chat/completions', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer YOUR_OPENAI_API_KEY_HERE' // Replace with your API key
                    },
                    body: JSON.stringify({
                        model: 'gpt-3.5-turbo',
                        messages: [
                            {
                                role: 'system',
                                content: 'You are a business intelligence AI assistant specializing in laundry and shoe cleaning business optimization.'
                            },
                            {
                                role: 'user',
                                content: prompt
                            }
                        ],
                        temperature: 0.7,
                        max_tokens: 1000
                    })
                });
                
                if (!response.ok) {
                    throw new Error('API request failed');
                }
                
                const data = await response.json();
                const aiResponse = JSON.parse(data.choices[0].message.content);
                
                // Display recommendation
                displayRecommendation(aiResponse);
                
            } catch (error) {
                console.error('Error:', error);
                
                // Fallback: Use demo recommendation if API fails
                const demoRecommendation = {
                    recommendation: `Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan. 

Pertama, dengan total 127 pesanan hari ini dan 23 pending pickups, terdapat indikasi bahwa kapasitas operasional sedang dalam tekanan. Disarankan untuk mengimplementasikan sistem penjadwalan otomatis dan menambah 1-2 kurir di jam sibuk (10:00-14:00) untuk mengurangi pending pickups hingga maksimal 10 per hari.

Kedua, dengan pendapatan bulanan Rp 45 juta dan 1,842 pelanggan aktif, ada peluang untuk meningkatkan customer lifetime value melalui program loyalitas bertingkat. Berdasarkan pola pembelian, pelanggan yang menggunakan layanan Deep Cleaning cenderung repeat order 3x lebih sering. Rekomendasi: tawarkan paket bundling "Premium Care Package" dengan diskon 15% untuk komitmen 3 bulan, yang berpotensi meningkatkan retention hingga 23% dan revenue 15%.`,
                    insights: [
                        "Pending pickups 23 unit mengindikasikan bottleneck di proses logistik - optimasi scheduling dapat meningkatkan efisiensi 18%",
                        "Deep Cleaning service memiliki repeat rate tertinggi - fokus marketing ke segment ini dapat boost revenue 15%",
                        "Customer aktif 1,842 dengan revenue Rp 45jt = Average Order Value Rp 24,400 - ada peluang upselling ke premium services"
                    ],
                    impact: {
                        revenue: 15,
                        retention: 23,
                        efficiency: 18
                    }
                };
                
                displayRecommendation(demoRecommendation);
            }
            
            // Hide loading state
            loadingState.classList.add('hidden');
            generateBtn.disabled = false;
            generateBtn.innerHTML = '<i class="fas fa-magic mr-2"></i>Generate New Recommendation';
        }
        
        function displayRecommendation(data) {
            currentRecommendation = data;
            
            // Update date
            const now = new Date();
            document.getElementById('recommendationDate').textContent = 
                now.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
            
            // Update content
            const content = document.getElementById('recommendationContent');
            content.innerHTML = `
                <h4 class="text-sm font-bold text-gray-700 mb-3">Recommendation:</h4>
                <div class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">${data.recommendation}</div>
            `;
            
            // Show action buttons
            document.getElementById('actionButtons').classList.remove('hidden');
            
            // Display insights
            const insightsContainer = document.getElementById('keyInsights');
            insightsContainer.innerHTML = data.insights.map((insight, index) => `
                <div class="flex items-start gap-3 p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                    <div class="w-8 h-8 gradient-emerald rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">${index + 1}</span>
                    </div>
                    <p class="text-sm text-gray-700 leading-relaxed">${insight}</p>
                </div>
            `).join('');
            
            // Update impact chart
            updateImpactChart(data.impact);
            
            // Add to history
            addToHistory(data);
        }
        
        function updateImpactChart(impact) {
            const ctx = document.getElementById('impactCanvas').getContext('2d');
            
            if (impactChartInstance) {
                impactChartInstance.destroy();
            }
            
            impactChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Revenue Growth', 'Customer Retention', 'Operational Efficiency'],
                    datasets: [{
                        label: 'Predicted Impact (%)',
                        data: [impact.revenue, impact.retention, impact.efficiency],
                        backgroundColor: ['#10b981', '#34d399', '#6ee7b7'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 30,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            },
                            grid: { color: '#f3f4f6' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });
        }
        
        function addToHistory(data) {
            const historyList = document.getElementById('historyList');
            const now = new Date();
            const timeString = now.toLocaleString('id-ID', { 
                day: 'numeric', 
                month: 'short', 
                year: 'numeric', 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            
            const preview = data.recommendation.substring(0, 150) + '...';
            
            const historyItem = `
                <div class="border border-gray-200 rounded-xl p-4 hover:border-emerald-300 hover:shadow-md transition cursor-pointer">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-file-alt text-emerald-500"></i>
                            <span class="text-sm font-semibold text-gray-800">Business Recommendation</span>
                        </div>
                        <span class="text-xs text-gray-500">${timeString}</span>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">${preview}</p>
                    <div class="flex gap-2 mt-3">
                        <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs">+${data.impact.revenue}% Revenue</span>
                        <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs">+${data.impact.retention}% Retention</span>
                    </div>
                </div>
            `;
            
            if (historyList.innerHTML.includes('Belum ada riwayat')) {
                historyList.innerHTML = historyItem;
            } else {
                historyList.insertAdjacentHTML('afterbegin', historyItem);
            }
        }
        
        function implementRecommendation() {
            alert('Fitur implement akan mengarahkan ke halaman action plan atau workflow automation');
        }
        
        function saveRecommendation() {
            alert('Recommendation saved successfully!');
        }
        
        function shareRecommendation() {
            alert('Share recommendation via email atau export PDF');
        }
    </script>
</body>
</html>