<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pelanggan - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Kelola Pelanggan</h1>
                        <div class="bg-emerald-100 px-4 py-1 rounded-full">
                            <span class="text-emerald-700 text-sm font-medium" id="totalBadge"><?= isset($pelanggan) ? count($pelanggan) : 0 ?> Pelanggan</span>
                        </div>
                        <?php if(isset($cabang)): ?>
                        <div class="bg-blue-100 px-4 py-1 rounded-full">
                            <span class="text-blue-700 text-sm font-medium">
                                <i class="fas fa-store mr-1"></i><?= htmlspecialchars($cabang->nama_cabang ?? '') ?>
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                        <!-- Search -->
                        <div class="relative flex-1 md:w-80">
                            <input type="text" id="searchInput" placeholder="Cari pelanggan..."
                                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>

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
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Total Pelanggan -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Pelanggan</p>
                                <h3 class="text-2xl font-bold text-emerald-500 mt-2" id="totalCustomers"><?= isset($pelanggan) ? count($pelanggan) : 0 ?></h3>
                                <p class="text-sm text-gray-500 mt-2">Di cabang ini</p>
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
                                <h3 class="text-2xl font-bold text-blue-500 mt-2" id="activeCustomers">
                                    <?php
                                    $active_count = 0;
                                    if(isset($pelanggan)) {
                                        foreach($pelanggan as $p) {
                                            if(!empty($p->no_telp)) $active_count++;
                                        }
                                    }
                                    echo $active_count;
                                    ?>
                                </h3>
                                <p class="text-sm text-gray-500 mt-2">Dengan kontak lengkap</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-check text-blue-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Cabang Info -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Cabang Anda</p>
                                <h3 class="text-lg font-bold text-purple-500 mt-2"><?= isset($cabang) ? htmlspecialchars($cabang->nama_cabang ?? '-') : '-' ?></h3>
                                <p class="text-sm text-gray-500 mt-2"><?= isset($cabang) ? htmlspecialchars($cabang->alamat ?? '-') : '-' ?></p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-store text-purple-500"></i>
                            </div>
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
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-8 text-gray-500">Tidak ada data pelanggan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Edit Customer -->
    <div id="customerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4">
            <div class="flex items-center justify-between p-6 border-b">
                <h3 id="modalTitle" class="text-xl font-semibold text-gray-800">Edit Pelanggan</h3>
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

    <script>
        const BASE_URL = '<?= base_url() ?>';
        
        // Search functionality with debounce
        let searchTimeout;
        $('#searchInput').on('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(loadCustomers, 300);
        });
        
        function loadCustomers() {
            const search = $('#searchInput').val();
            
            $.ajax({
                url: BASE_URL + 'karyawan/pelanggan/search',
                type: 'GET',
                data: { keyword: search },
                dataType: 'json',
                success: function(response) {
                    if(response.success && response.data) {
                        updateTable(response.data);
                        $('#totalBadge').text(response.data.length + ' Pelanggan');
                        $('#totalCustomers').text(response.data.length);
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
                                </div>
                            </td>
                        </tr>
                    `;
                });
            } else {
                html = '<tr><td colspan="7" class="text-center py-8 text-gray-500">Tidak ada data pelanggan</td></tr>';
            }
            $('#customerTableBody').html(html);
        }
        
        function closeModal() {
            $('#customerModal').addClass('hidden');
        }
        
        function closeViewModal() {
            $('#viewModal').addClass('hidden');
        }

        function openAddModal() {
            $('#modalTitle').text('Tambah Pelanggan Baru');
            $('#customerForm')[0].reset();
            $('#customerId').val('');
            $('#customerModal').removeClass('hidden');
        }
        
        $('#customerForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#customerId').val();
            const isEdit = id && id !== '';
            const url = isEdit ? 
                BASE_URL + 'karyawan/pelanggan/update/' + id : 
                BASE_URL + 'karyawan/pelanggan/store';
            
            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        showNotification(response.message || 'Data pelanggan berhasil disimpan', 'success');
                        closeModal();
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showNotification(response.message || 'Terjadi kesalahan', 'error');
                    }
                },
                error: function(xhr) {
                    showNotification('Terjadi kesalahan saat menyimpan data', 'error');
                }
            });
        });
        
        function viewCustomer(id) {
            $.ajax({
                url: BASE_URL + 'karyawan/pelanggan/edit/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(customer) {
                    if(customer && !customer.error) {
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
                        showNotification(customer.error || 'Data tidak ditemukan', 'error');
                    }
                },
                error: function() {
                    showNotification('Terjadi kesalahan saat mengambil data', 'error');
                }
            });
        }
        
        function editCustomer(id) {
            $.ajax({
                url: BASE_URL + 'karyawan/pelanggan/edit/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(customer) {
                    if(customer && !customer.error) {
                        $('#modalTitle').text('Edit Pelanggan');
                        $('#customerId').val(customer.id_pelanggan);
                        $('#nama').val(customer.nama);
                        $('#no_telp').val(customer.no_telp);
                        $('#email').val(customer.email);
                        $('#alamat').val(customer.alamat);
                        $('#customerModal').removeClass('hidden');
                    } else {
                        showNotification(customer.error || 'Data tidak ditemukan', 'error');
                    }
                },
                error: function() {
                    showNotification('Terjadi kesalahan saat mengambil data', 'error');
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
    </script>
</body>
</html>
