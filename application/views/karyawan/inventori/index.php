<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory - KixEra</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>
<body class="bg-gray-50">
<!-- Main Content -->
<main class="flex-1 ml-64">

    <!-- Topbar -->
    <div class="bg-white shadow-sm px-6 py-4 sticky top-0 z-10">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Input Data Inventory</h1>
                <p class="text-sm text-gray-500 mt-1">Tambah dan kelola stok barang inventory</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <input type="text" id="searchInput" placeholder="Cari barang..." 
                    class="border border-gray-300 px-4 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <select class="border border-gray-300 px-4 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>Semua Cabang</option>
                    <option>Cabang A</option>
                    <option>Cabang B</option>
                </select>
            </div>
        </div>
    </div>

    <div class="p-6">

        <!-- Flash Messages -->
        <?php if($this->session->flashdata('success')): ?>
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center shadow-sm animate-fade-in">
            <i class="fas fa-check-circle mr-3 text-xl"></i>
            <div>
                <p class="font-semibold">Berhasil!</p>
                <p class="text-sm"><?= $this->session->flashdata('success') ?></p>
            </div>
        </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-lg mb-6 flex items-center shadow-sm animate-fade-in">
            <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
            <div>
                <p class="font-semibold">Error!</p>
                <p class="text-sm"><?= $this->session->flashdata('error') ?></p>
            </div>
        </div>
        <?php endif; ?>

        <!-- Form Input -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-plus-circle text-emerald-600"></i>
                    </div>
                    Form Input Inventory
                </h2>
            </div>

            <form method="POST" action="<?= base_url('karyawan/inventori/save') ?>" id="formInventory">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Barang -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            Nama Barang <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text"
                            name="nama_item" 
                            class="input" 
                            placeholder="Contoh: Sabun Cair Premium" 
                            required
                            autocomplete="off">
                    </div>

                    <!-- Jumlah Masuk -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            Jumlah Masuk <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="stok_masuk" 
                            class="input" 
                            min="1" 
                            placeholder="0" 
                            required>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_item" class="input" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php if(isset($categories) && is_array($categories)): ?>
                                <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat ?>"><?= $cat ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Satuan -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            Satuan <span class="text-red-500">*</span>
                        </label>
                        <select name="satuan" class="input" required>
                            <option value="">-- Pilih Satuan --</option>
                            <?php if(isset($units) && is_array($units)): ?>
                                <?php foreach($units as $unit): ?>
                                <option value="<?= $unit ?>"><?= $unit ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Cabang -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            Cabang <span class="text-red-500">*</span>
                        </label>
                        <select name="id_cabang" class="input" required>
                            <option value="">-- Pilih Cabang --</option>
                            <?php if(isset($branches) && !empty($branches)): ?>
                                <?php foreach($branches as $branch): ?>
                                <option value="<?= $branch->id_cabang ?>"><?= $branch->nama_cabang ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="tanggal_masuk" 
                            class="input" 
                            value="<?= date('Y-m-d') ?>" 
                            max="<?= date('Y-m-d') ?>"
                            required>
                    </div>
                    
                    <!-- Harga Satuan -->
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            Harga Satuan (Opsional)
                        </label>
                        <input 
                            type="number" 
                            name="harga_satuan" 
                            class="input" 
                            min="0" 
                            placeholder="Masukkan harga satuan (Rp)">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-wrap gap-3 pt-6 border-t border-gray-100">
                    <button 
                        type="submit" 
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-lg transition flex items-center gap-2 shadow-sm font-medium">
                        <i class="fas fa-save"></i>
                        <span>Simpan Data</span>
                    </button>
                    <button 
                        type="reset" 
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg transition flex items-center gap-2 shadow-sm font-medium">
                        <i class="fas fa-redo"></i>
                        <span>Reset</span>
                    </button>
                    <button 
                        type="button"
                        onclick="window.location.href='<?= base_url('karyawan/inventori/lihat_stok') ?>'" 
                        class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-6 py-2.5 rounded-lg transition flex items-center gap-2 border border-emerald-200 font-medium">
                        <i class="fas fa-boxes"></i>
                        <span>Lihat Stok</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1 font-medium">Total Item</p>
                        <p class="text-3xl font-bold text-gray-800"><?= isset($stats['total']) ? $stats['total'] : 0 ?></p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl">
                        <i class="fas fa-box text-blue-600 text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1 font-medium">Tersedia</p>
                        <p class="text-3xl font-bold text-green-600"><?= isset($stats['available']) ? $stats['available'] : 0 ?></p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-xl">
                        <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1 font-medium">Stok Rendah</p>
                        <p class="text-3xl font-bold text-yellow-600"><?= isset($stats['low_stock']) ? $stats['low_stock'] : 0 ?></p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-xl">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1 font-medium">Habis</p>
                        <p class="text-3xl font-bold text-red-600"><?= isset($stats['out_of_stock']) ? $stats['out_of_stock'] : 0 ?></p>
                    </div>
                    <div class="bg-red-50 p-4 rounded-xl">
                        <i class="fas fa-times-circle text-red-600 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Kategori Barang Terbanyak -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-100">
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-bar text-emerald-600"></i>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        Barang Paling Sering Digunakan Minggu Ini
                    </h2>
                </div>
                <p class="text-sm text-gray-500 ml-10">Berdasarkan perbandingan stok tersedia dengan stok minimal</p>
            </div>
            
            <div style="position: relative; height: 400px;">
                <canvas id="itemUsageChart"></canvas>
            </div>
        </div>

        <!-- Table Inventory Terbaru -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-history text-emerald-600"></i>
                    </div>
                    Inventory Terbaru
                </h2>
                <div class="flex flex-wrap gap-2">
                    <button class="text-sm text-gray-600 hover:text-emerald-600 px-4 py-2 rounded-lg border border-gray-300 hover:border-emerald-600 transition font-medium">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                    <button class="text-sm text-gray-600 hover:text-emerald-600 px-4 py-2 rounded-lg border border-gray-300 hover:border-emerald-600 transition font-medium">
                        <i class="fas fa-download mr-2"></i>Export
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama Barang</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700">Stok</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Satuan</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Cabang</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal Update</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTableBody">
                    <?php if(isset($recent_inventory) && !empty($recent_inventory)): ?>
                        <?php foreach($recent_inventory as $item): ?>
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-4 py-3 font-medium text-gray-800"><?= $item->nama_item ?></td>
                            <td class="px-4 py-3">
                                <span class="badge"><?= $item->jenis_item ?></span>
                            </td>
                            <td class="px-4 py-3 text-center font-semibold">
                                <?php if($item->stok_tersedia <= 0): ?>
                                    <span class="text-red-600"><?= $item->stok_tersedia ?></span>
                                <?php elseif($item->stok_tersedia <= $item->stok_minimal): ?>
                                    <span class="text-yellow-600"><?= $item->stok_tersedia ?></span>
                                <?php else: ?>
                                    <span class="text-green-600"><?= $item->stok_tersedia ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-gray-600"><?= $item->satuan ?></td>
                            <td class="px-4 py-3 text-gray-600"><?= isset($item->nama_cabang) ? $item->nama_cabang : '-' ?></td>
                            <td class="px-4 py-3 text-gray-600"><?= isset($item->updated_at) ? date('d/m/Y H:i', strtotime($item->updated_at)) : '-' ?></td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-3">
                                    <button 
                                        onclick="openEditModal(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>)"
                                        class="text-blue-600 hover:text-blue-800 transition" 
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a 
                                        href="<?= base_url('inventori/delete/'.$item->id_inventori) ?>" 
                                        onclick="return confirm('Yakin ingin menghapus <?= $item->nama_item ?>?')"
                                        class="text-red-600 hover:text-red-800 transition" 
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-4 py-16 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-inbox text-6xl mb-4 text-gray-300"></i>
                                    <p class="font-semibold text-lg mb-1">Belum ada data inventory</p>
                                    <p class="text-sm">Tambahkan inventory pertama Anda menggunakan form di atas</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<!-- Modal Edit -->
