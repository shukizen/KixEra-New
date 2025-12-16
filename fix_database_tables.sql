-- Membuat tabel cabang yang mungkin hilang
CREATE TABLE IF NOT EXISTS `cabang` (
  `id_cabang` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik` int(11) NOT NULL,
  `nama_cabang` varchar(100) NOT NULL,
  `alamat` text,
  `no_telp` varchar(20),
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_cabang`),
  KEY `id_pemilik` (`id_pemilik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuat tabel activity_log untuk pencatatan log
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `description` text,
  `ip_address` varchar(45),
  `user_agent` text,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_log`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
