-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: kixera_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_log`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (1,18,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-16 18:02:34'),(2,2,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-16 18:12:12'),(3,2,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-16 18:13:45'),(4,3,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-16 18:15:12'),(5,3,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-16 18:24:26'),(6,3,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-16 18:24:31'),(7,3,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-16 18:36:21'),(8,2,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-16 18:36:27'),(9,2,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-16 18:52:56'),(10,2,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-16 18:53:01'),(11,8,'Register','User mendaftar akun baru','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 05:38:55'),(12,8,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 05:39:02'),(13,9,'Register','User mendaftar via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 05:50:54'),(14,9,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 07:08:24'),(15,8,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 07:09:33'),(16,8,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 07:11:02'),(17,9,'Login','User login via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 07:11:07'),(18,9,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 09:58:59'),(19,8,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 09:59:09'),(20,14,'Register','User mendaftar akun baru','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:05:46'),(21,14,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:05:49'),(22,14,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:05:59'),(23,14,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:06:01'),(24,15,'Register','User mendaftar via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:06:31'),(25,15,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:06:35'),(26,15,'Login','User login via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:07:38'),(27,15,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:07:42'),(28,14,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:08:03'),(29,14,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:09:31'),(30,8,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:09:38'),(31,9,'Login','User login via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:09:47'),(32,9,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:15:59'),(33,0,'Forgot Password','Password reset requested for: hattapramana@gmail.com','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:16:12'),(34,9,'Login','User login via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:16:34'),(35,15,'Login','User login via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:21:24'),(36,15,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:21:38'),(37,15,'Login','User login via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:22:34'),(38,15,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:36:32'),(39,15,'Login','User login via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 10:36:43'),(40,9,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 11:09:40'),(41,9,'Login','User login via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 11:09:47'),(42,9,'Login','User login via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 13:20:50'),(43,9,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 16:13:01'),(44,8,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 16:13:23'),(45,8,'Logout','User logout dari sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 16:47:44'),(46,9,'Login','User login via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 16:58:21'),(47,8,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-22 18:17:40'),(48,8,'Login','User login ke sistem','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-23 04:21:18'),(49,9,'Login','User login via Google OAuth','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','2025-12-23 04:27:45');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `email` (`email`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,1,'Super Admin','admin@kixera.com','081234567890',NULL,'2025-12-16 17:00:21','2025-12-22 18:07:52','2025-12-22 12:07:52');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_data`
--

DROP TABLE IF EXISTS `backup_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup_data` (
  `id_backup` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik` int(11) DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `ukuran_file` bigint(20) DEFAULT NULL,
  `path_file` varchar(255) NOT NULL,
  `jenis_backup` enum('otomatis','manual') NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `tgl_backup` datetime NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_backup`),
  KEY `id_pemilik` (`id_pemilik`),
  KEY `id_admin` (`id_admin`),
  CONSTRAINT `backup_data_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE,
  CONSTRAINT `backup_data_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_data`
--

LOCK TABLES `backup_data` WRITE;
/*!40000 ALTER TABLE `backup_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bukti_transaksi`
--

DROP TABLE IF EXISTS `bukti_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bukti_transaksi` (
  `id_bukti` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemasukan` int(11) DEFAULT NULL,
  `id_pengeluaran` int(11) DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `ukuran_file` bigint(20) DEFAULT NULL,
  `tipe_file` varchar(50) DEFAULT NULL,
  `tgl_upload` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_bukti`),
  UNIQUE KEY `id_pemasukan` (`id_pemasukan`),
  UNIQUE KEY `id_pengeluaran` (`id_pengeluaran`),
  CONSTRAINT `bukti_transaksi_ibfk_1` FOREIGN KEY (`id_pemasukan`) REFERENCES `pemasukan` (`id_pemasukan`) ON DELETE CASCADE,
  CONSTRAINT `bukti_transaksi_ibfk_2` FOREIGN KEY (`id_pengeluaran`) REFERENCES `pengeluaran` (`id_pengeluaran`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bukti_transaksi`
--

