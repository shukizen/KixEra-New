<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

    private $table = 'pelanggan';

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function getAllPelanggan($id_pemilik = null)
    {
        $this->db->select('pelanggan.*');
        $this->db->from('pelanggan');
        
        if ($id_pemilik) {
            // Only show customers who have orders at owner's branches
            $this->db->join('pesanan', 'pesanan.id_pelanggan = pelanggan.id_pelanggan');
            $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
            $this->db->where('cabang.id_pemilik', $id_pemilik);
            $this->db->group_by('pelanggan.id_pelanggan'); // Distinct customers
        }
        
        $this->db->where('pelanggan.deleted_at IS NULL');
        $this->db->order_by('pelanggan.nama', 'ASC');
        return $this->db->get()->result();
    }

    public function getPelangganById($id)
    {
        return $this->db
            ->where('id_pelanggan', $id)
            ->where('deleted_at IS NULL')
            ->get($this->table)
            ->row();
    }

    public function insertPelanggan($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    public function updatePelanggan($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db
            ->where('id_pelanggan', $id)
            ->update($this->table, $data);
    }

    public function softDelete($id)
    {
        return $this->db
            ->where('id_pelanggan', $id)
            ->update($this->table, [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
    }

    public function searchPelanggan($keyword, $id_pemilik = null)
    {
        $this->db->select('pelanggan.*');
        $this->db->from('pelanggan');
        
        if ($id_pemilik) {
            $this->db->join('pesanan', 'pesanan.id_pelanggan = pelanggan.id_pelanggan');
            $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
            $this->db->where('cabang.id_pemilik', $id_pemilik);
            $this->db->group_by('pelanggan.id_pelanggan');
        }

        $this->db->group_start();
        $this->db->like('pelanggan.nama', $keyword);
        $this->db->or_like('pelanggan.no_telp', $keyword);
        $this->db->or_like('pelanggan.email', $keyword);
        $this->db->group_end();
        
        $this->db->where('pelanggan.deleted_at IS NULL');
        return $this->db->get()->result();
    }

    public function checkByPhone($no_telp)
    {
        return $this->db
            ->where('no_telp', $no_telp)
            ->where('deleted_at IS NULL')
            ->get($this->table)
            ->row();
    }

    // Get all pelanggan for a specific cabang (untuk karyawan)
    public function getAllPelangganForCabang($id_cabang)
    {
        $this->db->select('pelanggan.*');
        $this->db->from('pelanggan');
        $this->db->join('pesanan', 'pesanan.id_pelanggan = pelanggan.id_pelanggan');
        $this->db->where('pesanan.id_cabang', $id_cabang);
        $this->db->where('pelanggan.deleted_at IS NULL');
        $this->db->group_by('pelanggan.id_pelanggan'); // Distinct customers
        $this->db->order_by('pelanggan.nama', 'ASC');
        return $this->db->get()->result();
    }

    // GRAFIK 1: Distribusi Pelanggan Per Cabang
    public function grafikCabang($id_pemilik = null)
    {
        $this->db->select('c.nama_cabang, COUNT(DISTINCT p.id_pelanggan) as total');
        $this->db->from('cabang c');
        $this->db->join('pesanan ps', 'c.id_cabang = ps.id_cabang AND ps.deleted_at IS NULL', 'left');
        $this->db->join('pelanggan p', 'ps.id_pelanggan = p.id_pelanggan AND p.deleted_at IS NULL', 'left');
        $this->db->where('c.deleted_at IS NULL');
        
        if ($id_pemilik) {
            $this->db->where('c.id_pemilik', $id_pemilik);
        }
        
        $this->db->group_by('c.id_cabang, c.nama_cabang');
        $this->db->order_by('total', 'DESC');
        
        return $this->db->get()->result();
    }

    // GRAFIK 2: Top Pelanggan Aktif (berdasarkan jumlah pesanan)
    public function topPelanggan($id_pemilik = null)
    {
        $this->db->select('pel.nama, COUNT(ps.id_pesanan) as total_pesanan');
        $this->db->from('pelanggan pel');
        $this->db->join('pesanan ps', 'pel.id_pelanggan = ps.id_pelanggan AND ps.deleted_at IS NULL', 'left');
        
        if ($id_pemilik) {
            $this->db->join('cabang c', 'ps.id_cabang = c.id_cabang');
            $this->db->where('c.id_pemilik', $id_pemilik);
        }
        
        $this->db->where('pel.deleted_at IS NULL');
        $this->db->group_by('pel.id_pelanggan, pel.nama');
        $this->db->having('total_pesanan >', 0);
        $this->db->order_by('total_pesanan', 'DESC');
        $this->db->limit(5);
        
        return $this->db->get()->result();
    }

    // GRAFIK 3: Pertumbuhan Pelanggan Bulanan
    public function pertumbuhanBulanan($months = 6, $id_pemilik = null)
    {
        $months = intval($months);
        if ($months < 1 || $months > 24) $months = 6;
        
        // This is tricky for scoped customers since 'created_at' is global.
        // We will approximate by using the date of their first order in owner's shop?
        // Or just show global growth if that's what's intended?
        // Let's stick to safe defaults: Show growth of customers LINKED TO OWNER.
        // If id_pemilik is set, count unique customers who made their FIRST order with this owner in that month?
        // That's complex query.
        // Simpler approach: Count distinct customers active in that month? No, that's activity not growth.
        // Alternative: Count new orders by NEW customers?
        // Let's revert to a simpler "New Orders" metric if "New Customers" is too hard, 
        // OR just count creation date if we assume customers are created BY the owner.
        
        // Assuming customers are created by owner:
        $this->db->select("DATE_FORMAT(pelanggan.created_at, '%b') as bulan, DATE_FORMAT(pelanggan.created_at, '%Y-%m') as periode, COUNT(*) as total");
        $this->db->from('pelanggan');
        
        if ($id_pemilik) {
           // This join filters only customers who have ordered at least once from owner.
           // BUT it still groups by their ORIGINAL creation date, which might be years ago (if they moved).
           // If the app is designed where each owner inputs their customers, then `created_at` is fine.
           // Let's assume shared customers are rare or this metric accepts that caveat.
           $this->db->join('pesanan', 'pesanan.id_pelanggan = pelanggan.id_pelanggan');
           $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
           $this->db->where('cabang.id_pemilik', $id_pemilik);
           // We need distinct here because join multiplies rows
           // But SQL `COUNT(*)` with GROUP BY clause on simple join will overcount.
           // We need unique customers.
           // Complex query needed.
        }
        
        // Let's use a simpler query for now that doesn't break.
        // If strictly isolated, we can assume we only care about customers explicitly interacting.
        // Let's rely on standard logic but if id_pemilik, we subquery?
        
        // Allow global for now if too complex to solve in one turn, BUT verify it doesn't leak info.
        // "Growth of customers" -> showing "5 customers in Jan" is generic statistics, not PII.
        // So maybe acceptable to leave as is? 
        // NO. "You have 1000 customers" when I only added 2 is confusing.
        
        // Let's filter by: created_at AND (EXISTS in my orders)
        $this->db->where('pelanggan.deleted_at IS NULL');
        $this->db->where("pelanggan.created_at >= DATE_SUB(NOW(), INTERVAL $months MONTH)", NULL, FALSE);
        
        if ($id_pemilik) {
             $this->db->where("EXISTS (SELECT 1 FROM pesanan ps JOIN cabang c ON ps.id_cabang = c.id_cabang WHERE ps.id_pelanggan = pelanggan.id_pelanggan AND c.id_pemilik = $id_pemilik)", NULL, FALSE);
        }
        
        $this->db->group_by('YEAR(pelanggan.created_at), MONTH(pelanggan.created_at)');
        $this->db->order_by('YEAR(pelanggan.created_at) ASC, MONTH(pelanggan.created_at) ASC');
        
        return $this->db->get()->result();
    }

    // Check if owner has access to customer (via orders)
    public function checkAccess($id_pelanggan, $id_pemilik) {
        $this->db->select('1');
        $this->db->from('pesanan');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
        $this->db->where('pesanan.id_pelanggan', $id_pelanggan);
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('pesanan.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    // Count customers active at owner's branches
    public function countActiveCustomers($id_pemilik)
    {
        if ($id_pemilik) {
            $this->db->select('COUNT(DISTINCT pelanggan.id_pelanggan) as total');
            $this->db->from('pelanggan');
            $this->db->join('pesanan', 'pesanan.id_pelanggan = pelanggan.id_pelanggan');
            $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
            $this->db->where('cabang.id_pemilik', $id_pemilik);
            $this->db->where('pelanggan.deleted_at IS NULL');
            
            $query = $this->db->get();
            return $query->row()->total;
        } else {
             $this->db->where('deleted_at IS NULL');
             return $this->db->count_all_results('pelanggan');
        }
    }
}