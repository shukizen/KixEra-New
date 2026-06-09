-- Table for Remember Me Tokens
-- Stores secure tokens for persistent login

CREATE TABLE IF NOT EXISTS `remember_tokens` (
  `id_token` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `token_hash` varchar(255) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_token`),
  KEY `idx_selector` (`selector`),
  KEY `idx_user` (`id_user`),
  CONSTRAINT `fk_remember_tokens_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
