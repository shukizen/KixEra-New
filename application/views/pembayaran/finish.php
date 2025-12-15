<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Pembayaran Berhasil' ?> - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-lg w-full">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <!-- Success Icon -->
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Pembayaran Berhasil!</h1>
            <p class="text-gray-600 mb-6">Terima kasih telah berlangganan KixEra</p>
            
            <!-- Transaction Details -->
            <div class="bg-gray-50 rounded-xl p-6 text-left mb-6">
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                    <span class="text-gray-600">Paket</span>
                    <span class="font-semibold text-gray-900"><?= $paket->nama_paket ?? 'N/A' ?></span>
                </div>
                
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                    <span class="text-gray-600">Order ID</span>
                    <span class="font-mono text-sm text-gray-900"><?= $transaksi->kode_pembayaran ?? 'N/A' ?></span>
                </div>
                
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                    <span class="text-gray-600">Total Bayar</span>
                    <span class="font-bold text-emerald-600">Rp <?= number_format($transaksi->jumlah_bayar ?? 0, 0, ',', '.') ?></span>
                </div>
                
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                    <span class="text-gray-600">Periode Langganan</span>
                    <span class="text-gray-900">
                        <?= date('d M Y', strtotime($transaksi->tgl_mulai_langganan ?? 'now')) ?> - 
                        <?= date('d M Y', strtotime($transaksi->tgl_akhir_langganan ?? '+1 month')) ?>
                    </span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Status</span>
                    <?php 
                    $status = $transaksi->status_pembayaran ?? 'pending';
                    $status_class = $status == 'sukses' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                    ?>
                    <span class="px-3 py-1 <?= $status_class ?> rounded-full text-sm font-medium capitalize"><?= $status ?></span>
                </div>
            </div>
            
            <!-- Info Box -->
            <?php if ($status == 'pending'): ?>
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-yellow-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="text-left">
                        <p class="text-sm text-yellow-800">
                            Pembayaran Anda sedang diproses. Status akan diperbarui dalam beberapa menit.
                        </p>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="text-left">
                        <p class="text-sm text-green-800">
                            Langganan Anda sudah aktif! Silakan login untuk mengakses semua fitur premium.
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="<?= base_url('auth/login') ?>" class="flex-1 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-semibold transition-colors text-center">
                    Login ke Dashboard
                </a>
                <a href="<?= base_url('landingpage') ?>" class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-semibold transition-colors text-center">
                    Kembali ke Home
                </a>
            </div>
        </div>
        
        <!-- Support Info -->
        <p class="text-center text-gray-500 text-sm mt-6">
            Ada pertanyaan? Hubungi kami di <a href="mailto:support@kixera.id" class="text-emerald-600 hover:underline">support@kixera.id</a>
        </p>
    </div>
</body>
</html>
