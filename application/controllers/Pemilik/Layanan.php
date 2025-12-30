<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Layanan_model');
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require owner role
        $this->auth_library->require_role('owner');
    }

    // Helper to get id_pemilik
    private function get_id_pemilik() {
        $id_pemilik = $this->session->userdata('id_pemilik');
        if (empty($id_pemilik)) {
            $id_user = $this->session->userdata('id_user');
            if ($id_user) {
                $owner = $this->db->get_where('pemilik', ['id_user' => $id_user])->row();
                if ($owner) return $owner->id_pemilik;
            }
        }
        return $id_pemilik;
    }

    public function index()
    {
        $id_pemilik = $this->get_id_pemilik();
        $data['layanan'] = $this->Layanan_model->getAllLayananByOwner($id_pemilik);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/layanan/index', $data);
        $this->load->view('template/footer');
    }

    public function store()
    {
        $id_pemilik = $this->get_id_pemilik();
        
        // Check if AJAX request
        $is_ajax = $this->input->is_ajax_request();
        
        $data = [
            'id_pemilik'     => $id_pemilik,
            'nama_layanan'   => $this->input->post('nama_layanan', true),
            'deskripsi'      => $this->input->post('deskripsi', true),
            'harga'          => $this->input->post('harga', true),
            'estimasi_waktu' => $this->input->post('estimasi_waktu', true),
            'status'         => $this->input->post('status', true) ?: 'aktif',
        ];

        // Validasi data
        if(empty($data['nama_layanan']) || empty($data['harga']) || empty($data['estimasi_waktu'])) {
            if($is_ajax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Nama layanan, harga, dan estimasi waktu harus diisi'
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Nama layanan, harga, dan estimasi waktu harus diisi');
                redirect('pemilik/layanan');
            }
        }

        // Validate harga is positive number
        if(!is_numeric($data['harga']) || $data['harga'] <= 0) {
            if($is_ajax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Harga harus berupa angka positif'
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Harga harus berupa angka positif');
                redirect('pemilik/layanan');
            }
        }

        // Validate estimasi_waktu is positive number
        if(!is_numeric($data['estimasi_waktu']) || $data['estimasi_waktu'] <= 0) {
            if($is_ajax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Estimasi waktu harus berupa angka positif'
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Estimasi waktu harus berupa angka positif');
                redirect('pemilik/layanan');
            }
        }

        // Validate status
        if($data['status'] !== 'aktif' && $data['status'] !== 'nonaktif') {
            $data['status'] = 'aktif';
        }

        $result = $this->Layanan_model->insertLayanan($data);
        
        if($is_ajax) {
            echo json_encode([
                'success' => true,
                'message' => 'Layanan berhasil ditambahkan'
            ]);
        } else {
            $this->session->set_flashdata('success', 'Layanan berhasil ditambahkan');
            redirect('pemilik/layanan');
        }
    }

    public function edit($id)
    {
        $id_pemilik = $this->get_id_pemilik();
        
        // RBAC Check
        if (!$this->Layanan_model->checkOwnership($id, $id_pemilik)) {
             echo json_encode(['error' => 'Akses ditolak']);
             return;
        }

        $layanan = $this->Layanan_model->getLayananById($id);
        
        if(!$layanan) {
            echo json_encode(['error' => 'Data tidak ditemukan']);
            return;
        }
        
        echo json_encode($layanan);
    }

    public function update($id)
    {
        $id_pemilik = $this->get_id_pemilik();
        
        // RBAC Check
        if (!$this->Layanan_model->checkOwnership($id, $id_pemilik)) {
             $msg = 'Akses ditolak';
             if ($this->input->is_ajax_request()) {
                 echo json_encode(['success' => false, 'message' => $msg]);
             } else {
                 $this->session->set_flashdata('error', $msg);
                 redirect('pemilik/layanan');
             }
             return;
        }

        // Check if AJAX request
        $is_ajax = $this->input->is_ajax_request();
        
        $data = [
            'nama_layanan'   => $this->input->post('nama_layanan', true),
            'deskripsi'      => $this->input->post('deskripsi', true),
            'harga'          => $this->input->post('harga', true),
            'estimasi_waktu' => $this->input->post('estimasi_waktu', true),
            'status'         => $this->input->post('status', true) ?: 'aktif',
        ];

        // Validasi data
        if(empty($data['nama_layanan']) || empty($data['harga']) || empty($data['estimasi_waktu'])) {
            if($is_ajax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Nama layanan, harga, dan estimasi waktu harus diisi'
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Nama layanan, harga, dan estimasi waktu harus diisi');
                redirect('pemilik/layanan');
            }
        }

        // Validate harga
        if(!is_numeric($data['harga']) || $data['harga'] <= 0) {
            if($is_ajax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Harga harus berupa angka positif'
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Harga harus berupa angka positif');
                redirect('pemilik/layanan');
            }
        }

        // Validate estimasi_waktu
        if(!is_numeric($data['estimasi_waktu']) || $data['estimasi_waktu'] <= 0) {
            if($is_ajax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Estimasi waktu harus berupa angka positif'
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Estimasi waktu harus berupa angka positif');
                redirect('pemilik/layanan');
            }
        }

        // Validate status
        if($data['status'] !== 'aktif' && $data['status'] !== 'nonaktif') {
            $data['status'] = 'aktif';
        }

        $result = $this->Layanan_model->updateLayanan($id, $data);
        
        if($is_ajax) {
            echo json_encode([
                'success' => true,
                'message' => 'Data layanan berhasil diperbarui'
            ]);
        } else {
            $this->session->set_flashdata('success', 'Data layanan berhasil diperbarui');
            redirect('pemilik/layanan');
        }
    }

    public function delete($id)
    {
        $id_pemilik = $this->get_id_pemilik();
        
        // RBAC Check
        if (!$this->Layanan_model->checkOwnership($id, $id_pemilik)) {
             $msg = 'Akses ditolak';
             if ($this->input->is_ajax_request()) {
                 echo json_encode(['success' => false, 'message' => $msg]);
             } else {
                 $this->session->set_flashdata('error', $msg);
                 redirect('pemilik/layanan');
             }
             return;
        }

        // Check if AJAX request
        $is_ajax = $this->input->is_ajax_request();
        
        // Check if layanan exists
        $layanan = $this->Layanan_model->getLayananById($id);
        
        if(!$layanan) {
            if($is_ajax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Data layanan tidak ditemukan'
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Data layanan tidak ditemukan');
                redirect('pemilik/layanan');
            }
        }

        // Perform soft delete
        $result = $this->Layanan_model->softDelete($id);
        
        if($is_ajax) {
            echo json_encode([
                'success' => true,
                'message' => 'Layanan berhasil dihapus'
            ]);
        } else {
            $this->session->set_flashdata('success', 'Layanan berhasil dihapus');
            redirect('pemilik/layanan');
        }
    }

    public function search()
    {
        $id_pemilik = $this->get_id_pemilik();
        $keyword = $this->input->get('keyword', true);
        $status = $this->input->get('status', true);
        
        // Filter by status if provided
        if (!empty($status) && ($status === 'aktif' || $status === 'nonaktif')) {
            $layanan = $this->Layanan_model->getLayananByStatus($status, $id_pemilik);
        } 
        // Search by keyword if provided
        elseif (!empty($keyword)) {
            $layanan = $this->Layanan_model->searchLayanan($keyword, $id_pemilik);
        }
        // Get all layanan
        else {
            $layanan = $this->Layanan_model->getAllLayananByOwner($id_pemilik);
        }
        
        // Return JSON response
        echo json_encode([
            'success' => true,
            'data' => $layanan
        ]);
    }
}
