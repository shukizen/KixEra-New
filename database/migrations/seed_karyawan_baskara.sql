-- Script Dummy Data Karyawan: Baskara Putra
-- Password: password ($2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi)

-- 1. Hapus jika user sudah ada (untuk idempotensi)
DELETE FROM users WHERE username = 'baskara_putra';

-- 2. Insert ke tabel users
INSERT INTO `users` (`username`, `password`, `role`, `status`, `created_at`, `updated_at`) 
VALUES ('baskara_putra', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'karyawan', 'aktif', NOW(), NOW());

SET @last_user_id = LAST_INSERT_ID();

-- 3. Pilih salah satu id_cabang yang ada (mengambil yang pertama ketemu, misal ID 8)
SET @target_cabang_id = (SELECT id_cabang FROM cabang LIMIT 1);

-- 4. Insert ke tabel karyawan
INSERT INTO `karyawan` (
    `id_user`, 
    `id_cabang`, 
    `nama`, 
    `email`, 
    `no_telp`, 
    `jabatan`, 
    `alamat`, 
    `tgl_masuk`, 
    `created_at`, 
    `updated_at`
) VALUES (
    @last_user_id, 
    @target_cabang_id, 
    'Baskara Putra', 
    'baskara.putra@example.com', 
    '081234567890', 
    'Kasir', 
    'Jl. Kaliurang KM 5, Yogyakarta', 
    CURDATE(), 
    NOW(), 
    NOW()
);

-- Tampilkan hasil
SELECT 'Akun Berhasil Dibuat' as Status, 'baskara_putra' as Username, 'password' as Password;
