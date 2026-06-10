<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - KixEra</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .sidebar { position: fixed; left: 0; top: 0; }
        .gradient-emerald { background-color: #10b981; }
        .gradient-red { background-color: #b91c1c; }
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?php $this->load->view('template/sidebarkaryawan'); ?>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64 p-4 lg:p-6 pt-20 lg:pt-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div>
                        <nav class="text-sm text-gray-500 mb-2">
                            <a href="<?= site_url('karyawan/pesanan') ?>" class="hover:text-emerald-600">Pesanan</a>
                            <span class="mx-2">/</span>
                            <span class="text-gray-800">Detail</span>
                        </nav>
                        <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan</h1>
                        <p class="text-gray-500">No. <?= htmlspecialchars($pesanan->nomor_pesanan) ?></p>
                    </div>
                    <a href="<?= site_url('karyawan/pesanan') ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content - 2/3 -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Informasi Pesanan -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b">
                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-info-circle text-emerald-600"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">Informasi Pesanan</h2>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Pelanggan</p>
                                <p class="font-medium text-gray-800"><?= htmlspecialchars($pesanan->nama_pelanggan ?? '-') ?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Cabang</p>
                                <p class="font-medium text-gray-800"><?= htmlspecialchars($pesanan->nama_cabang ?? '-') ?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Layanan</p>
                                <p class="font-medium text-gray-800"><?= htmlspecialchars($pesanan->nama_layanan ?? '-') ?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Karyawan</p>
                                <p class="font-medium text-gray-800"><?= htmlspecialchars($pesanan->nama_karyawan ?? '-') ?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Jumlah Item</p>
                                <p class="font-medium text-gray-800"><?= htmlspecialchars($pesanan->jumlah_item ?? '0') ?> item</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Total Harga</p>
                                <p class="font-semibold text-emerald-600 text-lg">Rp <?= number_format($pesanan->total_harga ?? 0, 0, ',', '.') ?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Status Pembayaran</p>
                                <?php
                                $status_bayar = strtolower($pesanan->status_pembayaran ?? 'belum_bayar');
                                $badge_bayar = 'bg-red-100 text-red-600';
                                $label_bayar = 'Belum Bayar';
                                $icon_bayar = 'fa-clock';
                                
                                if ($status_bayar === 'sudah_bayar') {
                                    $badge_bayar = 'bg-emerald-100 text-emerald-600';
                                    $label_bayar = 'Sudah Bayar';
                                    $icon_bayar = 'fa-check-circle';
                                }
                                ?>
                                <span class="<?= $badge_bayar ?> px-3 py-1.5 rounded-full text-sm font-medium inline-flex items-center gap-1.5">
                                    <i class="fas <?= $icon_bayar ?> text-xs"></i>
                                    <?= $label_bayar ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal & Status -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-blue-600"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">Tanggal & Status</h2>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Tanggal Masuk</p>
                                <p class="font-medium text-gray-800"><?= date('d/m/Y H:i', strtotime($pesanan->tgl_masuk)) ?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Estimasi Selesai</p>
                                <p class="font-medium text-gray-800"><?= $pesanan->tgl_estimasi_selesai ? date('d/m/Y', strtotime($pesanan->tgl_estimasi_selesai)) : '-' ?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Tanggal Selesai</p>
                                <p class="font-medium text-gray-800"><?= $pesanan->tgl_selesai ? date('d/m/Y H:i', strtotime($pesanan->tgl_selesai)) : '-' ?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Tanggal Diambil</p>
                                <p class="font-medium text-gray-800"><?= $pesanan->tgl_diambil ? date('d/m/Y H:i', strtotime($pesanan->tgl_diambil)) : '-' ?></p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm text-gray-500 mb-1">Status</p>
                                <?php
                                $status = strtolower($pesanan->status_pesanan ?? '');
                                $badge = 'bg-gray-100 text-gray-700';
                                $status_label = ucfirst(str_replace('_', ' ', $status));
                                
                                if ($status === 'sudah_diambil') {
                                    $badge = 'bg-emerald-100 text-emerald-600';
                                } elseif ($status === 'siap_diambil') {
                                    $badge = 'bg-green-100 text-green-600';
                                } elseif ($status === 'selesai') {
                                    $badge = 'bg-emerald-100 text-emerald-600';
                                } elseif ($status === 'dalam_proses') {
                                    $badge = 'bg-yellow-100 text-yellow-600';
                                } elseif ($status === 'diterima') {
                                    $badge = 'bg-blue-100 text-blue-600';
                                } elseif ($status === 'dibatalkan') {
                                    $badge = 'bg-red-100 text-red-600';
                                }
                                ?>
                                <span class="<?= $badge ?> px-4 py-1.5 rounded-full text-sm font-medium"><?= $status_label ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center gap-3 mb-4 pb-4 border-b">
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-sticky-note text-orange-600"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">Catatan</h2>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 min-h-[80px]">
                            <p class="text-gray-700 whitespace-pre-wrap"><?= htmlspecialchars($pesanan->catatan ?? 'Tidak ada catatan') ?></p>
                        </div>
                    </div>

                    <!-- Detail Item Pesanan -->
                    <?php if (!empty($detail_items)): ?>
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shoe-prints text-purple-600"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800">Detail Sepatu</h2>
                            <span class="ml-auto text-sm text-gray-500"><?= count($detail_items) ?> item</span>
                        </div>

                        <div class="space-y-4">
                            <?php foreach ($detail_items as $idx => $item): ?>
                            <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center">
                                        <span class="text-white font-bold"><?= $idx + 1 ?></span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800"><?= htmlspecialchars($item->jenis_sepatu ?? 'Sepatu ' . ($idx + 1)) ?></h4>
                                        <p class="text-sm text-gray-500"><?= htmlspecialchars($item->warna ?? '-') ?></p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Kondisi Awal</p>
                                        <p class="text-sm text-gray-800"><?= htmlspecialchars($item->kondisi_awal ?? '-') ?></p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Catatan Khusus</p>
                                        <p class="text-sm text-gray-800"><?= htmlspecialchars($item->catatan_khusus ?? '-') ?></p>
                                    </div>
                                </div>


                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar - 1/3 -->
                <div class="space-y-6">
                    <!-- Dokumentasi Foto (Moved here) -->
                    <?php 
                    $has_photos = false;
                    foreach ($detail_items as $item) {
                        if ($item->foto_sebelum || $item->foto_sesudah) {
                            $has_photos = true;
                            break;
                        }
                    }
                    ?>
                    <?php if ($has_photos): ?>
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center gap-3 mb-4 pb-4 border-b">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-images text-indigo-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Dokumentasi</h3>
                        </div>
                        <div class="space-y-6">
                            <?php foreach ($detail_items as $idx => $item): ?>
                                <?php if ($item->foto_sebelum || $item->foto_sesudah): ?>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                                            <span class="w-5 h-5 bg-gray-100 rounded-full flex items-center justify-center text-xs text-gray-600"><?= $idx + 1 ?></span>
                                            <?= htmlspecialchars($item->jenis_sepatu ?? 'Sepatu ' . ($idx + 1)) ?>
                                        </h4>
                                        <div class="grid grid-cols-2 gap-3">
                                            <!-- Sebelum -->
                                            <div class="relative group">
                                                <?php if ($item->foto_sebelum): ?>
                                                    <a href="<?= base_url($item->foto_sebelum) ?>" target="_blank" class="block">
                                                        <img src="<?= base_url($item->foto_sebelum) ?>" class="w-full h-24 object-cover rounded-lg border border-gray-200 hover:border-orange-400 transition">
                                                        <span class="absolute bottom-1 right-1 px-1.5 py-0.5 bg-black/60 text-white text-[10px] rounded backdrop-blur-sm">Sebelum</span>
                                                    </a>
                                                <?php else: ?>
                                                    <div class="w-full h-24 bg-gray-50 rounded-lg border border-dashed border-gray-300 flex items-center justify-center text-gray-300">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <!-- Sesudah -->
                                            <div class="relative group">
                                                <?php if ($item->foto_sesudah): ?>
                                                    <a href="<?= base_url($item->foto_sesudah) ?>" target="_blank" class="block">
                                                        <img src="<?= base_url($item->foto_sesudah) ?>" class="w-full h-24 object-cover rounded-lg border border-gray-200 hover:border-green-400 transition">
                                                        <span class="absolute bottom-1 right-1 px-1.5 py-0.5 bg-black/60 text-white text-[10px] rounded backdrop-blur-sm">Sesudah</span>
                                                    </a>
                                                <?php else: ?>
                                                    <div class="w-full h-24 bg-gray-50 rounded-lg border border-dashed border-gray-300 flex items-center justify-center text-gray-300">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Quick Info -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Singkat</h3>

                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Nomor Pesanan</p>
                                <p class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($pesanan->nomor_pesanan) ?></p>
                            </div>

                            <div class="border-t pt-4">
                                <p class="text-sm text-gray-500">Waktu Dibuat</p>
                                <p class="text-sm text-gray-800"><?= $pesanan->created_at ? date('d/m/Y H:i', strtotime($pesanan->created_at)) : '-' ?></p>
                            </div>

                            <div class="border-t pt-4">
                                <p class="text-sm text-gray-500">Terakhir Diperbarui</p>
                                <p class="text-sm text-gray-800"><?= $pesanan->updated_at ? date('d/m/Y H:i', strtotime($pesanan->updated_at)) : 'Belum diperbarui' ?></p>
                            </div>

                            <div class="border-t pt-4">
                                <p class="text-sm text-gray-500">Total Harga</p>
                                <p class="text-2xl font-bold text-emerald-600">Rp <?= number_format($pesanan->total_harga ?? 0, 0, ',', '.') ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Progres -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center gap-2 mb-6">
                            <i class="fas fa-history text-emerald-600"></i>
                            <h3 class="text-lg font-semibold text-gray-800">Timeline Progres</h3>
                        </div>
                        
                        <?php if (!empty($progres_list)): ?>
                            <?php 
                            // Reverse the list to show newest first
                            $reversed_progres = array_reverse($progres_list);
                            ?>
                            <div class="relative">
                                <?php foreach ($reversed_progres as $idx => $progres): ?>
                                    <?php
                                    $status = strtolower($progres->status);
                                    $is_first = ($idx === 0);
                                    $is_last = ($idx === count($reversed_progres) - 1);
                                    
                                    // Determine icon based on status
                                    $icon = 'fa-circle-dot';
                                    $icon_color = 'text-gray-400';
                                    if ($status === 'diterima') {
                                        $icon = 'fa-calendar-check';
                                        $icon_color = 'text-blue-500';
                                    } elseif ($status === 'dalam_proses') {
                                        $icon = 'fa-gear';
                                        $icon_color = 'text-yellow-500';
                                    } elseif ($status === 'selesai') {
                                        $icon = 'fa-check-double';
                                        $icon_color = 'text-emerald-500';
                                    } elseif ($status === 'siap_diambil') {
                                        $icon = 'fa-box-open';
                                        $icon_color = 'text-green-500';
                                    } elseif ($status === 'sudah_diambil') {
                                        $icon = 'fa-handshake';
                                        $icon_color = 'text-emerald-500';
                                    } elseif ($status === 'dibatalkan') {
                                        $icon = 'fa-ban';
                                        $icon_color = 'text-red-500';
                                    }
                                    
                                    $status_label = ucfirst(str_replace('_', ' ', $status));
                                    $dot_color = $is_first ? 'bg-emerald-500' : 'bg-gray-300';
                                    $text_color = $is_first ? 'text-emerald-600 font-semibold' : 'text-gray-700';
                                    ?>
                                    <div class="flex gap-4 <?= !$is_last ? 'pb-6' : '' ?>">
                                        <!-- Timeline dot and line -->
                                        <div class="flex flex-col items-center">
                                            <div class="w-3 h-3 rounded-full <?= $dot_color ?> flex-shrink-0"></div>
                                            <?php if (!$is_last): ?>
                                                <div class="w-0.5 flex-1 bg-gray-200 mt-1"></div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Content -->
                                        <div class="flex-1 -mt-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <i class="fas <?= $icon ?> <?= $icon_color ?> text-sm"></i>
                                                <span class="<?= $text_color ?>"><?= $status_label ?></span>
                                            </div>
                                            <p class="text-xs text-gray-500 mb-1">
                                                <?= date('d M Y H:i', strtotime($progres->tgl_update)) ?>
                                            </p>
                                            <?php if (!empty($progres->deskripsi)): ?>
                                                <p class="text-sm text-gray-600"><?= htmlspecialchars($progres->deskripsi) ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-8 text-gray-400">
                                <i class="fas fa-clock text-4xl mb-3 opacity-50"></i>
                                <p class="text-sm">Belum ada progres</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>

                        <div class="space-y-3">
                            <a href="<?= site_url('karyawan/pesanan') ?>" class="block w-full px-4 py-2.5 bg-emerald-600 text-white text-center rounded-lg hover:bg-emerald-700 transition">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
