<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_sistem extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Monitoring_sistem_model');
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }

    /**
     * Main monitoring sistem page
     */
    public function index()
    {
        $data['page_title'] = 'Monitoring Sistem - KixEra';
        $data['user'] = $this->auth_library->get_user();
        $data['stats'] = $this->Monitoring_sistem_model->getSystemStats();
        $data['server_info'] = $this->Monitoring_sistem_model->getServerInfo();
        $data['db_info'] = $this->Monitoring_sistem_model->getDatabaseInfo();
        $data['activity_types'] = $this->Monitoring_sistem_model->getActivityTypes();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/monitoring_sistem/index', $data);
        $this->load->view('template/footer');
    }

    /**
     * Get activity logs (AJAX endpoint)
     */
    public function get_logs()
    {
        $filters = [
            'type' => $this->input->get('type'),
            'search' => $this->input->get('search'),
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to')
        ];
        
        $limit = $this->input->get('limit') ? intval($this->input->get('limit')) : 50;
        $logs = $this->Monitoring_sistem_model->getActivityLogs($filters, $limit);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $logs
        ]);
    }

    /**
     * Get login history (AJAX endpoint)
     */
    public function get_login_history()
    {
        $limit = $this->input->get('limit') ? intval($this->input->get('limit')) : 10;
        $history = $this->Monitoring_sistem_model->getLoginHistory($limit);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $history
        ]);
    }

    /**
     * Get stats (AJAX endpoint)
     */
    public function get_stats()
    {
        $stats = $this->Monitoring_sistem_model->getSystemStats();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $stats]);
    }

    /**
     * Delete old logs (AJAX endpoint)
     */
    public function delete_old_logs()
    {
        $days = $this->input->post('days') ? intval($this->input->post('days')) : 30;
        $deleted = $this->Monitoring_sistem_model->deleteOldLogs($days);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => "Berhasil menghapus {$deleted} log lama",
            'deleted_count' => $deleted
        ]);
    }
}
