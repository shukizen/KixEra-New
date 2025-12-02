  <main class="flex-1 ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-8 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">Keuangan</h1>
                    
                    <div class="flex items-center gap-4">
                        <!-- Search Bar -->
                        <div class="relative">
                            <input type="text" placeholder="Search..." class="w-80 px-4 py-2 pr-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                        </div>
                        
                        <!-- Filter Buttons -->
                        <button class="px-6 py-2 bg-emerald-500 text-white rounded-lg font-normal flex items-center gap-2">
                            Bulan Ini
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <button class="px-6 py-2 bg-emerald-500 text-white rounded-lg font-medium flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Tambah Transaksi
                        </button>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Pemasukan -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Pemasukan</p>
                                <h3 class="text-2xl font-bold text-emerald-500 mt-2">Rp 45,750,000</h3>
                                <p class="text-sm text-green-600 mt-2">+12.5% from last month</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-arrow-up text-emerald-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pengeluaran -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Pengeluaran</p>
                                <h3 class="text-2xl font-bold text-red-500 mt-2">Rp 32,150,000</h3>
                                <p class="text-sm text-red-500 mt-2">+8.2% from last month</p>
                            </div>
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-arrow-down text-red-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Net Profit -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Net Profit</p>
                                <h3 class="text-2xl font-bold text-emerald-500 mt-2">Rp 13,600,000</h3>
                                <p class="text-sm text-green-600 mt-2">+18.7% from last month</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-chart-line text-emerald-500"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Pembayaran -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pending Pembayaran</p>
                                <h3 class="text-2xl font-bold text-orange-500 mt-2">Rp 8,450,000</h3>
                                <p class="text-sm text-gray-500 mt-2">12 transactions</p>
                            </div>
                            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-orange-500"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Cash Flow Trend -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Cash Flow Trend</h3>
                        <canvas id="cashFlowChart"></canvas>
                    </div>

                    <!-- Pengeluaran Breakdown -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengeluaran Breakdown</h3>
                        <canvas id="pengeluaranChart"></canvas>
                    </div>
                </div>

                <!-- Transaction Table -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Rincian Transaksi</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="border-b border-gray-200">
                                <tr>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Tanggal</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Deskripsi</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Kategori</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Jumlah</th>
                                    <th class="text-center py-3 px-4 text-base font-medium text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100">
                                    <td class="py-4 px-4 text-center text-gray-700">Oct 25, 2024</td>
                                    <td class="py-4 px-4 text-center text-gray-700">Shoe Cleaning Service</td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Income</span>
                                    </td>
                                    <td class="py-4 px-4 text-center text-emerald-500 font-semibold">+Rp 2,500,000</td>
                                    <td class="py-4 px-4 text-center">
                                        <button class="text-blue-500 hover:text-blue-700 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-4 px-4 text-center text-gray-700">Oct 24, 2024</td>
                                    <td class="py-4 px-4 text-center text-gray-700">Equipment Purchase</td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Expense</span>
                                    </td>
                                    <td class="py-4 px-4 text-center text-red-500 font-semibold">-Rp 1,200,000</td>
                                    <td class="py-4 px-4 text-center">
                                        <button class="text-blue-500 hover:text-blue-700 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-4 px-4 text-center text-gray-700">Oct 23, 2024</td>
                                    <td class="py-4 px-4 text-center text-gray-700">Premium Package Sale</td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Income</span>
                                    </td>
                                    <td class="py-4 px-4 text-center text-emerald-500 font-semibold">+Rp 3,750,000</td>
                                    <td class="py-4 px-4 text-center">
                                        <button class="text-blue-500 hover:text-blue-700 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
        // Cash Flow Trend Chart
        const cashFlowCtx = document.getElementById('cashFlowChart').getContext('2d');
        new Chart(cashFlowCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Pemasukan',
                    data: [30, 35, 40, 45, 48, 46],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Pengeluaran',
                    data: [22, 24, 26, 30, 26, 24],
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 20,
                        max: 50,
                        ticks: {
                            callback: function(value) {
                                return value;
                            }
                        },
                        title: {
                            display: true,
                            text: 'Amount (Million Rp)'
                        }
                    }
                }
            }
        });

        // Pengeluaran Breakdown Chart
        const pengeluaranCtx = document.getElementById('pengeluaranChart').getContext('2d');
        new Chart(pengeluaranCtx, {
            type: 'bar',
            data: {
                labels: ['Operational', 'Supplies', 'Marketing', 'Payroll'],
                datasets: [{
                    label: 'Pengeluaran',
                    data: [12, 8, 5, 5],
                    backgroundColor: '#34d399',
                    borderColor: 'white',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 15,
                        ticks: {
                            callback: function(value) {
                                return value;
                            }
                        },
                        title: {
                            display: true,
                            text: 'Amount (Million Rp)'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>