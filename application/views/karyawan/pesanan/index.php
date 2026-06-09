<!DOCTYPE html>
<html lang="id">
<head>
    <?php $this->load->view('template/header'); ?>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        
        <?php $this->load->view('template/sidebarkaryawan'); ?>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64 flex flex-col min-h-screen">
            
            <!-- Topbar -->
            <header class="bg-white shadow-sm px-6 py-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <h1 class="text-xl font-semibold text-gray-800">Kelola Pesanan</h1>
                    <span class="bg-emerald-100 text-emerald-600 text-sm px-3 py-1 rounded-full">
                        <?php echo isset($pesanan) ? count($pesanan) : 0; ?> Total Pesanan
                    </span>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Cari nama pelanggan..."
                            class="pl-10 pr-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500"
                        >
                    </div>

                    <select id="statusFilter" class="border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Status</option>
                        <?php foreach ($status_list as $value => $label): ?>
                            <option value="<?= $value ?>"><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button id="btnTambahPesanan" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl transition flex items-center gap-2">
                        <i class="fas fa-plus"></i> Tambah Pesanan
                    </button>
                </div>
            </header>

            <!-- Content -->
            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">

                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Pesanan Hari Ini</p>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['today'] ?? 0; ?></h3>
                        </div>
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bag-shopping text-emerald-600"></i>
                        </div>
                    </div>


                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Pesanan Selesai</p>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['selesai'] ?? 0; ?></h3>
                        </div>
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-emerald-600"></i>
                        </div>
                    </div>


                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Dalam Proses</p>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['proses'] ?? 0; ?></h3>
                        </div>
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-spinner text-yellow-600"></i>
                        </div>
                    </div>


                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Diterima</p>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['diterima'] ?? 0; ?></h3>
                        </div>
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-inbox text-blue-600"></i>
                        </div>
                    </div>


                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Dibatalkan</p>
                            <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['dibatalkan'] ?? 0; ?></h3>
                        </div>
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-xmark text-red-600"></i>
                        </div>
                    </div>

                </div>

                <!-- Tabel Pesanan -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <table class="w-full text-sm" id="pesananTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-gray-500">No. Pesanan</th>
                                <th class="px-4 py-3 text-left text-gray-500">Tanggal</th>
                                <th class="px-4 py-3 text-left text-gray-500">Pelanggan</th>
                                <th class="px-4 py-3 text-left text-gray-500">Layanan</th>
                                <th class="px-4 py-3 text-left text-gray-500">Total</th>
                                <th class="px-4 py-3 text-left text-gray-500">Status</th>
                                <th class="px-4 py-3 text-left text-gray-500">Pembayaran</th>
                                <th class="px-4 py-3 text-left text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pesanan)): ?>
                                <?php foreach ($pesanan as $p): ?>
                                    <?php
                                        $status = strtolower($p->status_pesanan ?? '');
                                        $badge = 'bg-gray-100 text-gray-700';
                                        $status_label = ucfirst(str_replace('_', ' ', $status));
                                        
                                        if ($status === 'sudah_diambil') {
                                            $badge = 'bg-emerald-600/10 text-emerald-500';
                                            $status_label = 'Sudah Diambil';
                                        } elseif ($status === 'siap_diambil') {
                                            $badge = 'bg-green-500/10 text-green-500';
                                            $status_label = 'Siap Diambil';
                                        } elseif ($status === 'selesai') {
                                            $badge = 'bg-emerald-500/10 text-emerald-500';
                                        } elseif ($status === 'dalam_proses') {
                                            $badge = 'bg-yellow-500/10 text-yellow-600';
                                            $status_label = 'Dalam Proses';
                                        } elseif ($status === 'diterima') {
                                            $badge = 'bg-blue-500/10 text-blue-500';
                                        } elseif ($status === 'dibatalkan') {
                                            $badge = 'bg-red-500/10 text-red-500';
                                        }
                                    ?>
                                    <tr class="border-t hover:bg-gray-50" data-status="<?= $status ?>">
                                        <td class="px-4 py-3 font-medium"><?= htmlspecialchars($p->nomor_pesanan ?? '-') ?></td>
                                        <td class="px-4 py-3"><?= date('d M Y', strtotime($p->tgl_masuk)) ?></td>
                                        <td class="px-4 py-3"><?= htmlspecialchars($p->nama_pelanggan ?? '-') ?></td>
                                        <td class="px-4 py-3"><?= htmlspecialchars($p->nama_layanan ?? '-') ?></td>
                                        <td class="px-4 py-3 font-semibold">Rp <?= number_format($p->total_harga ?? 0, 0, ',', '.') ?></td>
                                        <td class="px-4 py-3">
                                            <span class="<?= $badge ?> px-3 py-1 rounded-full text-xs font-medium">
                                                <?= htmlspecialchars($status_label ?: '-') ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <?php
                                            $status_bayar = $p->status_pembayaran ?? 'belum_bayar';
                                            $metode = $p->metode_pembayaran ?? '';
                                            $metode_icon = '';
                                            if ($metode === 'tunai') $metode_icon = '';
                                            elseif ($metode === 'debit') $metode_icon = '';
                                            elseif ($metode === 'qris') $metode_icon = '';
                                            ?>
                                            <?php if ($status_bayar === 'sudah_bayar'): ?>
                                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">
                                                    <?= $metode_icon ?> Lunas
                                                </span>
                                            <?php else: ?>
                                                <button class="btn-confirm-payment bg-orange-500 hover:bg-orange-600 text-white px-2 py-1 rounded-lg text-xs flex items-center gap-1"
                                                    data-id="<?= $p->id_pesanan ?>"
                                                    data-nomor="<?= htmlspecialchars($p->nomor_pesanan) ?>"
                                                    data-total="<?= $p->total_harga ?>"
                                                    data-metode="<?= $metode ?>"
                                                    title="Konfirmasi Pembayaran">
                                                    <i class="fas fa-money-bill-wave"></i>
                                                    <span>Bayar</span>
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex gap-1 flex-wrap">
                                                <?php 
                                                // Quick action buttons based on status
                                                $next_status = null;
                                                $next_label = '';
                                                $next_icon = '';
                                                $next_color = '';
                                                
                                                switch ($status) {
                                                    case 'diterima':
                                                        $next_status = 'dalam_proses';
                                                        $next_label = 'Proses';
                                                        $next_icon = 'fa-spinner';
                                                        $next_color = 'bg-yellow-500 hover:bg-yellow-600';
                                                        break;
                                                    case 'dalam_proses':
                                                        $next_status = 'selesai';
                                                        $next_label = 'Selesai';
                                                        $next_icon = 'fa-check';
                                                        $next_color = 'bg-emerald-500 hover:bg-emerald-600';
                                                        break;
                                                    case 'selesai':
                                                        $next_status = 'siap_diambil';
                                                        $next_label = 'Siap';
                                                        $next_icon = 'fa-box';
                                                        $next_color = 'bg-green-500 hover:bg-green-600';
                                                        break;
                                                    case 'siap_diambil':
                                                        $next_status = 'sudah_diambil';
                                                        $next_label = 'Diambil';
                                                        $next_icon = 'fa-hand-holding';
                                                        $next_color = 'bg-emerald-600 hover:bg-emerald-700';
                                                        break;
                                                }
                                                
                                                if ($next_status): 
                                                ?>
                                                <button class="btn-quick-status <?= $next_color ?> text-white px-2 py-1 rounded-lg text-xs flex items-center gap-1"
                                                    data-id="<?= $p->id_pesanan ?>" 
                                                    data-status="<?= $next_status ?>"
                                                    title="Ubah ke <?= ucwords(str_replace('_', ' ', $next_status)) ?>">
                                                    <i class="fas <?= $next_icon ?>"></i>
                                                    <span class="hidden sm:inline"><?= $next_label ?></span>
                                                </button>
                                                <?php endif; ?>
                                                
                                                <?php if (in_array($status, ['selesai', 'siap_diambil', 'sudah_diambil']) && isset($p->pending_photos) && $p->pending_photos > 0): ?>
                                                <button class="btn-upload-foto bg-purple-500 hover:bg-purple-600 text-white px-2 py-1 rounded-lg text-xs"
                                                    data-id="<?= $p->id_pesanan ?>" 
                                                    title="Upload Foto Sesudah">
                                                    <i class="fas fa-camera"></i>
                                                </button>
                                                <?php endif; ?>
                                                
                                                <a href="<?= site_url('karyawan/pesanan/detail/' . $p->id_pesanan) ?>" 
                                                    class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-lg flex items-center justify-center transition" 
                                                    title="Lihat Detail">
                                                    <i class="fas fa-eye text-sm"></i>
                                                </a>
                                                
                                                <button class="btn-edit w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg flex items-center justify-center transition"
                                                    data-id="<?= $p->id_pesanan ?>" title="Edit">
                                                    <i class="fas fa-edit text-sm"></i>
                                                </button>
                                                
                                                <?php if (!in_array($status, ['sudah_diambil', 'dibatalkan'])): ?>
                                                <button class="btn-delete w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition"
                                                    data-id="<?= $p->id_pesanan ?>" data-nomor="<?= htmlspecialchars($p->nomor_pesanan) ?>" title="Hapus">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                        <i class="fas fa-inbox text-4xl mb-2"></i>
                                        <p>Belum ada pesanan</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Modal Tambah Pesanan -->
            <div id="modalTambahPesanan" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl mx-4 max-h-[90vh] overflow-hidden">
                    <!-- Header -->
                    <div class="bg-white border-b p-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-plus text-emerald-600 text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Tambah Pesanan Baru</h2>
                                <p class="text-gray-500 text-sm">Buat pesanan untuk pelanggan</p>
                            </div>
                        </div>
                        <button id="btnCloseModal" class="text-gray-400 hover:text-gray-600 text-2xl hover:bg-gray-100 rounded-lg w-10 h-10 flex items-center justify-center transition-all">
                            &times;
                        </button>
                    </div>
                    
                    <!-- Body with scroll -->
                    <div class="p-6 max-h-[calc(90vh-180px)] overflow-y-auto">
                        <form id="formTambahPesanan" enctype="multipart/form-data">
                            <input type="hidden" name="id_cabang" value="<?= $id_cabang ?? '' ?>">
                            <input type="hidden" name="id_karyawan" value="<?= $id_karyawan ?? '' ?>">
                            
                            <!-- Info Pesanan Section -->
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 mb-6">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-info-circle text-emerald-600 text-sm"></i>
                                    </div>
                                    <h3 class="font-semibold text-gray-800">Informasi Pesanan</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Pelanggan -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-user text-emerald-500 mr-1"></i>Pelanggan <span class="text-red-500">*</span>
                                        </label>
                                        <select name="id_pelanggan" id="add-id_pelanggan" required
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                            <option value="">-- Pilih Pelanggan --</option>
                                            <?php foreach ($pelanggan_list as $pel): ?>
                                                <option value="<?= $pel->id_pelanggan ?>"><?= htmlspecialchars($pel->nama) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <!-- Jumlah Item -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-shoe-prints text-emerald-500 mr-1"></i>Jumlah Item <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" name="jumlah_item" id="add-jumlah_item" min="1" value="1" required
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    </div>
                                    
                                    <!-- Tanggal Masuk -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-calendar-plus text-emerald-500 mr-1"></i>Tanggal Masuk
                                        </label>
                                        <input type="datetime-local" name="tgl_masuk" id="add-tgl_masuk"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    </div>
                                    
                                    <!-- Estimasi Selesai -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-calendar-check text-emerald-500 mr-1"></i>Estimasi Selesai
                                        </label>
                                        <input type="datetime-local" name="tgl_estimasi_selesai" id="add-tgl_estimasi_selesai"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    </div>
                                    
                                    <!-- Catatan -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-sticky-note text-emerald-500 mr-1"></i>Catatan Umum
                                        </label>
                                        <textarea name="catatan" id="add-catatan" rows="2" placeholder="Catatan tambahan (opsional)"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 resize-none transition-all"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Payment Section -->
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 mb-6">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-credit-card text-blue-600 text-sm"></i>
                                    </div>
                                    <h3 class="font-semibold text-gray-800">Pembayaran</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Metode Pembayaran -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-wallet text-blue-500 mr-1"></i>Metode Pembayaran
                                        </label>
                                        <select name="metode_pembayaran" id="add-metode_pembayaran"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-all">
                                            <option value="">-- Pilih Metode --</option>
                                            <option value="tunai">Tunai</option>
                                            <option value="debit">Debit/Transfer</option>
                                            <option value="qris">QRIS</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Status Pembayaran -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-check-circle text-blue-500 mr-1"></i>Status Pembayaran
                                        </label>
                                        <div class="flex items-center gap-4 h-[42px]">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="sudah_bayar" id="add-sudah_bayar" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                                <span class="ms-3 text-sm font-medium text-gray-700" id="sudah-bayar-label">Belum Dibayar</span>
                                            </label>
                                            <input type="hidden" name="status_pembayaran" id="add-status_pembayaran" value="belum_bayar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Detail Items Section -->
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 mb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-shoe-prints text-emerald-600 text-sm"></i>
                                        </div>
                                        <h3 class="font-semibold text-gray-800">Detail Sepatu</h3>
                                    </div>
                                    <span class="text-xs text-gray-500 bg-white px-3 py-1 rounded-full border">
                                        <i class="fas fa-info-circle mr-1"></i>Isi detail untuk setiap item
                                    </span>
                                </div>
                                
                                <div id="detailItemsContainer" class="space-y-4">
                                    <!-- Dynamic items will be generated here -->
                                </div>
                            </div>
                            
                            <!-- Total Harga Preview -->
                            <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-200">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 font-medium">
                                        <i class="fas fa-receipt mr-2 text-emerald-600"></i>Total Harga:
                                    </span>
                                    <span id="totalHarga" class="text-2xl font-bold text-emerald-600">Rp 0</span>
                                    <input type="hidden" name="total_harga" id="add-total_harga" value="0">
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Fixed Footer -->
                    <div class="p-4 border-t bg-gray-50 flex justify-end gap-3">
                        <button type="button" id="btnBatalModal" class="px-6 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 font-medium transition-all flex items-center gap-2">
                            <i class="fas fa-times"></i>Batal
                        </button>
                        <button type="submit" form="formTambahPesanan" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-medium transition-all flex items-center gap-2">
                            <i class="fas fa-save"></i>Simpan Pesanan
                        </button>
                    </div>
                </div>
            </div>


            <!-- Modal Edit Pesanan -->
            <div id="modalEditPesanan" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl mx-4 max-h-[90vh] overflow-hidden">
                    <!-- Header -->
                    <div class="bg-white border-b p-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-edit text-emerald-600 text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Edit Pesanan</h2>
                                <p class="text-gray-500 text-sm">Perbarui informasi pesanan</p>
                            </div>
                        </div>
                        <button id="btnCloseEditModal" class="text-gray-400 hover:text-gray-600 text-2xl hover:bg-gray-100 rounded-lg w-10 h-10 flex items-center justify-center transition-all">
                            &times;
                        </button>
                    </div>
                    
                    <!-- Body with scroll -->
                    <div class="p-6 max-h-[calc(90vh-180px)] overflow-y-auto">
                        <form id="formEditPesanan" enctype="multipart/form-data">
                            <input type="hidden" name="id_pesanan" id="edit-id_pesanan">
                            
                            <!-- Info Pesanan Section -->
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 mb-6">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-info-circle text-emerald-600 text-sm"></i>
                                    </div>
                                    <h3 class="font-semibold text-gray-800">Informasi Pesanan</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-flag text-emerald-500 mr-1"></i>Status Pesanan
                                        </label>
                                        <select name="status_pesanan" id="edit-status_pesanan"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                            <?php foreach ($status_list as $value => $label): ?>
                                                <option value="<?= $value ?>"><?= $label ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-concierge-bell text-emerald-500 mr-1"></i>Layanan
                                        </label>
                                        <select name="id_layanan" id="edit-id_layanan"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                            <?php foreach ($layanan_list as $lay): ?>
                                                <option value="<?= $lay->id_layanan ?>" data-harga="<?= $lay->harga ?>">
                                                    <?= htmlspecialchars($lay->nama_layanan) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-shoe-prints text-emerald-500 mr-1"></i>Jumlah Item
                                        </label>
                                        <input type="number" name="jumlah_item" id="edit-jumlah_item" min="1" readonly
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-100 text-gray-600">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-money-bill-wave text-emerald-500 mr-1"></i>Total Harga
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                            <input type="number" name="total_harga" id="edit-total_harga"
                                                class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-calendar-check text-emerald-500 mr-1"></i>Estimasi Selesai
                                        </label>
                                        <input type="datetime-local" name="tgl_estimasi_selesai" id="edit-tgl_estimasi_selesai"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    </div>
                                    
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-sticky-note text-emerald-500 mr-1"></i>Catatan
                                        </label>
                                        <textarea name="catatan" id="edit-catatan" rows="2" placeholder="Catatan tambahan..."
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 resize-none transition-all"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Detail Items Section -->
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-shoe-prints text-emerald-600 text-sm"></i>
                                        </div>
                                        <h3 class="font-semibold text-gray-800">Detail Sepatu</h3>
                                    </div>
                                    <span class="text-xs text-gray-500 bg-white px-3 py-1 rounded-full border">
                                        <i class="fas fa-camera mr-1"></i>Upload foto saat selesai
                                    </span>
                                </div>
                                
                                <div id="editDetailItemsContainer" class="space-y-4">
                                    <!-- Dynamic items will be loaded here -->
                                    <div class="text-center py-8 text-gray-400">
                                        <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                                        <p class="text-sm">Memuat detail sepatu...</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Fixed Footer -->
                    <div class="p-4 border-t bg-gray-50 flex justify-end gap-3">
                        <button type="button" id="btnBatalEditModal" class="px-6 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 font-medium transition-all flex items-center gap-2">
                            <i class="fas fa-times"></i>Batal
                        </button>
                        <button type="submit" form="formEditPesanan" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-medium transition-all flex items-center gap-2">
                            <i class="fas fa-save"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>


            <!-- Modal View Detail Pesanan -->
            <div id="modalViewPesanan" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 backdrop-blur-sm">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl mx-4 max-h-[90vh] overflow-hidden">
                    <!-- Header -->
                    <div class="bg-emerald-700 p-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-eye text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-white">Detail Pesanan</h2>
                                <p id="view-nomor-pesanan" class="text-emerald-100 text-sm">#-</p>
                            </div>
                        </div>
                        <button id="btnCloseViewModal" class="text-white/80 hover:text-white text-3xl hover:bg-white/10 rounded-lg w-10 h-10 flex items-center justify-center transition-all">
                            &times;
                        </button>
                    </div>
                    
                    <!-- Body with scroll -->
                    <div class="p-6 max-h-[calc(90vh-140px)] overflow-y-auto">
                        <!-- Info Pesanan Section -->
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 mb-6">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-info-circle text-emerald-600 text-sm"></i>
                                </div>
                                <h3 class="font-semibold text-gray-800">Informasi Pesanan</h3>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Pelanggan</p>
                                    <p id="view-pelanggan" class="font-medium text-gray-800">-</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Layanan</p>
                                    <p id="view-layanan" class="font-medium text-gray-800">-</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Status</p>
                                    <span id="view-status" class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-gray-100">-</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Tanggal Masuk</p>
                                    <p id="view-tgl-masuk" class="font-medium text-gray-800">-</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Estimasi Selesai</p>
                                    <p id="view-tgl-estimasi" class="font-medium text-gray-800">-</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Jumlah Item</p>
                                    <p id="view-jumlah-item" class="font-medium text-gray-800">-</p>
                                </div>
                                <div class="col-span-2 md:col-span-3">
                                    <p class="text-xs text-gray-500 mb-1">Catatan</p>
                                    <p id="view-catatan" class="font-medium text-gray-800 italic">-</p>
                                </div>
                            </div>
                            
                            <!-- Total Harga -->
                            <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between items-center">
                                <span class="text-gray-600 font-medium">Total Harga:</span>
                                <span id="view-total-harga" class="text-2xl font-bold text-emerald-600">Rp 0</span>
                            </div>
                        </div>
                        
                        <!-- Detail Items Section -->
                        <div class="bg-emerald-50 rounded-xl p-5 border border-teal-200">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-shoe-prints text-emerald-600 text-sm"></i>
                                </div>
                                <h3 class="font-semibold text-gray-800">Detail Sepatu</h3>
                            </div>
                            
                            <div id="viewDetailItemsContainer" class="space-y-4">
                                <!-- Dynamic items will be loaded here -->
                                <div class="text-center py-8 text-gray-400">
                                    <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                                    <p class="text-sm">Memuat detail sepatu...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fixed Footer -->
                    <div class="p-4 border-t bg-gray-50 flex justify-end gap-3">
                        <button type="button" id="btnCloseViewFooter" class="px-6 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl font-medium transition-all flex items-center gap-2">
                            <i class="fas fa-times"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Delete Confirmation -->
            <div id="modalDeletePesanan" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md mx-4">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-red-100">
                            <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Hapus Pesanan?</h3>
                    </div>
                    <p class="text-gray-600 mb-6">
                        Pesanan <span id="delete-nomor" class="font-semibold"></span> akan dihapus. Tindakan ini tidak bisa dibatalkan.
                    </p>
                    <input type="hidden" id="delete-id">
                    <div class="flex justify-end gap-3">
                        <button id="btnCancelDelete" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</button>
                        <button id="btnConfirmDelete" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">Hapus</button>
                    </div>
                </div>
            </div>

            <!-- Modal Status Change Confirmation -->
            <div id="modalStatusPesanan" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md mx-4">
                    <div class="flex items-center gap-3 mb-4">
                        <div id="status-icon" class="w-12 h-12 flex items-center justify-center rounded-full bg-emerald-100">
                            <i class="fas fa-sync-alt text-emerald-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Ubah Status Pesanan</h3>
                    </div>
                    <p class="text-gray-600 mb-6">
                        Ubah status pesanan menjadi <span id="status-label" class="font-semibold text-emerald-600"></span>?
                    </p>
                    <input type="hidden" id="status-id">
                    <input type="hidden" id="status-value">
                    <div class="flex justify-end gap-3">
                        <button id="btnCancelStatus" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</button>
                        <button id="btnConfirmStatus" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg">
                            <i class="fas fa-check mr-1"></i>Konfirmasi
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Modal Success with Print Option -->
            <div id="modalSuccessPesanan" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md mx-4 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-emerald-100">
                        <i class="fas fa-check-circle text-emerald-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Pesanan Berhasil Disimpan!</h3>
                    <p class="text-gray-600 mb-2">Nomor Pesanan:</p>
                    <p id="success-nomor-pesanan" class="text-2xl font-bold text-emerald-600 mb-6">#-</p>
                    <input type="hidden" id="success-id-pesanan">
                    <div class="flex flex-col gap-3">
                        <button id="btnCetakNota" class="w-full px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-medium flex items-center justify-center gap-2 transition-all">
                            <i class="fas fa-print"></i>
                            <span>Cetak Nota</span>
                        </button>
                        <button id="btnCloseSuccess" class="w-full px-5 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium transition-all">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
            
            <?php $this->load->view('template/footer'); ?>
    </div>

    <script>
        const BASE_URL = '<?= site_url("karyawan/pesanan/") ?>';
        
        // Notification helper
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-emerald-700' : 'bg-red-600';
            notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center gap-2`;
            notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}`;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }

        // Format Rupiah
        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // ============ MODAL TAMBAH PESANAN ============
        (function() {
            const modal = document.getElementById('modalTambahPesanan');
            const btnOpen = document.getElementById('btnTambahPesanan');
            const btnClose = document.getElementById('btnCloseModal');
            const btnBatal = document.getElementById('btnBatalModal');
            const form = document.getElementById('formTambahPesanan');
            const inputJumlah = document.getElementById('add-jumlah_item');
            const totalHargaEl = document.getElementById('totalHarga');
            const totalHargaInput = document.getElementById('add-total_harga');
            const inputTglMasuk = document.getElementById('add-tgl_masuk');

            function hitungTotal() {
                const jumlah = parseInt(inputJumlah.value) || 1;
                
                // Generate detail items based on jumlah
                generateDetailItems(jumlah);
                
                // Update total from item selections
                updateTotalFromItems();
            }

            // Generate layanan options for per-item dropdowns
            const layananData = <?php echo json_encode($layanan_list); ?>;
            let layananOptionsHtml = '';
            layananData.forEach(lay => {
                layananOptionsHtml += `<option value="${lay.id_layanan}" data-harga="${lay.harga}">${lay.nama_layanan}</option>`;
            });

            // Update total from all item layanan selections
            window.updateTotalFromItems = function() {
                const layananSelects = document.querySelectorAll('.layanan-select');
                let total = 0;
                layananSelects.forEach(select => {
                    const selectedOption = select.options[select.selectedIndex];
                    if (selectedOption && selectedOption.dataset.harga) {
                        total += parseInt(selectedOption.dataset.harga) || 0;
                    }
                });
                const totalHargaEl = document.getElementById('totalHarga');
                const totalHargaInput = document.getElementById('add-total_harga');
                if (totalHargaEl) totalHargaEl.textContent = formatRupiah(total);
                if (totalHargaInput) totalHargaInput.value = total;
            };

            // Generate dynamic detail item forms
            function generateDetailItems(count) {
                const container = document.getElementById('detailItemsContainer');
                container.innerHTML = '';
                
                for (let i = 1; i <= count; i++) {
                    const itemHtml = `
                        <div class="bg-white rounded-xl p-5 border border-gray-200 hover:shadow-md transition-all" data-item="${i}">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">${i}</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Sepatu ${i}</h4>
                                    <p class="text-xs text-gray-500">Isi detail sepatu</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-concierge-bell text-emerald-500 mr-1"></i>Layanan
                                    </label>
                                    <select name="detail[${i}][id_layanan]" 
                                        class="layanan-select w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all"
                                        onchange="updateTotalFromItems()">
                                        <option value="">-- Pilih Layanan --</option>
                                        ${layananOptionsHtml}
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-tag text-gray-400 mr-1"></i>Jenis Sepatu
                                    </label>
                                    <input type="text" name="detail[${i}][jenis_sepatu]" placeholder="Nike Air Max, Adidas, dll"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-palette text-gray-400 mr-1"></i>Warna
                                    </label>
                                    <input type="text" name="detail[${i}][warna]" placeholder="Putih, Hitam, dll"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-clipboard-list text-gray-400 mr-1"></i>Kondisi Awal
                                    </label>
                                    <input type="text" name="detail[${i}][kondisi_awal]" placeholder="Kotor, Sol menguning, Noda, dll"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-sticky-note text-gray-400 mr-1"></i>Catatan Khusus
                                    </label>
                                    <input type="text" name="detail[${i}][catatan_khusus]" placeholder="Hati-hati bagian tertentu, dll"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                </div>
                            </div>
                            
                            <!-- Foto Upload Section -->
                            <div class="pt-4 border-t border-gray-100">
                                <label class="block text-xs font-medium text-gray-500 mb-2">
                                    <i class="fas fa-camera text-emerald-500 mr-1"></i>Foto Sebelum (Kondisi Awal)
                                </label>
                                <div class="flex items-center gap-4">
                                    <label class="w-24 h-24 bg-emerald-50 rounded-xl flex flex-col items-center justify-center border-2 border-dashed border-teal-400 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all">
                                        <i class="fas fa-cloud-upload-alt text-emerald-400 text-xl mb-1"></i>
                                        <span class="text-xs text-emerald-600">Upload</span>
                                        <input type="file" name="foto_sebelum_${i}" accept="image/*" 
                                            onchange="previewImage(this, 'preview_${i}')" class="hidden">
                                    </label>
                                    <img id="preview_${i}" src="" alt="" class="hidden w-24 h-24 object-cover rounded-xl border-2 border-emerald-500">
                                </div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', itemHtml);
                }
            }

            // Preview uploaded image
            // Preview uploaded image - Made global for inline onchange
            window.previewImage = function(input, previewId) {
                const preview = document.getElementById(previewId);
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            };

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                const now = new Date();
                now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
                inputTglMasuk.value = now.toISOString().slice(0, 16);
                hitungTotal();
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                form.reset();
                totalHargaEl.textContent = 'Rp 0';
                document.getElementById('detailItemsContainer').innerHTML = '';
            }

            btnOpen.addEventListener('click', openModal);
            btnClose.addEventListener('click', closeModal);
            btnBatal.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

            inputJumlah.addEventListener('input', hitungTotal);

            // Collect detail items data
            function collectDetailItems() {
                const details = [];
                const container = document.getElementById('detailItemsContainer');
                const items = container.querySelectorAll('[data-item]');
                
                items.forEach((item, index) => {
                    const i = index + 1; // Or use item.dataset.item
                    const detail = {
                        id_layanan: item.querySelector(`[name="detail[${i}][id_layanan]"]`)?.value || '',
                        jenis_sepatu: item.querySelector(`[name="detail[${i}][jenis_sepatu]"]`)?.value || '',
                        warna: item.querySelector(`[name="detail[${i}][warna]"]`)?.value || '',
                        kondisi_awal: item.querySelector(`[name="detail[${i}][kondisi_awal]"]`)?.value || '',
                        catatan_khusus: item.querySelector(`[name="detail[${i}][catatan_khusus]"]`)?.value || ''
                    };
                    details.push(detail);
                });
                
                return details;
            }

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Use FormData for file upload
                const formData = new FormData();
                formData.append('id_cabang', form.id_cabang.value);
                formData.append('id_karyawan', form.id_karyawan.value);
                formData.append('id_pelanggan', form.id_pelanggan.value);
                formData.append('jumlah_item', form.jumlah_item.value);
                formData.append('total_harga', form.total_harga.value);
                formData.append('tgl_masuk', form.tgl_masuk.value);
                formData.append('tgl_estimasi_selesai', form.tgl_estimasi_selesai.value);
                formData.append('catatan', form.catatan.value);
                formData.append('metode_pembayaran', form.metode_pembayaran.value);
                formData.append('status_pembayaran', form.status_pembayaran.value);
                
                // Collect detail items
                const details = collectDetailItems();
                formData.append('detail_items', JSON.stringify(details));
                
                // Append foto files
                const jumlah = parseInt(form.jumlah_item.value) || 1;
                for (let i = 1; i <= jumlah; i++) {
                    const fotoInput = document.querySelector(`[name="foto_sebelum_${i}"]`);
                    if (fotoInput && fotoInput.files[0]) {
                        formData.append(`foto_sebelum_${i}`, fotoInput.files[0]);
                    }
                }

                try {
                    const res = await fetch(BASE_URL + 'store', {
                        method: 'POST',
                        body: formData
                    });
                    
                    if (!res.ok) {
                        const text = await res.text();
                        console.error('Server Error:', text);
                        throw new Error('Server error: ' + res.status);
                    }
                    
                    const json = await res.json();
                    
                    if (json.status === 'success') {
                        closeModal();
                        // Show success modal with print option
                        showSuccessModal(json.data.id_pesanan, json.data.nomor_pesanan);
                    } else {
                        showNotification(json.message, 'error');
                    }
                } catch (err) {
                    console.error('Submit Error:', err);
                    showNotification('Terjadi kesalahan: ' + err.message, 'error');
                }
            });
        })();

        // ============ MODAL SUCCESS PESANAN ============
        (function() {
            const modal = document.getElementById('modalSuccessPesanan');
            const btnCetak = document.getElementById('btnCetakNota');
            const btnClose = document.getElementById('btnCloseSuccess');
            const nomorEl = document.getElementById('success-nomor-pesanan');
            const idInput = document.getElementById('success-id-pesanan');

            window.showSuccessModal = function(idPesanan, nomorPesanan) {
                idInput.value = idPesanan;
                nomorEl.textContent = nomorPesanan;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            };

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                location.reload();
            }

            btnCetak.addEventListener('click', function() {
                const id = idInput.value;
                if (id) {
                    // Open nota in new tab
                    window.open(BASE_URL + 'cetak_nota/' + id, '_blank');
                }
                closeModal();
            });

            btnClose.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
        })();

        // ============ MODAL EDIT PESANAN ============
        (function() {
            const modal = document.getElementById('modalEditPesanan');
            const btnClose = document.getElementById('btnCloseEditModal');
            const btnBatal = document.getElementById('btnBatalEditModal');
            const form = document.getElementById('formEditPesanan');

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                form.reset();
                document.getElementById('editDetailItemsContainer').innerHTML = '';
            }

            btnClose.addEventListener('click', closeModal);
            btnBatal.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

            // Render detail items for edit
            function renderEditDetailItems(details, status) {
                const container = document.getElementById('editDetailItemsContainer');
                
                if (!details || details.length === 0) {
                    container.innerHTML = `
                        <div class="text-center py-8 text-gray-400">
                            <i class="fas fa-shoe-prints text-4xl mb-3 opacity-50"></i>
                            <p class="text-sm">Tidak ada detail sepatu</p>
                        </div>`;
                    return;
                }
                
                const showFotoSesudah = ['selesai', 'siap_diambil', 'sudah_diambil'].includes(status);
                
                let html = '';
                details.forEach((d, index) => {
                    const i = index + 1;
                    html += `
                        <div class="bg-white rounded-xl p-5 border border-gray-200 hover:shadow-md transition-all" data-detail-id="${d.id_detail}">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">${i}</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">${d.jenis_sepatu || 'Sepatu ' + i}</h4>
                                        <p class="text-xs text-gray-500">${d.warna || 'Warna tidak diketahui'}</p>
                                    </div>
                                </div>
                                ${d.foto_sebelum || d.foto_sesudah ? `<span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full"><i class="fas fa-image mr-1"></i>Foto tersedia</span>` : ''}
                            </div>
                            <input type="hidden" name="detail_id_${i}" value="${d.id_detail}">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-tag text-gray-400 mr-1"></i>Jenis Sepatu
                                    </label>
                                    <input type="text" name="edit_detail[${i}][jenis_sepatu]" value="${d.jenis_sepatu || ''}"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-palette text-gray-400 mr-1"></i>Warna
                                    </label>
                                    <input type="text" name="edit_detail[${i}][warna]" value="${d.warna || ''}"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-clipboard-list text-gray-400 mr-1"></i>Kondisi Awal
                                    </label>
                                    <input type="text" name="edit_detail[${i}][kondisi_awal]" value="${d.kondisi_awal || ''}"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-sticky-note text-gray-400 mr-1"></i>Catatan Khusus
                                    </label>
                                    <input type="text" name="edit_detail[${i}][catatan_khusus]" value="${d.catatan_khusus || ''}"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-all">
                                </div>
                            </div>
                            
                            <!-- Foto Section -->
                            <div class="pt-4 border-t border-gray-100">
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Foto Sebelum -->
                                    <div class="text-center">
                                        <label class="block text-xs font-medium text-gray-500 mb-2">
                                            <i class="fas fa-camera text-orange-400 mr-1"></i>Foto Sebelum
                                        </label>
                                        ${d.foto_sebelum 
                                            ? `<div class="relative inline-block">
                                                <img src="${BASE_URL}../../${d.foto_sebelum}" class="w-24 h-24 object-cover rounded-xl border-2 border-orange-200 shadow-lg" alt="Sebelum">
                                                <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full">Before</span>
                                               </div>`
                                            : `<div class="w-24 h-24 mx-auto bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                                                <i class="fas fa-image text-gray-300 text-2xl"></i>
                                               </div>`
                                        }
                                    </div>
                                    
                                    <!-- Foto Sesudah -->
                                    <div class="text-center">
                                        <label class="block text-xs font-medium text-gray-500 mb-2">
                                            <i class="fas fa-camera-retro text-green-500 mr-1"></i>Foto Sesudah
                                        </label>
                                        ${d.foto_sesudah 
                                            ? `<div class="relative inline-block">
                                                <img src="${BASE_URL}../../${d.foto_sesudah}" class="w-24 h-24 object-cover rounded-xl border-2 border-green-200 shadow-lg" alt="Sesudah">
                                                <span class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-2 py-0.5 rounded-full">After</span>
                                               </div>`
                                            : showFotoSesudah 
                                                ? `<div class="space-y-2">
                                                    <label class="w-24 h-24 mx-auto bg-emerald-50 rounded-xl flex flex-col items-center justify-center border-2 border-dashed border-teal-400 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all">
                                                        <i class="fas fa-cloud-upload-alt text-green-400 text-xl mb-1"></i>
                                                        <span class="text-xs text-green-600">Upload</span>
                                                        <input type="file" name="foto_sesudah_${i}" accept="image/*" 
                                                            onchange="previewImage(this, 'edit_preview_sesudah_${i}')" class="hidden">
                                                    </label>
                                                    <img id="edit_preview_sesudah_${i}" src="" class="hidden w-24 h-24 mx-auto object-cover rounded-xl border-2 border-green-500">
                                                   </div>`
                                                : `<div class="w-24 h-24 mx-auto bg-gray-50 rounded-xl flex flex-col items-center justify-center border border-gray-200">
                                                    <i class="fas fa-lock text-gray-300 text-lg mb-1"></i>
                                                    <span class="text-xs text-gray-400">Setelah selesai</span>
                                                   </div>`
                                        }
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                container.innerHTML = html;
            }

            // ============ MODAL VIEW DETAIL PESANAN ============
            (function() {
                const modal = document.getElementById('modalViewPesanan');
                const btnClose = document.getElementById('btnCloseViewModal');
                const btnCloseFooter = document.getElementById('btnCloseViewFooter');

                function openModal() {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeModal() {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }

                btnClose.addEventListener('click', closeModal);
                btnCloseFooter.addEventListener('click', closeModal);
                modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

                // Render detail items for view (read-only)
                function renderViewDetailItems(details) {
                    const container = document.getElementById('viewDetailItemsContainer');
                    
                    if (!details || details.length === 0) {
                        container.innerHTML = `
                            <div class="text-center py-8 text-gray-400">
                                <i class="fas fa-shoe-prints text-4xl mb-3 opacity-50"></i>
                                <p class="text-sm">Tidak ada detail sepatu</p>
                            </div>`;
                        return;
                    }
                    
                    let html = '';
                    details.forEach((d, index) => {
                        const i = index + 1;
                        html += `
                            <div class="bg-white rounded-xl p-5 border border-gray-200">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center">
                                            <span class="text-white font-bold text-sm">${i}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">${d.jenis_sepatu || 'Sepatu ' + i}</h4>
                                            <p class="text-xs text-gray-500">${d.warna || 'Warna tidak diketahui'}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Kondisi Awal</p>
                                        <p class="text-sm text-gray-800">${d.kondisi_awal || '-'}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Catatan Khusus</p>
                                        <p class="text-sm text-gray-800">${d.catatan_khusus || '-'}</p>
                                    </div>
                                </div>
                                
                                <!-- Foto Section -->
                                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                                    <!-- Foto Sebelum -->
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500 mb-2">
                                            <i class="fas fa-camera text-orange-400 mr-1"></i>Foto Sebelum
                                        </p>
                                        ${d.foto_sebelum 
                                            ? `<div class="relative inline-block">
                                                <img src="${BASE_URL}../../${d.foto_sebelum}" class="w-24 h-24 object-cover rounded-xl border-2 border-orange-200 shadow-lg cursor-pointer hover:scale-105 transition-transform" alt="Sebelum" onclick="window.open(this.src, '_blank')">
                                                <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full">Before</span>
                                               </div>`
                                            : `<div class="w-24 h-24 mx-auto bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                                                <i class="fas fa-image text-gray-300 text-2xl"></i>
                                               </div>`
                                        }
                                    </div>
                                    
                                    <!-- Foto Sesudah -->
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500 mb-2">
                                            <i class="fas fa-camera-retro text-green-500 mr-1"></i>Foto Sesudah
                                        </p>
                                        ${d.foto_sesudah 
                                            ? `<div class="relative inline-block">
                                                <img src="${BASE_URL}../../${d.foto_sesudah}" class="w-24 h-24 object-cover rounded-xl border-2 border-green-200 shadow-lg cursor-pointer hover:scale-105 transition-transform" alt="Sesudah" onclick="window.open(this.src, '_blank')">
                                                <span class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-2 py-0.5 rounded-full">After</span>
                                               </div>`
                                            : `<div class="w-24 h-24 mx-auto bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                                                <i class="fas fa-image text-gray-300 text-2xl"></i>
                                               </div>`
                                        }
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    
                    container.innerHTML = html;
                }

                // Format date helper
                function formatDate(dateStr) {
                    if (!dateStr) return '-';
                    const d = new Date(dateStr);
                    return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });
                }

                // Get status badge class
                function getStatusBadge(status) {
                    const badges = {
                        'diterima': 'bg-blue-100 text-blue-600',
                        'dalam_proses': 'bg-yellow-100 text-yellow-600',
                        'selesai': 'bg-emerald-100 text-emerald-600',
                        'siap_diambil': 'bg-green-100 text-green-600',
                        'sudah_diambil': 'bg-emerald-100 text-emerald-600',
                        'dibatalkan': 'bg-red-100 text-red-600'
                    };
                    return badges[status] || 'bg-gray-100 text-gray-600';
                }

                // Attach click handlers to view buttons
                document.querySelectorAll('.btn-view').forEach(btn => {
                    btn.addEventListener('click', async function() {
                        const id = this.dataset.id;
                        try {
                            const res = await fetch(BASE_URL + 'get/' + id);
                            const json = await res.json();
                            
                            if (json.status === 'success') {
                                const p = json.data;
                                
                                // Fill info pesanan
                                document.getElementById('view-nomor-pesanan').textContent = '#' + (p.nomor_pesanan || p.id_pesanan);
                                document.getElementById('view-pelanggan').textContent = p.nama_pelanggan || '-';
                                document.getElementById('view-layanan').textContent = p.nama_layanan || '-';
                                document.getElementById('view-tgl-masuk').textContent = formatDate(p.tgl_masuk);
                                document.getElementById('view-tgl-estimasi').textContent = formatDate(p.tgl_estimasi_selesai);
                                document.getElementById('view-jumlah-item').textContent = p.jumlah_item + ' item';
                                document.getElementById('view-catatan').textContent = p.catatan || 'Tidak ada catatan';
                                document.getElementById('view-total-harga').textContent = 'Rp ' + parseInt(p.total_harga || 0).toLocaleString('id-ID');
                                
                                // Status badge
                                const statusEl = document.getElementById('view-status');
                                const statusLabel = (p.status_pesanan || '-').replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
                                statusEl.textContent = statusLabel;
                                statusEl.className = 'inline-block px-3 py-1 rounded-full text-xs font-medium ' + getStatusBadge(p.status_pesanan);
                                
                                // Render detail items
                                renderViewDetailItems(p.detail_items || []);
                                
                                openModal();
                            } else {
                                showNotification(json.message || 'Gagal memuat data', 'error');
                            }
                        } catch (err) {
                            showNotification('Gagal memuat data: ' + err.message, 'error');
                        }
                    });
                });
            })();

            // Attach click handlers to edit buttons
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', async function() {
                    const id = this.dataset.id;
                    try {
                        const res = await fetch(BASE_URL + 'get/' + id);
                        const json = await res.json();
                        
                        if (json.status === 'success' && json.data) {
                            const p = json.data;
                            document.getElementById('edit-id_pesanan').value = p.id_pesanan;
                            document.getElementById('edit-status_pesanan').value = p.status_pesanan || '';
                            document.getElementById('edit-id_layanan').value = p.id_layanan || '';
                            document.getElementById('edit-jumlah_item').value = p.jumlah_item || 1;
                            document.getElementById('edit-total_harga').value = p.total_harga || 0;
                            document.getElementById('edit-catatan').value = p.catatan || '';
                            
                            if (p.tgl_estimasi_selesai) {
                                const dt = new Date(p.tgl_estimasi_selesai);
                                dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
                                document.getElementById('edit-tgl_estimasi_selesai').value = dt.toISOString().slice(0, 16);
                            }
                            
                            // Load and render detail items
                            renderEditDetailItems(json.detail_items || [], p.status_pesanan);
                            
                            openModal();
                        }
                    } catch (err) {
                        showNotification('Gagal memuat data: ' + err.message, 'error');
                    }
                });
            });

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Use FormData for file upload
                const formData = new FormData();
                formData.append('id_pesanan', form.id_pesanan.value);
                formData.append('status_pesanan', form.status_pesanan.value);
                formData.append('id_layanan', form.id_layanan.value);
                formData.append('jumlah_item', form.jumlah_item.value);
                formData.append('total_harga', form.total_harga.value);
                formData.append('tgl_estimasi_selesai', form.tgl_estimasi_selesai.value);
                formData.append('catatan', form.catatan.value);
                
                // Collect detail items data
                const detailContainer = document.getElementById('editDetailItemsContainer');
                const detailItems = detailContainer.querySelectorAll('[data-detail-id]');
                const details = [];
                
                detailItems.forEach((item, index) => {
                    const i = index + 1;
                    const detailId = item.dataset.detailId;
                    
                    details.push({
                        id_detail: detailId,
                        jenis_sepatu: item.querySelector(`[name="edit_detail[${i}][jenis_sepatu]"]`)?.value || '',
                        warna: item.querySelector(`[name="edit_detail[${i}][warna]"]`)?.value || '',
                        kondisi_awal: item.querySelector(`[name="edit_detail[${i}][kondisi_awal]"]`)?.value || '',
                        catatan_khusus: item.querySelector(`[name="edit_detail[${i}][catatan_khusus]"]`)?.value || ''
                    });
                    
                    // Append foto sesudah if exists
                    const fotoInput = item.querySelector(`[name="foto_sesudah_${i}"]`);
                    if (fotoInput && fotoInput.files[0]) {
                        formData.append(`foto_sesudah_${i}`, fotoInput.files[0]);
                        formData.append(`detail_id_${i}`, detailId);
                    }
                });
                
                formData.append('detail_items', JSON.stringify(details));

                try {
                    const res = await fetch(BASE_URL + 'update', {
                        method: 'POST',
                        body: formData
                    });
                    const json = await res.json();
                    
                    if (json.status === 'success') {
                        showNotification(json.message);
                        closeModal();
                        setTimeout(() => location.reload(), 500);
                    } else {
                        showNotification(json.message, 'error');
                    }
                } catch (err) {
                    showNotification('Gagal menyimpan: ' + err.message, 'error');
                }
            });
        })();

        // ============ MODAL DELETE ============
        (function() {
            const modal = document.getElementById('modalDeletePesanan');
            const btnCancel = document.getElementById('btnCancelDelete');
            const btnConfirm = document.getElementById('btnConfirmDelete');

            function openModal(id, nomor) {
                document.getElementById('delete-id').value = id;
                document.getElementById('delete-nomor').textContent = nomor;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            btnCancel.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    openModal(this.dataset.id, this.dataset.nomor);
                });
            });

            btnConfirm.addEventListener('click', async function() {
                const id = document.getElementById('delete-id').value;
                
                try {
                    const res = await fetch(BASE_URL + 'delete', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_pesanan: id })
                    });
                    const json = await res.json();
                    
                    if (json.status === 'success') {
                        showNotification(json.message);
                        closeModal();
                        setTimeout(() => location.reload(), 500);
                    } else {
                        showNotification(json.message, 'error');
                    }
                } catch (err) {
                    showNotification('Gagal menghapus: ' + err.message, 'error');
                }
            });
        })();

        // ============ SEARCH & FILTER ============
        (function() {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const table = document.getElementById('pesananTable');
            const rows = table.querySelectorAll('tbody tr');

            function filterTable() {
                const search = searchInput.value.toLowerCase();
                const status = statusFilter.value;

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const rowStatus = row.dataset.status || '';
                    
                    const matchSearch = text.includes(search);
                    const matchStatus = !status || rowStatus === status;
                    
                    row.style.display = (matchSearch && matchStatus) ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
        })();

        // ============ QUICK STATUS CHANGE ============
        (function() {
            const modal = document.getElementById('modalStatusPesanan');
            const btnCancel = document.getElementById('btnCancelStatus');
            const btnConfirm = document.getElementById('btnConfirmStatus');
            
            const statusLabels = {
                'dalam_proses': 'Dalam Proses',
                'selesai': 'Selesai',
                'siap_diambil': 'Siap Diambil',
                'sudah_diambil': 'Sudah Diambil'
            };
            
            const statusColors = {
                'dalam_proses': { bg: 'bg-yellow-100', text: 'text-yellow-600' },
                'selesai': { bg: 'bg-emerald-100', text: 'text-emerald-600' },
                'siap_diambil': { bg: 'bg-green-100', text: 'text-green-600' },
                'sudah_diambil': { bg: 'bg-emerald-100', text: 'text-emerald-600' }
            };

            function openModal(id, status) {
                document.getElementById('status-id').value = id;
                document.getElementById('status-value').value = status;
                document.getElementById('status-label').textContent = statusLabels[status] || status;
                
                // Update icon color
                const iconDiv = document.getElementById('status-icon');
                const colors = statusColors[status] || { bg: 'bg-emerald-100', text: 'text-emerald-600' };
                iconDiv.className = `w-12 h-12 flex items-center justify-center rounded-full ${colors.bg}`;
                iconDiv.querySelector('i').className = `fas fa-sync-alt ${colors.text} text-2xl`;
                
                // Update label color
                document.getElementById('status-label').className = `font-semibold ${colors.text}`;
                
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            btnCancel.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

            // Attach click handlers to quick status buttons
            document.querySelectorAll('.btn-quick-status').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const newStatus = this.dataset.status;
                    openModal(id, newStatus);
                });
            });

            // Confirm status change
            btnConfirm.addEventListener('click', async function() {
                const id = document.getElementById('status-id').value;
                const newStatus = document.getElementById('status-value').value;
                
                try {
                    const res = await fetch(BASE_URL + 'quick_status', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_pesanan: id, status_pesanan: newStatus })
                    });
                    const json = await res.json();
                    
                    if (json.status === 'success') {
                        showNotification(json.message);
                        closeModal();
                        setTimeout(() => location.reload(), 500);
                    } else {
                        showNotification(json.message, 'error');
                    }
                } catch (err) {
                    showNotification('Gagal mengubah status: ' + err.message, 'error');
                }
            });
        })();

        // ============ QUICK UPLOAD FOTO ============
        (function() {
            document.querySelectorAll('.btn-upload-foto').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    // Open edit modal which has foto upload
                    document.querySelector(`.btn-edit[data-id="${id}"]`).click();
                });
            });
        })();

        // ============ PAYMENT TOGGLE HANDLER ============
        (function() {
            const toggle = document.getElementById('add-sudah_bayar');
            const hiddenInput = document.getElementById('add-status_pembayaran');
            const label = document.getElementById('sudah-bayar-label');
            
            if (toggle) {
                toggle.addEventListener('change', function() {
                    if (this.checked) {
                        hiddenInput.value = 'sudah_bayar';
                        label.textContent = 'Sudah Dibayar';
                        label.classList.remove('text-gray-700');
                        label.classList.add('text-green-600');
                    } else {
                        hiddenInput.value = 'belum_bayar';
                        label.textContent = 'Belum Dibayar';
                        label.classList.remove('text-green-600');
                        label.classList.add('text-gray-700');
                    }
                });
            }
        })();

        // ============ CONFIRM PAYMENT HANDLER ============
        (function() {
            document.querySelectorAll('.btn-confirm-payment').forEach(btn => {
                btn.addEventListener('click', async function() {
                    const id = this.dataset.id;
                    const nomor = this.dataset.nomor;
                    const total = this.dataset.total;
                    const currentMetode = this.dataset.metode;
                    
                    // Create confirmation modal
                    const modalHtml = `
                        <div id="modalConfirmPayment" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
                                <div class="bg-white border-b p-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-gray-800">Konfirmasi Pembayaran</h2>
                                            <p class="text-gray-500 text-sm">Pesanan ${nomor}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <p class="text-gray-600 mb-2">Total Pembayaran:</p>
                                        <p class="text-3xl font-bold text-green-600">Rp ${Number(total).toLocaleString('id-ID')}</p>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-wallet text-blue-500 mr-1"></i>Metode Pembayaran
                                        </label>
                                        <select id="confirm-metode-pembayaran" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
                                            <option value="tunai" ${currentMetode === 'tunai' ? 'selected' : ''}>Tunai</option>
                                            <option value="debit" ${currentMetode === 'debit' ? 'selected' : ''}>Debit/Transfer</option>
                                            <option value="qris" ${currentMetode === 'qris' ? 'selected' : ''}>QRIS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="p-4 border-t bg-gray-50 flex justify-end gap-3">
                                    <button type="button" id="btnCancelPayment" class="px-4 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 font-medium">
                                        Batal
                                    </button>
                                    <button type="button" id="btnConfirmPayment" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium flex items-center gap-2">
                                        <i class="fas fa-check"></i>Konfirmasi Bayar
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    document.body.insertAdjacentHTML('beforeend', modalHtml);
                    const modal = document.getElementById('modalConfirmPayment');
                    
                    // Cancel button
                    document.getElementById('btnCancelPayment').addEventListener('click', () => {
                        modal.remove();
                    });
                    
                    // Close on overlay click
                    modal.addEventListener('click', (e) => {
                        if (e.target === modal) modal.remove();
                    });
                    
                    // Confirm button
                    document.getElementById('btnConfirmPayment').addEventListener('click', async () => {
                        const metode = document.getElementById('confirm-metode-pembayaran').value;
                        
                        try {
                            const res = await fetch(BASE_URL + 'confirm_payment', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ 
                                    id_pesanan: id, 
                                    metode_pembayaran: metode 
                                })
                            });
                            const json = await res.json();
                            
                            if (json.status === 'success') {
                                showNotification(json.message);
                                modal.remove();
                                setTimeout(() => location.reload(), 500);
                            } else {
                                showNotification(json.message, 'error');
                            }
                        } catch (err) {
                            showNotification('Gagal mengkonfirmasi pembayaran: ' + err.message, 'error');
                        }
                    });
                });
            });
        })();
    </script>
</body>
</html>
