<?php
$conn = new mysqli('localhost', 'root', '', 'kixera_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check cabang table
echo "--- CABANG TABLE ---\n";
$result = $conn->query("DESCRIBE cabang");
if ($result) {
    while($row = $result->fetch_assoc()) {
        echo $row['Field'] . " (" . $row['Type'] . ")\n";
    }
} else {
    echo "Error describing cabang: " . $conn->error . "\n";
}

// Check activity_log table just in case
echo "\n--- ACTIVITY_LOG TABLE ---\n";
$result = $conn->query("DESCRIBE activity_log");
if ($result) {
    while($row = $result->fetch_assoc()) {
        echo $row['Field'] . " (" . $row['Type'] . ")\n";
    }
} else {
    echo "Error describing activity_log: " . $conn->error . "\n";
}
?>
