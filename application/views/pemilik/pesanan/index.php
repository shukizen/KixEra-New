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
            <header class="bg-white border-b border-gray-200 px-6 py-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <h1 class="text-2xl font-semibold text-gray-800">Kelola Pesanan</h1>
                        <div class="bg-emerald-100 px-4 py-1 rounded-full">
                            <span class="text-teal-700 text-sm font-medium"><?php echo isset($pesanan) ? count($pesanan) . ' Total Pesanan' : '0 Total Pesanan'; ?></span>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                        <!-- Search -->
                        <div class="relative flex-1 md:w-80">
                            <input type="text" id="searchInput" placeholder="Search by customer name or order"
                                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>

                        <!-- Status Filter -->

                        <select id="statusFilter"
                            class="px-4 py-2 border border-gray-300 rounded-xl text-black focus:outline-none focus:border-emerald-500">
                            <option value="">Semua Status</option>
                            <?php foreach ($status_list as $value => $label): ?>
                                <option value="<?= $value ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>

                        <!-- Cabang Filter -->
                        <select id="cabangFilter"
                            class="px-4 py-2 border border-gray-300 rounded-xl text-black focus:outline-none focus:border-emerald-500">
                            <option value="">Semua Cabang</option>
                            <?php if (!empty($cabang_list)): ?>
                                <?php foreach ($cabang_list as $c): ?>
                                    <option value="<?= $c->id_cabang ?>"><?= htmlspecialchars($c->nama_cabang) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Edit Modal (hidden) -->
                <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl mx-4">
                        <div class="p-4 border-b flex items-center justify-between">
                            <h3 class="text-lg font-semibold">Edit Pesanan</h3>
                            <button id="closeModal" class="text-gray-500">&times;</button>
                        </div>
                        <div class="p-6">
                            <form id="editForm">
                                <input type="hidden" id="edit-id_pesanan" name="id_pesanan">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm text-gray-600">Pelanggan</label>
                                        <select id="edit-id_pelanggan" name="id_pelanggan" class="w-full px-4 py-2 border rounded-xl">
                                            <option value="">-- Pilih Pelanggan --</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Layanan</label>
                                        <select id="edit-id_layanan" name="id_layanan" class="w-full px-4 py-2 border rounded-xl">
                                            <option value="">-- Pilih Layanan --</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Karyawan</label>
                                        <select id="edit-id_karyawan" name="id_karyawan" class="w-full px-4 py-2 border rounded-xl">
                                            <option value="">-- Pilih Karyawan --</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Tanggal Masuk</label>
                                        <input type="date" id="edit-tgl_masuk" name="tgl_masuk" class="w-full px-4 py-2 border rounded-xl" />
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Total Harga</label>
                                        <input type="number" id="edit-total_harga" name="total_harga" class="w-full px-4 py-2 border rounded-xl" />
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Status</label>
                                        <select id="edit-status_pesanan" name="status_pesanan" class="w-full px-4 py-2 border rounded-xl">
                                            <option value="diterima">Diterima</option>
                                            <option value="dalam_proses">Dalam Proses</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="siap_diambil">Siap Diambil</option>
                                            <option value="sudah_diambil">Sudah Diambil</option>
                                            <option value="dibatalkan">Dibatalkan</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="text-sm text-gray-600">Cabang</label>
                                        <input id="edit-cabang" name="cabang" class="w-full px-4 py-2 border rounded-xl" readonly />
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Jumlah Item</label>
                                        <input type="number" id="edit-jumlah_item" name="jumlah_item" class="w-full px-4 py-2 border rounded-xl" />
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Tanggal Estimasi Selesai</label>
                                        <input type="datetime-local" id="edit-tgl_estimasi_selesai" name="tgl_estimasi_selesai" class="w-full px-4 py-2 border rounded-xl" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="text-sm text-gray-600">Catatan</label>
                                        <textarea id="edit-catatan" name="catatan" class="w-full px-4 py-2 border rounded-xl" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end gap-3">
                                    <button type="button" id="cancelEdit" class="px-4 py-2 rounded-xl border">Batal</button>
                                    <button type="submit" class="bg-emerald-500 text-white px-6 py-2 rounded-xl">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Delete Confirmation Modal -->
                <div id="deleteModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 backdrop-blur-sm">
                    <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6 mx-4">

                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-red-100">
                                <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Hapus Pesanan?</h3>
                        </div>

                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Pesanan <span id="delete-id-text" class="font-semibold text-gray-800"></span> akan dihapus secara permanen.
                            Tindakan ini tidak bisa dibatalkan.
                        </p>

                        <div class="flex justify-end gap-3">
                            <button id="cancelDeleteBtn"
                                class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                                Batal
                            </button>

                            <button id="confirmDeleteBtn"
                                class="px-5 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">
                                Hapus
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">
                    <!-- Total Pesanan Hari Ini -->
                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Pesanan Hari Ini</p>
                                <h3 id="stat-today" class="text-3xl font-bold text-gray-800 mt-2"><?php
                                                                                                    $total_today = 0;
                                                                                                    if (!empty($pesanan)) {
                                                                                                        foreach ($pesanan as $p) {
                                                                                                            if (date('Y-m-d', strtotime($p->tgl_masuk)) == date('Y-m-d')) $total_today++;
                                                                                                        }
                                                                                                    }
                                                                                                    echo $total_today;
                                                                                                    ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-emerald-500/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-emerald-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pesanan Selesai -->
                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pesanan Selesai</p>
                                <h3 id="stat-selesai" class="text-3xl font-bold text-gray-800 mt-2"><?php
                                                                                                    $done = 0;
                                                                                                    if (!empty($pesanan)) {
                                                                                                        foreach ($pesanan as $p) {
                                                                                                            $s = strtolower($p->status_pesanan ?? '');
                                                                                                            if ($s === 'selesai' || $s === 'diambil') $done++;
                                                                                                        }
                                                                                                    }
                                                                                                    echo $done;
                                                                                                    ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-emerald-400/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-check-circle text-emerald-400 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Dalam Proses -->
                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Dalam Proses</p>
                                <h3 id="stat-proses" class="text-3xl font-bold text-gray-800 mt-2"><?php
                                                                                                    $processing = 0;
                                                                                                    if (!empty($pesanan)) {
                                                                                                        foreach ($pesanan as $p) {
                                                                                                            $s = strtolower($p->status_pesanan ?? '');
                                                                                                            if ($s === 'diterima' || $s === 'dalam_proses') $processing++;
                                                                                                        }
                                                                                                    }
                                                                                                    echo $processing;
                                                                                                    ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-spinner text-yellow-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Diterima -->
                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Diterima</p>
                                <h3 id="stat-tunggu" class="text-3xl font-bold text-gray-800 mt-2"><?php
                                                                                                    $waiting = 0;
                                                                                                    if (!empty($pesanan)) {
                                                                                                        foreach ($pesanan as $p) {
                                                                                                            $s = strtolower($p->status_pesanan ?? '');
                                                                                                            if ($s === 'diterima') $waiting++;
                                                                                                        }
                                                                                                    }
                                                                                                    echo $waiting;
                                                                                                    ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-blue-500/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-clock text-blue-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Dibatalkan -->
                    <div class="bg-white rounded-xl shadow-lg border border-emerald-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Dibatalkan</p>
                                <h3 id="stat-batal" class="text-3xl font-bold text-gray-800 mt-2"><?php
                                                                                                    $cancel = 0;
                                                                                                    if (!empty($pesanan)) {
                                                                                                        foreach ($pesanan as $p) {
                                                                                                            $s = strtolower($p->status_pesanan ?? '');
                                                                                                            if ($s === 'dibatalkan') $cancel++;
                                                                                                        }
                                                                                                    }
                                                                                                    echo $cancel;
                                                                                                    ?></h3>
                            </div>
                            <div class="w-12 h-12 bg-red-500/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-times-circle text-red-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Detail Modal REMOVED: User redirects to separate detail page -->

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Data Pesanan Table -->
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Data Pesanan</h2>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="border-b border-gray-200">
                                    <tr>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Nomor Pesanan</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Tanggal</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Pelanggan</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Cabang</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Layanan</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Total</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Status</th>
                                        <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pesanan)) : ?>
                                        <?php foreach ($pesanan as $p) : ?>
                                            <tr class="border-b border-gray-100 hover:bg-gray-50" data-status="<?= strtolower($p->status_pesanan ?? '') ?>" data-cabang="<?= $p->id_cabang ?? '' ?>">
                                                <td class="text-center py-4 px-2"><?php echo htmlspecialchars($p->nomor_pesanan ?? '-'); ?></td>
                                                <td class="text-center py-4 px-2"><?php echo date('d/m/Y', strtotime($p->tgl_masuk)); ?></td>
                                                <td class="text-center py-4 px-2"><?php echo htmlspecialchars($p->nama_pelanggan ?? '-'); ?></td>
                                                <td class="text-center py-4 px-2"><?php echo htmlspecialchars($p->nama_cabang ?? '-'); ?></td>
                                                <td class="text-center py-4 px-2"><?php echo htmlspecialchars($p->nama_layanan ?? '-'); ?></td>
                                                <td class="text-center py-4 px-2">Rp <?php echo number_format($p->total_harga ?? 0, 0, ',', '.'); ?></td>
                                                <td class="text-center py-4 px-2">
                                                    <?php
                                                    $status = strtolower($p->status_pesanan ?? '');
                                                    $badge = 'bg-gray-100 text-gray-700';
                                                    $status_label = ucfirst(str_replace('_', ' ', $status));
                                                    
                                                    if ($status === 'sudah_diambil') {
                                                        $badge = 'bg-emerald-500/10 text-emerald-500';
                                                        $status_label = 'Sudah Diambil';
                                                    } elseif ($status === 'siap_diambil') {
                                                        $badge = 'bg-green-500/10 text-green-500';
                                                        $status_label = 'Siap Diambil';
                                                    } elseif ($status === 'selesai') {
                                                        $badge = 'bg-teal-500/10 text-teal-500';
                                                    } elseif ($status === 'dalam_proses') {
                                                        $badge = 'bg-yellow-500/10 text-yellow-600';
                                                        $status_label = 'Dalam Proses';
                                                    } elseif ($status === 'diterima') {
                                                        $badge = 'bg-blue-500/10 text-blue-500';
                                                    } elseif ($status === 'dibatalkan') {
                                                        $badge = 'bg-red-500/10 text-red-500';
                                                    }
                                                    ?>
                                                    <span class="<?php echo $badge; ?> px-3 py-1 rounded-full text-xs font-medium"><?php echo htmlspecialchars($status_label ?: '-'); ?></span>
                                                </td>
                                                <td class="text-center py-4 px-2">
                                                    <div class="flex items-center justify-center gap-2">
                                                        <button data-id="<?php echo $p->id_pesanan; ?>"
                                                            data-nomor="<?php echo htmlspecialchars($p->id_pesanan); ?>"
                                                            class="text-emerald-500 hover:text-emerald-600 btn-view"
                                                            title="Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button data-id="<?php echo $p->id_pesanan; ?>" data-nomor="<?php echo htmlspecialchars($p->nomor_pesanan ?? $p->id_pesanan); ?>" class="text-blue-500 hover:text-blue-600 btn-edit" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button data-id="<?php echo $p->id_pesanan; ?>" data-nomor="<?php echo htmlspecialchars($p->nomor_pesanan ?? $p->id_pesanan); ?>" class="text-red-500 hover:text-red-600 btn-delete" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center py-6 text-gray-500">Tidak ada pesanan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Right Sidebar Charts -->
                    <div class="space-y-6">
                        <!-- Pesanan per Cabang -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Pesanan per Cabang</h2>
                            <div class="h-64">
                                <canvas id="branchChart"></canvas>
                            </div>
                        </div>

                        <!-- Jenis Layanan -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Jenis Layanan</h2>
                            <div class="h-64">
                                <canvas id="serviceTypeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Tren Pesanan -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tren Pesanan (7 Hari)</h2>
                        <div class="h-64">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>

                    <!-- Insight Ringkas -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Insight Ringkas</h2>
                        <div class="space-y-4">
                            <!-- Insight 1 -->
                            <div class="bg-emerald-100/20 rounded-lg p-4 flex items-start gap-3">
                                <i class="fas fa-chart-line text-emerald-500 mt-1"></i>
                                <p class="text-sm text-gray-700">Cabang Condongcatur memiliki peningkatan 25% minggu ini</p>
                            </div>

                            <!-- Insight 2 -->
                            <div class="bg-emerald-100/20 rounded-lg p-4 flex items-start gap-3">
                                <i class="fas fa-star text-emerald-500 mt-1"></i>
                                <p class="text-sm text-gray-700">Layanan Whitening paling diminati bulan ini</p>
                            </div>

                            <!-- Insight 3 -->
                            <div class="bg-emerald-100/20 rounded-lg p-4 flex items-start gap-3">
                                <i class="fas fa-clock text-emerald-500 mt-1"></i>
                                <p class="text-sm text-gray-700">Rata-rata waktu penyelesaian: 2,3 hari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script>
        // Provide lists for JS (populated from controller)
        const pelangganList = <?php echo json_encode($pelanggan_list ?? []); ?>;
        const layananList = <?php echo json_encode($layanan_list ?? []); ?>;
        const karyawanList = <?php echo json_encode($karyawan_list ?? []); ?>;
        const pesananData = <?php echo json_encode($pesanan ?? []); ?>;

        // Function to generate dynamic charts from pesananData
        function generateDynamicCharts() {
            // 1. Pesanan per Cabang - Bar Chart
            const branchMap = {};
            pesananData.forEach(p => {
                const cabang = p.nama_cabang || 'Unknown';
                branchMap[cabang] = (branchMap[cabang] || 0) + 1;
            });

            const branchLabels = Object.keys(branchMap);
            const branchData = Object.values(branchMap);

            const branchCtx = document.getElementById('branchChart').getContext('2d');
            new Chart(branchCtx, {
                type: 'bar',
                data: {
                    labels: branchLabels.length > 0 ? branchLabels : ['Tidak ada data'],
                    datasets: [{
                        label: 'Jumlah Pesanan',
                        data: branchData.length > 0 ? branchData : [0],
                        backgroundColor: '#10b981',
                        borderRadius: 8
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
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // 2. Jenis Layanan - Pie Chart
            const layananMap = {};
            pesananData.forEach(p => {
                const layanan = p.nama_layanan || 'Unknown';
                layananMap[layanan] = (layananMap[layanan] || 0) + 1;
            });

            const layananLabels = Object.keys(layananMap);
            const layananData = Object.values(layananMap);
            const colors = ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0', '#d1fae5', '#ecfdf5'];

            const serviceTypeCtx = document.getElementById('serviceTypeChart').getContext('2d');
            new Chart(serviceTypeCtx, {
                type: 'pie',
                data: {
                    labels: layananLabels.length > 0 ? layananLabels : ['Tidak ada data'],
                    datasets: [{
                        data: layananData.length > 0 ? layananData : [0],
                        backgroundColor: layananData.length > 0 ? colors.slice(0, layananData.length) : ['#ccc'],
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
                                font: {
                                    size: 11
                                },
                                padding: 10
                            }
                        }
                    }
                }
            });

            // 3. Tren Pesanan 7 Hari - Line Chart
            const today = new Date();
            const last7Days = {};
            for (let i = 6; i >= 0; i--) {
                const d = new Date(today);
                d.setDate(d.getDate() - i);
                const dateStr = d.toISOString().split('T')[0];
                const dayName = d.toLocaleDateString('id-ID', {
                    month: 'short',
                    day: 'numeric'
                });
                last7Days[dateStr] = {
                    name: dayName,
                    count: 0
                };
            }

            pesananData.forEach(p => {
                const tglStr = p.tgl_masuk ? p.tgl_masuk.split(' ')[0] : '';
                if (last7Days[tglStr]) {
                    last7Days[tglStr].count++;
                }
            });

            const trendLabels = Object.values(last7Days).map(d => d.name);
            const trendData = Object.values(last7Days).map(d => d.count);

            const trendCtx = document.getElementById('trendChart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: trendLabels,
                    datasets: [{
                        label: 'Pesanan Harian',
                        data: trendData,
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
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }

        // Generate charts saat page load
        document.addEventListener('DOMContentLoaded', function() {
            generateDynamicCharts();
        });


        // Function to recalculate and update stats cards without page reload
        function updateStatsCards() {
            if (!pesananData || pesananData.length === 0) {
                document.getElementById('stat-today').textContent = '0';
                document.getElementById('stat-selesai').textContent = '0';
                document.getElementById('stat-proses').textContent = '0';
                document.getElementById('stat-tunggu').textContent = '0';
                document.getElementById('stat-batal').textContent = '0';
                return;
            }

            let today = 0,
                selesai = 0,
                proses = 0,
                tunggu = 0,
                batal = 0;
            const todayDate = new Date().toISOString().split('T')[0];

            pesananData.forEach(function(p) {
                const status = (p.status_pesanan || '').toLowerCase();
                const tglMasuk = p.tgl_masuk ? p.tgl_masuk.split(' ')[0] : '';

                if (tglMasuk === todayDate) today++;
                if (status === 'selesai' || status === 'siap_diambil' || status === 'sudah_diambil') {
                    selesai++;
                } else if (status === 'dalam_proses') {
                    proses++;
                } else if (status === 'diterima') {
                    tunggu++;
                } else if (status === 'dibatalkan') {
                    batal++;
                }
            });

            document.getElementById('stat-today').textContent = today;
            document.getElementById('stat-selesai').textContent = selesai;
            document.getElementById('stat-proses').textContent = proses;
            document.getElementById('stat-tunggu').textContent = tunggu;
            document.getElementById('stat-batal').textContent = batal;
        }

        // populate select options
        function populateSelect(selectId, items, idKey, labelKey) {
            const sel = document.getElementById(selectId);
            if (!sel) return;
            // keep first placeholder option
            sel.innerHTML = '<option value="">-- Pilih --</option>';
            items.forEach(function(it) {
                const opt = document.createElement('option');
                opt.value = it[idKey];
                opt.text = it[labelKey];
                sel.appendChild(opt);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            populateSelect('edit-id_pelanggan', pelangganList, 'id_pelanggan', 'nama');
            populateSelect('edit-id_layanan', layananList, 'id_layanan', 'nama_layanan');
            populateSelect('edit-id_karyawan', karyawanList, 'id_karyawan', 'nama');
        });

        // Edit modal flow (GET JSON -> populate -> submit JSON)
        (function() {
            function showModal() {
                const m = document.getElementById('editModal');
                m.classList.remove('hidden');
                m.classList.add('flex');
            }

            function hideModal() {
                const m = document.getElementById('editModal');
                m.classList.add('hidden');
                m.classList.remove('flex');
            }

            // open edit modal and populate
            async function openEditModal(id) {
                try {
                    const res = await fetch('<?php echo site_url("pemilik/pesanan/get/"); ?>' + id);
                    const json = await res.json();
                    if (!json || !json.data) {
                        // Data tidak tersedia, tapi modal tetap dibuka dengan form kosong (fallback)
                        console.warn('Data tidak lengkap, membuka form dengan field kosong');
                    } else {
                        const p = json.data;
                        document.getElementById('edit-id_pesanan').value = p.id_pesanan || '';
                        // prefer selecting by readable name (match option text) falling back to id
                        try {
                            const pelName = p.nama_pelanggan || '';
                            const pelSelect = document.getElementById('edit-id_pelanggan');
                            let matched = false;
                            if (pelName) {
                                Array.from(pelSelect.options).forEach(function(opt) {
                                    if (opt.text === pelName) {
                                        opt.selected = true;
                                        matched = true;
                                    }
                                });
                            }
                            if (!matched) pelSelect.value = p.id_pelanggan || '';

                            const layName = p.nama_layanan || '';
                            const laySelect = document.getElementById('edit-id_layanan');
                            matched = false;
                            if (layName) {
                                Array.from(laySelect.options).forEach(function(opt) {
                                    if (opt.text === layName) {
                                        opt.selected = true;
                                        matched = true;
                                    }
                                });
                            }
                            if (!matched) laySelect.value = p.id_layanan || '';

                            const karName = p.nama_karyawan || '';
                            const karSelect = document.getElementById('edit-id_karyawan');
                            matched = false;
                            if (karName) {
                                Array.from(karSelect.options).forEach(function(opt) {
                                    if (opt.text === karName) {
                                        opt.selected = true;
                                        matched = true;
                                    }
                                });
                            }
                            if (!matched) karSelect.value = p.id_karyawan || '';
                        } catch (e) {
                            document.getElementById('edit-id_pelanggan').value = p.id_pelanggan || '';
                            document.getElementById('edit-id_layanan').value = p.id_layanan || '';
                            document.getElementById('edit-id_karyawan').value = p.id_karyawan || '';
                        }
                        document.getElementById('edit-tgl_masuk').value = p.tgl_masuk ? p.tgl_masuk.split(' ')[0] : '';
                        document.getElementById('edit-total_harga').value = p.total_harga || 0;
                        document.getElementById('edit-status_pesanan').value = p.status_pesanan || '';
                        document.getElementById('edit-cabang').value = p.nama_cabang || '';
                        document.getElementById('edit-jumlah_item').value = p.jumlah_item || '';
                        if (p.tgl_estimasi_selesai) {
                            const est = new Date(p.tgl_estimasi_selesai);
                            document.getElementById('edit-tgl_estimasi_selesai').value =
                                est.toISOString().slice(0, 16); // format: YYYY-MM-DDTHH:MM
                        } else {
                            document.getElementById('edit-tgl_estimasi_selesai').value = '';
                        }
                        document.getElementById('edit-catatan').value = p.catatan || '';
                    }
                    showModal();
                } catch (e) {
                    console.error(e);
                    // Tetap buka modal supaya user bisa edit dengan field kosong
                    showModal();
                }
            }

            // submit form as JSON
            async function submitEditForm(e) {
                e.preventDefault();

                // Validasi form wajib terisi
                const pelanggan = document.getElementById('edit-id_pelanggan').value;
                const layanan = document.getElementById('edit-id_layanan').value;
                const karyawan = document.getElementById('edit-id_karyawan').value;
                const tgl_masuk = document.getElementById('edit-tgl_masuk').value;
                const total_harga = document.getElementById('edit-total_harga').value;
                const status = document.getElementById('edit-status_pesanan').value;

                if (!pelanggan) {
                    showNotification('Pelanggan harus dipilih', 'error');
                    return;
                }
                if (!layanan) {
                    showNotification('Layanan harus dipilih', 'error');
                    return;
                }
                if (!karyawan) {
                    showNotification('Karyawan harus dipilih', 'error');
                    return;
                }
                if (!tgl_masuk) {
                    showNotification('Tanggal Masuk harus diisi', 'error');
                    return;
                }
                if (!total_harga || total_harga <= 0) {
                    showNotification('Total Harga harus diisi dan lebih dari 0', 'error');
                    return;
                }
                if (!status) {
                    showNotification('Status harus dipilih', 'error');
                    return;
                }

                const payload = {
                    id_pesanan: document.getElementById('edit-id_pesanan').value,
                    id_pelanggan: pelanggan,
                    id_layanan: layanan,
                    id_karyawan: karyawan,
                    tgl_masuk: tgl_masuk,
                    total_harga: total_harga,
                    status_pesanan: status,
                    jumlah_item: parseInt(document.getElementById('edit-jumlah_item').value) || 0,
                    tgl_estimasi_selesai: document.getElementById('edit-tgl_estimasi_selesai').value,
                    catatan: document.getElementById('edit-catatan').value || '',
                    // do not send `cabang` (no column in pesanan table)
                };

                const url = '<?php echo site_url("pemilik/pesanan/update_json"); ?>';
                console.log('Sending update request to:', url);
                console.log('Payload:', payload);

                try {
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });
                    console.log('Response status:', res.status, 'ok:', res.ok);
                    const json = await res.json();
                    console.log('Update response:', json);
                    console.log('pesananData before update:', pesananData);
                    if (json.status === 'success') {
                        // Update local pesanan data with data from server response
                        if (json.data) {
                            const idx = pesananData.findIndex(p => p.id_pesanan == json.data.id_pesanan);
                            console.log('Found pesanan at index:', idx, 'id:', json.data.id_pesanan);
                            if (idx !== -1) {
                                pesananData[idx] = json.data;
                                console.log('Updated pesananData[' + idx + ']:', pesananData[idx]);
                            }
                        }
                        hideModal();
                        showNotification('Pesanan berhasil diperbarui', 'success');
                        // Update stats without full page reload
                        console.log('Calling updateStatsCards, pesananData:', pesananData);
                        updateStatsCards();
                        // Optionally reload to see updated table row styling
                        setTimeout(() => location.reload(), 800);
                    } else {
                        showNotification(json.message || 'Gagal menyimpan', 'error');
                    }
                } catch (err) {
                    console.error(err);
                    showNotification('Terjadi kesalahan jaringan: ' + err.message, 'error');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // edit buttons
                document.querySelectorAll('.btn-edit').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        if (!id) return;
                        openEditModal(id);
                    });
                });

                // close/cancel handlers
                document.getElementById('closeModal').addEventListener('click', hideModal);
                document.getElementById('cancelEdit').addEventListener('click', hideModal);

                // submit handler
                document.getElementById('editForm').addEventListener('submit', submitEditForm);
            });
        })();

        let deleteId = null;

        function showDeleteModal(id, nomor) {
            deleteId = id;
            document.getElementById("delete-id-text").textContent = nomor;

            const modal = document.getElementById("deleteModal");
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }

        function hideDeleteModal() {
            const modal = document.getElementById("deleteModal");
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }

        document.addEventListener('DOMContentLoaded', function() {

            // Open modal on delete button click (use nomor_pesanan for display)
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    const nomor = this.getAttribute("data-nomor") || id;
                    showDeleteModal(id, nomor);
                });
            });

            // Cancel button
            document.getElementById("cancelDeleteBtn").addEventListener("click", hideDeleteModal);

            // Confirm delete button
            document.getElementById("confirmDeleteBtn").addEventListener("click", function() {

                fetch('<?php echo site_url("pemilik/pesanan/delete"); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                        body: 'id_pesanan=' + encodeURIComponent(deleteId)
                    })
                    .then(res => res.json())
                    .then(json => {
                        if (json.status === 'success') {
                            showNotification('Pesanan berhasil dihapus', 'success');
                            setTimeout(() => {
                                location.reload();
                            }, 800);
                        } else {
                            showNotification(json.message || 'Gagal menghapus pesanan', 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showNotification('Terjadi kesalahan jaringan', 'error');
                    });

                hideDeleteModal();
            });
        });


        // Function to filter table by search and status
        function filterTable() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase().trim();
            const statusValue = document.getElementById('statusFilter').value.toLowerCase();

            document.querySelectorAll('table tbody tr').forEach(row => {
                // Get text from nomor pesanan (col 1), pelanggan (col 3), dan status (col 7)
                const nomorCell = row.querySelector('td:nth-child(1)');
                const pelangganCell = row.querySelector('td:nth-child(3)');
                const statusCell = row.querySelector('td:nth-child(7)');

                if (!nomorCell || !pelangganCell || !statusCell) return;

                const nomor = nomorCell.textContent.trim().toLowerCase();
                const pelanggan = pelangganCell.textContent.trim().toLowerCase();
                const status = statusCell.textContent.trim().toLowerCase();

                // Match search (nomor pesanan atau nama pelanggan)
                const matchSearch = searchValue === '' || nomor.includes(searchValue) || pelanggan.includes(searchValue);

                // Match status filter
                const matchStatus = statusValue === '' || status === statusValue;

                // Show row jika kedua filter cocok
                if (matchSearch && matchStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        document.getElementById('searchInput').addEventListener('keyup', filterTable);
        document.getElementById('statusFilter').addEventListener('change', filterTable);


        (function() {
            // When clicking eye icon - redirect to detail page
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.btn-view').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        if (id) {
                            window.location.href = '<?php echo site_url("pemilik/pesanan/view/"); ?>' + id;
                        }
                    });
                });
            });
        })();



        // ============ SEARCH & FILTER TABLE ============
        (function() {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const cabangFilter = document.getElementById('cabangFilter');
            const tableBody = document.querySelector('table tbody');
            const rows = tableBody ? tableBody.querySelectorAll('tr[data-status]') : [];

            // Update statistics based on visible rows
            function updateStats() {
                let today = 0, selesai = 0, proses = 0, tunggu = 0, batal = 0;
                const todayDate = new Date().toISOString().split('T')[0];

                rows.forEach(row => {
                    if (row.style.display === 'none') return; // Skip hidden rows
                    
                    const status = row.dataset.status || '';
                    const tglMasukCell = row.querySelector('td:nth-child(2)');
                    
                    // Parse date from table (format: dd/mm/yyyy)
                    if (tglMasukCell) {
                        const parts = tglMasukCell.textContent.trim().split('/');
                        if (parts.length === 3) {
                            const rowDate = `${parts[2]}-${parts[1].padStart(2,'0')}-${parts[0].padStart(2,'0')}`;
                            if (rowDate === todayDate) today++;
                        }
                    }

                    if (status === 'selesai' || status === 'siap_diambil' || status === 'sudah_diambil') {
                        selesai++;
                    } else if (status === 'dalam_proses') {
                        proses++;
                    } else if (status === 'diterima') {
                        tunggu++;
                    } else if (status === 'dibatalkan') {
                        batal++;
                    }
                });

                // Update stat elements
                const statToday = document.getElementById('stat-today');
                const statSelesai = document.getElementById('stat-selesai');
                const statProses = document.getElementById('stat-proses');
                const statTunggu = document.getElementById('stat-tunggu');
                const statBatal = document.getElementById('stat-batal');

                if (statToday) statToday.textContent = today;
                if (statSelesai) statSelesai.textContent = selesai;
                if (statProses) statProses.textContent = proses;
                if (statTunggu) statTunggu.textContent = tunggu;
                if (statBatal) statBatal.textContent = batal;
            }

            function filterTable() {
                const searchTerm = (searchInput?.value || '').toLowerCase();
                const statusValue = statusFilter?.value || '';
                const cabangValue = cabangFilter?.value || '';

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const rowStatus = row.dataset.status || '';
                    const rowCabang = row.dataset.cabang || '';

                    const matchSearch = !searchTerm || text.includes(searchTerm);
                    const matchStatus = !statusValue || rowStatus === statusValue;
                    const matchCabang = !cabangValue || rowCabang === cabangValue;

                    row.style.display = (matchSearch && matchStatus && matchCabang) ? '' : 'none';
                });

                // Update stats after filtering
                updateStats();
            }

            if (searchInput) searchInput.addEventListener('input', filterTable);
            if (statusFilter) statusFilter.addEventListener('change', filterTable);
            if (cabangFilter) cabangFilter.addEventListener('change', filterTable);
        })();

        function showNotification(message, type = 'info') {
            const existing = document.getElementById('temp-notification');
            if (existing) {
                existing.remove();
            }

            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                'bg-blue-500 text-white'
            }`;
            notification.textContent = message;
            notification.id = 'temp-notification';

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
</body>

</html>