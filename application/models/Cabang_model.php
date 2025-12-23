<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cabang Model (menggantikan Proyek_model)
 */
class Cabang_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get project by ID (sebenarnya cabang)
     */
    public function get_project_by_id($cabang_id)
    {
        $this->db->select('
            id_cabang,
            nama_cabang,
            alamat_cabang,
            no_telp,
            status,
            created_at,
            NULL as nama_proyek,  // alias untuk kompatibilitas
            NULL as nama_klien,   // alias untuk kompatibilitas
            NULL as anggaran,     // alias untuk kompatibilitas
            NULL as tgl_mulai,    // alias untuk kompatibilitas
            NULL as deadline      // alias untuk kompatibilitas
        ');
        $this->db->from('cabang');
        $this->db->where('id_cabang', $cabang_id);
        $this->db->where('deleted_at IS NULL');
        
        $query = $this->db->get();
        $result = $query->row_array();
        
        // Mapping field untuk kompatibilitas controller
        if ($result) {
            $result['nama_proyek'] = $result['nama_cabang'];
            $result['nama_klien'] = 'N/A'; // Tidak ada klien di sistem cabang
            $result['anggaran'] = 0;       // Tidak ada anggaran di sistem cabang
        }
        
        return $result;
    }

    /**
     * Get all projects (cabang)
     */
    public function get_all_projects()
    {
        $this->db->select('*');
        $this->db->from('cabang');
        $this->db->where('status', 'aktif');
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('nama_cabang', 'ASC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get all cabang by owner (untuk filter pesanan)
     */
    public function getAllCabangByOwner($id_pemilik)
    {
        $this->db->select('*');
        $this->db->from('cabang');
        $this->db->where('id_pemilik', $id_pemilik);
        $this->db->where('status', 'aktif');
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('nama_cabang', 'ASC');
        
        $query = $this->db->get();
        return $query->result();
    }
}