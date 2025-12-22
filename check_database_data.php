<?php
/**
 * Check Database Data
 * Script untuk cek apakah database punya data atau tidak
 */

// Load CodeIgniter
define('ENVIRONMENT', 'development');
$system_path = 'system';
$application_folder = 'application';

// Path to front controller
$_SERVER['CI_ENV'] = 'development';
require_once 'index.php';

// Get CI instance
$CI =& get_instance();
$CI->load->database();

echo "<h1>📊 Database Data Check</h1>";
echo "<style>
    body { font-family: Arial; max-width: 900px; margin: 50px auto; padding: 20px; }
    table { width: 100%; border-collapse: collapse; margin: 20px 0; }
    th, td { padding: 12px; text-align: left; border: 1px solid #ddd; }
    th { background: #4CAF50; color: white; }
    tr:nth-child(even) { background: #f2f2f2; }
    .success { color: green; }
    .warning { color: orange; }
    .error { color: red; }
</style>";

// Check tables
$tables = [
    'pesanan' => 'SELECT COUNT(*) as total FROM pesanan WHERE deleted_at IS NULL',
    'pelanggan' => 'SELECT COUNT(*) as total FROM pelanggan',
    'keuangan' => 'SELECT COUNT(*) as total FROM keuangan',
    'layanan' => 'SELECT COUNT(*) as total FROM layanan',
    'cabang' => 'SELECT COUNT(*) as total FROM cabang',
    'pemilik' => 'SELECT COUNT(*) as total FROM pemilik',
    'rekomendasi_ai' => 'SELECT COUNT(*) as total FROM rekomendasi_ai'
];

echo "<h2>Jumlah Data per Tabel:</h2>";
echo "<table>";
echo "<tr><th>Tabel</th><th>Jumlah Data</th><th>Status</th></tr>";

$has_data = false;
foreach ($tables as $table => $query) {
    $result = $CI->db->query($query);
    if ($result) {
        $row = $result->row();
        $total = $row->total;
        
        if ($total > 0) {
            $status = "<span class='success'>✓ Ada data</span>";
            $has_data = true;
        } else {
            $status = "<span class='warning'>⚠ Kosong</span>";
        }
        
        echo "<tr>";
        echo "<td><strong>{$table}</strong></td>";
        echo "<td>{$total}</td>";
        echo "<td>{$status}</td>";
        echo "</tr>";
    } else {
        echo "<tr>";
        echo "<td><strong>{$table}</strong></td>";
        echo "<td colspan='2'><span class='error'>✗ Tabel tidak ada</span></td>";
        echo "</tr>";
    }
}

echo "</table>";

// Check if user is logged in as owner
echo "<h2>Session Check:</h2>";
$CI->load->library('session');
$id_pemilik = $CI->session->userdata('id_pemilik');
$user_id = $CI->session->userdata('user_id');

echo "<table>";
echo "<tr><th>Session Variable</th><th>Value</th></tr>";
echo "<tr><td>id_pemilik</td><td>" . ($id_pemilik ?: '<span class="warning">Not set</span>') . "</td></tr>";
echo "<tr><td>user_id</td><td>" . ($user_id ?: '<span class="warning">Not set</span>') . "</td></tr>";
echo "</table>";

// Sample business data
if ($id_pemilik) {
    echo "<h2>Sample Business Data (untuk id_pemilik = {$id_pemilik}):</h2>";
    
    // Load models
    $CI->load->model('Pesanan_model');
    $CI->load->model('Keuangan_model');
    $CI->load->model('Pelanggan_model');
    
    $data = [];
    $data['total_orders_today'] = $CI->Pesanan_model->countOrdersToday($id_pemilik);
    $data['total_orders_month'] = $CI->Pesanan_model->countOrdersThisMonth($id_pemilik);
    
    $revenue_filters = [
        'id_pemilik' => $id_pemilik,
        'bulan' => date('m'),
        'tahun' => date('Y')
    ];
    $data['monthly_revenue'] = $CI->Keuangan_model->get_total_pemasukan($revenue_filters);
    $data['active_customers'] = $CI->Pelanggan_model->countActiveCustomers($id_pemilik);
    $data['pending_pickups'] = $CI->Pesanan_model->countPendingPickups($id_pemilik);
    
    echo "<table>";
    echo "<tr><th>Metric</th><th>Value</th></tr>";
    foreach ($data as $key => $value) {
        echo "<tr><td>{$key}</td><td><strong>{$value}</strong></td></tr>";
    }
    echo "</table>";
} else {
    echo "<p class='warning'>⚠ Anda belum login sebagai pemilik. Login dulu untuk melihat business data.</p>";
}

// Conclusion
echo "<hr>";
echo "<h2>Kesimpulan:</h2>";

if (!$has_data) {
    echo "<p class='error'><strong>❌ Database KOSONG!</strong></p>";
    echo "<p>Anda perlu insert dummy data terlebih dahulu. Jalankan file:</p>";
    echo "<code>database/reset_and_dummy_data.sql</code>";
    echo "<p>Atau buat data manual via aplikasi.</p>";
} else {
    echo "<p class='success'><strong>✓ Database punya data!</strong></p>";
    
    if (!$id_pemilik) {
        echo "<p class='warning'>⚠ Tapi Anda belum login sebagai pemilik.</p>";
        echo "<p>Login dulu di: <a href='" . base_url('auth/login') . "'>" . base_url('auth/login') . "</a></p>";
    } else {
        echo "<p class='success'>✓ Session pemilik OK!</p>";
        echo "<p>Gemini AI siap digunakan! Silakan test generate rekomendasi.</p>";
    }
}
