<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Library
 * Menangani autentikasi, session management, dan validasi akses berdasarkan role & paket langganan
 */
class Auth_library {
    
    protected $CI;
    
    // Definisi fitur berdasarkan paket
    private $paket_features = [
        'Free' => [
            'max_orders_per_month' => 100,
            'max_cabang' => 1,
            'max_karyawan' => 3,
            'features' => [
                'basic_inventory',
                'basic_reporting',
                'email_support'
            ],
            'disabled_features' => [
                'advanced_analytics',
                'ai_recommendations',
                'multi_location',
                'custom_integrations',
                'priority_support',
                'phone_support',
                'backup_restore',
                'chatbot'
            ]
        ],
        'Pro' => [
            'max_orders_per_month' => 500,
            'max_cabang' => 3,
            'max_karyawan' => 10,
            'features' => [
                'basic_inventory',
                'advanced_inventory',
                'basic_reporting',
                'advanced_analytics',
                'ai_recommendations',
                'email_support',
                'priority_support',
                'backup_restore'
            ],
            'disabled_features' => [
                'multi_location',
                'custom_integrations',
                'phone_support'
            ]
        ],
        'Premium' => [
            'max_orders_per_month' => null, // unlimited
            'max_cabang' => null, // unlimited
            'max_karyawan' => null, // unlimited
            'features' => [
                'basic_inventory',
                'advanced_inventory',
                'basic_reporting',
                'advanced_analytics',
                'ai_recommendations',
                'multi_location',
                'custom_integrations',
                'email_support',
                'priority_support',
                'phone_support',
                'backup_restore',
                'chatbot'
            ],
            'disabled_features' => []
        ],
        'Trial' => [
            'max_orders_per_month' => 20,
            'max_cabang' => 1,
            'max_karyawan' => 2,
            'features' => [
                'basic_inventory',
                'basic_reporting',
                'email_support'
            ],
            'disabled_features' => [
                'advanced_analytics',
                'ai_recommendations',
                'multi_location',
                'custom_integrations',
                'priority_support',
                'phone_support',
                'backup_restore',
                'chatbot',
                'advanced_inventory'
            ]
        ]
    ];
    
    // Role permissions
    private $role_permissions = [
        'admin' => [
            'access' => ['*'], // Full access
            'can' => [
                'manage_users',
                'manage_subscriptions',
                'view_all_data',
                'manage_content',
                'customer_service',
                'system_settings'
            ]
        ],
        'owner' => [
            'access' => [
                'dashboard',
                'pesanan',
                'pelanggan',
                'inventori',
                'keuangan',
                'laporan',
                'layanan',
                'cabang',
                'karyawan',
                'settings'
            ],
            'can' => [
                'manage_business',
                'view_reports',
                'manage_employees',
                'manage_branches',
                'manage_services',
                'manage_inventory',
                'manage_customers',
                'view_analytics'
            ]
        ],
        'karyawan' => [
            'access' => [
                'dashboard',
                'pesanan',
                'pelanggan',
                'inventori',
                'nota'
            ],
            'can' => [
                'manage_orders',
                'view_customers',
                'manage_inventory_basic',
                'print_invoice'
            ]
        ]
    ];
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->library('session');
        $this->CI->load->helper('cookie');
        
