-- ============================================
-- KIXERA DATABASE - RESET AND DUMMY DATA
-- Generated: 2025-12-16
-- ============================================

SET FOREIGN_KEY_CHECKS = 0;

-- Clear all data from tables (excluding views prefixed with 'v_')
TRUNCATE TABLE `activity_log`;
TRUNCATE TABLE `admin`;
TRUNCATE TABLE `backup_data`;
TRUNCATE TABLE `bukti_transaksi`;
TRUNCATE TABLE `chatbot_log`;
TRUNCATE TABLE `customer_service`;
TRUNCATE TABLE `detail_pesanan`;
TRUNCATE TABLE `feedback_pelanggan`;
TRUNCATE TABLE `inventori`;
TRUNCATE TABLE `karyawan`;
TRUNCATE TABLE `konten`;
TRUNCATE TABLE `layanan`;
TRUNCATE TABLE `log_aktivitas`;
TRUNCATE TABLE `nota`;
TRUNCATE TABLE `notifikasi`;
TRUNCATE TABLE `paket_langganan`;
TRUNCATE TABLE `pelanggan`;
TRUNCATE TABLE `pemasukan`;
TRUNCATE TABLE `pemilik`;
TRUNCATE TABLE `pengeluaran`;
TRUNCATE TABLE `pesanan`;
TRUNCATE TABLE `progres_pesanan`;
TRUNCATE TABLE `rekomendasi_ai`;
TRUNCATE TABLE `transaksi_inventori`;
TRUNCATE TABLE `transaksi_langganan`;
TRUNCATE TABLE `cabang`;
TRUNCATE TABLE `users`;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================
-- INSERT DUMMY DATA
-- ============================================

-- 1. PAKET LANGGANAN
INSERT INTO `paket_langganan` (`id_paket`, `nama_paket`, `deskripsi`, `harga`, `durasi_hari`, `fitur_aktif`, `status`, `created_at`) VALUES
(1, 'Basic', 'Paket dasar untuk usaha kecil', 99000.00, 30, '{"cabang": 1, "karyawan": 2}', 'aktif', NOW()),
(2, 'Professional', 'Paket untuk usaha menengah', 199000.00, 30, '{"cabang": 3, "karyawan": 10}', 'aktif', NOW()),
(3, 'Enterprise', 'Paket untuk usaha besar', 399000.00, 30, '{"cabang": -1, "karyawan": -1}', 'aktif', NOW());

