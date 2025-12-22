<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lihat Stok Inventory - KixEra</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Tambahkan Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<body class="bg-gray-50">

<main class="flex-1 ml-64 p-6">

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Stok Inventory</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola dan pantau stok inventory</p>
    </div>
    <a href="<?= base_url('karyawan/inventori') ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg transition flex items-center gap-2 shadow-sm">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali</span>
    </a>
</div>

<!-- Flash Messages -->
<?php if($this->session->flashdata('success')): ?>
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4 flex items-center animate-fade-in">
    <i class="fas fa-check-circle mr-3 text-xl"></i>
    <div>
        <p class="font-medium">Berhasil!</p>
        <p class="text-sm"><?= $this->session->flashdata('success') ?></p>
    </div>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
<div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-4 flex items-center animate-fade-in">
    <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
    <div>
        <p class="font-medium">Error!</p>
        <p class="text-sm"><?= $this->session->flashdata('error') ?></p>
    </div>
</div>
<?php endif; ?>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Total Item</p>
                <p class="text-3xl font-bold text-gray-800"><?= isset($stats['total']) ? $stats['total'] : 0 ?></p>
            </div>
            <div class="bg-blue-100 p-4 rounded-lg">
                <i class="fas fa-box text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Tersedia</p>
                <p class="text-3xl font-bold text-green-600"><?= isset($stats['available']) ? $stats['available'] : 0 ?></p>
            </div>
            <div class="bg-green-100 p-4 rounded-lg">
                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Stok Rendah</p>
                <p class="text-3xl font-bold text-yellow-600"><?= isset($stats['low_stock']) ? $stats['low_stock'] : 0 ?></p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-lg">
                <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Habis</p>
                <p class="text-3xl font-bold text-red-600"><?= isset($stats['out_of_stock']) ? $stats['out_of_stock'] : 0 ?></p>
            </div>
            <div class="bg-red-100 p-4 rounded-lg">
                <i class="fas fa-times-circle text-red-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filter & Search Section -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
        <i class="fas fa-filter text-emerald-600"></i>
        Filter & Pencarian
    </h3>
    <form method="GET" action="<?= base_url('inventori/lihat_stok') ?>" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="text-sm font-medium text-gray-700 block mb-2">
                <i class="fas fa-search mr-1"></i>Cari Barang
            </label>
            <input type="text" name="search" value="<?= $this->input->get('search') ?>" 
                   class="input" placeholder="Nama barang...">
        </div>
        
        <div>
            <label class="text-sm font-medium text-gray-700 block mb-2">
                <i class="fas fa-tag mr-1"></i>Kategori
            </label>
            <select name="category" class="input">
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
                <i class="fas fa-building mr-1"></i>Cabang
            </label>
            <select name="cabang" class="input">
                <option value="">Semua Cabang</option>
                <?php if(isset($branches)): foreach($branches as $branch): ?>
                <option value="<?= $branch->id_cabang ?>" <?= $this->input->get('cabang') == $branch->id_cabang ? 'selected' : '' ?>>
                    <?= $branch->nama_cabang ?>
                </option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        
        <div class="flex items-end gap-2">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-lg transition flex-1 flex items-center justify-center gap-2">
                <i class="fas fa-filter"></i>
                <span>Filter</span>
            </button>
            <a href="<?= base_url('inventori/lihat_stok') ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2.5 rounded-lg transition" title="Reset Filter">
                <i class="fas fa-redo"></i>
            </a>
        </div>
    </form>
</div>

