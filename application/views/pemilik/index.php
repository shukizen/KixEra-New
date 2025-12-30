<!DOCTYPE html>
<html lang="id">
<head>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                    
                    <div class="flex items-center gap-6">
                        <!-- Notification Bell with Dropdown -->
                        <div class="relative">
                            <button id="notificationBtn" class="relative hover:text-emerald-500 transition">
                                <i class="fas fa-bell text-gray-600 text-xl"></i>
                                <span id="headerBadge" class="notification-badge absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center hidden">0</span>
                            </button>
                            
                            <!-- Notification Dropdown -->
                            <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 z-50">
                                <div class="p-4 border-b border-gray-200">
                                    <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                                        <i class="fas fa-bell text-emerald-500"></i>
                                        Notifikasi
                                    </h3>
                                </div>
                                <div id="headerNotificationsList" class="max-h-96 overflow-y-auto">
                                    <!-- Notifications will be loaded dynamically -->
                                    <div class="text-center py-8 text-gray-400">
                                        <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                                        <p class="text-sm">Memuat...</p>
                                    </div>
                                </div>
                                <div class="p-3 border-t border-gray-200">
                                    <button onclick="markAllAsRead()" class="text-sm text-emerald-500 hover:text-emerald-600 font-medium flex items-center justify-center gap-2 w-full">
                                        Tandai Semua Dibaca
                                        <i class="fas fa-check text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Profile with Dropdown -->
                        <div class="relative">
                            <button id="profileBtn" class="flex items-center gap-3 hover:bg-gray-50 rounded-xl px-3 py-2 transition">
                                <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div class="text-left">
                                    <div class="text-sm font-medium text-gray-800">
                                        <?php echo $this->session->userdata('nama') ? $this->session->userdata('nama') : 'Owner'; ?>
                                    </div>
                                    <div class="text-xs text-gray-500">Owner</div>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                            </button>
                            
                            <!-- Profile Dropdown -->
                            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 z-50">
                                <div class="p-4 border-b border-gray-200">
                                    <p class="font-semibold text-gray-800"><?php echo $this->session->userdata('nama') ? $this->session->userdata('nama') : 'Owner'; ?></p>
                                    <p class="text-xs text-gray-500 mt-1"><?php echo $this->session->userdata('email') ? $this->session->userdata('email') : 'owner@kixera.com'; ?></p>
                                </div>
                                <div class="py-2">
                                    <a href="<?= base_url('pemilik/pengaturan') ?>" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition text-gray-700">
                                        <i class="fas fa-cog text-gray-400"></i>
                                        <span class="text-sm font-medium">Pengaturan</span>
                                    </a>
                                    <a href="<?= base_url('pemilik/pengaturan#password') ?>" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition text-gray-700">
                                        <i class="fas fa-key text-gray-400"></i>
                                        <span class="text-sm font-medium">Ganti Password</span>
                                    </a>
                                </div>
                                <div class="border-t border-gray-200">
                                    <a href="<?= base_url('auth/logout') ?>" class="flex items-center gap-3 px-4 py-3 hover:bg-red-50 transition text-red-600">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span class="text-sm font-medium">Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Flash Messages -->
                <?php if($this->session->flashdata('success')): ?>
                <div id="alert-success" class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm relative fade-in">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span><?= $this->session->flashdata('success') ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('error')): ?>
                <div id="alert-error" class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm relative fade-in">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?= $this->session->flashdata('error') ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Pesanan -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Pesanan Hari ini</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo number_format($total_orders_today); ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pendapatan -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pendapatan Bulanan</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">Rp <?php echo number_format($monthly_revenue, 0, ',', '.'); ?></h3>
                                <p class="text-sm text-emerald-500 mt-2">
                                    <?php echo ($revenue_growth >= 0 ? '+' : '') . number_format($revenue_growth, 1); ?>% from last month
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pelanggan Aktif -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pelanggan Aktif</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo number_format($active_customers); ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-users text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pending Pickups -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pending Pickups</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo number_format($pending_pickups); ?></h3>
                                <?php if($pending_pickups > 0): ?>
                                    <p class="text-sm text-yellow-600 mt-2">Requires attention</p>
                                <?php endif; ?>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-truck text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Performa Cabang -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Performa Cabang</h2>
                        <div class="h-64 flex items-center justify-center">
                            <canvas id="branchChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Volume Pelanggan Per Service -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Volume Pelanggan Per Service</h2>
                        <div class="h-64">
                            <canvas id="serviceChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- KixEra AI Insight -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-lightbulb text-emerald-500"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">KixEra AI Insight</h2>
                        </div>
                        <div class="bg-emerald-100 rounded-xl p-4">
                            <p class="text-sm font-bold text-gray-700 mb-2">Recommendation:</p>
                            <p class="text-sm text-gray-700 mb-4">
                                <?php if($pending_pickups > 5): ?>
                                    High number of pending pickups. Consider sending reminder SMS to customers to free up space.
                                <?php else: ?>
                                    Retention by offering a loyalty discount this month. Based on customer behavior, 
                                    a 15% discount could boost retention by 23%.
                                <?php endif; ?>
                            </p>
                            <button onclick="window.location='<?= base_url('pemilik/rekomendasi') ?>'" 
                                    class="w-full bg-emerald-500 text-white py-2 rounded-lg hover:bg-emerald-600 transition">
                                View Details
                            </button>

                        </div>
                    </div>
                </div>
                
                <!-- Monthly Revenue Trend -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Monthly Revenue Trend (<?php echo date('Y'); ?>)</h2>
                        <div class="h-80">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Distribusi Servis -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Servis</h2>
                        <div class="h-64 flex items-center justify-center">
                            <canvas id="distributionChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Bottom Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Orders -->
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Orders</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="border-b border-gray-200">
                                    <tr>
                                        <th class="text-center py-3 text-gray-500 font-medium">Customer</th>
                                        <th class="text-center py-3 text-gray-500 font-medium">Service</th>
                                        <th class="text-center py-3 text-gray-500 font-medium">Status</th>
                                        <th class="text-center py-3 text-gray-500 font-medium">Total</th>
                                        <th class="text-center py-3 text-gray-500 font-medium">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($recent_orders)): ?>
                                        <?php foreach($recent_orders as $order): ?>
                                        <tr class="border-b border-gray-100">
                                            <td class="text-center py-4"><?php echo htmlspecialchars($order->nama_pelanggan); ?></td>
                                            <td class="text-center py-4"><?php echo htmlspecialchars($order->nama_layanan); ?></td>
                                            <td class="text-center py-4">
                                                <span class="px-4 py-1 rounded-full text-sm text-white" 
                                                      style="background-color: <?php 
                                                          switch($order->status_pesanan) {
                                                              case 'selesai': echo '#10b981'; break;
                                                              case 'dalam_proses': echo '#eab308'; break;
                                                              case 'siap_diambil': echo '#3b82f6'; break;
                                                              default: echo '#6b7280';
                                                          }
                                                      ?>">
                                                    <?php echo ucwords(str_replace('_', ' ', $order->status_pesanan)); ?>
                                                </span>
                                            </td>
                                            <td class="text-center py-4">Rp <?php echo number_format($order->total_harga, 0, ',', '.'); ?></td>
                                            <td class="text-center py-4"><?php echo date('M d, Y', strtotime($order->tgl_masuk)); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-gray-500">Belum ada pesanan terbaru.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Right Column - Extended Notifications -->
                    <div class="space-y-6">
                        <!-- Notifications & Alerts (Extended) -->
                         <div class="bg-white rounded-2xl shadow-lg p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-bell text-emerald-500"></i>
                                    Notifikasi
                                </h2>
                                <button onclick="markAllAsRead()" class="text-xs text-emerald-500 hover:text-emerald-600 font-medium">
                                    Tandai semua dibaca
                                </button>
                            </div>
                            
                            <div id="notificationsList" class="space-y-3">
                                <!-- Notifications will be loaded dynamically here -->
                                <div class="text-center py-8 text-gray-400">
                                    <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                                    <p class="text-sm">Memuat notifikasi...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Pass PHP data to JS -->
    <script>
        var branchData = <?php echo json_encode($branch_performance); ?>;
        var serviceData = <?php echo json_encode($service_volume); ?>;
        var revenueData = <?php echo json_encode($revenue_trend); ?>;
    </script>

    <script>
        // Utilities
        function formatRupiah(num) {
            return 'Rp ' + num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        }

        // 1. Branch Performance Pie Chart
        const branchCtx = document.getElementById('branchChart').getContext('2d');
        const branchLabels = branchData.map(item => item.label);
        const branchValues = branchData.map(item => item.value);
        
        new Chart(branchCtx, {
            type: 'pie',
            data: {
                labels: branchLabels,
                datasets: [{
                    data: branchValues,
                    backgroundColor: ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { size: 12, family: 'Inter' }, padding: 15 }
                    },
                    tooltip: {
                         callbacks: {
                             label: function(context) {
                                 let label = context.label || '';
                                 if (label) { label += ': '; }
                                 if (context.parsed !== null) {
                                     label += formatRupiah(context.parsed);
                                 }
                                 return label;
                             }
                         }
                    }
                }
            }
        });
        
        // 2. Service Volume Bar Chart
        const serviceCtx = document.getElementById('serviceChart').getContext('2d');
        const serviceLabels = serviceData.map(item => item.nama_layanan);
        const serviceValues = serviceData.map(item => item.total);

        new Chart(serviceCtx, {
            type: 'bar',
            data: {
                labels: serviceLabels,
                datasets: [{
                    data: serviceValues,
                    backgroundColor: ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0', '#059669'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                    x: { grid: { display: false } }
                }
            }
        });
        
        // 3. Revenue Trend Line Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        // Need to process revenueData (month/total) to full array
        // Assuming revenueData is array of objects {bulan: "1", total: "50000", ...}
        const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        let revLabels = [];
        let revValues = [];
        
        // Initialize 12 months with 0
        let monthlyTotals = new Array(12).fill(0);
        
        if (revenueData && Array.isArray(revenueData)) {
            revenueData.forEach(item => {
                let monthIdx = parseInt(item.bulan) - 1;
                if (monthIdx >= 0 && monthIdx < 12) {
                    monthlyTotals[monthIdx] = parseInt(item.total);
                }
            });
        }
        
        // Use up to current month or full year? Let's show full year
        revLabels = monthNames;
        revValues = monthlyTotals;

        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revLabels,
                datasets: [{
                    label: 'Revenue',
                    data: revValues,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                         callbacks: {
                             label: function(context) {
                                 return 'Revenue: ' + formatRupiah(context.parsed.y);
                             }
                         }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) { return value/1000 + 'k'; }
                        },
                        grid: { color: '#f3f4f6' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
        
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const successAlert = document.getElementById('alert-success');
            const errorAlert = document.getElementById('alert-error');
            if (successAlert) successAlert.style.display = 'none';
            if (errorAlert) errorAlert.style.display = 'none';
        }, 5000);

        // 4. Service Distribution Pie Chart (Using same data as Service Volume)
        const distributionCtx = document.getElementById('distributionChart').getContext('2d');
        new Chart(distributionCtx, {
            type: 'doughnut',
            data: {
                labels: serviceLabels,
                datasets: [{
                    data: serviceValues,
                    backgroundColor: ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0', '#059669'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { font: { size: 11, family: 'Inter' }, padding: 10 }
                    }
                }
            }
        });
        
        // Dropdown Toggle Functionality
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        
        // Toggle Notification Dropdown
        notificationBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationDropdown.classList.toggle('hidden');
            profileDropdown.classList.add('hidden'); // Close profile dropdown
        });
        
        // Toggle Profile Dropdown
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
            notificationDropdown.classList.add('hidden'); // Close notification dropdown
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!notificationBtn.contains(e.target) && !notificationDropdown.contains(e.target)) {
                notificationDropdown.classList.add('hidden');
            }
            if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
        
        // Close dropdowns with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                notificationDropdown.classList.add('hidden');
                profileDropdown.classList.add('hidden');
            }
        });

        // ============================================
        // NOTIFICATION SYSTEM
        // ============================================
        const BASE_URL = '<?= base_url() ?>';
        
        // Format relative time
        function timeAgo(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const seconds = Math.floor((now - date) / 1000);
            
            if (seconds < 60) return 'Baru saja';
            if (seconds < 3600) return Math.floor(seconds / 60) + ' menit yang lalu';
            if (seconds < 86400) return Math.floor(seconds / 3600) + ' jam yang lalu';
            if (seconds < 604800) return Math.floor(seconds / 86400) + ' hari yang lalu';
            return Math.floor(seconds / 604800) + ' minggu yang lalu';
        }

        // Get icon and color based on notification type
        function getNotificationStyle(type) {
            const styles = {
                'order': { icon: 'fas fa-shopping-cart', color: 'emerald' },
                'payment': { icon: 'fas fa-money-bill-wave', color: 'blue' },
                'pickup': { icon: 'fas fa-truck', color: 'orange' },
                'general': { icon: 'fas fa-info-circle', color: 'gray' }
            };
            return styles[type] || styles.general;
        }

        // Fetch notifications from API
        function loadNotifications() {
           fetch(BASE_URL + 'pemilik/pemilik_dashboard/get_notifications')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderNotifications(data.notifications);
                        renderHeaderNotifications(data.notifications);
                        updateBadgeCount(data.unread_count);
                    } else {
                        // Show error message from API
                        const errorMsg = data.error || data.message || 'Gagal memuat notifikasi';
                        const errorHtml = '<div class="text-center py-8 text-red-500"><i class="fas fa-exclamation-triangle text-2xl mb-2"></i><p class="text-sm">' + errorMsg + '</p></div>';
                        document.getElementById('notificationsList').innerHTML = errorHtml;
                        document.getElementById('headerNotificationsList').innerHTML = errorHtml;
                        console.error('API Error:', data);
                    }
                })
                .catch(error => {
                    console.error('Error loading notifications:', error);
                    const errorHtml = '<div class="text-center py-8 text-red-500"><i class="fas fa-exclamation-triangle text-2xl mb-2"></i><p class="text-sm">Gagal memuat notifikasi</p></div>';
                    document.getElementById('notificationsList').innerHTML = errorHtml;
                    document.getElementById('headerNotificationsList').innerHTML = errorHtml;
                });
        }

        // Render notifications in sidebar
        function renderNotifications(notifications) {
            const container = document.getElementById('notificationsList');
            
            if (!notifications || notifications.length === 0) {
                container.innerHTML = '<div class="text-center py-8 text-gray-400"><i class="fas fa-bell-slash text-2xl mb-2"></i><p class="text-sm">Belum ada notifikasi</p></div>';
                return;
            }

            let html = '';
            notifications.forEach(notif => {
                const style = getNotificationStyle(notif.type);
                const isRead = notif.is_read == 1;
                const bgClass = isRead ? 'bg-gray-50' : 'bg-white';
                const dotColor = style.color;
                
                html += '<div class="' + bgClass + ' border border-' + dotColor + '-200 rounded-xl p-4 hover:shadow-md transition cursor-pointer" onclick="markAsRead(' + notif.id_notification + ')">';
                html += '<div class="flex items-start gap-3">';
                html += '<div class="w-8 h-8 bg-' + dotColor + '-100 rounded-full flex items-center justify-center flex-shrink-0">';
                html += '<i class="' + style.icon + ' text-' + dotColor + '-500 text-sm"></i>';
                html += '</div>';
                html += '<div class="flex-1 min-w-0">';
                html += '<div class="flex items-start justify-between gap-2">';
                html += '<p class="text-sm font-medium text-gray-800 ' + (isRead ? 'opacity-70' : '') + '">' + notif.title + '</p>';
                if (!isRead) html += '<div class="w-2 h-2 bg-emerald-500 rounded-full flex-shrink-0 mt-1"></div>';
                html += '</div>';
                if (notif.message) html += '<p class="text-xs text-gray-600 mt-1 ' + (isRead ? 'opacity-60' : '') + '">' + notif.message + '</p>';
                html += '<p class="text-xs text-gray-400 mt-2">' + timeAgo(notif.created_at) + '</p>';
                html += '</div></div></div>';
            });
            
            container.innerHTML = html;
        }

        // Render notifications in header dropdown  
        function renderHeaderNotifications(notifications) {
            const container = document.getElementById('headerNotificationsList');
            
            if (!notifications || notifications.length === 0) {
                container.innerHTML = '<div class="text-center py-8 text-gray-400"><i class="fas fa-bell-slash text-2xl mb-2"></i><p class="text-sm">Belum ada notifikasi</p></div>';
                return;
            }

            let html = '';
            const displayNotifs = notifications.slice(0, 5); // Only show 5 in header
            displayNotifs.forEach(notif => {
                const style = getNotificationStyle(notif.type);
                const isRead = notif.is_read == 1;
                const dotColor = style.color;
                
                html += '<div class="p-4 hover:bg-gray-50 border-b border-gray-100 cursor-pointer transition" onclick="markAsRead(' + notif.id_notification + ')">';
                html += '<div class="flex items-start gap-3">';
                if (!isRead) {
                    html += '<div class="w-2 h-2 bg-' + dotColor + '-500 rounded-full mt-2"></div>';
                } else {
                    html += '<div class="w-2 h-2 bg-gray-300 rounded-full mt-2"></div>';
                }
                html += '<div class="flex-1">';
                html += '<p class="text-sm font-medium text-gray-800 ' + (isRead ? 'opacity-60' : '') + '">' + notif.title + '</p>';
                html += '<p class="text-xs text-gray-500 mt-1">' + timeAgo(notif.created_at) + '</p>';
                html += '</div></div></div>';
            });
            
            container.innerHTML = html;
        }

        // Update badge count
        function updateBadgeCount(count) {
            const badgeElements = document.querySelectorAll('.notification-badge');
            badgeElements.forEach(badge => {
                if (count > 0) {
                    badge.textContent = count;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            });
        }

        // Mark notification as read
        function markAsRead(id) {
            fetch(BASE_URL + 'pemilik/pemilik_dashboard/mark_notification_read/' + id, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadNotifications(); // Reload notifications
                }
            });
        }

        // Mark all as read
        function markAllAsRead() {
            fetch(BASE_URL + 'pemilik/pemilik_dashboard/mark_all_read', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadNotifications(); // Reload notifications
                }
            });
        }

        // Load notifications on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadNotifications();
            
            // Refresh notifications every 30 seconds
            setInterval(loadNotifications, 30000);
        });
    
    
    </script>
</body>
</html>