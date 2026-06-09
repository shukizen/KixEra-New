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
    <?php
    // DEBUG LOGIC - Unified Subscription Check
    $debug_email = $this->session->userdata('email');
    $debug_id_pemilik = $this->session->userdata('id_pemilik');
    
    // Use Auth_library for consistent validation
    $CI =& get_instance();
    $CI->load->library('auth_library');
    
    if ($debug_id_pemilik) {
        $sub_status = $CI->auth_library->check_subscription_status($debug_id_pemilik);
        
        // Debug info in HTML comment
        echo "<!-- DEBUG: Email: $debug_email, ID Pemilik: $debug_id_pemilik, Status: {$sub_status['status']}, Active: " . ($sub_status['active'] ? 'YES' : 'NO') . " -->";
        
        // If actually valid but on this page (stale session), auto-fix and redirect
        if ($sub_status['active'] === true) {
            $CI->session->unset_userdata('subscription_expired');
            $sisa = $sub_status['sisa_hari'] ?? 'N/A';
            $paket = $sub_status['paket'] ?? 'Unknown';
            echo '<div class="bg-blue-600 text-white p-3 text-center text-sm font-medium">';
            echo '✅ Akun Anda VALID (' . $paket . ', Sisa: ' . $sisa . ' hari). Session sedang diperbaiki, redirect dalam 2 detik...';
            echo '</div>';
            echo '<script>setTimeout(function(){ window.location.href = "'.base_url('pemilik').'"; }, 2000);</script>';
        }
    }
    ?>
    
    <!-- Hero Section -->
    <div class="relative bg-white pb-24 pt-20 overflow-hidden shadow-sm border-b border-gray-100">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-emerald-50 rounded-full blur-3xl opacity-50 z-0"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 bg-teal-50 rounded-full blur-3xl opacity-50 z-0"></div>

        <!-- Top Bar (Absolute) -->
        <div class="absolute top-0 left-0 w-full px-6 py-6 z-20 flex justify-between items-start">
            <!-- User Info (Top Left) -->
            <div class="flex items-center gap-4 bg-white/80 backdrop-blur-md px-4 py-2 rounded-full border border-gray-200 shadow-sm">
                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold text-lg border border-emerald-200">
                    <?= substr($this->session->userdata('nama') ?? 'U', 0, 1) ?>
                </div>
                <div class="flex flex-col pr-2">
                    <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Logged in as</span>
                    <span class="text-sm font-semibold text-gray-800 leading-tight"><?= $this->session->userdata('nama') ?></span>
                    <span class="text-xs text-emerald-600 font-medium"><?= $this->session->userdata('email') ?></span>
                </div>
            </div>

            <!-- Logout (Top Right) -->
            <a href="<?= base_url('auth/logout') ?>" class="group flex items-center gap-2 px-4 py-2 bg-white/80 backdrop-blur-md hover:bg-red-50 border border-gray-200 hover:border-red-200 rounded-full text-gray-600 hover:text-red-600 transition-all shadow-sm">
                <span class="text-sm font-medium">Keluar</span>
                <i class="fas fa-sign-out-alt group-hover:translate-x-0.5 transition-transform"></i>
            </a>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 mt-8">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-red-50 rounded-full mb-8 animate-pulse">
                    <i class="fas fa-history text-4xl text-red-500"></i>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    Masa Langganan Anda <br> <span class="text-red-600">Telah Berakhir</span>
                </h1>
                
                <p class="text-lg md:text-xl text-gray-500 leading-relaxed mb-10 max-w-2xl mx-auto">
                    Akses ke dashboard terkunci sementara. <span class="font-semibold text-gray-800">Data Anda aman</span>, namun Anda perlu memperbarui paket langganan untuk melanjutkan operasional.
                </p>
                
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-50 text-yellow-700 rounded-lg text-sm font-medium border border-yellow-100 shadow-sm">
                    <div class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></div>
                    Status Akun: <span class="uppercase font-bold tracking-wide">Suspended</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Section -->
    <div class="relative max-w-7xl mx-auto px-6 mt-12 pb-20 z-20">
        <div class="text-center mb-12">
             <h2 class="text-3xl font-bold text-gray-900">Pilih Paket untuk Melanjutkan</h2>
             <p class="text-gray-500 mt-2">Pilih paket yang sesuai dengan kebutuhan bisnis Anda</p>
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
