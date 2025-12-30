<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Paket Langganan
 */
class Paket_langganan_model extends CI_Model {
    
    private $table = 'paket_langganan';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get semua paket aktif (for frontend)
     */
    public function get_all() {
        return $this->db->get_where($this->table, ['status' => 'aktif', 'deleted_at' => NULL])->result();
    }
    
    /**
     * Get all pakets with filtering (for admin)
     */
    public function getAllPakets($filters = []) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('deleted_at IS NULL');
        
        if (isset($filters['status']) && !empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }
        
        if (isset($filters['search']) && !empty($filters['search'])) {
            $this->db->like('nama_paket', $filters['search']);
        }
        
        $this->db->order_by('harga', 'ASC');
        return $this->db->get()->result();
    }
    
    /**
     * Get paket by ID
     */
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id_paket' => $id, 'deleted_at' => NULL])->row();
    }
    
    /**
     * Insert paket baru
     */
    public function insert($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update paket
     */
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_paket', $id);
        return $this->db->update($this->table, $data);
    }
    
    /**
     * Soft delete paket
     */
    public function delete($id) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_paket', $id);
        return $this->db->update($this->table, $data);
    }
    
    /**
     * Toggle status paket
     */
    public function toggleStatus($id) {
        $paket = $this->get_by_id($id);
        if (!$paket) {
            return ['success' => false, 'message' => 'Paket tidak ditemukan'];
        }
        
        $new_status = ($paket->status == 'aktif') ? 'nonaktif' : 'aktif';
        
        $this->db->where('id_paket', $id);
        $result = $this->db->update($this->table, [
            'status' => $new_status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        if ($result) {
            $status_text = ($new_status == 'aktif') ? 'diaktifkan' : 'dinonaktifkan';
            return ['success' => true, 'message' => 'Paket berhasil ' . $status_text, 'new_status' => $new_status];
        }
        
        return ['success' => false, 'message' => 'Gagal mengubah status'];
    }
    
    /**
     * Get statistics for dashboard
     */
    public function getStats() {
        // Total pakets
        $this->db->where('deleted_at IS NULL');
        $total = $this->db->count_all_results($this->table);
        
        // Active pakets
        $this->db->where('deleted_at IS NULL');
        $this->db->where('status', 'aktif');
        $active = $this->db->count_all_results($this->table);
        
        // Count subscribers per package
        $this->db->select('COUNT(*) as count');
        $this->db->from('pemilik');
        $this->db->where('id_paket IS NOT NULL');
        $this->db->where('deleted_at IS NULL');
        $subscribers = $this->db->get()->row()->count;
        
        return [
            'total' => $total,
            'active' => $active,
            'inactive' => $total - $active,
            'subscribers' => $subscribers
        ];
    }
}