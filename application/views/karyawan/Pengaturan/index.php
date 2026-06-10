<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - KixEra</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64 transition-all duration-300">
            <!-- Header -->
            <header class="p-6 pb-0 flex flex-col md:flex-row justify-between items-start gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Pengaturan</h1>
                    <p class="text-gray-600">Kelola profil dan preferensi akun Anda</p>
                </div>
            </header>

            <div class="p-6">
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
                                class="px-6 py-3 bg-emerald-500 text-white rounded-xl hover:opacity-90 transition font-medium">
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
                                <input type="checkbox" id="notif_pesanan" 
                                       <?= isset($karyawan->notif_pesanan) && $karyawan->notif_pesanan ? 'checked' : '' ?> 
                                       class="sr-only peer notification-toggle">
                                <div class="w-11 h-6 bg-gray-300 peer-checked:bg-emerald-500 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        
                        <!-- Notification 2 -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-base font-medium text-gray-800 mb-1">Stok Inventory</h3>
                                <p class="text-sm text-gray-600">Dapatkan alert saat stok barang menipis</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="notif_stok" 
                                       <?= isset($karyawan->notif_stok) && $karyawan->notif_stok ? 'checked' : '' ?> 
                                       class="sr-only peer notification-toggle">
                                <div class="w-11 h-6 bg-gray-300 peer-checked:bg-emerald-500 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>

                        <!-- Notification 3 -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-base font-medium text-gray-800 mb-1">Jadwal Shift</h3>
                                <p class="text-sm text-gray-600">Dapatkan pengingat jadwal shift Anda</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="notif_shift" 
                                       <?= isset($karyawan->notif_shift) && $karyawan->notif_shift ? 'checked' : '' ?> 
                                       class="sr-only peer notification-toggle">
                                <div class="w-11 h-6 bg-gray-300 peer-checked:bg-emerald-500 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Preferensi Sistem -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Preferensi Sistem</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Bahasa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bahasa</label>
                            <select id="bahasa" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 preference-select">
                                <option value="id" <?= (isset($karyawan->bahasa) && $karyawan->bahasa == 'id') || !isset($karyawan->bahasa) ? 'selected' : '' ?>>Indonesia</option>
                                <option value="en" <?= isset($karyawan->bahasa) && $karyawan->bahasa == 'en' ? 'selected' : '' ?>>English</option>
                            </select>
                        </div>
                        
                        <!-- Mata Uang -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mata Uang</label>
                            <select id="mata_uang" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 preference-select">
                                <option value="IDR" <?= (isset($karyawan->mata_uang) && $karyawan->mata_uang == 'IDR') || !isset($karyawan->mata_uang) ? 'selected' : '' ?>>Rupiah (Rp)</option>
                                <option value="USD" <?= isset($karyawan->mata_uang) && $karyawan->mata_uang == 'USD' ? 'selected' : '' ?>>Dollar ($)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button onclick="saveSystemPreferences()" 
                                class="px-6 py-3 bg-emerald-500 text-white rounded-xl hover:opacity-90 transition font-medium">
                            <i class="fas fa-save mr-2"></i>Simpan Preferensi
                        </button>
                    </div>
                </div>
            </div>
        </main>
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
    
  
    // ============ NOTIFICATION SETTINGS FUNCTIONS ============
    function saveNotificationSettings() {
        const notifPesanan = document.getElementById('notif_pesanan').checked ? 1 : 0;
        const notifStok = document.getElementById('notif_stok').checked ? 1 : 0;
        const notifShift = document.getElementById('notif_shift').checked ? 1 : 0;
        
        $.ajax({
            url: BASE_URL + 'karyawan/pengaturan/save_notification_settings',
            type: 'POST',
            data: {
                notif_pesanan: notifPesanan,
                notif_stok: notifStok,
                notif_shift: notifShift
            },
            dataType: 'json',
            success: function(response) {
                showNotification(response.message, response.success ? 'success' : 'error');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan: ' + error, 'error');
            }
        });
    }
    
    // Auto-save notification settings on toggle change
    document.addEventListener('DOMContentLoaded', function() {
        const notifToggles = document.querySelectorAll('.notification-toggle');
        notifToggles.forEach(toggle => {
            toggle.addEventListener('change', function() {
                saveNotificationSettings();
            });
        });
    });
    
    // ============ SYSTEM PREFERENCES FUNCTIONS ============
    function saveSystemPreferences() {
        const bahasa = document.getElementById('bahasa').value;
        const mataUang = document.getElementById('mata_uang').value;
        
        $.ajax({
            url: BASE_URL + 'karyawan/pengaturan/save_system_preferences',
            type: 'POST',
            data: {
                bahasa: bahasa,
                mata_uang: mataUang
            },
            dataType: 'json',
            success: function(response) {
                showNotification(response.message, response.success ? 'success' : 'error');
                if(response.success) {
                    // Store in session/local storage for immediate UI updates if needed
                    localStorage.setItem('user_language', bahasa);
                    localStorage.setItem('user_currency', mataUang);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan: ' + error, 'error');
            }
        });
    }

</script>
</body>
</html>