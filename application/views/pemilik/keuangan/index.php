<main class="flex-1 lg:ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-8 py-4">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800"><?= lang_text('financial_report') ?></h1>
            
            <div class="flex items-center gap-4">
                <!-- Search Bar -->
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="<?= lang_text('search') ?>..." class="w-80 px-4 py-2 pr-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                </div>
                
                <!-- Filter Button -->
                <button onclick="toggleFilterModal()" class="px-6 py-2 bg-emerald-500 text-white rounded-lg font-normal flex items-center gap-2 hover:bg-emerald-600">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>
                
                <!-- Tambah Transaksi Dropdown -->
                <div class="relative">
                    <button onclick="toggleTransaksiDropdown()" class="px-6 py-2 bg-emerald-500 text-white rounded-lg font-medium flex items-center gap-2 hover:bg-emerald-600">
                        <i class="fas fa-plus"></i>
                        <?= lang_text('add_transaction') ?>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div id="transaksiDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-10 border border-gray-200">
                        <a href="javascript:void(0)" onclick="openPemasukanModal()" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-t-lg">
                            <i class="fas fa-arrow-up text-green-500 mr-2"></i> <?= lang_text('income') ?>
                        </a>
                        <a href="javascript:void(0)" onclick="openPengeluaranModal()" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-b-lg">
                            <i class="fas fa-arrow-down text-red-500 mr-2"></i> <?= lang_text('expense') ?>
                        </a>
                    </div>
                </div>
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
                        <p class="text-sm font-medium text-gray-500"><?= lang_text('total_income') ?></p>
                        <h3 class="text-2xl font-bold text-emerald-500 mt-2">
                            Rp <?php echo number_format($total_pemasukan ?? 0, 0, ',', '.'); ?>
                        </h3>
                        <p class="text-sm text-gray-500 mt-2"><?php echo $selected_bulan ? date('F Y', strtotime($selected_tahun.'-'.$selected_bulan.'-01')) : $selected_tahun; ?></p>
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
                        <p class="text-sm font-medium text-gray-500"><?= lang_text('total_expense') ?></p>
                        <h3 class="text-2xl font-bold text-red-500 mt-2">
                            Rp <?php echo number_format($total_pengeluaran ?? 0, 0, ',', '.'); ?>
                        </h3>
                        <p class="text-sm text-gray-500 mt-2"><?php echo $selected_bulan ? date('F Y', strtotime($selected_tahun.'-'.$selected_bulan.'-01')) : $selected_tahun; ?></p>
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
                        <p class="text-sm font-medium text-gray-500"><?= lang_text('net_profit') ?></p>
                        <?php 
                        $net_profit = ($total_pemasukan ?? 0) - ($total_pengeluaran ?? 0);
                        $profit_class = $net_profit >= 0 ? 'text-emerald-500' : 'text-red-500';
                        ?>
                        <h3 class="text-2xl font-bold <?php echo $profit_class; ?> mt-2">
                            Rp <?php echo number_format($net_profit, 0, ',', '.'); ?>
                        </h3>
                        <p class="text-sm text-gray-500 mt-2"><?= lang_text('current_period') ?></p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-chart-line text-emerald-500"></i>
                    </div>
                </div>
            </div>

            <!-- Total Transaksi -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500"><?= lang_text('transactions') ?></p>
                        <h3 class="text-2xl font-bold text-blue-500 mt-2">
                            <?php echo count($transaksi ?? []); ?>
                        </h3>
                        <p class="text-sm text-gray-500 mt-2"><?= lang_text('transactions') ?></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-receipt text-blue-500"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Cash Flow Trend -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4"><?= lang_text('cash_flow_trend') ?></h3>
                <canvas id="cashFlowChart"></canvas>
            </div>

            <!-- Pengeluaran Breakdown -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4"><?= lang_text('expense_breakdown') ?></h3>
                <canvas id="pengeluaranChart"></canvas>
            </div>
        </div>

        <!-- Transaction Table -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-semibold text-gray-800"><?= lang_text('cost_details') ?></h3>
        
        <!-- Export Button dengan Dropdown -->
        <div class="relative">
            <button onclick="toggleExportDropdown()" class="px-6 py-2 bg-emerald-500 text-white rounded-lg font-medium flex items-center gap-2 hover:bg-emerald-600">
                <i class="fas fa-file-export"></i>
                <?= lang_text('export_data') ?>
                <i class="fas fa-chevron-down text-xs ml-2"></i>
            </button>
            
            <!-- Dropdown Menu Export -->
            <div id="exportDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-20 border border-gray-200">
                <!-- Header Export Type -->
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-semibold text-gray-700"><?= lang_text('report_type') ?></p>
                </div>
                
                <!-- Export Options -->
                <a href="javascript:void(0)" onclick="exportData('all', 'excel')" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50">
                    <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center mr-3">
                        <i class="fas fa-file-excel text-emerald-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="font-medium text-sm">Excel (<?= lang_text('all_transactions') ?>)</p>
                        <p class="text-xs text-gray-500"><?= lang_text('all_transactions') ?></p>
                    </div>
                </a>
                
                <a href="javascript:void(0)" onclick="exportData('income_only', 'excel')" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50">
                    <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mr-3">
                        <i class="fas fa-arrow-up text-green-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="font-medium text-sm">Excel (<?= lang_text('income') ?>)</p>
                        <p class="text-xs text-gray-500"><?= lang_text('income_only') ?></p>
                    </div>
                </a>
                
                <a href="javascript:void(0)" onclick="exportData('expense_only', 'excel')" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50">
                    <div class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center mr-3">
                        <i class="fas fa-arrow-down text-red-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="font-medium text-sm">Excel (<?= lang_text('expense') ?>)</p>
                        <p class="text-xs text-gray-500"><?= lang_text('expense_only') ?></p>
                    </div>
                </a>
                
                <!-- Separator -->
                <div class="border-t border-gray-100">
                    <div class="px-4 py-2">
                        <p class="text-xs font-medium text-gray-500"><?= lang_text('other_format') ?></p>
                    </div>
                </div>
                
                <!-- CSV Option -->
                <a href="javascript:void(0)" onclick="exportData('all', 'csv')" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50">
                    <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                        <i class="fas fa-file-csv text-blue-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="font-medium text-sm">Download CSV</p>
                        <p class="text-xs text-gray-500">Format spreadsheet</p>
                    </div>
                </a>
                
                <!-- PDF Option -->
                <a href="javascript:void(0)" onclick="exportData('all', 'pdf')" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50">
                    <div class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center mr-3">
                        <i class="fas fa-file-pdf text-red-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="font-medium text-sm">Download PDF</p>
                        <p class="text-xs text-gray-500"><?= lang_text('for_print') ?></p>
                    </div>
                </a>
            </div>
        </div>
    </div>
            <div class="overflow-x-auto">
                <table class="w-full" id="transaksiTable">
                    <thead class="border-b border-gray-200">
                        <tr>
                            <th class="text-center py-3 px-4 text-base font-medium text-gray-600"><?= lang_text('date') ?></th>
                            <th class="text-center py-3 px-4 text-base font-medium text-gray-600"><?= lang_text('description') ?></th>
                            <th class="text-center py-3 px-4 text-base font-medium text-gray-600"><?= lang_text('branch') ?></th>
                            <th class="text-center py-3 px-4 text-base font-medium text-gray-600"><?= lang_text('category') ?></th>
                            <th class="text-center py-3 px-4 text-base font-medium text-gray-600"><?= lang_text('type') ?></th>
                            <th class="text-center py-3 px-4 text-base font-medium text-gray-600"><?= lang_text('amount') ?></th>
                            <th class="text-center py-3 px-4 text-base font-medium text-gray-600"><?= lang_text('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transaksi)): ?>
                            <?php foreach ($transaksi as $item): ?>
                                <tr class="border-b border-gray-100">
                                    <td class="py-4 px-4 text-center text-gray-700">
                                        <?php echo date('d M Y', strtotime($item->tgl_transaksi)); ?>
                                    </td>
                                    <td class="py-4 px-4 text-center text-gray-700">
                                        <?php echo htmlspecialchars($item->nama_transaksi); ?>
                                        <?php if ($item->keterangan): ?>
                                            <br><small class="text-gray-500"><?php echo htmlspecialchars($item->keterangan); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 px-4 text-center text-gray-600">
                                        <?php echo htmlspecialchars($item->nama_cabang ?? '-'); ?>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                            <?php echo htmlspecialchars($item->kategori); ?>
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <?php if ($item->tipe_transaksi == 'pemasukan'): ?>
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full"><?= lang_text('income') ?></span>
                                        <?php else: ?>
                                            <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full"><?= lang_text('expense') ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 px-4 text-center font-semibold <?php echo $item->tipe_transaksi == 'pemasukan' ? 'text-emerald-500' : 'text-red-500'; ?>">
                                        <?php echo $item->tipe_transaksi == 'pemasukan' ? '+' : '-'; ?>Rp <?php echo number_format($item->jumlah, 0, ',', '.'); ?>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <button onclick="edit<?php echo ucfirst($item->tipe_transaksi); ?>(<?php echo $item->id_transaksi; ?>)" class="text-blue-500 hover:text-blue-700 mr-3" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deleteTransaksi('<?php echo $item->tipe_transaksi; ?>', <?php echo $item->id_transaksi; ?>, '<?php echo htmlspecialchars($item->nama_transaksi, ENT_QUOTES); ?>')" class="text-red-500 hover:text-red-700" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="py-8 text-center text-gray-500"><?= lang_text('no_transaction_data') ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal Filter -->
<div id="filterModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-800"><?= lang_text('filter_finance') ?></h3>
            <button onclick="toggleFilterModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form id="filterForm" method="get" action="<?php echo base_url('pemilik/keuangan'); ?>">
            <div class="p-6 space-y-4">
                <!-- Cabang -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang_text('branch') ?></label>
                    <select name="id_cabang" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value=""><?= lang_text('all_branches') ?></option>
                        <?php if (!empty($cabang_list)): ?>
                            <?php foreach ($cabang_list as $cabang): ?>
                                <option value="<?php echo $cabang->id_cabang; ?>" <?php echo (isset($_GET['id_cabang']) && $_GET['id_cabang'] == $cabang->id_cabang) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cabang->nama_cabang); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Tahun -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select name="tahun" id="filterTahun" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <?php if (!empty($tahun_list)): ?>
                            <?php foreach ($tahun_list as $thn): ?>
                                <option value="<?php echo $thn; ?>" <?php echo ($selected_tahun == $thn) ? 'selected' : ''; ?>>
                                    <?php echo $thn; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Bulan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2"><?= lang_text('month') ?></label>
                    <select name="bulan" id="filterBulan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value=""><?= lang_text('all_months') ?></option>
                        <?php 
                        $bulan_list = [
                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                        ];
                        foreach ($bulan_list as $key => $value):
                        ?>
                            <option value="<?php echo $key; ?>" <?php echo ($selected_bulan == $key) ? 'selected' : ''; ?>>
                                <?php echo $value; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Kategori</option>
                        <option value="Penjualan" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Penjualan') ? 'selected' : ''; ?>>Penjualan</option>
                        <option value="Layanan" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Layanan') ? 'selected' : ''; ?>>Layanan</option>
                        <option value="Operasional" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Operasional') ? 'selected' : ''; ?>>Operasional</option>
                        <option value="Supplies" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Supplies') ? 'selected' : ''; ?>>Supplies</option>
                        <option value="Marketing" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
                        <option value="Payroll" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Payroll') ? 'selected' : ''; ?>>Payroll</option>
                        <option value="Lain-lain" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Lain-lain') ? 'selected' : ''; ?>>Lain-lain</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 p-6 border-t">
                <button type="button" onclick="resetFilter()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    <?= lang_text('reset') ?>
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600">
                    <?= lang_text('apply_filter') ?>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Pemasukan -->
