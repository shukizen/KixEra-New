<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('User_model');
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require owner role
        $this->auth_library->require_role('owner');
    }

    // Helper to get id_pemilik securely
    private function get_id_pemilik() {
        $id_pemilik = $this->session->userdata('id_pemilik');
        if (empty($id_pemilik)) {
             $user_id = $this->session->userdata('id_user');
             if ($user_id) {
                 $this->load->model('Owner_model');
                 $owner = $this->Owner_model->getOwnerByUserId($user_id);
                 if ($owner) return $owner->id_pemilik;
             }
        }
        return $id_pemilik;
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        $id_pemilik = $this->get_id_pemilik();

        // Ambil data user
        $user = $this->User_model->getUserById($id_user);
        
        if (!$user) {
            show_error('User session invalid', 403);
            return;
        }

        // Ambil data pemilik
        $pemilik = null;
        if ($id_pemilik) {
            $pemilik = $this->db->where('id_pemilik', $id_pemilik)
                                ->where('deleted_at IS NULL')
                                ->get('pemilik')
                                ->row();
        }

        // Jika tidak ada data pemilik (autogen logic)
        if (!$pemilik) {
            // Try to find by user_id if id_pemilik missing from session
            $pemilik = $this->db->where('id_user', $id_user)->where('deleted_at IS NULL')->get('pemilik')->row();
            
            if (!$pemilik) {
                // Auto-create PEMILIK if missing
                log_message('debug', "Data pemilik tidak ditemukan untuk id_user: $id_user, membuat baru...");
                
                $insert_data = [
                    'id_user' => $id_user,
                    'nama' => $user->username,
                    'email' => $user->email ? $user->email : $user->username . '@kixera.com',
                    'no_telp' => '0000000000',
                    'nama_usaha' => 'Kixera Shoes',
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                if ($this->db->insert('pemilik', $insert_data)) {
                    $insert_id = $this->db->insert_id();
                    $pemilik = $this->db->where('id_pemilik', $insert_id)->get('pemilik')->row();
                    // Update session
                    $this->session->set_userdata('id_pemilik', $pemilik->id_pemilik);
                    $id_pemilik = $pemilik->id_pemilik;
                } else {
                    show_error('Gagal membuat data pemilik');
                    return;
                }
            } else {
                 $id_pemilik = $pemilik->id_pemilik;
                 $this->session->set_userdata('id_pemilik', $id_pemilik);
            }
        }
        
        $pemilik->is_admin = false;

        // Fetch Branches (Scoped to Owner)
        $branches = $this->db->where('id_pemilik', $id_pemilik)
                             ->where('deleted_at IS NULL')
                             ->get('cabang')
                             ->result() ?: [];

        // Fetch Employees (Scoped to Owner's Branches)
        $employees = [];
        if (!empty($branches)) {
             $employees = $this->db->select('karyawan.*, users.username, users.status, cabang.nama_cabang')
                                  ->from('karyawan')
                                  ->join('users', 'users.id_user = karyawan.id_user', 'left')
                                  ->join('cabang', 'cabang.id_cabang = karyawan.id_cabang')
                                  ->where('cabang.id_pemilik', $id_pemilik)
                                  ->where('karyawan.deleted_at IS NULL')
                                  ->get()->result() ?: [];
        }

        $data = [
            'pemilik' => $pemilik,
            'user' => $user,
            'branches' => $branches,
            'employees' => $employees,
            'id_pemilik' => $id_pemilik
        ];

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/pengaturan/index', $data);
        $this->load->view('template/footer');
    }

    // Upload profile photo
    public function upload_photo() {
        $id_pemilik_form = $this->input->post('id_pemilik');
        $id_pemilik_sess = $this->get_id_pemilik();
        
        if ($id_pemilik_form != $id_pemilik_sess) {
             echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
             return;
        }
        
        if (empty($id_pemilik_sess)) {
            echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
            return;
        }

        // Upload directory
        $upload_dir = FCPATH . 'uploads/profile/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $config = [
            'upload_path' => $upload_dir,
            'allowed_types' => 'jpg|jpeg|png|gif',
            'max_size' => 5120, // 5MB
            'file_name' => 'profile_' . $id_pemilik_sess . '_' . time(),
            'overwrite' => true
        ];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_photo')) {
            $error = $this->upload->display_errors('', '');
            echo json_encode(['success' => false, 'message' => $error]);
            return;
        }

        $upload_data = $this->upload->data();
        $photo_path = 'uploads/profile/' . $upload_data['file_name'];

        // Update foto_profil di tabel pemilik
        $this->db->where('id_pemilik', $id_pemilik_sess);
        $result = $this->db->update('pemilik', [
            'foto_profil' => $photo_path,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Foto berhasil diupload',
                'photo_url' => base_url($photo_path)
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menyimpan path foto ke database'
            ]);
        }
    }

    public function update_profile() {
        $id_pemilik_form = $this->input->post('id_pemilik');
        $id_pemilik_sess = $this->get_id_pemilik();
        
        if ($id_pemilik_form != $id_pemilik_sess) {
             echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
             return;
        }

        $nama = trim($this->input->post('nama_lengkap'));
        $email = trim($this->input->post('email'));
        $telepon = trim($this->input->post('telepon'));
        
        if (empty($nama) || empty($email) || empty($telepon)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        // Update data
        $update_data = [
            'nama' => $nama,
            'email' => $email,
            'no_telp' => $telepon,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id_pemilik', $id_pemilik_sess);
        $this->db->update('pemilik', $update_data);
        
        echo json_encode(['success' => true, 'message' => 'Profil berhasil diperbarui']);
    }

    public function change_password() {
        $id_user = $this->session->userdata('user_id');
        $password_lama = $this->input->post('password_lama');
        $password_baru = $this->input->post('password_baru');

        if (empty($password_lama) || empty($password_baru)) {
            echo json_encode(['success' => false, 'message' => 'Password tidak boleh kosong']);
            return;
        }

        $user = $this->User_model->getUserById($id_user);
        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'User session invalid']);
            return;
        }

        if (!password_verify($password_lama, $user->password)) {
            echo json_encode(['success' => false, 'message' => 'Password lama tidak sesuai']);
            return;
        }

        $updated = $this->User_model->updateUser($id_user, ['password' => $password_baru]);
        
        if ($updated) {
            echo json_encode(['success' => true, 'message' => 'Password berhasil diubah']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengubah password']);
        }
    }

    public function get_employee($id) {
        $id_pemilik = $this->get_id_pemilik();
        
        $emp = $this->db->select('karyawan.*, users.username, users.status, cabang.nama_cabang')
                        ->from('karyawan')
                        ->join('users', 'users.id_user = karyawan.id_user', 'left')
                        ->join('cabang', 'cabang.id_cabang = karyawan.id_cabang', 'left')
                        ->where('karyawan.id_karyawan', $id)
                        ->where('karyawan.deleted_at IS NULL')
                        ->where('cabang.id_pemilik', $id_pemilik) // Scope to owner
                        ->get()->row();
                        
        echo json_encode(['success' => !!$emp, 'data' => $emp]);
    }

    public function add_employee() {
        $id_pemilik = $this->get_id_pemilik();
        
        $nama = trim($this->input->post('nama_karyawan'));
        $email = trim($this->input->post('email_karyawan'));
        $jabatan = $this->input->post('jabatan') ?: 'Staff';
        $telepon = trim($this->input->post('telepon_karyawan'));
        $id_cabang = (int) $this->input->post('id_cabang');
        $status = $this->input->post('status') ?: 'aktif';

        // Validasi data
        if (empty($nama) || empty($email) || empty($telepon)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }
        if ($id_cabang === 0) {
            echo json_encode(['success' => false, 'message' => 'Cabang harus dipilih']);
            return;
        }

        // Cek kepemilikan cabang
        $cabang = $this->db->where('id_cabang', $id_cabang)
                           ->where('id_pemilik', $id_pemilik) // Verify ownership
                           ->where('deleted_at IS NULL')
                           ->get('cabang')
                           ->row();
                           
        if (!$cabang) {
            echo json_encode(['success' => false, 'message' => 'Cabang tidak valid atau akses ditolak']);
            return;
        }

        // Basic insert to karyawan
        $data = [
            'id_cabang' => $id_cabang,
            'nama' => $nama,
            'no_telp' => $telepon,
            'jabatan' => $jabatan,
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->db->insert('karyawan', $data)) {
             echo json_encode(['success' => true, 'message' => 'Karyawan berhasil ditambahkan']);
        } else {
             echo json_encode(['success' => false, 'message' => 'Gagal menambahkan karyawan']);
        }
    }
}