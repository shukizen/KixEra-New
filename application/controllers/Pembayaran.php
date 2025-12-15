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
        /*
        if (!$this->session->userdata('logged_in')) {
            // Simpan intended URL untuk redirect setelah login
            $this->session->set_userdata('intended_url', current_url());
            $this->session->set_flashdata('info', 'Silakan login terlebih dahulu untuk melanjutkan pembelian paket.');
            redirect('auth/login');
        }
        */
        
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
        // Validasi request method
        if ($this->input->method() !== 'post') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }
        
        // Cek login - DINONAKTIFKAN SEMENTARA UNTUK TESTING
        /*
        if (!$this->session->userdata('logged_in')) {
            echo json_encode(['success' => false, 'message' => 'Silakan login terlebih dahulu']);
            return;
        }
        */
        
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
            'id_pemilik' => $this->session->userdata('id_pemilik') ?: 1,
            'id_paket' => $id_paket,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'jumlah_bayar' => $total,
            'metode_pembayaran' => 'midtrans',
            'status_pembayaran' => 'pending',
            'kode_pembayaran' => $order_id,
            'tgl_mulai_langganan' => date('Y-m-d'),
            'tgl_akhir_langganan' => date('Y-m-d', strtotime("+{$durasi_bulan} months"))
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
            
            echo json_encode([
                'success' => false,
                'message' => 'Gagal membuat pembayaran: ' . implode(', ', $snap_response['error'])
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