<!-- Modal Pemasukan -->
<div id="pemasukanModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center overflow-y-auto">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 my-8">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-800" id="pemasukanModalTitle"><?= lang_text('add_income') ?></h3>
            <button onclick="closePemasukanModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form id="pemasukanForm" onsubmit="submitPemasukan(event)" enctype="multipart/form-data">
            <input type="hidden" id="pemasukan_id" name="id">
            <div class="p-6 space-y-4">
                <!-- Cabang -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cabang <span class="text-red-500">*</span></label>
                    <select name="id_cabang" id="pemasukan_cabang" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="">Pilih Cabang</option>
                        <?php if (!empty($cabang_list)): ?>
                            <?php foreach ($cabang_list as $cabang): ?>
                                <option value="<?php echo $cabang->id_cabang; ?>">
                                    <?php echo htmlspecialchars($cabang->nama_cabang); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Nama Transaksi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Transaksi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_transaksi" id="pemasukan_nama" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" id="pemasukan_kategori" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="">Pilih Kategori</option>
                        <option value="Penjualan">Penjualan</option>
                        <option value="Layanan">Layanan</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>

                <!-- Jumlah -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah" id="pemasukan_jumlah" required min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" name="tgl_transaksi" id="pemasukan_tanggal" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <!-- Bukti Transaksi -->
                <div>
                    <label for="pemasukan_bukti" class="block text-sm font-medium text-gray-700 mb-2">Bukti Transaksi (JPG, PNG, PDF)</label>
                    <input type="file" name="bukti_transaksi" id="pemasukan_bukti" accept=".jpg,.jpeg,.png,.pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB</p>
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea name="keterangan" id="pemasukan_keterangan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                </div>
            </div>
            <div class="flex gap-3 p-6 border-t">
                <button type="button" onclick="closePemasukanModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Pengeluaran -->
