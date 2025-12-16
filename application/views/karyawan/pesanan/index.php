<!DOCTYPE html>
<html lang="id">
<head>
    <?php $this->load->view('template/header'); ?>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        
        <?php $this->load->view('template/sidebarkaryawan'); ?>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            
            <!-- Topbar (User Content starts here) -->
            <div class="bg-white shadow-sm px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <h1 class="text-xl font-semibold text-gray-800">Kelola Pesanan</h1>
                    <span class="bg-emerald-100 text-emerald-600 text-sm px-3 py-1 rounded-full">
                        1,247 Total Pesanan
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input
                            type="text"
                            placeholder="Search by customer name or order"
                            class="pl-10 pr-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500"
                        >
                    </div>

                    <select class="border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500">
                        <option>All Status</option>
                        <option>Selesai</option>
                        <option>Dalam Proses</option>
                        <option>Menunggu</option>
                        <option>Dibatalkan</option>
                    </select>

                    <button id="btnTambahPesanan" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                        <i class="fas fa-plus"></i> Tambah Pesanan
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">

                <!-- Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

                    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Total Pesanan Hari Ini</p>
                            <h3 class="text-2xl font-bold text-gray-800">126</h3>
                        </div>
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bag-shopping text-emerald-600"></i>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Pesanan Selesai</p>
                            <h3 class="text-2xl font-bold text-gray-800">89</h3>
                        </div>
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-emerald-600"></i>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Dalam Proses</p>
                            <h3 class="text-2xl font-bold text-gray-800">32</h3>
                        </div>
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-spinner text-yellow-600"></i>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Dibatalkan</p>
                            <h3 class="text-2xl font-bold text-gray-800">5</h3>
                        </div>
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-xmark text-red-600"></i>
                        </div>
                    </div>

                </div>

                <!-- Tabel Pesanan -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-gray-500">ID Pesanan</th>
                                <th class="px-4 py-3 text-left text-gray-500">Tanggal Masuk</th>
                                <th class="px-4 py-3 text-left text-gray-500">Nama Pelanggan</th>
                                <th class="px-4 py-3 text-left text-gray-500">Cabang</th>
                                <th class="px-4 py-3 text-left text-gray-500">Jenis Layanan</th>
                                <th class="px-4 py-3 text-left text-gray-500">Total</th>
                                <th class="px-4 py-3 text-left text-gray-500">Status</th>
                                <th class="px-4 py-3 text-left text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium">#KX001</td>
                                <td class="px-4 py-3">12 Jan 2024</td>
                                <td class="px-4 py-3">Ahmad Rizki</td>
                                <td class="px-4 py-3">Kota Gede</td>
                                <td class="px-4 py-3">Cuci Premium</td>
                                <td class="px-4 py-3 font-semibold">Rp 35.000</td>
                                <td class="px-4 py-3">
                                    <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-xs">
                                        Selesai
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs">
                                        Update
                                    </button>
                                </td>
                            </tr>

                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium">#KX002</td>
                                <td class="px-4 py-3">12 Jan 2024</td>
                                <td class="px-4 py-3">Sari Dewi</td>
                                <td class="px-4 py-3">Seturan</td>
                                <td class="px-4 py-3">Whitening</td>
                                <td class="px-4 py-3 font-semibold">Rp 45.000</td>
                                <td class="px-4 py-3">
                                    <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-xs">
                                        Dalam Proses
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs">
                                        Update
                                    </button>
                                </td>
                            </tr>

                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium">#KX003</td>
                                <td class="px-4 py-3">11 Jan 2024</td>
                                <td class="px-4 py-3">Budi Santoso</td>
                                <td class="px-4 py-3">Condongcatur</td>
                                <td class="px-4 py-3">Cuci Reguler</td>
                                <td class="px-4 py-3 font-semibold">Rp 25.000</td>
                                <td class="px-4 py-3">
                                    <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs">
                                        Menunggu
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs">
                                        Update
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Modal Tambah Pesanan -->
            <div id="modalTambahPesanan" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
                    <!-- Modal Header -->
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Tambah Pesanan Baru</h2>
                        <button id="btnCloseModal" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="p-6">
                        <form id="formTambahPesanan">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Nama Pelanggan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" placeholder="Masukkan nama pelanggan" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                                </div>
                                
                                <!-- No. Telepon -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                                    <input type="tel" name="no_telepon" placeholder="08xxxxxxxxxx" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                                </div>
                                
                                <!-- Jenis Layanan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Layanan</label>
                                    <select name="jenis_layanan" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                                        <option value="">-- Pilih Layanan --</option>
                                        <option value="cuci_reguler">Cuci Reguler - Rp 25.000</option>
                                        <option value="cuci_premium">Cuci Premium - Rp 35.000</option>
                                        <option value="whitening">Whitening - Rp 45.000</option>
                                        <option value="deep_clean">Deep Clean - Rp 55.000</option>
                                        <option value="repair">Repair - Rp 75.000</option>
                                    </select>
                                </div>
                                
                                <!-- Jumlah Pasang -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Pasang Sepatu</label>
                                    <input type="number" name="jumlah" min="1" value="1" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                                </div>
                                
                                <!-- Tanggal Masuk -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk</label>
                                    <input type="date" name="tanggal_masuk" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                                </div>
                                
                                <!-- Estimasi Selesai -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Estimasi Selesai</label>
                                    <input type="date" name="estimasi_selesai" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                </div>
                                
                                <!-- Catatan -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                                    <textarea name="catatan" rows="3" placeholder="Catatan tambahan (opsional)" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                                </div>
                            </div>
                            
                            <!-- Total Harga Preview -->
                            <div class="mt-6 p-4 bg-emerald-50 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 font-medium">Total Harga:</span>
                                    <span id="totalHarga" class="text-2xl font-bold text-emerald-600">Rp 0</span>
                                </div>
                            </div>
                            
                            <!-- Modal Actions -->
                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" id="btnBatalModal" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                    Batal
                                </button>
                                <button type="submit" class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg flex items-center gap-2">
                                    <i class="fas fa-save"></i> Simpan Pesanan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <?php $this->load->view('template/footer'); ?>
        </main>
    </div>

    <script>
        // Modal Tambah Pesanan
        (function() {
            const modal = document.getElementById('modalTambahPesanan');
            const btnOpen = document.getElementById('btnTambahPesanan');
            const btnClose = document.getElementById('btnCloseModal');
            const btnBatal = document.getElementById('btnBatalModal');
            const form = document.getElementById('formTambahPesanan');
            const selectLayanan = document.querySelector('select[name="jenis_layanan"]');
            const inputJumlah = document.querySelector('input[name="jumlah"]');
            const totalHargaEl = document.getElementById('totalHarga');
            const inputTanggalMasuk = document.querySelector('input[name="tanggal_masuk"]');

            // Harga layanan
            const hargaLayanan = {
                'cuci_reguler': 25000,
                'cuci_premium': 35000,
                'whitening': 45000,
                'deep_clean': 55000,
                'repair': 75000
            };

            function formatRupiah(angka) {
                return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function hitungTotal() {
                const layanan = selectLayanan.value;
                const jumlah = parseInt(inputJumlah.value) || 1;
                const harga = hargaLayanan[layanan] || 0;
                const total = harga * jumlah;
                totalHargaEl.textContent = formatRupiah(total);
            }

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                // Set tanggal hari ini
                const today = new Date().toISOString().split('T')[0];
                inputTanggalMasuk.value = today;
                hitungTotal();
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                form.reset();
                totalHargaEl.textContent = 'Rp 0';
            }

            btnOpen.addEventListener('click', openModal);
            btnClose.addEventListener('click', closeModal);
            btnBatal.addEventListener('click', closeModal);

            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Hitung total saat layanan atau jumlah berubah
            selectLayanan.addEventListener('change', hitungTotal);
            inputJumlah.addEventListener('input', hitungTotal);

            // Handle form submit (static - just show notification)
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show success notification
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-emerald-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center gap-2';
                notification.innerHTML = '<i class="fas fa-check-circle"></i> Pesanan berhasil ditambahkan!';
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.remove();
                }, 3000);
                
                closeModal();
            });
        })();
    </script>
</body>
</html>
