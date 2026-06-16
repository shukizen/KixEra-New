<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
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
    public function index()
    {
        if ($this->is_logged_in()) {
            $role = $this->session->userdata('role');
            redirect($this->get_dashboard_url($role));
        }
        redirect('auth/login');
    }

    /**
     * Halaman Login
     */
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->is_logged_in()) {
            $role = $this->session->userdata('role');
            redirect($this->get_dashboard_url($role));
        }

        // Capture redirect_url from GET parameter and store in session
        $redirect_url = $this->input->get('redirect_url');
        if ($redirect_url) {
            $decoded_url = urldecode($redirect_url);
            $this->session->set_userdata('redirect_after_login', $decoded_url);

            // Check if redirecting from subscription/checkout
            if (strpos($decoded_url, 'pembayaran/checkout') !== false) {
                $this->session->set_flashdata('info', 'Silakan login terlebih dahulu untuk melanjutkan berlangganan. Belum punya akun? <a href="' . base_url('auth/register') . '" class="underline font-semibold">Daftar di sini</a>');
            }
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
    private function process_login()
    {
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

        if ($user === 'INACTIVE_ACCOUNT') {
            $response = [
                'success' => false,
                'message' => 'Akun Anda tidak aktif. Silakan hubungi administrator.'
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

        if ($user) {
            // Security: Prevent Admin from logging in via Standard Portal
            if ($user['role'] === 'admin') {
                $response = [
                    'success' => false,
                    'message' => 'Akses Ditolak. Akun Admin tidak diizinkan login di halaman ini.'
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
                    // Set session users first so they can access payment page
                    $this->set_user_session($user);
                    $this->session->set_userdata('subscription_expired', true);

                    $response = [
                        'success' => false,
                        'message' => 'Langganan Anda telah berakhir. Silakan perpanjang langganan.',
                        'subscription_expired' => true,
                        'redirect' => base_url('auth/subscription_expired')
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

            // Clear subscription_expired flag if valid
            $this->session->unset_userdata('subscription_expired');

            // Log activity
            $this->user_model->log_activity($user['id_user'], 'Login', 'User login ke sistem');

            // Check for redirect_after_login in session
            $redirect_after_login = $this->session->userdata('redirect_after_login');
            if ($redirect_after_login) {
                $this->session->unset_userdata('redirect_after_login');
                $redirect_url = $redirect_after_login;
            } else {
                $redirect_url = base_url($this->get_dashboard_url($user['role']));
            }

            $response = [
                'success' => true,
                'message' => 'Login berhasil!',
                'redirect' => $redirect_url
            ];

            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
                return;
            }

            $this->session->set_flashdata('success', 'Selamat datang, ' . $user['nama']);
            redirect($redirect_url);
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
    public function register()
    {
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
     * Proses registrasi - Step 1: Validasi dan Kirim OTP
     */
    private function process_registration()
    {
        // Clear previous selected OTP channel session
        $this->session->unset_userdata('selected_otp_channel');

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
            } elseif (!preg_match('/^(08|628|\+628)[0-9]{8,12}$/', preg_replace('/[^0-9+]/', '', $phone_number))) {
                $errors[] = 'Format nomor telepon tidak valid (contoh: 081234567890)';
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

            // Load Fonnte library
            $this->load->library('fonnte_library');

            // Generate TWO separate 6-digit OTPs
            $wa_otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $email_otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            // Set timezone to WIB for consistent expiry calculation
            date_default_timezone_set('Asia/Jakarta');
            $expire_time = date('Y-m-d H:i:s', strtotime('+5 minutes'));
            $sent_time = date('Y-m-d H:i:s');

            // Hash password untuk storage
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Normalize phone number
            $normalized_phone = $this->fonnte_library->normalize_phone($phone_number);

            // Check if email already in pending (delete old one)
            $this->db->where('email', $email)->delete('pending_registrations');

            // Insert to pending_registrations with DUAL OTP
            $pending_data = [
                'nama' => $full_name,
                'email' => $email,
                'password_hash' => $password_hash,
                'nama_usaha' => $business_name,
                'no_telp' => $normalized_phone,
                'wa_verification_code' => $wa_otp,
                'wa_code_expires_at' => $expire_time,
                'wa_code_sent_at' => $sent_time,
                'email_verification_code' => $email_otp,
                'email_code_expires_at' => $expire_time,
                'email_code_sent_at' => $sent_time,
                'attempts' => 0,
                'wa_verified' => 0,
                'email_verified' => 0,
                'is_verified' => 0
            ];

            if (!$this->db->insert('pending_registrations', $pending_data)) {
                throw new Exception('Gagal menyimpan data registrasi sementara');
            }

            $pending_id = $this->db->insert_id();

            // Store pending ID in session for verification
            $this->session->set_userdata([
                'pending_registration_id' => $pending_id,
                'pending_registration_email' => $email,
                'pending_registration_phone' => $this->fonnte_library->mask_phone($normalized_phone)
            ]);

            // Success - redirect to verification page (to select OTP channel first)
            $msg = "Registrasi awal berhasil. Silakan pilih metode verifikasi.";

            if ($is_ajax) {
                echo json_encode([
                    'success' => true,
                    'message' => $msg,
                    'redirect' => base_url('auth/verify_registration')
                ]);
                return;
            } else {
                $this->session->set_flashdata('success', $msg);
                redirect('auth/verify_registration');
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
     * Halaman verifikasi registrasi (input OTP)
     */
    public function verify_registration()
    {
        // Cek apakah ada pending registration
        $pending_id = $this->session->userdata('pending_registration_id');

        if (!$pending_id) {
            $this->session->set_flashdata('error', 'Silakan isi form registrasi terlebih dahulu.');
            redirect('auth/register');
            return;
        }

        // Get pending data
        $pending = $this->db->get_where('pending_registrations', ['id_pending' => $pending_id])->row();

        if (!$pending || $pending->is_verified) {
            $this->session->unset_userdata(['pending_registration_id', 'pending_registration_email', 'pending_registration_phone', 'selected_otp_channel']);
            $this->session->set_flashdata('error', 'Data registrasi tidak ditemukan atau sudah diverifikasi.');
            redirect('auth/register');
            return;
        }

        // Get selected channel
        $selected_channel = $this->session->userdata('selected_otp_channel');

        $wa_countdown = 0;
        $email_countdown = 0;
        $wa_expire = 0;
        $email_expire = 0;
        $cooldown = 90; // seconds

        date_default_timezone_set('Asia/Jakarta');

        if ($selected_channel === 'wa') {
            $wa_last_sent = strtotime($pending->wa_code_sent_at);
            $wa_elapsed = time() - $wa_last_sent;
            $wa_countdown = max(0, $cooldown - $wa_elapsed);
            $wa_expire = max(0, strtotime($pending->wa_code_expires_at) - time());
        } elseif ($selected_channel === 'email') {
            $email_last_sent = strtotime($pending->email_code_sent_at);
            $email_elapsed = time() - $email_last_sent;
            $email_countdown = max(0, $cooldown - $email_elapsed);
            $email_expire = max(0, strtotime($pending->email_code_expires_at) - time());
        }

        // Load Fonnte for masked phone
        $this->load->library('fonnte_library');

        $data = [
            'page_title' => 'Verifikasi Registrasi - KixEra',
            'email' => $pending->email,
            'masked_phone' => $this->fonnte_library->mask_phone($pending->no_telp),
            'nama' => $pending->nama,
            'selected_channel' => $selected_channel,
            'wa_countdown' => $wa_countdown,
            'email_countdown' => $email_countdown,
            'wa_expire_seconds' => $wa_expire,
            'email_expire_seconds' => $email_expire,
            'wa_verified' => $pending->wa_verified,
            'email_verified' => $pending->email_verified
        ];

        $this->load->view('auth/register_verify', $data);
    }

    /**
     * Memilih channel verifikasi registrasi dan kirim OTP
     */
    public function select_verification_channel()
    {
        $this->output->set_content_type('application/json');

        $pending_id = $this->session->userdata('pending_registration_id');
        $channel = $this->input->post('channel'); // 'wa' or 'email'

        if (!$pending_id) {
            echo json_encode(['success' => false, 'message' => 'Sesi registrasi tidak valid.']);
            return;
        }

        if ($channel !== 'wa' && $channel !== 'email') {
            echo json_encode(['success' => false, 'message' => 'Metode verifikasi tidak valid.']);
            return;
        }

        // Get pending data
        $pending = $this->db->get_where('pending_registrations', ['id_pending' => $pending_id])->row();
        if (!$pending) {
            echo json_encode(['success' => false, 'message' => 'Data registrasi tidak ditemukan.']);
            return;
        }

        // Save choice in session
        $this->session->set_userdata('selected_otp_channel', $channel);

        // Send OTP based on choice
        date_default_timezone_set('Asia/Jakarta');
        $now = time();
        $update_data = [];
        $success = false;
        $msg = '';

        if ($channel === 'wa') {
            // Generate/Refresh WA OTP
            $wa_otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $update_data['wa_verification_code'] = $wa_otp;
            $update_data['wa_code_expires_at'] = date('Y-m-d H:i:s', $now + 300);
            $update_data['wa_code_sent_at'] = date('Y-m-d H:i:s');

            $this->load->library('fonnte_library');
            $result = $this->fonnte_library->send_registration_code($pending->no_telp, $wa_otp, $pending->nama);

            if ($result['success']) {
                $success = true;
                $msg = 'Kode verifikasi telah dikirim ke WhatsApp Anda.';
            } else {
                log_message('error', 'Failed to send WhatsApp OTP on selection: ' . json_encode($result));
                $msg = 'Gagal mengirim WhatsApp OTP: ' . ($result['message'] ?? 'Koneksi API error');
            }
        } else {
            // Generate/Refresh Email OTP
            $email_otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $update_data['email_verification_code'] = $email_otp;
            $update_data['email_code_expires_at'] = date('Y-m-d H:i:s', $now + 300);
            $update_data['email_code_sent_at'] = date('Y-m-d H:i:s');

            $this->load->library('email_library');
            $result = $this->email_library->send_registration_verification($pending->email, $pending->nama, $email_otp);

            if ($result['success']) {
                $success = true;
                $msg = 'Kode verifikasi telah dikirim ke Email Anda.';
            } else {
                log_message('error', 'Failed to send Email OTP on selection: ' . json_encode($result));
                $msg = 'Gagal mengirim Email OTP: ' . ($result['message'] ?? 'SMTP error');
            }
        }

        // Reset attempts
        $update_data['attempts'] = 0;
        $this->db->where('id_pending', $pending_id)->update('pending_registrations', $update_data);

        echo json_encode([
            'success' => $success,
            'message' => $msg,
            'channel' => $channel
        ]);
    }

    /**
     * Membatalkan channel verifikasi terpilih dan kembali ke menu pemilihan
     */
    public function change_verification_channel()
    {
        $this->session->unset_userdata('selected_otp_channel');
        redirect('auth/verify_registration');
    }

    /**
     * Proses verifikasi OTP registrasi (Berdasarkan channel terpilih)
     */
    public function process_verify_registration()
    {
        $this->output->set_content_type('application/json');

        $pending_id = $this->session->userdata('pending_registration_id');
        $selected_channel = $this->session->userdata('selected_otp_channel');

        if (!$pending_id || !$selected_channel) {
            echo json_encode(['success' => false, 'message' => 'Sesi registrasi tidak valid.']);
            return;
        }

        $otp = $this->input->post('otp');

        // Get pending registration
        $pending = $this->db->get_where('pending_registrations', ['id_pending' => $pending_id])->row();

        if (!$pending) {
            echo json_encode(['success' => false, 'message' => 'Data registrasi tidak ditemukan.']);
            return;
        }

        date_default_timezone_set('Asia/Jakarta');
        $errors = [];
        $is_valid = false;

        if ($selected_channel === 'wa') {
            if (empty($otp)) {
                $errors[] = 'Kode verifikasi WhatsApp harus diisi';
            } elseif (strlen($otp) != 6) {
                $errors[] = 'Kode WhatsApp harus 6 digit';
            } elseif (strtotime($pending->wa_code_expires_at) < time()) {
                $errors[] = 'Kode WhatsApp sudah kadaluarsa';
            } elseif ($pending->wa_verification_code !== $otp) {
                $errors[] = 'Kode WhatsApp salah';
            } else {
                $is_valid = true;
            }
        } elseif ($selected_channel === 'email') {
            if (empty($otp)) {
                $errors[] = 'Kode verifikasi Email harus diisi';
            } elseif (strlen($otp) != 6) {
                $errors[] = 'Kode Email harus 6 digit';
            } elseif (strtotime($pending->email_code_expires_at) < time()) {
                $errors[] = 'Kode Email sudah kadaluarsa';
            } elseif ($pending->email_verification_code !== $otp) {
                $errors[] = 'Kode Email salah';
            } else {
                $is_valid = true;
            }
        }

        if (!$is_valid) {
            // Increment attempts
            $this->db->where('id_pending', $pending_id)->update('pending_registrations', [
                'attempts' => $pending->attempts + 1
            ]);
            echo json_encode(['success' => false, 'message' => implode('. ', $errors)]);
            return;
        }

        // Update verified status
        $update_data = ['is_verified' => 1];
        if ($selected_channel === 'wa') {
            $update_data['wa_verified'] = 1;
        } else {
            $update_data['email_verified'] = 1;
        }
        $this->db->where('id_pending', $pending_id)->update('pending_registrations', $update_data);

        // OTP Valid! Create the actual user account
        try {
            $register_data = [
                'nama' => $pending->nama,
                'email' => $pending->email,
                'password' => '', // Will use hash directly
                'nama_usaha' => $pending->nama_usaha,
                'no_telp' => $pending->no_telp
            ];

            // Use direct insert instead of register_owner to use pre-hashed password
            $this->db->trans_begin();

            // Create username from email
            $username = explode('@', $pending->email)[0];
            $username = preg_replace('/[^a-zA-Z0-9]/', '', $username);
            $base_username = $username;
            $counter = 1;
            while ($this->user_model->check_username_exists($username)) {
                $username = $base_username . $counter;
                $counter++;
            }

            // Insert user
            $user_data = [
                'username' => $username,
                'password' => $pending->password_hash, // Use pre-hashed password
                'role' => 'owner',
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('users', $user_data);
            $id_user = $this->db->insert_id();

            // Insert pemilik
            $pemilik_data = [
                'id_user' => $id_user,
                'nama' => $pending->nama,
                'email' => $pending->email,
                'no_telp' => $pending->no_telp,
                'nama_usaha' => $pending->nama_usaha,
                'status_langganan' => 'trial',
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('pemilik', $pemilik_data);
            $id_pemilik = $this->db->insert_id();

            // Create default branch
            $cabang_data = [
                'id_pemilik' => $id_pemilik,
                'nama_cabang' => 'Cabang Utama',
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('cabang', $cabang_data);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Gagal membuat akun');
            }

            $this->db->trans_commit();

            // Build complete user data for session (including pemilik data)
            $user = [
                'id_user' => $id_user,
                'username' => $username,
                'role' => 'owner',
                'id_pemilik' => $id_pemilik,
                'nama' => $pending->nama,
                'email' => $pending->email,
                'nama_usaha' => $pending->nama_usaha,
                'status_langganan' => 'trial',
                'nama_paket' => 'Trial'
            ];

            $this->set_user_session($user);
            $this->user_model->log_activity($id_user, 'Register', 'User mendaftar akun baru (verified via OTP)');

            // Clear pending session
            $this->session->unset_userdata(['pending_registration_id', 'pending_registration_email', 'pending_registration_phone', 'selected_otp_channel']);

            echo json_encode([
                'success' => true,
                'message' => 'Registrasi berhasil! Selamat datang di KixEra.',
                'redirect' => base_url('auth/complete_profile')
            ]);
        } catch (Exception $e) {
            log_message('error', 'Registration completion error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Gagal membuat akun: ' . $e->getMessage()]);
        }
    }

    /**
     * Kirim ulang kode OTP registrasi (supports channel-specific resend)
     */
    public function resend_registration_code()
    {
        $this->output->set_content_type('application/json');

        $pending_id = $this->session->userdata('pending_registration_id');
        $selected_channel = $this->session->userdata('selected_otp_channel');
        $channel = $this->input->post('channel') ?: $selected_channel ?: 'both';

        if (!$pending_id) {
            echo json_encode(['success' => false, 'message' => 'Sesi registrasi tidak valid.']);
            return;
        }

        // Get pending registration
        $pending = $this->db->get_where('pending_registrations', ['id_pending' => $pending_id])->row();

        if (!$pending || $pending->is_verified) {
            echo json_encode(['success' => false, 'message' => 'Data registrasi tidak ditemukan.']);
            return;
        }

        date_default_timezone_set('Asia/Jakarta');
        $cooldown = 90;
        $now = time();
        $update_data = [];
        $messages = [];

        // Check WA cooldown and resend if requested
        if ($channel === 'wa' || $channel === 'both') {
            if ($pending->wa_verified == 1) {
                $messages[] = 'WhatsApp sudah terverifikasi';
            } else {
                $wa_elapsed = $now - strtotime($pending->wa_code_sent_at);
                if ($wa_elapsed < $cooldown) {
                    $remaining = $cooldown - $wa_elapsed;
                    echo json_encode(['success' => false, 'message' => "Tunggu {$remaining} detik untuk kirim ulang kode WhatsApp."]);
                    return;
                }

                // Generate new WA OTP
                $new_wa_otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $update_data['wa_verification_code'] = $new_wa_otp;
                $update_data['wa_code_expires_at'] = date('Y-m-d H:i:s', $now + 300);
                $update_data['wa_code_sent_at'] = date('Y-m-d H:i:s');

                // Send
                $this->load->library('fonnte_library');
                $result = $this->fonnte_library->send_registration_code($pending->no_telp, $new_wa_otp, $pending->nama);
                if ($result['success']) {
                    $messages[] = 'WhatsApp';
                } else {
                    echo json_encode(['success' => false, 'message' => 'Gagal mengirim WhatsApp OTP: ' . ($result['message'] ?? 'Koneksi API error')]);
                    return;
                }
            }
        }

        // Check Email cooldown and resend if requested
        if ($channel === 'email' || $channel === 'both') {
            if ($pending->email_verified == 1) {
                $messages[] = 'Email sudah terverifikasi';
            } else {
                $email_elapsed = $now - strtotime($pending->email_code_sent_at);
                if ($email_elapsed < $cooldown) {
                    $remaining = $cooldown - $email_elapsed;
                    echo json_encode(['success' => false, 'message' => "Tunggu {$remaining} detik untuk kirim ulang kode Email."]);
                    return;
                }

                // Generate new Email OTP
                $new_email_otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $update_data['email_verification_code'] = $new_email_otp;
                $update_data['email_code_expires_at'] = date('Y-m-d H:i:s', $now + 300);
                $update_data['email_code_sent_at'] = date('Y-m-d H:i:s');

                // Send
                $this->load->library('email_library');
                $result = $this->email_library->send_registration_verification($pending->email, $pending->nama, $new_email_otp);
                if ($result['success']) {
                    $messages[] = 'Email';
                } else {
                    echo json_encode(['success' => false, 'message' => 'Gagal mengirim Email OTP: ' . ($result['message'] ?? 'SMTP error')]);
                    return;
                }
            }
        }

        // Update database
        if (!empty($update_data)) {
            $update_data['attempts'] = 0;
            $this->db->where('id_pending', $pending_id)->update('pending_registrations', $update_data);
        }

        if (!empty($messages)) {
            echo json_encode([
                'success' => true,
                'message' => 'Kode baru dikirim ke: ' . implode(' & ', $messages),
                'countdown' => $cooldown
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengirim kode.']);
        }
    }

    /**
     * Set user session
     */
    private function set_user_session($user)
    {
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
            $session_data['id_paket'] = $user['id_paket'] ?? 1; // Default to Basic if null
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
            $session_data['id_pemilik'] = $user['id_pemilik']; // ID pemilik dari cabang
        }

        $this->session->set_userdata($session_data);
    }

    /**
     * Cek subscription untuk owner
     * 
     * Logika Unified:
     * - AKTIF: Cek tgl_akhir_langganan dari transaksi_langganan terakhir yang sukses
     * - TRIAL: Hitung hari sejak created_at (max 7 hari)
     * - NONAKTIF: Selalu expired
     * 
     * @param array $user Data user dari query login
     * @return bool true jika subscription valid
     */
    private function check_subscription($user)
    {
        $id_pemilik = $user['id_pemilik'];

        // CASE 1: Status AKTIF - cek dari transaksi_langganan
        if ($user['status_langganan'] === 'aktif') {
            // Query transaksi langganan terakhir yang sukses
            $this->db->select('tgl_akhir_langganan');
            $this->db->from('transaksi_langganan');
            $this->db->where('id_pemilik', $id_pemilik);
            $this->db->where('status_pembayaran', 'sukses');
            $this->db->order_by('tgl_akhir_langganan', 'DESC');
            $this->db->limit(1);
            $transaksi = $this->db->get()->row();

            if ($transaksi && !empty($transaksi->tgl_akhir_langganan)) {
                $tgl_akhir = strtotime($transaksi->tgl_akhir_langganan);
                $today = strtotime(date('Y-m-d'));

                if ($tgl_akhir >= $today) {
                    return true; // Masih aktif
                } else {
                    // Expired! Auto-update status ke nonaktif
                    $this->db->where('id_pemilik', $id_pemilik);
                    $this->db->update('pemilik', ['status_langganan' => 'nonaktif']);
                    log_message('info', "Subscription expired for id_pemilik: $id_pemilik. Auto-updated to nonaktif.");
                    return false;
                }
            } else {
                // Tidak ada transaksi sukses, tapi status aktif? Kembalikan ke trial atau nonaktif
                // Ini bisa terjadi jika admin set manual. Anggap masih valid untuk sekarang.
                return true;
            }
        }

        // CASE 2: Status TRIAL - hitung 7 hari dari created_at
        if ($user['status_langganan'] === 'trial') {
            $created_date = strtotime($user['created_at']);
            $current_date = time();
            $days_diff = floor(($current_date - $created_date) / (60 * 60 * 24));

            if ($days_diff <= 7) {
                return true; // Trial masih valid
            } else {
                // Trial expired! Auto-update status ke nonaktif
                $this->db->where('id_pemilik', $id_pemilik);
                $this->db->update('pemilik', ['status_langganan' => 'nonaktif']);
                log_message('info', "Trial expired for id_pemilik: $id_pemilik (Day $days_diff). Auto-updated to nonaktif.");
                return false;
            }
        }

        // CASE 3: Status NONAKTIF atau lainnya
        return false;
    }

    /**
     * Logout
     */
    public function logout()
    {
        // Log activity sebelum destroy session
        if ($this->is_logged_in()) {
            $id_user = $this->session->userdata('id_user');
            // Only log if id_user is valid (not null or empty)
            if (!empty($id_user)) {
                $this->user_model->log_activity($id_user, 'Logout', 'User logout dari sistem');
            }
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
    public function subscription_expired()
    {
        $data['page_title'] = 'Langganan Berakhir - KixEra';
        $this->load->view('auth/subscription_expired', $data);
    }

    /**
     * Cek apakah user sudah login
     */
    private function is_logged_in()
    {
        return $this->session->userdata('logged_in') === true;
    }

    /**
     * Cek session (AJAX)
     */
    public function check_session()
    {
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
    private function get_dashboard_url($role)
    {
        switch ($role) {
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
    public function google_login()
    {
        // Load library Google OAuth
        $this->load->library('google_oauth');

        // Redirect ke Google OAuth page
        $this->google_oauth->redirect();
    }

    /**
     * Google Callback - Handle callback dari Google setelah user authorize
     */
    public function google_callback()
    {
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
                    $user_raw = $this->user_model->get_user_by_id($user_by_email['id_user']);
                    $updated_user = $this->user_model->get_user_details($user_raw);
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

                    // Redirect ke halaman Lengkapi Profil
                    $this->session->set_flashdata('success', 'Selamat datang di KixEra, ' . $new_user['nama'] . '! Akun Anda telah berhasil dibuat. Silakan lengkapi profil Anda.');
                    redirect('auth/complete_profile');
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
    public function link_google()
    {
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

            redirect('pemilik/pengaturan');
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

            // Send email with reset link
            $this->load->library('email_library');
            $email_result = $this->email_library->send_password_reset(
                $email,
                $token_data['name'],
                $reset_link
            );

            // Log activity
            $this->user_model->log_activity(0, 'Forgot Password', 'Password reset requested for: ' . $email);

            if ($email_result['success']) {
                $response = [
                    'success' => true,
                    'message' => 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.'
                ];

                if ($this->input->is_ajax_request()) {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                    return;
                }

                // Store success message in session
                $this->session->set_flashdata('email_sent', true);
                $this->session->set_flashdata('success', 'Link reset password telah dikirim ke email Anda');
                redirect('auth/forgot_password');
            } else {
                // Email failed to send
                $response = [
                    'success' => false,
                    'message' => 'Gagal mengirim email. Silakan coba lagi nanti.'
                ];

                if ($this->input->is_ajax_request()) {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($response));
                    return;
                }

                $this->session->set_flashdata('error', $response['message']);
                redirect('auth/forgot_password');
            }
        } else {
            // Don't reveal if email exists or not (security)
            $response = [
                'success' => true,
                'message' => 'Jika email terdaftar, link reset password akan dikirim ke email tersebut'
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

    /**
     * Test Email - Debug endpoint untuk test SMTP
     * Akses: /auth/test_email?to=youremail@example.com
     */
    public function test_email()
    {
        $this->output->set_content_type('application/json');

        $to = $this->input->get('to');

        if (empty($to)) {
            echo json_encode(['success' => false, 'message' => 'Parameter "to" diperlukan. Contoh: /auth/test_email?to=email@example.com']);
            return;
        }

        $this->load->library('email_library');

        $result = $this->email_library->send_registration_verification($to, 'Test User', '123456');

        echo json_encode([
            'success' => $result['success'],
            'message' => $result['message'],
            'debug' => $result['debug'] ?? null,
            'to' => $to
        ]);
    }

    /**
     * Halaman lengkapi profil (setelah registrasi)
     */
    public function complete_profile()
    {
        // Pastikan user sudah login sebagai owner
        if (!$this->is_logged_in() || $this->session->userdata('role') !== 'owner') {
            redirect('auth/login');
            return;
        }

        $id_pemilik = $this->session->userdata('id_pemilik');

        // Get pemilik data
        $this->load->model('owner_model');
        $pemilik = $this->owner_model->getOwnerById($id_pemilik);

        $data = [
            'page_title' => 'Lengkapi Profil - KixEra',
            'pemilik' => $pemilik
        ];

        $this->load->view('auth/complete_profile', $data);
    }

    /**
     * Simpan profil lengkap
     */
    public function save_profile()
    {
        // Pastikan user sudah login sebagai owner
        if (!$this->is_logged_in() || $this->session->userdata('role') !== 'owner') {
            redirect('auth/login');
            return;
        }

        $id_pemilik = $this->session->userdata('id_pemilik');

        // Handle password update if provided (useful for Google users who want traditional login access)
        $password = $this->input->post('password');
        if (!empty($password)) {
            if (strlen($password) < 6) {
                $this->session->set_flashdata('error', 'Password harus minimal 6 karakter');
                redirect('auth/complete_profile');
                return;
            }
            $konfirmasi_password = $this->input->post('konfirmasi_password');
            if ($password !== $konfirmasi_password) {
                $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok');
                redirect('auth/complete_profile');
                return;
            }
            $id_user = $this->session->userdata('id_user');
            $this->user_model->change_password($id_user, $password);
        }

        // Prepare data
        $update_data = [
            'alamat' => $this->input->post('alamat'),
            'kota' => $this->input->post('kota'),
            'kota_code' => $this->input->post('kota_code'),
            'provinsi' => $this->input->post('provinsi'),
            'provinsi_code' => $this->input->post('provinsi_code'),
            'jam_buka' => $this->input->post('jam_buka'),
            'jam_tutup' => $this->input->post('jam_tutup'),
            'profile_completed' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Handle logo upload
        if (!empty($_FILES['logo']['name'])) {
            $upload_path = './uploads/logos/';

            // Create directory if not exists
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }

            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = 'logo_' . $id_pemilik . '_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo')) {
                $upload_data = $this->upload->data();
                $update_data['logo'] = 'uploads/logos/' . $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload logo: ' . $this->upload->display_errors('', ''));
                redirect('auth/complete_profile');
                return;
            }
        }

        // Update pemilik
        $this->db->where('id_pemilik', $id_pemilik)->update('pemilik', $update_data);

        // Update session nama_usaha jika ada
        $this->session->set_flashdata('success', 'Profil berhasil disimpan! Selamat menggunakan KixEra.');
        redirect('pemilik/pemilik_dashboard');
    }
}
