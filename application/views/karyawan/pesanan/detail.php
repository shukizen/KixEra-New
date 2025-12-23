<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .sidebar { position: fixed; left: 0; top: 0; }
        .gradient-emerald { background: linear-gradient(to right, #10b981, #34d399); }
        .gradient-red { background: linear-gradient(to right, rgba(185, 28, 28, 0.7), rgba(185, 28, 28, 0.7)); }
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
                            <a href="<?= site_url('karyawan/pesanan') ?>" class="hover:text-teal-600">Pesanan</a>
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
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b">
                            <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-info-circle text-teal-600"></i>
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
                                <p class="font-semibold text-teal-600 text-lg">Rp <?= number_format($pesanan->total_harga ?? 0, 0, ',', '.') ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal & Status -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
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
                                    $badge = 'bg-teal-100 text-teal-600';
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
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
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
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
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
                                    <div class="w-10 h-10 bg-teal-600 rounded-xl flex items-center justify-center">
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

                                <?php if ($item->foto_sebelum || $item->foto_sesudah): ?>
                                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-200">
                                    <?php if ($item->foto_sebelum): ?>
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500 mb-2"><i class="fas fa-camera text-orange-400 mr-1"></i>Sebelum</p>
                                        <a href="<?= base_url($item->foto_sebelum) ?>" target="_blank">
                                            <img src="<?= base_url($item->foto_sebelum) ?>" alt="Sebelum" class="w-full max-w-[200px] mx-auto h-40 object-cover rounded-lg border-2 border-orange-200 hover:scale-105 transition-transform cursor-pointer">
                                        </a>
                                    </div>
                                    <?php else: ?>
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500 mb-2"><i class="fas fa-camera text-orange-400 mr-1"></i>Sebelum</p>
                                        <div class="w-40 h-40 mx-auto bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                                            <i class="fas fa-image text-gray-300 text-3xl"></i>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ($item->foto_sesudah): ?>
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500 mb-2"><i class="fas fa-camera-retro text-green-500 mr-1"></i>Sesudah</p>
                                        <a href="<?= base_url($item->foto_sesudah) ?>" target="_blank">
                                            <img src="<?= base_url($item->foto_sesudah) ?>" alt="Sesudah" class="w-full max-w-[200px] mx-auto h-40 object-cover rounded-lg border-2 border-green-200 hover:scale-105 transition-transform cursor-pointer">
                                        </a>
                                    </div>
                                    <?php else: ?>
                                    <div class="text-center">
                                        <p class="text-xs text-gray-500 mb-2"><i class="fas fa-camera-retro text-green-500 mr-1"></i>Sesudah</p>
                                        <div class="w-40 h-40 mx-auto bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                                            <i class="fas fa-image text-gray-300 text-3xl"></i>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar - 1/3 -->
                <div class="space-y-6">
                    <!-- Quick Info -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
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
                                <p class="text-2xl font-bold text-teal-600">Rp <?= number_format($pesanan->total_harga ?? 0, 0, ',', '.') ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Progres -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center gap-2 mb-6">
                            <i class="fas fa-history text-teal-600"></i>
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
                                        $icon_color = 'text-teal-500';
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
                                    $dot_color = $is_first ? 'bg-teal-500' : 'bg-gray-300';
                                    $text_color = $is_first ? 'text-teal-600 font-semibold' : 'text-gray-700';
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
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>

                        <div class="space-y-3">
                            <a href="<?= site_url('karyawan/pesanan') ?>" class="block w-full px-4 py-2.5 bg-teal-600 text-white text-center rounded-lg hover:bg-teal-700 transition">
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
