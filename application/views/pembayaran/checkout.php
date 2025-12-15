<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Checkout' ?> - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Midtrans Snap JS -->
    <script src="<?= $midtrans_snap_url ?>" data-client-key="<?= $midtrans_client_key ?>"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        @media print { .no-print { display: none; } }
        .loading-spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #10b981;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <a href="<?= base_url('landingpage#pricing') ?>" class="no-print mb-6 flex items-center gap-2 text-gray-600 hover:text-gray-900 transition-colors inline-flex">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Paket
            </a>

            <!-- Flash Messages -->
            <?php if($this->session->flashdata('error')): ?>
                <div class="no-print mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('info')): ?>
                <div class="no-print mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-xl">
                    <?= $this->session->flashdata('info') ?>
                </div>
            <?php endif; ?>

            <!-- Invoice Container -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-emerald-500 to-teal-400 px-8 py-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">CHECKOUT</h1>
                            <p class="text-emerald-50"><?= $invoice_number ?></p>
                        </div>
                        <div class="text-right">
                            <div class="text-white font-bold text-2xl mb-1">KixEra</div>
                            <p class="text-emerald-50 text-sm">Shoe Care Management</p>
                        </div>
                    </div>
                </div>

                <!-- Invoice Details -->
                <div class="px-8 py-8">
                    <div class="grid md:grid-cols-2 gap-8 mb-8">
                        <!-- Bill To -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Ditagihkan Kepada</h3>
                            <div class="space-y-1">
                                <p class="font-semibold text-gray-900"><?= $customer['nama'] ?></p>
                                <p class="text-gray-600"><?= $customer['email'] ?></p>
                                <p class="text-gray-600"><?= $customer['telp'] ?></p>
                                <p class="text-gray-600"><?= $customer['alamat'] ?></p>
                            </div>
                        </div>

                        <!-- Invoice Info -->
                        <div class="text-left md:text-right">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Detail Invoice</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between md:justify-end gap-4">
                                    <span class="text-gray-600">Tanggal Invoice:</span>
                                    <span class="font-semibold"><?= date('d M Y', strtotime($invoice_date)) ?></span>
                                </div>
                                <div class="flex justify-between md:justify-end gap-4">
                                    <span class="text-gray-600">Tanggal Mulai:</span>
                                    <span class="font-semibold" id="start-date"><?= date('d M Y') ?></span>
                                </div>
                                <div class="flex justify-between md:justify-end gap-4">
                                    <span class="text-gray-600">Tanggal Akhir:</span>
                                    <span class="font-semibold" id="end-date">-</span>
                                </div>
                                <div class="flex justify-between md:justify-end gap-4">
                                    <span class="text-gray-600">Status:</span>
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-sm font-semibold rounded-full">Pending</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Subscription Details -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Langganan</h3>
                        <div class="border border-gray-200 rounded-xl overflow-hidden">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Paket</th>
                                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Durasi</th>
                                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Harga</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-900"><?= $paket->nama_paket ?> Plan</div>
                                            <div class="text-sm text-gray-600 mt-1"><?= $paket->deskripsi ?? 'Fitur premium untuk bisnis Anda' ?></div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full" id="duration">1 Bulan</span>
                                        </td>
                                        <td class="px-6 py-4 text-right font-semibold text-gray-900" id="plan-price">Rp <?= number_format($paket->harga, 0, ',', '.') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Duration Selector -->
                    <div class="mb-8 no-print">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pilih Durasi Langganan</h3>
                        <div class="grid sm:grid-cols-3 gap-4">
                            <button type="button" onclick="updateDuration(1, <?= $paket->harga ?>)" class="duration-btn p-4 border-2 border-emerald-500 bg-emerald-50 rounded-xl text-center transition-all hover:shadow-md">
                                <div class="text-2xl font-bold text-gray-900">1 Bulan</div>
                                <div class="text-sm text-gray-600 mt-1">Rp <?= number_format($paket->harga, 0, ',', '.') ?>/bulan</div>
                                <div class="text-emerald-600 font-semibold mt-2">Total: Rp <?= number_format($paket->harga, 0, ',', '.') ?></div>
                            </button>
                            <button type="button" onclick="updateDuration(3, <?= floor($paket->harga * 0.9) ?>)" class="duration-btn p-4 border-2 border-gray-300 rounded-xl text-center transition-all hover:border-emerald-500 hover:shadow-md">
                                <div class="text-2xl font-bold text-gray-900">3 Bulan</div>
                                <div class="text-sm text-gray-600 mt-1">Rp <?= number_format(floor($paket->harga * 0.9), 0, ',', '.') ?>/bulan</div>
                                <div class="text-emerald-600 font-semibold mt-2">Total: Rp <?= number_format(floor($paket->harga * 0.9) * 3, 0, ',', '.') ?></div>
                                <div class="text-xs text-orange-600 font-semibold mt-1">Hemat 10%</div>
                            </button>
                            <button type="button" onclick="updateDuration(12, <?= floor($paket->harga * 0.8) ?>)" class="duration-btn p-4 border-2 border-gray-300 rounded-xl text-center transition-all hover:border-emerald-500 hover:shadow-md">
                                <div class="text-2xl font-bold text-gray-900">12 Bulan</div>
                                <div class="text-sm text-gray-600 mt-1">Rp <?= number_format(floor($paket->harga * 0.8), 0, ',', '.') ?>/bulan</div>
                                <div class="text-emerald-600 font-semibold mt-2">Total: Rp <?= number_format(floor($paket->harga * 0.8) * 12, 0, ',', '.') ?></div>
                                <div class="text-xs text-orange-600 font-semibold mt-1">Hemat 20%</div>
                            </button>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="space-y-3 max-w-md ml-auto">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span id="subtotal">Rp <?= number_format($paket->harga, 0, ',', '.') ?></span>
                            </div>
                            <div class="border-t border-gray-300 pt-3 flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">Total Bayar</span>
                                <span class="text-2xl font-bold text-emerald-600" id="total">Rp <?= number_format($paket->harga, 0, ',', '.') ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Midtrans Payment Info -->
                    <div class="mt-8 no-print">
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-blue-800 font-semibold mb-1">Pembayaran Aman via Midtrans</p>
                                    <p class="text-sm text-blue-700">Anda dapat membayar dengan Credit Card, Virtual Account, GoPay, ShopeePay, dan metode lainnya.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex flex-col sm:flex-row gap-3 no-print">
                        <button type="button" onclick="window.print()" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Cetak Invoice
                        </button>
                        <button type="button" id="pay-button" onclick="processPayment()" class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-400 hover:from-emerald-600 hover:to-teal-500 text-white rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span id="pay-button-text">Bayar Sekarang</span>
                        </button>
                    </div>

                    <!-- Terms -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h4 class="font-semibold text-gray-900 mb-2">Syarat & Ketentuan</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Langganan akan aktif setelah pembayaran berhasil</li>
                            <li>• Refund tersedia dalam 7 hari setelah pembelian</li>
                            <li>• Semua harga dalam Rupiah (IDR)</li>
                            <li>• Dengan melanjutkan pembayaran, Anda menyetujui Syarat Layanan kami</li>
                        </ul>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                    <div class="text-center text-sm text-gray-600">
                        <p>Terima kasih telah memilih KixEra!</p>
                        <p class="mt-1">Butuh bantuan? Hubungi kami di support@kixera.id atau +62 812-3456-7890</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data paket
        const idPaket = <?= $paket->id_paket ?>;
        const basePrice = <?= $paket->harga ?>;
        let currentMonths = 1;
        let currentPricePerMonth = basePrice;
        let currentTotal = basePrice;

        function updateDuration(months, pricePerMonth) {
            currentMonths = months;
            currentPricePerMonth = pricePerMonth;
            
            // Update duration buttons
            document.querySelectorAll('.duration-btn').forEach(btn => {
                btn.classList.remove('border-emerald-500', 'bg-emerald-50');
                btn.classList.add('border-gray-300');
            });
            event.target.closest('.duration-btn').classList.add('border-emerald-500', 'bg-emerald-50');
            event.target.closest('.duration-btn').classList.remove('border-gray-300');
            
            // Calculate dates
            const startDate = new Date();
            const endDate = new Date();
            endDate.setMonth(endDate.getMonth() + months);
            
            // Update UI
            document.getElementById('duration').textContent = months === 1 ? '1 Bulan' : `${months} Bulan`;
            document.getElementById('start-date').textContent = formatDate(startDate);
            document.getElementById('end-date').textContent = formatDate(endDate);
            
            // Calculate totals (no tax for simplicity with Midtrans)
            const subtotal = pricePerMonth * months;
            currentTotal = subtotal;
            
            document.getElementById('plan-price').textContent = `Rp ${formatNumber(pricePerMonth)} x ${months}`;
            document.getElementById('subtotal').textContent = `Rp ${formatNumber(subtotal)}`;
            document.getElementById('total').textContent = `Rp ${formatNumber(subtotal)}`;
        }

        function formatDate(date) {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            return `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
        }

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function processPayment() {
            const payButton = document.getElementById('pay-button');
            const payButtonText = document.getElementById('pay-button-text');
            
            // Disable button and show loading
            payButton.disabled = true;
            payButtonText.innerHTML = '<div class="loading-spinner inline-block mr-2"></div> Memproses...';
            
            // Request Snap Token dari server
            fetch('<?= base_url("pembayaran/create_snap_token") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id_paket=${idPaket}&durasi_bulan=${currentMonths}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Open Midtrans Snap popup
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            // Redirect ke halaman finish
                            window.location.href = '<?= base_url("pembayaran/finish") ?>?order_id=' + data.order_id + '&transaction_status=success';
                        },
                        onPending: function(result) {
                            // Redirect ke halaman finish dengan status pending
                            window.location.href = '<?= base_url("pembayaran/finish") ?>?order_id=' + data.order_id + '&transaction_status=pending';
                        },
                        onError: function(result) {
                            alert('Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
                            resetButton();
                        },
                        onClose: function() {
                            // User menutup popup tanpa menyelesaikan pembayaran
                            resetButton();
                        }
                    });
                } else {
                    alert('Error: ' + data.message);
                    resetButton();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
                resetButton();
            });
        }

        function resetButton() {
            const payButton = document.getElementById('pay-button');
            const payButtonText = document.getElementById('pay-button-text');
            payButton.disabled = false;
            payButtonText.innerHTML = 'Bayar Sekarang';
        }

        // Initialize end date on page load
        window.onload = function() {
            const endDate = new Date();
            endDate.setMonth(endDate.getMonth() + 1);
            document.getElementById('end-date').textContent = formatDate(endDate);
        }
    </script>
</body>
</html>