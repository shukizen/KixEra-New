-- ============================================
-- KIXERA - Create Rekomendasi AI Table
-- File: create_rekomendasi_ai_table.sql
-- Deskripsi: Tabel untuk menyimpan rekomendasi AI
-- ============================================

CREATE TABLE IF NOT EXISTS `rekomendasi_ai` (
  `id_rekomendasi` INT AUTO_INCREMENT PRIMARY KEY,
  `id_pemilik` INT NOT NULL,
  `recommendation_text` TEXT NOT NULL COMMENT 'Teks rekomendasi lengkap dari AI',
  `insights` JSON NULL COMMENT 'Array of key insights (3 items)',
  `impact_prediction` JSON NULL COMMENT 'Predicted impact percentages (revenue, retention, efficiency)',
  `business_data_snapshot` JSON NULL COMMENT 'Business data yang digunakan untuk generate rekomendasi',
  `status` ENUM('new', 'saved', 'implemented', 'archived') DEFAULT 'new' COMMENT 'Status rekomendasi',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `idx_pemilik` (`id_pemilik`),
  INDEX `idx_status` (`status`),
  INDEX `idx_created` (`created_at` DESC),
  FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik`(`id_pemilik`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='AI-generated business recommendations';

-- Verifikasi
SELECT 
    'Tabel rekomendasi_ai berhasil dibuat!' AS Status,
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES 
     WHERE table_schema = DATABASE() 
     AND table_name = 'rekomendasi_ai') AS table_exists;

-- Cek struktur tabel
DESCRIBE rekomendasi_ai;
