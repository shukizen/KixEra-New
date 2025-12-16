<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Validasi login user
     * @param string $username_or_email Username atau email
     * @param string $password Password
     * @return array|false User data jika berhasil, false jika gagal
     */
    public function validate_login($username_or_email, $password)
    {
        $this->db->select('u.*');
        $this->db->from('users u');
        
        // Cek apakah menggunakan email atau username
        if (filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
            // Login menggunakan email, cari di tabel pemilik dulu
            // Note: Idealnya kita join ke semua role table jika ingin login email universal
            $this->db->select('p.email as email_pemilik');
            $this->db->join('pemilik p', 'u.id_user = p.id_user', 'left');
            
            $this->db->group_start();
            $this->db->where('p.email', $username_or_email);
            $this->db->or_where('u.username', $username_or_email);
            $this->db->group_end();
        } else {
            // Login menggunakan username
            $this->db->where('u.username', $username_or_email);
        }
        
        $this->db->where('u.status', 'aktif');
        $this->db->where('u.deleted_at IS NULL');
        
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            $user = $query->row_array();
            
            // Verifikasi password menggunakan password_verify untuk password hash
            // atau md5 untuk backward compatibility
            if (password_verify($password, $user['password']) || md5($password) === $user['password']) {
                
                // Auto-upgrade MD5 to Bcrypt if successful
                if (md5($password) === $user['password']) {
                    $this->change_password($user['id_user'], $password);
                }
                
                // Get additional user info based on role
                $user_info = $this->get_user_details($user);
                return $user_info;
            }
        }
        
        return false;
    }

    /**
     * Dapatkan detail user berdasarkan role
     * @param array $user Data user dari tabel users
     * @return array User details lengkap
     */
    public function get_user_details($user)
    {
        $user_details = $user;
        
        switch($user['role']) {
            case 'admin':
                $this->db->select('*');
                $this->db->where('id_user', $user['id_user']);
                $this->db->where('deleted_at IS NULL');
                $query = $this->db->get('admin');
                if ($query->num_rows() == 1) {
                    $admin_info = $query->row_array();
                    $user_details = array_merge($user_details, $admin_info);
                }
                break;
                
            case 'owner':
                $this->db->select('p.*, pl.nama_paket, pl.harga, pl.durasi_hari');
                $this->db->from('pemilik p');
                $this->db->join('paket_langganan pl', 'p.id_paket = pl.id_paket', 'left');
                $this->db->where('p.id_user', $user['id_user']);
                $this->db->where('p.deleted_at IS NULL');
                $query = $this->db->get();
                if ($query->num_rows() == 1) {
                    $owner_info = $query->row_array();
                    $user_details = array_merge($user_details, $owner_info);
                }
                break;
                
            case 'karyawan':
                $this->db->select('k.*, c.nama_cabang');
                $this->db->from('karyawan k');
                $this->db->join('cabang c', 'k.id_cabang = c.id_cabang', 'left');
                $this->db->where('k.id_user', $user['id_user']);
                $this->db->where('k.deleted_at IS NULL');
                $query = $this->db->get();
                if ($query->num_rows() == 1) {
                    $karyawan_info = $query->row_array();
                    $user_details = array_merge($user_details, $karyawan_info);
                }
                break;
        }
        
        return $user_details;
    }

    /**
     * Registrasi user baru (Owner)
     * @param array $data Data registrasi
     * @return array Result dengan success status dan message
     */
    /**
     * Registrasi user baru (Owner)
     * @param array $data Data registrasi
     * @return array Result dengan success status dan message
     */
    public function register_owner($data)
    {
        // Simpan status db_debug dan nonaktifkan untuk mencegah error HTML
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        
        $this->db->trans_start();
        
        try {
            // 1. Cek apakah email sudah terdaftar
            $this->db->where('email', $data['email']);
            if ($this->db->count_all_results('pemilik') > 0) {
                return [
                    'success' => false,
                    'message' => 'Email sudah terdaftar'
                ];
            }
            
            // 2. Generate username unik
            $username = $this->generate_unique_username($data['nama']);
            
            // 3. Insert ke tabel users
            $user_data = [
                'username' => $username,
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role' => 'owner',
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            if (!$this->db->insert('users', $user_data)) {
                 $error = $this->db->error();
                 throw new Exception('Gagal membuat user: ' . $error['message']);
            }
            
            $id_user = $this->db->insert_id();
            
            // 4. Insert ke tabel pemilik
            $pemilik_data = [
                'id_user' => $id_user,
                'nama' => $data['nama'],
                'email' => $data['email'],
                'no_telp' => isset($data['no_telp']) ? $data['no_telp'] : null,
                'foto_profil' => isset($data['foto_profil']) ? $data['foto_profil'] : null,
                'nama_usaha' => isset($data['nama_usaha']) ? $data['nama_usaha'] : $data['nama'] . "'s Business",
                'alamat_usaha' => isset($data['alamat_usaha']) ? $data['alamat_usaha'] : null,
                'status_langganan' => 'trial',
                'id_paket' => null,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            if (!$this->db->insert('pemilik', $pemilik_data)) {
                $error = $this->db->error();
                throw new Exception('Gagal membuat pemilik: ' . $error['message']);
            }
            
            $id_pemilik = $this->db->insert_id();
            
            // 5. Buat cabang default
            $cabang_data = [
                'id_pemilik' => $id_pemilik,
                'nama_cabang' => 'Cabang Utama',
                'alamat' => '',
                'no_telp' => '',
                'status' => 'aktif',
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            if (!$this->db->insert('cabang', $cabang_data)) {
                $error = $this->db->error();
                throw new Exception('Gagal membuat cabang: ' . $error['message']);
            }
            
            // Commit transaksi
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                $error = $this->db->error();
                throw new Exception('Transaksi database gagal: ' . $error['message']);
            }
            
            // Restore db_debug
            $this->db->db_debug = $db_debug;
            
            return [
                'success' => true,
                'message' => 'Registrasi berhasil',
                'data' => [
                    'id_user' => $id_user,
                    'id_pemilik' => $id_pemilik,
                    'username' => $username
                ]
            ];
            
        } catch (Exception $e) {
            $this->db->trans_rollback();
            // Restore db_debug
            $this->db->db_debug = $db_debug;
            
            log_message('error', 'Register error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat registrasi: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Generate username unik dari nama
     * @param string $nama Nama lengkap
     * @return string Username unik
     */
    private function generate_unique_username($nama)
    {
        // Bersihkan nama dari karakter khusus
        $base_username = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $nama));
        $base_username = substr($base_username, 0, 20); // Maksimal 20 karakter
        
        // Tambahkan angka acak
        $username = $base_username . rand(100, 999);
        
        // Cek keunikan
        $counter = 1;
        while ($counter <= 10) {
            $this->db->where('username', $username);
            if ($this->db->count_all_results('users') == 0) {
                return $username;
            }
            $username = $base_username . rand(1000, 9999);
            $counter++;
        }
        
        // Jika masih belum unik setelah 10 percobaan, gunakan uniqid
        return $base_username . substr(uniqid(), -6);
    }

    /**
     * Dapatkan user berdasarkan ID
     */
    public function get_user_by_id($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get('users');
        return $query->row_array();
    }

    /**
     * Dapatkan user berdasarkan username
     */
    public function get_user_by_username($username)
    {
        $this->db->where('username', $username);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get('users');
        
        if ($query->num_rows() == 1) {
            return $this->get_user_details($query->row_array());
        }
        
        return false;
    }

    /**
     * Dapatkan user berdasarkan email
     */
    public function get_user_by_email($email)
    {
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->join('pemilik p', 'u.id_user = p.id_user', 'left');
        $this->db->join('admin a', 'u.id_user = a.id_user', 'left');
        $this->db->where('p.email', $email);
        $this->db->or_where('a.email', $email);
        $this->db->where('u.deleted_at IS NULL');
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return $this->get_user_details($query->row_array());
        }
        
        return false;
    }

    /**
     * Update password user
     */
    public function change_password($id_user, $new_password)
    {
        $data = [
            'password' => password_hash($new_password, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id_user', $id_user);
        return $this->db->update('users', $data);
    }

    /**
     * Update status user
     */
    public function update_status($id_user, $status)
    {
        $data = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id_user', $id_user);
        return $this->db->update('users', $data);
    }

    /**
     * Soft delete user
     */
    public function delete_user($id_user)
    {
        $data = [
            'deleted_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id_user', $id_user);
        return $this->db->update('users', $data);
    }

    /**
     * Cek apakah username sudah ada
     */
    public function check_username_exists($username, $exclude_id_user = null)
    {
        $this->db->where('username', $username);
        $this->db->where('deleted_at IS NULL');
        
        if ($exclude_id_user) {
            $this->db->where('id_user !=', $exclude_id_user);
        }
        
        return $this->db->count_all_results('users') > 0;
    }

    /**
     * Cek apakah email sudah ada
     */
    public function check_email_exists($email, $exclude_id = null)
    {
        $this->db->where('email', $email);
        $this->db->where('deleted_at IS NULL');
        
        if ($exclude_id) {
            $this->db->where('id_pemilik !=', $exclude_id);
        }
        
        return $this->db->count_all_results('pemilik') > 0;
    }

    /**
     * Update profil pemilik
     */
    public function update_owner_profile($id_pemilik, $data)
    {
        $update_data = [];
        
        // Field yang boleh diupdate
        $allowed_fields = ['nama', 'email', 'no_telp', 'foto_profil', 'nama_usaha', 'alamat_usaha'];
        
        foreach ($allowed_fields as $field) {
            if (isset($data[$field])) {
                $update_data[$field] = $data[$field];
            }
        }
        
        if (empty($update_data)) {
            return false;
        }
        
        $update_data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->where('id_pemilik', $id_pemilik);
        return $this->db->update('pemilik', $update_data);
    }

    /**
     * Update profil admin
     */
    public function update_admin_profile($id_admin, $data)
    {
        $update_data = [];
        
        // Field yang boleh diupdate
        $allowed_fields = ['nama', 'email', 'no_telp', 'foto_profil'];
        
        foreach ($allowed_fields as $field) {
            if (isset($data[$field])) {
                $update_data[$field] = $data[$field];
            }
        }
        
        if (empty($update_data)) {
            return false;
        }
        
        $update_data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->where('id_admin', $id_admin);
        return $this->db->update('admin', $update_data);
    }

    /**
     * Update profil karyawan
     */
    public function update_karyawan_profile($id_karyawan, $data)
    {
        $update_data = [];
        
        // Field yang boleh diupdate
        $allowed_fields = ['nama', 'email', 'no_telp', 'foto_profil', 'jabatan', 'alamat'];
        
        foreach ($allowed_fields as $field) {
            if (isset($data[$field])) {
                $update_data[$field] = $data[$field];
            }
        }
        
        if (empty($update_data)) {
            return false;
        }
        
        $update_data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->update('karyawan', $update_data);
    }

    /**
     * Log aktivitas user
     */
    public function log_activity($id_user, $activity, $description = null)
    {
        $data = [
            'id_user' => $id_user,
            'activity' => $activity,
            'description' => $description,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        return $this->db->insert('activity_log', $data);
    }

    /**
     * Dapatkan semua user (untuk admin)
     */
    public function get_all_users($role = null, $status = null)
    {
        $this->db->select('u.*, 
                          CASE 
                              WHEN u.role = "admin" THEN a.nama
                              WHEN u.role = "owner" THEN p.nama
                              WHEN u.role = "karyawan" THEN k.nama
                          END as nama_lengkap,
                          CASE 
                              WHEN u.role = "admin" THEN a.email
                              WHEN u.role = "owner" THEN p.email
                              WHEN u.role = "karyawan" THEN k.email
                          END as email');
        $this->db->from('users u');
        $this->db->join('admin a', 'u.id_user = a.id_user AND u.role = "admin"', 'left');
        $this->db->join('pemilik p', 'u.id_user = p.id_user AND u.role = "owner"', 'left');
        $this->db->join('karyawan k', 'u.id_user = k.id_user AND u.role = "karyawan"', 'left');
        $this->db->where('u.deleted_at IS NULL');
        
        if ($role) {
            $this->db->where('u.role', $role);
        }
        
        if ($status) {
            $this->db->where('u.status', $status);
        }
        
        $this->db->order_by('u.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getUserById($id_user)
{
    $this->db->where('id_user', $id_user);
    $this->db->where('deleted_at IS NULL');
    $query = $this->db->get('users');
    return $query->row_array();
}

}