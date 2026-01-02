<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .fade-in { animation: fadeIn 0.3s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-emerald-300 flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden">
            <!-- Top Gradient Bar -->
            <div class="h-1 bg-gradient-to-r from-emerald-500 via-emerald-300 to-emerald-500"></div>
            
            <!-- Logo -->
            <div class="flex justify-center pt-8 pb-4">
                <div class="text-4xl font-bold text-emerald-500">KixEra</div>
            </div>
            
            <div class="px-8 pb-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Lupa Password?</h2>
                    <p class="text-gray-600">Masukkan email untuk reset password</p>
                </div>
                
                <!-- Flash Messages -->
                <?php if ($this->session->flashdata('error')): ?>
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm fade-in">
                    <?= $this->session->flashdata('error') ?>
                </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('info')): ?>
                <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-xl text-sm fade-in">
                    <?= $this->session->flashdata('info') ?>
                </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('success')): ?>
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm fade-in">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span><?= $this->session->flashdata('success') ?></span>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('email_sent')): ?>
                <!-- Success State: Email sent notification -->
                <div class="mb-6 p-6 bg-emerald-50 border border-emerald-200 rounded-xl text-center">
                    <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-emerald-800 mb-2">Email Terkirim!</h3>
                    <p class="text-sm text-emerald-700 mb-4">
                        Link reset password telah dikirim ke email Anda.<br>
                        Silakan cek <strong>inbox</strong> atau folder <strong>spam</strong>.
                    </p>
                    <p class="text-xs text-emerald-600">
                        ⏰ Link berlaku selama 1 jam
                    </p>
                </div>
                
                <a href="<?= base_url('auth/login') ?>" 
                   class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-3 px-4 rounded-xl transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Kembali ke Login
                </a>
                
                <?php else: ?>
                <!-- Form State -->
                <form method="POST" action="<?= base_url('auth/forgot_password') ?>" id="resetForm" class="space-y-6">
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="relative">
                            <input type="email" name="email" id="email" required
                                   placeholder="Masukkan email Anda"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" id="submitBtn"
                            class="w-full bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-medium py-3 px-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span id="btnText">Kirim Link Reset</span>
                        <svg id="btnSpinner" class="hidden animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </form>
                
                <!-- Back to Login -->
                <div class="mt-6 text-center">
                    <a href="<?= base_url('auth/login') ?>" class="text-emerald-600 hover:text-emerald-700 text-sm font-medium hover:underline transition">
                        ← Kembali ke Login
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Footer -->
        <p class="text-center text-gray-500 text-xs mt-6">
            &copy; <?= date('Y') ?> KixEra. All rights reserved.
        </p>
    </div>
    
    <script>
        document.getElementById('resetForm')?.addEventListener('submit', function() {
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('btnText').textContent = 'Mengirim...';
            document.getElementById('btnSpinner').classList.remove('hidden');
        });
        
        // Auto-hide alerts
        setTimeout(() => {
            document.querySelectorAll('.fade-in').forEach(el => {
                if (!el.closest('[class*="reset_link"]')) {
                    el.style.display = 'none';
                }
            });
        }, 5000);
    </script>
</body>
</html>