<div id="editModal" class="modal-overlay hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-edit text-emerald-600"></i>
                </div>
                Edit Inventory
            </h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form method="POST" action="<?= base_url('karyawan/inventori/update') ?>" id="formEdit">
            <input type="hidden" name="id_inventori" id="edit_id">
            
            <div class="modal-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Nama Barang *</label>
                        <input type="text" name="nama_item" id="edit_nama" class="input" required>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Stok Tersedia *</label>
                        <input type="number" name="stok_tersedia" id="edit_stok" class="input" min="0" required>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Kategori *</label>
                        <select name="jenis_item" id="edit_kategori" class="input" required>
                            <?php if(isset($categories)): foreach($categories as $cat): ?>
                            <option value="<?= $cat ?>"><?= $cat ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Satuan *</label>
                        <select name="satuan" id="edit_satuan" class="input" required>
                            <?php if(isset($units)): foreach($units as $unit): ?>
                            <option value="<?= $unit ?>"><?= $unit ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Cabang *</label>
                        <select name="id_cabang" id="edit_cabang" class="input" required>
                            <?php if(isset($branches)): foreach($branches as $branch): ?>
                            <option value="<?= $branch->id_cabang ?>"><?= $branch->nama_cabang ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Stok Minimal *</label>
                        <input type="number" name="stok_minimal" id="edit_minimal" class="input" min="0" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Harga Satuan</label>
                        <input type="number" name="harga_satuan" id="edit_harga" class="input" min="0">
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-lg transition font-medium">
                    Batal
                </button>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg transition font-medium">
                    <i class="fas fa-save mr-2"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>
