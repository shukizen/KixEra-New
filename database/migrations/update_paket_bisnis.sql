-- Update nama paket Enterprise menjadi Bisnis
-- Jalankan query ini di phpMyAdmin atau MySQL

UPDATE `paket_langganan` 
SET `nama_paket` = 'Bisnis', 
    `deskripsi` = 'Paket untuk usaha besar',
    `updated_at` = NOW()
WHERE `id_paket` = 3;
