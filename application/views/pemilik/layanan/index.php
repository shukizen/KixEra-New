<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Layanan - KixEra</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Kelola Layanan</h1>
                        <div class="bg-emerald-100 px-4 py-1 rounded-full">
                            <span class="text-emerald-700 text-sm font-medium" id="totalBadge">0 Total Layanan</span>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                        <!-- Search -->
                        <div class="relative flex-1 md:w-80">
                            <input type="text" id="searchInput" placeholder="Cari layanan..."
                                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>

                        <!-- Status Filter -->
                        <select id="statusFilter"
                            class="px-4 py-2 border border-gray-300 rounded-xl text-black focus:outline-none focus:border-emerald-500">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>

                        <!-- Add Layanan Button -->
                        <button onclick="openAddModal()" class="bg-emerald-500 text-white px-6 py-2 rounded-xl hover:bg-emerald-600 transition flex items-center justify-center gap-2">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Layanan</span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Layanan -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Layanan</p>
                                <h3 class="text-2xl font-bold text-emerald-500 mt-2" id="totalLayanan">0</h3>
                                <p class="text-sm text-gray-500 mt-2">Semua layanan</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-cogs text-emerald-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Layanan Aktif -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Layanan Aktif</p>
                                <h3 class="text-2xl font-bold text-blue-500 mt-2" id="activeLayanan">0</h3>
                                <p class="text-sm text-gray-500 mt-2">Tersedia</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check-circle text-blue-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Layanan Nonaktif -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Layanan Nonaktif</p>
                                <h3 class="text-2xl font-bold text-gray-500 mt-2" id="inactiveLayanan">0</h3>
                                <p class="text-sm text-gray-500 mt-2">Tidak tersedia</p>
                            </div>
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-times-circle text-gray-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Rata-rata Harga -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Rata-rata Harga</p>
                                <h3 class="text-2xl font-bold text-orange-500 mt-2" id="avgPrice">Rp 0</h3>
                                <p class="text-sm text-gray-500 mt-2">Per layanan</p>
                            </div>
                            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-tag text-orange-500"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Layanan Table -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Data Layanan</h2>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="border-b border-gray-200">
                                <tr>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">ID</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Nama Layanan</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Deskripsi</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Harga</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Estimasi Waktu</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Status</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="layananTableBody">
                                <?php if(isset($layanan) && count($layanan) > 0): ?>
                                    <?php foreach ($layanan as $l): ?>
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="py-4 px-4 text-center text-gray-700">#L<?= str_pad($l->id_layanan, 3, '0', STR_PAD_LEFT) ?></td>
                                        <td class="py-4 px-4 text-center text-gray-800 font-medium"><?= htmlspecialchars($l->nama_layanan ?? '') ?></td>
                                        <td class="py-4 px-4 text-center text-gray-700">
                                            <span class="line-clamp-2"><?= htmlspecialchars(substr($l->deskripsi ?? '-', 0, 50)) ?><?= strlen($l->deskripsi ?? '') > 50 ? '...' : '' ?></span>
                                        </td>
                                        <td class="py-4 px-4 text-center text-gray-700 font-medium text-emerald-600">
                                            Rp <?= number_format($l->harga ?? 0, 0, ',', '.') ?>
                                        </td>
                                        <td class="py-4 px-4 text-center text-gray-700">
                                            <?php 
                                                $waktu = $l->estimasi_waktu ?? 0;
                                                if ($waktu > 0 && $waktu % 1440 === 0) {
                                                    echo ($waktu / 1440) . ' hari';
                                                } elseif ($waktu > 0 && $waktu % 60 === 0) {
                                                    echo ($waktu / 60) . ' jam';
                                                } else {
                                                    echo $waktu . ' menit';
                                                }
                                            ?>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <?php if($l->status == 'aktif'): ?>
                                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Aktif</span>
                                            <?php else: ?>
                                                <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Nonaktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <button onclick="viewLayanan(<?= $l->id_layanan ?>)" class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-lg flex items-center justify-center transition" title="Detail">
                                                    <i class="fas fa-eye text-sm"></i>
                                                </button>
                                                <button onclick="manageBahan(<?= $l->id_layanan ?>, '<?= htmlspecialchars($l->nama_layanan ?? '', ENT_QUOTES) ?>')" class="w-8 h-8 bg-cyan-100 hover:bg-cyan-200 text-cyan-600 rounded-lg flex items-center justify-center transition" title="Kelola Bahan Baku">
                                                    <i class="fas fa-flask text-sm"></i>
                                                </button>
                                                <button onclick="editLayanan(<?= $l->id_layanan ?>)" class="w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg flex items-center justify-center transition" title="Edit">
                                                    <i class="fas fa-edit text-sm"></i>
                                                </button>
                                                <button onclick="deleteLayanan(<?= $l->id_layanan ?>, '<?= htmlspecialchars($l->nama_layanan ?? '', ENT_QUOTES) ?>')" class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition" title="Hapus">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-8 text-gray-500">Tidak ada data layanan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Add/Edit Layanan -->
    <div id="layananModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4">
            <div class="flex items-center justify-between p-6 border-b">
                <h3 id="modalTitle" class="text-xl font-semibold text-gray-800">Tambah Layanan Baru</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="layananForm">
                <input type="hidden" id="layananId" name="id_layanan">
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_layanan" name="nama_layanan" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3"
                                  placeholder="Masukkan deskripsi layanan"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" id="harga" name="harga" required min="0" step="1000"
                                   placeholder="50000"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Estimasi Waktu <span class="text-red-500">*</span></label>
                            <div class="flex gap-2">
                                <input type="number" id="estimasi_waktu_val" required min="1" placeholder="3"
                                       class="w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <select id="estimasi_waktu_unit" class="w-1/3 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                    <option value="menit">Menit</option>
                                    <option value="jam">Jam</option>
                                    <option value="hari">Hari</option>
                                </select>
                            </div>
                            <input type="hidden" id="estimasi_waktu" name="estimasi_waktu">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status" name="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
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

    <!-- Modal View Layanan -->
    <div id="viewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4">
            <div class="flex items-center justify-between p-6 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Detail Layanan</h3>
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

    <!-- Modal Kelola Bahan Baku -->
    <div id="bahanModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl mx-4">
            <div class="flex items-center justify-between p-6 border-b">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Kelola Bahan Baku</h3>
                    <p id="bahanModalSubtitle" class="text-sm text-gray-500 mt-1"></p>
                </div>
                <button onclick="closeBahanModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="bahanForm">
                <input type="hidden" id="bahanLayananId">
                <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-700">Daftar Bahan Baku yang Dibutuhkan</p>
                        <button type="button" onclick="addBahanRow()" class="px-3 py-1.5 bg-cyan-100 hover:bg-cyan-200 text-cyan-700 rounded-lg text-sm font-semibold flex items-center gap-1.5 transition">
                            <i class="fas fa-plus text-xs"></i> Tambah Bahan
                        </button>
                    </div>

                    <div id="bahanRowsContainer" class="space-y-3">
                        <!-- Baris bahan baku akan dimasukkan secara dinamis di sini -->
                    </div>

                    <div id="noBahanPlaceholder" class="text-center py-6 text-gray-500 bg-gray-50 rounded-xl">
                        <i class="fas fa-flask text-2xl text-gray-300 mb-2 block"></i>
                        Belum ada bahan baku yang dikonfigurasi untuk layanan ini.
                    </div>
                </div>
                <div class="flex gap-3 p-6 border-t bg-gray-50 rounded-b-2xl">
                    <button type="button" onclick="closeBahanModal()" class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-100 font-medium transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 font-medium shadow-md shadow-emerald-500/20 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
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
                <p class="text-gray-600 mb-2">Apakah Anda yakin ingin menghapus layanan:</p>
                <p id="deleteLayananName" class="text-lg font-semibold text-red-500 mb-6"></p>
            </div>
            <div class="flex gap-3 p-6 border-t border-gray-200">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition font-medium">
                    Batal
                </button>
                <button id="confirmDeleteBtn" onclick="confirmDelete()" class="flex-1 px-4 py-3 rounded-xl text-white font-bold transition bg-red-600 hover:bg-red-700 shadow-lg shadow-red-500/50">
                    <i class="fas fa-trash mr-2"></i>Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        const BASE_URL = '<?= base_url() ?>';
        
        // Search functionality with debounce
        let searchTimeout;
        $('#searchInput').on('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(loadLayanan, 300);
        });
        
        $('#statusFilter').on('change', loadLayanan);
        
        function loadLayanan() {
            const search = $('#searchInput').val();
            const status = $('#statusFilter').val();
            
            $.ajax({
                url: BASE_URL + 'pemilik/layanan/search',
                type: 'GET',
                data: { keyword: search, status: status },
                dataType: 'json',
                success: function(response) {
                    if(response.success && response.data) {
                        updateTable(response.data);
                        updateStats(response.data);
                        $('#totalBadge').text(response.data.length + ' Total Layanan');
                    }
                }
            });
        }
        
        function updateTable(layanan) {
            let html = '';
            if(layanan.length > 0) {
                layanan.forEach(l => {
                    const estimasi = formatEstimasiWaktu(l.estimasi_waktu);
                    const statusBadge = l.status === 'aktif' 
                        ? '<span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Aktif</span>'
                        : '<span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Nonaktif</span>';
                    
                    const deskripsi = (l.deskripsi || '-').substring(0, 50);
                    const deskripsiText = (l.deskripsi || '-').length > 50 ? deskripsi + '...' : deskripsi;
                    
                    html += `
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4 text-center text-gray-700">#L${String(l.id_layanan).padStart(3, '0')}</td>
                            <td class="py-4 px-4 text-center text-gray-800 font-medium">${l.nama_layanan || ''}</td>
                            <td class="py-4 px-4 text-center text-gray-700">
                                <span class="line-clamp-2">${deskripsiText}</span>
                            </td>
                            <td class="py-4 px-4 text-center text-gray-700 font-medium text-emerald-600">
                                Rp ${formatRupiah(l.harga)}
                            </td>
                            <td class="py-4 px-4 text-center text-gray-700">${estimasi}</td>
                            <td class="py-4 px-4 text-center">${statusBadge}</td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="viewLayanan(${l.id_layanan})" class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-lg flex items-center justify-center transition" title="Detail">
                                        <i class="fas fa-eye text-sm"></i>
                                    </button>
                                    <button onclick="manageBahan(${l.id_layanan}, '${(l.nama_layanan || '').replace(/'/g, "\\'")}')" class="w-8 h-8 bg-cyan-100 hover:bg-cyan-200 text-cyan-600 rounded-lg flex items-center justify-center transition" title="Kelola Bahan Baku">
                                        <i class="fas fa-flask text-sm"></i>
                                    </button>
                                    <button onclick="editLayanan(${l.id_layanan})" class="w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg flex items-center justify-center transition" title="Edit">
                                        <i class="fas fa-edit text-sm"></i>
                                    </button>
                                    <button onclick="deleteLayanan(${l.id_layanan}, '${(l.nama_layanan || '').replace(/'/g, "\\'")}')" class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition" title="Hapus">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            } else {
                html = '<tr><td colspan="7" class="text-center py-8 text-gray-500">Tidak ada data layanan</td></tr>';
            }
            $('#layananTableBody').html(html);
        }
        
        function updateStats(layanan) {
            const total = layanan.length;
            const aktif = layanan.filter(l => l.status === 'aktif').length;
            const nonaktif = total - aktif;
            
            let totalHarga = 0;
            layanan.forEach(l => {
                totalHarga += parseFloat(l.harga || 0);
            });
            const avgHarga = total > 0 ? totalHarga / total : 0;
            
            $('#totalLayanan').text(total);
            $('#activeLayanan').text(aktif);
            $('#inactiveLayanan').text(nonaktif);
            $('#avgPrice').text('Rp ' + formatRupiah(avgHarga));
        }
        
        function formatRupiah(angka) {
            return Math.floor(angka).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        
        function formatEstimasiWaktu(menit) {
            const m = parseInt(menit) || 0;
            if (m > 0 && m % 1440 === 0) {
                return (m / 1440) + ' hari';
            } else if (m > 0 && m % 60 === 0) {
                return (m / 60) + ' jam';
            }
            return m + ' menit';
        }

        function updateEstimasiWaktuHidden() {
            const val = parseInt($('#estimasi_waktu_val').val()) || 0;
            const unit = $('#estimasi_waktu_unit').val();
            let minutes = val;
            if (unit === 'jam') {
                minutes = val * 60;
            } else if (unit === 'hari') {
                minutes = val * 1440;
            }
            $('#estimasi_waktu').val(minutes);
        }

        // Bind events for estimasi_waktu updates
        $(document).on('input change', '#estimasi_waktu_val, #estimasi_waktu_unit', updateEstimasiWaktuHidden);
        
        function openAddModal() {
            $('#modalTitle').text('Tambah Layanan Baru');
            $('#layananForm')[0].reset();
            $('#layananId').val('');
            $('#estimasi_waktu_val').val('');
            $('#estimasi_waktu_unit').val('menit');
            $('#estimasi_waktu').val('');
            $('#status').val('aktif');
            $('#layananModal').removeClass('hidden');
        }
        
        function closeModal() {
            $('#layananModal').addClass('hidden');
        }
        
        function closeViewModal() {
            $('#viewModal').addClass('hidden');
        }
        
        $('#layananForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#layananId').val();
            const url = id ? BASE_URL + 'pemilik/layanan/update/' + id : BASE_URL + 'pemilik/layanan/store';
            
            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    showNotification('Data layanan berhasil disimpan', 'success');
                    closeModal();
                    setTimeout(() => location.reload(), 1500);
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    showNotification(response?.message || 'Terjadi kesalahan', 'error');
                }
            });
        });
        
        function viewLayanan(id) {
            $.ajax({
                url: BASE_URL + 'pemilik/layanan/edit/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(layanan) {
                    if(layanan) {
                        const estimasi = formatEstimasiWaktu(layanan.estimasi_waktu);
                        const statusBadge = layanan.status === 'aktif'
                            ? '<span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Aktif</span>'
                            : '<span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Nonaktif</span>';
                        
                        // Muat bahan baku layanan
                        $.ajax({
                            url: BASE_URL + 'pemilik/layanan/get_bahan/' + id,
                            type: 'GET',
                            dataType: 'json',
                            success: function(res) {
                                let bahanHtml = '<p class="text-gray-500 italic text-sm">Tidak ada bahan baku dikonfigurasi</p>';
                                if (res.success && res.bahan && res.bahan.length > 0) {
                                    bahanHtml = '<ul class="list-disc pl-5 space-y-1 text-sm text-gray-700">';
                                    res.bahan.forEach(b => {
                                        bahanHtml += `<li><span class="font-semibold">${b.nama_item}</span>: ${parseFloat(b.jumlah_dibutuhkan)} unit per pasang</li>`;
                                    });
                                    bahanHtml += '</ul>';
                                }

                                let html = `
                                    <div class="space-y-4">
                                        <div class="flex items-center gap-4 pb-4 border-b">
                                            <div class="w-16 h-16 bg-emerald-500 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                                ${(layanan.nama_layanan || 'L')[0].toUpperCase()}
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold">${layanan.nama_layanan}</h3>
                                                <p class="text-sm text-gray-500">#L${String(layanan.id_layanan).padStart(3, '0')}</p>
                                            </div>
                                        </div>
                                        <div class="space-y-3">
                                            ${layanan.deskripsi ? `
                                            <div class="p-3 bg-gray-50 rounded-lg">
                                                <p class="text-sm text-gray-500 mb-1">Deskripsi</p>
                                                <p class="text-gray-700">${layanan.deskripsi}</p>
                                            </div>
                                            ` : ''}
                                            <div class="grid grid-cols-2 gap-3">
                                                <div class="p-3 bg-gray-50 rounded-lg">
                                                    <p class="text-sm text-gray-500 mb-1">Harga</p>
                                                    <p class="text-lg font-bold text-emerald-600">Rp ${formatRupiah(layanan.harga)}</p>
                                                </div>
                                                <div class="p-3 bg-gray-50 rounded-lg">
                                                    <p class="text-sm text-gray-500 mb-1">Estimasi Waktu</p>
                                                    <p class="text-lg font-bold text-blue-600">${estimasi}</p>
                                                </div>
                                            </div>
                                            <div class="p-3 bg-gray-50 rounded-lg">
                                                <p class="text-sm text-gray-500 mb-2 font-medium">Bahan Baku yang Digunakan</p>
                                                ${bahanHtml}
                                            </div>
                                            <div class="p-3 bg-gray-50 rounded-lg">
                                                <p class="text-sm text-gray-500 mb-2">Status</p>
                                                ${statusBadge}
                                            </div>
                                        </div>
                                    </div>
                                `;
                                $('#viewContent').html(html);
                                $('#viewModal').removeClass('hidden');
                            },
                            error: function() {
                                showNotification('Gagal memuat bahan baku', 'error');
                            }
                        });
                    } else {
                        showNotification('Data tidak ditemukan', 'error');
                    }
                },
                error: function() {
                    showNotification('Terjadi kesalahan saat mengambil data', 'error');
                }
            });
        }
        
        function editLayanan(id) {
            $.ajax({
                url: BASE_URL + 'pemilik/layanan/edit/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(layanan) {
                    if(layanan) {
                        $('#modalTitle').text('Edit Layanan');
                        $('#layananId').val(layanan.id_layanan);
                        $('#nama_layanan').val(layanan.nama_layanan);
                        $('#deskripsi').val(layanan.deskripsi);
                        $('#harga').val(layanan.harga);
                        
                        // Parse minutes to value and unit
                        const minutes = parseInt(layanan.estimasi_waktu) || 0;
                        if (minutes > 0 && minutes % 1440 === 0) {
                            $('#estimasi_waktu_val').val(minutes / 1440);
                            $('#estimasi_waktu_unit').val('hari');
                        } else if (minutes > 0 && minutes % 60 === 0) {
                            $('#estimasi_waktu_val').val(minutes / 60);
                            $('#estimasi_waktu_unit').val('jam');
                        } else {
                            $('#estimasi_waktu_val').val(minutes);
                            $('#estimasi_waktu_unit').val('menit');
                        }
                        $('#estimasi_waktu').val(minutes);
                        
                        $('#status').val(layanan.status);
                        $('#layananModal').removeClass('hidden');
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
        
        function deleteLayanan(id, nama) {
            pendingDeleteId = id;
            document.getElementById('deleteLayananName').textContent = '"' + nama + '"';
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
                url: BASE_URL + 'pemilik/layanan/delete/' + id,
                type: 'POST',
                success: function(response) {
                    if(response.success) {
                        showNotification('Layanan berhasil dihapus', 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showNotification(response.message || 'Gagal menghapus layanan', 'error');
                    }
                },
                error: function() {
                    showNotification('Terjadi kesalahan saat menghapus data', 'error');
                }
            });
        }
        
        let availableCategories = [];

        function manageBahan(id, nama) {
            $('#bahanLayananId').val(id);
            $('#bahanModalSubtitle').text('Layanan: ' + nama);
            $('#bahanRowsContainer').empty();
            $('#noBahanPlaceholder').removeClass('hidden');
            
            // Muat bahan baku layanan
            $.ajax({
                url: BASE_URL + 'pemilik/layanan/get_bahan/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        availableCategories = res.kategori || [];
                        
                        if (res.bahan && res.bahan.length > 0) {
                            $('#noBahanPlaceholder').addClass('hidden');
                            res.bahan.forEach(b => {
                                addBahanRow(b.nama_item, b.jumlah_dibutuhkan);
                            });
                        }
                        $('#bahanModal').removeClass('hidden');
                    } else {
                        showNotification(res.message || 'Gagal memuat bahan baku', 'error');
                    }
                },
                error: function() {
                    showNotification('Terjadi kesalahan saat mengambil bahan baku', 'error');
                }
            });
        }

        function closeBahanModal() {
            $('#bahanModal').addClass('hidden');
        }

        function addBahanRow(selectedItem = '', quantity = 1) {
            $('#noBahanPlaceholder').addClass('hidden');
            
            const rowIndex = $('#bahanRowsContainer').children().length;
            
            let optionsHtml = '<option value="">Pilih Barang...</option>';
            availableCategories.forEach(cat => {
                const isSelected = cat.nama_item === selectedItem ? 'selected' : '';
                optionsHtml += `<option value="${cat.nama_item}" ${isSelected}>${cat.nama_item}</option>`;
            });

            // Fallback jika tidak ada barang terdaftar di inventori
            if (availableCategories.length === 0 && selectedItem !== '') {
                optionsHtml += `<option value="${selectedItem}" selected>${selectedItem}</option>`;
            }

            const rowHtml = `
                <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-xl border border-gray-200" id="bahan_row_${rowIndex}">
                    <div class="flex-1">
                        <select name="bahan[${rowIndex}][nama_item]" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                            ${optionsHtml}
                        </select>
                    </div>
                    <div class="w-1/3">
                        <input type="number" name="bahan[${rowIndex}][jumlah_dibutuhkan]" value="${quantity}" required min="0.01" step="0.01" placeholder="Jumlah" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                    </div>
                    <button type="button" onclick="removeBahanRow(${rowIndex})" class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition">
                        <i class="fas fa-trash text-sm"></i>
                    </button>
                </div>
            `;
            $('#bahanRowsContainer').append(rowHtml);
        }

        function removeBahanRow(index) {
            $(`#bahan_row_${index}`).remove();
            if ($('#bahanRowsContainer').children().length === 0) {
                $('#noBahanPlaceholder').removeClass('hidden');
            }
        }

        $('#bahanForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#bahanLayananId').val();
            
            $.ajax({
                url: BASE_URL + 'pemilik/layanan/save_bahan/' + id,
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showNotification(response.message || 'Bahan baku berhasil disimpan', 'success');
                        closeBahanModal();
                    } else {
                        showNotification(response.message || 'Gagal menyimpan bahan baku', 'error');
                    }
                },
                error: function() {
                    showNotification('Terjadi kesalahan saat menyimpan bahan baku', 'error');
                }
            });
        });

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
            // Initial badge count from PHP
            <?php if(isset($layanan)): ?>
            $('#totalBadge').text('<?= count($layanan) ?> Total Layanan');
            
            // Calculate and update stats
            const layananData = <?= json_encode($layanan) ?>;
            updateStats(layananData);
            <?php endif; ?>
        });
    </script>
</body>
</html>
