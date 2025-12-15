<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Checkout' ?> - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body class="bg-gray-50 antialiased">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <a href="<?= site_url('landingpage#pricing') ?>" class="no-print mb-6 flex items-center gap-2 text-gray-600 hover:text-gray-900 transition-colors inline-flex">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Plans
            </a>

            <!-- Flash Messages -->
            <?php if($this->session->flashdata('error')): ?>
                <div class="no-print mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- Invoice Container -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-emerald-500 to-teal-400 px-8 py-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">INVOICE</h1>
                            <p class="text-emerald-50"><?= $invoice_number ?></p>
                        </div>
                        <div class="text-right">
                            <div class="text-white font-bold text-2xl mb-1">KixEra</div>
                            <p class="text-emerald-50 text-sm">Shoe Care Management</p>
                        </div>
                    </div>
                </div>

                <!-- Form untuk proses pembayaran -->
                <form id="paymentForm" method="POST" action="<?= site_url('pembayaran/process') ?>">
                    <input type="hidden" name="id_paket" value="<?= $paket->id_paket ?>">
                    <input type="hidden" name="durasi_bulan" id="durasi_bulan_input" value="1">
                    <input type="hidden" name="metode_pembayaran" id="metode_pembayaran_input" value="credit">
                    <input type="hidden" name="jumlah_bayar" id="jumlah_bayar_input" value="<?= $paket->harga ?>">
                    
                    <!-- Invoice Details -->
                    <div class="px-8 py-8">
                        <div class="grid md:grid-cols-2 gap-8 mb-8">
                            <!-- Bill To -->
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Bill To</h3>
                                <div class="space-y-1">
                                    <p class="font-semibold text-gray-900"><?= $customer['nama'] ?></p>
                                    <p class="text-gray-600"><?= $customer['email'] ?></p>
                                    <p class="text-gray-600"><?= $customer['telp'] ?></p>
                                    <p class="text-gray-600"><?= $customer['alamat'] ?></p>
                                </div>
                            </div>

                            <!-- Invoice Info -->
                            <div class="text-left md:text-right">
                                <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Invoice Details</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between md:justify-end gap-4">
                                        <span class="text-gray-600">Invoice Date:</span>
                                        <span class="font-semibold"><?= date('M d, Y', strtotime($invoice_date)) ?></span>
                                    </div>
                                    <div class="flex justify-between md:justify-end gap-4">
                                        <span class="text-gray-600">Start Date:</span>
                                        <span class="font-semibold" id="start-date"><?= date('M d, Y') ?></span>
                                    </div>
                                    <div class="flex justify-between md:justify-end gap-4">
                                        <span class="text-gray-600">End Date:</span>
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
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Subscription Details</h3>
                            <div class="border border-gray-200 rounded-xl overflow-hidden">
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Plan</th>
                                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Duration</th>
                                            <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4">
                                                <div class="font-semibold text-gray-900"><?= $paket->nama_paket ?> Plan</div>
                                                <div class="text-sm text-gray-600 mt-1"><?= $paket->deskripsi ?? 'Premium features for your business' ?></div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full" id="duration">1 Month</span>
                                            </td>
                                            <td class="px-6 py-4 text-right font-semibold text-gray-900" id="plan-price">Rp <?= number_format($paket->harga, 0, ',', '.') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Duration Selector -->
                        <div class="mb-8 no-print">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Select Subscription Duration</h3>
                            <div class="grid sm:grid-cols-3 gap-4">
                                <button type="button" onclick="updateDuration(1, <?= $paket->harga ?>)" class="duration-btn p-4 border-2 border-emerald-500 bg-emerald-50 rounded-xl text-center transition-all hover:shadow-md">
                                    <div class="text-2xl font-bold text-gray-900">1 Month</div>
                                    <div class="text-sm text-gray-600 mt-1">Rp <?= number_format($paket->harga, 0, ',', '.') ?>/month</div>
                                    <div class="text-emerald-600 font-semibold mt-2">Total: Rp <?= number_format($paket->harga, 0, ',', '.') ?></div>
                                </button>
                                <button type="button" onclick="updateDuration(3, <?= floor($paket->harga * 0.9) ?>)" class="duration-btn p-4 border-2 border-gray-300 rounded-xl text-center transition-all hover:border-emerald-500 hover:shadow-md">
                                    <div class="text-2xl font-bold text-gray-900">3 Months</div>
                                    <div class="text-sm text-gray-600 mt-1">Rp <?= number_format(floor($paket->harga * 0.9), 0, ',', '.') ?>/month</div>
                                    <div class="text-emerald-600 font-semibold mt-2">Total: Rp <?= number_format(floor($paket->harga * 0.9) * 3, 0, ',', '.') ?></div>
                                    <div class="text-xs text-orange-600 font-semibold mt-1">Save 10%</div>
                                </button>
                                <button type="button" onclick="updateDuration(12, <?= floor($paket->harga * 0.8) ?>)" class="duration-btn p-4 border-2 border-gray-300 rounded-xl text-center transition-all hover:border-emerald-500 hover:shadow-md">
                                    <div class="text-2xl font-bold text-gray-900">12 Months</div>
                                    <div class="text-sm text-gray-600 mt-1">Rp <?= number_format(floor($paket->harga * 0.8), 0, ',', '.') ?>/month</div>
                                    <div class="text-emerald-600 font-semibold mt-2">Total: Rp <?= number_format(floor($paket->harga * 0.8) * 12, 0, ',', '.') ?></div>
                                    <div class="text-xs text-orange-600 font-semibold mt-1">Save 20%</div>
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
                                <div class="flex justify-between text-gray-600">
                                    <span>Tax (11%)</span>
                                    <span id="tax">Rp <?= number_format($paket->harga * 0.11, 0, ',', '.') ?></span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Discount</span>
                                    <span id="discount" class="text-green-600">- Rp 0</span>
                                </div>
                                <div class="border-t border-gray-300 pt-3 flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-900">Total Amount</span>
                                    <span class="text-2xl font-bold text-emerald-600" id="total">Rp <?= number_format($paket->harga * 1.11, 0, ',', '.') ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="mt-8 no-print">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Method</h3>
                            <div class="grid sm:grid-cols-3 gap-4">
                                <label class="payment-method cursor-pointer">
                                    <input type="radio" name="payment_radio" value="credit" class="hidden" checked onchange="selectPayment(this)">
                                    <div class="payment-card border-2 border-emerald-500 bg-emerald-50 rounded-xl p-4 text-center transition-all">
                                        <svg class="w-12 h-12 mx-auto mb-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        <div class="font-semibold text-gray-900">Credit Card</div>
                                    </div>
                                </label>
                                <label class="payment-method cursor-pointer">
                                    <input type="radio" name="payment_radio" value="bank" class="hidden" onchange="selectPayment(this)">
                                    <div class="payment-card border-2 border-gray-300 rounded-xl p-4 text-center transition-all">
                                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                        </svg>
                                        <div class="font-semibold text-gray-900">Bank Transfer</div>
                                    </div>
                                </label>
                                <label class="payment-method cursor-pointer">
                                    <input type="radio" name="payment_radio" value="ewallet" class="hidden" onchange="selectPayment(this)">
                                    <div class="payment-card border-2 border-gray-300 rounded-xl p-4 text-center transition-all">
                                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <div class="font-semibold text-gray-900">E-Wallet</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-8 flex flex-col sm:flex-row gap-3 no-print">
                            <button type="button" onclick="window.print()" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                                Print Invoice
                            </button>
                            <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-400 hover:from-emerald-600 hover:to-teal-500 text-white rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Proceed to Payment
                            </button>
                        </div>

                        <!-- Terms -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h4 class="font-semibold text-gray-900 mb-2">Terms & Conditions</h4>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• Subscription will auto-renew unless cancelled 24 hours before the end date</li>
                                <li>• Refunds are available within 7 days of purchase</li>
                                <li>• All prices are in Indonesian Rupiah (IDR)</li>
                                <li>• By proceeding with payment, you agree to our Terms of Service</li>
                            </ul>
                        </div>
                    </div>
                </form>

                <!-- Footer -->
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                    <div class="text-center text-sm text-gray-600">
                        <p>Thank you for choosing KixEra!</p>
                        <p class="mt-1">For support, contact us at support@kixera.com or +62 812-3456-7890</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentMonths = 1;
        let currentPricePerMonth = <?= $paket->harga ?>;
        const basePrice = <?= $paket->harga ?>;

        function updateDuration(months, pricePerMonth) {
            currentMonths = months;
            currentPricePerMonth = pricePerMonth;
            
            // Update hidden inputs
            document.getElementById('durasi_bulan_input').value = months;
            
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
            document.getElementById('duration').textContent = months === 1 ? '1 Month' : `${months} Months`;
            document.getElementById('start-date').textContent = formatDate(startDate);
            document.getElementById('end-date').textContent = formatDate(endDate);
            
            // Calculate totals
            const subtotal = pricePerMonth * months;
            const tax = Math.round(subtotal * 0.11);
            const total = subtotal + tax;
            
            // Update jumlah_bayar hidden input
            document.getElementById('jumlah_bayar_input').value = total;
            
            document.getElementById('plan-price').textContent = `Rp ${formatNumber(pricePerMonth)} x ${months}`;
            document.getElementById('subtotal').textContent = `Rp ${formatNumber(subtotal)}`;
            document.getElementById('tax').textContent = `Rp ${formatNumber(tax)}`;
            document.getElementById('total').textContent = `Rp ${formatNumber(total)}`;
        }

        function selectPayment(radio) {
            // Update hidden input
            document.getElementById('metode_pembayaran_input').value = radio.value;
            
            // Update UI
            document.querySelectorAll('.payment-card').forEach(card => {
                card.classList.remove('border-emerald-500', 'bg-emerald-50');
                card.classList.add('border-gray-300');
            });
            radio.closest('.payment-method').querySelector('.payment-card').classList.add('border-emerald-500', 'bg-emerald-50');
            radio.closest('.payment-method').querySelector('.payment-card').classList.remove('border-gray-300');
        }

        function formatDate(date) {
            return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
        }

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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