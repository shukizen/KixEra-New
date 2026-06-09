<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Verifikasi Registrasi - KixEra' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .scale-hover {
            transition: all 0.2s ease-in-out;
        }
        .scale-hover:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-2xl shadow-xl flex flex-col items-center gap-4 max-w-xs text-center">
            <svg class="animate-spin h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="font-semibold text-slate-800" id="loadingMessage">Mengirim kode OTP...</p>
        </div>
    </div>

    <div class="w-full max-w-lg">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-slate-800 px-8 py-7 text-center">
                <h1 class="text-2xl font-bold text-white">Verifikasi Akun</h1>
                <p class="text-slate-300 mt-2 text-sm">
                    <?= empty($selected_channel) ? 'Pilih metode untuk menerima kode OTP' : 'Masukkan kode verifikasi Anda' ?>
                </p>
            </div>
            
            <!-- Body -->
            <div class="p-8">
                
                <!-- Alert Box -->
                <div id="alertBox" class="hidden rounded-xl p-4 mb-6">
                    <p id="alertText" class="text-sm font-medium"></p>
                </div>

                <?php if (empty($selected_channel)): ?>
                    <!-- STATE 1: SELECTION MENU -->
                    <div class="text-center mb-6">
                        <p class="text-slate-600">Halo <span class="font-semibold text-slate-800"><?= htmlspecialchars($nama) ?></span>!</p>
                        <p class="text-slate-500 text-sm mt-1">Silakan pilih ke mana kami harus mengirimkan kode OTP Anda:</p>
                    </div>

                    <div class="space-y-4 mb-4">
                        <!-- Option WhatsApp -->
                        <button type="button" 
                                onclick="selectChannel('wa')" 
                                class="w-full flex items-center gap-4 p-5 rounded-2xl border-2 border-slate-100 hover:border-emerald-500 hover:bg-emerald-50/20 text-left transition-all scale-hover group relative overflow-hidden">
                            <div class="w-12 h-12 rounded-full bg-emerald-100 group-hover:bg-emerald-500 text-emerald-600 group-hover:text-white flex items-center justify-center transition-all flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-slate-800 text-base mb-0.5">WhatsApp OTP</h3>
                                <p class="text-sm text-slate-500">Kirim kode OTP ke nomor <span class="font-semibold text-slate-700"><?= htmlspecialchars($masked_phone) ?></span></p>
                            </div>
                            <div class="text-slate-300 group-hover:text-emerald-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </button>

                        <!-- Option Email -->
                        <button type="button" 
                                onclick="selectChannel('email')" 
                                class="w-full flex items-center gap-4 p-5 rounded-2xl border-2 border-slate-100 hover:border-blue-500 hover:bg-blue-50/20 text-left transition-all scale-hover group relative overflow-hidden">
                            <div class="w-12 h-12 rounded-full bg-blue-100 group-hover:bg-blue-500 text-blue-600 group-hover:text-white flex items-center justify-center transition-all flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-slate-800 text-base mb-0.5">Email OTP</h3>
                                <p class="text-sm text-slate-500">Kirim kode OTP ke email <span class="font-semibold text-slate-700"><?= htmlspecialchars($email) ?></span></p>
                            </div>
                            <div class="text-slate-300 group-hover:text-blue-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </button>
                    </div>

                    <!-- Back Link -->
                    <div class="mt-8 text-center">
                        <a href="<?= base_url('auth/register') ?>" class="text-slate-500 hover:text-slate-700 text-sm">
                            ← Kembali ke Halaman Registrasi
                        </a>
                    </div>

                <?php else: ?>
                    <!-- STATE 2: OTP INPUT -->
                    <div class="text-center mb-6">
                        <p class="text-slate-600">Halo <span class="font-semibold text-slate-800"><?= htmlspecialchars($nama) ?></span>!</p>
                        <p class="text-slate-500 text-sm mt-1">
                            Masukkan kode verifikasi 6 digit yang telah kami kirimkan ke 
                            <span class="font-semibold text-slate-800">
                                <?= $selected_channel === 'wa' ? 'WhatsApp ' . htmlspecialchars($masked_phone) : 'Email ' . htmlspecialchars($email) ?>
                            </span>
                        </p>
                    </div>

                    <!-- OTP Input Section -->
                    <div class="mb-6 p-6 rounded-2xl border-2 <?= $selected_channel === 'wa' ? 'border-emerald-100 bg-emerald-50/20' : 'border-blue-100 bg-blue-50/20' ?>">
                        <div class="flex justify-center gap-2 mb-4">
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                            <input type="text" 
                                   id="otp<?= $i ?>" 
                                   maxlength="1" 
                                   pattern="[0-9]"
                                   inputmode="numeric"
                                   class="w-12 h-14 text-center text-2xl font-bold border-2 border-slate-200 rounded-xl focus:border-slate-800 focus:ring-4 focus:ring-slate-100 transition-all outline-none"
                                   data-group="otp">
                            <?php endfor; ?>
                        </div>
                        
                        <div class="flex items-center justify-between text-xs text-slate-500 mt-2 px-1">
                            <span>Masa Berlaku: <span id="timer" class="font-semibold text-slate-700">0:00</span></span>
                            <button type="button" id="resendBtn" class="font-semibold text-slate-800 hover:underline disabled:text-slate-400 disabled:no-underline">
                                <span id="resendText">Kirim Ulang</span>
                            </button>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="button" 
                            id="verifyBtn"
                            class="w-full bg-slate-800 text-white py-3.5 px-4 rounded-xl font-semibold hover:bg-slate-900 transition-all focus:ring-4 focus:ring-slate-300 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                        <span id="verifyBtnText">Verifikasi & Buat Akun</span>
                        <svg id="verifySpinner" class="hidden animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>

                    <!-- Back/Switch Method Link -->
                    <div class="mt-6 text-center">
                        <a href="<?= base_url('auth/change_verification_channel') ?>" class="text-slate-500 hover:text-slate-800 text-sm inline-flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Ganti metode verifikasi
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Footer -->
        <p class="text-center text-slate-400 text-xs mt-6">
            &copy; <?= date('Y') ?> KixEra. All rights reserved.
        </p>
    </div>
    
    <script>
        // DOM Helpers
        function showOverlay(message) {
            document.getElementById('loadingOverlay').classList.remove('hidden');
            document.getElementById('loadingMessage').textContent = message;
        }

        function hideOverlay() {
            document.getElementById('loadingOverlay').classList.add('hidden');
        }

        function showAlert(message, type) {
            const alertBox = document.getElementById('alertBox');
            const alertText = document.getElementById('alertText');
            
            alertBox.classList.remove('hidden', 'bg-red-50', 'text-red-700', 'bg-green-50', 'text-green-700', 'bg-yellow-50', 'text-yellow-700');
            
            if (type === 'error') {
                alertBox.classList.add('bg-red-50', 'text-red-700');
            } else if (type === 'warning') {
                alertBox.classList.add('bg-yellow-50', 'text-yellow-700');
            } else {
                alertBox.classList.add('bg-green-50', 'text-green-700');
            }
            
            alertText.textContent = message;
            alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        <?php if (empty($selected_channel)): ?>
        // --- JS FOR SELECTION SCREEN ---
        async function selectChannel(channel) {
            showOverlay('Sedang mengirim kode OTP ke ' + (channel === 'wa' ? 'WhatsApp' : 'Email') + '...');
            
            try {
                const formData = new FormData();
                formData.append('channel', channel);
                
                const response = await fetch('<?= base_url('auth/select_verification_channel') ?>', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Success selection, reload page to transition to input screen
                    window.location.reload();
                } else {
                    hideOverlay();
                    showAlert(data.message || 'Gagal mengirim kode OTP.', 'error');
                }
            } catch (error) {
                hideOverlay();
                showAlert('Terjadi kesalahan jaringan. Silakan coba lagi.', 'error');
            }
        }
        
        <?php else: ?>
        // --- JS FOR OTP INPUT SCREEN ---
        const activeChannel = '<?= $selected_channel ?>';
        let expire = <?= $selected_channel === 'wa' ? $wa_expire_seconds : $email_expire_seconds ?>;
        let countdown = <?= $selected_channel === 'wa' ? $wa_countdown : $email_countdown ?>;
        
        // OTP Inputs Focus Management
        function setupOtpInputs() {
            const inputs = document.querySelectorAll('input[data-group="otp"]');
            
            inputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    if (this.value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });
                
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && !this.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
                
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pasteData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
                    pasteData.split('').forEach((digit, i) => {
                        if (inputs[i]) inputs[i].value = digit;
                    });
                    if (inputs[pasteData.length - 1]) {
                        inputs[pasteData.length - 1].focus();
                    }
                });
            });
        }
        
        function getOtp() {
            const inputs = document.querySelectorAll('input[data-group="otp"]');
            return Array.from(inputs).map(input => input.value).join('');
        }
        
        setupOtpInputs();
        
        // Submit handler
        document.getElementById('verifyBtn').addEventListener('click', async function() {
            const otpCode = getOtp();
            
            if (otpCode.length !== 6) {
                showAlert('Masukkan kode verifikasi 6 digit dengan lengkap', 'error');
                return;
            }
            
            const btn = this;
            const btnText = document.getElementById('verifyBtnText');
            const spinner = document.getElementById('verifySpinner');
            
            btn.disabled = true;
            btnText.textContent = 'Memverifikasi...';
            spinner.classList.remove('hidden');
            
            try {
                const formData = new FormData();
                formData.append('otp', otpCode);
                
                const response = await fetch('<?= base_url('auth/process_verify_registration') ?>', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showAlert(data.message, 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    showAlert(data.message, 'error');
                    btn.disabled = false;
                    btnText.textContent = 'Verifikasi & Buat Akun';
                    spinner.classList.add('hidden');
                }
            } catch (error) {
                showAlert('Terjadi kesalahan sistem. Silakan coba lagi.', 'error');
                btn.disabled = false;
                btnText.textContent = 'Verifikasi & Buat Akun';
                spinner.classList.add('hidden');
            }
        });
        
        // Resend handler
        document.getElementById('resendBtn').addEventListener('click', async function() {
            const btn = this;
            const text = document.getElementById('resendText');
            
            btn.disabled = true;
            text.textContent = 'Mengirim...';
            
            try {
                const formData = new FormData();
                formData.append('channel', activeChannel);
                
                const response = await fetch('<?= base_url('auth/resend_registration_code') ?>', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showAlert(data.message, 'success');
                    countdown = data.countdown || 90;
                    expire = 300; // Reset expire timer to 5 minutes
                    startCountdown();
                } else {
                    showAlert(data.message, 'error');
                    btn.disabled = false;
                    text.textContent = 'Kirim Ulang';
                }
            } catch (error) {
                showAlert('Gagal mengirim ulang kode.', 'error');
                btn.disabled = false;
                text.textContent = 'Kirim Ulang';
            }
        });
        
        function startCountdown() {
            const btn = document.getElementById('resendBtn');
            const text = document.getElementById('resendText');
            
            if (countdown > 0) {
                btn.disabled = true;
                const interval = setInterval(() => {
                    countdown--;
                    text.textContent = `Kirim ulang (${countdown}s)`;
                    
                    if (countdown <= 0) {
                        clearInterval(interval);
                        btn.disabled = false;
                        text.textContent = 'Kirim Ulang';
                    }
                }, 1000);
            } else {
                btn.disabled = false;
                text.textContent = 'Kirim Ulang';
            }
        }
        
        function updateTimer() {
            if (expire > 0) {
                expire--;
                const m = Math.floor(expire / 60);
                const s = expire % 60;
                document.getElementById('timer').textContent = `${m}:${s.toString().padStart(2, '0')}`;
            } else {
                document.getElementById('timer').textContent = 'Kadaluarsa';
            }
        }
        
        // Initialize Timers
        startCountdown();
        updateTimer();
        setInterval(updateTimer, 1000);
        
        // Focus first input box
        const firstInput = document.querySelector('input[data-group="otp"]');
        if (firstInput) firstInput.focus();
        <?php endif; ?>
    </script>
</body>
</html>
