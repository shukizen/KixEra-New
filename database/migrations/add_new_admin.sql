-- Tambah Akun Admin Baru (admin_kixera)
-- Password default: admin123 (hash $2y$10$8.XbYvJ5Y.f7L5qSj.r.I.bH5O/V/C.uGg8Uu6A5pD/u37.m9w6M.)

INSERT INTO `users` (`username`, `password`, `role`, `status`, `created_at`, `updated_at`) 
VALUES ('admin_kixera', '$2y$10$8.XbYvJ5Y.f7L5qSj.r.I.bH5O/V/C.uGg8Uu6A5pD/u37.m9w6M.', 'admin', 'aktif', NOW(), NOW());

SET @new_admin_id = LAST_INSERT_ID();

INSERT INTO `admin` (`id_user`, `nama`, `email`, `created_at`, `updated_at`) 
VALUES (@new_admin_id, 'Admin Kixera', 'admin_kixera@gmail.com', NOW(), NOW());