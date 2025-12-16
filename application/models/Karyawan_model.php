<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Karyawan_model extends CI_Model {

    private $table = 'karyawan';

    public function __construct() {
        parent::__construct();
    }

     public function getAllKaryawanByOwner($id_pemilik) {
        $this->db->select('karyawan.*, users.username, users.status, cabang.nama_cabang');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id_user = karyawan.id_user', 'left');
        $this->db->join('cabang', 'cabang.id_cabang = karyawan.id_cabang', 'left');
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('karyawan.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getKaryawanById($id_karyawan) {
        $this->db->select('karyawan.*, users.username');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id_user = karyawan.id_user', 'left');
        $this->db->where('karyawan.id_karyawan', $id_karyawan);
        $this->db->where('karyawan.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->row();
    }

    public function getKaryawanByUserId($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function insertKaryawan($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    public function updateKaryawan($id_karyawan, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->update($this->table, $data);
    }

    public function deleteKaryawan($id_karyawan) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->update($this->table, $data);
    }
}

?>