<?php
// Script to check columns in pesanan table
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'kixera_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tables = ['pesanan', 'pemasukan', 'bukti_transaksi'];
foreach($tables as $table) {
    echo "\nTABLE: $table\n";
    $result = $conn->query("SHOW COLUMNS FROM $table");
    if ($result) {
        while($row = $result->fetch_assoc()) {
            echo $row['Field'] . " (" . $row['Type'] . ")\n";
        }
    } else {
        echo "Error: " . $conn->error . "\n";
    }
}
$conn->close();
