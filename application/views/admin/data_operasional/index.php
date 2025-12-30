<!-- Main Content -->
<main class="flex-1 lg:ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <!-- Left: Title -->
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-semibold text-gray-800">Data Operasional</h1>
                <div class="bg-emerald-100 px-4 py-1 rounded-full">
                    <span class="text-emerald-700 text-sm font-medium">Ringkasan Sistem</span>
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
        <!-- Stats Cards - Row 1 -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Total Pemilik -->
            <div class="bg-white rounded-2xl shadow-lg border border-purple-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Total Pemilik Laundry</p>
                        <h3 class="text-3xl font-bold text-purple-600 mt-2"><?= $stats['total_pemilik'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-store text-purple-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Cabang -->
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Total Cabang</p>
                        <h3 class="text-3xl font-bold text-blue-600 mt-2"><?= $stats['total_cabang'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-building text-blue-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Karyawan -->
            <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Total Karyawan</p>
                        <h3 class="text-3xl font-bold text-green-600 mt-2"><?= $stats['total_karyawan'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-green-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Pelanggan -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Total Pelanggan</p>
                        <h3 class="text-3xl font-bold text-emerald-600 mt-2"><?= $stats['total_pelanggan'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-friends text-emerald-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards - Row 2 -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Total Pesanan -->
            <div class="bg-white rounded-2xl shadow-lg border border-orange-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Total Pesanan</p>
                        <h3 class="text-3xl font-bold text-orange-600 mt-2"><?= $stats['total_pesanan'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-orange-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Pesanan Hari Ini -->
            <div class="bg-white rounded-2xl shadow-lg border border-red-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Pesanan Hari Ini</p>
                        <h3 class="text-3xl font-bold text-red-600 mt-2"><?= $stats['pesanan_hari_ini'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar-day text-red-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Layanan -->
            <div class="bg-white rounded-2xl shadow-lg border border-cyan-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Total Layanan</p>
                        <h3 class="text-3xl font-bold text-cyan-600 mt-2"><?= $stats['total_layanan'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-concierge-bell text-cyan-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Inventori -->
            <div class="bg-white rounded-2xl shadow-lg border border-indigo-100 p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-medium text-gray-500">Total Item Inventori</p>
                        <h3 class="text-3xl font-bold text-indigo-600 mt-2"><?= $stats['total_inventori'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-boxes text-indigo-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Top Pemilik -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-crown text-yellow-500"></i> Pemilik Laundry Terbaru
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="border-b border-gray-200">
                            <tr>
                                <th class="text-left py-2 px-3 text-gray-600 font-medium text-sm">Nama</th>
                                <th class="text-left py-2 px-3 text-gray-600 font-medium text-sm">Usaha</th>
                                <th class="text-center py-2 px-3 text-gray-600 font-medium text-sm">Cabang</th>
                                <th class="text-center py-2 px-3 text-gray-600 font-medium text-sm">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pemilik_list)): ?>
                                <?php foreach ($pemilik_list as $pm): ?>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-2 px-3 text-gray-800 text-sm"><?= $pm->nama ?? '-' ?></td>
                                    <td class="py-2 px-3 text-gray-600 text-sm"><?= $pm->nama_usaha ?? '-' ?></td>
                                    <td class="py-2 px-3 text-center text-gray-800 font-medium"><?= $pm->jumlah_cabang ?? 0 ?></td>
                                    <td class="py-2 px-3 text-center">
                                        <?php if (($pm->status ?? '') === 'aktif'): ?>
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Aktif</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">Nonaktif</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center py-4 text-gray-500 text-sm">Tidak ada data</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Cabang Summary -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-sitemap text-blue-500"></i> Cabang per Pemilik
                </h3>
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    <?php if (!empty($cabang_summary)): ?>
                        <?php foreach ($cabang_summary as $cs): ?>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <div>
                                <p class="text-gray-800 text-sm font-medium"><?= $cs->nama_usaha ?? '-' ?></p>
                                <p class="text-gray-500 text-xs"><?= $cs->nama_pemilik ?? '-' ?></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium"><?= $cs->jumlah_cabang ?? 0 ?> cabang</span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-gray-500 text-sm py-4">Tidak ada data</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Pesanan by Status -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Pesanan Status Chart -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-pie text-purple-500"></i> Status Pesanan
                </h3>
                <div class="grid grid-cols-2 gap-3">
                    <?php 
                    $status_colors = [
                        'pending' => 'bg-yellow-100 text-yellow-700',
                        'proses' => 'bg-blue-100 text-blue-700',
                        'selesai' => 'bg-green-100 text-green-700',
                        'diambil' => 'bg-purple-100 text-purple-700',
                        'batal' => 'bg-red-100 text-red-700'
                    ];
                    if (!empty($pesanan_by_status)):
                        foreach ($pesanan_by_status as $ps):
                            $color = $status_colors[$ps->status] ?? 'bg-gray-100 text-gray-700';
                    ?>
                    <div class="p-4 <?= $color ?> rounded-xl">
                        <p class="text-2xl font-bold"><?= $ps->jumlah ?></p>
                        <p class="text-sm font-medium capitalize"><?= $ps->status ?></p>
                    </div>
                    <?php 
                        endforeach;
                    else:
                    ?>
                    <div class="col-span-2 text-center py-4 text-gray-500 text-sm">Tidak ada data pesanan</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Pesanan -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-history text-orange-500"></i> Pesanan Terbaru
                </h3>
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    <?php if (!empty($recent_pesanan)): ?>
                        <?php foreach ($recent_pesanan as $pesanan): ?>
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <div>
                                <p class="text-gray-800 text-sm font-medium"><?= $pesanan->nama_pelanggan ?? 'Guest' ?></p>
                                <p class="text-gray-500 text-xs"><?= $pesanan->nama_cabang ?? '-' ?> • <?= date('d M Y', strtotime($pesanan->created_at)) ?></p>
                            </div>
                            <span class="px-2 py-1 <?= $status_colors[$pesanan->status_pesanan ?? ''] ?? 'bg-gray-100 text-gray-700' ?> text-xs rounded-full capitalize">
                                <?= $pesanan->status_pesanan ?? '-' ?>
                            </span>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-gray-500 text-sm py-4">Tidak ada data pesanan</p>
                    <?php endif; ?>
                </div>
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
