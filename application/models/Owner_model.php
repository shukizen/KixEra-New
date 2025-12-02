<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Owner_model extends CI_Model {
    
    private $table = 'owner';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Get all owners
    public function getAllOwner() {
        $this->db->select('owner.*, users.username, users.status, paket_langganan.nama_paket');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id_user = owner.id_user', 'left');
        $this->db->join('paket_langganan', 'paket_langganan.id_paket = owner.id_paket', 'left');
        $this->db->where('owner.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get owner by ID
    public function getOwnerById($id_owner) {
        $this->db->select('owner.*, users.username, paket_langganan.nama_paket');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id_user = owner.id_user', 'left');
        $this->db->join('paket_langganan', 'paket_langganan.id_paket = owner.id_paket', 'left');
        $this->db->where('owner.id_owner', $id_owner);
        $this->db->where('owner.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->row();
    }
    
    // Get owner by user ID
    public function getOwnerByUserId($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    // Insert owner
    public function insertOwner($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }
    
    // Update owner
    public function updateOwner($id_owner, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_owner', $id_owner);
        return $this->db->update($this->table, $data);
    }
    
    // Update status langganan
    public function updateSubscriptionStatus($id_owner, $status) {
        $data = [
            'status_langganan' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_owner', $id_owner);
        return $this->db->update($this->table, $data);
    }
}
?>