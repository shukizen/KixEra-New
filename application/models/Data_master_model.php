<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_master_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get data master statistics
     */
    public function getStats() {
        // Paket langganan
        $this->db->where('deleted_at IS NULL');
        $total_paket = $this->db->count_all_results('paket_langganan');
        
        // Paket aktif
        $this->db->where('deleted_at IS NULL');
        $this->db->where('status', 'aktif');
        $paket_aktif = $this->db->count_all_results('paket_langganan');
        
        // Total layanan
        $this->db->where('deleted_at IS NULL');
        $total_layanan = $this->db->count_all_results('layanan');
        
        // Total cabang
        $this->db->where('deleted_at IS NULL');
        $total_cabang = $this->db->count_all_results('cabang');
        
        // Total users (admin + owner)
        $this->db->where('deleted_at IS NULL');
        $this->db->where_in('role', ['admin', 'owner']);
        $total_users = $this->db->count_all_results('users');
        
        // Total inventori items
        $total_inventori = $this->db->count_all_results('inventori');
        
        return [
            'total_paket' => $total_paket,
            'paket_aktif' => $paket_aktif,
            'total_layanan' => $total_layanan,
            'total_cabang' => $total_cabang,
            'total_users' => $total_users,
            'total_inventori' => $total_inventori
        ];
    }
    
    /**
     * Get all paket langganan
     */
    public function getPaketLangganan() {
        $this->db->select('*, 
            (SELECT COUNT(*) FROM pemilik p WHERE p.id_paket = paket_langganan.id_paket AND p.deleted_at IS NULL) as jumlah_subscriber');
        $this->db->from('paket_langganan');
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('harga', 'ASC');
        return $this->db->get()->result();
    }
    
    /**
     * Get layanan types summary
     */
    public function getLayananSummary() {
        $this->db->select('nama_layanan, COUNT(*) as jumlah');
        $this->db->from('layanan');
        $this->db->where('deleted_at IS NULL');
        $this->db->group_by('nama_layanan');
        $this->db->order_by('jumlah', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
    
    /**
     * Get cabang by pemilik (owner)
     */
    public function getCabangByCity() {
        $this->db->select('p.nama as pemilik_nama, COUNT(c.id_cabang) as jumlah');
        $this->db->from('cabang c');
        $this->db->join('pemilik p', 'c.id_pemilik = p.id_pemilik', 'left');
        $this->db->where('c.deleted_at IS NULL');
        $this->db->group_by('c.id_pemilik');
        $this->db->order_by('jumlah', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
    
    /**
     * Get users by role summary
     */
    public function getUsersByRole() {
        $this->db->select('role, COUNT(*) as jumlah');
        $this->db->from('users');
        $this->db->where('deleted_at IS NULL');
        $this->db->group_by('role');
        return $this->db->get()->result();
    }
    
    /**
     * Get inventori summary by cabang
     */
    public function getInventoriSummary() {
        $this->db->select('c.nama_cabang, COUNT(i.id_inventori) as jumlah_item, SUM(i.stok) as total_stok');
        $this->db->from('inventori i');
        $this->db->join('cabang c', 'i.id_cabang = c.id_cabang', 'left');
        $this->db->group_by('i.id_cabang');
        $this->db->order_by('jumlah_item', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
}
