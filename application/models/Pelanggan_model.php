<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

    private $table = 'pelanggan';

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    private function pelangganSelect($id_pemilik = null, $id_cabang = null)
    {
        if (!$id_pemilik) {
            return "p.*, (
                SELECT COUNT(*)
                FROM pesanan ps
                WHERE ps.id_pelanggan = p.id_pelanggan
                AND ps.deleted_at IS NULL
            ) as total_pesanan";
        }

        $owner = $this->db->escape($id_pemilik);
        $branchFilter = $id_cabang ? " AND ps.id_cabang = " . $this->db->escape($id_cabang) : "";

        return "p.*, (
            SELECT COUNT(*)
            FROM pesanan ps
            INNER JOIN cabang c ON c.id_cabang = ps.id_cabang
            WHERE ps.id_pelanggan = p.id_pelanggan
            AND c.id_pemilik = {$owner}
            {$branchFilter}
            AND ps.deleted_at IS NULL
        ) as total_pesanan";
    }

    private function pelangganScopeWhere($id_pemilik, $id_cabang = null)
    {
        $owner = $this->db->escape($id_pemilik);
        $branchOrderFilter = $id_cabang ? " AND ps.id_cabang = " . $this->db->escape($id_cabang) : "";
        $branchCreatedFilter = $id_cabang ? " AND p.id_cabang = " . $this->db->escape($id_cabang) : "";

        return "(
            EXISTS (
                SELECT 1
                FROM pesanan ps
                INNER JOIN cabang c ON c.id_cabang = ps.id_cabang
                WHERE ps.id_pelanggan = p.id_pelanggan
                AND c.id_pemilik = {$owner}
                {$branchOrderFilter}
                AND ps.deleted_at IS NULL
            )
            OR EXISTS (
                SELECT 1
                FROM cabang c2
                WHERE c2.id_cabang = p.id_cabang
                AND c2.id_pemilik = {$owner}
                {$branchCreatedFilter}
                AND c2.deleted_at IS NULL
            )
        )";
    }

    public function getAllPelanggan($id_pemilik = null, $id_cabang = null)
    {
        if ($id_pemilik) {
            $this->db->select($this->pelangganSelect($id_pemilik, $id_cabang), false);
            $this->db->from('pelanggan p');
            $this->db->where('p.deleted_at IS NULL');
            $this->db->where($this->pelangganScopeWhere($id_pemilik, $id_cabang), null, false);
            $this->db->order_by('p.nama', 'ASC');
            return $this->db->get()->result();
        }
        
        // No owner filter - return all customers
        $this->db->select($this->pelangganSelect(), false);
        $this->db->from('pelanggan p');
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('nama', 'ASC');
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

    public function searchPelanggan($keyword, $id_pemilik = null, $id_cabang = null)
    {
        if ($id_pemilik) {
            $this->db->select($this->pelangganSelect($id_pemilik, $id_cabang), false);
            $this->db->from('pelanggan p');
            $this->db->where('p.deleted_at IS NULL');
            $this->db->where($this->pelangganScopeWhere($id_pemilik, $id_cabang), null, false);
            $this->db->group_start();
            $this->db->like('p.nama', $keyword);
            $this->db->or_like('p.no_telp', $keyword);
            $this->db->or_like('p.email', $keyword);
            $this->db->group_end();
            $this->db->order_by('p.nama', 'ASC');
            return $this->db->get()->result();
        }
        
        // No owner filter
        $this->db->like('nama', $keyword);
        $this->db->or_like('no_telp', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->where('deleted_at IS NULL');
        return $this->db->get($this->table)->result();
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
    // Shows: customers who ordered at this branch + new customers with no orders yet
    // Get all pelanggan for a specific cabang (untuk karyawan)
    // Shows: customers who ordered at this branch + new customers scoped to this OWNER
    public function getAllPelangganForCabang($id_cabang, $id_pemilik = null)
    {
        // Parameter validation
        if (!$id_pemilik) {
            // Try to get pemiik from cabang if not provided
            $cabang = $this->db->select('id_pemilik')->where('id_cabang', $id_cabang)->get('cabang')->row();
            if ($cabang) {
                $id_pemilik = $cabang->id_pemilik;
            }
        }

        return $this->getAllPelanggan($id_pemilik, $id_cabang);
    }


    // GRAFIK 1: Distribusi Pelanggan Per Cabang
    public function grafikCabang($id_pemilik = null)
    {
        $this->db->select('c.nama_cabang, COUNT(DISTINCT p.id_pelanggan) as total');
        $this->db->from('cabang c');
        $this->db->join('pelanggan p', 'p.id_cabang = c.id_cabang AND p.deleted_at IS NULL', 'left');
        $this->db->where('c.deleted_at IS NULL');
        
        if ($id_pemilik) {
            $this->db->where('c.id_pemilik', $id_pemilik);
        }
        
        $this->db->group_by('c.id_cabang, c.nama_cabang');
        $this->db->order_by('total', 'DESC');
        
        $query = $this->db->get();
        if ($query === false) {
            $this->logQueryError('grafikCabang');
            return [];
        }

        return $query->result();
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
        
        $query = $this->db->get();
        if ($query === false) {
            $this->logQueryError('topPelanggan');
            return [];
        }

        return $query->result();
    }

    // GRAFIK 3: Pertumbuhan Pelanggan Bulanan
    public function pertumbuhanBulanan($months = 6, $id_pemilik = null)
    {
        $months = intval($months);
        if ($months < 1 || $months > 24) $months = 6;

        $this->db->select("DATE_FORMAT(p.created_at, '%b') as bulan, DATE_FORMAT(p.created_at, '%Y-%m') as periode, COUNT(DISTINCT p.id_pelanggan) as total");
        $this->db->from('pelanggan p');

        if ($id_pemilik) {
            $this->db->join('cabang c', 'c.id_cabang = p.id_cabang');
            $this->db->where('c.id_pemilik', $id_pemilik);
            $this->db->where('c.deleted_at IS NULL');
        }

        $this->db->where('p.deleted_at IS NULL');
        $this->db->where("p.created_at >= DATE_SUB(CURDATE(), INTERVAL {$months} MONTH)", NULL, FALSE);

        $this->db->group_by("YEAR(p.created_at), MONTH(p.created_at), DATE_FORMAT(p.created_at, '%b'), DATE_FORMAT(p.created_at, '%Y-%m')");
        $this->db->order_by('YEAR(p.created_at) ASC, MONTH(p.created_at) ASC');
        
        $query = $this->db->get();
        if ($query === false) {
            $this->logQueryError('pertumbuhanBulanan');
            return [];
        }

        return $query->result();
    }

    private function logQueryError($method)
    {
        $error = $this->db->error();
        $message = isset($error['message']) ? $error['message'] : 'Unknown database error';
        $code = isset($error['code']) ? $error['code'] : 'no-code';

        log_message('error', 'Pelanggan_model::' . $method . ' failed [' . $code . ']: ' . $message);
        log_message('error', 'Last query: ' . $this->db->last_query());
    }

    // Check if owner has access to customer (via orders or if new customer)
    public function checkAccess($id_pelanggan, $id_pemilik) {
        // Check if customer has any orders
        $has_orders = $this->db->where('id_pelanggan', $id_pelanggan)
                               ->where('deleted_at IS NULL')
                               ->count_all_results('pesanan') > 0;
        
        if (!$has_orders) {
            $this->db->select('1');
            $this->db->from('pelanggan');
            $this->db->join('cabang', 'cabang.id_cabang = pelanggan.id_cabang');
            $this->db->where('pelanggan.id_pelanggan', $id_pelanggan);
            $this->db->where('cabang.id_pemilik', $id_pemilik);
            $this->db->where('pelanggan.deleted_at IS NULL');
            $query = $this->db->get();
            return $query->num_rows() > 0;
        }
        
        // Check if customer has orders at owner's branches
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

    // Search pelanggan by cabang (untuk karyawan)
    // Searches: customers who ordered at this branch + new customers with no orders yet
    // Search pelanggan by cabang (untuk karyawan)
    // Searches: customers who ordered at this OWNER + match keyword
    public function searchPelangganByCabang($keyword, $id_cabang, $id_pemilik = null)
    {
        if (!$id_pemilik) {
            $cabang = $this->db->select('id_pemilik')->where('id_cabang', $id_cabang)->get('cabang')->row();
            if ($cabang) {
                $id_pemilik = $cabang->id_pemilik;
            }
        }

        return $this->searchPelanggan($keyword, $id_pemilik, $id_cabang);
    }

    // Check if karyawan (via cabang) has access to customer
    // Returns true if customer ordered at this branch OR has no orders yet (new customer)
    public function checkAccessByCabang($id_pelanggan, $id_cabang) {
        // Check if customer has any orders
        $has_orders = $this->db->where('id_pelanggan', $id_pelanggan)
                               ->where('deleted_at IS NULL')
                               ->count_all_results('pesanan') > 0;
        
        if (!$has_orders) {
            $this->db->select('1');
            $this->db->from('pelanggan');
            $this->db->where('id_pelanggan', $id_pelanggan);
            $this->db->where('id_cabang', $id_cabang);
            $this->db->where('deleted_at IS NULL');
            $query = $this->db->get();
            return $query->num_rows() > 0;
        }
        
        // Check if customer has orders at this specific branch
        $this->db->select('1');
        $this->db->from('pesanan');
        $this->db->where('pesanan.id_pelanggan', $id_pelanggan);
        $this->db->where('pesanan.id_cabang', $id_cabang);
        $this->db->where('pesanan.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }
}

