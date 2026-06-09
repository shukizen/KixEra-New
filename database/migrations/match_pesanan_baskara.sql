-- Script Reset & Match Data Pesanan Baskara Putra
-- Menyesuaikan pesanan agar terhubung ke Cabang 8 dan Pemilik 4 (Owner cabang tersebut)

-- 1. Definisikan ID target
SET @karyawan_id = 86; -- Baskara Putra
SET @cabang_id = 8;    -- Cabang Seturan
SET @pelanggan_id = 33; -- Pelanggan Baru di Cabang 8
SET @layanan_id = 11;   -- Layanan milik Pemilik 4

-- 2. Bersihkan pesanan lama Baskara
DELETE FROM detail_pesanan WHERE id_pesanan IN (SELECT id_pesanan FROM pesanan WHERE id_karyawan = @karyawan_id);
DELETE FROM pesanan WHERE id_karyawan = @karyawan_id;

-- 3. Masukkan data yang sudah MATCH dengan struktur Pemilik & Cabang
INSERT INTO `pesanan` (`id_cabang`, `id_pelanggan`, `id_layanan`, `id_karyawan`, `nomor_pesanan`, `tgl_masuk`, `jumlah_item`, `total_harga`, `status_pembayaran`, `status_pesanan`, `catatan`) 
VALUES 
(@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'MATCH-001', NOW(), 1, 30000.00, 'belum_bayar', 'diterima', 'Match Test: Diterima'),
(@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'MATCH-002', DATE_SUB(NOW(), INTERVAL 1 DAY), 1, 35000.00, 'sudah_bayar', 'dalam_proses', 'Match Test: Dalam Proses'),
(@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'MATCH-003', DATE_SUB(NOW(), INTERVAL 2 DAY), 1, 40000.00, 'sudah_bayar', 'selesai', 'Match Test: Selesai'),
(@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'MATCH-004', DATE_SUB(NOW(), INTERVAL 3 DAY), 1, 50000.00, 'sudah_bayar', 'siap_diambil', 'Match Test: Siap Diambil'),
(@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'MATCH-005', DATE_SUB(NOW(), INTERVAL 5 DAY), 1, 60000.00, 'sudah_bayar', 'sudah_diambil', 'Match Test: Sudah Diambil'),
(@cabang_id, @pelanggan_id, @layanan_id, @karyawan_id, 'MATCH-006', DATE_SUB(NOW(), INTERVAL 1 DAY), 1, 0.00, 'belum_bayar', 'dibatalkan', 'Match Test: Dibatalkan');

-- 4. Tampilkan Verifikasi
SELECT 
    p.nomor_pesanan, 
    c.nama_cabang, 
    u.username as owner_username,
    p.status_pesanan
FROM pesanan p
JOIN cabang c ON p.id_cabang = c.id_cabang
JOIN pemilik pem ON c.id_pemilik = pem.id_pemilik
JOIN users u ON pem.id_user = u.id_user
WHERE p.id_karyawan = @karyawan_id;
