<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

    private $table = 'pelanggan';

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function getAllPelanggan()
    {
        return $this->db
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get($this->table)
            ->result();
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

    public function searchPelanggan($keyword)
    {
        return $this->db
            ->group_start()
                ->like('nama', $keyword)
                ->or_like('no_telp', $keyword)
                ->or_like('email', $keyword)
            ->group_end()
            ->where('deleted_at IS NULL')
            ->get($this->table)
            ->result();
    }

    public function checkByPhone($no_telp)
    {
        return $this->db
            ->where('no_telp', $no_telp)
            ->where('deleted_at IS NULL')
            ->get($this->table)
            ->row();
    }

    // GRAFIK 1: Distribusi Pelanggan Per Cabang
    public function grafikCabang()
    {
        // Berdasarkan pesanan yang dibuat pelanggan di setiap cabang
        return $this->db->query("
            SELECT 
                c.nama_cabang,
                COUNT(DISTINCT p.id_pelanggan) as total
            FROM cabang c
            LEFT JOIN pesanan ps ON c.id_cabang = ps.id_cabang AND ps.deleted_at IS NULL
            LEFT JOIN pelanggan p ON ps.id_pelanggan = p.id_pelanggan AND p.deleted_at IS NULL
            WHERE c.deleted_at IS NULL
            GROUP BY c.id_cabang, c.nama_cabang
            ORDER BY total DESC
        ")->result();
    }

    // GRAFIK 2: Top Pelanggan Aktif (berdasarkan jumlah pesanan)
    public function topPelanggan()
    {
        return $this->db->query("
            SELECT 
                pel.nama,
                COUNT(ps.id_pesanan) as total_pesanan
            FROM pelanggan pel
            LEFT JOIN pesanan ps ON pel.id_pelanggan = ps.id_pelanggan 
                AND ps.deleted_at IS NULL
            WHERE pel.deleted_at IS NULL
            GROUP BY pel.id_pelanggan, pel.nama
            HAVING total_pesanan > 0
            ORDER BY total_pesanan DESC
            LIMIT 5
        ")->result();
    }

    // GRAFIK 3: Pertumbuhan Pelanggan Bulanan (berdasarkan periode)
    public function pertumbuhanBulanan($months = 6)
    {
        $months = intval($months);
        if ($months < 1 || $months > 24) {
            $months = 6;
        }
        
        return $this->db->query("
            SELECT 
                DATE_FORMAT(created_at, '%b') as bulan,
                DATE_FORMAT(created_at, '%Y-%m') as periode,
                COUNT(*) as total
            FROM pelanggan
            WHERE deleted_at IS NULL
                AND created_at >= DATE_SUB(NOW(), INTERVAL ? MONTH)
            GROUP BY YEAR(created_at), MONTH(created_at)
            ORDER BY YEAR(created_at) ASC, MONTH(created_at) ASC
        ", [$months])->result();
    }
}