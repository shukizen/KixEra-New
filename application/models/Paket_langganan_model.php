<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Paket Langganan
 */
class Paket_langganan_model extends CI_Model {
    
    private $table = 'paket_langganan';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get semua paket aktif
     */
    public function get_all() {
        return $this->db->get_where($this->table, ['status' => 'aktif', 'deleted_at' => NULL])->result();
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
}