<script>
// Auto-hide flash messages after 5 seconds
setTimeout(function() {
    const alerts = document.querySelectorAll('.animate-fade-in');
    alerts.forEach(alert => {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.5s';
        setTimeout(() => alert.remove(), 500);
    });
}, 5000);

// Form validation
document.getElementById('formInventory').addEventListener('submit', function(e) {
    const stokMasuk = document.querySelector('input[name="stok_masuk"]').value;
    if (stokMasuk < 1) {
        e.preventDefault();
        alert('Jumlah masuk harus lebih dari 0!');
        return false;
    }
});

// Modal Functions
function openEditModal(item) {
    document.getElementById('edit_id').value = item.id_inventori;
    document.getElementById('edit_nama').value = item.nama_item;
    document.getElementById('edit_stok').value = item.stok_tersedia;
    document.getElementById('edit_kategori').value = item.jenis_item;
    document.getElementById('edit_satuan').value = item.satuan;
    document.getElementById('edit_cabang').value = item.id_cabang;
    document.getElementById('edit_minimal').value = item.stok_minimal;
    document.getElementById('edit_harga').value = item.harga_satuan || 0;
    
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeEditModal();
    }
});

// Search Function
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchText = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#inventoryTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchText) ? '' : 'none';
    });
});

// Inisialisasi Chart
document.addEventListener('DOMContentLoaded', function() {
    // Ambil data dari PHP
    const chartData = <?= json_encode($items_by_category ?? []) ?>;
    
    console.log('=== DEBUG CHART DATA ===');
    console.log('Raw Data:', chartData);
    console.log('Data Length:', chartData ? chartData.length : 0);
    console.log('========================');
    
    // Jika tidak ada data, tampilkan pesan
    if (!chartData || chartData.length === 0) {
        const canvas = document.getElementById('itemUsageChart');
        const parent = canvas.parentElement;
        parent.innerHTML = `
            <div class="flex flex-col items-center justify-center h-full py-12">
                <i class="fas fa-chart-bar text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 font-semibold text-lg mb-2">Belum ada data untuk ditampilkan</p>
                <p class="text-gray-400 text-sm">Tambahkan inventory dengan stok minimal terlebih dahulu</p>
            </div>
        `;
        return;
    }
    
    // Prepare data untuk Chart.js - Prioritas nama_item
    const labels = chartData.map(item => {
        return item.nama_item || item.jenis_item || 'Unknown';
    });
    const dataValues = chartData.map(item => parseInt(item.total_used || item.total || 0));
    
    console.log('Labels (Nama Barang):', labels);
    console.log('Values (Tingkat Penggunaan):', dataValues);
    
    // Validasi data values
    const hasValidData = dataValues.some(val => val > 0);
    if (!hasValidData) {
        const canvas = document.getElementById('itemUsageChart');
        const parent = canvas.parentElement;
        parent.innerHTML = `
            <div class="flex flex-col items-center justify-center h-full py-12">
                <i class="fas fa-info-circle text-blue-400 text-6xl mb-4"></i>
                <p class="text-gray-500 font-semibold text-lg mb-2">Data inventory ditemukan, tapi belum ada yang memenuhi kriteria</p>
                <p class="text-gray-400 text-sm">Pastikan item memiliki stok minimal yang terisi</p>
            </div>
        `;
        return;
    }
    
    // Create gradient
    const ctx = document.getElementById('itemUsageChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, '#10b981');
    gradient.addColorStop(1, 'rgba(134, 239, 172, 0.6)');
    
    // Create chart
    const itemUsageChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tingkat Penggunaan',
                data: dataValues,
                backgroundColor: gradient,
                borderRadius: 8,
                maxBarThickness: 80
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'white',
                    titleColor: '#1f2937',
                    bodyColor: '#6b7280',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Tingkat Penggunaan: ' + context.parsed.y + '%';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10,
                        color: '#6b7280',
                        font: {
                            size: 12
                        },
                        callback: function(value) {
                            return value + '%';
                        }
                    },
                    grid: {
                        color: '#f3f4f6',
                        drawBorder: false
                    },
                    title: {
                        display: true,
                        text: 'Tingkat Penggunaan (%)',
                        color: '#6b7280',
                        font: {
                            size: 12,
                            weight: 'normal'
                        }
                    }
                },
                x: {
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 11
                        },
                        maxRotation: 45,
                        minRotation: 45
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
    
    console.log('✅ Chart berhasil dibuat!');
});
</script>
</body>
</html>