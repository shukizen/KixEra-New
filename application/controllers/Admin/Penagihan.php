<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penagihan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_langganan_model');
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }

    /**
     * Main penagihan page
     */
    public function index()
    {
        $data['page_title'] = 'Penagihan - KixEra';
        $data['user'] = $this->auth_library->get_user();
        $data['stats'] = $this->Transaksi_langganan_model->getStats();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/penagihan/index', $data);
        $this->load->view('template/footer');
    }

    /**
     * Get transactions (AJAX endpoint)
     */
    public function get_transactions()
    {
        $filters = [
            'status' => $this->input->get('status'),
            'search' => $this->input->get('search')
        ];
        
        try {
            $transactions = $this->Transaksi_langganan_model->getAllTransactions($filters);
            
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'data' => $transactions
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'Get Transactions Error: ' . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get single transaction (AJAX endpoint)
     */
    public function get_transaction($id)
    {
        try {
            $transaction = $this->Transaksi_langganan_model->get_by_id($id);
            
            header('Content-Type: application/json');
            if ($transaction) {
                echo json_encode([
                    'success' => true,
                    'data' => $transaction
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ]);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Get Transaction Detail Error: ' . $e->getMessage());
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Update payment status (AJAX endpoint)
     */
    public function update_status($id)
    {
        $status = $this->input->post('status', true);
        
        if (empty($status) || !in_array($status, ['pending', 'sukses', 'gagal', 'expired'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Status tidak valid']);
            return;
        }
        
        $result = $this->Transaksi_langganan_model->update_status($id, $status);
        
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Delete transaction (AJAX endpoint)
     */
    public function delete($id)
    {
        $is_ajax = $this->input->is_ajax_request();
        
        $result = $this->Transaksi_langganan_model->delete($id);
        
        if ($result) {
            $response = ['success' => true, 'message' => 'Transaksi berhasil dihapus'];
        } else {
            $response = ['success' => false, 'message' => 'Gagal menghapus transaksi'];
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
            redirect('admin/penagihan');
        }
    }

    /**
     * Get stats (AJAX endpoint)
     */
    public function get_stats()
    {
        $stats = $this->Transaksi_langganan_model->getStats();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $stats]);
    }
}
