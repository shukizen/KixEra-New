<!-- Main Content -->
<main class="flex-1 lg:ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <!-- Left: Title + Badge -->
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-semibold text-gray-800">Paket Langganan</h1>
                <div class="bg-emerald-100 px-4 py-1 rounded-full">
                    <span class="text-emerald-700 text-sm font-medium" id="totalBadge"><?= $stats['total'] ?> Total Paket</span>
                </div>
            </div>

            <!-- Right: Search + Add Button -->
            <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                <!-- Search Bar -->
                <div class="relative flex-1 md:w-80">
                    <input type="text" id="searchInput" placeholder="Cari nama paket..."
                        class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <!-- Add Paket Button -->
                <button onclick="openAddModal()" class="bg-emerald-500 text-white px-6 py-2 rounded-xl hover:bg-emerald-600 transition flex items-center justify-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Paket</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Dashboard Content -->
    <div class="p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <!-- Total Pakets -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Paket</p>
                        <h3 id="stat-total" class="text-3xl font-bold text-gray-800 mt-2"><?= $stats['total'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-box text-emerald-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Active Pakets -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Paket Aktif</p>
                        <h3 id="stat-active" class="text-3xl font-bold text-green-600 mt-2"><?= $stats['active'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Inactive Pakets -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Paket Nonaktif</p>
                        <h3 id="stat-inactive" class="text-3xl font-bold text-gray-600 mt-2"><?= $stats['inactive'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-pause-circle text-gray-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Subscribers -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Langganan</p>
                        <h3 id="stat-subscribers" class="text-3xl font-bold text-blue-600 mt-2"><?= $stats['subscribers'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-blue-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white rounded-2xl shadow-lg mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex flex-wrap -mb-px px-6">
                    <button onclick="filterByTab('all')" id="tab-all"
                        class="tab-button py-4 px-6 border-b-2 border-emerald-500 text-emerald-600 font-medium text-sm">
                        Semua Paket
                    </button>
                    <button onclick="filterByTab('aktif')" id="tab-aktif"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Aktif
                    </button>
                    <button onclick="filterByTab('nonaktif')" id="tab-nonaktif"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Nonaktif
                    </button>
                </nav>
            </div>

            <!-- Paket Table -->
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="border-b border-gray-200">
                            <tr>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">ID</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Nama Paket</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Harga</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Durasi</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Status</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="paketTableBody">
                            <tr>
                                <td colspan="6" class="text-center py-8 text-gray-500">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Add/Edit Paket -->
<div id="paketModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 id="modalTitle" class="text-xl font-semibold text-gray-800">Tambah Paket Baru</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form id="paketForm">
            <input type="hidden" id="paketId" name="id_paket">
            <div class="p-6 space-y-4">
                <!-- Nama Paket -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Paket <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_paket" name="nama_paket" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                        placeholder="Contoh: Paket Premium">
                </div>

                <!-- Harga -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" id="harga" name="harga" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                        placeholder="Contoh: 150000">
                </div>

                <!-- Durasi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Durasi (Hari) <span class="text-red-500">*</span></label>
                    <input type="number" id="durasi" name="durasi" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                        placeholder="Contoh: 30">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                        placeholder="Deskripsi singkat tentang paket"></textarea>
                </div>

                <!-- Fitur -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fitur</label>
                    <textarea id="fitur" name="fitur" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                        placeholder="Fitur-fitur yang termasuk dalam paket (pisahkan dengan enter)"></textarea>
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

<!-- Modal View Paket Details -->
<div id="viewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-800">Detail Paket</h3>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="viewContent" class="p-6">
            <!-- Content will be loaded dynamically -->
        </div>
        <div class="flex gap-3 p-6 border-t">
            <button onclick="closeViewModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Modal Delete Confirmation -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4">
        <div class="p-6 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-100 flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-3xl text-red-500"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-600 mb-2">Apakah Anda yakin ingin menghapus paket:</p>
            <p id="deletePaketName" class="text-lg font-semibold text-red-500 mb-6"></p>
        </div>
        <div class="flex gap-3 p-6 border-t border-gray-200">
            <button onclick="closeDeleteModal()" class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition font-medium">
                Batal
            </button>
            <button id="confirmDeleteBtn" class="flex-1 px-4 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition font-medium">
                <i class="fas fa-trash mr-2"></i>Hapus
            </button>
        </div>
    </div>
</div>

<script>
const BASE_URL = '<?= base_url() ?>';
let currentFilter = { status: '', search: '' };
let deletePaketId = null;

// Initialize
$(document).ready(function() {
    loadPakets();
    setupEventListeners();
});

function setupEventListeners() {
    // Search with debounce
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            currentFilter.search = $('#searchInput').val();
            loadPakets();
        }, 300);
    });
    
    // Form submit
    $('#paketForm').on('submit', function(e) {
        e.preventDefault();
        submitForm();
    });
}

