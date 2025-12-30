<!-- Main Content -->
<main class="flex-1 lg:ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <!-- Left: Title -->
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-semibold text-gray-800">Backup & Restore</h1>
                <div class="bg-yellow-100 px-4 py-1 rounded-full">
                    <span class="text-yellow-700 text-sm font-medium">Database Management</span>
                </div>
            </div>

            <!-- Right: Create Backup Button -->
            <button onclick="createBackup()" class="bg-emerald-500 text-white px-6 py-2 rounded-xl hover:bg-emerald-600 transition flex items-center gap-2">
                <i class="fas fa-plus"></i>
                <span>Buat Backup</span>
            </button>
        </div>
    </header>

    <!-- Dashboard Content -->
    <div class="p-6">
        <!-- Warning Alert -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6 flex items-start gap-3">
            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-yellow-600"></i>
            </div>
            <div>
                <h4 class="text-yellow-800 font-semibold">Perhatian!</h4>
                <p class="text-yellow-700 text-sm">Restore database akan menimpa data yang ada. Pastikan Anda memiliki backup terbaru sebelum melakukan restore. Operasi ini tidak dapat dibatalkan.</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Database Size -->
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 p-5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-database text-blue-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Ukuran Database</p>
                        <h3 class="text-2xl font-bold text-blue-600"><?= $stats['database_size'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Table Count -->
            <div class="bg-white rounded-2xl shadow-lg border border-purple-100 p-5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-table text-purple-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Tabel</p>
                        <h3 class="text-2xl font-bold text-purple-600"><?= $stats['table_count'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Backup Count -->
            <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-archive text-green-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Backup</p>
                        <h3 class="text-2xl font-bold text-green-600"><?= $stats['backup_count'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Backup Size -->
            <div class="bg-white rounded-2xl shadow-lg border border-orange-100 p-5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-hdd text-orange-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Ukuran Backup</p>
                        <h3 class="text-2xl font-bold text-orange-600"><?= $stats['backup_size'] ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Backup Card -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-upload text-cyan-500"></i> Upload Backup
            </h3>
            <div class="flex flex-col md:flex-row items-center gap-4">
                <div class="flex-1 w-full">
                    <input type="file" id="backupFile" accept=".sql" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                <button onclick="uploadBackup()" class="bg-cyan-500 text-white px-6 py-3 rounded-xl hover:bg-cyan-600 transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Upload File</span>
                </button>
            </div>
            <p class="text-gray-500 text-sm mt-2">Format yang didukung: .sql (max 50MB)</p>
        </div>

        <!-- Backup List -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-list text-emerald-500"></i> Daftar Backup
                </h3>
                <button onclick="refreshBackups()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full" id="backupTable">
                    <thead class="border-b-2 border-gray-100">
                        <tr>
                            <th class="text-left py-3 px-4 text-gray-600 font-semibold">Nama File</th>
                            <th class="text-center py-3 px-4 text-gray-600 font-semibold">Ukuran</th>
                            <th class="text-center py-3 px-4 text-gray-600 font-semibold">Tanggal</th>
                            <th class="text-center py-3 px-4 text-gray-600 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="backupList">
                        <?php if (!empty($backups)): ?>
                            <?php foreach ($backups as $backup): ?>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-file-code text-emerald-500"></i>
                                        </div>
                                        <span class="text-gray-800 font-medium"><?= $backup->filename ?></span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-center text-gray-600"><?= formatSize($backup->size) ?></td>
                                <td class="py-3 px-4 text-center text-gray-600"><?= date('d M Y H:i', strtotime($backup->created_at)) ?></td>
                                <td class="py-3 px-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="<?= base_url('admin/backup_restore/download/' . $backup->filename) ?>" 
                                           class="bg-blue-100 text-blue-600 px-3 py-2 rounded-lg hover:bg-blue-200 transition" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <button onclick="confirmRestore('<?= $backup->filename ?>')" 
                                                class="bg-green-100 text-green-600 px-3 py-2 rounded-lg hover:bg-green-200 transition" title="Restore">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                        <button onclick="confirmDelete('<?= $backup->filename ?>')" 
                                                class="bg-red-100 text-red-600 px-3 py-2 rounded-lg hover:bg-red-200 transition" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                                        <p>Belum ada backup</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Restore Confirmation Modal -->
<div id="restoreModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Restore</h3>
            <p class="text-gray-600">Apakah Anda yakin ingin restore database dari:</p>
            <p class="text-emerald-600 font-semibold mt-2" id="restoreFilename"></p>
            <p class="text-red-500 text-sm mt-2"><i class="fas fa-warning"></i> Data saat ini akan ditimpa!</p>
        </div>
        <div class="flex gap-3">
            <button onclick="closeRestoreModal()" class="flex-1 bg-gray-100 text-gray-700 px-4 py-3 rounded-xl hover:bg-gray-200 transition font-medium">
                Batal
            </button>
            <button onclick="executeRestore()" class="flex-1 bg-green-500 text-white px-4 py-3 rounded-xl hover:bg-green-600 transition font-medium">
                <i class="fas fa-undo mr-2"></i>Ya, Restore
            </button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-trash text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Hapus Backup</h3>
            <p class="text-gray-600">Apakah Anda yakin ingin menghapus backup:</p>
            <p class="text-emerald-600 font-semibold mt-2" id="deleteFilename"></p>
        </div>
        <div class="flex gap-3">
            <button onclick="closeDeleteModal()" class="flex-1 bg-gray-100 text-gray-700 px-4 py-3 rounded-xl hover:bg-gray-200 transition font-medium">
                Batal
            </button>
            <button onclick="executeDelete()" class="flex-1 bg-red-500 text-white px-4 py-3 rounded-xl hover:bg-red-600 transition font-medium">
                <i class="fas fa-trash mr-2"></i>Ya, Hapus
            </button>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div id="loadingModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl p-8 text-center">
        <div class="w-16 h-16 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
        <p class="text-gray-700 font-medium" id="loadingMessage">Memproses...</p>
    </div>
</div>

<?php
function formatSize($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}
?>

<script>
const BASE_URL = '<?= base_url() ?>';
let currentFilename = '';

// Create Backup
function createBackup() {
    showLoading('Membuat backup database...');
    
    $.ajax({
        url: BASE_URL + 'admin/backup_restore/create_backup',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if (response.success) {
                showNotification('Backup berhasil dibuat!', 'success');
                refreshBackups();
            } else {
                showNotification(response.message || 'Gagal membuat backup', 'error');
            }
        },
        error: function() {
            hideLoading();
            showNotification('Terjadi kesalahan server', 'error');
        }
    });
}

// Upload Backup
function uploadBackup() {
    const fileInput = document.getElementById('backupFile');
    if (!fileInput.files[0]) {
        showNotification('Pilih file backup terlebih dahulu', 'error');
        return;
    }
    
    const formData = new FormData();
    formData.append('backup_file', fileInput.files[0]);
    
    showLoading('Mengupload file...');
    
    $.ajax({
        url: BASE_URL + 'admin/backup_restore/upload_backup',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if (response.success) {
                showNotification('File berhasil diupload!', 'success');
                fileInput.value = '';
                refreshBackups();
            } else {
                showNotification(response.message || 'Gagal upload file', 'error');
            }
        },
        error: function() {
            hideLoading();
            showNotification('Terjadi kesalahan server', 'error');
        }
    });
}

// Restore Modal
function confirmRestore(filename) {
    currentFilename = filename;
    document.getElementById('restoreFilename').textContent = filename;
    document.getElementById('restoreModal').classList.remove('hidden');
    document.getElementById('restoreModal').classList.add('flex');
}

function closeRestoreModal() {
    document.getElementById('restoreModal').classList.add('hidden');
    document.getElementById('restoreModal').classList.remove('flex');
}

function executeRestore() {
    closeRestoreModal();
    showLoading('Restore database sedang berlangsung...');
    
    $.ajax({
        url: BASE_URL + 'admin/backup_restore/restore_backup',
        type: 'POST',
        data: { filename: currentFilename },
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if (response.success) {
                showNotification(response.message || 'Restore berhasil!', 'success');
            } else {
                showNotification(response.message || 'Gagal restore database', 'error');
            }
        },
        error: function() {
            hideLoading();
            showNotification('Terjadi kesalahan server', 'error');
        }
    });
}

