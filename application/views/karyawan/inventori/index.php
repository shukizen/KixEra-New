<!DOCTYPE html>
<html lang="id">
<head>
    <?php $this->load->view('template/header'); ?>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        
        <?php $this->load->view('template/sidebarkaryawan'); ?>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64 transition-all duration-300">
            
            <!-- Topbar -->
            <header class="bg-white shadow-sm px-6 py-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <h1 class="text-xl font-semibold text-gray-800">Kelola Inventory</h1>
                    <span class="bg-emerald-100 text-emerald-600 text-sm px-3 py-1 rounded-full">
                        <?php echo isset($stats['total']) ? $stats['total'] : 0; ?> Total Item
                    </span>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Cari nama barang..."
                            class="pl-10 pr-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500"
                        >
                    </div>

                    <select id="branchFilter" class="border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Cabang</option>
                        <?php if(isset($branches) && !empty($branches)): ?>
                            <?php foreach($branches as $branch): ?>
                            <option value="<?= $branch->id_cabang ?>"><?= $branch->nama_cabang ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>

                    <button id="btnTambahInventory" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl transition flex items-center gap-2">
                        <i class="fas fa-plus"></i> Tambah Inventory
                    </button>
                </div>
            </header>

            <!-- Content -->
            <div class="p-6">

                <!-- Flash Messages -->
                <?php if($this->session->flashdata('success')): ?>
                <div id="flashSuccess" class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span><?= $this->session->flashdata('success') ?></span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('error')): ?>
                <div id="flashError" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?= $this->session->flashdata('error') ?></span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <?php endif; ?>

                <!-- Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

                    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Total Item</p>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['total'] ?? 0; ?></h3>
                        </div>
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-boxes text-emerald-600"></i>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Stok Tersedia</p>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['available'] ?? 0; ?></h3>
                        </div>
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-blue-600"></i>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Stok Rendah</p>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['low_stock'] ?? 0; ?></h3>
                        </div>
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Stok Habis</p>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['out_of_stock'] ?? 0; ?></h3>
                        </div>
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-times-circle text-red-600"></i>
                        </div>
                    </div>

                </div>

                <!-- Charts Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Chart: Barang Paling Sering Digunakan (Bar Chart) -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-bar text-emerald-600"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">Barang Paling Sering Digunakan</h2>
                        </div>
                        <div class="relative h-64">
                            <canvas id="itemUsageChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart: Distribusi Kategori (Doughnut Chart) -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-pie text-teal-600"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">Distribusi Kategori</h2>
                        </div>
                        <div class="relative h-64">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Tabel Inventory -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-list text-emerald-600"></i>
                            Data Inventory
                        </h2>
                        <div class="flex gap-2">
                            <a href="<?= base_url('karyawan/inventori/lihat_stok') ?>" class="text-sm text-gray-600 hover:text-emerald-600 px-4 py-2 rounded-lg border border-gray-300 hover:border-emerald-600 transition font-medium">
                                <i class="fas fa-boxes mr-2"></i>Lihat Stok
                            </a>
                            <button onclick="exportData()" class="text-sm text-gray-600 hover:text-emerald-600 px-4 py-2 rounded-lg border border-gray-300 hover:border-emerald-600 transition font-medium">
                                <i class="fas fa-download mr-2"></i>Export
                            </button>
                        </div>
                    </div>
                    <table class="w-full text-sm" id="inventoryTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-gray-500">Nama Barang</th>
                                <th class="px-4 py-3 text-left text-gray-500">Kategori</th>
                                <th class="px-4 py-3 text-center text-gray-500">Stok</th>
                                <th class="px-4 py-3 text-left text-gray-500">Satuan</th>
                                <th class="px-4 py-3 text-left text-gray-500">Cabang</th>
                                <th class="px-4 py-3 text-left text-gray-500">Terakhir Update</th>
                                <th class="px-4 py-3 text-center text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTableBody">
                            <?php if(isset($recent_inventory) && !empty($recent_inventory)): ?>
                                <?php foreach($recent_inventory as $item): ?>
                                    <?php
                                        $stok_status = 'text-green-600';
                                        if ($item->stok_tersedia <= 0) {
                                            $stok_status = 'text-red-600';
                                        } elseif ($item->stok_tersedia <= $item->stok_minimal) {
                                            $stok_status = 'text-yellow-600';
                                        }
                                    ?>
                                    <tr class="border-t hover:bg-gray-50" data-branch="<?= $item->id_cabang ?>">
                                        <td class="px-4 py-3 font-medium"><?= htmlspecialchars($item->nama_item) ?></td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-emerald-100 text-emerald-700">
                                                <?= htmlspecialchars($item->jenis_item) ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center font-semibold <?= $stok_status ?>">
                                            <?= $item->stok_tersedia ?>
                                        </td>
                                        <td class="px-4 py-3"><?= htmlspecialchars($item->satuan) ?></td>
                                        <td class="px-4 py-3"><?= isset($item->nama_cabang) ? htmlspecialchars($item->nama_cabang) : '-' ?></td>
                                        <td class="px-4 py-3"><?= isset($item->updated_at) ? date('d M Y H:i', strtotime($item->updated_at)) : '-' ?></td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex justify-center gap-2">
                                                <button 
                                                    onclick='openEditModal(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, "UTF-8") ?>)'
                                                    class="w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg flex items-center justify-center transition" 
                                                    title="Edit">
                                                    <i class="fas fa-edit text-sm"></i>
                                                </button>
                                                <button 
                                                    onclick="openAddStokModal(<?= $item->id_inventori ?>, '<?= htmlspecialchars($item->nama_item) ?>', <?= $item->stok_tersedia ?>)"
                                                    class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-lg flex items-center justify-center transition" 
                                                    title="Tambah Stok">
                                                    <i class="fas fa-plus text-sm"></i>
                                                </button>
                                                <button 
                                                    type="button"
                                                    onclick="showDeleteModal(<?= $item->id_inventori ?>, '<?= htmlspecialchars($item->nama_item, ENT_QUOTES) ?>')"
                                                    class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition" 
                                                    title="Hapus">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                        <i class="fas fa-inbox text-4xl mb-2"></i>
                                        <p>Belum ada data inventory</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Modal Tambah Inventory -->
            <div id="modalTambahInventory" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-hidden">
                    <!-- Header -->
                    <div class="bg-white border-b p-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-plus text-emerald-600 text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Tambah Inventory Baru</h2>
                                <p class="text-gray-500 text-sm">Tambah barang baru ke inventory</p>
                            </div>
                        </div>
                        <button id="btnCloseModal" class="text-gray-400 hover:text-gray-600 text-2xl hover:bg-gray-100 rounded-lg w-10 h-10 flex items-center justify-center transition-all">
                            &times;
                        </button>
                    </div>
                    
                    <!-- Body with scroll -->
                    <div class="p-6 max-h-[calc(90vh-180px)] overflow-y-auto">
                        <form id="formTambahInventory" method="POST" action="<?= base_url('karyawan/inventori/save') ?>">
                            
                            <!-- Info Barang Section -->
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 mb-6">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-box text-emerald-600 text-sm"></i>
                                    </div>
                                    <h3 class="font-semibold text-gray-800">Informasi Barang</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Nama Barang -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-tag text-emerald-500 mr-1"></i>Nama Barang <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="nama_item" required
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                                            placeholder="Contoh: Sabun Cair Premium">
                                    </div>
                                    
                                    <!-- Kategori -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-folder text-emerald-500 mr-1"></i>Kategori <span class="text-red-500">*</span>
                                        </label>
                                        <select name="jenis_item" required
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
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
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-balance-scale text-emerald-500 mr-1"></i>Satuan <span class="text-red-500">*</span>
                                        </label>
                                        <select name="satuan" required
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
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
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-store text-emerald-500 mr-1"></i>Cabang <span class="text-red-500">*</span>
                                        </label>
                                        <select name="id_cabang" required
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                            <option value="">-- Pilih Cabang --</option>
                                            <?php if(isset($branches) && !empty($branches)): ?>
                                                <?php foreach($branches as $branch): ?>
                                                <option value="<?= $branch->id_cabang ?>"><?= $branch->nama_cabang ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    
                                    <!-- Jumlah Masuk -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-cubes text-emerald-500 mr-1"></i>Jumlah Masuk <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" name="stok_masuk" min="1" value="1" required
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Info Tambahan Section -->
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-info-circle text-blue-600 text-sm"></i>
                                    </div>
                                    <h3 class="font-semibold text-gray-800">Informasi Tambahan</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Harga Satuan -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-money-bill text-blue-500 mr-1"></i>Harga Satuan (Opsional)
                                        </label>
                                        <input type="number" name="harga_satuan" min="0" placeholder="0"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    </div>
                                    
                                    <!-- Tanggal -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-calendar text-blue-500 mr-1"></i>Tanggal Masuk
                                        </label>
                                        <input type="date" name="tanggal_masuk" value="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    </div>
                                    
                                    <!-- Keterangan -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-sticky-note text-blue-500 mr-1"></i>Keterangan
                                        </label>
                                        <textarea name="keterangan" rows="2" placeholder="Catatan tambahan (opsional)"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none transition-all"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Footer -->
                    <div class="bg-gray-50 border-t px-6 py-4 flex justify-end gap-3">
                        <button type="button" id="btnCancelModal" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-lg transition font-medium">
                            Batal
                        </button>
                        <button type="submit" form="formTambahInventory" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg transition font-medium flex items-center gap-2">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Inventory -->
            <div id="modalEditInventory" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-hidden">
                    <!-- Header -->
                    <div class="bg-white border-b p-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-edit text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Edit Inventory</h2>
                                <p class="text-gray-500 text-sm">Perbarui data inventory</p>
                            </div>
                        </div>
                        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 text-2xl hover:bg-gray-100 rounded-lg w-10 h-10 flex items-center justify-center transition-all">
                            &times;
                        </button>
                    </div>
                    
                    <!-- Body -->
                    <form id="formEditInventory" method="POST" action="<?= site_url('karyawan/inventori/update') ?>">
                        <input type="hidden" name="id_inventori" id="edit_id">
                        <input type="hidden" name="return_url" value="<?= htmlspecialchars(current_url(), ENT_QUOTES, 'UTF-8') ?>">
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-semibold text-gray-700 block mb-2">Nama Barang *</label>
                                    <input type="text" name="nama_item" id="edit_nama" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-700 block mb-2">Stok Tersedia *</label>
                                    <input type="number" name="stok_tersedia" id="edit_stok" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" min="0" required>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-700 block mb-2">Kategori *</label>
                                    <select name="jenis_item" id="edit_kategori" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                        <?php if(isset($categories)): foreach($categories as $cat): ?>
                                        <option value="<?= $cat ?>"><?= $cat ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-700 block mb-2">Satuan *</label>
                                    <select name="satuan" id="edit_satuan" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                        <?php if(isset($units)): foreach($units as $unit): ?>
                                        <option value="<?= $unit ?>"><?= $unit ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-700 block mb-2">Cabang *</label>
                                    <select name="id_cabang" id="edit_cabang" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                        <?php if(isset($branches)): foreach($branches as $branch): ?>
                                        <option value="<?= $branch->id_cabang ?>"><?= $branch->nama_cabang ?></option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-700 block mb-2">Stok Minimal *</label>
                                    <input type="number" name="stok_minimal" id="edit_minimal" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" min="0" required>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-sm font-semibold text-gray-700 block mb-2">Harga Satuan</label>
                                    <input type="number" name="harga_satuan" id="edit_harga" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" min="0">
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50">
                            <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-lg transition font-medium">
                                Batal
                            </button>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg transition font-medium">
                                <i class="fas fa-save mr-2"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Tambah Stok -->
            <div id="modalTambahStok" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4">
                    <!-- Header -->
                    <div class="bg-white border-b p-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-plus-circle text-emerald-600 text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Tambah Stok</h2>
                                <p class="text-gray-500 text-sm" id="addStokItemName">-</p>
                            </div>
                        </div>
                        <button onclick="closeAddStokModal()" class="text-gray-400 hover:text-gray-600 text-2xl hover:bg-gray-100 rounded-lg w-10 h-10 flex items-center justify-center transition-all">
                            &times;
                        </button>
                    </div>
                    
                    <!-- Body -->
                    <form id="formTambahStok" method="POST" action="<?= base_url('karyawan/inventori/save') ?>">
                        <input type="hidden" name="nama_item" id="addStok_nama">
                        <input type="hidden" name="jenis_item" value="Bahan">
                        <input type="hidden" name="satuan" value="Pcs">
                        <input type="hidden" name="id_cabang" value="<?= $this->session->userdata('id_cabang') ?>">
                        
                        <div class="p-6">
                            <div class="mb-4">
                                <label class="text-sm font-semibold text-gray-700 block mb-2">Stok Saat Ini</label>
                                <input type="text" id="addStok_current" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm bg-gray-100" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="text-sm font-semibold text-gray-700 block mb-2">Jumlah Tambah *</label>
                                <input type="number" name="stok_masuk" id="addStok_jumlah" min="1" value="1" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-gray-700 block mb-2">Harga Satuan (Opsional)</label>
                                <input type="number" name="harga_satuan" min="0" placeholder="0"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                        </div>
                        
                        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50">
                            <button type="button" onclick="closeAddStokModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-lg transition font-medium">
                                Batal
                            </button>
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-lg transition font-medium">
                                <i class="fas fa-plus mr-2"></i>Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div id="deleteModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
                <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6 mx-4">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-red-100">
                            <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800"><?= lang_text('confirm_delete') ?>?</h3>
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        <?= lang_text('inventory') ?> <span id="delete-nama-text" class="font-semibold text-gray-800"></span> <?= lang_text('will_be_deleted') ?>.
                    </p>
                    <div class="flex justify-end gap-3">
                        <button id="cancelDeleteBtn" onclick="hideDeleteModal()"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                            <?= lang_text('cancel') ?>
                        </button>
                        <button id="confirmDeleteBtn"
                            class="px-5 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">
                            <?= lang_text('delete') ?>
                        </button>
                    </div>
                </div>
            </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
