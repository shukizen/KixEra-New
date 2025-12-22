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
        <!-- Sidebar -->
        
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Pengaturan Profile -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Pengaturan Profile</h2>
                    
            <!-- Photo Section -->
                    <div class="flex items-center gap-6 mb-8">
                        <div class="relative">
                            <img id="profilePhotoDisplay" 
                                 src="<?= isset($pemilik->foto_profil) && !empty($pemilik->foto_profil) ? base_url($pemilik->foto_profil) : 'https://via.placeholder.com/64' ?>" 
                                 alt="Profile" class="w-16 h-16 bg-emerald-500 rounded-full object-cover flex items-center justify-center">
                            <i class="fas fa-user text-white text-2xl absolute inset-0 flex items-center justify-center" id="defaultIcon"></i>
                        </div>
                        <button type="button" onclick="document.getElementById('photoInput').click()" 
                                class="px-6 py-2 border border-emerald-600 text-emerald-600 rounded-xl hover:bg-emerald-50 transition">
                            Ubah Foto
                        </button>
                        <input type="file" id="photoInput" accept="image/*" style="display:none;" onchange="handlePhotoChange()">
                    </div>
                    
                    <!-- Form Fields -->
                    <form id="profileForm" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <input type="hidden" id="id_owner" value="<?= $pemilik->id_pemilik ?>">
                        
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" 
                                   value="<?= htmlspecialchars($pemilik->nama ?? '') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" 
                                   value="<?= htmlspecialchars($pemilik->email ?? '') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                        </div>
                        
                        <!-- Telepon -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                            <input type="tel" id="telepon" name="telepon" 
                                   value="<?= htmlspecialchars($pemilik->no_telp ?? '') ?>"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                        </div>
                        
                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <button type="button" onclick="openChangePasswordModal()" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-500 hover:bg-gray-50 text-center transition">
                                Change Password
                            </button>
                        </div>
                    </form>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button onclick="updateProfile()" class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-300 text-white rounded-xl hover:opacity-90 transition font-medium">
                            Simpan Perubahan
                        </button>
                        <button type="button" class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition font-medium" onclick="location.reload()">
                            Batal
                        </button>
                    </div>
                </div>
                
                <!-- Kelola Akun Karyawan -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 leading-7">Kelola Akun Karyawan</h2>
                            <p class="text-sm text-gray-600 leading-5">Tambahkan dan kelola akun staf untuk cabang Anda</p>
                        </div>
                        <button onclick="openAddEmployeeModal()" class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-emerald-300 text-white rounded-xl hover:opacity-90 transition flex items-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Tambah Akun Karyawan</span>
                        </button>
                    </div>
                    
                    <!-- Employee Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full" id="employeeTable">
                            <thead class="border-b border-gray-200">
                                <tr>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">ID Karyawan</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Nama Lengkap</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Email</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Jabatan</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Cabang</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Status</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="employeeTableBody">
                                <?php if (isset($employees) && count($employees) > 0): ?>
                                    <?php foreach ($employees as $emp): ?>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                            <td class="text-center py-3 px-2 text-gray-800">#KRW<?= str_pad($emp->id_karyawan, 3, '0', STR_PAD_LEFT) ?></td>
                                            <td class="text-center py-3 px-2 text-gray-800"><?= htmlspecialchars($emp->nama ?? '') ?></td>
                                            <td class="text-center py-3 px-2 text-gray-600"><?= htmlspecialchars($emp->email ?? '') ?></td>
                                            <td class="text-center py-3 px-2">
                                                <span class="<?php 
                                                    $jabatan_colors = [
                                                        'Manager' => 'bg-blue-100 text-blue-800',
                                                        'Kepala' => 'bg-yellow-100 text-yellow-800',
                                                        'Staff' => 'bg-purple-100 text-purple-800',
                                                        'Kasir' => 'bg-green-100 text-green-800',
                                            
                                                    ];
                                                    echo $jabatan_colors[$emp->jabatan ?? ''] ?? 'bg-gray-100 text-gray-800';
                                                ?> px-3 py-1 rounded-lg text-sm font-medium">
                                                    <?= htmlspecialchars($emp->jabatan ?? '-') ?>
                                                </span>
                                            </td>
                                            <td class="text-center py-3 px-2 text-gray-600"><?= htmlspecialchars($emp->nama_cabang ?? '-') ?></td>
                                            <td class="text-center py-3 px-2">
                                                <span class="<?php echo (($emp->status ?? '') === 'aktif' || ($emp->status ?? '') === 'active') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?> px-3 py-1 rounded-lg text-sm font-medium">
                                                    <?= ucfirst($emp->status ?? 'unknown') ?>
                                                </span>
                                            </td>
                                            <td class="text-center py-3 px-2">
                                                <div class="flex items-center justify-center gap-3">
                                                    <button onclick="editEmployee(<?= $emp->id_karyawan ?>)" class="text-emerald-600 hover:text-emerald-700" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button onclick="deleteEmployee(<?= $emp->id_karyawan ?>, '<?= htmlspecialchars($emp->nama ?? '') ?>')" class="text-red-600 hover:text-red-700" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-8 text-gray-500">Tidak ada data karyawan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Kelola Cabang Bisnis -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Kelola Cabang Bisnis</h2>
                        <button onclick="openAddBranchModal()" class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-emerald-300 text-white rounded-xl hover:opacity-90 transition">
                            Tambah Cabang
                        </button>
                    </div>
                    
                    <!-- Branch Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="branchContainer">
                        <?php if (isset($branches) && count($branches) > 0): ?>
                            <?php foreach ($branches as $branch): ?>
                                <div class="border border-gray-200 rounded-xl p-4">
                                    <div class="flex items-start justify-between mb-2">
                                        <h3 class="text-base font-medium text-gray-800"><?= htmlspecialchars($branch->nama_cabang) ?></h3>
                                        <span class="<?php echo ($branch->status === 'aktif' || $branch->status === 'active') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?> px-2 py-1 rounded text-xs font-medium">
                                            <?= ucfirst($branch->status ?? 'aktif') ?>
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-1"><?= htmlspecialchars($branch->alamat_cabang ?? $branch->alamat ?? '') ?></p>
                                    <p class="text-sm text-gray-600 mb-4"><?= htmlspecialchars($branch->no_telp ?? $branch->telepon ?? '') ?></p>
                                    <div class="flex gap-4">
                                        <button onclick="editBranch(<?= $branch->id_cabang ?>)" class="text-emerald-600 hover:text-emerald-700 text-sm">Edit</button>
                                        <button onclick="deleteBranch(<?= $branch->id_cabang ?>)" class="text-red-600 hover:text-red-700 text-sm">Delete</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-gray-500">Tidak ada cabang</p>
                        <?php endif; ?>
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
                                <p class="text-sm text-gray-600">Dapatkan pemberitahuan saat pesanan dilakukan atau diperbarui</p>
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
                                <option>Indonesia</option>
                                <option>English</option>
                            </select>
                        </div>
                        
                        <!-- Mata Uang -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mata Uang</label>
                            <select class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                                <option>Rupiah (Rp)</option>
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
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
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

    <!-- Modal Add/Edit Employee -->
    <div id="addEmployeeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <h2 id="modalEmployeeTitle" class="text-2xl font-semibold text-gray-800">Tambah Karyawan</h2>
            </div>
            <form id="addEmployeeForm" class="p-6">
                <input type="hidden" id="id_karyawan" value="">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Karyawan <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_karyawan" name="nama_karyawan" required placeholder="Masukkan nama karyawan"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email_karyawan" name="email_karyawan" required placeholder="contoh@email.com"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan <span class="text-red-500">*</span></label>
                        <select id="jabatan" name="jabatan" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                            <option value="Staff" selected>Staff</option>
                            <option value="Manager">Manager</option>
                            <option value="Kepala">Kepala</option>
                            <option value="Kasir">Kasir</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telepon <span class="text-red-500">*</span></label>
                        <input type="tel" id="telepon_karyawan" name="telepon_karyawan" required placeholder="08xxxxxxxxxx"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cabang <span class="text-red-500">*</span></label>
                        <select id="id_cabang" name="id_cabang" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                            <option value="">-- Pilih Cabang --</option>
                            <?php if (isset($branches) && count($branches) > 0): ?>
                                <?php foreach ($branches as $branch): ?>
                                    <option value="<?= $branch->id_cabang ?>"><?= htmlspecialchars($branch->nama_cabang) ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Tidak ada cabang tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status_karyawan" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                            <option value="aktif" selected>Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeAddEmployeeModal()" 
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" id="btnSubmitEmployee" class="flex-1 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                        Simpan Karyawan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Add/Edit Branch -->
    <div id="addBranchModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <h2 id="modalBranchTitle" class="text-2xl font-semibold text-gray-800">Tambah Cabang</h2>
            </div>
            <form id="addBranchForm" class="p-6">
                <input type="hidden" id="id_cabang_edit" value="">
                <input type="hidden" id="id_pemilik_branch" value="<?= $pemilik->id_pemilik ?>">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Cabang</label>
                        <input type="text" id="nama_cabang_edit" name="nama_cabang" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <textarea id="alamat_edit" name="alamat" required rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                        <input type="tel" id="telepon_edit" name="telepon" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status_cabang" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeAddBranchModal()" 
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                        Simpan Cabang
                    </button>
                </div>
            </form>
        </div>
    </div>