// Delete Modal
function confirmDelete(filename) {
    currentFilename = filename;
    document.getElementById('deleteFilename').textContent = filename;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}

function executeDelete() {
    closeDeleteModal();
    showLoading('Menghapus backup...');
    
    $.ajax({
        url: BASE_URL + 'admin/backup_restore/delete_backup',
        type: 'POST',
        data: { filename: currentFilename },
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if (response.success) {
                showNotification('Backup berhasil dihapus!', 'success');
                refreshBackups();
            } else {
                showNotification(response.message || 'Gagal menghapus backup', 'error');
            }
        },
        error: function() {
            hideLoading();
            showNotification('Terjadi kesalahan server', 'error');
        }
    });
}

// Refresh backup list
function refreshBackups() {
    location.reload();
}

// Loading Modal
function showLoading(message) {
    document.getElementById('loadingMessage').textContent = message || 'Memproses...';
    document.getElementById('loadingModal').classList.remove('hidden');
    document.getElementById('loadingModal').classList.add('flex');
}

function hideLoading() {
    document.getElementById('loadingModal').classList.add('hidden');
    document.getElementById('loadingModal').classList.remove('flex');
}

// Notification
function showNotification(message, type = 'info') {
    const colors = {
        success: 'from-green-500 to-emerald-600',
        error: 'from-red-500 to-pink-600',
        info: 'from-blue-500 to-cyan-600'
    };
    
    const icons = {
        success: 'check-circle',
        error: 'times-circle',
        info: 'info-circle'
    };
    
    const notification = $(`
        <div class="fixed top-4 right-4 z-50 bg-gradient-to-r ${colors[type]} text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 animate-slide-in">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-${icons[type]}"></i>
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
