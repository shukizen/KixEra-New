<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi_langganan_model extends CI_Model {
    
    private $table = 'transaksi_langganan';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get semua transaksi
     */
    public function get_all() {
        $this->db->select('tl.*, p.nama_paket, p.harga, pm.nama_pemilik');
        $this->db->from($this->table . ' tl');
        $this->db->join('paket_langganan p', 'tl.id_paket = p.id_paket', 'left');
        $this->db->join('pemilik pm', 'tl.id_pemilik = pm.id_pemilik', 'left');
        $this->db->where('tl.deleted_at', NULL);
        $this->db->order_by('tl.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get transaksi by ID
     */
    public function get_by_id($id) {
        $this->db->select('tl.*, p.nama_paket, p.harga, p.deskripsi, pm.nama_pemilik, pm.email, pm.telp, pm.alamat');
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
        return $this->db->update($this->table, $data);
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
}
?>   