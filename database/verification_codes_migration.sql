-- =====================================================
-- WhatsApp Verification Codes Table
-- For Admin Login 2FA using Fonnte API
-- =====================================================

CREATE TABLE IF NOT EXISTS `verification_codes` (
  `id_code` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `code` varchar(6) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `purpose` enum('admin_login','password_reset') DEFAULT 'admin_login',
  `is_used` tinyint(1) DEFAULT 0,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `used_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_code`),
  KEY `idx_user` (`id_user`),
  KEY `idx_code` (`code`),
  KEY `idx_expires` (`expires_at`),
  CONSTRAINT `fk_verification_codes_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Add index for faster lookups
CREATE INDEX `idx_verification_lookup` ON `verification_codes` (`id_user`, `code`, `is_used`, `expires_at`);
