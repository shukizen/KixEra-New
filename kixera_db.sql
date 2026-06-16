-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2026 pada 11.36
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
-- Struktur dari tabel `activity_log`
--

CREATE TABLE `activity_log` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_cabang` int(11) DEFAULT NULL,
  `activity` varchar(100) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `target_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `activity_log`
--

INSERT INTO `activity_log` (`id_log`, `id_user`, `id_karyawan`, `id_cabang`, `activity`, `action`, `module`, `description`, `target_id`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 11:31:47'),
(2, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 11:48:19'),
(3, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 12:10:27'),
(4, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 12:10:32'),
(5, 24, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 13:39:57'),
(6, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 22:38:43'),
(7, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 22:51:37'),
(8, 24, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 23:00:47'),
(9, 24, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-07 13:09:14'),
(10, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-07 14:04:34'),
(11, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-27 12:53:39'),
(12, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-27 16:29:06'),
(13, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 09:24:58'),
(14, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 09:25:15'),
(15, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 09:26:46'),
(16, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 09:27:03'),
(17, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 09:27:14'),
(18, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 09:28:57'),
(19, 24, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 09:29:53'),
(20, 24, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 09:30:18'),
(21, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 09:30:27'),
(22, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 09:30:48'),
(23, 24, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 09:30:58'),
(24, 24, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 10:51:16'),
(25, 24, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 11:24:12'),
(26, 24, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 11:24:33'),
(27, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 11:24:47'),
(28, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 11:24:56'),
(29, 24, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 11:25:01'),
(30, 24, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 11:36:50'),
(31, 8, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 12:01:19'),
(32, 24, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 12:01:23'),
(33, 24, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 12:01:25'),
(34, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 12:01:31'),
(35, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 12:28:56'),
(36, 8, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 12:44:14'),
(37, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 12:44:23'),
(38, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 05:13:44'),
(39, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-04-23 08:35:25'),
(40, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-04-23 08:35:42'),
(41, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-04-23 08:36:20'),
(42, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-04-23 08:36:32'),
(43, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-04-23 08:37:37'),
(44, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-04-23 08:37:56'),
(45, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-04-23 08:38:24'),
(46, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-04-23 08:38:34'),
(47, 24, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-04-23 08:38:44'),
(48, 24, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-04-23 08:41:33'),
(49, 33, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:02:20'),
(50, 33, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:18:21'),
(51, 38, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', '2026-04-23 09:19:44'),
(52, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:23:00'),
(53, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:26:40'),
(54, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:26:43'),
(55, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:26:55'),
(56, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:27:11'),
(57, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:27:38'),
(58, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:28:53'),
(59, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:32:38'),
(60, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:32:46'),
(61, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:34:31'),
(62, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:34:39'),
(63, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:34:43'),
(64, 24, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 09:43:53'),
(65, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 10:24:52'),
(66, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 10:26:01'),
(67, 39, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 10:26:09'),
(68, 39, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 10:26:14'),
(69, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 10:26:17'),
(70, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 12:11:02'),
(71, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 12:27:48'),
(72, 38, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 12:30:05'),
(73, 38, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 12:30:35'),
(74, 38, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 12:31:15'),
(75, 38, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 12:31:53'),
(76, 38, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 12:40:26'),
(77, 38, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 12:41:59'),
(78, 46, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 12:42:07'),
(79, 46, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', '2026-04-23 13:01:09'),
(80, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', '2026-04-23 13:01:16'),
(81, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', '2026-04-23 13:03:44'),
(82, 46, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', '2026-04-23 13:03:56'),
(83, 46, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', '2026-04-23 13:05:45'),
(84, 46, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', '2026-04-23 13:05:49'),
(85, 46, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', '2026-04-23 13:07:51'),
(86, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', '2026-04-23 13:07:57'),
(87, 46, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-24 10:03:49'),
(88, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 10:35:39'),
(89, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 10:35:54'),
(90, 46, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 10:36:07'),
(91, 46, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 11:19:07'),
(92, 140, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 11:54:00'),
(93, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 11:56:23'),
(94, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 11:56:38'),
(95, 137, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 11:57:11'),
(96, 137, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 11:58:48'),
(97, 137, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 12:00:16'),
(98, 137, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 12:19:21'),
(99, 141, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-28 12:19:26'),
(100, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:50:22'),
(101, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:50:30'),
(102, 140, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:53:16'),
(103, 140, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:53:43'),
(104, 137, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:53:52'),
(105, 137, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:54:00'),
(106, 141, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:54:10'),
(107, 141, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:54:26'),
(108, 141, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:54:37'),
(109, 141, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:55:32'),
(110, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:55:35'),
(111, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 01:58:34'),
(112, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-29 02:05:07'),
(113, 23, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 10:27:40'),
(114, 23, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 10:27:44'),
(115, 142, NULL, NULL, 'Register', NULL, NULL, 'User mendaftar akun baru (verified via OTP)', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 15:52:13'),
(116, 142, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:02:31'),
(117, 143, NULL, NULL, 'Register', NULL, NULL, 'User mendaftar akun baru (verified via OTP)', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 16:24:29'),
(118, 143, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:24:38'),
(119, 143, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:35:08'),
(120, 143, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:35:26'),
(121, 143, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:39:37'),
(122, 144, NULL, NULL, 'Register', NULL, NULL, 'User mendaftar via Google OAuth', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:39:44'),
(123, 144, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:42:50'),
(124, 144, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:43:38'),
(125, 144, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:48:17'),
(126, 145, NULL, NULL, 'Register', NULL, NULL, 'User mendaftar via Google OAuth', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:48:24'),
(127, 145, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:50:03'),
(128, 146, NULL, NULL, 'Register', NULL, NULL, 'User mendaftar via Google OAuth', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:50:10'),
(129, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:51:30'),
(130, 146, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:51:41'),
(131, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:51:44'),
(132, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 11:52:03'),
(133, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 12:14:39'),
(134, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 12:15:51'),
(135, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 12:39:42'),
(136, 143, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 12:39:52'),
(137, 143, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 12:40:33'),
(138, 147, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 12:40:40'),
(139, 147, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 12:46:56'),
(140, 147, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 12:47:35'),
(141, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:05:04'),
(142, 148, NULL, NULL, 'Register', NULL, NULL, 'User mendaftar via Google OAuth', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:05:14'),
(143, 148, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:05:23'),
(144, 147, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:06:04'),
(145, 147, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:15:36'),
(146, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:16:12'),
(147, 147, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:16:30'),
(148, 147, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:31:21'),
(149, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:48:29'),
(150, 147, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:48:35'),
(151, 147, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:49:00'),
(152, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 13:54:27'),
(153, 147, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-09 14:30:56'),
(154, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 14:35:37'),
(155, 147, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-09 14:37:24'),
(156, 146, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 14:37:41'),
(157, 156, NULL, NULL, 'Register', NULL, NULL, 'User mendaftar akun baru (verified via OTP)', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 19:40:07'),
(158, 157, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-09 14:42:28'),
(159, 157, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-09 21:27:44'),
(160, 157, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-09 21:27:56'),
(161, 157, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-09 21:38:46'),
(162, 156, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 21:45:34'),
(163, 157, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-09 21:45:59'),
(164, 158, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-10 07:34:35'),
(165, 157, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-10 12:15:31'),
(166, 157, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-10 13:42:47'),
(167, 157, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-10 13:42:56'),
(168, 157, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-10 14:44:41'),
(169, 157, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-10 14:44:50'),
(170, 157, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-12 07:59:46'),
(171, 157, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-12 08:15:53'),
(172, 156, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-12 08:21:12'),
(173, 157, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-12 08:27:21'),
(174, 156, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-12 08:28:41'),
(175, 156, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-12 08:52:03'),
(176, 156, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-12 09:05:44'),
(177, 156, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-12 09:16:28'),
(178, 157, NULL, NULL, 'Login', NULL, NULL, 'User login ke sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-12 09:18:44'),
(179, 157, NULL, NULL, 'Logout', NULL, NULL, 'User logout dari sistem', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-06-12 09:18:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `id_user`, `nama`, `email`, `no_telp`, `foto_profil`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Super Admin', 'admin@kixera.com', '081234567890', NULL, '2025-12-16 17:00:21', '2025-12-22 18:07:52', '2025-12-22 12:07:52'),
(2, 8, 'Hatta', 'hattapramana@gmail.com', '081279393094', NULL, '2025-12-21 15:38:55', '2025-12-29 17:47:58', NULL),
(3, 33, 'Admin Kixera', 'admin_kixera@gmail.com', '085922409428', NULL, '2026-04-23 13:24:31', '2026-04-23 13:27:55', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `backup_data`
--

CREATE TABLE `backup_data` (
  `id_backup` int(11) NOT NULL,
  `id_pemilik` int(11) DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `ukuran_file` bigint(20) DEFAULT NULL,
  `path_file` varchar(255) NOT NULL,
  `jenis_backup` enum('otomatis','manual') NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `tgl_backup` datetime NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti_transaksi`
--

CREATE TABLE `bukti_transaksi` (
  `id_bukti` int(11) NOT NULL,
  `id_pemasukan` int(11) DEFAULT NULL,
  `id_pengeluaran` int(11) DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `ukuran_file` bigint(20) DEFAULT NULL,
  `tipe_file` varchar(50) DEFAULT NULL,
  `tgl_upload` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bukti_transaksi`
--

INSERT INTO `bukti_transaksi` (`id_bukti`, `id_pemasukan`, `id_pengeluaran`, `nama_file`, `path_file`, `ukuran_file`, `tipe_file`, `tgl_upload`, `created_at`, `deleted_at`) VALUES
(1, 16, NULL, 'kixera_1.png', 'uploads/bukti_transaksi/ec053dc03ea658fad84f0c461c9157b5.png', 8888, '.png', '2025-12-29 15:15:05', '2025-12-29 08:15:05', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `alamat_cabang` text DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `id_pemilik`, `nama_cabang`, `alamat`, `alamat_cabang`, `no_telp`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 4, 'Seturan', 'Jl. Seturan Raya No. 88, Caturtunggal, Depok, Sleman', 'Jl. Seturan Raya No. 88, Caturtunggal, Depok, Sleman', '0274567890', 'aktif', '2025-12-22 06:06:35', '2025-12-22 10:12:40', NULL),
(9, 4, 'Bantul', 'Jl. Parangtritis Km 5.5, Sewon, Bantul', 'Jl. Parangtritis Km 5.5, Sewon, Bantul', '0274567891', 'aktif', '2025-12-22 06:06:35', '2025-12-22 10:12:31', NULL),
(12, 7, 'Cabang Utama', NULL, '', '', 'aktif', '2025-12-29 08:04:45', NULL, NULL),
(19, 14, 'Cabang Seturan', NULL, 'Jl.seturan raya no 9, sleman, diy', '081279394219', 'aktif', '2025-12-30 21:46:48', '2026-01-01 11:58:21', NULL),
(20, 14, 'Cabang bantul', NULL, 'bantul, adisucipto', '0821939123213', 'aktif', '2026-01-01 11:58:48', '2026-04-23 10:26:59', NULL),
(21, 14, 'Cabang gejayan', NULL, 'jl. gejayan 291', '081279393094', 'aktif', '2026-01-01 11:59:23', '2026-01-01 18:13:35', '2026-01-01 12:13:35'),
(27, 20, 'Cabang Utama', NULL, '', '', 'aktif', '2026-01-02 12:34:18', NULL, NULL),
(28, 21, 'Cabang Utama', NULL, NULL, NULL, 'aktif', '2026-01-03 18:34:05', NULL, NULL),
(41, 36, 'Cabang Utama', NULL, NULL, NULL, 'aktif', '2026-06-09 19:40:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `chatbot_log`
--

CREATE TABLE `chatbot_log` (
  `id_chat` int(11) NOT NULL,
  `id_pemilik` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL,
  `tgl_chat` datetime NOT NULL,
  `is_handled_by_ai` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer_service`
--

CREATE TABLE `customer_service` (
  `id_ticket` int(11) NOT NULL,
  `id_pemilik` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `kategori` enum('bug','pertanyaan','keluhan','saran') NOT NULL,
  `subjek` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `status` enum('baru','diproses','selesai','ditutup') DEFAULT 'baru',
  `prioritas` enum('rendah','normal','tinggi','urgent') DEFAULT 'normal',
  `tgl_dibuat` datetime NOT NULL,
  `tgl_ditutup` datetime DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `jenis_sepatu` varchar(255) DEFAULT NULL,
  `warna` varchar(100) DEFAULT NULL,
  `kondisi_awal` text DEFAULT NULL,
  `catatan_khusus` text DEFAULT NULL,
  `foto_sebelum` varchar(255) DEFAULT NULL,
  `foto_sesudah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail`, `id_pesanan`, `id_layanan`, `jenis_sepatu`, `warna`, `kondisi_awal`, `catatan_khusus`, `foto_sebelum`, `foto_sesudah`, `created_at`, `deleted_at`) VALUES
(32, 31, 19, 'Nike', 'putih', 'kotor', 'hati hati', NULL, NULL, '2026-01-01 23:07:09', NULL),
(33, 32, 19, 'Adidas', 'putih', 'Kotor', 'Hati hati', 'uploads/pesanan/32/sebelum_1_1767333752.jpg', NULL, '2026-01-02 00:02:32', NULL),
(34, 33, 19, 'Nike', 'merah', 'kotor', 'hati hati', 'uploads/pesanan/33/sebelum_1_1767334817.png', NULL, '2026-01-02 00:20:17', NULL),
(35, 46, 19, 'Nike', 'putih', 'Kotor sedikit', 'Hati-hati pada bagian solnya', NULL, NULL, '2026-01-02 01:28:00', NULL),
(36, 47, 20, 'Adidas', 'hitam', 'sol menguning', 'hati hati', NULL, NULL, '2026-01-02 01:33:13', NULL),
(37, 47, 19, 'Nike', 'Putih', 'Sol', 'Hati-Hati', NULL, NULL, '2026-01-02 01:33:13', NULL),
(38, 48, 21, 'Nike', 'Putih', 'Kotor', 'Hati-Hati', NULL, NULL, '2026-01-02 14:01:31', NULL),
(39, 49, 20, 'Nike', 'Putih', 'Sol mengelupass', 'hati hati', NULL, NULL, '2026-01-03 11:17:02', NULL),
(40, 50, 20, 'Nike', 'Putih', 'Sol rusak', 'Hati-Hati', 'uploads/pesanan/50/sebelum_1_1767463503.jpg', NULL, '2026-01-03 12:05:03', NULL),
(41, 51, 19, 'nike', 'hitam', 'kotor', 'hati-hati', 'uploads/pesanan/51/sebelum_1_1767466518.jpg', NULL, '2026-01-03 12:55:18', NULL),
(42, 52, 20, 'Nike', 'Merah Hitam', 'Sol LEPAS', 'Hati hati', NULL, NULL, '2026-01-03 14:15:02', NULL),
(43, 53, 20, 'Nike air jordan low', 'Biru navy', 'Pasang sol baru', 'Pasang sol baru dengan warna yang sesuai sepatu', NULL, 'uploads/pesanan/53/sesudah_43_1767477172.png', '2026-01-03 14:22:09', NULL),
(44, 53, 19, 'Nb 620', 'Putih ', 'Noda di bagian body', 'Jangan di basah basahin untuk menjaga kualitas sepatu', 'uploads/pesanan/53/sebelum_2_1767471729.jpg', 'uploads/pesanan/53/sesudah_44_1767477157.jpeg', '2026-01-03 14:22:09', NULL),
(45, 54, 19, 'Nike High Dunk', 'Merah', 'Noda di body', 'Berikan yang terbaik', NULL, NULL, '2026-01-03 14:27:45', NULL),
(46, 55, 20, 'Nike', 'Merah Hitam', 'Sol LEPAS', 'Pasang sol baru dengan warna yang sesuai sepatu', NULL, NULL, '2026-01-03 16:03:31', NULL),
(47, 56, 20, 'Nike', 'Merah', 'Sol lepas', 'Tolong perbaiki solnyaa', NULL, NULL, '2026-01-04 11:21:03', NULL),
(48, 57, 20, 'Nike', 'Merah Putih', 'Sol lepas', 'Tolong perbaiki solnyaa', NULL, NULL, '2026-01-04 13:18:19', NULL),
(49, 58, 19, 'Nike', 'Merah', 'Sol Lepas', 'Khusus', NULL, NULL, '2026-01-04 15:06:37', NULL),
(50, 59, 19, 'Nike', 'Merah Putih', 'Sol lepas', 'Tolong perbaiki solnyaa', NULL, NULL, '2026-01-04 15:16:13', NULL),
(51, 60, 19, 'Nike', 'Merah Putih', 'Sol lepas', 'Tolong perbaiki solnyaa', NULL, NULL, '2026-01-04 15:20:20', NULL),
(52, 61, 20, 'Nike', 'Merah Putih', 'Sol lepas', '', NULL, NULL, '2026-01-04 15:24:13', NULL),
(53, 62, 19, 'Nike', 'Merah Putih', 'Sol lepas', 'Tolong perbaiki solnyaa', 'uploads/pesanan/62/sebelum_1_1767562024.jpg', 'uploads/pesanan/62/sesudah_53_1767563433.jpeg', '2026-01-04 15:27:04', NULL),
(54, 63, 19, 'Nike', 'Merah Putih', 'Sol lepas', '', 'uploads/pesanan/63/sebelum_1_1767562072.jpg', 'uploads/pesanan/63/sesudah_54_1767562149.jpeg', '2026-01-04 15:27:52', NULL),
(55, 64, 19, 'Nike', 'Merah', 'Sol Lepas', 'Pasang sol baru dengan warna yang sesuai sepatu', 'uploads/pesanan/64/sebelum_1_1767631693.jpg', NULL, '2026-01-05 10:48:13', NULL),
(56, 65, 19, 'Nike', 'Merah Hitam', 'Noda di body', 'Berikan yang terbaik', 'uploads/pesanan/65/sebelum_1_1767675895.jpg', NULL, '2026-01-05 23:04:55', NULL),
(57, 65, 20, 'Nb 620', 'Putih ', 'Sol lepas', 'Jangan di basah basahin untuk menjaga kualitas sepatu', 'uploads/pesanan/65/sebelum_2_1767675895.jpg', NULL, '2026-01-05 23:04:55', NULL),
(58, 66, 19, 'Nike', 'Merah Hitam', 'Noda di body', 'Berikan yang terbaik', 'uploads/pesanan/66/sebelum_1_1767675901.jpg', NULL, '2026-01-05 23:05:01', NULL),
(59, 66, 20, 'Nb 620', 'Putih ', 'Sol lepas', 'Jangan di basah basahin untuk menjaga kualitas sepatu', 'uploads/pesanan/66/sebelum_2_1767675901.jpg', NULL, '2026-01-05 23:05:01', NULL),
(60, 67, 19, 'Nike', 'Merah Hitam', 'Noda di body', 'Berikan yang terbaik', 'uploads/pesanan/67/sebelum_1_1767675902.jpg', 'uploads/pesanan/67/sesudah_60_1767676044.jpeg', '2026-01-05 23:05:02', NULL),
(61, 67, 20, 'Nb 620', 'Putih ', 'Sol lepas', 'Jangan di basah basahin untuk menjaga kualitas sepatu', 'uploads/pesanan/67/sebelum_2_1767675902.jpg', NULL, '2026-01-05 23:05:02', NULL),
(85, 104, 39, 'Nike Shoes', 'Putih', 'Sol Menguning', '', 'uploads/pesanan/104/sebelum_1_1781034567.jpg', 'uploads/pesanan/104/sesudah_1_1781035186.jpg', '2026-06-09 14:49:27', NULL),
(86, 105, 39, 'Nike Shoes', 'Putih', 'Noda', '', 'uploads/pesanan/105/sebelum_1_1781035787.jpg', NULL, '2026-06-09 15:09:47', NULL),
(87, 106, 39, 'Nike Shoes', 'Kuning', 'Kotor', '', 'uploads/pesanan/106/sebelum_1_1781036873.jpg', NULL, '2026-06-09 15:27:53', NULL),
(88, 107, 39, 'Nike Air Max', 'Kuning', 'Noda Mmebandel', '', 'uploads/pesanan/107/sebelum_1_1781037266.jpg', NULL, '2026-06-09 15:34:26', NULL),
(89, 108, 39, 'Nike Air', 'Kuning', 'Kotor', '', 'uploads/pesanan/108/sebelum_1_1781037736.jpg', 'uploads/pesanan/108/sesudah_1_1781039852.jpg', '2026-06-09 15:42:16', NULL),
(90, 111, 39, 'Nike Air Max', 'Putih', 'Noda', '', 'uploads/pesanan/111/sebelum_1_1781039901.jpg', 'uploads/pesanan/111/sesudah_1_1781041093.jpg', '2026-06-09 21:18:21', NULL),
(91, 112, 39, 'Nike', 'Putih', 'Kotor', '', 'uploads/pesanan/112/sebelum_1_1781041584.jpg', 'uploads/pesanan/112/sesudah_1_1781252095.jpg', '2026-06-09 21:46:24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback_pelanggan`
--

CREATE TABLE `feedback_pelanggan` (
  `id_feedback` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tgl_feedback` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `helpdesk_messages`
--

CREATE TABLE `helpdesk_messages` (
  `id_message` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `helpdesk_messages`
--

INSERT INTO `helpdesk_messages` (`id_message`, `id_ticket`, `id_user`, `pesan`, `is_admin`, `created_at`) VALUES
(1, 2, 23, 'Apaa teknis yang harus dibuatt', 0, '2026-01-05 20:18:29'),
(2, 2, 8, 'Lihat konfigurasi pengaturan', 1, '2026-01-05 20:35:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `helpdesk_tickets`
--

CREATE TABLE `helpdesk_tickets` (
  `id_ticket` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `kategori` enum('teknis','billing','fitur','lainnya') DEFAULT 'lainnya',
  `prioritas` enum('rendah','sedang','tinggi','urgent') DEFAULT 'sedang',
  `status` enum('open','in_progress','resolved','closed') DEFAULT 'open',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `helpdesk_tickets`
--

INSERT INTO `helpdesk_tickets` (`id_ticket`, `id_user`, `subject`, `kategori`, `prioritas`, `status`, `created_at`, `updated_at`, `closed_at`) VALUES
(2, 23, 'Chat 05 Jan 2026 20:18', 'teknis', '', 'open', '2026-01-05 20:18:29', '2026-01-05 20:35:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventori`
--

CREATE TABLE `inventori` (
  `id_inventori` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `nama_item` varchar(255) NOT NULL,
  `jenis_item` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `stok_minimal` int(11) DEFAULT 10,
  `stok_tersedia` int(11) NOT NULL,
  `harga_satuan` decimal(10,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `inventori`
--

INSERT INTO `inventori` (`id_inventori`, `id_cabang`, `nama_item`, `jenis_item`, `satuan`, `stok_minimal`, `stok_tersedia`, `harga_satuan`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 8, 'Sabun Premium Sneakers', 'Bahan', 'botol', 10, 35, 35000.00, 'Sabun khusus sneakers premium', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(17, 8, 'Sikat Bulu Halus', 'Alat', 'pcs', 5, 15, 18000.00, 'Untuk material sensitif', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(18, 8, 'Sikat Sol Keras', 'Alat', 'pcs', 5, 12, 15000.00, 'Untuk sol dan rubber', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(19, 8, 'Whitening Cream Pro', 'Bahan', 'tube', 8, 20, 45000.00, 'Pemutih sol profesional', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(20, 8, 'Microfiber Premium', 'Perlengkapan', 'pcs', 15, 60, 8000.00, 'Lap microfiber kualitas tinggi', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(21, 8, 'Leather Conditioner', 'Bahan', 'botol', 5, 12, 55000.00, 'Perawatan kulit premium', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(22, 8, 'Repaint Base Black', 'Bahan', 'botol', 3, 8, 65000.00, 'Cat dasar hitam', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(23, 8, 'Repaint Base White', 'Bahan', 'botol', 3, 10, 65000.00, 'Cat dasar putih', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(24, 8, 'Unyellowing Solution', 'Bahan', 'botol', 5, 15, 50000.00, 'Cairan anti kuning', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(25, 8, 'Shoe Deodorizer', 'Bahan', 'botol', 8, 25, 25000.00, 'Penghilang bau sepatu', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(26, 9, 'Sabun Premium Sneakers', 'Bahan', 'botol', 10, 30, 35000.00, 'Sabun khusus sneakers premium', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(27, 9, 'Sikat Bulu Halus', 'Alat', 'pcs', 5, 12, 18000.00, 'Untuk material sensitif', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(28, 9, 'Sikat Sol Keras', 'Alat', 'pcs', 5, 10, 15000.00, 'Untuk sol dan rubber', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(29, 9, 'Whitening Cream Pro', 'Bahan', 'tube', 8, 18, 45000.00, 'Pemutih sol profesional', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(30, 9, 'Microfiber Premium', 'Perlengkapan', 'pcs', 15, 55, 8000.00, 'Lap microfiber kualitas tinggi', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(31, 9, 'Leather Conditioner', 'Bahan', 'botol', 5, 10, 55000.00, 'Perawatan kulit premium', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(32, 9, 'Repaint Base Black', 'Bahan', 'botol', 3, 6, 65000.00, 'Cat dasar hitam', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(33, 9, 'Repaint Base White', 'Bahan', 'botol', 3, 8, 65000.00, 'Cat dasar putih', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(34, 9, 'Unyellowing Solution', 'Bahan', 'botol', 5, 12, 50000.00, 'Cairan anti kuning', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(35, 9, 'Shoe Deodorizer', 'Bahan', 'botol', 8, 20, 25000.00, 'Penghilang bau sepatu', '2025-12-22 06:06:36', '2026-06-10 12:22:13', NULL),
(38, 20, 'pewangi', 'Bahan', 'Botol', 5, 2, 12000.00, '', '2026-01-01 22:49:38', '2026-06-10 12:22:13', NULL),
(39, 19, 'Sabun Cair Premium', 'Alat', 'Kg', 5, 1, 2000.00, '', '2026-01-04 16:23:10', '2026-06-10 12:22:13', NULL),
(40, 19, 'Sikat Premium', 'Alat', 'Pcs', 5, 0, 1.00, '', '2026-01-04 16:27:39', '2026-06-10 12:22:13', NULL),
(41, 19, 'Lap kanebo', 'Alat', 'Pcs', 5, 5, 30000.00, NULL, '2026-01-05 23:12:49', '2026-06-10 12:22:13', NULL),
(76, 41, 'Sabun Cair', 'Bahan', 'Botol', 5, 9, 10000.00, '', '2026-06-10 12:43:17', '2026-06-10 12:43:40', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `bahasa` varchar(5) NOT NULL DEFAULT 'id',
  `mata_uang` varchar(5) NOT NULL DEFAULT 'IDR',
  `notif_pesanan` enum('0','1') NOT NULL DEFAULT '1',
  `notif_stok` enum('0','1') NOT NULL DEFAULT '1',
  `notif_shift` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_user`, `id_cabang`, `nama`, `email`, `no_telp`, `foto_profil`, `jabatan`, `alamat`, `tgl_masuk`, `created_at`, `updated_at`, `deleted_at`, `bahasa`, `mata_uang`, `notif_pesanan`, `notif_stok`, `notif_shift`) VALUES
(9, 24, 19, 'Rayan', 'duplicate@owner.com', '081279393094', 'uploads/profile/karyawan/42984425ca4f25f14e4e22b79d2dd2d8.jpg', 'Kasir', NULL, '2026-01-01', '2026-01-01 12:20:50', '2026-04-24 15:48:14', NULL, 'id', 'IDR', '1', '1', '1'),
(11, 39, 19, 'Roihan', 'roihan@gmail.com', '081959625936', NULL, 'Kasir', NULL, '2026-04-23', '2026-04-23 10:25:49', '2026-04-23 10:27:08', NULL, 'id', 'IDR', '1', '1', '1'),
(12, 40, 19, 'alifa', 'alifa@gmail.com', '081729102939', NULL, 'Kasir', NULL, '2026-04-23', '2026-04-23 12:21:48', '2026-04-23 17:22:20', '2026-04-23 12:22:20', 'id', 'IDR', '1', '1', '1'),
(86, 141, 19, 'Baskara Putra', 'baskara.putra@example.com', '081234567890', NULL, 'Kasir', 'Jl. Kaliurang KM 5, Yogyakarta', '2026-04-29', '2026-04-28 17:18:34', '2026-04-29 07:04:45', NULL, 'id', 'IDR', '1', '1', '1'),
(94, 157, 41, 'Shukii', 'shukizenzen@gmail.com', '081272644107', 'uploads/profile/karyawan/3927ecdd1ff062dcfa78c64f37ae1b1a.png', 'Kasir', NULL, '2026-06-09', '2026-06-09 14:41:47', '2026-06-09 21:28:05', NULL, 'id', 'IDR', '1', '1', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konten`
--

CREATE TABLE `konten` (
  `id_konten` int(11) NOT NULL,
  `jenis_konten` enum('tutorial','panduan','faq','artikel') NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi_konten` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `status` enum('draft','publish') DEFAULT 'draft',
  `id_admin` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `estimasi_waktu` int(11) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `id_pemilik`, `nama_layanan`, `deskripsi`, `harga`, `estimasi_waktu`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 4, 'Basic Cleaning', 'Cuci sepatu standar untuk sepatu sehari-hari', 30000.00, 2, 'aktif', '2025-12-22 06:06:35', '2025-12-29 15:26:20', '2025-12-29 09:26:20'),
(12, 4, 'Deep Cleaning', 'Cuci mendalam dengan treatment khusus', 50000.00, 3, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(13, 4, 'Premium Care', 'Cuci premium + whitening + protection', 75000.00, 4, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(14, 4, 'Fast Clean', 'Cuci express selesai 1 hari', 45000.00, 1, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(15, 4, 'Unyellowing Service', 'Hilangkan kuning pada sol sepatu', 65000.00, 3, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(16, 4, 'Repaint Pro', 'Pengecatan ulang profesional', 120000.00, 7, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(17, 4, 'Leather Treatment', 'Perawatan khusus sepatu kulit', 85000.00, 5, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(18, 4, 'Complete Restoration', 'Paket lengkap cuci + repair + repaint', 180000.00, 10, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(19, 14, 'Premium cuci sepatu', 'Cuci sepatu premium', 19000.00, 400, 'aktif', '2026-01-01 12:56:38', NULL, NULL),
(20, 14, 'Pasang Sol Sepatu Sepatu', 'Memasang sol sepatu', 50000.00, 120, 'aktif', '2026-01-02 01:30:59', NULL, NULL),
(21, 20, 'Ganti Sol', 'Menganti sol kuning dana rusak ', 90000.00, 500, 'aktif', '2026-01-02 13:59:32', NULL, NULL),
(22, 20, 'Premium Cuci Sepatu', 'Membersihkan Sepatu Lebih Bersih', 60000.00, 70, 'aktif', '2026-01-02 14:00:18', NULL, NULL),
(39, 36, 'Deep Clean Plus', 'Cuci Deep', 33000.00, 60, 'aktif', '2026-06-09 14:47:43', '2026-06-09 14:47:54', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan_inventori`
--

CREATE TABLE `layanan_inventori` (
  `id_layanan_inventori` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `nama_item` varchar(255) NOT NULL COMMENT 'Nama item inventori spesifik, misal: Sabun Premium Sneakers',
  `jumlah_dibutuhkan` decimal(10,2) NOT NULL DEFAULT 1.00 COMMENT 'Jumlah dikonsumsi per pasang sepatu',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `layanan_inventori`
--

INSERT INTO `layanan_inventori` (`id_layanan_inventori`, `id_layanan`, `nama_item`, `jumlah_dibutuhkan`, `created_at`) VALUES
(1, 11, 'Sabun Premium Sneakers', 1.00, '2026-06-10 12:29:14'),
(2, 11, 'Microfiber Premium', 1.00, '2026-06-10 12:29:14'),
(3, 12, 'Sabun Premium Sneakers', 2.00, '2026-06-10 12:29:14'),
(4, 12, 'Microfiber Premium', 1.00, '2026-06-10 12:29:14'),
(5, 13, 'Sabun Premium Sneakers', 1.00, '2026-06-10 12:29:14'),
(6, 13, 'Leather Conditioner', 1.00, '2026-06-10 12:29:14'),
(7, 15, 'Unyellowing Solution', 1.00, '2026-06-10 12:29:14'),
(8, 16, 'Repaint Base Black', 1.00, '2026-06-10 12:29:14'),
(9, 16, 'Repaint Base White', 1.00, '2026-06-10 12:29:14'),
(10, 17, 'Leather Conditioner', 1.00, '2026-06-10 12:29:14'),
(11, 19, 'Sabun Premium Sneakers', 1.00, '2026-06-10 12:29:14'),
(12, 22, 'Sabun Premium Sneakers', 1.00, '2026-06-10 12:29:14'),
(13, 39, 'Sabun Cair', 1.00, '2026-06-10 12:43:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `tgl_aktivitas` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id_log`, `id_user`, `aktivitas`, `deskripsi`, `ip_address`, `user_agent`, `tgl_aktivitas`, `created_at`, `deleted_at`) VALUES
(1, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 18:27:49', '2025-12-29 17:27:49', NULL),
(2, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 18:27:49', '2025-12-29 17:27:49', NULL),
(3, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 18:27:50', '2025-12-29 17:27:50', NULL),
(4, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 18:27:50', '2025-12-29 17:27:50', NULL),
(5, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 21:25:31', '2025-12-29 20:25:31', NULL),
(6, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 10:24:05', '2025-12-30 09:24:05', NULL),
(7, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 10:24:13', '2025-12-30 09:24:13', NULL),
(8, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 10:24:18', '2025-12-30 09:24:18', NULL),
(9, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 13:47:29', '2025-12-30 12:47:29', NULL),
(10, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 13:51:28', '2025-12-30 12:51:28', NULL),
(11, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 13:51:35', '2025-12-30 12:51:35', NULL),
(12, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 13:51:35', '2025-12-30 12:51:35', NULL),
(13, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 13:55:52', '2025-12-30 12:55:52', NULL),
(14, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 13:55:52', '2025-12-30 12:55:52', NULL),
(15, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 13:58:24', '2025-12-30 12:58:24', NULL),
(16, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 14:00:48', '2025-12-30 13:00:48', NULL),
(17, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 14:00:54', '2025-12-30 13:00:54', NULL),
(18, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 14:14:27', '2025-12-30 13:14:27', NULL),
(19, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 15:54:02', '2025-12-30 14:54:02', NULL),
(20, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 15:54:08', '2025-12-30 14:54:08', NULL),
(21, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 15:55:34', '2025-12-30 14:55:34', NULL),
(22, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 15:55:40', '2025-12-30 14:55:40', NULL),
(23, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 15:56:03', '2025-12-30 14:56:03', NULL),
(24, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 16:16:38', '2025-12-30 15:16:38', NULL),
(25, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 16:40:28', '2025-12-30 15:40:28', NULL),
(26, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 19:40:09', '2025-12-30 18:40:09', NULL),
(27, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 20:21:58', '2025-12-30 19:21:58', NULL),
(28, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 20:39:17', '2025-12-30 19:39:17', NULL),
(29, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 22:44:43', '2025-12-30 21:44:43', NULL),
(30, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-01 17:13:00', '2026-01-01 16:13:00', NULL),
(31, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-02 17:15:36', '2026-01-02 16:15:36', NULL),
(32, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 00:58:29', '2026-01-04 23:58:29', NULL),
(33, 23, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 18:15:26', '2026-01-05 17:15:26', NULL),
(34, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 18:35:07', '2026-01-05 17:35:07', NULL),
(35, 23, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 20:18:48', '2026-01-05 19:18:48', NULL),
(36, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-05 20:18:55', '2026-01-05 19:18:55', NULL),
(37, 8, 'User login', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-06 19:05:38', '2026-01-06 18:05:38', NULL),
(38, 8, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-06 19:18:03', '2026-01-06 18:18:03', NULL),
(39, 23, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-07 21:20:41', '2026-01-07 20:20:41', NULL),
(40, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 18:39:04', '2026-01-28 17:39:04', NULL),
(41, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-28 19:29:15', '2026-01-28 18:29:15', NULL),
(42, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 15:23:38', '2026-04-23 13:23:38', NULL),
(43, 33, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 15:27:35', '2026-04-23 13:27:35', NULL),
(44, 33, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 15:28:11', '2026-04-23 13:28:11', NULL),
(45, 33, 'User logout', NULL, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', '2026-04-23 15:30:04', '2026-04-23 13:30:04', NULL),
(46, 33, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 15:31:33', '2026-04-23 13:31:33', NULL),
(47, 33, 'Auto-login via Remember Me', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 16:18:10', '2026-04-23 14:18:10', NULL),
(48, 33, 'Auto-login via Remember Me', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 16:18:29', '2026-04-23 14:18:29', NULL),
(49, 33, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 16:19:38', '2026-04-23 14:19:38', NULL),
(50, 23, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 16:23:09', '2026-04-23 14:23:09', NULL),
(51, 23, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', '2026-04-23 18:36:44', '2026-04-23 16:36:44', NULL),
(52, 147, 'User logout', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', '2026-06-09 19:46:31', '2026-06-09 17:46:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `no_nota` varchar(255) NOT NULL,
  `tgl_cetak` datetime NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `total_bayar` decimal(10,2) NOT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `type` enum('order','payment','pickup','stock','report','general') DEFAULT 'general',
  `related_id` int(11) DEFAULT NULL COMMENT 'ID pesanan/transaksi terkait',
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id_notification`, `id_pemilik`, `title`, `message`, `type`, `related_id`, `is_read`, `created_at`, `read_at`, `deleted_at`) VALUES
(17, 36, 'Pesanan Baru #PES-20260610-001', 'Pesanan baru PES-20260610-001 diterima di cabang Cabang Utama.', 'order', 111, 1, '2026-06-09 21:18:21', '2026-06-09 21:18:26', NULL),
(18, 36, 'Pembayaran Diterima', 'Pembayaran untuk pesanan #PES-20260610-001 di cabang Cabang Utama sebesar Rp 33.000 telah diterima.', 'payment', 111, 1, '2026-06-09 21:19:22', '2026-06-09 21:20:20', NULL),
(19, 36, 'Status Pesanan Diperbarui', 'Status pesanan #PES-20260610-001 di cabang Cabang Utama berubah menjadi: Dalam Proses.', 'order', 111, 1, '2026-06-09 21:19:46', '2026-06-09 21:20:20', NULL),
(20, 36, 'Status Pesanan Diperbarui', 'Status pesanan #PES-20260610-001 di cabang Cabang Utama berubah menjadi: Selesai.', 'order', 111, 1, '2026-06-09 21:19:53', '2026-06-09 21:20:20', NULL),
(21, 36, 'Status Pesanan Diperbarui', 'Status pesanan #PES-20260610-001 di cabang Cabang Utama berubah menjadi: Siap Diambil.', 'pickup', 111, 1, '2026-06-09 21:27:09', '2026-06-09 21:28:17', NULL),
(22, 36, 'Status Pesanan Diperbarui', 'Status pesanan #PES-20260610-001 di cabang Cabang Utama berubah menjadi: Sudah Diambil.', 'pickup', 111, 1, '2026-06-09 21:27:14', '2026-06-09 21:28:17', NULL),
(23, 36, 'Pesanan Baru #PES-20260610-002', 'Pesanan baru PES-20260610-002 diterima di cabang Cabang Utama.', 'order', 112, 1, '2026-06-09 21:46:24', '2026-06-09 21:46:41', NULL),
(24, 36, 'Status Pesanan Diperbarui', 'Status pesanan #PES-20260610-002 di cabang Cabang Utama berubah menjadi: Dalam Proses.', 'order', 112, 1, '2026-06-10 12:43:40', '2026-06-12 09:12:36', NULL),
(25, 36, 'Status Pesanan Diperbarui', 'Status pesanan #PES-20260610-002 di cabang Cabang Utama berubah menjadi: Selesai.', 'order', 112, 1, '2026-06-10 12:43:52', '2026-06-12 09:12:36', NULL),
(26, 36, 'Status Pesanan Diperbarui', 'Status pesanan #PES-20260610-002 di cabang Cabang Utama berubah menjadi: Siap Diambil.', 'pickup', 112, 1, '2026-06-10 13:44:18', '2026-06-12 09:12:36', NULL),
(27, 36, 'Status Pesanan Diperbarui', 'Status pesanan #PES-20260610-002 di cabang Cabang Utama berubah menjadi: Sudah Diambil.', 'pickup', 112, 1, '2026-06-12 08:27:38', '2026-06-12 09:12:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `type` enum('admin','pemilik','karyawan') NOT NULL DEFAULT 'pemilik',
  `id_user` int(11) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_sessions`
--

CREATE TABLE `oauth_sessions` (
  `id_session` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `provider` varchar(50) NOT NULL COMMENT 'google, facebook, dll',
  `provider_user_id` varchar(255) NOT NULL COMMENT 'ID dari provider (google_id, facebook_id, dll)',
  `access_token` text DEFAULT NULL,
  `refresh_token` text DEFAULT NULL,
  `token_expires_at` datetime DEFAULT NULL,
  `scope` text DEFAULT NULL COMMENT 'OAuth scopes yang diberikan',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabel untuk tracking OAuth sessions';

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_state_tokens`
--

CREATE TABLE `oauth_state_tokens` (
  `id_state` int(11) NOT NULL,
  `state_token` varchar(64) NOT NULL,
  `redirect_uri` varchar(500) DEFAULT NULL,
  `is_used` tinyint(1) DEFAULT 0,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabel untuk CSRF protection OAuth state tokens';

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_langganan`
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
-- Dumping data untuk tabel `paket_langganan`
--

INSERT INTO `paket_langganan` (`id_paket`, `nama_paket`, `deskripsi`, `harga`, `durasi_hari`, `fitur_aktif`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Basic', 'Paket dasar untuk usaha kecil', 99000.00, 30, '{\"cabang\": 1, \"karyawan\": 2}', 'aktif', '2025-12-16 17:00:21', '2025-12-29 10:00:39', NULL),
(2, 'Professional', 'Paket untuk usaha menengah', 199000.00, 30, '{\"cabang\": 3, \"karyawan\": 10}', 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(3, 'Bisnis', 'Paket untuk usaha besar', 399000.00, 30, '{\"cabang\": -1, \"karyawan\": -1}', 'aktif', '2025-12-16 17:00:21', '2026-01-01 17:18:43', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id_reset` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_used` tinyint(1) DEFAULT 0,
  `expires_at` datetime NOT NULL,
  `used` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `used_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id_reset`, `id_user`, `token`, `email`, `is_used`, `expires_at`, `used`, `created_at`, `used_at`) VALUES
(1, 8, '484246b0f951130fe4787eb8f4ff918a2039ff028f348988774e6773bfcdff57', 'hattapramana@gmail.com', 0, '2025-12-22 11:16:12', 0, '2025-12-22 10:16:12', NULL),
(2, 23, '9dd6a276214c07ca456445720e98cc7905c488aaef1895b4a62c9e813aca166d', '', 0, '2025-12-31 00:31:27', 0, '2025-12-30 23:31:27', NULL),
(3, 23, '731ccf3a453b0269a2664b19f7617374109fbf8f611e873c57b1e3a0540cec43', '', 0, '2026-01-01 17:13:29', 0, '2026-01-01 16:13:29', NULL),
(4, 23, 'e5e25284ad79c544adabaa72e4a05e365b25a001dc0ab15ad2a9794e0b22b6de', '', 0, '2026-01-01 17:34:20', 1, '2026-01-01 16:34:20', '2026-01-01 16:35:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_audit_log`
--

CREATE TABLE `payment_audit_log` (
  `id` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `id_pesanan` int(11) DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `request_payload` text DEFAULT NULL,
  `response_code` varchar(10) DEFAULT NULL,
  `error_message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_configs`
--

CREATE TABLE `payment_configs` (
  `id` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `provider` varchar(50) NOT NULL DEFAULT 'midtrans',
  `environment` enum('sandbox','production') NOT NULL DEFAULT 'sandbox',
  `merchant_id` varchar(100) DEFAULT NULL,
  `server_key` text NOT NULL,
  `client_key` text NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_configs`
--

INSERT INTO `payment_configs` (`id`, `id_pemilik`, `provider`, `environment`, `merchant_id`, `server_key`, `client_key`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 14, 'midtrans', 'sandbox', 'G-19', 'd24fa84292761915f19b3cbae371736d9583313d9c523ad5e0ded62e8c8cd4643f113c7318c15ee5587bda3e0943c1d7141c220e5b5e83b0bf172dfe9cd9f0f4aw1Q/8Wbioy03YIwJgxTkW3yOq+tf1gvq7f2zQ/NzieWYVpwR3dwvx/J93JloZ017xEnTOpxtF/mL71/yy0FhA==', '3fb2defe7c74a46a833e4fc902deb91366931bb75395118f89905fa2b3f42be41083331cf23c6812b1cd814ed85736ff034a90ca7008575d787e50889a1f93f5jehYr5oVp0P19pLA1mDn9gKIIeCY+7yPs5a19WtORznrBnDOGSgDRK3o+DLOJPN0', 1, '2026-01-06 05:59:54', '2026-01-06 05:59:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_cabang` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `level` enum('Basic','Member','VIP','Platinum') NOT NULL DEFAULT 'Basic',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_cabang`, `nama`, `no_telp`, `email`, `alamat`, `level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 19, 'Riko Mahendra', '6281279393094', 'riskypangestu057@gmail.com', 'jl.seturan', 'Basic', '2026-01-01 12:49:38', NULL, NULL),
(28, 19, 'Rizki Pangestu', '6285922409428', 'riskypangestu@gmail.com', 'Kost Putra Salsabiela 2,Jl.Lawu, Seturan, Caturtunggal, Depok (Jl. Lawu 05 no 03) DEPOK, KAB. SLEMAN, DI YOGYAKARTA', 'VIP', '2026-01-02 00:18:33', '2026-01-04 17:02:39', NULL),
(29, 27, 'Rizki Pangestu', '6285336003883', 'riskypangestu057@gmail.com', 'Jl.Seturan Raya, jalan Jangkar bumi no 304', 'Basic', '2026-01-02 13:56:07', NULL, NULL),
(30, 19, 'Rashad', '6282138417934', 'auliarashad@gmail.com', 'jl.jangkar bumi, seturan raya, sleman', 'Basic', '2026-01-03 14:12:03', NULL, NULL),
(31, 19, 'Iphled', '081935306842', 'riskypangestu057@gmail.com', 'Cw Ugm, sleman jogja', 'Basic', '2026-01-03 16:02:11', NULL, NULL),
(32, NULL, 'Hatta Pramana', '081272644107', 'hattapramana@gmail.com', 'Jl. Jambu No 11 CondongCatur', 'Basic', '2026-04-28 12:00:54', NULL, NULL),
(33, 8, 'Pelanggan Baskara', '089999999', NULL, NULL, 'Basic', '2026-04-29 06:57:17', NULL, NULL),
(49, NULL, 'Arif Wicaksono', '081400001001', 'arif.w@gmail.com', 'Jl. Seturan No. 22, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(50, NULL, 'Bella Safitri', '081400001002', 'bella.s@gmail.com', 'Jl. Babarsari No. 15, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(51, NULL, 'Cahya Pratama', '081400001003', 'cahya.p@gmail.com', 'Jl. Affandi No. 8, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(52, NULL, 'Dinda Maharani', '081400001004', 'dinda.m@gmail.com', 'Jl. Gejayan No. 17, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(53, NULL, 'Eko Raharjo', '081400001005', 'eko.r@gmail.com', 'Jl. Colombo No. 9, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(54, NULL, 'Fitria Dewi', '081400001006', 'fitria.d@gmail.com', 'Jl. Laksda Adisucipto No. 50, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(55, NULL, 'Gilang Ramadhan', '081400001007', 'gilang.r@gmail.com', 'Jl. Demangan Baru No. 12, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(56, NULL, 'Hana Permata', '081400001008', 'hana.p2@gmail.com', 'Jl. Kaliurang Km 6.5, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(57, NULL, 'Irfan Maulana', '081400001009', 'irfan.m2@gmail.com', 'Jl. Pogung Raya No. 30, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(58, NULL, 'Jasmine Putri', '081400001010', 'jasmine.p2@gmail.com', 'Jl. Monjali No. 25, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(59, NULL, 'Kevin Prasetya', '081400001011', 'kevin.p2@gmail.com', 'Jl. Palagan Km 5, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(60, NULL, 'Luna Anggraini', '081400001012', 'luna.a2@gmail.com', 'Jl. Magelang No. 40, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(61, NULL, 'Mario Santoso', '081400001013', 'mario.s2@gmail.com', 'Jl. Godean Km 3, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(62, NULL, 'Nadia Utami', '081400001014', 'nadia.u2@gmail.com', 'Jl. Wates Km 2, Yogyakarta', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(63, NULL, 'Oscar Firmansyah', '081400001015', 'oscar.f2@gmail.com', 'Jl. Condongcatur No. 18, Sleman', 'Basic', '2026-06-09 18:46:11', NULL, NULL),
(64, 41, 'Alieffa Faiz ', '62882000907161', 'alieffafaiz@gmail.com', 'Jl. Alma Ata', 'Basic', '2026-06-09 14:44:06', NULL, NULL),
(65, 41, 'Hatta Pramana', '6281272644107', 'hattajunior1@gmail.com', 'Jl. Jambu No 11', 'Basic', '2026-06-09 14:45:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `nama_transaksi` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_pesanan` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `id_cabang`, `nama_transaksi`, `kategori`, `jumlah`, `tgl_transaksi`, `id_pesanan`, `keterangan`, `id_karyawan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 8, 'Pembayaran AT-20251201-001', 'pesanan', 30000.00, '2025-12-01', NULL, 'Basic Cleaning Nike Air Force', NULL, '2025-12-22 06:06:36', NULL, NULL),
(5, 8, 'Pembayaran AT-20251202-001', 'pesanan', 150000.00, '2025-12-02', NULL, 'Premium Care 2 pasang', NULL, '2025-12-22 06:06:36', NULL, NULL),
(6, 8, 'Pembayaran AT-20251205-001', 'pesanan', 50000.00, '2025-12-05', NULL, 'Deep Cleaning Vans', NULL, '2025-12-22 06:06:36', NULL, NULL),
(7, 8, 'Pembayaran AT-20251208-001', 'pesanan', 65000.00, '2025-12-08', NULL, 'Unyellowing Service', NULL, '2025-12-22 06:06:36', NULL, NULL),
(8, 8, 'Pembayaran AT-20251210-001', 'pesanan', 45000.00, '2025-12-10', NULL, 'Fast Clean', NULL, '2025-12-22 06:06:36', NULL, NULL),
(9, 8, 'Pembayaran AT-20251212-001', 'pesanan', 85000.00, '2025-12-12', NULL, 'Leather Treatment', NULL, '2025-12-22 06:06:36', NULL, NULL),
(10, 8, 'Pembayaran AT-20251215-001', 'pesanan', 60000.00, '2025-12-15', NULL, 'Basic Clean 2 pasang', NULL, '2025-12-22 06:06:36', NULL, NULL),
(11, 9, 'Pembayaran AT-20251201-002', 'pesanan', 30000.00, '2025-12-01', NULL, 'Basic Cleaning Converse', NULL, '2025-12-22 06:06:36', NULL, NULL),
(12, 9, 'Pembayaran AT-20251203-001', 'pesanan', 45000.00, '2025-12-03', NULL, 'Fast Clean Adidas', NULL, '2025-12-22 06:06:36', NULL, NULL),
(13, 9, 'Pembayaran AT-20251205-002', 'pesanan', 180000.00, '2025-12-05', NULL, 'Complete Restoration', NULL, '2025-12-22 06:06:36', NULL, NULL),
(14, 9, 'Pembayaran AT-20251207-001', 'pesanan', 75000.00, '2025-12-07', NULL, 'Premium Care Reebok', NULL, '2025-12-22 06:06:36', NULL, NULL),
(15, 9, 'Pembayaran AT-20251210-002', 'pesanan', 100000.00, '2025-12-10', NULL, 'Deep Clean 2 pasang', NULL, '2025-12-22 06:06:36', NULL, NULL),
(16, 12, 'penjualan', 'Penjualan', 7000000.00, '2025-12-29', NULL, NULL, NULL, '2025-12-29 08:15:05', '2025-12-29 15:55:53', '2025-12-29 09:55:53'),
(17, 19, 'Pembayaran Pesanan #PES-20260102-001', 'pesanan', 19000.00, '2026-01-02', 31, 'Pembayaran tunai - Riko Mahendra', 9, '2026-01-01 23:11:13', NULL, NULL),
(18, 19, 'Pembayaran Pesanan #PES-20260102-002', 'pesanan', 19000.00, '2026-01-02', 32, 'Pembayaran tunai - Riko Mahendra', 9, '2026-01-02 00:20:35', NULL, NULL),
(19, 19, 'Pembayaran Pesanan #PES-20260102-003', 'pesanan', 19000.00, '2026-01-02', 33, 'Pembayaran tunai - Rizki Pangestu', 9, '2026-01-02 00:46:31', NULL, NULL),
(20, 19, 'Pembayaran Pesanan #PES-20260102-005', 'pesanan', 69000.00, '2026-01-02', 47, 'Pembayaran qris - Rizki Pangestu', 9, '2026-01-02 01:33:42', NULL, NULL),
(21, 27, 'Pembayaran Pesanan #PES-20260102-006', 'pesanan', 90000.00, '2026-01-02', 48, 'Pembayaran debit - Rizki Pangestu', NULL, '2026-01-02 14:05:45', NULL, NULL),
(22, 19, 'Pembayaran Pesanan #PES-20260103-005', 'pesanan', 69000.00, '2026-01-03', 53, 'Pembayaran debit - Rashad', 9, '2026-01-03 15:22:10', NULL, NULL),
(23, 19, 'Pembayaran Pesanan #PES-20260103-006', 'pesanan', 19000.00, '2026-01-03', 54, 'Pembayaran qris - Rizki Pangestu', 9, '2026-01-03 15:23:03', NULL, NULL),
(24, 19, 'Pembayaran Pesanan #PES-20260103-004', 'pesanan', 50000.00, '2026-01-03', 52, 'Pembayaran qris - Rashad', 9, '2026-01-03 15:33:17', NULL, NULL),
(25, 19, 'Pembayaran Pesanan #PES-20260103-003', 'pesanan', 19000.00, '2026-01-03', 51, 'Pembayaran qris - Riko Mahendra', 9, '2026-01-03 15:45:03', NULL, NULL),
(26, 19, 'Pembayaran Pesanan #PES-20260103-007', 'pesanan', 50000.00, '2026-01-03', 55, 'Pembayaran qris - Iphled', 9, '2026-01-03 16:05:04', NULL, NULL),
(27, 19, 'Pembayaran Pesanan #PES-20260104-002', 'pesanan', 50000.00, '2026-01-04', 57, 'Pembayaran qris - Riko Mahendra', 9, '2026-01-04 13:19:25', NULL, NULL),
(28, 19, 'Pembayaran Pesanan #PES-20260104-008', 'pesanan', 19000.00, '2026-01-04', 63, 'Pembayaran qris - Riko Mahendra', 9, '2026-01-04 15:47:38', NULL, NULL),
(29, 19, 'Pembayaran Pesanan #PES-20260106-003', 'pesanan', 69000.00, '2026-01-06', 67, 'Pembayaran qris - Riko Mahendra', 9, '2026-01-05 23:09:47', NULL, NULL),
(52, 41, 'Pembayaran Pesanan #PES-20260609-002', 'pesanan', 33000.00, '2026-06-09', 105, 'Pembayaran tunai - Hatta Pramana', 94, '2026-06-09 15:10:20', '2026-06-09 20:45:36', '2026-06-09 20:45:36'),
(53, 41, 'Pembayaran Pesanan #PES-20260609-003', 'pesanan', 33000.00, '2026-06-09', 106, 'Pembayaran tunai - Alieffa Faiz ', 94, '2026-06-09 15:29:01', '2026-06-09 20:42:44', '2026-06-09 15:42:44'),
(54, 41, 'Pembayaran Pesanan #PES-20260609-004', 'pesanan', 33000.00, '2026-06-09', 107, 'Pembayaran tunai - Alieffa Faiz ', 94, '2026-06-09 15:35:21', '2026-06-09 20:42:41', '2026-06-09 15:42:41'),
(55, 41, 'Pembayaran Pesanan #PES-20260609-005', 'Layanan', 33000.00, '2026-06-10', 108, 'Pembayaran tunai - Hatta Pramana', 94, '2026-06-09 20:45:25', '2026-06-09 20:50:07', NULL),
(56, 8, 'Pembayaran Pesanan #TEST-1781039788', 'pesanan', 50000.00, '2026-06-10', NULL, 'Pembayaran qris - Riko Mahendra', NULL, '2026-06-09 21:16:28', NULL, NULL),
(57, 41, 'Pembayaran Pesanan #PES-20260610-001', 'pesanan', 33000.00, '2026-06-10', 111, 'Pembayaran debit - Alieffa Faiz ', 94, '2026-06-09 21:19:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilik`
--

CREATE TABLE `pemilik` (
  `id_pemilik` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kota_code` varchar(10) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `provinsi_code` varchar(10) DEFAULT NULL,
  `jam_buka` time DEFAULT '08:00:00',
  `jam_tutup` time DEFAULT '21:00:00',
  `status_langganan` enum('aktif','nonaktif','trial') DEFAULT 'trial',
  `id_paket` int(11) DEFAULT NULL,
  `profile_completed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `bahasa` varchar(5) DEFAULT 'id' COMMENT 'Language preference: id/en',
  `mata_uang` varchar(5) DEFAULT 'IDR' COMMENT 'Currency preference: IDR/USD',
  `notif_pesanan` enum('0','1') DEFAULT '1' COMMENT 'Enable order notifications',
  `notif_stok` enum('0','1') DEFAULT '1' COMMENT 'Enable stock notifications',
  `notif_laporan` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemilik`
--

INSERT INTO `pemilik` (`id_pemilik`, `id_user`, `nama`, `email`, `no_telp`, `foto_profil`, `nama_usaha`, `logo`, `alamat`, `kota`, `kota_code`, `provinsi`, `provinsi_code`, `jam_buka`, `jam_tutup`, `status_langganan`, `id_paket`, `profile_completed`, `created_at`, `updated_at`, `deleted_at`, `bahasa`, `mata_uang`, `notif_pesanan`, `notif_stok`, `notif_laporan`) VALUES
(4, 9, 'AetherTech', 'rizkipangestu852@gmail.com', NULL, 'uploads/profile/profile_4_1766421273.jpg', 'AetherTech\'s Business', NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '21:00:00', 'aktif', 2, 0, '2025-12-21 22:50:54', '2026-06-09 21:16:28', NULL, 'id', 'IDR', '1', '1', '1'),
(7, 16, 'Rizki Pangestu', 'riskypangestu057@gmail.com', NULL, 'uploads/profile/profile_7_1767018913.png', 'Rizki Pangestu\'s Business', NULL, NULL, NULL, NULL, NULL, NULL, '08:00:00', '21:00:00', 'trial', NULL, 0, '2025-12-29 08:04:45', '2025-12-29 08:35:13', NULL, 'id', 'IDR', '1', '1', '1'),
(14, 23, 'Stronity', 'stronity@gmail.com', '6281279393094', 'uploads/profile/profile_14_1767290255.jpg', 'Stronity', NULL, 'Jl.seturan', 'KABUPATEN SLEMAN', '3404', 'DI YOGYAKARTA', '34', '08:00:00', '21:00:00', 'aktif', 2, 1, '2025-12-30 21:46:48', '2026-01-05 12:27:06', NULL, 'id', 'IDR', '1', '1', '1'),
(20, 30, 'RIZKI PANGESTU 23.12.3029', 'riskypangestu057@students.amikom.ac.id', NULL, 'uploads/profile/profile_20_1767379346.png', 'KickWash', NULL, 'Jl.Seturan Raya, jalan Jangkar bumi no 34', 'KABUPATEN SLEMAN', '3404', 'DI YOGYAKARTA', '34', '08:00:00', '21:00:00', 'trial', NULL, 1, '2026-01-02 12:34:18', '2026-01-02 12:42:26', NULL, 'id', 'IDR', '1', '1', '1'),
(21, 32, 'Prabowo', 'rashcorp99@gmail.com', '6282138417934', NULL, 'Subianto', NULL, 'Manchester Unted', 'KOTA PAYAKUMBUH', '1376', 'SUMATERA BARAT', '13', '08:00:00', '21:00:00', 'trial', NULL, 1, '2026-01-03 18:34:05', '2026-01-03 12:34:49', NULL, 'id', 'IDR', '1', '1', '1'),
(36, 156, 'Hatta Pramana', 'hattajunior1@gmail.com', '6285922409428', 'uploads/profile/profile_36_1781039144.png', 'Toko Hatta', 'uploads/logos/logo_36_1781034062.png', 'Jl. Jambu No 11', 'KOTA YOGYAKARTA', '3471', 'DI YOGYAKARTA', '34', '08:00:00', '21:00:00', 'aktif', 3, 1, '2026-06-09 19:40:07', '2026-06-09 21:05:44', NULL, 'id', 'IDR', '1', '1', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pending_registrations`
--

CREATE TABLE `pending_registrations` (
  `id_pending` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `wa_verification_code` varchar(6) NOT NULL,
  `email_verification_code` varchar(6) DEFAULT NULL,
  `wa_code_expires_at` datetime NOT NULL,
  `email_code_expires_at` datetime DEFAULT NULL,
  `wa_code_sent_at` datetime NOT NULL,
  `email_code_sent_at` datetime DEFAULT NULL,
  `attempts` int(11) DEFAULT 0,
  `wa_verified` tinyint(1) DEFAULT 0,
  `email_verified` tinyint(1) DEFAULT 0,
  `is_verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pending_registrations`
--

INSERT INTO `pending_registrations` (`id_pending`, `nama`, `email`, `password_hash`, `nama_usaha`, `no_telp`, `wa_verification_code`, `email_verification_code`, `wa_code_expires_at`, `email_code_expires_at`, `wa_code_sent_at`, `email_code_sent_at`, `attempts`, `wa_verified`, `email_verified`, `is_verified`, `created_at`) VALUES
(2, 'James simatupang', 'la.rhayan@gmail.com', '$2y$10$GSsn703T2kJVhAjUuMqt6OE53T6cnJ//vnr5MhTK.gxi3xa1hmawu', 'cucisepatu', '6285336003883', '944655', NULL, '2025-12-30 20:06:55', NULL, '2025-12-30 20:01:55', NULL, 0, 0, 0, 0, '2025-12-30 19:00:14'),
(3, 'Almira desy', 'riskypangestu057@students.amikom.ac.id', '$2y$10$o4Za/siorThHAoUB/Wz0jOOEht2zxoouSlr4FIe2QjfbrK5aTX6za', 'mire', '6285727188022', '101523', NULL, '2025-12-30 20:46:00', NULL, '2025-12-30 20:41:00', NULL, 0, 0, 0, 1, '2025-12-30 19:41:00'),
(4, 'Rizki Pangestu', 'rizkipangestu291@gmail.com', '$2y$10$/xWqgg1.UzFY5tHQhfqUNeI8vPMWlrVJqhics4npuyBE0SyfHsVgm', 'Stronity', '6281279393094', '267167', NULL, '2025-12-31 03:25:32', NULL, '2025-12-31 03:20:32', NULL, 0, 0, 0, 1, '2025-12-30 20:20:32'),
(5, 'Rizki Pangestu', 'rayanborn19@students.amikom.ac.id', '$2y$10$ZIQx9fbmieRYEBtbLJAsZurUAzLr4NFoeFckaeYwLBTEvEPJQsimK', 'Stronity', '6281279393094', '503063', NULL, '2025-12-31 03:41:04', NULL, '2025-12-31 03:36:04', NULL, 0, 0, 0, 1, '2025-12-30 20:36:04'),
(8, 'Stronity', 'stronity@gmail.com', '$2y$10$SyC7XMcBpZqERRIDanAbtOZzuO.bwd3xcIL5SGU5Wv5lCZBwn5gja', 'Stronity', '6281279393094', '951113', '375755', '2025-12-31 04:50:59', '2025-12-31 04:50:59', '2025-12-31 04:45:59', '2025-12-31 04:45:59', 0, 1, 1, 1, '2025-12-30 21:45:59'),
(9, 'Rizki Pangestu', 'office.gasniaditama@gmail.com', '$2y$10$rIur8H2YYZRX0NA7Au5tAuFWNpOujmbmyJnul0HHHo/uAZKjHvEay', 'Sanscarae', '6281279393094', '635161', '139863', '2026-01-02 22:29:45', '2026-01-02 22:29:45', '2026-01-02 22:24:45', '2026-01-02 22:24:45', 0, 0, 0, 0, '2026-01-02 15:24:45'),
(10, 'Prabowo', 'rashcorp99@gmail.com', '$2y$10$AS1Wq9r.iNhINXnffCGi0.LTRBkLbmYHdOmY4lw9j3J8ZwAW7iXwK', 'Subianto', '6282138417934', '219335', '347542', '2026-01-04 01:36:50', '2026-01-04 01:36:50', '2026-01-04 01:31:50', '2026-01-04 01:31:50', 1, 1, 1, 1, '2026-01-03 18:31:50'),
(16, 'Hatta Pramana', 'shukizenzen@gmail.com', '$2y$10$1P.rQmh.v5mcApG9O.j./.KOLeekip9SBTYdsQFBBlI5Ql9VZ6Tv2', 'Toko Hatta', '6285922409428', '032630', '975180', '2026-06-09 23:28:21', '2026-06-09 23:28:22', '2026-06-09 23:23:21', '2026-06-09 23:23:22', 0, 0, 1, 1, '2026-06-09 16:23:21'),
(17, 'Hatta Pramana', 'hattajunior1@gmail.com', '$2y$10$pkInjFqSJyxaKNsmGnB8oeaUqMD.B30I.5a.xkVRamOR4k7oCzoQW', 'Toko Hatta', '6285922409428', '073227', '027387', '2026-06-10 02:44:36', '2026-06-10 02:44:27', '2026-06-10 02:39:36', '2026-06-10 02:39:27', 0, 1, 0, 1, '2026-06-09 19:39:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `nama_transaksi` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_cabang`, `nama_transaksi`, `kategori`, `jumlah`, `tgl_transaksi`, `keterangan`, `id_karyawan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 8, 'Restock Sabun Premium', 'bahan', 350000.00, '2025-12-01', 'Beli sabun 10 botol', NULL, '2025-12-22 06:06:36', NULL, NULL),
(7, 8, 'Tagihan Listrik Desember', 'operasional', 120000.00, '2025-12-01', 'Listrik bulan Desember', NULL, '2025-12-22 06:06:36', NULL, NULL),
(8, 8, 'Restock Whitening Cream', 'bahan', 270000.00, '2025-12-05', 'Beli 6 tube whitening', NULL, '2025-12-22 06:06:36', NULL, NULL),
(9, 8, 'Gaji Karyawan Minggu 1', 'gaji', 600000.00, '2025-12-07', 'Gaji 2 karyawan minggu 1', NULL, '2025-12-22 06:06:36', NULL, NULL),
(10, 8, 'Restock Cat Repaint', 'bahan', 390000.00, '2025-12-10', 'Cat hitam & putih', NULL, '2025-12-22 06:06:36', NULL, NULL),
(11, 8, 'Biaya Air PDAM', 'operasional', 80000.00, '2025-12-12', 'Tagihan air Desember', NULL, '2025-12-22 06:06:36', NULL, NULL),
(12, 8, 'Maintenance Peralatan', 'operasional', 150000.00, '2025-12-15', 'Service mesin pengering', NULL, '2025-12-22 06:06:36', NULL, NULL),
(13, 9, 'Restock Sabun Premium', 'bahan', 350000.00, '2025-12-02', 'Beli sabun 10 botol', NULL, '2025-12-22 06:06:36', NULL, NULL),
(14, 9, 'Tagihan Listrik Desember', 'operasional', 110000.00, '2025-12-01', 'Listrik bulan Desember', NULL, '2025-12-22 06:06:36', NULL, NULL),
(15, 9, 'Restock Leather Care', 'bahan', 275000.00, '2025-12-06', 'Leather conditioner 5 botol', NULL, '2025-12-22 06:06:36', NULL, NULL),
(16, 9, 'Gaji Karyawan Minggu 1', 'gaji', 600000.00, '2025-12-08', 'Gaji 2 karyawan minggu 1', NULL, '2025-12-22 06:06:36', NULL, NULL),
(17, 9, 'Restock Microfiber', 'perlengkapan', 200000.00, '2025-12-11', 'Lap microfiber 25 pcs', NULL, '2025-12-22 06:06:36', NULL, NULL),
(18, 9, 'Biaya Air PDAM', 'operasional', 75000.00, '2025-12-12', 'Tagihan air Desember', NULL, '2025-12-22 06:06:36', '2025-12-29 14:27:58', '2025-12-29 08:27:58'),
(19, 19, 'Pembelian Pewangi', 'bahan', 10000.00, '2026-01-02', 'Pembelian stok awal 1 Kg @ Rp 10.000', 9, '2026-01-01 22:48:40', NULL, NULL),
(20, 20, 'Pembelian pewangi', 'bahan', 48000.00, '2026-01-02', 'Pembelian stok awal 4 Botol @ Rp 12.000', 9, '2026-01-01 22:49:38', NULL, NULL),
(21, 19, 'Pembelian Sabun Cair Premium', 'alat', 2000.00, '2026-01-04', 'Pembelian stok awal 1 Kg @ Rp 2.000', 9, '2026-01-04 16:23:10', NULL, NULL),
(22, 19, 'Pembelian Sikat Premium', 'perlengakapan', 1.00, '2026-01-04', 'Pembelian stok awal 1 Pcs @ Rp 1', 9, '2026-01-04 16:27:39', NULL, NULL),
(23, 19, 'Pembelian Lap kanebo', 'alat', 150000.00, '2026-01-06', 'Pembelian stok awal 5 Pcs @ Rp 30.000', 9, '2026-01-05 23:12:49', NULL, NULL),
(37, 41, 'Pembelian Sabun Cair', 'bahan', 50000.00, '2026-06-10', 'Pembelian stok awal 1 Botol @ Rp 50.000', 94, '2026-06-09 20:55:24', '2026-06-10 12:44:34', '2026-06-10 12:44:34'),
(38, 8, 'Pembelian Test Chemical 1781039730', 'bahan', 250000.00, '2026-06-10', 'Pembelian stok awal 10 Liter @ Rp 25.000', NULL, '2026-06-09 21:15:30', NULL, NULL),
(39, 8, 'Pembelian Test Chemical 1781039788', 'bahan', 250000.00, '2026-06-10', 'Pembelian stok awal 10 Liter @ Rp 25.000', NULL, '2026-06-09 21:16:28', NULL, NULL),
(40, 41, 'Pembelian Sabun Cair', 'bahan', 100000.00, '2026-06-10', 'Pembelian stok awal 10 Botol @ Rp 10.000', 94, '2026-06-10 12:15:57', '2026-06-10 12:44:26', '2026-06-10 12:44:26'),
(41, 41, 'Pembelian Sabun Cair', 'bahan', 100000.00, '2026-06-10', 'Pembelian stok awal 10 Botol @ Rp 10.000', 94, '2026-06-10 12:43:17', '2026-06-10 12:44:22', '2026-06-10 12:44:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `tgl_masuk` datetime NOT NULL,
  `tgl_estimasi_selesai` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `tgl_diambil` datetime DEFAULT NULL,
  `jumlah_item` int(11) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `metode_pembayaran` enum('tunai','debit','qris') DEFAULT NULL,
  `payment_external_id` varchar(100) DEFAULT NULL,
  `status_pembayaran` enum('belum_bayar','sudah_bayar') DEFAULT 'belum_bayar',
  `status_pesanan` enum('diterima','dalam_proses','selesai','siap_diambil','sudah_diambil','dibatalkan') DEFAULT 'diterima',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nomor_pesanan` varchar(50) DEFAULT NULL,
  `kode_verifikasi` varchar(10) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL COMMENT 'Path foto bukti pembayaran QRIS Manual'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, `tgl_masuk`, `tgl_estimasi_selesai`, `tgl_selesai`, `tgl_diambil`, `jumlah_item`, `total_harga`, `metode_pembayaran`, `payment_external_id`, `status_pembayaran`, `status_pesanan`, `catatan`, `created_at`, `updated_at`, `deleted_at`, `nomor_pesanan`, `kode_verifikasi`, `bukti_pembayaran`) VALUES
(31, 19, 27, 19, 9, '2026-01-02 12:06:00', '2026-01-10 12:06:00', NULL, NULL, 1, 19000.00, 'tunai', NULL, 'sudah_bayar', 'dalam_proses', '', '2026-01-01 23:07:09', '2026-01-03 14:10:20', NULL, 'PES-20260102-001', NULL, NULL),
(32, 19, 27, 19, 9, '2026-01-02 13:01:00', '2026-01-02 13:01:00', '2026-01-03 16:56:34', NULL, 1, 19000.00, 'tunai', NULL, 'sudah_bayar', 'selesai', '', '2026-01-02 00:02:32', '2026-01-03 09:56:34', NULL, 'PES-20260102-002', NULL, NULL),
(33, 19, 28, 19, 9, '2026-01-02 13:18:00', '2026-01-03 13:18:00', NULL, NULL, 1, 19000.00, 'tunai', NULL, 'sudah_bayar', 'diterima', '', '2026-01-02 00:20:17', '2026-01-02 00:46:31', NULL, 'PES-20260102-003', NULL, NULL),
(46, 19, 27, 19, 9, '2026-01-02 14:27:00', '2026-01-03 14:27:00', '2026-01-03 22:17:41', '2026-01-03 22:17:47', 1, 19000.00, 'tunai', NULL, 'sudah_bayar', 'sudah_diambil', 'Fast londryy', '2026-01-02 01:28:00', '2026-01-03 15:17:47', NULL, 'PES-20260102-004', NULL, NULL),
(47, 19, 28, 20, 9, '2026-01-02 14:31:00', '2026-01-03 14:31:00', NULL, NULL, 2, 69000.00, 'qris', NULL, 'sudah_bayar', 'dalam_proses', 'Untuk sepatu adidas jangan di buat basah atau kena air cukup di lap dan gosok dengan bahan pembersihh\r\n', '2026-01-02 01:33:13', '2026-01-03 14:08:42', NULL, 'PES-20260102-005', NULL, NULL),
(48, 27, 29, 21, NULL, '2026-01-03 03:00:00', '2026-01-04 03:00:00', NULL, NULL, 1, 90000.00, 'debit', NULL, 'sudah_bayar', 'diterima', '', '2026-01-02 14:01:31', '2026-01-02 14:05:45', NULL, 'PES-20260102-006', NULL, NULL),
(49, 19, 28, 20, 9, '2026-01-04 00:15:00', '2026-01-05 00:16:00', NULL, NULL, 1, 50000.00, 'tunai', NULL, 'belum_bayar', 'dibatalkan', 'Sol Sepatu terkelupas tolong di lem dan saya akan beri fee', '2026-01-03 11:17:02', '2026-01-03 14:12:29', NULL, 'PES-20260103-001', NULL, NULL),
(50, 19, 27, 20, 9, '2026-01-04 01:04:00', '2026-01-15 01:04:00', NULL, NULL, 1, 50000.00, 'tunai', NULL, 'belum_bayar', 'diterima', 'Bersih', '2026-01-03 12:05:03', NULL, NULL, 'PES-20260103-002', NULL, NULL),
(51, 19, 27, 19, 9, '2026-01-04 01:54:00', '2026-01-01 01:54:00', '2026-01-03 22:45:14', NULL, 1, 19000.00, 'qris', 'ORD-19-51-1767476325', 'sudah_bayar', 'selesai', '', '2026-01-03 12:55:18', '2026-01-03 15:45:14', NULL, 'PES-20260103-003', NULL, NULL),
(52, 19, 30, 20, 9, '2026-01-04 03:14:00', '2026-01-07 03:13:00', NULL, NULL, 1, 50000.00, 'qris', 'ORD-19-52-1767475490', 'sudah_bayar', 'diterima', 'Untuk kedua pesanan saya kalo bisa di selesaikan dengan cepat', '2026-01-03 14:15:02', '2026-01-03 15:33:17', NULL, 'PES-20260103-004', NULL, NULL),
(53, 19, 30, 20, 9, '2026-01-04 03:19:00', '2026-01-05 03:19:00', '2026-01-03 22:51:42', NULL, 2, 69000.00, 'debit', 'ORD-19-53-1767475097', 'sudah_bayar', 'selesai', 'Sol mau lepaas tolong di lem kan nanti di kasih fee', '2026-01-03 14:22:09', '2026-01-03 15:51:42', NULL, 'PES-20260103-005', NULL, NULL),
(54, 19, 28, 19, 9, '2026-01-04 03:26:00', '2026-01-07 03:26:00', '2026-01-03 21:28:09', '2026-01-03 21:28:18', 1, 19000.00, 'qris', 'ORD-19-54-1767475348', 'sudah_bayar', 'sudah_diambil', 'ya', '2026-01-03 14:27:45', '2026-01-03 15:23:03', NULL, 'PES-20260103-006', NULL, NULL),
(55, 19, 31, 20, 9, '2026-01-04 05:02:00', '2026-01-07 05:02:00', '2026-01-03 23:06:35', NULL, 1, 50000.00, 'qris', 'ORD-19-55-1767477845', 'sudah_bayar', 'selesai', 'Maaf sepatunya lumayan bau sampah\r\n', '2026-01-03 16:03:31', '2026-01-03 16:06:35', NULL, 'PES-20260103-007', NULL, NULL),
(56, 19, 31, 20, 9, '2026-01-05 00:19:00', '2026-01-08 00:19:00', NULL, NULL, 1, 50000.00, 'tunai', NULL, 'belum_bayar', 'diterima', 'Sepatu kotorr tidak terawatt', '2026-01-04 11:21:03', NULL, NULL, 'PES-20260104-001', 'FJPJVX', NULL),
(57, 19, 27, 20, 9, '2026-01-05 02:17:00', '2026-01-08 02:17:00', NULL, NULL, 1, 50000.00, 'qris', 'ORD-19-57-1767554333', 'sudah_bayar', 'diterima', 'Tolong Perbaiki', '2026-01-04 13:18:19', '2026-01-04 13:19:25', NULL, 'PES-20260104-002', 'QPZ4F8', NULL),
(58, 19, 27, 19, 9, '2026-01-05 04:05:00', '2026-01-08 04:05:00', NULL, NULL, 1, 19000.00, 'tunai', NULL, 'belum_bayar', 'diterima', 'Kurang sol yang lebih baik', '2026-01-04 15:06:37', NULL, NULL, 'PES-20260104-003', '4P3DD8', NULL),
(59, 19, 27, 19, 9, '2026-01-05 04:15:00', '2026-01-08 04:15:00', '2026-01-04 22:52:10', NULL, 1, 19000.00, '', NULL, 'belum_bayar', 'selesai', '', '2026-01-04 15:16:13', '2026-01-04 15:52:10', NULL, 'PES-20260104-004', 'DF8SFX', NULL),
(60, 19, 27, 19, 9, '2026-01-05 04:19:00', '2026-01-08 04:19:00', NULL, NULL, 1, 19000.00, '', NULL, 'belum_bayar', 'diterima', 'ya', '2026-01-04 15:20:20', NULL, NULL, 'PES-20260104-005', '8CERW2', NULL),
(61, 19, 27, 20, 9, '2026-01-05 04:23:00', '2026-01-08 04:23:00', NULL, NULL, 1, 50000.00, '', NULL, 'belum_bayar', 'diterima', '', '2026-01-04 15:24:13', NULL, NULL, 'PES-20260104-006', 'SWS5JJ', NULL),
(62, 19, 31, 19, 9, '2026-01-05 04:26:00', '2026-01-08 04:26:00', '2026-01-04 22:50:21', NULL, 1, 19000.00, '', NULL, 'belum_bayar', 'selesai', '', '2026-01-04 15:27:04', '2026-01-04 15:50:21', NULL, 'PES-20260104-007', 'VZDXSR', NULL),
(63, 19, 27, 19, 9, '2026-01-05 04:27:00', '2026-01-08 04:27:00', '2026-01-04 22:28:29', NULL, 1, 19000.00, 'qris', NULL, 'sudah_bayar', 'selesai', '', '2026-01-04 15:27:52', '2026-01-04 15:47:38', NULL, 'PES-20260104-008', 'PUUDL8', 'uploads/bukti_bayar/63/bukti_1767563258.jpg'),
(64, 19, 28, 19, 9, '2026-01-05 23:47:00', '2026-01-08 23:47:00', NULL, NULL, 1, 19000.00, '', NULL, 'belum_bayar', 'diterima', 'Tolong perbaiki sollnya', '2026-01-05 10:48:13', NULL, NULL, 'PES-20260105-001', '44VQUU', NULL),
(65, 19, 27, 19, 9, '2026-01-06 12:02:00', '2026-01-01 12:02:00', NULL, NULL, 2, 69000.00, '', NULL, 'belum_bayar', 'diterima', 'Perbaikan Sol', '2026-01-05 23:04:55', NULL, NULL, 'PES-20260106-001', 'AG8JZW', NULL),
(66, 19, 27, 19, 9, '2026-01-06 12:02:00', '2026-01-01 12:02:00', NULL, NULL, 2, 69000.00, '', NULL, 'belum_bayar', 'diterima', 'Perbaikan Sol', '2026-01-05 23:05:00', NULL, NULL, 'PES-20260106-002', 'FWQS23', NULL),
(67, 19, 27, 19, 9, '2026-01-06 12:02:00', '2026-01-01 12:02:00', '2026-01-06 06:07:14', NULL, 2, 69000.00, 'qris', 'ORD-19-67-1767676138', 'sudah_bayar', 'selesai', 'Perbaikan Sol', '2026-01-05 23:05:02', '2026-01-05 23:09:47', NULL, 'PES-20260106-003', 'H3P6LT', NULL),
(77, 8, 33, 11, 86, '2026-04-29 13:57:29', NULL, NULL, NULL, 1, 30000.00, NULL, NULL, 'belum_bayar', 'diterima', 'Match Test: Diterima', '2026-04-29 06:57:29', NULL, NULL, 'MATCH-001', NULL, NULL),
(78, 8, 33, 11, 86, '2026-04-28 13:57:29', NULL, NULL, NULL, 1, 35000.00, NULL, NULL, 'sudah_bayar', 'dalam_proses', 'Match Test: Dalam Proses', '2026-04-29 06:57:29', NULL, NULL, 'MATCH-002', NULL, NULL),
(79, 8, 33, 11, 86, '2026-04-27 13:57:29', NULL, NULL, NULL, 1, 40000.00, NULL, NULL, 'sudah_bayar', 'selesai', 'Match Test: Selesai', '2026-04-29 06:57:29', NULL, NULL, 'MATCH-003', NULL, NULL),
(80, 8, 33, 11, 86, '2026-04-26 13:57:29', NULL, NULL, NULL, 1, 50000.00, NULL, NULL, 'sudah_bayar', 'siap_diambil', 'Match Test: Siap Diambil', '2026-04-29 06:57:29', NULL, NULL, 'MATCH-004', NULL, NULL),
(81, 8, 33, 11, 86, '2026-04-24 13:57:29', NULL, NULL, NULL, 1, 60000.00, NULL, NULL, 'sudah_bayar', 'sudah_diambil', 'Match Test: Sudah Diambil', '2026-04-29 06:57:29', NULL, NULL, 'MATCH-005', NULL, NULL),
(82, 8, 33, 11, 86, '2026-04-28 13:57:29', NULL, NULL, NULL, 1, 0.00, NULL, NULL, 'belum_bayar', 'dibatalkan', 'Match Test: Dibatalkan', '2026-04-29 06:57:29', NULL, NULL, 'MATCH-006', NULL, NULL),
(104, 41, 65, 39, 94, '2026-06-10 00:00:00', '2026-06-10 19:48:00', '2026-06-09 21:58:27', '2026-06-09 22:07:16', 1, 33000.00, 'tunai', NULL, 'sudah_bayar', 'sudah_diambil', '', '2026-06-09 14:49:27', '2026-06-09 20:41:40', '2026-06-09 15:41:40', 'PES-20260609-001', NULL, NULL),
(105, 41, 65, 39, 94, '2026-06-10 03:09:00', '2026-06-13 03:09:00', '2026-06-09 22:27:23', '2026-06-09 22:27:29', 1, 33000.00, 'tunai', NULL, 'sudah_bayar', 'sudah_diambil', '', '2026-06-09 15:09:47', '2026-06-09 20:41:38', '2026-06-09 15:41:38', 'PES-20260609-002', NULL, NULL),
(106, 41, 64, 39, 94, '2026-06-10 03:27:00', '2026-06-11 03:33:00', '2026-06-09 22:32:43', '2026-06-09 22:33:11', 1, 33000.00, 'tunai', NULL, 'sudah_bayar', 'sudah_diambil', '', '2026-06-09 15:27:53', '2026-06-09 20:41:36', '2026-06-09 15:41:36', 'PES-20260609-003', NULL, NULL),
(107, 41, 64, 39, 94, '2026-06-10 03:33:00', '2026-06-10 23:36:00', '2026-06-09 22:35:06', '2026-06-09 22:35:34', 1, 33000.00, 'tunai', NULL, 'sudah_bayar', 'sudah_diambil', '', '2026-06-09 15:34:26', '2026-06-09 20:41:34', '2026-06-09 15:41:34', 'PES-20260609-004', NULL, NULL),
(108, 41, 65, 39, 94, '2026-06-10 03:41:00', '2026-06-11 03:41:00', '2026-06-09 22:43:23', '2026-06-10 03:45:20', 1, 33000.00, 'tunai', NULL, 'sudah_bayar', 'sudah_diambil', '', '2026-06-09 15:42:16', '2026-06-12 09:16:25', NULL, 'PES-20260609-005', NULL, NULL),
(111, 41, 64, 39, 94, '2026-06-10 04:17:00', '2026-06-11 04:18:00', '2026-06-10 04:19:53', '2026-06-10 04:27:14', 1, 33000.00, 'debit', NULL, 'sudah_bayar', 'sudah_diambil', '', '2026-06-09 21:18:21', '2026-06-09 21:38:13', NULL, 'PES-20260610-001', NULL, NULL),
(112, 41, 64, 39, 94, '2026-06-10 04:46:00', '0000-00-00 00:00:00', '2026-06-10 19:43:52', '2026-06-12 15:27:38', 1, 33000.00, 'tunai', NULL, 'sudah_bayar', 'sudah_diambil', '', '2026-06-09 21:46:24', '2026-06-12 08:27:38', NULL, 'PES-20260610-002', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `progres_pesanan`
--

CREATE TABLE `progres_pesanan` (
  `id_progres` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `tgl_update` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `progres_pesanan`
--

INSERT INTO `progres_pesanan` (`id_progres`, `id_pesanan`, `status`, `deskripsi`, `id_karyawan`, `tgl_update`, `created_at`, `deleted_at`) VALUES
(10, 31, 'diterima', 'Pesanan diterima', 9, '2026-01-02 06:07:09', '2026-01-01 23:07:09', NULL),
(11, 31, 'pembayaran', 'Pembayaran Tunai - Rp 19.000', 9, '2026-01-02 06:11:13', '2026-01-01 23:11:13', NULL),
(12, 31, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-02 06:11:16', '2026-01-01 23:11:16', NULL),
(13, 32, 'diterima', 'Pesanan diterima', 9, '2026-01-02 07:02:32', '2026-01-02 00:02:32', NULL),
(14, 33, 'diterima', 'Pesanan diterima', 9, '2026-01-02 07:20:17', '2026-01-02 00:20:17', NULL),
(15, 32, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-02 07:20:24', '2026-01-02 00:20:24', NULL),
(16, 32, 'pembayaran', 'Pembayaran Tunai - Rp 19.000', 9, '2026-01-02 07:20:35', '2026-01-02 00:20:35', NULL),
(17, 33, 'pembayaran', 'Pembayaran Tunai - Rp 19.000', 9, '2026-01-02 07:46:31', '2026-01-02 00:46:31', NULL),
(18, 46, 'diterima', 'Pesanan diterima', 9, '2026-01-02 08:28:00', '2026-01-02 01:28:00', NULL),
(19, 47, 'diterima', 'Pesanan diterima', 9, '2026-01-02 08:33:13', '2026-01-02 01:33:13', NULL),
(20, 47, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-02 08:33:31', '2026-01-02 01:33:31', NULL),
(21, 47, 'pembayaran', 'Pembayaran QRIS - Rp 69.000', 9, '2026-01-02 08:33:42', '2026-01-02 01:33:42', NULL),
(22, 48, 'diterima', 'Pesanan diterima', NULL, '2026-01-02 21:01:31', '2026-01-02 14:01:31', NULL),
(23, 48, 'pembayaran', 'Pembayaran Debit/Transfer - Rp 90.000', NULL, '2026-01-02 21:05:45', '2026-01-02 14:05:45', NULL),
(24, 32, 'selesai', 'Pesanan selesai dikerjakan', 9, '2026-01-03 16:56:34', '2026-01-03 09:56:34', NULL),
(25, 49, 'diterima', 'Pesanan diterima', 9, '2026-01-03 18:17:02', '2026-01-03 11:17:02', NULL),
(26, 49, 'dibatalkan', 'Pesanan dibatalkan', 9, '2026-01-03 18:17:14', '2026-01-03 11:17:14', NULL),
(27, 50, 'diterima', 'Pesanan diterima', 9, '2026-01-03 19:05:03', '2026-01-03 12:05:03', NULL),
(28, 51, 'diterima', 'Pesanan diterima', 9, '2026-01-03 19:55:18', '2026-01-03 12:55:18', NULL),
(29, 51, 'diterima', 'Pesanan diterima', 9, '2026-01-03 21:08:30', '2026-01-03 14:08:30', NULL),
(30, 51, 'diterima', 'Pesanan diterima', 9, '2026-01-03 21:08:34', '2026-01-03 14:08:34', NULL),
(31, 51, 'diterima', 'Pesanan diterima', 9, '2026-01-03 21:08:38', '2026-01-03 14:08:38', NULL),
(32, 47, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-03 21:08:42', '2026-01-03 14:08:42', NULL),
(33, 51, 'diterima', 'Pesanan diterima', 9, '2026-01-03 21:10:10', '2026-01-03 14:10:10', NULL),
(34, 31, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-03 21:10:20', '2026-01-03 14:10:20', NULL),
(35, 51, 'diterima', 'Pesanan diterima', 9, '2026-01-03 21:12:23', '2026-01-03 14:12:23', NULL),
(36, 51, 'diterima', 'Pesanan diterima', 9, '2026-01-03 21:12:26', '2026-01-03 14:12:26', NULL),
(37, 49, 'dibatalkan', 'Pesanan dibatalkan', 9, '2026-01-03 21:12:29', '2026-01-03 14:12:29', NULL),
(38, 52, 'diterima', 'Pesanan diterima', 9, '2026-01-03 21:15:02', '2026-01-03 14:15:02', NULL),
(39, 53, 'diterima', 'Pesanan diterima', 9, '2026-01-03 21:22:09', '2026-01-03 14:22:09', NULL),
(40, 54, 'diterima', 'Pesanan diterima', 9, '2026-01-03 21:27:45', '2026-01-03 14:27:45', NULL),
(41, 54, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-03 21:28:05', '2026-01-03 14:28:05', NULL),
(42, 54, 'selesai', 'Pesanan selesai dikerjakan', 9, '2026-01-03 21:28:09', '2026-01-03 14:28:09', NULL),
(43, 54, 'siap_diambil', 'Pesanan siap untuk diambil', 9, '2026-01-03 21:28:13', '2026-01-03 14:28:13', NULL),
(44, 54, 'sudah_diambil', 'Pesanan sudah diambil oleh pelanggan', 9, '2026-01-03 21:28:18', '2026-01-03 14:28:18', NULL),
(45, 46, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-03 22:17:38', '2026-01-03 15:17:38', NULL),
(46, 46, 'selesai', 'Pesanan selesai dikerjakan', 9, '2026-01-03 22:17:41', '2026-01-03 15:17:41', NULL),
(47, 46, 'siap_diambil', 'Pesanan siap untuk diambil', 9, '2026-01-03 22:17:44', '2026-01-03 15:17:44', NULL),
(48, 46, 'sudah_diambil', 'Pesanan sudah diambil oleh pelanggan', 9, '2026-01-03 22:17:47', '2026-01-03 15:17:47', NULL),
(49, 53, 'pembayaran', 'Pembayaran Debit/Transfer - Rp 69.000', 9, '2026-01-03 22:22:10', '2026-01-03 15:22:10', NULL),
(50, 54, 'pembayaran', 'Pembayaran QRIS - Rp 19.000', 9, '2026-01-03 22:23:03', '2026-01-03 15:23:03', NULL),
(51, 52, 'pembayaran', 'Pembayaran QRIS - Rp 50.000', 9, '2026-01-03 22:33:17', '2026-01-03 15:33:17', NULL),
(52, 51, 'pembayaran', 'Pembayaran QRIS - Rp 19.000', 9, '2026-01-03 22:45:03', '2026-01-03 15:45:03', NULL),
(53, 51, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-03 22:45:10', '2026-01-03 15:45:10', NULL),
(54, 51, 'selesai', 'Pesanan selesai dikerjakan', 9, '2026-01-03 22:45:14', '2026-01-03 15:45:14', NULL),
(55, 53, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-03 22:51:38', '2026-01-03 15:51:38', NULL),
(56, 53, 'selesai', 'Pesanan selesai dikerjakan', 9, '2026-01-03 22:51:42', '2026-01-03 15:51:42', NULL),
(57, 55, 'diterima', 'Pesanan diterima', 9, '2026-01-03 23:03:31', '2026-01-03 16:03:31', NULL),
(58, 55, 'pembayaran', 'Pembayaran QRIS - Rp 50.000', 9, '2026-01-03 23:05:04', '2026-01-03 16:05:04', NULL),
(59, 55, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-03 23:06:08', '2026-01-03 16:06:08', NULL),
(60, 55, 'selesai', 'Pesanan selesai dikerjakan', 9, '2026-01-03 23:06:35', '2026-01-03 16:06:35', NULL),
(61, 56, 'diterima', 'Pesanan diterima', 9, '2026-01-04 18:21:03', '2026-01-04 11:21:03', NULL),
(62, 57, 'diterima', 'Pesanan diterima', 9, '2026-01-04 20:18:19', '2026-01-04 13:18:19', NULL),
(63, 57, 'pembayaran', 'Pembayaran QRIS - Rp 50.000', 9, '2026-01-04 20:19:25', '2026-01-04 13:19:25', NULL),
(64, 58, 'diterima', 'Pesanan diterima', 9, '2026-01-04 22:06:37', '2026-01-04 15:06:37', NULL),
(65, 59, 'diterima', 'Pesanan diterima', 9, '2026-01-04 22:16:13', '2026-01-04 15:16:13', NULL),
(66, 60, 'diterima', 'Pesanan diterima', 9, '2026-01-04 22:20:20', '2026-01-04 15:20:20', NULL),
(67, 61, 'diterima', 'Pesanan diterima', 9, '2026-01-04 22:24:13', '2026-01-04 15:24:13', NULL),
(68, 62, 'diterima', 'Pesanan diterima', 9, '2026-01-04 22:27:04', '2026-01-04 15:27:04', NULL),
(69, 63, 'diterima', 'Pesanan diterima', 9, '2026-01-04 22:27:52', '2026-01-04 15:27:52', NULL),
(70, 63, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-04 22:28:26', '2026-01-04 15:28:26', NULL),
(71, 63, 'selesai', 'Pesanan selesai dikerjakan', 9, '2026-01-04 22:28:29', '2026-01-04 15:28:29', NULL),
(72, 63, 'pembayaran', 'Pembayaran QRIS - Rp 19.000', 9, '2026-01-04 22:47:38', '2026-01-04 15:47:38', NULL),
(73, 62, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-04 22:50:17', '2026-01-04 15:50:17', NULL),
(74, 62, 'selesai', 'Pesanan selesai dikerjakan', 9, '2026-01-04 22:50:21', '2026-01-04 15:50:21', NULL),
(75, 59, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-04 22:52:07', '2026-01-04 15:52:07', NULL),
(76, 59, 'selesai', 'Pesanan selesai dikerjakan', 9, '2026-01-04 22:52:10', '2026-01-04 15:52:10', NULL),
(77, 64, 'diterima', 'Pesanan diterima', 9, '2026-01-05 17:48:13', '2026-01-05 10:48:13', NULL),
(78, 65, 'diterima', 'Pesanan diterima', 9, '2026-01-06 06:04:55', '2026-01-05 23:04:55', NULL),
(79, 66, 'diterima', 'Pesanan diterima', 9, '2026-01-06 06:05:01', '2026-01-05 23:05:01', NULL),
(80, 67, 'diterima', 'Pesanan diterima', 9, '2026-01-06 06:05:02', '2026-01-05 23:05:02', NULL),
(81, 67, 'dalam_proses', 'Pesanan sedang diproses', 9, '2026-01-06 06:07:10', '2026-01-05 23:07:10', NULL),
(82, 67, 'selesai', 'Pesanan selesai dikerjakan', 9, '2026-01-06 06:07:14', '2026-01-05 23:07:14', NULL),
(83, 67, 'pembayaran', 'Pembayaran QRIS - Rp 69.000', 9, '2026-01-06 06:09:47', '2026-01-05 23:09:47', NULL),
(102, 104, 'diterima', 'Pesanan diterima', 94, '2026-06-09 21:49:27', '2026-06-09 14:49:27', NULL),
(103, 104, 'dalam_proses', 'Pesanan sedang diproses', 94, '2026-06-09 21:58:11', '2026-06-09 14:58:11', NULL),
(104, 104, 'selesai', 'Pesanan selesai dikerjakan', 94, '2026-06-09 21:58:27', '2026-06-09 14:58:27', NULL),
(105, 104, 'siap_diambil', 'Pesanan siap untuk diambil', 94, '2026-06-09 21:58:32', '2026-06-09 14:58:32', NULL),
(106, 104, 'sudah_diambil', 'Pesanan sudah diambil oleh pelanggan', 94, '2026-06-09 21:59:59', '2026-06-09 14:59:59', NULL),
(107, 104, 'siap_diambil', 'Pesanan siap untuk diambil', 94, '2026-06-09 22:07:09', '2026-06-09 15:07:09', NULL),
(108, 104, 'sudah_diambil', 'Pesanan sudah diambil oleh pelanggan', 94, '2026-06-09 22:07:16', '2026-06-09 15:07:16', NULL),
(109, 105, 'diterima', 'Pesanan diterima', 94, '2026-06-09 22:09:47', '2026-06-09 15:09:47', NULL),
(110, 105, 'pembayaran', 'Pembayaran Tunai - Rp 33.000', 94, '2026-06-09 22:10:20', '2026-06-09 15:10:20', NULL),
(111, 105, 'dalam_proses', 'Pesanan sedang diproses', 94, '2026-06-09 22:27:19', '2026-06-09 15:27:19', NULL),
(112, 105, 'selesai', 'Pesanan selesai dikerjakan', 94, '2026-06-09 22:27:23', '2026-06-09 15:27:23', NULL),
(113, 105, 'siap_diambil', 'Pesanan siap untuk diambil', 94, '2026-06-09 22:27:25', '2026-06-09 15:27:25', NULL),
(114, 105, 'sudah_diambil', 'Pesanan sudah diambil oleh pelanggan', 94, '2026-06-09 22:27:29', '2026-06-09 15:27:29', NULL),
(115, 106, 'diterima', 'Pesanan diterima', 94, '2026-06-09 22:27:53', '2026-06-09 15:27:53', NULL),
(116, 106, 'pembayaran', 'Pembayaran Tunai - Rp 33.000', 94, '2026-06-09 22:29:01', '2026-06-09 15:29:01', NULL),
(117, 106, 'dalam_proses', 'Pesanan sedang diproses', 94, '2026-06-09 22:29:14', '2026-06-09 15:29:14', NULL),
(118, 106, 'selesai', 'Pesanan selesai dikerjakan', 94, '2026-06-09 22:32:43', '2026-06-09 15:32:43', NULL),
(119, 106, 'siap_diambil', 'Pesanan siap untuk diambil', 94, '2026-06-09 22:33:08', '2026-06-09 15:33:08', NULL),
(120, 106, 'sudah_diambil', 'Pesanan sudah diambil oleh pelanggan', 94, '2026-06-09 22:33:11', '2026-06-09 15:33:11', NULL),
(121, 107, 'diterima', 'Pesanan diterima', 94, '2026-06-09 22:34:26', '2026-06-09 15:34:26', NULL),
(122, 107, 'dalam_proses', 'Pesanan sedang diproses', 94, '2026-06-09 22:34:54', '2026-06-09 15:34:54', NULL),
(123, 107, 'selesai', 'Pesanan selesai dikerjakan', 94, '2026-06-09 22:35:06', '2026-06-09 15:35:06', NULL),
(124, 107, 'siap_diambil', 'Pesanan siap untuk diambil', 94, '2026-06-09 22:35:13', '2026-06-09 15:35:13', NULL),
(125, 107, 'pembayaran', 'Pembayaran Tunai - Rp 33.000', 94, '2026-06-09 22:35:21', '2026-06-09 15:35:21', NULL),
(126, 107, 'sudah_diambil', 'Pesanan sudah diambil oleh pelanggan', 94, '2026-06-09 22:35:34', '2026-06-09 15:35:34', NULL),
(127, 108, 'diterima', 'Pesanan diterima', 94, '2026-06-09 22:42:16', '2026-06-09 15:42:16', NULL),
(128, 108, 'dalam_proses', 'Pesanan sedang diproses', 94, '2026-06-09 22:43:21', '2026-06-09 15:43:21', NULL),
(129, 108, 'selesai', 'Pesanan selesai dikerjakan', 94, '2026-06-09 22:43:23', '2026-06-09 15:43:23', NULL),
(130, 108, 'siap_diambil', 'Pesanan siap untuk diambil', 94, '2026-06-09 22:43:26', '2026-06-09 15:43:26', NULL),
(131, 108, 'sudah_diambil', 'Pesanan sudah diambil oleh pelanggan', 94, '2026-06-10 03:45:20', '2026-06-09 20:45:20', NULL),
(132, 108, 'pembayaran', 'Pembayaran Tunai - Rp 33.000', 94, '2026-06-10 03:45:25', '2026-06-09 20:45:25', NULL),
(134, 111, 'diterima', 'Pesanan diterima', 94, '2026-06-10 04:18:21', '2026-06-09 21:18:21', NULL),
(135, 111, 'pembayaran', 'Pembayaran Debit/Transfer - Rp 33.000', 94, '2026-06-10 04:19:22', '2026-06-09 21:19:22', NULL),
(136, 111, 'dalam_proses', 'Pesanan sedang diproses', 94, '2026-06-10 04:19:46', '2026-06-09 21:19:46', NULL),
(137, 111, 'selesai', 'Pesanan selesai dikerjakan', 94, '2026-06-10 04:19:53', '2026-06-09 21:19:53', NULL),
(138, 111, 'siap_diambil', 'Pesanan siap untuk diambil', 94, '2026-06-10 04:27:09', '2026-06-09 21:27:09', NULL),
(139, 111, 'sudah_diambil', 'Pesanan sudah diambil oleh pelanggan', 94, '2026-06-10 04:27:14', '2026-06-09 21:27:14', NULL),
(140, 112, 'diterima', 'Pesanan diterima', 94, '2026-06-10 04:46:24', '2026-06-09 21:46:24', NULL),
(141, 112, 'dalam_proses', 'Pesanan sedang diproses', 94, '2026-06-10 19:43:40', '2026-06-10 12:43:40', NULL),
(142, 112, 'selesai', 'Pesanan selesai dikerjakan', 94, '2026-06-10 19:43:52', '2026-06-10 12:43:52', NULL),
(143, 112, 'siap_diambil', 'Pesanan siap untuk diambil', 94, '2026-06-10 20:44:18', '2026-06-10 13:44:18', NULL),
(144, 112, 'sudah_diambil', 'Pesanan sudah diambil oleh pelanggan', 94, '2026-06-12 15:27:38', '2026-06-12 08:27:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekomendasi_ai`
--

CREATE TABLE `rekomendasi_ai` (
  `id_rekomendasi` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `recommendation_text` text NOT NULL COMMENT 'Teks rekomendasi lengkap dari AI',
  `insights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Array of key insights (3 items)' CHECK (json_valid(`insights`)),
  `impact_prediction` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Predicted impact percentages (revenue, retention, efficiency)' CHECK (json_valid(`impact_prediction`)),
  `business_data_snapshot` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Business data yang digunakan untuk generate rekomendasi' CHECK (json_valid(`business_data_snapshot`)),
  `status` enum('new','saved','implemented','archived') DEFAULT 'new' COMMENT 'Status rekomendasi',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='AI-generated business recommendations';

--
-- Dumping data untuk tabel `rekomendasi_ai`
--

INSERT INTO `rekomendasi_ai` (`id_rekomendasi`, `id_pemilik`, `recommendation_text`, `insights`, `impact_prediction`, `business_data_snapshot`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'saved', '2025-12-22 07:49:23', '2025-12-22 07:49:53'),
(2, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 07:52:12', '2025-12-22 13:52:12'),
(3, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 07:58:00', '2025-12-22 13:58:00'),
(4, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:10:02', '2025-12-22 14:10:02'),
(5, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:11:23', '2025-12-22 14:11:23'),
(6, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:14:36', '2025-12-22 14:14:36'),
(7, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:17:13', '2025-12-22 14:17:13'),
(8, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:18:44', '2025-12-22 14:18:44'),
(9, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:21:19', '2025-12-22 14:21:19'),
(10, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:25:14', '2025-12-22 14:25:14'),
(11, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:26:04', '2025-12-22 14:26:04'),
(12, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:30:10', '2025-12-22 14:30:10'),
(13, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:33:26', '2025-12-22 14:33:26'),
(14, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:37:05', '2025-12-22 14:37:05'),
(15, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:41:41', '2025-12-22 14:41:41'),
(16, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:46:27', '2025-12-22 14:46:27'),
(17, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:50:51', '2025-12-22 14:50:51'),
(18, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 08:54:39', '2025-12-22 14:54:39'),
(19, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 09:58:02', '2025-12-22 15:58:02'),
(20, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-22 10:10:30', '2025-12-22 16:10:30'),
(21, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Fast Clean\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-23 05:46:19', '2025-12-23 11:46:19'),
(22, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Fast Clean\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-23 05:47:16', '2025-12-23 11:47:16'),
(23, 4, 'Untuk meningkatkan customer retention, KixEra harus fokus pada tiga area utama: 1) **Implementasi Program Loyalitas:** Buat program poin atau tier yang memberikan reward kepada pelanggan setiap kali mereka menggunakan layanan. Misalnya, setiap Rp 100.000 akumulasi belanja, pelanggan mendapatkan diskon Rp 10.000 untuk layanan berikutnya, atau gratis layanan \'Basic Cleaning\' setelah 5 kali pemesanan. 2) **Personalisasi Komunikasi Pasca-Layanan & Feedback:** Setelah layanan selesai dan sepatu dikembalikan, kirim pesan personalisasi (misal: WhatsApp atau email) yang menanyakan kepuasan pelanggan dan menawarkan diskon kecil (misal: 5-10%) untuk pesanan berikutnya dalam jangka waktu tertentu (misal: 2-4 minggu) sebagai insentif untuk kembali. Aktifkan saluran feedback yang mudah diakses. 3) **Optimalisasi Pengelolaan \'Pending Pickups\' dan Notifikasi Proaktif:** Perbaiki proses komunikasi dan penjadwalan untuk \'Pending Pickups\' agar lebih efisien dan transparan. Kirim notifikasi proaktif kepada pelanggan untuk mengingatkan mereka tentang kebutuhan perawatan sepatu secara berkala (misal: setiap 1-2 bulan atau setelah musim hujan) atau promosi khusus untuk layanan terpopuler seperti Basic Cleaning dan Premium Care.', '[\"Dengan 15 pelanggan aktif dan 20 pesanan bulan ini, ada basis yang kuat untuk membangun program loyalitas dan mendorong repeat purchase.\",\"Rata-rata Order Value (AOV) sebesar Rp 45.750 menunjukkan bahwa insentif kecil pun sudah cukup menarik dan dapat meningkatkan frekuensi pembelian.\",\"Manajemen \'Pending Pickups\' yang efisien akan meningkatkan kepuasan pelanggan dan mengurangi potensi friksi, yang krusial untuk pengalaman retensi.\",\"Layanan terpopuler (Basic Cleaning, Premium Care, Fast Clean) dapat menjadi fokus utama untuk penawaran loyalitas atau paket bundling.\"]', '{\"revenue\":15,\"retention\":20,\"efficiency\":10}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Fast Clean\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-23 05:47:51', '2025-12-23 11:47:51'),
(24, 4, 'Untuk menentukan budget marketing bulan depan KixEra, lakukan langkah-langkah berikut:\n1.  **Tetapkan Tujuan Marketing Spesifik:** Tentukan target kuantitatif yang jelas untuk bulan depan. Contoh: \'Meningkatkan jumlah total pesanan menjadi 30\' atau \'Menambah 7 pelanggan baru\'. Tujuan ini akan menjadi dasar alokasi. \n2.  **Alokasikan Persentase dari Pendapatan atau Reinvestasi Keuntungan:** Mengingat pertumbuhan revenue 100% dan status bisnis yang masih berkembang, alokasikan persentase yang lebih tinggi dari pendapatan bulanan saat ini, atau bahkan sebagian keuntungan untuk reinvestasi. Kami merekomendasikan 10-20% dari pendapatan saat ini (Rp 915.000), yaitu sekitar **Rp 90.000 - Rp 180.000** sebagai titik awal. Anda bisa mempertimbangkan lebih tinggi jika target akuisisi pelanggan agresif. \n3.  **Perkirakan Biaya Akuisisi Pelanggan (CAC) Target:** Jika target Anda adalah \'X\' pelanggan baru, hitung berapa yang realistis untuk dikeluarkan per pelanggan baru agar tetap profitabel. Bandingkan dengan Average Order Value (Rp 45.750) Anda. Pastikan CAC lebih rendah dari LTV (Lifetime Value) pelanggan. \n4.  **Rinci Anggaran Berdasarkan Aktivitas:** Alokasikan budget ke aktivitas marketing spesifik yang mendukung tujuan Anda. Contoh: \n    *   Iklan Digital (misal: Instagram/Facebook Ads untuk menargetkan area lokal): XX% \n    *   Promosi Kemitraan Lokal (misal: dengan kafe/gym): YY% \n    *   Program Referral Pelanggan: ZZ% \n    *   Konten & Materi Promosi (desain, cetak): AA% \n5.  **Mulai dengan Konservatif dan Monitor:** Implementasikan budget, pantau performa setiap kampanye, dan siapkan diri untuk menyesuaikan alokasi berdasarkan data dan Return on Investment (ROI) yang terlihat. Fleksibilitas sangat penting di tahap awal.', '[\"Pendapatan Bulanan Rp 915.000 menjadi dasar perhitungan persentase budget marketing awal.\",\"Pertumbuhan Revenue 100% menunjukkan potensi tinggi dan justifikasi untuk investasi marketing guna mempercepat akuisisi dan ekspansi.\",\"Average Order Value (Rp 45.750) penting untuk menentukan batas maksimal Biaya Akuisisi Pelanggan (CAC) agar promosi tetap menguntungkan.\",\"15 Pelanggan Aktif dan 20 Total Pesanan Bulan Ini mengindikasikan bahwa fokus pada akuisisi pelanggan baru dan peningkatan frekuensi pesanan dari pelanggan eksisting adalah strategi yang relevan.\",\"Layanan Terpopuler (Basic Cleaning, Premium Care, Fast Clean) dapat menjadi fokus utama dalam kampanye marketing untuk menarik minat pelanggan.\"]', '{\"revenue\":15,\"retention\":10,\"efficiency\":20}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Fast Clean\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-23 05:51:07', '2025-12-23 11:51:07'),
(25, 4, 'Untuk membuat UI/UX bagi KixEra, fokus pada kemudahan dan efisiensi pengguna. Langkah-langkahnya adalah:\n1.  **Riset Pengguna:** Lakukan wawancara singkat atau survei dengan 15 pelanggan aktif KixEra. Pahami pain point mereka dalam proses pemesanan, penjadwalan pickup, dan pelacakan status laundry sepatu. Tanyakan fitur apa yang paling mereka harapkan.\n2.  **Definisikan Fitur Utama:** Berdasarkan riset, prioritaskan fitur seperti:\n    *   **Pemesanan Mudah:** Memilih layanan (Basic Cleaning, Premium Care, Fast Clean) dengan deskripsi jelas dan harga.\n    *   **Penjadwalan Pickup/Delivery:** Sistem yang intuitif untuk memilih tanggal dan waktu pickup/delivery (penting untuk mengatasi \'Pending Pickups\').\n    *   **Pelacakan Status Pesanan:** Fitur untuk melihat status pesanan secara real-time (diterima, sedang dicuci, siap antar, selesai).\n    *   **Riwayat Pesanan:** Akses ke pesanan sebelumnya dan detailnya.\n    *   **Pembayaran:** Integrasi metode pembayaran yang mudah.\n3.  **Buat User Flow & Information Architecture:** Petakan alur perjalanan pengguna dari awal hingga akhir (misal: \'Buka aplikasi -> Pilih layanan -> Jadwalkan pickup -> Bayar\'). Susun struktur informasi agar mudah ditemukan dan dipahami.\n4.  **Wireframing (Low-Fidelity):** Sketsakan tata letak dasar setiap halaman atau layar tanpa detail visual. Fokus pada penempatan elemen dan fungsionalitas.\n5.  **Prototyping (High-Fidelity):** Buat mockup interaktif yang menyerupai tampilan akhir. Terapkan branding KixEra (warna, logo, font) untuk menciptakan pengalaman visual yang konsisten.\n6.  **User Testing:** Ujicobakan prototipe kepada beberapa pelanggan potensial atau aktif KixEra. Kumpulkan umpan balik tentang kemudahan penggunaan, kejelasan, dan fitur yang dibutuhkan. Gunakan feedback ini untuk iterasi dan perbaikan desain.\n7.  **Iterasi & Pengembangan:** Perbaiki desain berdasarkan hasil user testing dan persiapkan aset desain untuk pengembangan.', '[\"Fokus utama UI\\/UX adalah menyederhanakan proses pemesanan dan pelacakan untuk meningkatkan kepuasan pelanggan dan mengurangi \'Pending Pickups\'.\",\"Integrasikan layanan terpopuler (Basic Cleaning, Premium Care, Fast Clean) secara menonjol dan mudah diakses dalam antarmuka.\",\"Desain harus responsif dan mobile-first, mengingat sebagian besar pengguna akan mengakses melalui smartphone untuk kemudahan.\"]', '{\"revenue\":15,\"retention\":20,\"efficiency\":25}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Fast Clean\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-23 05:52:13', '2025-12-23 11:52:13'),
(26, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Fast Clean\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-23 05:53:38', '2025-12-23 11:53:38'),
(27, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Fast Clean\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-23 05:54:57', '2025-12-23 11:54:57'),
(28, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-23 09:31:43', '2025-12-23 15:31:43'),
(29, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-23 13:13:06', '2025-12-23 19:13:06'),
(30, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-24 02:10:28', '2025-12-24 08:10:28'),
(31, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-29 16:03:26', '2025-12-29 22:03:26'),
(32, 4, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"Bantul\",\"value\":\"430000.00\"},{\"label\":\"Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}', 'new', '2025-12-29 16:04:35', '2025-12-29 22:04:35');
INSERT INTO `rekomendasi_ai` (`id_rekomendasi`, `id_pemilik`, `recommendation_text`, `insights`, `impact_prediction`, `business_data_snapshot`, `status`, `created_at`, `updated_at`) VALUES
(33, 14, 'Mengingat KixEra berada pada tahap sangat awal dengan total 1 pesanan dan pendapatan bulanan Rp 19.000, pendekatan budget marketing yang paling cocok saat ini adalah mengalokasikan investasi awal (seed funding) daripada persentase dari revenue yang masih sangat kecil. Kami merekomendasikan alokasi budget sekitar Rp 200.000 - Rp 500.000 sebagai investasi awal selama 1-2 bulan ke depan. Budget ini fokus untuk akuisisi pelanggan pertama dan membangun awareness lokal, bukan sebagai biaya operasional bulanan berbasis persentase revenue.', '[\"Bisnis KixEra berada pada fase start-up dengan pendapatan dan pelanggan yang minimal, sehingga alokasi persentase dari revenue saat ini tidak efektif.\",\"Fokus utama budget ini adalah akuisisi pelanggan baru dan meningkatkan visibilitas di area lokal.\",\"Dana ini akan digunakan sebagai investasi awal untuk menguji saluran marketing yang paling efektif (misalnya, promosi di media sosial lokal, flyer, atau penawaran khusus untuk pelanggan pertama).\",\"Penting untuk melacak efektivitas setiap pengeluaran untuk mengoptimalkan strategi marketing selanjutnya.\"]', '{\"revenue\":30,\"retention\":15,\"efficiency\":10}', '{\"total_orders_today\":1,\"total_orders_month\":1,\"monthly_revenue\":\"19000.00\",\"revenue_growth\":100,\"active_customers\":\"1\",\"pending_pickups\":0,\"top_services\":[\"Premium cuci sepatu\"],\"branch_performance\":[{\"label\":\"Cabang Seturan\",\"value\":\"19000.00\"}],\"avg_order_value\":19000}', 'new', '2026-01-02 06:32:35', '2026-01-02 12:32:35'),
(34, 14, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":5,\"total_orders_month\":5,\"monthly_revenue\":\"126000.00\",\"revenue_growth\":100,\"active_customers\":\"2\",\"pending_pickups\":0,\"top_services\":[\"Premium cuci sepatu\",\"Pasang Sol Sepatu Sepatu\"],\"branch_performance\":[{\"label\":\"Cabang Seturan\",\"value\":\"126000.00\"}],\"avg_order_value\":25200}', 'new', '2026-01-02 08:45:31', '2026-01-02 14:45:31'),
(35, 14, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":21,\"monthly_revenue\":\"402000.00\",\"revenue_growth\":100,\"active_customers\":\"4\",\"pending_pickups\":0,\"top_services\":[\"Premium cuci sepatu\",\"Pasang Sol Sepatu Sepatu\"],\"branch_performance\":[{\"label\":\"Cabang Seturan\",\"value\":\"402000.00\"}],\"avg_order_value\":19143}', 'new', '2026-01-06 05:39:03', '2026-01-06 11:39:03'),
(36, 14, 'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.', '[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]', '{\"revenue\":15,\"retention\":23,\"efficiency\":18}', '{\"total_orders_today\":0,\"total_orders_month\":21,\"monthly_revenue\":\"402000.00\",\"revenue_growth\":100,\"active_customers\":\"4\",\"pending_pickups\":0,\"top_services\":[\"Premium cuci sepatu\",\"Pasang Sol Sepatu Sepatu\"],\"branch_performance\":[{\"label\":\"Cabang Seturan\",\"value\":\"402000.00\"}],\"avg_order_value\":19143}', 'new', '2026-01-06 05:45:16', '2026-01-06 11:45:16'),
(37, 14, 'Berdasarkan pendapatan bulanan KixEra sebesar Rp 402.000, estimasi biaya marketing yang dapat dialokasikan untuk bulan depan adalah sekitar Rp 60.300 (menggunakan alokasi 15% dari pendapatan untuk marketing, yang umum untuk bisnis yang sedang bertumbuh). Penting untuk memastikan pengeluaran ini sangat terfokus dan terukur.', '[\"Dengan pendapatan saat ini yang masih relatif kecil, alokasi anggaran marketing harus sangat selektif dan berorientasi pada ROI cepat.\",\"Fokus pada channel marketing yang murah dan terukur, seperti promosi lokal terbatas, media sosial organik, atau program referral pelanggan.\",\"Mengingat layanan terpopuler Anda adalah \'Premium cuci sepatu\' dan \'Pasang Sol Sepatu\', promosi dapat ditargetkan pada keunggulan layanan ini untuk menarik pelanggan baru.\"]', '{\"revenue\":15,\"retention\":10,\"efficiency\":20}', '{\"total_orders_today\":0,\"total_orders_month\":21,\"monthly_revenue\":\"402000.00\",\"revenue_growth\":100,\"active_customers\":\"4\",\"pending_pickups\":0,\"top_services\":[\"Premium cuci sepatu\",\"Pasang Sol Sepatu Sepatu\"],\"branch_performance\":[{\"label\":\"Cabang Seturan\",\"value\":\"402000.00\"}],\"avg_order_value\":19143}', 'new', '2026-01-06 05:49:05', '2026-01-06 11:49:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `remember_tokens`
--

CREATE TABLE `remember_tokens` (
  `id_token` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `token_hash` varchar(255) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `remember_tokens`
--

INSERT INTO `remember_tokens` (`id_token`, `id_user`, `token_hash`, `selector`, `expires_at`, `created_at`) VALUES
(3, 8, 'b431e69ad8b7d2cf26e0d99e464896e76690f3322d7373d88bf96e892fb7d703', 'cb7713376941aae4f7', '2026-02-27 19:29:27', '2026-01-28 18:29:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_inventori`
--

CREATE TABLE `transaksi_inventori` (
  `id_transaksi_inventori` int(11) NOT NULL,
  `id_inventori` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `jenis_transaksi` enum('masuk','keluar') NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_inventori`
--

INSERT INTO `transaksi_inventori` (`id_transaksi_inventori`, `id_inventori`, `id_cabang`, `jenis_transaksi`, `jumlah`, `tgl_transaksi`, `id_karyawan`, `keterangan`, `created_at`, `deleted_at`) VALUES
(2, 38, 20, 'masuk', 4, '2026-01-02 05:49:38', 9, 'Stok awal: pewangi', '2026-01-01 22:49:38', NULL),
(3, 38, 20, 'keluar', 1, '2026-01-04 23:13:26', 9, 'Pemakaian rutin', '2026-01-04 16:13:26', NULL),
(4, 38, 20, 'keluar', 1, '2026-01-04 23:14:54', 9, 'Pemakaian rutin', '2026-01-04 16:14:54', NULL),
(5, 39, 19, 'masuk', 1, '2026-01-04 23:23:10', 9, 'Stok awal: Sabun Cair Premium', '2026-01-04 16:23:10', NULL),
(7, 40, 19, 'masuk', 1, '2026-01-04 23:27:39', 9, 'Stok awal: Sikat Premium', '2026-01-04 16:27:39', NULL),
(8, 40, 19, 'keluar', 1, '2026-01-06 06:10:38', 9, 'Pemakaian rutin', '2026-01-05 23:10:38', NULL),
(9, 41, 19, 'masuk', 5, '2026-01-06 06:12:49', 9, 'Stok awal: Lap kanebo', '2026-01-05 23:12:49', NULL),
(15, 76, 41, 'masuk', 10, '2026-06-10 19:43:17', 94, 'Stok awal: Sabun Cair', '2026-06-10 12:43:17', NULL),
(16, 76, 41, 'keluar', 1, '2026-06-10 19:43:40', NULL, 'Konsumsi otomatis pesanan #PES-20260610-002', '2026-06-10 12:43:40', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_langganan`
--

CREATE TABLE `transaksi_langganan` (
  `id_transaksi_langganan` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `jumlah_bayar` decimal(10,2) NOT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL,
  `status_pembayaran` enum('pending','sukses','gagal') DEFAULT 'pending',
  `kode_pembayaran` varchar(255) DEFAULT NULL,
  `tgl_mulai_langganan` date DEFAULT NULL,
  `tgl_akhir_langganan` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_langganan`
--

INSERT INTO `transaksi_langganan` (`id_transaksi_langganan`, `id_pemilik`, `id_paket`, `id_admin`, `tgl_transaksi`, `jumlah_bayar`, `metode_pembayaran`, `status_pembayaran`, `kode_pembayaran`, `tgl_mulai_langganan`, `tgl_akhir_langganan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 4, 2, NULL, '2025-12-23 05:59:42', 199000.00, 'midtrans', 'pending', 'KIX-20251223055942-8920', '2025-12-23', '2026-01-23', '2025-12-22 22:59:42', '2026-01-01 16:26:55', '2026-01-01 10:26:55'),
(3, 4, 2, NULL, '2025-12-23 06:00:21', 2388000.00, 'midtrans', 'pending', 'KIX-20251223060021-1363', '2025-12-23', '2026-12-23', '2025-12-22 23:00:21', '2026-01-01 16:26:52', '2026-01-01 10:26:52'),
(4, 4, 2, NULL, '2025-12-30 18:24:26', 2388000.00, 'midtrans', 'pending', 'KIX-20251230182426-7823', '2025-12-30', '2026-12-30', '2025-12-30 11:24:26', '2026-01-01 16:26:50', '2026-01-01 10:26:50'),
(5, 14, 2, NULL, '2026-01-01 17:09:34', 2388000.00, 'midtrans', 'pending', 'KIX-20260101170934-4495', '2026-01-01', '2027-01-01', '2026-01-01 10:09:34', '2026-01-01 16:26:47', '2026-01-01 10:26:47'),
(6, 14, 2, NULL, '2026-01-01 17:18:13', 597000.00, 'midtrans', 'pending', 'KIX-20260101171813-5761', '2026-01-01', '2026-04-01', '2026-01-01 10:18:13', '2026-01-01 16:26:44', '2026-01-01 10:26:44'),
(7, 14, 2, NULL, '2026-01-01 17:24:49', 2388000.00, 'midtrans', 'sukses', 'KIX-20260101172449-9362', '2026-01-01', '2027-01-01', '2026-01-01 10:24:49', '2026-01-01 10:26:06', NULL),
(8, 14, 2, NULL, '2026-01-02 07:10:00', 199000.00, 'midtrans', 'sukses', 'KIX-20260102071000-3077', '2026-01-02', '2027-01-30', '2026-01-02 00:10:00', '2026-01-02 00:10:42', NULL),
(9, 14, 2, NULL, '2026-01-02 08:35:46', 597000.00, 'midtrans', 'pending', 'KIX-20260102083546-3387', '2026-01-02', '2027-04-29', '2026-01-02 01:35:46', NULL, NULL),
(10, 14, 2, NULL, '2026-01-02 08:36:49', 597000.00, 'midtrans', 'pending', 'KIX-20260102083649-6020', '2026-01-02', '2027-04-29', '2026-01-02 01:36:49', '2026-01-02 01:37:43', NULL),
(11, 14, 2, NULL, '2026-01-02 08:38:16', 2388000.00, 'midtrans', 'sukses', 'KIX-20260102083816-3542', '2026-01-02', '2028-01-24', '2026-01-02 01:38:16', '2026-01-02 01:38:56', NULL),
(12, 14, 2, NULL, '2026-01-02 08:43:49', 597000.00, 'midtrans', 'sukses', 'KIX-20260102084349-7124', '2026-01-02', '2028-04-22', '2026-01-02 01:43:49', '2026-01-02 01:44:18', NULL),
(15, 14, 2, NULL, '2026-01-05 19:26:36', 2388000.00, 'midtrans', 'sukses', 'KIX-20260105192636-6113', '2026-01-05', '2029-04-16', '2026-01-05 12:26:36', '2026-01-05 12:27:06', NULL),
(20, 36, 3, NULL, '2026-06-10 04:02:21', 399000.00, 'midtrans', 'sukses', 'KIX-20260610040221-3352', '2026-06-10', '2026-07-10', '2026-06-09 21:02:21', '2026-06-09 21:02:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `google_email` varchar(255) DEFAULT NULL,
  `google_name` varchar(255) DEFAULT NULL,
  `google_picture` text DEFAULT NULL,
  `google_avatar` text DEFAULT NULL,
  `oauth_provider` varchar(50) DEFAULT NULL,
  `oauth_access_token` text DEFAULT NULL,
  `oauth_refresh_token` text DEFAULT NULL,
  `oauth_token_expires` datetime DEFAULT NULL,
  `role` enum('admin','owner','karyawan') NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expires_at` datetime DEFAULT NULL,
  `last_otp_sent_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `google_id`, `google_email`, `google_name`, `google_picture`, `google_avatar`, `oauth_provider`, `oauth_access_token`, `oauth_refresh_token`, `oauth_token_expires`, `role`, `status`, `created_at`, `updated_at`, `deleted_at`, `otp_code`, `otp_expires_at`, `last_otp_sent_at`) VALUES
(1, 'admin', '$2y$12$0dmsjQgcjim6VrTs65f5De13e6qAW8kiqHeaaf9xikmdV5lGld2Iy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'aktif', '2025-12-16 17:00:21', '2026-04-23 10:13:18', '2025-12-22 12:07:52', NULL, NULL, NULL),
(8, 'hatta751', '$2y$10$yuwzcYvHFVrk7WG0mC7SieO/..uSikH9oF9ap9MrUCUxqPkCB/uYK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'aktif', '2025-12-21 22:38:55', '2025-12-30 08:55:27', NULL, '244259', '2025-12-29 19:12:57', '2025-12-29 19:07:57'),
(9, 'rizkipangestu852922', '\\.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '107038979417885165985', 'rizkipangestu852@gmail.com', NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocIkAayErSyW-VC4JnamCCuT59FYqhshhXg37RgNl0Y6rjQRcWo=s96-c', 'google', NULL, NULL, NULL, 'owner', 'aktif', '2025-12-21 22:50:54', '2026-04-29 06:58:29', NULL, NULL, NULL, NULL),
(16, 'rizkipangestu998', '$2y$10$ijR2yQifRzyW7Tz2OvDjneZIeRBUe5Tk.iIu7TFQVynpkE.bVw3Da', '103668789038059031082', 'riskypangestu057@gmail.com', 'Rizki Pangestu', 'https://lh3.googleusercontent.com/a/ACg8ocLZbesGECP1f2QUqZsLEGmRHk523tsiPX0D4SZ_ZAJ13YnkR43V=s96-c', NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2025-12-29 08:04:45', '2025-12-30 07:23:29', NULL, NULL, NULL, NULL),
(23, 'stronity', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '116062482977845563862', 'stronity@gmail.com', 'stronity', 'https://lh3.googleusercontent.com/a/ACg8ocJIIrjGsk6TOdgDqr7H9Ua4-rAgXvm0-8p7wMXvW0bY7-LRZso=s96-c', NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2025-12-30 21:46:48', '2026-04-23 08:44:07', NULL, NULL, NULL, NULL),
(24, 'testing_error', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-01-01 12:20:50', '2026-04-24 15:30:29', NULL, NULL, NULL, NULL),
(30, 'rizkipangestu2312302570', '$2y$10$/mEEKcGpmu/MwbByBxDNWOaJYMNlSvi2HYuh0SVN7VTHoYAZso7kG', '113652892611796351362', 'riskypangestu057@students.amikom.ac.id', 'RIZKI PANGESTU 23.12.3029', 'https://lh3.googleusercontent.com/a/ACg8ocI_XbhjTJ-lE_VUNA2FqBySHyeCukLOVbQ4Bg8qYvK4p0jZOQ=s96-c', NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2026-01-02 12:34:18', NULL, NULL, NULL, NULL, NULL),
(31, 'hatta', '$2y$10$1UyjWw883bU0fuZxcU4...Pf2uM76TxR86WZ2JSqNlTu5vAqU1the', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-01-02 13:54:28', NULL, NULL, NULL, NULL, NULL),
(32, 'rashcorp99', '$2y$10$AS1Wq9r.iNhINXnffCGi0.LTRBkLbmYHdOmY4lw9j3J8ZwAW7iXwK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2026-01-03 18:34:05', NULL, NULL, NULL, NULL, NULL),
(33, 'admin_kixera', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'aktif', '2026-04-23 13:24:31', '2026-04-23 13:40:59', NULL, NULL, NULL, NULL),
(39, 'roihan', '$2y$10$wDNJ2PEuDky2.3i5bVlRneq7VUMtj7EO9.lszqzjrc2vtW3U4cD8S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-04-23 10:25:49', '2026-04-23 10:27:08', NULL, NULL, NULL, NULL),
(40, 'alifa', '$2y$10$QHekf5OQG1KtiYCmFqYb1.gSDKAIY/hNNlex96G/ekK9iJiIcPVsq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-04-23 12:21:48', '2026-04-23 17:22:20', '2026-04-23 12:22:20', NULL, NULL, NULL),
(96, 'error_total', '$2y$10$APjbH/zZYFuZlrj7FskUJO7vfOpdjHDiRJsvvpuhpELLmumIoqf02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-04-24 11:11:41', '2026-04-28 16:01:14', '2026-04-28 11:01:14', NULL, NULL, NULL),
(124, 'alifa1', '$2y$10$uMTuwQm9.6OgrpfHUfbuDuWRSxtqU3rFstznk.dsXPgqvuzF3fSC.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-04-28 10:57:56', '2026-04-28 15:58:11', '2026-04-28 10:58:11', NULL, NULL, NULL),
(137, 'baskaraputra', '$2y$10$R.LiA1NIjp0T9R2fjqiahuwekXMkQcjZXai68s5MQXhdnPrOyXKzi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-04-28 11:02:22', NULL, NULL, NULL, NULL, NULL),
(140, 'owner_expired', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2026-04-28 16:49:05', '2026-04-28 16:49:05', NULL, NULL, NULL, NULL),
(141, 'baskara_putra', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-04-28 17:18:34', '2026-04-28 17:18:34', NULL, NULL, NULL, NULL),
(142, 'hattajunior1', '$2y$10$QnK4OblQqFvY342izyIM/uCs7/3EOJGhL8mddbKpXgfbIPjT63H8C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2026-06-09 15:52:13', NULL, NULL, NULL, NULL, NULL),
(147, 'shukizenzen_1', '$2y$10$gju1U8me66LNIyXzkzIAVeWyaQ17b0MWFQfKQ9zNYo/WJvnCKLws2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-06-09 12:39:35', NULL, NULL, NULL, NULL, NULL),
(153, 'karyawan_rina_ks', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-06-09 18:46:11', NULL, NULL, NULL, NULL, NULL),
(154, 'karyawan_fajar_ks', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-06-09 18:46:11', NULL, NULL, NULL, NULL, NULL),
(155, 'karyawan_sinta_ks', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-06-09 18:46:11', NULL, NULL, NULL, NULL, NULL),
(156, 'hattajunior11', '$2y$10$hMB1reIa5kygsYyic9USSOT6kADDyL3iTACupwPzxOYIzufPlBQm2', NULL, 'hattajunior1@gmail.com', 'Hatta P Syahputra', 'https://lh3.googleusercontent.com/a/ACg8ocK_hoL2_NjdU9a8oYQwDq9hts_NwEKKGuJ5k5njLjZT3e4avp4D=s96-c', NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2026-06-09 19:40:07', '2026-06-12 09:05:55', NULL, NULL, NULL, NULL),
(157, 'shukizenzen', '$2y$10$JctFtrXswgKMc2/tXdpi2Og.DfaSJg1IVXQSeIxdyELpPzv0wwDiy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2026-06-09 14:41:47', '2026-06-09 14:42:02', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id_code` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `code` varchar(6) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `purpose` enum('admin_login','password_reset') DEFAULT 'admin_login',
  `is_used` tinyint(1) DEFAULT 0,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `used_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `verification_codes`
--

INSERT INTO `verification_codes` (`id_code`, `id_user`, `code`, `phone_number`, `purpose`, `is_used`, `expires_at`, `created_at`, `used_at`) VALUES
(1, 8, '999582', '081279393094', 'admin_login', 1, '2025-12-30 13:56:35', '2025-12-30 13:51:35', NULL),
(2, 8, '954704', '081279393094', 'admin_login', 1, '2025-12-30 14:00:52', '2025-12-30 13:55:52', NULL),
(3, 8, '690614', '081279393094', 'admin_login', 1, '2025-12-30 14:03:24', '2025-12-30 13:58:24', '2025-12-30 14:00:41'),
(4, 8, '634276', '081279393094', 'admin_login', 1, '2025-12-30 14:05:54', '2025-12-30 14:00:54', NULL),
(5, 8, '092928', '081279393094', 'admin_login', 1, '2025-12-30 14:07:59', '2025-12-30 14:02:59', NULL),
(6, 8, '079449', '081279393094', 'admin_login', 1, '2025-12-30 14:19:27', '2025-12-30 14:14:27', '2025-12-30 14:14:47'),
(7, 8, '056026', '081279393094', 'admin_login', 1, '2025-12-30 14:22:49', '2025-12-30 14:17:49', '2025-12-30 14:17:56'),
(8, 8, '230942', '081279393094', 'admin_login', 1, '2025-12-30 14:27:00', '2025-12-30 14:22:00', '2025-12-30 14:22:22'),
(9, 8, '802221', '081279393094', 'admin_login', 1, '2025-12-30 15:59:08', '2025-12-30 15:54:08', '2025-12-30 15:54:32'),
(10, 8, '340651', '081279393094', 'admin_login', 1, '2025-12-30 16:00:40', '2025-12-30 15:55:40', NULL),
(11, 8, '892309', '081279393094', 'admin_login', 1, '2025-12-30 16:01:03', '2025-12-30 15:56:03', '2025-12-30 15:56:18'),
(12, 8, '215617', '081279393094', 'admin_login', 1, '2025-12-30 16:45:28', '2025-12-30 16:40:28', '2025-12-30 16:40:57'),
(13, 8, '291623', '081279393094', 'admin_login', 1, '2025-12-30 20:26:58', '2025-12-30 20:21:58', '2025-12-30 20:22:34'),
(14, 8, '195084', '081279393094', 'admin_login', 1, '2025-12-30 22:49:43', '2025-12-30 22:44:43', '2025-12-30 22:44:57'),
(15, 8, '729057', '081279393094', 'admin_login', 1, '2026-01-01 17:18:00', '2026-01-01 17:13:00', '2026-01-01 17:14:14'),
(16, 8, '208805', '081279393094', 'admin_login', 1, '2026-01-02 17:20:36', '2026-01-02 17:15:36', '2026-01-02 17:15:48'),
(17, 8, '716811', '081279393094', 'admin_login', 1, '2026-01-05 01:03:29', '2026-01-05 00:58:29', '2026-01-05 00:58:57'),
(18, 8, '911808', '081279393094', 'admin_login', 1, '2026-01-05 18:40:07', '2026-01-05 18:35:07', NULL),
(19, 8, '512699', '081279393094', 'admin_login', 1, '2026-01-05 20:23:55', '2026-01-05 20:18:55', '2026-01-05 20:19:02'),
(20, 8, '639454', '081279393094', 'admin_login', 1, '2026-01-06 19:10:39', '2026-01-06 19:05:39', '2026-01-06 19:05:52'),
(21, 8, '325316', '081279393094', 'admin_login', 1, '2026-01-28 18:44:04', '2026-01-28 18:39:04', '2026-01-28 18:39:24'),
(22, 8, '709160', '081279393094', 'admin_login', 1, '2026-01-28 19:34:15', '2026-01-28 19:29:15', '2026-01-28 19:29:27'),
(23, 8, '511626', '081279393094', 'admin_login', 0, '2026-04-23 15:28:38', '2026-04-23 15:23:38', NULL),
(24, 33, '575237', '085922409428', 'admin_login', 1, '2026-04-23 15:33:11', '2026-04-23 15:28:11', '2026-04-23 15:28:25'),
(25, 33, '689130', '085922409428', 'admin_login', 1, '2026-04-23 15:36:34', '2026-04-23 15:31:34', '2026-04-23 15:31:48');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_dashboard_owner`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_dashboard_owner` (
`id_pemilik` int(11)
,`nama_usaha` varchar(255)
,`status_langganan` enum('aktif','nonaktif','trial')
,`total_cabang` bigint(21)
,`total_karyawan` bigint(21)
,`pesanan_aktif` bigint(21)
,`pesanan_selesai_hari_ini` bigint(21)
,`pendapatan_hari_ini` decimal(32,2)
,`pendapatan_bulan_ini` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_keuangan_bulanan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_keuangan_bulanan` (
`id_cabang` int(11)
,`nama_cabang` varchar(255)
,`id_pemilik` int(11)
,`nama_usaha` varchar(255)
,`tahun` int(4)
,`bulan` int(2)
,`periode` varchar(7)
,`total_pemasukan` decimal(32,2)
,`total_pengeluaran` decimal(32,2)
,`laba_rugi` decimal(33,2)
,`margin_persen` decimal(39,2)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_kinerja_karyawan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_kinerja_karyawan` (
`id_karyawan` int(11)
,`nama` varchar(255)
,`jabatan` varchar(100)
,`nama_cabang` varchar(255)
,`nama_usaha` varchar(255)
,`total_pesanan_ditangani` bigint(21)
,`total_revenue` decimal(32,2)
,`rata_rata_transaksi` decimal(14,6)
,`total_nota_dicetak` bigint(21)
,`total_transaksi_inventori` bigint(21)
,`bulan` int(2)
,`tahun` int(4)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_laporan_keuangan_lengkap`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_laporan_keuangan_lengkap` (
`id_cabang` int(11)
,`nama_cabang` varchar(255)
,`id_pemilik` int(11)
,`nama_usaha` varchar(255)
,`tanggal` date
,`total_pemasukan` decimal(32,2)
,`total_pengeluaran` decimal(32,2)
,`laba_rugi` decimal(33,2)
,`jumlah_transaksi_masuk` bigint(21)
,`jumlah_transaksi_keluar` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_layanan_populer`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_layanan_populer` (
`id_layanan` int(11)
,`nama_layanan` varchar(255)
,`harga` decimal(10,2)
,`id_pemilik` int(11)
,`nama_usaha` varchar(255)
,`total_order` bigint(21)
,`total_revenue` decimal(32,2)
,`rata_rata_harga` decimal(14,6)
,`bulan` int(2)
,`tahun` int(4)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_pelanggan_baru`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_pelanggan_baru` (
`id_pelanggan` int(11)
,`nama` varchar(255)
,`no_telp` varchar(20)
,`email` varchar(255)
,`tgl_daftar` timestamp
,`jumlah_transaksi` bigint(21)
,`total_pembelian` decimal(32,2)
,`nama_cabang` varchar(255)
,`nama_usaha` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_pelanggan_setia`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_pelanggan_setia` (
`id_pelanggan` int(11)
,`nama` varchar(255)
,`no_telp` varchar(20)
,`email` varchar(255)
,`total_transaksi` bigint(21)
,`total_pembelian` decimal(32,2)
,`rata_rata_pembelian` decimal(14,6)
,`transaksi_pertama` datetime
,`transaksi_terakhir` datetime
,`hari_terakhir_transaksi` int(7)
,`rata_rata_rating` decimal(14,4)
,`nama_cabang` varchar(255)
,`nama_usaha` varchar(255)
,`tier_pelanggan` varchar(7)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_pengeluaran_kategori`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_pengeluaran_kategori` (
`id_cabang` int(11)
,`nama_cabang` varchar(255)
,`nama_usaha` varchar(255)
,`kategori` varchar(100)
,`bulan` int(2)
,`tahun` int(4)
,`jumlah_transaksi` bigint(21)
,`total_pengeluaran` decimal(32,2)
,`rata_rata_pengeluaran` decimal(14,6)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_pesanan_cabang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_pesanan_cabang` (
`id_cabang` int(11)
,`nama_cabang` varchar(255)
,`nama_usaha` varchar(255)
,`tanggal` date
,`total_pesanan` bigint(21)
,`total_pendapatan` decimal(32,2)
,`rata_rata_transaksi` decimal(14,6)
,`total_item` decimal(32,0)
,`status_diterima` bigint(21)
,`status_proses` bigint(21)
,`status_selesai` bigint(21)
,`status_siap` bigint(21)
,`status_diambil` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_pesanan_detail`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_pesanan_detail` (
`id_pesanan` int(11)
,`tgl_masuk` datetime
,`tgl_estimasi_selesai` datetime
,`tgl_selesai` datetime
,`tgl_diambil` datetime
,`status_pesanan` enum('diterima','dalam_proses','selesai','siap_diambil','sudah_diambil','dibatalkan')
,`total_harga` decimal(10,2)
,`jumlah_item` int(11)
,`id_cabang` int(11)
,`nama_cabang` varchar(255)
,`id_pemilik` int(11)
,`nama_usaha` varchar(255)
,`id_pelanggan` int(11)
,`nama_pelanggan` varchar(255)
,`telp_pelanggan` varchar(20)
,`nama_layanan` varchar(255)
,`harga_layanan` decimal(10,2)
,`nama_karyawan` varchar(255)
,`durasi_pengerjaan` int(7)
,`status_ketepatan` varchar(12)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_rating_cabang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_rating_cabang` (
`id_cabang` int(11)
,`nama_cabang` varchar(255)
,`nama_usaha` varchar(255)
,`total_feedback` bigint(21)
,`rata_rata_rating` decimal(14,4)
,`rating_5` bigint(21)
,`rating_4` bigint(21)
,`rating_3` bigint(21)
,`rating_2` bigint(21)
,`rating_1` bigint(21)
,`persentase_puas` decimal(26,2)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_riwayat_inventori`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_riwayat_inventori` (
`id_transaksi_inventori` int(11)
,`jenis_transaksi` enum('masuk','keluar')
,`jumlah` int(11)
,`tgl_transaksi` datetime
,`keterangan` text
,`nama_item` varchar(255)
,`jenis_item` varchar(100)
,`satuan` varchar(50)
,`nama_cabang` varchar(255)
,`nama_karyawan` varchar(255)
,`nama_usaha` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_status_langganan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_status_langganan` (
`id_pemilik` int(11)
,`nama_usaha` varchar(255)
,`email` varchar(255)
,`no_telp` varchar(20)
,`status_langganan` enum('aktif','nonaktif','trial')
,`nama_paket` varchar(255)
,`harga_paket` decimal(10,2)
,`tgl_mulai_langganan` date
,`tgl_akhir_langganan` date
,`sisa_hari` int(7)
,`status_pembayaran` enum('pending','sukses','gagal')
,`status_sisa` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_stok_inventori`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_stok_inventori` (
`id_inventori` int(11)
,`nama_item` varchar(255)
,`jenis_item` varchar(100)
,`satuan` varchar(50)
,`stok_tersedia` int(11)
,`stok_minimal` int(11)
,`harga_satuan` decimal(10,2)
,`nilai_stok` decimal(20,2)
,`id_cabang` int(11)
,`nama_cabang` varchar(255)
,`id_pemilik` int(11)
,`nama_usaha` varchar(255)
,`status_stok` varchar(6)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_stok_kritis`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_stok_kritis` (
`id_inventori` int(11)
,`nama_item` varchar(255)
,`jenis_item` varchar(100)
,`stok_tersedia` int(11)
,`stok_minimal` int(11)
,`kebutuhan_stok` bigint(12)
,`harga_satuan` decimal(10,2)
,`estimasi_biaya` decimal(21,2)
,`nama_cabang` varchar(255)
,`nama_usaha` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_tren_penjualan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_tren_penjualan` (
`id_pemilik` int(11)
,`nama_usaha` varchar(255)
,`id_cabang` int(11)
,`nama_cabang` varchar(255)
,`tahun` int(4)
,`bulan` int(2)
,`periode` varchar(7)
,`jumlah_pesanan` bigint(21)
,`total_penjualan` decimal(32,2)
,`rata_rata_penjualan` decimal(14,6)
,`jumlah_pelanggan_unik` bigint(21)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_dashboard_owner`
--
DROP TABLE IF EXISTS `v_dashboard_owner`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dashboard_owner`  AS SELECT `pm`.`id_pemilik` AS `id_pemilik`, `pm`.`nama_usaha` AS `nama_usaha`, `pm`.`status_langganan` AS `status_langganan`, count(distinct `c`.`id_cabang`) AS `total_cabang`, count(distinct `k`.`id_karyawan`) AS `total_karyawan`, count(distinct case when `p`.`status_pesanan` in ('diterima','dalam_proses','selesai','siap_diambil') then `p`.`id_pesanan` end) AS `pesanan_aktif`, count(distinct case when `p`.`status_pesanan` = 'sudah_diambil' and cast(`p`.`tgl_diambil` as date) = curdate() then `p`.`id_pesanan` end) AS `pesanan_selesai_hari_ini`, coalesce(sum(case when cast(`pem`.`tgl_transaksi` as date) = curdate() then `pem`.`jumlah` end),0) AS `pendapatan_hari_ini`, coalesce(sum(case when month(`pem`.`tgl_transaksi`) = month(curdate()) and year(`pem`.`tgl_transaksi`) = year(curdate()) then `pem`.`jumlah` end),0) AS `pendapatan_bulan_ini` FROM ((((`pemilik` `pm` left join `cabang` `c` on(`pm`.`id_pemilik` = `c`.`id_pemilik` and `c`.`deleted_at` is null)) left join `karyawan` `k` on(`c`.`id_cabang` = `k`.`id_cabang` and `k`.`deleted_at` is null)) left join `pesanan` `p` on(`c`.`id_cabang` = `p`.`id_cabang` and `p`.`deleted_at` is null)) left join `pemasukan` `pem` on(`c`.`id_cabang` = `pem`.`id_cabang` and `pem`.`deleted_at` is null)) WHERE `pm`.`deleted_at` is null GROUP BY `pm`.`id_pemilik`, `pm`.`nama_usaha`, `pm`.`status_langganan` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_keuangan_bulanan`
--
DROP TABLE IF EXISTS `v_keuangan_bulanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_keuangan_bulanan`  AS SELECT `c`.`id_cabang` AS `id_cabang`, `c`.`nama_cabang` AS `nama_cabang`, `pm`.`id_pemilik` AS `id_pemilik`, `pm`.`nama_usaha` AS `nama_usaha`, year(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`)) AS `tahun`, month(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`)) AS `bulan`, date_format(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`),'%Y-%m') AS `periode`, coalesce(sum(`pem`.`jumlah`),0) AS `total_pemasukan`, coalesce(sum(`pen`.`jumlah`),0) AS `total_pengeluaran`, coalesce(sum(`pem`.`jumlah`),0) - coalesce(sum(`pen`.`jumlah`),0) AS `laba_rugi`, round((coalesce(sum(`pem`.`jumlah`),0) - coalesce(sum(`pen`.`jumlah`),0)) / nullif(coalesce(sum(`pem`.`jumlah`),0),0) * 100,2) AS `margin_persen` FROM (((`cabang` `c` join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `pemasukan` `pem` on(`c`.`id_cabang` = `pem`.`id_cabang` and `pem`.`deleted_at` is null)) left join `pengeluaran` `pen` on(`c`.`id_cabang` = `pen`.`id_cabang` and `pen`.`deleted_at` is null)) WHERE `c`.`deleted_at` is null GROUP BY `c`.`id_cabang`, `c`.`nama_cabang`, `pm`.`id_pemilik`, `pm`.`nama_usaha`, year(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`)), month(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_kinerja_karyawan`
--
DROP TABLE IF EXISTS `v_kinerja_karyawan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kinerja_karyawan`  AS SELECT `k`.`id_karyawan` AS `id_karyawan`, `k`.`nama` AS `nama`, `k`.`jabatan` AS `jabatan`, `c`.`nama_cabang` AS `nama_cabang`, `pm`.`nama_usaha` AS `nama_usaha`, count(distinct `p`.`id_pesanan`) AS `total_pesanan_ditangani`, sum(`p`.`total_harga`) AS `total_revenue`, avg(`p`.`total_harga`) AS `rata_rata_transaksi`, count(distinct `n`.`id_nota`) AS `total_nota_dicetak`, count(distinct `ti`.`id_transaksi_inventori`) AS `total_transaksi_inventori`, month(`p`.`tgl_masuk`) AS `bulan`, year(`p`.`tgl_masuk`) AS `tahun` FROM (((((`karyawan` `k` join `cabang` `c` on(`k`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `pesanan` `p` on(`k`.`id_karyawan` = `p`.`id_karyawan` and `p`.`deleted_at` is null)) left join `nota` `n` on(`k`.`id_karyawan` = `n`.`id_karyawan` and `n`.`deleted_at` is null)) left join `transaksi_inventori` `ti` on(`k`.`id_karyawan` = `ti`.`id_karyawan` and `ti`.`deleted_at` is null)) WHERE `k`.`deleted_at` is null GROUP BY `k`.`id_karyawan`, `k`.`nama`, `k`.`jabatan`, `c`.`nama_cabang`, `pm`.`nama_usaha`, month(`p`.`tgl_masuk`), year(`p`.`tgl_masuk`) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_laporan_keuangan_lengkap`
--
DROP TABLE IF EXISTS `v_laporan_keuangan_lengkap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_keuangan_lengkap`  AS SELECT `c`.`id_cabang` AS `id_cabang`, `c`.`nama_cabang` AS `nama_cabang`, `pm`.`id_pemilik` AS `id_pemilik`, `pm`.`nama_usaha` AS `nama_usaha`, cast(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`) as date) AS `tanggal`, coalesce(sum(`pem`.`jumlah`),0) AS `total_pemasukan`, coalesce(sum(`pen`.`jumlah`),0) AS `total_pengeluaran`, coalesce(sum(`pem`.`jumlah`),0) - coalesce(sum(`pen`.`jumlah`),0) AS `laba_rugi`, count(distinct `pem`.`id_pemasukan`) AS `jumlah_transaksi_masuk`, count(distinct `pen`.`id_pengeluaran`) AS `jumlah_transaksi_keluar` FROM (((`cabang` `c` join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `pemasukan` `pem` on(`c`.`id_cabang` = `pem`.`id_cabang` and `pem`.`deleted_at` is null)) left join `pengeluaran` `pen` on(`c`.`id_cabang` = `pen`.`id_cabang` and `pen`.`deleted_at` is null)) WHERE `c`.`deleted_at` is null GROUP BY `c`.`id_cabang`, `c`.`nama_cabang`, `pm`.`id_pemilik`, `pm`.`nama_usaha`, cast(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`) as date) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_layanan_populer`
--
DROP TABLE IF EXISTS `v_layanan_populer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_layanan_populer`  AS SELECT `l`.`id_layanan` AS `id_layanan`, `l`.`nama_layanan` AS `nama_layanan`, `l`.`harga` AS `harga`, `pm`.`id_pemilik` AS `id_pemilik`, `pm`.`nama_usaha` AS `nama_usaha`, count(`p`.`id_pesanan`) AS `total_order`, sum(`p`.`total_harga`) AS `total_revenue`, avg(`p`.`total_harga`) AS `rata_rata_harga`, month(`p`.`tgl_masuk`) AS `bulan`, year(`p`.`tgl_masuk`) AS `tahun` FROM ((`layanan` `l` join `pemilik` `pm` on(`l`.`id_pemilik` = `pm`.`id_pemilik`)) join `pesanan` `p` on(`l`.`id_layanan` = `p`.`id_layanan`)) WHERE `l`.`deleted_at` is null AND `p`.`deleted_at` is null GROUP BY `l`.`id_layanan`, `l`.`nama_layanan`, `l`.`harga`, `pm`.`id_pemilik`, `pm`.`nama_usaha`, month(`p`.`tgl_masuk`), year(`p`.`tgl_masuk`) ORDER BY count(`p`.`id_pesanan`) DESC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pelanggan_baru`
--
DROP TABLE IF EXISTS `v_pelanggan_baru`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pelanggan_baru`  AS SELECT `pel`.`id_pelanggan` AS `id_pelanggan`, `pel`.`nama` AS `nama`, `pel`.`no_telp` AS `no_telp`, `pel`.`email` AS `email`, `pel`.`created_at` AS `tgl_daftar`, count(`p`.`id_pesanan`) AS `jumlah_transaksi`, sum(`p`.`total_harga`) AS `total_pembelian`, `c`.`nama_cabang` AS `nama_cabang`, `pm`.`nama_usaha` AS `nama_usaha` FROM (((`pelanggan` `pel` left join `pesanan` `p` on(`pel`.`id_pelanggan` = `p`.`id_pelanggan` and `p`.`deleted_at` is null)) left join `cabang` `c` on(`p`.`id_cabang` = `c`.`id_cabang`)) left join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) WHERE `pel`.`deleted_at` is null AND month(`pel`.`created_at`) = month(curdate()) AND year(`pel`.`created_at`) = year(curdate()) GROUP BY `pel`.`id_pelanggan`, `pel`.`nama`, `pel`.`no_telp`, `pel`.`email`, `pel`.`created_at`, `c`.`nama_cabang`, `pm`.`nama_usaha` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pelanggan_setia`
--
DROP TABLE IF EXISTS `v_pelanggan_setia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pelanggan_setia`  AS SELECT `pel`.`id_pelanggan` AS `id_pelanggan`, `pel`.`nama` AS `nama`, `pel`.`no_telp` AS `no_telp`, `pel`.`email` AS `email`, count(`p`.`id_pesanan`) AS `total_transaksi`, sum(`p`.`total_harga`) AS `total_pembelian`, avg(`p`.`total_harga`) AS `rata_rata_pembelian`, min(`p`.`tgl_masuk`) AS `transaksi_pertama`, max(`p`.`tgl_masuk`) AS `transaksi_terakhir`, to_days(current_timestamp()) - to_days(max(`p`.`tgl_masuk`)) AS `hari_terakhir_transaksi`, avg(coalesce(`f`.`rating`,0)) AS `rata_rata_rating`, `c`.`nama_cabang` AS `nama_cabang`, `pm`.`nama_usaha` AS `nama_usaha`, CASE WHEN count(`p`.`id_pesanan`) >= 20 THEN 'VIP' WHEN count(`p`.`id_pesanan`) >= 10 THEN 'Gold' WHEN count(`p`.`id_pesanan`) >= 5 THEN 'Silver' ELSE 'Regular' END AS `tier_pelanggan` FROM ((((`pelanggan` `pel` join `pesanan` `p` on(`pel`.`id_pelanggan` = `p`.`id_pelanggan`)) join `cabang` `c` on(`p`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `feedback_pelanggan` `f` on(`p`.`id_pesanan` = `f`.`id_pesanan`)) WHERE `pel`.`deleted_at` is null AND `p`.`deleted_at` is null GROUP BY `pel`.`id_pelanggan`, `pel`.`nama`, `pel`.`no_telp`, `pel`.`email`, `c`.`nama_cabang`, `pm`.`nama_usaha` HAVING `total_transaksi` >= 3 ORDER BY count(`p`.`id_pesanan`) DESC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pengeluaran_kategori`
--
DROP TABLE IF EXISTS `v_pengeluaran_kategori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengeluaran_kategori`  AS SELECT `c`.`id_cabang` AS `id_cabang`, `c`.`nama_cabang` AS `nama_cabang`, `pm`.`nama_usaha` AS `nama_usaha`, `pen`.`kategori` AS `kategori`, month(`pen`.`tgl_transaksi`) AS `bulan`, year(`pen`.`tgl_transaksi`) AS `tahun`, count(`pen`.`id_pengeluaran`) AS `jumlah_transaksi`, sum(`pen`.`jumlah`) AS `total_pengeluaran`, avg(`pen`.`jumlah`) AS `rata_rata_pengeluaran` FROM ((`pengeluaran` `pen` join `cabang` `c` on(`pen`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) WHERE `pen`.`deleted_at` is null GROUP BY `c`.`id_cabang`, `c`.`nama_cabang`, `pm`.`nama_usaha`, `pen`.`kategori`, month(`pen`.`tgl_transaksi`), year(`pen`.`tgl_transaksi`) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pesanan_cabang`
--
DROP TABLE IF EXISTS `v_pesanan_cabang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pesanan_cabang`  AS SELECT `c`.`id_cabang` AS `id_cabang`, `c`.`nama_cabang` AS `nama_cabang`, `pm`.`nama_usaha` AS `nama_usaha`, cast(`p`.`tgl_masuk` as date) AS `tanggal`, count(`p`.`id_pesanan`) AS `total_pesanan`, sum(`p`.`total_harga`) AS `total_pendapatan`, avg(`p`.`total_harga`) AS `rata_rata_transaksi`, sum(`p`.`jumlah_item`) AS `total_item`, count(case when `p`.`status_pesanan` = 'diterima' then 1 end) AS `status_diterima`, count(case when `p`.`status_pesanan` = 'dalam_proses' then 1 end) AS `status_proses`, count(case when `p`.`status_pesanan` = 'selesai' then 1 end) AS `status_selesai`, count(case when `p`.`status_pesanan` = 'siap_diambil' then 1 end) AS `status_siap`, count(case when `p`.`status_pesanan` = 'sudah_diambil' then 1 end) AS `status_diambil` FROM ((`cabang` `c` join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `pesanan` `p` on(`c`.`id_cabang` = `p`.`id_cabang` and `p`.`deleted_at` is null)) WHERE `c`.`deleted_at` is null GROUP BY `c`.`id_cabang`, `c`.`nama_cabang`, `pm`.`nama_usaha`, cast(`p`.`tgl_masuk` as date) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pesanan_detail`
--
DROP TABLE IF EXISTS `v_pesanan_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pesanan_detail`  AS SELECT `p`.`id_pesanan` AS `id_pesanan`, `p`.`tgl_masuk` AS `tgl_masuk`, `p`.`tgl_estimasi_selesai` AS `tgl_estimasi_selesai`, `p`.`tgl_selesai` AS `tgl_selesai`, `p`.`tgl_diambil` AS `tgl_diambil`, `p`.`status_pesanan` AS `status_pesanan`, `p`.`total_harga` AS `total_harga`, `p`.`jumlah_item` AS `jumlah_item`, `c`.`id_cabang` AS `id_cabang`, `c`.`nama_cabang` AS `nama_cabang`, `pm`.`id_pemilik` AS `id_pemilik`, `pm`.`nama_usaha` AS `nama_usaha`, `pel`.`id_pelanggan` AS `id_pelanggan`, `pel`.`nama` AS `nama_pelanggan`, `pel`.`no_telp` AS `telp_pelanggan`, `l`.`nama_layanan` AS `nama_layanan`, `l`.`harga` AS `harga_layanan`, `k`.`nama` AS `nama_karyawan`, to_days(coalesce(`p`.`tgl_selesai`,current_timestamp())) - to_days(`p`.`tgl_masuk`) AS `durasi_pengerjaan`, CASE WHEN `p`.`tgl_selesai` <= `p`.`tgl_estimasi_selesai` THEN 'Tepat Waktu' WHEN `p`.`tgl_selesai` > `p`.`tgl_estimasi_selesai` THEN 'Terlambat' ELSE 'Dalam Proses' END AS `status_ketepatan` FROM (((((`pesanan` `p` join `cabang` `c` on(`p`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) join `pelanggan` `pel` on(`p`.`id_pelanggan` = `pel`.`id_pelanggan`)) join `layanan` `l` on(`p`.`id_layanan` = `l`.`id_layanan`)) left join `karyawan` `k` on(`p`.`id_karyawan` = `k`.`id_karyawan`)) WHERE `p`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_rating_cabang`
--
DROP TABLE IF EXISTS `v_rating_cabang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_rating_cabang`  AS SELECT `c`.`id_cabang` AS `id_cabang`, `c`.`nama_cabang` AS `nama_cabang`, `pm`.`nama_usaha` AS `nama_usaha`, count(`f`.`id_feedback`) AS `total_feedback`, avg(`f`.`rating`) AS `rata_rata_rating`, count(case when `f`.`rating` = 5 then 1 end) AS `rating_5`, count(case when `f`.`rating` = 4 then 1 end) AS `rating_4`, count(case when `f`.`rating` = 3 then 1 end) AS `rating_3`, count(case when `f`.`rating` = 2 then 1 end) AS `rating_2`, count(case when `f`.`rating` = 1 then 1 end) AS `rating_1`, round(count(case when `f`.`rating` >= 4 then 1 end) * 100.0 / count(`f`.`id_feedback`),2) AS `persentase_puas` FROM (((`cabang` `c` join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) join `pesanan` `p` on(`c`.`id_cabang` = `p`.`id_cabang`)) left join `feedback_pelanggan` `f` on(`p`.`id_pesanan` = `f`.`id_pesanan`)) WHERE `c`.`deleted_at` is null AND `p`.`deleted_at` is null AND `f`.`deleted_at` is null GROUP BY `c`.`id_cabang`, `c`.`nama_cabang`, `pm`.`nama_usaha` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_riwayat_inventori`
--
DROP TABLE IF EXISTS `v_riwayat_inventori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_riwayat_inventori`  AS SELECT `ti`.`id_transaksi_inventori` AS `id_transaksi_inventori`, `ti`.`jenis_transaksi` AS `jenis_transaksi`, `ti`.`jumlah` AS `jumlah`, `ti`.`tgl_transaksi` AS `tgl_transaksi`, `ti`.`keterangan` AS `keterangan`, `i`.`nama_item` AS `nama_item`, `i`.`jenis_item` AS `jenis_item`, `i`.`satuan` AS `satuan`, `c`.`nama_cabang` AS `nama_cabang`, `k`.`nama` AS `nama_karyawan`, `pm`.`nama_usaha` AS `nama_usaha` FROM ((((`transaksi_inventori` `ti` join `inventori` `i` on(`ti`.`id_inventori` = `i`.`id_inventori`)) join `cabang` `c` on(`ti`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `karyawan` `k` on(`ti`.`id_karyawan` = `k`.`id_karyawan`)) WHERE `ti`.`deleted_at` is null ORDER BY `ti`.`tgl_transaksi` DESC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_status_langganan`
--
DROP TABLE IF EXISTS `v_status_langganan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_status_langganan`  AS SELECT `pm`.`id_pemilik` AS `id_pemilik`, `pm`.`nama_usaha` AS `nama_usaha`, `pm`.`email` AS `email`, `pm`.`no_telp` AS `no_telp`, `pm`.`status_langganan` AS `status_langganan`, `pl`.`nama_paket` AS `nama_paket`, `pl`.`harga` AS `harga_paket`, `tl`.`tgl_mulai_langganan` AS `tgl_mulai_langganan`, `tl`.`tgl_akhir_langganan` AS `tgl_akhir_langganan`, to_days(`tl`.`tgl_akhir_langganan`) - to_days(curdate()) AS `sisa_hari`, `tl`.`status_pembayaran` AS `status_pembayaran`, CASE WHEN to_days(`tl`.`tgl_akhir_langganan`) - to_days(curdate()) <= 0 THEN 'Habis' WHEN to_days(`tl`.`tgl_akhir_langganan`) - to_days(curdate()) <= 7 THEN 'Akan Habis' ELSE 'Aktif' END AS `status_sisa` FROM ((`pemilik` `pm` left join `transaksi_langganan` `tl` on(`pm`.`id_pemilik` = `tl`.`id_pemilik` and `tl`.`status_pembayaran` = 'sukses' and `tl`.`deleted_at` is null)) left join `paket_langganan` `pl` on(`tl`.`id_paket` = `pl`.`id_paket`)) WHERE `pm`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_stok_inventori`
--
DROP TABLE IF EXISTS `v_stok_inventori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stok_inventori`  AS SELECT `i`.`id_inventori` AS `id_inventori`, `i`.`nama_item` AS `nama_item`, `i`.`jenis_item` AS `jenis_item`, `i`.`satuan` AS `satuan`, `i`.`stok_tersedia` AS `stok_tersedia`, `i`.`stok_minimal` AS `stok_minimal`, `i`.`harga_satuan` AS `harga_satuan`, `i`.`stok_tersedia`* `i`.`harga_satuan` AS `nilai_stok`, `c`.`id_cabang` AS `id_cabang`, `c`.`nama_cabang` AS `nama_cabang`, `pm`.`id_pemilik` AS `id_pemilik`, `pm`.`nama_usaha` AS `nama_usaha`, CASE WHEN `i`.`stok_tersedia` <= 0 THEN 'Habis' WHEN `i`.`stok_tersedia` <= `i`.`stok_minimal` THEN 'Kritis' WHEN `i`.`stok_tersedia` <= `i`.`stok_minimal` * 1.5 THEN 'Rendah' ELSE 'Aman' END AS `status_stok` FROM ((`inventori` `i` join `cabang` `c` on(`i`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) WHERE `i`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_stok_kritis`
--
DROP TABLE IF EXISTS `v_stok_kritis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stok_kritis`  AS SELECT `i`.`id_inventori` AS `id_inventori`, `i`.`nama_item` AS `nama_item`, `i`.`jenis_item` AS `jenis_item`, `i`.`stok_tersedia` AS `stok_tersedia`, `i`.`stok_minimal` AS `stok_minimal`, `i`.`stok_minimal`- `i`.`stok_tersedia` AS `kebutuhan_stok`, `i`.`harga_satuan` AS `harga_satuan`, (`i`.`stok_minimal` - `i`.`stok_tersedia`) * `i`.`harga_satuan` AS `estimasi_biaya`, `c`.`nama_cabang` AS `nama_cabang`, `pm`.`nama_usaha` AS `nama_usaha` FROM ((`inventori` `i` join `cabang` `c` on(`i`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) WHERE `i`.`stok_tersedia` <= `i`.`stok_minimal` AND `i`.`deleted_at` is null ORDER BY `i`.`stok_minimal`- `i`.`stok_tersedia` DESC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_tren_penjualan`
--
DROP TABLE IF EXISTS `v_tren_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tren_penjualan`  AS SELECT `pm`.`id_pemilik` AS `id_pemilik`, `pm`.`nama_usaha` AS `nama_usaha`, `c`.`id_cabang` AS `id_cabang`, `c`.`nama_cabang` AS `nama_cabang`, year(`p`.`tgl_masuk`) AS `tahun`, month(`p`.`tgl_masuk`) AS `bulan`, date_format(`p`.`tgl_masuk`,'%Y-%m') AS `periode`, count(`p`.`id_pesanan`) AS `jumlah_pesanan`, sum(`p`.`total_harga`) AS `total_penjualan`, avg(`p`.`total_harga`) AS `rata_rata_penjualan`, count(distinct `p`.`id_pelanggan`) AS `jumlah_pelanggan_unik` FROM ((`pemilik` `pm` join `cabang` `c` on(`pm`.`id_pemilik` = `c`.`id_pemilik`)) left join `pesanan` `p` on(`c`.`id_cabang` = `p`.`id_cabang` and `p`.`deleted_at` is null)) WHERE `pm`.`deleted_at` is null AND `c`.`deleted_at` is null GROUP BY `pm`.`id_pemilik`, `pm`.`nama_usaha`, `c`.`id_cabang`, `c`.`nama_cabang`, year(`p`.`tgl_masuk`), month(`p`.`tgl_masuk`) ORDER BY year(`p`.`tgl_masuk`) DESC, month(`p`.`tgl_masuk`) DESC ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `backup_data`
--
ALTER TABLE `backup_data`
  ADD PRIMARY KEY (`id_backup`),
  ADD KEY `id_pemilik` (`id_pemilik`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `bukti_transaksi`
--
ALTER TABLE `bukti_transaksi`
  ADD PRIMARY KEY (`id_bukti`),
  ADD UNIQUE KEY `id_pemasukan` (`id_pemasukan`),
  ADD UNIQUE KEY `id_pengeluaran` (`id_pengeluaran`);

--
-- Indeks untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indeks untuk tabel `chatbot_log`
--
ALTER TABLE `chatbot_log`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `id_pemilik` (`id_pemilik`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `customer_service`
--
ALTER TABLE `customer_service`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `id_pemilik` (`id_pemilik`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indeks untuk tabel `feedback_pelanggan`
--
ALTER TABLE `feedback_pelanggan`
  ADD PRIMARY KEY (`id_feedback`),
  ADD UNIQUE KEY `id_pesanan` (`id_pesanan`),
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `helpdesk_messages`
--
ALTER TABLE `helpdesk_messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `idx_ticket` (`id_ticket`);

--
-- Indeks untuk tabel `helpdesk_tickets`
--
ALTER TABLE `helpdesk_tickets`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `idx_user` (`id_user`),
  ADD KEY `idx_status` (`status`);

--
-- Indeks untuk tabel `inventori`
--
ALTER TABLE `inventori`
  ADD PRIMARY KEY (`id_inventori`),
  ADD KEY `id_cabang` (`id_cabang`),
  ADD KEY `idx_inventori_stok` (`stok_tersedia`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- Indeks untuk tabel `konten`
--
ALTER TABLE `konten`
  ADD PRIMARY KEY (`id_konten`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indeks untuk tabel `layanan_inventori`
--
ALTER TABLE `layanan_inventori`
  ADD PRIMARY KEY (`id_layanan_inventori`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD UNIQUE KEY `id_pesanan` (`id_pesanan`),
  ADD UNIQUE KEY `no_nota` (`no_nota`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notification`),
  ADD KEY `idx_pemilik_read` (`id_pemilik`,`is_read`),
  ADD KEY `idx_created` (`created_at`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `type` (`type`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `status` (`status`);

--
-- Indeks untuk tabel `oauth_sessions`
--
ALTER TABLE `oauth_sessions`
  ADD PRIMARY KEY (`id_session`),
  ADD KEY `idx_user` (`id_user`),
  ADD KEY `idx_provider` (`provider`),
  ADD KEY `idx_provider_user_id` (`provider_user_id`),
  ADD KEY `idx_last_used` (`last_used_at`);

--
-- Indeks untuk tabel `oauth_state_tokens`
--
ALTER TABLE `oauth_state_tokens`
  ADD PRIMARY KEY (`id_state`),
  ADD UNIQUE KEY `state_token` (`state_token`),
  ADD KEY `idx_state_token` (`state_token`),
  ADD KEY `idx_expires` (`expires_at`),
  ADD KEY `idx_is_used` (`is_used`);

--
-- Indeks untuk tabel `paket_langganan`
--
ALTER TABLE `paket_langganan`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id_reset`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `idx_token` (`token`),
  ADD KEY `idx_user` (`id_user`),
  ADD KEY `idx_expires` (`expires_at`);

--
-- Indeks untuk tabel `payment_audit_log`
--
ALTER TABLE `payment_audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payment_configs`
--
ALTER TABLE `payment_configs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `idx_pelanggan_no_telp` (`no_telp`),
  ADD KEY `idx_pelanggan_cabang` (`id_cabang`);

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `id_cabang` (`id_cabang`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `idx_pemasukan_pesanan` (`id_pesanan`),
  ADD KEY `idx_pemasukan_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id_pemilik`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `pending_registrations`
--
ALTER TABLE `pending_registrations`
  ADD PRIMARY KEY (`id_pending`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_cabang` (`id_cabang`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD UNIQUE KEY `idx_kode_verifikasi` (`kode_verifikasi`),
  ADD KEY `id_cabang` (`id_cabang`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_layanan` (`id_layanan`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `idx_pesanan_status` (`status_pesanan`),
  ADD KEY `idx_pesanan_tgl_masuk` (`tgl_masuk`);

--
-- Indeks untuk tabel `progres_pesanan`
--
ALTER TABLE `progres_pesanan`
  ADD PRIMARY KEY (`id_progres`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `rekomendasi_ai`
--
ALTER TABLE `rekomendasi_ai`
  ADD PRIMARY KEY (`id_rekomendasi`),
  ADD KEY `idx_pemilik` (`id_pemilik`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_created` (`created_at`);

--
-- Indeks untuk tabel `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD PRIMARY KEY (`id_token`),
  ADD KEY `idx_selector` (`selector`),
  ADD KEY `idx_user` (`id_user`);

--
-- Indeks untuk tabel `transaksi_inventori`
--
ALTER TABLE `transaksi_inventori`
  ADD PRIMARY KEY (`id_transaksi_inventori`),
  ADD KEY `id_inventori` (`id_inventori`),
  ADD KEY `id_cabang` (`id_cabang`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `transaksi_langganan`
--
ALTER TABLE `transaksi_langganan`
  ADD PRIMARY KEY (`id_transaksi_langganan`),
  ADD KEY `id_pemilik` (`id_pemilik`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `idx_transaksi_langganan_status` (`status_pembayaran`),
  ADD KEY `idx_id_paket` (`id_paket`),
  ADD KEY `idx_kode_pembayaran` (`kode_pembayaran`),
  ADD KEY `idx_id_paket_backup` (`id_paket`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idx_users_username` (`username`),
  ADD KEY `idx_users_role` (`role`),
  ADD KEY `idx_google_id` (`google_id`),
  ADD KEY `idx_oauth_provider` (`oauth_provider`);

--
-- Indeks untuk tabel `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id_code`),
  ADD KEY `idx_user` (`id_user`),
  ADD KEY `idx_code` (`code`),
  ADD KEY `idx_expires` (`expires_at`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `backup_data`
--
ALTER TABLE `backup_data`
  MODIFY `id_backup` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bukti_transaksi`
--
ALTER TABLE `bukti_transaksi`
  MODIFY `id_bukti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `chatbot_log`
--
ALTER TABLE `chatbot_log`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `customer_service`
--
ALTER TABLE `customer_service`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `feedback_pelanggan`
--
ALTER TABLE `feedback_pelanggan`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `helpdesk_messages`
--
ALTER TABLE `helpdesk_messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `helpdesk_tickets`
--
ALTER TABLE `helpdesk_tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `inventori`
--
ALTER TABLE `inventori`
  MODIFY `id_inventori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT untuk tabel `konten`
--
ALTER TABLE `konten`
  MODIFY `id_konten` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `layanan_inventori`
--
ALTER TABLE `layanan_inventori`
  MODIFY `id_layanan_inventori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `oauth_sessions`
--
ALTER TABLE `oauth_sessions`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `oauth_state_tokens`
--
ALTER TABLE `oauth_state_tokens`
  MODIFY `id_state` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `paket_langganan`
--
ALTER TABLE `paket_langganan`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id_reset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `payment_audit_log`
--
ALTER TABLE `payment_audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `payment_configs`
--
ALTER TABLE `payment_configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id_pemilik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `pending_registrations`
--
ALTER TABLE `pending_registrations`
  MODIFY `id_pending` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT untuk tabel `progres_pesanan`
--
ALTER TABLE `progres_pesanan`
  MODIFY `id_progres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT untuk tabel `rekomendasi_ai`
--
ALTER TABLE `rekomendasi_ai`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `remember_tokens`
--
ALTER TABLE `remember_tokens`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi_inventori`
--
ALTER TABLE `transaksi_inventori`
  MODIFY `id_transaksi_inventori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `transaksi_langganan`
--
ALTER TABLE `transaksi_langganan`
  MODIFY `id_transaksi_langganan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT untuk tabel `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `backup_data`
--
ALTER TABLE `backup_data`
  ADD CONSTRAINT `backup_data_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE,
  ADD CONSTRAINT `backup_data_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `bukti_transaksi`
--
ALTER TABLE `bukti_transaksi`
  ADD CONSTRAINT `bukti_transaksi_ibfk_1` FOREIGN KEY (`id_pemasukan`) REFERENCES `pemasukan` (`id_pemasukan`) ON DELETE CASCADE,
  ADD CONSTRAINT `bukti_transaksi_ibfk_2` FOREIGN KEY (`id_pengeluaran`) REFERENCES `pengeluaran` (`id_pengeluaran`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD CONSTRAINT `cabang_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `chatbot_log`
--
ALTER TABLE `chatbot_log`
  ADD CONSTRAINT `chatbot_log_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE,
  ADD CONSTRAINT `chatbot_log_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE,
  ADD CONSTRAINT `chatbot_log_ibfk_3` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `customer_service`
--
ALTER TABLE `customer_service`
  ADD CONSTRAINT `customer_service_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_service_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_service_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `feedback_pelanggan`
--
ALTER TABLE `feedback_pelanggan`
  ADD CONSTRAINT `feedback_pelanggan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedback_pelanggan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `inventori`
--
ALTER TABLE `inventori`
  ADD CONSTRAINT `inventori_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `konten`
--
ALTER TABLE `konten`
  ADD CONSTRAINT `konten_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD CONSTRAINT `layanan_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `layanan_inventori`
--
ALTER TABLE `layanan_inventori`
  ADD CONSTRAINT `layanan_inventori_ibfk_1` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `oauth_sessions`
--
ALTER TABLE `oauth_sessions`
  ADD CONSTRAINT `oauth_sessions_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `password_reset_tokens_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `fk_pelanggan_cabang` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemasukan_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE SET NULL,
  ADD CONSTRAINT `pemasukan_ibfk_3` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  ADD CONSTRAINT `pemilik_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemilik_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket_langganan` (`id_paket`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `progres_pesanan`
--
ALTER TABLE `progres_pesanan`
  ADD CONSTRAINT `progres_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `progres_pesanan_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `rekomendasi_ai`
--
ALTER TABLE `rekomendasi_ai`
  ADD CONSTRAINT `rekomendasi_ai_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD CONSTRAINT `fk_remember_tokens_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_inventori`
--
ALTER TABLE `transaksi_inventori`
  ADD CONSTRAINT `transaksi_inventori_ibfk_1` FOREIGN KEY (`id_inventori`) REFERENCES `inventori` (`id_inventori`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_inventori_ibfk_2` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_inventori_ibfk_3` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `transaksi_langganan`
--
ALTER TABLE `transaksi_langganan`
  ADD CONSTRAINT `transaksi_langganan_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_langganan_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket_langganan` (`id_paket`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_langganan_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD CONSTRAINT `fk_verification_codes_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
