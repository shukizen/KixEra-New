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
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Header - KONSISTEN dengan Pesanan -->
            <header class="bg-white border-b border-gray-200 px-6 py-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Kelola Pelanggan</h1>
                        <div class="bg-emerald-100 px-4 py-1 rounded-full">
                            <span class="text-emerald-700 text-sm font-medium" id="totalBadge">0 Total Pelanggan</span>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                        <!-- Search -->
                        <div class="relative flex-1 md:w-80">
                            <input type="text" id="searchInput" placeholder="Cari pelanggan..."
                                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>

                        <!-- Branch Filter -->
                        <select id="branchFilter"
                            class="px-4 py-2 border border-gray-300 rounded-xl text-black focus:outline-none focus:border-emerald-500">
                            <option value="">Semua Cabang</option>
                            <option value="1">Kota Gede</option>
                            <option value="2">Seturan</option>
                            <option value="3">Condongcatur</option>
                            <option value="4">Jakal</option>
                            <option value="5">Banguntapan</option>
                        </select>

                        <!-- Add Customer Button -->
                        <button onclick="openAddModal()" class="bg-emerald-500 text-white px-6 py-2 rounded-xl hover:bg-emerald-600 transition flex items-center justify-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Tambah Pelanggan</span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Stats Cards - KONSISTEN dengan format Keuangan & Pesanan -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Pelanggan -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Pelanggan</p>
                                <h3 class="text-2xl font-bold text-emerald-500 mt-2" id="totalCustomers">0</h3>
                                <p class="text-sm text-gray-500 mt-2">Semua cabang</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-emerald-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pelanggan Aktif -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pelanggan Aktif</p>
                                <h3 class="text-2xl font-bold text-blue-500 mt-2" id="activeCustomers">0</h3>
                                <p class="text-sm text-gray-500 mt-2">30 hari terakhir</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-check text-blue-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pelanggan Baru -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Baru Bulan Ini</p>
                                <h3 class="text-2xl font-bold text-purple-500 mt-2" id="newCustomers">0</h3>
                                <p class="text-sm text-gray-500 mt-2" id="currentMonth">-</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-plus text-purple-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Transaksi -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Transaksi</p>
                                <h3 class="text-2xl font-bold text-orange-500 mt-2" id="totalTransactions">0</h3>
                                <p class="text-sm text-gray-500 mt-2">Semua waktu</p>
                            </div>
                            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-orange-500"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Distribusi Pelanggan Per Cabang -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Distribusi Per Cabang</h2>
                            <button onclick="refreshCharts()" class="text-emerald-500 hover:text-emerald-600" title="Refresh">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                        <div class="h-64">
                            <canvas id="distributionChart"></canvas>
                        </div>
                    </div>

                    <!-- Top Pelanggan Aktif -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Top 5 Pelanggan Aktif</h2>
                        <div class="h-64">
                            <canvas id="topCustomersChart"></canvas>
                        </div>
                    </div>

                    <!-- Pertumbuhan Bulanan -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Pertumbuhan Bulanan</h2>
                            <select id="periodFilter" class="text-xs px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                                <option value="6">6 Bulan</option>
                                <option value="3">3 Bulan</option>
                                <option value="12">12 Bulan</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="growthChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Customer Table -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Data Pelanggan</h2>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="border-b border-gray-200">
                                <tr>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">ID</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Nama</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Telepon</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Email</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Alamat</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Total Pesanan</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Status</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="customerTableBody">
                                <?php if(isset($pelanggan) && count($pelanggan) > 0): ?>
                                    <?php foreach ($pelanggan as $p): ?>
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="py-4 px-4 text-center text-gray-700">#C<?= str_pad($p->id_pelanggan, 3, '0', STR_PAD_LEFT) ?></td>
                                        <td class="py-4 px-4 text-center text-gray-800 font-medium"><?= htmlspecialchars($p->nama ?? '') ?></td>
                                        <td class="py-4 px-4 text-center text-gray-700"><?= htmlspecialchars($p->no_telp ?? '') ?></td>
                                        <td class="py-4 px-4 text-center text-gray-700"><?= htmlspecialchars($p->email ?? '-') ?></td>
                                        <td class="py-4 px-4 text-center text-gray-700"><?= htmlspecialchars($p->alamat ?? '-') ?></td>
                                        <td class="py-4 px-4 text-center text-gray-700">
                                            <span class="font-medium text-emerald-600"><?= isset($p->total_pesanan) ? $p->total_pesanan : '0' ?></span>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Aktif</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <button onclick="viewCustomer(<?= $p->id_pelanggan ?>)" class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-lg flex items-center justify-center transition" title="Detail">
                                                    <i class="fas fa-eye text-sm"></i>
                                                </button>
                                                <button onclick="editCustomer(<?= $p->id_pelanggan ?>)" class="w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg flex items-center justify-center transition" title="Edit">
                                                    <i class="fas fa-edit text-sm"></i>
                                                </button>
                                                <button onclick="deleteCustomer(<?= $p->id_pelanggan ?>, '<?= htmlspecialchars($p->nama ?? '', ENT_QUOTES) ?>')" class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition" title="Hapus">
                                                    <i class="fas fa-trash text-sm"></i>
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
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4">
            <div class="flex items-center justify-between p-6 border-b">
                <h3 id="modalTitle" class="text-xl font-semibold text-gray-800">Tambah Pelanggan Baru</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="customerForm">
                <input type="hidden" id="customerId" name="id_pelanggan">
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="nama" name="nama" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon <span class="text-red-500">*</span></label>
                        <input type="text" id="no_telp" name="no_telp" required
                               placeholder="Contoh: 08123456789"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email"
                               placeholder="email@example.com"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3"
                                  placeholder="Masukkan alamat lengkap"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                    </div>
                </div>
                <div class="flex gap-3 p-6 border-t">
                    <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal View Customer -->
    <div id="viewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4">
            <div class="flex items-center justify-between p-6 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Detail Pelanggan</h3>
                <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="viewContent" class="p-6"></div>
            <div class="flex justify-end p-6 border-t">
                <button onclick="closeViewModal()" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Neon Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4">
            <div class="p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-3xl text-red-500"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Hapus</h3>
                <p class="text-gray-600 mb-2">Apakah Anda yakin ingin menghapus pelanggan:</p>
                <p id="deleteCustomerName" class="text-lg font-semibold text-red-500 mb-6"></p>
            </div>
            <div class="flex gap-3 p-6 border-t border-gray-200">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition font-medium">
                    Batal
                </button>
                <button id="confirmDeleteBtn" onclick="confirmDelete()" class="flex-1 px-4 py-3 rounded-xl text-white font-bold transition" style="background: linear-gradient(135deg, #ef4444, #dc2626); box-shadow: 0 0 15px rgba(239, 68, 68, 0.6), 0 0 30px rgba(239, 68, 68, 0.4);">
                    <i class="fas fa-trash mr-2"></i>Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        const BASE_URL = '<?= base_url() ?>';
        
        let distributionChart, topCustomersChart, growthChart;
        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                           'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        // Search functionality with debounce
        let searchTimeout;
        $('#searchInput').on('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(loadCustomers, 300);
        });
        
        $('#branchFilter').on('change', loadCustomers);
        $('#periodFilter').on('change', refreshCharts);
        
        function loadCustomers() {
            const search = $('#searchInput').val();
            const branch = $('#branchFilter').val();
            
            $.ajax({
                url: BASE_URL + 'pemilik/pelanggan/search',
                type: 'GET',
                data: { keyword: search, branch: branch },
                dataType: 'json',
                success: function(response) {
                    if(response.success && response.data) {
                        updateTable(response.data);
                        $('#totalBadge').text(response.data.length + ' Total Pelanggan');
                    }
                }
            });
        }
        
        function updateTable(customers) {
            let html = '';
            if(customers.length > 0) {
                customers.forEach(customer => {
                    html += `
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4 text-center text-gray-700">#C${String(customer.id_pelanggan).padStart(3, '0')}</td>
                            <td class="py-4 px-4 text-center text-gray-800 font-medium">${customer.nama || ''}</td>
                            <td class="py-4 px-4 text-center text-gray-700">${customer.no_telp || ''}</td>
                            <td class="py-4 px-4 text-center text-gray-700">${customer.email || '-'}</td>
                            <td class="py-4 px-4 text-center text-gray-700">${customer.alamat || '-'}</td>
                            <td class="py-4 px-4 text-center text-gray-700">
                                <span class="font-medium text-emerald-600">${customer.total_pesanan || '0'}</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Aktif</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="viewCustomer(${customer.id_pelanggan})" class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-lg flex items-center justify-center transition" title="Detail">
                                        <i class="fas fa-eye text-sm"></i>
                                    </button>
                                    <button onclick="editCustomer(${customer.id_pelanggan})" class="w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg flex items-center justify-center transition" title="Edit">
                                        <i class="fas fa-edit text-sm"></i>
                                    </button>
                                    <button onclick="deleteCustomer(${customer.id_pelanggan}, '${(customer.nama || '').replace(/'/g, "\\'")}')" class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition" title="Hapus">
                                        <i class="fas fa-trash text-sm"></i>
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
        
        function updateStatsCards(data) {
            let totalPelanggan = 0;
            if (data.distribusi) {
                data.distribusi.forEach(d => totalPelanggan += parseInt(d.total) || 0);
            }
            $('#totalCustomers').text(totalPelanggan);
            
            const activeCustomers = data.top ? data.top.length : 0;
            $('#activeCustomers').text(activeCustomers);
            
            let newThisMonth = 0;
            if (data.growth && data.growth.length > 0) {
                newThisMonth = parseInt(data.growth[data.growth.length - 1].total) || 0;
            }
            $('#newCustomers').text(newThisMonth);
            
            let totalTransactions = 0;
            if (data.top) {
                data.top.forEach(t => totalTransactions += parseInt(t.total_pesanan) || 0);
            }
            $('#totalTransactions').text(totalTransactions);
            
            const now = new Date();
            $('#currentMonth').text(monthNames[now.getMonth()] + ' ' + now.getFullYear());
        }
        
        function refreshCharts() {
            loadChartData();
        }
        
        function loadChartData() {
            const period = $('#periodFilter').val() || 6;
            
            $.ajax({
                url: BASE_URL + 'pemilik/pelanggan/grafik',
                type: 'GET',
                data: { period: period },
                dataType: 'json',
                success: function(response) {
                    if(response) {
                        updateCharts(response);
                        updateStatsCards(response);
                    }
                }
            });
        }
        
        function updateCharts(data) {
            if(!data) return;
            updateDistributionChart(data.distribusi || []);
            updateTopCustomersChart(data.top || []);
            updateGrowthChart(data.growth || []);
        }
        
        function updateDistributionChart(branches) {
            const labels = branches.map(b => b.nama_cabang || 'Unknown');
            const dataValues = branches.map(b => Number(b.total) || 0);
            const colors = ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0', '#0f766e', '#047857'];
            
            if (distributionChart) {
                distributionChart.data.labels = labels;
                distributionChart.data.datasets[0].data = dataValues;
                distributionChart.update();
            } else {
                const ctx = document.getElementById('distributionChart');
                if(!ctx) return;
                
                distributionChart = new Chart(ctx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: labels.length > 0 ? labels : ['Tidak ada data'],
                        datasets: [{
                            data: dataValues.length > 0 ? dataValues : [1],
                            backgroundColor: colors,
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });
            }
        }
        
        function updateTopCustomersChart(customers) {
            const labels = customers.map(c => c.nama || 'Unknown');
            const dataValues = customers.map(c => Number(c.total_pesanan) || 0);
            
            if (topCustomersChart) {
                topCustomersChart.data.labels = labels;
                topCustomersChart.data.datasets[0].data = dataValues;
                topCustomersChart.update();
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
                            backgroundColor: '#3b82f6',
                            borderRadius: 8
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { beginAtZero: true }
                        }
                    }
                });
            }
        }
        
        function updateGrowthChart(growth) {
            const labels = growth.map(g => g.bulan || 'Unknown');
            const dataValues = growth.map(g => Number(g.total) || 0);
            
            if (growthChart) {
                growthChart.data.labels = labels;
                growthChart.data.datasets[0].data = dataValues;
                growthChart.update();
            } else {
                const ctx = document.getElementById('growthChart');
                if(!ctx) return;
                
                growthChart = new Chart(ctx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: labels.length > 0 ? labels : ['Tidak ada data'],
                        datasets: [{
                            label: 'Pelanggan Baru',
                            data: dataValues.length > 0 ? dataValues : [0],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: '#10b981',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            }
        }
        
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
        
        $('#customerForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#customerId').val();
            const url = id ? BASE_URL + 'pemilik/pelanggan/update/' + id : BASE_URL + 'pemilik/pelanggan/store';
            
            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    showNotification('Data pelanggan berhasil disimpan', 'success');
                    closeModal();
                    setTimeout(() => location.reload(), 1500);
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    showNotification(response?.message || 'Terjadi kesalahan', 'error');
                }
            });
        });
        
        function viewCustomer(id) {
            $.ajax({
                url: BASE_URL + 'pemilik/pelanggan/edit/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(customer) {
                    if(customer) {
                        let html = `
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 pb-4 border-b">
                                    <div class="w-16 h-16 bg-emerald-500 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                        ${(customer.nama || 'U')[0].toUpperCase()}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold">${customer.nama}</h3>
                                        <p class="text-sm text-gray-500">#C${String(customer.id_pelanggan).padStart(3, '0')}</p>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                        <i class="fas fa-phone text-emerald-500"></i>
                                        <span class="text-gray-700">${customer.no_telp}</span>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                        <i class="fas fa-envelope text-emerald-500"></i>
                                        <span class="text-gray-700">${customer.email || '-'}</span>
                                    </div>
                                    ${customer.alamat ? `
                                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                                        <i class="fas fa-map-marker-alt text-emerald-500 mt-1"></i>
                                        <span class="text-gray-700">${customer.alamat}</span>
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                        `;
                        $('#viewContent').html(html);
                        $('#viewModal').removeClass('hidden');
                    } else {
                        showNotification('Data tidak ditemukan', 'error');
                    }
                },
                error: function() {
                    showNotification('Terjadi kesalahan saat mengambil data', 'error');
                }
            });
        }
        
        function editCustomer(id) {
            $.ajax({
                url: BASE_URL + 'pemilik/pelanggan/edit/' + id,
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
                        showNotification('Data tidak ditemukan', 'error');
                    }
                },
                error: function() {
                    showNotification('Terjadi kesalahan saat mengambil data', 'error');
                }
            });
        }
        
        let pendingDeleteId = null;
        
        function deleteCustomer(id, nama) {
            pendingDeleteId = id;
            document.getElementById('deleteCustomerName').textContent = '"' + nama + '"';
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            pendingDeleteId = null;
        }
        
        function confirmDelete() {
            if (!pendingDeleteId) return;
            
            const id = pendingDeleteId;
            closeDeleteModal();
            
            $.ajax({
                url: BASE_URL + 'pemilik/pelanggan/delete/' + id,
                type: 'POST',
                success: function(response) {
                    if(response.success) {
                        showNotification('Pelanggan berhasil dihapus', 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showNotification(response.message || 'Gagal menghapus pelanggan', 'error');
                    }
                },
                error: function() {
                    showNotification('Terjadi kesalahan saat menghapus data', 'error');
                }
            });
        }
        
        function showNotification(message, type = 'info') {
            const existing = document.getElementById('temp-notification');
            if (existing) existing.remove();

            const notification = document.createElement('div');

            let neonClass = '';
            let neonShadow = '';

            if (type === 'success') {
                neonClass = 'bg-green-400 text-black';
                neonShadow = '0 0 10px #22c55e, 0 0 20px #22c55e, 0 0 40px #22c55e';
            } else if (type === 'error') {
                neonClass = 'bg-red-400 text-black';
                neonShadow = '0 0 10px #f87171, 0 0 20px #f87171, 0 0 40px #f87171';
            } else {
                neonClass = 'bg-cyan-400 text-black';
                neonShadow = '0 0 10px #22d3ee, 0 0 20px #22d3ee, 0 0 40px #22d3ee';
            }

            notification.className = `
                fixed top-4 right-4 px-6 py-3 rounded-xl
                font-semibold tracking-wide
                z-50 transition-all duration-300
                ${neonClass}
            `;

            notification.style.boxShadow = neonShadow;
            notification.style.filter = 'brightness(1.1)';
            notification.textContent = message;
            notification.id = 'temp-notification';

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-10px)';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
        
        // Initialize
        $(document).ready(function() {
            const now = new Date();
            $('#currentMonth').text(monthNames[now.getMonth()] + ' ' + now.getFullYear());
            loadChartData();
            
            // Initial badge count from PHP
            <?php if(isset($pelanggan)): ?>
            $('#totalBadge').text('<?= count($pelanggan) ?> Total Pelanggan');
            <?php endif; ?>
        });
    </script>
</body>
</html>