<script>
    const BASE_URL = '<?= base_url() ?>';
    
    // ============ UPDATE PROFILE FUNCTION ============
    function updateProfile() {
        const id_pemilik = $('#id_owner').val();
        const nama = $('#nama_lengkap').val();
        const email = $('#email').val();
        const telepon = $('#telepon').val();
        
        if (!nama || !email || !telepon) {
            alert('Semua field harus diisi');
            return;
        }
        
        $.ajax({
            url: BASE_URL + 'pemilik/pengaturan/update_profile',
            type: 'POST',
            data: {
                id_pemilik: id_pemilik,
                nama_lengkap: nama,
                email: email,
                telepon: telepon
            },
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response);
                alert(response.message);
                if(response.success) {
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                alert('Terjadi kesalahan: ' + error);
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
            alert('Hanya file gambar (JPG, PNG, GIF) yang diperbolehkan');
            return;
        }
        
        // Validate file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file maksimal 5MB');
            return;
        }
        
        // Show preview immediately
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePhotoDisplay').src = e.target.result;
            document.getElementById('defaultIcon').style.display = 'none';
        };
        reader.readAsDataURL(file);
        
        // Upload file
        const formData = new FormData();
        formData.append('profile_photo', file);
        formData.append('id_pemilik', $('#id_owner').val());
        
        console.log('Uploading photo with id_pemilik:', $('#id_owner').val());
        
        $.ajax({
            url: BASE_URL + 'pemilik/pengaturan/upload_photo',
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
                    alert('Foto berhasil diupload');
                    location.reload();
                } else {
                    alert(response.message || 'Gagal mengupload foto');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                alert('Terjadi kesalahan saat upload: ' + error);
            }
        });
    }

    // ============ PASSWORD FUNCTIONS ============
    function openChangePasswordModal() {
        $('#changePasswordModal').removeClass('hidden');
    }
    
    function closeChangePasswordModal() {
        $('#changePasswordModal').addClass('hidden');
        $('#changePasswordForm')[0].reset();
    }
    
    $('#changePasswordForm').on('submit', function(e) {
        e.preventDefault();
        
        const pwd_lama = $('#password_lama').val();
        const pwd_baru = $('#password_baru').val();
        const pwd_konfirmasi = $('#password_konfirmasi').val();
        
        if (!pwd_lama || !pwd_baru || !pwd_konfirmasi) {
            alert('Semua field password harus diisi');
            return;
        }
        
        if (pwd_baru !== pwd_konfirmasi) {
            alert('Password baru tidak cocok dengan konfirmasi');
            return;
        }
        
        if (pwd_baru.length < 6) {
            alert('Password minimal 6 karakter');
            return;
        }
        
        $.ajax({
            url: BASE_URL + 'pemilik/pengaturan/change_password',
            type: 'POST',
            data: {
                password_lama: pwd_lama,
                password_baru: pwd_baru
            },
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response);
                alert(response.message);
                if(response.success) {
                    closeChangePasswordModal();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });
    
    // ============ EMPLOYEE FUNCTIONS ============
    function openAddEmployeeModal() {
        $('#addEmployeeModal').removeClass('hidden');
        $('#addEmployeeForm')[0].reset();
        $('#modalEmployeeTitle').text('Tambah Karyawan');
        $('#id_karyawan').val('');
        $('#jabatan').val('Staff');
        $('#status_karyawan').val('aktif');
        $('#id_cabang').val('');
        $('#btnSubmitEmployee').prop('disabled', false).text('Simpan Karyawan');
    }
    
    function closeAddEmployeeModal() {
        $('#addEmployeeModal').addClass('hidden');
        $('#addEmployeeForm')[0].reset();
    }
    
    function editEmployee(id) {
        $.ajax({
            url: BASE_URL + 'pemilik/pengaturan/get_employee/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    const emp = response.data;
                    $('#modalEmployeeTitle').text('Edit Karyawan');
                    $('#id_karyawan').val(emp.id_karyawan);
                    $('#nama_karyawan').val(emp.nama);
                    $('#email_karyawan').val(emp.email);
                    $('#jabatan').val(emp.jabatan);
                    $('#telepon_karyawan').val(emp.no_telp);
                    $('#id_cabang').val(emp.id_cabang);
                    $('#status_karyawan').val(emp.status);
                    $('#addEmployeeModal').removeClass('hidden');
                }
            },
            error: function() {
                alert('Gagal mengambil data karyawan');
            }
        });
    }
    
    $('#addEmployeeForm').on('submit', function(e){
        e.preventDefault();
        
        const id_karyawan = $('#id_karyawan').val();
        const nama = $('#nama_karyawan').val().trim();
        const email = $('#email_karyawan').val().trim();
        const jabatan = $('#jabatan').val();
        const telepon = $('#telepon_karyawan').val().trim();
        const id_cabang = $('#id_cabang').val();
        const status = $('#status_karyawan').val();
        
        console.log('Form data:', {nama, email, jabatan, telepon, id_cabang, status});
        
        // Validasi
        if (!nama) {
            alert('Nama karyawan harus diisi');
            $('#nama_karyawan').focus();
            return;
        }
        if (!email) {
            alert('Email harus diisi');
            $('#email_karyawan').focus();
            return;
        }
        if (!telepon) {
            alert('Telepon harus diisi');
            $('#telepon_karyawan').focus();
            return;
        }
        if (!id_cabang) {
            alert('Cabang harus dipilih');
            $('#id_cabang').focus();
            return;
        }
        
        // Disable button untuk mencegah double submit
        $('#btnSubmitEmployee').prop('disabled', true).text('Menyimpan...');
        
        let url, data;
        
        if (id_karyawan) {
            // Update
            url = BASE_URL + 'pemilik/pengaturan/update_employee';
            data = {
                id_karyawan: id_karyawan,
                nama_karyawan: nama,
                email_karyawan: email,
                jabatan: jabatan,
                telepon_karyawan: telepon,
                status: status
            };
        } else {
            // Add
            url = BASE_URL + 'pemilik/pengaturan/add_employee';
            data = {
                nama_karyawan: nama,
                email_karyawan: email,
                jabatan: jabatan,
                telepon_karyawan: telepon,
                id_cabang: id_cabang,
                status: status
            };
        }
        
        console.log('Sending to:', url, 'Data:', data);
        
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response);
                $('#btnSubmitEmployee').prop('disabled', false).text('Simpan Karyawan');
                
                if (response.success) {
                    if (response.username && response.password) {
                        alert('Karyawan berhasil ditambahkan!\n\nUsername: ' + response.username + '\nPassword: ' + response.password + '\n\nSimpan informasi ini!');
                    } else {
                        alert(response.message);
                    }
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                $('#btnSubmitEmployee').prop('disabled', false).text('Simpan Karyawan');
                
                // Coba parse response jika berupa JSON
                try {
                    const resp = JSON.parse(xhr.responseText);
                    alert('Gagal: ' + (resp.message || error));
                } catch(e) {
                    alert('Terjadi kesalahan: ' + error + '\n' + xhr.responseText);
                }
            }
        });
    });
    
    function deleteEmployee(id, nama) {
        if(confirm('Apakah Anda yakin ingin menghapus karyawan ' + nama + '?')) {
            $.ajax({
                url: BASE_URL + 'pemilik/pengaturan/delete_employee',
                type: 'POST',
                data: { id_karyawan: id },
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    if(response.success) {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        }
    }
    
    // ============ BRANCH FUNCTIONS ============
    function openAddBranchModal() {
        $('#addBranchModal').removeClass('hidden');
        $('#addBranchForm')[0].reset();
        $('#modalBranchTitle').text('Tambah Cabang');
        $('#id_cabang_edit').val('');
        $('#status_cabang').val('aktif');
    }
    
    function closeAddBranchModal() {
        $('#addBranchModal').addClass('hidden');
    }
    
    function editBranch(id) {
        $.ajax({
            url: BASE_URL + 'pemilik/pengaturan/get_branch/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    const branch = response.data;
                    $('#modalBranchTitle').text('Edit Cabang');
                    $('#id_cabang_edit').val(branch.id_cabang);
                    $('#nama_cabang_edit').val(branch.nama_cabang);
                    $('#alamat_edit').val(branch.alamat_cabang || branch.alamat);
                    $('#telepon_edit').val(branch.no_telp || branch.telepon);
                    $('#status_cabang').val(branch.status);
                    $('#addBranchModal').removeClass('hidden');
                }
            },
            error: function() {
                alert('Gagal mengambil data cabang');
            }
        });
    }
    
    $('#addBranchForm').on('submit', function(e) {
        e.preventDefault();
        
        const id_cabang = $('#id_cabang_edit').val();
        const nama = $('#nama_cabang_edit').val();
        const alamat = $('#alamat_edit').val();
        const telepon = $('#telepon_edit').val();
        const status = $('#status_cabang').val();
        const id_pemilik = $('#id_pemilik_branch').val();
        
        if (!nama || !alamat || !telepon) {
            alert('Semua field harus diisi');
            return;
        }
        
        let url, data;
        
        if (id_cabang) {
            // Update
            url = BASE_URL + 'pemilik/pengaturan/update_branch';
            data = {
                id_cabang: id_cabang,
                nama_cabang: nama,
                alamat: alamat,
                telepon: telepon,
                status: status
            };
        } else {
            // Add
            url = BASE_URL + 'pemilik/pengaturan/add_branch';
            data = {
                id_pemilik: id_pemilik,
                nama_cabang: nama,
                alamat: alamat,
                telepon: telepon,
                status: status
            };
        }
        
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response);
                alert(response.message);
                if(response.success) {
                    closeAddBranchModal();
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });
    
    function deleteBranch(id) {
        if(confirm('Apakah Anda yakin ingin menghapus cabang ini?')) {
            $.ajax({
                url: BASE_URL + 'pemilik/pengaturan/delete_branch',
                type: 'POST',
                data: { id_cabang: id },
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    if(response.success) {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        }
    }
</script>
</body>
</html>