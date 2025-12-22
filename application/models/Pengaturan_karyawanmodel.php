<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_karyawanmodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Dapatkan data karyawan berdasarkan ID dengan info cabang
     */
    public function get_karyawan_by_id($id_karyawan)
    {
        $this->db->select('k.*, c.nama_cabang, c.alamat_cabang, c.no_telp as telp_cabang');
        $this->db->from('karyawan k');
        $this->db->join('cabang c', 'k.id_cabang = c.id_cabang', 'left');
        $this->db->where('k.id_karyawan', $id_karyawan);
        $this->db->where('k.deleted_at IS NULL');
        
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Dapatkan karyawan berdasarkan id_user
     */
    public function get_karyawan_by_user_id($id_user)
    {
        $this->db->select('k.*, c.nama_cabang, c.alamat_cabang');
        $this->db->from('karyawan k');
        $this->db->join('cabang c', 'k.id_cabang = c.id_cabang', 'left');
        $this->db->where('k.id_user', $id_user);
        $this->db->where('k.deleted_at IS NULL');
        
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Update data karyawan
     */
    public function update_karyawan($id_karyawan, $data)
    {
        $update_data = [];
        
        // Field yang boleh diupdate
        $allowed_fields = ['nama', 'email', 'no_telp', 'foto_profil', 'jabatan', 'alamat'];
        
        foreach ($allowed_fields as $field) {
            if (isset($data[$field])) {
                $update_data[$field] = $data[$field];
            }
        }
        
        if (empty($update_data)) {
            return false;
        }
        
        $update_data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->update('karyawan', $update_data);
    }

    /**
     * Cek apakah email sudah digunakan oleh karyawan lain
     */
    public function check_email_exists($email, $exclude_id_karyawan = null)
    {
        $this->db->where('email', $email);
        $this->db->where('deleted_at IS NULL');
        
        if ($exclude_id_karyawan) {
            $this->db->where('id_karyawan !=', $exclude_id_karyawan);
        }
        
        return $this->db->count_all_results('karyawan') > 0;
    }

    /**
     * Dapatkan semua karyawan berdasarkan id_pemilik
     */
    public function get_karyawan_by_pemilik($id_pemilik)
    {
        $this->db->select('k.*, c.nama_cabang');
        $this->db->from('karyawan k');
        $this->db->join('cabang c', 'k.id_cabang = c.id_cabang', 'left');
        $this->db->join('pemilik p', 'c.id_pemilik = p.id_pemilik', 'left');
        $this->db->where('p.id_pemilik', $id_pemilik);
        $this->db->where('k.deleted_at IS NULL');
        $this->db->order_by('k.created_at', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Dapatkan karyawan berdasarkan id_cabang
     */
    public function get_karyawan_by_cabang($id_cabang)
    {
        $this->db->select('k.*');
        $this->db->from('karyawan k');
        $this->db->where('k.id_cabang', $id_cabang);
        $this->db->where('k.deleted_at IS NULL');
        $this->db->where('k.status', 'aktif');
        $this->db->order_by('k.nama', 'ASC');
        
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Insert karyawan baru
     */
    public function insert_karyawan($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('karyawan', $data);
    }

    /**
     * Soft delete karyawan
     */
    public function delete_karyawan($id_karyawan)
    {
        $data = [
            'deleted_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->update('karyawan', $data);
    }

    /**
     * Update status karyawan
     */
    public function update_status($id_karyawan, $status)
    {
        $data = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->update('karyawan', $data);
    }
}