LOCK TABLES `bukti_transaksi` WRITE;
/*!40000 ALTER TABLE `bukti_transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `bukti_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cabang`
--

DROP TABLE IF EXISTS `cabang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cabang` (
  `id_cabang` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik` int(11) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `alamat_cabang` text DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cabang`),
  KEY `id_pemilik` (`id_pemilik`),
  CONSTRAINT `cabang_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cabang`
--

LOCK TABLES `cabang` WRITE;
/*!40000 ALTER TABLE `cabang` DISABLE KEYS */;
INSERT INTO `cabang` VALUES (1,1,'Clean Shoes - Seturan','Jl. Seturan Raya No. 15','Jl. Seturan Raya No. 15','0274123456','aktif','2025-12-16 17:00:21',NULL,NULL),(2,1,'Clean Shoes - Condongcatur','Jl. Anggajaya No. 20','Jl. Anggajaya No. 20','0274123457','aktif','2025-12-16 17:00:21',NULL,NULL),(3,2,'Sepatu Resik - Kota Gede','Jl. Kemasan No. 5, Kotagede','Jl. Kemasan No. 5, Kotagede','0274123458','aktif','2025-12-16 17:00:21',NULL,NULL),(4,2,'Sepatu Resik - Malioboro','Jl. Malioboro No. 10','Jl. Malioboro No. 10','0274123459','aktif','2025-12-16 17:00:21',NULL,NULL),(5,2,'Sepatu Resik - Gejayan','Jl. Gejayan No. 25','Jl. Gejayan No. 25','0274123460','aktif','2025-12-16 17:00:21',NULL,NULL),(6,3,'Cabang Utama','',NULL,'','aktif','2025-12-21 22:38:55',NULL,NULL),(8,4,'Seturan','Jl. Seturan Raya No. 88, Caturtunggal, Depok, Sleman','Jl. Seturan Raya No. 88, Caturtunggal, Depok, Sleman','0274567890','aktif','2025-12-22 06:06:35','2025-12-22 10:12:40',NULL),(9,4,'Bantul','Jl. Parangtritis Km 5.5, Sewon, Bantul','Jl. Parangtritis Km 5.5, Sewon, Bantul','0274567891','aktif','2025-12-22 06:06:35','2025-12-22 10:12:31',NULL),(10,5,'Cabang Utama','',NULL,'','aktif','2025-12-22 03:05:46',NULL,NULL),(11,6,'Cabang Utama','',NULL,'','aktif','2025-12-22 03:06:31',NULL,NULL);
/*!40000 ALTER TABLE `cabang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chatbot_log`
--

DROP TABLE IF EXISTS `chatbot_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chatbot_log` (
  `id_chat` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL,
  `tgl_chat` datetime NOT NULL,
  `is_handled_by_ai` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_chat`),
  KEY `id_pemilik` (`id_pemilik`),
  KEY `id_karyawan` (`id_karyawan`),
  KEY `id_pelanggan` (`id_pelanggan`),
  CONSTRAINT `chatbot_log_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE,
  CONSTRAINT `chatbot_log_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE,
  CONSTRAINT `chatbot_log_ibfk_3` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chatbot_log`
--

LOCK TABLES `chatbot_log` WRITE;
/*!40000 ALTER TABLE `chatbot_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `chatbot_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_service`
--

DROP TABLE IF EXISTS `customer_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_service` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ticket`),
  KEY `id_pemilik` (`id_pemilik`),
  KEY `id_karyawan` (`id_karyawan`),
  KEY `id_admin` (`id_admin`),
  CONSTRAINT `customer_service_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE,
  CONSTRAINT `customer_service_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE,
  CONSTRAINT `customer_service_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_service`
--

LOCK TABLES `customer_service` WRITE;
/*!40000 ALTER TABLE `customer_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_pesanan`
--

DROP TABLE IF EXISTS `detail_pesanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_pesanan` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesanan` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `jenis_sepatu` varchar(255) DEFAULT NULL,
  `warna` varchar(100) DEFAULT NULL,
  `kondisi_awal` text DEFAULT NULL,
  `catatan_khusus` text DEFAULT NULL,
  `foto_sebelum` varchar(255) DEFAULT NULL,
  `foto_sesudah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_pesanan` (`id_pesanan`),
  KEY `id_layanan` (`id_layanan`),
  CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_pesanan`
--

LOCK TABLES `detail_pesanan` WRITE;
/*!40000 ALTER TABLE `detail_pesanan` DISABLE KEYS */;
INSERT INTO `detail_pesanan` VALUES (1,1,2,'Nike Air Max 90','Putih','Kotor, noda tanah','Hati-hati bagian mesh',NULL,NULL,'2025-12-16 17:00:21',NULL),(2,1,2,'Nike Air Max 90','Putih','Kotor, noda tanah','Pasangan sepatu pertama',NULL,NULL,'2025-12-16 17:00:21',NULL),(3,2,3,'Adidas Superstar','Putih/Hitam','Sol menguning','Focus pada sol',NULL,NULL,'2025-12-16 17:00:21',NULL),(4,3,1,'Vans Old Skool','Hitam','Berdebu',NULL,NULL,NULL,'2025-12-16 17:00:21',NULL),(5,4,4,'Converse Chuck Taylor','Merah','Noda lumpur','Noda sudah lama',NULL,NULL,'2025-12-16 17:00:21',NULL),(6,5,5,'New Balance 574','Abu-abu','Jahitan lepas','Jahitan depan kanan',NULL,NULL,'2025-12-16 17:00:21',NULL),(7,6,7,'Sneakers Generic','Berbagai','Kotor biasa','3 pasang sepatu keluarga',NULL,NULL,'2025-12-16 17:00:21',NULL),(8,7,8,'Nike Jordan 1','Putih/Merah','Warna pudar','Repaint sesuai original',NULL,NULL,'2025-12-16 17:00:21',NULL),(9,8,6,'Puma RS-X','Biru/Putih','Kotor','Express order',NULL,NULL,'2025-12-16 17:00:21',NULL),(10,9,10,'Adidas NMD','Hitam/Putih','Kotor, sol kuning, warna pudar','Full restoration',NULL,NULL,'2025-12-16 17:00:21',NULL),(11,10,9,'Nike Air Force 1','Putih','Sol sangat kuning','Perlu unyellowing ekstra',NULL,NULL,'2025-12-16 17:00:21',NULL),(12,11,11,'Nike Air Force 1','Putih','Kotor debu',NULL,NULL,NULL,'2025-12-22 06:06:36',NULL),(13,12,13,'Adidas Ultraboost','Hitam/Putih','Kotor + sol kuning','Sepatu lari 2 pasang',NULL,NULL,'2025-12-22 06:06:36',NULL),(14,13,12,'Vans Old Skool','Hitam','Noda membandel',NULL,NULL,NULL,'2025-12-22 06:06:36',NULL),(15,14,15,'New Balance 574','Abu-abu','Sol sangat kuning','Fokus pada sol',NULL,NULL,'2025-12-22 06:06:36',NULL),(16,15,14,'Puma Suede','Biru','Kotor ringan','Butuh cepat',NULL,NULL,'2025-12-22 06:06:36',NULL),(17,16,17,'Clarks Desert Boot','Coklat','Kulit kering','Sepatu kulit formal',NULL,NULL,'2025-12-22 06:06:36',NULL),(18,17,11,'Skechers D\'Lites','Putih/Pink','Berdebu','2 pasang sneakers',NULL,NULL,'2025-12-22 06:06:36',NULL),(19,18,16,'Air Jordan 1','Merah/Hitam','Warna pudar','Repaint bred colorway',NULL,NULL,'2025-12-22 06:06:36',NULL),(20,19,13,'New Balance 990','Abu-abu','Kotor berat','Premium treatment',NULL,NULL,'2025-12-22 06:06:36',NULL),(21,20,12,'Puma RS-X','Multicolor','Noda lumpur','Deep cleaning needed',NULL,NULL,'2025-12-22 06:06:36',NULL),(22,21,11,'Converse Chuck Taylor','Hitam','Kotor biasa',NULL,NULL,NULL,'2025-12-22 06:06:36',NULL),(23,22,14,'Adidas Superstar','Putih/Hitam','Kotor ringan','Express',NULL,NULL,'2025-12-22 06:06:36',NULL),(24,23,18,'Vintage Sneakers','Multi','Rusak berat','Full restoration',NULL,NULL,'2025-12-22 06:06:36',NULL),(25,24,13,'Reebok Classic','Putih','Sol kuning','Premium care',NULL,NULL,'2025-12-22 06:06:36',NULL),(26,25,12,'Nike Air Max 90','Putih/Biru','Kotor sedang','2 pasang',NULL,NULL,'2025-12-22 06:06:36',NULL),(27,26,15,'Yeezy 350','Cream White','Sol kuning parah','Unyellowing fokus sol',NULL,NULL,'2025-12-22 06:06:36',NULL),(28,27,17,'Timberland Boots','Coklat','Kulit kering cracking','Leather care urgent',NULL,NULL,'2025-12-22 06:06:36',NULL),(29,28,11,'Nike Pegasus','Hitam/Putih','Debu ringan','Running shoes',NULL,NULL,'2025-12-22 06:06:36',NULL),(30,29,14,'Adidas NMD','Hitam','Kotor ringan','Express needed',NULL,NULL,'2025-12-22 06:06:36',NULL),(31,30,13,'Air Jordan 4','Bred','Kotor + sol kuning','Premium Jordan',NULL,NULL,'2025-12-22 06:06:36',NULL);
/*!40000 ALTER TABLE `detail_pesanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback_pelanggan`
--

DROP TABLE IF EXISTS `feedback_pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback_pelanggan` (
  `id_feedback` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tgl_feedback` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_feedback`),
  UNIQUE KEY `id_pesanan` (`id_pesanan`),
  UNIQUE KEY `id_pelanggan` (`id_pelanggan`),
  CONSTRAINT `feedback_pelanggan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  CONSTRAINT `feedback_pelanggan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback_pelanggan`
--

LOCK TABLES `feedback_pelanggan` WRITE;
/*!40000 ALTER TABLE `feedback_pelanggan` DISABLE KEYS */;
INSERT INTO `feedback_pelanggan` VALUES (1,3,3,5,'Hasil cuci sangat bersih, cepat selesainya!','2024-12-17 16:00:00','2025-12-16 17:00:21',NULL),(2,5,5,4,'Jahitan sudah rapi, tapi agak lama prosesnya','2024-12-20 17:00:00','2025-12-16 17:00:21',NULL),(3,9,9,5,'Sepatu seperti baru lagi! Sangat puas dengan full treatment','2024-12-22 16:00:00','2025-12-16 17:00:21',NULL);
/*!40000 ALTER TABLE `feedback_pelanggan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventori`
--

DROP TABLE IF EXISTS `inventori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventori` (
  `id_inventori` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_inventori`),
  KEY `id_cabang` (`id_cabang`),
  KEY `idx_inventori_stok` (`stok_tersedia`),
  CONSTRAINT `inventori_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventori`
--

LOCK TABLES `inventori` WRITE;
/*!40000 ALTER TABLE `inventori` DISABLE KEYS */;
INSERT INTO `inventori` VALUES (1,1,'Sabun Cuci Sepatu','bahan','botol',5,20,25000.00,'Sabun khusus sneakers','2025-12-16 17:00:21',NULL,NULL),(2,1,'Sikat Bulu Lembut','alat','pcs',3,10,15000.00,'Untuk bahan sensitif','2025-12-16 17:00:21',NULL,NULL),(3,1,'Sikat Bulu Keras','alat','pcs',3,8,12000.00,'Untuk sol dan rubber','2025-12-16 17:00:21',NULL,NULL),(4,1,'Whitening Solution','bahan','botol',5,15,35000.00,'Cairan whitening sol','2025-12-16 17:00:21',NULL,NULL),(5,1,'Microfiber Cloth','perlengkapan','pcs',10,50,5000.00,'Kain lap microfiber','2025-12-16 17:00:21',NULL,NULL),(6,2,'Sabun Cuci Sepatu','bahan','botol',5,18,25000.00,'Sabun khusus sneakers','2025-12-16 17:00:21',NULL,NULL),(7,2,'Sikat Premium','alat','pcs',3,6,20000.00,'Sikat kualitas tinggi','2025-12-16 17:00:21',NULL,NULL),(8,2,'Deodorizer Spray','bahan','botol',5,12,30000.00,'Penghilang bau','2025-12-16 17:00:21',NULL,NULL),(9,3,'Sabun Cuci Sepatu','bahan','botol',5,25,25000.00,'Sabun khusus sneakers','2025-12-16 17:00:21',NULL,NULL),(10,3,'Cat Sepatu Hitam','bahan','botol',3,8,45000.00,'Cat repaint hitam','2025-12-16 17:00:21',NULL,NULL),(11,3,'Cat Sepatu Putih','bahan','botol',3,10,45000.00,'Cat repaint putih','2025-12-16 17:00:21',NULL,NULL),(12,4,'Sabun Cuci Express','bahan','botol',5,30,30000.00,'Sabun fast-dry','2025-12-16 17:00:21',NULL,NULL),(13,4,'Dryer Machine Pad','perlengkapan','pcs',5,20,8000.00,'Pad mesin pengering','2025-12-16 17:00:21',NULL,NULL),(14,5,'Unyellowing Cream','bahan','tube',5,12,50000.00,'Krim penghilang kuning','2025-12-16 17:00:21',NULL,NULL),(15,5,'UV Light Bulb','alat','pcs',2,4,75000.00,'Lampu UV untuk proses','2025-12-16 17:00:21',NULL,NULL),(16,8,'Sabun Premium Sneakers','bahan','botol',10,35,35000.00,'Sabun khusus sneakers premium','2025-12-22 06:06:36',NULL,NULL),(17,8,'Sikat Bulu Halus','alat','pcs',5,15,18000.00,'Untuk material sensitif','2025-12-22 06:06:36',NULL,NULL),(18,8,'Sikat Sol Keras','alat','pcs',5,12,15000.00,'Untuk sol dan rubber','2025-12-22 06:06:36',NULL,NULL),(19,8,'Whitening Cream Pro','bahan','tube',8,20,45000.00,'Pemutih sol profesional','2025-12-22 06:06:36',NULL,NULL),(20,8,'Microfiber Premium','perlengkapan','pcs',15,60,8000.00,'Lap microfiber kualitas tinggi','2025-12-22 06:06:36',NULL,NULL),(21,8,'Leather Conditioner','bahan','botol',5,12,55000.00,'Perawatan kulit premium','2025-12-22 06:06:36',NULL,NULL),(22,8,'Repaint Base Black','bahan','botol',3,8,65000.00,'Cat dasar hitam','2025-12-22 06:06:36',NULL,NULL),(23,8,'Repaint Base White','bahan','botol',3,10,65000.00,'Cat dasar putih','2025-12-22 06:06:36',NULL,NULL),(24,8,'Unyellowing Solution','bahan','botol',5,15,50000.00,'Cairan anti kuning','2025-12-22 06:06:36',NULL,NULL),(25,8,'Shoe Deodorizer','bahan','botol',8,25,25000.00,'Penghilang bau sepatu','2025-12-22 06:06:36',NULL,NULL),(26,9,'Sabun Premium Sneakers','bahan','botol',10,30,35000.00,'Sabun khusus sneakers premium','2025-12-22 06:06:36',NULL,NULL),(27,9,'Sikat Bulu Halus','alat','pcs',5,12,18000.00,'Untuk material sensitif','2025-12-22 06:06:36',NULL,NULL),(28,9,'Sikat Sol Keras','alat','pcs',5,10,15000.00,'Untuk sol dan rubber','2025-12-22 06:06:36',NULL,NULL),(29,9,'Whitening Cream Pro','bahan','tube',8,18,45000.00,'Pemutih sol profesional','2025-12-22 06:06:36',NULL,NULL),(30,9,'Microfiber Premium','perlengkapan','pcs',15,55,8000.00,'Lap microfiber kualitas tinggi','2025-12-22 06:06:36',NULL,NULL),(31,9,'Leather Conditioner','bahan','botol',5,10,55000.00,'Perawatan kulit premium','2025-12-22 06:06:36',NULL,NULL),(32,9,'Repaint Base Black','bahan','botol',3,6,65000.00,'Cat dasar hitam','2025-12-22 06:06:36',NULL,NULL),(33,9,'Repaint Base White','bahan','botol',3,8,65000.00,'Cat dasar putih','2025-12-22 06:06:36',NULL,NULL),(34,9,'Unyellowing Solution','bahan','botol',5,12,50000.00,'Cairan anti kuning','2025-12-22 06:06:36',NULL,NULL),(35,9,'Shoe Deodorizer','bahan','botol',8,20,25000.00,'Penghilang bau sepatu','2025-12-22 06:06:36',NULL,NULL);
/*!40000 ALTER TABLE `inventori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id_karyawan`),
  UNIQUE KEY `id_user` (`id_user`),
  KEY `id_cabang` (`id_cabang`),
  CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `karyawan`
--

LOCK TABLES `karyawan` WRITE;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` VALUES (1,4,1,'Andi Prasetyo','andi@cleanshoes.com','081345678901',NULL,'Staff Cuci','Jl. Kaliurang Km 7','2024-01-15','2025-12-16 17:00:21',NULL,NULL),(2,5,1,'Dewi Lestari','dewi@cleanshoes.com','081345678902',NULL,'Kasir','Jl. Seturan No. 10','2024-02-01','2025-12-16 17:00:21',NULL,NULL),(3,6,2,'Rudi Hermawan','rudi@cleanshoes.com','081345678903',NULL,'Staff Cuci','Jl. Condongcatur No. 5','2024-03-10','2025-12-16 17:00:21',NULL,NULL),(4,7,3,'Nina Safitri','nina@sepaturesik.com','081345678904',NULL,'Staff Cuci','Jl. Kotagede No. 8','2024-01-20','2025-12-16 17:00:21',NULL,NULL),(5,10,8,'Rizky Pratama','rizky@aethertech.com','081234567801',NULL,'Staff Cuci','Jl. Kaliurang Km 8, Sleman','2025-01-10','2025-12-22 06:06:35',NULL,NULL),(6,11,8,'Ayu Lestari','ayu@aethertech.com','081234567802',NULL,'Kasir','Jl. Seturan No. 25, Sleman','2025-01-15','2025-12-22 06:06:35',NULL,NULL),(7,12,9,'Bayu Saputra','bayu@aethertech.com','081234567803',NULL,'Staff Cuci','Jl. Bantul No. 12, Bantul','2025-02-01','2025-12-22 06:06:35',NULL,NULL),(8,13,9,'Dina Puspita','dina@aethertech.com','081234567804',NULL,'Kasir','Jl. Parangtritis Km 6, Bantul','2025-02-05','2025-12-22 06:06:35',NULL,NULL);
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `konten`
--

DROP TABLE IF EXISTS `konten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `konten` (
  `id_konten` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_konten`),
  KEY `id_admin` (`id_admin`),
  CONSTRAINT `konten_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `konten`
--

LOCK TABLES `konten` WRITE;
/*!40000 ALTER TABLE `konten` DISABLE KEYS */;
/*!40000 ALTER TABLE `konten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `layanan`
--

DROP TABLE IF EXISTS `layanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik` int(11) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `estimasi_waktu` int(11) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_layanan`),
  KEY `id_pemilik` (`id_pemilik`),
  CONSTRAINT `layanan_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `layanan`
--

LOCK TABLES `layanan` WRITE;
/*!40000 ALTER TABLE `layanan` DISABLE KEYS */;
INSERT INTO `layanan` VALUES (1,1,'Cuci Reguler','Cuci standar untuk sepatu sneakers',25000.00,2,'aktif','2025-12-16 17:00:21',NULL,NULL),(2,1,'Cuci Premium','Cuci mendalam dengan perawatan khusus',35000.00,3,'aktif','2025-12-16 17:00:21',NULL,NULL),(3,1,'Whitening','Pemutihan sol dan bagian putih',45000.00,4,'aktif','2025-12-16 17:00:21',NULL,NULL),(4,1,'Deep Clean','Cuci ekstra dengan penghilang noda membandel',55000.00,5,'aktif','2025-12-16 17:00:21',NULL,NULL),(5,1,'Repair','Perbaikan jahitan dan lem',75000.00,7,'aktif','2025-12-16 17:00:21',NULL,NULL),(6,2,'Cuci Express','Cuci cepat dalam 1 hari',40000.00,1,'aktif','2025-12-16 17:00:21',NULL,NULL),(7,2,'Cuci Standar','Cuci biasa dengan hasil maksimal',30000.00,3,'aktif','2025-12-16 17:00:21',NULL,NULL),(8,2,'Repaint','Pengecatan ulang sepatu',100000.00,7,'aktif','2025-12-16 17:00:21',NULL,NULL),(9,2,'Unyellowing','Menghilangkan warna kuning pada sol',60000.00,4,'aktif','2025-12-16 17:00:21',NULL,NULL),(10,2,'Full Treatment','Paket lengkap cuci, whitening, dan repaint',150000.00,10,'aktif','2025-12-16 17:00:21',NULL,NULL),(11,4,'Basic Cleaning','Cuci sepatu standar untuk sepatu sehari-hari',30000.00,2,'aktif','2025-12-22 06:06:35',NULL,NULL),(12,4,'Deep Cleaning','Cuci mendalam dengan treatment khusus',50000.00,3,'aktif','2025-12-22 06:06:35',NULL,NULL),(13,4,'Premium Care','Cuci premium + whitening + protection',75000.00,4,'aktif','2025-12-22 06:06:35',NULL,NULL),(14,4,'Fast Clean','Cuci express selesai 1 hari',45000.00,1,'aktif','2025-12-22 06:06:35',NULL,NULL),(15,4,'Unyellowing Service','Hilangkan kuning pada sol sepatu',65000.00,3,'aktif','2025-12-22 06:06:35',NULL,NULL),(16,4,'Repaint Pro','Pengecatan ulang profesional',120000.00,7,'aktif','2025-12-22 06:06:35',NULL,NULL),(17,4,'Leather Treatment','Perawatan khusus sepatu kulit',85000.00,5,'aktif','2025-12-22 06:06:35',NULL,NULL),(18,4,'Complete Restoration','Paket lengkap cuci + repair + repaint',180000.00,10,'aktif','2025-12-22 06:06:35',NULL,NULL);
/*!40000 ALTER TABLE `layanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_aktivitas`
--

DROP TABLE IF EXISTS `log_aktivitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_aktivitas` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `tgl_aktivitas` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_log`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_aktivitas`
--

LOCK TABLES `log_aktivitas` WRITE;
/*!40000 ALTER TABLE `log_aktivitas` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_aktivitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nota`
--

DROP TABLE IF EXISTS `nota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesanan` int(11) NOT NULL,
  `no_nota` varchar(255) NOT NULL,
  `tgl_cetak` datetime NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `total_bayar` decimal(10,2) NOT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_nota`),
  UNIQUE KEY `id_pesanan` (`id_pesanan`),
  UNIQUE KEY `no_nota` (`no_nota`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota`
--

LOCK TABLES `nota` WRITE;
/*!40000 ALTER TABLE `nota` DISABLE KEYS */;
INSERT INTO `nota` VALUES (1,3,'NOTA-20241217-001','2024-12-17 15:30:00',1,25000.00,'cash','2025-12-16 17:00:21',NULL),(2,5,'NOTA-20241220-001','2024-12-20 16:00:00',3,75000.00,'transfer','2025-12-16 17:00:21',NULL),(3,9,'NOTA-20241222-001','2024-12-22 15:30:00',NULL,150000.00,'qris','2025-12-16 17:00:21',NULL);
/*!40000 ALTER TABLE `nota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `type` enum('order','payment','pickup','general') DEFAULT 'general',
  `related_id` int(11) DEFAULT NULL COMMENT 'ID pesanan/transaksi terkait',
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_notification`),
  KEY `idx_pemilik_read` (`id_pemilik`,`is_read`),
  KEY `idx_created` (`created_at`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,1,'Selamat datang di KixEra!','Sistem notifikasi telah aktif. Anda akan menerima notifikasi untuk setiap aktivitas penting.','general',NULL,0,'2025-12-22 16:59:40',NULL),(2,2,'Selamat datang di KixEra!','Sistem notifikasi telah aktif. Anda akan menerima notifikasi untuk setiap aktivitas penting.','general',NULL,0,'2025-12-22 16:59:40',NULL),(3,3,'Selamat datang di KixEra!','Sistem notifikasi telah aktif. Anda akan menerima notifikasi untuk setiap aktivitas penting.','general',NULL,0,'2025-12-22 16:59:40',NULL),(4,4,'Selamat datang di KixEra!','Sistem notifikasi telah aktif. Anda akan menerima notifikasi untuk setiap aktivitas penting.','general',NULL,0,'2025-12-22 16:59:40',NULL),(5,5,'Selamat datang di KixEra!','Sistem notifikasi telah aktif. Anda akan menerima notifikasi untuk setiap aktivitas penting.','general',NULL,0,'2025-12-22 16:59:40',NULL);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_sessions`
--

DROP TABLE IF EXISTS `oauth_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_sessions` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `provider` varchar(50) NOT NULL COMMENT 'google, facebook, dll',
  `provider_user_id` varchar(255) NOT NULL COMMENT 'ID dari provider (google_id, facebook_id, dll)',
  `access_token` text DEFAULT NULL,
  `refresh_token` text DEFAULT NULL,
  `token_expires_at` datetime DEFAULT NULL,
  `scope` text DEFAULT NULL COMMENT 'OAuth scopes yang diberikan',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_session`),
  KEY `idx_user` (`id_user`),
  KEY `idx_provider` (`provider`),
  KEY `idx_provider_user_id` (`provider_user_id`),
  KEY `idx_last_used` (`last_used_at`),
  CONSTRAINT `oauth_sessions_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabel untuk tracking OAuth sessions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_sessions`
--

LOCK TABLES `oauth_sessions` WRITE;
/*!40000 ALTER TABLE `oauth_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_state_tokens`
--

DROP TABLE IF EXISTS `oauth_state_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_state_tokens` (
  `id_state` int(11) NOT NULL AUTO_INCREMENT,
  `state_token` varchar(64) NOT NULL,
  `redirect_uri` varchar(500) DEFAULT NULL,
  `is_used` tinyint(1) DEFAULT 0,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_state`),
  UNIQUE KEY `state_token` (`state_token`),
  KEY `idx_state_token` (`state_token`),
  KEY `idx_expires` (`expires_at`),
  KEY `idx_is_used` (`is_used`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabel untuk CSRF protection OAuth state tokens';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_state_tokens`
--

LOCK TABLES `oauth_state_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_state_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_state_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paket_langganan`
--

DROP TABLE IF EXISTS `paket_langganan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paket_langganan` (
  `id_paket` int(11) NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `durasi_hari` int(11) NOT NULL,
  `fitur_aktif` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fitur_aktif`)),
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paket_langganan`
--

LOCK TABLES `paket_langganan` WRITE;
/*!40000 ALTER TABLE `paket_langganan` DISABLE KEYS */;
INSERT INTO `paket_langganan` VALUES (1,'Basic','Paket dasar untuk usaha kecil',99000.00,30,'{\"cabang\": 1, \"karyawan\": 2}','aktif','2025-12-16 17:00:21',NULL,NULL),(2,'Professional','Paket untuk usaha menengah',199000.00,30,'{\"cabang\": 3, \"karyawan\": 10}','aktif','2025-12-16 17:00:21',NULL,NULL),(3,'Enterprise','Paket untuk usaha besar',399000.00,30,'{\"cabang\": -1, \"karyawan\": -1}','aktif','2025-12-16 17:00:21',NULL,NULL);
/*!40000 ALTER TABLE `paket_langganan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `id_reset` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_used` tinyint(1) DEFAULT 0,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `used_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_reset`),
  UNIQUE KEY `token` (`token`),
  KEY `idx_token` (`token`),
  KEY `idx_user` (`id_user`),
  KEY `idx_expires` (`expires_at`),
  CONSTRAINT `password_reset_tokens_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES (1,8,'484246b0f951130fe4787eb8f4ff918a2039ff028f348988774e6773bfcdff57','hattapramana@gmail.com',0,'2025-12-22 11:16:12','2025-12-22 10:16:12',NULL);
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`),
  KEY `idx_pelanggan_no_telp` (`no_telp`),
  KEY `idx_pelanggan_cabang` (`id_cabang`),
  CONSTRAINT `fk_pelanggan_cabang` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelanggan`
--

LOCK TABLES `pelanggan` WRITE;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` VALUES (1,NULL,'Ahmad Rizki','081567890123','ahmad@gmail.com','Jl. Magelang No. 15','2025-12-16 17:00:21',NULL,NULL),(2,NULL,'Putri Handayani','081567890124','putri@gmail.com','Jl. Solo No. 20','2025-12-16 17:00:21',NULL,NULL),(3,NULL,'Dimas Pratama','081567890125','dimas@gmail.com','Jl. Godean No. 8','2025-12-16 17:00:21',NULL,NULL),(4,NULL,'Rina Wati','081567890126','rina@gmail.com','Jl. Bantul No. 30','2025-12-16 17:00:21',NULL,NULL),(5,NULL,'Yoga Setiawan','081567890127','yoga@gmail.com','Jl. Wates No. 12','2025-12-16 17:00:21',NULL,NULL),(6,NULL,'Lisa Permata','081567890128','lisa@gmail.com','Jl. Kaliurang Km 10','2025-12-16 17:00:21',NULL,NULL),(7,NULL,'Bagus Wicaksono','081567890129','bagus@gmail.com','Jl. Seturan No. 5','2025-12-16 17:00:21',NULL,NULL),(8,NULL,'Maya Sari','081567890130','maya@gmail.com','Jl. Condongcatur No. 15','2025-12-16 17:00:21',NULL,NULL),(9,NULL,'Fajar Nugroho','081567890131','fajar@gmail.com','Jl. Gejayan No. 7','2025-12-16 17:00:21',NULL,NULL),(10,NULL,'Indah Permatasari','081567890132','indah@gmail.com','Jl. Kotagede No. 22','2025-12-16 17:00:21',NULL,NULL),(11,8,'Agung Prasetyo','082134567801','agung.p@gmail.com','Jl. Babarsari No. 10, Sleman','2025-12-22 06:06:35',NULL,NULL),(12,8,'Bella Putri','082134567802','bella.putri@gmail.com','Jl. Affandi No. 5, Sleman','2025-12-22 06:06:35',NULL,NULL),(13,8,'Cahyo Wibowo','082134567803','cahyo.w@gmail.com','Jl. Colombo No. 15, Sleman','2025-12-22 06:06:35',NULL,NULL),(14,8,'Diana Sari','082134567804','diana.sari@gmail.com','Jl. Gejayan No. 30, Sleman','2025-12-22 06:06:35',NULL,NULL),(15,8,'Eko Susanto','082134567805','eko.susanto@gmail.com','Jl. Monjali No. 8, Sleman','2025-12-22 06:06:35',NULL,NULL),(16,9,'Fitri Handayani','082134567806','fitri.h@gmail.com','Jl. Bantul No. 20, Bantul','2025-12-22 06:06:35',NULL,NULL),(17,9,'Galih Nugroho','082134567807','galih.n@gmail.com','Jl. Parangtritis Km 7, Bantul','2025-12-22 06:06:35',NULL,NULL),(18,9,'Hana Wijaya','082134567808','hana.wijaya@gmail.com','Jl. Imogiri No. 12, Bantul','2025-12-22 06:06:35',NULL,NULL),(19,9,'Irfan Hakim','082134567809','irfan.hakim@gmail.com','Jl. Sewon No. 25, Bantul','2025-12-22 06:06:35',NULL,NULL),(20,9,'Julia Permata','082134567810','julia.p@gmail.com','Jl. Bantul Barat No. 5, Bantul','2025-12-22 06:06:35',NULL,NULL),(21,8,'Kevin Tanjung','082134567811','kevin.t@gmail.com','Jl. Kaliurang Km 12, Sleman','2025-12-22 06:06:35',NULL,NULL),(22,8,'Lina Margaretha','082134567812','lina.m@gmail.com','Jl. Palagan No. 18, Sleman','2025-12-22 06:06:35',NULL,NULL),(23,9,'Mario Kusuma','082134567813','mario.k@gmail.com','Jl. Piyungan No. 7, Bantul','2025-12-22 06:06:35',NULL,NULL),(24,9,'Nina Safira','082134567814','nina.safira@gmail.com','Jl. Kasihan No. 15, Bantul','2025-12-22 06:06:35',NULL,NULL),(25,8,'Oscar Rahmad','082134567815','oscar.r@gmail.com','Jl. Condongcatur No. 22, Sleman','2025-12-22 06:06:35',NULL,NULL);
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemasukan`
--

DROP TABLE IF EXISTS `pemasukan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pemasukan`),
  KEY `id_cabang` (`id_cabang`),
  KEY `id_pesanan` (`id_pesanan`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE,
  CONSTRAINT `pemasukan_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE SET NULL,
  CONSTRAINT `pemasukan_ibfk_3` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemasukan`
--

LOCK TABLES `pemasukan` WRITE;
/*!40000 ALTER TABLE `pemasukan` DISABLE KEYS */;
INSERT INTO `pemasukan` VALUES (1,1,'Pembayaran Pesanan #3','pesanan',25000.00,'2024-12-17',3,'Pembayaran pesanan KX-20241215-001',1,'2025-12-16 17:00:21',NULL,NULL),(2,2,'Pembayaran Pesanan #5','pesanan',75000.00,'2024-12-20',5,'Pembayaran pesanan KX-20241214-001',3,'2025-12-16 17:00:21',NULL,NULL),(3,4,'Pembayaran Pesanan #9','pesanan',150000.00,'2024-12-22',9,'Pembayaran pesanan KX-20241213-001',NULL,'2025-12-16 17:00:21',NULL,NULL),(4,8,'Pembayaran AT-20251201-001','pesanan',30000.00,'2025-12-01',11,'Basic Cleaning Nike Air Force',6,'2025-12-22 06:06:36',NULL,NULL),(5,8,'Pembayaran AT-20251202-001','pesanan',150000.00,'2025-12-02',12,'Premium Care 2 pasang',6,'2025-12-22 06:06:36',NULL,NULL),(6,8,'Pembayaran AT-20251205-001','pesanan',50000.00,'2025-12-05',13,'Deep Cleaning Vans',6,'2025-12-22 06:06:36',NULL,NULL),(7,8,'Pembayaran AT-20251208-001','pesanan',65000.00,'2025-12-08',14,'Unyellowing Service',6,'2025-12-22 06:06:36',NULL,NULL),(8,8,'Pembayaran AT-20251210-001','pesanan',45000.00,'2025-12-10',15,'Fast Clean',6,'2025-12-22 06:06:36',NULL,NULL),(9,8,'Pembayaran AT-20251212-001','pesanan',85000.00,'2025-12-12',16,'Leather Treatment',6,'2025-12-22 06:06:36',NULL,NULL),(10,8,'Pembayaran AT-20251215-001','pesanan',60000.00,'2025-12-15',17,'Basic Clean 2 pasang',6,'2025-12-22 06:06:36',NULL,NULL),(11,9,'Pembayaran AT-20251201-002','pesanan',30000.00,'2025-12-01',21,'Basic Cleaning Converse',8,'2025-12-22 06:06:36',NULL,NULL),(12,9,'Pembayaran AT-20251203-001','pesanan',45000.00,'2025-12-03',22,'Fast Clean Adidas',8,'2025-12-22 06:06:36',NULL,NULL),(13,9,'Pembayaran AT-20251205-002','pesanan',180000.00,'2025-12-05',23,'Complete Restoration',8,'2025-12-22 06:06:36',NULL,NULL),(14,9,'Pembayaran AT-20251207-001','pesanan',75000.00,'2025-12-07',24,'Premium Care Reebok',8,'2025-12-22 06:06:36',NULL,NULL),(15,9,'Pembayaran AT-20251210-002','pesanan',100000.00,'2025-12-10',25,'Deep Clean 2 pasang',8,'2025-12-22 06:06:36',NULL,NULL);
/*!40000 ALTER TABLE `pemasukan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemilik`
--

DROP TABLE IF EXISTS `pemilik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pemilik` (
  `id_pemilik` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pemilik`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `email` (`email`),
  KEY `id_paket` (`id_paket`),
  CONSTRAINT `pemilik_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `pemilik_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket_langganan` (`id_paket`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemilik`
--

LOCK TABLES `pemilik` WRITE;
/*!40000 ALTER TABLE `pemilik` DISABLE KEYS */;
INSERT INTO `pemilik` VALUES (1,2,'Budi Santoso','budi@cleanshoes.com','081234567891',NULL,'Clean Shoes Jogja','Jl. Kaliurang Km 5, Yogyakarta','aktif',2,'2025-12-16 17:00:21',NULL,NULL),(2,3,'Sari Dewi','sari@sepaturesik.com','081234567892',NULL,'Sepatu Resik','Jl. Malioboro No. 10, Yogyakarta','aktif',3,'2025-12-16 17:00:21',NULL,NULL),(3,8,'Hatta','hattapramana@gmail.com','081278421122',NULL,'Toko hatta',NULL,'trial',NULL,'2025-12-21 22:38:55',NULL,NULL),(4,9,'AetherTech','rizkipangestu852@gmail.com',NULL,'uploads/profile/profile_4_1766421273.jpg','AetherTech\'s Business',NULL,'trial',NULL,'2025-12-21 22:50:54','2025-12-22 10:34:33',NULL),(5,14,'rayan','rayan@gmail.com','0812732139123',NULL,'sancare',NULL,'trial',NULL,'2025-12-22 03:05:46',NULL,NULL),(6,15,'RIZKI PANGESTU 23.12.3029','riskypangestu057@students.amikom.ac.id',NULL,'https://lh3.googleusercontent.com/a/ACg8ocI_XbhjTJ-lE_VUNA2FqBySHyeCukLOVbQ4Bg8qYvK4p0jZOQ=s96-c','RIZKI PANGESTU 23.12.3029\'s Business',NULL,'trial',NULL,'2025-12-22 03:06:31',NULL,NULL);
/*!40000 ALTER TABLE `pemilik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengeluaran`
--

DROP TABLE IF EXISTS `pengeluaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(11) NOT NULL,
  `nama_transaksi` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengeluaran`),
  KEY `id_cabang` (`id_cabang`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE,
  CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengeluaran`
--

LOCK TABLES `pengeluaran` WRITE;
/*!40000 ALTER TABLE `pengeluaran` DISABLE KEYS */;
INSERT INTO `pengeluaran` VALUES (1,1,'Restock Sabun Cuci','bahan',250000.00,'2024-12-15','Restock sabun cuci 10 botol',1,'2025-12-16 17:00:21',NULL,NULL),(2,1,'Tagihan Listrik','operasional',100000.00,'2024-12-01','Tagihan listrik Desember',NULL,'2025-12-16 17:00:21',NULL,NULL),(3,2,'Restock Whitening','bahan',200000.00,'2024-12-10','Restock whitening solution',3,'2025-12-16 17:00:21',NULL,NULL),(4,3,'Gaji Karyawan','gaji',500000.00,'2024-12-15','Gaji karyawan minggu 2',NULL,'2025-12-16 17:00:21',NULL,NULL),(5,4,'Beli Dryer Pad','perlengkapan',150000.00,'2024-12-12','Beli dryer pad baru',NULL,'2025-12-16 17:00:21',NULL,NULL),(6,8,'Restock Sabun Premium','bahan',350000.00,'2025-12-01','Beli sabun 10 botol',5,'2025-12-22 06:06:36',NULL,NULL),(7,8,'Tagihan Listrik Desember','operasional',120000.00,'2025-12-01','Listrik bulan Desember',NULL,'2025-12-22 06:06:36',NULL,NULL),(8,8,'Restock Whitening Cream','bahan',270000.00,'2025-12-05','Beli 6 tube whitening',5,'2025-12-22 06:06:36',NULL,NULL),(9,8,'Gaji Karyawan Minggu 1','gaji',600000.00,'2025-12-07','Gaji 2 karyawan minggu 1',NULL,'2025-12-22 06:06:36',NULL,NULL),(10,8,'Restock Cat Repaint','bahan',390000.00,'2025-12-10','Cat hitam & putih',5,'2025-12-22 06:06:36',NULL,NULL),(11,8,'Biaya Air PDAM','operasional',80000.00,'2025-12-12','Tagihan air Desember',NULL,'2025-12-22 06:06:36',NULL,NULL),(12,8,'Maintenance Peralatan','operasional',150000.00,'2025-12-15','Service mesin pengering',6,'2025-12-22 06:06:36',NULL,NULL),(13,9,'Restock Sabun Premium','bahan',350000.00,'2025-12-02','Beli sabun 10 botol',7,'2025-12-22 06:06:36',NULL,NULL),(14,9,'Tagihan Listrik Desember','operasional',110000.00,'2025-12-01','Listrik bulan Desember',NULL,'2025-12-22 06:06:36',NULL,NULL),(15,9,'Restock Leather Care','bahan',275000.00,'2025-12-06','Leather conditioner 5 botol',7,'2025-12-22 06:06:36',NULL,NULL),(16,9,'Gaji Karyawan Minggu 1','gaji',600000.00,'2025-12-08','Gaji 2 karyawan minggu 1',NULL,'2025-12-22 06:06:36',NULL,NULL),(17,9,'Restock Microfiber','perlengkapan',200000.00,'2025-12-11','Lap microfiber 25 pcs',8,'2025-12-22 06:06:36',NULL,NULL),(18,9,'Biaya Air PDAM','operasional',75000.00,'2025-12-12','Tagihan air Desember',NULL,'2025-12-22 06:06:36',NULL,NULL);
/*!40000 ALTER TABLE `pengeluaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesanan`
--

DROP TABLE IF EXISTS `pesanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
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
  `nomor_pesanan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`),
  KEY `id_cabang` (`id_cabang`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `id_layanan` (`id_layanan`),
  KEY `id_karyawan` (`id_karyawan`),
  KEY `idx_pesanan_status` (`status_pesanan`),
  KEY `idx_pesanan_tgl_masuk` (`tgl_masuk`),
  CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE,
  CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE,
  CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE CASCADE,
  CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesanan`
--

LOCK TABLES `pesanan` WRITE;
/*!40000 ALTER TABLE `pesanan` DISABLE KEYS */;
INSERT INTO `pesanan` VALUES (1,1,1,2,1,'2024-12-16 00:00:00','2024-12-18 13:00:00',NULL,NULL,2,70000.00,'dibatalkan','Sepatu Nike Air Max putih','2025-12-16 17:00:21','2025-12-16 11:43:46',NULL,'KX-20241216-001'),(2,1,2,3,2,'2024-12-16 10:30:00','2024-12-20 17:00:00',NULL,NULL,1,45000.00,'diterima','Sol sudah menguning','2025-12-16 17:00:21',NULL,NULL,'KX-20241216-002'),(3,1,3,1,1,'2024-12-15 00:00:00','2024-12-17 10:00:00','2024-12-17 15:00:00',NULL,1,25000.00,'sudah_diambil','','2025-12-16 17:00:21','2025-12-16 11:43:08',NULL,'KX-20241215-001'),(4,2,4,4,3,'2024-12-16 11:00:00','2024-12-21 17:00:00',NULL,NULL,1,55000.00,'dalam_proses','Noda lumpur membandel','2025-12-16 17:00:21',NULL,NULL,'KX-20241216-003'),(5,2,5,5,3,'2024-12-14 00:00:00','2024-12-21 03:00:00','2024-12-20 14:00:00','2024-12-20 16:00:00',1,75000.00,'sudah_diambil','Jahitan depan lepas','2025-12-16 17:00:21','2025-12-16 11:42:51',NULL,'KX-20241214-001'),(6,3,6,7,4,'2024-12-16 08:30:00','2024-12-19 17:00:00',NULL,NULL,3,90000.00,'diterima','Sepatu keluarga','2025-12-16 17:00:21',NULL,NULL,'KX-20241216-004'),(7,3,7,8,4,'2024-12-15 10:00:00','2024-12-22 17:00:00',NULL,NULL,1,100000.00,'dalam_proses','Repaint warna hitam','2025-12-16 17:00:21',NULL,NULL,'KX-20241215-002'),(8,4,8,6,4,'2024-12-16 00:00:00','2024-12-17 10:00:00',NULL,NULL,2,80000.00,'diterima','Express - butuh cepat','2025-12-16 17:00:21','2025-12-16 11:36:13',NULL,'KX-20241216-005'),(9,4,9,8,4,'2024-12-13 00:00:00','2024-12-21 23:00:00','2024-12-22 10:00:00','2024-12-22 15:00:00',1,150000.00,'dalam_proses','Full treatment untuk sepatu lama','2025-12-16 17:00:21','2025-12-16 11:36:17',NULL,'KX-20241213-001'),(10,5,10,9,NULL,'2024-12-16 13:00:00','2024-12-20 17:00:00',NULL,NULL,1,60000.00,'dalam_proses','Sol kuning parah','2025-12-16 17:00:21',NULL,NULL,'KX-20241216-006'),(11,8,11,11,5,'2025-12-01 09:00:00','2025-12-03 17:00:00','2025-12-03 15:00:00','2025-12-03 18:00:00',1,30000.00,'sudah_diambil','Nike Air Force putih','2025-12-22 06:06:36',NULL,NULL,'AT-20251201-001'),(12,8,12,13,5,'2025-12-02 10:30:00','2025-12-06 17:00:00','2025-12-06 14:00:00','2025-12-07 10:00:00',2,150000.00,'sudah_diambil','Adidas Ultraboost - 2 pasang','2025-12-22 06:06:36',NULL,NULL,'AT-20251202-001'),(13,8,13,12,6,'2025-12-05 11:00:00','2025-12-08 17:00:00','2025-12-08 16:00:00',NULL,1,50000.00,'siap_diambil','Vans Old Skool hitam','2025-12-22 06:06:36',NULL,NULL,'AT-20251205-001'),(14,8,14,15,5,'2025-12-08 14:00:00','2025-12-11 17:00:00','2025-12-11 15:00:00',NULL,1,65000.00,'siap_diambil','Sol kuning parah','2025-12-22 06:06:36',NULL,NULL,'AT-20251208-001'),(15,8,15,14,6,'2025-12-10 09:30:00','2025-12-11 17:00:00',NULL,NULL,1,45000.00,'selesai','Express - butuh cepat','2025-12-22 06:06:36',NULL,NULL,'AT-20251210-001'),(16,8,21,17,5,'2025-12-12 10:00:00','2025-12-17 17:00:00',NULL,NULL,1,85000.00,'dalam_proses','Sepatu kulit formal','2025-12-22 06:06:36',NULL,NULL,'AT-20251212-001'),(17,8,22,11,6,'2025-12-15 13:00:00','2025-12-17 17:00:00',NULL,NULL,2,60000.00,'dalam_proses','Sneakers casual 2 pasang','2025-12-22 06:06:36',NULL,NULL,'AT-20251215-001'),(18,8,25,16,5,'2025-12-18 11:30:00','2025-12-25 17:00:00',NULL,NULL,1,120000.00,'diterima','Repaint Jordan 1 bred','2025-12-22 06:06:36',NULL,NULL,'AT-20251218-001'),(19,8,11,13,6,'2025-12-20 09:00:00','2025-12-24 17:00:00',NULL,NULL,1,75000.00,'diterima','Premium care New Balance','2025-12-22 06:06:36',NULL,NULL,'AT-20251220-001'),(20,8,12,12,5,'2025-12-21 10:00:00','2025-12-24 17:00:00',NULL,NULL,1,50000.00,'diterima','Deep clean Puma RS-X','2025-12-22 06:06:36',NULL,NULL,'AT-20251221-001'),(21,9,16,11,7,'2025-12-01 10:00:00','2025-12-03 17:00:00','2025-12-03 14:00:00','2025-12-04 09:00:00',1,30000.00,'sudah_diambil','Converse Chuck Taylor','2025-12-22 06:06:36',NULL,NULL,'AT-20251201-002'),(22,9,17,14,8,'2025-12-03 11:30:00','2025-12-04 17:00:00','2025-12-04 16:00:00','2025-12-05 11:00:00',1,45000.00,'sudah_diambil','Fast clean Adidas','2025-12-22 06:06:36',NULL,NULL,'AT-20251203-001'),(23,9,18,18,7,'2025-12-05 09:00:00','2025-12-15 17:00:00',NULL,NULL,1,180000.00,'dalam_proses','Full restoration vintage shoes','2025-12-22 06:06:36',NULL,NULL,'AT-20251205-002'),(24,9,19,13,8,'2025-12-07 14:00:00','2025-12-11 17:00:00','2025-12-11 13:00:00',NULL,1,75000.00,'siap_diambil','Premium Reebok Classic','2025-12-22 06:06:36',NULL,NULL,'AT-20251207-001'),(25,9,20,12,7,'2025-12-10 10:30:00','2025-12-13 17:00:00',NULL,NULL,2,100000.00,'selesai','Deep clean 2 pasang Nike','2025-12-22 06:06:36',NULL,NULL,'AT-20251210-002'),(26,9,23,15,8,'2025-12-12 13:00:00','2025-12-15 17:00:00',NULL,NULL,1,65000.00,'dalam_proses','Unyellowing Yeezy','2025-12-22 06:06:36',NULL,NULL,'AT-20251212-002'),(27,9,24,17,7,'2025-12-14 11:00:00','2025-12-19 17:00:00',NULL,NULL,1,85000.00,'dalam_proses','Leather boots treatment','2025-12-22 06:06:36',NULL,NULL,'AT-20251214-001'),(28,9,16,11,8,'2025-12-16 09:30:00','2025-12-18 17:00:00',NULL,NULL,1,30000.00,'diterima','Basic clean running shoes','2025-12-22 06:06:36',NULL,NULL,'AT-20251216-001'),(29,9,17,14,7,'2025-12-19 10:00:00','2025-12-20 17:00:00',NULL,NULL,1,45000.00,'diterima','Express service','2025-12-22 06:06:36',NULL,NULL,'AT-20251219-001'),(30,9,18,13,8,'2025-12-21 11:00:00','2025-12-25 17:00:00',NULL,NULL,1,75000.00,'diterima','Premium Jordan 4','2025-12-22 06:06:36',NULL,NULL,'AT-20251221-002');
/*!40000 ALTER TABLE `pesanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progres_pesanan`
--

DROP TABLE IF EXISTS `progres_pesanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `progres_pesanan` (
  `id_progres` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesanan` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `tgl_update` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_progres`),
  KEY `id_pesanan` (`id_pesanan`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `progres_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  CONSTRAINT `progres_pesanan_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progres_pesanan`
--

LOCK TABLES `progres_pesanan` WRITE;
/*!40000 ALTER TABLE `progres_pesanan` DISABLE KEYS */;
INSERT INTO `progres_pesanan` VALUES (1,1,'diterima','Pesanan diterima',1,'2024-12-16 09:00:00','2025-12-16 17:00:21',NULL),(2,1,'dalam_proses','Mulai proses cuci',1,'2024-12-16 10:00:00','2025-12-16 17:00:21',NULL),(3,3,'diterima','Pesanan diterima',1,'2024-12-15 14:00:00','2025-12-16 17:00:21',NULL),(4,3,'dalam_proses','Proses cuci',1,'2024-12-15 15:00:00','2025-12-16 17:00:21',NULL),(5,3,'selesai','Sepatu sudah bersih',1,'2024-12-17 15:00:00','2025-12-16 17:00:21',NULL),(6,5,'diterima','Pesanan diterima',3,'2024-12-14 09:00:00','2025-12-16 17:00:21',NULL),(7,5,'dalam_proses','Proses repair jahitan',3,'2024-12-14 11:00:00','2025-12-16 17:00:21',NULL),(8,5,'selesai','Jahitan sudah diperbaiki',3,'2024-12-20 14:00:00','2025-12-16 17:00:21',NULL),(9,5,'sudah_diambil','Pelanggan sudah mengambil',3,'2024-12-20 16:00:00','2025-12-16 17:00:21',NULL);
/*!40000 ALTER TABLE `progres_pesanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rekomendasi_ai`
--

DROP TABLE IF EXISTS `rekomendasi_ai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rekomendasi_ai` (
  `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik` int(11) NOT NULL,
  `recommendation_text` text NOT NULL COMMENT 'Teks rekomendasi lengkap dari AI',
  `insights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Array of key insights (3 items)' CHECK (json_valid(`insights`)),
  `impact_prediction` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Predicted impact percentages (revenue, retention, efficiency)' CHECK (json_valid(`impact_prediction`)),
  `business_data_snapshot` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Business data yang digunakan untuk generate rekomendasi' CHECK (json_valid(`business_data_snapshot`)),
  `status` enum('new','saved','implemented','archived') DEFAULT 'new' COMMENT 'Status rekomendasi',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_rekomendasi`),
  KEY `idx_pemilik` (`id_pemilik`),
  KEY `idx_status` (`status`),
  KEY `idx_created` (`created_at`),
  CONSTRAINT `rekomendasi_ai_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='AI-generated business recommendations';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekomendasi_ai`
--

LOCK TABLES `rekomendasi_ai` WRITE;
/*!40000 ALTER TABLE `rekomendasi_ai` DISABLE KEYS */;
INSERT INTO `rekomendasi_ai` VALUES (1,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','saved','2025-12-22 07:49:23','2025-12-22 07:49:53'),(2,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 07:52:12','2025-12-22 13:52:12'),(3,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 07:58:00','2025-12-22 13:58:00'),(4,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:10:02','2025-12-22 14:10:02'),(5,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:11:23','2025-12-22 14:11:23'),(6,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:14:36','2025-12-22 14:14:36'),(7,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:17:13','2025-12-22 14:17:13'),(8,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:18:44','2025-12-22 14:18:44'),(9,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:21:19','2025-12-22 14:21:19'),(10,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:25:14','2025-12-22 14:25:14'),(11,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:26:04','2025-12-22 14:26:04'),(12,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:30:10','2025-12-22 14:30:10'),(13,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:33:26','2025-12-22 14:33:26'),(14,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:37:05','2025-12-22 14:37:05'),(15,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:41:41','2025-12-22 14:41:41'),(16,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:46:27','2025-12-22 14:46:27'),(17,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:50:51','2025-12-22 14:50:51'),(18,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 08:54:39','2025-12-22 14:54:39'),(19,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 09:58:02','2025-12-22 15:58:02'),(20,4,'Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.','[\"Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional\",\"Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%\",\"Focus marketing pada layanan premium dapat boost average order value hingga 20%\"]','{\"revenue\":15,\"retention\":23,\"efficiency\":18}','{\"total_orders_today\":0,\"total_orders_month\":20,\"monthly_revenue\":\"915000.00\",\"revenue_growth\":100,\"active_customers\":\"15\",\"pending_pickups\":3,\"top_services\":[\"Basic Cleaning\",\"Premium Care\",\"Deep Cleaning\"],\"branch_performance\":[{\"label\":\"AetherTech Shoes Care - Bantul\",\"value\":\"430000.00\"},{\"label\":\"AetherTech Shoes Care - Seturan\",\"value\":\"485000.00\"}],\"avg_order_value\":45750}','new','2025-12-22 10:10:30','2025-12-22 16:10:30');
/*!40000 ALTER TABLE `rekomendasi_ai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi_inventori`
--

DROP TABLE IF EXISTS `transaksi_inventori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi_inventori` (
  `id_transaksi_inventori` int(11) NOT NULL AUTO_INCREMENT,
  `id_inventori` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `jenis_transaksi` enum('masuk','keluar') NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_inventori`),
  KEY `id_inventori` (`id_inventori`),
  KEY `id_cabang` (`id_cabang`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `transaksi_inventori_ibfk_1` FOREIGN KEY (`id_inventori`) REFERENCES `inventori` (`id_inventori`) ON DELETE CASCADE,
  CONSTRAINT `transaksi_inventori_ibfk_2` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE,
  CONSTRAINT `transaksi_inventori_ibfk_3` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi_inventori`
--

LOCK TABLES `transaksi_inventori` WRITE;
/*!40000 ALTER TABLE `transaksi_inventori` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi_inventori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi_langganan`
--

DROP TABLE IF EXISTS `transaksi_langganan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi_langganan` (
  `id_transaksi_langganan` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_langganan`),
  KEY `id_pemilik` (`id_pemilik`),
  KEY `id_admin` (`id_admin`),
  KEY `idx_transaksi_langganan_status` (`status_pembayaran`),
  KEY `idx_id_paket` (`id_paket`),
  KEY `idx_kode_pembayaran` (`kode_pembayaran`),
  KEY `idx_id_paket_backup` (`id_paket`),
  CONSTRAINT `transaksi_langganan_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE CASCADE,
  CONSTRAINT `transaksi_langganan_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket_langganan` (`id_paket`) ON DELETE CASCADE,
  CONSTRAINT `transaksi_langganan_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi_langganan`
--

LOCK TABLES `transaksi_langganan` WRITE;
/*!40000 ALTER TABLE `transaksi_langganan` DISABLE KEYS */;
INSERT INTO `transaksi_langganan` VALUES (1,5,2,NULL,'2025-12-22 10:08:34',199000.00,'midtrans','pending','KIX-20251222100834-7788','2025-12-22','2026-01-22','2025-12-22 03:08:34','2025-12-22 18:22:28','2025-12-22 12:22:28');
/*!40000 ALTER TABLE `transaksi_langganan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `google_email` varchar(255) DEFAULT NULL,
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
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  KEY `idx_users_username` (`username`),
  KEY `idx_users_role` (`role`),
  KEY `idx_google_id` (`google_id`),
  KEY `idx_oauth_provider` (`oauth_provider`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'admin','aktif','2025-12-16 17:00:21','2025-12-22 18:07:52','2025-12-22 12:07:52'),(2,'owner_budi','$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'owner','aktif','2025-12-16 17:00:21','2025-12-16 17:11:53',NULL),(3,'owner_sari','$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'owner','aktif','2025-12-16 17:00:21','2025-12-16 17:11:53',NULL),(4,'karyawan_andi','$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'karyawan','aktif','2025-12-16 17:00:21','2025-12-16 17:11:53',NULL),(5,'karyawan_dewi','$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'karyawan','aktif','2025-12-16 17:00:21','2025-12-16 17:11:53',NULL),(6,'karyawan_rudi','$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'karyawan','aktif','2025-12-16 17:00:21','2025-12-16 17:11:53',NULL),(7,'karyawan_nina','$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'karyawan','aktif','2025-12-16 17:00:21','2025-12-16 17:11:53',NULL),(8,'hatta751','$2y$10$d7rIQezD9agtxv2kM.KSxOZz3u0c6EyDnnQ1RquuF/3DzS3KdBZam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'admin','aktif','2025-12-21 22:38:55','2025-12-22 06:09:23',NULL),(9,'rizkipangestu852922',NULL,'107038979417885165985','rizkipangestu852@gmail.com','https://lh3.googleusercontent.com/a/ACg8ocIkAayErSyW-VC4JnamCCuT59FYqhshhXg37RgNl0Y6rjQRcWo=s96-c','google',NULL,NULL,NULL,'owner','aktif','2025-12-21 22:50:54',NULL,NULL),(10,'karyawan_rizky','$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'karyawan','aktif','2025-12-22 06:06:35',NULL,NULL),(11,'karyawan_ayu','$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'karyawan','aktif','2025-12-22 06:06:35',NULL,NULL),(12,'karyawan_bayu','$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'karyawan','aktif','2025-12-22 06:06:35',NULL,NULL),(13,'karyawan_dina','$2y$10$lJyr6deDy2W7zCv0YNlyku/6ljRjw8vJAtUxb5f5G7nWFaiYhI4OK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'karyawan','aktif','2025-12-22 06:06:35',NULL,NULL),(14,'rayan496','$2y$10$t6jYb9tgdrvb8Gc6Pk0.4eb5Tt8fng77CSnjx2QahF67gbM1.Fh7O',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'owner','aktif','2025-12-22 03:05:46',NULL,NULL),(15,'riskypangestu057228',NULL,'113652892611796351362','riskypangestu057@students.amikom.ac.id','https://lh3.googleusercontent.com/a/ACg8ocI_XbhjTJ-lE_VUNA2FqBySHyeCukLOVbQ4Bg8qYvK4p0jZOQ=s96-c','google',NULL,NULL,NULL,'owner','aktif','2025-12-22 03:06:31','2025-12-22 12:07:24',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `v_dashboard_owner`
--

DROP TABLE IF EXISTS `v_dashboard_owner`;
/*!50001 DROP VIEW IF EXISTS `v_dashboard_owner`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_dashboard_owner` AS SELECT
 1 AS `id_pemilik`,
  1 AS `nama_usaha`,
  1 AS `status_langganan`,
  1 AS `total_cabang`,
  1 AS `total_karyawan`,
  1 AS `pesanan_aktif`,
  1 AS `pesanan_selesai_hari_ini`,
  1 AS `pendapatan_hari_ini`,
  1 AS `pendapatan_bulan_ini` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_keuangan_bulanan`
--

DROP TABLE IF EXISTS `v_keuangan_bulanan`;
/*!50001 DROP VIEW IF EXISTS `v_keuangan_bulanan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_keuangan_bulanan` AS SELECT
 1 AS `id_cabang`,
  1 AS `nama_cabang`,
  1 AS `id_pemilik`,
  1 AS `nama_usaha`,
  1 AS `tahun`,
  1 AS `bulan`,
  1 AS `periode`,
  1 AS `total_pemasukan`,
  1 AS `total_pengeluaran`,
  1 AS `laba_rugi`,
  1 AS `margin_persen` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_kinerja_karyawan`
--

DROP TABLE IF EXISTS `v_kinerja_karyawan`;
/*!50001 DROP VIEW IF EXISTS `v_kinerja_karyawan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_kinerja_karyawan` AS SELECT
 1 AS `id_karyawan`,
  1 AS `nama`,
  1 AS `jabatan`,
  1 AS `nama_cabang`,
  1 AS `nama_usaha`,
  1 AS `total_pesanan_ditangani`,
  1 AS `total_revenue`,
  1 AS `rata_rata_transaksi`,
  1 AS `total_nota_dicetak`,
  1 AS `total_transaksi_inventori`,
  1 AS `bulan`,
  1 AS `tahun` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_laporan_keuangan_lengkap`
--

DROP TABLE IF EXISTS `v_laporan_keuangan_lengkap`;
/*!50001 DROP VIEW IF EXISTS `v_laporan_keuangan_lengkap`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_laporan_keuangan_lengkap` AS SELECT
 1 AS `id_cabang`,
  1 AS `nama_cabang`,
  1 AS `id_pemilik`,
  1 AS `nama_usaha`,
  1 AS `tanggal`,
  1 AS `total_pemasukan`,
  1 AS `total_pengeluaran`,
  1 AS `laba_rugi`,
  1 AS `jumlah_transaksi_masuk`,
  1 AS `jumlah_transaksi_keluar` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_layanan_populer`
--

DROP TABLE IF EXISTS `v_layanan_populer`;
/*!50001 DROP VIEW IF EXISTS `v_layanan_populer`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_layanan_populer` AS SELECT
 1 AS `id_layanan`,
  1 AS `nama_layanan`,
  1 AS `harga`,
  1 AS `id_pemilik`,
  1 AS `nama_usaha`,
  1 AS `total_order`,
  1 AS `total_revenue`,
  1 AS `rata_rata_harga`,
  1 AS `bulan`,
  1 AS `tahun` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_pelanggan_baru`
--

DROP TABLE IF EXISTS `v_pelanggan_baru`;
/*!50001 DROP VIEW IF EXISTS `v_pelanggan_baru`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_pelanggan_baru` AS SELECT
 1 AS `id_pelanggan`,
  1 AS `nama`,
  1 AS `no_telp`,
  1 AS `email`,
  1 AS `tgl_daftar`,
  1 AS `jumlah_transaksi`,
  1 AS `total_pembelian`,
  1 AS `nama_cabang`,
  1 AS `nama_usaha` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_pelanggan_setia`
--

DROP TABLE IF EXISTS `v_pelanggan_setia`;
/*!50001 DROP VIEW IF EXISTS `v_pelanggan_setia`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_pelanggan_setia` AS SELECT
 1 AS `id_pelanggan`,
  1 AS `nama`,
  1 AS `no_telp`,
  1 AS `email`,
  1 AS `total_transaksi`,
  1 AS `total_pembelian`,
  1 AS `rata_rata_pembelian`,
  1 AS `transaksi_pertama`,
  1 AS `transaksi_terakhir`,
  1 AS `hari_terakhir_transaksi`,
  1 AS `rata_rata_rating`,
  1 AS `nama_cabang`,
  1 AS `nama_usaha`,
  1 AS `tier_pelanggan` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_pengeluaran_kategori`
--

DROP TABLE IF EXISTS `v_pengeluaran_kategori`;
/*!50001 DROP VIEW IF EXISTS `v_pengeluaran_kategori`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_pengeluaran_kategori` AS SELECT
 1 AS `id_cabang`,
  1 AS `nama_cabang`,
  1 AS `nama_usaha`,
  1 AS `kategori`,
  1 AS `bulan`,
  1 AS `tahun`,
  1 AS `jumlah_transaksi`,
  1 AS `total_pengeluaran`,
  1 AS `rata_rata_pengeluaran` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_pesanan_cabang`
--

DROP TABLE IF EXISTS `v_pesanan_cabang`;
/*!50001 DROP VIEW IF EXISTS `v_pesanan_cabang`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_pesanan_cabang` AS SELECT
 1 AS `id_cabang`,
  1 AS `nama_cabang`,
  1 AS `nama_usaha`,
  1 AS `tanggal`,
  1 AS `total_pesanan`,
  1 AS `total_pendapatan`,
  1 AS `rata_rata_transaksi`,
  1 AS `total_item`,
  1 AS `status_diterima`,
  1 AS `status_proses`,
  1 AS `status_selesai`,
  1 AS `status_siap`,
  1 AS `status_diambil` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_pesanan_detail`
--

DROP TABLE IF EXISTS `v_pesanan_detail`;
/*!50001 DROP VIEW IF EXISTS `v_pesanan_detail`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_pesanan_detail` AS SELECT
 1 AS `id_pesanan`,
  1 AS `tgl_masuk`,
  1 AS `tgl_estimasi_selesai`,
  1 AS `tgl_selesai`,
  1 AS `tgl_diambil`,
  1 AS `status_pesanan`,
  1 AS `total_harga`,
  1 AS `jumlah_item`,
  1 AS `id_cabang`,
  1 AS `nama_cabang`,
  1 AS `id_pemilik`,
  1 AS `nama_usaha`,
  1 AS `id_pelanggan`,
  1 AS `nama_pelanggan`,
  1 AS `telp_pelanggan`,
  1 AS `nama_layanan`,
  1 AS `harga_layanan`,
  1 AS `nama_karyawan`,
  1 AS `durasi_pengerjaan`,
  1 AS `status_ketepatan` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_rating_cabang`
--

DROP TABLE IF EXISTS `v_rating_cabang`;
/*!50001 DROP VIEW IF EXISTS `v_rating_cabang`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_rating_cabang` AS SELECT
 1 AS `id_cabang`,
  1 AS `nama_cabang`,
  1 AS `nama_usaha`,
  1 AS `total_feedback`,
  1 AS `rata_rata_rating`,
  1 AS `rating_5`,
  1 AS `rating_4`,
  1 AS `rating_3`,
  1 AS `rating_2`,
  1 AS `rating_1`,
  1 AS `persentase_puas` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_riwayat_inventori`
--

DROP TABLE IF EXISTS `v_riwayat_inventori`;
/*!50001 DROP VIEW IF EXISTS `v_riwayat_inventori`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_riwayat_inventori` AS SELECT
 1 AS `id_transaksi_inventori`,
  1 AS `jenis_transaksi`,
  1 AS `jumlah`,
  1 AS `tgl_transaksi`,
  1 AS `keterangan`,
  1 AS `nama_item`,
  1 AS `jenis_item`,
  1 AS `satuan`,
  1 AS `nama_cabang`,
  1 AS `nama_karyawan`,
  1 AS `nama_usaha` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_status_langganan`
--

DROP TABLE IF EXISTS `v_status_langganan`;
/*!50001 DROP VIEW IF EXISTS `v_status_langganan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_status_langganan` AS SELECT
 1 AS `id_pemilik`,
  1 AS `nama_usaha`,
  1 AS `email`,
  1 AS `no_telp`,
  1 AS `status_langganan`,
  1 AS `nama_paket`,
  1 AS `harga_paket`,
  1 AS `tgl_mulai_langganan`,
  1 AS `tgl_akhir_langganan`,
  1 AS `sisa_hari`,
  1 AS `status_pembayaran`,
  1 AS `status_sisa` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_stok_inventori`
--

DROP TABLE IF EXISTS `v_stok_inventori`;
/*!50001 DROP VIEW IF EXISTS `v_stok_inventori`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_stok_inventori` AS SELECT
 1 AS `id_inventori`,
  1 AS `nama_item`,
  1 AS `jenis_item`,
  1 AS `satuan`,
  1 AS `stok_tersedia`,
  1 AS `stok_minimal`,
  1 AS `harga_satuan`,
  1 AS `nilai_stok`,
  1 AS `id_cabang`,
  1 AS `nama_cabang`,
  1 AS `id_pemilik`,
  1 AS `nama_usaha`,
  1 AS `status_stok` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_stok_kritis`
--

DROP TABLE IF EXISTS `v_stok_kritis`;
/*!50001 DROP VIEW IF EXISTS `v_stok_kritis`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_stok_kritis` AS SELECT
 1 AS `id_inventori`,
  1 AS `nama_item`,
  1 AS `jenis_item`,
  1 AS `stok_tersedia`,
  1 AS `stok_minimal`,
  1 AS `kebutuhan_stok`,
  1 AS `harga_satuan`,
  1 AS `estimasi_biaya`,
  1 AS `nama_cabang`,
  1 AS `nama_usaha` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tren_penjualan`
--

DROP TABLE IF EXISTS `v_tren_penjualan`;
/*!50001 DROP VIEW IF EXISTS `v_tren_penjualan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_tren_penjualan` AS SELECT
 1 AS `id_pemilik`,
  1 AS `nama_usaha`,
  1 AS `id_cabang`,
  1 AS `nama_cabang`,
  1 AS `tahun`,
  1 AS `bulan`,
  1 AS `periode`,
  1 AS `jumlah_pesanan`,
  1 AS `total_penjualan`,
  1 AS `rata_rata_penjualan`,
  1 AS `jumlah_pelanggan_unik` */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `v_dashboard_owner`
--

/*!50001 DROP VIEW IF EXISTS `v_dashboard_owner`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_dashboard_owner` AS select `pm`.`id_pemilik` AS `id_pemilik`,`pm`.`nama_usaha` AS `nama_usaha`,`pm`.`status_langganan` AS `status_langganan`,count(distinct `c`.`id_cabang`) AS `total_cabang`,count(distinct `k`.`id_karyawan`) AS `total_karyawan`,count(distinct case when `p`.`status_pesanan` in ('diterima','dalam_proses','selesai','siap_diambil') then `p`.`id_pesanan` end) AS `pesanan_aktif`,count(distinct case when `p`.`status_pesanan` = 'sudah_diambil' and cast(`p`.`tgl_diambil` as date) = curdate() then `p`.`id_pesanan` end) AS `pesanan_selesai_hari_ini`,coalesce(sum(case when cast(`pem`.`tgl_transaksi` as date) = curdate() then `pem`.`jumlah` end),0) AS `pendapatan_hari_ini`,coalesce(sum(case when month(`pem`.`tgl_transaksi`) = month(curdate()) and year(`pem`.`tgl_transaksi`) = year(curdate()) then `pem`.`jumlah` end),0) AS `pendapatan_bulan_ini` from ((((`pemilik` `pm` left join `cabang` `c` on(`pm`.`id_pemilik` = `c`.`id_pemilik` and `c`.`deleted_at` is null)) left join `karyawan` `k` on(`c`.`id_cabang` = `k`.`id_cabang` and `k`.`deleted_at` is null)) left join `pesanan` `p` on(`c`.`id_cabang` = `p`.`id_cabang` and `p`.`deleted_at` is null)) left join `pemasukan` `pem` on(`c`.`id_cabang` = `pem`.`id_cabang` and `pem`.`deleted_at` is null)) where `pm`.`deleted_at` is null group by `pm`.`id_pemilik`,`pm`.`nama_usaha`,`pm`.`status_langganan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_keuangan_bulanan`
--

/*!50001 DROP VIEW IF EXISTS `v_keuangan_bulanan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_keuangan_bulanan` AS select `c`.`id_cabang` AS `id_cabang`,`c`.`nama_cabang` AS `nama_cabang`,`pm`.`id_pemilik` AS `id_pemilik`,`pm`.`nama_usaha` AS `nama_usaha`,year(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`)) AS `tahun`,month(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`)) AS `bulan`,date_format(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`),'%Y-%m') AS `periode`,coalesce(sum(`pem`.`jumlah`),0) AS `total_pemasukan`,coalesce(sum(`pen`.`jumlah`),0) AS `total_pengeluaran`,coalesce(sum(`pem`.`jumlah`),0) - coalesce(sum(`pen`.`jumlah`),0) AS `laba_rugi`,round((coalesce(sum(`pem`.`jumlah`),0) - coalesce(sum(`pen`.`jumlah`),0)) / nullif(coalesce(sum(`pem`.`jumlah`),0),0) * 100,2) AS `margin_persen` from (((`cabang` `c` join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `pemasukan` `pem` on(`c`.`id_cabang` = `pem`.`id_cabang` and `pem`.`deleted_at` is null)) left join `pengeluaran` `pen` on(`c`.`id_cabang` = `pen`.`id_cabang` and `pen`.`deleted_at` is null)) where `c`.`deleted_at` is null group by `c`.`id_cabang`,`c`.`nama_cabang`,`pm`.`id_pemilik`,`pm`.`nama_usaha`,year(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`)),month(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_kinerja_karyawan`
--

/*!50001 DROP VIEW IF EXISTS `v_kinerja_karyawan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_kinerja_karyawan` AS select `k`.`id_karyawan` AS `id_karyawan`,`k`.`nama` AS `nama`,`k`.`jabatan` AS `jabatan`,`c`.`nama_cabang` AS `nama_cabang`,`pm`.`nama_usaha` AS `nama_usaha`,count(distinct `p`.`id_pesanan`) AS `total_pesanan_ditangani`,sum(`p`.`total_harga`) AS `total_revenue`,avg(`p`.`total_harga`) AS `rata_rata_transaksi`,count(distinct `n`.`id_nota`) AS `total_nota_dicetak`,count(distinct `ti`.`id_transaksi_inventori`) AS `total_transaksi_inventori`,month(`p`.`tgl_masuk`) AS `bulan`,year(`p`.`tgl_masuk`) AS `tahun` from (((((`karyawan` `k` join `cabang` `c` on(`k`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `pesanan` `p` on(`k`.`id_karyawan` = `p`.`id_karyawan` and `p`.`deleted_at` is null)) left join `nota` `n` on(`k`.`id_karyawan` = `n`.`id_karyawan` and `n`.`deleted_at` is null)) left join `transaksi_inventori` `ti` on(`k`.`id_karyawan` = `ti`.`id_karyawan` and `ti`.`deleted_at` is null)) where `k`.`deleted_at` is null group by `k`.`id_karyawan`,`k`.`nama`,`k`.`jabatan`,`c`.`nama_cabang`,`pm`.`nama_usaha`,month(`p`.`tgl_masuk`),year(`p`.`tgl_masuk`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_laporan_keuangan_lengkap`
--

/*!50001 DROP VIEW IF EXISTS `v_laporan_keuangan_lengkap`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_laporan_keuangan_lengkap` AS select `c`.`id_cabang` AS `id_cabang`,`c`.`nama_cabang` AS `nama_cabang`,`pm`.`id_pemilik` AS `id_pemilik`,`pm`.`nama_usaha` AS `nama_usaha`,cast(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`) as date) AS `tanggal`,coalesce(sum(`pem`.`jumlah`),0) AS `total_pemasukan`,coalesce(sum(`pen`.`jumlah`),0) AS `total_pengeluaran`,coalesce(sum(`pem`.`jumlah`),0) - coalesce(sum(`pen`.`jumlah`),0) AS `laba_rugi`,count(distinct `pem`.`id_pemasukan`) AS `jumlah_transaksi_masuk`,count(distinct `pen`.`id_pengeluaran`) AS `jumlah_transaksi_keluar` from (((`cabang` `c` join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `pemasukan` `pem` on(`c`.`id_cabang` = `pem`.`id_cabang` and `pem`.`deleted_at` is null)) left join `pengeluaran` `pen` on(`c`.`id_cabang` = `pen`.`id_cabang` and `pen`.`deleted_at` is null)) where `c`.`deleted_at` is null group by `c`.`id_cabang`,`c`.`nama_cabang`,`pm`.`id_pemilik`,`pm`.`nama_usaha`,cast(coalesce(`pem`.`tgl_transaksi`,`pen`.`tgl_transaksi`) as date) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_layanan_populer`
--

/*!50001 DROP VIEW IF EXISTS `v_layanan_populer`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_layanan_populer` AS select `l`.`id_layanan` AS `id_layanan`,`l`.`nama_layanan` AS `nama_layanan`,`l`.`harga` AS `harga`,`pm`.`id_pemilik` AS `id_pemilik`,`pm`.`nama_usaha` AS `nama_usaha`,count(`p`.`id_pesanan`) AS `total_order`,sum(`p`.`total_harga`) AS `total_revenue`,avg(`p`.`total_harga`) AS `rata_rata_harga`,month(`p`.`tgl_masuk`) AS `bulan`,year(`p`.`tgl_masuk`) AS `tahun` from ((`layanan` `l` join `pemilik` `pm` on(`l`.`id_pemilik` = `pm`.`id_pemilik`)) join `pesanan` `p` on(`l`.`id_layanan` = `p`.`id_layanan`)) where `l`.`deleted_at` is null and `p`.`deleted_at` is null group by `l`.`id_layanan`,`l`.`nama_layanan`,`l`.`harga`,`pm`.`id_pemilik`,`pm`.`nama_usaha`,month(`p`.`tgl_masuk`),year(`p`.`tgl_masuk`) order by count(`p`.`id_pesanan`) desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_pelanggan_baru`
--

/*!50001 DROP VIEW IF EXISTS `v_pelanggan_baru`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_pelanggan_baru` AS select `pel`.`id_pelanggan` AS `id_pelanggan`,`pel`.`nama` AS `nama`,`pel`.`no_telp` AS `no_telp`,`pel`.`email` AS `email`,`pel`.`created_at` AS `tgl_daftar`,count(`p`.`id_pesanan`) AS `jumlah_transaksi`,sum(`p`.`total_harga`) AS `total_pembelian`,`c`.`nama_cabang` AS `nama_cabang`,`pm`.`nama_usaha` AS `nama_usaha` from (((`pelanggan` `pel` left join `pesanan` `p` on(`pel`.`id_pelanggan` = `p`.`id_pelanggan` and `p`.`deleted_at` is null)) left join `cabang` `c` on(`p`.`id_cabang` = `c`.`id_cabang`)) left join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) where `pel`.`deleted_at` is null and month(`pel`.`created_at`) = month(curdate()) and year(`pel`.`created_at`) = year(curdate()) group by `pel`.`id_pelanggan`,`pel`.`nama`,`pel`.`no_telp`,`pel`.`email`,`pel`.`created_at`,`c`.`nama_cabang`,`pm`.`nama_usaha` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_pelanggan_setia`
--

/*!50001 DROP VIEW IF EXISTS `v_pelanggan_setia`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_pelanggan_setia` AS select `pel`.`id_pelanggan` AS `id_pelanggan`,`pel`.`nama` AS `nama`,`pel`.`no_telp` AS `no_telp`,`pel`.`email` AS `email`,count(`p`.`id_pesanan`) AS `total_transaksi`,sum(`p`.`total_harga`) AS `total_pembelian`,avg(`p`.`total_harga`) AS `rata_rata_pembelian`,min(`p`.`tgl_masuk`) AS `transaksi_pertama`,max(`p`.`tgl_masuk`) AS `transaksi_terakhir`,to_days(current_timestamp()) - to_days(max(`p`.`tgl_masuk`)) AS `hari_terakhir_transaksi`,avg(coalesce(`f`.`rating`,0)) AS `rata_rata_rating`,`c`.`nama_cabang` AS `nama_cabang`,`pm`.`nama_usaha` AS `nama_usaha`,case when count(`p`.`id_pesanan`) >= 20 then 'VIP' when count(`p`.`id_pesanan`) >= 10 then 'Gold' when count(`p`.`id_pesanan`) >= 5 then 'Silver' else 'Regular' end AS `tier_pelanggan` from ((((`pelanggan` `pel` join `pesanan` `p` on(`pel`.`id_pelanggan` = `p`.`id_pelanggan`)) join `cabang` `c` on(`p`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `feedback_pelanggan` `f` on(`p`.`id_pesanan` = `f`.`id_pesanan`)) where `pel`.`deleted_at` is null and `p`.`deleted_at` is null group by `pel`.`id_pelanggan`,`pel`.`nama`,`pel`.`no_telp`,`pel`.`email`,`c`.`nama_cabang`,`pm`.`nama_usaha` having `total_transaksi` >= 3 order by count(`p`.`id_pesanan`) desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_pengeluaran_kategori`
--

/*!50001 DROP VIEW IF EXISTS `v_pengeluaran_kategori`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_pengeluaran_kategori` AS select `c`.`id_cabang` AS `id_cabang`,`c`.`nama_cabang` AS `nama_cabang`,`pm`.`nama_usaha` AS `nama_usaha`,`pen`.`kategori` AS `kategori`,month(`pen`.`tgl_transaksi`) AS `bulan`,year(`pen`.`tgl_transaksi`) AS `tahun`,count(`pen`.`id_pengeluaran`) AS `jumlah_transaksi`,sum(`pen`.`jumlah`) AS `total_pengeluaran`,avg(`pen`.`jumlah`) AS `rata_rata_pengeluaran` from ((`pengeluaran` `pen` join `cabang` `c` on(`pen`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) where `pen`.`deleted_at` is null group by `c`.`id_cabang`,`c`.`nama_cabang`,`pm`.`nama_usaha`,`pen`.`kategori`,month(`pen`.`tgl_transaksi`),year(`pen`.`tgl_transaksi`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_pesanan_cabang`
--

/*!50001 DROP VIEW IF EXISTS `v_pesanan_cabang`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_pesanan_cabang` AS select `c`.`id_cabang` AS `id_cabang`,`c`.`nama_cabang` AS `nama_cabang`,`pm`.`nama_usaha` AS `nama_usaha`,cast(`p`.`tgl_masuk` as date) AS `tanggal`,count(`p`.`id_pesanan`) AS `total_pesanan`,sum(`p`.`total_harga`) AS `total_pendapatan`,avg(`p`.`total_harga`) AS `rata_rata_transaksi`,sum(`p`.`jumlah_item`) AS `total_item`,count(case when `p`.`status_pesanan` = 'diterima' then 1 end) AS `status_diterima`,count(case when `p`.`status_pesanan` = 'dalam_proses' then 1 end) AS `status_proses`,count(case when `p`.`status_pesanan` = 'selesai' then 1 end) AS `status_selesai`,count(case when `p`.`status_pesanan` = 'siap_diambil' then 1 end) AS `status_siap`,count(case when `p`.`status_pesanan` = 'sudah_diambil' then 1 end) AS `status_diambil` from ((`cabang` `c` join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `pesanan` `p` on(`c`.`id_cabang` = `p`.`id_cabang` and `p`.`deleted_at` is null)) where `c`.`deleted_at` is null group by `c`.`id_cabang`,`c`.`nama_cabang`,`pm`.`nama_usaha`,cast(`p`.`tgl_masuk` as date) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_pesanan_detail`
--

/*!50001 DROP VIEW IF EXISTS `v_pesanan_detail`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_pesanan_detail` AS select `p`.`id_pesanan` AS `id_pesanan`,`p`.`tgl_masuk` AS `tgl_masuk`,`p`.`tgl_estimasi_selesai` AS `tgl_estimasi_selesai`,`p`.`tgl_selesai` AS `tgl_selesai`,`p`.`tgl_diambil` AS `tgl_diambil`,`p`.`status_pesanan` AS `status_pesanan`,`p`.`total_harga` AS `total_harga`,`p`.`jumlah_item` AS `jumlah_item`,`c`.`id_cabang` AS `id_cabang`,`c`.`nama_cabang` AS `nama_cabang`,`pm`.`id_pemilik` AS `id_pemilik`,`pm`.`nama_usaha` AS `nama_usaha`,`pel`.`id_pelanggan` AS `id_pelanggan`,`pel`.`nama` AS `nama_pelanggan`,`pel`.`no_telp` AS `telp_pelanggan`,`l`.`nama_layanan` AS `nama_layanan`,`l`.`harga` AS `harga_layanan`,`k`.`nama` AS `nama_karyawan`,to_days(coalesce(`p`.`tgl_selesai`,current_timestamp())) - to_days(`p`.`tgl_masuk`) AS `durasi_pengerjaan`,case when `p`.`tgl_selesai` <= `p`.`tgl_estimasi_selesai` then 'Tepat Waktu' when `p`.`tgl_selesai` > `p`.`tgl_estimasi_selesai` then 'Terlambat' else 'Dalam Proses' end AS `status_ketepatan` from (((((`pesanan` `p` join `cabang` `c` on(`p`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) join `pelanggan` `pel` on(`p`.`id_pelanggan` = `pel`.`id_pelanggan`)) join `layanan` `l` on(`p`.`id_layanan` = `l`.`id_layanan`)) left join `karyawan` `k` on(`p`.`id_karyawan` = `k`.`id_karyawan`)) where `p`.`deleted_at` is null */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_rating_cabang`
--

/*!50001 DROP VIEW IF EXISTS `v_rating_cabang`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_rating_cabang` AS select `c`.`id_cabang` AS `id_cabang`,`c`.`nama_cabang` AS `nama_cabang`,`pm`.`nama_usaha` AS `nama_usaha`,count(`f`.`id_feedback`) AS `total_feedback`,avg(`f`.`rating`) AS `rata_rata_rating`,count(case when `f`.`rating` = 5 then 1 end) AS `rating_5`,count(case when `f`.`rating` = 4 then 1 end) AS `rating_4`,count(case when `f`.`rating` = 3 then 1 end) AS `rating_3`,count(case when `f`.`rating` = 2 then 1 end) AS `rating_2`,count(case when `f`.`rating` = 1 then 1 end) AS `rating_1`,round(count(case when `f`.`rating` >= 4 then 1 end) * 100.0 / count(`f`.`id_feedback`),2) AS `persentase_puas` from (((`cabang` `c` join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) join `pesanan` `p` on(`c`.`id_cabang` = `p`.`id_cabang`)) left join `feedback_pelanggan` `f` on(`p`.`id_pesanan` = `f`.`id_pesanan`)) where `c`.`deleted_at` is null and `p`.`deleted_at` is null and `f`.`deleted_at` is null group by `c`.`id_cabang`,`c`.`nama_cabang`,`pm`.`nama_usaha` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_riwayat_inventori`
--

/*!50001 DROP VIEW IF EXISTS `v_riwayat_inventori`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_riwayat_inventori` AS select `ti`.`id_transaksi_inventori` AS `id_transaksi_inventori`,`ti`.`jenis_transaksi` AS `jenis_transaksi`,`ti`.`jumlah` AS `jumlah`,`ti`.`tgl_transaksi` AS `tgl_transaksi`,`ti`.`keterangan` AS `keterangan`,`i`.`nama_item` AS `nama_item`,`i`.`jenis_item` AS `jenis_item`,`i`.`satuan` AS `satuan`,`c`.`nama_cabang` AS `nama_cabang`,`k`.`nama` AS `nama_karyawan`,`pm`.`nama_usaha` AS `nama_usaha` from ((((`transaksi_inventori` `ti` join `inventori` `i` on(`ti`.`id_inventori` = `i`.`id_inventori`)) join `cabang` `c` on(`ti`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) left join `karyawan` `k` on(`ti`.`id_karyawan` = `k`.`id_karyawan`)) where `ti`.`deleted_at` is null order by `ti`.`tgl_transaksi` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_status_langganan`
--

/*!50001 DROP VIEW IF EXISTS `v_status_langganan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_status_langganan` AS select `pm`.`id_pemilik` AS `id_pemilik`,`pm`.`nama_usaha` AS `nama_usaha`,`pm`.`email` AS `email`,`pm`.`no_telp` AS `no_telp`,`pm`.`status_langganan` AS `status_langganan`,`pl`.`nama_paket` AS `nama_paket`,`pl`.`harga` AS `harga_paket`,`tl`.`tgl_mulai_langganan` AS `tgl_mulai_langganan`,`tl`.`tgl_akhir_langganan` AS `tgl_akhir_langganan`,to_days(`tl`.`tgl_akhir_langganan`) - to_days(curdate()) AS `sisa_hari`,`tl`.`status_pembayaran` AS `status_pembayaran`,case when to_days(`tl`.`tgl_akhir_langganan`) - to_days(curdate()) <= 0 then 'Habis' when to_days(`tl`.`tgl_akhir_langganan`) - to_days(curdate()) <= 7 then 'Akan Habis' else 'Aktif' end AS `status_sisa` from ((`pemilik` `pm` left join `transaksi_langganan` `tl` on(`pm`.`id_pemilik` = `tl`.`id_pemilik` and `tl`.`status_pembayaran` = 'sukses' and `tl`.`deleted_at` is null)) left join `paket_langganan` `pl` on(`tl`.`id_paket` = `pl`.`id_paket`)) where `pm`.`deleted_at` is null */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_stok_inventori`
--

/*!50001 DROP VIEW IF EXISTS `v_stok_inventori`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_stok_inventori` AS select `i`.`id_inventori` AS `id_inventori`,`i`.`nama_item` AS `nama_item`,`i`.`jenis_item` AS `jenis_item`,`i`.`satuan` AS `satuan`,`i`.`stok_tersedia` AS `stok_tersedia`,`i`.`stok_minimal` AS `stok_minimal`,`i`.`harga_satuan` AS `harga_satuan`,`i`.`stok_tersedia` * `i`.`harga_satuan` AS `nilai_stok`,`c`.`id_cabang` AS `id_cabang`,`c`.`nama_cabang` AS `nama_cabang`,`pm`.`id_pemilik` AS `id_pemilik`,`pm`.`nama_usaha` AS `nama_usaha`,case when `i`.`stok_tersedia` <= 0 then 'Habis' when `i`.`stok_tersedia` <= `i`.`stok_minimal` then 'Kritis' when `i`.`stok_tersedia` <= `i`.`stok_minimal` * 1.5 then 'Rendah' else 'Aman' end AS `status_stok` from ((`inventori` `i` join `cabang` `c` on(`i`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) where `i`.`deleted_at` is null */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_stok_kritis`
--

/*!50001 DROP VIEW IF EXISTS `v_stok_kritis`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_stok_kritis` AS select `i`.`id_inventori` AS `id_inventori`,`i`.`nama_item` AS `nama_item`,`i`.`jenis_item` AS `jenis_item`,`i`.`stok_tersedia` AS `stok_tersedia`,`i`.`stok_minimal` AS `stok_minimal`,`i`.`stok_minimal` - `i`.`stok_tersedia` AS `kebutuhan_stok`,`i`.`harga_satuan` AS `harga_satuan`,(`i`.`stok_minimal` - `i`.`stok_tersedia`) * `i`.`harga_satuan` AS `estimasi_biaya`,`c`.`nama_cabang` AS `nama_cabang`,`pm`.`nama_usaha` AS `nama_usaha` from ((`inventori` `i` join `cabang` `c` on(`i`.`id_cabang` = `c`.`id_cabang`)) join `pemilik` `pm` on(`c`.`id_pemilik` = `pm`.`id_pemilik`)) where `i`.`stok_tersedia` <= `i`.`stok_minimal` and `i`.`deleted_at` is null order by `i`.`stok_minimal` - `i`.`stok_tersedia` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tren_penjualan`
--

/*!50001 DROP VIEW IF EXISTS `v_tren_penjualan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tren_penjualan` AS select `pm`.`id_pemilik` AS `id_pemilik`,`pm`.`nama_usaha` AS `nama_usaha`,`c`.`id_cabang` AS `id_cabang`,`c`.`nama_cabang` AS `nama_cabang`,year(`p`.`tgl_masuk`) AS `tahun`,month(`p`.`tgl_masuk`) AS `bulan`,date_format(`p`.`tgl_masuk`,'%Y-%m') AS `periode`,count(`p`.`id_pesanan`) AS `jumlah_pesanan`,sum(`p`.`total_harga`) AS `total_penjualan`,avg(`p`.`total_harga`) AS `rata_rata_penjualan`,count(distinct `p`.`id_pelanggan`) AS `jumlah_pelanggan_unik` from ((`pemilik` `pm` join `cabang` `c` on(`pm`.`id_pemilik` = `c`.`id_pemilik`)) left join `pesanan` `p` on(`c`.`id_cabang` = `p`.`id_cabang` and `p`.`deleted_at` is null)) where `pm`.`deleted_at` is null and `c`.`deleted_at` is null group by `pm`.`id_pemilik`,`pm`.`nama_usaha`,`c`.`id_cabang`,`c`.`nama_cabang`,year(`p`.`tgl_masuk`),month(`p`.`tgl_masuk`) order by year(`p`.`tgl_masuk`) desc,month(`p`.`tgl_masuk`) desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-23 10:34:03
