<!-- Main Content -->
<main class="flex-1 lg:ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <!-- Left: Title + Badge -->
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-semibold text-gray-800">Penagihan</h1>
                <div class="bg-emerald-100 px-4 py-1 rounded-full">
                    <span class="text-emerald-700 text-sm font-medium" id="totalBadge"><?= $stats['total'] ?> Transaksi</span>
                </div>
            </div>

            <!-- Right: Search -->
            <div class="relative flex-1 md:w-80 md:flex-none">
                <input type="text" id="searchInput" placeholder="Cari nama, usaha, atau kode pembayaran..."
                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
    </header>

    <!-- Dashboard Content -->
    <div class="p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
            <!-- Total Transactions -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Total Transaksi</p>
                        <h3 id="stat-total" class="text-2xl font-bold text-gray-800 mt-1"><?= $stats['total'] ?></h3>
                    </div>
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-receipt text-emerald-500"></i>
                    </div>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-white rounded-2xl shadow-lg border border-yellow-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Pending</p>
                        <h3 id="stat-pending" class="text-2xl font-bold text-yellow-600 mt-1"><?= $stats['pending'] ?></h3>
                    </div>
                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-500"></i>
                    </div>
                </div>
            </div>

            <!-- Sukses -->
            <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Sukses</p>
                        <h3 id="stat-sukses" class="text-2xl font-bold text-green-600 mt-1"><?= $stats['sukses'] ?></h3>
                    </div>
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                </div>
            </div>

            <!-- Gagal -->
            <div class="bg-white rounded-2xl shadow-lg border border-red-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Gagal</p>
                        <h3 id="stat-gagal" class="text-2xl font-bold text-red-600 mt-1"><?= $stats['gagal'] ?></h3>
                    </div>
                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-times-circle text-red-500"></i>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Total Pendapatan</p>
                        <h3 id="stat-revenue" class="text-xl font-bold text-blue-600 mt-1"><?= 'Rp ' . number_format($stats['total_revenue'], 0, ',', '.') ?></h3>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-wallet text-blue-500"></i>
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
                        Semua
                    </button>
                    <button onclick="filterByTab('pending')" id="tab-pending"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Pending
                    </button>
                    <button onclick="filterByTab('sukses')" id="tab-sukses"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Sukses
                    </button>
                    <button onclick="filterByTab('gagal')" id="tab-gagal"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Gagal
                    </button>
                </nav>
            </div>

            <!-- Transaction Table -->
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="border-b border-gray-200">
                            <tr>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Kode</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Pemilik</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Paket</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Jumlah</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Status</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Tanggal</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="transactionTableBody">
                            <tr>
                                <td colspan="7" class="text-center py-8 text-gray-500">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal View Transaction Details -->
<div id="viewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-800">Detail Transaksi</h3>
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

<!-- Modal Update Status -->
<div id="statusModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-800">Update Status Pembayaran</h3>
            <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6">
            <p class="text-gray-600 mb-4">Pilih status baru untuk transaksi:</p>
            <input type="hidden" id="statusTransactionId">
            <div class="grid grid-cols-2 gap-3">
                <button onclick="setStatus('pending')" class="px-4 py-3 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 font-medium">
                    <i class="fas fa-clock mr-2"></i>Pending
                </button>
                <button onclick="setStatus('sukses')" class="px-4 py-3 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 font-medium">
                    <i class="fas fa-check mr-2"></i>Sukses
                </button>
                <button onclick="setStatus('gagal')" class="px-4 py-3 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 font-medium">
                    <i class="fas fa-times mr-2"></i>Gagal
                </button>
                <button onclick="setStatus('expired')" class="px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                    <i class="fas fa-calendar-times mr-2"></i>Expired
                </button>
            </div>
        </div>
        <div class="flex gap-3 p-6 border-t">
            <button onclick="closeStatusModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                Batal
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
            <p class="text-gray-600 mb-2">Apakah Anda yakin ingin menghapus transaksi:</p>
            <p id="deleteTransactionCode" class="text-lg font-semibold text-red-500 mb-6"></p>
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
let deleteTransactionId = null;

// Initialize
$(document).ready(function() {
    loadTransactions();
    setupEventListeners();
});

function setupEventListeners() {
    // Search with debounce
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            currentFilter.search = $('#searchInput').val();
            loadTransactions();
        }, 300);
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
    
    loadTransactions();
}

