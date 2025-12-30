<!-- Main Content -->
<main class="flex-1 lg:ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <!-- Left: Title -->
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-semibold text-gray-800">Monitoring Sistem</h1>
                <div class="bg-emerald-100 px-4 py-1 rounded-full">
                    <span class="text-emerald-700 text-sm font-medium"><i class="fas fa-circle text-green-500 text-xs mr-2"></i>Online</span>
                </div>
            </div>

            <!-- Right: Refresh Button -->
            <button onclick="refreshAll()" class="bg-emerald-500 text-white px-6 py-2 rounded-xl hover:bg-emerald-600 transition flex items-center gap-2">
                <i class="fas fa-sync-alt"></i>
                <span>Refresh</span>
            </button>
        </div>
    </header>

    <!-- Dashboard Content -->
    <div class="p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
            <!-- Total Users -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-blue-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Total Users</p>
                        <h3 id="stat-users" class="text-xl font-bold text-gray-800"><?= $stats['total_users'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Total Pemilik -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-store text-purple-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Total Pemilik</p>
                        <h3 id="stat-pemilik" class="text-xl font-bold text-gray-800"><?= $stats['total_pemilik'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Active Subscriptions -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Langganan Aktif</p>
                        <h3 id="stat-subs" class="text-xl font-bold text-green-600"><?= $stats['active_subscriptions'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Active Today -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-clock text-yellow-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Aktif Hari Ini</p>
                        <h3 id="stat-active" class="text-xl font-bold text-yellow-600"><?= $stats['active_today'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Logs Today -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-file-alt text-red-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Log Hari Ini</p>
                        <h3 id="stat-logs-today" class="text-xl font-bold text-gray-800"><?= $stats['logs_today'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Logs This Week -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar-week text-indigo-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Log Minggu Ini</p>
                        <h3 id="stat-logs-week" class="text-xl font-bold text-gray-800"><?= $stats['logs_week'] ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Server Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-server text-emerald-500"></i> Informasi Server
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-600">PHP Version</span>
                        <span class="font-medium text-blue-600"><?= $server_info['php_version'] ?></span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-600">MySQL Version</span>
                        <span class="font-medium"><?= $server_info['mysql_version'] ?></span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-600">CodeIgniter Version</span>
                        <span class="font-medium"><?= $server_info['codeigniter_version'] ?></span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-600">Memory Limit</span>
                        <span class="font-medium"><?= $server_info['memory_limit'] ?></span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-600">Max Upload Size</span>
                        <span class="font-medium"><?= $server_info['max_upload_size'] ?></span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-600">Server Time</span>
                        <span class="font-medium"><?= $server_info['server_time'] ?></span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Timezone</span>
                        <span class="font-medium"><?= $server_info['timezone'] ?></span>
                    </div>
                </div>
            </div>

            <!-- Database Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-database text-emerald-500"></i> Informasi Database
                </h3>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-600">Nama Database</span>
                        <span class="font-medium font-mono text-sm"><?= $db_info['database_name'] ?></span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-600">Ukuran Database</span>
                        <span class="font-medium text-blue-600"><?= $db_info['database_size'] ?></span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Jumlah Tabel</span>
                        <span class="font-medium"><?= $db_info['table_count'] ?> tabel</span>
                    </div>
                </div>
                
                <!-- Recent Login History -->
                <h4 class="text-md font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <i class="fas fa-sign-in-alt text-gray-500"></i> Login Terakhir
                </h4>
                <div id="loginHistory" class="space-y-2 max-h-48 overflow-y-auto">
                    <p class="text-gray-500 text-sm">Loading...</p>
                </div>
            </div>
        </div>

        <!-- Activity Logs Section -->
        <div class="bg-white rounded-2xl shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-history text-emerald-500"></i> Activity Log
                    </h3>
                    <div class="flex flex-wrap items-center gap-3">
                        <!-- Type Filter -->
                        <select id="typeFilter" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-emerald-500">
                            <option value="">Semua Tipe</option>
                            <?php foreach ($activity_types as $type): ?>
                            <option value="<?= $type->type ?>"><?= ucfirst($type->type) ?></option>
                            <?php endforeach; ?>
                        </select>
                        
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Cari..."
                                class="w-48 px-3 py-2 pl-8 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute left-2.5 top-3 text-gray-400 text-xs"></i>
                        </div>
                        
                        <!-- Delete Old Logs -->
                        <button onclick="openCleanupModal()" class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 text-sm font-medium">
                            <i class="fas fa-trash mr-1"></i> Hapus Log Lama
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Logs Table -->
            <div class="p-6">
                <div class="overflow-x-auto max-h-96 overflow-y-auto">
                    <table class="w-full">
                        <thead class="border-b border-gray-200 sticky top-0 bg-white">
                            <tr>
                                <th class="text-left py-3 px-4 text-gray-600 font-medium text-sm">Waktu</th>
                                <th class="text-left py-3 px-4 text-gray-600 font-medium text-sm">User</th>
                                <th class="text-left py-3 px-4 text-gray-600 font-medium text-sm">Tipe</th>
                                <th class="text-left py-3 px-4 text-gray-600 font-medium text-sm">Deskripsi</th>
                                <th class="text-left py-3 px-4 text-gray-600 font-medium text-sm">IP Address</th>
                            </tr>
                        </thead>
                        <tbody id="logsTableBody">
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-500">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Cleanup Logs -->
<div id="cleanupModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4">
        <div class="p-6">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-yellow-100 flex items-center justify-center">
                <i class="fas fa-broom text-3xl text-yellow-500"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Hapus Log Lama</h3>
            <p class="text-gray-600 text-center mb-4">Hapus activity log yang lebih lama dari:</p>
            
            <select id="cleanupDays" class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-4">
                <option value="7">7 hari</option>
                <option value="14">14 hari</option>
                <option value="30" selected>30 hari</option>
                <option value="60">60 hari</option>
                <option value="90">90 hari</option>
            </select>
        </div>
        <div class="flex gap-3 p-6 border-t border-gray-200">
            <button onclick="closeCleanupModal()" class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition font-medium">
                Batal
            </button>
            <button onclick="deleteOldLogs()" class="flex-1 px-4 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition font-medium">
                <i class="fas fa-trash mr-2"></i>Hapus
            </button>
        </div>
    </div>
</div>

<script>
const BASE_URL = '<?= base_url() ?>';

// Initialize
$(document).ready(function() {
    loadLogs();
    loadLoginHistory();
    setupEventListeners();
});

function setupEventListeners() {
    // Search with debounce
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            loadLogs();
        }, 300);
    });
    
    // Type filter change
    $('#typeFilter').on('change', function() {
        loadLogs();
    });
}

function loadLogs() {
    const filters = {
        type: $('#typeFilter').val(),
        search: $('#searchInput').val()
    };
    
    $.ajax({
        url: BASE_URL + 'admin/monitoring_sistem/get_logs',
        type: 'GET',
        data: filters,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                updateLogsTable(response.data);
            }
        },
        error: function() {
            $('#logsTableBody').html('<tr><td colspan="5" class="text-center py-8 text-red-500">Gagal memuat data</td></tr>');
        }
    });
}

