<!-- Main Content -->
<main class="flex-1 lg:ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Profil Saya</h1>
                <p class="text-gray-500 mt-1">Kelola informasi pribadi dan keamanan akun Anda</p>
            </div>
        </div>
    </header>

    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-8 text-center sticky top-6">
                    <div class="relative w-32 h-32 mx-auto mb-6">
                        <div class="w-full h-full rounded-full bg-emerald-100 flex items-center justify-center text-4xl text-emerald-600 font-bold border-4 border-white shadow-md ring-1 ring-gray-100">
                            <?= strtoupper(substr($user['nama'] ?? $user['username'], 0, 1)) ?>
                        </div>
                        <div class="absolute bottom-1 right-1 w-8 h-8 bg-emerald-500 rounded-full border-4 border-white flex items-center justify-center text-white text-xs shadow-sm">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    
                    <h2 class="text-xl font-bold text-gray-800 mb-1"><?= $user['nama'] ?? $user['username'] ?></h2>
                    <div class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-sm font-medium mb-6">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2"></span>
                        Administrator
                    </div>
                    
                    <div class="space-y-4 text-left">
                        <div class="p-4 bg-gray-50 rounded-xl hover:bg-emerald-50/50 transition-colors border border-gray-100 group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-emerald-500 shadow-sm group-hover:scale-105 transition-transform">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-xs text-gray-500 mb-0.5">Email Address</p>
                                    <p class="text-sm font-medium text-gray-800 truncate"><?= $user['email'] ?? '-' ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-xl hover:bg-emerald-50/50 transition-colors border border-gray-100 group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-emerald-500 shadow-sm group-hover:scale-105 transition-transform">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-0.5">Nomor Telepon</p>
                                    <p class="text-sm font-medium text-gray-800"><?= $user['no_telp'] ?? '-' ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-xl hover:bg-emerald-50/50 transition-colors border border-gray-100 group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-emerald-500 shadow-sm group-hover:scale-105 transition-transform">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-0.5">Bergabung Sejak</p>
                                    <p class="text-sm font-medium text-gray-800"><?= isset($user['created_at']) ? date('d M Y', strtotime($user['created_at'])) : '-' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Forms -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Update Profile Form -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/30">
                        <h3 class="font-bold text-gray-800 flex items-center">
                            <i class="fas fa-user-circle mr-3 text-emerald-500 text-lg"></i>
                            Edit Informasi Profil
                        </h3>
                    </div>
                    <div class="p-6">
                        <form id="profileForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                    <div class="relative">
                                        <input type="text" name="nama" value="<?= $user['nama'] ?? $user['username'] ?>" required
                                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all">
                                        <i class="fas fa-user absolute left-3.5 top-3 text-gray-400"></i>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                                    <div class="relative">
                                        <input type="tel" name="no_telp" value="<?= $user['no_telp'] ?? '' ?>"
                                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all">
                                        <i class="fas fa-phone absolute left-3.5 top-3 text-gray-400"></i>
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                    <div class="relative">
                                        <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" required
                                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all">
                                        <i class="fas fa-envelope absolute left-3.5 top-3 text-gray-400"></i>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2 ml-1 flex items-center">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Email digunakan untuk login dan notifikasi sistem.
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-end pt-4 border-t border-gray-100">
                                <button type="submit" class="px-6 py-2.5 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 transition-all transform hover:scale-[1.02] active:scale-[0.98] font-medium shadow-lg shadow-emerald-500/20 flex items-center">
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password Form -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/30">
                        <h3 class="font-bold text-gray-800 flex items-center">
                            <i class="fas fa-shield-alt mr-3 text-emerald-500 text-lg"></i>
                            Ganti Password
                        </h3>
                    </div>
                    <div class="p-6">
                        <form id="passwordForm">
                            <div class="space-y-5 mb-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
                                    <div class="relative">
                                        <input type="password" name="current_password" required
                                            class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all">
                                        <i class="fas fa-lock absolute left-3.5 top-3 text-gray-400"></i>
                                        <i class="fas fa-eye absolute right-3.5 top-3 text-gray-400 cursor-pointer toggle-password hover:text-emerald-500 transition-colors"></i>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                        <div class="relative">
                                            <input type="password" name="new_password" required minlength="6"
                                                class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all">
                                            <i class="fas fa-key absolute left-3.5 top-3 text-gray-400"></i>
                                            <i class="fas fa-eye absolute right-3.5 top-3 text-gray-400 cursor-pointer toggle-password hover:text-emerald-500 transition-colors"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                                        <div class="relative">
                                            <input type="password" name="confirm_password" required minlength="6"
                                                class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all">
                                            <i class="fas fa-check-circle absolute left-3.5 top-3 text-gray-400"></i>
                                            <i class="fas fa-eye absolute right-3.5 top-3 text-gray-400 cursor-pointer toggle-password hover:text-emerald-500 transition-colors"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end pt-4 border-t border-gray-100">
                                <button type="submit" class="px-6 py-2.5 bg-gray-800 text-white rounded-xl hover:bg-gray-900 transition-all transform hover:scale-[1.02] active:scale-[0.98] font-medium shadow-lg flex items-center">
                                    <i class="fas fa-lock mr-2"></i>
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    // Toggle Password Visibility
    $('.toggle-password').click(function() {
        const input = $(this).siblings('input');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Handle Profile Update
    $('#profileForm').on('submit', function(e) {
        e.preventDefault();
        const btn = $(this).find('button[type="submit"]');
        const originalText = btn.html();
        
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...');

        $.ajax({
            url: '<?= base_url('admin/profil/update') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showNotification(response.message, 'error');
                    btn.prop('disabled', false).html(originalText);
                }
            },
            error: function() {
                showNotification('Terjadi kesalahan koneksi', 'error');
                btn.prop('disabled', false).html(originalText);
            }
        });
    });

    // Handle Password Change
    $('#passwordForm').on('submit', function(e) {
        e.preventDefault();
        const btn = $(this).find('button[type="submit"]');
        const originalText = btn.html();
        
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...');

        $.ajax({
            url: '<?= base_url('admin/profil/change_password') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    $('#passwordForm')[0].reset();
                } else {
                    showNotification(response.message, 'error');
                }
                btn.prop('disabled', false).html(originalText);
            },
            error: function() {
                showNotification('Terjadi kesalahan koneksi', 'error');
                btn.prop('disabled', false).html(originalText);
            }
        });
    });

    function showNotification(message, type = 'info') {
        const colors = {
            success: 'from-green-500 to-emerald-600',
            error: 'from-red-500 to-pink-600',
            info: 'from-blue-500 to-cyan-600'
        };
        
        const notification = $(`
            <div class="fixed top-4 right-4 z-50 bg-gradient-to-r ${colors[type]} text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 animate-slide-in">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle"></i>
                </div>
                <div class="flex-1">
                    <p class="font-medium">${message}</p>
                </div>
            </div>
        `);
        
        $('body').append(notification);
        
        setTimeout(function() {
            notification.fadeOut(300, function() {
                $(this).remove();
            });
        }, 3000);
    }
});
</script>

<style>
@keyframes slide-in {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
.animate-slide-in {
    animation: slide-in 0.3s ease-out;
}
</style>
