<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Login Admin System' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-emerald-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-[20%] -right-[10%] w-[35%] h-[35%] bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[45%] h-[45%] bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Login Container -->
    <div class="w-full max-w-[1000px] bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row relative z-10 border border-white/50">
        
        <!-- Left Side: Branding (Hidden on Mobile) -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-emerald-600 to-teal-800 p-12 flex-col justify-between text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://source.unsplash.com/random/800x1200/?technology,abstract')] mix-blend-overlay opacity-10 bg-cover bg-center"></div>
            
            <div class="relative z-10">
                <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20 mb-8">
                    <i class="fas fa-shield-alt text-emerald-300"></i>
                    <span class="text-sm font-medium tracking-wide">SECURE ADMIN PORTAL</span>
                </div>
                <h1 class="text-4xl font-bold leading-tight mb-4">KixEra System Administrator</h1>
                <p class="text-emerald-100 text-lg leading-relaxed">Pusat kendali manajemen sistem yang aman, efisien, dan terintegrasi.</p>
            </div>

            <div class="relative z-10">
                <p class="text-sm text-emerald-200/80">© <?= date('Y') ?> KixEra System. All rights reserved.</p>
            </div>
            
            <!-- Abstract Shapes -->
            <div class="absolute bottom-0 right-0 transform translate-x-1/4 translate-y-1/4">
                <svg width="300" height="300" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="rgba(255,255,255,0.05)" d="M44.5,-73.4C58.9,-65.8,72.4,-56.9,81.4,-45.3C90.4,-33.7,94.9,-19.4,92.6,-5.9C90.3,7.6,81.2,20.3,71.2,31.7C61.2,43.1,50.3,53.2,38.1,62.1C25.9,71,12.4,78.7,-0.6,79.7C-13.6,80.7,-26.7,75,-38.3,66.8C-49.9,58.6,-60,47.9,-68.6,35.6C-77.2,23.3,-84.3,9.4,-82.9,-3.9C-81.5,-17.2,-71.7,-29.9,-61.1,-40.8C-50.5,-51.7,-39.1,-60.8,-26.8,-69.6C-14.5,-78.4,-1.3,-86.9,10.2,-84.5L21.7,-82.1"></path>
                </svg>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center bg-white/80 backdrop-blur-sm">
            <div class="max-w-md mx-auto w-full">
                <!-- Mobile Branding -->
                <div class="md:hidden text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Admin Login</h2>
                    <p class="text-gray-500 mt-2">Masuk untuk mengelola sistem</p>
                </div>

                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-gray-800 hidden md:block">Selamat Datang</h2>
                    <p class="text-gray-500 mt-2 hidden md:block">Silakan masukkan kredensial admin Anda.</p>
                </div>

                <form id="adminLoginForm" class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400 group-focus-within:text-emerald-500 transition-colors"></i>
                            </div>
                            <input type="email" name="email" required placeholder="admin@kixera.com" autocomplete="username"
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-gray-800 placeholder-gray-400">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-semibold text-gray-700">Password</label>
                            <!-- Optional Forgot Password -->
                            <a href="#" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition-colors">Lupa passowrd?</a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 group-focus-within:text-emerald-500 transition-colors"></i>
                            </div>
                            <input type="password" name="password" required placeholder="••••••••" autocomplete="current-password"
                                class="w-full pl-11 pr-11 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-gray-800 placeholder-gray-400">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer toggle-password">
                                <i class="fas fa-eye text-gray-400 hover:text-emerald-500 transition-colors"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="remember-me" name="remember_me" type="checkbox"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded cursor-pointer">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-600 cursor-pointer">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    <button type="submit" 
                        class="w-full py-3.5 px-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2 group">
                        <span>Masuk ke Dashboard</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-xs text-gray-400">
                        Akses terbatas hanya untuk Administrator.<br>
                        IP Anda akan dicatat untuk keamanan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="notification-area" class="fixed top-4 right-4 z-50"></div>

<script>
$(document).ready(function() {
    // Toggle Password Visibility
    $('.toggle-password').click(function() {
        const input = $(this).siblings('input');
        const icon = $(this).find('i');
        
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Handle Login
    $('#adminLoginForm').on('submit', function(e) {
        e.preventDefault();
        
        const btn = $(this).find('button[type="submit"]');
        const originalContent = btn.html();
        
        // Disable button & loading state
        btn.prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin"></i>');

        $.ajax({
            url: '<?= base_url('admin/auth/process_login') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    setTimeout(() => {
                        window.location.href = response.redirect_url;
                    }, 1000);
                } else {
                    showNotification(response.message, 'error');
                    btn.prop('disabled', false).html(originalContent);
                    // Shake animation for error
                    btn.addClass('animate-bounce');
                    setTimeout(() => btn.removeClass('animate-bounce'), 500);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                showNotification('Terjadi kesalahan server. Coba lagi.', 'error');
                btn.prop('disabled', false).html(originalContent);
            }
        });
    });

    function showNotification(message, type = 'info') {
        const colors = {
            success: 'bg-emerald-500',
            error: 'bg-rose-500',
            info: 'bg-blue-500'
        };
        
        const icon = type === 'success' ? 'fa-check-circle' : (type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle');
        
        const notification = $(`
            <div class="${colors[type]} text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 animate-slide-in-right mb-3 min-w-[300px]">
                <i class="fas ${icon} text-xl"></i>
                <span class="font-medium">${message}</span>
            </div>
        `);
        
        $('#notification-area').append(notification);
        
        setTimeout(() => {
            notification.fadeOut(300, function() { $(this).remove(); });
        }, 4000);
    }
});
</script>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
    animation: blob 7s infinite;
}
.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-4000 { animation-delay: 4s; }

@keyframes slide-in-right {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
.animate-slide-in-right {
    animation: slide-in-right 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
</style>
</body>
</html>
