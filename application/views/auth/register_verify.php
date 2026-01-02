<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Verifikasi Registrasi - KixEra' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-50 via-white to-emerald-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-lg">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-slate-800 to-slate-900 px-8 py-6 text-center">
                <h1 class="text-2xl font-bold text-white">Verifikasi Akun</h1>
                <p class="text-slate-300 mt-2 text-sm">Masukkan kode OTP dari WhatsApp dan Email</p>
            </div>
            
            <!-- Body -->
            <div class="p-8">
                <!-- Greeting -->
                <div class="text-center mb-6">
                    <p class="text-gray-600">Halo <span class="font-semibold text-gray-800"><?= htmlspecialchars($nama) ?></span>!</p>
                    <p class="text-gray-500 text-sm mt-1">Masukkan kedua kode verifikasi untuk menyelesaikan registrasi</p>
                </div>
                
                <!-- Alert -->
                <div id="alertBox" class="hidden rounded-lg p-4 mb-6">
                    <p id="alertText" class="text-sm font-medium"></p>
                </div>
                
                <!-- WHATSAPP OTP Section -->
                <div id="waSection" class="mb-6 p-4 rounded-xl border-2 <?= $wa_verified ? 'border-green-200 bg-green-50' : 'border-emerald-200 bg-emerald-50/50' ?>">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">WhatsApp</p>
                            <p class="text-sm text-gray-500"><?= htmlspecialchars($masked_phone) ?></p>
                        </div>
                        <?php if ($wa_verified): ?>
                        <span class="px-3 py-1 rounded-full bg-green-500 text-white text-xs font-semibold">✓ Verified</span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (!$wa_verified): ?>
                    <div class="flex gap-2 justify-center">
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                        <input type="text" 
                               id="waOtp<?= $i ?>" 
                               maxlength="1" 
                               pattern="[0-9]"
                               inputmode="numeric"
                               class="w-10 h-12 text-center text-xl font-bold border-2 border-gray-200 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                               data-group="wa">
                        <?php endfor; ?>
                    </div>
                    <div class="flex items-center justify-between mt-3 text-xs">
                        <span class="text-gray-500">Berlaku: <span id="waTimer" class="font-semibold"><?= floor($wa_expire_seconds/60) ?>:<?= str_pad($wa_expire_seconds%60, 2, '0', STR_PAD_LEFT) ?></span></span>
                        <button type="button" id="resendWaBtn" class="text-emerald-600 hover:text-emerald-700 font-semibold disabled:text-gray-400">
                            <span id="resendWaText"><?= $wa_countdown > 0 ? "Kirim ulang ({$wa_countdown}s)" : 'Kirim Ulang' ?></span>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- EMAIL OTP Section -->
                <div id="emailSection" class="mb-6 p-4 rounded-xl border-2 <?= $email_verified ? 'border-green-200 bg-green-50' : 'border-blue-200 bg-blue-50/50' ?>">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">Email</p>
                            <p class="text-sm text-gray-500"><?= htmlspecialchars($email) ?></p>
                        </div>
                        <?php if ($email_verified): ?>
                        <span class="px-3 py-1 rounded-full bg-green-500 text-white text-xs font-semibold">✓ Verified</span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (!$email_verified): ?>
                    <div class="flex gap-2 justify-center">
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                        <input type="text" 
                               id="emailOtp<?= $i ?>" 
                               maxlength="1" 
                               pattern="[0-9]"
                               inputmode="numeric"
                               class="w-10 h-12 text-center text-xl font-bold border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                               data-group="email">
                        <?php endfor; ?>
                    </div>
                    <div class="flex items-center justify-between mt-3 text-xs">
                        <span class="text-gray-500">Berlaku: <span id="emailTimer" class="font-semibold"><?= floor($email_expire_seconds/60) ?>:<?= str_pad($email_expire_seconds%60, 2, '0', STR_PAD_LEFT) ?></span></span>
                        <button type="button" id="resendEmailBtn" class="text-blue-600 hover:text-blue-700 font-semibold disabled:text-gray-400">
                            <span id="resendEmailText"><?= $email_countdown > 0 ? "Kirim ulang ({$email_countdown}s)" : 'Kirim Ulang' ?></span>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Submit -->
                <button type="button" 
                        id="verifyBtn"
                        class="w-full bg-gradient-to-r from-slate-800 to-slate-900 text-white py-3 px-4 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-800 transition-all focus:ring-4 focus:ring-slate-300 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                    <span id="verifyBtnText">Verifikasi & Buat Akun</span>
                    <svg id="verifySpinner" class="hidden animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
                
                <!-- Back -->
                <div class="mt-6 text-center">
                    <a href="<?= base_url('auth/register') ?>" class="text-gray-500 hover:text-gray-700 text-sm">
                        ← Kembali ke halaman registrasi
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <p class="text-center text-gray-400 text-xs mt-6">
            &copy; <?= date('Y') ?> KixEra. All rights reserved.
        </p>
    </div>
    
    <script>
        // State
        let waVerified = <?= $wa_verified ? 'true' : 'false' ?>;
        let emailVerified = <?= $email_verified ? 'true' : 'false' ?>;
        let waExpire = <?= $wa_expire_seconds ?? 0 ?>;
        let emailExpire = <?= $email_expire_seconds ?? 0 ?>;
        let waCountdown = <?= $wa_countdown ?? 0 ?>;
        let emailCountdown = <?= $email_countdown ?? 0 ?>;
        
        // OTP Input handling
        function setupOtpInputs(groupName) {
            const inputs = document.querySelectorAll(`input[data-group="${groupName}"]`);
            
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
                });
            });
        }
        
        function getOtp(groupName) {
            const inputs = document.querySelectorAll(`input[data-group="${groupName}"]`);
            return Array.from(inputs).map(input => input.value).join('');
        }
        
        setupOtpInputs('wa');
        setupOtpInputs('email');
        
        // Verify button
        document.getElementById('verifyBtn').addEventListener('click', async function() {
            const waOtp = getOtp('wa');
            const emailOtp = getOtp('email');
            
            // Validate
            if (!waVerified && waOtp.length !== 6) {
                showAlert('Masukkan kode WhatsApp 6 digit', 'error');
                return;
            }
            if (!emailVerified && emailOtp.length !== 6) {
                showAlert('Masukkan kode Email 6 digit', 'error');
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
                if (!waVerified) formData.append('wa_otp', waOtp);
                if (!emailVerified) formData.append('email_otp', emailOtp);
                
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
                } else if (data.partial) {
                    // Partial success - update UI
                    showAlert(data.message, 'warning');
                    if (data.wa_verified) markVerified('wa');
                    if (data.email_verified) markVerified('email');
                    btn.disabled = false;
                    btnText.textContent = 'Verifikasi & Buat Akun';
                    spinner.classList.add('hidden');
                } else {
                    showAlert(data.message, 'error');
                    btn.disabled = false;
                    btnText.textContent = 'Verifikasi & Buat Akun';
                    spinner.classList.add('hidden');
                }
            } catch (error) {
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                btn.disabled = false;
                btnText.textContent = 'Verifikasi & Buat Akun';
                spinner.classList.add('hidden');
            }
        });
        
        // Resend handlers
        document.getElementById('resendWaBtn')?.addEventListener('click', () => resend('wa'));
        document.getElementById('resendEmailBtn')?.addEventListener('click', () => resend('email'));
        
        async function resend(channel) {
            const btn = document.getElementById(channel === 'wa' ? 'resendWaBtn' : 'resendEmailBtn');
            const text = document.getElementById(channel === 'wa' ? 'resendWaText' : 'resendEmailText');
            
            btn.disabled = true;
            text.textContent = 'Mengirim...';
            
            try {
                const formData = new FormData();
                formData.append('channel', channel);
                
                const response = await fetch('<?= base_url('auth/resend_registration_code') ?>', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showAlert(data.message, 'success');
                    if (channel === 'wa') {
                        waCountdown = data.countdown || 90;
                        waExpire = 300;
                        startCountdown('wa');
                    } else {
                        emailCountdown = data.countdown || 90;
                        emailExpire = 300;
                        startCountdown('email');
                    }
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
        }
        
        function startCountdown(channel) {
            const btn = document.getElementById(channel === 'wa' ? 'resendWaBtn' : 'resendEmailBtn');
            const text = document.getElementById(channel === 'wa' ? 'resendWaText' : 'resendEmailText');
            let countdown = channel === 'wa' ? waCountdown : emailCountdown;
            
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
            }
        }
        
        function updateTimers() {
            if (!waVerified && waExpire > 0) {
                waExpire--;
                const m = Math.floor(waExpire / 60);
                const s = waExpire % 60;
                document.getElementById('waTimer').textContent = 
                    waExpire > 0 ? `${m}:${s.toString().padStart(2, '0')}` : 'Kadaluarsa';
            }
            if (!emailVerified && emailExpire > 0) {
                emailExpire--;
                const m = Math.floor(emailExpire / 60);
                const s = emailExpire % 60;
                document.getElementById('emailTimer').textContent = 
                    emailExpire > 0 ? `${m}:${s.toString().padStart(2, '0')}` : 'Kadaluarsa';
            }
        }
        
        function markVerified(channel) {
            if (channel === 'wa') {
                waVerified = true;
                const section = document.getElementById('waSection');
                section.classList.remove('border-emerald-200', 'bg-emerald-50/50');
                section.classList.add('border-green-200', 'bg-green-50');
            } else {
                emailVerified = true;
                const section = document.getElementById('emailSection');
                section.classList.remove('border-blue-200', 'bg-blue-50/50');
                section.classList.add('border-green-200', 'bg-green-50');
            }
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
        }
        
        // Initialize
        if (waCountdown > 0) startCountdown('wa');
        if (emailCountdown > 0) startCountdown('email');
        setInterval(updateTimers, 1000);
        
        // Focus first input
        const firstInput = document.querySelector('input[data-group="wa"]') || document.querySelector('input[data-group="email"]');
        if (firstInput) firstInput.focus();
    </script>
</body>
</html>
