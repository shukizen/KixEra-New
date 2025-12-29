<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lihat Stok Inventory - KixEra</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">

<main class="flex-1 ml-64 p-6">

<!-- Page Header -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6 flex justify-between items-center border border-gray-100">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Stok Inventory</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola dan pantau stok inventory</p>
    </div>
    <a href="<?= base_url('karyawan/inventori') ?>" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white px-5 py-2.5 rounded-xl transition-all duration-300 flex items-center gap-2 shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/40 hover:-translate-y-0.5">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali</span>
    </a>
</div>

<!-- Flash Messages -->
<?php if($this->session->flashdata('success')): ?>
<div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 px-5 py-4 rounded-xl mb-4 flex items-center shadow-md">
    <i class="fas fa-check-circle mr-4 text-2xl text-green-500"></i>
    <div>
        <p class="font-semibold">Berhasil!</p>
        <p class="text-sm"><?= $this->session->flashdata('success') ?></p>
    </div>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
<div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-700 px-5 py-4 rounded-xl mb-4 flex items-center shadow-md">
    <i class="fas fa-exclamation-circle mr-4 text-2xl text-red-500"></i>
    <div>
        <p class="font-semibold">Error!</p>
        <p class="text-sm"><?= $this->session->flashdata('error') ?></p>
    </div>
</div>
<?php endif; ?>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Total Item</p>
                <p class="text-3xl font-bold text-gray-800"><?= isset($stats['total']) ? $stats['total'] : 0 ?></p>
            </div>
            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-box text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Tersedia</p>
                <p class="text-3xl font-bold text-green-600"><?= isset($stats['available']) ? $stats['available'] : 0 ?></p>
            </div>
            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Stok Rendah</p>
                <p class="text-3xl font-bold text-yellow-600"><?= isset($stats['low_stock']) ? $stats['low_stock'] : 0 ?></p>
            </div>
            <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Habis</p>
                <p class="text-3xl font-bold text-red-600"><?= isset($stats['out_of_stock']) ? $stats['out_of_stock'] : 0 ?></p>
            </div>
            <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-times-circle text-red-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filter & Search Section -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
            <i class="fas fa-filter text-white"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Filter & Pencarian</h3>
    </div>
    <form method="GET" action="<?= base_url('karyawan/inventori/lihat_stok') ?>" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="text-sm font-medium text-gray-700 block mb-2">
                <i class="fas fa-search mr-1 text-gray-400"></i>Cari Barang
            </label>
            <input type="text" name="search" value="<?= $this->input->get('search') ?>" 
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300 bg-gray-50 hover:bg-white" placeholder="Nama barang...">
        </div>
        
        <div>
            <label class="text-sm font-medium text-gray-700 block mb-2">
                <i class="fas fa-tag mr-1 text-gray-400"></i>Kategori
            </label>
            <select name="category" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300 bg-gray-50 hover:bg-white">
                <option value="">Semua Kategori</option>
                <?php if(isset($categories)): foreach($categories as $cat): ?>
                <option value="<?= $cat ?>" <?= $this->input->get('category') == $cat ? 'selected' : '' ?>>
                    <?= $cat ?>
                </option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        
        <div>
            <label class="text-sm font-medium text-gray-700 block mb-2">
                <i class="fas fa-building mr-1 text-gray-400"></i>Cabang
            </label>
            <select name="cabang" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300 bg-gray-50 hover:bg-white">
                <option value="">Semua Cabang</option>
                <?php if(isset($branches)): foreach($branches as $branch): ?>
                <option value="<?= $branch->id_cabang ?>" <?= $this->input->get('cabang') == $branch->id_cabang ? 'selected' : '' ?>>
                    <?= $branch->nama_cabang ?>
                </option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        
        <div class="flex items-end gap-2">
            <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white px-4 py-3 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/40 font-medium">
                <i class="fas fa-filter"></i>
                <span>Filter</span>
            </button>
            <a href="<?= base_url('karyawan/inventori/lihat_stok') ?>" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-3 rounded-xl transition-all duration-300" title="Reset Filter">
                <i class="fas fa-redo"></i>
            </a>
        </div>
    </form>
