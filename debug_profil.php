<?php
$conn = new mysqli('localhost', 'root', '', 'kixera_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$id_user = 8; // Based on error log "ID: #8"

echo "Checking User ID: $id_user\n";

$result = $conn->query("SELECT * FROM users WHERE id_user = $id_user");
if ($result->num_rows > 0) {
    echo "Found in USERS table:\n";
    print_r($result->fetch_assoc());
} else {
    echo "NOT FOUND in USERS table.\n";
}

$result = $conn->query("SELECT * FROM admin WHERE id_user = $id_user");
if ($result->num_rows > 0) {
    echo "Found in ADMIN table:\n";
    print_r($result->fetch_assoc());
} else {
    echo "NOT FOUND in ADMIN table.\n";
}

$conn->close();
