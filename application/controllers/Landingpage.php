<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Landingpage extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Owner_model');
        $this->load->model('Paket_langganan_model');
    }
    
    public function index() {
        $data = [];
        
        // Check if user is logged in
        if ($this->session->userdata('logged_in')) {
            $data['logged_in'] = true;
            
            // Get fresh data from database for owners
            $role = $this->session->userdata('role');
            $status_langganan = $this->session->userdata('status_langganan');
            $paket_nama = $this->session->userdata('paket');
            
            if ($role === 'owner') {
                $id_pemilik = $this->session->userdata('id_pemilik');
                if ($id_pemilik) {
                    $owner = $this->Owner_model->getOwnerById($id_pemilik);
                    if ($owner) {
                        $status_langganan = $owner->status_langganan;
                        
                        // Get package name if available
                        if ($owner->id_paket) {
                            $paket = $this->Paket_langganan_model->get_by_id($owner->id_paket);
                            $paket_nama = $paket ? $paket->nama_paket : 'Unknown';
                        }
                        
                        // Update session with fresh data
                        $this->session->set_userdata('status_langganan', $status_langganan);
                        $this->session->set_userdata('paket', $paket_nama);
                    }
                }
            }
            
            $data['user'] = [
                'nama' => $this->session->userdata('nama'),
                'role' => $role,
                'status_langganan' => $status_langganan,
                'paket' => $paket_nama
            ];
            
            // Get dashboard URL based on role
            $data['dashboard_url'] = $this->get_dashboard_url($role);
        } else {
            $data['logged_in'] = false;
        }
        
        $this->load->view('landingpage/index', $data);
    }
    
    /**
     * Get dashboard URL based on role
     */
    private function get_dashboard_url($role) {
        switch($role) {
            case 'admin':
                return 'admin/admin_dashboard';
            case 'owner':
                return 'pemilik/pemilik_dashboard';
            case 'karyawan':
                return 'karyawan/karyawan_dashboard';
            default:
                return 'auth/login';
        }
    }
}