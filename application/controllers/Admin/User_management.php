<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_management extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_management_model');
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }

    /**
     * Main user management page
     */
    public function index()
    {
        $data['page_title'] = 'Manajemen Pengguna - KixEra';
        $data['user'] = $this->auth_library->get_user();
        $data['stats'] = $this->User_management_model->getUserStats();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/user_management/index', $data);
        $this->load->view('template/footer');
    }

    /**
     * Get users (AJAX endpoint)
     * GET params: role, status, search
     */
    public function get_users()
    {
        $filters = [
            'role' => $this->input->get('role'),
            'status' => $this->input->get('status'),
            'search' => $this->input->get('search')
        ];
        
        $users = $this->User_management_model->getAllUsers($filters);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $users
        ]);
    }

    /**
     * Get single user (AJAX endpoint)
     * @param int $id User ID
     */
    public function get_user($id)
    {
        $user = $this->User_management_model->getUserById($id);
        
        header('Content-Type: application/json');
        if ($user) {
            echo json_encode([
                'success' => true,
                'data' => $user
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ]);
        }
    }

    /**
     * Create new user (AJAX endpoint)
     */
    public function create()
    {
        $is_ajax = $this->input->is_ajax_request();
        
        // Validation
        $role = $this->input->post('role', true);
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $nama = $this->input->post('nama', true);
        $email = $this->input->post('email', true);
        
        $errors = [];
        
        if (empty($role) || !in_array($role, ['admin', 'owner'])) {
            $errors[] = 'Role harus dipilih (Admin atau Pemilik)';
        }
        
        if (empty($username)) {
            $errors[] = 'Username wajib diisi';
        } elseif (strlen($username) < 3) {
            $errors[] = 'Username minimal 3 karakter';
        }
        
        if (empty($password)) {
            $errors[] = 'Password wajib diisi';
        } elseif (strlen($password) < 6) {
            $errors[] = 'Password minimal 6 karakter';
        }
        
        if (empty($nama)) {
            $errors[] = 'Nama lengkap wajib diisi';
        }
        
        if (empty($email)) {
            $errors[] = 'Email wajib diisi';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Format email tidak valid';
        }
        
        if (!empty($errors)) {
            $response = [
                'success' => false,
                'message' => implode('<br>', $errors)
            ];
            
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('error', $response['message']);
                redirect('admin/user_management');
            }
            return;
        }
        
        // Prepare data
        $user_data = [
            'username' => $username,
            'password' => $password,
            'role' => $role,
            'status' => 'aktif'
        ];
        
        $role_data = [
            'nama' => $nama,
            'email' => $email,
            'no_telp' => $this->input->post('no_telp', true),
            'foto_profil' => $this->input->post('foto_profil', true)
        ];
        
        // Add owner-specific fields
        if ($role == 'owner') {
            $role_data['nama_usaha'] = $this->input->post('nama_usaha', true);
            $role_data['alamat_usaha'] = $this->input->post('alamat_usaha', true);
        }
        
        // Create user
        $result = $this->User_management_model->createUser($user_data, $role_data);
        
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            if ($result['success']) {
                $this->session->set_flashdata('success', $result['message']);
            } else {
                $this->session->set_flashdata('error', $result['message']);
            }
            redirect('admin/user_management');
        }
    }

    /**
     * Update user (AJAX endpoint)
     * @param int $id User ID
     */
    public function update($id)
    {
        $is_ajax = $this->input->is_ajax_request();
        
        // Validation
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $nama = $this->input->post('nama', true);
        $email = $this->input->post('email', true);
        
        $errors = [];
        
        if (empty($username)) {
            $errors[] = 'Username wajib diisi';
        } elseif (strlen($username) < 3) {
            $errors[] = 'Username minimal 3 karakter';
        }
        
        if (!empty($password) && strlen($password) < 6) {
            $errors[] = 'Password minimal 6 karakter jika diisi';
        }
        
        if (empty($nama)) {
            $errors[] = 'Nama lengkap wajib diisi';
        }
        
        if (empty($email)) {
            $errors[] = 'Email wajib diisi';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Format email tidak valid';
        }
        
        if (!empty($errors)) {
            $response = [
                'success' => false,
                'message' => implode('<br>', $errors)
            ];
            
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('error', $response['message']);
                redirect('admin/user_management');
            }
            return;
        }
        
        // Prepare data
        $user_data = [
            'username' => $username
        ];
        
        if (!empty($password)) {
            $user_data['password'] = $password;
        }
        
        $role_data = [
            'nama' => $nama,
            'email' => $email,
            'no_telp' => $this->input->post('no_telp', true),
            'foto_profil' => $this->input->post('foto_profil', true)
        ];
        
        // Add owner-specific fields if present
        if ($this->input->post('nama_usaha') !== null) {
            $role_data['nama_usaha'] = $this->input->post('nama_usaha', true);
        }
        if ($this->input->post('alamat_usaha') !== null) {
            $role_data['alamat_usaha'] = $this->input->post('alamat_usaha', true);
        }
        
        // Update user
        $result = $this->User_management_model->updateUser($id, $user_data, $role_data);
        
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            if ($result['success']) {
                $this->session->set_flashdata('success', $result['message']);
            } else {
                $this->session->set_flashdata('error', $result['message']);
            }
            redirect('admin/user_management');
        }
    }

    /**
     * Delete user (AJAX endpoint)
     * @param int $id User ID
     */
    public function delete($id)
    {
        $is_ajax = $this->input->is_ajax_request();
        
        $result = $this->User_management_model->deleteUser($id);
        
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            if ($result['success']) {
                $this->session->set_flashdata('success', $result['message']);
            } else {
                $this->session->set_flashdata('error', $result['message']);
            }
            redirect('admin/user_management');
        }
    }

    /**
     * Toggle user status (AJAX endpoint)
     * @param int $id User ID
     */
    public function toggle_status($id)
    {
        $result = $this->User_management_model->toggleStatus($id);
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
