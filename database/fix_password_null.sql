-- ============================================
-- FIX: Allow NULL password for OAuth users
-- ============================================

-- Ubah kolom password agar bisa NULL (untuk OAuth users)
ALTER TABLE `users` 
MODIFY COLUMN `password` VARCHAR(255) NULL DEFAULT NULL;

-- Verifikasi
DESCRIBE users;
