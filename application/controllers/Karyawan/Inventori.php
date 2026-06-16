<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inventori_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');
        
        // Cek apakah user sudah login sebagai karyawan
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // Pastikan yang akses adalah karyawan
        if ($this->session->userdata('role') !== 'karyawan') {
            redirect('karyawan/karyawan_dashboard');
        }
    }

    public function index()
    {
        // Ambil id_pemilik dan id_cabang dari session karyawan
        $id_pemilik = $this->session->userdata('id_pemilik');
        $id_cabang = $this->session->userdata('id_cabang');
        
        // Fallback: jika id_pemilik belum ada di session, ambil dari database melalui cabang
        if (empty($id_pemilik) && !empty($id_cabang)) {
            $cabang = $this->db->select('id_pemilik')
                               ->where('id_cabang', $id_cabang)
                               ->get('cabang')
                               ->row();
            if ($cabang) {
                $id_pemilik = $cabang->id_pemilik;
                // Update session untuk request berikutnya
                $this->session->set_userdata('id_pemilik', $id_pemilik);
            }
        }
        
        // Debug: Log session values
        log_message('debug', 'Inventori Index - id_pemilik: ' . $id_pemilik . ', id_cabang: ' . $id_cabang);
        
        // Inisialisasi data
        $data = [];
        
        // Ambil data untuk form - hanya cabang milik pemilik yang sama
        $data['branches'] = $this->Inventori_model->get_all_branches($id_pemilik);
        $data['categories'] = $this->get_categories();
        $data['units'] = $this->get_units();
        
        // Ambil data inventory terbaru (limit 10) - SCOPED BY OWNER, NOT BRANCH
        // Karyawan dapat melihat semua inventory yang dimiliki pemilik usaha
        $data['recent_inventory'] = $this->get_recent_inventory($id_pemilik, 10, null);
        
        // Ambil statistik - SCOPED BY OWNER
        $data['stats'] = $this->Inventori_model->get_inventory_stats($id_pemilik, null);
        
        // Data untuk Chart 1: Barang paling sering digunakan (Bar Chart) - SCOPED BY OWNER
        $data['items_by_category'] = $this->Inventori_model->get_most_used_items($id_pemilik, 5, null);
        
        // Data untuk Chart 2: Distribusi Kategori (Doughnut Chart) - SCOPED BY OWNER
        $data['category_distribution'] = $this->Inventori_model->get_items_by_category($id_pemilik, null);
        
        // Debug - cek apakah data grafik ada
        log_message('debug', 'Chart Data Usage: ' . print_r($data['items_by_category'], true));
        log_message('debug', 'Chart Data Category: ' . print_r($data['category_distribution'], true));
        
        // Load view
        $this->load->view('karyawan/inventori/index', $data);
    }

    private function redirect_after_action($fallback = 'karyawan/inventori')
    {
        $target = $this->input->post('return_url', true) ?: $this->input->get('return_url', true);
        if (!$target) {
            $target = $this->input->server('HTTP_REFERER', true);
        }

        if ($this->is_safe_local_url($target)) {
            redirect($target);
            return;
        }

        redirect($fallback);
    }

    private function is_safe_local_url($url)
    {
        if (empty($url)) {
            return false;
        }

        $base_host = parse_url(base_url(), PHP_URL_HOST);
        $target_scheme = parse_url($url, PHP_URL_SCHEME);
        $target_host = parse_url($url, PHP_URL_HOST);

        if (empty($target_host)) {
            return empty($target_scheme);
        }

        return $target_host === $base_host;
    }
    
    // Fungsi untuk menyimpan data inventory
    public function save()
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        
        // Validasi input
        $this->form_validation->set_rules('nama_item', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('jenis_item', 'Kategori', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('id_cabang', 'Cabang', 'required|numeric');
        $this->form_validation->set_rules('stok_masuk', 'Jumlah Masuk', 'required|numeric|greater_than[0]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('karyawan/inventori');
            return;
        }
        
        $id_cabang = $this->input->post('id_cabang');
        
        // Validasi cabang milik owner
        if (!$this->Inventori_model->validate_branch_owner($id_cabang, $id_pemilik)) {
            $this->session->set_flashdata('error', 'Cabang tidak valid atau bukan milik perusahaan Anda!');
            redirect('karyawan/inventori');
            return;
        }
        
        $nama_item = trim($this->input->post('nama_item'));
        $id_karyawan = $this->session->userdata('id_karyawan');
        
        // Cek apakah item sudah ada di cabang yang sama
        $existing_item = $this->check_existing_item($nama_item, $id_cabang);
        
        if ($existing_item) {
            // Update stok yang sudah ada
            $stok_masuk = $this->input->post('stok_masuk');
            $new_stock = $existing_item->stok_tersedia + $stok_masuk;
            $data_update = [
                'stok_tersedia' => $new_stock,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            if ($this->Inventori_model->update_inventory($existing_item->id_inventori, $data_update)) {
                // Log to transaksi_inventori
                $transaksi_data = [
                    'id_inventori' => $existing_item->id_inventori,
                    'id_cabang' => $id_cabang,
                    'jenis_transaksi' => 'masuk',
                    'jumlah' => $stok_masuk,
                    'tgl_transaksi' => date('Y-m-d H:i:s'),
                    'id_karyawan' => $id_karyawan,
                    'keterangan' => 'Penambahan stok: ' . $nama_item,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('transaksi_inventori', $transaksi_data);
                
                // Log to pengeluaran if harga_satuan exists
                $harga_satuan = $this->input->post('harga_satuan');
                if (!empty($harga_satuan) && $harga_satuan > 0) {
                    $total_cost = $harga_satuan * $stok_masuk;
                    $pengeluaran_data = [
                        'id_cabang' => $id_cabang,
                        'nama_transaksi' => 'Pembelian ' . $nama_item,
                        'kategori' => strtolower($existing_item->jenis_item),
                        'jumlah' => $total_cost,
                        'tgl_transaksi' => date('Y-m-d'),
                        'keterangan' => 'Penambahan stok ' . $stok_masuk . ' ' . $existing_item->satuan . ' @ Rp ' . number_format($harga_satuan, 0, ',', '.'),
                        'id_karyawan' => $id_karyawan,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $this->db->insert('pengeluaran', $pengeluaran_data);
                }
                
                $this->session->set_flashdata('success', 'Stok barang "'.$nama_item.'" berhasil ditambahkan! Stok sekarang: '.$new_stock);
            } else {
                $this->session->set_flashdata('error', 'Gagal menambah stok!');
            }
        } else {
            // Insert data baru
            $harga_satuan = $this->input->post('harga_satuan');
            $data = [
                'nama_item' => $nama_item,
                'jenis_item' => $this->input->post('jenis_item'),
                'satuan' => $this->input->post('satuan'),
                'id_cabang' => $id_cabang,
                'stok_tersedia' => $this->input->post('stok_masuk'),
                'stok_minimal' => 5, // Default
                'harga_satuan' => (!empty($harga_satuan) && $harga_satuan > 0) ? $harga_satuan : 0,
                'keterangan' => $this->input->post('keterangan'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            if ($this->Inventori_model->insert_inventory($data, $id_karyawan)) {
                $this->session->set_flashdata('success', 'Data inventory "'.$nama_item.'" berhasil disimpan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data!');
            }
        }
        
        redirect('karyawan/inventori');
    }
    
    // Fungsi untuk melihat stok lengkap
    public function lihat_stok()
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        
        // Inisialisasi data
        $data = [];
        
        // Ambil parameter filter
        $search = $this->input->get('search');
        $category = $this->input->get('category');
        $id_cabang = $this->input->get('cabang');
        
        // Ambil semua inventory dengan filter SCOPED BY BRANCH
        $all_inventory = $this->Inventori_model->get_all_inventory($search, $category, $id_pemilik, $id_cabang);
        
        $data['inventory'] = $all_inventory;
        
        $data['branches'] = $this->Inventori_model->get_all_branches($id_pemilik);
        $data['categories'] = $this->get_categories();
        $data['stats'] = $this->Inventori_model->get_inventory_stats($id_pemilik, $id_cabang);
        $data['items_by_category'] = $this->Inventori_model->get_items_by_category($id_pemilik, $id_cabang);
        
        // Load view
        $this->load->view('karyawan/inventori/lihat_stok', $data);
    }
    
    // Update inventory item
    public function update()
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        $id_inventori = $this->input->post('id_inventori');
        
        // Validasi input
        $this->form_validation->set_rules('nama_item', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('jenis_item', 'Kategori', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('id_cabang', 'Cabang', 'required|numeric');
        $this->form_validation->set_rules('stok_tersedia', 'Stok', 'required|numeric');
        $this->form_validation->set_rules('stok_minimal', 'Stok Minimal', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->redirect_after_action();
            return;
        }
        
        // Validasi kepemilikan
        $item = $this->Inventori_model->get_inventory_by_id($id_inventori, $id_pemilik);
        
        if (!$item) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan atau Anda tidak memiliki akses!');
            $this->redirect_after_action();
            return;
        }
        
        $data_update = [
            'nama_item' => trim($this->input->post('nama_item')),
            'jenis_item' => $this->input->post('jenis_item'),
            'satuan' => $this->input->post('satuan'),
            'id_cabang' => $this->input->post('id_cabang'),
            'stok_tersedia' => $this->input->post('stok_tersedia'),
            'stok_minimal' => $this->input->post('stok_minimal'),
            'harga_satuan' => $this->input->post('harga_satuan') ?: 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->Inventori_model->update_inventory($id_inventori, $data_update)) {
            $this->session->set_flashdata('success', 'Data inventory berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate data!');
        }
        
        $this->redirect_after_action();
    }
    
    // Delete inventory item
    public function delete($id)
    {
        if (empty($id) || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'ID tidak valid!');
            $this->redirect_after_action();
            return;
        }
        
        $id_pemilik = $this->session->userdata('id_pemilik');
        
        // Validasi kepemilikan
        $item = $this->Inventori_model->get_inventory_by_id($id, $id_pemilik);
        
        if (!$item) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan atau Anda tidak memiliki akses!');
            $this->redirect_after_action();
            return;
        }
        
        $nama_item = $item->nama_item;
        
        if ($this->Inventori_model->delete_inventory($id)) {
            $this->session->set_flashdata('success', 'Data "'.$nama_item.'" berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data!');
        }
        
        $this->redirect_after_action();
    }
    
    // AJAX: Get inventory data
    public function get_inventory_data()
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        $search = $this->input->post('search');
        $category = $this->input->post('category');
        
        $inventory = $this->Inventori_model->get_all_inventory($search, $category, $id_pemilik);
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'data' => $inventory
        ]);
    }
    
    // Helper: Get recent inventory
    private function get_recent_inventory($id_pemilik, $limit = 10, $id_cabang = null)
    {
        $this->db->select('inventori.*, cabang.nama_cabang');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        
        // Check for soft deletes
        $this->db->where('inventori.deleted_at IS NULL');
        
        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }

        if ($id_cabang) {
            $this->db->where('inventori.id_cabang', $id_cabang);
        }
        
        $this->db->order_by('inventori.updated_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        
        // Debug: log the actual query
        log_message('debug', 'Recent Inventory Query: ' . $this->db->last_query());
        
        return $query->result();
    }
    
    // Helper: Check existing item in same branch
    private function check_existing_item($nama_item, $id_cabang)
    {
        $this->db->where('nama_item', $nama_item);
        $this->db->where('id_cabang', $id_cabang);
        $query = $this->db->get('inventori');
        return $query->row();
    }
    
    // Helper: Get categories (untuk bisnis laundry)
    private function get_categories()
    {
        return [
            'Bahan',
            'Alat',
            'Perlengkapan'
        ];
    }
    
    // Helper: Get units
    private function get_units()
    {
        return [
            'Botol',
            'Kg',
            'Liter',
            'Pack',
            'Box',
            'Pcs',
            'Karung'
        ];
    }
}
