<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori_model extends CI_Model {
    
    private $table = 'inventori';
    
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }
    
    // Get all inventory with optional filters and id_pemilik
    public function get_all_inventory($search = null, $category = null, $id_pemilik = null) {
        $this->db->select('inventori.*, cabang.nama_cabang as nama_cabang');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        
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
    
    // Get inventory by ID with id_pemilik validation
    public function get_inventory_by_id($id, $id_pemilik = null) {
        $this->db->select('inventori.*, cabang.nama_cabang as nama_cabang, cabang.id_pemilik');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        $this->db->where('inventori.id_inventori', $id);
        
        // Filter berdasarkan id_pemilik jika disediakan
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
    
    // Get inventory statistics with id_pemilik filter
    public function get_inventory_stats($id_pemilik = null) {
        // Subquery untuk filter berdasarkan id_pemilik
        if ($id_pemilik) {
            $this->db->select('inventori.*');
            $this->db->from('inventori');
            $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
            $this->db->where('cabang.id_pemilik', $id_pemilik);
            $subquery = $this->db->get_compiled_select();
            
            // Total items
            $this->db->from("($subquery) as filtered_inventori");
            $total = $this->db->count_all_results();
            
            // Low stock items
            $this->db->from("($subquery) as filtered_inventori");
            $this->db->where('stok_tersedia <=', 'stok_minimal', FALSE);
            $low_stock = $this->db->count_all_results();
            
            // Out of stock items
            $this->db->from("($subquery) as filtered_inventori");
            $this->db->where('stok_tersedia', 0);
            $out_of_stock = $this->db->count_all_results();
        } else {
            // Total items
            $total = $this->db->count_all('inventori');
            
            // Low stock items
            $this->db->where('stok_tersedia <=', 'stok_minimal', FALSE);
            $low_stock = $this->db->count_all_results('inventori');
            
            // Out of stock items
            $this->db->where('stok_tersedia', 0);
            $out_of_stock = $this->db->count_all_results('inventori');
        }
        
        return [
            'total' => $total,
            'low_stock' => $low_stock,
            'out_of_stock' => $out_of_stock,
            'available' => $total - $out_of_stock
        ];
    }
    
    // Get items by category with id_pemilik filter
    public function get_items_by_category($id_pemilik = null) {
        $this->db->select('inventori.jenis_item, COUNT(*) as total');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        
        // Filter berdasarkan id_pemilik
        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        $this->db->group_by('inventori.jenis_item');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get all branches with id_pemilik filter
    public function get_all_branches($id_pemilik = null) {
        $this->db->select('id_cabang, nama_cabang');
        $this->db->from('cabang');
        
        // Filter berdasarkan id_pemilik
        if ($id_pemilik) {
            $this->db->where('id_pemilik', $id_pemilik);
        }
        
        $this->db->order_by('nama_cabang', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Validate if branch belongs to owner
    public function validate_branch_owner($id_cabang, $id_pemilik) {
        $this->db->where('id_cabang', $id_cabang);
        $this->db->where('id_pemilik', $id_pemilik);
        $query = $this->db->get('cabang');
        
        return $query->num_rows() > 0;
    }
    
    // Check if item exists with id_pemilik validation
    public function item_exists($nama_item, $id_exclude = null, $id_pemilik = null) {
        $this->db->select('inventori.id_inventori');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        $this->db->where('inventori.nama_item', $nama_item);
        
        // Filter berdasarkan id_pemilik
        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        if ($id_exclude) {
            $this->db->where('inventori.id_inventori !=', $id_exclude);
        }
        
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }
    
    // Update stock
    public function update_stock($id, $quantity, $type = 'add') {
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

    // Get top items by stock with id_pemilik filter
    public function get_top_items_by_stock($limit = 5, $id_pemilik = null) {
        $this->db->select('inventori.id_inventori, inventori.nama_item, inventori.stok_tersedia, inventori.harga_satuan');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        
        // Filter berdasarkan id_pemilik
        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        $this->db->order_by('inventori.stok_tersedia', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get stock trend by category with id_pemilik filter
    public function get_stock_trend_by_category($id_pemilik = null) {
        $this->db->select('inventori.jenis_item, COUNT(*) as count, ROUND(AVG(inventori.stok_tersedia)) as avg_stock, ROUND(AVG(inventori.harga_satuan)) as avg_price');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        
        // Filter berdasarkan id_pemilik
        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        $this->db->group_by('inventori.jenis_item');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get barang yang paling sering digunakan minggu ini
    // Berdasarkan persentase penggunaan stok (stok tersedia vs stok minimal)
    public function get_most_used_items($id_pemilik, $limit = 5)
    {
        // Hitung item dengan stok paling mendekati minimal (indikasi sering dipakai)
        $this->db->select('inventori.id_inventori,
                           inventori.nama_item, 
                           inventori.jenis_item,
                           inventori.stok_tersedia,
                           inventori.stok_minimal,
                           CASE 
                               WHEN inventori.stok_minimal > 0 AND inventori.stok_tersedia < inventori.stok_minimal
                               THEN ROUND(((inventori.stok_minimal - inventori.stok_tersedia) / inventori.stok_minimal) * 100)
                               ELSE 0 
                           END as usage_score');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('inventori.stok_tersedia >=', 0); // Termasuk yang habis untuk analisa
        $this->db->where('inventori.stok_minimal >', 0); // Pastikan ada stok minimal
        $this->db->order_by('usage_score', 'DESC'); // Yang paling tinggi usage_score = paling sering dipakai
        $this->db->limit($limit);
        
        $query = $this->db->get();
        $result = $query->result();
        
        // Format hasil untuk chart
        foreach ($result as $item) {
            // Gunakan usage_score yang sudah dihitung dalam persen
            $item->total_used = max(5, (int)$item->usage_score); // Minimal 5 untuk visibility di chart
        }
        
        // Jika tidak ada data yang memenuhi kriteria atau semua usage_score 0
        $hasValidData = false;
        foreach ($result as $item) {
            if ($item->total_used > 5) {
                $hasValidData = true;
                break;
            }
        }
        
        if (empty($result) || !$hasValidData) {
            // Fallback: ambil 5 item dengan stok terkecil (mendekati habis)
            $this->db->select('inventori.id_inventori,
                               inventori.nama_item, 
                               inventori.jenis_item,
                               inventori.stok_tersedia,
                               inventori.stok_minimal,
                               20 as total_used'); // Default value 20% untuk visibility
            $this->db->from('inventori');
            $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
            $this->db->where('cabang.id_pemilik', $id_pemilik);
            $this->db->where('inventori.stok_tersedia >=', 0);
            $this->db->order_by('inventori.stok_tersedia', 'ASC'); // Stok terkecil dulu
            $this->db->limit($limit);
            
            $query = $this->db->get();
            $result = $query->result();
            
            // Hitung ulang usage based on stok saja
            foreach ($result as $item) {
                if ($item->stok_minimal > 0) {
                    $percentage = ($item->stok_tersedia / $item->stok_minimal) * 100;
                    $item->total_used = max(10, round(100 - $percentage));
                } else {
                    $item->total_used = 20; // Default
                }
            }
        }
        
        return $result;
    }
}