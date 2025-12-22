-- ============================================
-- KIXERA - Complete OAuth Google Migration
-- File: oauth_google_complete_migration.sql
-- Deskripsi: Migrasi lengkap untuk mendukung Google OAuth
-- ============================================

SET @dbname = DATABASE();
SET @tablename = 'users';

-- ============================================
-- BAGIAN 1: MODIFIKASI TABEL USERS
-- ============================================

-- 1.1 Ubah kolom password menjadi NULLABLE (untuk OAuth users)
ALTER TABLE `users` 
MODIFY COLUMN `password` VARCHAR(255) NULL DEFAULT NULL;

-- 1.2 Tambah kolom google_id
SET @columnname = 'google_id';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
   WHERE (table_name = @tablename)
     AND (table_schema = @dbname)
     AND (column_name = @columnname)
  ) > 0,
  "SELECT 'Column google_id already exists' AS msg;",
  "ALTER TABLE `users` ADD COLUMN `google_id` VARCHAR(255) NULL DEFAULT NULL AFTER `password`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- 1.3 Tambah kolom google_email
SET @columnname = 'google_email';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
   WHERE (table_name = @tablename)
     AND (table_schema = @dbname)
     AND (column_name = @columnname)
  ) > 0,
  "SELECT 'Column google_email already exists' AS msg;",
  "ALTER TABLE `users` ADD COLUMN `google_email` VARCHAR(255) NULL DEFAULT NULL AFTER `google_id`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- 1.4 Tambah kolom google_avatar
SET @columnname = 'google_avatar';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
   WHERE (table_name = @tablename)
     AND (table_schema = @dbname)
     AND (column_name = @columnname)
  ) > 0,
  "SELECT 'Column google_avatar already exists' AS msg;",
  "ALTER TABLE `users` ADD COLUMN `google_avatar` TEXT NULL DEFAULT NULL AFTER `google_email`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- 1.5 Tambah kolom oauth_provider
SET @columnname = 'oauth_provider';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
   WHERE (table_name = @tablename)
     AND (table_schema = @dbname)
     AND (column_name = @columnname)
  ) > 0,
  "SELECT 'Column oauth_provider already exists' AS msg;",
  "ALTER TABLE `users` ADD COLUMN `oauth_provider` VARCHAR(50) NULL DEFAULT NULL AFTER `google_avatar` COMMENT 'google, facebook, dll';"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- 1.6 Tambah kolom oauth_access_token
SET @columnname = 'oauth_access_token';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
   WHERE (table_name = @tablename)
     AND (table_schema = @dbname)
     AND (column_name = @columnname)
  ) > 0,
  "SELECT 'Column oauth_access_token already exists' AS msg;",
  "ALTER TABLE `users` ADD COLUMN `oauth_access_token` TEXT NULL DEFAULT NULL AFTER `oauth_provider`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- 1.7 Tambah kolom oauth_refresh_token
SET @columnname = 'oauth_refresh_token';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
   WHERE (table_name = @tablename)
     AND (table_schema = @dbname)
     AND (column_name = @columnname)
  ) > 0,
  "SELECT 'Column oauth_refresh_token already exists' AS msg;",
  "ALTER TABLE `users` ADD COLUMN `oauth_refresh_token` TEXT NULL DEFAULT NULL AFTER `oauth_access_token`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- 1.8 Tambah kolom oauth_token_expires
SET @columnname = 'oauth_token_expires';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
   WHERE (table_name = @tablename)
     AND (table_schema = @dbname)
     AND (column_name = @columnname)
  ) > 0,
  "SELECT 'Column oauth_token_expires already exists' AS msg;",
  "ALTER TABLE `users` ADD COLUMN `oauth_token_expires` DATETIME NULL DEFAULT NULL AFTER `oauth_refresh_token`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- 1.9 Tambah index untuk google_id
SET @indexname = 'idx_google_id';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS
   WHERE (table_name = @tablename)
     AND (table_schema = @dbname)
     AND (index_name = @indexname)
  ) > 0,
  "SELECT 'Index idx_google_id already exists' AS msg;",
  "ALTER TABLE `users` ADD INDEX `idx_google_id` (`google_id`);"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- 1.10 Tambah index untuk oauth_provider
SET @indexname = 'idx_oauth_provider';
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS
   WHERE (table_name = @tablename)
     AND (table_schema = @dbname)
     AND (index_name = @indexname)
  ) > 0,
  "SELECT 'Index idx_oauth_provider already exists' AS msg;",
  "ALTER TABLE `users` ADD INDEX `idx_oauth_provider` (`oauth_provider`);"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- ============================================
-- BAGIAN 2: TABEL OAUTH_SESSIONS
-- ============================================

CREATE TABLE IF NOT EXISTS `oauth_sessions` (
  `id_session` INT AUTO_INCREMENT PRIMARY KEY,
  `id_user` INT NOT NULL,
  `provider` VARCHAR(50) NOT NULL COMMENT 'google, facebook, dll',
  `provider_user_id` VARCHAR(255) NOT NULL COMMENT 'ID dari provider (google_id, facebook_id, dll)',
  `access_token` TEXT NULL,
  `refresh_token` TEXT NULL,
  `token_expires_at` DATETIME NULL,
  `scope` TEXT NULL COMMENT 'OAuth scopes yang diberikan',
  `last_used_at` DATETIME NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_user` (`id_user`),
  INDEX `idx_provider` (`provider`),
  INDEX `idx_provider_user_id` (`provider_user_id`),
  INDEX `idx_last_used` (`last_used_at`),
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabel untuk tracking OAuth sessions';

-- ============================================
-- BAGIAN 3: TABEL OAUTH_STATE_TOKENS
-- ============================================

CREATE TABLE IF NOT EXISTS `oauth_state_tokens` (
  `id_state` INT AUTO_INCREMENT PRIMARY KEY,
  `state_token` VARCHAR(64) NOT NULL UNIQUE,
  `redirect_uri` VARCHAR(500) NULL,
  `is_used` TINYINT(1) DEFAULT 0,
  `expires_at` DATETIME NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_state_token` (`state_token`),
  INDEX `idx_expires` (`expires_at`),
  INDEX `idx_is_used` (`is_used`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabel untuk CSRF protection OAuth state tokens';

-- ============================================
-- BAGIAN 4: VERIFIKASI HASIL
-- ============================================

SELECT 
    '✓ OAuth Google Migration Completed!' AS Status,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_name = 'users' AND column_name = 'google_id') AS google_id_exists,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_name = 'users' AND column_name = 'google_email') AS google_email_exists,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_name = 'users' AND column_name = 'google_avatar') AS google_avatar_exists,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_name = 'users' AND column_name = 'oauth_provider') AS oauth_provider_exists,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_name = 'users' AND column_name = 'oauth_access_token') AS oauth_access_token_exists,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_name = 'users' AND column_name = 'oauth_refresh_token') AS oauth_refresh_token_exists,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_name = 'users' AND column_name = 'oauth_token_expires') AS oauth_token_expires_exists,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES 
     WHERE table_name = 'oauth_sessions') AS oauth_sessions_table_exists,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES 
     WHERE table_name = 'oauth_state_tokens') AS oauth_state_tokens_table_exists;

-- ============================================
-- SELESAI!
-- ============================================
