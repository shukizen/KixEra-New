<?php
$conn = new mysqli('localhost', 'root', '', 'kixera_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Fixing schema...\n";

// 1. Check and add 'alamat' to 'cabang'
$check = $conn->query("SHOW COLUMNS FROM cabang LIKE 'alamat'");
if ($check->num_rows == 0) {
    // Determine position. Try after nama_cabang
    if ($conn->query("ALTER TABLE cabang ADD COLUMN alamat TEXT AFTER nama_cabang")) {
        echo "SUCCESS: Added 'alamat' to 'cabang'.\n";
    } else {
        // Fallback: add at end
        if ($conn->query("ALTER TABLE cabang ADD COLUMN alamat TEXT")) {
            echo "SUCCESS: Added 'alamat' to 'cabang' (at end).\n";
        } else {
            echo "ERROR: Could not add 'alamat': " . $conn->error . "\n";
        }
    }
} else {
    echo "INFO: 'alamat' already exists in 'cabang'.\n";
}

// 2. Check and add 'no_telp' to 'cabang'
$check = $conn->query("SHOW COLUMNS FROM cabang LIKE 'no_telp'");
if ($check->num_rows == 0) {
    if ($conn->query("ALTER TABLE cabang ADD COLUMN no_telp VARCHAR(20) AFTER alamat")) {
        echo "SUCCESS: Added 'no_telp' to 'cabang'.\n";
    } else {
        if ($conn->query("ALTER TABLE cabang ADD COLUMN no_telp VARCHAR(20)")) {
            echo "SUCCESS: Added 'no_telp' to 'cabang' (at end).\n";
        } else {
            echo "ERROR: Could not add 'no_telp': " . $conn->error . "\n";
        }
    }
} else {
    echo "INFO: 'no_telp' already exists in 'cabang'.\n";
}

echo "Schema fix complete.\n";
?>
