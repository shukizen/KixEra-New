<!-- Main Content -->
<main class="flex-1 lg:ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <!-- Left: Title + Badge -->
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-semibold text-gray-800">Manajemen Pengguna</h1>
                <div class="bg-emerald-100 px-4 py-1 rounded-full">
                    <span class="text-emerald-700 text-sm font-medium" id="totalBadge"><?= $stats['total'] ?> Total Pengguna</span>
                </div>
            </div>

            <!-- Right: Search + Add Button -->
            <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                <!-- Search Bar -->
                <div class="relative flex-1 md:w-80">
                    <input type="text" id="searchInput" placeholder="Cari username, nama, atau email..."
                        class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>

                <!-- Add User Button -->
                <button onclick="openAddModal()" class="bg-emerald-500 text-white px-6 py-2 rounded-xl hover:bg-emerald-600 transition flex items-center justify-center gap-2">
                    <i class="fas fa-user-plus"></i>
                    <span>Tambah Pengguna</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Dashboard Content -->
    <div class="p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <!-- Total Users -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                        <h3 id="stat-total" class="text-3xl font-bold text-gray-800 mt-2"><?= $stats['total'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-blue-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Active Users -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Pengguna Aktif</p>
                        <h3 id="stat-active" class="text-3xl font-bold text-green-600 mt-2"><?= $stats['active'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Admins -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Admin</p>
                        <h3 id="stat-admins" class="text-3xl font-bold text-blue-600 mt-2"><?= $stats['admins'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-shield text-blue-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Owners -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pemilik</p>
                        <h3 id="stat-owners" class="text-3xl font-bold text-emerald-600 mt-2"><?= $stats['owners'] ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-store text-emerald-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white rounded-2xl shadow-lg mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex flex-wrap -mb-px px-6">
                    <button onclick="filterByTab('all')" id="tab-all"
                        class="tab-button py-4 px-6 border-b-2 border-emerald-500 text-emerald-600 font-medium text-sm">
                        Semua Pengguna
                    </button>
                    <button onclick="filterByTab('admin')" id="tab-admin"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Admin
                    </button>
                    <button onclick="filterByTab('owner')" id="tab-owner"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Pemilik
                    </button>
                    <button onclick="filterByTab('aktif')" id="tab-aktif"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Aktif
                    </button>
                    <button onclick="filterByTab('nonaktif')" id="tab-nonaktif"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Nonaktif
                    </button>
                </nav>
            </div>

            <!-- User Table -->
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="border-b border-gray-200">
                            <tr>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">ID</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Username</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Nama Lengkap</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Email</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Role</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Status</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <tr>
                                <td colspan="7" class="text-center py-8 text-gray-500">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal Add/Edit User -->
<div id="userModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 id="modalTitle" class="text-xl font-semibold text-gray-800">Tambah Pengguna Baru</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form id="userForm">
            <input type="hidden" id="userId" name="id_user">
            <div class="p-6 space-y-4">
                <!-- Role Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role <span class="text-red-500">*</span></label>
                    <select id="role" name="role" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="owner">Pemilik Usaha</option>
                    </select>
                </div>

                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username <span class="text-red-500">*</span></label>
                    <input type="text" id="username" name="username" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                </div>

                <!-- Password -->
                <div id="passwordField">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password <span class="text-red-500" id="passwordRequired">*</span></label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    <p class="text-xs text-gray-500 mt-1" id="passwordHint">Min. 6 karakter</p>
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="nama" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                </div>

                <!-- No Telepon -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                    <input type="tel" id="no_telp" name="no_telp"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                </div>

                <!-- Owner-specific fields (hidden by default) -->
                <div id="ownerFields" class="hidden space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Usaha</label>
                        <input type="text" id="nama_usaha" name="nama_usaha"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Usaha</label>
                        <textarea id="alamat_usaha" name="alamat_usaha" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"></textarea>
                    </div>
                </div>
            </div>
            <div class="flex gap-3 p-6 border-t">
                <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal View User Details -->
<div id="viewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-800">Detail Pengguna</h3>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="viewContent" class="p-6">
            <!-- Content will be loaded dynamically -->
        </div>
        <div class="flex gap-3 p-6 border-t">
            <button onclick="closeViewModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Modal Delete Confirmation (Simple Style like Pelanggan) -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4">
        <div class="p-6 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-100 flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-3xl text-red-500"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-600 mb-2">Apakah Anda yakin ingin menghapus pengguna:</p>
            <p id="deleteUsername" class="text-lg font-semibold text-red-500 mb-6"></p>
        </div>
        <div class="flex gap-3 p-6 border-t border-gray-200">
            <button onclick="closeDeleteModal()" class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition font-medium">
                Batal
            </button>
            <button id="confirmDeleteBtn" class="flex-1 px-4 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition font-medium">
                <i class="fas fa-trash mr-2"></i>Hapus
            </button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const BASE_URL = '<?= base_url() ?>';
let currentFilter = { role: '', status: '', search: '' };
let deleteUserId = null;

// Initialize
$(document).ready(function() {
    loadUsers();
    setupEventListeners();
});

function setupEventListeners() {
    // Search with debounce
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            currentFilter.search = $('#searchInput').val();
            loadUsers();
        }, 300);
    });
    
    // Role change event
    $('#role').on('change', function() {
        toggleOwnerFields();
    });
    
    // Form submit
    $('#userForm').on('submit', function(e) {
        e.preventDefault();
        submitForm();
    });
}

