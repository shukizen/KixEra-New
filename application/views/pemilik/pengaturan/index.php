<!DOCTYPE html>
<html lang="id">
<head>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        
        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Pengaturan Profile -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Pengaturan Profile</h2>
                    
                    <!-- Photo Section -->
                    <div class="flex items-center gap-6 mb-8">
                        <div class="w-16 h-16 bg-emerald-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                        <button class="px-6 py-2 border border-emerald-600 text-emerald-600 rounded-xl hover:bg-emerald-50 transition">
                            Ubah Foto
                        </button>
                    </div>
                    
                    <!-- Form Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" value="Syafrudin" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" value="Syafrudin@kixera.com" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                        </div>
                        
                        <!-- Telephone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Telephone</label>
                            <input type="tel" value="+62 812-3456-7890" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500">
                        </div>
                        
                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <button class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-500 hover:bg-gray-50 text-center transition">
                                Change Password
                            </button>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-300 text-white rounded-xl hover:opacity-90 transition font-medium">
                            Simpan Perubahan
                        </button>
                        <button class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition font-medium">
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
                        <button class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-emerald-300 text-white rounded-xl hover:opacity-90 transition flex items-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Tambah Akun Karyawan</span>
                        </button>
                    </div>
                    
                    <!-- Employee Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="border-b border-gray-200">
                                <tr>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">ID Karyawan</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Nama Lengkap</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Email</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Role</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Cabang</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Status</th>
                                    <th class="text-center py-3 px-2 text-gray-700 text-base font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 -->
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="text-center py-3 px-2 text-gray-800">#KRW001</td>
                                    <td class="text-center py-3 px-2 text-gray-800">Yanto</td>
                                    <td class="text-center py-3 px-2 text-gray-600">yanto@kixera.sf.ac.id</td>
                                    <td class="text-center py-3 px-2">
                                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-lg text-sm">Staff</span>
                                    </td>
                                    <td class="text-center py-3 px-2 text-gray-600">Kota Gede</td>
                                    <td class="text-center py-3 px-2">
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-lg text-sm">Active</span>
                                    </td>
                                    <td class="text-center py-3 px-2">
                                        <div class="flex items-center justify-center gap-3">
                                            <button class="text-emerald-600 hover:text-emerald-700" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-700" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Row 2 -->
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="text-center py-3 px-2 text-gray-800">#KRW002</td>
                                    <td class="text-center py-3 px-2 text-gray-800">Naila</td>
                                    <td class="text-center py-3 px-2 text-gray-600">naila@kixera.sf.ac.id</td>
                                    <td class="text-center py-3 px-2">
                                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-lg text-sm">Staff</span>
                                    </td>
                                    <td class="text-center py-3 px-2 text-gray-600">Seturan</td>
                                    <td class="text-center py-3 px-2">
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-lg text-sm">Active</span>
                                    </td>
                                    <td class="text-center py-3 px-2">
                                        <div class="flex items-center justify-center gap-3">
                                            <button class="text-emerald-600 hover:text-emerald-700" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-700" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Kelola Cabang Bisnis -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Kelola Cabang Bisnis</h2>
                        <button class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-emerald-300 text-white rounded-xl hover:opacity-90 transition">
                            Tambah Cabang
                        </button>
                    </div>
                    
                    <!-- Branch Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Branch 1 -->
                        <div class="border border-gray-200 rounded-xl p-4">
                            <h3 class="text-base font-medium text-gray-800 mb-2">Kota Gede</h3>
                            <p class="text-sm text-gray-600 mb-1">Jl. Kemasan No. 45, Yogyakarta</p>
                            <p class="text-sm text-gray-600 mb-4">+62 274-123-4567</p>
                            <div class="flex gap-4">
                                <button class="text-emerald-600 hover:text-emerald-700 text-sm">Edit</button>
                                <button class="text-red-600 hover:text-red-700 text-sm">Delete</button>
                            </div>
                        </div>
                        
                        <!-- Branch 2 -->
                        <div class="border border-gray-200 rounded-xl p-4">
                            <h3 class="text-base font-medium text-gray-800 mb-2">Seturan</h3>
                            <p class="text-sm text-gray-600 mb-1">Jl. Seturan Raya No. 12, Sleman</p>
                            <p class="text-sm text-gray-600 mb-4">+62 274-234-5678</p>
                            <div class="flex gap-4">
                                <button class="text-emerald-600 hover:text-emerald-700 text-sm">Edit</button>
                                <button class="text-red-600 hover:text-red-700 text-sm">Delete</button>
                            </div>
                        </div>
                        
                        <!-- Branch 3 -->
                        <div class="border border-gray-200 rounded-xl p-4">
                            <h3 class="text-base font-medium text-gray-800 mb-2">Condongcatur</h3>
                            <p class="text-sm text-gray-600 mb-1">Jl. Condongcatur No. 78, Sleman</p>
                            <p class="text-sm text-gray-600 mb-4">+62 274-345-6789</p>
                            <div class="flex gap-4">
                                <button class="text-emerald-600 hover:text-emerald-700 text-sm">Edit</button>
                                <button class="text-red-600 hover:text-red-700 text-sm">Delete</button>
                            </div>
                        </div>
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
</body>
</html>