// Modal Tambah Inventory
const modalTambah = document.getElementById('modalTambahInventory');
const btnTambah = document.getElementById('btnTambahInventory');
const btnClose = document.getElementById('btnCloseModal');
const btnCancel = document.getElementById('btnCancelModal');

btnTambah.addEventListener('click', function() {
    modalTambah.classList.remove('hidden');
    modalTambah.classList.add('flex');
});

btnClose.addEventListener('click', closeAddModal);
btnCancel.addEventListener('click', closeAddModal);

function closeAddModal() {
    modalTambah.classList.add('hidden');
    modalTambah.classList.remove('flex');
}

modalTambah.addEventListener('click', function(e) {
    if (e.target === modalTambah) closeAddModal();
});

// Modal Edit Inventory
function openEditModal(item) {
    document.getElementById('edit_id').value = item.id_inventori;
    document.getElementById('edit_nama').value = item.nama_item;
    document.getElementById('edit_stok').value = item.stok_tersedia;
    document.getElementById('edit_kategori').value = item.jenis_item;
    document.getElementById('edit_satuan').value = item.satuan;
    document.getElementById('edit_cabang').value = item.id_cabang;
    document.getElementById('edit_minimal').value = item.stok_minimal;
    document.getElementById('edit_harga').value = item.harga_satuan || 0;
    
    const modal = document.getElementById('modalEditInventory');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('modalEditInventory');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

document.getElementById('modalEditInventory').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});

