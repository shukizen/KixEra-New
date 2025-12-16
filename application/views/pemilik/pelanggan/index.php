<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pelanggan - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Skeleton Loading Animation */
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: 8px;
        }
        
        /* Chart Card Hover Effect */
        .chart-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .chart-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .chart-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #34d399, #6ee7b7);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .chart-card:hover::before {
            opacity: 1;
        }
        
        /* Pulse Animation for Refresh Icon */
        .refresh-btn:hover i {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /* Fade In Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease forwards;
        }
        
        /* Counter Animation */
        .counter-value {
            transition: all 0.5s ease-out;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar (gunakan sidebar yang sudah ada) -->
        
        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-100 shadow-sm px-6 py-4">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <h1 class="text-2xl font-semibold text-gray-800">Kelola Pelanggan</h1>
                    
                    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                        <!-- Search -->
                        <div class="relative flex-1 md:w-80">
                            <input type="text" id="searchInput" placeholder="Cari pelanggan..." 
                                   class="w-full px-4 py-2 pl-10 border border-gray-200 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        
                        <!-- Branch Filter -->
                        <select id="branchFilter" class="px-4 py-2 border border-gray-200 rounded-xl text-black focus:outline-none focus:border-emerald-500">
                            <option value="">Semua Cabang</option>
                            <option value="1">Kota Gede</option>
                            <option value="2">Seturan</option>
                            <option value="3">Condongcatur</option>
                            <option value="4">Jakal</option>
                            <option value="5">Banguntapan</option>
                        </select>
                        
                        <!-- Add Customer Button -->
                        <button onclick="openAddModal()" class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-6 py-2 rounded-xl hover:opacity-90 transition flex items-center justify-center gap-2 shadow-md">
                            <i class="fas fa-user-plus"></i>
                            <span>Tambah Pelanggan</span>
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Stats Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <!-- Total Pelanggan -->
                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 text-white shadow-lg animate-fade-in-up" style="animation-delay: 0.1s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-emerald-100 text-sm font-medium">Total Pelanggan</p>
                                <h3 class="text-3xl font-bold mt-1 counter-value" id="totalCustomers">-</h3>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center text-emerald-100 text-sm">
                            <i class="fas fa-chart-line mr-1"></i>
                            <span id="growthPercentage">+0%</span>
                            <span class="ml-1">dari bulan lalu</span>
                        </div>
                    </div>
                    
                    <!-- Pelanggan Aktif -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 text-white shadow-lg animate-fade-in-up" style="animation-delay: 0.2s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm font-medium">Pelanggan Aktif</p>
                                <h3 class="text-3xl font-bold mt-1 counter-value" id="activeCustomers">-</h3>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-user-check text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center text-blue-100 text-sm">
                            <i class="fas fa-circle text-xs mr-2 animate-pulse"></i>
                            <span>Transaksi 30 hari</span>
                        </div>
                    </div>
                    
                    <!-- Pelanggan Baru Bulan Ini -->
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-5 text-white shadow-lg animate-fade-in-up" style="animation-delay: 0.3s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-100 text-sm font-medium">Baru Bulan Ini</p>
                                <h3 class="text-3xl font-bold mt-1 counter-value" id="newCustomers">-</h3>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-user-plus text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center text-purple-100 text-sm">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span id="currentMonth">-</span>
                        </div>
                    </div>
                    
                    <!-- Total Transaksi -->
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-5 text-white shadow-lg animate-fade-in-up" style="animation-delay: 0.4s">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-orange-100 text-sm font-medium">Total Transaksi</p>
                                <h3 class="text-3xl font-bold mt-1 counter-value" id="totalTransactions">-</h3>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-2xl"></i>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center text-orange-100 text-sm">
                            <i class="fas fa-receipt mr-2"></i>
                            <span>Semua waktu</span>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Section Header -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-chart-pie text-emerald-500 mr-2"></i>
                        Analisis Pelanggan
                    </h2>
                    <div class="flex items-center gap-3">
                        <!-- Period Filter -->
                        <select id="periodFilter" class="px-3 py-2 text-sm border border-gray-200 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500 bg-white">
                            <option value="6">6 Bulan Terakhir</option>
                            <option value="3">3 Bulan Terakhir</option>
                            <option value="12">12 Bulan Terakhir</option>
                        </select>
                        
                        <!-- Refresh Button -->
                        <button onclick="refreshCharts()" class="refresh-btn flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 transition-all text-sm font-medium shadow-md hover:shadow-lg">
                            <i class="fas fa-sync-alt"></i>
                            <span class="hidden md:inline">Refresh</span>
                        </button>
                        
                        <!-- Last Updated -->
                        <div class="text-xs text-gray-400 hidden md:block">
                            <span>Update: </span>
                            <span id="lastUpdated">-</span>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Distribusi Pelanggan Per Cabang -->
                    <div class="chart-card bg-white rounded-2xl shadow-lg p-6 animate-fade-in-up" style="animation-delay: 0.5s">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <span class="w-3 h-3 bg-emerald-500 rounded-full mr-2"></span>
                                Distribusi Per Cabang
                            </h2>
                            <div class="text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded-lg">
                                <i class="fas fa-map-marker-alt mr-1"></i> Lokasi
                            </div>
                        </div>
                        <div class="h-64 relative" id="distributionChartContainer">
                            <!-- Skeleton Loading -->
                            <div id="distributionSkeleton" class="absolute inset-0 flex items-center justify-center">
                                <div class="w-32 h-32 skeleton rounded-full"></div>
                            </div>
                            <canvas id="distributionChart" class="opacity-0 transition-opacity duration-500"></canvas>
                        </div>
                        <div id="distributionLegend" class="mt-4 grid grid-cols-2 gap-2 text-xs"></div>
                    </div>
                    
                    <!-- Top Pelanggan Aktif -->
                    <div class="chart-card bg-white rounded-2xl shadow-lg p-6 animate-fade-in-up" style="animation-delay: 0.6s">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                                Top 5 Pelanggan Aktif
                            </h2>
                            <div class="text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded-lg">
                                <i class="fas fa-trophy mr-1"></i> Ranking
                            </div>
                        </div>
                        <div class="h-64 relative" id="topCustomersChartContainer">
                            <!-- Skeleton Loading -->
                            <div id="topCustomersSkeleton" class="absolute inset-0 flex flex-col justify-center gap-3">
                                <div class="skeleton h-8 w-full"></div>
                                <div class="skeleton h-8 w-11/12"></div>
                                <div class="skeleton h-8 w-10/12"></div>
                                <div class="skeleton h-8 w-9/12"></div>
                                <div class="skeleton h-8 w-8/12"></div>
                            </div>
                            <canvas id="topCustomersChart" class="opacity-0 transition-opacity duration-500"></canvas>
                        </div>
                    </div>
                    
                    <!-- Pertumbuhan Bulanan -->
                    <div class="chart-card bg-white rounded-2xl shadow-lg p-6 animate-fade-in-up" style="animation-delay: 0.7s">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <span class="w-3 h-3 bg-purple-500 rounded-full mr-2"></span>
                                Pertumbuhan Bulanan
                            </h2>
                            <div class="text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded-lg">
                                <i class="fas fa-chart-line mr-1"></i> Trend
                            </div>
                        </div>
                        <div class="h-64 relative" id="growthChartContainer">
                            <!-- Skeleton Loading -->
                            <div id="growthSkeleton" class="absolute inset-0 flex items-end gap-2 pb-8">
                                <div class="skeleton flex-1 h-16"></div>
                                <div class="skeleton flex-1 h-24"></div>
                                <div class="skeleton flex-1 h-20"></div>
                                <div class="skeleton flex-1 h-32"></div>
                                <div class="skeleton flex-1 h-28"></div>
                                <div class="skeleton flex-1 h-36"></div>
                            </div>
                            <canvas id="growthChart" class="opacity-0 transition-opacity duration-500"></canvas>
                        </div>
                        <div class="mt-4 flex items-center justify-between text-sm">
                            <div class="flex items-center text-gray-500">
                                <div class="w-3 h-3 bg-gradient-to-r from-emerald-400 to-emerald-600 rounded mr-2"></div>
                                Pelanggan Baru
                            </div>
                            <div id="growthTrend" class="flex items-center text-emerald-500 font-medium">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span>+0%</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Customer Table -->
                <div class="bg-white rounded-2xl shadow-lg mb-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">ID</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Nama</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Telepon</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Email</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Alamat</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Total<br/>Pesanan</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Status</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="customerTableBody">
                                <?php if(isset($pelanggan) && count($pelanggan) > 0): ?>
                                    <?php foreach ($pelanggan as $p): ?>
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                        <td class="text-center py-5 px-3 text-gray-600 text-sm">#C<?= str_pad($p->id_pelanggan, 3, '0', STR_PAD_LEFT) ?></td>
                                        <td class="text-center py-5 px-3 text-gray-800 text-sm font-medium"><?= htmlspecialchars($p->nama ?? '') ?></td>
                                        <td class="text-center py-5 px-3 text-gray-600 text-sm"><?= htmlspecialchars($p->no_telp ?? '') ?></td>
                                        <td class="text-center py-5 px-3 text-gray-600 text-sm"><?= htmlspecialchars($p->email ?? '-') ?></td>
                                        <td class="text-center py-5 px-3 text-gray-600 text-sm"><?= htmlspecialchars($p->alamat ?? '-') ?></td>
                                        <td class="text-center py-5 px-3 text-gray-600 text-sm">-</td>
                                        <td class="text-center py-5 px-3">
                                            <span class="bg-emerald-500/20 text-emerald-500 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                                        </td>
                                        <td class="text-center py-5 px-3">
                                            <div class="flex items-center justify-center gap-2">
                                                <button onclick="viewCustomer(<?= $p->id_pelanggan ?>)" class="text-emerald-500 hover:text-emerald-600 p-2 transition-colors" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button onclick="editCustomer(<?= $p->id_pelanggan ?>)" class="text-blue-600 hover:text-blue-700 p-2 transition-colors" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button onclick="deleteCustomer(<?= $p->id_pelanggan ?>, '<?= htmlspecialchars($p->nama ?? '', ENT_QUOTES) ?>')" class="text-red-600 hover:text-red-700 p-2 transition-colors" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-8 text-gray-500">Tidak ada data pelanggan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Add/Edit Customer -->
    <div id="customerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <h2 id="modalTitle" class="text-2xl font-semibold text-gray-800">Tambah Pelanggan Baru</h2>
            </div>
            <form id="customerForm" class="p-6">
                <input type="hidden" id="customerId" name="id_pelanggan">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon *</label>
                        <input type="text" id="no_telp" name="no_telp" required
                               placeholder="Contoh: 08123456789"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email"
                               placeholder="email@example.com"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3"
                                  placeholder="Masukkan alamat lengkap"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"></textarea>
                    </div>
                </div>
                
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModal()" 
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal View Customer -->
    <div id="viewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800">Detail Pelanggan</h2>
            </div>
            <div id="viewContent" class="p-6">
                <!-- Content will be loaded dynamically -->
            </div>
            <div class="p-6 border-t border-gray-200 flex justify-end">
                <button onclick="closeViewModal()" 
                        class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        const BASE_URL = '<?= base_url() ?>';
        
        let distributionChart, topCustomersChart, growthChart;
        let autoRefreshInterval = null;
        
        // Month names in Indonesian
        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                           'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        // Search functionality with debounce
        let searchTimeout;
        $('#searchInput').on('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(loadCustomers, 300);
        });
        
        // Branch filter
        $('#branchFilter').on('change', function() {
            loadCustomers();
        });
        
        // Period filter for growth chart
        $('#periodFilter').on('change', function() {
            refreshCharts();
        });
        
        // Load customers data
        function loadCustomers() {
            const search = $('#searchInput').val();
            const branch = $('#branchFilter').val();
            
            $.ajax({
                url: BASE_URL + 'pelanggan/search',
                type: 'GET',
                data: { keyword: search, branch: branch },
                dataType: 'json',
                success: function(response) {
                    if(response.success && response.data) {
                        updateTable(response.data);
                    }
                },
                error: function(xhr, status, err) {
                    console.error('Error loading customers:', err);
                }
            });
        }
        
        // Update table with customer data
        function updateTable(customers) {
            let html = '';
            
            if(customers.length > 0) {
                customers.forEach(customer => {
                    html += `
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="text-center py-5 px-3 text-gray-600 text-sm">#C${String(customer.id_pelanggan).padStart(3, '0')}</td>
                            <td class="text-center py-5 px-3 text-gray-800 text-sm font-medium">${customer.nama || ''}</td>
                            <td class="text-center py-5 px-3 text-gray-600 text-sm">${customer.no_telp || ''}</td>
                            <td class="text-center py-5 px-3 text-gray-600 text-sm">${customer.email || '-'}</td>
                            <td class="text-center py-5 px-3 text-gray-600 text-sm">${customer.alamat || '-'}</td>
                            <td class="text-center py-5 px-3 text-gray-600 text-sm">-</td>
                            <td class="text-center py-5 px-3">
                                <span class="bg-emerald-500/20 text-emerald-500 px-3 py-1 rounded-full text-xs font-medium">Aktif</span>
                            </td>
                            <td class="text-center py-5 px-3">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="viewCustomer(${customer.id_pelanggan})" class="text-emerald-500 hover:text-emerald-600 p-2 transition-colors" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="editCustomer(${customer.id_pelanggan})" class="text-blue-600 hover:text-blue-700 p-2 transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteCustomer(${customer.id_pelanggan}, '${(customer.nama || '').replace(/'/g, "\\'")}')" class="text-red-600 hover:text-red-700 p-2 transition-colors" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            } else {
                html = '<tr><td colspan="8" class="text-center py-8 text-gray-500">Tidak ada data pelanggan</td></tr>';
            }
            
            $('#customerTableBody').html(html);
        }
        
        // Animate counter
        function animateCounter(elementId, targetValue) {
            const element = document.getElementById(elementId);
            if (!element) return;
            
            const startValue = parseInt(element.textContent) || 0;
            const duration = 1000;
            const startTime = performance.now();
            
            function updateCounter(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                const currentValue = Math.floor(startValue + (targetValue - startValue) * easeOutQuart);
                
                element.textContent = currentValue.toLocaleString('id-ID');
                
                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                }
            }
            
            requestAnimationFrame(updateCounter);
        }
        
        // Update stats cards
        function updateStatsCards(data) {
            let totalPelanggan = 0;
            if (data.distribusi) {
                data.distribusi.forEach(d => {
                    totalPelanggan += parseInt(d.total) || 0;
                });
            }
            animateCounter('totalCustomers', totalPelanggan);
            
            const activeCustomers = data.top ? data.top.length : 0;
            animateCounter('activeCustomers', activeCustomers);
            
            let newThisMonth = 0;
            if (data.growth && data.growth.length > 0) {
                newThisMonth = parseInt(data.growth[data.growth.length - 1].total) || 0;
            }
            animateCounter('newCustomers', newThisMonth);
            
            let totalTransactions = 0;
            if (data.top) {
                data.top.forEach(t => {
                    totalTransactions += parseInt(t.total_pesanan) || 0;
                });
            }
            animateCounter('totalTransactions', totalTransactions);
            
            // Calculate growth percentage
            if (data.growth && data.growth.length >= 2) {
                const current = parseInt(data.growth[data.growth.length - 1].total) || 0;
                const previous = parseInt(data.growth[data.growth.length - 2].total) || 1;
                const growthPct = ((current - previous) / previous * 100).toFixed(1);
                const isPositive = growthPct >= 0;
                
                $('#growthPercentage').html(`${isPositive ? '+' : ''}${growthPct}%`);
                $('#growthTrend').html(`
                    <i class="fas fa-arrow-${isPositive ? 'up' : 'down'} mr-1"></i>
                    <span>${isPositive ? '+' : ''}${growthPct}%</span>
                `);
                $('#growthTrend').removeClass('text-emerald-500 text-red-500').addClass(isPositive ? 'text-emerald-500' : 'text-red-500');
            }
            
            const now = new Date();
            $('#currentMonth').text(monthNames[now.getMonth()] + ' ' + now.getFullYear());
        }
        
        // Show/hide skeleton and chart
        function showChart(chartId) {
            const skeleton = document.getElementById(chartId + 'Skeleton');
            const canvas = document.getElementById(chartId);
            if (skeleton) skeleton.style.display = 'none';
            if (canvas) {
                canvas.classList.remove('opacity-0');
                canvas.classList.add('opacity-100');
            }
        }
        
        function showSkeleton(chartId) {
            const skeleton = document.getElementById(chartId + 'Skeleton');
            const canvas = document.getElementById(chartId);
            if (skeleton) skeleton.style.display = 'flex';
            if (canvas) {
                canvas.classList.remove('opacity-100');
                canvas.classList.add('opacity-0');
            }
        }
        
        function updateLastUpdated() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            $('#lastUpdated').text(timeStr);
        }
        
        function refreshCharts() {
            showSkeleton('distribution');
            showSkeleton('topCustomers');
            showSkeleton('growth');
            loadChartData();
        }
        
        // Load chart data
        function loadChartData() {
            const period = $('#periodFilter').val() || 6;
            
            $.ajax({
                url: BASE_URL + 'pelanggan/grafik',
                type: 'GET',
                data: { period: period },
                dataType: 'json',
                success: function(response) {
                    console.log('Chart data:', response);
                    if(response) {
                        updateCharts(response);
                        updateStatsCards(response);
                        updateLastUpdated();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading chart data:', error);
                    showChart('distribution');
                    showChart('topCustomers');
                    showChart('growth');
                }
            });
        }
        
        function updateCharts(data) {
            if(!data) return;
            updateDistributionChart(data.distribusi || []);
            updateTopCustomersChart(data.top || []);
            updateGrowthChart(data.growth || []);
        }
        
        const gradientColors = {
            emerald: ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0', '#0f766e', '#047857'],
            blue: ['#3b82f6', '#60a5fa', '#93c5fd', '#2563eb', '#1d4ed8']
        };
        
        // Distribution Chart (Doughnut)
        function updateDistributionChart(branches) {
            const labels = branches.map(b => b.nama_cabang || 'Unknown');
            const dataValues = branches.map(b => Number(b.total) || 0);
            
            if (distributionChart) {
                distributionChart.data.labels = labels;
                distributionChart.data.datasets[0].data = dataValues;
                distributionChart.update('active');
            } else {
                const ctx = document.getElementById('distributionChart');
                if(!ctx) return;
                
                distributionChart = new Chart(ctx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: labels.length > 0 ? labels : ['Tidak ada data'],
                        datasets: [{
                            data: dataValues.length > 0 ? dataValues : [1],
                            backgroundColor: gradientColors.emerald.slice(0, Math.max(labels.length, 1)),
                            borderWidth: 3,
                            borderColor: '#fff',
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        cutout: '60%',
                        animation: { animateScale: true, animateRotate: true, duration: 1000 },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: 'rgba(17, 24, 39, 0.9)',
                                padding: 12,
                                cornerRadius: 8,
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const pct = ((context.raw / total) * 100).toFixed(1);
                                        return `${context.label}: ${context.raw} (${pct}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }
            
            // Custom legend
            let legendHtml = '';
            branches.forEach((b, i) => {
                const color = gradientColors.emerald[i % gradientColors.emerald.length];
                legendHtml += `
                    <div class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-3 h-3 rounded-full" style="background-color: ${color}"></div>
                        <span class="text-gray-600 truncate">${b.nama_cabang}</span>
                        <span class="ml-auto font-semibold text-gray-800">${b.total}</span>
                    </div>
                `;
            });
            $('#distributionLegend').html(legendHtml);
            showChart('distribution');
        }
        
        // Top Customers Chart (Horizontal Bar)
        function updateTopCustomersChart(customers) {
            const labels = customers.map(c => c.nama || 'Unknown');
            const dataValues = customers.map(c => Number(c.total_pesanan) || 0);
            const barColors = customers.map((_, i) => `rgba(59, 130, 246, ${1 - (i * 0.15)})`);
            
            if (topCustomersChart) {
                topCustomersChart.data.labels = labels;
                topCustomersChart.data.datasets[0].data = dataValues;
                topCustomersChart.data.datasets[0].backgroundColor = barColors;
                topCustomersChart.update('active');
            } else {
                const ctx = document.getElementById('topCustomersChart');
                if(!ctx) return;
                
                topCustomersChart = new Chart(ctx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: labels.length > 0 ? labels : ['Tidak ada data'],
                        datasets: [{
                            label: 'Total Pesanan',
                            data: dataValues.length > 0 ? dataValues : [0],
                            backgroundColor: barColors.length > 0 ? barColors : ['#3b82f6'],
                            borderRadius: 8,
                            barThickness: 20
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: true,
                        animation: { duration: 1000, delay: (ctx) => ctx.dataIndex * 100 },
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { beginAtZero: true, grid: { color: 'rgba(229, 231, 235, 0.5)' } },
                            y: { grid: { display: false } }
                        }
                    }
                });
            }
            showChart('topCustomers');
        }
        
        // Growth Chart (Line with gradient fill)
        function updateGrowthChart(growth) {
            const labels = growth.map(g => g.bulan || 'Unknown');
            const dataValues = growth.map(g => Number(g.total) || 0);
            
            if (growthChart) {
                growthChart.data.labels = labels;
                growthChart.data.datasets[0].data = dataValues;
                growthChart.update('active');
            } else {
                const ctx = document.getElementById('growthChart');
                if(!ctx) return;
                
                const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 250);
                gradient.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
                gradient.addColorStop(1, 'rgba(16, 185, 129, 0.02)');
                
                growthChart = new Chart(ctx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: labels.length > 0 ? labels : ['Tidak ada data'],
                        datasets: [{
                            label: 'Pelanggan Baru',
                            data: dataValues.length > 0 ? dataValues : [0],
                            borderColor: '#10b981',
                            backgroundColor: gradient,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: '#10b981',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 3,
                            pointRadius: 6,
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        animation: { duration: 1500 },
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, grid: { color: 'rgba(229, 231, 235, 0.5)' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
            showChart('growth');
        }
        
        // Modal functions
        function openAddModal() {
            $('#modalTitle').text('Tambah Pelanggan Baru');
            $('#customerForm')[0].reset();
            $('#customerId').val('');
            $('#customerModal').removeClass('hidden');
        }
        
        function closeModal() {
            $('#customerModal').addClass('hidden');
        }
        
        function closeViewModal() {
            $('#viewModal').addClass('hidden');
        }
        
        // Form submit
        $('#customerForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#customerId').val();
            const url = id ? BASE_URL + 'pelanggan/update/' + id : BASE_URL + 'pelanggan/store';
            
            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert('Data pelanggan berhasil disimpan');
                    closeModal();
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        });
        
        // View customer
        function viewCustomer(id) {
            $.ajax({
                url: BASE_URL + 'pelanggan/edit/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(customer) {
                    if(customer) {
                        let html = `
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 pb-4 border-b border-gray-100">
                                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                        ${(customer.nama || 'U')[0].toUpperCase()}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">${customer.nama}</h3>
                                        <p class="text-sm text-gray-500">#C${String(customer.id_pelanggan).padStart(3, '0')}</p>
                                    </div>
                                </div>
                                <div class="grid gap-3">
                                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                        <i class="fas fa-phone text-emerald-500 w-5"></i>
                                        <span class="text-gray-700">${customer.no_telp}</span>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                        <i class="fas fa-envelope text-emerald-500 w-5"></i>
                                        <span class="text-gray-700">${customer.email || '-'}</span>
                                    </div>
                                    ${customer.alamat ? `
                                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                                        <i class="fas fa-map-marker-alt text-emerald-500 w-5 mt-1"></i>
                                        <span class="text-gray-700">${customer.alamat}</span>
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                        `;
                        $('#viewContent').html(html);
                        $('#viewModal').removeClass('hidden');
                    } else {
                        alert('Data tidak ditemukan');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        }
        
        // Edit customer
        function editCustomer(id) {
            $.ajax({
                url: BASE_URL + 'pelanggan/edit/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(customer) {
                    if(customer) {
                        $('#modalTitle').text('Edit Pelanggan');
                        $('#customerId').val(customer.id_pelanggan);
                        $('#nama').val(customer.nama);
                        $('#no_telp').val(customer.no_telp);
                        $('#email').val(customer.email);
                        $('#alamat').val(customer.alamat);
                        $('#customerModal').removeClass('hidden');
                    } else {
                        alert('Data tidak ditemukan');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        }
        
        // Delete customer
        function deleteCustomer(id, nama) {
            if(confirm('Apakah Anda yakin ingin menghapus pelanggan "' + nama + '"?')) {
                window.location.href = BASE_URL + 'pelanggan/delete/' + id;
            }
        }
        
        // Auto refresh
        function startAutoRefresh() {
            if (autoRefreshInterval) clearInterval(autoRefreshInterval);
            autoRefreshInterval = setInterval(loadChartData, 30000);
        }
        
        function stopAutoRefresh() {
            if (autoRefreshInterval) {
                clearInterval(autoRefreshInterval);
                autoRefreshInterval = null;
            }
        }
        
        // Initialize
        $(document).ready(function() {
            const now = new Date();
            $('#currentMonth').text(monthNames[now.getMonth()] + ' ' + now.getFullYear());
            loadChartData();
            startAutoRefresh();
            
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    stopAutoRefresh();
                } else {
                    startAutoRefresh();
                    loadChartData();
                }
            });
        });
    </script>
</body>
</html>