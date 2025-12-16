<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Inventorimodel');
        $this->load->library('form_validation');
        
        // // Check if user is logged in (sesuaikan dengan sistem auth Anda)
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('auth/login');
        // }
    }
    
    // Main inventory page
    public function index() {
        $search = $this->input->get('search');
        $category = $this->input->get('category');
        
        $data['inventory_items'] = $this->Inventorimodel->get_all_inventory($search, $category);
        $data['stats'] = $this->Inventorimodel->get_inventory_stats();
        $data['branches'] = $this->Inventorimodel->get_all_branches();
        $data['category_stats'] = $this->Inventorimodel->get_items_by_category();
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/inventori/index', $data);
        $this->load->view('template/footer');
    }
    
    // Get inventory data as JSON (for AJAX)
    public function get_inventory() {
        $search = $this->input->post('search');
        $category = $this->input->post('category');
        
        $items = $this->Inventorimodel->get_all_inventory($search, $category);
        
        echo json_encode([
            'success' => true,
            'data' => $items
        ]);
    }
    
    // Get single inventory item
    public function get_item($id) {
        $item = $this->Inventorimodel->get_inventory_by_id($id);
        
        if ($item) {
            echo json_encode([
                'success' => true,
                'data' => $item
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Item tidak ditemukan'
            ]);
        }
    }
    
    // Add new inventory item
    public function add() {
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
        
        // Check if item already exists
        if ($this->Inventorimodel->item_exists($nama_item)) {
            echo json_encode([
                'success' => false,
                'message' => 'Item dengan nama tersebut sudah ada'
            ]);
            return;
        }
        
        $data = [
            'id_cabang' => $this->input->post('id_cabang'),
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
        
        // Check if item name exists (excluding current item)
        if ($this->Inventorimodel->item_exists($nama_item, $id)) {
            echo json_encode([
                'success' => false,
                'message' => 'Item dengan nama tersebut sudah ada'
            ]);
            return;
        }
        
        $data = [
            'id_cabang' => $this->input->post('id_cabang'),
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
        // Top items by stock
        $top_items = $this->Inventorimodel->get_top_items_by_stock(5);
        
        // Items by category
        $category_data = $this->Inventorimodel->get_items_by_category();
        
        // Stock trend by category
        $stock_trend = $this->Inventorimodel->get_stock_trend_by_category();
        
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