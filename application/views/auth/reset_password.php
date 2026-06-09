<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .fade-in { animation: fadeIn 0.3s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="min-h-screen bg-emerald-50 flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden">
            <!-- Top Gradient Bar -->
            <div class="h-1 bg-emerald-500"></div>
            
            <!-- Logo -->
            <div class="flex justify-center pt-8 pb-4">
                <div class="text-4xl font-bold text-emerald-500">KixEra</div>
            </div>
            
            <div class="px-8 pb-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Reset Password</h2>
                    <p class="text-gray-600">Buat password baru untuk akun Anda</p>
                </div>
                
                <!-- Flash Messages -->
                <?php if ($this->session->flashdata('error')): ?>
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm fade-in">
                    <?= $this->session->flashdata('error') ?>
                </div>
                <?php endif; ?>
                
                <!-- Email info -->
                <div class="mb-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <p class="text-sm text-gray-600">Reset password untuk:</p>
                    <p class="font-semibold text-gray-800"><?= htmlspecialchars($email ?? '') ?></p>
                </div>
                
                <form method="POST" action="<?= base_url('auth/reset_password/' . ($token ?? '')) ?>" id="resetForm" class="space-y-6">
                    
                    <!-- New Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" required minlength="6"
                                   placeholder="Minimal 6 karakter"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                            <button type="button" onclick="togglePassword('password')" 
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <div class="relative">
                            <input type="password" name="confirm_password" id="confirm_password" required minlength="6"
                                   placeholder="Ulangi password"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p id="matchError" class="hidden text-red-500 text-xs">Password tidak cocok</p>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" id="submitBtn"
                            class="w-full bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-medium py-3 px-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span id="btnText">Reset Password</span>
                        <svg id="btnSpinner" class="hidden animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Footer -->
        <p class="text-center text-gray-500 text-xs mt-6">
            &copy; <?= date('Y') ?> KixEra. All rights reserved.
        </p>
    </div>
    
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
        
        // Check password match
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirm = this.value;
            const error = document.getElementById('matchError');
            
            if (confirm.length > 0 && password !== confirm) {
                error.classList.remove('hidden');
            } else {
                error.classList.add('hidden');
            }
        });
        
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('confirm_password').value;
            
            if (password !== confirm) {
                e.preventDefault();
                document.getElementById('matchError').classList.remove('hidden');
                return;
            }
            
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('btnText').textContent = 'Menyimpan...';
            document.getElementById('btnSpinner').classList.remove('hidden');
        });
    </script>
</body>
</html>
