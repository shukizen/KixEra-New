<?php
// Generate hash untuk password123
$hash = password_hash('password123', PASSWORD_DEFAULT);
echo "Hash: " . $hash . "\n";

// Verify
echo "Verify: " . (password_verify('password123', $hash) ? 'OK' : 'FAIL') . "\n";

// Update database
$mysqli = new mysqli('localhost', 'root', '', 'kixera_db');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$escaped_hash = $mysqli->real_escape_string($hash);
$sql = "UPDATE users SET password = '$escaped_hash' WHERE id_user > 0";
if ($mysqli->query($sql) === TRUE) {
    echo "Password updated for " . $mysqli->affected_rows . " users\n";
} else {
    echo "Error: " . $mysqli->error . "\n";
}

$mysqli->close();
echo "Done!\n";
