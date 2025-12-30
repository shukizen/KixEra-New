<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class  Layanan_model extends CI_Model {
    
    private $table = 'layanan';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Get all layanan by owner
    public function getAllLayananByOwner($id_pemilik) {
        $this->db->where('id_pemilik', $id_pemilik);
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('nama_layanan', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    // Get active layanan
    public function getActiveLayanan($id_pemilik) {
        $this->db->where('id_pemilik', $id_pemilik);
        $this->db->where('status', 'aktif');
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    // Get layanan by ID
    public function getLayananById($id_layanan) {
        $this->db->where('id_layanan', $id_layanan);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    // Insert layanan
    public function insertLayanan($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }
    
    // Update layanan
    public function updateLayanan($id_layanan, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_layanan', $id_layanan);
        return $this->db->update($this->table, $data);
    }
    
    // Soft delete layanan
    public function deleteLayanan($id_layanan) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_layanan', $id_layanan);
        return $this->db->update($this->table, $data);
    }
    
    // Alias for soft delete to match Pelanggan pattern
    public function softDelete($id_layanan) {
        return $this->deleteLayanan($id_layanan);
    }
    
    // Search layanan by keyword
    public function searchLayanan($keyword, $id_pemilik = null) {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if ($id_pemilik) {
            $this->db->where('id_pemilik', $id_pemilik);
        }

        $this->db->group_start();
        $this->db->like('nama_layanan', $keyword);
        $this->db->or_like('deskripsi', $keyword);
        $this->db->group_end();
        
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('nama_layanan', 'ASC');
        return $this->db->get()->result();
    }
    
    // Check if layanan belongs to owner
    public function checkOwnership($id_layanan, $id_pemilik) {
        $this->db->select('1');
        $this->db->from($this->table);
        $this->db->where('id_layanan', $id_layanan);
        $this->db->where('id_pemilik', $id_pemilik);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }
    
    // Get layanan by status
    public function getLayananByStatus($status, $id_pemilik = null) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status', $status);
        
        if ($id_pemilik) {
            $this->db->where('id_pemilik', $id_pemilik);
        }
        
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('nama_layanan', 'ASC');
        return $this->db->get()->result();
    }
    
    // Get layanan statistics
    public function getLayananStats($id_pemilik) {
        $query = $this->db->query("
            SELECT 
                l.id_layanan,
                l.nama_layanan,
                l.harga,
                COUNT(p.id_pesanan) as total_pesanan,
                SUM(p.total_harga) as total_pendapatan
            FROM layanan l
            LEFT JOIN pesanan p ON p.id_layanan = l.id_layanan AND p.deleted_at IS NULL
            WHERE l.id_pemilik = ? AND l.deleted_at IS NULL
            GROUP BY l.id_layanan
            ORDER BY total_pesanan DESC
        ", [$id_pemilik]);
        
        return $query->result();
    }
}?>