<div id="pengeluaranModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center overflow-y-auto">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 my-8">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-800" id="pengeluaranModalTitle">Tambah Pengeluaran</h3>
            <button onclick="closePengeluaranModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form id="pengeluaranForm" onsubmit="submitPengeluaran(event)" enctype="multipart/form-data">
            <input type="hidden" id="pengeluaran_id" name="id">
            <div class="p-6 space-y-4">
                <!-- Cabang -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cabang <span class="text-red-500">*</span></label>
                    <select name="id_cabang" id="pengeluaran_cabang" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="">Pilih Cabang</option>
                        <?php if (!empty($cabang_list)): ?>
                            <?php foreach ($cabang_list as $cabang): ?>
                                <option value="<?php echo $cabang->id_cabang; ?>">
                                    <?php echo htmlspecialchars($cabang->nama_cabang); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Nama Transaksi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Transaksi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_transaksi" id="pengeluaran_nama" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" id="pengeluaran_kategori" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="">Pilih Kategori</option>
                        <option value="Operasional">Operasional</option>
                        <option value="Supplies">Supplies</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Payroll">Payroll</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>

                <!-- Jumlah -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah" id="pengeluaran_jumlah" required min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" name="tgl_transaksi" id="pengeluaran_tanggal" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <!-- Bukti Transaksi -->
                <div>
                    <label for="pengeluaran_bukti" class="block text-sm font-medium text-gray-700 mb-2">Bukti Transaksi (JPG, PNG, PDF)</label>
                    <input type="file" name="bukti_transaksi" id="pengeluaran_bukti" accept=".jpg,.jpeg,.png,.pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB</p>
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea name="keterangan" id="pengeluaran_keterangan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                </div>
            </div>
            <div class="flex gap-3 p-6 border-t">
                <button type="button" onclick="closePengeluaranModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6 mx-4">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800"><?= lang_text('confirm_delete') ?>?</h3>
        </div>
        <p class="text-gray-600 mb-6 leading-relaxed">
            <?= lang_text('transactions') ?> <span id="delete-nama-text" class="font-semibold text-gray-800"></span> <?= lang_text('will_be_deleted') ?>.
        </p>
        <div class="flex justify-end gap-3">
            <button id="cancelDeleteBtn" onclick="hideDeleteModal()"
                class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                <?= lang_text('cancel') ?>
            </button>
            <button id="confirmDeleteBtn"
                class="px-5 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">
                <?= lang_text('delete') ?>
            </button>
        </div>
    </div>
