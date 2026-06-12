<!DOCTYPE html>
<html lang="id">

<head>
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <h1 class="text-2xl font-semibold text-gray-800"><?= lang_text('manage_orders') ?></h1>
                        <div class="bg-emerald-100 px-4 py-1 rounded-full">
                            <span class="text-teal-700 text-sm font-medium"><?php echo isset($pesanan) ? count($pesanan) . ' ' . lang_text('total_orders') : '0 ' . lang_text('total_orders'); ?></span>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                        <!-- Search -->
                        <div class="relative flex-1 md:w-80">
                            <input type="text" id="searchInput" placeholder="<?= lang_text('search') ?>..."
                                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>

                        <!-- Status Filter -->

                        <select id="statusFilter"
                            class="px-4 py-2 border border-gray-300 rounded-xl text-black focus:outline-none focus:border-emerald-500">
                            <option value=""><?= lang_text('all_status') ?></option>
                            <?php foreach ($status_list as $value => $label): ?>
                                <option value="<?= $value ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>

                        <!-- Cabang Filter -->
                        <select id="cabangFilter"
                            class="px-4 py-2 border border-gray-300 rounded-xl text-black focus:outline-none focus:border-emerald-500">
                            <option value=""><?= lang_text('all_branches') ?></option>
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



                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">
                    <!-- Total Pesanan Hari Ini -->
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500"><?= lang_text('total_orders_today') ?></p>
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
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500"><?= lang_text('orders_completed') ?></p>
                                <h3 id="stat-selesai" class="text-3xl font-bold text-gray-800 mt-2"><?php
                                                                                                    $done = 0;
                                                                                                    if (!empty($pesanan)) {
                                                                                                        foreach ($pesanan as $p) {
                                                                                                            $s = strtolower($p->status_pesanan ?? '');
                                                                                                            if (in_array($s, ['selesai', 'siap_diambil', 'sudah_diambil'])) $done++;
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
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500"><?= lang_text('in_process') ?></p>
                                <h3 id="stat-proses" class="text-3xl font-bold text-gray-800 mt-2"><?php
                                                                                                    $processing = 0;
                                                                                                    if (!empty($pesanan)) {
                                                                                                        foreach ($pesanan as $p) {
                                                                                                            $s = strtolower($p->status_pesanan ?? '');
                                                                                                            if ($s === 'dalam_proses') $processing++;
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
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500"><?= lang_text('received') ?></p>
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
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-gray-500"><?= lang_text('cancelled') ?></p>
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

                <!-- Charts Section (Moved to top) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Tren Pesanan -->
                    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4"><?= lang_text('order_trend') ?> (7 <?= lang_text('days') ?>)</h2>
                        <div class="h-64">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>

                    <!-- Pesanan per Cabang -->
                    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4"><?= lang_text('orders_by_branch') ?></h2>
                        <div class="h-64">
                            <canvas id="branchChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <!-- Data Pesanan Table (Full Width) -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6"><?= lang_text('order_data') ?></h2>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="border-b border-gray-200">
                                <tr>
                                    <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm"><?= lang_text('order_number') ?></th>
                                    <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm"><?= lang_text('date') ?></th>
                                    <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm"><?= lang_text('customer') ?></th>
                                    <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm"><?= lang_text('branch') ?></th>
                                    <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm"><?= lang_text('service') ?></th>
                                    <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm"><?= lang_text('total') ?></th>
                                    <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm"><?= lang_text('status') ?></th>
                                    <th class="text-center py-3 px-2 text-gray-600 font-medium text-sm"><?= lang_text('action') ?></th>
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
                                        <td colspan="8" class="text-center py-6 text-gray-500"><?= lang_text('no_order_data') ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>

    <!-- Modal Edit Pesanan -->
            <div id="modalEditPesanan" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl mx-4 max-h-[90vh] overflow-hidden">
                    <!-- Header -->
                    <div class="bg-white border-b p-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-edit text-emerald-600 text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Edit Pesanan</h2>
                                <p class="text-gray-500 text-sm">Perbarui informasi pesanan</p>
                            </div>
                        </div>
                        <button id="btnCloseEditModal" class="text-gray-400 hover:text-gray-600 text-2xl hover:bg-gray-100 rounded-lg w-10 h-10 flex items-center justify-center transition-all">
                            &times;
                        </button>
                    </div>
                    
                    <!-- Body with scroll -->
                    <div class="p-6 max-h-[calc(90vh-180px)] overflow-y-auto">
                        <form id="formEditPesanan" enctype="multipart/form-data">
                            <input type="hidden" name="id_pesanan" id="edit-id_pesanan">
                            
                            <!-- Info Pesanan Section -->
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 mb-6">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-info-circle text-emerald-600 text-sm"></i>
                                    </div>
                                    <h3 class="font-semibold text-gray-800">Informasi Pesanan</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-flag text-emerald-500 mr-1"></i>Status Pesanan
                                        </label>
                                        <select name="status_pesanan" id="edit-status_pesanan"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                            <?php foreach ($status_list as $value => $label): ?>
                                                <option value="<?= $value ?>"><?= $label ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-concierge-bell text-emerald-500 mr-1"></i>Layanan
                                        </label>
                                        <select name="id_layanan" id="edit-id_layanan"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                            <?php foreach ($layanan_list as $lay): ?>
                                                <option value="<?= $lay->id_layanan ?>" data-harga="<?= $lay->harga ?>">
                                                    <?= htmlspecialchars($lay->nama_layanan) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-shoe-prints text-emerald-500 mr-1"></i>Jumlah Item
                                        </label>
                                        <input type="number" name="jumlah_item" id="edit-jumlah_item" min="1" readonly
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-100 text-gray-600">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-money-bill-wave text-emerald-500 mr-1"></i>Total Harga
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                            <input type="number" name="total_harga" id="edit-total_harga"
                                                class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-calendar-check text-emerald-500 mr-1"></i>Estimasi Selesai
                                        </label>
                                        <input type="datetime-local" name="tgl_estimasi_selesai" id="edit-tgl_estimasi_selesai"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-sticky-note text-emerald-500 mr-1"></i>Catatan
                                        </label>
                                        <textarea name="catatan" id="edit-catatan" rows="2" placeholder="Catatan tambahan..."
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 resize-none transition-all"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Detail Items Section -->
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-shoe-prints text-emerald-600 text-sm"></i>
                                        </div>
                                        <h3 class="font-semibold text-gray-800">Detail Sepatu</h3>
                                    </div>
                                    <span class="text-xs text-gray-500 bg-white px-3 py-1 rounded-full border">
                                        <i class="fas fa-camera mr-1"></i>Upload foto saat selesai
                                    </span>
                                </div>
                                
                                <div id="editDetailItemsContainer" class="space-y-4">
                                    <!-- Dynamic items will be loaded here -->
                                    <div class="text-center py-8 text-gray-400">
                                        <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                                        <p class="text-sm">Memuat detail sepatu...</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Fixed Footer -->
                    <div class="p-4 border-t bg-gray-50 flex justify-end gap-3">
                        <button type="button" id="btnBatalEditModal" class="px-6 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 font-medium transition-all flex items-center gap-2">
                            <i class="fas fa-times"></i>Batal
                        </button>
                        <button type="submit" form="formEditPesanan" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-medium transition-all flex items-center gap-2">
                            <i class="fas fa-save"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>


            <!-- Modal Delete Confirmation -->
            <div id="modalDeletePesanan" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md mx-4">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-red-100">
                            <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Hapus Pesanan?</h3>
                    </div>
                    <p class="text-gray-600 mb-6">
                        Pesanan <span id="delete-nomor" class="font-semibold"></span> akan dihapus. Tindakan ini tidak bisa dibatalkan.
                    </p>
                    <input type="hidden" id="delete-id">
                    <div class="flex justify-end gap-3">
                        <button id="btnCancelDelete" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</button>
                        <button id="btnConfirmDelete" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">Hapus</button>
                    </div>
                </div>
            </div>

            <!-- Modal Status Change Confirmation -->
            <div id="modalStatusPesanan" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md mx-4">
                    <div class="flex items-center gap-3 mb-4">
                        <div id="status-icon" class="w-12 h-12 flex items-center justify-center rounded-full bg-emerald-100">
                            <i class="fas fa-sync-alt text-emerald-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Ubah Status Pesanan</h3>
                    </div>
                    <p class="text-gray-600 mb-6">
                        Ubah status pesanan menjadi <span id="status-label" class="font-semibold text-emerald-600"></span>?
                    </p>
                    <input type="hidden" id="status-id">
                    <input type="hidden" id="status-value">
                    <div class="flex justify-end gap-3">
                        <button id="btnCancelStatus" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</button>
                        <button id="btnConfirmStatus" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg">
                            <i class="fas fa-check mr-1"></i>Konfirmasi
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Modal Success with Print Option -->
            <div id="modalSuccessPesanan" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md mx-4 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-emerald-100">
                        <i class="fas fa-check-circle text-emerald-500 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Pesanan Berhasil Disimpan!</h3>
                    <p class="text-gray-600 mb-2">Nomor Pesanan:</p>
                    <p id="success-nomor-pesanan" class="text-2xl font-bold text-emerald-600 mb-6">#-</p>
                    <input type="hidden" id="success-id-pesanan">
                    <div class="flex flex-col gap-3">
                        <button id="btnCetakNota" class="w-full px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-medium flex items-center justify-center gap-2 transition-all">
                            <i class="fas fa-print"></i>
                            <span>Cetak Nota</span>
                        </button>
                        <button id="btnCloseSuccess" class="w-full px-5 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium transition-all">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>

     

    
    <script>
        // Helper to format Date to YYYY-MM-DD in local time
        const formatLocalDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };

        // Provide lists for JS (populated from controller)
        const pelangganList = <?php echo json_encode($pelanggan_list ?? []); ?>;
        const layananList = <?php echo json_encode($layanan_list ?? []); ?>;
        const karyawanList = <?php echo json_encode($karyawan_list ?? []); ?>;
        const pesananData = <?php echo json_encode($pesanan ?? []); ?>;

        // Function to generate dynamic charts from pesananData
        function generateDynamicCharts() {
            // 1. Visualisasi Pesanan per Cabang - Bar Chart
            const branchMap = {};
            pesananData.forEach(p => {
                const cabang = p.nama_cabang || 'Unknown';
                branchMap[cabang] = (branchMap[cabang] || 0) + 1;
            });

            const branchLabels = Object.keys(branchMap);
            const branchData = Object.values(branchMap);

            // Generate different colors for each branch
            const branchColors = [
                '#10b981', // emerald-500
                '#3b82f6', // blue-500
                '#f59e0b', // amber-500
                '#ef4444', // red-500
                '#8b5cf6', // purple-500
                '#ec4899', // pink-500
                '#14b8a6', // teal-500
                '#f97316', // orange-500
            ];

            const branchCtx = document.getElementById('branchChart').getContext('2d');
            new Chart(branchCtx, {
                type: 'bar',
                data: {
                    labels: branchLabels.length > 0 ? branchLabels : ['Tidak ada data'],
                    datasets: [{
                        label: 'Jumlah Pesanan',
                        data: branchData.length > 0 ? branchData : [0],
                        backgroundColor: branchData.length > 0 ?
                            branchData.map((_, index) => branchColors[index % branchColors.length]) : ['#cccccc'],
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
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

            // Harmonious gradient colors - emerald to teal theme
            const serviceColors = [
                '#10b981', // emerald-500
                '#14b8a6', // teal-500
                '#34d399', // emerald-400
                '#2dd4bf', // teal-400
                '#6ee7b7', // emerald-300
                '#5eead4', // teal-300
            ];

            const serviceTypeChartEl = document.getElementById('serviceTypeChart');
            if (serviceTypeChartEl) {
                const serviceTypeCtx = serviceTypeChartEl.getContext('2d');
                new Chart(serviceTypeCtx, {
                    type: 'pie',
                    data: {
                        labels: layananLabels.length > 0 ? layananLabels : ['Tidak ada data'],
                        datasets: [{
                            data: layananData.length > 0 ? layananData : [0],
                            backgroundColor: layananData.length > 0 ?
                                layananData.map((_, index) => serviceColors[index % serviceColors.length]) : ['#cccccc'],
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 11
                                    },
                                    padding: 10,
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        if (data.labels.length && data.datasets.length) {
                                            const dataset = data.datasets[0];
                                            const total = dataset.data.reduce((a, b) => a + b, 0);
                                            return data.labels.map((label, i) => {
                                                const value = dataset.data[i];
                                                const percentage = ((value / total) * 100).toFixed(1);
                                                return {
                                                    text: `${label} (${percentage}%)`,
                                                    fillStyle: dataset.backgroundColor[i],
                                                    hidden: false,
                                                    index: i
                                                };
                                            });
                                        }
                                        return [];
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.parsed;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = ((value / total) * 100).toFixed(1);
                                        return `${label}: ${value} pesanan (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // 3. Tren Pesanan 7 Hari - Line Chart
            const today = new Date();
            const last7Days = {};
            for (let i = 6; i >= 0; i--) {
                const d = new Date(today);
                d.setDate(d.getDate() - i);
                const dateStr = formatLocalDate(d);
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
                    maintainAspectRatio: false,
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
            const todayDate = formatLocalDate(new Date());

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
                let today = 0,
                    selesai = 0,
                    proses = 0,
                    tunggu = 0,
                    batal = 0;
                const todayDate = formatLocalDate(new Date());
                const searchTerm = (searchInput?.value || '').toLowerCase();
                const cabangValue = cabangFilter?.value || '';

                rows.forEach(row => {
                    const status = row.dataset.status || '';
                    const text = row.textContent.toLowerCase();
                    const rowCabang = row.dataset.cabang || '';
                    const tglMasukCell = row.querySelector('td:nth-child(2)');
                    const matchSearch = !searchTerm || text.includes(searchTerm);
                    const matchCabang = !cabangValue || rowCabang === cabangValue;

                    // Pesanan hari ini tidak ikut berubah saat filter status dipilih.
                    if (matchSearch && matchCabang && tglMasukCell) {
                        const parts = tglMasukCell.textContent.trim().split('/');
                        if (parts.length === 3) {
                            const rowDate = `${parts[2]}-${parts[1].padStart(2,'0')}-${parts[0].padStart(2,'0')}`;
                            if (rowDate === todayDate) today++;
                        }
                    }

                    if (row.style.display === 'none') return; // Skip hidden rows for status cards

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
    
        const BASE_URL = '<?= site_url("pemilik/pesanan/") ?>';

// ============ MODAL EDIT PESANAN ============
        (function() {
            const modal = document.getElementById('modalEditPesanan');
            const btnClose = document.getElementById('btnCloseEditModal');
            const btnBatal = document.getElementById('btnBatalEditModal');
            const form = document.getElementById('formEditPesanan');

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                form.reset();
                document.getElementById('editDetailItemsContainer').innerHTML = '';
            }

            btnClose.addEventListener('click', closeModal);
            btnBatal.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

            // Render detail items for edit
            function renderEditDetailItems(details, status) {
                const container = document.getElementById('editDetailItemsContainer');
                
                if (!details || details.length === 0) {
                    container.innerHTML = `
                        <div class="text-center py-8 text-gray-400">
                            <i class="fas fa-shoe-prints text-4xl mb-3 opacity-50"></i>
                            <p class="text-sm">Tidak ada detail sepatu</p>
                        </div>`;
                    return;
                }
                
                const showFotoSesudah = ['selesai', 'siap_diambil', 'sudah_diambil'].includes(status);
                
                let html = '';
                details.forEach((d, index) => {
                    const i = index + 1;
                    html += `
                        <div class="bg-white rounded-xl p-5 border border-gray-200 hover:shadow-md transition-all" data-detail-id="${d.id_detail}">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">${i}</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">${d.jenis_sepatu || 'Sepatu ' + i}</h4>
                                        <p class="text-xs text-gray-500">${d.warna || 'Warna tidak diketahui'}</p>
                                    </div>
                                </div>
                                ${d.foto_sebelum || d.foto_sesudah ? `<span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full"><i class="fas fa-image mr-1"></i>Foto tersedia</span>` : ''}
                            </div>
                            <input type="hidden" name="detail_id_${i}" value="${d.id_detail}">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-tag text-gray-400 mr-1"></i>Jenis Sepatu
                                    </label>
                                    <input type="text" name="edit_detail[${i}][jenis_sepatu]" value="${d.jenis_sepatu || ''}"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-palette text-gray-400 mr-1"></i>Warna
                                    </label>
                                    <input type="text" name="edit_detail[${i}][warna]" value="${d.warna || ''}"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-clipboard-list text-gray-400 mr-1"></i>Kondisi Awal
                                    </label>
                                    <input type="text" name="edit_detail[${i}][kondisi_awal]" value="${d.kondisi_awal || ''}"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                                        <i class="fas fa-sticky-note text-gray-400 mr-1"></i>Catatan Khusus
                                    </label>
                                    <input type="text" name="edit_detail[${i}][catatan_khusus]" value="${d.catatan_khusus || ''}"
                                        class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-all">
                                </div>
                            </div>
                            
                            <!-- Foto Section -->
                            <div class="pt-4 border-t border-gray-100">
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Foto Sebelum -->
                                    <div class="text-center">
                                        <label class="block text-xs font-medium text-gray-500 mb-2">
                                            <i class="fas fa-camera text-orange-400 mr-1"></i>Foto Sebelum
                                        </label>
                                        ${d.foto_sebelum 
                                            ? `<div class="relative inline-block">
                                                <img src="${BASE_URL}../../${d.foto_sebelum}" class="w-24 h-24 object-cover rounded-xl border-2 border-orange-200 shadow-lg" alt="Sebelum">
                                                <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full">Before</span>
                                               </div>`
                                            : `<div class="w-24 h-24 mx-auto bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                                                <i class="fas fa-image text-gray-300 text-2xl"></i>
                                               </div>`
                                        }
                                    </div>
                                    
                                    <!-- Foto Sesudah -->
                                    <div class="text-center">
                                        <label class="block text-xs font-medium text-gray-500 mb-2">
                                            <i class="fas fa-camera-retro text-green-500 mr-1"></i>Foto Sesudah
                                        </label>
                                        ${d.foto_sesudah 
                                            ? `<div class="relative inline-block">
                                                <img src="${BASE_URL}../../${d.foto_sesudah}" class="w-24 h-24 object-cover rounded-xl border-2 border-green-200 shadow-lg" alt="Sesudah">
                                                <span class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-2 py-0.5 rounded-full">After</span>
                                               </div>`
                                            : showFotoSesudah 
                                                ? `<div class="flex items-center justify-center gap-2">
                                                    <div class="flex flex-col gap-2">
                                                        <label class="w-20 h-8 bg-emerald-50 rounded-lg flex items-center justify-center border-2 border-dashed border-teal-400 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all">
                                                            <span class="text-xs text-emerald-600"><i class="fas fa-upload mr-1"></i> File</span>
                                                            <input type="file" id="edit_input_sesudah_${i}" name="foto_sesudah_${i}" accept="image/*" 
                                                                onchange="previewImage(this, 'edit_preview_sesudah_${i}')" class="hidden">
                                                        </label>
                                                        <button type="button" onclick="openKamera('edit_input_sesudah_${i}', 'edit_preview_sesudah_${i}')" class="w-20 h-8 bg-blue-50 rounded-lg flex items-center justify-center border-2 border-dashed border-blue-400 cursor-pointer hover:border-blue-500 hover:bg-blue-100 transition-all text-blue-600 text-xs">
                                                            <i class="fas fa-camera mr-1"></i> Kam
                                                        </button>
                                                    </div>
                                                    <img id="edit_preview_sesudah_${i}" src="" class="hidden w-20 h-20 object-cover rounded-xl border-2 border-green-500">
                                                   </div>`
                                                : `<div class="w-24 h-24 mx-auto bg-gray-50 rounded-xl flex flex-col items-center justify-center border border-gray-200">
                                                    <i class="fas fa-lock text-gray-300 text-lg mb-1"></i>
                                                    <span class="text-xs text-gray-400">Setelah selesai</span>
                                                   </div>`
                                        }
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                container.innerHTML = html;
            }



            // Attach click handlers to edit buttons
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', async function() {
                    const id = this.dataset.id;
                    try {
                        const res = await fetch(BASE_URL + 'get/' + id);
                        const json = await res.json();
                        
                        if (json.status === 'success' && json.data) {
                            const p = json.data;
                            document.getElementById('edit-id_pesanan').value = p.id_pesanan;
                            document.getElementById('edit-status_pesanan').value = p.status_pesanan || '';
                            document.getElementById('edit-id_layanan').value = p.id_layanan || '';
                            document.getElementById('edit-jumlah_item').value = p.jumlah_item || 1;
                            document.getElementById('edit-total_harga').value = p.total_harga || 0;
                            document.getElementById('edit-catatan').value = p.catatan || '';
                            
                            if (p.tgl_estimasi_selesai && p.tgl_estimasi_selesai !== '0000-00-00 00:00:00' && p.tgl_estimasi_selesai !== '0000-00-00') {
                                const dt = new Date(p.tgl_estimasi_selesai);
                                if (!isNaN(dt.getTime())) {
                                    dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
                                    document.getElementById('edit-tgl_estimasi_selesai').value = dt.toISOString().slice(0, 16);
                                }
                            }
                            
                            // Load and render detail items
                            renderEditDetailItems(json.detail_items || [], p.status_pesanan);
                            
                            openModal();
                        }
                    } catch (err) {
                        showNotification('Gagal memuat data: ' + err.message, 'error');
                    }
                });
            });

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Use FormData for file upload
                const formData = new FormData();
                formData.append('id_pesanan', form.id_pesanan.value);
                formData.append('status_pesanan', form.status_pesanan.value);
                formData.append('id_layanan', form.id_layanan.value);
                formData.append('jumlah_item', form.jumlah_item.value);
                formData.append('total_harga', form.total_harga.value);
                formData.append('tgl_estimasi_selesai', form.tgl_estimasi_selesai.value);
                formData.append('catatan', form.catatan.value);
                
                // Collect detail items data
                const detailContainer = document.getElementById('editDetailItemsContainer');
                const detailItems = detailContainer.querySelectorAll('[data-detail-id]');
                const details = [];
                
                detailItems.forEach((item, index) => {
                    const i = index + 1;
                    const detailId = item.dataset.detailId;
                    
                    details.push({
                        id_detail: detailId,
                        jenis_sepatu: item.querySelector(`[name="edit_detail[${i}][jenis_sepatu]"]`)?.value || '',
                        warna: item.querySelector(`[name="edit_detail[${i}][warna]"]`)?.value || '',
                        kondisi_awal: item.querySelector(`[name="edit_detail[${i}][kondisi_awal]"]`)?.value || '',
                        catatan_khusus: item.querySelector(`[name="edit_detail[${i}][catatan_khusus]"]`)?.value || ''
                    });
                    
                    // Append foto sesudah if exists
                    const fotoInput = item.querySelector(`[name="foto_sesudah_${i}"]`);
                    if (fotoInput && fotoInput.files[0]) {
                        formData.append(`foto_sesudah_${i}`, fotoInput.files[0]);
                        formData.append(`detail_id_${i}`, detailId);
                    }
                });
                
                formData.append('detail_items', JSON.stringify(details));

                try {
                    const res = await fetch(BASE_URL + 'update', {
                        method: 'POST',
                        body: formData
                    });
                    const json = await res.json();
                    
                    if (json.status === 'success') {
                        showNotification(json.message);
                        closeModal();
                        setTimeout(() => location.reload(), 500);
                    } else {
                        showNotification(json.message, 'error');
                    }
                } catch (err) {
                    showNotification('Gagal menyimpan: ' + err.message, 'error');
                }
            });
        })();

        // ============ MODAL DELETE ============
        (function() {
            const modal = document.getElementById('modalDeletePesanan');
            const btnCancel = document.getElementById('btnCancelDelete');
            const btnConfirm = document.getElementById('btnConfirmDelete');

            function openModal(id, nomor) {
                document.getElementById('delete-id').value = id;
                document.getElementById('delete-nomor').textContent = nomor;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            btnCancel.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    openModal(this.dataset.id, this.dataset.nomor);
                });
            });

            btnConfirm.addEventListener('click', async function() {
                const id = document.getElementById('delete-id').value;
                
                try {
                    const res = await fetch(BASE_URL + 'delete', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_pesanan: id })
                    });
                    const json = await res.json();
                    
                    if (json.status === 'success') {
                        showNotification(json.message);
                        closeModal();
                        setTimeout(() => location.reload(), 500);
                    } else {
                        showNotification(json.message, 'error');
                    }
                } catch (err) {
                    showNotification('Gagal menghapus: ' + err.message, 'error');
                }
            });
        })();


        // ============ QUICK STATUS CHANGE ============
        (function() {
            const modal = document.getElementById('modalStatusPesanan');
            const btnCancel = document.getElementById('btnCancelStatus');
            const btnConfirm = document.getElementById('btnConfirmStatus');
            
            const statusLabels = {
                'dalam_proses': 'Dalam Proses',
                'selesai': 'Selesai',
                'siap_diambil': 'Siap Diambil',
                'sudah_diambil': 'Sudah Diambil'
            };
            
            const statusColors = {
                'dalam_proses': { bg: 'bg-yellow-100', text: 'text-yellow-600' },
                'selesai': { bg: 'bg-emerald-100', text: 'text-emerald-600' },
                'siap_diambil': { bg: 'bg-green-100', text: 'text-green-600' },
                'sudah_diambil': { bg: 'bg-emerald-100', text: 'text-emerald-600' }
            };

            function openModal(id, status) {
                document.getElementById('status-id').value = id;
                document.getElementById('status-value').value = status;
                document.getElementById('status-label').textContent = statusLabels[status] || status;
                
                // Update icon color
                const iconDiv = document.getElementById('status-icon');
                const colors = statusColors[status] || { bg: 'bg-emerald-100', text: 'text-emerald-600' };
                iconDiv.className = `w-12 h-12 flex items-center justify-center rounded-full ${colors.bg}`;
                iconDiv.querySelector('i').className = `fas fa-sync-alt ${colors.text} text-2xl`;
                
                // Update label color
                document.getElementById('status-label').className = `font-semibold ${colors.text}`;
                
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            btnCancel.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

            // Attach click handlers to quick status buttons
            document.querySelectorAll('.btn-quick-status').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const newStatus = this.dataset.status;
                    openModal(id, newStatus);
                });
            });

            // Confirm status change
            btnConfirm.addEventListener('click', async function() {
                const id = document.getElementById('status-id').value;
                const newStatus = document.getElementById('status-value').value;
                
                try {
                    const res = await fetch(BASE_URL + 'quick_status', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_pesanan: id, status_pesanan: newStatus })
                    });
                    const json = await res.json();
                    
                    if (json.status === 'success') {
                        showNotification(json.message);
                        closeModal();
                        setTimeout(() => location.reload(), 500);
                    } else {
                        showNotification(json.message, 'error');
                    }
                } catch (err) {
                    showNotification('Gagal mengubah status: ' + err.message, 'error');
                }
            });
        })();

        // ============ QUICK UPLOAD FOTO ============
        (function() {
            document.querySelectorAll('.btn-upload-foto').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    // Open edit modal which has foto upload
                    document.querySelector(`.btn-edit[data-id="${id}"]`).click();
                });
            });
        })();

        // ============ PAYMENT TOGGLE HANDLER ============
        (function() {
            const toggle = document.getElementById('add-sudah_bayar');
            const hiddenInput = document.getElementById('add-status_pembayaran');
            const label = document.getElementById('sudah-bayar-label');
            
            if (toggle) {
                toggle.addEventListener('change', function() {
                    if (this.checked) {
                        hiddenInput.value = 'sudah_bayar';
                        label.textContent = 'Sudah Dibayar';
                        label.classList.remove('text-gray-700');
                        label.classList.add('text-green-600');
                    } else {
                        hiddenInput.value = 'belum_bayar';
                        label.textContent = 'Belum Dibayar';
                        label.classList.remove('text-green-600');
                        label.classList.add('text-gray-700');
                    }
                });
            }
        })();

        // ============ CONFIRM PAYMENT HANDLER ============
        (function() {
            document.querySelectorAll('.btn-confirm-payment').forEach(btn => {
                btn.addEventListener('click', async function() {
                    const id = this.dataset.id;
                    const nomor = this.dataset.nomor;
                    const total = this.dataset.total;
                    const currentMetode = this.dataset.metode;
                    
                    // Create confirmation modal
                    const modalHtml = `
                        <div id="modalConfirmPayment" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
                                <div class="bg-white border-b p-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-gray-800">Konfirmasi Pembayaran</h2>
                                            <p class="text-gray-500 text-sm">Pesanan ${nomor}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <p class="text-gray-600 mb-2">Total Pembayaran:</p>
                                        <p class="text-3xl font-bold text-green-600">Rp ${Number(total).toLocaleString('id-ID')}</p>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-600 mb-2">
                                            <i class="fas fa-wallet text-blue-500 mr-1"></i>Metode Pembayaran
                                        </label>
                                        <select id="confirm-metode-pembayaran" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
                                            <option value="tunai" ${currentMetode === 'tunai' ? 'selected' : ''}>Tunai</option>
                                            <option value="debit" ${currentMetode === 'debit' ? 'selected' : ''}>Debit/Transfer</option>
                                            <option value="qris" ${currentMetode === 'qris' ? 'selected' : ''}>QRIS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="p-4 border-t bg-gray-50 flex justify-end gap-3">
                                    <button type="button" id="btnCancelPayment" class="px-4 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 font-medium">
                                        Batal
                                    </button>
                                    <button type="button" id="btnConfirmPayment" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium flex items-center gap-2">
                                        <i class="fas fa-check"></i>Konfirmasi Bayar
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    document.body.insertAdjacentHTML('beforeend', modalHtml);
                    const modal = document.getElementById('modalConfirmPayment');
                    
                    // Cancel button
                    document.getElementById('btnCancelPayment').addEventListener('click', () => {
                        modal.remove();
                    });
                    
                    // Close on overlay click
                    modal.addEventListener('click', (e) => {
                        if (e.target === modal) modal.remove();
                    });
                    
                    // Confirm button
                    document.getElementById('btnConfirmPayment').addEventListener('click', async () => {
                        const metode = document.getElementById('confirm-metode-pembayaran').value;
                        
                        try {
                            const res = await fetch(BASE_URL + 'confirm_payment', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ 
                                    id_pesanan: id, 
                                    metode_pembayaran: metode 
                                })
                            });
                            const json = await res.json();
                            
                            if (json.status === 'success') {
                                showNotification(json.message);
                                modal.remove();
                                setTimeout(() => location.reload(), 500);
                            } else {
                                showNotification(json.message, 'error');
                            }
                        } catch (err) {
                            showNotification('Gagal mengkonfirmasi pembayaran: ' + err.message, 'error');
                        }
                    });
                });
            });
        })();
    </script>

    <!-- Modal Kamera -->
    <div id="modalKamera" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-[60]">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden flex flex-col">
            <div class="bg-gray-800 p-4 flex items-center justify-between">
                <h3 class="text-white font-semibold">Ambil Foto</h3>
                <button id="btnCloseKamera" class="text-gray-400 hover:text-white text-xl">&times;</button>
            </div>
            <div class="relative bg-black flex-1 min-h-[300px] flex items-center justify-center">
                <video id="kameraVideo" class="w-full h-auto max-h-[60vh] object-cover" autoplay playsinline></video>
            </div>
            <div class="p-4 bg-gray-100 flex justify-center gap-4">
                <button id="btnAmbilFoto" class="w-16 h-16 rounded-full bg-white border-4 border-gray-300 shadow-md flex items-center justify-center hover:bg-gray-200 transition-all">
                    <div class="w-12 h-12 rounded-full bg-emerald-500"></div>
                </button>
            </div>
            <canvas id="kameraCanvas" class="hidden"></canvas>
        </div>
    </div>

    <script>
        let currentKameraTarget = null;
        let currentPreviewTarget = null;
        let kameraStream = null;

        async function openKamera(inputId, previewId) {
            currentKameraTarget = document.getElementById(inputId);
            currentPreviewTarget = document.getElementById(previewId);
            
            const modalKamera = document.getElementById('modalKamera');
            const video = document.getElementById('kameraVideo');
            
            modalKamera.classList.remove('hidden');
            modalKamera.classList.add('flex');
            
            try {
                kameraStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
                video.srcObject = kameraStream;
            } catch (err) {
                alert("Tidak dapat mengakses kamera: " + err.message);
                closeKamera();
            }
        }

        function closeKamera() {
            if (kameraStream) {
                kameraStream.getTracks().forEach(track => track.stop());
                kameraStream = null;
            }
            document.getElementById('modalKamera').classList.add('hidden');
            document.getElementById('modalKamera').classList.remove('flex');
        }

        document.getElementById('btnCloseKamera')?.addEventListener('click', closeKamera);

        document.getElementById('btnAmbilFoto')?.addEventListener('click', () => {
            const video = document.getElementById('kameraVideo');
            const canvas = document.getElementById('kameraCanvas');
            
            if (video.videoWidth) {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                
                canvas.toBlob((blob) => {
                    const file = new File([blob], "kamera_" + Date.now() + ".jpg", { type: "image/jpeg" });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    
                    if (currentKameraTarget) {
                        currentKameraTarget.files = dataTransfer.files;
                    }
                    if (currentPreviewTarget) {
                        currentPreviewTarget.src = URL.createObjectURL(blob);
                        currentPreviewTarget.classList.remove('hidden');
                    }
                    closeKamera();
                }, 'image/jpeg', 0.8);
            }
        });
    </script>