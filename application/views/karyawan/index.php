<!DOCTYPE html>
<html lang="id">
<head>
    <?php $this->load->view('template/header'); ?>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        
        <?php $this->load->view('template/sidebarkaryawan'); ?>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                    
                    <div class="flex items-center gap-6">
                        <!-- User Profile with Dropdown -->
                        <div class="relative">
                            <button id="profileBtn" class="flex items-center gap-3 hover:bg-gray-50 rounded-xl px-3 py-2 transition">
                                <?php 
                                $foto_profil = $this->session->userdata('foto_profil');
                                if (!empty($foto_profil) && file_exists(FCPATH . $foto_profil)): 
                                ?>
                                    <img src="<?= base_url($foto_profil) ?>" class="w-10 h-10 object-cover rounded-full" alt="Profile">
                                <?php else: ?>
                                    <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="text-left">
                                    <div class="text-sm font-medium text-gray-800">
                                        <?php echo $this->session->userdata('nama') ? $this->session->userdata('nama') : 'Karyawan'; ?>
                                    </div>
                                    <div class="text-xs text-gray-500">Karyawan</div>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                            </button>
                            
                            <!-- Profile Dropdown -->
                            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 z-50">
                                <div class="p-4 border-b border-gray-200">
                                    <p class="font-semibold text-gray-800"><?php echo $this->session->userdata('nama') ? $this->session->userdata('nama') : 'Karyawan'; ?></p>
                                    <p class="text-xs text-gray-500 mt-1"><?php echo $this->session->userdata('email') ? $this->session->userdata('email') : ''; ?></p>
                                </div>
                                <div class="py-2">
                                    <a href="<?= base_url('karyawan/pengaturan') ?>" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition text-gray-700">
                                        <i class="fas fa-cog text-gray-400"></i>
                                        <span class="text-sm font-medium">Pengaturan</span>
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
                    <!-- Pesanan Hari Ini -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pesanan Hari Ini</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= $pesanan_hari_ini ?? 0 ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pesanan Pending -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pesanan Pending</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= $pesanan_pending ?? 0 ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dalam Proses -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Dalam Proses</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= $pesanan_proses ?? 0 ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-spinner text-blue-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cabang -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Cabang</p>
                                <h3 class="text-lg font-bold text-gray-800 mt-2"><?= isset($cabang['nama_cabang']) ? $cabang['nama_cabang'] : '-' ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-store text-purple-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pesanan Aktif Hari Ini -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-6">
                    <div class="border-b border-gray-100 px-6 py-6">
                        <h2 class="text-xl font-semibold text-gray-800">Pesanan Aktif Hari Ini</h2>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center py-3 px-4 text-gray-500 text-xs font-medium">ID Pesanan</th>
                                    <th class="text-center py-3 px-4 text-gray-500 text-xs font-medium">Nama Pelanggan</th>
                                    <th class="text-center py-3 px-4 text-gray-500 text-xs font-medium">Jenis Layanan</th>
                                    <th class="text-center py-3 px-4 text-gray-500 text-xs font-medium">Cabang</th>
                                    <th class="text-center py-3 px-4 text-gray-500 text-xs font-medium">Status</th>
                                    <th class="text-center py-3 px-4 text-gray-500 text-xs font-medium">Estimasi Selesai</th>
                                    <th class="text-center py-3 px-4 text-gray-500 text-xs font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($recent_orders) && !empty($recent_orders)): ?>
                                    <?php foreach($recent_orders as $order): ?>
                                    <tr class="hover:bg-gray-50 border-t border-gray-100">
                                        <td class="text-center py-4 px-4 text-gray-900 text-sm font-medium">#<?= $order['id_pesanan'] ?></td>
                                        <td class="text-center py-4 px-4 text-gray-600 text-sm"><?= htmlspecialchars($order['nama_pelanggan']) ?></td>
                                        <td class="text-center py-4 px-4 text-gray-600 text-sm"><?= htmlspecialchars($order['nama_layanan'] ?? '-') ?></td>
                                        <td class="text-center py-4 px-4 text-gray-600 text-sm"><?= isset($cabang['nama_cabang']) ? $cabang['nama_cabang'] : '-' ?></td>
                                        <td class="text-center py-4 px-4">
                                            <?php
                                            $status_class = 'bg-gray-100 text-gray-800';
                                            if($order['status_pesanan'] == 'selesai') $status_class = 'bg-emerald-100 text-emerald-800';
                                            elseif($order['status_pesanan'] == 'proses' || $order['status_pesanan'] == 'dalam_proses') $status_class = 'bg-blue-100 text-blue-800';
                                            elseif($order['status_pesanan'] == 'pending' || $order['status_pesanan'] == 'diterima') $status_class = 'bg-yellow-100 text-yellow-800';
                                            ?>
                                            <span class="<?= $status_class ?> px-4 py-1 rounded-full text-xs font-medium">
                                                <?= ucfirst(str_replace('_', ' ', $order['status_pesanan'])) ?>
                                            </span>
                                        </td>
                                        <td class="text-center py-4 px-4 text-gray-600 text-sm"><?= isset($order['tgl_estimasi_selesai']) && $order['tgl_estimasi_selesai'] ? date('d/m H:i', strtotime($order['tgl_estimasi_selesai'])) : '-' ?></td>
                                        <td class="text-center py-4 px-4">
                                            <a href="<?= base_url('karyawan/pesanan/detail/'.$order['id_pesanan']) ?>" class="text-emerald-500 font-medium hover:text-emerald-600">Lihat Detail</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-8 text-gray-500">Belum ada pesanan terbaru</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Jumlah Pesanan Per Hari -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Jumlah Pesanan Per Hari (Minggu Ini)</h2>
                        <div class="h-80">
                            <canvas id="orderChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Aktivitas Terbaru -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Aktivitas Terbaru</h2>
                        
                        <div class="space-y-6">
                            <?php if(isset($activities) && !empty($activities)): ?>
                                <?php foreach($activities as $act): ?>
                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 bg-<?= $act['color'] ?>-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas <?= $act['icon'] ?> text-<?= $act['color'] ?>-500 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-800 leading-5"><?= htmlspecialchars($act['message']) ?></p>
                                        <p class="text-xs text-gray-500 leading-4">
                                            <?php
                                                if (!empty($act['time'])) {
                                                    $time = strtotime($act['time']);
                                                    $diff = time() - $time;
                                                    if ($diff < 60) echo "Baru saja";
                                                    elseif ($diff < 3600) echo floor($diff/60) . " menit yang lalu";
                                                    elseif ($diff < 86400) echo floor($diff/3600) . " jam yang lalu";
                                                    else echo date('d M H:i', $time);
                                                } else {
                                                    echo "-";
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-center text-gray-500 py-4">Belum ada aktivitas terbaru.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Profile dropdown toggle
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        
        if (profileBtn && profileDropdown) {
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });
            
            document.addEventListener('click', function() {
                profileDropdown.classList.add('hidden');
            });
        }
        
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const successAlert = document.getElementById('alert-success');
            const errorAlert = document.getElementById('alert-error');
            if (successAlert) successAlert.style.display = 'none';
            if (errorAlert) errorAlert.style.display = 'none';
        }, 5000);

        // Jumlah Pesanan Per Hari - Bar Chart
        if (document.getElementById('orderChart')) {
            const orderCtx = document.getElementById('orderChart').getContext('2d');
            new Chart(orderCtx, {
                type: 'bar',
                data: {
                    labels: <?= isset($chart_data) ? json_encode(array_column($chart_data, 'label')) : "['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']" ?>,
                    datasets: [{
                        label: 'Jumlah Pesanan',
                        data: <?= isset($chart_data) ? json_encode(array_column($chart_data, 'count')) : "[0,0,0,0,0,0,0]" ?>,
                        backgroundColor: function(context) {
                            const chart = context.chart;
                            const {ctx, chartArea} = chart;
                            if (!chartArea) {
                                return null;
                            }
                            const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                            gradient.addColorStop(0, '#a7f3d0');
                            gradient.addColorStop(1, '#10b981');
                            return gradient;
                        },
                        borderRadius: 8,
                        borderWidth: 1,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: <?= isset($chart_data) && !empty($chart_data) ? (max(array_column($chart_data, 'count')) + 5) : 30 ?>,
                            ticks: {
                                stepSize: 5,
                                font: {
                                    size: 10
                                }
                            },
                            grid: {
                                color: '#e5e7eb'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 10
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }
    </script>

    <!-- Footer now handles closing tags -->
    <?php $this->load->view('template/footer'); ?>