<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Inventorimodel');
        $this->load->library('form_validation');
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require owner role
        $this->auth_library->require_role('owner');
    }
    
    // Helper to get id_pemilik
    private function get_id_pemilik() {
        $id_pemilik = $this->session->userdata('id_pemilik');
        if (empty($id_pemilik)) {
            // Fallback for testing or if session structure is different
             $user_id = $this->session->userdata('user_id');
             if ($user_id) {
                 $this->load->model('Owner_model');
                 $owner = $this->Owner_model->getOwnerByUserId($user_id);
                 if ($owner) return $owner->id_pemilik;
             }
        }
        return $id_pemilik;
    }

    // Main inventory page
    public function index() {
        $id_pemilik = $this->get_id_pemilik();
        $search = $this->input->get('search');
        $category = $this->input->get('category');
        
        $data['inventory_items'] = $this->Inventorimodel->get_all_inventory($search, $category, $id_pemilik);
        $data['stats'] = $this->Inventorimodel->get_inventory_stats($id_pemilik);
        $data['branches'] = $this->Inventorimodel->get_all_branches($id_pemilik);
        $data['category_stats'] = $this->Inventorimodel->get_items_by_category($id_pemilik);
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/inventori/index', $data);
        $this->load->view('template/footer');
    }
    
    // Get inventory data as JSON (for AJAX)
    public function get_inventory() {
        $id_pemilik = $this->get_id_pemilik();
        $search = $this->input->post('search');
        $category = $this->input->post('category');
        
        $items = $this->Inventorimodel->get_all_inventory($search, $category, $id_pemilik);
        
        echo json_encode([
            'success' => true,
            'data' => $items
        ]);
    }
    
    // Get single inventory item
    public function get_item($id) {
        $id_pemilik = $this->get_id_pemilik();
        $item = $this->Inventorimodel->get_inventory_by_id($id, $id_pemilik);
        
        if ($item) {
            echo json_encode([
                'success' => true,
                'data' => $item
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Item tidak ditemukan atau Anda tidak memiliki akses'
            ]);
        }
    }
    
    // Add new inventory item
    public function add() {
        $id_pemilik = $this->get_id_pemilik();
        $this->form_validation->set_rules('nama_item', 'Nama Item', 'required|trim');
        $this->form_validation->set_rules('jenis_item', 'Jenis Item', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('stok_minimal', 'Stok Minimal', 'required|numeric');
        $this->form_validation->set_rules('id_cabang', 'Cabang', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => validation_errors()
            ]);
            return;
        }
        
        $nama_item = $this->input->post('nama_item');
        $id_cabang = $this->input->post('id_cabang');

        // Verify branch ownership
        $valid_branches = array_column($this->Inventorimodel->get_all_branches($id_pemilik), 'id_cabang');
        if (!in_array($id_cabang, $valid_branches)) {
             echo json_encode(['success' => false, 'message' => 'Cabang tidak valid']);
             return;
        }
        
        // Check if item already exists
        if ($this->Inventorimodel->item_exists($nama_item, null, $id_pemilik)) {
            echo json_encode([
                'success' => false,
                'message' => 'Item dengan nama tersebut sudah ada'
            ]);
            return;
        }
        
        $data = [
            'id_cabang' => $id_cabang,
            'nama_item' => $nama_item,
            'jenis_item' => $this->input->post('jenis_item'),
            'satuan' => $this->input->post('satuan'),
            'stok_minimal' => $this->input->post('stok_minimal'),
            'stok_tersedia' => $this->input->post('stok_tersedia', true) ?: 0,
            'harga_satuan' => $this->input->post('harga_satuan', true) ?: NULL,
            'keterangan' => $this->input->post('keterangan', true) ?: NULL
        ];
        
        if ($this->Inventorimodel->insert_inventory($data)) {
            echo json_encode([
                'success' => true,
                'message' => 'Item berhasil ditambahkan'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menambahkan item'
            ]);
        }
    }
    
    // Update inventory item
    public function update($id) {
        $id_pemilik = $this->get_id_pemilik();
        
        // Ownership Verify
        if (!$this->Inventorimodel->verify_ownership($id, $id_pemilik)) {
             echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
             return;
        }

        $this->form_validation->set_rules('nama_item', 'Nama Item', 'required|trim');
        $this->form_validation->set_rules('jenis_item', 'Jenis Item', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('stok_minimal', 'Stok Minimal', 'required|numeric');
        $this->form_validation->set_rules('id_cabang', 'Cabang', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => validation_errors()
            ]);
            return;
        }
        
        $nama_item = $this->input->post('nama_item');
        $id_cabang = $this->input->post('id_cabang');

        // Verify branch ownership
        $valid_branches = array_column($this->Inventorimodel->get_all_branches($id_pemilik), 'id_cabang');
        if (!in_array($id_cabang, $valid_branches)) {
             echo json_encode(['success' => false, 'message' => 'Cabang tidak valid']);
             return;
        }
        
        // Check if item name exists (excluding current item)
        if ($this->Inventorimodel->item_exists($nama_item, $id, $id_pemilik)) {
            echo json_encode([
                'success' => false,
                'message' => 'Item dengan nama tersebut sudah ada'
            ]);
            return;
        }
        
        $data = [
            'id_cabang' => $id_cabang,
            'nama_item' => $nama_item,
            'jenis_item' => $this->input->post('jenis_item'),
            'satuan' => $this->input->post('satuan'),
            'stok_minimal' => $this->input->post('stok_minimal'),
            'stok_tersedia' => $this->input->post('stok_tersedia'),
            'harga_satuan' => $this->input->post('harga_satuan', true) ?: NULL,
            'keterangan' => $this->input->post('keterangan', true) ?: NULL
        ];
        
        if ($this->Inventorimodel->update_inventory($id, $data)) {
            echo json_encode([
                'success' => true,
                'message' => 'Item berhasil diupdate'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mengupdate item'
            ]);
        }
    }
    
    // Delete inventory item
    public function delete($id) {
        $id_pemilik = $this->get_id_pemilik();
        // Ownership Verify
        if (!$this->Inventorimodel->verify_ownership($id, $id_pemilik)) {
             echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
             return;
        }

        if ($this->Inventorimodel->delete_inventory($id)) {
            echo json_encode([
                'success' => true,
                'message' => 'Item berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus item'
            ]);
        }
    }
    
    // Get chart data
    public function get_chart_data() {
        $id_pemilik = $this->get_id_pemilik();
        // Top items by stock
        $top_items = $this->Inventorimodel->get_top_items_by_stock(5, $id_pemilik);
        
        // Items by category
        $category_data = $this->Inventorimodel->get_items_by_category($id_pemilik);
        
        // Stock trend by category
        $stock_trend = $this->Inventorimodel->get_stock_trend_by_category($id_pemilik);
        
        echo json_encode([
            'success' => true,
            'data' => [
                'top_items' => $top_items,
                'category_data' => $category_data,
                'stock_trend' => $stock_trend
            ]
        ]);
    }
    
    // Update stock (for restocking)
    public function update_stock() {
        $id = $this->input->post('id_inventori');
        $id_pemilik = $this->get_id_pemilik();

        // Ownership Verify
        if (!$this->Inventorimodel->verify_ownership($id, $id_pemilik)) {
             echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
             return;
        }

        $quantity = $this->input->post('quantity');
        $type = $this->input->post('type'); // 'add' or 'subtract'
        
        if ($this->Inventorimodel->update_stock($id, $quantity, $type)) {
            echo json_encode([
                'success' => true,
                'message' => 'Stok berhasil diupdate'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mengupdate stok'
            ]);
        }
    }
}