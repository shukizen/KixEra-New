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
    <div class="bg-white shadow-lg px-6 py-4 sticky top-0 z-10">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Input Data Inventory</h1>
                <p class="text-sm text-gray-500 mt-1">Tambah dan kelola stok barang inventory</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari barang..." 
                        class="w-64 pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
                <select id="branchFilter" class="px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                    <option value="">Semua Cabang</option>
                    <?php if(isset($branches) && !empty($branches)): ?>
                        <?php foreach($branches as $branch): ?>
                        <option value="<?= $branch->id_cabang ?>"><?= $branch->nama_cabang ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
    </div>

    <!-- Form Input -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-plus-circle text-emerald-600"></i>
                </div>
                Form Input Inventory
            </h2>
        </div>

        <form method="POST" action="<?= base_url('karyawan/inventori/save') ?>" id="formInventory">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- Nama Barang -->
                <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            Nama Barang <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text"
                            name="nama_item" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
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
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                            min="1" 
                            placeholder="0" 
                            required>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" required>
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
                        <select name="satuan" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" required>
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
                        <select name="id_cabang" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" required>
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
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                            value="<?= date('Y-m-d') ?>" 
                            max="<?= date('Y-m-d') ?>"
                            required>
                    </div>
                    
                    <!-- Harga Satuan -->
                    <div class="lg:col-span-3">
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            Harga Satuan (Opsional)
                        </label>
                        <input 
                            type="number" 
                            name="harga_satuan" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                            min="0" 
                            placeholder="Masukkan harga satuan (Rp)">
                    </div>
                    
                    <!-- Keterangan -->
                    <div class="lg:col-span-3">
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            Keterangan (Opsional)
                        </label>
                        <textarea 
                            name="keterangan" 
                            rows="2"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                            placeholder="Masukkan keterangan atau catatan"></textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex flex-wrap gap-3 pt-5 border-t border-gray-100">
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


        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Chart: Barang Paling Sering Digunakan (Bar Chart) -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="mb-4">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-bar text-emerald-600"></i>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-800">Barang Paling Sering Digunakan</h2>
                    </div>
                    <p class="text-sm text-gray-500 ml-10">Item inventory dengan penggunaan tertinggi</p>
                </div>
                <div class="relative h-72">
                    <canvas id="itemUsageChart"></canvas>
                </div>
            </div>

            <!-- Chart: Distribusi Kategori (Doughnut Chart) -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="mb-4">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-pie text-teal-600"></i>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-800">Distribusi Kategori</h2>
                    </div>
                    <p class="text-sm text-gray-500 ml-10">Persentase item berdasarkan kategori</p>
                </div>
                <div class="relative h-72">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Table Inventory Terbaru -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-history text-emerald-600"></i>
                    </div>
                    Inventory Terbaru
                </h2>
                <div class="flex flex-wrap gap-2">
                    <button onclick="exportData()" class="text-sm text-gray-600 hover:text-emerald-600 px-4 py-2 rounded-lg border border-gray-300 hover:border-emerald-600 transition font-medium">
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
                        <tr class="border-t hover:bg-gray-50 transition" data-branch="<?= $item->id_cabang ?>" data-branch-name="<?= isset($item->nama_cabang) ? htmlspecialchars($item->nama_cabang) : '' ?>">
                            <td class="px-4 py-3 font-medium text-gray-800"><?= htmlspecialchars($item->nama_item) ?></td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-emerald-100 text-emerald-700"><?= htmlspecialchars($item->jenis_item) ?></span>
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
                            <td class="px-4 py-3 text-gray-600"><?= htmlspecialchars($item->satuan) ?></td>
                            <td class="px-4 py-3 text-gray-600"><?= isset($item->nama_cabang) ? htmlspecialchars($item->nama_cabang) : '-' ?></td>
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
                                        href="<?= base_url('karyawan/inventori/delete/'.$item->id_inventori) ?>" 
                                        onclick="return confirm('Yakin ingin menghapus <?= htmlspecialchars($item->nama_item) ?>?')"
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
<div id="editModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
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
        
        <form method="POST" action="<?= site_url('karyawan/inventori/update') ?>" id="formEdit">
            <input type="hidden" name="id_inventori" id="edit_id">
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Nama Barang *</label>
                        <input type="text" name="nama_item" id="edit_nama" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Stok Tersedia *</label>
                        <input type="number" name="stok_tersedia" id="edit_stok" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" min="0" required>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Kategori *</label>
                        <select name="jenis_item" id="edit_kategori" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            <?php if(isset($categories)): foreach($categories as $cat): ?>
                            <option value="<?= $cat ?>"><?= $cat ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Satuan *</label>
                        <select name="satuan" id="edit_satuan" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            <?php if(isset($units)): foreach($units as $unit): ?>
                            <option value="<?= $unit ?>"><?= $unit ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Cabang *</label>
                        <select name="id_cabang" id="edit_cabang" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            <?php if(isset($branches)): foreach($branches as $branch): ?>
                            <option value="<?= $branch->id_cabang ?>"><?= $branch->nama_cabang ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Stok Minimal *</label>
                        <input type="number" name="stok_minimal" id="edit_minimal" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" min="0" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-gray-700 block mb-2">Harga Satuan</label>
                        <input type="number" name="harga_satuan" id="edit_harga" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" min="0">
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50">
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
    const flashSuccess = document.getElementById('flashSuccess');
    const flashError = document.getElementById('flashError');
    if (flashSuccess) {
        flashSuccess.style.opacity = '0';
        flashSuccess.style.transition = 'opacity 0.5s';
        setTimeout(() => flashSuccess.remove(), 500);
    }
    if (flashError) {
        flashError.style.opacity = '0';
        flashError.style.transition = 'opacity 0.5s';
        setTimeout(() => flashError.remove(), 500);
    }
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
    
    const modal = document.getElementById('editModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
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

// Search and Filter Functions
let currentSearch = '';
let currentBranch = '';

function applyFilters() {
    const rows = document.querySelectorAll('#inventoryTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const branchId = row.getAttribute('data-branch');
        
        const matchesSearch = currentSearch === '' || text.includes(currentSearch);
        const matchesBranch = currentBranch === '' || branchId === currentBranch;
        
        row.style.display = (matchesSearch && matchesBranch) ? '' : 'none';
    });
}

