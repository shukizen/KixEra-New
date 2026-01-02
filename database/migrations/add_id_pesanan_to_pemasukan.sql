ALTER TABLE `pemasukan`
ADD COLUMN `id_pesanan` INT(11) NULL AFTER `id_cabang`,
ADD COLUMN `id_karyawan` INT(11) NULL AFTER `keterangan`;

-- Optional: Add index for better performance
ALTER TABLE `pemasukan` ADD INDEX `idx_pemasukan_pesanan` (`id_pesanan`);
ALTER TABLE `pemasukan` ADD INDEX `idx_pemasukan_karyawan` (`id_karyawan`);
