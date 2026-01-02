-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2026 at 05:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `paket_langganan`
--

CREATE TABLE `paket_langganan` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `durasi_hari` int(11) NOT NULL,
  `fitur_aktif` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fitur_aktif`)),
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_langganan`
--

INSERT INTO `paket_langganan` (`id_paket`, `nama_paket`, `deskripsi`, `harga`, `durasi_hari`, `fitur_aktif`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Basic', 'Paket dasar untuk usaha kecil', 99000.00, 30, '{\"cabang\": 1, \"karyawan\": 2}', 'aktif', '2025-12-16 17:00:21', '2025-12-29 10:00:39', NULL),
(2, 'Professional', 'Paket untuk usaha menengah', 199000.00, 30, '{\"cabang\": 3, \"karyawan\": 10}', 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(3, 'Enterprise', 'Paket untuk usaha besar', 399000.00, 30, '{\"cabang\": -1, \"karyawan\": -1}', 'aktif', '2025-12-16 17:00:21', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paket_langganan`
--
ALTER TABLE `paket_langganan`
  ADD PRIMARY KEY (`id_paket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paket_langganan`
--
ALTER TABLE `paket_langganan`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
