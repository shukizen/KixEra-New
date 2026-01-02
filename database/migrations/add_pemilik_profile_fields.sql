-- Migration: Add profile fields to existing pemilik table
-- Jalankan di phpMyAdmin satu per satu

-- 1. Rename alamat_usaha to alamat (skip jika sudah)
ALTER TABLE pemilik CHANGE COLUMN alamat_usaha alamat text DEFAULT NULL;

-- 2. Add logo
ALTER TABLE pemilik ADD COLUMN logo varchar(255) NULL AFTER nama_usaha;

-- 3. Add kota (nama kota)
ALTER TABLE pemilik ADD COLUMN kota varchar(100) NULL AFTER alamat;

-- 4. Add kota_code
ALTER TABLE pemilik ADD COLUMN kota_code varchar(10) NULL AFTER kota;

-- 5. Add provinsi (nama provinsi)
ALTER TABLE pemilik ADD COLUMN provinsi varchar(100) NULL AFTER kota_code;

-- 6. Add provinsi_code
ALTER TABLE pemilik ADD COLUMN provinsi_code varchar(10) NULL AFTER provinsi;

-- 7. Add jam_buka
ALTER TABLE pemilik ADD COLUMN jam_buka time DEFAULT '08:00:00' AFTER provinsi_code;

-- 8. Add jam_tutup
ALTER TABLE pemilik ADD COLUMN jam_tutup time DEFAULT '21:00:00' AFTER jam_buka;

-- 9. Add profile_completed
ALTER TABLE pemilik ADD COLUMN profile_completed tinyint(1) DEFAULT 0 AFTER id_paket;
