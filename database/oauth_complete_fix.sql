-- ============================================
-- COMPLETE FIX untuk Google OAuth
-- Jalankan semua query ini secara berurutan
-- ============================================

-- 1. Ubah kolom password agar bisa NULL (untuk OAuth users)
ALTER TABLE `users` 
MODIFY COLUMN `password` VARCHAR(255) NULL DEFAULT NULL;

-- 2. Tambah kolom google_id
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `google_id` VARCHAR(255) NULL DEFAULT NULL AFTER `password`;

-- 3. Tambah kolom google_email  
ALTER TABLE `users`
ADD COLUMN IF NOT EXISTS `google_email` VARCHAR(255) NULL DEFAULT NULL AFTER `google_id`;

-- 4. Tambah kolom google_avatar
ALTER TABLE `users`
ADD COLUMN IF NOT EXISTS `google_avatar` TEXT NULL DEFAULT NULL AFTER `google_email`;

-- 5. Tambah kolom oauth_provider
ALTER TABLE `users`
ADD COLUMN IF NOT EXISTS `oauth_provider` VARCHAR(50) NULL DEFAULT NULL AFTER `google_avatar`;

-- 6. Tambah index untuk google_id (opsional, untuk performa)
ALTER TABLE `users`
ADD INDEX IF NOT EXISTS `idx_google_id` (`google_id`);

-- Verifikasi hasil
DESCRIBE users;
