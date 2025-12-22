<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventorimodel extends CI_Model {
    
    private $table = 'inventori';
    
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }
    
    // Get all inventory with optional filters
    public function get_all_inventory($search = null, $category = null, $id_pemilik = null) {
        $this->db->select('inventori.*, cabang.nama_cabang as nama_cabang');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang'); // Inner join to enforce valid branch
        
        // Filter by id_pemilik
        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('inventori.nama_item', $search);
            $this->db->or_like('inventori.jenis_item', $search);
            $this->db->or_like('inventori.satuan', $search);
            $this->db->group_end();
        }
        
        if ($category && $category != 'Semua Kategori') {
            $this->db->where('inventori.jenis_item', $category);
        }
        
        $this->db->order_by('inventori.id_inventori', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get inventory by ID (with ownership verification)
    public function get_inventory_by_id($id, $id_pemilik = null) {
        $this->db->select('inventori.*, cabang.nama_cabang as nama_cabang');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang');
        $this->db->where('inventori.id_inventori', $id);
        
        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        $query = $this->db->get();
        return $query->row();
    }
    
    // Insert new inventory
    public function insert_inventory($data) {
        return $this->db->insert($this->table, $data);
    }
    
    // Update inventory
    public function update_inventory($id, $data) {
        $this->db->where('id_inventori', $id);
        return $this->db->update($this->table, $data);
    }
    
    // Delete inventory
    public function delete_inventory($id) {
        $this->db->where('id_inventori', $id);
        return $this->db->delete($this->table);
    }
    
    // Get inventory statistics
    public function get_inventory_stats($id_pemilik = null) {
        // Base query setup helper
        $setup_filter = function() use ($id_pemilik) {
            if ($id_pemilik) {
                // For count_all results we need to use join
                $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang');
                $this->db->where('cabang.id_pemilik', $id_pemilik);
            }
        };

        // Total items
        $this->db->from('inventori');
        $setup_filter();
        $total = $this->db->count_all_results();
        
        // Low stock items (stok_tersedia <= stok_minimal)
        $this->db->from('inventori');
        $setup_filter();
        $this->db->where('stok_tersedia <=', 'stok_minimal', FALSE);
        $low_stock = $this->db->count_all_results();
        
        // Out of stock items
        $this->db->from('inventori');
        $setup_filter();
        $this->db->where('stok_tersedia', 0);
        $out_of_stock = $this->db->count_all_results();
        
        return [
            'total' => $total,
            'low_stock' => $low_stock,
            'out_of_stock' => $out_of_stock,
            'available' => $total - $out_of_stock
        ];
    }
    
    // Get items by category (untuk pie chart)
    public function get_items_by_category($id_pemilik = null) {
        $this->db->select('jenis_item, COUNT(*) as total');
        $this->db->from('inventori');
        
        if ($id_pemilik) {
            $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang');
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        $this->db->group_by('jenis_item');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get all branches
    public function get_all_branches($id_pemilik = null) {
        $this->db->select('id_cabang, nama_cabang');
        $this->db->from('cabang');
        $this->db->where('deleted_at IS NULL');
        
        if ($id_pemilik) {
            $this->db->where('id_pemilik', $id_pemilik);
        }
        
        $this->db->order_by('nama_cabang', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Check if item exists
    public function item_exists($nama_item, $id_exclude = null, $id_pemilik = null) {
        $this->db->select('inventori.id_inventori');
        $this->db->from('inventori');
        $this->db->where('nama_item', $nama_item);
        
        if ($id_pemilik) {
            $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang');
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        if ($id_exclude) {
            $this->db->where('id_inventori !=', $id_exclude);
        }
        
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }
    
    // Update stock
    public function update_stock($id, $quantity, $type = 'add') {
        // Warning: This method trusts the controller to verify ownership first!
        // Ideally should pass id_pemilik here too, but for update actions usually 
        // we verify existence first in controller.
        
        $item = $this->get_inventory_by_id($id);
        if (!$item) {
            return false;
        }
        
        $new_stock = $type == 'add' 
            ? $item->stok_tersedia + $quantity 
            : $item->stok_tersedia - $quantity;
        
        if ($new_stock < 0) {
            return false;
        }
        
        $data = ['stok_tersedia' => $new_stock];
        return $this->update_inventory($id, $data);
    }

    // Get top items by stock (untuk chart penggunaan)
    public function get_top_items_by_stock($limit = 5, $id_pemilik = null) {
        $this->db->select('inventori.id_inventori, inventori.nama_item, inventori.stok_tersedia, inventori.harga_satuan');
        $this->db->from('inventori');
        
        if ($id_pemilik) {
            $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang');
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        $this->db->order_by('stok_tersedia', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get stock trend by category
    public function get_stock_trend_by_category($id_pemilik = null) {
        $this->db->select('inventori.jenis_item, COUNT(*) as count, ROUND(AVG(inventori.stok_tersedia)) as avg_stock, ROUND(AVG(inventori.harga_satuan)) as avg_price');
        $this->db->from('inventori');
        
        if ($id_pemilik) {
            $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang');
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        $this->db->group_by('inventori.jenis_item');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Verify ownership helper
    public function verify_ownership($id_inventori, $id_pemilik) {
        $this->db->select('inventori.id_inventori');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang');
        $this->db->where('inventori.id_inventori', $id_inventori);
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }
}