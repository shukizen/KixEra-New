-- Create notifications table for dynamic notification system
CREATE TABLE IF NOT EXISTS notifications (
    id_notification INT AUTO_INCREMENT PRIMARY KEY,
    id_pemilik INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    message TEXT,
    type ENUM('order', 'payment', 'pickup', 'general') DEFAULT 'general',
    related_id INT NULL COMMENT 'ID pesanan/transaksi terkait',
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    read_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (id_pemilik) REFERENCES pemilik(id_pemilik) ON DELETE CASCADE,
    INDEX idx_pemilik_read (id_pemilik, is_read),
    INDEX idx_created (created_at DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert some sample notifications for testing
-- Note: Replace id_pemilik with actual owner IDs from your database
INSERT INTO notifications (id_pemilik, title, message, type, related_id, is_read) 
SELECT 
    p.id_pemilik,
    'Selamat datang di KixEra!',
    'Sistem notifikasi telah aktif. Anda akan menerima notifikasi untuk setiap aktivitas penting.',
    'general',
    NULL,
    0
FROM pemilik p
WHERE p.deleted_at IS NULL
LIMIT 5;
