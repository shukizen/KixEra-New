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
                            <p class="text-sm text-gray-500">Powered by Google Gemini</p>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Mode Toggle & Custom Prompt Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Mode Analisis</h3>
                    </div>
                    <div class="flex gap-3 mb-4">
                        <button id="autoModeBtn" class="flex-1 py-3 px-4 rounded-xl font-medium transition-all duration-200 bg-emerald-500 text-white shadow-md">
                            <i class="fas fa-chart-line mr-2"></i>Auto Analysis
                        </button>
                        <button id="customModeBtn" class="flex-1 py-3 px-4 rounded-xl font-medium transition-all duration-200 bg-gray-100 text-gray-600 hover:bg-gray-200">
                            <i class="fas fa-comment-dots mr-2"></i>Custom Prompt
                        </button>
                    </div>
                    
                    <!-- Custom Prompt Section (Hidden by default) -->
                    <div id="customPromptSection" class="hidden mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanyakan apa saja tentang bisnis Anda:
                        </label>
                        <textarea 
                            id="customPromptInput" 
                            class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent resize-none" 
                            rows="4" 
                            maxlength="1000"
                            placeholder="Contoh: Bagaimana cara meningkatkan customer retention di bulan depan? Atau: Analisis peluang untuk membuka cabang baru berdasarkan data saat ini."
                        ></textarea>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>AI akan menjawab dengan konteks data bisnis Anda
                            </span>
                            <span id="charCount" class="text-xs text-gray-500">0/1000</span>
                        </div>
                    </div>
                    
                    <!-- Generate Button -->
                    <button id="generateBtn" onclick="generateRecommendation()" class="w-full gradient-emerald text-white py-4 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2 mt-6">
                        <i class="fas fa-magic"></i>
                        <span>Generate Recommendation</span>
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
            
        </main>
    </div>
    
    <script>
        // Real business data from PHP
        const businessData = <?php echo json_encode($business_data ?? []); ?>;
        
        let currentRecommendation = null;
        let impactChartInstance = null;
        let currentMode = 'auto'; // 'auto' or 'custom'
        
        // Mode Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Rekomendasi Script Loaded v' + Date.now());
            
            const autoModeBtn = document.getElementById('autoModeBtn');
            const customModeBtn = document.getElementById('customModeBtn');
            const customPromptSection = document.getElementById('customPromptSection');
            const customPromptInput = document.getElementById('customPromptInput');
            const charCount = document.getElementById('charCount');
            
            // Auto Mode Click
            if (autoModeBtn) {
                autoModeBtn.addEventListener('click', function() {
                    currentMode = 'auto';
                    autoModeBtn.classList.remove('bg-gray-100','text-gray-600');
                    autoModeBtn.classList.add('bg-emerald-500', 'text-white', 'shadow-md');
                    
                    if (customModeBtn) {
                        customModeBtn.classList.remove('bg-emerald-500', 'text-white', 'shadow-md');
                        customModeBtn.classList.add('bg-gray-100', 'text-gray-600');
                    }
                    if (customPromptSection) customPromptSection.classList.add('hidden');
                });
            }
            
            // Custom Mode Click
            if (customModeBtn) {
                customModeBtn.addEventListener('click', function() {
                    currentMode = 'custom';
                    customModeBtn.classList.remove('bg-gray-100', 'text-gray-600');
                    customModeBtn.classList.add('bg-emerald-500', 'text-white', 'shadow-md');
                    
                    if (autoModeBtn) {
                        autoModeBtn.classList.remove('bg-emerald-500', 'text-white', 'shadow-md');
                        autoModeBtn.classList.add('bg-gray-100', 'text-gray-600');
                    }
                    if (customPromptSection) customPromptSection.classList.remove('hidden');
                    if (customPromptInput) customPromptInput.focus();
                });
            }
            
            // Character Counter
            if (customPromptInput && charCount) {
                customPromptInput.addEventListener('input', function() {
                    const length = this.value.length;
                    charCount.textContent = length + '/1000';
                    
                    if (length > 900) {
                        charCount.classList.add('text-orange-500', 'font-semibold');
                    } else {
                        charCount.classList.remove('text-orange-500', 'font-semibold');
                    }
                });
            }
        });
        
        async function generateRecommendation() {
            const generateBtn = document.getElementById('generateBtn');
            const loadingState = document.getElementById('loadingState');
            const recommendationCard = document.getElementById('recommendationCard');
            
            // Null checks
            if (!generateBtn || !loadingState) {
                console.error('Required elements not found');
                alert('Error: Page elements not loaded properly. Please refresh the page.');
                return;
            }
            
            // Show loading state
            generateBtn.disabled = true;
            generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating...';
            loadingState.classList.remove('hidden');
            
            try {
                // Prepare request body
                const requestBody = {};
                
                // Debug logging
                console.log('Current Mode:', currentMode);
                
                // If custom mode, validate and add custom prompt
                if (currentMode === 'custom') {
                    const customPromptInput = document.getElementById('customPromptInput');
                    const customPrompt = customPromptInput ? customPromptInput.value.trim() : '';
                    
                    console.log('Custom Prompt Input Element:', customPromptInput);
                    console.log('Custom Prompt Value:', customPrompt);
                    
                    if (!customPrompt) {
                        alert('Mohon masukkan pertanyaan atau prompt Anda.');
                        generateBtn.disabled = false;
                        generateBtn.innerHTML = '<i class="fas fa-magic mr-2"></i>Generate New Recommendation';
                        loadingState.classList.add('hidden');
                        return;
                    }
                    
                    requestBody.custom_prompt = customPrompt;
                    console.log('Sending custom_prompt:', customPrompt);
                } else {
                    console.log('Using AUTO mode - no custom prompt');
                }
                
                console.log('Request Body:', requestBody);
                
                // Call backend API
                const response = await fetch('<?= base_url("pemilik/rekomendasi/generate") ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(requestBody)
                });
                
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('API Response Error:', errorText);
                    throw new Error('API request failed with status: ' + response.status);
                }
                
                const result = await response.json();
                console.log('API Response:', result);
                
                if (result.success) {
                    displayRecommendation(result.data);
                } else {
                    throw new Error(result.message || 'Failed to generate recommendation');
                }
                
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal generate rekomendasi: ' + error.message + '\n\nSilakan cek console untuk detail error atau hubungi administrator.');
            } finally {
                // Hide loading state safely
                const loadingState = document.getElementById('loadingState');
                if (loadingState) {
                    loadingState.classList.add('hidden');
                }
                
                const generateBtn = document.getElementById('generateBtn');
                if (generateBtn) {
                    generateBtn.disabled = false;
                    const btnText = document.getElementById('generateBtnText'); // Try to find text span if exists
                     if (btnText) {
                        btnText.textContent = 'Generate Recommendation';
                     } else {
                        generateBtn.innerHTML = '<i class="fas fa-magic mr-2"></i>Generate New Recommendation';
                     }
                }
            }
        }
        
        function displayRecommendation(data) {
            currentRecommendation = data;
            
            // Update date
            const dateEl = document.getElementById('recommendationDate');
            if (dateEl) {
                const now = new Date();
                dateEl.textContent = now.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
            }
            
            // Update content
            const content = document.getElementById('recommendationContent');
            if (content) {
                content.innerHTML = `
                    <h4 class="text-sm font-bold text-gray-700 mb-3">Recommendation:</h4>
                    <div class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">${data.recommendation}</div>
                `;
            }
            
            // Show action buttons safely
            const actionButtons = document.getElementById('actionButtons');
            if (actionButtons) {
                actionButtons.classList.remove('hidden');
            }
            
            // Display insights
            const insightsContainer = document.getElementById('keyInsights');
            if (insightsContainer && data.insights) {
                insightsContainer.innerHTML = data.insights.map((insight, index) => `
                    <div class="flex items-start gap-3 p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                        <div class="w-8 h-8 gradient-emerald rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">${index + 1}</span>
                        </div>
                        <p class="text-sm text-gray-700 leading-relaxed">${insight}</p>
                    </div>
                `).join('');
            }
            
            // Update impact chart
            if (data.impact) {
                updateImpactChart(data.impact);
            }
            
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
        
        async function saveRecommendation() {
            if (!currentRecommendation || !currentRecommendation.id_rekomendasi) {
                alert('No recommendation to save');
                return;
            }
            
            try {
                const response = await fetch('<?= base_url("pemilik/rekomendasi/save") ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: `id_rekomendasi=${currentRecommendation.id_rekomendasi}`
                });
                
                const result = await response.json();
                
                if (result.success) {
                    alert('Recommendation saved successfully!');
                } else {
                    alert('Failed to save: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to save recommendation');
            }
        }
        
        function shareRecommendation() {
            alert('Share recommendation via email atau export PDF');
        }
    </script>
</body>
</html>