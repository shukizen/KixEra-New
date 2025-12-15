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
            'customer' => $this->get_customer_data() // Dari session jika sudah login
        ];
        
        // Load view
        $this->load->view('pembayaran/checkout', $data);
    }
    
    /**
     * Proses pembayaran
     */
    public function process() {
        // Validasi request method
        if ($this->input->method() !== 'post') {
            show_404();
        }
        
        // Ambil data dari form
        $id_paket = $this->input->post('id_paket');
        $durasi_bulan = $this->input->post('durasi_bulan');
        $metode_pembayaran = $this->input->post('metode_pembayaran');
        $jumlah_bayar = $this->input->post('jumlah_bayar');
        
        // Validasi input
        $this->form_validation->set_rules('id_paket', 'Paket', 'required|numeric');
        $this->form_validation->set_rules('durasi_bulan', 'Durasi', 'required|numeric');
        $this->form_validation->set_rules('metode_pembayaran', 'Metode Pembayaran', 'required');
        $this->form_validation->set_rules('jumlah_bayar', 'Jumlah Bayar', 'required|numeric');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('pembayaran/checkout/' . $id_paket);
        }
        
        // Ambil data paket
        $paket = $this->Paket_langganan_model->get_by_id($id_paket);
        
        if (!$paket) {
            $this->session->set_flashdata('error', 'Paket tidak ditemukan');
            redirect('landingpage#pricing');
        }
        
        // Hitung tanggal mulai dan akhir langganan
        $tgl_mulai = date('Y-m-d');
        $tgl_akhir = date('Y-m-d', strtotime("+{$durasi_bulan} months"));
        
        // Generate kode pembayaran unik
        $kode_pembayaran = $this->generate_payment_code();
        
        // Data transaksi
        $data_transaksi = [
            'id_pemilik' => $this->session->userdata('id_pemilik') ?? 1, // Sesuaikan dengan session user
            'id_paket' => $id_paket,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'jumlah_bayar' => $jumlah_bayar,
            'metode_pembayaran' => $metode_pembayaran,
            'status_pembayaran' => 'pending',
            'kode_pembayaran' => $kode_pembayaran,
            'tgl_mulai_langganan' => $tgl_mulai,
            'tgl_akhir_langganan' => $tgl_akhir
        ];
        
        // Simpan transaksi ke database
        $id_transaksi = $this->Transaksi_langganan_model->insert($data_transaksi);
        
        if ($id_transaksi) {
            // Set session untuk halaman konfirmasi
            $this->session->set_flashdata('success', 'Transaksi berhasil dibuat');
            
            // Redirect ke halaman konfirmasi pembayaran
            redirect('pembayaran/konfirmasi/' . $id_transaksi);
        } else {
            $this->session->set_flashdata('error', 'Gagal membuat transaksi');
            redirect('pembayaran/checkout/' . $id_paket);
        }
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
     * Update status pembayaran (untuk simulasi atau webhook payment gateway)
     */
    public function update_status() {
        $id_transaksi = $this->input->post('id_transaksi');
        $status = $this->input->post('status'); // sukses, gagal
        
        if ($id_transaksi && in_array($status, ['sukses', 'gagal'])) {
            $update_data = [
                'status_pembayaran' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->Transaksi_langganan_model->update($id_transaksi, $update_data);
            
            echo json_encode(['success' => true, 'message' => 'Status berhasil diupdate']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data tidak valid']);
        }
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