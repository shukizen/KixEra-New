<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_master extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_master_model');
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }

    /**
     * Main data master page
     */
    public function index()
    {
        $data['page_title'] = 'Data Master - KixEra';
        $data['user'] = $this->auth_library->get_user();
        $data['stats'] = $this->Data_master_model->getStats();
        $data['paket_list'] = $this->Data_master_model->getPaketLangganan();
        $data['layanan_summary'] = $this->Data_master_model->getLayananSummary();
        $data['cabang_by_city'] = $this->Data_master_model->getCabangByCity();
        $data['users_by_role'] = $this->Data_master_model->getUsersByRole();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/data_master/index', $data);
        $this->load->view('template/footer');
    }

    /**
     * Get stats (AJAX endpoint)
     */
    public function get_stats()
    {
        $stats = $this->Data_master_model->getStats();
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Get paket langganan (AJAX endpoint)
     */
    public function get_paket()
    {
        $paket = $this->Data_master_model->getPaketLangganan();
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $paket
        ]);
    }

    /**
     * Get inventori summary (AJAX endpoint)
     */
    public function get_inventori()
    {
        $inventori = $this->Data_master_model->getInventoriSummary();
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $inventori
        ]);
    }
}
