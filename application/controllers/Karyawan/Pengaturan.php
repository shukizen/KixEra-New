<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Pengaturan_karyawanmodel');
        
        // Cek apakah user sudah login dan role-nya karyawan
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'karyawan') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $id_karyawan = $this->session->userdata('id_karyawan');
        
        // Ambil data karyawan lengkap dengan info cabang
        $data['karyawan'] = $this->Pengaturan_karyawanmodel->get_karyawan_by_id($id_karyawan);
        
        $this->load->view('template/header');
        $this->load->view('template/sidebarkaryawan');
        $this->load->view('karyawan/pengaturan/index', $data);
        $this->load->view('template/footer');
    }
    
    /**
     * Update profil karyawan
     */
    public function update_profile()
    {
        // Validasi request method
        if ($this->input->method() !== 'post') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }
        
        $id_karyawan = $this->session->userdata('id_karyawan');
        
        // Ambil data dari POST
        $nama = $this->input->post('nama_lengkap');
        $email = $this->input->post('email');
        $telepon = $this->input->post('telepon');
        
        // Validasi data
        if (empty($nama) || empty($email) || empty($telepon)) {
            echo json_encode(['success' => false, 'message' => 'Semua field harus diisi']);
            return;
        }
        
        // Validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Format email tidak valid']);
            return;
        }
        
        // Cek apakah email sudah digunakan oleh karyawan lain
        if ($this->Karyawan_model->check_email_exists($email, $id_karyawan)) {
            echo json_encode(['success' => false, 'message' => 'Email sudah digunakan']);
            return;
        }
        
        // Prepare data update
        $update_data = [
            'nama' => $nama,
            'email' => $email,
            'no_telp' => $telepon
        ];
        
        // Update data
        $result = $this->Karyawan_model->update_karyawan($id_karyawan, $update_data);
        
        if ($result) {
            // Update session data
            $this->session->set_userdata('nama', $nama);
            
            echo json_encode(['success' => true, 'message' => 'Profil berhasil diperbarui']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui profil']);
        }
    }
    
    /**
     * Upload foto profil
     */
    public function upload_photo()
    {
        if ($this->input->method() !== 'post') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }
        
        $id_karyawan = $this->session->userdata('id_karyawan');
        
        // Konfigurasi upload
        $config['upload_path'] = './uploads/profile/karyawan/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 5120; // 5MB
        $config['encrypt_name'] = TRUE;
        
        // Buat folder jika belum ada
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('profile_photo')) {
            $error = $this->upload->display_errors('', '');
            echo json_encode(['success' => false, 'message' => $error]);
            return;
        }
        
        $upload_data = $this->upload->data();
        $foto_path = 'uploads/profile/karyawan/' . $upload_data['file_name'];
        
        // Hapus foto lama jika ada
        $karyawan = $this->Karyawan_model->get_karyawan_by_id($id_karyawan);
        if ($karyawan && !empty($karyawan->foto_profil) && file_exists('./' . $karyawan->foto_profil)) {
            unlink('./' . $karyawan->foto_profil);
        }
        
        // Update foto di database
        $result = $this->Karyawan_model->update_karyawan($id_karyawan, ['foto_profil' => $foto_path]);
        
        if ($result) {
            echo json_encode([
                'success' => true, 
                'message' => 'Foto berhasil diupload',
                'photo_url' => base_url($foto_path)
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan foto']);
        }
    }
    
    /**
     * Ubah password
     */
    public function change_password()
    {
        if ($this->input->method() !== 'post') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }
        
        $id_user = $this->session->userdata('id_user');
        $password_lama = $this->input->post('password_lama');
        $password_baru = $this->input->post('password_baru');
        
        // Validasi input
        if (empty($password_lama) || empty($password_baru)) {
            echo json_encode(['success' => false, 'message' => 'Password lama dan baru harus diisi']);
            return;
        }
        
        // Validasi panjang password baru
        if (strlen($password_baru) < 6) {
            echo json_encode(['success' => false, 'message' => 'Password baru minimal 6 karakter']);
            return;
        }
        
        // Ambil data user
        $user = $this->User_model->get_user_by_id($id_user);
        
        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'User tidak ditemukan']);
            return;
        }
        
        // Verifikasi password lama
        if (!password_verify($password_lama, $user['password']) && md5($password_lama) !== $user['password']) {
            echo json_encode(['success' => false, 'message' => 'Password lama tidak sesuai']);
            return;
        }
        
        // Update password
        $result = $this->User_model->change_password($id_user, $password_baru);
        
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Password berhasil diubah']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal mengubah password']);
        }
    }
}