function toggleOwnerFields() {
    const role = $('#role').val();
    if (role === 'owner') {
        $('#ownerFields').removeClass('hidden');
    } else {
        $('#ownerFields').addClass('hidden');
    }
}

function filterByTab(tab) {
    // Update tab styling
    $('.tab-button').removeClass('border-emerald-500 text-emerald-600').addClass('border-transparent text-gray-500');
    $('#tab-' + tab).removeClass('border-transparent text-gray-500').addClass('border-emerald-500 text-emerald-600');
    
    // Set filter
    if (tab === 'all') {
        currentFilter.role = '';
        currentFilter.status = '';
    } else if (tab === 'admin' || tab === 'owner') {
        currentFilter.role = tab;
        currentFilter.status = '';
    } else {
        currentFilter.role = '';
        currentFilter.status = tab;
    }
    
    loadUsers();
}

function loadUsers() {
    $.ajax({
        url: BASE_URL + 'admin/user_management/get_users',
        type: 'GET',
        data: currentFilter,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                updateTable(response.data);
                updateStats();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading users:', error);
            showNotification('Gagal memuat data pengguna', 'error');
        }
    });
}

function updateTable(users) {
    let html = '';
    
    if (users.length > 0) {
        users.forEach(user => {
            const roleBadge = user.role === 'admin' 
                ? '<span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Admin</span>'
                : '<span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">Pemilik</span>';
            
            const statusBadge = user.status === 'aktif'
                ? '<span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Aktif</span>'
                : '<span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Nonaktif</span>';
            
            html += `
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-4 px-4 text-center text-gray-700">#U${String(user.id_user).padStart(3, '0')}</td>
                    <td class="py-4 px-4 text-center text-gray-800 font-medium">${user.username}</td>
                    <td class="py-4 px-4 text-center text-gray-700">${user.nama_lengkap || '-'}</td>
                    <td class="py-4 px-4 text-center text-gray-700">${user.email || '-'}</td>
                    <td class="py-4 px-4 text-center">${roleBadge}</td>
                    <td class="py-4 px-4 text-center">${statusBadge}</td>
                    <td class="py-4 px-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="viewUser(${user.id_user})" class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-lg flex items-center justify-center transition" title="Detail">
                                <i class="fas fa-eye text-sm"></i>
                            </button>
                            <button onclick="editUser(${user.id_user})" class="w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg flex items-center justify-center transition" title="Edit">
                                <i class="fas fa-edit text-sm"></i>
                            </button>
                            <button onclick="toggleStatus(${user.id_user})" class="w-8 h-8 ${user.status === 'aktif' ? 'bg-yellow-100 hover:bg-yellow-200 text-yellow-600' : 'bg-green-100 hover:bg-green-200 text-green-600'} rounded-lg flex items-center justify-center transition" title="${user.status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan'}">
                                <i class="fas fa-${user.status === 'aktif' ? 'ban' : 'check'} text-sm"></i>
                            </button>
                            <button onclick="deleteUser(${user.id_user}, '${user.username}')" class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition" title="Hapus">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
    } else {
        html = '<tr><td colspan="7" class="text-center py-8 text-gray-500">Tidak ada data pengguna</td></tr>';
    }
    
    $('#userTableBody').html(html);
}

function updateStats() {
    $.ajax({
        url: BASE_URL + 'admin/user_management/get_users',
        type: 'GET',
        data: { role: '', status: '', search: '' },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const users = response.data;
                const total = users.length;
                const active = users.filter(u => u.status === 'aktif').length;
                const admins = users.filter(u => u.role === 'admin').length;
                const owners = users.filter(u => u.role === 'owner').length;
                
                $('#stat-total').text(total);
                $('#stat-active').text(active);
                $('#stat-admins').text(admins);
                $('#stat-owners').text(owners);
                $('#totalBadge').text(total + ' Total Pengguna');
            }
        }
    });
}

function openAddModal() {
    $('#modalTitle').text('Tambah Pengguna Baru');
    $('#userForm')[0].reset();
    $('#userId').val('');
    $('#role').prop('disabled', false);
    $('#password').prop('required', true);
    $('#passwordRequired').show();
    $('#passwordHint').text('Min. 6 karakter');
    $('#ownerFields').addClass('hidden');
    $('#userModal').removeClass('hidden');
}

function closeModal() {
    $('#userModal').addClass('hidden');
}

function viewUser(id) {
    $.ajax({
        url: BASE_URL + 'admin/user_management/get_user/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const user = response.data;
                let html = `
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID:</span>
                            <span class="font-medium">#U${String(user.id_user).padStart(3, '0')}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Username:</span>
                            <span class="font-medium">${user.username}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama:</span>
                            <span class="font-medium">${user.nama_lengkap || '-'}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span class="font-medium">${user.email || '-'}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">No. Telp:</span>
                            <span class="font-medium">${user.no_telp || '-'}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Role:</span>
                            <span class="font-medium">${user.role === 'admin' ? 'Admin' : 'Pemilik Usaha'}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="font-medium">${user.status === 'aktif' ? 'Aktif' : 'Nonaktif'}</span>
                        </div>
                        ${user.role === 'owner' && user.nama_usaha ? `
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama Usaha:</span>
                            <span class="font-medium">${user.nama_usaha}</span>
                        </div>
                        ` : ''}
                        ${user.role === 'owner' && user.alamat_usaha ? `
                        <div>
                            <span class="text-gray-600 block mb-1">Alamat Usaha:</span>
                            <p class="text-sm text-gray-800">${user.alamat_usaha}</p>
                        </div>
                        ` : ''}
                    </div>
                `;
                
                $('#viewContent').html(html);
                $('#viewModal').removeClass('hidden');
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function() {
            showNotification('Gagal memuat detail pengguna', 'error');
        }
    });
}

function closeViewModal() {
    $('#viewModal').addClass('hidden');
}

function editUser(id) {
    $.ajax({
        url: BASE_URL + 'admin/user_management/get_user/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const user = response.data;
                $('#modalTitle').text('Edit Pengguna');
                $('#userId').val(user.id_user);
                $('#username').val(user.username);
                $('#password').val('').prop('required', false);
                $('#passwordRequired').hide();
                $('#passwordHint').text('Kosongkan jika tidak ingin mengubah password');
                $('#nama').val(user.nama_lengkap || '');
                $('#email').val(user.email || '');
                $('#no_telp').val(user.no_telp || '');
                $('#role').val(user.role).prop('disabled', true);
                
                if (user.role === 'owner') {
                    $('#nama_usaha').val(user.nama_usaha || '');
                    $('#alamat_usaha').val(user.alamat_usaha || '');
                    $('#ownerFields').removeClass('hidden');
                }
                
                $('#userModal').removeClass('hidden');
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function() {
            showNotification('Gagal memuat data pengguna', 'error');
        }
    });
}

function submitForm() {
    const userId = $('#userId').val();
    const url = userId 
        ? BASE_URL + 'admin/user_management/update/' + userId
        : BASE_URL + 'admin/user_management/create';
    
    const formData = $('#userForm').serialize();
    
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification(response.message, 'success');
                closeModal();
                loadUsers();
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function() {
            showNotification('Terjadi kesalahan saat menyimpan data', 'error');
        }
    });
}

function deleteUser(id, username) {
    deleteUserId = id;
    $('#deleteUsername').text(username);
    $('#deleteModal').removeClass('hidden');
}

function closeDeleteModal() {
    $('#deleteModal').addClass('hidden');
    deleteUserId = null;
}

$('#confirmDeleteBtn').on('click', function() {
    if (deleteUserId) {
        $.ajax({
            url: BASE_URL + 'admin/user_management/delete/' + deleteUserId,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    closeDeleteModal();
                    loadUsers();
                } else {
                    showNotification(response.message, 'error');
                }
            },
            error: function() {
                showNotification('Gagal menghapus pengguna', 'error');
            }
        });
    }
});

function toggleStatus(id) {
    $.ajax({
        url: BASE_URL + 'admin/user_management/toggle_status/' + id,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification(response.message, 'success');
                loadUsers();
            } else {
                showNotification(response.message, 'error');
            }
        },
        error: function() {
            showNotification('Gagal mengubah status pengguna', 'error');
        }
    });
}

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
</script>

<style>
@keyframes slide-in {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-slide-in {
    animation: slide-in 0.3s ease-out;
}
</style>
