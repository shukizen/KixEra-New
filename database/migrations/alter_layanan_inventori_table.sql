-- Alter table layanan_inventori to change column jenis_item to nama_item
ALTER TABLE layanan_inventori CHANGE COLUMN jenis_item nama_item VARCHAR(255) NOT NULL COMMENT 'Nama item inventori spesifik, misal: Sabun Premium Sneakers';
