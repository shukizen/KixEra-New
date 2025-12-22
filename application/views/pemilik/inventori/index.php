<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Inventory - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar (gunakan sidebar yang sudah ada) -->
        
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-100 shadow-sm px-6 py-4">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <h1 class="text-2xl font-semibold text-gray-800">Kelola Inventory</h1>
                    
                    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                        <!-- Search -->
                        <div class="relative flex-1 md:w-80">
                            <input type="text" id="searchInput" placeholder="Search..." 
                                   class="w-full px-4 py-2 pl-10 border border-gray-200 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        
                        <!-- Category Filter -->
                        <select id="categoryFilter" class="px-4 py-2 border border-gray-200 rounded-xl text-black focus:outline-none focus:border-emerald-500">
                            <option value="">Semua Kategori</option>
                            <option value="bahan">bahan</option>
                            <option value="alat">alat</option>
                            <option value="perlengkapan">perlengkapan</option>
                        </select>
                        
                        <!-- Add Item Button -->
                        <button onclick="openAddModal()" class="bg-emerald-500 text-white px-6 py-3 rounded-xl hover:bg-emerald-600 transition flex items-center justify-center gap-2">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Item Baru</span>
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <div class="p-6">
                 <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Top Penggunaan Item -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Top Penggunaan Item</h2>
                        <div class="h-64">
                            <canvas id="usageChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Inventory Per Kategori -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Inventory Per Kategori</h2>
                        <div class="h-64">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Tren Jumlah Stok -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tren Jumlah Stok</h2>
                        <div class="h-64">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Inventory Table -->
                <div class="bg-white rounded-2xl shadow-lg mb-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Item ID</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Nama Item</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Kategori</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Jumlah Stok</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Satuan</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Stok Terakhir</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Harga</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Supplier</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Status</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="inventoryTableBody">
                                <?php if(isset($inventory_items) && count($inventory_items) > 0): ?>
                                    <?php foreach($inventory_items as $item): ?>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50" data-id="<?= $item->id_inventori ?>">
                                            <td class="text-center py-5 px-3 text-gray-600 text-sm">#INV<?= str_pad($item->id_inventori, 3, '0', STR_PAD_LEFT) ?></td>
                                            <td class="text-center py-5 px-3 text-gray-800 text-sm font-medium"><?= htmlspecialchars($item->nama_item) ?></td>
                                            <td class="text-center py-5 px-3 text-gray-600 text-sm"><?= ucfirst(htmlspecialchars($item->jenis_item)) ?></td>
                                            <td class="text-center py-5 px-3 text-gray-600 text-sm"><?= $item->stok_tersedia ?></td>
                                            <td class="text-center py-5 px-3 text-gray-600 text-sm"><?= $item->stok_minimal ?></td>
                                            <td class="text-center py-5 px-3 text-gray-600 text-sm"><?= ucfirst(htmlspecialchars($item->satuan)) ?></td>
                                            <td class="text-center py-5 px-3 text-gray-600 text-sm">
                                                <?= ($item->harga_satuan !== null && $item->harga_satuan !== '') ? 'Rp ' . number_format((float)$item->harga_satuan, 0, ',', '.') : '-' ?>
                                            </td>
                                            <td class="text-center py-5 px-3">
                                                <?php 
                                                    if($item->stok_tersedia == 0) {
                                                        echo '<span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-medium">Out Of Stock</span>';
                                                    } elseif($item->stok_tersedia <= $item->stok_minimal) {
                                                        echo '<span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-medium">Low Stock</span>';
                                                    } else {
                                                        echo '<span class="bg-emerald-500/20 text-emerald-500 px-3 py-1 rounded-full text-xs font-medium">Available</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center py-5 px-3">
                                                <div class="flex items-center justify-center gap-2">
                                                    <button onclick="viewItem(<?= $item->id_inventori ?>)" class="text-emerald-500 hover:text-emerald-600 p-2" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button onclick="editItem(<?= $item->id_inventori ?>)" class="text-blue-600 hover:text-blue-700 p-2" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button onclick="deleteItem(<?= $item->id_inventori ?>, '<?= htmlspecialchars($item->nama_item) ?>')" class="text-red-600 hover:text-red-700 p-2" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="10" class="text-center py-8 text-gray-500">Tidak ada data inventory</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Add/Edit Item -->
    <div id="itemModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <h2 id="modalTitle" class="text-2xl font-semibold text-gray-800">Tambah Item Baru</h2>
            </div>
            <form id="itemForm" class="p-6">
                <input type="hidden" id="itemId" name="id_inventori">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Item *</label>
                        <input type="text" id="nama_item" name="nama_item" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                        <select id="jenis_item" name="jenis_item" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                            <option value="">Pilih Kategori</option>
                            <option value="bahan">Bahan</option>
                            <option value="alat">Alat</option>
                            <option value="perlengkapan">Perlengkapan</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Satuan *</label>
                        <input type="text" id="satuan" name="satuan" required placeholder="Contoh: pcs, liter, kg"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cabang *</label>
                        <select id="id_cabang" name="id_cabang" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                            <option value="">Pilih Cabang</option>
                            <?php if(isset($branches)): ?>
                                <?php foreach($branches as $branch): ?>
                                    <option value="<?= $branch->id_cabang ?>"><?= htmlspecialchars($branch->nama_cabang) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stok Minimal *</label>
                        <input type="number" id="stok_minimal" name="stok_minimal" required min="0"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stok Tersedia</label>
                        <input type="number" id="stok_tersedia" name="stok_tersedia" min="0" value="0"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga Satuan</label>
                        <input type="number" id="harga_satuan" name="harga_satuan" min="0" step="0.01"
                               placeholder="Masukkan harga (contoh: 10000)"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="3"
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

    <!-- Modal View Item -->
    <div id="viewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800">Detail Item</h2>
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
    
    let usageChart, categoryChart, trendChart;
    
    // helper format rupiah
    function formatRupiah(value) {
        if (value === null || value === undefined || value === '') return '-';
        const num = Number(value);
        if (isNaN(num)) return '-';
        return 'Rp ' + num.toLocaleString('id-ID', {minimumFractionDigits: 0});
    }

    // Search functionality
    $('#searchInput').on('keyup', function() {
        loadInventory();
    });
    
    // Category filter
    $('#categoryFilter').on('change', function() {
        loadInventory();
    });
    
    // Load inventory data
    function loadInventory() {
        const search = $('#searchInput').val();
        const category = $('#categoryFilter').val();
        
        $.ajax({
            url: BASE_URL + 'pemilik/inventori/get_inventory',
            type: 'POST',
            data: { search: search, category: category },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    updateTable(response.data);
                }
            },
            error: function(xhr, status, err) {
                console.error('Error loading inventory:', err);
            }
        });
    }
    
    // Load chart data
    function loadChartData() {
        $.ajax({
            url: BASE_URL + 'pemilik/inventori/get_chart_data',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('Chart data response:', response);
                if(response.success && response.data) {
                    updateCharts(response.data);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading chart data:', error, xhr.responseText);
            }
        });
    }
    
    // Update table with data
    function updateTable(items) {
        let html = '';
        
        if(items.length > 0) {
            items.forEach(item => {
                let status = '';
                if(item.stok_tersedia == 0) {
                    status = '<span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-medium">Out Of Stock</span>';
                } else if(item.stok_tersedia <= item.stok_minimal) {
                    status = '<span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-medium">Low Stock</span>';
                } else {
                    status = '<span class="bg-emerald-500/20 text-emerald-500 px-3 py-1 rounded-full text-xs font-medium">Available</span>';
                }
                
                let lastUpdate = item.updated_at ? new Date(item.updated_at).toLocaleDateString('id-ID') : (item.created_at ? new Date(item.created_at).toLocaleDateString('id-ID') : '-');
                let harga = item.harga_satuan !== null && item.harga_satuan !== undefined && item.harga_satuan !== '' 
                    ? 'Rp ' + Number(item.harga_satuan).toLocaleString('id-ID')
                    : '-';
                let supplier = item.nama_cabang || '-';
                
                html += `
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="text-center py-5 px-3 text-gray-600 text-sm">#INV${String(item.id_inventori).padStart(3, '0')}</td>
                        <td class="text-center py-5 px-3 text-gray-800 text-sm font-medium">${item.nama_item}</td>
                        <td class="text-center py-5 px-3 text-gray-600 text-sm">${item.jenis_item}</td>
                        <td class="text-center py-5 px-3 text-gray-600 text-sm">${item.stok_tersedia}</td>
                        <td class="text-center py-5 px-3 text-gray-600 text-sm">${item.satuan}</td>
                        <td class="text-center py-5 px-3 text-gray-600 text-sm">${lastUpdate}</td>
                        <td class="text-center py-5 px-3 text-gray-600 text-sm font-medium">${harga}</td>
                        <td class="text-center py-5 px-3 text-gray-600 text-sm">${supplier}</td>
                        <td class="text-center py-5 px-3">${status}</td>
                        <td class="text-center py-5 px-3">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewItem(${item.id_inventori})" class="text-emerald-500 hover:text-emerald-600 p-2" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editItem(${item.id_inventori})" class="text-blue-600 hover:text-blue-700 p-2" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteItem(${item.id_inventori}, '${item.nama_item.replace(/'/g, "\\'")}')" class="text-red-600 hover:text-red-700 p-2" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        } else {
            html = '<tr><td colspan="10" class="text-center py-8 text-gray-500">Tidak ada data inventory</td></tr>';
        }
        
        $('#inventoryTableBody').html(html);
    }
    
    // Update charts with real data
    function updateCharts(data) {
        console.log('updateCharts called with data:', data);
        // Expected data format:
        // { top_items: [{nama_item, stok_tersedia, harga_satuan}], category_data: [{jenis_item, total}], stock_trend: [{jenis_item, avg_stock, count, avg_price}] }
        
        if(!data) {
            console.error('No data provided to updateCharts');
            return;
        }
        
        updateUsageChart(data.top_items || []);
        updateCategoryChart(data.category_data || []);
        updateTrendChart(data.stock_trend || []);
    }
    
    // Update usage chart (top items by stok)
    function updateUsageChart(items) {
        console.log('updateUsageChart with items:', items);
        
        if(!items || items.length === 0) {
            console.log('No items data, using placeholder');
            items = [];
        }
        
        const labels = items.map(item => item.nama_item || 'Unknown');
        const dataValues = items.map(item => Number(item.stok_tersedia) || 0);
        
        console.log('Chart labels:', labels, 'values:', dataValues);
        
        if (usageChart) {
            usageChart.data.labels = labels;
            usageChart.data.datasets[0].data = dataValues;
            usageChart.update();
        } else {
            const usageCtx = document.getElementById('usageChart');
            if(!usageCtx) {
                console.error('usageChart canvas not found');
                return;
            }
            usageChart = new Chart(usageCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels.length > 0 ? labels : ['No Data'],
                    datasets: [{
                        label: 'Stok Tersedia',
                        data: dataValues.length > 0 ? dataValues : [0],
                        backgroundColor: '#10b981',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: { legend: { display: true } },
                    scales: {
                        y: { beginAtZero: true, ticks: { font: { size: 10 } }, grid: { color: '#e5e7eb' } },
                        x: { ticks: { font: { size: 10 } }, grid: { display: false } }
                    }
                }
            });
        }
    }
    
    // Update category chart
    function updateCategoryChart(categories) {
        console.log('updateCategoryChart with categories:', categories);
        
        if(!categories || categories.length === 0) {
            categories = [];
        }
        
        const labels = categories.map(cat => cat.jenis_item || 'Unknown');
        const dataValues = categories.map(cat => Number(cat.total) || 0);
        const colors = ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0', '#0f766e', '#047857'];
        
        if (categoryChart) {
            categoryChart.data.labels = labels;
            categoryChart.data.datasets[0].data = dataValues;
            categoryChart.data.datasets[0].backgroundColor = colors.slice(0, labels.length);
            categoryChart.update();
        } else {
            const categoryCtx = document.getElementById('categoryChart');
            if(!categoryCtx) {
                console.error('categoryChart canvas not found');
                return;
            }
            categoryChart = new Chart(categoryCtx.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: labels.length > 0 ? labels : ['No Data'],
                    datasets: [{
                        data: dataValues.length > 0 ? dataValues : [1],
                        backgroundColor: colors.slice(0, Math.max(labels.length, 1)),
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: { position: 'bottom', labels: { font: { size: 11 }, padding: 10, boxWidth: 12 } }
                    }
                }
            });
        }
    }
    
    // Update trend chart (avg_stock and optionally avg_price per category)
    function updateTrendChart(trend) {
        console.log('updateTrendChart with trend:', trend);
        
        if(!trend || trend.length === 0) {
            trend = [];
        }
        
        const labels = trend.map(item => item.jenis_item || 'Unknown');
        const avgStockData = trend.map(item => Number(item.avg_stock) || 0);
        const countData = trend.map(item => Number(item.count) || 0);
        const avgPriceData = trend.map(item => Number(item.avg_price) || 0);

        if (trendChart) {
            trendChart.data.labels = labels;
            trendChart.data.datasets[0].data = avgStockData;
            if (trendChart.data.datasets[1]) trendChart.data.datasets[1].data = countData;
            if (trendChart.data.datasets[2]) trendChart.data.datasets[2].data = avgPriceData;
            trendChart.update();
        } else {
            const trendCtx = document.getElementById('trendChart');
            if(!trendCtx) {
                console.error('trendChart canvas not found');
                return;
            }
            trendChart = new Chart(trendCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: labels.length > 0 ? labels : ['No Data'],
                    datasets: [
                        {
                            label: 'Rata-rata Stok',
                            data: avgStockData.length > 0 ? avgStockData : [0],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Jumlah Item',
                            data: countData.length > 0 ? countData : [0],
                            borderColor: '#facc15',
                            backgroundColor: 'rgba(250, 204, 21, 0.1)',
                            tension: 0.4,
                            fill: true,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Harga Rata-rata (Rp)',
                            data: avgPriceData.length > 0 ? avgPriceData : [0],
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59,130,246,0.08)',
                            tension: 0.4,
                            fill: false,
                            yAxisID: 'yPrice',
                            hidden: avgPriceData.every(v => v === 0)
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: { legend: { position: 'bottom', labels: { font: { size: 10, weight: 'bold' }, padding: 10, boxWidth: 12 } } },
                    scales: {
                        y: { beginAtZero: true, ticks: { font: { size: 10 } }, grid: { color: '#e5e7eb' } },
                        yPrice: {
                            position: 'right',
                            beginAtZero: true,
                            ticks: { callback: function(value){ return 'Rp ' + Number(value).toLocaleString('id-ID'); } }
                        },
                        x: { ticks: { font: { size: 10 } }, grid: { display: false } }
                    }
                }
            });
        }
    }
    
    // Open add modal
    function openAddModal() {
        $('#modalTitle').text('Tambah Item Baru');
        $('#itemForm')[0].reset();
        $('#itemId').val('');
        $('#itemModal').removeClass('hidden');
    }
    
    // Close modal
    function closeModal() {
        $('#itemModal').addClass('hidden');
    }
    
    // Close view modal
    function closeViewModal() {
        $('#viewModal').addClass('hidden');
    }
    
    // Form submit handler (add/update)
    $('#itemForm').on('submit', function(e) {
        e.preventDefault();
        
        const id = $('#itemId').val();
        const url = id ? BASE_URL + 'pemilik/inventori/update/' + id : BASE_URL + 'pemilik/inventori/add';
        
        // Use FormData to ensure harga_satuan with decimals are preserved
        const formData = new FormData(this);
        
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    alert(response.message);
                    closeModal();
                    // update table & charts without reload
                    loadInventory();
                    loadChartData();
                } else {
                    alert(response.message || 'Gagal menyimpan data');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + (xhr.responseText || error));
            }
        });
    });
    
    // View item details
    function viewItem(id) {
        $.ajax({
            url: BASE_URL + 'pemilik/inventori/get_item/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    const item = response.data;
                    let harga = item.harga_satuan ? formatRupiah(item.harga_satuan) : '-';
                    
                    let html = `
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">ID:</span>
                                <span class="font-medium">#INV${String(item.id_inventori).padStart(3, '0')}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nama Item:</span>
                                <span class="font-medium">${item.nama_item}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kategori:</span>
                                <span class="font-medium">${item.jenis_item}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Satuan:</span>
                                <span class="font-medium">${item.satuan}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Stok Tersedia:</span>
                                <span class="font-medium">${item.stok_tersedia}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Stok Minimal:</span>
                                <span class="font-medium">${item.stok_minimal}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Harga Satuan:</span>
                                <span class="font-medium">${harga}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Cabang:</span>
                                <span class="font-medium">${item.nama_cabang || '-'}</span>
                            </div>
                            ${item.keterangan ? `
                            <div>
                                <span class="text-gray-600 block mb-1">Keterangan:</span>
                                <p class="text-sm text-gray-800">${item.keterangan}</p>
                            </div>
                            ` : ''}
                        </div>
                    `;
                    
                    $('#viewContent').html(html);
                    $('#viewModal').removeClass('hidden');
                } else {
                    alert('Data tidak ditemukan');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data');
            }
        });
    }
    
    // Edit item
    function editItem(id) {
        $.ajax({
            url: BASE_URL + 'pemilik/inventori/get_item/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    const item = response.data;
                    $('#modalTitle').text('Edit Item');
                    $('#itemId').val(item.id_inventori);
                    $('#nama_item').val(item.nama_item);
                    $('#jenis_item').val(item.jenis_item);
                    $('#satuan').val(item.satuan);
                    $('#id_cabang').val(item.id_cabang);
                    $('#stok_minimal').val(item.stok_minimal);
                    $('#stok_tersedia').val(item.stok_tersedia);
                    $('#harga_satuan').val(item.harga_satuan);
                    $('#keterangan').val(item.keterangan);
                    $('#itemModal').removeClass('hidden');
                } else {
                    alert('Data tidak ditemukan');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data');
            }
        });
    }
    
    // Delete item
    function deleteItem(id, namaItem) {
        if(confirm('Apakah Anda yakin ingin menghapus "' + namaItem + '"?')) {
            $.ajax({
                url: BASE_URL + 'pemilik/inventori/delete/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        alert(response.message);
                        // update charts & table
                        loadChartData();
                        loadInventory();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus data');
                }
            });
        }
    }
    
    // Initialize on page load
    $(document).ready(function() {
        console.log('Page ready, loading charts and inventory');
        loadChartData();
        loadInventory();
    });
</script>
</script>
</body>
</html>