</div>

<!-- Category Summary -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-gray-100">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
            <i class="fas fa-chart-pie text-white"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800">Ringkasan per Kategori</h3>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php if(isset($items_by_category) && !empty($items_by_category)): ?>
            <?php foreach($items_by_category as $cat): ?>
            <div class="border-2 border-gray-200 rounded-xl p-5 hover:border-emerald-400 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 bg-gradient-to-br from-white to-gray-50">
                <p class="text-sm text-gray-500 mb-1"><?= $cat->jenis_item ?></p>
                <p class="text-2xl font-bold text-emerald-600"><?= $cat->total ?></p>
                <p class="text-xs text-gray-400">item</p>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-4 text-center text-gray-500 py-8">
                <i class="fas fa-inbox text-4xl mb-3 block opacity-50"></i>
                <p>Belum ada data kategori</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="flex justify-between items-center p-6 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                <i class="fas fa-list text-white"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Daftar Inventory</h2>
        </div>
        <div class="text-sm text-gray-500">
            Total: <span class="font-semibold text-emerald-600"><?= isset($inventory) ? count($inventory) : 0 ?></span> item
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr>
                    <th class="px-5 py-4 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">No</th>
                    <th class="px-5 py-4 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">Nama Barang</th>
                    <th class="px-5 py-4 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">Kategori</th>
                    <th class="px-5 py-4 text-center font-bold text-gray-600 text-xs uppercase tracking-wider">Stok</th>
                    <th class="px-5 py-4 text-center font-bold text-gray-600 text-xs uppercase tracking-wider">Min. Stok</th>
                    <th class="px-5 py-4 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">Satuan</th>
                    <th class="px-5 py-4 text-right font-bold text-gray-600 text-xs uppercase tracking-wider">Harga</th>
                    <th class="px-5 py-4 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">Cabang</th>
                    <th class="px-5 py-4 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">Update</th>
                    <th class="px-5 py-4 text-center font-bold text-gray-600 text-xs uppercase tracking-wider">Status</th>
                    <th class="px-5 py-4 text-center font-bold text-gray-600 text-xs uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($inventory) && !empty($inventory)): ?>
                <?php $no = 1; foreach($inventory as $item): ?>
                <tr class="border-t border-gray-100 hover:bg-gradient-to-r hover:from-emerald-50/50 hover:to-teal-50/50 transition-all duration-200">
                    <td class="px-5 py-4 text-gray-600"><?= $no++ ?></td>
                    <td class="px-5 py-4 font-medium text-gray-800"><?= $item->nama_item ?></td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700"><?= $item->jenis_item ?></span>
                    </td>
                    <td class="px-5 py-4 text-center font-bold">
                        <?php if($item->stok_tersedia <= 0): ?>
                            <span class="text-red-600"><?= $item->stok_tersedia ?></span>
                        <?php elseif($item->stok_tersedia <= $item->stok_minimal): ?>
                            <span class="text-yellow-600"><?= $item->stok_tersedia ?></span>
                        <?php else: ?>
                            <span class="text-green-600"><?= $item->stok_tersedia ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="px-5 py-4 text-center text-gray-500"><?= $item->stok_minimal ?></td>
                    <td class="px-5 py-4 text-gray-600"><?= $item->satuan ?></td>
                    <td class="px-5 py-4 text-right text-gray-700">Rp <?= number_format($item->harga_satuan, 0, ',', '.') ?></td>
                    <td class="px-5 py-4 text-gray-600"><?= isset($item->nama_cabang) ? $item->nama_cabang : '-' ?></td>
                    <td class="px-5 py-4 text-xs text-gray-500">
                        <?= isset($item->updated_at) ? date('d/m/Y H:i', strtotime($item->updated_at)) : '-' ?>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <?php if($item->stok_tersedia <= 0): ?>
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700 uppercase tracking-wide">Habis</span>
                        <?php elseif($item->stok_tersedia <= $item->stok_minimal): ?>
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-700 uppercase tracking-wide">Rendah</span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700 uppercase tracking-wide">Aman</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-5 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <button 
                                onclick="openEditModal(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>)"
                                class="w-9 h-9 bg-blue-100 hover:bg-blue-500 text-blue-600 hover:text-white rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-lg hover:shadow-blue-500/30" 
                                title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="<?= base_url('karyawan/inventori/delete/'.$item->id_inventori) ?>" 
                               onclick="return confirm('Yakin ingin menghapus <?= $item->nama_item ?>?')"
                               class="w-9 h-9 bg-red-100 hover:bg-red-500 text-red-600 hover:text-white rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110 hover:shadow-lg hover:shadow-red-500/30" 
                               title="Hapus">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11" class="px-5 py-16 text-center text-gray-500">
                        <i class="fas fa-inbox text-5xl mb-4 block opacity-30"></i>
                        <p class="font-medium text-lg">Tidak ada data inventory</p>
                        <p class="text-sm mt-1">Gunakan filter atau tambahkan data baru</p>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</main>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <i class="fas fa-edit text-white"></i>
                </div>
                Edit Inventory
            </h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form method="POST" action="<?= base_url('karyawan/inventori/update') ?>" id="formEdit">
            <input type="hidden" name="id_inventori" id="edit_id">
            
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-2">Nama Barang *</label>
                        <input type="text" name="nama_item" id="edit_nama" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300" required>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-2">Stok Tersedia *</label>
                        <input type="number" name="stok_tersedia" id="edit_stok" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300" min="0" required>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-2">Kategori *</label>
                        <select name="jenis_item" id="edit_kategori" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300" required>
                            <?php if(isset($categories)): foreach($categories as $cat): ?>
                            <option value="<?= $cat ?>"><?= $cat ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-2">Satuan *</label>
                        <select name="satuan" id="edit_satuan" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300" required>
                            <option value="Botol">Botol</option>
                            <option value="Kg">Kg</option>
                            <option value="Liter">Liter</option>
                            <option value="Pack">Pack</option>
                            <option value="Box">Box</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Karung">Karung</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-2">Cabang *</label>
                        <select name="id_cabang" id="edit_cabang" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300" required>
                            <?php if(isset($branches)): foreach($branches as $branch): ?>
                            <option value="<?= $branch->id_cabang ?>"><?= $branch->nama_cabang ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-2">Stok Minimal *</label>
                        <input type="number" name="stok_minimal" id="edit_minimal" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300" min="0" required>
                    </div>
                    <div class="col-span-2">
                        <label class="text-sm font-medium text-gray-700 block mb-2">Harga Satuan</label>
                        <input type="number" name="harga_satuan" id="edit_harga" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-300" min="0">
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-2xl">
                <button type="button" onclick="closeEditModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-xl transition-all duration-200 font-medium">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white px-5 py-2.5 rounded-xl transition-all duration-300 font-medium shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/40 flex items-center gap-2">
                    <i class="fas fa-save"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Auto-hide flash messages after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const flashMessages = document.querySelectorAll('[class*="border-l-4"]');
        flashMessages.forEach(msg => {
            msg.style.transition = 'opacity 0.5s, transform 0.5s';
            msg.style.opacity = '0';
            msg.style.transform = 'translateY(-10px)';
            setTimeout(() => msg.remove(), 500);
        });
    }, 5000);
});

// Live Search Function (real-time filtering as you type)
const searchInput = document.querySelector('input[name="search"]');
if (searchInput) {
    searchInput.addEventListener('input', function(e) {
        const searchText = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            if (row.querySelector('td[colspan]')) return; // Skip empty state row
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchText) ? '' : 'none';
        });
    });
}

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

// Confirm delete with better UX
function confirmDelete(nama, url) {
    if (confirm('Yakin ingin menghapus "' + nama + '"?')) {
        window.location.href = url;
    }
    return false;
}
</script>

</body>
</html>