<?php
$conn = new mysqli('localhost', 'root', '', 'kixera_db');
$result = $conn->query("SHOW COLUMNS FROM pesanan");
while($row = $result->fetch_assoc()) {
    echo $row['Field'] . "\n";
}
