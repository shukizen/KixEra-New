<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket_langganan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Paket_langganan_model');
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }

    /**
     * Main paket langganan page
     */
    public function index()
    {
        $data['page_title'] = 'Paket Langganan - KixEra';
        $data['user'] = $this->auth_library->get_user();
        $data['stats'] = $this->Paket_langganan_model->getStats();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/paket_langganan/index', $data);
        $this->load->view('template/footer');
    }

    /**
     * Get pakets (AJAX endpoint)
     */
    public function get_pakets()
    {
        $filters = [
            'status' => $this->input->get('status'),
            'search' => $this->input->get('search')
        ];
        
        $pakets = $this->Paket_langganan_model->getAllPakets($filters);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $pakets
        ]);
    }

    /**
     * Get single paket (AJAX endpoint)
     */
    public function get_paket($id)
    {
        $paket = $this->Paket_langganan_model->get_by_id($id);
        
        header('Content-Type: application/json');
        if ($paket) {
            echo json_encode([
                'success' => true,
                'data' => $paket
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Paket tidak ditemukan'
            ]);
        }
    }

    /**
     * Create new paket (AJAX endpoint)
     */
    public function create()
    {
        $is_ajax = $this->input->is_ajax_request();
        
        // Validation
        $nama_paket = $this->input->post('nama_paket', true);
        $harga = $this->input->post('harga', true);
        $durasi = $this->input->post('durasi', true);
        $deskripsi = $this->input->post('deskripsi', true);
        $fitur = $this->input->post('fitur', true);
        
        $errors = [];
        
        if (empty($nama_paket)) {
            $errors[] = 'Nama paket wajib diisi';
        }
        
        if (empty($harga) || !is_numeric($harga)) {
            $errors[] = 'Harga wajib diisi dan harus berupa angka';
        }
        
        if (empty($durasi) || !is_numeric($durasi)) {
            $errors[] = 'Durasi wajib diisi dan harus berupa angka (hari)';
        }
        
        if (!empty($errors)) {
            $response = [
                'success' => false,
                'message' => implode('<br>', $errors)
            ];
            
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('error', $response['message']);
                redirect('admin/paket_langganan');
            }
            return;
        }
        
        // Prepare data
        $data = [
            'nama_paket' => $nama_paket,
            'harga' => $harga,
            'durasi' => $durasi,
            'deskripsi' => $deskripsi,
            'fitur' => $fitur,
            'status' => 'aktif'
        ];
        
        // Create paket
        $id = $this->Paket_langganan_model->insert($data);
        
        if ($id) {
            $response = ['success' => true, 'message' => 'Paket berhasil dibuat', 'id_paket' => $id];
        } else {
            $response = ['success' => false, 'message' => 'Gagal membuat paket'];
        }
        
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            if ($response['success']) {
                $this->session->set_flashdata('success', $response['message']);
            } else {
                $this->session->set_flashdata('error', $response['message']);
            }
            redirect('admin/paket_langganan');
        }
    }

    /**
     * Update paket (AJAX endpoint)
     */
    public function update($id)
    {
        $is_ajax = $this->input->is_ajax_request();
        
        // Validation
        $nama_paket = $this->input->post('nama_paket', true);
        $harga = $this->input->post('harga', true);
        $durasi = $this->input->post('durasi', true);
        $deskripsi = $this->input->post('deskripsi', true);
        $fitur = $this->input->post('fitur', true);
        
        $errors = [];
        
        if (empty($nama_paket)) {
            $errors[] = 'Nama paket wajib diisi';
        }
        
        if (empty($harga) || !is_numeric($harga)) {
            $errors[] = 'Harga wajib diisi dan harus berupa angka';
        }
        
        if (empty($durasi) || !is_numeric($durasi)) {
            $errors[] = 'Durasi wajib diisi dan harus berupa angka (hari)';
        }
        
        if (!empty($errors)) {
            $response = [
                'success' => false,
                'message' => implode('<br>', $errors)
            ];
            
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('error', $response['message']);
                redirect('admin/paket_langganan');
            }
            return;
        }
        
        // Prepare data
        $data = [
            'nama_paket' => $nama_paket,
            'harga' => $harga,
            'durasi' => $durasi,
            'deskripsi' => $deskripsi,
            'fitur' => $fitur
        ];
        
        // Update paket
        $result = $this->Paket_langganan_model->update($id, $data);
        
        if ($result) {
            $response = ['success' => true, 'message' => 'Paket berhasil diupdate'];
        } else {
            $response = ['success' => false, 'message' => 'Gagal mengupdate paket'];
        }
        
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            if ($response['success']) {
                $this->session->set_flashdata('success', $response['message']);
            } else {
                $this->session->set_flashdata('error', $response['message']);
            }
            redirect('admin/paket_langganan');
        }
    }

    /**
     * Delete paket (AJAX endpoint)
     */
    public function delete($id)
    {
        $is_ajax = $this->input->is_ajax_request();
        
        $result = $this->Paket_langganan_model->delete($id);
        
        if ($result) {
            $response = ['success' => true, 'message' => 'Paket berhasil dihapus'];
        } else {
            $response = ['success' => false, 'message' => 'Gagal menghapus paket'];
        }
        
        if ($is_ajax) {
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            if ($response['success']) {
                $this->session->set_flashdata('success', $response['message']);
            } else {
                $this->session->set_flashdata('error', $response['message']);
            }
            redirect('admin/paket_langganan');
        }
    }

    /**
     * Toggle paket status (AJAX endpoint)
     */
    public function toggle_status($id)
    {
        $result = $this->Paket_langganan_model->toggleStatus($id);
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
