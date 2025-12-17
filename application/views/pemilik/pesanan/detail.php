<!DOCTYPE html>
<html lang="id">

<head>
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <!-- Main Content -->
        <main class="flex-1 ml-64">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div>
                            <h1 class="text-2xl font-semibold text-gray-800">Detail Pesanan</h1>
                            <p class="text-sm text-gray-500">No. Pesanan: <?php echo htmlspecialchars($pesanan->nomor_pesanan); ?></p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Detail Utama -->
                    <div class="lg:col-span-2">
                        <!-- Informasi Pesanan -->
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-4 border-b">Informasi Pesanan</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Pelanggan -->
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Pelanggan</label>
                                    <p class="text-lg text-gray-800 mt-1"><?php echo htmlspecialchars($pesanan->nama_pelanggan ?? '-'); ?></p>
                                </div>

                                <!-- Cabang -->
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Cabang</label>
                                    <p class="text-lg text-gray-800 mt-1"><?php echo htmlspecialchars($pesanan->nama_cabang ?? '-'); ?></p>
                                </div>

                                <!-- Layanan -->
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Layanan</label>
                                    <p class="text-lg text-gray-800 mt-1"><?php echo htmlspecialchars($pesanan->nama_layanan ?? '-'); ?></p>
                                </div>

                                <!-- Karyawan -->
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Karyawan</label>
                                    <p class="text-lg text-gray-800 mt-1"><?php echo htmlspecialchars($pesanan->nama_karyawan ?? '-'); ?></p>
                                </div>

                                <!-- Jumlah Item -->
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Jumlah Item</label>
                                    <p class="text-lg text-gray-800 mt-1"><?php echo htmlspecialchars($pesanan->jumlah_item ?? '0'); ?></p>
                                </div>

                                <!-- Total Harga -->
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Total Harga</label>
                                    <p class="text-lg font-semibold text-emerald-600 mt-1">Rp <?php echo number_format($pesanan->total_harga ?? 0, 0, ',', '.'); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal & Status -->
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-4 border-b">Tanggal & Status</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Tanggal Masuk -->
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Tanggal Masuk</label>
                                    <p class="text-lg text-gray-800 mt-1"><?php echo date('d/m/Y H:i', strtotime($pesanan->tgl_masuk)); ?></p>
                                </div>

                                <!-- Tanggal Estimasi Selesai -->
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Estimasi Selesai</label>
                                    <p class="text-lg text-gray-800 mt-1">
                                        <?php echo $pesanan->tgl_estimasi_selesai ? date('d/m/Y', strtotime($pesanan->tgl_estimasi_selesai)) : '-'; ?>
                                    </p>
                                </div>

                                <!-- Tanggal Selesai -->
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Tanggal Selesai</label>
                                    <p class="text-lg text-gray-800 mt-1">
                                        <?php echo $pesanan->tgl_selesai ? date('d/m/Y H:i', strtotime($pesanan->tgl_selesai)) : '-'; ?>
                                    </p>
                                </div>

                                <!-- Tanggal Diambil -->
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Tanggal Diambil</label>
                                    <p class="text-lg text-gray-800 mt-1">
                                        <?php echo $pesanan->tgl_diambil ? date('d/m/Y H:i', strtotime($pesanan->tgl_diambil)) : '-'; ?>
                                    </p>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Status Pesanan</label>
                                    <?php
                                    $status = strtolower($pesanan->status_pesanan ?? '');
                                    $badge = 'bg-gray-100 text-gray-700';
                                    if ($status === 'selesai' || $status === 'sudah_diambil') {
                                        $badge = 'bg-emerald-500/10 text-emerald-500';
                                    } elseif ($status === 'diterima' || $status === 'dalam_proses' || $status === 'siap_diambil') {
                                        $badge = 'bg-emerald-400/10 text-emerald-400';
                                    } elseif ($status === 'menunggu') {
                                        $badge = 'bg-blue-500/10 text-blue-600';
                                    } elseif ($status === 'dibatalkan') {
                                        $badge = 'bg-red-500/10 text-red-500';
                                    }
                                    ?>
                                    <div class="mt-1">
                                        <span class="<?php echo $badge; ?> px-4 py-2 rounded-full text-sm font-medium">
                                            <?php echo htmlspecialchars($pesanan->status_pesanan ?? '-'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-4 border-b">Catatan</h2>
                            <div class="bg-gray-50 rounded-lg p-4 min-h-[100px]">
                                <p class="text-gray-700 whitespace-pre-wrap">
                                    <?php echo htmlspecialchars($pesanan->catatan ?? 'Tidak ada catatan'); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Detail Item Pesanan -->
                        <?php if (!empty($detail_items)): ?>
                            <div class="bg-white rounded-xl shadow-lg p-6">
                                <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-4 border-b">Detail Item Pesanan</h2>

                                <div class="space-y-6">
                                    <?php foreach ($detail_items as $idx => $item): ?>
                                        <div class="border rounded-lg p-4 bg-gray-50">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="text-sm font-medium text-gray-600">Jenis Sepatu</label>
                                                    <p class="text-lg text-gray-800 mt-1"><?php echo htmlspecialchars($item->jenis_sepatu ?? '-'); ?></p>
                                                </div>

                                                <div>
                                                    <label class="text-sm font-medium text-gray-600">Warna</label>
                                                    <p class="text-lg text-gray-800 mt-1"><?php echo htmlspecialchars($item->warna ?? '-'); ?></p>
                                                </div>

                                                <div class="md:col-span-2">
                                                    <label class="text-sm font-medium text-gray-600">Kondisi Awal</label>
                                                    <p class="text-gray-800 mt-1"><?php echo htmlspecialchars($item->kondisi_awal ?? '-'); ?></p>
                                                </div>

                                                <div class="md:col-span-2">
                                                    <label class="text-sm font-medium text-gray-600">Catatan Khusus</label>
                                                    <p class="text-gray-800 mt-1"><?php echo htmlspecialchars($item->catatan_khusus ?? '-'); ?></p>
                                                </div>

                                                <?php if ($item->foto_sebelum || $item->foto_sesudah): ?>
                                                    <div class="md:col-span-2">
                                                        <label class="text-sm font-medium text-gray-600 block mb-3">Foto</label>
                                                        <div class="grid grid-cols-2 gap-4">
                                                            <?php if ($item->foto_sebelum): ?>
                                                                <div>
                                                                    <p class="text-xs text-gray-600 mb-2">Sebelum</p>
                                                                    <img src="<?php echo base_url($item->foto_sebelum); ?>" alt="Foto Sebelum" class="w-full h-40 object-cover rounded-lg border border-gray-300">
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if ($item->foto_sesudah): ?>
                                                                <div>
                                                                    <p class="text-xs text-gray-600 mb-2">Sesudah</p>
                                                                    <img src="<?php echo base_url($item->foto_sesudah); ?>" alt="Foto Sesudah" class="w-full h-40 object-cover rounded-lg border border-gray-300">
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Sidebar Info -->

                    <div class="lg:col-span-1">
                        <!-- Quick Info -->
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Singkat</h3>

                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Nomor Pesanan</p>
                                    <p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($pesanan->nomor_pesanan); ?></p>
                                </div>

                                <div class="border-t pt-4">
                                    <p class="text-sm text-gray-500">Waktu Dibuat</p>
                                    <p class="text-sm text-gray-800"><?php echo $pesanan->created_at ? date('d/m/Y H:i', strtotime($pesanan->created_at)) : '-'; ?></p>
                                </div>

                                <div class="border-t pt-4">
                                    <p class="text-sm text-gray-500">Terakhir Diperbarui</p>
                                    <p class="text-sm text-gray-800">
                                        <?php echo $pesanan->tgl_selesai ? date('d/m/Y H:i', strtotime($pesanan->tgl_selesai)) : 'Belum selesai'; ?>
                                    </p>
                                </div>

                                <div class="border-t pt-4">
                                    <p class="text-sm text-gray-500">Total Harga</p>
                                    <p class="text-2xl font-bold text-emerald-600">Rp <?php echo number_format($pesanan->total_harga ?? 0, 0, ',', '.'); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Status Pesanan (Timeline) -->
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Detail Status Pesanan</h3>
                            
                            <?php if (!empty($progres_list)): ?>
                                <?php 
                                // Reverse the list to show newest first
                                $reversed_progres = array_reverse($progres_list);
                                ?>
                                <div class="relative">
                                    <?php foreach ($reversed_progres as $idx => $progres): ?>
                                        <?php
                                        $status = strtolower($progres->status);
                                        $is_first = ($idx === 0);
                                        $is_last = ($idx === count($reversed_progres) - 1);
                                        
                                        // Determine icon based on status
                                        $icon = 'fa-circle-dot';
                                        if ($status === 'diterima') $icon = 'fa-calendar-check';
                                        elseif ($status === 'dalam_proses') $icon = 'fa-gear';
                                        elseif ($status === 'selesai') $icon = 'fa-check-double';
                                        elseif ($status === 'siap_diambil') $icon = 'fa-box-open';
                                        elseif ($status === 'sudah_diambil') $icon = 'fa-handshake';
                                        elseif ($status === 'dibatalkan') $icon = 'fa-ban';
                                        
                                        $status_label = ucfirst(str_replace('_', ' ', $status));
                                        $dot_color = $is_first ? 'bg-blue-500' : 'bg-gray-300';
                                        $text_color = $is_first ? 'text-blue-600' : 'text-gray-700';
                                        ?>
                                        <div class="flex gap-4 <?php echo !$is_last ? 'pb-6' : ''; ?>">
                                            <!-- Timeline dot and line -->
                                            <div class="flex flex-col items-center">
                                                <div class="w-3 h-3 rounded-full <?php echo $dot_color; ?> flex-shrink-0"></div>
                                                <?php if (!$is_last): ?>
                                                    <div class="w-0.5 flex-1 bg-gray-200 mt-1"></div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Content -->
                                            <div class="flex-1 -mt-1">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <i class="fas <?php echo $icon; ?> text-gray-400 text-sm"></i>
                                                    <span class="font-semibold <?php echo $text_color; ?>"><?php echo $status_label; ?></span>
                                                </div>
                                                <p class="text-sm text-gray-500 mb-2">
                                                    <?php echo date('d M Y H:i', strtotime($progres->tgl_update)); ?>
                                                </p>
                                                <?php if (!empty($progres->deskripsi)): ?>
                                                    <p class="text-sm text-gray-600"><?php echo htmlspecialchars($progres->deskripsi); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-6 text-gray-500">
                                    <i class="fas fa-clock text-3xl mb-2 text-gray-300"></i>
                                    <p class="text-sm">Belum ada progres</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>

                            <div class="space-y-3">
                                <a href="<?php echo site_url('pemilik/pesanan'); ?>" class="block w-full px-4 py-2 bg-emerald-500 text-white text-center rounded-lg hover:bg-emerald-600 transition">
                                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                                </a>

                                <button class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition" onclick="editPesanan(<?php echo $pesanan->id_pesanan; ?>)">
                                    <i class="fas fa-edit mr-2"></i> Edit Pesanan
                                </button>

                                <button class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition" onclick="showDeleteModal(<?php echo $pesanan->id_pesanan; ?>, '<?php echo htmlspecialchars($pesanan->nomor_pesanan); ?>')">
                                    <i class="fas fa-trash mr-2"></i> Hapus Pesanan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function editPesanan(id) {
            window.location.href = '<?php echo site_url("pemilik/pesanan"); ?>' + '?edit=' + id;
        }

        let deleteId = null;

        function showDeleteModal(id, nomor) {
            deleteId = id;
            const el = document.getElementById('delete-id-text');
            if (el) el.textContent = '#' + nomor;

            const modal = document.getElementById('deleteModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function hideDeleteModal() {
            const modal = document.getElementById('deleteModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const cancelBtn = document.getElementById('cancelDeleteBtn');
            if (cancelBtn) cancelBtn.addEventListener('click', hideDeleteModal);

            const confirmBtn = document.getElementById('confirmDeleteBtn');
            if (confirmBtn) confirmBtn.addEventListener('click', function() {
                fetch('<?php echo site_url("pemilik/pesanan/delete"); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                        body: 'id_pesanan=' + encodeURIComponent(deleteId)
                    })
                    .then(res => res.json())
                    .then(json => {
                        if (json.status === 'success') {
                            showNotification('Pesanan berhasil dihapus', 'success');
                            setTimeout(function() {
                                window.location.href = '<?php echo site_url("pemilik/pesanan"); ?>';
                            }, 800);
                        } else {
                            showNotification(json.message || 'Gagal menghapus pesanan', 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showNotification('Terjadi kesalahan jaringan', 'error');
                    });

                hideDeleteModal();
            });
        });

        function showNotification(message, type = 'info') {
            const existing = document.getElementById('temp-notification');
            if (existing) {
                existing.remove();
            }

            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                'bg-blue-500 text-white'
            }`;
            notification.textContent = message;
            notification.id = 'temp-notification';

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 items-center justify-center bg-black bg-opacity-40 z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 mx-4">
            <h3 class="text-lg font-semibold mb-2">Konfirmasi Hapus</h3>
            <p class="text-sm text-gray-600 mb-4">Hapus pesanan <span id="delete-id-text"></span> ?</p>
            <div class="flex justify-end gap-3">
                <button id="cancelDeleteBtn" class="px-4 py-2 rounded-lg border">Batal</button>
                <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-500 text-white rounded-lg">Hapus</button>
            </div>
        </div>
    </div>
</body>

</html>