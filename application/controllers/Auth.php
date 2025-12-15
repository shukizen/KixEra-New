<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('auth_library');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }
    
    /**
     * Index - redirect ke login
     */
    public function index() {
        if ($this->auth_library->is_logged_in()) {
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
        if ($this->auth_library->is_logged_in()) {
            $role = $this->session->userdata('role');
            redirect($this->get_dashboard_url($role));
        }
        
        // Handle request POST (percobaan login)
        if ($this->input->method() === 'post') {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            
            // Validasi input
            if (empty($username) || empty($password)) {
                $response = [
                    'success' => false,
                    'message' => 'Username dan password harus diisi'
                ];
                
                if ($this->input->is_ajax_request()) {
                    echo json_encode($response);
                    return;
                }
                
                $this->session->set_flashdata('error', $response['message']);
                redirect('auth/login');
                return;
            }
            
            // Coba login
            $result = $this->auth_library->login($username, $password);
            
            // Kembalikan JSON untuk request AJAX
            if ($this->input->is_ajax_request()) {
                echo json_encode($result);
                return;
            }
            
            // Handle submit form normal
            if ($result['success']) {
                $this->session->set_flashdata('success', $result['message']);
                redirect($result['redirect']);
            } else {
                $this->session->set_flashdata('error', $result['message']);
                if (isset($result['subscription_expired']) && $result['subscription_expired']) {
                    redirect('auth/subscription_expired');
                } else {
                    redirect('auth/login');
                }
            }
            return;
        }
        
        // Tampilkan view login
        $data['page_title'] = 'Login - KixEra';
        $this->load->view('auth/login', $data);
    }
    
    /**
     * Halaman Register
     */
    public function register() {
        // Jika sudah login, redirect
        if ($this->auth_library->is_logged_in()) {
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
        // Ambil data form
        $full_name = $this->input->post('fullName', TRUE);
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);
        $confirm_password = $this->input->post('confirmPassword', TRUE);
        
        // Validasi
        $errors = [];
        
        if (empty($full_name)) {
            $errors[] = 'Nama lengkap harus diisi';
        }
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email tidak valid';
        }
        
        if (empty($password) || strlen($password) < 8) {
            $errors[] = 'Password minimal 8 karakter';
        }
        
        if ($password !== $confirm_password) {
            $errors[] = 'Password tidak cocok';
        }
        
        // Cek apakah email sudah ada
        $this->db->where('email', $email);
        if ($this->db->count_all_results('pemilik') > 0) {
            $errors[] = 'Email sudah terdaftar';
        }
        
        if (!empty($errors)) {
            $response = [
                'success' => false,
                'errors' => $errors,
                'message' => implode(', ', $errors)
            ];
            
            if ($this->input->is_ajax_request()) {
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('error', implode('<br>', $errors));
                redirect('auth/register');
            }
            return;
        }
        
        // Generate username unik
        $username = $this->generate_unique_username($full_name);
        
        // Mulai transaksi
        $this->db->trans_start();
        
        // Buat akun user
        $user_data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Gunakan password_hash daripada md5
            'role' => 'owner',
            'status' => 'aktif',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('users', $user_data);
        $id_user = $this->db->insert_id();
        
        // Buat record pemilik
        $pemilik_data = [
            'id_user' => $id_user,
            'nama' => $full_name,
            'email' => $email,
            'nama_usaha' => $full_name . "'s Business",
            'status_langganan' => 'trial',
            'id_paket' => null,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('pemilik', $pemilik_data);
        $id_pemilik = $this->db->insert_id();
        
        // Buat cabang default
        $cabang_data = [
            'id_pemilik' => $id_pemilik,
            'nama_cabang' => 'Cabang Utama',
            'alamat' => '',
            'no_telp' => '',
            'status' => 'aktif',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('cabang', $cabang_data);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            $response = [
                'success' => false,
                'message' => 'Gagal membuat akun. Silakan coba lagi.'
            ];
            
            if ($this->input->is_ajax_request()) {
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('error', $response['message']);
                redirect('auth/register');
            }
            return;
        }
        
        // Login otomatis setelah registrasi
        $login_result = $this->auth_library->login($username, $password);
        
        $response = [
            'success' => true,
            'message' => 'Registrasi berhasil! Selamat datang di KixEra. Anda mendapat trial 7 hari gratis.',
            'redirect' => $login_result['redirect']
        ];
        
        if ($this->input->is_ajax_request()) {
            echo json_encode($response);
        } else {
            $this->session->set_flashdata('success', $response['message']);
            redirect($login_result['redirect']);
        }
    }
    
    /**
     * Generate username unik
     */
    private function generate_unique_username($full_name) {
        $base_username = strtolower(str_replace(' ', '', $full_name));
        $username = $base_username . rand(100, 999);
        
        // Cek keunikan
        $counter = 1;
        while (true) {
            $this->db->where('username', $username);
            if ($this->db->count_all_results('users') == 0) {
                break;
            }
            $username = $base_username . rand(1000, 9999);
            $counter++;
            
            // Cegah loop tak terbatas
            if ($counter > 10) {
                $username = $base_username . uniqid();
                break;
            }
        }
        
        return $username;
    }
    
    /**
     * Google OAuth - Inisiasi
     */
    public function google() {
        try {
            // Cek apakah library Google OAuth ada
            if (!file_exists(APPPATH . 'libraries/Google_oauth.php')) {
                $this->session->set_flashdata('error', 'Google OAuth belum dikonfigurasi');
                redirect('auth/login');
                return;
            }
            
            $this->load->library('google_oauth');
            
            // Cek apakah ini callback dari Google
            if ($this->input->get('code')) {
                $this->handle_google_callback();
            } else {
                // Redirect ke Google OAuth
                $this->google_oauth->redirect();
            }
        } catch (Exception $e) {
            log_message('error', 'Google OAuth error: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menghubungkan dengan Google');
            redirect('auth/login');
        }
    }
    
    /**
     * Handle Google OAuth callback
     */
    private function handle_google_callback() {
        $this->load->library('google_oauth');
        
        try {
            // Dapatkan info user dari Google
            $google_user = $this->google_oauth->get_user_info();
            
            if (!$google_user) {
                $this->session->set_flashdata('error', 'Gagal mendapatkan informasi dari Google');
                redirect('auth/login');
                return;
            }
            
            // Cek apakah user sudah ada berdasarkan email
            $this->db->where('email', $google_user['email']);
            $query = $this->db->get('pemilik');
            
            if ($query->num_rows() > 0) {
                // User ada, login
                $pemilik = $query->row_array();
                
                $this->db->where('id_user', $pemilik['id_user']);
                $user_query = $this->db->get('users');
                
                if ($user_query->num_rows() == 0) {
                    $this->session->set_flashdata('error', 'Akun tidak ditemukan');
                    redirect('auth/login');
                    return;
                }
                
                $user = $user_query->row_array();
                
                if ($user['status'] !== 'aktif') {
                    $this->session->set_flashdata('error', 'Akun Anda tidak aktif');
                    redirect('auth/login');
                    return;
                }
                
                // Setup session manual untuk login OAuth
                $user_details = $this->get_user_details_for_oauth($user);
                
                if ($user['role'] === 'owner') {
                    $subscription_check = $this->auth_library->check_subscription_status($pemilik['id_pemilik']);
                    $user_details['subscription'] = $subscription_check;
                }
                
                $this->set_oauth_session($user_details);
                
                $this->session->set_flashdata('success', 'Login berhasil!');
                redirect($this->get_dashboard_url($user['role']));
                
            } else {
                // User baru, buat akun
                $this->register_google_user($google_user);
            }
            
        } catch (Exception $e) {
            log_message('error', 'Google OAuth callback error: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat login dengan Google');
            redirect('auth/login');
        }
    }
    
    /**
     * Dapatkan detail user untuk OAuth (tanpa memanggil method private auth_library)
     */
    private function get_user_details_for_oauth($user) {
        $details = [
            'id_user' => $user['id_user'],
            'username' => $user['username'],
            'role' => $user['role']
        ];
        
        if ($user['role'] === 'owner') {
            $this->db->select('p.*, pl.nama_paket, pl.harga as harga_paket');
            $this->db->from('pemilik p');
            $this->db->join('paket_langganan pl', 'p.id_paket = pl.id_paket', 'left');
            $this->db->where('p.id_user', $user['id_user']);
            $query = $this->db->get();
            
            if ($query->num_rows() == 1) {
                $pemilik = $query->row_array();
                $details = array_merge($details, $pemilik);
            }
        }
        
        return $details;
    }
    
    /**
     * Set session OAuth
     */
    private function set_oauth_session($user_details) {
        $session_data = [
            'id_user' => $user_details['id_user'],
            'username' => $user_details['username'],
            'role' => $user_details['role'],
            'logged_in' => true,
            'login_time' => time()
        ];
        
        if ($user_details['role'] === 'owner') {
            $session_data['id_pemilik'] = $user_details['id_pemilik'];
            $session_data['nama'] = $user_details['nama'];
            $session_data['email'] = $user_details['email'];
            $session_data['nama_usaha'] = $user_details['nama_usaha'];
            $session_data['status_langganan'] = $user_details['status_langganan'];
            $session_data['paket'] = $user_details['nama_paket'] ?? 'Trial';
            
            if (isset($user_details['subscription'])) {
                $session_data['subscription'] = $user_details['subscription'];
            }
        }
        
        $this->session->set_userdata($session_data);
    }
    
    /**
     * Register user dari Google OAuth
     */
    private function register_google_user($google_user) {
        $this->db->trans_start();
        
        // Generate username unik dari email
        $username = $this->generate_unique_username($google_user['name']);
        
        // Buat user
        $user_data = [
            'username' => $username,
            'password' => password_hash(uniqid(), PASSWORD_DEFAULT), // Password acak untuk user OAuth
            'role' => 'owner',
            'status' => 'aktif',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('users', $user_data);
        $id_user = $this->db->insert_id();
        
        // Buat pemilik
        $pemilik_data = [
            'id_user' => $id_user,
            'nama' => $google_user['name'],
            'email' => $google_user['email'],
            'nama_usaha' => $google_user['name'] . "'s Business",
            'foto_profil' => $google_user['picture'] ?? null,
            'status_langganan' => 'trial',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('pemilik', $pemilik_data);
        $id_pemilik = $this->db->insert_id();
        
        // Buat cabang default
        $cabang_data = [
            'id_pemilik' => $id_pemilik,
            'nama_cabang' => 'Cabang Utama',
            'alamat' => '',
            'no_telp' => '',
            'status' => 'aktif',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('cabang', $cabang_data);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Gagal membuat akun');
            redirect('auth/login');
            return;
        }
        
        // Dapatkan detail user dan set session
        $this->db->where('id_user', $id_user);
        $user = $this->db->get('users')->row_array();
        
        $user_details = $this->get_user_details_for_oauth($user);
        $subscription_check = $this->auth_library->check_subscription_status($id_pemilik);
        $user_details['subscription'] = $subscription_check;
        
        $this->set_oauth_session($user_details);
        
        $this->session->set_flashdata('success', 
            'Selamat datang di KixEra! Anda mendapat trial 7 hari gratis.');
        redirect($this->get_dashboard_url('owner'));
    }
    
    /**
     * Logout
     */
    public function logout() {
        $this->auth_library->logout();
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
     * Cek session (AJAX)
     */
    public function check_session() {
        header('Content-Type: application/json');
        echo json_encode([
            'valid' => $this->auth_library->is_logged_in(),
            'role' => $this->session->userdata('role'),
            'username' => $this->session->userdata('username')
        ]);
    }
    
    /**
     * Dapatkan URL dashboard berdasarkan role - SESUAI STRUKTUR FOLDER
     */
    private function get_dashboard_url($role) {
        switch($role) {
            case 'admin':
                return 'admin/admin_dashboard'; // Mengarah ke folder Admin/admin_dashboard.php
            case 'owner':
                return 'pemilik/pemilik_dashboard'; // Mengarah ke folder Pemilik/Pemilik_Dashboard.php
            case 'karyawan':
                return 'karyawan/karyawan_dashboard'; // Mengarah ke folder Karyawan/Karyawan_dashboard.php
            default:
                return 'auth/login';
        }
    }
}