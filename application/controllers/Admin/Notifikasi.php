<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notifikasi_model');
        $this->load->library('auth_library');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }

    public function index()
    {
        $data['page_title'] = 'Notifikasi - Admin KixEra';
        $data['user'] = $this->auth_library->get_user();
        
        // Get notifications
        $data['notifications'] = $this->Notifikasi_model->getAllAdmin(100);
        $data['unread_count'] = $this->Notifikasi_model->countUnreadAdmin();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/notifikasi/index', $data);
        $this->load->view('template/footer');
    }

    public function mark_read($id)
    {
        $this->Notifikasi_model->markAsRead($id);
        if ($this->input->is_ajax_request()) {
            echo json_encode(['success' => true]);
        } else {
            redirect('admin/notifikasi');
        }
    }

    public function mark_all_read()
    {
        $this->Notifikasi_model->markAllAsReadAdmin();
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
            $this->Notifikasi_model->insertNotification($data);
            redirect('admin/notifikasi');
        }
    }
}
