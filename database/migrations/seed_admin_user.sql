INSERT INTO `users` (`username`, `password`, `role`, `status`, `created_at`, `updated_at`) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'aktif', NOW(), NOW());

SET @last_user_id = LAST_INSERT_ID();

INSERT INTO `admin` (`id_user`, `nama`, `email`, `created_at`, `updated_at`) 
VALUES (@last_user_id, 'Super Admin', 'admin@kixera.com', NOW(), NOW());