</div>

<script>
const BASE_URL = '<?php echo base_url(); ?>';

function getApiUrl(endpoint, params = {}) {
    let url = BASE_URL + 'pemilik/keuangan/' + endpoint;
    let queryParams = [];
    
    for (let key in params) {
        if (params[key] !== null && params[key] !== undefined && params[key] !== '') {
            queryParams.push(encodeURIComponent(key) + '=' + encodeURIComponent(params[key]));
        }
    }
    
    if (queryParams.length > 0) {
        url += '?' + queryParams.join('&');
    }
    
    return url;
}

// Toggle Transaksi Dropdown
function toggleTransaksiDropdown() {
    const dropdown = document.getElementById('transaksiDropdown');
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('transaksiDropdown');
    const button = event.target.closest('button');
    
    if (dropdown && !dropdown.classList.contains('hidden')) {
        if (!button || !button.getAttribute('onclick') || 
            button.getAttribute('onclick').indexOf('toggleTransaksiDropdown') === -1) {
            if (!dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        }
    }
});


// Toggle Export Dropdown
function toggleExportDropdown() {
    const dropdown = document.getElementById('exportDropdown');
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    }
}

// Close export dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('exportDropdown');
    const exportButton = event.target.closest('button');
    
    if (dropdown && !dropdown.classList.contains('hidden')) {
        if (!exportButton || !exportButton.getAttribute('onclick') || 
            exportButton.getAttribute('onclick').indexOf('toggleExportDropdown') === -1) {
            if (!dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        }
    }
});

