<!DOCTYPE html>
<html lang="id">
<head>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <main class="flex-1 ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4 shadow-sm">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <h1 class="text-2xl font-bold text-gray-800">Kelola Pelanggan</h1>
                    
                    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                        <!-- Search -->
                        <div class="relative flex-1 md:w-72">
                            <input type="text" placeholder="Search..." 
                                   class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg text-gray-600 focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        
                        <!-- Branch Filter -->
                        <select class="px-4 py-2 border border-gray-300 rounded-xl text-black focus:outline-none focus:border-emerald-500">
                            <option>Semua Cabang</option>
                            <option>Kota Gede</option>
                            <option>Seturan</option>
                            <option>Condongcatur</option>
                            <option>Jakal</option>
                            <option>Banguntapan</option>
                        </select>
                        
                        <!-- Add Customer Button -->
                        <button class="bg-gradient-to-r from-emerald-500 to-emerald-300 text-white px-6 py-2 rounded-xl hover:opacity-90 transition flex items-center justify-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Tambah Pelanggan</span>
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <div class="p-6">
                   <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Distribusi Pelanggan Per Cabang -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Pelanggan Per Cabang</h2>
                        <div class="h-64">
                            <canvas id="distributionChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Top Pelanggan Aktif -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Top Pelanggan Aktif</h2>
                        <div class="h-64">
                            <canvas id="topCustomersChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Pertumbuhan Bulanan -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Pertumbuhan Bulanan</h2>
                        <div class="h-64">
                            <canvas id="growthChart"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Customer Table -->
                <div class="bg-white rounded-2xl shadow-sm mb-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="text-center py-5 px-4 text-gray-700 text-sm font-semibold">
                                        Pelanggan<br/>ID
                                    </th>
                                    <th class="text-center py-5 px-4 text-gray-700 text-sm font-semibold">Nama</th>
                                    <th class="text-center py-5 px-4 text-gray-700 text-sm font-semibold">Telepon</th>
                                    <th class="text-center py-5 px-4 text-gray-700 text-sm font-semibold">Email</th>
                                    <th class="text-center py-5 px-4 text-gray-700 text-sm font-semibold">
                                        Total<br/>Pesanan
                                    </th>
                                    <th class="text-center py-5 px-4 text-gray-700 text-sm font-semibold">Status</th>
                                    <th class="text-center py-5 px-4 text-gray-700 text-sm font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 -->
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="text-center py-5 px-4 text-gray-900 text-sm">#C001</td>
                                    <td class="text-center py-5 px-4 text-gray-900 text-sm font-medium">Rizki Pangestu</td>
                                    <td class="text-center py-5 px-4 text-gray-600 text-sm">
                                        +62 812-3456-7890
                                    </td>
                                    <td class="text-center py-5 px-4 text-gray-600 text-sm">rizkipangestu@email.com</td>
                                    <td class="text-center py-5 px-4 text-gray-900 text-sm">24</td>
                                    <td class="text-center py-5 px-4">
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">VIP</span>
                                    </td>
                                    <td class="text-center py-5 px-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="text-emerald-500 hover:text-emerald-600 p-2" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-blue-600 hover:text-blue-700 p-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-700 p-2" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Row 2 -->
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="text-center py-5 px-4 text-gray-900 text-sm">#C002</td>
                                    <td class="text-center py-5 px-4 text-gray-900 text-sm font-medium">Rayan</td>
                                    <td class="text-center py-5 px-4 text-gray-600 text-sm">
                                        +62 813-4567-8901
                                    </td>
                                    <td class="text-center py-5 px-4 text-gray-600 text-sm">siti.nur@email.com</td>
                                    <td class="text-center py-5 px-4 text-gray-900 text-sm">12</td>
                                    <td class="text-center py-5 px-4">
                                        <span class="bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-medium">Regular</span>
                                    </td>
                                    <td class="text-center py-5 px-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="text-emerald-500 hover:text-emerald-600 p-2" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-blue-600 hover:text-blue-700 p-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-700 p-2" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Row 3 -->
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="text-center py-5 px-4 text-gray-900 text-sm">#C003</td>
                                    <td class="text-center py-5 px-4 text-gray-900 text-sm font-medium">Hatta Pramana</td>
                                    <td class="text-center py-5 px-4 text-gray-600 text-sm">
                                        +62 814-5678-9012
                                    </td>
                                    <td class="text-center py-5 px-4 text-gray-600 text-sm">budi.santoso@email.com</td>
                                    <td class="text-center py-5 px-4 text-gray-900 text-sm">3</td>
                                    <td class="text-center py-5 px-4">
                                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">New</span>
                                    </td>
                                    <td class="text-center py-5 px-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="text-emerald-500 hover:text-emerald-600 p-2" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-blue-600 hover:text-blue-700 p-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-700 p-2" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        // Distribusi Pelanggan Per Cabang - Pie Chart
        const distributionCtx = document.getElementById('distributionChart').getContext('2d');
        new Chart(distributionCtx, {
            type: 'pie',
            data: {
                labels: ['Kota Gede: 35.0%', 'Seturan: 25.0%', 'Condongcatur: 20.0%', 'Jakal: 12.0%', 'Banguntapan: 8.0%'],
                datasets: [{
                    data: [35, 25, 20, 12, 8],
                    backgroundColor: [
                        '#10b981',  // emerald-500
                        '#34d399',  // emerald-300
                        '#6ee7b7',  // emerald-400
                        '#0f766e',  // teal-700
                        '#a7f3d0'   // emerald-100
                    ],
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
                            font: { size: 11, family: 'Inter' },
                            padding: 10,
                            boxWidth: 12
                        }
                    }
                }
            }
        });
        
        // Top Pelanggan Aktif - Horizontal Bar Chart
        const topCustomersCtx = document.getElementById('topCustomersChart').getContext('2d');
        new Chart(topCustomersCtx, {
            type: 'bar',
            data: {
                labels: ['Rizki Pangestu', 'Siti Nurhaliza', 'Rayan', 'Hatta Pramana', 'Andir'],
                datasets: [{
                    label: 'Pesanan',
                    data: [30, 22, 18, 15, 12],
                    backgroundColor: '#10b981',
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            font: { size: 11 }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 30,
                        ticks: {
                            stepSize: 10,
                            font: { size: 10 }
                        },
                        grid: {
                            color: '#e5e7eb'
                        }
                    },
                    y: {
                        ticks: {
                            font: { size: 10 }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        
        // Pertumbuhan Bulanan - Line Chart
        const growthCtx = document.getElementById('growthChart').getContext('2d');
        new Chart(growthCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Pelanggan Baru',
                    data: [10, 18, 15, 25, 35, 45],
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
                            font: { size: 11 }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 50,
                        ticks: {
                            stepSize: 10,
                            font: { size: 10 }
                        },
                        grid: {
                            color: '#e5e7eb'
                        }
                    },
                    x: {
                        ticks: {
                            font: { size: 10 }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>