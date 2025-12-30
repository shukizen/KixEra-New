<?php
// Check notifikasi table columns
$conn = new mysqli('localhost', 'root', '', 'kixera_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

echo "TABLE: notifikasi\n";
$result = $conn->query("SHOW COLUMNS FROM notifikasi");
if ($result) {
    while($row = $result->fetch_assoc()) echo $row['Field'] . "\n";
} else {
    echo "Error showing notifikasi: " . $conn->error . "\n";
}
$conn->close();