// Export Data Function
function exportData(exportType = 'all', format = 'excel') {
    // Dapatkan semua filter yang aktif dari halaman
    const searchInput = document.getElementById('searchInput');
    const filterForm = document.getElementById('filterForm');
    const formData = new FormData(filterForm);
    
    // Sembunyikan dropdown
    document.getElementById('exportDropdown').classList.add('hidden');
    
    // Bangun URL untuk export
    const params = new URLSearchParams();
    
    // Tambahkan tipe export
    params.append('export_type', exportType);
    
    // Tambahkan parameter filter dari form jika ada
    if (formData.get('id_cabang')) {
        params.append('id_cabang', formData.get('id_cabang'));
    }
    
    if (formData.get('tahun')) {
        params.append('tahun', formData.get('tahun'));
    }
    
    if (formData.get('bulan')) {
        params.append('bulan', formData.get('bulan'));
    }
    
    if (formData.get('kategori')) {
        params.append('kategori', formData.get('kategori'));
    }
    
    // Tambahkan search term jika ada
    if (searchInput && searchInput.value.trim()) {
        params.append('search', searchInput.value.trim());
    }
    
    // Tambahkan tanggal dari filter jika ada di URL
    const urlParams = new URLSearchParams(window.location.search);
    const dateStart = urlParams.get('date_start');
    const dateEnd = urlParams.get('date_end');
    
    if (dateStart) {
        params.append('date_start', dateStart);
    }
    
    if (dateEnd) {
        params.append('date_end', dateEnd);
    }
    
    // Jika tidak ada filter tanggal, gunakan bulan dan tahun dari filter
    if (!dateStart && !dateEnd) {
        const tahun = formData.get('tahun') || new Date().getFullYear();
        const bulan = formData.get('bulan') || '';
        
        if (bulan) {
            // Jika bulan dipilih, gunakan tanggal awal dan akhir bulan tersebut
            params.append('date_start', tahun + '-' + bulan + '-01');
            const lastDay = new Date(tahun, bulan, 0).getDate();
            params.append('date_end', tahun + '-' + bulan + '-' + lastDay);
        } else if (tahun) {
            // Jika hanya tahun dipilih, gunakan seluruh tahun
            params.append('date_start', tahun + '-01-01');
            params.append('date_end', tahun + '-12-31');
        }
    }
    
    // Tampilkan loading notification
    showNotification('Menyiapkan laporan ' + format.toUpperCase() + '...', 'info');
    
    // Redirect ke controller export
    const exportUrl = BASE_URL + 'pemilik/export_keuangan/export/' + format + '?' + params.toString();
    
    // Buka di tab baru untuk proses export
    setTimeout(() => {
        window.open(exportUrl, '_blank');
    }, 500);
}

// Export Modal untuk pilihan lanjutan
function openExportModal() {
    showNotification('Fitur export lanjutan akan segera tersedia!', 'info');
}

// Initialize export button events
function initExportFunctions() {
    // Add keyboard shortcut for export (Ctrl+E)
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'e') {
            e.preventDefault();
            toggleExportDropdown();
        }
    });
}

// Filter Modal
function toggleFilterModal() {
    const modal = document.getElementById('filterModal');
    if (modal) {
        modal.classList.toggle('hidden');
    }
}

function resetFilter() {
    window.location.href = BASE_URL + 'pemilik/keuangan/';
}

