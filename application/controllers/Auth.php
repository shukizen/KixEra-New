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
        // Cek apakah ini AJAX request
        $is_ajax = $this->input->is_ajax_request() || 
                    $this->input->get_request_header('X-Requested-With') === 'XMLHttpRequest';
        
        if ($is_ajax) {
             $this->output->set_content_type('application/json');
        }
        
        try {
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
                $error_msg = implode(', ', $errors);
                
                if ($is_ajax) {
                    echo json_encode(['success' => false, 'errors' => $errors, 'message' => $error_msg]);
                    return;
                } else {
                    $this->session->set_flashdata('error', $error_msg);
                    redirect('auth/register');
                    return;
                }
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
                    
                    $msg = 'Registrasi berhasil! Selamat datang di KixEra. Anda mendapat trial 7 hari gratis.';
                    $redirect_url = base_url($this->get_dashboard_url($user['role']));
                    
                    if ($is_ajax) {
                        echo json_encode(['success' => true, 'message' => $msg, 'redirect' => $redirect_url]);
                        return;
                    } else {
                        $this->session->set_flashdata('success', $msg);
                        redirect($redirect_url);
                        return;
                    }
                }
            }
            
            // Jika gagal
            $fail_msg = $result['message'] ?? 'Gagal membuat akun. Silakan coba lagi.';
            
            if ($is_ajax) {
                echo json_encode(['success' => false, 'message' => $fail_msg]);
                return;
            } else {
                $this->session->set_flashdata('error', $fail_msg);
                redirect('auth/register');
                return;
            }
            
        } catch (Exception $e) {
            // Log error
            log_message('error', 'Registration error: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            $sys_err = 'Terjadi kesalahan sistem: ' . $e->getMessage();
            
            if ($is_ajax) {
                echo json_encode([
                    'success' => false, 
                    'message' => $sys_err,
                    'error_detail' => ENVIRONMENT === 'development' ? $e->getTraceAsString() : null
                ]);
                return;
            } else {
                 $this->session->set_flashdata('error', $sys_err);
                 redirect('auth/register');
                 return;
            }
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
        
        // Destroy session sepenuhnya
        $this->session->sess_destroy();
        
        // Set flashdata setelah destroy (akan dibuat session baru khusus untuk flashdata)
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
    
    // ========================================
    // GOOGLE OAUTH METHODS
    // ========================================
    
    /**
     * Google Login - Redirect ke Google OAuth
     */
    public function google_login() {
        // Load library Google OAuth
        $this->load->library('google_oauth');
        
        // Redirect ke Google OAuth page
        $this->google_oauth->redirect();
    }
    
    /**
     * Google Callback - Handle callback dari Google setelah user authorize
     */
    public function google_callback() {
        // Ambil parameter dari URL
        $code = $this->input->get('code');
        $state = $this->input->get('state');
        $error = $this->input->get('error');
        
        // Cek apakah user cancel authorization
        if ($error) {
            $this->session->set_flashdata('error', 'Login dengan Google dibatalkan');
            redirect('auth/login');
            return;
        }
        
        // Cek apakah ada code
        if (!$code) {
            $this->session->set_flashdata('error', 'Kode authorization tidak valid');
            redirect('auth/login');
            return;
        }
        
        // Load library
        $this->load->library('google_oauth');
        
        // Authenticate dan dapatkan user info
        $google_user = $this->google_oauth->authenticate($code, $state);
        
        if (!$google_user) {
            log_message('error', 'Google OAuth failed: Unable to get user info');
            $this->session->set_flashdata('error', 'Gagal login dengan Google. Silakan coba lagi.');
            redirect('auth/login');
            return;
        }
        
        // Cek apakah email terverifikasi
        if (!$google_user['verified_email']) {
            $this->session->set_flashdata('error', 'Email Google Anda belum terverifikasi');
            redirect('auth/login');
            return;
        }
        
        // Cek apakah user sudah terdaftar (by google_id)
        $existing_user = $this->user_model->get_user_by_google_id($google_user['google_id']);
        
        if ($existing_user) {
            // User sudah ada, login langsung
            
            // Cek status user
            if ($existing_user['status'] !== 'aktif') {
                $this->session->set_flashdata('error', 'Akun Anda tidak aktif. Hubungi administrator.');
                redirect('auth/login');
                return;
            }
            
            // Cek langganan untuk owner
            if ($existing_user['role'] === 'owner') {
                $subscription_valid = $this->check_subscription($existing_user);
                if (!$subscription_valid) {
                    $this->session->set_flashdata('error', 'Langganan Anda telah berakhir. Silakan perpanjang langganan.');
                    redirect('auth/subscription_expired');
                    return;
                }
            }
            
            // Set session
            $this->set_user_session($existing_user);
            
            // Log activity
            $this->user_model->log_activity($existing_user['id_user'], 'Login', 'User login via Google OAuth');
            
            // Redirect ke dashboard
            $this->session->set_flashdata('success', 'Selamat datang kembali, ' . $existing_user['nama']);
            redirect($this->get_dashboard_url($existing_user['role']));
            
        } else {
            // User belum terdaftar, cek apakah email sudah terdaftar dengan metode lain
            $user_by_email = $this->user_model->get_user_by_email($google_user['email']);
            
            if ($user_by_email) {
                // Email sudah terdaftar dengan metode tradisional
                // Option 1: Link Google account ke akun existing (recommended untuk keamanan)
                // Option 2: Auto-merge (lebih convenient tapi kurang aman)
                
                // Gunakan Option 2: Auto-merge jika user login dengan email yang sama
                // Update akun existing dengan Google ID
                $link_result = $this->user_model->link_google_account($user_by_email['id_user'], $google_user);
                
                if ($link_result['success']) {
                    // Login sebagai user existing
                    $updated_user = $this->user_model->get_user_by_id($user_by_email['id_user']);
                    $this->set_user_session($updated_user);
                    
                    $this->session->set_flashdata('success', 'Akun Google Anda berhasil dihubungkan!');
                    redirect($this->get_dashboard_url($updated_user['role']));
                } else {
                    $this->session->set_flashdata('error', $link_result['message']);
                    redirect('auth/login');
                }
                
            } else {
                // User benar-benar baru, buat akun baru
                $new_user = $this->user_model->create_user_from_google($google_user);
                
                if ($new_user) {
                    // Set session
                    $this->set_user_session($new_user);
                    
                    // Log activity
                    $this->user_model->log_activity($new_user['id_user'], 'Register', 'User mendaftar via Google OAuth');
                    
                    // Redirect ke dashboard dengan welcome message
                    $this->session->set_flashdata('success', 'Selamat datang di KixEra, ' . $new_user['nama'] . '! Akun Anda telah dibuat. Anda mendapat trial 7 hari gratis.');
                    redirect($this->get_dashboard_url($new_user['role']));
                    
                } else {
                    log_message('error', 'Failed to create user from Google data');
                    $this->session->set_flashdata('error', 'Gagal membuat akun. Silakan coba lagi atau hubungi administrator.');
                    redirect('auth/login');
                }
            }
        }
    }
    
    /**
     * Link Google Account (Optional)
     * Untuk user yang sudah login dan ingin menghubungkan akun Google
     */
    public function link_google() {
        // Cek apakah user sudah login
        if (!$this->is_logged_in()) {
            redirect('auth/login');
            return;
        }
        
        // Load library
        $this->load->library('google_oauth');
        
        // Jika ini adalah callback dari Google
        $code = $this->input->get('code');
        if ($code) {
            $state = $this->input->get('state');
            $google_user = $this->google_oauth->authenticate($code, $state);
            
            if ($google_user) {
                $id_user = $this->session->userdata('id_user');
                $result = $this->user_model->link_google_account($id_user, $google_user);
                
                $this->session->set_flashdata(
                    $result['success'] ? 'success' : 'error',
                    $result['message']
                );
            } else {
                $this->session->set_flashdata('error', 'Gagal menghubungkan akun Google');
            }
            
            redirect('pemilik/profile'); // Sesuaikan dengan halaman profile Anda
            return;
        }
        
        // Redirect ke Google OAuth
        $this->google_oauth->redirect();
    }
    
    // ========================================
    // FORGOT PASSWORD METHODS
    // ========================================
    
    /**
     * Forgot Password - Request reset token
     */
    public function forgot_password()
    {
        // If already logged in, redirect
        if ($this->is_logged_in()) {
            $role = $this->session->userdata('role');
            redirect($this->get_dashboard_url($role));
        }
        
        // Handle POST request
        if ($this->input->method() === 'post') {
            $this->process_forgot_password();
            return;
        }
        
        // Show forgot password form
        $data['page_title'] = 'Forgot Password - KixEra';
        $this->load->view('auth/forgot_password', $data);
    }
    
    /**
     * Process forgot password request
     */
    private function process_forgot_password()
    {
        $email = $this->input->post('email', TRUE);
        
        // Validate email
        if (empty($email)) {
            $response = [
                'success' => false,
                'message' => 'Email harus diisi'
            ];
            
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }
            
            $this->session->set_flashdata('error', $response['message']);
            redirect('auth/forgot_password');
            return;
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response = [
                'success' => false,
                'message' => 'Format email tidak valid'
            ];
            
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }
            
            $this->session->set_flashdata('error', $response['message']);
            redirect('auth/forgot_password');
            return;
        }
        
        // Create reset token
        $token_data = $this->user_model->create_reset_token($email);
        
        if ($token_data) {
            // Generate reset link
            $reset_link = base_url('auth/reset_password/' . $token_data['token']);
            
            // Log activity
            $this->user_model->log_activity(0, 'Forgot Password', 'Password reset requested for: ' . $email);
            
            $response = [
                'success' => true,
                'message' => 'Reset link berhasil dibuat',
                'reset_link' => $reset_link,
                'expires_at' => $token_data['expires_at'],
                'email' => $email
            ];
            
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }
            
            // Store in session for display
            $this->session->set_flashdata('reset_link', $reset_link);
            $this->session->set_flashdata('success', 'Reset link berhasil dibuat');
            redirect('auth/forgot_password');
            
        } else {
            // Don't reveal if email exists or not (security)
            $response = [
                'success' => true,
                'message' => 'Jika email terdaftar, link reset password akan ditampilkan'
            ];
            
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }
            
            $this->session->set_flashdata('info', $response['message']);
            redirect('auth/forgot_password');
        }
    }
    
    /**
     * Reset Password - Using token
     */
    public function reset_password($token = null)
    {
        // If already logged in, redirect
        if ($this->is_logged_in()) {
            $role = $this->session->userdata('role');
            redirect($this->get_dashboard_url($role));
        }
        
        if (!$token) {
            $this->session->set_flashdata('error', 'Token reset tidak valid');
            redirect('auth/login');
            return;
        }
        
        // Validate token
        $token_data = $this->user_model->validate_reset_token($token);
        
        if (!$token_data) {
            $this->session->set_flashdata('error', 'Token tidak valid, sudah digunakan, atau kadaluarsa');
            redirect('auth/login');
            return;
        }
        
        // Handle POST request (password reset submission)
        if ($this->input->method() === 'post') {
            $this->process_reset_password($token);
            return;
        }
        
        // Show reset password form
        $data['page_title'] = 'Reset Password - KixEra';
        $data['token'] = $token;
        $data['email'] = $token_data['email'];
        $data['username'] = $token_data['username'];
        $this->load->view('auth/reset_password', $data);
    }
    
    /**
     * Process password reset
     */
    private function process_reset_password($token)
    {
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        
        // Validate
        if (empty($password) || empty($confirm_password)) {
            $response = [
                'success' => false,
                'message' => 'Password dan konfirmasi password harus diisi'
            ];
            
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }
            
            $this->session->set_flashdata('error', $response['message']);
            redirect('auth/reset_password/' . $token);
            return;
        }
        
        if ($password !== $confirm_password) {
            $response = [
                'success' => false,
                'message' => 'Password dan konfirmasi password tidak cocok'
            ];
            
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }
            
            $this->session->set_flashdata('error', $response['message']);
            redirect('auth/reset_password/' . $token);
            return;
        }
        
        if (strlen($password) < 8) {
            $response = [
                'success' => false,
                'message' => 'Password minimal 8 karakter'
            ];
            
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }
            
            $this->session->set_flashdata('error', $response['message']);
            redirect('auth/reset_password/' . $token);
            return;
        }
        
        // Reset password
        if ($this->user_model->reset_password_with_token($token, $password)) {
            $response = [
                'success' => true,
                'message' => 'Password berhasil direset. Silakan login dengan password baru Anda.',
                'redirect' => base_url('auth/login')
            ];
            
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }
            
            $this->session->set_flashdata('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
            redirect('auth/login');
            
        } else {
            $response = [
                'success' => false,
                'message' => 'Gagal mereset password. Token mungkin sudah tidak valid.'
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

}
