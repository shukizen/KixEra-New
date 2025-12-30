<?php
// Simple test file to debug Keuangan API issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

echo "<h1>Keuangan API Debug</h1>";

// Load CodeIgniter
define('BASEPATH', 'c:/xampp/htdocs/KixEra/system/');
define('APPPATH', 'c:/xampp/htdocs/KixEra/application/');
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

// Check session
echo "<h2>Session Data:</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// Check database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'kixera_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
echo "<h2>Database Connected Successfully</h2>";

// Check pemasukan table
echo "<h2>Recent Pemasukan Records:</h2>";
$result = $conn->query("SELECT id_pemasukan, id_cabang, nama_transaksi, kategori, deleted_at FROM pemasukan LIMIT 10");
if ($result && $result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Cabang</th><th>Nama</th><th>Kategori</th><th>Deleted</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_pemasukan'] . "</td>";
        echo "<td>" . $row['id_cabang'] . "</td>";
        echo "<td>" . $row['nama_transaksi'] . "</td>";
        echo "<td>" . $row['kategori'] . "</td>";
        echo "<td>" . ($row['deleted_at'] ?? 'NULL') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No pemasukan records found or query error: " . $conn->error . "</p>";
}

// Check cabang table  
echo "<h2>Cabang Records:</h2>";
$result = $conn->query("SELECT id_cabang, id_pemilik, nama_cabang, status, deleted_at FROM cabang");
if ($result && $result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID Cabang</th><th>ID Pemilik</th><th>Nama</th><th>Status</th><th>Deleted</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_cabang'] . "</td>";
        echo "<td>" . ($row['id_pemilik'] ?? 'NULL') . "</td>";
        echo "<td>" . $row['nama_cabang'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . ($row['deleted_at'] ?? 'NULL') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No cabang records found or query error: " . $conn->error . "</p>";
}

// Check bukti_transaksi table structure
echo "<h2>Bukti Transaksi Table Structure:</h2>";
$result = $conn->query("DESCRIBE bukti_transaksi");
if ($result && $result->num_rows > 0) {
    echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . ($row['Default'] ?? 'NULL') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Could not describe bukti_transaksi: " . $conn->error . "</p>";
}

$conn->close();