function filterByTab(tab) {
    // Update tab styling
    $('.tab-button').removeClass('border-emerald-500 text-emerald-600').addClass('border-transparent text-gray-500');
    $('#tab-' + tab).removeClass('border-transparent text-gray-500').addClass('border-emerald-500 text-emerald-600');
    
    // Set filter
    if (tab === 'all') {
        currentFilter.status = '';
    } else {
        currentFilter.status = tab;
    }
    
    loadPakets();
}

function loadPakets() {
    $.ajax({
        url: BASE_URL + 'admin/paket_langganan/get_pakets',
        type: 'GET',
        data: currentFilter,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                updateTable(response.data);
                updateStats();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading pakets:', error);
            showNotification('Gagal memuat data paket', 'error');
        }
    });
}

function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(number);
}

function updateTable(pakets) {
    let html = '';
    
    if (pakets.length > 0) {
        pakets.forEach(paket => {
            const statusBadge = paket.status === 'aktif'
                ? '<span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Aktif</span>'
                : '<span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Nonaktif</span>';
            
            html += `
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-4 px-4 text-center text-gray-700">#P${String(paket.id_paket).padStart(3, '0')}</td>
                    <td class="py-4 px-4 text-center text-gray-800 font-medium">${paket.nama_paket}</td>
                    <td class="py-4 px-4 text-center text-gray-700">${formatRupiah(paket.harga)}</td>
                    <td class="py-4 px-4 text-center text-gray-700">${paket.durasi} Hari</td>
                    <td class="py-4 px-4 text-center">${statusBadge}</td>
                    <td class="py-4 px-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="viewPaket(${paket.id_paket})" class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-lg flex items-center justify-center transition" title="Detail">
                                <i class="fas fa-eye text-sm"></i>
                            </button>
                            <button onclick="editPaket(${paket.id_paket})" class="w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg flex items-center justify-center transition" title="Edit">
                                <i class="fas fa-edit text-sm"></i>
                            </button>
                            <button onclick="toggleStatus(${paket.id_paket})" class="w-8 h-8 ${paket.status === 'aktif' ? 'bg-yellow-100 hover:bg-yellow-200 text-yellow-600' : 'bg-green-100 hover:bg-green-200 text-green-600'} rounded-lg flex items-center justify-center transition" title="${paket.status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan'}">
                                <i class="fas fa-${paket.status === 'aktif' ? 'ban' : 'check'} text-sm"></i>
                            </button>
                            <button onclick="deletePaket(${paket.id_paket}, '${paket.nama_paket}')" class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition" title="Hapus">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
    } else {
        html = '<tr><td colspan="6" class="text-center py-8 text-gray-500">Tidak ada data paket</td></tr>';
    }
    
    $('#paketTableBody').html(html);
}

function updateStats() {
    $.ajax({
        url: BASE_URL + 'admin/paket_langganan/get_pakets',
        type: 'GET',
        data: { status: '', search: '' },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const pakets = response.data;
                const total = pakets.length;
                const active = pakets.filter(p => p.status === 'aktif').length;
                
                $('#stat-total').text(total);
                $('#stat-active').text(active);
                $('#stat-inactive').text(total - active);
                $('#totalBadge').text(total + ' Total Paket');
            }
        }
    });
}

function openAddModal() {
    $('#modalTitle').text('Tambah Paket Baru');
    $('#paketForm')[0].reset();
    $('#paketId').val('');
    $('#paketModal').removeClass('hidden');
}

function closeModal() {
    $('#paketModal').addClass('hidden');
}

function viewPaket(id) {
    $.ajax({
        url: BASE_URL + 'admin/paket_langganan/get_paket/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const paket = response.data;
                let html = `
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID:</span>
                            <span class="font-medium">#P${String(paket.id_paket).padStart(3, '0')}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama:</span>
                            <span class="font-medium">${paket.nama_paket}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga:</span>
                            <span class="font-medium">${formatRupiah(paket.harga)}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Durasi:</span>
                            <span class="font-medium">${paket.durasi} Hari</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="font-medium">${paket.status === 'aktif' ? 'Aktif' : 'Nonaktif'}</span>
                        </div>
                        ${paket.deskripsi ? `
                        <div>
                            <span class="text-gray-600 block mb-1">Deskripsi:</span>
                            <p class="text-sm text-gray-800">${paket.deskripsi}</p>
                        </div>
                        ` : ''}
                        ${paket.fitur ? `
                        <div>
                            <span class="text-gray-600 block mb-1">Fitur:</span>
                            <p class="text-sm text-gray-800 whitespace-pre-line">${paket.fitur}</p>
                        </div>
                        ` : ''}
                    </div>
                `;
                
                $('#viewContent').html(html);
                $('#viewModal').removeClass('hidden');
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function() {
            showNotification('Gagal memuat detail paket', 'error');
        }
    });
}

function closeViewModal() {
    $('#viewModal').addClass('hidden');
}

function editPaket(id) {
    $.ajax({
        url: BASE_URL + 'admin/paket_langganan/get_paket/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const paket = response.data;
                $('#modalTitle').text('Edit Paket');
                $('#paketId').val(paket.id_paket);
                $('#nama_paket').val(paket.nama_paket);
                $('#harga').val(paket.harga);
                $('#durasi').val(paket.durasi);
                $('#deskripsi').val(paket.deskripsi || '');
                $('#fitur').val(paket.fitur || '');
                
                $('#paketModal').removeClass('hidden');
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function() {
            showNotification('Gagal memuat data paket', 'error');
        }
    });
}

function submitForm() {
    const paketId = $('#paketId').val();
    const url = paketId 
        ? BASE_URL + 'admin/paket_langganan/update/' + paketId
        : BASE_URL + 'admin/paket_langganan/create';
    
    const formData = $('#paketForm').serialize();
    
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification(response.message, 'success');
                closeModal();
                loadPakets();
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function() {
            showNotification('Terjadi kesalahan saat menyimpan data', 'error');
        }
    });
}

function deletePaket(id, nama) {
    deletePaketId = id;
    $('#deletePaketName').text(nama);
    $('#deleteModal').removeClass('hidden');
}

function closeDeleteModal() {
    $('#deleteModal').addClass('hidden');
    deletePaketId = null;
}

$('#confirmDeleteBtn').on('click', function() {
    if (deletePaketId) {
        $.ajax({
            url: BASE_URL + 'admin/paket_langganan/delete/' + deletePaketId,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    closeDeleteModal();
                    loadPakets();
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function() {
                showNotification('Gagal menghapus paket', 'error');
            }
        });
    }
});

function toggleStatus(id) {
    $.ajax({
        url: BASE_URL + 'admin/paket_langganan/toggle_status/' + id,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification(response.message, 'success');
                loadPakets();
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function() {
            showNotification('Gagal mengubah status paket', 'error');
        }
    });
}

function showNotification(message, type = 'info') {
    const colors = {
        success: 'from-green-500 to-emerald-600',
        error: 'from-red-500 to-pink-600',
        info: 'from-blue-500 to-cyan-600'
    };
    
    const notification = $(`
        <div class="fixed top-4 right-4 z-50 bg-gradient-to-r ${colors[type]} text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 animate-slide-in">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle"></i>
            </div>
            <div class="flex-1">
                <p class="font-medium">${message}</p>
            </div>
        </div>
    `);
    
    $('body').append(notification);
    
    setTimeout(function() {
        notification.fadeOut(300, function() {
            $(this).remove();
        });
    }, 3000);
}
</script>

<style>
@keyframes slide-in {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-slide-in {
    animation: slide-in 0.3s ease-out;
}
</style>
