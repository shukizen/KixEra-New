-- ============================================
-- KIXERA - Update Database untuk Google OAuth
-- Jalankan query ini di phpMyAdmin atau MySQL
-- ============================================

-- Tambah kolom google_id
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `google_id` VARCHAR(255) NULL DEFAULT NULL AFTER `password`;

-- Tambah kolom google_email  
ALTER TABLE `users`
ADD COLUMN IF NOT EXISTS `google_email` VARCHAR(255) NULL DEFAULT NULL AFTER `google_id`;

-- Tambah kolom google_avatar
ALTER TABLE `users`
ADD COLUMN IF NOT EXISTS `google_avatar` TEXT NULL DEFAULT NULL AFTER `google_email`;

-- Tambah kolom oauth_provider
ALTER TABLE `users`
ADD COLUMN IF NOT EXISTS `oauth_provider` VARCHAR(50) NULL DEFAULT NULL AFTER `google_avatar`;

-- Tambah index untuk google_id (opsional, untuk performa)
ALTER TABLE `users`
ADD INDEX IF NOT EXISTS `idx_google_id` (`google_id`);

-- Verifikasi hasil (jalankan setelah query di atas berhasil)
-- DESCRIBE users;
