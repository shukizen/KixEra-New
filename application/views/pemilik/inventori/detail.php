<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Item - KixEra</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64 transition-all duration-300">
            <!-- Header -->
            <header class="bg-white border-b border-gray-100 shadow-sm px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <a href="<?= base_url('pemilik/inventori') ?>" 
                           class="text-gray-500 hover:text-emerald-500 transition">
                            <i class="fas fa-arrow-left text-xl"></i>
                        </a>
                        <h1 class="text-2xl font-semibold text-gray-800">Detail Item</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="<?= base_url('pemilik/inventori') ?>" 
                           class="px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition flex items-center gap-2">
                            <i class="fas fa-list"></i>
                            <span>Kembali ke Daftar</span>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-6">
                <?php if(isset($item) && $item): ?>
                <div class="max-w-4xl mx-auto">
                    <!-- Item Card -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <!-- Card Header -->
                        <div class="bg-emerald-500 px-8 py-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-emerald-100 text-sm font-medium mb-1">Item ID</p>
                                    <h2 class="text-white text-3xl font-bold">#INV<?= str_pad($item->id_inventori, 3, '0', STR_PAD_LEFT) ?></h2>
                                </div>
                                <div>
                                    <?php 
                                        if($item->stok_tersedia == 0) {
                                            echo '<span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">Out Of Stock</span>';
                                        } elseif($item->stok_tersedia <= $item->stok_minimal) {
                                            echo '<span class="bg-yellow-400 text-yellow-900 px-4 py-2 rounded-full text-sm font-semibold shadow-lg">Low Stock</span>';
                                        } else {
                                            echo '<span class="bg-white text-emerald-600 px-4 py-2 rounded-full text-sm font-semibold shadow-lg">Available</span>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-8">
                            <!-- Item Name -->
                            <div class="mb-8 text-center">
                                <h3 class="text-3xl font-bold text-gray-800"><?= htmlspecialchars($item->nama_item) ?></h3>
                                <p class="text-gray-500 mt-2">
                                    <span class="inline-flex items-center gap-2 bg-gray-100 px-4 py-1 rounded-full text-sm">
                                        <i class="fas fa-tag text-emerald-500"></i>
                                        <?= ucfirst(htmlspecialchars($item->jenis_item)) ?>
                                    </span>
                                </p>
                            </div>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                <!-- Stock Available -->
                                <div class="bg-emerald-50 rounded-xl p-6 border border-emerald-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-boxes text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 text-sm">Stok Tersedia</p>
                                            <p class="text-2xl font-bold text-gray-800"><?= $item->stok_tersedia ?> <span class="text-sm font-normal text-gray-500"><?= htmlspecialchars($item->satuan) ?></span></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Minimum Stock -->
                                <div class="bg-yellow-50 rounded-xl p-6 border border-yellow-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 text-sm">Stok Minimal</p>
                                            <p class="text-2xl font-bold text-gray-800"><?= $item->stok_minimal ?> <span class="text-sm font-normal text-gray-500"><?= htmlspecialchars($item->satuan) ?></span></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-money-bill-wave text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 text-sm">Harga Satuan</p>
                                            <p class="text-2xl font-bold text-gray-800">
                                                <?= ($item->harga_satuan !== null && $item->harga_satuan !== '') ? 'Rp ' . number_format((float)$item->harga_satuan, 0, ',', '.') : '-' ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Details Table -->
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                    <i class="fas fa-info-circle text-emerald-500"></i>
                                    Informasi Detail
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex justify-between py-3 border-b border-gray-200">
                                        <span class="text-gray-500">Kategori</span>
                                        <span class="font-medium text-gray-800"><?= ucfirst(htmlspecialchars($item->jenis_item)) ?></span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-200">
                                        <span class="text-gray-500">Satuan</span>
                                        <span class="font-medium text-gray-800"><?= ucfirst(htmlspecialchars($item->satuan)) ?></span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-200">
                                        <span class="text-gray-500">Cabang</span>
                                        <span class="font-medium text-gray-800"><?= isset($item->nama_cabang) ? htmlspecialchars($item->nama_cabang) : '-' ?></span>
                                    </div>
                                    <div class="flex justify-between py-3 border-b border-gray-200">
                                        <span class="text-gray-500">Terakhir Diperbarui</span>
                                        <span class="font-medium text-gray-800">
                                            <?= isset($item->updated_at) && $item->updated_at ? date('d M Y, H:i', strtotime($item->updated_at)) : (isset($item->created_at) ? date('d M Y, H:i', strtotime($item->created_at)) : '-') ?>
                                        </span>
                                    </div>
                                </div>

                                <?php if(isset($item->keterangan) && $item->keterangan): ?>
                                <div class="mt-6">
                                    <p class="text-gray-500 mb-2">Keterangan</p>
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <p class="text-gray-700"><?= nl2br(htmlspecialchars($item->keterangan)) ?></p>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                        <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-exclamation-circle text-red-500 text-4xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Item Tidak Ditemukan</h2>
                        <p class="text-gray-500 mb-6">Item yang Anda cari tidak ditemukan atau Anda tidak memiliki akses.</p>
                        <a href="<?= base_url('pemilik/inventori') ?>" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 transition">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
