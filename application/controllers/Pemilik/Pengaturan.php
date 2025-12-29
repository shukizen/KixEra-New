<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('User_model');
        $this->load->helper(['lang', 'currency']);
        // Pastikan user sudah login
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
    }

    private function get_owner_column($table) {
        $candidates = ['id_pemilik', 'id_owner', 'id_admin'];
        foreach ($candidates as $c) {
            if ($this->db->field_exists($c, $table)) {
                return $c;
            }
        }
        return null;
    }

    public function index() {
        // Ambil id_user dari session (user yang sedang login)
        $id_user = $this->session->userdata('id_user');
        $user_role = $this->session->userdata('role');

        // Ambil data user
        $user = $this->User_model->getUserById($id_user);
        
        if (!$user) {
            show_error('User tidak ditemukan');
            return;
        }

        // Ambil data pemilik berdasarkan id_user yang login
        $pemilik = $this->db->where('id_user', $id_user)
                            ->where('deleted_at IS NULL')
                            ->get('pemilik')
                            ->row();

        // Jika tidak ada data pemilik dan role adalah owner, buat baru
        if (!$pemilik && $user_role == 'owner') {
            log_message('debug', "Data pemilik tidak ditemukan untuk id_user: $id_user, membuat baru...");
            
            $insert_data = [
                'id_user' => $id_user,
                'nama' => $user['username'],
                'email' => $user['username'] . '@kixera.com',
                'no_telp' => '0000000000',
                'nama_usaha' => 'Kixera Shoes',
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            if ($this->db->insert('pemilik', $insert_data)) {
                $pemilik = $this->db->where('id_user', $id_user)->get('pemilik')->row();
                log_message('debug', "Data pemilik berhasil dibuat dengan id_pemilik: " . $pemilik->id_pemilik);
            } else {
                show_error('Gagal membuat data pemilik');
                return;
            }
        }
        
        if (!$pemilik) {
            show_error('Data pemilik tidak ditemukan');
            return;
        }
        
        // Initialize session with user's preferences from database
        if (isset($pemilik->bahasa)) {
            $this->session->set_userdata('bahasa', $pemilik->bahasa);
        }
        if (isset($pemilik->mata_uang)) {
            $this->session->set_userdata('mata_uang', $pemilik->mata_uang);
        }
        
        $pemilik->is_admin = false;
        $id_pemilik = $pemilik->id_pemilik;

        // Ambil cabang milik pemilik yang login
        $branches = $this->db->where('id_pemilik', $id_pemilik)
                             ->where('deleted_at IS NULL')
                             ->get('cabang')
                             ->result() ?: [];

        // Ambil karyawan dari cabang-cabang milik pemilik yang login
        $cabang_ids = array_column($branches, 'id_cabang');
        
        if (!empty($cabang_ids)) {
            $this->db->select('karyawan.*, users.username, users.status, cabang.nama_cabang');
            $this->db->from('karyawan');
            $this->db->join('users', 'users.id_user = karyawan.id_user', 'left');
            $this->db->join('cabang', 'cabang.id_cabang = karyawan.id_cabang', 'left');
            $this->db->where_in('karyawan.id_cabang', $cabang_ids);
            $this->db->where('karyawan.deleted_at IS NULL');
            $employees = $this->db->get()->result() ?: [];
        } else {
            $employees = [];
        }

        $data = [
            'pemilik' => $pemilik,
            'user' => $user,
            'branches' => $branches,
            'employees' => $employees
        ];

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/pengaturan/index', $data);
        $this->load->view('template/footer');
    }

    // Halaman Langganan / Subscription
    public function langganan() {
        $id_user = $this->session->userdata('id_user');
        
        // Get pemilik data for current plan info
        $pemilik = $this->db->where('id_user', $id_user)
                           ->where('deleted_at IS NULL')
                           ->get('pemilik')
                           ->row();
        
        $data = [
            'current_plan' => isset($pemilik->subscription_plan) ? $pemilik->subscription_plan : 'free',
            'subscription_end' => isset($pemilik->subscription_end) ? $pemilik->subscription_end : null
        ];

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/pengaturan/langganan', $data);
        $this->load->view('template/footer');
    }

    // Upload profile photo
    public function upload_photo() {
        $id_pemilik = $this->input->post('id_pemilik');
        
        log_message('debug', "upload_photo - id_pemilik: $id_pemilik");
        
        if (empty($id_pemilik)) {
            echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
            return;
        }

        // Ambil data pemilik
        $pemilik = $this->db->where('id_pemilik', $id_pemilik)
                            ->where('deleted_at IS NULL')
                            ->get('pemilik')
                            ->row();
        
        if (!$pemilik) {
            echo json_encode(['success' => false, 'message' => 'Data pemilik tidak ditemukan']);
            return;
        }

        // Upload directory - pastikan path absolut
        $upload_dir = FCPATH . 'uploads/profile/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $config = [
            'upload_path' => $upload_dir,
            'allowed_types' => 'jpg|jpeg|png|gif',
            'max_size' => 5120, // 5MB
            'file_name' => 'profile_' . $id_pemilik . '_' . time(),
            'overwrite' => true
        ];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_photo')) {
            $error = $this->upload->display_errors('', '');
            log_message('error', "upload_photo - Upload error: $error");
            echo json_encode(['success' => false, 'message' => $error]);
            return;
        }

        $upload_data = $this->upload->data();
        $photo_path = 'uploads/profile/' . $upload_data['file_name'];

        // Update foto_profil di tabel pemilik
        $this->db->where('id_pemilik', $id_pemilik);
        $result = $this->db->update('pemilik', [
            'foto_profil' => $photo_path,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        log_message('debug', "upload_photo - Updated rows: " . $this->db->affected_rows());
        log_message('debug', "upload_photo - Photo path: " . $photo_path);

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
        $id_pemilik = $this->input->post('id_pemilik');
        $nama = trim($this->input->post('nama_lengkap'));
        $email = trim($this->input->post('email'));
        $telepon = trim($this->input->post('telepon'));

        log_message('debug', "update_profile - id_pemilik: $id_pemilik, nama: $nama, email: $email, telepon: $telepon");

        if (empty($id_pemilik) || empty($nama) || empty($email) || empty($telepon)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        // Cek apakah pemilik atau admin
        $is_admin = false;
        $record = $this->db->where('id_pemilik', $id_pemilik)
                           ->where('deleted_at IS NULL')
                           ->get('pemilik')
                           ->row();
        
        if (!$record) {
            // Coba cek di tabel admin
            $record = $this->db->where('id_admin', $id_pemilik)
                               ->where('deleted_at IS NULL')
                               ->get('admin')
                               ->row();
            $is_admin = true;
        }
        
        if (!$record) {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
            return;
        }

        // Update data
        $update_data = [
            'nama' => $nama,
            'email' => $email,
            'no_telp' => $telepon,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($is_admin) {
            $this->db->where('id_admin', $id_pemilik);
            $this->db->update('admin', $update_data);
        } else {
            $this->db->where('id_pemilik', $id_pemilik);
            $this->db->update('pemilik', $update_data);
        }
        
        $affected = $this->db->affected_rows();
        log_message('debug', "update_profile - affected_rows: $affected");
        log_message('debug', "update_profile - db_error: " . json_encode($this->db->error()));

        echo json_encode(['success' => true, 'message' => 'Profil berhasil diperbarui', 'affected_rows' => $affected]);
    }

    public function change_password() {
        // Ambil id_user dari session
        $id_user = $this->session->userdata('id_user');
        $password_lama = $this->input->post('password_lama');
        $password_baru = $this->input->post('password_baru');

        log_message('debug', "change_password - id_user: $id_user");

        if (empty($password_lama) || empty($password_baru)) {
            echo json_encode(['success' => false, 'message' => 'Password tidak boleh kosong']);
            return;
        }

        $user = $this->User_model->getUserById($id_user);
        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'User tidak ditemukan di database']);
            return;
        }

        log_message('debug', "change_password - user password hash: " . substr($user['password'], 0, 20) . "...");

        if (!password_verify($password_lama, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'Password lama tidak sesuai']);
            return;
        }

        $updated = $this->User_model->change_password($id_user, $password_baru);
        
        log_message('debug', "change_password - updated: " . ($updated ? 'true' : 'false'));

        if ($updated) {
            echo json_encode(['success' => true, 'message' => 'Password berhasil diubah']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengubah password']);
        }
    }

    public function get_employee($id) {
        $emp = $this->db->select('karyawan.*, users.username, users.status, cabang.nama_cabang')
                        ->from('karyawan')
                        ->join('users', 'users.id_user = karyawan.id_user', 'left')
                        ->join('cabang', 'cabang.id_cabang = karyawan.id_cabang', 'left')
                        ->where('karyawan.id_karyawan', $id)
                        ->where('karyawan.deleted_at IS NULL')
                        ->get()->row();
        echo json_encode(['success' => !!$emp, 'data' => $emp]);
    }

    public function add_employee() {
        $nama = trim($this->input->post('nama_karyawan'));
        $email = trim($this->input->post('email_karyawan'));
        $jabatan = $this->input->post('jabatan') ?: 'Staff';
        $telepon = trim($this->input->post('telepon_karyawan'));
        $id_cabang = (int) $this->input->post('id_cabang');
        $status = $this->input->post('status') ?: 'aktif';
        $password = trim($this->input->post('password_karyawan')); // PASSWORD BARU

        log_message('debug', "add_employee - nama: $nama, email: $email, jabatan: $jabatan, telepon: $telepon, id_cabang: $id_cabang, status: $status");

        // Validasi data
        if (empty($nama)) {
            echo json_encode(['success' => false, 'message' => 'Nama karyawan harus diisi']);
            return;
        }
        if (empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Email karyawan harus diisi']);
            return;
        }
        if (empty($telepon)) {
            echo json_encode(['success' => false, 'message' => 'Telepon karyawan harus diisi']);
            return;
        }
        if ($id_cabang === 0) {
            echo json_encode(['success' => false, 'message' => 'Cabang harus dipilih']);
            return;
        }
        
        // Validasi password
        if (empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Password harus diisi']);
            return;
        }
        if (strlen($password) < 6) {
            echo json_encode(['success' => false, 'message' => 'Password minimal 6 karakter']);
            return;
        }

        // Ambil id_user dari session untuk mendapatkan id_pemilik
        $id_user = $this->session->userdata('id_user');
        $pemilik = $this->db->where('id_user', $id_user)
                            ->where('deleted_at IS NULL')
                            ->get('pemilik')
                            ->row();

        if (!$pemilik) {
            echo json_encode(['success' => false, 'message' => 'Data pemilik tidak ditemukan']);
            return;
        }

        // Cek apakah cabang ada dan milik pemilik yang login
        $cabang = $this->db->where('id_cabang', $id_cabang)
                           ->where('id_pemilik', $pemilik->id_pemilik)
                           ->where('deleted_at IS NULL')
                           ->get('cabang')
                           ->row();
        
        if (!$cabang) {
            echo json_encode(['success' => false, 'message' => 'Cabang tidak ditemukan atau bukan milik Anda']);
            return;
        }

        // Generate username dari email (bagian sebelum @)
        $base_username = strtolower(explode('@', $email)[0]);
        $base_username = preg_replace('/[^a-zA-Z0-9]/', '_', $base_username);
        $username = $base_username;
        $counter = 1;
        
        // Cek apakah username sudah ada, jika ada tambahkan counter
        while ($this->User_model->check_username_exists($username)) {
            $username = $base_username . '_' . $counter;
            $counter++;
        }

        log_message('debug', "add_employee - Generated username: $username");

        // Start transaction
        $this->db->trans_start();

        // Insert ke tabel users dengan password yang diinput pemilik
        $user_data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'karyawan',
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if (!$this->db->insert('users', $user_data)) {
            $this->db->trans_rollback();
            $db_error = $this->db->error();
            log_message('error', "add_employee - Gagal insert users: " . json_encode($db_error));
            echo json_encode(['success' => false, 'message' => 'Gagal membuat user: ' . $db_error['message']]);
            return;
        }

        $id_user_new = $this->db->insert_id();
        log_message('debug', "add_employee - User berhasil dibuat dengan id_user: $id_user_new");

        // Insert ke tabel karyawan
        $karyawan_data = [
            'id_user' => $id_user_new,
            'id_cabang' => $id_cabang,
            'nama' => $nama,
            'email' => $email,
            'no_telp' => $telepon,
            'jabatan' => $jabatan,
            'tgl_masuk' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        log_message('debug', "add_employee - karyawan_data: " . json_encode($karyawan_data));

        if (!$this->db->insert('karyawan', $karyawan_data)) {
            $this->db->trans_rollback();
            $db_error = $this->db->error();
            log_message('error', "add_employee - Gagal insert karyawan: " . json_encode($db_error));
            echo json_encode(['success' => false, 'message' => 'Gagal menambahkan karyawan: ' . $db_error['message']]);
            return;
        }

        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            log_message('error', "add_employee - Transaction failed");
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data (transaction failed)']);
            return;
        }

        log_message('debug', "add_employee - Karyawan berhasil ditambahkan");

        echo json_encode([
            'success' => true, 
            'message' => 'Karyawan berhasil ditambahkan',
            'username' => $username,
            'password' => $password, // Tampilkan password yang diinput pemilik
            'id_user' => $id_user_new
        ]);
    }

    public function update_employee() {
        $id_karyawan = (int) $this->input->post('id_karyawan');
        $nama = trim($this->input->post('nama_karyawan'));
        $email = trim($this->input->post('email_karyawan'));
        $telepon = trim($this->input->post('telepon_karyawan'));
        $jabatan = $this->input->post('jabatan') ?: 'Staff';
        $status = $this->input->post('status') ?: 'aktif';

        log_message('debug', "update_employee - id_karyawan: $id_karyawan, status: $status");

        if ($id_karyawan === 0 || empty($nama) || empty($email) || empty($telepon)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        // Get employee untuk mendapat id_user
        $emp = $this->db->where('id_karyawan', $id_karyawan)->get('karyawan')->row();
        if (!$emp) {
            echo json_encode(['success' => false, 'message' => 'Karyawan tidak ditemukan']);
            return;
        }

        $this->db->trans_start();

        // Update status di tabel users
        if ($emp->id_user) {
            $this->db->where('id_user', $emp->id_user);
            $this->db->update('users', ['status' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
            log_message('debug', "update_employee - User status updated");
        }

        // Update data di tabel karyawan
        $karyawan_data = [
            'nama' => $nama,
            'email' => $email,
            'no_telp' => $telepon,
            'jabatan' => $jabatan,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->update('karyawan', $karyawan_data);

        $this->db->trans_complete();

        log_message('debug', "update_employee - affected_rows: " . $this->db->affected_rows());

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan perubahan']);
            return;
        }

        echo json_encode(['success' => true, 'message' => 'Data karyawan berhasil diperbarui']);
    }

    public function delete_employee() {
        $id_karyawan = (int) $this->input->post('id_karyawan');
        
        log_message('debug', "delete_employee - id_karyawan: $id_karyawan");

        if ($id_karyawan === 0) {
            echo json_encode(['success' => false, 'message' => 'ID karyawan tidak ditemukan']);
            return;
        }

        // Get employee untuk mendapat id_user
        $emp = $this->db->where('id_karyawan', $id_karyawan)->get('karyawan')->row();
        
        $this->db->trans_start();

        // Soft delete karyawan
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->update('karyawan', $data);

        // Juga soft delete user jika ada
        if ($emp && $emp->id_user) {
            $this->db->where('id_user', $emp->id_user);
            $this->db->update('users', ['deleted_at' => date('Y-m-d H:i:s')]);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus karyawan']);
            return;
        }

        echo json_encode(['success' => true, 'message' => 'Karyawan berhasil dihapus']);
    }

    public function get_branch($id) {
        $branch = $this->db->where('id_cabang', $id)->where('deleted_at IS NULL')->get('cabang')->row();
        echo json_encode(['success' => !!$branch, 'data' => $branch]);
    }

    public function add_branch() {
        // Ambil id_pemilik dari session
        $id_user = $this->session->userdata('id_user');
        $pemilik = $this->db->where('id_user', $id_user)
                            ->where('deleted_at IS NULL')
                            ->get('pemilik')
                            ->row();

        if (!$pemilik) {
            echo json_encode(['success' => false, 'message' => 'Data pemilik tidak ditemukan']);
            return;
        }

        $id_pemilik = $pemilik->id_pemilik;
        $nama_cabang = trim($this->input->post('nama_cabang'));
        $alamat = trim($this->input->post('alamat'));
        $telepon = trim($this->input->post('telepon'));
        $status = $this->input->post('status') ?: 'aktif';

        log_message('debug', "add_branch - id_pemilik: $id_pemilik, nama_cabang: $nama_cabang, status: $status");

        // Validasi data wajib
        if (empty($nama_cabang) || empty($alamat) || empty($telepon)) {
            echo json_encode(['success' => false, 'message' => 'Nama cabang, alamat, dan telepon harus diisi']);
            return;
        }

        // Pastikan pakai id_pemilik
        $branch_data = [
            'id_pemilik' => $id_pemilik,
            'nama_cabang' => $nama_cabang,
            'alamat_cabang' => $alamat,
            'no_telp' => $telepon,
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s')
        ];

        log_message('debug', "add_branch - data: " . json_encode($branch_data));

        if ($this->db->insert('cabang', $branch_data)) {
            echo json_encode(['success' => true, 'message' => 'Cabang berhasil ditambahkan']);
        } else {
            log_message('error', "add_branch - Gagal insert: " . json_encode($this->db->error()));
            echo json_encode(['success' => false, 'message' => 'Gagal menambahkan cabang']);
        }
    }

    public function update_branch() {
        $id_cabang = (int) $this->input->post('id_cabang');
        $nama_cabang = trim($this->input->post('nama_cabang'));
        $alamat = trim($this->input->post('alamat'));
        $telepon = trim($this->input->post('telepon'));
        $status = $this->input->post('status') ?: 'aktif';

        log_message('debug', "update_branch - id_cabang: $id_cabang, status: $status");

        if ($id_cabang === 0 || empty($nama_cabang) || empty($alamat) || empty($telepon)) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        $update_data = [
            'nama_cabang' => $nama_cabang,
            'alamat_cabang' => $alamat,
            'no_telp' => $telepon,
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id_cabang', $id_cabang);
        $this->db->update('cabang', $update_data);

        log_message('debug', "update_branch - affected_rows: " . $this->db->affected_rows());

        echo json_encode(['success' => true, 'message' => 'Cabang berhasil diperbarui']);
    }

    public function delete_branch() {
        $id_cabang = (int) $this->input->post('id_cabang');
        
        log_message('debug', "delete_branch - id_cabang: $id_cabang");

        if ($id_cabang === 0) {
            echo json_encode(['success' => false, 'message' => 'ID cabang tidak ditemukan']);
            return;
        }

        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_cabang', $id_cabang);
        $this->db->update('cabang', $data);

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['success' => true, 'message' => 'Cabang berhasil dihapus']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus cabang']);
        }
    }

    // Save preferences (bahasa & mata uang)
    public function save_preferences() {
        $id_pemilik = $this->input->post('id_pemilik');
        $bahasa = $this->input->post('bahasa');
        $mata_uang = $this->input->post('mata_uang');

        log_message('debug', "save_preferences - id_pemilik: $id_pemilik, bahasa: $bahasa, mata_uang: $mata_uang");

        if (empty($id_pemilik)) {
            echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
            return;
        }

        // Validasi nilai bahasa
        $valid_bahasa = ['id', 'en'];
        if (!in_array($bahasa, $valid_bahasa)) {
            $bahasa = 'id'; // default
        }

        // Validasi nilai mata_uang
        $valid_mata_uang = ['IDR', 'USD', 'EUR', 'SGD', 'MYR'];
        if (!in_array($mata_uang, $valid_mata_uang)) {
            $mata_uang = 'IDR'; // default
        }

        // Check if pemilik exists
        $pemilik = $this->db->where('id_pemilik', $id_pemilik)
                            ->where('deleted_at IS NULL')
                            ->get('pemilik')
                            ->row();
        
        if (!$pemilik) {
            echo json_encode(['success' => false, 'message' => 'Data pemilik tidak ditemukan']);
            return;
        }

        // Update preferences
        $update_data = [
            'bahasa' => $bahasa,
            'mata_uang' => $mata_uang,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id_pemilik', $id_pemilik);
        $result = $this->db->update('pemilik', $update_data);

        log_message('debug', "save_preferences - affected_rows: " . $this->db->affected_rows());
        log_message('debug', "save_preferences - db_error: " . json_encode($this->db->error()));

        if ($result) {
            // Also save to session for immediate use
            $this->session->set_userdata('bahasa', $bahasa);
            $this->session->set_userdata('mata_uang', $mata_uang);

            $bahasa_text = $bahasa == 'id' ? 'Indonesia' : 'English';
            $mata_uang_text = [
                'IDR' => 'Rupiah (Rp)',
                'USD' => 'Dollar ($)',
                'EUR' => 'Euro (€)',
            ][$mata_uang] ?? $mata_uang;

            echo json_encode([
                'success' => true, 
                'message' => "Preferensi berhasil disimpan! Bahasa: $bahasa_text, Mata Uang: $mata_uang_text"
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan preferensi']);
        }
    }

    // Save notification settings
    public function save_notification_settings() {
        $id_pemilik = $this->input->post('id_pemilik');
        $notif_pesanan = $this->input->post('notif_pesanan');
        $notif_stok = $this->input->post('notif_stok');
        $notif_laporan = $this->input->post('notif_laporan');

        log_message('debug', "save_notification_settings - id_pemilik: $id_pemilik");

        if (empty($id_pemilik)) {
            echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
            return;
        }

        // Update notification settings
        $update_data = [
            'notif_pesanan' => $notif_pesanan == '1' ? '1' : '0',
            'notif_stok' => $notif_stok == '1' ? '1' : '0',
            'notif_laporan' => $notif_laporan == '1' ? '1' : '0',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id_pemilik', $id_pemilik);
        $result = $this->db->update('pemilik', $update_data);

        if ($result) {
            echo json_encode([
                'success' => true, 
                'message' => 'Pengaturan notifikasi berhasil disimpan!'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan pengaturan notifikasi']);
        }
    }
}