-- ============================================
-- ADD PAYMENT FIELDS TO PESANAN TABLE
-- Generated: 2024-12-24
-- ============================================

-- Add payment method column (tunai, debit, qris)
ALTER TABLE `pesanan` 
ADD COLUMN `metode_pembayaran` ENUM('tunai', 'debit', 'qris') DEFAULT NULL AFTER `total_harga`;

-- Add payment status column (belum_bayar, sudah_bayar)  
ALTER TABLE `pesanan`
ADD COLUMN `status_pembayaran` ENUM('belum_bayar', 'sudah_bayar') DEFAULT 'belum_bayar' AFTER `metode_pembayaran`;

-- Verify columns added
DESCRIBE `pesanan`;

SELECT 'Payment fields added successfully!' as Result;