<!-- Category Summary -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
        <i class="fas fa-chart-pie text-emerald-600"></i>
        Ringkasan per Kategori
    </h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php if(isset($items_by_category) && !empty($items_by_category)): ?>
            <?php foreach($items_by_category as $cat): ?>
            <div class="border-2 border-emerald-100 rounded-lg p-4 hover:border-emerald-300 transition">
                <p class="text-sm text-gray-500 mb-1"><?= $cat->jenis_item ?></p>
                <p class="text-2xl font-bold text-emerald-600"><?= $cat->total ?></p>
                <p class="text-xs text-gray-400">item</p>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-4 text-center text-gray-500 py-4">
                <i class="fas fa-inbox text-3xl mb-2 block"></i>
                <p>Belum ada data kategori</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
            <i class="fas fa-list text-emerald-600"></i>
            Daftar Inventory
        </h2>
        <div class="text-sm text-gray-500">
            Total: <span class="font-semibold text-emerald-600"><?= isset($inventory) ? count($inventory) : 0 ?></span> item
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">No</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama Barang</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Stok</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Min. Stok</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Satuan</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Harga</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Cabang</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Update</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($inventory) && !empty($inventory)): ?>
                <?php $no = 1; foreach($inventory as $item): ?>
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-600"><?= $no++ ?></td>
                    <td class="px-4 py-3 font-medium text-gray-800"><?= $item->nama_item ?></td>
                    <td class="px-4 py-3">
                        <span class="badge"><?= $item->jenis_item ?></span>
                    </td>
                    <td class="px-4 py-3 text-center font-bold">
                        <?php if($item->stok_tersedia <= 0): ?>
                            <span class="text-red-600"><?= $item->stok_tersedia ?></span>
                        <?php elseif($item->stok_tersedia <= $item->stok_minimal): ?>
                            <span class="text-yellow-600"><?= $item->stok_tersedia ?></span>
                        <?php else: ?>
                            <span class="text-green-600"><?= $item->stok_tersedia ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-center text-gray-500"><?= $item->stok_minimal ?></td>
                    <td class="px-4 py-3 text-gray-600"><?= $item->satuan ?></td>
                    <td class="px-4 py-3 text-right text-gray-700">Rp <?= number_format($item->harga_satuan, 0, ',', '.') ?></td>
                    <td class="px-4 py-3 text-gray-600"><?= isset($item->nama_cabang) ? $item->nama_cabang : '-' ?></td>
                    <td class="px-4 py-3 text-xs text-gray-500">
                        <?= isset($item->updated_at) ? date('d/m/Y H:i', strtotime($item->updated_at)) : '-' ?>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <?php if($item->stok_tersedia <= 0): ?>
                            <span class="status-badge status-danger">Habis</span>
                        <?php elseif($item->stok_tersedia <= $item->stok_minimal): ?>
                            <span class="status-badge status-warning">Rendah</span>
                        <?php else: ?>
                            <span class="status-badge status-success">Aman</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <button 
                            onclick="openEditModal(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>)"
                            class="text-blue-600 hover:text-blue-800 mr-3" 
                            title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <a href="<?= base_url('inventori/delete/'.$item->id_inventori) ?>" 
                           onclick="return confirm('Yakin ingin menghapus <?= $item->nama_item ?>?')"
                           class="text-red-600 hover:text-red-800" 
                           title="Hapus">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11" class="px-4 py-12 text-center text-gray-500">
                        <i class="fas fa-inbox text-5xl mb-3 block text-gray-300"></i>
                        <p class="font-medium">Tidak ada data inventory</p>
                        <p class="text-xs mt-1">Gunakan filter atau tambahkan data baru</p>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</main>

<!-- Modal Edit -->
<div id="editModal" class="modal-overlay hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-edit text-emerald-600"></i>
                Edit Inventory
            </h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form method="POST" action="<?= base_url('inventori/update') ?>" id="formEdit">
            <input type="hidden" name="id_inventori" id="edit_id">
            
            <div class="modal-body">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-2">Nama Barang *</label>
                        <input type="text" name="nama_item" id="edit_nama" class="input" required>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-2">Stok Tersedia *</label>
                        <input type="number" name="stok_tersedia" id="edit_stok" class="input" min="0" required>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-2">Kategori *</label>
                        <select name="jenis_item" id="edit_kategori" class="input" required>
                            <?php if(isset($categories)): foreach($categories as $cat): ?>
                            <option value="<?= $cat ?>"><?= $cat ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-2">Satuan *</label>
                        <select name="satuan" id="edit_satuan" class="input" required>
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
                        <select name="id_cabang" id="edit_cabang" class="input" required>
                            <?php if(isset($branches)): foreach($branches as $branch): ?>
                            <option value="<?= $branch->id_cabang ?>"><?= $branch->nama_cabang ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-2">Stok Minimal *</label>
                        <input type="number" name="stok_minimal" id="edit_minimal" class="input" min="0" required>
                    </div>
                    <div class="col-span-2">
                        <label class="text-sm font-medium text-gray-700 block mb-2">Harga Satuan</label>
                        <input type="number" name="harga_satuan" id="edit_harga" class="input" min="0">
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                    Batal
                </button>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-save mr-2"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.input {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    transition: all 0.3s;
    font-size: 14px;
}

.input:focus {
    outline: none;
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
}

.badge {
    background: #d1fae5;
    color: #065f46;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 500;
    display: inline-block;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
}

.status-success {
    background: #d1fae5;
    color: #065f46;
}

.status-warning {
    background: #fef3c7;
    color: #92400e;
}

.status-danger {
    background: #fee2e2;
    color: #991b1b;
}

table th {
    font-weight: 600;
    color: #374151;
    font-size: 13px;
}

table td {
    font-size: 13px;
}

@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.modal-overlay.hidden {
    display: none;
}

.modal-content {
    background: white;
    border-radius: 12px;
    width: 90%;
    max-width: 700px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid #e5e7eb;
}

.modal-body {
    padding: 24px;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding: 20px 24px;
    border-top: 1px solid #e5e7eb;
}
</style>

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
</script>

</body>
</html>