function loadTransactions() {
    $.ajax({
        url: BASE_URL + 'admin/penagihan/get_transactions',
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
            console.error('Error loading transactions:', error);
            showNotification('Gagal memuat data transaksi', 'error');
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

function formatDate(dateStr) {
    if (!dateStr) return '-';
    const date = new Date(dateStr);
    return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
}

function getStatusBadge(status) {
    const badges = {
        'pending': '<span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Pending</span>',
        'sukses': '<span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Sukses</span>',
        'gagal': '<span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Gagal</span>',
        'expired': '<span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Expired</span>'
    };
    return badges[status] || badges['pending'];
}

function updateTable(transactions) {
    let html = '';
    
    if (transactions.length > 0) {
        transactions.forEach(trx => {
            html += `
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-4 px-4 text-center text-gray-700 font-mono text-sm">${trx.kode_pembayaran || '-'}</td>
                    <td class="py-4 px-4 text-center">
                        <div>
                            <p class="text-gray-800 font-medium">${trx.nama_pemilik || '-'}</p>
                            <p class="text-gray-500 text-xs">${trx.nama_usaha || ''}</p>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-center text-gray-700">${trx.nama_paket || '-'}</td>
                    <td class="py-4 px-4 text-center text-gray-800 font-medium">${formatRupiah(trx.jumlah_bayar || 0)}</td>
                    <td class="py-4 px-4 text-center">${getStatusBadge(trx.status_pembayaran)}</td>
                    <td class="py-4 px-4 text-center text-gray-700 text-sm">${formatDate(trx.created_at)}</td>
                    <td class="py-4 px-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="viewTransaction(${trx.id_transaksi_langganan})" class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-lg flex items-center justify-center transition" title="Detail">
                                <i class="fas fa-eye text-sm"></i>
                            </button>
                            <button onclick="openStatusModal(${trx.id_transaksi_langganan})" class="w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg flex items-center justify-center transition" title="Update Status">
                                <i class="fas fa-edit text-sm"></i>
                            </button>
                            <button onclick="deleteTransaction(${trx.id_transaksi_langganan}, '${trx.kode_pembayaran || 'N/A'}')" class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition" title="Hapus">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
    } else {
        html = '<tr><td colspan="7" class="text-center py-8 text-gray-500">Tidak ada data transaksi</td></tr>';
    }
    
    $('#transactionTableBody').html(html);
}

function updateStats() {
    $.ajax({
        url: BASE_URL + 'admin/penagihan/get_stats',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const stats = response.data;
                $('#stat-total').text(stats.total);
                $('#stat-pending').text(stats.pending);
                $('#stat-sukses').text(stats.sukses);
                $('#stat-gagal').text(stats.gagal);
                $('#stat-revenue').text(formatRupiah(stats.total_revenue));
                $('#totalBadge').text(stats.total + ' Transaksi');
            }
        }
    });
}

function viewTransaction(id) {
    $.ajax({
        url: BASE_URL + 'admin/penagihan/get_transaction/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const trx = response.data;
                let html = `
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kode Pembayaran:</span>
                            <span class="font-mono font-medium">${trx.kode_pembayaran || '-'}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pemilik:</span>
                            <span class="font-medium">${trx.nama_pemilik || '-'}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama Usaha:</span>
                            <span class="font-medium">${trx.nama_usaha || '-'}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span class="font-medium">${trx.email || '-'}</span>
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Paket:</span>
                            <span class="font-medium">${trx.nama_paket || '-'}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga Paket:</span>
                            <span class="font-medium">${formatRupiah(trx.harga || 0)}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah Bayar:</span>
                            <span class="font-medium text-emerald-600">${formatRupiah(trx.jumlah_bayar || 0)}</span>
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span>${getStatusBadge(trx.status_pembayaran)}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Transaksi:</span>
                            <span class="font-medium">${formatDate(trx.created_at)}</span>
                        </div>
                        ${trx.tgl_bayar ? `
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Bayar:</span>
                            <span class="font-medium">${formatDate(trx.tgl_bayar)}</span>
                        </div>
                        ` : ''}
                        ${trx.tgl_akhir_langganan ? `
                        <div class="flex justify-between">
                            <span class="text-gray-600">Aktif Sampai:</span>
                            <span class="font-medium">${formatDate(trx.tgl_akhir_langganan)}</span>
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
            showNotification('Gagal memuat detail transaksi', 'error');
        }
    });
}

function closeViewModal() {
    $('#viewModal').addClass('hidden');
}

function openStatusModal(id) {
    $('#statusTransactionId').val(id);
    $('#statusModal').removeClass('hidden');
}

function closeStatusModal() {
    $('#statusModal').addClass('hidden');
}

function setStatus(status) {
    const id = $('#statusTransactionId').val();
    
    $.ajax({
        url: BASE_URL + 'admin/penagihan/update_status/' + id,
        type: 'POST',
        data: { status: status },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification(response.message, 'success');
                closeStatusModal();
                loadTransactions();
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function() {
            showNotification('Gagal mengupdate status', 'error');
        }
    });
}

function deleteTransaction(id, code) {
    deleteTransactionId = id;
    $('#deleteTransactionCode').text(code);
    $('#deleteModal').removeClass('hidden');
}

function closeDeleteModal() {
    $('#deleteModal').addClass('hidden');
    deleteTransactionId = null;
}

$('#confirmDeleteBtn').on('click', function() {
    if (deleteTransactionId) {
        $.ajax({
            url: BASE_URL + 'admin/penagihan/delete/' + deleteTransactionId,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    closeDeleteModal();
                    loadTransactions();
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function() {
                showNotification('Gagal menghapus transaksi', 'error');
            }
        });
    }
});

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
