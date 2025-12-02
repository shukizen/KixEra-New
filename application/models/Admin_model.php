<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model {
    
    private $table = 'admin';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Get admin by user ID
    public function getAdminByUserId($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    // Get all admins
    public function getAllAdmins() {
        $this->db->select('admin.*, users.username, users.status');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id_user = admin.id_user', 'left');
        $this->db->where('admin.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Insert admin
    public function insertAdmin($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }
    
    // Update admin
    public function updateAdmin($id_admin, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_admin', $id_admin);
        return $this->db->update($this->table, $data);
    }
}
?>