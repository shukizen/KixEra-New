-- Script Dummy Data Pesanan untuk Karyawan: Baskara Putra
-- Menghubungkan pesanan ke Baskara Putra dan Cabang tempat dia bekerja

-- 1. Ambil ID Karyawan dan ID Cabang Baskara Putra
SET @karyawan_id = (SELECT id_karyawan FROM karyawan WHERE nama = 'Baskara Putra' LIMIT 1);
SET @cabang_id = (SELECT id_cabang FROM karyawan WHERE nama = 'Baskara Putra' LIMIT 1);
SET @pelanggan_id = (SELECT id_pelanggan FROM pelanggan LIMIT 1);
SET @layanan_id = (SELECT id_layanan FROM layanan LIMIT 1);

-- 2. Hapus data pesanan lama milik Baskara (untuk bersih-bersih testing)
-- DELETE FROM pesanan WHERE id_karyawan = @karyawan_id;

-- 3. Insert Pesanan 1: Status Diterima (Hari ini)
INSERT INTO `pesanan` (
    `id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, 
    `nomor_pesanan`, `tgl_masuk`, `tgl_estimasi_selesai`, 
    `jumlah_item`, `total_harga`, `status_pembayaran`, `status_pesanan`, `catatan`
) VALUES (
    @cabang_id, @pelanggan_id, @layanan_id, @karyawan_id,
    CONCAT('ORD-', DATE_FORMAT(NOW(), '%y%m%d'), '-001'), NOW(), DATE_ADD(NOW(), INTERVAL 3 DAY),
    1, 35000.00, 'belum_bayar', 'diterima', 'Cuci Deep Clean sepatu Nike'
);
SET @pesanan_id_1 = LAST_INSERT_ID();

INSERT INTO `detail_pesanan` (`id_pesanan`, `id_layanan`, `jenis_sepatu`, `warna`, `kondisi_awal`)
VALUES (@pesanan_id_1, @layanan_id, 'Nike Air Jordan', 'Putih', 'Kotor pekat di bagian outsole');

-- 4. Insert Pesanan 2: Status Dalam Proses
INSERT INTO `pesanan` (
    `id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, 
    `nomor_pesanan`, `tgl_masuk`, `tgl_estimasi_selesai`, 
    `jumlah_item`, `total_harga`, `status_pembayaran`, `status_pesanan`, `catatan`
) VALUES (
    @cabang_id, @pelanggan_id, @layanan_id, @karyawan_id,
    CONCAT('ORD-', DATE_FORMAT(NOW(), '%y%m%d'), '-002'), DATE_SUB(NOW(), INTERVAL 1 DAY), DATE_ADD(NOW(), INTERVAL 2 DAY),
    1, 50000.00, 'sudah_bayar', 'dalam_proses', 'Unyellowing'
);
SET @pesanan_id_2 = LAST_INSERT_ID();

INSERT INTO `detail_pesanan` (`id_pesanan`, `id_layanan`, `jenis_sepatu`, `warna`, `kondisi_awal`)
VALUES (@pesanan_id_2, @layanan_id, 'Adidas Stan Smith', 'Putih/Hijau', 'Midsole sangat menguning');

-- 5. Insert Pesanan 3: Status Selesai (Siap Diambil)
INSERT INTO `pesanan` (
    `id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, 
    `nomor_pesanan`, `tgl_masuk`, `tgl_estimasi_selesai`, `tgl_selesai`,
    `jumlah_item`, `total_harga`, `status_pembayaran`, `status_pesanan`, `catatan`
) VALUES (
    @cabang_id, @pelanggan_id, @layanan_id, @karyawan_id,
    CONCAT('ORD-', DATE_FORMAT(NOW(), '%y%m%d'), '-003'), DATE_SUB(NOW(), INTERVAL 3 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY),
    2, 70000.00, 'sudah_bayar', 'siap_diambil', 'Epress Service'
);
SET @pesanan_id_3 = LAST_INSERT_ID();

INSERT INTO `detail_pesanan` (`id_pesanan`, `id_layanan`, `jenis_sepatu`, `warna`, `kondisi_awal`)
VALUES (@pesanan_id_3, @layanan_id, 'Converse All Star', 'Hitam', 'Berdebu kental');

-- Tampilkan rekapan
SELECT 'Pesanan Berhasil Dibuat untuk Baskara Putra' as Info;
SELECT nomor_pesanan, status_pesanan, total_harga FROM pesanan WHERE id_karyawan = @karyawan_id;
