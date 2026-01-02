-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Des 2025
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kixera_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilik`
-- Updated untuk SaaS Service Management System
--

CREATE TABLE `pemilik` (
  `id_pemilik` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  
  -- Informasi Dasar
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  
  -- Informasi Usaha
  `nama_usaha` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL COMMENT 'Path ke file logo usaha',
  `alamat` text DEFAULT NULL COMMENT 'Alamat lengkap usaha',
  `kota` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  
  -- Jam Operasional
  `jam_buka` time DEFAULT '08:00:00',
  `jam_tutup` time DEFAULT '21:00:00',
  
  -- Status Subscription (SaaS)
  `status_langganan` enum('aktif','nonaktif','trial') DEFAULT 'trial',
  `id_paket` int(11) DEFAULT NULL,
  
  -- Profile Completion Flag
  `profile_completed` tinyint(1) DEFAULT 0 COMMENT '0=belum lengkap, 1=sudah lengkap',
  
  -- Timestamps
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemilik`
--

INSERT INTO `pemilik` (`id_pemilik`, `id_user`, `nama`, `email`, `no_telp`, `foto_profil`, `nama_usaha`, `logo`, `alamat`, `kota`, `provinsi`, `jam_buka`, `jam_tutup`, `status_langganan`, `id_paket`, `profile_completed`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 9, 'AetherTech', 'rizkipangestu852@gmail.com', NULL, 'uploads/profile/profile_4_1766421273.jpg', 'AetherTech\'s Business', NULL, NULL, NULL, NULL, '08:00:00', '21:00:00', 'aktif', 2, 1, '2025-12-21 22:50:54', '2025-12-30 17:06:52', NULL),
(7, 16, 'Rizki Pangestu', 'riskypangestu057@gmail.com', NULL, 'uploads/profile/profile_7_1767018913.png', 'Rizki Pangestu\'s Business', NULL, NULL, NULL, NULL, '08:00:00', '21:00:00', 'trial', NULL, 1, '2025-12-29 08:04:45', '2025-12-29 08:35:13', NULL),
(14, 23, 'Stronity', 'stronity@gmail.com', '6281279393094', NULL, 'Stronity', NULL, NULL, NULL, NULL, '08:00:00', '21:00:00', 'trial', NULL, 0, '2025-12-30 21:46:48', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id_pemilik`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_paket` (`id_paket`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id_pemilik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  ADD CONSTRAINT `pemilik_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemilik_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket_langganan` (`id_paket`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
