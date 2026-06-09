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
        if ($this->Pengaturan_karyawanmodel->check_email_exists($email, $id_karyawan)) {
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
        $result = $this->Pengaturan_karyawanmodel->update_karyawan($id_karyawan, $update_data);
        
        if ($result) {
            $this->load->library('auth_library');
            $this->auth_library->refresh_session();
            
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
        $karyawan = $this->Pengaturan_karyawanmodel->get_karyawan_by_id($id_karyawan);
        if ($karyawan && !empty($karyawan->foto_profil) && file_exists('./' . $karyawan->foto_profil)) {
            unlink('./' . $karyawan->foto_profil);
        }
        
        // Update foto di database
        $result = $this->Pengaturan_karyawanmodel->update_karyawan($id_karyawan, ['foto_profil' => $foto_path]);
        
        if ($result) {
            $this->load->library('auth_library');
            $this->auth_library->refresh_session();
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
     * Simpan pengaturan notifikasi
     */
    public function save_notification_settings()
    {
        if ($this->input->method() !== 'post') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }
        
        $id_karyawan = $this->session->userdata('id_karyawan');
        
        $notif_pesanan = $this->input->post('notif_pesanan') ? 1 : 0;
        $notif_stok = $this->input->post('notif_stok') ? 1 : 0;
        $notif_shift = $this->input->post('notif_shift') ? 1 : 0;
        
        $update_data = [
            'notif_pesanan' => $notif_pesanan,
            'notif_stok' => $notif_stok,
            'notif_shift' => $notif_shift
        ];
        
        $result = $this->Pengaturan_karyawanmodel->update_notification_settings($id_karyawan, $update_data);
        
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Pengaturan notifikasi berhasil disimpan']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan pengaturan']);
        }
    }
    
    /**
     * Simpan preferensi sistem (bahasa dan mata uang)
     */
    public function save_system_preferences()
    {
        if ($this->input->method() !== 'post') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }
        
        $id_karyawan = $this->session->userdata('id_karyawan');
        
        $bahasa = $this->input->post('bahasa');
        $mata_uang = $this->input->post('mata_uang');
        
        // Validate inputs
        $valid_languages = ['id', 'en'];
        $valid_currencies = ['IDR', 'USD'];
        
        if (!in_array($bahasa, $valid_languages)) {
            $bahasa = 'id'; // default
        }
        
        if (!in_array($mata_uang, $valid_currencies)) {
            $mata_uang = 'IDR'; // default
        }
        
        $update_data = [
            'bahasa' => $bahasa,
            'mata_uang' => $mata_uang
        ];
        
        $result = $this->Pengaturan_karyawanmodel->update_system_preferences($id_karyawan, $update_data);
        
        if ($result) {
            // Update session for immediate effect
            $this->session->set_userdata('bahasa', $bahasa);
            $this->session->set_userdata('mata_uang', $mata_uang);
            
            echo json_encode(['success' => true, 'message' => 'Preferensi sistem berhasil disimpan']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan preferensi']);
        }
    }
}