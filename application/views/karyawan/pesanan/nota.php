<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pesanan - <?= htmlspecialchars($pesanan->nomor_pesanan) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        @media print {
            body { 
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .no-print { display: none !important; }
            .print-container {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
            }
        }
        
        .nota-border {
            border: 2px dashed #14b8a6;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen py-8">
    
    <!-- Action Buttons -->
    <div class="no-print fixed top-4 right-4 flex gap-2 z-50">
        <button onclick="window.print()" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-2 transition-all">
            <i class="fas fa-print"></i>
            <span>Cetak Nota</span>
        </button>
        <button onclick="window.close()" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-2 transition-all">
            <i class="fas fa-times"></i>
            <span>Tutup</span>
        </button>
    </div>

    <!-- Nota Container -->
    <div class="print-container max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
        
        <!-- Header -->
        <div class="bg-teal-600 text-white p-6 text-center">
            <div class="flex items-center justify-center gap-3 mb-2">
                <i class="fas fa-shoe-prints text-3xl"></i>
                <h1 class="text-2xl font-bold">KixEra</h1>
            </div>
            <p class="text-teal-100 text-sm">Shoe Cleaning & Care</p>
            <?php if ($cabang): ?>
            <p class="text-teal-100 text-xs mt-1"><?= htmlspecialchars($cabang->alamat ?? $cabang->nama_cabang) ?></p>
            <?php endif; ?>
        </div>

        <!-- Nota Content -->
        <div class="p-6">
            
            <!-- Nomor & Tanggal -->
            <div class="nota-border rounded-xl p-4 mb-6 bg-teal-50">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-500">Nomor Pesanan</p>
                        <p class="font-bold text-teal-700 text-lg"><?= htmlspecialchars($pesanan->nomor_pesanan) ?></p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">Tanggal</p>
                        <p class="font-medium text-gray-800"><?= date('d/m/Y', strtotime($pesanan->tgl_masuk)) ?></p>
                        <p class="text-xs text-gray-500"><?= date('H:i', strtotime($pesanan->tgl_masuk)) ?> WIB</p>
                    </div>
                </div>
            </div>

            <!-- Info Pelanggan -->
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-500 mb-3 flex items-center gap-2">
                    <i class="fas fa-user text-teal-500"></i>
                    DATA PELANGGAN
                </h3>
                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="font-semibold text-gray-800"><?= htmlspecialchars($pesanan->nama_pelanggan) ?></p>
                    <?php if (!empty($pesanan->no_telepon)): ?>
                    <p class="text-sm text-gray-600"><?= htmlspecialchars($pesanan->no_telepon) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Detail Layanan -->
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-500 mb-3 flex items-center gap-2">
                    <i class="fas fa-concierge-bell text-teal-500"></i>
                    DETAIL LAYANAN
                </h3>
                <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Layanan</span>
                        <span class="font-medium text-gray-800"><?= htmlspecialchars($pesanan->nama_layanan) ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jumlah Item</span>
                        <span class="font-medium text-gray-800"><?= $pesanan->jumlah_item ?> pasang</span>
                    </div>
                    <?php if ($pesanan->tgl_estimasi_selesai): ?>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Estimasi Selesai</span>
                        <span class="font-medium text-gray-800"><?= date('d/m/Y', strtotime($pesanan->tgl_estimasi_selesai)) ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Detail Sepatu -->
            <?php if (!empty($detail_items)): ?>
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-500 mb-3 flex items-center gap-2">
                    <i class="fas fa-shoe-prints text-teal-500"></i>
                    DETAIL SEPATU (<?= count($detail_items) ?> item)
                </h3>
                <div class="space-y-3">
                    <?php foreach ($detail_items as $idx => $item): ?>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <!-- Header Item -->
                        <div class="flex items-center gap-3 mb-3 pb-2 border-b border-gray-200">
                            <span class="w-7 h-7 bg-teal-600 text-white text-sm font-bold rounded-full flex items-center justify-center"><?= $idx + 1 ?></span>
                            <span class="font-bold text-gray-800 text-base"><?= htmlspecialchars($item->jenis_sepatu ?: 'Sepatu ' . ($idx + 1)) ?></span>
                        </div>
                        <!-- Detail Grid -->
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div class="flex">
                                <span class="text-gray-500 w-16">Warna</span>
                                <span class="text-gray-800 font-medium">: <?= htmlspecialchars($item->warna ?: '-') ?></span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-500 w-16">Kondisi</span>
                                <span class="text-gray-800 font-medium">: <?= htmlspecialchars($item->kondisi_awal ?: '-') ?></span>
                            </div>
                            <?php if (!empty($item->catatan_khusus)): ?>
                            <div class="col-span-2 flex">
                                <span class="text-gray-500 w-16">Catatan</span>
                                <span class="text-gray-800 font-medium">: <?= htmlspecialchars($item->catatan_khusus) ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Catatan -->
            <?php if (!empty($pesanan->catatan)): ?>
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-500 mb-3 flex items-center gap-2">
                    <i class="fas fa-sticky-note text-teal-500"></i>
                    CATATAN
                </h3>
                <div class="bg-yellow-50 rounded-xl p-4 border border-yellow-200">
                    <p class="text-sm text-gray-700"><?= htmlspecialchars($pesanan->catatan) ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Pembayaran -->
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-500 mb-3 flex items-center gap-2">
                    <i class="fas fa-credit-card text-teal-500"></i>
                    PEMBAYARAN
                </h3>
                <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                    <?php if ($pesanan->metode_pembayaran): ?>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Metode</span>
                        <span class="font-medium text-gray-800">
                            <?php 
                            $metode_label = '';
                            switch($pesanan->metode_pembayaran) {
                                case 'tunai': $metode_label = '💵 Tunai'; break;
                                case 'debit': $metode_label = '💳 Debit/Transfer'; break;
                                case 'qris': $metode_label = '📱 QRIS'; break;
                                default: $metode_label = ucfirst($pesanan->metode_pembayaran);
                            }
                            echo $metode_label;
                            ?>
                        </span>
                    </div>
                    <?php endif; ?>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status</span>
                        <?php 
                        $status_bayar = $pesanan->status_pembayaran ?? 'belum_bayar';
                        $badge_class = $status_bayar === 'sudah_bayar' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700';
                        $status_label = $status_bayar === 'sudah_bayar' ? 'LUNAS' : 'BELUM BAYAR';
                        ?>
                        <span class="<?= $badge_class ?> px-2 py-1 rounded-full text-xs font-bold"><?= $status_label ?></span>
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div class="bg-teal-600 rounded-xl p-5 text-white">
                <div class="flex justify-between items-center">
                    <span class="text-teal-100 font-medium">TOTAL BAYAR</span>
                    <span class="text-2xl font-bold">Rp <?= number_format($pesanan->total_harga, 0, ',', '.') ?></span>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="border-t p-6 text-center bg-gray-50">
            <p class="text-sm text-gray-600 mb-2">Terima kasih telah mempercayakan sepatu Anda kepada kami!</p>
            <p class="text-xs text-gray-400">Simpan nota ini sebagai bukti pengambilan</p>
            <div class="mt-4 pt-4 border-t border-dashed border-gray-300">
                <p class="text-xs text-gray-400"><?= date('d/m/Y H:i:s') ?></p>
                <p class="text-xs text-gray-400">Dicetak oleh: <?= htmlspecialchars($pesanan->nama_karyawan ?? 'Karyawan') ?></p>
            </div>
        </div>

    </div>

    <script>
        // Auto trigger print dialog when page loads
        window.onload = function() { 
            setTimeout(function() {
                window.print(); 
            }, 500); // Small delay to ensure page is fully rendered
        }
    </script>
</body>
</html>
