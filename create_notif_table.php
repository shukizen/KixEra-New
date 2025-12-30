<?php
// Create notifikasi table
$conn = new mysqli('localhost', 'root', '', 'kixera_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "CREATE TABLE IF NOT EXISTS notifikasi (
    id_notifikasi INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('admin', 'pemilik', 'karyawan') NOT NULL DEFAULT 'pemilik',
    id_user INT NULL,
    judul VARCHAR(255) NOT NULL,
    pesan TEXT NOT NULL,
    link VARCHAR(255) NULL,
    status ENUM('unread', 'read') NOT NULL DEFAULT 'unread',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL,
    deleted_at DATETIME NULL,
    INDEX (type),
    INDEX (id_user),
    INDEX (status)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'notifikasi' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();
