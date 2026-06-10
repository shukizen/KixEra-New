<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori_model extends CI_Model {
    
    private $table = 'inventori';
    
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }
    
    // Get all inventory with optional filters, id_pemilik, and id_cabang
    public function get_all_inventory($search = null, $category = null, $id_pemilik = null, $id_cabang = null) {
        $this->db->select('inventori.*, cabang.nama_cabang as nama_cabang');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        
        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }

        if ($id_cabang) {
            $this->db->where('inventori.id_cabang', $id_cabang);
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
    
    // Insert new inventory with automatic logging to transaksi_inventori and pengeluaran
    public function insert_inventory($data, $id_karyawan = null) {
        $this->db->trans_start();
        
        // Insert inventory
        $this->db->insert($this->table, $data);
        $id_inventori = $this->db->insert_id();
        
        if ($id_inventori) {
            // Log to transaksi_inventori
            $transaksi_data = [
                'id_inventori' => $id_inventori,
                'id_cabang' => $data['id_cabang'],
                'jenis_transaksi' => 'masuk',
                'jumlah' => $data['stok_tersedia'],
                'tgl_transaksi' => date('Y-m-d H:i:s'),
                'id_karyawan' => $id_karyawan,
                'keterangan' => 'Stok awal: ' . $data['nama_item'],
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('transaksi_inventori', $transaksi_data);
            
            // Log to pengeluaran if harga_satuan is set
            if (!empty($data['harga_satuan']) && $data['harga_satuan'] > 0) {
                $total_cost = $data['harga_satuan'] * $data['stok_tersedia'];
                $pengeluaran_data = [
                    'id_cabang' => $data['id_cabang'],
                    'nama_transaksi' => 'Pembelian ' . $data['nama_item'],
                    'kategori' => strtolower($data['jenis_item']),
                    'jumlah' => $total_cost,
                    'tgl_transaksi' => date('Y-m-d'),
                    'keterangan' => 'Pembelian stok awal ' . $data['stok_tersedia'] . ' ' . $data['satuan'] . ' @ Rp ' . number_format($data['harga_satuan'], 0, ',', '.'),
                    'id_karyawan' => $id_karyawan,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('pengeluaran', $pengeluaran_data);
            }
        }
        
        $this->db->trans_complete();
        
        return $this->db->trans_status() ? $id_inventori : false;
    }
    
    // Update inventory
    public function update_inventory($id, $data) {
        $item = $this->get_inventory_by_id($id);
        
        $this->db->where('id_inventori', $id);
        $result = $this->db->update($this->table, $data);
        
        if ($result && $item && isset($data['stok_tersedia'])) {
            $new_stock = $data['stok_tersedia'];
            if ($new_stock <= $item->stok_minimal) {
                $this->load->model('Notification_model');
                $this->Notification_model->create([
                    'id_pemilik' => $item->id_pemilik,
                    'title' => 'Stok Menipis: ' . $item->nama_item,
                    'message' => 'Stok ' . $item->nama_item . ' di cabang ' . $item->nama_cabang . ' tersisa ' . $new_stock . ' ' . $item->satuan . ' (minimal: ' . $item->stok_minimal . ').',
                    'type' => 'stock',
                    'related_id' => $id
                ]);
            }
        }
        
        return $result;
    }
    
    // Delete inventory
    public function delete_inventory($id) {
        $this->db->where('id_inventori', $id);
        return $this->db->delete($this->table);
    }
    
    // Get inventory statistics with id_pemilik or id_cabang filter
    public function get_inventory_stats($id_pemilik = null, $id_cabang = null) {
        $this->db->select('inventori.*');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        
        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        if ($id_cabang) {
            $this->db->where('inventori.id_cabang', $id_cabang);
        }

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

        return [
            'total' => $total,
            'low_stock' => $low_stock,
            'out_of_stock' => $out_of_stock,
            'available' => $total - $out_of_stock
        ];
    }
    
    // Get items by category with id_pemilik and id_cabang filter
    public function get_items_by_category($id_pemilik = null, $id_cabang = null) {
        $this->db->select('inventori.jenis_item, COUNT(*) as total');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        
        // Filter berdasarkan id_pemilik
        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }

        if ($id_cabang) {
            $this->db->where('inventori.id_cabang', $id_cabang);
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
    
    // Get barang yang paling sering digunakan
    // Berdasarkan stok terkecil (yang paling sering habis/dipakai)
    public function get_most_used_items($id_pemilik, $limit = 5, $id_cabang = null)
    {
        // Jika id_pemilik tidak ada, kembalikan array kosong
        if (empty($id_pemilik)) {
            return [];
        }
        
        // Ambil semua inventory untuk pemilik ini
        $this->db->select('inventori.id_inventori,
                           inventori.nama_item, 
                           inventori.jenis_item,
                           inventori.stok_tersedia,
                           inventori.stok_minimal');
        $this->db->from('inventori');
        $this->db->join('cabang', 'cabang.id_cabang = inventori.id_cabang', 'left');
        $this->db->where('cabang.id_pemilik', $id_pemilik);

        if ($id_cabang) {
            $this->db->where('inventori.id_cabang', $id_cabang);
        }

        $this->db->order_by('inventori.stok_tersedia', 'ASC'); // Stok terkecil dulu = paling sering digunakan
        $this->db->limit($limit);
        
        $query = $this->db->get();
        $result = $query->result();
        
        // Jika tidak ada data, kembalikan array kosong
        if (empty($result)) {
            return [];
        }
        
        // Hitung usage percentage untuk tiap item
        // Item dengan stok terkecil dianggap paling sering digunakan
        $maxStock = 0;
        foreach ($result as $item) {
            if ($item->stok_tersedia > $maxStock) {
                $maxStock = $item->stok_tersedia;
            }
        }
        
        // Jika maxStock = 0, set ke 1 untuk menghindari division by zero
        $maxStock = max(1, $maxStock);
        
        foreach ($result as $item) {
            // Hitung persentase kebalikan - stok kecil = usage tinggi
            if ($item->stok_minimal > 0 && $item->stok_tersedia <= $item->stok_minimal) {
                // Jika stok di bawah minimal, set usage tinggi
                $item->total_used = 80 + rand(0, 20); // 80-100%
            } else {
                // Hitung berdasarkan posisi relatif terhadap stok maksimum
                $usagePercentage = 100 - (($item->stok_tersedia / $maxStock) * 100);
                $item->total_used = max(10, min(100, round($usagePercentage)));
            }
        }
        
        return $result;
    }

    // Mengurangi stok item inventori yang cocok secara otomatis saat pesanan masuk tahap pengerjaan
    public function kurangi_stok_layanan($id_layanan, $id_cabang, $nomor_pesanan, $jumlah_pesanan = 1) {
        // Ambil resep kebutuhan bahan baku untuk layanan ini
        $this->db->where('id_layanan', $id_layanan);
        $resep = $this->db->get('layanan_inventori')->result();
        
        if (empty($resep)) {
            return true; // Tidak ada bahan baku yang perlu dikurangi
        }
        
        $this->db->trans_start();
        
        foreach ($resep as $bahan) {
            // Cari item inventori di cabang bersangkutan yang memiliki nama_item yang cocok
            $this->db->where('id_cabang', $id_cabang);
            $this->db->where('nama_item', $bahan->nama_item);
            $item = $this->db->get($this->table)->row();
            
            if ($item) {
                $jumlah_dikurangi = $bahan->jumlah_dibutuhkan * $jumlah_pesanan;
                $stok_baru = max(0, $item->stok_tersedia - $jumlah_dikurangi);
                
                // Update stok inventori
                $this->db->where('id_inventori', $item->id_inventori);
                $this->db->update($this->table, ['stok_tersedia' => $stok_baru]);
                
                // Catat di transaksi_inventori (keluar)
                $transaksi_data = [
                    'id_inventori' => $item->id_inventori,
                    'id_cabang' => $id_cabang,
                    'jenis_transaksi' => 'keluar',
                    'jumlah' => $jumlah_dikurangi,
                    'tgl_transaksi' => date('Y-m-d H:i:s'),
                    'keterangan' => 'Konsumsi otomatis pesanan #' . $nomor_pesanan,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('transaksi_inventori', $transaksi_data);
                
                // Trigger notifikasi jika stok menipis (di bawah minimal)
                if ($stok_baru <= $item->stok_minimal) {
                    // Ambil id_pemilik dari cabang
                    $cabang = $this->db->get_where('cabang', ['id_cabang' => $id_cabang])->row();
                    if ($cabang) {
                        $this->load->model('Notification_model');
                        $this->Notification_model->create([
                            'id_pemilik' => $cabang->id_pemilik,
                            'title' => 'Stok Menipis: ' . $item->nama_item,
                            'message' => 'Stok ' . $item->nama_item . ' di cabang ' . $cabang->nama_cabang . ' tersisa ' . $stok_baru . ' ' . $item->satuan . ' (minimal: ' . $item->stok_minimal . ') akibat pengerjaan pesanan #' . $nomor_pesanan . '.',
                            'type' => 'stock',
                            'related_id' => $item->id_inventori
                        ]);
                    }
                }
            }
        }
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // Mengembalikan stok item inventori jika pesanan dibatalkan setelah masuk tahap pengerjaan
    public function kembalikan_stok_layanan($id_layanan, $id_cabang, $nomor_pesanan, $jumlah_pesanan = 1) {
        // Ambil resep kebutuhan bahan baku untuk layanan ini
        $this->db->where('id_layanan', $id_layanan);
        $resep = $this->db->get('layanan_inventori')->result();
        
        if (empty($resep)) {
            return true;
        }
        
        $this->db->trans_start();
        
        foreach ($resep as $bahan) {
            // Cari item inventori di cabang bersangkutan yang memiliki nama_item yang cocok
            $this->db->where('id_cabang', $id_cabang);
            $this->db->where('nama_item', $bahan->nama_item);
            $item = $this->db->get($this->table)->row();
            
            if ($item) {
                $jumlah_dikembalikan = $bahan->jumlah_dibutuhkan * $jumlah_pesanan;
                $stok_baru = $item->stok_tersedia + $jumlah_dikembalikan;
                
                // Update stok inventori
                $this->db->where('id_inventori', $item->id_inventori);
                $this->db->update($this->table, ['stok_tersedia' => $stok_baru]);
                
                // Catat di transaksi_inventori (masuk)
                $transaksi_data = [
                    'id_inventori' => $item->id_inventori,
                    'id_cabang' => $id_cabang,
                    'jenis_transaksi' => 'masuk',
                    'jumlah' => $jumlah_dikembalikan,
                    'tgl_transaksi' => date('Y-m-d H:i:s'),
                    'keterangan' => 'Pemulihan otomatis (pembatalan pesanan #' . $nomor_pesanan . ')',
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('transaksi_inventori', $transaksi_data);
            }
        }
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}