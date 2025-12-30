<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth_library');
        $this->load->model('User_model');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }

    public function index()
    {
        $data['page_title'] = 'Profil Saya - Admin KixEra';
        
        // Get generic user data
        $user = $this->auth_library->get_user();
        
        // Get full details (merging users and admin table)
        $data['user'] = $this->User_model->get_user_details($user);
        
        // Handle case where Admin record is missing
        if (!isset($data['user']['nama']) && $user['role'] == 'admin') {
            $data['user']['nama'] = $data['user']['username'];
            $data['user']['email'] = ''; // Will be populated from users table if available there, but keys need to exist
            $data['user']['no_telp'] = '';
            $data['user']['created_at'] = $data['user']['created_at'] ?? date('Y-m-d H:i:s'); // Fallback
            
            // Try to set email from generic user data if available
            if (isset($user['email'])) {
                 $data['user']['email'] = $user['email'];
            } else {
                 // Try to fetch from users table directly if not in session
                 $u = $this->User_model->get_user_by_id($user['id_user']);
                 if ($u) $data['user']['email'] = $u['email'] ?? '';
            }
        }
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/profil/index', $data);
        $this->load->view('template/footer');
    }

    public function update()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $user = $this->auth_library->get_user();
        $id_user = $user['id_user'];
        
        // Get Admin ID
        $full_user = $this->User_model->get_user_details($user);
        
        $id_admin = $full_user['id_admin'] ?? null;
        
        // Validation
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('no_telp', 'No. Telepon', 'trim');
        
        // Check generic username/email uniqueness if email/username changed?
        // Current implementation of update_owner_profile etc usually updates specific table.
        // BUT email is in `users` table usually (or both?). 
        // Let's check `users` schema again. It has `email`. `admin` also has `email`.
        // We should update BOTH to be safe/consistent.
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
            return;
        }

        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $no_telp = $this->input->post('no_telp');

        // Check if email is already used by another user (if changed)
        if ($email != $user['email']) {
             if ($this->User_model->check_email_exists($email, $id_user)) {
                 echo json_encode(['success' => false, 'message' => 'Email sudah digunakan oleh pengguna lain']);
                 return;
             }
        }

        // Start Transaction
        $this->db->trans_start();

        // 1. Update `users` table (email)
        $users_data = ['email' => $email];
        $this->User_model->updateUser($id_user, $users_data);

        // 2. Update or Insert `admin` table
        $admin_data = [
            'nama' => $nama,
            'email' => $email,
            'no_telp' => $no_telp
        ];
        
        if ($id_admin) {
             $this->User_model->update_admin_profile($id_admin, $admin_data);
        } else {
             // Create new admin record
             $admin_data['id_user'] = $id_user;
             $admin_data['created_at'] = date('Y-m-d H:i:s');
             $this->db->insert('admin', $admin_data);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui profil']);
        } else {
            // Update Session Data if needed (generic auth lib might cache)
            // But usually session holds minimal data.
            echo json_encode(['success' => true, 'message' => 'Profil berhasil diperbarui']);
        }
    }

    public function change_password()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $user = $this->auth_library->get_user();
        
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            echo json_encode(['success' => false, 'message' => 'Semua kolom harus dsiisi']);
            return;
        }

        if ($new_password !== $confirm_password) {
            echo json_encode(['success' => false, 'message' => 'Konfirmasi password tidak cocok']);
            return;
        }
        
        if (strlen($new_password) < 6) {
             echo json_encode(['success' => false, 'message' => 'Password minimal 6 karakter']);
             return;
        }

        // Verify old password
        // Logic usually: get user password hash from DB
        $db_user = $this->User_model->get_user_by_id($user['id_user']);
        if (!password_verify($current_password, $db_user['password'])) {
            echo json_encode(['success' => false, 'message' => 'Password saat ini salah']);
            return;
        }

        // Update password
        if ($this->User_model->change_password($user['id_user'], $new_password)) {
            echo json_encode(['success' => true, 'message' => 'Password berhasil diubah']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengubah password']);
        }
    }
}
