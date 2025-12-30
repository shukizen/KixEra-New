<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Pelanggan_model');
        $this->load->model('Karyawan_model');
        $this->load->library('session');
    }

    // Helper to get id_cabang from session or database
    private function get_id_cabang() {
        $id_cabang = $this->session->userdata('id_cabang');
        
        if (empty($id_cabang)) {
            $user_id = $this->session->userdata('user_id');
            if ($user_id) {
                $karyawan = $this->Karyawan_model->getKaryawanByUserId($user_id);
                if ($karyawan) {
                    $id_cabang = $karyawan->id_cabang;
                    // Store in session for future use
                    $this->session->set_userdata('id_cabang', $id_cabang);
                }
            }
        }
        
        // Fallback for testing - get first karyawan's cabang
        if (empty($id_cabang)) {
            $first_karyawan = $this->db->get('karyawan')->row();
            if ($first_karyawan) {
                $id_cabang = $first_karyawan->id_cabang;
            }
        }
        
        return $id_cabang;
    }

    public function index()
    {
        $id_cabang = $this->get_id_cabang();
        
        // Get pelanggan data for this branch
        $data['pelanggan'] = $this->Pelanggan_model->getAllPelangganForCabang($id_cabang);
        
        // Get cabang info
        $cabang = $this->db->where('id_cabang', $id_cabang)->get('cabang')->row();
        $data['cabang'] = $cabang;
        $data['id_cabang'] = $id_cabang;

        $this->load->view('template/header');
        $this->load->view('template/sidebarkaryawan');
        $this->load->view('karyawan/pelanggan/index', $data);
        $this->load->view('template/footer');
    }

    // Get customer data for edit modal
    public function edit($id)
    {
        $id_cabang = $this->get_id_cabang();
        
        // Check if karyawan has access to this customer
        if (!$this->Pelanggan_model->checkAccessByCabang($id, $id_cabang)) {
            echo json_encode(['error' => 'Akses ditolak']);
            return;
        }

        $pelanggan = $this->Pelanggan_model->getPelangganById($id);
        
        if(!$pelanggan) {
            echo json_encode(['error' => 'Data tidak ditemukan']);
            return;
        }
        
        echo json_encode($pelanggan);
    }

    // Update customer data
    public function update($id)
    {
        $id_cabang = $this->get_id_cabang();
        
        // Check access
        if (!$this->Pelanggan_model->checkAccessByCabang($id, $id_cabang)) {
            echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
            return;
        }

        $data = [
            'nama'    => $this->input->post('nama', true),
            'no_telp' => $this->input->post('no_telp', true),
            'email'   => $this->input->post('email', true),
            'alamat'  => $this->input->post('alamat', true),
        ];

        // Validate required fields
        if(empty($data['nama']) || empty($data['no_telp'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Nama dan No. Telepon harus diisi'
            ]);
            return;
        }

        // Check if phone number already exists (for other customers)
        $existing = $this->db->where('no_telp', $data['no_telp'])
                             ->where('id_pelanggan !=', $id)
                             ->where('deleted_at IS NULL')
                             ->get('pelanggan')
                             ->row();
        
        if($existing) {
            echo json_encode([
                'success' => false,
                'message' => 'Nomor telepon sudah digunakan pelanggan lain'
            ]);
            return;
        }

        $result = $this->Pelanggan_model->updatePelanggan($id, $data);
        
        echo json_encode([
            'success' => true,
            'message' => 'Data pelanggan berhasil diperbarui'
        ]);
    }

    // Search customers
    public function search()
    {
        $id_cabang = $this->get_id_cabang();
        $keyword = $this->input->get('keyword', true);
        
        $pelanggan = empty($keyword) ? 
            $this->Pelanggan_model->getAllPelangganForCabang($id_cabang) : 
            $this->Pelanggan_model->searchPelangganByCabang($keyword, $id_cabang);
        
        echo json_encode([
            'success' => true,
            'data' => $pelanggan
        ]);
    }

    // Store new customer
    public function store()
    {
        $data = [
            'nama'    => $this->input->post('nama', true),
            'no_telp' => $this->input->post('no_telp', true),
            'email'   => $this->input->post('email', true),
            'alamat'  => $this->input->post('alamat', true),
        ];

        // Validate required fields
        if(empty($data['nama']) || empty($data['no_telp'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Nama dan No. Telepon harus diisi'
            ]);
            return;
        }

        // Check if phone number already exists
        $existing = $this->Pelanggan_model->checkByPhone($data['no_telp']);
        
        if($existing) {
            echo json_encode([
                'success' => false,
                'message' => 'Nomor telepon sudah terdaftar'
            ]);
            return;
        }

        $result = $this->Pelanggan_model->insertPelanggan($data);
        
        if($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Pelanggan baru berhasil ditambahkan'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menambahkan pelanggan'
            ]);
        }
    }
}