// Pemasukan Modal Functions
function openPemasukanModal() {
    const modal = document.getElementById('pemasukanModal');
    const form = document.getElementById('pemasukanForm');
    const dropdown = document.getElementById('transaksiDropdown');
    
    if (modal && form) {
        document.getElementById('pemasukanModalTitle').textContent = 'Tambah Pemasukan';
        form.reset();
        document.getElementById('pemasukan_id').value = '';
        document.getElementById('pemasukan_tanggal').value = new Date().toISOString().split('T')[0];
        
        // Reset file input display
        const fileLabel = document.querySelector('#pemasukanForm label[for="pemasukan_bukti"]');
        if (fileLabel) {
            fileLabel.textContent = 'Bukti Transaksi (JPG, PNG, PDF)';
        }
        
        modal.classList.remove('hidden');
    }
    
    if (dropdown) {
        dropdown.classList.add('hidden');
    }
}

function closePemasukanModal() {
    const modal = document.getElementById('pemasukanModal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

function editPemasukan(id) {
    fetch(BASE_URL + 'pemilik/keuangan/get_pemasukan/' + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(result => {
            if (result.success) {
                const data = result.data;
                document.getElementById('pemasukanModalTitle').textContent = 'Edit Pemasukan';
                document.getElementById('pemasukan_id').value = data.id_pemasukan;
                document.getElementById('pemasukan_cabang').value = data.id_cabang;
                document.getElementById('pemasukan_nama').value = data.nama_transaksi;
                document.getElementById('pemasukan_kategori').value = data.kategori;
                document.getElementById('pemasukan_jumlah').value = data.jumlah;
                document.getElementById('pemasukan_tanggal').value = data.tgl_transaksi;
                document.getElementById('pemasukan_keterangan').value = data.keterangan || '';
                
                // Show existing file if any
                if (data.bukti_transaksi) {
                    const fileLabel = document.querySelector('#pemasukanForm label[for="pemasukan_bukti"]');
                    if (fileLabel) {
                        fileLabel.innerHTML = 'Bukti Transaksi (JPG, PNG, PDF)<br><small class="text-blue-600">File saat ini: ' + data.bukti_transaksi.nama_file + '</small>';
                    }
                }
                
                document.getElementById('pemasukanModal').classList.remove('hidden');
            } else {
                showNotification(result.message || 'Data tidak ditemukan', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat mengambil data', 'error');
        });
}

function submitPemasukan(event) {
    event.preventDefault();
    const form = document.getElementById('pemasukanForm');
    const formData = new FormData(form);
    const id = document.getElementById('pemasukan_id').value;
    
    const url = id ? 
        BASE_URL + 'pemilik/keuangan/update_pemasukan/' + id : 
        BASE_URL + 'pemilik/keuangan/add_pemasukan';
    
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.status);
        }
        return response.json();
    })
    .then(result => {
        if (result.success) {
            showNotification(result.message, 'success');
            closePemasukanModal();
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showNotification(result.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menyimpan data: ' + error.message, 'error');
    });
}

// Pengeluaran Modal Functions
function openPengeluaranModal() {
    const modal = document.getElementById('pengeluaranModal');
    const form = document.getElementById('pengeluaranForm');
    const dropdown = document.getElementById('transaksiDropdown');
    
    if (modal && form) {
        document.getElementById('pengeluaranModalTitle').textContent = 'Tambah Pengeluaran';
        form.reset();
        document.getElementById('pengeluaran_id').value = '';
        document.getElementById('pengeluaran_tanggal').value = new Date().toISOString().split('T')[0];
        
        // Reset file input display
        const fileLabel = document.querySelector('#pengeluaranForm label[for="pengeluaran_bukti"]');
        if (fileLabel) {
            fileLabel.textContent = 'Bukti Transaksi (JPG, PNG, PDF)';
        }
        
        modal.classList.remove('hidden');
    }
    
    if (dropdown) {
        dropdown.classList.add('hidden');
    }
}

function closePengeluaranModal() {
    const modal = document.getElementById('pengeluaranModal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

function editPengeluaran(id) {
    fetch(BASE_URL + 'pemilik/keuangan/get_pengeluaran/' + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(result => {
            if (result.success) {
                const data = result.data;
                document.getElementById('pengeluaranModalTitle').textContent = 'Edit Pengeluaran';
                document.getElementById('pengeluaran_id').value = data.id_pengeluaran;
                document.getElementById('pengeluaran_cabang').value = data.id_cabang;
                document.getElementById('pengeluaran_nama').value = data.nama_transaksi;
                document.getElementById('pengeluaran_kategori').value = data.kategori;
                document.getElementById('pengeluaran_jumlah').value = data.jumlah;
                document.getElementById('pengeluaran_tanggal').value = data.tgl_transaksi;
                document.getElementById('pengeluaran_keterangan').value = data.keterangan || '';
                
                // Show existing file if any
                if (data.bukti_transaksi) {
                    const fileLabel = document.querySelector('#pengeluaranForm label[for="pengeluaran_bukti"]');
                    if (fileLabel) {
                        fileLabel.innerHTML = 'Bukti Transaksi (JPG, PNG, PDF)<br><small class="text-blue-600">File saat ini: ' + data.bukti_transaksi.nama_file + '</small>';
                    }
                }
                
                document.getElementById('pengeluaranModal').classList.remove('hidden');
            } else {
                showNotification(result.message || 'Data tidak ditemukan', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat mengambil data', 'error');
        });
}

function submitPengeluaran(event) {
    event.preventDefault();
    const form = document.getElementById('pengeluaranForm');
    const formData = new FormData(form);
    const id = document.getElementById('pengeluaran_id').value;
    
    const url = id ? 
        BASE_URL + 'pemilik/keuangan/update_pengeluaran/' + id : 
        BASE_URL + 'pemilik/keuangan/add_pengeluaran';
    
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.status);
        }
        return response.json();
    })
    .then(result => {
        if (result.success) {
            showNotification(result.message, 'success');
            closePengeluaranModal();
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showNotification(result.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menyimpan data: ' + error.message, 'error');
    });
}

// Delete Transaction
let deleteTipe = null;
let deleteId = null;

function deleteTransaksi(tipe, id, nama) {
    deleteTipe = tipe;
    deleteId = id;
    document.getElementById("delete-nama-text").textContent = '"' + nama + '"';
    
    const modal = document.getElementById("deleteModal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

function hideDeleteModal() {
    const modal = document.getElementById("deleteModal");
    modal.classList.add("hidden");
    modal.classList.remove("flex");
    deleteTipe = null;
    deleteId = null;
}

document.addEventListener('DOMContentLoaded', function() {
    const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener("click", function() {
            if (!deleteId || !deleteTipe) return;
            
            const url = deleteTipe === 'pemasukan' ? 
                BASE_URL + 'pemilik/keuangan/delete_pemasukan/' + deleteId : 
                BASE_URL + 'pemilik/keuangan/delete_pengeluaran/' + deleteId;
            
            fetch(url, {
                method: 'POST'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                return response.json();
            })
            .then(result => {
                if (result.success) {
                    showNotification(result.message, 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showNotification(result.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat menghapus data: ' + error.message, 'error');
            });
            
            hideDeleteModal();
        });
    }
});

// File input change handler
function handleFileInput(inputId, labelId) {
    const input = document.getElementById(inputId);
    const label = document.querySelector('label[for="' + inputId + '"]');
    
    if (input && label) {
        input.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const fileName = this.files[0].name;
                const fileSize = (this.files[0].size / 1024).toFixed(2); // KB
                label.innerHTML = 'Bukti Transaksi (JPG, PNG, PDF)<br><small class="text-green-600">File dipilih: ' + fileName + ' (' + fileSize + ' KB)</small>';
            }
        });
    }
}

// Search Function
const searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#transaksiTable tbody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
}

// Notification Function
function showNotification(message, type = 'info') {
    const existing = document.getElementById('temp-notification');
    if (existing) existing.remove();

    const notification = document.createElement('div');

    let neonClass = '';
    let neonShadow = '';

    if (type === 'success') {
        neonClass = 'bg-green-400 text-black';
        neonShadow = '0 0 10px #22c55e, 0 0 20px #22c55e, 0 0 40px #22c55e';
    } else if (type === 'error') {
        neonClass = 'bg-red-400 text-black';
        neonShadow = '0 0 10px #f87171, 0 0 20px #f87171, 0 0 40px #f87171';
    } else {
        neonClass = 'bg-cyan-400 text-black';
        neonShadow = '0 0 10px #22d3ee, 0 0 20px #22d3ee, 0 0 40px #22d3ee';
    }

    notification.className = `
        fixed top-4 right-4 px-6 py-3 rounded-xl
        font-semibold tracking-wide
        z-50 transition-all duration-300
        ${neonClass}
    `;

    notification.style.boxShadow = neonShadow;
    notification.style.filter = 'brightness(1.1)';
    notification.textContent = message;
    notification.id = 'temp-notification';

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateY(-10px)';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}


// Chart Functions
let cashFlowChartInstance = null;
let pengeluaranChartInstance = null;

function loadCharts() {
    const urlParams = new URLSearchParams(window.location.search);
    const tahun = urlParams.get('tahun') || new Date().getFullYear();
    const id_cabang = urlParams.get('id_cabang') || '';
    
    console.log('Loading charts for tahun:', tahun, 'cabang:', id_cabang);
    
    // Load Cash Flow Chart
    fetch(getApiUrl('get_grafik_gabungan', { tahun: tahun, id_cabang: id_cabang }))
        .then(response => {
            console.log('Cash flow response status:', response.status);
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(result => {
            console.log('Cash flow result:', result);
            if (result.success) {
                renderCashFlowChart(result.data);
            } else {
                console.error('Server error:', result.message);
                showNotification('Gagal memuat data cash flow: ' + result.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error loading cash flow:', error);
            showNotification('Gagal memuat data grafik cash flow', 'error');
        });
    
    // Load Pengeluaran Chart
    fetch(getApiUrl('get_summary_kategori', { 
        tahun: tahun, 
        tipe: 'pengeluaran', 
        id_cabang: id_cabang 
    }))
        .then(response => {
            console.log('Pengeluaran response status:', response.status);
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(result => {
            console.log('Pengeluaran result:', result);
            if (result.success) {
                renderPengeluaranChart(result.data);
            } else {
                console.error('Server error:', result.message);
                showNotification('Gagal memuat data pengeluaran: ' + result.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error loading pengeluaran:', error);
            showNotification('Gagal memuat data breakdown pengeluaran', 'error');
        });
}

function renderCashFlowChart(data) {
    const ctx = document.getElementById('cashFlowChart');
    if (!ctx) {
        console.error('Canvas cashFlowChart not found');
        return;
    }
    
    // Destroy existing chart
    if (cashFlowChartInstance) {
        cashFlowChartInstance.destroy();
    }
    
    console.log('Rendering cash flow chart with data:', data);
    
    cashFlowChartInstance = new Chart(ctx.getContext('2d'), {
        type: 'line',
        data: {
            labels: data.map(d => d.nama_bulan),
            datasets: [{
                label: 'Pemasukan',
                data: data.map(d => parseFloat(d.pemasukan) || 0),
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Pengeluaran',
                data: data.map(d => parseFloat(d.pengeluaran) || 0),
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
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (value >= 1000000) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                            } else if (value >= 1000) {
                                return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                            }
                            return 'Rp ' + value;
                        }
                    }
                }
            }
        }
    });
}

function renderPengeluaranChart(data) {
    const ctx = document.getElementById('pengeluaranChart');
    if (!ctx) {
        console.error('Canvas pengeluaranChart not found');
        return;
    }
    
    // Destroy existing chart
    if (pengeluaranChartInstance) {
        pengeluaranChartInstance.destroy();
    }
    
    console.log('Rendering pengeluaran chart with data:', data);
    
    // Handle empty data
    if (!data || data.length === 0) {
        console.log('No pengeluaran data available');
        data = [{kategori: 'Tidak ada data', total: 0}];
    }
    
    pengeluaranChartInstance = new Chart(ctx.getContext('2d'), {
        type: 'bar',
        data: {
            labels: data.map(d => d.kategori),
            datasets: [{
                label: 'Pengeluaran',
                data: data.map(d => parseFloat(d.total) || 0),
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
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (value >= 1000000) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                            } else if (value >= 1000) {
                                return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                            }
                            return 'Rp ' + value;
                        }
                    }
                }
            }
        }
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded');
    
    // Set default dates
    const today = new Date().toISOString().split('T')[0];
    const pemasukanDate = document.getElementById('pemasukan_tanggal');
    const pengeluaranDate = document.getElementById('pengeluaran_tanggal');
    
    if (pemasukanDate && !pemasukanDate.value) {
        pemasukanDate.value = today;
    }
    
    if (pengeluaranDate && !pengeluaranDate.value) {
        pengeluaranDate.value = today;
    }
    
    // Setup file input handlers
    handleFileInput('pemasukan_bukti', 'pemasukan_bukti_label');
    handleFileInput('pengeluaran_bukti', 'pengeluaran_bukti_label');
    
    // Load charts
    loadCharts();
        initExportFunctions();

});
</script>