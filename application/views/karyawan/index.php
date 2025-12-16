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
            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Pesanan Hari Ini -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 leading-5">Pesanan Hari Ini</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">12</h3>
                            </div>
                            <div class="w-12 h-12 bg-emerald-300 rounded-xl flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pesanan Selesai -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 leading-5">Pesanan Selesai</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">8</h3>
                            </div>
                            <div class="w-12 h-12 bg-emerald-300 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dalam Proses -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 leading-5">Dalam Proses</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">4</h3>
                            </div>
                            <div class="w-12 h-12 bg-emerald-300 rounded-xl flex items-center justify-center">
                                <i class="fas fa-spinner text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Menunggu Konfirmasi -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 leading-5">Menunggu Konfirmasi</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">3</h3>
                            </div>
                            <div class="w-12 h-12 bg-emerald-300 rounded-xl flex items-center justify-center">
                                <i class="fas fa-clock text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pesanan Aktif Hari Ini -->
                <div class="bg-white rounded-2xl shadow-sm mb-6">
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
                                <!-- Row 1 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="text-center py-4 px-4 text-gray-900 text-sm font-medium">#001</td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">Budi Santoso</td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">Cuci Premium</td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">Seturan</td>
                                    <td class="text-center py-4 px-4">
                                        <span class="bg-emerald-400 text-white px-4 py-1 rounded-full text-xs font-medium">Dalam Proses</span>
                                    </td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">2 jam</td>
                                    <td class="text-center py-4 px-4">
                                        <button class="text-emerald-500 font-medium hover:text-emerald-600">Lihat Detail</button>
                                    </td>
                                </tr>
                                
                                <!-- Row 2 -->
                                <tr class="border-t border-gray-100 hover:bg-gray-50">
                                    <td class="text-center py-4 px-4 text-gray-900 text-sm font-medium">#002</td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">Sari Indah</td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">Whitening</td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">Condong catur</td>
                                    <td class="text-center py-4 px-4">
                                        <span class="bg-yellow-400 text-white px-4 py-1 rounded-full text-xs font-medium">Menunggu</span>
                                    </td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">4 jam</td>
                                    <td class="text-center py-4 px-4">
                                        <button class="text-emerald-500 font-medium hover:text-emerald-600">Lihat Detail</button>
                                    </td>
                                </tr>
                                
                                <!-- Row 3 -->
                                <tr class="border-t border-gray-100 hover:bg-gray-50">
                                    <td class="text-center py-4 px-4 text-gray-900 text-sm font-medium">#003</td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">Rudi Hartono</td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">Repair</td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">Gejayan</td>
                                    <td class="text-center py-4 px-4">
                                        <span class="bg-emerald-500 text-white px-4 py-1 rounded-full text-xs font-medium">Selesai</span>
                                    </td>
                                    <td class="text-center py-4 px-4 text-gray-600 text-sm">-</td>
                                    <td class="text-center py-4 px-4">
                                        <button class="text-emerald-500 font-medium hover:text-emerald-600">Lihat Detail</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Jumlah Pesanan Per Hari -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Jumlah Pesanan Per Hari (Minggu Ini)</h2>
                        <div class="h-80">
                            <canvas id="orderChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Aktivitas Terbaru -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Aktivitas Terbaru</h2>
                        
                        <div class="space-y-6">
                            <!-- Activity 1 -->
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-800 leading-5">Pesanan #123 telah diselesaikan oleh Andi</p>
                                    <p class="text-xs text-gray-500 leading-4">5 menit yang lalu</p>
                                </div>
                            </div>
                            
                            <!-- Activity 2 -->
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-shopping-bag text-white text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-800 leading-5">Pesanan baru diterima dari Rudi (Cuci Premium)</p>
                                    <p class="text-xs text-gray-500 leading-4">15 menit yang lalu</p>
                                </div>
                            </div>
                            
                            <!-- Activity 3 -->
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-800 leading-5">Stok sabun sepatu hampir habis</p>
                                    <p class="text-xs text-gray-500 leading-4">1 jam yang lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <script>
        // Jumlah Pesanan Per Hari - Bar Chart
        if (document.getElementById('orderChart')) {
            const orderCtx = document.getElementById('orderChart').getContext('2d');
            new Chart(orderCtx, {
                type: 'bar',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                        label: 'Jumlah Pesanan',
                        data: [15, 22, 18, 25, 20, 12, 8],
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
                            max: 30,
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