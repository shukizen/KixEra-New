<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggan_model');
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
        $data['pelanggan'] = $this->Pelanggan_model->getAllPelanggan($id_pemilik);
        $data['cabang_list'] = $this->db
            ->where('id_pemilik', $id_pemilik)
            ->where('deleted_at IS NULL')
            ->order_by('nama_cabang', 'ASC')
            ->get('cabang')
            ->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/pelanggan/index', $data);
        $this->load->view('template/footer');
    }

    private function verify_branch_ownership($id_cabang, $id_pemilik)
    {
        if (!$id_cabang || !$id_pemilik) return false;

        return $this->db
            ->where('id_cabang', $id_cabang)
            ->where('id_pemilik', $id_pemilik)
            ->where('deleted_at IS NULL')
            ->count_all_results('cabang') > 0;
    }

    private function get_default_cabang($id_pemilik)
    {
        return $this->db
            ->where('id_pemilik', $id_pemilik)
            ->where('deleted_at IS NULL')
            ->order_by('id_cabang', 'ASC')
            ->get('cabang')
            ->row();
    }

    public function store()
    {
        $id_pemilik = $this->get_id_pemilik();
        $is_ajax = $this->input->is_ajax_request();

        $id_cabang = $this->input->post('id_cabang', true);
        if (!$id_cabang) {
            $default_cabang = $this->get_default_cabang($id_pemilik);
            $id_cabang = $default_cabang ? $default_cabang->id_cabang : null;
        }

        if (!$this->verify_branch_ownership($id_cabang, $id_pemilik)) {
            $response = ['success' => false, 'message' => 'Cabang tidak valid'];
            if ($is_ajax) {
                echo json_encode($response);
                return;
            }
            $this->session->set_flashdata('error', $response['message']);
            redirect('pemilik/pelanggan');
            return;
        }

        $data = [
            'nama'      => $this->input->post('nama', true),
            'no_telp'   => $this->input->post('no_telp', true),
            'email'     => $this->input->post('email', true),
            'alamat'    => $this->input->post('alamat', true),
            'id_cabang' => $id_cabang,
        ];

        if (empty($data['nama']) || empty($data['no_telp'])) {
            $response = ['success' => false, 'message' => 'Nama dan No. Telepon harus diisi'];
            if ($is_ajax) {
                echo json_encode($response);
                return;
            }
            $this->session->set_flashdata('error', $response['message']);
            redirect('pemilik/pelanggan');
            return;
        }

        if ($this->Pelanggan_model->checkByPhone($data['no_telp'])) {
            $response = ['success' => false, 'message' => 'Nomor telepon sudah terdaftar'];
            if ($is_ajax) {
                echo json_encode($response);
                return;
            }
            $this->session->set_flashdata('error', $response['message']);
            redirect('pemilik/pelanggan');
            return;
        }

        $result = $this->Pelanggan_model->insertPelanggan($data);
        $response = [
            'success' => (bool) $result,
            'message' => $result ? 'Pelanggan baru berhasil ditambahkan' : 'Gagal menambahkan pelanggan'
        ];

        if ($is_ajax) {
            echo json_encode($response);
            return;
        }

        $this->session->set_flashdata($result ? 'success' : 'error', $response['message']);
        redirect('pemilik/pelanggan');
    }

    public function edit($id)
    {
        $id_pemilik = $this->get_id_pemilik();
        
        // RBAC Check
        // Allow if customer has relationship with owner OR if customer is global? 
        // For safety, let's restrict to customers with relationship, 
        // OR simply fetch by ID and if logic permits. 
        // BUT current update logic checks verify_customer_access?
        // Let's implement checkAccess here.
        if (!$this->Pelanggan_model->checkAccess($id, $id_pemilik)) {
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

    public function update($id)
    {
        $id_pemilik = $this->get_id_pemilik();
        
        // RBAC Check
        if (!$this->Pelanggan_model->checkAccess($id, $id_pemilik)) {
             $msg = 'Akses ditolak';
             if ($this->input->is_ajax_request()) {
                 echo json_encode(['success' => false, 'message' => $msg]);
             } else {
                 $this->session->set_flashdata('error', $msg);
                 redirect('pelanggan');
             }
             return;
        }

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

    public function delete($id = null)
    {
        if (empty($id)) {
            $id = $this->input->post('id_pelanggan', true) ?: $this->input->post('id', true);
        }
        if (empty($id)) {
            $raw = $this->input->raw_input_stream;
            $input = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($input)) {
                $id = isset($input['id_pelanggan']) ? $input['id_pelanggan'] : ($input['id'] ?? null);
            }
        }

        $id_pemilik = $this->get_id_pemilik();
        $is_ajax = $this->input->is_ajax_request();

        if (empty($id)) {
            $response = ['success' => false, 'message' => 'ID pelanggan tidak ditemukan'];
            if ($is_ajax) {
                return $this->output->set_content_type('application/json')->set_output(json_encode($response));
            }
            $this->session->set_flashdata('error', $response['message']);
            redirect('pemilik/pelanggan');
            return;
        }
        
        // RBAC Check
        if (!$this->Pelanggan_model->checkAccess($id, $id_pemilik)) {
             $msg = 'Akses ditolak';
             if ($is_ajax) {
                 return $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => $msg]));
             } else {
                 $this->session->set_flashdata('error', $msg);
                 redirect('pemilik/pelanggan');
             }
             return;
        }

        // Check if customer exists
        $pelanggan = $this->Pelanggan_model->getPelangganById($id);
        
        if(!$pelanggan) {
            if($is_ajax) {
                return $this->output->set_content_type('application/json')->set_output(json_encode([
                    'success' => false,
                    'message' => 'Data pelanggan tidak ditemukan'
                ]));
            } else {
                $this->session->set_flashdata('error', 'Data pelanggan tidak ditemukan');
                redirect('pemilik/pelanggan');
                return;
            }
        }

        // Check if customer has orders
        $has_orders = $this->db->where('id_pelanggan', $id)
                               ->where('deleted_at IS NULL')
                               ->get('pesanan')
                               ->num_rows() > 0;
        
        if($has_orders) {
            if($is_ajax) {
                return $this->output->set_content_type('application/json')->set_output(json_encode([
                    'success' => false,
                    'message' => 'Data pelanggan ini tidak bisa dihapus karena memiliki data pesanan'
                ]));
            } else {
                $this->session->set_flashdata('error', 'Pelanggan tidak dapat dihapus karena memiliki riwayat pesanan');
                redirect('pemilik/pelanggan');
                return;
            }
        }

        $result = $this->Pelanggan_model->softDelete($id);
        
        if($is_ajax) {
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'success' => true,
                'message' => 'Pelanggan berhasil dihapus'
            ]));
        } else {
            $this->session->set_flashdata('success', 'Pelanggan berhasil dihapus');
            redirect('pemilik/pelanggan');
        }
    }

    public function search()
    {
        $id_pemilik = $this->get_id_pemilik();
        $keyword = $this->input->get('keyword', true);
        $id_cabang = $this->input->get('branch', true);
        if ($id_cabang && !$this->verify_branch_ownership($id_cabang, $id_pemilik)) {
            $id_cabang = null;
        }

        $pelanggan = empty($keyword) ? 
            $this->Pelanggan_model->getAllPelanggan($id_pemilik, $id_cabang) : 
            $this->Pelanggan_model->searchPelanggan($keyword, $id_pemilik, $id_cabang);
        
        // Return JSON response
        echo json_encode([
            'success' => true,
            'data' => $pelanggan
        ]);
    }

    public function grafik()
    {
        $id_pemilik = $this->get_id_pemilik();
        // Get period parameter (default 6 months)
        $period = $this->input->get('period', true);
        $period = intval($period) ?: 6;
        
        $distribusi = $this->Pelanggan_model->grafikCabang($id_pemilik);
        $top = $this->Pelanggan_model->topPelanggan($id_pemilik);
        $growth = $this->Pelanggan_model->pertumbuhanBulanan($period, $id_pemilik);
        
        header('Content-Type: application/json');
        echo json_encode([
            'distribusi' => $distribusi,
            'top' => $top,
            'growth' => $growth,
            'period' => $period
        ]);
    }
}
