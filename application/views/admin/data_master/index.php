<!-- Main Content -->
<main class="flex-1 lg:ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <!-- Left: Title -->
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-semibold text-gray-800">Data Master</h1>
                <div class="bg-emerald-100 px-4 py-1 rounded-full">
                    <span class="text-emerald-700 text-sm font-medium">Konfigurasi Sistem</span>
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
            <!-- Total Paket -->
            <div class="bg-white rounded-2xl shadow-lg border border-purple-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-box text-purple-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Total Paket</p>
                        <h3 class="text-xl font-bold text-purple-600"><?= $stats['total_paket'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Paket Aktif -->
            <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Paket Aktif</p>
                        <h3 class="text-xl font-bold text-green-600"><?= $stats['paket_aktif'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Total Layanan -->
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-concierge-bell text-blue-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Total Layanan</p>
                        <h3 class="text-xl font-bold text-blue-600"><?= $stats['total_layanan'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Total Cabang -->
            <div class="bg-white rounded-2xl shadow-lg border border-orange-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-building text-orange-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Total Cabang</p>
                        <h3 class="text-xl font-bold text-orange-600"><?= $stats['total_cabang'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white rounded-2xl shadow-lg border border-cyan-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-cyan-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-cyan-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Total Users</p>
                        <h3 class="text-xl font-bold text-cyan-600"><?= $stats['total_users'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Total Inventori -->
            <div class="bg-white rounded-2xl shadow-lg border border-indigo-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-boxes text-indigo-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Inventori</p>
                        <h3 class="text-xl font-bold text-indigo-600"><?= $stats['total_inventori'] ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Paket Langganan -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-box text-purple-500"></i> Paket Langganan
                    </h3>
                    <a href="<?= base_url('admin/paket_langganan') ?>" class="text-emerald-600 hover:text-emerald-700 text-sm font-medium">
                        Kelola <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="border-b border-gray-200">
                            <tr>
                                <th class="text-left py-2 px-3 text-gray-600 font-medium text-sm">Nama</th>
                                <th class="text-right py-2 px-3 text-gray-600 font-medium text-sm">Harga</th>
                                <th class="text-center py-2 px-3 text-gray-600 font-medium text-sm">Durasi</th>
                                <th class="text-center py-2 px-3 text-gray-600 font-medium text-sm">Subscriber</th>
                                <th class="text-center py-2 px-3 text-gray-600 font-medium text-sm">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($paket_list)): ?>
                                <?php foreach ($paket_list as $paket): ?>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-2 px-3 text-gray-800 text-sm font-medium"><?= $paket->nama_paket ?? '-' ?></td>
                                    <td class="py-2 px-3 text-right text-gray-700 text-sm">Rp <?= number_format($paket->harga ?? 0, 0, ',', '.') ?></td>
                                    <td class="py-2 px-3 text-center text-gray-600 text-sm"><?= $paket->durasi ?? 0 ?> hari</td>
                                    <td class="py-2 px-3 text-center">
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium"><?= $paket->jumlah_subscriber ?? 0 ?></span>
                                    </td>
                                    <td class="py-2 px-3 text-center">
                                        <?php if (($paket->status ?? '') === 'aktif'): ?>
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Aktif</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center py-4 text-gray-500 text-sm">Tidak ada data</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Users by Role -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-users-cog text-cyan-500"></i> Users per Role
                    </h3>
                    <a href="<?= base_url('admin/user_management') ?>" class="text-emerald-600 hover:text-emerald-700 text-sm font-medium">
                        Kelola <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <?php 
                    $role_colors = [
                        'admin' => 'bg-red-100 text-red-700 border-red-200',
                        'owner' => 'bg-purple-100 text-purple-700 border-purple-200',
                        'karyawan' => 'bg-blue-100 text-blue-700 border-blue-200'
                    ];
                    $role_icons = [
                        'admin' => 'fa-user-shield',
                        'owner' => 'fa-store',
                        'karyawan' => 'fa-user-tie'
                    ];
                    if (!empty($users_by_role)):
                        foreach ($users_by_role as $role):
                            $color = $role_colors[$role->role] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                            $icon = $role_icons[$role->role] ?? 'fa-user';
                    ?>
                    <div class="p-4 <?= $color ?> rounded-xl border">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/50 rounded-full flex items-center justify-center">
                                <i class="fas <?= $icon ?>"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold"><?= $role->jumlah ?></p>
                                <p class="text-sm font-medium capitalize"><?= $role->role ?></p>
                            </div>
                        </div>
                    </div>
                    <?php 
                        endforeach;
                    else:
                    ?>
                    <div class="col-span-2 text-center py-4 text-gray-500 text-sm">Tidak ada data</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Second Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Layanan Summary -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-concierge-bell text-blue-500"></i> Layanan Populer
                </h3>
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    <?php if (!empty($layanan_summary)): ?>
                        <?php foreach ($layanan_summary as $layanan): ?>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-800 text-sm font-medium"><?= $layanan->nama_layanan ?? '-' ?></span>
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium"><?= $layanan->jumlah ?? 0 ?> cabang</span>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-gray-500 text-sm py-4">Tidak ada data</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Cabang by Pemilik -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-store text-orange-500"></i> Cabang per Pemilik
                </h3>
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    <?php if (!empty($cabang_by_city)): ?>
                        <?php foreach ($cabang_by_city as $owner): ?>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user text-gray-400"></i>
                                <span class="text-gray-800 text-sm font-medium"><?= $owner->pemilik_nama ?? 'Tidak Diketahui' ?></span>
                            </div>
                            <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-medium"><?= $owner->jumlah ?? 0 ?> cabang</span>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-gray-500 text-sm py-4">Tidak ada data</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-link text-emerald-500"></i> Kelola Data Master
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="<?= base_url('admin/paket_langganan') ?>" class="flex flex-col items-center p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition group">
                    <div class="w-12 h-12 bg-purple-100 group-hover:bg-purple-200 rounded-xl flex items-center justify-center mb-2">
                        <i class="fas fa-box text-purple-500 text-xl"></i>
                    </div>
                    <span class="text-gray-700 text-sm font-medium">Paket Langganan</span>
                </a>
                <a href="<?= base_url('admin/user_management') ?>" class="flex flex-col items-center p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition group">
                    <div class="w-12 h-12 bg-blue-100 group-hover:bg-blue-200 rounded-xl flex items-center justify-center mb-2">
                        <i class="fas fa-users-cog text-blue-500 text-xl"></i>
                    </div>
                    <span class="text-gray-700 text-sm font-medium">Manajemen User</span>
                </a>
                <a href="<?= base_url('admin/penagihan') ?>" class="flex flex-col items-center p-4 bg-green-50 rounded-xl hover:bg-green-100 transition group">
                    <div class="w-12 h-12 bg-green-100 group-hover:bg-green-200 rounded-xl flex items-center justify-center mb-2">
                        <i class="fas fa-file-invoice-dollar text-green-500 text-xl"></i>
                    </div>
                    <span class="text-gray-700 text-sm font-medium">Penagihan</span>
                </a>
                <a href="<?= base_url('admin/monitoring_sistem') ?>" class="flex flex-col items-center p-4 bg-orange-50 rounded-xl hover:bg-orange-100 transition group">
                    <div class="w-12 h-12 bg-orange-100 group-hover:bg-orange-200 rounded-xl flex items-center justify-center mb-2">
                        <i class="fas fa-desktop text-orange-500 text-xl"></i>
                    </div>
                    <span class="text-gray-700 text-sm font-medium">Monitoring</span>
                </a>
            </div>
        </div>
    </div>
</main>

<script>
const BASE_URL = '<?= base_url() ?>';

function refreshAll() {
    location.reload();
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
