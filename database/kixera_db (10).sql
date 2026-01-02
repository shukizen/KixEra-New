-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Des 2025 pada 18.08
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
  `id_user` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `activity_log`
--

INSERT INTO `activity_log` (`id_log`, `id_user`, `activity`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 18, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-16 18:02:34'),
(2, 2, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-16 18:12:12'),
(3, 2, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-16 18:13:45'),
(4, 3, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-16 18:15:12'),
(5, 3, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-16 18:24:26'),
(6, 3, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-16 18:24:31'),
(7, 3, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-16 18:36:21'),
(8, 2, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-16 18:36:27'),
(9, 2, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-16 18:52:56'),
(10, 2, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-16 18:53:01'),
(11, 8, 'Register', 'User mendaftar akun baru', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 05:38:55'),
(12, 8, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 05:39:02'),
(13, 9, 'Register', 'User mendaftar via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 05:50:54'),
(14, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 07:08:24'),
(15, 8, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 07:09:33'),
(16, 8, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 07:11:02'),
(17, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 07:11:07'),
(18, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 09:58:59'),
(19, 8, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 09:59:09'),
(20, 14, 'Register', 'User mendaftar akun baru', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:05:46'),
(21, 14, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:05:49'),
(22, 14, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:05:59'),
(23, 14, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:06:01'),
(24, 15, 'Register', 'User mendaftar via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:06:31'),
(25, 15, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:06:35'),
(26, 15, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:07:38'),
(27, 15, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:07:42'),
(28, 14, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:08:03'),
(29, 14, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:09:31'),
(30, 8, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:09:38'),
(31, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:09:47'),
(32, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:15:59'),
(33, 0, 'Forgot Password', 'Password reset requested for: hattapramana@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:16:12'),
(34, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:16:34'),
(35, 15, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:21:24'),
(36, 15, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:21:38'),
(37, 15, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:22:34'),
(38, 15, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:36:32'),
(39, 15, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 10:36:43'),
(40, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 11:09:40'),
(41, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 11:09:47'),
(42, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 13:20:50'),
(43, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 16:13:01'),
(44, 8, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 16:13:23'),
(45, 8, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 16:47:44'),
(46, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 16:58:21'),
(47, 8, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-22 18:17:40'),
(48, 8, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 04:21:18'),
(49, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 04:27:45'),
(50, 0, 'backup', 'Membuat backup database: backup_2025-12-23_04-34-02.sql', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 04:34:03'),
(51, 0, 'download_backup', 'Mengunduh backup: backup_2025-12-23_04-34-02.sql', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 04:34:10'),
(52, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 05:34:17'),
(53, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 05:43:38'),
(54, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 05:58:49'),
(55, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 05:59:00'),
(56, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 06:01:32'),
(57, 8, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 06:01:45'),
(58, 8, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 06:02:21'),
(59, 8, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 06:02:52'),
(60, 8, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 06:03:09'),
(61, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 06:03:31'),
(62, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 06:03:43'),
(63, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 06:04:02'),
(64, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 06:04:16'),
(65, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 06:05:20'),
(66, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 06:05:23'),
(67, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 09:23:52'),
(68, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 09:23:56'),
(69, 8, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 09:24:21'),
(70, 8, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 09:31:00'),
(71, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 09:31:06'),
(72, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-23 13:12:11'),
(73, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-24 02:09:37'),
(74, 16, 'Register', 'User mendaftar via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:04:45'),
(75, 16, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:06:51'),
(76, 8, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:06:57'),
(77, 8, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:07:23'),
(78, 16, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:07:28'),
(79, 16, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:13:16'),
(80, 8, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:13:21'),
(81, 8, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:14:16'),
(82, 16, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:14:25'),
(83, 16, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:17:58'),
(84, 16, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:18:04'),
(85, 16, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:18:15'),
(86, 16, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:18:31'),
(87, 16, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:18:33'),
(88, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:18:52'),
(89, 16, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:23:29'),
(90, 9, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:59:00'),
(91, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 15:59:04'),
(92, 16, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 16:28:54'),
(93, 16, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 16:29:00'),
(94, 16, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 16:32:03'),
(95, 16, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 16:33:52'),
(96, 16, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 16:56:45'),
(97, 8, 'Login', 'User login ke sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 16:56:55'),
(98, 0, 'download_backup', 'Mengunduh backup: backup_2025-12-23_04-34-02.sql', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 17:42:45'),
(99, 8, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 18:26:41'),
(100, 16, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 19:12:40'),
(101, 16, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 19:12:57'),
(102, 8, 'Logout', 'User logout dari sistem', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-29 21:25:37'),
(103, 17, 'Register', 'User mendaftar via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 16:59:07'),
(104, 9, 'Login', 'User login via Google OAuth', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 18:07:14');

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
(2, 8, 'Hatta', 'hattapramana@gmail.com', '081279393094', NULL, '2025-12-21 15:38:55', '2025-12-29 17:47:58', NULL);

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
(1, 1, 'Clean Shoes - Seturan', 'Jl. Seturan Raya No. 15', 'Jl. Seturan Raya No. 15', '0274123456', 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(2, 1, 'Clean Shoes - Condongcatur', 'Jl. Anggajaya No. 20', 'Jl. Anggajaya No. 20', '0274123457', 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(3, 2, 'Sepatu Resik - Kota Gede', 'Jl. Kemasan No. 5, Kotagede', 'Jl. Kemasan No. 5, Kotagede', '0274123458', 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(4, 2, 'Sepatu Resik - Malioboro', 'Jl. Malioboro No. 10', 'Jl. Malioboro No. 10', '0274123459', 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(5, 2, 'Sepatu Resik - Gejayan', 'Jl. Gejayan No. 25', 'Jl. Gejayan No. 25', '0274123460', 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(6, 3, 'Cabang Utama', '', NULL, '', 'aktif', '2025-12-21 22:38:55', NULL, NULL),
(8, 4, 'Seturan', 'Jl. Seturan Raya No. 88, Caturtunggal, Depok, Sleman', 'Jl. Seturan Raya No. 88, Caturtunggal, Depok, Sleman', '0274567890', 'aktif', '2025-12-22 06:06:35', '2025-12-22 10:12:40', NULL),
(9, 4, 'Bantul', 'Jl. Parangtritis Km 5.5, Sewon, Bantul', 'Jl. Parangtritis Km 5.5, Sewon, Bantul', '0274567891', 'aktif', '2025-12-22 06:06:35', '2025-12-22 10:12:31', NULL),
(10, 5, 'Cabang Utama', '', NULL, '', 'aktif', '2025-12-22 03:05:46', NULL, NULL),
(11, 6, 'Cabang Utama', '', NULL, '', 'aktif', '2025-12-22 03:06:31', NULL, NULL),
(12, 7, 'Cabang Utama', NULL, '', '', 'aktif', '2025-12-29 08:04:45', NULL, NULL),
(13, 8, 'Cabang Utama', NULL, '', '', 'aktif', '2025-12-30 09:59:07', NULL, NULL);

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
(1, 1, 2, 'Nike Air Max 90', 'Putih', 'Kotor, noda tanah', 'Hati-hati bagian mesh', NULL, NULL, '2025-12-16 17:00:21', NULL),
(2, 1, 2, 'Nike Air Max 90', 'Putih', 'Kotor, noda tanah', 'Pasangan sepatu pertama', NULL, NULL, '2025-12-16 17:00:21', NULL),
(3, 2, 3, 'Adidas Superstar', 'Putih/Hitam', 'Sol menguning', 'Focus pada sol', NULL, NULL, '2025-12-16 17:00:21', NULL),
(4, 3, 1, 'Vans Old Skool', 'Hitam', 'Berdebu', NULL, NULL, NULL, '2025-12-16 17:00:21', NULL),
(5, 4, 4, 'Converse Chuck Taylor', 'Merah', 'Noda lumpur', 'Noda sudah lama', NULL, NULL, '2025-12-16 17:00:21', NULL),
(6, 5, 5, 'New Balance 574', 'Abu-abu', 'Jahitan lepas', 'Jahitan depan kanan', NULL, NULL, '2025-12-16 17:00:21', NULL),
(7, 6, 7, 'Sneakers Generic', 'Berbagai', 'Kotor biasa', '3 pasang sepatu keluarga', NULL, NULL, '2025-12-16 17:00:21', NULL),
(8, 7, 8, 'Nike Jordan 1', 'Putih/Merah', 'Warna pudar', 'Repaint sesuai original', NULL, NULL, '2025-12-16 17:00:21', NULL),
(9, 8, 6, 'Puma RS-X', 'Biru/Putih', 'Kotor', 'Express order', NULL, NULL, '2025-12-16 17:00:21', NULL),
(10, 9, 10, 'Adidas NMD', 'Hitam/Putih', 'Kotor, sol kuning, warna pudar', 'Full restoration', NULL, NULL, '2025-12-16 17:00:21', NULL),
(11, 10, 9, 'Nike Air Force 1', 'Putih', 'Sol sangat kuning', 'Perlu unyellowing ekstra', NULL, NULL, '2025-12-16 17:00:21', NULL),
(12, 11, 11, 'Nike Air Force 1', 'Putih', 'Kotor debu', NULL, NULL, NULL, '2025-12-22 06:06:36', NULL),
(13, 12, 13, 'Adidas Ultraboost', 'Hitam/Putih', 'Kotor + sol kuning', 'Sepatu lari 2 pasang', NULL, NULL, '2025-12-22 06:06:36', NULL),
(14, 13, 12, 'Vans Old Skool', 'Hitam', 'Noda membandel', NULL, NULL, NULL, '2025-12-22 06:06:36', NULL),
(15, 14, 15, 'New Balance 574', 'Abu-abu', 'Sol sangat kuning', 'Fokus pada sol', NULL, NULL, '2025-12-22 06:06:36', NULL),
(16, 15, 14, 'Puma Suede', 'Biru', 'Kotor ringan', 'Butuh cepat', NULL, NULL, '2025-12-22 06:06:36', NULL),
(17, 16, 17, 'Clarks Desert Boot', 'Coklat', 'Kulit kering', 'Sepatu kulit formal', NULL, NULL, '2025-12-22 06:06:36', NULL),
(18, 17, 11, 'Skechers D\'Lites', 'Putih/Pink', 'Berdebu', '2 pasang sneakers', NULL, NULL, '2025-12-22 06:06:36', NULL),
(19, 18, 16, 'Air Jordan 1', 'Merah/Hitam', 'Warna pudar', 'Repaint bred colorway', NULL, NULL, '2025-12-22 06:06:36', NULL),
(20, 19, 13, 'New Balance 990', 'Abu-abu', 'Kotor berat', 'Premium treatment', NULL, NULL, '2025-12-22 06:06:36', NULL),
(21, 20, 12, 'Puma RS-X', 'Multicolor', 'Noda lumpur', 'Deep cleaning needed', NULL, NULL, '2025-12-22 06:06:36', NULL),
(22, 21, 11, 'Converse Chuck Taylor', 'Hitam', 'Kotor biasa', NULL, NULL, NULL, '2025-12-22 06:06:36', NULL),
(23, 22, 14, 'Adidas Superstar', 'Putih/Hitam', 'Kotor ringan', 'Express', NULL, NULL, '2025-12-22 06:06:36', NULL),
(24, 23, 18, 'Vintage Sneakers', 'Multi', 'Rusak berat', 'Full restoration', NULL, NULL, '2025-12-22 06:06:36', NULL),
(25, 24, 13, 'Reebok Classic', 'Putih', 'Sol kuning', 'Premium care', NULL, NULL, '2025-12-22 06:06:36', NULL),
(26, 25, 12, 'Nike Air Max 90', 'Putih/Biru', 'Kotor sedang', '2 pasang', NULL, NULL, '2025-12-22 06:06:36', NULL),
(27, 26, 15, 'Yeezy 350', 'Cream White', 'Sol kuning parah', 'Unyellowing fokus sol', NULL, NULL, '2025-12-22 06:06:36', NULL),
(28, 27, 17, 'Timberland Boots', 'Coklat', 'Kulit kering cracking', 'Leather care urgent', NULL, NULL, '2025-12-22 06:06:36', NULL),
(29, 28, 11, 'Nike Pegasus', 'Hitam/Putih', 'Debu ringan', 'Running shoes', NULL, NULL, '2025-12-22 06:06:36', NULL),
(30, 29, 14, 'Adidas NMD', 'Hitam', 'Kotor ringan', 'Express needed', NULL, NULL, '2025-12-22 06:06:36', NULL),
(31, 30, 13, 'Air Jordan 4', 'Bred', 'Kotor + sol kuning', 'Premium Jordan', NULL, NULL, '2025-12-22 06:06:36', NULL);

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

--
-- Dumping data untuk tabel `feedback_pelanggan`
--

INSERT INTO `feedback_pelanggan` (`id_feedback`, `id_pesanan`, `id_pelanggan`, `rating`, `komentar`, `tgl_feedback`, `created_at`, `deleted_at`) VALUES
(1, 3, 3, 5, 'Hasil cuci sangat bersih, cepat selesainya!', '2024-12-17 16:00:00', '2025-12-16 17:00:21', NULL),
(2, 5, 5, 4, 'Jahitan sudah rapi, tapi agak lama prosesnya', '2024-12-20 17:00:00', '2025-12-16 17:00:21', NULL),
(3, 9, 9, 5, 'Sepatu seperti baru lagi! Sangat puas dengan full treatment', '2024-12-22 16:00:00', '2025-12-16 17:00:21', NULL);

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventori`
--

CREATE TABLE `inventori` (
  `id_inventori` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `nama_item` varchar(255) NOT NULL,
  `jenis_item` enum('bahan','alat','perlengkapan') NOT NULL,
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
(1, 1, 'Sabun Cuci Sepatu', 'bahan', 'botol', 5, 20, 25000.00, 'Sabun khusus sneakers', '2025-12-16 17:00:21', NULL, NULL),
(2, 1, 'Sikat Bulu Lembut', 'alat', 'pcs', 3, 10, 15000.00, 'Untuk bahan sensitif', '2025-12-16 17:00:21', NULL, NULL),
(3, 1, 'Sikat Bulu Keras', 'alat', 'pcs', 3, 8, 12000.00, 'Untuk sol dan rubber', '2025-12-16 17:00:21', NULL, NULL),
(4, 1, 'Whitening Solution', 'bahan', 'botol', 5, 15, 35000.00, 'Cairan whitening sol', '2025-12-16 17:00:21', NULL, NULL),
(5, 1, 'Microfiber Cloth', 'perlengkapan', 'pcs', 10, 50, 5000.00, 'Kain lap microfiber', '2025-12-16 17:00:21', NULL, NULL),
(6, 2, 'Sabun Cuci Sepatu', 'bahan', 'botol', 5, 18, 25000.00, 'Sabun khusus sneakers', '2025-12-16 17:00:21', NULL, NULL),
(7, 2, 'Sikat Premium', 'alat', 'pcs', 3, 6, 20000.00, 'Sikat kualitas tinggi', '2025-12-16 17:00:21', NULL, NULL),
(8, 2, 'Deodorizer Spray', 'bahan', 'botol', 5, 12, 30000.00, 'Penghilang bau', '2025-12-16 17:00:21', NULL, NULL),
(9, 3, 'Sabun Cuci Sepatu', 'bahan', 'botol', 5, 25, 25000.00, 'Sabun khusus sneakers', '2025-12-16 17:00:21', NULL, NULL),
(10, 3, 'Cat Sepatu Hitam', 'bahan', 'botol', 3, 8, 45000.00, 'Cat repaint hitam', '2025-12-16 17:00:21', NULL, NULL),
(11, 3, 'Cat Sepatu Putih', 'bahan', 'botol', 3, 10, 45000.00, 'Cat repaint putih', '2025-12-16 17:00:21', NULL, NULL),
(12, 4, 'Sabun Cuci Express', 'bahan', 'botol', 5, 30, 30000.00, 'Sabun fast-dry', '2025-12-16 17:00:21', NULL, NULL),
(13, 4, 'Dryer Machine Pad', 'perlengkapan', 'pcs', 5, 20, 8000.00, 'Pad mesin pengering', '2025-12-16 17:00:21', NULL, NULL),
(14, 5, 'Unyellowing Cream', 'bahan', 'tube', 5, 12, 50000.00, 'Krim penghilang kuning', '2025-12-16 17:00:21', NULL, NULL),
(15, 5, 'UV Light Bulb', 'alat', 'pcs', 2, 4, 75000.00, 'Lampu UV untuk proses', '2025-12-16 17:00:21', NULL, NULL),
(16, 8, 'Sabun Premium Sneakers', 'bahan', 'botol', 10, 35, 35000.00, 'Sabun khusus sneakers premium', '2025-12-22 06:06:36', NULL, NULL),
(17, 8, 'Sikat Bulu Halus', 'alat', 'pcs', 5, 15, 18000.00, 'Untuk material sensitif', '2025-12-22 06:06:36', NULL, NULL),
(18, 8, 'Sikat Sol Keras', 'alat', 'pcs', 5, 12, 15000.00, 'Untuk sol dan rubber', '2025-12-22 06:06:36', NULL, NULL),
(19, 8, 'Whitening Cream Pro', 'bahan', 'tube', 8, 20, 45000.00, 'Pemutih sol profesional', '2025-12-22 06:06:36', NULL, NULL),
(20, 8, 'Microfiber Premium', 'perlengkapan', 'pcs', 15, 60, 8000.00, 'Lap microfiber kualitas tinggi', '2025-12-22 06:06:36', NULL, NULL),
(21, 8, 'Leather Conditioner', 'bahan', 'botol', 5, 12, 55000.00, 'Perawatan kulit premium', '2025-12-22 06:06:36', NULL, NULL),
(22, 8, 'Repaint Base Black', 'bahan', 'botol', 3, 8, 65000.00, 'Cat dasar hitam', '2025-12-22 06:06:36', NULL, NULL),
(23, 8, 'Repaint Base White', 'bahan', 'botol', 3, 10, 65000.00, 'Cat dasar putih', '2025-12-22 06:06:36', NULL, NULL),
(24, 8, 'Unyellowing Solution', 'bahan', 'botol', 5, 15, 50000.00, 'Cairan anti kuning', '2025-12-22 06:06:36', NULL, NULL),
(25, 8, 'Shoe Deodorizer', 'bahan', 'botol', 8, 25, 25000.00, 'Penghilang bau sepatu', '2025-12-22 06:06:36', NULL, NULL),
(26, 9, 'Sabun Premium Sneakers', 'bahan', 'botol', 10, 30, 35000.00, 'Sabun khusus sneakers premium', '2025-12-22 06:06:36', NULL, NULL),
(27, 9, 'Sikat Bulu Halus', 'alat', 'pcs', 5, 12, 18000.00, 'Untuk material sensitif', '2025-12-22 06:06:36', NULL, NULL),
(28, 9, 'Sikat Sol Keras', 'alat', 'pcs', 5, 10, 15000.00, 'Untuk sol dan rubber', '2025-12-22 06:06:36', NULL, NULL),
(29, 9, 'Whitening Cream Pro', 'bahan', 'tube', 8, 18, 45000.00, 'Pemutih sol profesional', '2025-12-22 06:06:36', NULL, NULL),
(30, 9, 'Microfiber Premium', 'perlengkapan', 'pcs', 15, 55, 8000.00, 'Lap microfiber kualitas tinggi', '2025-12-22 06:06:36', NULL, NULL),
(31, 9, 'Leather Conditioner', 'bahan', 'botol', 5, 10, 55000.00, 'Perawatan kulit premium', '2025-12-22 06:06:36', NULL, NULL),
(32, 9, 'Repaint Base Black', 'bahan', 'botol', 3, 6, 65000.00, 'Cat dasar hitam', '2025-12-22 06:06:36', NULL, NULL),
(33, 9, 'Repaint Base White', 'bahan', 'botol', 3, 8, 65000.00, 'Cat dasar putih', '2025-12-22 06:06:36', NULL, NULL),
(34, 9, 'Unyellowing Solution', 'bahan', 'botol', 5, 12, 50000.00, 'Cairan anti kuning', '2025-12-22 06:06:36', NULL, NULL),
(35, 9, 'Shoe Deodorizer', 'bahan', 'botol', 8, 20, 25000.00, 'Penghilang bau sepatu', '2025-12-22 06:06:36', NULL, NULL);

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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_user`, `id_cabang`, `nama`, `email`, `no_telp`, `foto_profil`, `jabatan`, `alamat`, `tgl_masuk`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, 'Andi Prasetyo', 'andi@cleanshoes.com', '081345678901', NULL, 'Staff Cuci', 'Jl. Kaliurang Km 7', '2024-01-15', '2025-12-16 17:00:21', NULL, NULL),
(2, 5, 1, 'Dewi Lestari', 'dewi@cleanshoes.com', '081345678902', NULL, 'Kasir', 'Jl. Seturan No. 10', '2024-02-01', '2025-12-16 17:00:21', NULL, NULL),
(3, 6, 2, 'Rudi Hermawan', 'rudi@cleanshoes.com', '081345678903', NULL, 'Staff Cuci', 'Jl. Condongcatur No. 5', '2024-03-10', '2025-12-16 17:00:21', NULL, NULL),
(4, 7, 3, 'Nina Safitri', 'nina@sepaturesik.com', '081345678904', NULL, 'Staff Cuci', 'Jl. Kotagede No. 8', '2024-01-20', '2025-12-16 17:00:21', NULL, NULL),
(5, 10, 8, 'Rizky Pratama', 'rizky@aethertech.com', '081234567801', NULL, 'Staff Cuci', 'Jl. Kaliurang Km 8, Sleman', '2025-01-10', '2025-12-22 06:06:35', NULL, NULL),
(6, 11, 8, 'Ayu Lestari', 'ayu@aethertech.com', '081234567802', NULL, 'Kasir', 'Jl. Seturan No. 25, Sleman', '2025-01-15', '2025-12-22 06:06:35', NULL, NULL),
(7, 12, 9, 'Bayu Saputra', 'bayu@aethertech.com', '081234567803', NULL, 'Staff Cuci', 'Jl. Bantul No. 12, Bantul', '2025-02-01', '2025-12-22 06:06:35', NULL, NULL),
(8, 13, 9, 'Dina Puspita', 'dina@aethertech.com', '081234567804', NULL, 'Kasir', 'Jl. Parangtritis Km 6, Bantul', '2025-02-05', '2025-12-22 06:06:35', NULL, NULL);

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
(1, 1, 'Cuci Reguler', 'Cuci standar untuk sepatu sneakers', 25000.00, 2, 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(2, 1, 'Cuci Premium', 'Cuci mendalam dengan perawatan khusus', 35000.00, 3, 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(3, 1, 'Whitening', 'Pemutihan sol dan bagian putih', 45000.00, 4, 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(4, 1, 'Deep Clean', 'Cuci ekstra dengan penghilang noda membandel', 55000.00, 5, 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(5, 1, 'Repair', 'Perbaikan jahitan dan lem', 75000.00, 7, 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(6, 2, 'Cuci Express', 'Cuci cepat dalam 1 hari', 40000.00, 1, 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(7, 2, 'Cuci Standar', 'Cuci biasa dengan hasil maksimal', 30000.00, 3, 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(8, 2, 'Repaint', 'Pengecatan ulang sepatu', 100000.00, 7, 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(9, 2, 'Unyellowing', 'Menghilangkan warna kuning pada sol', 60000.00, 4, 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(10, 2, 'Full Treatment', 'Paket lengkap cuci, whitening, dan repaint', 150000.00, 10, 'aktif', '2025-12-16 17:00:21', NULL, NULL),
(11, 4, 'Basic Cleaning', 'Cuci sepatu standar untuk sepatu sehari-hari', 30000.00, 2, 'aktif', '2025-12-22 06:06:35', '2025-12-29 15:26:20', '2025-12-29 09:26:20'),
(12, 4, 'Deep Cleaning', 'Cuci mendalam dengan treatment khusus', 50000.00, 3, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(13, 4, 'Premium Care', 'Cuci premium + whitening + protection', 75000.00, 4, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(14, 4, 'Fast Clean', 'Cuci express selesai 1 hari', 45000.00, 1, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(15, 4, 'Unyellowing Service', 'Hilangkan kuning pada sol sepatu', 65000.00, 3, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(16, 4, 'Repaint Pro', 'Pengecatan ulang profesional', 120000.00, 7, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(17, 4, 'Leather Treatment', 'Perawatan khusus sepatu kulit', 85000.00, 5, 'aktif', '2025-12-22 06:06:35', NULL, NULL),
(18, 4, 'Complete Restoration', 'Paket lengkap cuci + repair + repaint', 180000.00, 10, 'aktif', '2025-12-22 06:06:35', NULL, NULL);

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
(25, 8, 'User login', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-30 16:40:28', '2025-12-30 15:40:28', NULL);

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

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`id_nota`, `id_pesanan`, `no_nota`, `tgl_cetak`, `id_karyawan`, `total_bayar`, `metode_pembayaran`, `created_at`, `deleted_at`) VALUES
(1, 3, 'NOTA-20241217-001', '2024-12-17 15:30:00', 1, 25000.00, 'cash', '2025-12-16 17:00:21', NULL),
(2, 5, 'NOTA-20241220-001', '2024-12-20 16:00:00', 3, 75000.00, 'transfer', '2025-12-16 17:00:21', NULL),
(3, 9, 'NOTA-20241222-001', '2024-12-22 15:30:00', NULL, 150000.00, 'qris', '2025-12-16 17:00:21', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `type` enum('order','payment','pickup','general') DEFAULT 'general',
  `related_id` int(11) DEFAULT NULL COMMENT 'ID pesanan/transaksi terkait',
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id_notification`, `id_pemilik`, `title`, `message`, `type`, `related_id`, `is_read`, `created_at`, `read_at`) VALUES
(1, 1, 'Selamat datang di KixEra!', 'Sistem notifikasi telah aktif. Anda akan menerima notifikasi untuk setiap aktivitas penting.', 'general', NULL, 0, '2025-12-22 16:59:40', NULL),
(2, 2, 'Selamat datang di KixEra!', 'Sistem notifikasi telah aktif. Anda akan menerima notifikasi untuk setiap aktivitas penting.', 'general', NULL, 0, '2025-12-22 16:59:40', NULL),
(3, 3, 'Selamat datang di KixEra!', 'Sistem notifikasi telah aktif. Anda akan menerima notifikasi untuk setiap aktivitas penting.', 'general', NULL, 0, '2025-12-22 16:59:40', NULL),
(4, 4, 'Selamat datang di KixEra!', 'Sistem notifikasi telah aktif. Anda akan menerima notifikasi untuk setiap aktivitas penting.', 'general', NULL, 0, '2025-12-22 16:59:40', NULL),
(5, 5, 'Selamat datang di KixEra!', 'Sistem notifikasi telah aktif. Anda akan menerima notifikasi untuk setiap aktivitas penting.', 'general', NULL, 0, '2025-12-22 16:59:40', NULL);

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
(3, 'Enterprise', 'Paket untuk usaha besar', 399000.00, 30, '{\"cabang\": -1, \"karyawan\": -1}', 'aktif', '2025-12-16 17:00:21', NULL, NULL);

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
  `created_at` datetime DEFAULT current_timestamp(),
  `used_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id_reset`, `id_user`, `token`, `email`, `is_used`, `expires_at`, `created_at`, `used_at`) VALUES
(1, 8, '484246b0f951130fe4787eb8f4ff918a2039ff028f348988774e6773bfcdff57', 'hattapramana@gmail.com', 0, '2025-12-22 11:16:12', '2025-12-22 10:16:12', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_cabang`, `nama`, `no_telp`, `email`, `alamat`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Ahmad Rizki', '081567890123', 'ahmad@gmail.com', 'Jl. Magelang No. 15', '2025-12-16 17:00:21', NULL, NULL),
(2, NULL, 'Putri Handayani', '081567890124', 'putri@gmail.com', 'Jl. Solo No. 20', '2025-12-16 17:00:21', NULL, NULL),
(3, NULL, 'Dimas Pratama', '081567890125', 'dimas@gmail.com', 'Jl. Godean No. 8', '2025-12-16 17:00:21', NULL, NULL),
(4, NULL, 'Rina Wati', '081567890126', 'rina@gmail.com', 'Jl. Bantul No. 30', '2025-12-16 17:00:21', NULL, NULL),
(5, NULL, 'Yoga Setiawan', '081567890127', 'yoga@gmail.com', 'Jl. Wates No. 12', '2025-12-16 17:00:21', NULL, NULL),
(6, NULL, 'Lisa Permata', '081567890128', 'lisa@gmail.com', 'Jl. Kaliurang Km 10', '2025-12-16 17:00:21', NULL, NULL),
(7, NULL, 'Bagus Wicaksono', '081567890129', 'bagus@gmail.com', 'Jl. Seturan No. 5', '2025-12-16 17:00:21', NULL, NULL),
(8, NULL, 'Maya Sari', '081567890130', 'maya@gmail.com', 'Jl. Condongcatur No. 15', '2025-12-16 17:00:21', NULL, NULL),
(9, NULL, 'Fajar Nugroho', '081567890131', 'fajar@gmail.com', 'Jl. Gejayan No. 7', '2025-12-16 17:00:21', NULL, NULL),
(10, NULL, 'Indah Permatasari', '081567890132', 'indah@gmail.com', 'Jl. Kotagede No. 22', '2025-12-16 17:00:21', NULL, NULL),
(11, 8, 'Agung Prasetyo1', '082134567801', 'agung.p@gmail.com', 'Jl. Babarsari No. 10, Sleman', '2025-12-22 06:06:35', '2025-12-29 09:02:23', NULL),
(12, 8, 'Bella Putri', '082134567802', 'bella.putri@gmail.com', 'Jl. Affandi No. 5, Sleman', '2025-12-22 06:06:35', NULL, NULL),
(13, 8, 'Cahyo Wibowo', '082134567803', 'cahyo.w@gmail.com', 'Jl. Colombo No. 15, Sleman', '2025-12-22 06:06:35', NULL, NULL),
(14, 8, 'Diana Sari', '082134567804', 'diana.sari@gmail.com', 'Jl. Gejayan No. 30, Sleman', '2025-12-22 06:06:35', NULL, NULL),
(15, 8, 'Eko Susanto', '082134567805', 'eko.susanto@gmail.com', 'Jl. Monjali No. 8, Sleman', '2025-12-22 06:06:35', NULL, NULL),
(16, 9, 'Fitri Handayani', '082134567806', 'fitri.h@gmail.com', 'Jl. Bantul No. 20, Bantul', '2025-12-22 06:06:35', NULL, NULL),
(17, 9, 'Galih Nugroho', '082134567807', 'galih.n@gmail.com', 'Jl. Parangtritis Km 7, Bantul', '2025-12-22 06:06:35', NULL, NULL),
(18, 9, 'Hana Wijaya', '082134567808', 'hana.wijaya@gmail.com', 'Jl. Imogiri No. 12, Bantul', '2025-12-22 06:06:35', NULL, NULL),
(19, 9, 'Irfan Hakim', '082134567809', 'irfan.hakim@gmail.com', 'Jl. Sewon No. 25, Bantul', '2025-12-22 06:06:35', NULL, NULL),
(20, 9, 'Julia Permata', '082134567810', 'julia.p@gmail.com', 'Jl. Bantul Barat No. 5, Bantul', '2025-12-22 06:06:35', NULL, NULL),
(21, 8, 'Kevin Tanjung', '082134567811', 'kevin.t@gmail.com', 'Jl. Kaliurang Km 12, Sleman', '2025-12-22 06:06:35', NULL, NULL),
(22, 8, 'Lina Margaretha', '082134567812', 'lina.m@gmail.com', 'Jl. Palagan No. 18, Sleman', '2025-12-22 06:06:35', NULL, NULL),
(23, 9, 'Mario Kusuma', '082134567813', 'mario.k@gmail.com', 'Jl. Piyungan No. 7, Bantul', '2025-12-22 06:06:35', NULL, NULL),
(24, 9, 'Nina Safira', '082134567814', 'nina.safira@gmail.com', 'Jl. Kasihan No. 15, Bantul', '2025-12-22 06:06:35', NULL, NULL),
(25, 8, 'Oscar Rahmad', '082134567815', 'oscar.r@gmail.com', 'Jl. Condongcatur No. 22, Sleman', '2025-12-22 06:06:35', NULL, NULL);

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
(1, 1, 'Pembayaran Pesanan #3', 'pesanan', 25000.00, '2024-12-17', 3, 'Pembayaran pesanan KX-20241215-001', 1, '2025-12-16 17:00:21', NULL, NULL),
(2, 2, 'Pembayaran Pesanan #5', 'pesanan', 75000.00, '2024-12-20', 5, 'Pembayaran pesanan KX-20241214-001', 3, '2025-12-16 17:00:21', NULL, NULL),
(3, 4, 'Pembayaran Pesanan #9', 'pesanan', 150000.00, '2024-12-22', 9, 'Pembayaran pesanan KX-20241213-001', NULL, '2025-12-16 17:00:21', NULL, NULL),
(4, 8, 'Pembayaran AT-20251201-001', 'pesanan', 30000.00, '2025-12-01', 11, 'Basic Cleaning Nike Air Force', 6, '2025-12-22 06:06:36', NULL, NULL),
(5, 8, 'Pembayaran AT-20251202-001', 'pesanan', 150000.00, '2025-12-02', 12, 'Premium Care 2 pasang', 6, '2025-12-22 06:06:36', NULL, NULL),
(6, 8, 'Pembayaran AT-20251205-001', 'pesanan', 50000.00, '2025-12-05', 13, 'Deep Cleaning Vans', 6, '2025-12-22 06:06:36', NULL, NULL),
(7, 8, 'Pembayaran AT-20251208-001', 'pesanan', 65000.00, '2025-12-08', 14, 'Unyellowing Service', 6, '2025-12-22 06:06:36', NULL, NULL),
(8, 8, 'Pembayaran AT-20251210-001', 'pesanan', 45000.00, '2025-12-10', 15, 'Fast Clean', 6, '2025-12-22 06:06:36', NULL, NULL),
(9, 8, 'Pembayaran AT-20251212-001', 'pesanan', 85000.00, '2025-12-12', 16, 'Leather Treatment', 6, '2025-12-22 06:06:36', NULL, NULL),
(10, 8, 'Pembayaran AT-20251215-001', 'pesanan', 60000.00, '2025-12-15', 17, 'Basic Clean 2 pasang', 6, '2025-12-22 06:06:36', NULL, NULL),
(11, 9, 'Pembayaran AT-20251201-002', 'pesanan', 30000.00, '2025-12-01', 21, 'Basic Cleaning Converse', 8, '2025-12-22 06:06:36', NULL, NULL),
(12, 9, 'Pembayaran AT-20251203-001', 'pesanan', 45000.00, '2025-12-03', 22, 'Fast Clean Adidas', 8, '2025-12-22 06:06:36', NULL, NULL),
(13, 9, 'Pembayaran AT-20251205-002', 'pesanan', 180000.00, '2025-12-05', 23, 'Complete Restoration', 8, '2025-12-22 06:06:36', NULL, NULL),
(14, 9, 'Pembayaran AT-20251207-001', 'pesanan', 75000.00, '2025-12-07', 24, 'Premium Care Reebok', 8, '2025-12-22 06:06:36', NULL, NULL),
(15, 9, 'Pembayaran AT-20251210-002', 'pesanan', 100000.00, '2025-12-10', 25, 'Deep Clean 2 pasang', 8, '2025-12-22 06:06:36', NULL, NULL),
(16, 12, 'penjualan', 'Penjualan', 7000000.00, '2025-12-29', NULL, NULL, NULL, '2025-12-29 08:15:05', '2025-12-29 15:55:53', '2025-12-29 09:55:53');

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
  `alamat_usaha` text DEFAULT NULL,
  `status_langganan` enum('aktif','nonaktif','trial') DEFAULT 'trial',
  `id_paket` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemilik`
--

INSERT INTO `pemilik` (`id_pemilik`, `id_user`, `nama`, `email`, `no_telp`, `foto_profil`, `nama_usaha`, `alamat_usaha`, `status_langganan`, `id_paket`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Budi Santoso', 'budi@cleanshoes.com', '081234567891', NULL, 'Clean Shoes Jogja', 'Jl. Kaliurang Km 5, Yogyakarta', 'aktif', 2, '2025-12-16 17:00:21', NULL, NULL),
(2, 3, 'Sari Dewi', 'sari@sepaturesik.com', '081234567892', NULL, 'Sepatu Resik', 'Jl. Malioboro No. 10, Yogyakarta', 'aktif', 3, '2025-12-16 17:00:21', NULL, NULL),
(3, 8, 'Hatta', 'hattapramana@gmail.com', '081278421122', NULL, 'Toko hatta', NULL, 'trial', NULL, '2025-12-21 22:38:55', NULL, NULL),
(4, 9, 'AetherTech', 'rizkipangestu852@gmail.com', NULL, 'uploads/profile/profile_4_1766421273.jpg', 'AetherTech\'s Business', NULL, 'aktif', 2, '2025-12-21 22:50:54', '2025-12-30 17:06:52', NULL),
(5, 14, 'rayan', 'rayan@gmail.com', '0812732139123', NULL, 'sancare', NULL, 'trial', NULL, '2025-12-22 03:05:46', NULL, NULL),
(6, 15, 'RIZKI PANGESTU 23.12.3029', 'riskypangestu057@students.amikom.ac.id', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocI_XbhjTJ-lE_VUNA2FqBySHyeCukLOVbQ4Bg8qYvK4p0jZOQ=s96-c', 'RIZKI PANGESTU 23.12.3029\'s Business', NULL, 'trial', NULL, '2025-12-22 03:06:31', NULL, NULL),
(7, 16, 'Rizki Pangestu', 'riskypangestu057@gmail.com', NULL, 'uploads/profile/profile_7_1767018913.png', 'Rizki Pangestu\'s Business', NULL, 'trial', NULL, '2025-12-29 08:04:45', '2025-12-29 08:35:13', NULL),
(8, 17, 'Rizki Pangestu', 'rizkipangestu291@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocJV4ytlHnxz4dY-5dlHuKdrA43eN8GbDpErD2e4Y7lvAGly-6E=s96-c', 'Rizki Pangestu\'s Business', NULL, 'trial', NULL, '2025-12-30 09:59:07', NULL, NULL);

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
(1, 1, 'Restock Sabun Cuci', 'bahan', 250000.00, '2024-12-15', 'Restock sabun cuci 10 botol', 1, '2025-12-16 17:00:21', NULL, NULL),
(2, 1, 'Tagihan Listrik', 'operasional', 100000.00, '2024-12-01', 'Tagihan listrik Desember', NULL, '2025-12-16 17:00:21', NULL, NULL),
(3, 2, 'Restock Whitening', 'bahan', 200000.00, '2024-12-10', 'Restock whitening solution', 3, '2025-12-16 17:00:21', NULL, NULL),
(4, 3, 'Gaji Karyawan', 'gaji', 500000.00, '2024-12-15', 'Gaji karyawan minggu 2', NULL, '2025-12-16 17:00:21', NULL, NULL),
(5, 4, 'Beli Dryer Pad', 'perlengkapan', 150000.00, '2024-12-12', 'Beli dryer pad baru', NULL, '2025-12-16 17:00:21', NULL, NULL),
(6, 8, 'Restock Sabun Premium', 'bahan', 350000.00, '2025-12-01', 'Beli sabun 10 botol', 5, '2025-12-22 06:06:36', NULL, NULL),
(7, 8, 'Tagihan Listrik Desember', 'operasional', 120000.00, '2025-12-01', 'Listrik bulan Desember', NULL, '2025-12-22 06:06:36', NULL, NULL),
(8, 8, 'Restock Whitening Cream', 'bahan', 270000.00, '2025-12-05', 'Beli 6 tube whitening', 5, '2025-12-22 06:06:36', NULL, NULL),
(9, 8, 'Gaji Karyawan Minggu 1', 'gaji', 600000.00, '2025-12-07', 'Gaji 2 karyawan minggu 1', NULL, '2025-12-22 06:06:36', NULL, NULL),
(10, 8, 'Restock Cat Repaint', 'bahan', 390000.00, '2025-12-10', 'Cat hitam & putih', 5, '2025-12-22 06:06:36', NULL, NULL),
(11, 8, 'Biaya Air PDAM', 'operasional', 80000.00, '2025-12-12', 'Tagihan air Desember', NULL, '2025-12-22 06:06:36', NULL, NULL),
(12, 8, 'Maintenance Peralatan', 'operasional', 150000.00, '2025-12-15', 'Service mesin pengering', 6, '2025-12-22 06:06:36', NULL, NULL),
(13, 9, 'Restock Sabun Premium', 'bahan', 350000.00, '2025-12-02', 'Beli sabun 10 botol', 7, '2025-12-22 06:06:36', NULL, NULL),
(14, 9, 'Tagihan Listrik Desember', 'operasional', 110000.00, '2025-12-01', 'Listrik bulan Desember', NULL, '2025-12-22 06:06:36', NULL, NULL),
(15, 9, 'Restock Leather Care', 'bahan', 275000.00, '2025-12-06', 'Leather conditioner 5 botol', 7, '2025-12-22 06:06:36', NULL, NULL),
(16, 9, 'Gaji Karyawan Minggu 1', 'gaji', 600000.00, '2025-12-08', 'Gaji 2 karyawan minggu 1', NULL, '2025-12-22 06:06:36', NULL, NULL),
(17, 9, 'Restock Microfiber', 'perlengkapan', 200000.00, '2025-12-11', 'Lap microfiber 25 pcs', 8, '2025-12-22 06:06:36', NULL, NULL),
(18, 9, 'Biaya Air PDAM', 'operasional', 75000.00, '2025-12-12', 'Tagihan air Desember', NULL, '2025-12-22 06:06:36', '2025-12-29 14:27:58', '2025-12-29 08:27:58');

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
  `status_pesanan` enum('diterima','dalam_proses','selesai','siap_diambil','sudah_diambil','dibatalkan') DEFAULT 'diterima',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nomor_pesanan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, `tgl_masuk`, `tgl_estimasi_selesai`, `tgl_selesai`, `tgl_diambil`, `jumlah_item`, `total_harga`, `status_pesanan`, `catatan`, `created_at`, `updated_at`, `deleted_at`, `nomor_pesanan`) VALUES
(1, 1, 1, 2, 1, '2024-12-16 00:00:00', '2024-12-18 13:00:00', NULL, NULL, 2, 70000.00, 'dibatalkan', 'Sepatu Nike Air Max putih', '2025-12-16 17:00:21', '2025-12-16 11:43:46', NULL, 'KX-20241216-001'),
(2, 1, 2, 3, 2, '2024-12-16 10:30:00', '2024-12-20 17:00:00', NULL, NULL, 1, 45000.00, 'diterima', 'Sol sudah menguning', '2025-12-16 17:00:21', NULL, NULL, 'KX-20241216-002'),
(3, 1, 3, 1, 1, '2024-12-15 00:00:00', '2024-12-17 10:00:00', '2024-12-17 15:00:00', NULL, 1, 25000.00, 'sudah_diambil', '', '2025-12-16 17:00:21', '2025-12-16 11:43:08', NULL, 'KX-20241215-001'),
(4, 2, 4, 4, 3, '2024-12-16 11:00:00', '2024-12-21 17:00:00', NULL, NULL, 1, 55000.00, 'dalam_proses', 'Noda lumpur membandel', '2025-12-16 17:00:21', NULL, NULL, 'KX-20241216-003'),
(5, 2, 5, 5, 3, '2024-12-14 00:00:00', '2024-12-21 03:00:00', '2024-12-20 14:00:00', '2024-12-20 16:00:00', 1, 75000.00, 'sudah_diambil', 'Jahitan depan lepas', '2025-12-16 17:00:21', '2025-12-16 11:42:51', NULL, 'KX-20241214-001'),
(6, 3, 6, 7, 4, '2024-12-16 08:30:00', '2024-12-19 17:00:00', NULL, NULL, 3, 90000.00, 'diterima', 'Sepatu keluarga', '2025-12-16 17:00:21', NULL, NULL, 'KX-20241216-004'),
(7, 3, 7, 8, 4, '2024-12-15 10:00:00', '2024-12-22 17:00:00', NULL, NULL, 1, 100000.00, 'dalam_proses', 'Repaint warna hitam', '2025-12-16 17:00:21', NULL, NULL, 'KX-20241215-002'),
(8, 4, 8, 6, 4, '2024-12-16 00:00:00', '2024-12-17 10:00:00', NULL, NULL, 2, 80000.00, 'diterima', 'Express - butuh cepat', '2025-12-16 17:00:21', '2025-12-16 11:36:13', NULL, 'KX-20241216-005'),
(9, 4, 9, 8, 4, '2024-12-13 00:00:00', '2024-12-21 23:00:00', '2024-12-22 10:00:00', '2024-12-22 15:00:00', 1, 150000.00, 'dalam_proses', 'Full treatment untuk sepatu lama', '2025-12-16 17:00:21', '2025-12-16 11:36:17', NULL, 'KX-20241213-001'),
(10, 5, 10, 9, NULL, '2024-12-16 13:00:00', '2024-12-20 17:00:00', NULL, NULL, 1, 60000.00, 'dalam_proses', 'Sol kuning parah', '2025-12-16 17:00:21', NULL, NULL, 'KX-20241216-006'),
(11, 8, 11, 11, 5, '2025-12-01 09:00:00', '2025-12-03 17:00:00', '2025-12-03 15:00:00', '2025-12-03 18:00:00', 1, 30000.00, 'sudah_diambil', 'Nike Air Force putih', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251201-001'),
(12, 8, 12, 13, 5, '2025-12-02 10:30:00', '2025-12-06 17:00:00', '2025-12-06 14:00:00', '2025-12-07 10:00:00', 2, 150000.00, 'sudah_diambil', 'Adidas Ultraboost - 2 pasang', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251202-001'),
(13, 8, 13, 12, 6, '2025-12-05 11:00:00', '2025-12-08 17:00:00', '2025-12-08 16:00:00', NULL, 1, 50000.00, 'siap_diambil', 'Vans Old Skool hitam', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251205-001'),
(14, 8, 14, 15, 5, '2025-12-08 14:00:00', '2025-12-11 17:00:00', '2025-12-11 15:00:00', NULL, 1, 65000.00, 'siap_diambil', 'Sol kuning parah', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251208-001'),
(15, 8, 15, 14, 6, '2025-12-10 09:30:00', '2025-12-11 17:00:00', NULL, NULL, 1, 45000.00, 'selesai', 'Express - butuh cepat', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251210-001'),
(16, 8, 21, 17, 5, '2025-12-12 10:00:00', '2025-12-17 17:00:00', NULL, NULL, 1, 85000.00, 'dalam_proses', 'Sepatu kulit formal', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251212-001'),
(17, 8, 22, 11, 6, '2025-12-15 13:00:00', '2025-12-17 17:00:00', NULL, NULL, 2, 60000.00, 'dalam_proses', 'Sneakers casual 2 pasang', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251215-001'),
(18, 8, 25, 16, 5, '2025-12-18 11:30:00', '2025-12-25 17:00:00', NULL, NULL, 1, 120000.00, 'diterima', 'Repaint Jordan 1 bred', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251218-001'),
(19, 8, 11, 13, 6, '2025-12-20 09:00:00', '2025-12-24 17:00:00', NULL, NULL, 1, 75000.00, 'diterima', 'Premium care New Balance', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251220-001'),
(20, 8, 12, 12, 5, '2025-12-21 10:00:00', '2025-12-24 17:00:00', NULL, NULL, 1, 50000.00, 'diterima', 'Deep clean Puma RS-X', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251221-001'),
(21, 9, 16, 11, 7, '2025-12-01 10:00:00', '2025-12-03 17:00:00', '2025-12-03 14:00:00', '2025-12-04 09:00:00', 1, 30000.00, 'sudah_diambil', 'Converse Chuck Taylor', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251201-002'),
(22, 9, 17, 14, 8, '2025-12-03 11:30:00', '2025-12-04 17:00:00', '2025-12-04 16:00:00', '2025-12-05 11:00:00', 1, 45000.00, 'sudah_diambil', 'Fast clean Adidas', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251203-001'),
(23, 9, 18, 18, 7, '2025-12-05 09:00:00', '2025-12-15 17:00:00', NULL, NULL, 1, 180000.00, 'dalam_proses', 'Full restoration vintage shoes', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251205-002'),
(24, 9, 19, 13, 8, '2025-12-07 14:00:00', '2025-12-11 17:00:00', '2025-12-11 13:00:00', NULL, 1, 75000.00, 'siap_diambil', 'Premium Reebok Classic', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251207-001'),
(25, 9, 20, 12, 7, '2025-12-10 10:30:00', '2025-12-13 17:00:00', NULL, NULL, 2, 100000.00, 'selesai', 'Deep clean 2 pasang Nike', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251210-002'),
(26, 9, 23, 15, 8, '2025-12-12 13:00:00', '2025-12-15 17:00:00', NULL, NULL, 1, 65000.00, 'dalam_proses', 'Unyellowing Yeezy', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251212-002'),
(27, 9, 24, 17, 7, '2025-12-14 11:00:00', '2025-12-19 17:00:00', NULL, NULL, 1, 85000.00, 'dalam_proses', 'Leather boots treatment', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251214-001'),
(28, 9, 16, 11, 8, '2025-12-16 09:30:00', '2025-12-18 17:00:00', NULL, NULL, 1, 30000.00, 'diterima', 'Basic clean running shoes', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251216-001'),
(29, 9, 17, 14, 7, '2025-12-19 10:00:00', '2025-12-20 17:00:00', NULL, NULL, 1, 45000.00, 'diterima', 'Express service', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251219-001'),
(30, 9, 18, 13, 8, '2025-12-21 11:00:00', '2025-12-25 17:00:00', NULL, NULL, 1, 75000.00, 'diterima', 'Premium Jordan 4', '2025-12-22 06:06:36', NULL, NULL, 'AT-20251221-002');

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
(1, 1, 'diterima', 'Pesanan diterima', 1, '2024-12-16 09:00:00', '2025-12-16 17:00:21', NULL),
(2, 1, 'dalam_proses', 'Mulai proses cuci', 1, '2024-12-16 10:00:00', '2025-12-16 17:00:21', NULL),
(3, 3, 'diterima', 'Pesanan diterima', 1, '2024-12-15 14:00:00', '2025-12-16 17:00:21', NULL),
(4, 3, 'dalam_proses', 'Proses cuci', 1, '2024-12-15 15:00:00', '2025-12-16 17:00:21', NULL),
(5, 3, 'selesai', 'Sepatu sudah bersih', 1, '2024-12-17 15:00:00', '2025-12-16 17:00:21', NULL),
(6, 5, 'diterima', 'Pesanan diterima', 3, '2024-12-14 09:00:00', '2025-12-16 17:00:21', NULL),
(7, 5, 'dalam_proses', 'Proses repair jahitan', 3, '2024-12-14 11:00:00', '2025-12-16 17:00:21', NULL),
(8, 5, 'selesai', 'Jahitan sudah diperbaiki', 3, '2024-12-20 14:00:00', '2025-12-16 17:00:21', NULL),
(9, 5, 'sudah_diambil', 'Pelanggan sudah mengambil', 3, '2024-12-20 16:00:00', '2025-12-16 17:00:21', NULL);

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
(1, 5, 2, NULL, '2025-12-22 10:08:34', 199000.00, 'midtrans', 'pending', 'KIX-20251222100834-7788', '2025-12-22', '2026-01-22', '2025-12-22 03:08:34', '2025-12-22 18:22:28', '2025-12-22 12:22:28'),
(2, 4, 2, NULL, '2025-12-23 05:59:42', 199000.00, 'midtrans', 'pending', 'KIX-20251223055942-8920', '2025-12-23', '2026-01-23', '2025-12-22 22:59:42', NULL, NULL),
(3, 4, 2, NULL, '2025-12-23 06:00:21', 2388000.00, 'midtrans', 'pending', 'KIX-20251223060021-1363', '2025-12-23', '2026-12-23', '2025-12-22 23:00:21', NULL, NULL);

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
(1, 'admin', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'aktif', '2025-12-16 17:00:21', '2025-12-22 18:07:52', '2025-12-22 12:07:52', NULL, NULL, NULL),
(2, 'owner_budi', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2025-12-16 17:00:21', '2025-12-16 17:11:53', NULL, NULL, NULL, NULL),
(3, 'owner_sari', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2025-12-16 17:00:21', '2025-12-16 17:11:53', NULL, NULL, NULL, NULL),
(4, 'karyawan_andi', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2025-12-16 17:00:21', '2025-12-16 17:11:53', NULL, NULL, NULL, NULL),
(5, 'karyawan_dewi', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2025-12-16 17:00:21', '2025-12-16 17:11:53', NULL, NULL, NULL, NULL),
(6, 'karyawan_rudi', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2025-12-16 17:00:21', '2025-12-16 17:11:53', NULL, NULL, NULL, NULL),
(7, 'karyawan_nina', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2025-12-16 17:00:21', '2025-12-16 17:11:53', NULL, NULL, NULL, NULL),
(8, 'hatta751', '$2y$10$yuwzcYvHFVrk7WG0mC7SieO/..uSikH9oF9ap9MrUCUxqPkCB/uYK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'aktif', '2025-12-21 22:38:55', '2025-12-30 08:55:27', NULL, '244259', '2025-12-29 19:12:57', '2025-12-29 19:07:57'),
(9, 'rizkipangestu852922', NULL, '107038979417885165985', 'rizkipangestu852@gmail.com', NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocIkAayErSyW-VC4JnamCCuT59FYqhshhXg37RgNl0Y6rjQRcWo=s96-c', 'google', NULL, NULL, NULL, 'owner', 'aktif', '2025-12-21 22:50:54', '2025-12-22 23:02:58', NULL, NULL, NULL, NULL),
(10, 'karyawan_rizky', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2025-12-22 06:06:35', NULL, NULL, NULL, NULL, NULL),
(11, 'karyawan_ayu', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2025-12-22 06:06:35', NULL, NULL, NULL, NULL, NULL),
(12, 'karyawan_bayu', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2025-12-22 06:06:35', NULL, NULL, NULL, NULL, NULL),
(13, 'karyawan_dina', '$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'karyawan', 'aktif', '2025-12-22 06:06:35', NULL, NULL, NULL, NULL, NULL),
(14, 'rayan496', '$2y$10$t6jYb9tgdrvb8Gc6Pk0.4eb5Tt8fng77CSnjx2QahF67gbM1.Fh7O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2025-12-22 03:05:46', '2025-12-29 09:57:21', NULL, NULL, NULL, NULL),
(15, 'riskypangestu057228', NULL, '113652892611796351362', 'riskypangestu057@students.amikom.ac.id', NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocI_XbhjTJ-lE_VUNA2FqBySHyeCukLOVbQ4Bg8qYvK4p0jZOQ=s96-c', 'google', NULL, NULL, NULL, 'owner', 'aktif', '2025-12-22 03:06:31', '2025-12-30 07:23:28', NULL, NULL, NULL, NULL),
(16, 'rizkipangestu998', '$2y$10$ijR2yQifRzyW7Tz2OvDjneZIeRBUe5Tk.iIu7TFQVynpkE.bVw3Da', '103668789038059031082', 'riskypangestu057@gmail.com', 'Rizki Pangestu', 'https://lh3.googleusercontent.com/a/ACg8ocLZbesGECP1f2QUqZsLEGmRHk523tsiPX0D4SZ_ZAJ13YnkR43V=s96-c', NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2025-12-29 08:04:45', '2025-12-30 07:23:29', NULL, NULL, NULL, NULL),
(17, 'rizkipangestu720', '$2y$10$2FoEVZpyTV8EMLHa6aNIReMKqAmnR/EplftKI/1qbzkt9J43pBgGO', '104815621157629355183', 'rizkipangestu291@gmail.com', 'Rizki Pangestu', 'https://lh3.googleusercontent.com/a/ACg8ocJV4ytlHnxz4dY-5dlHuKdrA43eN8GbDpErD2e4Y7lvAGly-6E=s96-c', NULL, NULL, NULL, NULL, NULL, 'owner', 'aktif', '2025-12-30 09:59:07', NULL, NULL, NULL, NULL, NULL);

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
(12, 8, '215617', '081279393094', 'admin_login', 1, '2025-12-30 16:45:28', '2025-12-30 16:40:28', '2025-12-30 16:40:57');

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
,`jenis_item` enum('bahan','alat','perlengkapan')
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
,`jenis_item` enum('bahan','alat','perlengkapan')
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
,`jenis_item` enum('bahan','alat','perlengkapan')
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
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

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
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id_reset`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `idx_token` (`token`),
  ADD KEY `idx_user` (`id_user`),
  ADD KEY `idx_expires` (`expires_at`);

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
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id_pemilik`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_paket` (`id_paket`);

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
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `feedback_pelanggan`
--
ALTER TABLE `feedback_pelanggan`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `helpdesk_messages`
--
ALTER TABLE `helpdesk_messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `helpdesk_tickets`
--
ALTER TABLE `helpdesk_tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inventori`
--
ALTER TABLE `inventori`
  MODIFY `id_inventori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `konten`
--
ALTER TABLE `konten`
  MODIFY `id_konten` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id_reset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id_pemilik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `progres_pesanan`
--
ALTER TABLE `progres_pesanan`
  MODIFY `id_progres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `rekomendasi_ai`
--
ALTER TABLE `rekomendasi_ai`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `remember_tokens`
--
ALTER TABLE `remember_tokens`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi_inventori`
--
ALTER TABLE `transaksi_inventori`
  MODIFY `id_transaksi_inventori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_langganan`
--
ALTER TABLE `transaksi_langganan`
  MODIFY `id_transaksi_langganan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
