<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Paket_langganan_model extends CI_Model {
    
    private $table = 'paket_langganan';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Get all packages
    public function getAllPackages() {
        $this->db->where('status', 'aktif');
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('harga', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    // Get all packages (admin view)
    public function getAllPackagesAdmin() {
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('harga', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    // Get package by ID
    public function getPackageById($id_paket) {
        $this->db->where('id_paket', $id_paket);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    // Insert package (admin only)
    public function insertPackage($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }
    
    // Update package
    public function updatePackage($id_paket, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_paket', $id_paket);
        return $this->db->update($this->table, $data);
    }
    
    // Delete package
    public function deletePackage($id_paket) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_paket', $id_paket);
        return $this->db->update($this->table, $data);
    }
}
?>
