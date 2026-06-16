<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 antialiased">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-3xl mx-auto">

            <!-- Success Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-emerald-500 px-8 py-12 text-center">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">Payment Pending!</h1>
                    <p class="text-emerald-50">Please complete your payment to activate your subscription</p>
                </div>

                <!-- Content -->
                <div class="px-8 py-8">
                    <!-- Payment Details -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Details</h3>
                        <div class="bg-gray-50 rounded-xl p-6 space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Transaction ID</span>
                                <span class="font-semibold">#<?= $transaksi->id_transaksi_langganan ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Code</span>
                                <span class="font-mono font-semibold text-emerald-600"><?= $transaksi->kode_pembayaran ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Plan</span>
                                <span class="font-semibold"><?= $paket->nama_paket ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Method</span>
                                <span class="font-semibold capitalize"><?= str_replace('_', ' ', $transaksi->metode_pembayaran) ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Duration</span>
                                <span class="font-semibold">
                                    <?php
                                    $start = new DateTime($transaksi->tgl_mulai_langganan);
                                    $end = new DateTime($transaksi->tgl_akhir_langganan);
                                    $diff = $start->diff($end);
                                    echo $diff->m > 0 ? $diff->m . ' Month(s)' : $diff->d . ' Day(s)';
                                    ?>
                                </span>
                            </div>
                            <div class="flex justify-between pt-3 border-t border-gray-200">
                                <span class="text-gray-900 font-semibold">Total Amount</span>
                                <span class="text-xl font-bold text-emerald-600">Rp <?= number_format($transaksi->jumlah_bayar, 0, ',', '.') ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Instructions -->
                    <div class="mb-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <h4 class="font-semibold text-blue-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Payment Instructions
                        </h4>
                        <ol class="text-sm text-blue-900 space-y-2">
                            <li>1. Transfer the exact amount to the account below</li>
                            <li>2. Use payment code <strong><?= $transaksi->kode_pembayaran ?></strong> as reference</li>
                            <li>3. Complete payment within 24 hours</li>
                            <li>4. Your subscription will be activated automatically after payment verification</li>
                        </ol>
                    </div>

                    <!-- Bank Account (Example for Bank Transfer) -->
                    <?php if ($transaksi->metode_pembayaran == 'bank'): ?>
                        <div class="mb-8">
                            <h4 class="font-semibold text-gray-900 mb-3">Bank Account Details</h4>
                            <div class="bg-gray-50 rounded-xl p-6">
                                <div class="space-y-3">
                                    <div>
                                        <div class="text-sm text-gray-600">Bank Name</div>
                                        <div class="font-semibold text-gray-900">Bank Mandiri</div>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-600">Account Number</div>
                                        <div class="font-mono font-semibold text-gray-900 text-lg">1234567890</div>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-600">Account Name</div>
                                        <div class="font-semibold text-gray-900">PT KixEra Indonesia</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="<?= site_url('landingpage') ?>" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors text-center">
                            Back to Home
                        </a>
                        <a href="<?= site_url('pemilik/pemilik_dashboard') ?>" class="flex-1 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl text-center">
                            Go to Dashboard
                        </a>
                    </div>

                    <!-- Status Note -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-start gap-3 text-sm text-gray-600">
                            <svg class="w-5 h-5 text-yellow-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-900 mb-1">Payment Status: <span class="text-yellow-600">Pending Verification</span></p>
                                <p>We will send you an email notification once your payment is verified. This usually takes 5-15 minutes for automatic verification.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Need Help -->
            <div class="mt-6 text-center text-sm text-gray-600">
                <p>Need help? Contact us at <a href="mailto:support@kixera.com" class="text-emerald-600 hover:text-emerald-700 font-semibold">support@kixera.com</a> or call <a href="tel:+6281234567890" class="text-emerald-600 hover:text-emerald-700 font-semibold">+62 812-3456-7890</a></p>
            </div>
        </div>
    </div>
</body>

</html>
