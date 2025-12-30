<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_operasional extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_operasional_model');
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }

    /**
     * Main data operasional page
     */
    public function index()
    {
        $data['page_title'] = 'Data Operasional - KixEra';
        $data['user'] = $this->auth_library->get_user();
        $data['stats'] = $this->Data_operasional_model->getStats();
        $data['recent_pesanan'] = $this->Data_operasional_model->getRecentPesanan(5);
        $data['pemilik_list'] = $this->Data_operasional_model->getPemilikWithStats(5);
        $data['cabang_summary'] = $this->Data_operasional_model->getCabangSummary();
        $data['pesanan_by_status'] = $this->Data_operasional_model->getPesananByStatus();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/data_operasional/index', $data);
        $this->load->view('template/footer');
    }

    /**
     * Get pemilik data (AJAX endpoint)
     */
    public function get_pemilik()
    {
        $limit = $this->input->get('limit') ? intval($this->input->get('limit')) : 10;
        $pemilik = $this->Data_operasional_model->getPemilikWithStats($limit);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $pemilik
        ]);
    }

    /**
     * Get cabang summary (AJAX endpoint)
     */
    public function get_cabang_summary()
    {
        $summary = $this->Data_operasional_model->getCabangSummary();
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $summary
        ]);
    }

    /**
     * Get layanan summary (AJAX endpoint)
     */
    public function get_layanan()
    {
        $layanan = $this->Data_operasional_model->getLayananSummary();
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $layanan
        ]);
    }

    /**
     * Get pesanan trend (AJAX endpoint)
     */
    public function get_pesanan_trend()
    {
        $trend = $this->Data_operasional_model->getMonthlyPesananTrend();
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $trend
        ]);
    }

    /**
     * Get stats (AJAX endpoint)
     */
    public function get_stats()
    {
        $stats = $this->Data_operasional_model->getStats();
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $stats
        ]);
    }
}
