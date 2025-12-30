<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Langganan Berakhir' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    
    <!-- Hero Section -->
    <div class="relative bg-emerald-700 pb-24 pt-12 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
             <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
             <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-teal-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 text-center text-white">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                <i class="fas fa-exclamation-triangle text-3xl text-yellow-300"></i>
            </div>
            
            <h2 class="text-xl font-medium text-emerald-100 mb-2">Halo, <?= $this->session->userdata('nama') ?></h2>
            <h1 class="text-4xl font-bold mb-4">Masa Langganan <?= $this->session->userdata('paket') ?? 'Anda' ?> Telah Berakhir</h1>
            
            <p class="text-xl text-emerald-100 max-w-2xl mx-auto">
                Jangan biarkan operasional bisnis Anda terhenti. Pilih paket langganan baru untuk mengaktifkan kembali akses penuh ke dashboard KixEra.
            </p>
            
            <div class="absolute top-6 right-6">
               <a href="<?= base_url('auth/logout') ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 border border-white/20 rounded-lg text-white transition-colors text-sm font-medium backdrop-blur-sm">
                  <i class="fas fa-sign-out-alt"></i> Logout
               </a>
            </div>
        </div>
    </div>

    <!-- Pricing Section -->
    <div class="relative max-w-7xl mx-auto px-6 -mt-20 pb-20 z-20">
        <div class="text-center mb-12 hidden">
             <h2 class="text-3xl font-bold text-gray-900">Pilih Paket Langganan</h2>
             <p class="text-gray-600 mt-2">Aktifkan kembali akun Anda sekarang</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Free Plan (Disabled for Renewal usually, but kept for context if needed) -->
            <!-- Note: Usually you can't downgrade to Free easily if data exceeds limits, but for now we list it or maybe hide it? 
                 Let's show Pro and Premium mainly as renewal options since they are likely paying users. 
                 But let's stick to the Landing Page layout including Free for completeness, or maybe just Pro/Premium.
                 Let's show all 3 consistent with Landing Page.
            -->

            <!-- Free Plan -->
             <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 flex flex-col">
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Free</h3>
                <div class="text-center mb-2">
                    <span class="text-4xl font-bold text-gray-900">Rp 0</span>
                    <span class="text-gray-500 text-lg"> / Selamanya</span>
                </div>
                <p class="text-center text-gray-500 mb-8 text-sm">Untuk bisnis rintisan kecil</p>
                
                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-start gap-3 text-sm">
                        <i class="fas fa-check text-emerald-500 mt-1"></i>
                        <span class="text-gray-600">Up to 100 orders/month</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm">
                        <i class="fas fa-check text-emerald-500 mt-1"></i>
                        <span class="text-gray-600">Basic inventory tracking</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm">
                        <i class="fas fa-check text-emerald-500 mt-1"></i>
                        <span class="text-gray-600">Email support</span>
                    </li>
                </ul>
                
                <button class="w-full py-3 bg-gray-100 text-gray-400 rounded-xl font-semibold cursor-not-allowed" disabled>Paket Saat Ini / Trial</button>
            </div>

            <!-- Pro Plan (Focus) -->
            <div class="bg-white rounded-2xl p-8 shadow-2xl border-2 border-emerald-500 relative transform md:-translate-y-4 flex flex-col">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-emerald-600 text-white px-6 py-1.5 rounded-full text-sm font-semibold shadow-md">Paling Populer</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-2 mt-2">Pro</h3>
                <div class="text-center mb-2">
                    <span class="text-4xl font-bold text-emerald-600">Rp 99.000</span>
                    <span class="text-gray-500 text-lg"> / Bulan</span>
                </div>
                <p class="text-center text-gray-500 mb-8 text-sm">Ideal untuk bisnis berkembang</p>
                
                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-start gap-3 text-sm">
                        <i class="fas fa-check-circle text-emerald-500 mt-1"></i>
                        <span class="text-gray-700 font-medium">Up to 10.000 orders/month</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm">
                        <i class="fas fa-check-circle text-emerald-500 mt-1"></i>
                        <span class="text-gray-700 font-medium">Advanced analytics</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm">
                        <i class="fas fa-check-circle text-emerald-500 mt-1"></i>
                        <span class="text-gray-700 font-medium">AI recommendations</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm">
                        <i class="fas fa-check-circle text-emerald-500 mt-1"></i>
                        <span class="text-gray-700 font-medium">Priority support</span>
                    </li>
                </ul>
                
                <a href="<?= base_url('pembayaran/checkout/2') ?>" class="block w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold transition-all shadow-lg hover:shadow-xl text-center">
                    Pilih Paket Pro
                </a>
            </div>

            <!-- Premium Plan -->
            <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 flex flex-col">
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Premium</h3>
                <div class="text-center mb-2">
                    <span class="text-4xl font-bold text-gray-900">Rp 199.000</span>
                    <span class="text-gray-500 text-lg"> / Bulan</span>
                </div>
                <p class="text-center text-gray-500 mb-8 text-sm">Untuk bisnis skala besar</p>
                
                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-start gap-3 text-sm">
                        <i class="fas fa-check text-emerald-500 mt-1"></i>
                        <span class="text-gray-600">Unlimited orders</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm">
                        <i class="fas fa-check text-emerald-500 mt-1"></i>
                        <span class="text-gray-600">Custom integrations</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm">
                        <i class="fas fa-check text-emerald-500 mt-1"></i>
                        <span class="text-gray-600">Multi-location support</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm">
                        <i class="fas fa-check text-emerald-500 mt-1"></i>
                        <span class="text-gray-600">24/7 phone support</span>
                    </li>
                </ul>
                
                <a href="<?= base_url('pembayaran/checkout/3') ?>" class="block w-full py-3 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 rounded-xl font-semibold transition-colors text-center">
                    Pilih Premium
                </a>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <p class="text-gray-500 text-sm">Butuh bantuan? <a href="https://wa.me/6281234567890" class="text-emerald-600 font-semibold hover:underline">Hubungi Support</a></p>
        </div>
    </div>

</body>
</html>
