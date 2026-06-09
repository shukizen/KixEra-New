-- Script Dummy Data Pesanan Lengkap untuk Filter Status
-- Menghubungkan pesanan ke Baskara Putra agar muncul di dashboardnya

-- 1. Ambil ID referensi
SET @karyawan_id = (SELECT id_karyawan FROM karyawan WHERE nama = 'Baskara Putra' LIMIT 1);
SET @cabang_id = (SELECT id_cabang FROM karyawan WHERE nama = 'Baskara Putra' LIMIT 1);
SET @pelanggan_id = (SELECT id_pelanggan FROM pelanggan LIMIT 1);
SET @layanan_id = (SELECT id_layanan FROM layanan LIMIT 1);

-- 2. Hapus data pesanan lama milik Baskara agar bersih saat testing filter (Opsional)
DELETE FROM detail_pesanan WHERE id_pesanan IN (SELECT id_pesanan FROM pesanan WHERE id_karyawan = @karyawan_id);
DELETE FROM pesanan WHERE id_karyawan = @karyawan_id;

-- 3. Insert Pesanan untuk SETIAP status yang ada di enum status_pesanan

-- Status: diterima
INSERT INTO `pesanan` (`id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, `nomor_pesanan`, `tgl_masuk`, `jumlah_item`, `total_harga`, `status_pembayaran`, `status_pesanan`, `catatan`) 
VALUES (@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'FIL-001', NOW(), 1, 30000.00, 'belum_bayar', 'diterima', 'Filter Test: Diterima');

-- Status: dalam_proses
INSERT INTO `pesanan` (`id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, `nomor_pesanan`, `tgl_masuk`, `jumlah_item`, `total_harga`, `status_pembayaran`, `status_pesanan`, `catatan`) 
VALUES (@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'FIL-002', DATE_SUB(NOW(), INTERVAL 1 DAY), 1, 35000.00, 'sudah_bayar', 'dalam_proses', 'Filter Test: Dalam Proses');

-- Status: selesai
INSERT INTO `pesanan` (`id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, `nomor_pesanan`, `tgl_masuk`, `tgl_selesai`, `jumlah_item`, `total_harga`, `status_pembayaran`, `status_pesanan`, `catatan`) 
VALUES (@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'FIL-003', DATE_SUB(NOW(), INTERVAL 2 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY), 1, 40000.00, 'sudah_bayar', 'selesai', 'Filter Test: Selesai');

-- Status: siap_diambil
INSERT INTO `pesanan` (`id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, `nomor_pesanan`, `tgl_masuk`, `tgl_selesai`, `jumlah_item`, `total_harga`, `status_pembayaran`, `status_pesanan`, `catatan`) 
VALUES (@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'FIL-004', DATE_SUB(NOW(), INTERVAL 3 DAY), DATE_SUB(NOW(), INTERVAL 2 DAY), 1, 50000.00, 'sudah_bayar', 'siap_diambil', 'Filter Test: Siap Diambil');

-- Status: sudah_diambil
INSERT INTO `pesanan` (`id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, `nomor_pesanan`, `tgl_masuk`, `tgl_diambil`, `jumlah_item`, `total_harga`, `status_pembayaran`, `status_pesanan`, `catatan`) 
VALUES (@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'FIL-005', DATE_SUB(NOW(), INTERVAL 5 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY), 1, 60000.00, 'sudah_bayar', 'sudah_diambil', 'Filter Test: Sudah Diambil');

-- Status: dibatalkan
INSERT INTO `pesanan` (`id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, `nomor_pesanan`, `tgl_masuk`, `jumlah_item`, `total_harga`, `status_pembayaran`, `status_pesanan`, `catatan`) 
VALUES (@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'FIL-006', DATE_SUB(NOW(), INTERVAL 1 DAY), 1, 0.00, 'belum_bayar', 'dibatalkan', 'Filter Test: Dibatalkan');

-- Tampilkan rekapan hasil
SELECT 'Data Pesanan Filter Berhasil Dibuat' as Status;
SELECT status_pesanan, count(*) as Jumlah FROM pesanan WHERE id_karyawan = @karyawan_id GROUP BY status_pesanan;
