<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('auth_library');
        $this->load->library('session');
        $this->load->model('Admin_model');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }
    
    public function index() {
        $data['page_title'] = 'Admin Dashboard - KixEra';
        $data['user'] = $this->auth_library->get_user();
        
        // Call model methods for data
        $data['stats'] = $this->Admin_model->get_main_statistics();
        $data['subscription_stats'] = $this->Admin_model->get_subscription_analytics();
        $data['revenue_data'] = $this->Admin_model->get_revenue_data();
        $data['recent_transactions'] = $this->Admin_model->get_recent_transactions(10);
        $data['system_alerts'] = $this->Admin_model->get_system_alerts();
        $data['top_owners'] = $this->Admin_model->get_top_owners(5);
        $data['monthly_growth'] = $this->Admin_model->get_monthly_growth();
        $data['package_distribution'] = $this->Admin_model->get_package_distribution();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer');
    }
    
}