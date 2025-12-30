<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_management_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all users with optional filtering (simplified version)
     */
    public function getAllUsers($filters = [])
    {
        $this->db->select('id_user, username, role, status, created_at, updated_at');
        $this->db->from('users');
        $this->db->where('deleted_at IS NULL');
        $this->db->where_in('role', ['admin', 'owner']);
        
        if (isset($filters['role']) && !empty($filters['role'])) {
            $this->db->where('role', $filters['role']);
        }
        
        if (isset($filters['status']) && !empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }
        
        if (isset($filters['search']) && !empty($filters['search'])) {
            $this->db->like('username', $filters['search']);
        }
        
        $this->db->order_by('created_at', 'DESC');
        $users = $this->db->get()->result();
        
        // Enrich with role-specific data
        foreach ($users as &$user) {
            $user->nama_lengkap = null;
            $user->email = null;
            $user->no_telp = null;
            $user->role_id = null;
            $user->nama_usaha = null;
            $user->alamat_usaha = null;
            
            if ($user->role == 'admin') {
                $admin = $this->db->select('*')->get_where('admin', ['id_user' => $user->id_user])->row();
                if ($admin) {
                    $user->role_id = isset($admin->id_admin) ? $admin->id_admin : null;
                    $user->nama_lengkap = isset($admin->nama) ? $admin->nama : null;
                    $user->email = isset($admin->email) ? $admin->email : null;
                    $user->no_telp = isset($admin->no_telp) ? $admin->no_telp : null;
                }
            } else if ($user->role == 'owner') {
                $pemilik = $this->db->select('*')->get_where('pemilik', ['id_user' => $user->id_user])->row();
                if ($pemilik) {
                    $user->role_id = isset($pemilik->id_pemilik) ? $pemilik->id_pemilik : null;
                    $user->nama_lengkap = isset($pemilik->nama) ? $pemilik->nama : null;
                    $user->email = isset($pemilik->email) ? $pemilik->email : null;
                    $user->no_telp = isset($pemilik->no_telp) ? $pemilik->no_telp : null;
                    $user->nama_usaha = isset($pemilik->nama_usaha) ? $pemilik->nama_usaha : null;
                    $user->alamat_usaha = isset($pemilik->alamat_usaha) ? $pemilik->alamat_usaha : null;
                }
            }
        }
        
        return $users;
    }

    /**
     * Get user by ID (simplified version)
     */
    public function getUserById($id_user)
    {
        $user = $this->db->select('*')->get_where('users', ['id_user' => $id_user, 'deleted_at' => null])->row();
        
        if (!$user) {
            return null;
        }
        
        // Defaults
        $user->nama_lengkap = null;
        $user->email = null;
        $user->no_telp = null;
        $user->role_id = null;
        $user->nama_usaha = null;
        $user->alamat_usaha = null;
        $user->status_langganan = null;
        
        if ($user->role == 'admin') {
            $admin = $this->db->select('*')->get_where('admin', ['id_user' => $id_user])->row();
            if ($admin) {
                $user->role_id = isset($admin->id_admin) ? $admin->id_admin : null;
                $user->nama_lengkap = isset($admin->nama) ? $admin->nama : null;
                $user->email = isset($admin->email) ? $admin->email : null;
                $user->no_telp = isset($admin->no_telp) ? $admin->no_telp : null;
            }
        } else if ($user->role == 'owner') {
            $pemilik = $this->db->select('*')->get_where('pemilik', ['id_user' => $id_user])->row();
            if ($pemilik) {
                $user->role_id = isset($pemilik->id_pemilik) ? $pemilik->id_pemilik : null;
                $user->nama_lengkap = isset($pemilik->nama) ? $pemilik->nama : null;
                $user->email = isset($pemilik->email) ? $pemilik->email : null;
                $user->no_telp = isset($pemilik->no_telp) ? $pemilik->no_telp : null;
                $user->nama_usaha = isset($pemilik->nama_usaha) ? $pemilik->nama_usaha : null;
                $user->alamat_usaha = isset($pemilik->alamat_usaha) ? $pemilik->alamat_usaha : null;
                $user->status_langganan = isset($pemilik->status_langganan) ? $pemilik->status_langganan : null;
            }
        }
        
        return $user;
    }

    /**
     * Create new user
     */
    public function createUser($user_data, $role_data)
    {
        $this->db->trans_start();
        
        // Validate role
        if (!in_array($user_data['role'], ['admin', 'owner'])) {
            return ['success' => false, 'message' => 'Role tidak valid'];
        }
        
        // Check username uniqueness
        $existing = $this->db->get_where('users', ['username' => $user_data['username'], 'deleted_at' => null])->row();
        if ($existing) {
            return ['success' => false, 'message' => 'Username sudah digunakan'];
        }
        
        // Hash password
        $user_data['password'] = password_hash($user_data['password'], PASSWORD_DEFAULT);
        $user_data['created_at'] = date('Y-m-d H:i:s');
        
        // Insert user
        $this->db->insert('users', $user_data);
        $id_user = $this->db->insert_id();
        
        // Insert role-specific data
        $role_data['id_user'] = $id_user;
        $role_data['created_at'] = date('Y-m-d H:i:s');
        
        if ($user_data['role'] == 'admin') {
            $this->db->insert('admin', $role_data);
        } else {
            if (!isset($role_data['status_langganan'])) {
                $role_data['status_langganan'] = 'trial';
            }
            if (!isset($role_data['nama_usaha']) || empty($role_data['nama_usaha'])) {
                $role_data['nama_usaha'] = $role_data['nama'] . "'s Business";
            }
            $this->db->insert('pemilik', $role_data);
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            return ['success' => false, 'message' => 'Gagal membuat user'];
        }
        
        return ['success' => true, 'message' => 'User berhasil dibuat', 'id_user' => $id_user];
    }

    /**
     * Update user
     */
    public function updateUser($id_user, $user_data = [], $role_data = [])
    {
        $user = $this->getUserById($id_user);
        if (!$user) {
            return ['success' => false, 'message' => 'User tidak ditemukan'];
        }
        
        $this->db->trans_start();
        
        // Update users table
        if (!empty($user_data)) {
            if (isset($user_data['password']) && !empty($user_data['password'])) {
                $user_data['password'] = password_hash($user_data['password'], PASSWORD_DEFAULT);
            } else {
                unset($user_data['password']);
            }
            $user_data['updated_at'] = date('Y-m-d H:i:s');
            $this->db->where('id_user', $id_user);
            $this->db->update('users', $user_data);
        }
        
        // Update role-specific table
        if (!empty($role_data)) {
            $role_data['updated_at'] = date('Y-m-d H:i:s');
            if ($user->role == 'admin') {
                $this->db->where('id_user', $id_user);
                $this->db->update('admin', $role_data);
            } else {
                $this->db->where('id_user', $id_user);
                $this->db->update('pemilik', $role_data);
            }
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            return ['success' => false, 'message' => 'Gagal update user'];
        }
        
        return ['success' => true, 'message' => 'User berhasil diupdate'];
    }

    /**
     * Soft delete user
     */
    public function deleteUser($id_user)
    {
        $user = $this->getUserById($id_user);
        if (!$user) {
            return ['success' => false, 'message' => 'User tidak ditemukan'];
        }
        
        $deleted_at = date('Y-m-d H:i:s');
        
        $this->db->trans_start();
        
        // Soft delete from users table
        $this->db->where('id_user', $id_user);
        $this->db->update('users', ['deleted_at' => $deleted_at]);
        
        // Soft delete from role-specific table
        if ($user->role == 'admin') {
            $this->db->where('id_user', $id_user);
            $this->db->update('admin', ['deleted_at' => $deleted_at]);
        } else {
            $this->db->where('id_user', $id_user);
            $this->db->update('pemilik', ['deleted_at' => $deleted_at]);
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            return ['success' => false, 'message' => 'Gagal menghapus user'];
        }
        
        return ['success' => true, 'message' => 'User berhasil dihapus'];
    }

    /**
     * Toggle user status (aktif/nonaktif)
     */
    public function toggleStatus($id_user)
    {
        $user = $this->db->select('status')->get_where('users', ['id_user' => $id_user, 'deleted_at' => null])->row();
        
        if (!$user) {
            return ['success' => false, 'message' => 'User tidak ditemukan'];
        }
        
        $new_status = ($user->status == 'aktif') ? 'nonaktif' : 'aktif';
        
        $this->db->where('id_user', $id_user);
        $result = $this->db->update('users', [
            'status' => $new_status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        if ($result) {
            $status_text = ($new_status == 'aktif') ? 'diaktifkan' : 'dinonaktifkan';
            return ['success' => true, 'message' => 'User berhasil ' . $status_text, 'new_status' => $new_status];
        }
        
        return ['success' => false, 'message' => 'Gagal mengubah status'];
    }

    /**
     * Get user statistics
     */
    public function getUserStats()
    {
        // Total users (admin + owner only)
        $this->db->where('deleted_at IS NULL');
        $this->db->where_in('role', ['admin', 'owner']);
        $total = $this->db->count_all_results('users');
        
        // Active users
        $this->db->where('deleted_at IS NULL');
        $this->db->where('status', 'aktif');
        $this->db->where_in('role', ['admin', 'owner']);
        $active = $this->db->count_all_results('users');
        
        // Total admins
        $this->db->where('deleted_at IS NULL');
        $this->db->where('role', 'admin');
        $admins = $this->db->count_all_results('users');
        
        // Total owners
        $this->db->where('deleted_at IS NULL');
        $this->db->where('role', 'owner');
        $owners = $this->db->count_all_results('users');
        
        return [
            'total' => $total,
            'active' => $active,
            'admins' => $admins,
            'owners' => $owners,
            'inactive' => $total - $active
        ];
    }
}
