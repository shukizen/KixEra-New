<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Inventori_model');
        $this->load->library('form_validation');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // Cek apakah id_pemilik ada di session
        if (!$this->session->userdata('id_pemilik')) {
            show_error('ID Pemilik tidak ditemukan. Silakan login kembali.', 403);
        }
    }
    
    // Fungsi helper untuk mendapatkan id_pemilik dari session
    private function get_id_pemilik() {
        return $this->session->userdata('id_pemilik');
    }
    
    // Main inventory page
    public function index() {
        $search = $this->input->get('search');
        $category = $this->input->get('category');
        $id_pemilik = $this->get_id_pemilik();
        
        $data['inventory_items'] = $this->Inventori_model->get_all_inventory($search, $category, $id_pemilik);
        $data['stats'] = $this->Inventori_model->get_inventory_stats($id_pemilik);
        $data['branches'] = $this->Inventori_model->get_all_branches($id_pemilik);
        $data['category_stats'] = $this->Inventori_model->get_items_by_category($id_pemilik);
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/inventori/index', $data);
        $this->load->view('template/footer');
    }
    
    // Get inventory data as JSON (for AJAX)
    public function get_inventory() {
        $search = $this->input->post('search');
        $category = $this->input->post('category');
        $id_pemilik = $this->get_id_pemilik();
        
        $items = $this->Inventori_model->get_all_inventory($search, $category, $id_pemilik);
        
        echo json_encode([
            'success' => true,
            'data' => $items
        ]);
    }
    
    // Get single inventory item
    public function get_item($id) {
        $id_pemilik = $this->get_id_pemilik();
        $item = $this->Inventori_model->get_inventory_by_id($id, $id_pemilik);
        
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
    
    // Detail page for inventory item
    public function detail($id) {
        $id_pemilik = $this->get_id_pemilik();
        $data['item'] = $this->Inventori_model->get_inventory_by_id($id, $id_pemilik);
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/inventori/detail', $data);
        $this->load->view('template/footer');
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
        
        $id_pemilik = $this->get_id_pemilik();
        $nama_item = $this->input->post('nama_item');
        $id_cabang = $this->input->post('id_cabang');
        
        // Validasi apakah cabang milik pemilik yang login
        if (!$this->Inventori_model->validate_branch_owner($id_cabang, $id_pemilik)) {
            echo json_encode([
                'success' => false,
                'message' => 'Cabang tidak valid atau bukan milik Anda'
            ]);
            return;
        }
        
        // Check if item already exists untuk pemilik ini
        if ($this->Inventori_model->item_exists($nama_item, null, $id_pemilik)) {
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
        
        if ($this->Inventori_model->insert_inventory($data)) {
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
        
        $id_pemilik = $this->get_id_pemilik();
        $nama_item = $this->input->post('nama_item');
        $id_cabang = $this->input->post('id_cabang');
        
        // Validasi apakah item milik pemilik yang login
        $existing_item = $this->Inventori_model->get_inventory_by_id($id, $id_pemilik);
        if (!$existing_item) {
            echo json_encode([
                'success' => false,
                'message' => 'Item tidak ditemukan atau Anda tidak memiliki akses'
            ]);
            return;
        }
        
        // Validasi apakah cabang milik pemilik yang login
        if (!$this->Inventori_model->validate_branch_owner($id_cabang, $id_pemilik)) {
            echo json_encode([
                'success' => false,
                'message' => 'Cabang tidak valid atau bukan milik Anda'
            ]);
            return;
        }
        
        // Check if item name exists (excluding current item)
        if ($this->Inventori_model->item_exists($nama_item, $id, $id_pemilik)) {
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
        
        if ($this->Inventori_model->update_inventory($id, $data)) {
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
    public function delete($id = null) {
        if (empty($id)) {
            $id = $this->input->post('id_inventori', true) ?: $this->input->post('id', true);
        }
        if (empty($id)) {
            $raw = $this->input->raw_input_stream;
            $input = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($input)) {
                $id = isset($input['id_inventori']) ? $input['id_inventori'] : ($input['id'] ?? null);
            }
        }

        $id_pemilik = $this->get_id_pemilik();

        if (empty($id)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => 'ID item tidak ditemukan'
                ]));
        }
        
        // Validasi apakah item milik pemilik yang login
        $existing_item = $this->Inventori_model->get_inventory_by_id($id, $id_pemilik);
        if (!$existing_item) {
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'success' => false,
                'message' => 'Item tidak ditemukan atau Anda tidak memiliki akses'
            ]));
        }
        
        if ($this->Inventori_model->delete_inventory($id)) {
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'success' => true,
                'message' => 'Item berhasil dihapus'
            ]));
        } else {
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'success' => false,
                'message' => 'Gagal menghapus item'
            ]));
        }
    }
    
    // Get chart data
    public function get_chart_data() {
        $id_pemilik = $this->get_id_pemilik();
        
        // Top items by stock
        $top_items = $this->Inventori_model->get_top_items_by_stock(5, $id_pemilik);
        
        // Items by category
        $category_data = $this->Inventori_model->get_items_by_category($id_pemilik);
        
        // Stock trend by category
        $stock_trend = $this->Inventori_model->get_stock_trend_by_category($id_pemilik);
        
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
        $id_pemilik = $this->get_id_pemilik();
        
        // Validasi apakah item milik pemilik yang login
        $existing_item = $this->Inventori_model->get_inventory_by_id($id, $id_pemilik);
        if (!$existing_item) {
            echo json_encode([
                'success' => false,
                'message' => 'Item tidak ditemukan atau Anda tidak memiliki akses'
            ]);
            return;
        }
        
        if ($this->Inventori_model->update_stock($id, $quantity, $type)) {
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
