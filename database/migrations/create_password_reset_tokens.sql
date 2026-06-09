-- ============================================
-- Password Reset Tokens Table
-- For forgot password functionality
-- ============================================

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `id_reset` INT AUTO_INCREMENT PRIMARY KEY,
  `id_user` INT NOT NULL,
  `token` VARCHAR(64) NOT NULL UNIQUE,
  `email` VARCHAR(255) NOT NULL,
  `is_used` TINYINT(1) DEFAULT 0,
  `expires_at` DATETIME NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `used_at` DATETIME NULL,
  INDEX `idx_token` (`token`),
  INDEX `idx_user` (`id_user`),
  INDEX `idx_expires` (`expires_at`),
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Cleanup old tokens (optional, for maintenance)
-- DELETE FROM password_reset_tokens WHERE created_at < DATE_SUB(NOW(), INTERVAL 24 HOUR);
