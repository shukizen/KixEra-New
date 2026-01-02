-- Migration: Add pending_registrations table for 2FA verification
-- Run this SQL in phpMyAdmin

CREATE TABLE IF NOT EXISTS `pending_registrations` (
  `id_pending` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `verification_code` varchar(6) NOT NULL,
  `code_expires_at` datetime NOT NULL,
  `code_sent_at` datetime NOT NULL,
  `attempts` int(11) DEFAULT 0 COMMENT 'Failed verification attempts',
  `is_verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_pending`),
  UNIQUE KEY `email` (`email`),
  KEY `no_telp` (`no_telp`),
  KEY `verification_code` (`verification_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Clean up old pending registrations (optional cron)
-- DELETE FROM pending_registrations WHERE created_at < DATE_SUB(NOW(), INTERVAL 24 HOUR);