// Modal Tambah Stok
function openAddStokModal(id, nama, currentStok) {
    document.getElementById('addStok_nama').value = nama;
    document.getElementById('addStok_current').value = currentStok;
    document.getElementById('addStokItemName').textContent = nama;
    
    const modal = document.getElementById('modalTambahStok');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeAddStokModal() {
    const modal = document.getElementById('modalTambahStok');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

document.getElementById('modalTambahStok').addEventListener('click', function(e) {
    if (e.target === this) closeAddStokModal();
});

let deleteItemId = null;

function showDeleteModal(id, namaItem) {
    deleteItemId = id;
    document.getElementById("delete-nama-text").textContent = '"' + namaItem + '"';
    const modal = document.getElementById("deleteModal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

function hideDeleteModal() {
    const modal = document.getElementById("deleteModal");
    modal.classList.add("hidden");
    modal.classList.remove("flex");
    deleteItemId = null;
}

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) hideDeleteModal();
});

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (deleteItemId) {
        window.location.href = "<?= base_url('karyawan/inventori/delete/') ?>" + deleteItemId + '?return_url=' + encodeURIComponent(window.location.href);
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeAddModal();
        closeEditModal();
        closeAddStokModal();
        hideDeleteModal();
    }
});

// Search and Filter
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

document.getElementById('searchInput').addEventListener('input', function(e) {
    currentSearch = e.target.value.toLowerCase();
    applyFilters();
});

document.getElementById('branchFilter').addEventListener('change', function(e) {
    currentBranch = e.target.value;
    applyFilters();
});

// Export Function
function exportData() {
    alert('Fitur export akan segera tersedia!');
}

// Flash message auto-hide
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
    
    if (!canvas) return;
    
    if (!chartData || chartData.length === 0) {
        showChartPlaceholder(canvas, 'Belum ada data untuk ditampilkan');
        return;
    }
    
    const labels = chartData.map(item => item.nama_item || item.jenis_item || 'Unknown');
    const dataValues = chartData.map(item => parseInt(item.total_used || item.total || 0));
    
    if (!dataValues.some(val => val > 0)) {
        showChartPlaceholder(canvas, 'Belum ada data penggunaan');
        return;
    }
    
    const ctx = canvas.getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tingkat Penggunaan (%)',
                data: dataValues,
                backgroundColor: '#10b981',
                borderRadius: 6,
                maxBarThickness: 60
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
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

<?php $this->load->view('template/footer'); ?>
