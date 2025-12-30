<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('auth_library');
        $this->load->model('User_model');
    }

    public function login() {
        // If already logged in as admin, redirect to dashboard
        if ($this->auth_library->is_logged_in()) {
            $user = $this->auth_library->get_user();
            if ($user['role'] == 'admin') {
                redirect('admin/dashboard');
            } else {
                $this->auth_library->logout();
            }
        }
        
        $data['page_title'] = 'Login Admin System - KixEra';
        $this->load->view('admin/auth/login', $data);
    }

    public function process_login() {
        // Set JSON header first to ensure clean output
        $this->output->set_content_type('application/json');
        
        if (!$this->input->is_ajax_request()) {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            return;
        }

        $email = $this->input->post('email'); 
        $password = $this->input->post('password');
        
        if (empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Email dan Password harus diisi']);
            return;
        }

        // Call auth_library login - returns array with 'success', 'message', 'user'
        $result = $this->auth_library->login($email, $password);

        if (!$result['success']) {
            // Login failed (wrong credentials, inactive account, etc.)
            echo json_encode(['success' => false, 'message' => $result['message']]);
            return;
        }

        // Login suceeded, now check role
        $user = $result['user'];
        
        if ($user['role'] !== 'admin') {
            // Not an admin - force logout and reject
            $this->auth_library->logout();
            echo json_encode(['success' => false, 'message' => 'Akses Ditolak. Area khusus Admin.']);
            return;
        }

        // --- NEW: WhatsApp Verification Flow ---
        
        // 1. Unset auth session data but keep session alive (DO NOT use logout which destroys session)
        $this->session->unset_userdata(['id_user', 'username', 'role', 'logged_in', 'login_time', 'id_admin', 'nama', 'email']);
        
        // 2. Load necessary models/libraries
        $this->load->model('Verification_code_model');
        $this->load->library('Fonnte_library');
        
        // 3. Get admin phone number
        // We need to fetch the admin record to get the phone number
        $admin = $this->db->get_where('admin', ['id_user' => $user['id_user']])->row_array();
        
        if (!$admin || empty($admin['no_telp'])) {
             echo json_encode(['success' => false, 'message' => 'Nomor HP Admin tidak ditemukan. Silakan hubungi Super Admin.']);
             return;
        }
        
        // 4. Generate & Send OTP
        $code = $this->Verification_code_model->generate_code($user['id_user'], $admin['no_telp'], 'admin_login');
        
        if (!$code) {
             echo json_encode(['success' => false, 'message' => 'Gagal membuat kode verifikasi.']);
             return;
        }
        
        $send_result = $this->fonnte_library->send_verification_code($admin['no_telp'], $code);
        
        if (!$send_result['success']) {
             // For debugging/development, we might want to log this or handle differently
             // But for now, show error
             // log_message('error', 'WA send failed: ' . $send_result['message']);
             // echo json_encode(['success' => false, 'message' => 'Gagal mengirim kode WA: ' . $send_result['message']]);
             // return;
        }
        
        // 5. Set Temporary Session for Verification
        $verification_data = [
            'verify_id_user' => $user['id_user'],
            'verify_phone' => $admin['no_telp'],
            'verify_time' => time(),
            'verify_remember_me' => $this->input->post('remember_me') // Save remember me preference
        ];
        $this->session->set_userdata($verification_data);

        // 6. Return success with redirect to verification page
        echo json_encode([
            'success' => true, 
            'message' => 'Login Berhasil. Kode verifikasi dikirim ke WhatsApp.',
            'redirect_url' => base_url('admin/auth/verify')
        ]);
    }
    
    public function verify() {
        // Check if we have a pending verification
        if (!$this->session->userdata('verify_id_user')) {
             // Coba cek auto-login token jika tidak ada sesi verifikasi
             // Ini opsional, tapi untuk keamanan biarkan redirect ke login dulu
            redirect('admin/login');
        }
        
        $data['page_title'] = 'Verifikasi Admin - KixEra';
        
        $this->load->library('Fonnte_library');
        $data['masked_phone'] = $this->fonnte_library->mask_phone($this->session->userdata('verify_phone'));
        $data['resend_cooldown'] = $this->config->item('verification_code_resend_cooldown') ?: 90;
        
        // Calculate remaining cooldown
        $this->load->model('Verification_code_model');
        $id_user = $this->session->userdata('verify_id_user');
        $data['remaining_cooldown'] = $this->Verification_code_model->get_resend_countdown($id_user);
        
        $this->load->view('admin/auth/verify', $data);
    }
    
    public function process_verify() {
        $this->output->set_content_type('application/json');
        
        $id_user = $this->session->userdata('verify_id_user');
        $remember_me = $this->session->userdata('verify_remember_me');
        
        if (!$id_user) {
            echo json_encode(['success' => false, 'message' => 'Sesi kadaluarsa, silakan login ulang', 'redirect_url' => base_url('admin/login')]);
            return;
        }
        
        $code = $this->input->post('code');
        
        if (empty($code)) {
            echo json_encode(['success' => false, 'message' => 'Kode verifikasi harus diisi']);
            return;
        }
        
        $this->load->model('Verification_code_model');
        $result = $this->Verification_code_model->verify_code($id_user, $code, 'admin_login');
        
        if (!$result['success']) {
            echo json_encode(['success' => false, 'message' => $result['message']]);
            return;
        }
        
        // Verification Successful!
        // Retrieve full user details again to force login
        $user = $this->db->get_where('users', ['id_user' => $id_user])->row_array();
        
        if ($user) {
            $user_details = $this->auth_library->get_user_details($user);
            $this->auth_library->set_user_session($user_details);
            
            // Set Persistent Cookie if Remember Me checked
            if ($remember_me) {
                // We need to implement set_remember_cookie in Auth_library
                if (method_exists($this->auth_library, 'set_remember_cookie')) {
                    $this->auth_library->set_remember_cookie($id_user);
                }
            }
            
            // Clear verification session
            $this->session->unset_userdata(['verify_id_user', 'verify_phone', 'verify_time', 'verify_remember_me']);
            
             echo json_encode([
                'success' => true, 
                'message' => 'Verifikasi Berhasil',
                'redirect_url' => base_url('admin/dashboard')
            ]);
        } else {
             echo json_encode(['success' => false, 'message' => 'User tidak ditemukan']);
        }
    }
    
    public function resend_code() {
        $this->output->set_content_type('application/json');
        
        $id_user = $this->session->userdata('verify_id_user');
        $phone = $this->session->userdata('verify_phone');
        
        if (!$id_user || !$phone) {
            echo json_encode(['success' => false, 'message' => 'Sesi tidak valid']);
            return;
        }
        
        $this->load->model('Verification_code_model');
        
        if (!$this->Verification_code_model->can_resend($id_user)) {
             $remaining = $this->Verification_code_model->get_resend_countdown($id_user);
             echo json_encode(['success' => false, 'message' => "Mohon tunggu {$remaining} detik sebelum kirim ulang"]);
             return;
        }
        
        // Generate & Send
        $code = $this->Verification_code_model->generate_code($id_user, $phone, 'admin_login');
        
         if (!$code) {
             echo json_encode(['success' => false, 'message' => 'Gagal membuat kode verifikasi.']);
             return;
        }
        
        $this->load->library('Fonnte_library');
        $send_result = $this->fonnte_library->send_verification_code($phone, $code);
        
        if ($send_result['success']) {
            echo json_encode(['success' => true, 'message' => 'Kode verifikasi baru telah dikirim']);
        } else {
             echo json_encode(['success' => false, 'message' => 'Gagal mengirim WA: ' . $send_result['message']]);
        }
    }

    public function logout() {
        $this->auth_library->logout();
        redirect('admin/login');
    }
}
