<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notification_model');
        $this->load->library('auth_library');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }

    public function index()
    {
        $data['page_title'] = 'Notifikasi - Admin KixEra';
        $data['user'] = $this->auth_library->get_user();
        
        // Get notifications
        $data['notifications'] = $this->Notification_model->get_all_admin(100);
        $data['unread_count'] = $this->Notification_model->count_unread_admin();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/notifikasi/index', $data);
        $this->load->view('template/footer');
    }

    public function mark_read($id)
    {
        $this->Notification_model->mark_admin_as_read($id);
        if ($this->input->is_ajax_request()) {
            echo json_encode(['success' => true]);
        } else {
            redirect('admin/notifikasi');
        }
    }

    public function mark_all_read()
    {
        $this->Notification_model->mark_all_admin_as_read();
        if ($this->input->is_ajax_request()) {
            echo json_encode(['success' => true]);
        } else {
            redirect('admin/notifikasi');
        }
    }
    
    // Method to create a test notification (for debugging)
    public function create_test()
    {
        if (ENVIRONMENT !== 'production') {
            $data = [
                'type' => 'admin',
                'judul' => 'Test Notifikasi Admin',
                'pesan' => 'Ini adalah notifikasi percobaan untuk halaman admin.',
                'link' => 'admin/notifikasi',
                'status' => 'unread'
            ];
            $this->Notification_model->insert_admin_notification($data);
            redirect('admin/notifikasi');
        }
    }
}
