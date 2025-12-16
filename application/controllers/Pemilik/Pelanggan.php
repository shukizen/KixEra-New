<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggan_model');
    }

    public function index()
    {
        $data['pelanggan'] = $this->Pelanggan_model->getAllPelanggan();

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/pelanggan/index', $data);
        $this->load->view('template/footer');
    }

    public function edit($id)
    {
        $pelanggan = $this->Pelanggan_model->getPelangganById($id);
        
        if(!$pelanggan) {
            echo json_encode(['error' => 'Data tidak ditemukan']);
            return;
        }
        
        echo json_encode($pelanggan);
    }

    public function update($id)
    {
        // Check if AJAX request
        $is_ajax = $this->input->is_ajax_request();
        
        $data = [
            'nama'    => $this->input->post('nama', true),
            'no_telp' => $this->input->post('no_telp', true),
            'email'   => $this->input->post('email', true),
            'alamat'  => $this->input->post('alamat', true),
        ];

        // Validasi data
        if(empty($data['nama']) || empty($data['no_telp'])) {
            if($is_ajax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Nama dan No. Telepon harus diisi'
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Nama dan No. Telepon harus diisi');
                redirect('pelanggan');
            }
        }

        // Check if phone number already exists (for other customers)
        $existing = $this->db->where('no_telp', $data['no_telp'])
                             ->where('id_pelanggan !=', $id)
                             ->where('deleted_at IS NULL')
                             ->get('pelanggan')
                             ->row();
        
        if($existing) {
            if($is_ajax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Nomor telepon sudah digunakan pelanggan lain'
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Nomor telepon sudah digunakan pelanggan lain');
                redirect('pelanggan');
            }
        }

        $result = $this->Pelanggan_model->updatePelanggan($id, $data);
        
        if($is_ajax) {
            echo json_encode([
                'success' => true,
                'message' => 'Data pelanggan berhasil diperbarui'
            ]);
        } else {
            $this->session->set_flashdata('success', 'Data pelanggan berhasil diperbarui');
            redirect('pelanggan');
        }
    }

    public function delete($id)
    {
        // Check if AJAX request
        $is_ajax = $this->input->is_ajax_request();
        
        // Check if customer exists
        $pelanggan = $this->Pelanggan_model->getPelangganById($id);
        
        if(!$pelanggan) {
            if($is_ajax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Data pelanggan tidak ditemukan'
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Data pelanggan tidak ditemukan');
                redirect('pelanggan');
            }
        }

        // Check if customer has orders
        $has_orders = $this->db->where('id_pelanggan', $id)
                               ->where('deleted_at IS NULL')
                               ->get('pesanan')
                               ->num_rows() > 0;
        
        if($has_orders) {
            if($is_ajax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Pelanggan tidak dapat dihapus karena memiliki riwayat pesanan'
                ]);
                return;
            } else {
                $this->session->set_flashdata('error', 'Pelanggan tidak dapat dihapus karena memiliki riwayat pesanan');
                redirect('pelanggan');
            }
        }

        $result = $this->Pelanggan_model->softDelete($id);
        
        if($is_ajax) {
            echo json_encode([
                'success' => true,
                'message' => 'Pelanggan berhasil dihapus'
            ]);
        } else {
            $this->session->set_flashdata('success', 'Pelanggan berhasil dihapus');
            redirect('pelanggan');
        }
    }

    public function search()
    {
        $keyword = $this->input->get('keyword', true);
        $pelanggan = empty($keyword) ? 
            $this->Pelanggan_model->getAllPelanggan() : 
            $this->Pelanggan_model->searchPelanggan($keyword);
        
        // Return JSON response
        echo json_encode([
            'success' => true,
            'data' => $pelanggan
        ]);
    }

    public function grafik()
    {
        // Get period parameter (default 6 months)
        $period = $this->input->get('period', true);
        $period = intval($period) ?: 6;
        
        $distribusi = $this->Pelanggan_model->grafikCabang();
        $top = $this->Pelanggan_model->topPelanggan();
        $growth = $this->Pelanggan_model->pertumbuhanBulanan($period);
        
        header('Content-Type: application/json');
        echo json_encode([
            'distribusi' => $distribusi,
            'top' => $top,
            'growth' => $growth,
            'period' => $period
        ]);
    }
}