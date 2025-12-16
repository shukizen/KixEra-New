<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require karyawan role
        $this->auth_library->require_role('karyawan');
    }
    
    public function index() {
        $data['page_title'] = 'Dashboard Karyawan - KixEra';
        $data['user'] = $this->auth_library->get_user();
        
        // Get karyawan statistics
        $id_cabang = $this->session->userdata('id_cabang');
        $id_karyawan = $this->session->userdata('id_karyawan');
        
        $data['cabang'] = $this->get_cabang_info($id_cabang);
        $data['pesanan_hari_ini'] = $this->get_pesanan_hari_ini($id_cabang);
        $data['pesanan_pending'] = $this->get_pesanan_pending($id_cabang);
        $data['pesanan_proses'] = $this->get_pesanan_proses($id_cabang);
        
        // Get recent orders for this branch
        $data['recent_orders'] = $this->get_recent_orders($id_cabang);
        
        // Load the main view which will handle the layout structure
        $this->load->view('karyawan/index', $data);
    }
    
    private function get_cabang_info($id_cabang) {
        $this->db->select('c.*, p.nama_usaha');
        $this->db->from('cabang c');
        $this->db->join('pemilik p', 'c.id_pemilik = p.id_pemilik');
        $this->db->where('c.id_cabang', $id_cabang);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    private function get_pesanan_hari_ini($id_cabang) {
        $this->db->where('id_cabang', $id_cabang);
        $this->db->where('DATE(tgl_masuk)', date('Y-m-d'));
        return $this->db->count_all_results('pesanan');
    }
    
    private function get_pesanan_pending($id_cabang) {
        $this->db->where('id_cabang', $id_cabang);
        $this->db->where('status_pesanan', 'pending');
        return $this->db->count_all_results('pesanan');
    }
    
    private function get_pesanan_proses($id_cabang) {
        $this->db->where('id_cabang', $id_cabang);
        $this->db->where('status_pesanan', 'proses');
        return $this->db->count_all_results('pesanan');
    }
    
    private function get_recent_orders($id_cabang, $limit = 10) {
        $this->db->select('p.*, pl.nama as nama_pelanggan');
        $this->db->from('pesanan p');
        $this->db->join('pelanggan pl', 'p.id_pelanggan = pl.id_pelanggan', 'left');
        $this->db->where('p.id_cabang', $id_cabang);
        $this->db->order_by('p.tgl_masuk', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
}