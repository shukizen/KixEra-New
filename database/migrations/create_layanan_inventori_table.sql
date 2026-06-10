-- Create layanan_inventori table for linking services with inventory items
CREATE TABLE IF NOT EXISTS layanan_inventori (
    id_layanan_inventori INT AUTO_INCREMENT PRIMARY KEY,
    id_layanan INT NOT NULL,
    jenis_item VARCHAR(100) NOT NULL COMMENT 'Kategori inventori, misal: sabun, parfum, sikat',
    jumlah_dibutuhkan DECIMAL(10,2) NOT NULL DEFAULT 1.00 COMMENT 'Jumlah dikonsumsi per pasang sepatu',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_layanan) REFERENCES layanan(id_layanan) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
