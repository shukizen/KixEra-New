<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }
    
    public function index() {
        $data['page_title'] = 'Admin Dashboard - KixEra';
        $data['user'] = $this->auth_library->get_user();
        
        // Get statistics
        $data['total_pemilik'] = $this->get_total_pemilik();
        $data['total_pesanan'] = $this->get_total_pesanan();
        $data['total_revenue'] = $this->get_total_revenue();
        $data['active_subscriptions'] = $this->get_active_subscriptions();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer');
    }
    
    private function get_total_pemilik() {
        return $this->db->count_all('pemilik');
    }
    
    private function get_total_pesanan() {
        return $this->db->count_all('pesanan');
    }
    
    private function get_total_revenue() {
        $this->db->select_sum('harga');
        $this->db->from('transaksi_langganan');
        $this->db->where('status_pembayaran', 'sukses');
        $query = $this->db->get();
        $result = $query->row();
        return $result->harga ?? 0;
    }
    
    private function get_active_subscriptions() {
        $this->db->where('status_langganan', 'aktif');
        return $this->db->count_all_results('pemilik');
    }
}