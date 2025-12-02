<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

    private $table =  'pelanggan';

    public function __construct() {
        parent::__construct();
    }
    // Get all pelanggan
    public function getAllPelanggan() {
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    // Get pelanggan by ID
    public function getPelangganById($id_pelanggan) {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    // Search pelanggan
    public function searchPelanggan($keyword) {
        $this->db->like('nama', $keyword);
        $this->db->or_like('no_telp', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    // Insert pelanggan
    public function insertPelanggan($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }
    
    // Update pelanggan
    public function updatePelanggan($id_pelanggan, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->update($this->table, $data);
    }
    
    // Check if pelanggan exists by phone
    public function checkByPhone($no_telp) {
        $this->db->where('no_telp', $no_telp);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    // Get pelanggan with statistics
    public function getPelangganWithStats($id_owner, $min_transaksi = 3) {
        $query = $this->db->query("
            SELECT 
                pel.id_pelanggan,
                pel.nama,
                pel.no_telp,
                pel.email,
                COUNT(p.id_pesanan) as total_pesanan,
                SUM(p.total_harga) as total_belanja,
                MAX(p.tgl_masuk) as transaksi_terakhir
            FROM pelanggan pel
            INNER JOIN pesanan p ON p.id_pelanggan = pel.id_pelanggan
            WHERE p.id_owner = ? AND p.deleted_at IS NULL AND pel.deleted_at IS NULL
            GROUP BY pel.id_pelanggan
            HAVING total_pesanan >= ?
            ORDER BY total_pesanan DESC, total_belanja DESC
        ", [$id_owner, $min_transaksi]);
        
        return $query->result();
    }
}

?>