function formatDateTime(dateStr) {
    if (!dateStr) return '-';
    const date = new Date(dateStr);
    return date.toLocaleString('id-ID', { 
        day: '2-digit', 
        month: 'short', 
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function getTypeBadge(type) {
    const colors = {
        'login': 'bg-green-100 text-green-800',
        'logout': 'bg-gray-100 text-gray-800',
        'create': 'bg-blue-100 text-blue-800',
        'update': 'bg-yellow-100 text-yellow-800',
        'delete': 'bg-red-100 text-red-800'
    };
    const color = colors[type] || 'bg-gray-100 text-gray-800';
    return `<span class="px-2 py-1 ${color} text-xs font-medium rounded-full">${type || '-'}</span>`;
}

function updateLogsTable(logs) {
    let html = '';
    
    if (logs.length > 0) {
        logs.forEach(log => {
            html += `
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-3 px-4 text-gray-600 text-sm">${formatDateTime(log.created_at)}</td>
                    <td class="py-3 px-4">
                        <span class="text-gray-800 font-medium">${log.username || '-'}</span>
                        <span class="text-gray-400 text-xs ml-1">(${log.role || '-'})</span>
                    </td>
                    <td class="py-3 px-4">${getTypeBadge(log.activity)}</td>
                    <td class="py-3 px-4 text-gray-700 text-sm">${log.description || '-'}</td>
                    <td class="py-3 px-4 text-gray-600 text-sm font-mono">${log.ip_address || '-'}</td>
                </tr>
            `;
        });
    } else {
        html = '<tr><td colspan="5" class="text-center py-8 text-gray-500">Tidak ada data log</td></tr>';
    }
    
    $('#logsTableBody').html(html);
}

function loadLoginHistory() {
    $.ajax({
        url: BASE_URL + 'admin/monitoring_sistem/get_login_history',
        type: 'GET',
        data: { limit: 5 },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                let html = '';
                if (response.data.length > 0) {
                    response.data.forEach(log => {
                        html += `
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-emerald-500 text-xs"></i>
                                    </div>
                                    <span class="text-gray-800 text-sm font-medium">${log.username || '-'}</span>
                                </div>
                                <span class="text-gray-500 text-xs">${formatDateTime(log.created_at)}</span>
                            </div>
                        `;
                    });
                } else {
                    html = '<p class="text-gray-500 text-sm">Tidak ada data login</p>';
                }
                $('#loginHistory').html(html);
            }
        }
    });
}

function refreshAll() {
    loadLogs();
    loadLoginHistory();
    updateStats();
    showNotification('Data berhasil direfresh', 'success');
}

function updateStats() {
    $.ajax({
        url: BASE_URL + 'admin/monitoring_sistem/get_stats',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const s = response.data;
                $('#stat-users').text(s.total_users);
                $('#stat-pemilik').text(s.total_pemilik);
                $('#stat-subs').text(s.active_subscriptions);
                $('#stat-active').text(s.active_today);
                $('#stat-logs-today').text(s.logs_today);
                $('#stat-logs-week').text(s.logs_week);
            }
        }
    });
}

function openCleanupModal() {
    $('#cleanupModal').removeClass('hidden');
}

function closeCleanupModal() {
    $('#cleanupModal').addClass('hidden');
}

function deleteOldLogs() {
    const days = $('#cleanupDays').val();
    
    $.ajax({
        url: BASE_URL + 'admin/monitoring_sistem/delete_old_logs',
        type: 'POST',
        data: { days: days },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification(response.message, 'success');
                closeCleanupModal();
                loadLogs();
                updateStats();
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function() {
            showNotification('Gagal menghapus log', 'error');
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