// Search Function
document.getElementById('searchInput').addEventListener('input', function(e) {
    currentSearch = e.target.value.toLowerCase();
    applyFilters();
});

// Branch Filter Function
document.getElementById('branchFilter').addEventListener('change', function(e) {
    currentBranch = e.target.value;
    applyFilters();
});

// Export Function (placeholder)
function exportData() {
    alert('Fitur export akan segera tersedia!');
}

// Chart Colors
const chartColors = ['#10b981', '#14b8a6', '#0d9488', '#0891b2', '#0284c7'];

// Initialize Charts
document.addEventListener('DOMContentLoaded', function() {
    initUsageChart();
    initCategoryChart();
});

// Chart 1: Item Usage (Bar Chart)
function initUsageChart() {
    const chartData = <?= json_encode($items_by_category ?? []) ?>;
    const canvas = document.getElementById('itemUsageChart');
    
    console.log('Usage Chart Data:', chartData);
    
    if (!canvas) {
        console.error('Canvas element itemUsageChart not found');
        return;
    }
    
    if (!chartData || chartData.length === 0) {
        showChartPlaceholder(canvas, 'Belum ada data untuk ditampilkan');
        return;
    }
    
    const labels = chartData.map(item => item.nama_item || item.jenis_item || 'Unknown');
    const dataValues = chartData.map(item => parseInt(item.total_used || item.total || 0));
    
    if (!dataValues.some(val => val > 0)) {
        showChartPlaceholder(canvas, 'Pastikan item memiliki stok minimal yang terisi');
        return;
    }
    
    const ctx = canvas.getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 280);
    gradient.addColorStop(0, '#10b981');
    gradient.addColorStop(1, 'rgba(134, 239, 172, 0.6)');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tingkat Penggunaan (%)',
                data: dataValues,
                backgroundColor: gradient,
                borderRadius: 6,
                maxBarThickness: 60
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'white',
                    titleColor: '#1f2937',
                    bodyColor: '#6b7280',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    padding: 10,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Penggunaan: ' + context.parsed.y + '%';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: { stepSize: 20, color: '#6b7280', font: { size: 11 } },
                    grid: { color: '#f3f4f6', drawBorder: false }
                },
                x: {
                    ticks: { color: '#6b7280', font: { size: 10 }, maxRotation: 45, minRotation: 45 },
                    grid: { display: false }
                }
            }
        }
    });
}

// Chart 2: Category Distribution (Doughnut Chart)
function initCategoryChart() {
    const categoryData = <?= json_encode($category_distribution ?? []) ?>;
    
    const canvas = document.getElementById('categoryChart');
    
    if (!categoryData || categoryData.length === 0) {
        showChartPlaceholder(canvas, 'Belum ada data kategori');
        return;
    }
    
    const labels = categoryData.map(item => item.jenis_item || 'Lainnya');
    const dataValues = categoryData.map(item => parseInt(item.total || 0));
    
    if (!dataValues.some(val => val > 0)) {
        showChartPlaceholder(canvas, 'Belum ada data kategori');
        return;
    }
    
    const ctx = canvas.getContext('2d');
    
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: dataValues,
                backgroundColor: chartColors.slice(0, labels.length),
                borderWidth: 2,
                borderColor: '#fff',
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: { size: 11 }
                    }
                },
                tooltip: {
                    backgroundColor: 'white',
                    titleColor: '#1f2937',
                    bodyColor: '#6b7280',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    padding: 10,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((context.parsed / total) * 100);
                            return context.label + ': ' + context.parsed + ' item (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
}

// Helper function to show placeholder when no data
function showChartPlaceholder(canvas, message) {
    const parent = canvas.parentElement;
    parent.innerHTML = `
        <div class="flex flex-col items-center justify-center h-full py-8">
            <i class="fas fa-chart-bar text-gray-300 text-5xl mb-3"></i>
            <p class="text-gray-500 font-medium text-sm">${message}</p>
        </div>
    `;
}
</script>
</body>
</html>