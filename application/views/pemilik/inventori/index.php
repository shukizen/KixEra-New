<!DOCTYPE html>
<html lang="id">
<head>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-100 shadow-sm px-6 py-4">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <h1 class="text-2xl font-semibold text-gray-800">Kelola Inventory</h1>
                    
                    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                        <!-- Search -->
                        <div class="relative flex-1 md:w-80">
                            <input type="text" placeholder="Search..." 
                                   class="w-full px-4 py-2 pl-10 border border-gray-200 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        
                        <!-- Category Filter -->
                        <select class="px-4 py-2 border border-gray-200 rounded-xl text-black focus:outline-none focus:border-emerald-500">
                            <option>Semua Kategori</option>
                            <option>Pembersih</option>
                            <option>Kuas</option>
                            <option>Parfum</option>
                            <option>Packaging</option>
                        </select>
                        
                        <!-- Add Item Button -->
                        <button class="bg-emerald-500 text-white px-6 py-3 rounded-xl hover:bg-emerald-600 transition flex items-center justify-center gap-2">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Item Baru</span>
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Inventory Table -->
                <div class="bg-white rounded-2xl shadow-lg mb-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Item ID</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Nama Item</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Kategori</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">
                                        Jumlah<br/>Stok
                                    </th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Satuan</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">
                                        Stok<br/>Terakhir
                                    </th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Supplier</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Status</th>
                                    <th class="text-center py-4 px-3 text-gray-700 text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 -->
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">#INV001</td>
                                    <td class="text-center py-5 px-3 text-gray-800 text-sm font-medium">
                                        Premium Shoe<br/>Cleaner
                                    </td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">Pembersih</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">25</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">Botol</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">2024-01-15</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">CleanCorp</td>
                                    <td class="text-center py-5 px-3">
                                        <span class="bg-emerald-500/20 text-emerald-500 px-3 py-1 rounded-full text-xs font-medium">Available</span>
                                    </td>
                                    <td class="text-center py-5 px-3">
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
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">#INV002</td>
                                    <td class="text-center py-5 px-3 text-gray-800 text-sm font-medium">Soft Bristle Brush</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">Kuas</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">5</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">Pcs</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">2024-01-10</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">BrushMax</td>
                                    <td class="text-center py-5 px-3">
                                        <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-medium">Low Stock</span>
                                    </td>
                                    <td class="text-center py-5 px-3">
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
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">#INV003</td>
                                    <td class="text-center py-5 px-3 text-gray-800 text-sm font-medium">Fresh Mint Spray</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">Parfum</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">0</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">Botol</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">2023-12-20</td>
                                    <td class="text-center py-5 px-3 text-gray-600 text-sm">ScentPro</td>
                                    <td class="text-center py-5 px-3">
                                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-medium">Out Of Stock</span>
                                    </td>
                                    <td class="text-center py-5 px-3">
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
                
                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Top Penggunaan Item -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Top Penggunaan Item</h2>
                        <div class="h-64">
                            <canvas id="usageChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Inventory Per Kategori -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Inventory Per Kategori</h2>
                        <div class="h-64">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Tren Jumlah Stok -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tren Jumlah Stok</h2>
                        <div class="h-64">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        // Top Penggunaan Item - Bar Chart
        const usageCtx = document.getElementById('usageChart').getContext('2d');
        new Chart(usageCtx, {
            type: 'bar',
            data: {
                labels: ['Cleaner', 'Brush', 'Perfume', 'Packaging', 'Polish'],
                datasets: [{
                    label: 'Usage Count',
                    data: [55, 42, 38, 35, 28],
                    backgroundColor: '#10b981',
                    borderRadius: 6
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
                        max: 60,
                        ticks: {
                            stepSize: 20,
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
        
        // Inventory Per Kategori - Pie Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'pie',
            data: {
                labels: ['Pembersih', 'Sikat', 'Pewangi', 'Packaging', 'Lainnya'],
                datasets: [{
                    data: [35, 25, 20, 12, 8],
                    backgroundColor: [
                        '#10b981',  // emerald-500
                        '#34d399',  // emerald-300
                        '#6ee7b7',  // emerald-400
                        '#a7f3d0',  // emerald-100
                        '#0f766e'   // teal-700
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
        
        // Tren Jumlah Stok - Multi-line Chart
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [
                    {
                        label: 'Refills',
                        data: [120, 135, 140, 125, 155, 145],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: false,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    },
                    {
                        label: 'Low Stock Alerts',
                        data: [5, 4, 6, 4, 3, 5],
                        borderColor: '#facc15',
                        backgroundColor: 'rgba(250, 204, 21, 0.1)',
                        tension: 0.4,
                        fill: false,
                        pointBackgroundColor: '#facc15',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 10, weight: 'bold' },
                            padding: 10,
                            boxWidth: 12
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 200,
                        ticks: {
                            stepSize: 50,
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