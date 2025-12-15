<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('auth_library');
        $this->load->helper('url');
    }
    
    /**
     * Halaman login
     */
    public function login() {
        // Jika sudah login, redirect ke dashboard
        if ($this->auth_library->is_logged_in()) {
            $this->_redirect_by_role();
            return;
        }
        
        // Proses form login jika POST
        if ($this->input->method() === 'post') {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);
            
            // Login menggunakan email sebagai username
            $result = $this->auth_library->login($email, $password);
            
            if ($result['success']) {
                // Cek apakah ada intended_url untuk redirect
                $intended_url = $this->session->userdata('intended_url');
                
                if ($intended_url) {
                    // Hapus intended_url dari session
                    $this->session->unset_userdata('intended_url');
                    redirect($intended_url);
                } else {
                    // Redirect berdasarkan role
                    redirect($result['redirect']);
                }
            } else {
                // Login gagal
                $this->session->set_flashdata('error', $result['message']);
                redirect('auth/login');
            }
        }
        
        // Show login view
        $this->load->view('auth/login');
    }
    
    /**
     * Proses login via AJAX
     */
    public function ajax_login() {
        if ($this->input->method() !== 'post') {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            return;
        }
        
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);
        
        $result = $this->auth_library->login($email, $password);
        
        if ($result['success']) {
            // Cek intended_url
            $intended_url = $this->session->userdata('intended_url');
            
            if ($intended_url) {
                $this->session->unset_userdata('intended_url');
                $result['redirect'] = $intended_url;
            }
        }
        
        echo json_encode($result);
    }
    
    /**
     * Google OAuth callback
     */
    public function google() {
        // Google OAuth logic - implementasi nanti
        $this->session->set_flashdata('info', 'Google OAuth belum diimplementasikan');
        redirect('auth/login');
    }
    
    /**
     * Halaman register
     */
    public function register() {
        // Jika sudah login, redirect
        if ($this->auth_library->is_logged_in()) {
            $this->_redirect_by_role();
            return;
        }
        
        $this->load->view('auth/register');
    }
    
    /**
     * Logout
     */
    public function logout() {
        $this->auth_library->logout();
        $this->session->set_flashdata('success', 'Anda telah berhasil logout');
        redirect('auth/login');
    }
    
    /**
     * Redirect berdasarkan role
     */
    private function _redirect_by_role() {
        $role = $this->session->userdata('role');
        
        switch ($role) {
            case 'admin':
                redirect('admin/dashboard');
                break;
            case 'owner':
                redirect('pemilik/pemilik_dashboard');
                break;
            case 'karyawan':
                redirect('karyawan/karyawan_dashboard');
                break;
            default:
                redirect('landingpage');
        }
    }
}