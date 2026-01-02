<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Profil Usaha - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .upload-area { transition: all 0.3s ease; }
        .upload-area:hover { border-color: #10b981; background-color: #f0fdf4; }
        select { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e"); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-white to-emerald-50 min-h-screen py-8 px-4">
    <div class="max-w-xl mx-auto">
        <!-- Progress -->
        <div class="mb-8">
            <div class="flex items-center justify-center gap-3 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs font-bold">✓</div>
                    <span class="text-gray-400 hidden sm:inline">Registrasi</span>
                </div>
                <div class="w-8 h-0.5 bg-emerald-500"></div>
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs font-bold">✓</div>
                    <span class="text-gray-400 hidden sm:inline">Verifikasi</span>
                </div>
                <div class="w-8 h-0.5 bg-emerald-500"></div>
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs font-bold">3</div>
                    <span class="font-semibold text-emerald-600">Profil Usaha</span>
                </div>
            </div>
        </div>
        
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-slate-800 to-slate-900">
                <h1 class="text-xl font-bold text-white">Selamat Datang di KixEra! 🎉</h1>
                <p class="text-slate-300 text-sm mt-1">Lengkapi informasi usaha Anda untuk memulai</p>
            </div>
            
            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('error')): ?>
            <div class="mx-6 mt-4 p-3 rounded-lg bg-red-50 text-red-700 text-sm">
                <?= $this->session->flashdata('error') ?>
            </div>
            <?php endif; ?>
            
            <!-- Form -->
            <form action="<?= base_url('auth/save_profile') ?>" method="POST" enctype="multipart/form-data" class="p-6">
                
                <!-- Logo Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo Usaha <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <div class="flex items-center gap-4">
                        <div id="logoPreview" class="w-20 h-20 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white text-2xl font-bold shadow-md flex-shrink-0">
                            <?= strtoupper(substr($pemilik->nama_usaha ?? 'K', 0, 1)) ?>
                        </div>
                        <div class="flex-1">
                            <label class="upload-area block w-full p-3 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer text-center hover:border-emerald-400">
                                <input type="file" name="logo" id="logoInput" accept="image/*" class="hidden">
                                <span class="text-sm text-gray-500">Klik untuk upload</span>
                                <span class="block text-xs text-gray-400">PNG, JPG max 2MB</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Nama Usaha (Display Only) -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Usaha</label>
                    <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-700">
                        <?= htmlspecialchars($pemilik->nama_usaha ?? '-') ?>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Ubah di menu Pengaturan nanti</p>
                </div>
                
                <!-- Alamat Lengkap -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Usaha <span class="text-red-400">*</span></label>
                    <textarea name="alamat" rows="2" required
                              placeholder="Contoh: Jl. Malioboro No. 123, Gedongtengen"
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-200 focus:border-emerald-500 transition-all resize-none text-sm"><?= htmlspecialchars($pemilik->alamat ?? '') ?></textarea>
                </div>
                
                <!-- Provinsi (Dropdown) -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi <span class="text-red-400">*</span></label>
                    <select name="provinsi" id="provinsiSelect" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-200 focus:border-emerald-500 transition-all text-sm bg-white appearance-none pr-10">
                        <option value="">-- Pilih Provinsi --</option>
                    </select>
                    <input type="hidden" name="provinsi_code" id="provinsiCode" value="<?= htmlspecialchars($pemilik->provinsi_code ?? '') ?>">
                </div>
                
                <!-- Kota/Kabupaten (Dropdown - cascading) -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten <span class="text-red-400">*</span></label>
                    <select name="kota" id="kotaSelect" required disabled
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-200 focus:border-emerald-500 transition-all text-sm bg-white appearance-none pr-10 disabled:bg-gray-100 disabled:cursor-not-allowed">
                        <option value="">-- Pilih Provinsi Dulu --</option>
                    </select>
                    <input type="hidden" name="kota_code" id="kotaCode" value="<?= htmlspecialchars($pemilik->kota_code ?? '') ?>">
                </div>
                
                <!-- Jam Operasional -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional</label>
                    <div class="flex gap-2 items-center">
                        <input type="time" name="jam_buka" 
                               value="<?= htmlspecialchars($pemilik->jam_buka ?? '08:00') ?>"
                               class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-200 focus:border-emerald-500 transition-all text-sm">
                        <span class="text-gray-400 text-sm">s/d</span>
                        <input type="time" name="jam_tutup" 
                               value="<?= htmlspecialchars($pemilik->jam_tutup ?? '21:00') ?>"
                               class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-200 focus:border-emerald-500 transition-all text-sm">
                    </div>
                </div>
                
                <!-- Info Box -->
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-xl">
                    <div class="flex gap-3">
                        <div class="text-emerald-500 text-xl">💡</div>
                        <div class="text-sm">
                            <p class="font-medium text-emerald-800">Anda bisa melengkapi nanti</p>
                            <p class="text-emerald-600 mt-1">Layanan, harga, dan pengaturan lainnya bisa dikonfigurasi setelah masuk ke Dashboard.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex gap-3">
                    <a href="<?= base_url('pemilik/pemilik_dashboard') ?>" 
                       class="flex-1 py-3 px-4 border border-gray-200 text-gray-500 rounded-xl font-medium text-center hover:bg-gray-50 transition-all text-sm">
                        Lewati
                    </a>
                    <button type="submit" 
                            class="flex-[2] py-3 px-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-xl font-semibold hover:from-emerald-600 hover:to-teal-600 transition-all focus:ring-4 focus:ring-emerald-200 text-sm">
                        Simpan & Mulai →
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Trial Info -->
        <div class="mt-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 border border-amber-200 rounded-full">
                <span class="text-amber-500">⏰</span>
                <span class="text-sm text-amber-700">Trial gratis <strong>7 hari</strong> dimulai sekarang</span>
            </div>
        </div>
        
        <!-- Footer -->
        <p class="text-center text-gray-400 text-xs mt-4">
            &copy; <?= date('Y') ?> KixEra • Sistem Manajemen Laundry Sepatu
        </p>
    </div>
    
    <script>
        // Location data
        let provinsiData = [];
        let kabupatenData = {};
        
        // Existing values (for edit mode)
        const existingProvinsi = '<?= htmlspecialchars($pemilik->provinsi ?? '') ?>';
        const existingKota = '<?= htmlspecialchars($pemilik->kota ?? '') ?>';
        const existingProvinsiCode = '<?= htmlspecialchars($pemilik->provinsi_code ?? '') ?>';
        
        // Load data on page load
        async function loadLocationData() {
            try {
                const [provRes, kabRes] = await Promise.all([
                    fetch('<?= base_url('assets/data/provinsi.json') ?>'),
                    fetch('<?= base_url('assets/data/kabupaten.json') ?>')
                ]);
                
                provinsiData = await provRes.json();
                kabupatenData = await kabRes.json();
                
                populateProvinsi();
            } catch (error) {
                console.error('Failed to load location data:', error);
            }
        }
        
        function populateProvinsi() {
            const select = document.getElementById('provinsiSelect');
            select.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
            
            provinsiData.forEach(prov => {
                const option = document.createElement('option');
                option.value = prov.name;
                option.dataset.code = prov.code;
                option.textContent = prov.name;
                
                // Select if matches existing
                if (existingProvinsi && prov.name === existingProvinsi) {
                    option.selected = true;
                }
                
                select.appendChild(option);
            });
            
            // If there's existing provinsi, populate kota
            if (existingProvinsiCode) {
                populateKota(existingProvinsiCode);
            }
        }
        
        function populateKota(provinsiCode) {
            const select = document.getElementById('kotaSelect');
            const cities = kabupatenData[provinsiCode] || [];
            
            select.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
            select.disabled = cities.length === 0;
            
            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.name;
                option.dataset.code = city.code;
                option.textContent = city.name;
                
                // Select if matches existing
                if (existingKota && city.name === existingKota) {
                    option.selected = true;
                }
                
                select.appendChild(option);
            });
        }
        
        // Event listeners
        document.getElementById('provinsiSelect').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            const code = selected.dataset.code || '';
            
            document.getElementById('provinsiCode').value = code;
            document.getElementById('kotaSelect').innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
            document.getElementById('kotaCode').value = '';
            
            if (code) {
                populateKota(code);
            } else {
                document.getElementById('kotaSelect').disabled = true;
            }
        });
        
        document.getElementById('kotaSelect').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            document.getElementById('kotaCode').value = selected.dataset.code || '';
        });
        
        // Logo preview
        document.getElementById('logoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB');
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('logoPreview');
                    preview.innerHTML = '';
                    preview.style.background = 'none';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-full object-cover rounded-xl';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
        
        // Initialize
        loadLocationData();
    </script>
</body>
</html>
