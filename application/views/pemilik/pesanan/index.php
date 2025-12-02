<!DOCTYPE html>
<html lang="id">
<head>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->  
        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Kelola Pesanan</h1>
                        <div class="bg-emerald-100 px-4 py-1 rounded-full">
                            <span class="text-teal-700 text-sm font-medium">1,247 Total Pesanan</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                        <!-- Search -->
                        <div class="relative flex-1 md:w-80">
                            <input type="text" placeholder="Search by customer name or order" 
                                   class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        
                        <!-- Status Filter -->
                        <select class="px-4 py-2 border border-gray-300 rounded-xl text-black focus:outline-none focus:border-emerald-500">
                            <option>All Status</option>
                            <option>Selesai</option>
                            <option>Proses</option>
                            <option>Menunggu</option>
                            <option>Dibatalkan</option>
                        </select>
                        
                        <!-- Add Order Button -->
                        <button class="bg-emerald-500 text-white px-6 py-2 rounded-xl hover:bg-emerald-600 transition flex items-center justify-center gap-2">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Pesanan</span>
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Pesanan Hari Ini -->
                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Pesanan Hari Ini</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">126</h3>
                            </div>
                            <div class="w-12 h-12 bg-emerald-500/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pesanan Selesai -->
                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pesanan Selesai</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">89</h3>
                            </div>
                            <div class="w-12 h-12 bg-emerald-400/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-check-circle text-emerald-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dalam Proses -->
                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Dalam Proses</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">32</h3>
                            </div>
                            <div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-spinner text-yellow-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dibatalkan -->
                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Dibatalkan</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">5</h3>
                            </div>
                            <div class="w-12 h-12 bg-red-500/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-times-circle text-red-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Data Pesanan Table -->
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Data Pesanan</h2>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="border-b border-gray-200">
                                    <tr>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">ID</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Tanggal</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Pelanggan</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Cabang</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Layanan</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Total</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Status</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Row 1 -->
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="text-center py-4 px-2">#001</td>
                                        <td class="text-center py-4 px-2">12/11/2024</td>
                                        <td class="text-center py-4 px-2">Ahmad Rizki</td>
                                        <td class="text-center py-4 px-2">Kota Gede</td>
                                        <td class="text-center py-4 px-2">Premium</td>
                                        <td class="text-center py-4 px-2">Rp 45.000</td>
                                        <td class="text-center py-4 px-2">
                                            <span class="bg-emerald-500/10 text-emerald-500 px-3 py-1 rounded-full text-xs font-medium">Selesai</span>
                                        </td>
                                        <td class="text-center py-4 px-2">
                                            <div class="flex items-center justify-center gap-2">
                                                <button class="text-emerald-500 hover:text-emerald-600" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-blue-500 hover:text-blue-600" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-500 hover:text-red-600" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Row 2 -->
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="text-center py-4 px-2">#002</td>
                                        <td class="text-center py-4 px-2">12/11/2024</td>
                                        <td class="text-center py-4 px-2">Sari Dewi</td>
                                        <td class="text-center py-4 px-2">Seturan</td>
                                        <td class="text-center py-4 px-2">Whitening</td>
                                        <td class="text-center py-4 px-2">Rp 60.000</td>
                                        <td class="text-center py-4 px-2">
                                            <span class="bg-emerald-400/10 text-emerald-400 px-3 py-1 rounded-full text-xs font-medium">Proses</span>
                                        </td>
                                        <td class="text-center py-4 px-2">
                                            <div class="flex items-center justify-center gap-2">
                                                <button class="text-emerald-500 hover:text-emerald-600" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-blue-500 hover:text-blue-600" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-500 hover:text-red-600" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Row 3 -->
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="text-center py-4 px-2">#003</td>
                                        <td class="text-center py-4 px-2">11/11/2024</td>
                                        <td class="text-center py-4 px-2">Budi Santoso</td>
                                        <td class="text-center py-4 px-2">Condongcatur</td>
                                        <td class="text-center py-4 px-2">Reguler</td>
                                        <td class="text-center py-4 px-2">Rp 25.000</td>
                                        <td class="text-center py-4 px-2">
                                            <span class="bg-yellow-500/10 text-yellow-600 px-3 py-1 rounded-full text-xs font-medium">Menunggu</span>
                                        </td>
                                        <td class="text-center py-4 px-2">
                                            <div class="flex items-center justify-center gap-2">
                                                <button class="text-emerald-500 hover:text-emerald-600" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-blue-500 hover:text-blue-600" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-500 hover:text-red-600" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Right Sidebar Charts -->
                    <div class="space-y-6">
                        <!-- Pesanan per Cabang -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Pesanan per Cabang</h2>
                            <div class="h-64">
                                <canvas id="branchChart"></canvas>
                            </div>
                        </div>
                        
                        <!-- Jenis Layanan -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Jenis Layanan</h2>
                            <div class="h-64">
                                <canvas id="serviceTypeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bottom Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Tren Pesanan -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tren Pesanan (7 Hari)</h2>
                        <div class="h-64">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Insight Ringkas -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Insight Ringkas</h2>
                        <div class="space-y-4">
                            <!-- Insight 1 -->
                            <div class="bg-emerald-100/20 rounded-lg p-4 flex items-start gap-3">
                                <i class="fas fa-chart-line text-emerald-500 mt-1"></i>
                                <p class="text-sm text-gray-700">Cabang Condongcatur memiliki peningkatan 25% minggu ini</p>
                            </div>
                            
                            <!-- Insight 2 -->
                            <div class="bg-emerald-100/20 rounded-lg p-4 flex items-start gap-3">
                                <i class="fas fa-star text-emerald-500 mt-1"></i>
                                <p class="text-sm text-gray-700">Layanan Whitening paling diminati bulan ini</p>
                            </div>
                            
                            <!-- Insight 3 -->
                            <div class="bg-emerald-100/20 rounded-lg p-4 flex items-start gap-3">
                                <i class="fas fa-clock text-emerald-500 mt-1"></i>
                                <p class="text-sm text-gray-700">Rata-rata waktu penyelesaian: 2,3 hari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>
    </div>
    
    <script>
        // Pesanan per Cabang - Bar Chart
        const branchCtx = document.getElementById('branchChart').getContext('2d');
        new Chart(branchCtx, {
            type: 'bar',
            data: {
                labels: ['Kota Gede', 'Seturan', 'Condongcatur', 'Jakal', 'Banguntapan'],
                datasets: [{
                    label: 'Pesanan',
                    data: [65, 55, 70, 40, 50],
                    backgroundColor: '#10b981',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 75,
                        ticks: {
                            stepSize: 25
                        }
                    }
                }
            }
        });
        
        // Jenis Layanan - Pie Chart
        const serviceTypeCtx = document.getElementById('serviceTypeChart').getContext('2d');
        new Chart(serviceTypeCtx, {
            type: 'pie',
            data: {
                labels: ['Cuci Reguler', 'Premium', 'Whitening', 'Repair'],
                datasets: [{
                    data: [35, 25, 25, 15],
                    backgroundColor: ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: { size: 11 },
                            padding: 10
                        }
                    }
                }
            }
        });
        
        // Tren Pesanan - Line Chart
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['6 Nov', '7 Nov', '8 Nov', '9 Nov', '10 Nov', '11 Nov', '12 Nov'],
                datasets: [{
                    label: 'Pesanan Harian',
                    data: [20, 28, 48, 38, 42, 55, 45],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 20,
                        max: 60,
                        ticks: {
                            stepSize: 10
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>