        // Cek auto-login dari cookie jika tidak ada sesi aktif
        if (!$this->is_logged_in()) {
            $this->check_remember_token();
        }
    }
    
    /**
     * Set persistent login cookie (Remember Me)
     */
    public function set_remember_cookie($id_user) {
        $selector = bin2hex(random_bytes(9));
        $validator = bin2hex(random_bytes(18));
        
        $token_hash = hash('sha256', $validator);
        $expires = date('Y-m-d H:i:s', time() + 30 * 24 * 60 * 60); // 30 days
        
        $data = [
            'id_user' => $id_user,
            'selector' => $selector,
            'token_hash' => $token_hash,
            'expires_at' => $expires
        ];
        
        $this->CI->db->insert('remember_tokens', $data);
        
        // Set cookie: selector:validator
        $cookie_value = $selector . ':' . $validator;
        
        $cookie = [
            'name' => 'remember_me',
            'value' => $cookie_value,
            'expire' => 30 * 24 * 60 * 60,
            'path'   => '/',
            'httponly' => true,
            'secure' => false // Set true if using HTTPS
        ];
        
        $this->CI->input->set_cookie($cookie);
    }
    
    /**
     * Check remember me token and auto-login
     */
    public function check_remember_token() {
        $cookie = $this->CI->input->cookie('remember_me');
        
        if (!$cookie) {
            return false;
        }
        
        $parts = explode(':', $cookie);
        if (count($parts) !== 2) {
            return false;
        }
        
        list($selector, $validator) = $parts;
        
        $token = $this->CI->db->get_where('remember_tokens', ['selector' => $selector])->row_array();
        
        if (!$token) {
            return false;
        }
        
        if (strtotime($token['expires_at']) < time()) {
            // Delete expired token
            $this->CI->db->delete('remember_tokens', ['id_token' => $token['id_token']]);
            return false;
        }
        
        if (hash_equals($token['token_hash'], hash('sha256', $validator))) {
            // Token valid! Login user.
            $user = $this->CI->db->get_where('users', ['id_user' => $token['id_user']])->row_array();
            
            if ($user && $user['status'] === 'aktif') {
                $user_details = $this->get_user_details($user);
                
                if ($user_details) {
                    // Check subscription if owner
                     if ($user['role'] === 'owner') {
                         $sub = $this->check_subscription_status($user_details['id_pemilik']);
                         if (!$sub['active']) return false;
                         $user_details['subscription'] = $sub;
                     }
                     
                    $this->set_user_session($user_details);
                    $this->log_activity($user['id_user'], 'Auto-login via Remember Me', 'users');
                    return true;
                }
            }
        }
        
        return false;
    }
    
    /**
     * Login user dan set session
     * Support login dengan username atau email
     */
    public function login($username_or_email, $password) {
        // Cek apakah input adalah email (mengandung @)
        $is_email = strpos($username_or_email, '@') !== false;
        
        if ($is_email) {
            // Login dengan email - cari dari tabel role yang sesuai
            // Coba cari di semua tabel role (admin, pemilik, karyawan)
            
            // 1. Cek di tabel admin
            $this->CI->db->select('u.*');
            $this->CI->db->from('users u');
            $this->CI->db->join('admin a', 'u.id_user = a.id_user');
            $this->CI->db->where('a.email', $username_or_email);
            $this->CI->db->where('u.status', 'aktif');
            $this->CI->db->where('a.deleted_at IS NULL');
            $query = $this->CI->db->get();
            
            // 2. Jika tidak ketemu, cek di tabel pemilik
            if ($query->num_rows() == 0) {
                $this->CI->db->select('u.*');
                $this->CI->db->from('users u');
                $this->CI->db->join('pemilik p', 'u.id_user = p.id_user');
                $this->CI->db->where('p.email', $username_or_email);
                $this->CI->db->where('u.status', 'aktif');
                $this->CI->db->where('p.deleted_at IS NULL');
                $query = $this->CI->db->get();
            }
            
            // 3. Jika tidak ketemu, cek di tabel karyawan
            if ($query->num_rows() == 0) {
                $this->CI->db->select('u.*');
                $this->CI->db->from('users u');
                $this->CI->db->join('karyawan k', 'u.id_user = k.id_user');
                $this->CI->db->where('k.email', $username_or_email);
                $this->CI->db->where('u.status', 'aktif');
                $this->CI->db->where('k.deleted_at IS NULL');
                $query = $this->CI->db->get();
            }
        } else {
            // Login dengan username
            $this->CI->db->where('username', $username_or_email);
            $this->CI->db->where('status', 'aktif');
            $this->CI->db->where('deleted_at IS NULL');
            $query = $this->CI->db->get('users');
        }
        
        if ($query->num_rows() == 0) {
            return [
                'success' => false,
                'message' => $is_email ? 'Email tidak ditemukan atau tidak aktif' : 'Username tidak ditemukan atau tidak aktif'
            ];
        }
        
        $user = $query->row_array();
        
        // Verifikasi password - Support both md5 (legacy) and password_hash
        $password_valid = false;
        
        if (password_get_info($user['password'])['algo'] !== 0) {
            // Password menggunakan password_hash
            $password_valid = password_verify($password, $user['password']);
        } else {
            // Legacy MD5 password
            $password_valid = (md5($password) === $user['password']);
            
            // Update to password_hash if MD5 is correct
            if ($password_valid) {
                $this->CI->db->where('id_user', $user['id_user']);
                $this->CI->db->update('users', [
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ]);
            }
        }
        
        if (!$password_valid) {
            return [
                'success' => false,
                'message' => 'Password salah'
            ];
        }
        
        // Get user details berdasarkan role
        $user_details = $this->get_user_details($user);
        
        if (!$user_details) {
            return [
                'success' => false,
                'message' => 'Data user tidak lengkap'
            ];
        }
        
        // Check subscription status untuk owner
        if ($user['role'] === 'owner') {
            $subscription_check = $this->check_subscription_status($user_details['id_pemilik']);
            
            if (!$subscription_check['active']) {
                return [
                    'success' => false,
                    'message' => 'Langganan Anda tidak aktif. Silakan perpanjang langganan.',
                    'subscription_expired' => true
                ];
            }
            
            $user_details['subscription'] = $subscription_check;
        }
        
        // Set session
        $this->set_user_session($user_details);
        
        // Log activity
        $this->log_activity($user['id_user'], 'User login', 'users');
        
        // Get redirect URL based on role and folder structure
        $redirect_url = $this->get_redirect_url($user['role']);
        
        return [
            'success' => true,
            'message' => 'Login berhasil',
            'user' => $user_details,
            'redirect' => $redirect_url
        ];
    }
    
    /**
     * Get user details berdasarkan role
     */
    public function get_user_details($user) {
        $details = [
            'id_user' => $user['id_user'],
            'username' => $user['username'],
            'role' => $user['role']
        ];
        
        switch($user['role']) {
            case 'admin':
                $this->CI->db->select('id_admin, nama, email, no_telp, foto_profil');
                $this->CI->db->where('id_user', $user['id_user']);
                $query = $this->CI->db->get('admin');
                
                if ($query->num_rows() == 1) {
                    $admin = $query->row_array();
                    $details = array_merge($details, $admin);
                }
                break;
                
            case 'owner':
                $this->CI->db->select('p.*, pl.nama_paket, pl.harga as harga_paket');
                $this->CI->db->from('pemilik p');
                $this->CI->db->join('paket_langganan pl', 'p.id_paket = pl.id_paket', 'left');
                $this->CI->db->where('p.id_user', $user['id_user']);
                $query = $this->CI->db->get();
                
                if ($query->num_rows() == 1) {
                    $pemilik = $query->row_array();
                    $details = array_merge($details, $pemilik);
                }
                break;
                
            case 'karyawan':
                $this->CI->db->select('k.*, c.nama_cabang, c.id_pemilik, p.nama_usaha');
                $this->CI->db->from('karyawan k');
                $this->CI->db->join('cabang c', 'k.id_cabang = c.id_cabang');
                $this->CI->db->join('pemilik p', 'c.id_pemilik = p.id_pemilik');
                $this->CI->db->where('k.id_user', $user['id_user']);
                $query = $this->CI->db->get();
                
                if ($query->num_rows() == 1) {
                    $karyawan = $query->row_array();
                    $details = array_merge($details, $karyawan);
                }
                break;
        }
        
        return $details;
    }
    
    /**
     * Check subscription status untuk owner
     * 
     * Unified Logic:
     * - AKTIF: Cek tgl_akhir_langganan dari transaksi_langganan terakhir yang sukses
     * - TRIAL: Hitung hari sejak created_at (max 7 hari)
     * - NONAKTIF: Selalu expired
     */
    public function check_subscription_status($id_pemilik) {
        // First, get pemilik data with created_at for trial calculation
        $this->CI->db->select('
            p.status_langganan,
            p.id_paket,
            p.created_at as pemilik_created_at,
            pl.nama_paket,
            pl.harga,
            pl.durasi_hari,
            tl.tgl_mulai_langganan,
            tl.tgl_akhir_langganan,
            tl.status_pembayaran,
            DATEDIFF(tl.tgl_akhir_langganan, CURDATE()) as sisa_hari
        ');
        $this->CI->db->from('pemilik p');
        $this->CI->db->join('paket_langganan pl', 'p.id_paket = pl.id_paket', 'left');
        $this->CI->db->join('transaksi_langganan tl', 
            'p.id_pemilik = tl.id_pemilik AND tl.status_pembayaran = "sukses"', 
            'left'
        );
        $this->CI->db->where('p.id_pemilik', $id_pemilik);
        $this->CI->db->order_by('tl.tgl_akhir_langganan', 'DESC');
        $this->CI->db->limit(1);
        $query = $this->CI->db->get();
        
        if ($query->num_rows() == 0) {
            return [
                'active' => false,
                'status' => 'expired',
                'message' => 'Tidak ada langganan aktif'
            ];
        }
        
        $sub = $query->row_array();
        
        // CASE 1: Status TRIAL - Hitung hari sejak created_at
        if ($sub['status_langganan'] === 'trial') {
            $created_date = strtotime($sub['pemilik_created_at']);
            $current_date = time();
            $days_used = floor(($current_date - $created_date) / (60 * 60 * 24));
            $sisa_hari_trial = 7 - $days_used;
            
            if ($sisa_hari_trial >= 0) {
                return [
                    'active' => true,
                    'status' => 'trial',
                    'paket' => 'Trial',
                    'features' => $this->paket_features['Trial'],
                    'sisa_hari' => $sisa_hari_trial,
                    'days_used' => $days_used,
                    'message' => "Anda menggunakan paket trial (Hari ke-" . ($days_used + 1) . " dari 7)"
                ];
            } else {
                // Trial expired! Auto-update status
                $this->CI->db->where('id_pemilik', $id_pemilik);
                $this->CI->db->update('pemilik', ['status_langganan' => 'nonaktif']);
                log_message('info', "Trial expired for id_pemilik: $id_pemilik (Day $days_used). Auto-updated to nonaktif.");
                
                return [
                    'active' => false,
                    'status' => 'expired',
                    'paket' => 'Trial',
                    'message' => 'Masa trial Anda telah berakhir'
                ];
            }
        }
        
        // CASE 2: Status AKTIF - Check dari transaksi_langganan
        if ($sub['status_langganan'] === 'aktif') {
            // Check expiry dari transaksi
            if ($sub['sisa_hari'] === null) {
                // Tidak ada transaksi sukses, tapi status aktif (mungkin set manual)
                return [
                    'active' => true,
                    'status' => 'active',
                    'paket' => $sub['nama_paket'] ?? 'Free',
                    'features' => $this->paket_features[$sub['nama_paket'] ?? 'Free'] ?? $this->paket_features['Free'],
                    'sisa_hari' => 30, // Default assumption
                    'message' => 'Langganan aktif'
                ];
            }
            
            if ($sub['sisa_hari'] < 0) {
                // Expired! Auto-update status
                $this->CI->db->where('id_pemilik', $id_pemilik);
                $this->CI->db->update('pemilik', ['status_langganan' => 'nonaktif']);
                log_message('info', "Subscription expired for id_pemilik: $id_pemilik (Sisa hari: {$sub['sisa_hari']}). Auto-updated to nonaktif.");
                
                return [
                    'active' => false,
                    'status' => 'expired',
                    'paket' => $sub['nama_paket'],
                    'message' => 'Langganan Anda telah berakhir'
                ];
            }
            
            // Check jika hampir expired (7 hari)
            $warning = $sub['sisa_hari'] <= 7;
            
            return [
                'active' => true,
                'status' => $warning ? 'expiring_soon' : 'active',
                'paket' => $sub['nama_paket'],
                'features' => $this->paket_features[$sub['nama_paket']] ?? $this->paket_features['Free'],
                'sisa_hari' => $sub['sisa_hari'],
                'tgl_akhir' => $sub['tgl_akhir_langganan'],
                'warning' => $warning,
                'message' => $warning ? 
                    "Langganan Anda akan berakhir dalam {$sub['sisa_hari']} hari" : 
                    'Langganan aktif'
            ];
        }
        
        // CASE 3: Status NONAKTIF
        return [
            'active' => false,
            'status' => 'expired',
            'paket' => $sub['nama_paket'] ?? 'None',
            'message' => 'Langganan tidak aktif'
        ];
    }
    
    /**
     * Set user session
     */
    public function set_user_session($user_details) {
        $session_data = [
            'id_user' => $user_details['id_user'],
            'username' => $user_details['username'],
            'role' => $user_details['role'],
            'logged_in' => true,
            'login_time' => time()
        ];
        
        // Add role-specific data
        switch($user_details['role']) {
            case 'admin':
                $session_data['id_admin'] = $user_details['id_admin'] ?? null;
                $session_data['nama'] = $user_details['nama'] ?? 'Admin';
                $session_data['email'] = $user_details['email'] ?? '';
                break;
                
            case 'owner':
                $session_data['id_pemilik'] = $user_details['id_pemilik'];
                $session_data['nama'] = $user_details['nama'];
                $session_data['email'] = $user_details['email'];
                $session_data['nama_usaha'] = $user_details['nama_usaha'];
                $session_data['status_langganan'] = $user_details['status_langganan'];
                $session_data['paket'] = $user_details['nama_paket'] ?? 'Trial';
                
                if (isset($user_details['subscription'])) {
                    $session_data['subscription'] = $user_details['subscription'];
                }
                break;
                
            case 'karyawan':
                $session_data['id_karyawan'] = $user_details['id_karyawan'];
                $session_data['nama'] = $user_details['nama'];
                $session_data['id_cabang'] = $user_details['id_cabang'];
                $session_data['nama_cabang'] = $user_details['nama_cabang'];
                $session_data['id_pemilik'] = $user_details['id_pemilik'];
                $session_data['nama_usaha'] = $user_details['nama_usaha'];
                break;
        }
        
        
        $this->CI->session->unset_userdata(['verify_id_user', 'verify_phone', 'verify_time', 'verify_remember_me']);
        $this->CI->session->set_userdata($session_data);
    }
    
    /**
     * Check if user is logged in
     */
    public function is_logged_in() {
        return $this->CI->session->userdata('logged_in') === true;
    }
    
    /**
     * Get current user data
     */
    public function get_user() {
        if (!$this->is_logged_in()) {
            return null;
        }
        
        return [
            'id_user' => $this->CI->session->userdata('id_user'),
            'username' => $this->CI->session->userdata('username'),
            'role' => $this->CI->session->userdata('role'),
            'nama' => $this->CI->session->userdata('nama')
        ];
    }
    
    /**
     * Check if user has specific role
     */
    public function has_role($role) {
        if (!$this->is_logged_in()) {
            return false;
        }
        
        $user_role = $this->CI->session->userdata('role');
        
        // Admin has all roles
        if ($user_role === 'admin') {
            return true;
        }
        
        return $user_role === $role;
    }
    
    /**
     * Check if user can access specific module
     */
    public function can_access($module) {
        if (!$this->is_logged_in()) {
            return false;
        }
        
        $role = $this->CI->session->userdata('role');
        
        // Admin can access everything
        if ($role === 'admin') {
            return true;
        }
        
        $permissions = $this->role_permissions[$role] ?? [];
        
        // Check wildcard
        if (in_array('*', $permissions['access'])) {
            return true;
        }
        
        return in_array($module, $permissions['access']);
    }
    
    /**
     * Check if user has specific permission
     */
    public function can($permission) {
        if (!$this->is_logged_in()) {
            return false;
        }
        
        $role = $this->CI->session->userdata('role');
        
        // Admin can do everything
        if ($role === 'admin') {
            return true;
        }
        
        $permissions = $this->role_permissions[$role] ?? [];
        
        return in_array($permission, $permissions['can'] ?? []);
    }
    
    /**
     * Check if feature is available for current user's subscription
     */
    public function has_feature($feature_name) {
        $role = $this->CI->session->userdata('role');
        
        // Admin always has access
        if ($role === 'admin') {
            return true;
        }
        
        // Karyawan check owner's subscription
        if ($role === 'karyawan') {
            $id_pemilik = $this->CI->session->userdata('id_pemilik');
            $subscription = $this->check_subscription_status($id_pemilik);
        } else if ($role === 'owner') {
            $subscription = $this->CI->session->userdata('subscription');
            
            // Refresh if not in session
            if (!$subscription) {
                $id_pemilik = $this->CI->session->userdata('id_pemilik');
                $subscription = $this->check_subscription_status($id_pemilik);
                $this->CI->session->set_userdata('subscription', $subscription);
            }
        } else {
            return false;
        }
        
        if (!$subscription || !$subscription['active']) {
            return false;
        }
        
        $features = $subscription['features']['features'] ?? [];
        
        return in_array($feature_name, $features);
    }
    
    /**
     * Check usage limit (orders, cabang, karyawan)
     */
    public function check_limit($limit_type) {
        $role = $this->CI->session->userdata('role');
        
        if ($role !== 'owner') {
            return ['allowed' => true];
        }
        
        $subscription = $this->CI->session->userdata('subscription');
        
        if (!$subscription || !$subscription['active']) {
            return [
                'allowed' => false,
                'message' => 'Langganan tidak aktif'
            ];
        }
        
        $id_pemilik = $this->CI->session->userdata('id_pemilik');
        $limits = $subscription['features'];
        
        switch($limit_type) {
            case 'orders':
                $max = $limits['max_orders_per_month'];
                if ($max === null) {
                    return ['allowed' => true];
                }
                
                // Count orders this month
                $this->CI->db->where('id_pemilik', $id_pemilik);
                $this->CI->db->where('MONTH(tgl_masuk)', date('m'));
                $this->CI->db->where('YEAR(tgl_masuk)', date('Y'));
                $current = $this->CI->db->count_all_results('pesanan');
                
                return [
                    'allowed' => $current < $max,
                    'current' => $current,
                    'max' => $max,
                    'message' => $current >= $max ? 
                        "Anda telah mencapai batas {$max} pesanan per bulan. Upgrade paket untuk meningkatkan limit." : 
                        null
                ];
                
            case 'cabang':
                $max = $limits['max_cabang'];
                if ($max === null) {
                    return ['allowed' => true];
                }
                
                $this->CI->db->where('id_pemilik', $id_pemilik);
                $this->CI->db->where('deleted_at IS NULL');
                $current = $this->CI->db->count_all_results('cabang');
                
                return [
                    'allowed' => $current < $max,
                    'current' => $current,
                    'max' => $max,
                    'message' => $current >= $max ? 
                        "Anda telah mencapai batas {$max} cabang. Upgrade paket untuk menambah cabang." : 
                        null
                ];
                
            case 'karyawan':
                $max = $limits['max_karyawan'];
                if ($max === null) {
                    return ['allowed' => true];
                }
                
                $this->CI->db->select('k.*');
                $this->CI->db->from('karyawan k');
                $this->CI->db->join('cabang c', 'k.id_cabang = c.id_cabang');
                $this->CI->db->where('c.id_pemilik', $id_pemilik);
                $this->CI->db->where('k.deleted_at IS NULL');
                $current = $this->CI->db->count_all_results();
                
                return [
                    'allowed' => $current < $max,
                    'current' => $current,
                    'max' => $max,
                    'message' => $current >= $max ? 
                        "Anda telah mencapai batas {$max} karyawan. Upgrade paket untuk menambah karyawan." : 
                        null
                ];
        }
        
        return ['allowed' => true];
    }
    
    /**
     * Get redirect URL based on role - SESUAI STRUKTUR FOLDER
     */
    public function get_redirect_url($role) {
        switch($role) {
            case 'admin':
                return base_url('admin/admin_dashboard');
            case 'owner':
                return base_url('pemilik/pemilik_dashboard');
            case 'karyawan':
                return base_url('karyawan/karyawan_dashboard');
            default:
                return base_url('auth/login');
        }
    }
    
    /**
     * Logout user
     */
    public function logout() {
        $id_user = $this->CI->session->userdata('id_user');
        
        if ($id_user) {
            $this->log_activity($id_user, 'User logout', 'users');
        }
        
        // Clear Remember Me Cookie & Token
        $cookie = $this->CI->input->cookie('remember_me');
        if ($cookie) {
            $parts = explode(':', $cookie);
            if (count($parts) === 2) {
                $selector = $parts[0];
                $this->CI->db->delete('remember_tokens', ['selector' => $selector]);
            }
        }
        
        // Delete cookie
        $this->CI->load->helper('cookie');
        delete_cookie('remember_me');
        
        $this->CI->session->sess_destroy();
        
        return [
            'success' => true,
            'message' => 'Logout berhasil'
        ];
    }
    
    /**
     * Require login - redirect if not logged in
     */
    public function require_login() {
        if (!$this->is_logged_in()) {
            $this->CI->session->set_flashdata('error', 'Silakan login terlebih dahulu');
            redirect('auth/login');
        }
    }
    
    /**
     * Require specific role
     */
    public function require_role($role) {
        $this->require_login();
        
        // Check for subscription expiration
        if ($role === 'owner' && $this->CI->session->userdata('subscription_expired') === true) {
             // Allow ajax to handle it gracefully if needed, or just redirect
             if (!$this->CI->input->is_ajax_request()) {
                 redirect('auth/subscription_expired');
             }
        }
        
        if (!$this->has_role($role)) {
            $this->CI->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini');
            redirect($this->get_redirect_url($this->CI->session->userdata('role')));
        }
    }
    
    /**
     * Require access to module
     */
    public function require_access($module) {
        $this->require_login();
        
        if (!$this->can_access($module)) {
            $this->CI->session->set_flashdata('error', 'Anda tidak memiliki akses ke modul ini');
            redirect($this->get_redirect_url($this->CI->session->userdata('role')));
        }
    }
    
    /**
     * Require feature (subscription check)
     */
    public function require_feature($feature) {
        $this->require_login();
        
        if (!$this->has_feature($feature)) {
            $paket = $this->CI->session->userdata('paket') ?? 'Trial';
            $this->CI->session->set_flashdata('error', 
                "Fitur ini tidak tersedia dalam paket {$paket}. Silakan upgrade paket Anda."
            );
            redirect('owner/subscription');
        }
    }
    
    /**
     * Log activity
     */
    private function log_activity($id_user, $aktivitas, $table_affected = null) {
        $data = [
            'id_user' => $id_user,
            'aktivitas' => $aktivitas,
            'deskripsi' => null,
            'ip_address' => $this->CI->input->ip_address(),
            'user_agent' => $this->CI->input->user_agent(),
            'tgl_aktivitas' => date('Y-m-d H:i:s')
        ];
        
        $this->CI->db->insert('log_aktivitas', $data);
    }
}