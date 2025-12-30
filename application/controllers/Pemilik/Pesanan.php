<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load database library
        $this->load->model('Pesanan_model');
        $this->load->model('Owner_model');
        $this->load->library('session');
        $this->load->library('auth_library');
        
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
        // Determine pemilik id from session or user mapping
        $id_pemilik = $this->get_id_pemilik();

        $data['status_list'] = [
            'diterima' => 'Diterima',
            'dalam_proses' => 'Dalam Proses',
            'selesai' => 'Selesai',
            'siap_diambil' => 'Siap Diambil',
            'sudah_diambil' => 'Sudah Diambil',
            'dibatalkan' => 'Dibatalkan',
        ];

        $data['pesanan'] = $this->Pesanan_model->getAllPesananByOwner($id_pemilik);

        // load auxiliary lists for modal selects
        $this->load->model('Pelanggan_model');
        $this->load->model('Layanan_model');
        $this->load->model('Karyawan_model');

        $data['pelanggan_list'] = method_exists($this->Pelanggan_model, 'getAllPelanggan') ? $this->Pelanggan_model->getAllPelanggan() : [];
        $data['layanan_list'] = method_exists($this->Layanan_model, 'getAllLayananByOwner') ? $this->Layanan_model->getAllLayananByOwner($id_pemilik) : [];
        $data['karyawan_list'] = method_exists($this->Karyawan_model, 'getAllKaryawanByOwner') ? $this->Karyawan_model->getAllKaryawanByOwner($id_pemilik) : [];

        $this->load->view('template/header',);
        $this->load->view('template/sidebar',);
        $this->load->view('pemilik/pesanan/index', $data);
        $this->load->view('template/footer');
    }

    // View detail pesanan
    public function view($id)
    {
        $id_pemilik = $this->get_id_pemilik();
        // Access Control Check
        if (!$this->Pesanan_model->verify_ownership($id, $id_pemilik)) {
            show_error('Anda tidak memiliki akses ke pesanan ini', 403);
            return;
        }

        $pesanan = $this->Pesanan_model->getPesananDetailFromView($id);

        if (!$pesanan) {
            show_404();
            return;
        }

        $data['pesanan'] = $pesanan;
        $data['detail_items'] = $this->Pesanan_model->getDetailPesanan($id);
        $data['progres_list'] = $this->Pesanan_model->getProgresPesanan($id);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/pesanan/detail', $data);
        $this->load->view('template/footer');
    }

    // Update pesanan (expects POST with `id_pesanan` and fields to update)
    public function update()
    {
        $id = $this->input->post('id_pesanan');
        $id_pemilik = $this->get_id_pemilik();
        
        if (empty($id)) {
            $resp = ['status' => 'error', 'message' => 'Missing id_pesanan'];
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($resp));
        }

        // Access Control Check
        if (!$this->Pesanan_model->verify_ownership($id, $id_pemilik)) {
             $resp = ['status' => 'error', 'message' => 'Akses ditolak'];
             return $this->output->set_content_type('application/json')->set_output(json_encode($resp));
        }

        $data = $this->input->post();
        unset($data['id_pesanan']);
        // pesanan table doesn't have `cabang` column; ensure we don't attempt to update it
        if (isset($data['cabang'])) unset($data['cabang']);

        // Check if status is being changed
        $new_status = isset($data['status_pesanan']) ? $data['status_pesanan'] : null;
        $old_status = $this->Pesanan_model->getCurrentStatus($id);

        $updated = $this->Pesanan_model->updatePesanan($id, $data);
        
        if ($updated) {
            // If status changed, add progress record
            if ($new_status && $new_status !== $old_status) {
                $id_karyawan = $this->session->userdata('id_karyawan');
                $this->Pesanan_model->insertProgres($id, $new_status, null, $id_karyawan);
            }
            $resp = ['status' => 'success', 'message' => 'Pesanan updated'];
        } else {
            $resp = ['status' => 'error', 'message' => 'Failed to update pesanan'];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resp));
    }

    // Delete pesanan (soft delete). Expects POST with `id_pesanan`.
    public function delete()
    {
        $id = $this->input->post('id_pesanan');
        $id_pemilik = $this->get_id_pemilik();
        
        if (empty($id)) {
            $resp = ['status' => 'error', 'message' => 'Missing id_pesanan'];
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($resp));
        }
        
        // Access Control Check
        if (!$this->Pesanan_model->verify_ownership($id, $id_pemilik)) {
             $resp = ['status' => 'error', 'message' => 'Akses ditolak'];
             return $this->output->set_content_type('application/json')->set_output(json_encode($resp));
        }

        $deleted = $this->Pesanan_model->deletePesanan($id);
        if ($deleted) {
            $resp = ['status' => 'success', 'message' => 'Pesanan deleted'];
        } else {
            $resp = ['status' => 'error', 'message' => 'Failed to delete pesanan'];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resp));
    }

    public function get_pesanan_json($id)
    {
        $id_pemilik = $this->get_id_pemilik();
        // Access Control Check implicit in getPesananById with parameter
        $data = $this->Pesanan_model->getPesananById($id, $id_pemilik);
        
        if (!$data) {
             echo json_encode(['error' => 'Not found or access denied']);
             return;
        }

        echo json_encode($data);
    }

    // Method get() untuk modal edit - mengembalikan format {status, data}
    public function get($id)
    {
        $id_pemilik = $this->get_id_pemilik();
        $pesanan = $this->Pesanan_model->getPesananById($id, $id_pemilik);

        if (!$pesanan) {
            $resp = ['status' => 'error', 'message' => 'Pesanan tidak ditemukan atau akses ditolak'];
        } else {
            $resp = ['status' => 'success', 'data' => $pesanan];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resp));
    }

    // Update via JSON (expects JSON body)
    public function update_json()
    {
        $raw = $this->input->raw_input_stream;
        $input = json_decode($raw, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'Invalid JSON']));
        }

        $id = isset($input['id_pesanan']) ? $input['id_pesanan'] : null;
        if (empty($id)) {
            return $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'Missing id_pesanan']));
        }
        
        $id_pemilik = $this->get_id_pemilik();
        // Access Control Check
        if (!$this->Pesanan_model->verify_ownership($id, $id_pemilik)) {
             return $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'Akses ditolak']));
        }

        // whitelist fields (do NOT include `cabang` since pesanan table has no such column)
        $allowed = ['id_pelanggan', 'id_layanan', 'id_karyawan', 'tgl_masuk', 'total_harga', 'status_pesanan', 'jumlah_item', 'tgl_estimasi_selesai', 'catatan'];
        $data = [];
        foreach ($allowed as $f) {
            if (isset($input[$f])) $data[$f] = $input[$f];
        }

        // basic validation
        if (isset($data['total_harga']) && !is_numeric($data['total_harga'])) {
            return $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'total_harga must be numeric']));
        }

        // Check if status is being changed (BEFORE update)
        $new_status = isset($data['status_pesanan']) ? $data['status_pesanan'] : null;
        $old_status = $this->Pesanan_model->getCurrentStatus($id);

        $ok = $this->Pesanan_model->updatePesanan($id, $data);
        
        if ($ok) {
            // If status changed, add progress record
            if ($new_status && $new_status !== $old_status) {
                $id_karyawan = isset($input['id_karyawan']) ? $input['id_karyawan'] : null;
                $this->Pesanan_model->insertProgres($id, $new_status, null, $id_karyawan);
            }
            
            $updated = $this->Pesanan_model->getPesananById($id);
            return $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'success', 'message' => 'Updated', 'data' => $updated]));
        }

        return $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'Update failed']));
    }
}
