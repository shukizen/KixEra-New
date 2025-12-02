<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    private $table = 'users';
    
    public function __construct() {
        parent::__construct();
    }

    public function validation($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        
        if ($query->num_rows() > 0) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }
    public function getRole($id_user) {
        $this->db->select('role');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get($this->table);
        return $query->row();
    }
    public function getAllUser() {
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    public function getUserById($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    public function insertUser($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }
    public function updateUser($id_user, $data) {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_user', $id_user);
        return $this->db->update($this->table, $data);
    }
    public function deleteUser($id_user) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_user', $id_user);
        return $this->db->update($this->table, $data);
    }
    public function checkUsername($username) {
        $this->db->where('username', $username);
        $this->db->where('deleted_at IS NULL');
        return $this->db->count_all_results($this->table) > 0;
    }
}?>