-- 2. USERS (password: password123 - hashed with bcrypt)
INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'aktif', NOW()),
(2, 'owner_budi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'owner', 'aktif', NOW()),
(3, 'owner_sari', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'owner', 'aktif', NOW()),
(4, 'karyawan_andi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'karyawan', 'aktif', NOW()),
(5, 'karyawan_dewi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'karyawan', 'aktif', NOW()),
(6, 'karyawan_rudi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'karyawan', 'aktif', NOW()),
(7, 'karyawan_nina', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'karyawan', 'aktif', NOW());

-- 3. ADMIN
INSERT INTO `admin` (`id_admin`, `id_user`, `nama`, `email`, `no_telp`, `created_at`) VALUES
(1, 1, 'Super Admin', 'admin@kixera.com', '081234567890', NOW());

-- 4. PEMILIK (Owners)
INSERT INTO `pemilik` (`id_pemilik`, `id_user`, `nama`, `email`, `no_telp`, `nama_usaha`, `alamat_usaha`, `status_langganan`, `id_paket`, `created_at`) VALUES
(1, 2, 'Budi Santoso', 'budi@cleanshoes.com', '081234567891', 'Clean Shoes Jogja', 'Jl. Kaliurang Km 5, Yogyakarta', 'aktif', 2, NOW()),
(2, 3, 'Sari Dewi', 'sari@sepaturesik.com', '081234567892', 'Sepatu Resik', 'Jl. Malioboro No. 10, Yogyakarta', 'aktif', 3, NOW());

-- 5. CABANG (Branches)
INSERT INTO `cabang` (`id_cabang`, `id_pemilik`, `nama_cabang`, `alamat`, `alamat_cabang`, `no_telp`, `status`, `created_at`) VALUES
(1, 1, 'Clean Shoes - Seturan', 'Jl. Seturan Raya No. 15', 'Jl. Seturan Raya No. 15', '0274123456', 'aktif', NOW()),
(2, 1, 'Clean Shoes - Condongcatur', 'Jl. Anggajaya No. 20', 'Jl. Anggajaya No. 20', '0274123457', 'aktif', NOW()),
(3, 2, 'Sepatu Resik - Kota Gede', 'Jl. Kemasan No. 5, Kotagede', 'Jl. Kemasan No. 5, Kotagede', '0274123458', 'aktif', NOW()),
(4, 2, 'Sepatu Resik - Malioboro', 'Jl. Malioboro No. 10', 'Jl. Malioboro No. 10', '0274123459', 'aktif', NOW()),
(5, 2, 'Sepatu Resik - Gejayan', 'Jl. Gejayan No. 25', 'Jl. Gejayan No. 25', '0274123460', 'aktif', NOW());

-- 6. KARYAWAN (Employees)
INSERT INTO `karyawan` (`id_karyawan`, `id_user`, `id_cabang`, `nama`, `email`, `no_telp`, `jabatan`, `alamat`, `tgl_masuk`, `created_at`) VALUES
(1, 4, 1, 'Andi Prasetyo', 'andi@cleanshoes.com', '081345678901', 'Staff Cuci', 'Jl. Kaliurang Km 7', '2024-01-15', NOW()),
(2, 5, 1, 'Dewi Lestari', 'dewi@cleanshoes.com', '081345678902', 'Kasir', 'Jl. Seturan No. 10', '2024-02-01', NOW()),
(3, 6, 2, 'Rudi Hermawan', 'rudi@cleanshoes.com', '081345678903', 'Staff Cuci', 'Jl. Condongcatur No. 5', '2024-03-10', NOW()),
(4, 7, 3, 'Nina Safitri', 'nina@sepaturesik.com', '081345678904', 'Staff Cuci', 'Jl. Kotagede No. 8', '2024-01-20', NOW());

-- 7. LAYANAN (Services)
INSERT INTO `layanan` (`id_layanan`, `id_pemilik`, `nama_layanan`, `deskripsi`, `harga`, `estimasi_waktu`, `status`, `created_at`) VALUES
(1, 1, 'Cuci Reguler', 'Cuci standar untuk sepatu sneakers', 25000.00, 2, 'aktif', NOW()),
(2, 1, 'Cuci Premium', 'Cuci mendalam dengan perawatan khusus', 35000.00, 3, 'aktif', NOW()),
(3, 1, 'Whitening', 'Pemutihan sol dan bagian putih', 45000.00, 4, 'aktif', NOW()),
(4, 1, 'Deep Clean', 'Cuci ekstra dengan penghilang noda membandel', 55000.00, 5, 'aktif', NOW()),
(5, 1, 'Repair', 'Perbaikan jahitan dan lem', 75000.00, 7, 'aktif', NOW()),
(6, 2, 'Cuci Express', 'Cuci cepat dalam 1 hari', 40000.00, 1, 'aktif', NOW()),
(7, 2, 'Cuci Standar', 'Cuci biasa dengan hasil maksimal', 30000.00, 3, 'aktif', NOW()),
(8, 2, 'Repaint', 'Pengecatan ulang sepatu', 100000.00, 7, 'aktif', NOW()),
(9, 2, 'Unyellowing', 'Menghilangkan warna kuning pada sol', 60000.00, 4, 'aktif', NOW()),
(10, 2, 'Full Treatment', 'Paket lengkap cuci, whitening, dan repaint', 150000.00, 10, 'aktif', NOW());

-- 8. PELANGGAN (Customers)
INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `no_telp`, `email`, `alamat`, `created_at`) VALUES
(1, 'Ahmad Rizki', '081567890123', 'ahmad@gmail.com', 'Jl. Magelang No. 15', NOW()),
(2, 'Putri Handayani', '081567890124', 'putri@gmail.com', 'Jl. Solo No. 20', NOW()),
(3, 'Dimas Pratama', '081567890125', 'dimas@gmail.com', 'Jl. Godean No. 8', NOW()),
(4, 'Rina Wati', '081567890126', 'rina@gmail.com', 'Jl. Bantul No. 30', NOW()),
(5, 'Yoga Setiawan', '081567890127', 'yoga@gmail.com', 'Jl. Wates No. 12', NOW()),
(6, 'Lisa Permata', '081567890128', 'lisa@gmail.com', 'Jl. Kaliurang Km 10', NOW()),
(7, 'Bagus Wicaksono', '081567890129', 'bagus@gmail.com', 'Jl. Seturan No. 5', NOW()),
(8, 'Maya Sari', '081567890130', 'maya@gmail.com', 'Jl. Condongcatur No. 15', NOW()),
(9, 'Fajar Nugroho', '081567890131', 'fajar@gmail.com', 'Jl. Gejayan No. 7', NOW()),
(10, 'Indah Permatasari', '081567890132', 'indah@gmail.com', 'Jl. Kotagede No. 22', NOW());

-- 9. PESANAN (Orders)
INSERT INTO `pesanan` (`id_pesanan`, `id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, `nomor_pesanan`, `tgl_masuk`, `tgl_estimasi_selesai`, `tgl_selesai`, `tgl_diambil`, `jumlah_item`, `total_harga`, `status_pesanan`, `catatan`, `created_at`) VALUES
(1, 1, 1, 2, 1, 'KX-20241216-001', '2024-12-16 09:00:00', '2024-12-19 17:00:00', NULL, NULL, 2, 70000.00, 'dalam_proses', 'Sepatu Nike Air Max putih', NOW()),
(2, 1, 2, 3, 2, 'KX-20241216-002', '2024-12-16 10:30:00', '2024-12-20 17:00:00', NULL, NULL, 1, 45000.00, 'diterima', 'Sol sudah menguning', NOW()),
(3, 1, 3, 1, 1, 'KX-20241215-001', '2024-12-15 14:00:00', '2024-12-17 17:00:00', '2024-12-17 15:00:00', NULL, 1, 25000.00, 'selesai', NULL, NOW()),
(4, 2, 4, 4, 3, 'KX-20241216-003', '2024-12-16 11:00:00', '2024-12-21 17:00:00', NULL, NULL, 1, 55000.00, 'dalam_proses', 'Noda lumpur membandel', NOW()),
(5, 2, 5, 5, 3, 'KX-20241214-001', '2024-12-14 09:00:00', '2024-12-21 17:00:00', '2024-12-20 14:00:00', '2024-12-20 16:00:00', 1, 75000.00, 'sudah_diambil', 'Jahitan depan lepas', NOW()),
(6, 3, 6, 7, 4, 'KX-20241216-004', '2024-12-16 08:30:00', '2024-12-19 17:00:00', NULL, NULL, 3, 90000.00, 'diterima', 'Sepatu keluarga', NOW()),
(7, 3, 7, 8, 4, 'KX-20241215-002', '2024-12-15 10:00:00', '2024-12-22 17:00:00', NULL, NULL, 1, 100000.00, 'dalam_proses', 'Repaint warna hitam', NOW()),
(8, 4, 8, 6, NULL, 'KX-20241216-005', '2024-12-16 12:00:00', '2024-12-17 17:00:00', NULL, NULL, 2, 80000.00, 'diterima', 'Express - butuh cepat', NOW()),
(9, 4, 9, 10, NULL, 'KX-20241213-001', '2024-12-13 09:00:00', '2024-12-23 17:00:00', '2024-12-22 10:00:00', '2024-12-22 15:00:00', 1, 150000.00, 'sudah_diambil', 'Full treatment untuk sepatu lama', NOW()),
(10, 5, 10, 9, NULL, 'KX-20241216-006', '2024-12-16 13:00:00', '2024-12-20 17:00:00', NULL, NULL, 1, 60000.00, 'dalam_proses', 'Sol kuning parah', NOW());

-- 10. DETAIL PESANAN
INSERT INTO `detail_pesanan` (`id_detail`, `id_pesanan`, `id_layanan`, `jenis_sepatu`, `warna`, `kondisi_awal`, `catatan_khusus`, `created_at`) VALUES
(1, 1, 2, 'Nike Air Max 90', 'Putih', 'Kotor, noda tanah', 'Hati-hati bagian mesh', NOW()),
(2, 1, 2, 'Nike Air Max 90', 'Putih', 'Kotor, noda tanah', 'Pasangan sepatu pertama', NOW()),
(3, 2, 3, 'Adidas Superstar', 'Putih/Hitam', 'Sol menguning', 'Focus pada sol', NOW()),
(4, 3, 1, 'Vans Old Skool', 'Hitam', 'Berdebu', NULL, NOW()),
(5, 4, 4, 'Converse Chuck Taylor', 'Merah', 'Noda lumpur', 'Noda sudah lama', NOW()),
(6, 5, 5, 'New Balance 574', 'Abu-abu', 'Jahitan lepas', 'Jahitan depan kanan', NOW()),
(7, 6, 7, 'Sneakers Generic', 'Berbagai', 'Kotor biasa', '3 pasang sepatu keluarga', NOW()),
(8, 7, 8, 'Nike Jordan 1', 'Putih/Merah', 'Warna pudar', 'Repaint sesuai original', NOW()),
(9, 8, 6, 'Puma RS-X', 'Biru/Putih', 'Kotor', 'Express order', NOW()),
(10, 9, 10, 'Adidas NMD', 'Hitam/Putih', 'Kotor, sol kuning, warna pudar', 'Full restoration', NOW()),
(11, 10, 9, 'Nike Air Force 1', 'Putih', 'Sol sangat kuning', 'Perlu unyellowing ekstra', NOW());

-- 11. INVENTORI (Inventory)
INSERT INTO `inventori` (`id_inventori`, `id_cabang`, `nama_item`, `jenis_item`, `satuan`, `stok_minimal`, `stok_tersedia`, `harga_satuan`, `keterangan`, `created_at`) VALUES
(1, 1, 'Sabun Cuci Sepatu', 'bahan', 'botol', 5, 20, 25000.00, 'Sabun khusus sneakers', NOW()),
(2, 1, 'Sikat Bulu Lembut', 'alat', 'pcs', 3, 10, 15000.00, 'Untuk bahan sensitif', NOW()),
(3, 1, 'Sikat Bulu Keras', 'alat', 'pcs', 3, 8, 12000.00, 'Untuk sol dan rubber', NOW()),
(4, 1, 'Whitening Solution', 'bahan', 'botol', 5, 15, 35000.00, 'Cairan whitening sol', NOW()),
(5, 1, 'Microfiber Cloth', 'perlengkapan', 'pcs', 10, 50, 5000.00, 'Kain lap microfiber', NOW()),
(6, 2, 'Sabun Cuci Sepatu', 'bahan', 'botol', 5, 18, 25000.00, 'Sabun khusus sneakers', NOW()),
(7, 2, 'Sikat Premium', 'alat', 'pcs', 3, 6, 20000.00, 'Sikat kualitas tinggi', NOW()),
(8, 2, 'Deodorizer Spray', 'bahan', 'botol', 5, 12, 30000.00, 'Penghilang bau', NOW()),
(9, 3, 'Sabun Cuci Sepatu', 'bahan', 'botol', 5, 25, 25000.00, 'Sabun khusus sneakers', NOW()),
(10, 3, 'Cat Sepatu Hitam', 'bahan', 'botol', 3, 8, 45000.00, 'Cat repaint hitam', NOW()),
(11, 3, 'Cat Sepatu Putih', 'bahan', 'botol', 3, 10, 45000.00, 'Cat repaint putih', NOW()),
(12, 4, 'Sabun Cuci Express', 'bahan', 'botol', 5, 30, 30000.00, 'Sabun fast-dry', NOW()),
(13, 4, 'Dryer Machine Pad', 'perlengkapan', 'pcs', 5, 20, 8000.00, 'Pad mesin pengering', NOW()),
(14, 5, 'Unyellowing Cream', 'bahan', 'tube', 5, 12, 50000.00, 'Krim penghilang kuning', NOW()),
(15, 5, 'UV Light Bulb', 'alat', 'pcs', 2, 4, 75000.00, 'Lampu UV untuk proses', NOW());

-- 12. NOTA (Receipts)
INSERT INTO `nota` (`id_nota`, `id_pesanan`, `no_nota`, `tgl_cetak`, `id_karyawan`, `total_bayar`, `metode_pembayaran`, `created_at`) VALUES
(1, 3, 'NOTA-20241217-001', '2024-12-17 15:30:00', 1, 25000.00, 'cash', NOW()),
(2, 5, 'NOTA-20241220-001', '2024-12-20 16:00:00', 3, 75000.00, 'transfer', NOW()),
(3, 9, 'NOTA-20241222-001', '2024-12-22 15:30:00', NULL, 150000.00, 'qris', NOW());

-- 13. PROGRES PESANAN (Order Progress)
INSERT INTO `progres_pesanan` (`id_progres`, `id_pesanan`, `status`, `deskripsi`, `id_karyawan`, `tgl_update`, `created_at`) VALUES
(1, 1, 'diterima', 'Pesanan diterima', 1, '2024-12-16 09:00:00', NOW()),
(2, 1, 'dalam_proses', 'Mulai proses cuci', 1, '2024-12-16 10:00:00', NOW()),
(3, 3, 'diterima', 'Pesanan diterima', 1, '2024-12-15 14:00:00', NOW()),
(4, 3, 'dalam_proses', 'Proses cuci', 1, '2024-12-15 15:00:00', NOW()),
(5, 3, 'selesai', 'Sepatu sudah bersih', 1, '2024-12-17 15:00:00', NOW()),
(6, 5, 'diterima', 'Pesanan diterima', 3, '2024-12-14 09:00:00', NOW()),
(7, 5, 'dalam_proses', 'Proses repair jahitan', 3, '2024-12-14 11:00:00', NOW()),
(8, 5, 'selesai', 'Jahitan sudah diperbaiki', 3, '2024-12-20 14:00:00', NOW()),
(9, 5, 'sudah_diambil', 'Pelanggan sudah mengambil', 3, '2024-12-20 16:00:00', NOW());

-- 14. FEEDBACK PELANGGAN
INSERT INTO `feedback_pelanggan` (`id_feedback`, `id_pesanan`, `id_pelanggan`, `rating`, `komentar`, `tgl_feedback`, `created_at`) VALUES
(1, 3, 3, 5, 'Hasil cuci sangat bersih, cepat selesainya!', '2024-12-17 16:00:00', NOW()),
(2, 5, 5, 4, 'Jahitan sudah rapi, tapi agak lama prosesnya', '2024-12-20 17:00:00', NOW()),
(3, 9, 9, 5, 'Sepatu seperti baru lagi! Sangat puas dengan full treatment', '2024-12-22 16:00:00', NOW());

-- 15. PEMASUKAN (Income)
INSERT INTO `pemasukan` (`id_pemasukan`, `id_cabang`, `nama_transaksi`, `kategori`, `jumlah`, `tgl_transaksi`, `id_pesanan`, `keterangan`, `id_karyawan`, `created_at`) VALUES
(1, 1, 'Pembayaran Pesanan #3', 'pesanan', 25000.00, '2024-12-17', 3, 'Pembayaran pesanan KX-20241215-001', 1, NOW()),
(2, 2, 'Pembayaran Pesanan #5', 'pesanan', 75000.00, '2024-12-20', 5, 'Pembayaran pesanan KX-20241214-001', 3, NOW()),
(3, 4, 'Pembayaran Pesanan #9', 'pesanan', 150000.00, '2024-12-22', 9, 'Pembayaran pesanan KX-20241213-001', NULL, NOW());

-- 16. PENGELUARAN (Expenses)
INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_cabang`, `nama_transaksi`, `kategori`, `jumlah`, `tgl_transaksi`, `keterangan`, `id_karyawan`, `created_at`) VALUES
(1, 1, 'Restock Sabun Cuci', 'bahan', 250000.00, '2024-12-15', 'Restock sabun cuci 10 botol', 1, NOW()),
(2, 1, 'Tagihan Listrik', 'operasional', 100000.00, '2024-12-01', 'Tagihan listrik Desember', NULL, NOW()),
(3, 2, 'Restock Whitening', 'bahan', 200000.00, '2024-12-10', 'Restock whitening solution', 3, NOW()),
(4, 3, 'Gaji Karyawan', 'gaji', 500000.00, '2024-12-15', 'Gaji karyawan minggu 2', NULL, NOW()),
(5, 4, 'Beli Dryer Pad', 'perlengkapan', 150000.00, '2024-12-12', 'Beli dryer pad baru', NULL, NOW());

-- ============================================
-- DONE!
-- ============================================
SELECT 'Database reset and dummy data insertion completed!' as Result;
