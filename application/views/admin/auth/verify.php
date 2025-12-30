<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Verifikasi Admin' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="p-8 text-center">
            
            <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-shield-alt text-2xl text-emerald-600"></i>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-2">Verifikasi Login</h2>
            <p class="text-gray-500 mb-8">
                Masukkan 6 digit kode yang telah dikirim ke WhatsApp<br>
                <span class="font-semibold text-gray-700"><?= $masked_phone ?></span>
            </p>

            <form id="verifyForm" class="space-y-6">
                <div>
                    <input type="text" name="code" maxlength="6" 
                        class="w-full text-center text-3xl tracking-[1em] font-bold py-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all text-gray-800"
                        placeholder="••••••" autocomplete="off" autofocus>
                </div>

                <button type="submit" 
                    class="w-full py-3.5 px-4 bg-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/30 hover:bg-emerald-700 hover:shadow-emerald-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Verifikasi
                </button>
            </form>

            <div class="mt-8">
                <p class="text-sm text-gray-500 mb-3">Tidak menerima kode?</p>
                <button id="resendBtn" class="text-emerald-600 font-semibold text-sm hover:text-emerald-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    Kirim Ulang <span id="timerText"></span>
                </button>
            </div>
            
            <div class="mt-6 pt-6 border-t border-gray-100">
                 <a href="<?= base_url('admin/auth/logout') ?>" class="text-xs text-gray-400 hover:text-gray-600">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login
                 </a>
            </div>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="notification-area" class="fixed top-4 right-4 z-50"></div>

<script>
$(document).ready(function() {
    let cooldown = <?= $remaining_cooldown ?>;
    
    function updateTimer() {
        if (cooldown > 0) {
            $('#resendBtn').prop('disabled', true);
            $('#timerText').text(`(${cooldown}s)`);
            cooldown--;
            setTimeout(updateTimer, 1000);
        } else {
            $('#resendBtn').prop('disabled', false);
            $('#timerText').text('');
        }
    }
    
    // Start initial timer
    updateTimer();
    
    // Format Input (Numbers Only)
    $('input[name="code"]').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Handle Verification
    $('#verifyForm').on('submit', function(e) {
        e.preventDefault();
        const btn = $(this).find('button[type="submit"]');
        const originalContent = btn.html();
        
        btn.prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin"></i>');

        $.ajax({
            url: '<?= base_url('admin/auth/process_verify') ?>',
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
                }
            },
            error: function() {
                showNotification('Terjadi kesalahan server.', 'error');
                btn.prop('disabled', false).html(originalContent);
            }
        });
    });
    
    // Handle Resend
    $('#resendBtn').click(function(e) {
        e.preventDefault();
        if (cooldown > 0) return;
        
        const btn = $(this);
        const originalText = btn.text();
        btn.prop('disabled', true).text('Mengirim...');
        
        $.ajax({
            url: '<?= base_url('admin/auth/resend_code') ?>',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    cooldown = <?= $resend_cooldown ?>; 
                    updateTimer();
                } else {
                    showNotification(response.message, 'error');
                    btn.prop('disabled', false).text('Kirim Ulang');
                }
            },
            error: function() {
                showNotification('Gagal mengirim ulang.', 'error');
                btn.prop('disabled', false).text('Kirim Ulang');
            }
        });
    });

    function showNotification(message, type = 'info') {
        const colors = {
            success: 'bg-emerald-500',
            error: 'bg-rose-500', 
            info: 'bg-blue-500'
        };
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        
        const notification = $(`
            <div class="${colors[type]} text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 mb-3 min-w-[300px]">
                <i class="fas ${icon} text-xl"></i>
                <span class="font-medium">${message}</span>
            </div>
        `);
        
        $('#notification-area').append(notification);
        setTimeout(() => notification.fadeOut(300, function() { $(this).remove(); }), 4000);
    }
});
</script>
</body>
</html>
