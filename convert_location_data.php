<?php
// Script to convert CSV to JSON for provinsi and kabupaten

// Read provinsi.csv
$provinsi_csv = array_map('str_getcsv', file(__DIR__ . '/provinsi.csv'));
array_shift($provinsi_csv); // Remove header

$provinsi = [];
foreach ($provinsi_csv as $row) {
    if (count($row) >= 3) {
        $provinsi[] = [
            'code' => trim($row[0]),
            'name' => trim($row[2])
        ];
    }
}

// Read kabupaten.csv
$kabupaten_csv = array_map('str_getcsv', file(__DIR__ . '/kabupaten.csv'));
array_shift($kabupaten_csv); // Remove header

$kabupaten = [];
foreach ($kabupaten_csv as $row) {
    if (count($row) >= 3) {
        $parent = trim($row[1]);
        if (!isset($kabupaten[$parent])) {
            $kabupaten[$parent] = [];
        }
        $kabupaten[$parent][] = [
            'code' => trim($row[0]),
            'name' => trim($row[2])
        ];
    }
}

// Create assets/data directory if not exists
$data_dir = __DIR__ . '/assets/data';
if (!is_dir($data_dir)) {
    mkdir($data_dir, 0755, true);
}

// Save JSON files
file_put_contents($data_dir . '/provinsi.json', json_encode($provinsi, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
file_put_contents($data_dir . '/kabupaten.json', json_encode($kabupaten, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Created provinsi.json with " . count($provinsi) . " provinces\n";
echo "Created kabupaten.json with " . count($kabupaten) . " province groups\n";
