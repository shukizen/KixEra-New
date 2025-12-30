<?php
$conn = new mysqli('localhost', 'root', '', 'kixera_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'kixera_db' AND TABLE_NAME = 'notifikasi'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    echo "COLUMNS found:\n";
    while($row = $result->fetch_assoc()) {
        echo $row['COLUMN_NAME'] . "\n";
    }
} else {
    echo "Table 'notifikasi' not found or empty columns.\n";
}
$conn->close();
