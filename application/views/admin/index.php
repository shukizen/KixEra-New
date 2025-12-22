<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                    
                    <div class="flex items-center gap-4">
                        <!-- Search -->
                        <div class="relative hidden md:block">
                            <input type="text" placeholder="Search..." class="w-80 px-4 py-2 pr-10 border border-gray-300 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                        </div>
                        
                        <!-- Notification Bell -->
                        <div class="relative">
                            <i class="fas fa-bell text-gray-600 text-xl"></i>
                            <?php if (!empty($system_alerts)): ?>
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                <?= count($system_alerts) ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        
                        <!-- User Profile -->
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-shield text-white"></i>
                            </div>
                            <div class="hidden md:block">
                                <div class="text-sm font-medium text-gray-800">
                                    <?= $user['nama'] ?? 'Admin System' ?>
                                </div>
                                <div class="text-xs text-gray-500">Administrator</div>
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
                    <!-- Total Pemilik Usaha -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Pemilik Usaha</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= number_format($stats['total_pemilik']) ?></h3>
                                <p class="text-sm text-emerald-500 mt-2"><?= $stats['total_pemilik_active'] ?> Aktif</p>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-users text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Total Revenue -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">Rp <?= number_format($stats['total_revenue']/1000000, 1) ?>jt</h3>
                                <?php if (isset($stats['growth']['revenue'])): ?>
                                <p class="text-sm text-emerald-500 mt-2"><?= $stats['growth']['revenue'] >= 0 ? '+' : '' ?><?= $stats['growth']['revenue'] ?>% from last month</p>
                                <?php endif; ?>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pendapatan Bulan Ini -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pendapatan Bulan Ini</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">Rp <?= number_format($stats['monthly_revenue']/1000, 0) ?>k</h3>
                                <p class="text-sm text-emerald-500 mt-2">+8% from last month</p>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-chart-line text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Transaksi Pending -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Transaksi Pending</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= number_format($stats['pending_transactions']) ?></h3>
                                <p class="text-sm text-yellow-600 mt-2">Requires attention</p>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-clock text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Distribusi Status Langganan -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Status Langganan</h2>
                        <div class="h-64 flex items-center justify-center">
                            <canvas id="subscriptionChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Pertumbuhan Pengguna -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Pertumbuhan Pengguna Baru</h2>
                        <div class="h-64">
                            <canvas id="growthChart"></canvas>
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
                            <p class="text-sm font-bold text-gray-700 mb-2">System Recommendation:</p>
                            <p class="text-sm text-gray-700 mb-4">
                                <?php if ($stats['pending_transactions'] > 5): ?>
                                    Ada <?= $stats['pending_transactions'] ?> transaksi pending. Segera lakukan verifikasi untuk meningkatkan konversi pembayaran.
                                <?php elseif (isset($subscription_stats['expiring_soon']) && $subscription_stats['expiring_soon'] > 0): ?>
                                    <?= $subscription_stats['expiring_soon'] ?> langganan akan berakhir dalam 7 hari. Kirim reminder untuk renewal.
                                <?php else: ?>
                                    Sistem berjalan optimal. Total <?= $stats['total_pemilik_active'] ?> pemilik aktif menghasilkan revenue Rp <?= number_format($stats['monthly_revenue'], 0, ',', '.') ?> bulan ini.
                                <?php endif; ?>
                            </p>
                            <button onclick="window.location='<?= base_url('admin/monitoring_sistem') ?>'" 
                                    class="w-full bg-emerald-500 text-white py-2 rounded-lg hover:bg-emerald-600 transition">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Monthly Revenue Trend -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Monthly Revenue Trend</h2>
                        <div class="h-80">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Distribusi Paket -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Paket</h2>
                        <div class="h-64 flex items-center justify-center">
                            <canvas id="packageChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Bottom Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Transactions -->
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Transactions</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="border-b border-gray-200">
                                    <tr>
                                        <th class="text-center py-3 text-gray-500 font-medium">Owner</th>
                                        <th class="text-center py-3 text-gray-500 font-medium">Package</th>
                                        <th class="text-center py-3 text-gray-500 font-medium">Status</th>
                                        <th class="text-center py-3 text-gray-500 font-medium">Total</th>
                                        <th class="text-center py-3 text-gray-500 font-medium">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recent_transactions)): ?>
                                        <?php foreach (array_slice($recent_transactions, 0, 5) as $transaction): ?>
                                        <tr class="border-b border-gray-100">
                                            <td class="text-center py-4">
                                                <div class="font-medium"><?= $transaction->nama_usaha ?></div>
                                                <div class="text-sm text-gray-500"><?= $transaction->nama_pemilik ?></div>
                                            </td>
                                            <td class="text-center py-4"><?= $transaction->nama_paket ?></td>
                                            <td class="text-center py-4">
                                                <?php
                                                $status_class = '';
                                                $status_text = '';
                                                switch ($transaction->status_pembayaran) {
                                                    case 'sukses':
                                                        $status_class = 'bg-emerald-500';
                                                        $status_text = 'Completed';
                                                        break;
                                                    case 'pending':
                                                        $status_class = 'bg-yellow-500';
                                                        $status_text = 'Pending';
                                                        break;
                                                    case 'gagal':
                                                        $status_class = 'bg-red-500';
                                                        $status_text = 'Failed';
                                                        break;
                                                }
                                                ?>
                                                <span class="<?= $status_class ?> text-white px-4 py-1 rounded-full text-sm"><?= $status_text ?></span>
                                            </td>
                                            <td class="text-center py-4">Rp <?= number_format($transaction->jumlah_bayar, 0, ',', '.') ?></td>
                                            <td class="text-center py-4"><?= date('M d, Y', strtotime($transaction->tgl_transaksi)) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-8 text-gray-500">Belum ada transaksi</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Notifications & Alerts -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Notifications & Alerts</h2>
                            <div class="space-y-4">
                                <?php if (!empty($system_alerts)): ?>
                                    <?php foreach (array_slice($system_alerts, 0, 3) as $alert): ?>
                                        <?php
                                        $alert_bg = '';
                                        $alert_border = '';
                                        $alert_icon_color = '';
                                        switch ($alert['type']) {
                                            case 'warning':
                                                $alert_bg = 'bg-yellow-50';
                                                $alert_border = 'border-yellow-200';
                                                $alert_icon_color = 'text-yellow-600';
                                                break;
                                            case 'info':
                                                $alert_bg = 'bg-blue-50';
                                                $alert_border = 'border-blue-200';
                                                $alert_icon_color = 'text-blue-600';
                                                break;
                                            case 'success':
                                                $alert_bg = 'bg-emerald-100';
                                                $alert_border = 'border-emerald-500';
                                                $alert_icon_color = 'text-emerald-500';
                                                break;
                                        }
                                        ?>
                                        <!-- Alert -->
                                        <div class="<?= $alert_bg ?> border <?= $alert_border ?> rounded-xl p-4 flex items-start gap-3">
                                            <i class="fas <?= $alert['icon'] ?> <?= $alert_icon_color ?> mt-1"></i>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800"><?= $alert['title'] ?></p>
                                                <p class="text-xs text-gray-600"><?= $alert['message'] ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="bg-emerald-100 border border-emerald-500 rounded-xl p-4 flex items-start gap-3">
                                        <i class="fas fa-check-circle text-emerald-500 mt-1"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">All systems operational</p>
                                            <p class="text-xs text-gray-600">No alerts at this time</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
                            <div class="space-y-3">
                                <button onclick="window.location='<?= base_url('admin/manajemen_pengguna') ?>'" 
                                        class="w-full bg-emerald-500 text-white py-3 rounded-xl hover:bg-emerald-600 transition flex items-center justify-center gap-2">
                                    <i class="fas fa-user-plus"></i>
                                    Manage Users
                                </button>
                                <button onclick="window.location='<?= base_url('admin/paket_langganan') ?>'" 
                                        class="w-full border border-emerald-500 text-emerald-500 py-3 rounded-xl hover:bg-emerald-50 transition flex items-center justify-center gap-2">
                                    <i class="fas fa-box"></i>
                                    Manage Packages
                                </button>
                                <button onclick="window.location='<?= base_url('admin/penagihan') ?>'" 
                                        class="w-full border border-gray-300 text-gray-700 py-3 rounded-xl hover:bg-gray-50 transition flex items-center justify-center gap-2">
                                    <i class="fas fa-download"></i>
                                    Export Report
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        // Subscription Status Pie Chart
        const subscriptionCtx = document.getElementById('subscriptionChart').getContext('2d');
        new Chart(subscriptionCtx, {
            type: 'pie',
            data: {
                labels: [
                    'Aktif: <?= isset($subscription_stats["aktif"]) ? $subscription_stats["aktif"] : 0 ?>',
                    'Trial: <?= isset($subscription_stats["trial"]) ? $subscription_stats["trial"] : 0 ?>',
                    'Non-Aktif: <?= isset($subscription_stats["nonaktif"]) ? $subscription_stats["nonaktif"] : 0 ?>'
                ],
                datasets: [{
                    data: [
                        <?= isset($subscription_stats['aktif']) ? $subscription_stats['aktif'] : 0 ?>,
                        <?= isset($subscription_stats['trial']) ? $subscription_stats['trial'] : 0 ?>,
                        <?= isset($subscription_stats['nonaktif']) ? $subscription_stats['nonaktif'] : 0 ?>
                    ],
                    backgroundColor: ['#10b981', '#6ee7b7', '#d1d5db'],
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
                        labels: {
                            font: { size: 12, family: 'Inter' },
                            padding: 15
                        }
                    }
                }
            }
        });
        
        // Growth Bar Chart
        const growthCtx = document.getElementById('growthChart').getContext('2d');
        new Chart(growthCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($monthly_growth['labels']) ?>,
                datasets: [{
                    data: <?= json_encode($monthly_growth['values']) ?>,
                    backgroundColor: ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0', '#d1fae5', '#ecfdf5'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
        
        // Revenue Trend Line Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode($revenue_data['labels']) ?>,
                datasets: [{
                    label: 'Revenue',
                    data: <?= json_encode($revenue_data['values']) ?>,
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
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 12, family: 'Inter', weight: 'bold' }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value/1000) + 'k';
                            }
                        },
                        grid: { color: '#f3f4f6' }
                    },
                    x: {
                        grid: { display: false }
                    }
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
        
        // Package Distribution Pie Chart
        const packageCtx = document.getElementById('packageChart').getContext('2d');
        new Chart(packageCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode(array_map(function($label, $value) {
                    return $label . ': ' . $value;
                }, $package_distribution['labels'], $package_distribution['values'])) ?>,
                datasets: [{
                    data: <?= json_encode($package_distribution['values']) ?>,
                    backgroundColor: ['#10b981', '#6ee7b7', '#34d399'],
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
                        labels: {
                            font: { size: 11, family: 'Inter' },
                            padding: 10
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>