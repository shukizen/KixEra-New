<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <div class="p-6">
                <!-- Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Pengaturan</h1>
                    <p class="text-gray-600">Kelola profil dan preferensi akun Anda</p>
                </div>

                <!-- Pengaturan Profile -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Informasi Profil</h2>
                    
                    <!-- Photo Section -->
                    <div class="flex items-center gap-6 mb-8">
                        <div class="relative">
                            <img id="profilePhotoDisplay" 
                                 src="<?= isset($karyawan->foto_profil) && !empty($karyawan->foto_profil) ? base_url($karyawan->foto_profil) : 'https://via.placeholder.com/64' ?>" 
                                 alt="Profile" 
                                 class="w-16 h-16 rounded-full object-cover">
                            <?php if (!isset($karyawan->foto_profil) || empty($karyawan->foto_profil)): ?>
                            <div class="w-16 h-16 bg-emerald-500 rounded-full flex items-center justify-center absolute top-0 left-0">
                                <i class="fas fa-user text-white text-2xl"></i>
                            </div>
                            <?php endif; ?>
                        </div>
                        <button type="button" onclick="document.getElementById('photoInput').click()" 
                                class="px-6 py-2 border border-emerald-600 text-emerald-600 rounded-xl hover:bg-emerald-50 transition">
                            Ubah Foto
                        </button>
                        <input type="file" id="photoInput" accept="image/*" style="display:none;" onchange="handlePhotoChange()">
                    </div>
                    
                    <!-- Form Fields -->
                    <form id="profileForm" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <input type="hidden" id="id_karyawan" value="<?= $karyawan->id_karyawan ?>">
                        
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" 
                                   value="<?= htmlspecialchars($karyawan->nama ?? '') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" 
                                   value="<?= htmlspecialchars($karyawan->email ?? '') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                        </div>
                        
                        <!-- Telepon -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" id="telepon" name="telepon" 
                                   value="<?= htmlspecialchars($karyawan->no_telp ?? '') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                            <input type="text" readonly
                                   value="<?= htmlspecialchars($karyawan->jabatan ?? '-') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600">
                        </div>

                        <!-- Cabang (Read Only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cabang Kerja</label>
                            <input type="text" readonly
                                   value="<?= htmlspecialchars($karyawan->nama_cabang ?? '-') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600">
                        </div>
                    </form>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button onclick="updateProfile()" 
                                class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-300 text-white rounded-xl hover:opacity-90 transition font-medium">
                            Simpan Perubahan
                        </button>
                        <button type="button" 
                                class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition font-medium" 
                                onclick="location.reload()">
                            Batal
                        </button>
                    </div>
                </div>
                
                <!-- Pengaturan Notifikasi -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Pengaturan Notifikasi</h2>
                    
                    <div class="space-y-6">
                        <!-- Notification 1 -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-base font-medium text-gray-800 mb-1">Update Pesanan</h3>
                                <p class="text-sm text-gray-600">Dapatkan pemberitahuan saat ada pesanan baru atau update</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-emerald-500 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        
                        <!-- Notification 2 -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-base font-medium text-gray-800 mb-1">Stok Inventory</h3>
                                <p class="text-sm text-gray-600">Dapatkan alert saat stok barang menipis</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-emerald-500 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>

                        <!-- Notification 3 -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-base font-medium text-gray-800 mb-1">Jadwal Shift</h3>
                                <p class="text-sm text-gray-600">Dapatkan pengingat jadwal shift Anda</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-emerald-500 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Preferensi Sistem -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Preferensi Sistem</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Bahasa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bahasa</label>
                            <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                                <option selected>Indonesia</option>
                                <option>English</option>
                            </select>
                        </div>
                        
                        <!-- Mata Uang -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mata Uang</label>
                            <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                                <option selected>Rupiah (Rp)</option>
                                <option>Dollar ($)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Change Password -->
    <div id="changePasswordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800">Ubah Password</h2>
            </div>
            <form id="changePasswordForm" class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password Lama</label>
                        <input type="password" id="password_lama" name="password_lama" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                        <input type="password" id="password_baru" name="password_baru" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                        <input type="password" id="password_konfirmasi" name="password_konfirmasi" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeChangePasswordModal()" 
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>

<script>
    const BASE_URL = '<?= base_url() ?>';
    
    // ============ NOTIFICATION FUNCTION ============
    function showNotification(message, type = 'info') {
        const existing = document.getElementById('temp-notification');
        if (existing) {
            existing.remove();
        }
        
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-300 ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-blue-500 text-white'
        }`;
        notification.textContent = message;
        notification.id = 'temp-notification';
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
    
    // ============ UPDATE PROFILE FUNCTION ============
    function updateProfile() {
        const nama = $('#nama_lengkap').val();
        const email = $('#email').val();
        const telepon = $('#telepon').val();
        
        if (!nama || !email || !telepon) {
            showNotification('Semua field harus diisi', 'error');
            return;
        }
        
        $.ajax({
            url: BASE_URL + 'karyawan/pengaturan/update_profile',
            type: 'POST',
            data: {
                nama_lengkap: nama,
                email: email,
                telepon: telepon
            },
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response);
                showNotification(response.message, response.success ? 'success' : 'error');
                if(response.success) {
                    setTimeout(() => location.reload(), 1500);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                showNotification('Terjadi kesalahan: ' + error, 'error');
            }
        });
    }
    
    // ============ PHOTO UPLOAD FUNCTION ============
    function handlePhotoChange() {
        const fileInput = document.getElementById('photoInput');
        const file = fileInput.files[0];
        
        if (!file) return;
        
        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            showNotification('Hanya file gambar (JPG, PNG, GIF) yang diperbolehkan', 'error');
            return;
        }
        
        // Validate file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            showNotification('Ukuran file maksimal 5MB', 'error');
            return;
        }
        
        // Show preview immediately
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePhotoDisplay').src = e.target.result;
        };
        reader.readAsDataURL(file);
        
        // Upload file
        const formData = new FormData();
        formData.append('profile_photo', file);
        
        $.ajax({
            url: BASE_URL + 'karyawan/pengaturan/upload_photo',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('Upload response:', response);
                try {
                    response = typeof response === 'string' ? JSON.parse(response) : response;
                } catch(e) {
                    console.error('Parse error:', e);
                }
                
                if(response.success) {
                    showNotification('Foto berhasil diupload', 'success');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showNotification(response.message || 'Gagal mengupload foto', 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                showNotification('Terjadi kesalahan saat upload: ' + error, 'error');
            }
        });
    }


</script>
</body>
</html>