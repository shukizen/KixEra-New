<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_langganan_model extends CI_Model {
    
    private $table = 'transaksi_langganan';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get semua transaksi
     */
    public function get_all() {
        $this->db->select('tl.*, p.nama_paket, p.harga, pm.nama as nama_pemilik');
        $this->db->from($this->table . ' tl');
        $this->db->join('paket_langganan p', 'tl.id_paket = p.id_paket', 'left');
        $this->db->join('pemilik pm', 'tl.id_pemilik = pm.id_pemilik', 'left');
        $this->db->where('tl.deleted_at', NULL);
        $this->db->order_by('tl.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get all transactions with filtering (for admin)
     */
    public function getAllTransactions($filters = []) {
        $this->db->select('tl.*, p.nama_paket, p.harga as harga_paket, pm.nama as nama_pemilik, pm.nama_usaha, pm.email');
        $this->db->from($this->table . ' tl');
        $this->db->join('paket_langganan p', 'tl.id_paket = p.id_paket', 'left');
        $this->db->join('pemilik pm', 'tl.id_pemilik = pm.id_pemilik', 'left');
        $this->db->where('tl.deleted_at', NULL);
        
        if (isset($filters['status']) && !empty($filters['status'])) {
            $this->db->where('tl.status_pembayaran', $filters['status']);
        }
        
        if (isset($filters['search']) && !empty($filters['search'])) {
            $keyword = $filters['search'];
            $this->db->group_start();
            $this->db->like('pm.nama', $keyword);
            $this->db->or_like('pm.nama_usaha', $keyword);
            $this->db->or_like('tl.kode_pembayaran', $keyword);
            $this->db->group_end();
        }
        
        $this->db->order_by('tl.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get transaksi by ID
     */
    public function get_by_id($id) {
        $this->db->select('tl.*, p.nama_paket, p.harga, p.deskripsi, p.durasi_hari as durasi, pm.nama as nama_pemilik, pm.email, pm.no_telp, pm.nama_usaha, pm.alamat_usaha');
        $this->db->from($this->table . ' tl');
        $this->db->join('paket_langganan p', 'tl.id_paket = p.id_paket', 'left');
        $this->db->join('pemilik pm', 'tl.id_pemilik = pm.id_pemilik', 'left');
        $this->db->where('tl.id_transaksi_langganan', $id);
        $this->db->where('tl.deleted_at', NULL);
        return $this->db->get()->row();
    }
    
    /**
     * Get transaksi by user
     */
    public function get_by_user($id_pemilik) {
        $this->db->select('tl.*, p.nama_paket, p.harga');
        $this->db->from($this->table . ' tl');
        $this->db->join('paket_langganan p', 'tl.id_paket = p.id_paket', 'left');
        $this->db->where('tl.id_pemilik', $id_pemilik);
        $this->db->where('tl.deleted_at', NULL);
        $this->db->order_by('tl.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get transaksi by kode pembayaran
     */
    public function get_by_payment_code($kode) {
        return $this->db->get_where($this->table, ['kode_pembayaran' => $kode, 'deleted_at' => NULL])->row();
    }
    
    /**
     * Insert transaksi baru
     */
    public function insert($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update transaksi
     */
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_transaksi_langganan', $id);
        return $this->db->update($this->table, $data);
    }
    
    /**
     * Update status pembayaran
     */
    public function update_status($id, $status) {
        $data = [
            'status_pembayaran' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id_transaksi_langganan', $id);
        $result = $this->db->update($this->table, $data);
        
        if ($result) {
            return ['success' => true, 'message' => 'Status berhasil diupdate'];
        }
        return ['success' => false, 'message' => 'Gagal mengupdate status'];
    }
    
    /**
     * Soft delete transaksi
     */
    public function delete($id) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_transaksi_langganan', $id);
        return $this->db->update($this->table, $data);
    }
    
    /**
     * Get transaksi aktif (subscription yang masih berjalan)
     */
    public function get_active_subscription($id_pemilik) {
        $this->db->select('tl.*, p.nama_paket');
        $this->db->from($this->table . ' tl');
        $this->db->join('paket_langganan p', 'tl.id_paket = p.id_paket', 'left');
        $this->db->where('tl.id_pemilik', $id_pemilik);
        $this->db->where('tl.status_pembayaran', 'sukses');
        $this->db->where('tl.tgl_akhir_langganan >=', date('Y-m-d'));
        $this->db->where('tl.deleted_at', NULL);
        $this->db->order_by('tl.tgl_akhir_langganan', 'DESC');
        return $this->db->get()->row();
    }
    
    /**
     * Get statistics for dashboard
     */
    public function getStats() {
        // Total transactions
        $this->db->where('deleted_at IS NULL');
        $total = $this->db->count_all_results($this->table);
        
        // Pending transactions
        $this->db->where('deleted_at IS NULL');
        $this->db->where('status_pembayaran', 'pending');
        $pending = $this->db->count_all_results($this->table);
        
        // Sukses transactions
        $this->db->where('deleted_at IS NULL');
        $this->db->where('status_pembayaran', 'sukses');
        $sukses = $this->db->count_all_results($this->table);
        
        // Gagal transactions
        $this->db->where('deleted_at IS NULL');
        $this->db->where('status_pembayaran', 'gagal');
        $gagal = $this->db->count_all_results($this->table);
        
        // Total revenue
        $this->db->select_sum('jumlah_bayar');
        $this->db->where('deleted_at IS NULL');
        $this->db->where('status_pembayaran', 'sukses');
        $revenue_result = $this->db->get($this->table)->row();
        $total_revenue = $revenue_result->jumlah_bayar ? $revenue_result->jumlah_bayar : 0;
        
        return [
            'total' => $total,
            'pending' => $pending,
            'sukses' => $sukses,
            'gagal' => $gagal,
            'total_revenue' => $total_revenue
        ];
    }
}
   