-- ============================================
-- QUERY INSERT AKUN TESTING - SESUAI STRUKTUR DATABASE
-- ============================================
-- Password untuk semua akun: admin123
-- Hash: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
-- ============================================

-- AKUN 1: Admin KixEra (Role: admin)
INSERT INTO `users` (`username`, `password`, `role`, `status`, `created_at`) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'aktif', NOW());

SET @id_user_admin = LAST_INSERT_ID();

INSERT INTO `admin` (`id_user`, `nama`, `email`, `no_telp`, `created_at`) 
VALUES (@id_user_admin, 'Admin KixEra', 'admin@kixera.com', '081234567890', NOW());

-- ============================================

-- AKUN 2: Pemilik John Doe (Role: owner)
INSERT INTO `users` (`username`, `password`, `role`, `status`, `created_at`) 
VALUES ('john', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'owner', 'aktif', NOW());

SET @id_user_john = LAST_INSERT_ID();

INSERT INTO `pemilik` (`id_user`, `nama`, `email`, `no_telp`, `nama_usaha`, `alamat_usaha`, `status_langganan`, `created_at`) 
VALUES (@id_user_john, 'John Doe', 'john@example.com', '081234567891', 'John Shoe Care', 'Jl. Testing No. 456, Bandung', 'trial', NOW());

-- ============================================

-- AKUN 3: Pemilik Premium (Role: owner dengan subscription)
INSERT INTO `users` (`username`, `password`, `role`, `status`, `created_at`) 
VALUES ('premium', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'owner', 'aktif', NOW());

SET @id_user_premium = LAST_INSERT_ID();

INSERT INTO `pemilik` (`id_user`, `nama`, `email`, `no_telp`, `nama_usaha`, `alamat_usaha`, `status_langganan`, `created_at`) 
VALUES (@id_user_premium, 'Premium User', 'premium@kixera.com', '081234567892', 'Premium Shoe Spa', 'Jl. Premium No. 789, Surabaya', 'aktif', NOW());

-- ============================================
-- INFORMASI LOGIN
-- ============================================
-- ADMIN:
--   Username: admin    | Password: admin123 | Email: admin@kixera.com
--
-- OWNER 1:
--   Username: john     | Password: admin123 | Email: john@example.com
--
-- OWNER 2:
--   Username: premium  | Password: admin123 | Email: premium@kixera.com
-- ============================================

-- CARA LOGIN:
-- Bisa pakai USERNAME atau EMAIL:
-- - Username: admin + Password: admin123
-- - ATAU Email: admin@kixera.com + Password: admin123
-- ============================================
