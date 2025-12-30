<!-- Main Content -->
<main class="flex-1 lg:ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <!-- Left: Title + Badge -->
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-semibold text-gray-800">Notifikasi</h1>
                <div class="bg-emerald-100 px-4 py-1 rounded-full">
                    <span class="text-emerald-700 text-sm font-medium" id="totalBadge"><?= count($notifications) ?> Notifikasi</span>
                </div>
            </div>

            <!-- Right: Actions -->
            <div class="flex gap-3">
                <button onclick="markAllRead()" class="bg-white border border-gray-200 text-gray-600 px-4 py-2 rounded-xl hover:bg-gray-50 transition flex items-center shadow-sm">
                    <i class="fas fa-check-double mr-2"></i>
                    <span>Tandai Semua Dibaca</span>
                </button>
                <?php if(ENVIRONMENT !== 'production'): ?>
                <a href="<?= base_url('admin/notifikasi/create_test') ?>" class="bg-emerald-500 text-white px-4 py-2 rounded-xl hover:bg-emerald-600 transition flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Test Notif</span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Total Notifications -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Notifikasi</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= count($notifications) ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-bell text-blue-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Unread Notifications -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Belum Dibaca</p>
                        <h3 class="text-3xl font-bold text-emerald-600 mt-2" id="unreadCount"><?= $unread_count ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-envelope-open text-emerald-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="font-bold text-gray-800 text-lg">Daftar Notifikasi</h2>
            </div>
            
            <div class="divide-y divide-gray-100" id="notificationList">
                <?php if(empty($notifications)): ?>
                    <div class="p-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-50 rounded-full mb-4">
                            <i class="fas fa-bell-slash text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-gray-800 font-medium mb-1">Tidak ada notifikasi</h3>
                        <p class="text-gray-500">Anda belum memiliki notifikasi apapun saat ini.</p>
                    </div>
                <?php else: ?>
                    <?php foreach($notifications as $notif): ?>
                        <div class="p-4 hover:bg-gray-50 transition-colors <?= $notif->status == 'unread' ? 'bg-emerald-50/30' : '' ?>" id="notif-<?= $notif->id_notifikasi ?>">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center <?= $notif->status == 'unread' ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-400' ?>">
                                        <i class="fas <?= $notif->status == 'unread' ? 'fa-bell' : 'fa-check' ?>"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <h4 class="font-semibold text-gray-800 mb-1 <?= $notif->status == 'unread' ? '' : 'font-normal' ?>">
                                                <?= htmlspecialchars($notif->judul) ?>
                                            </h4>
                                            <p class="text-gray-600 mb-2 text-sm"><?= htmlspecialchars($notif->pesan) ?></p>
                                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                                <span>
                                                    <i class="far fa-clock mr-1"></i>
                                                    <?= date('d M Y H:i', strtotime($notif->created_at)) ?>
                                                </span>
                                                <?php if($notif->link): ?>
                                                    <a href="<?= base_url($notif->link) ?>" class="text-emerald-600 hover:text-emerald-700 font-medium flex items-center">
                                                        Lihat Detail
                                                        <i class="fas fa-arrow-right ml-1"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if($notif->status == 'unread'): ?>
                                            <button onclick="markRead(<?= $notif->id_notifikasi ?>)" class="text-gray-400 hover:text-emerald-600 transition-colors" title="Tandai dibaca">
                                                <i class="fas fa-circle text-xs text-emerald-500"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<script>
function markRead(id) {
    fetch('<?= base_url('admin/notifikasi/mark_read/') ?>' + id, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            window.location.reload();
        }
    });
}

function markAllRead() {
    if(confirm('Tandai semua notifikasi sebagai dibaca?')) {
        fetch('<?= base_url('admin/notifikasi/mark_all_read') ?>', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                window.location.reload();
            }
        });
    }
}
</script>
