<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Load database
        $this->load->database();
        
        // Load models
        $this->load->model('Paket_langganan_model');
        $this->load->model('Transaksi_langganan_model');
        $this->load->model('Owner_model');
        
        // Load libraries
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('midtrans_lib');
        
        // Load helpers
        $this->load->helper('url');
        $this->load->helper('form');
    }
    
    /**
     * Halaman utama pembayaran (redirect ke landing page)
     */
    public function index() {
        redirect('landingpage');
    }
    
    /**
     * Debug endpoint - HAPUS SETELAH SELESAI DEBUG
     * Akses via: /pembayaran/debug_payment
     */
    public function debug_payment() {
        header('Content-Type: application/json');
        
        $debug_info = [
            'timestamp' => date('Y-m-d H:i:s'),
            'checks' => []
        ];
        
        // 1. Check database connection
        try {
            $this->db->simple_query('SELECT 1');
            $debug_info['checks']['database_connection'] = 'OK';
        } catch (Exception $e) {
            $debug_info['checks']['database_connection'] = 'FAILED: ' . $e->getMessage();
        }
        
        // 2. Check if transaksi_langganan table exists
        $table_exists = $this->db->table_exists('transaksi_langganan');
        $debug_info['checks']['table_transaksi_langganan'] = $table_exists ? 'EXISTS' : 'NOT EXISTS';
        
        // 3. Check table columns if exists
        if ($table_exists) {
            $fields = $this->db->list_fields('transaksi_langganan');
            $debug_info['checks']['table_columns'] = $fields;
            
            // Check required columns
            $required_columns = ['id_pemilik', 'id_paket', 'tgl_transaksi', 'jumlah_bayar', 
                                 'metode_pembayaran', 'status_pembayaran', 'kode_pembayaran',
                                 'tgl_mulai_langganan', 'tgl_akhir_langganan'];
            $missing = array_diff($required_columns, $fields);
            $debug_info['checks']['missing_columns'] = empty($missing) ? 'NONE' : $missing;
        }
        
        // 4. Check paket_langganan table
        $paket_exists = $this->db->table_exists('paket_langganan');
        $debug_info['checks']['table_paket_langganan'] = $paket_exists ? 'EXISTS' : 'NOT EXISTS';
        
        // 5. Check pemilik table
        $pemilik_exists = $this->db->table_exists('pemilik');
        $debug_info['checks']['table_pemilik'] = $pemilik_exists ? 'EXISTS' : 'NOT EXISTS';
        
        // 6. Check if paket with id=1 exists (for testing)
        if ($paket_exists) {
            $test_paket = $this->Paket_langganan_model->get_by_id(1);
            $debug_info['checks']['paket_id_1'] = $test_paket ? 'EXISTS' : 'NOT EXISTS';
        }
        
        // 7. Check Midtrans config
        $debug_info['checks']['midtrans_server_key'] = $this->config->item('midtrans_server_key') ? 'SET' : 'NOT SET';
        $debug_info['checks']['midtrans_client_key'] = $this->config->item('midtrans_client_key') ? 'SET' : 'NOT SET';
        $debug_info['checks']['midtrans_api_url'] = $this->config->item('midtrans_api_url') ?: 'NOT SET';
        
        // 8. Check if curl is available
        $debug_info['checks']['curl_available'] = function_exists('curl_init') ? 'YES' : 'NO';
        
        echo json_encode($debug_info, JSON_PRETTY_PRINT);
    }
    
    /**
     * Halaman checkout untuk paket tertentu
     * @param int $id_paket
     */
    public function checkout($id_paket = null) {
        // Validasi id_paket
        if (!$id_paket || !is_numeric($id_paket)) {
            $this->session->set_flashdata('error', 'Paket tidak valid');
            redirect('landingpage#pricing');
        }
        
        // ================================================================
        // CEK LOGIN - DINONAKTIFKAN SEMENTARA UNTUK TESTING MIDTRANS
        // Uncomment kode di bawah setelah login system siap
        // ================================================================
        if (!$this->session->userdata('logged_in')) {
            // Simpan intended URL untuk redirect setelah login
            $this->session->set_userdata('intended_url', current_url());
            $this->session->set_flashdata('info', 'Silakan login terlebih dahulu untuk melanjutkan pembelian paket.');
            redirect('auth/login');
        }
        
        // Ambil data paket dari database
        $paket = $this->Paket_langganan_model->get_by_id($id_paket);
        
        if (!$paket) {
            $this->session->set_flashdata('error', 'Paket tidak ditemukan');
            redirect('landingpage#pricing');
        }
        
        // Cek status paket
        if ($paket->status != 'aktif') {
            $this->session->set_flashdata('error', 'Paket tidak tersedia');
            redirect('landingpage#pricing');
        }
        
        // Data untuk view
        $data = [
            'title' => 'Checkout - ' . $paket->nama_paket,
            'paket' => $paket,
            'invoice_number' => $this->generate_invoice_number(),
            'invoice_date' => date('Y-m-d'),
            'customer' => $this->get_customer_data(),
            'midtrans_client_key' => $this->midtrans_lib->get_client_key(),
            'midtrans_snap_url' => $this->midtrans_lib->get_snap_url()
        ];
        
        // Load view
        $this->load->view('pembayaran/checkout', $data);
    }
    
    /**
     * Create Snap Token untuk Midtrans
     * (Called via AJAX)
     */
    public function create_snap_token() {
        // Set JSON header
        header('Content-Type: application/json');
        
        try {
            // Validasi request method
            if ($this->input->method() !== 'post') {
                echo json_encode(['success' => false, 'message' => 'Invalid request method']);
                return;
            }
            
            if (!$this->session->userdata('logged_in')) {
                echo json_encode(['success' => false, 'message' => 'Silakan login terlebih dahulu']);
                return;
            }
            
            // Ambil data dari form
            $id_paket = $this->input->post('id_paket');
            $durasi_bulan = $this->input->post('durasi_bulan') ?: 1;
            
            // Ambil data paket
            $paket = $this->Paket_langganan_model->get_by_id($id_paket);
            
            if (!$paket) {
                echo json_encode(['success' => false, 'message' => 'Paket tidak ditemukan']);
                return;
            }
            
            // Hitung total harga
            $harga = floatval($paket->harga);
            $total = $harga * intval($durasi_bulan);
            
            // Generate unique order ID
            $order_id = 'KIX-' . date('YmdHis') . '-' . mt_rand(1000, 9999);
            
            // Simpan transaksi pending ke database
            // Untuk testing, gunakan id_pemilik = 1 jika belum login
            $data_transaksi = [
                'id_pemilik' => $this->session->userdata('id_pemilik'),
                'id_paket' => $id_paket,
                'tgl_transaksi' => date('Y-m-d H:i:s'),
                'jumlah_bayar' => $total,
                'metode_pembayaran' => 'midtrans',
                'status_pembayaran' => 'pending',
                'kode_pembayaran' => $order_id,
                'tgl_mulai_langganan' => date('Y-m-d'),
                'tgl_akhir_langganan' => date('Y-m-d', strtotime("+{$durasi_bulan} months")),
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $id_transaksi = $this->Transaksi_langganan_model->insert($data_transaksi);
            
            if (!$id_transaksi) {
                echo json_encode(['success' => false, 'message' => 'Gagal membuat transaksi']);
                return;
            }
            
            // Siapkan data customer
            $customer = $this->get_customer_data();
            
            // Transaction details untuk Midtrans
            $transaction_details = [
                'order_id' => $order_id,
                'gross_amount' => intval($total) // Midtrans requires integer
            ];
            
            // Customer details untuk Midtrans
            $customer_details = [
                'first_name' => $customer['nama'],
                'email' => $customer['email'],
                'phone' => $customer['telp']
            ];
            
            // Item details untuk Midtrans
            $item_details = [
                [
                    'id' => 'PKT-' . $id_paket,
                    'price' => intval($harga),
                    'quantity' => intval($durasi_bulan),
                    'name' => $paket->nama_paket . ' (' . $durasi_bulan . ' Bulan)'
                ]
            ];
            
            // Get Snap Token dari Midtrans
            $snap_response = $this->midtrans_lib->get_snap_token(
                $transaction_details,
                $customer_details,
                $item_details
            );
            
            if ($snap_response['success']) {
                echo json_encode([
                    'success' => true,
                    'snap_token' => $snap_response['snap_token'],
                    'order_id' => $order_id,
                    'id_transaksi' => $id_transaksi
                ]);
            } else {
                // Rollback - hapus transaksi yang sudah dibuat
                $this->Transaksi_langganan_model->delete($id_transaksi);
                
                $error_msg = isset($snap_response['error']) && is_array($snap_response['error']) 
                    ? implode(', ', $snap_response['error']) 
                    : 'Unknown error';
                
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal membuat pembayaran: ' . $error_msg
                ]);
            }
        } catch (Exception $e) {
            log_message('error', 'create_snap_token error: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Handle notification dari Midtrans (Webhook)
     */
    public function notification() {
        // Get raw POST data
        $raw_input = file_get_contents('php://input');
        $notification = json_decode($raw_input);
        
        if (!$notification) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid notification data']);
            return;
        }
        
        // Verify notification dengan Midtrans API
        $verified = $this->midtrans_lib->verify_notification($notification);
        
        if (!$verified) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Failed to verify notification']);
            return;
        }
        
        // Get order ID dan status
        $order_id = $verified->order_id;
        $transaction_status = $verified->transaction_status;
        $fraud_status = $verified->fraud_status ?? null;
        
        // Map status ke status internal
        $status = $this->midtrans_lib->map_transaction_status($transaction_status, $fraud_status);
        
        // Cari transaksi berdasarkan kode_pembayaran (order_id)
        $transaksi = $this->Transaksi_langganan_model->get_by_payment_code($order_id);
        
        if ($transaksi) {
            // Update status transaksi
            $this->Transaksi_langganan_model->update_status($transaksi->id_transaksi_langganan, $status);
            
            // Jika pembayaran sukses, aktifkan langganan user
            if ($status == 'sukses') {
                $this->Owner_model->activateSubscription($transaksi->id_pemilik, $transaksi->id_paket);
                log_message('info', "Subscription activated for Owner ID: {$transaksi->id_pemilik}, Paket ID: {$transaksi->id_paket}");
            }

            // Log untuk debugging
            log_message('info', "Midtrans notification: Order {$order_id} status {$status}");
        }
        
        http_response_code(200);
        echo json_encode(['status' => 'ok']);
    }
    
    /**
     * Callback setelah pembayaran selesai (redirect dari Midtrans)
     */
    public function finish() {
        $order_id = $this->input->get('order_id');
        $status_code = $this->input->get('status_code');
        $transaction_status = $this->input->get('transaction_status');
        
        // Cari transaksi
        if ($order_id) {
            $transaksi = $this->Transaksi_langganan_model->get_by_payment_code($order_id);
            
            if ($transaksi) {
                $paket = $this->Paket_langganan_model->get_by_id($transaksi->id_paket);
                
                $data = [
                    'title' => 'Pembayaran Berhasil',
                    'transaksi' => $transaksi,
                    'paket' => $paket,
                    'status' => $transaction_status
                ];
                
                $this->load->view('pembayaran/finish', $data);
                return;
            }
        }
        
        // Jika tidak menemukan transaksi
        $this->session->set_flashdata('info', 'Pembayaran Anda sedang diproses.');
        redirect('landingpage');
    }
    
    /**
     * Callback jika pembayaran pending
     */
    public function unfinish() {
        $this->session->set_flashdata('info', 'Pembayaran Anda belum selesai. Silakan selesaikan pembayaran.');
        redirect('landingpage');
    }
    
    /**
     * Callback jika terjadi error
     */
    public function error() {
        $this->session->set_flashdata('error', 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
        redirect('landingpage#pricing');
    }
    
    /**
     * Proses pembayaran (legacy - untuk compatibility)
     */
    public function process() {
        // Redirect ke halaman pricing
        $this->session->set_flashdata('info', 'Silakan gunakan pembayaran via Midtrans.');
        redirect('landingpage#pricing');
    }
    
    /**
     * Halaman konfirmasi pembayaran
     * @param int $id_transaksi
     */
    public function konfirmasi($id_transaksi = null) {
        if (!$id_transaksi) {
            redirect('landingpage');
        }
        
        // Ambil data transaksi
        $transaksi = $this->Transaksi_langganan_model->get_by_id($id_transaksi);
        
        if (!$transaksi) {
            $this->session->set_flashdata('error', 'Transaksi tidak ditemukan');
            redirect('landingpage');
        }
        
        // Ambil data paket
        $paket = $this->Paket_langganan_model->get_by_id($transaksi->id_paket);
        
        $data = [
            'title' => 'Konfirmasi Pembayaran',
            'transaksi' => $transaksi,
            'paket' => $paket
        ];
        
        $this->load->view('pembayaran/konfirmasi', $data);
    }
    
    /**
     * Generate nomor invoice unik
     * @return string
     */
    private function generate_invoice_number() {
        $prefix = 'INV';
        $date = date('Ymd');
        $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        return $prefix . '-' . $date . '-' . $random;
    }
    
    /**
     * Generate kode pembayaran unik
     * @return string
     */
    private function generate_payment_code() {
        return 'PAY' . date('YmdHis') . mt_rand(1000, 9999);
    }
    
    /**
     * Get data customer dari session
     * @return array
     */
    private function get_customer_data() {
        // Jika user sudah login, ambil dari session
        if ($this->session->userdata('logged_in')) {
            return [
                'nama' => $this->session->userdata('nama_pemilik') ?? 'Guest User',
                'email' => $this->session->userdata('email') ?? 'guest@example.com',
                'telp' => $this->session->userdata('telp') ?? '-',
                'alamat' => $this->session->userdata('alamat') ?? '-'
            ];
        }
        
        // Default data jika belum login
        return [
            'nama' => 'Guest User',
            'email' => 'guest@example.com',
            'telp' => '-',
            'alamat' => '-'
        ];
    }
    
    /**
     * Get data paket berdasarkan ID (untuk AJAX)
     */
    public function get_paket($id_paket) {
        $paket = $this->Paket_langganan_model->get_by_id($id_paket);
        
        if ($paket) {
            echo json_encode(['success' => true, 'data' => $paket]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Paket tidak ditemukan']);
        }
    }
}