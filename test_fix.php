<?php
// Simplified test script to verify database column fix
$conn = new mysqli('localhost', 'root', '', 'kixera_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

echo "Testing SQL query with fixed column name...\n";

// Using 'nomor_pesanan' as 'kode_pesanan'
$sql = "SELECT p.id_pemasukan, c.nama_cabang, k.nama as nama_karyawan, ps.nomor_pesanan as kode_pesanan 
        FROM pemasukan p 
        LEFT JOIN cabang c ON c.id_cabang = p.id_cabang 
        LEFT JOIN karyawan k ON k.id_karyawan = p.id_karyawan 
        LEFT JOIN pesanan ps ON ps.id_pesanan = p.id_pesanan 
        WHERE p.deleted_at IS NULL LIMIT 1";

$result = $conn->query($sql);
if ($result) {
    echo "SUCCESS: Query executed without error!\n";
    $row = $result->fetch_assoc();
    if ($row) {
        echo "Data retrieved:\n";
        print_r($row);
    } else {
        echo "Query successful but no data found (table might be empty).\n";
    }
} else {
    echo "FAILURE: SQL Error: " . $conn->error . "\n";
}
$conn->close();
