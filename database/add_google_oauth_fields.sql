-- ============================================
-- KIXERA - Google OAuth 2.0 Fields
-- Menambahkan kolom untuk Google OAuth
-- ============================================

-- Cek apakah kolom sudah ada sebelum menambahkan
SET @dbname = DATABASE();
SET @tablename = "users";

-- Tambah kolom google_id
SET @columnname = "google_id";
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

-- Tambah kolom google_email
SET @columnname = "google_email";
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

-- Tambah kolom google_avatar
SET @columnname = "google_avatar";
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

-- Tambah kolom oauth_provider
SET @columnname = "oauth_provider";
SET @preparedStatement = (SELECT IF(
  (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
   WHERE (table_name = @tablename)
     AND (table_schema = @dbname)
     AND (column_name = @columnname)
  ) > 0,
  "SELECT 'Column oauth_provider already exists' AS msg;",
  "ALTER TABLE `users` ADD COLUMN `oauth_provider` VARCHAR(50) NULL DEFAULT NULL AFTER `google_avatar`;"
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- Tambah index untuk google_id
SET @indexname = "idx_google_id";
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

-- Verifikasi hasil
SELECT 
    'Google OAuth fields added successfully!' AS Result,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_name = 'users' AND column_name = 'google_id') AS google_id_exists,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_name = 'users' AND column_name = 'google_email') AS google_email_exists,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_name = 'users' AND column_name = 'google_avatar') AS google_avatar_exists,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE table_name = 'users' AND column_name = 'oauth_provider') AS oauth_provider_exists;
