-- Tambah Akun Owner Expired untuk Testing
-- Password: password ($2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi)

DELETE FROM users WHERE username = 'owner_expired';

INSERT INTO `users` (`username`, `password`, `role`, `status`, `created_at`, `updated_at`) 
VALUES ('owner_expired', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'owner', 'aktif', NOW(), NOW());

SET @last_user_id = LAST_INSERT_ID();

-- Insert ke tabel pemilik dengan status_langganan 'nonaktif' dan tanggal expired di masa lalu
INSERT INTO `pemilik` (`id_user`, `nama`, `email`, `nama_usaha`, `status_langganan`, `id_paket`, `created_at`, `updated_at`) 
VALUES (@last_user_id, 'Owner Berakhir', 'expired@owner.com', 'Toko Expired', 'nonaktif', 1, DATE_SUB(NOW(), INTERVAL 40 DAY), DATE_SUB(NOW(), INTERVAL 40 DAY));

SET @last_pemilik_id = LAST_INSERT_ID();

-- Tambah record ke transaksi_langganan yang sudah expired
INSERT INTO `transaksi_langganan` (`id_pemilik`, `id_paket`, `jumlah_bayar`, `tgl_mulai_langganan`, `tgl_akhir_langganan`, `status_pembayaran`, `created_at`)
VALUES (@last_pemilik_id, 1, 99000.00, DATE_SUB(CURDATE(), INTERVAL 40 DAY), DATE_SUB(CURDATE(), INTERVAL 10 DAY), 'sukses', NOW());