<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        
        // Enable error reporting untuk debugging
        if (ENVIRONMENT === 'development') {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        }
    }
    
    /**
     * Index - redirect ke login
     */
    public function index() {
        if ($this->is_logged_in()) {
            $role = $this->session->userdata('role');
            redirect($this->get_dashboard_url($role));
        }
        redirect('auth/login');
    }
    
    /**
     * Halaman Login
     */
    public function login() {
        // Jika sudah login, redirect ke dashboard
        if ($this->is_logged_in()) {
            $role = $this->session->userdata('role');
            redirect($this->get_dashboard_url($role));
        }
        
        // Handle request POST (percobaan login)
        if ($this->input->method() === 'post') {
            $this->process_login();
            return;
        }
        
        // Tampilkan view login
        $data['page_title'] = 'Login - KixEra';
        $this->load->view('auth/login', $data);
    }
    
    /**
     * Proses Login
     */
    private function process_login() {
        $username_or_email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);
        
        // Validasi input
        if (empty($username_or_email) || empty($password)) {
            $response = [
                'success' => false,
                'message' => 'Email/Username dan password harus diisi'
            ];
            
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }
            
            $this->session->set_flashdata('error', $response['message']);
            redirect('auth/login');
            return;
        }
        
        // Validasi user
        $user = $this->user_model->validate_login($username_or_email, $password);
        
        if ($user) {
            // Cek status user
            if ($user['status'] !== 'aktif') {
                $response = [
                    'success' => false,
                    'message' => 'Akun Anda tidak aktif. Hubungi administrator.'
                ];
                
                if ($this->input->is_ajax_request()) {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                    return;
                }
                
                $this->session->set_flashdata('error', $response['message']);
                redirect('auth/login');
                return;
            }
            
            // Cek langganan untuk owner
            if ($user['role'] === 'owner') {
                $subscription_valid = $this->check_subscription($user);
                if (!$subscription_valid) {
                    $response = [
                        'success' => false,
                        'message' => 'Langganan Anda telah berakhir. Silakan perpanjang langganan.',
                        'subscription_expired' => true
                    ];
                    
                    if ($this->input->is_ajax_request()) {
                        $this->output
                            ->set_content_type('application/json')
                            ->set_output(json_encode($response));
                        return;
                    }
                    
                    $this->session->set_flashdata('error', $response['message']);
                    redirect('auth/subscription_expired');
                    return;
                }
            }
            
            // Set session
            $this->set_user_session($user);
            
            // Log activity
            $this->user_model->log_activity($user['id_user'], 'Login', 'User login ke sistem');
            
            $response = [
                'success' => true,
                'message' => 'Login berhasil!',
                'redirect' => base_url($this->get_dashboard_url($user['role']))
            ];
            
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }
            
            $this->session->set_flashdata('success', 'Selamat datang, ' . $user['nama']);
            redirect($this->get_dashboard_url($user['role']));
            
        } else {
            $response = [
                'success' => false,
                'message' => 'Email/Username atau password salah'
            ];
            
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }
            
            $this->session->set_flashdata('error', $response['message']);
            redirect('auth/login');
        }
    }
    
    /**
     * Halaman Register
     */
    public function register() {
        // Jika sudah login, redirect
        if ($this->is_logged_in()) {
            $role = $this->session->userdata('role');
            redirect($this->get_dashboard_url($role));
        }
        
        // Handle request POST
        if ($this->input->method() === 'post') {
            $this->process_registration();
            return;
        }
        
        // Tampilkan view register
        $data['page_title'] = 'Daftar - KixEra';
        $this->load->view('auth/register', $data);
    }
    
    /**
     * Proses registrasi
     */
    private function process_registration() {
        // CRITICAL: Set JSON header FIRST before any processing
        $this->output->set_content_type('application/json');
        
        try {
            // Cek apakah ini AJAX request
            $is_ajax = $this->input->is_ajax_request() || 
                       $this->input->get_request_header('X-Requested-With') === 'XMLHttpRequest';
            
            // Ambil data form
            $full_name = trim($this->input->post('fullName', TRUE));
            $email = trim($this->input->post('email', TRUE));
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirmPassword');
            
            // Data tambahan
            $business_name = trim($this->input->post('businessName', TRUE));
            $phone_number = trim($this->input->post('phoneNumber', TRUE));
            
            // Validasi
            $errors = [];
            
            if (empty($full_name)) {
                $errors[] = 'Nama lengkap harus diisi';
            } elseif (strlen($full_name) < 3) {
                $errors[] = 'Nama lengkap minimal 3 karakter';
            }
            
            if (empty($business_name)) {
                $errors[] = 'Nama bisnis harus diisi';
            }
            
            if (empty($phone_number)) {
                $errors[] = 'Nomor telepon harus diisi';
            }
            
            if (empty($email)) {
                $errors[] = 'Email harus diisi';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Format email tidak valid';
            } elseif ($this->user_model->check_email_exists($email)) {
                $errors[] = 'Email sudah terdaftar. Silakan gunakan email lain atau login.';
            }
            
            if (empty($password)) {
                $errors[] = 'Password harus diisi';
            } elseif (strlen($password) < 8) {
                $errors[] = 'Password minimal 8 karakter';
            }
            
            if (empty($confirm_password)) {
                $errors[] = 'Konfirmasi password harus diisi';
            } elseif ($password !== $confirm_password) {
                $errors[] = 'Password dan konfirmasi password tidak cocok';
            }
            
            // Jika ada error
            if (!empty($errors)) {
                $response = [
                    'success' => false,
                    'errors' => $errors,
                    'message' => implode(', ', $errors)
                ];
                
                echo json_encode($response);
                return;
            }
            
            // Proses registrasi
            $register_data = [
                'nama' => $full_name,
                'email' => $email,
                'password' => $password,
                'nama_usaha' => $business_name,
                'no_telp' => $phone_number
            ];
            
            $result = $this->user_model->register_owner($register_data);
            
            if ($result['success']) {
                // Login otomatis setelah registrasi
                $user = $this->user_model->get_user_by_username($result['data']['username']);
                
                if ($user) {
                    $this->set_user_session($user);
                    
                    // Log activity
                    $this->user_model->log_activity($user['id_user'], 'Register', 'User mendaftar akun baru');
                    
                    $response = [
                        'success' => true,
                        'message' => 'Registrasi berhasil! Selamat datang di KixEra. Anda mendapat trial 7 hari gratis.',
                        'redirect' => base_url($this->get_dashboard_url($user['role']))
                    ];
                    
                    echo json_encode($response);
                    return;
                }
            }
            
            // Jika gagal
            $response = [
                'success' => false,
                'message' => $result['message'] ?? 'Gagal membuat akun. Silakan coba lagi.'
            ];
            
            echo json_encode($response);
            return;
            
        } catch (Exception $e) {
            // Log error
            log_message('error', 'Registration error: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            $response = [
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage(),
                'error_detail' => ENVIRONMENT === 'development' ? $e->getTraceAsString() : null
            ];
            
            echo json_encode($response);
            return;
        }
    }
    
    /**
     * Set user session
     */
    private function set_user_session($user) {
        $session_data = [
            'id_user' => $user['id_user'],
            'username' => $user['username'],
            'role' => $user['role'],
            'logged_in' => true,
            'login_time' => time()
        ];
        
        // Data tambahan berdasarkan role
        if ($user['role'] === 'owner') {
            $session_data['id_pemilik'] = $user['id_pemilik'];
            $session_data['nama'] = $user['nama'];
            $session_data['email'] = $user['email'];
            $session_data['nama_usaha'] = $user['nama_usaha'];
            $session_data['status_langganan'] = $user['status_langganan'];
            $session_data['paket'] = $user['nama_paket'] ?? 'Trial';
        } elseif ($user['role'] === 'admin') {
            $session_data['id_admin'] = $user['id_admin'];
            $session_data['nama'] = $user['nama'];
            $session_data['email'] = $user['email'];
        } elseif ($user['role'] === 'karyawan') {
            $session_data['id_karyawan'] = $user['id_karyawan'];
            $session_data['nama'] = $user['nama'];
            $session_data['email'] = $user['email'];
            $session_data['id_cabang'] = $user['id_cabang'];
            $session_data['nama_cabang'] = $user['nama_cabang'];
        }
        
        $this->session->set_userdata($session_data);
    }
    
    /**
     * Cek subscription untuk owner
     */
    private function check_subscription($user) {
        if ($user['status_langganan'] === 'aktif') {
            return true;
        }
        
        if ($user['status_langganan'] === 'trial') {
            // Cek apakah masih dalam masa trial (7 hari)
            $created_date = strtotime($user['created_at']);
            $current_date = time();
            $days_diff = floor(($current_date - $created_date) / (60 * 60 * 24));
            
            return $days_diff <= 7;
        }
        
        return false;
    }
    
    /**
     * Logout
     */
    public function logout() {
        // Log activity sebelum destroy session
        if ($this->is_logged_in()) {
            $id_user = $this->session->userdata('id_user');
            $this->user_model->log_activity($id_user, 'Logout', 'User logout dari sistem');
        }
        
        $this->session->unset_userdata([
            'id_user', 'username', 'role', 'logged_in', 'login_time',
            'id_pemilik', 'id_admin', 'id_karyawan', 'nama', 'email',
            'nama_usaha', 'status_langganan', 'paket', 'id_cabang', 'nama_cabang'
        ]);
        
        $this->session->set_flashdata('success', 'Anda telah keluar dari sistem');
        redirect('auth/login');
    }
    
    /**
     * Halaman langganan berakhir
     */
    public function subscription_expired() {
        $data['page_title'] = 'Langganan Berakhir - KixEra';
        $this->load->view('auth/subscription_expired', $data);
    }
    
    /**
     * Cek apakah user sudah login
     */
    private function is_logged_in() {
        return $this->session->userdata('logged_in') === true;
    }
    
    /**
     * Cek session (AJAX)
     */
    public function check_session() {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'valid' => $this->is_logged_in(),
                'role' => $this->session->userdata('role'),
                'username' => $this->session->userdata('username')
            ]));
    }
    
    /**
     * Dapatkan URL dashboard berdasarkan role
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