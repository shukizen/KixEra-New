<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{

    private $table = 'pesanan';
    private $table_detail = 'detail_pesanan';
    private $table_progres = 'progres_pesanan';
    private $table_nota = 'nota';

    public function __construct()
    {
        parent::__construct();
    }
    public function getAllPesananByOwner($id_pemilik)
    {
        $this->db->select('
            pesanan.*,
            pelanggan.nama AS nama_pelanggan,
            pelanggan.no_telp,
            layanan.nama_layanan,
            karyawan.nama AS nama_karyawan,
            cabang.nama_cabang
        ');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left');
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = pesanan.id_karyawan', 'left');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang', 'left');

        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('pesanan.deleted_at IS NULL');

        return $this->db->get()->result();
    }

    public function insertNota($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table_nota, $data);
    }

    public function generateNoNota()
    {
        $this->db->select('no_nota');
        $this->db->from($this->table_nota);
        $this->db->like('no_nota', 'NOTA-' . date('Ymd'), 'after');
        $this->db->order_by('no_nota', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $last_nota = $query->row()->no_nota;
            $last_number = (int) substr($last_nota, -4);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        return 'NOTA-' . date('Ymd') . '-' . str_pad($new_number, 4, '0', STR_PAD_LEFT);
    }

    public function getNotaById($id_nota)
    {
        $this->db->where('id_nota', $id_nota);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_nota);
        return $query->row();
    }

    // Update pesanan
    public function updatePesanan($id_pesanan, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->update($this->table, $data);
    }

    // Soft delete pesanan
    public function deletePesanan($id_pesanan)
    {
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->update($this->table, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getPesananById($id_pesanan, $id_pemilik = null)
    {
        $this->db->select('
            pesanan.*,
            pelanggan.nama AS nama_pelanggan,
            pelanggan.no_telp,
            layanan.nama_layanan,
            karyawan.nama AS nama_karyawan,
            cabang.nama_cabang
        ');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left');
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = pesanan.id_karyawan', 'left');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang', 'left');

        $this->db->where('pesanan.id_pesanan', $id_pesanan);
        $this->db->where('pesanan.deleted_at IS NULL');
        
        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }

        return $this->db->get()->row();
    }
    
    // Verify ownership helper
    public function verify_ownership($id_pesanan, $id_pemilik) {
        $this->db->select('pesanan.id_pesanan');
        $this->db->from('pesanan');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
        $this->db->where('pesanan.id_pesanan', $id_pesanan);
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    // Get pesanan detail from view (includes all joins)
    public function getPesananDetailFromView($id_pesanan)
    {
        $this->db->select('
            v.*, 
            p.created_at,
            p.updated_at
        ');
        $this->db->from('v_pesanan_detail v');
        $this->db->join('pesanan p', 'p.id_pesanan = v.id_pesanan', 'left');
        $this->db->where('v.id_pesanan', $id_pesanan);
        $query = $this->db->get();
        return $query->row();
    }

    // Get detail items for a pesanan
    public function getDetailPesanan($id_pesanan)
    {
        $this->db->where('id_pesanan', $id_pesanan);
        $this->db->where('deleted_at IS NULL');
        return $this->db->get('detail_pesanan')->result();
    }

    // Get progress/timeline for a pesanan
    public function getProgresPesanan($id_pesanan)
    {
        $this->db->select('progres_pesanan.*, karyawan.nama as nama_karyawan');
        $this->db->from('progres_pesanan');
        $this->db->join('karyawan', 'karyawan.id_karyawan = progres_pesanan.id_karyawan', 'left');
        $this->db->where('progres_pesanan.id_pesanan', $id_pesanan);
        $this->db->where('progres_pesanan.deleted_at IS NULL');
        $this->db->order_by('progres_pesanan.tgl_update', 'ASC');
        return $this->db->get()->result();
    }

    // Insert new progress record
    public function insertProgres($id_pesanan, $status, $deskripsi = null, $id_karyawan = null)
    {
        $data = [
            'id_pesanan' => $id_pesanan,
            'status' => $status,
            'deskripsi' => $deskripsi ?? $this->getStatusDescription($status),
            'id_karyawan' => $id_karyawan,
            'tgl_update' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('progres_pesanan', $data);
    }

    // Get default description for status
    private function getStatusDescription($status)
    {
        $descriptions = [
            'diterima' => 'Pesanan diterima',
            'dalam_proses' => 'Pesanan sedang diproses',
            'selesai' => 'Pesanan selesai dikerjakan',
            'siap_diambil' => 'Pesanan siap untuk diambil',
            'sudah_diambil' => 'Pesanan sudah diambil oleh pelanggan',
            'dibatalkan' => 'Pesanan dibatalkan'
        ];
        return $descriptions[$status] ?? 'Status diperbarui';
    }

    // Get current status of a pesanan
    public function getCurrentStatus($id_pesanan)
    {
        $this->db->select('status_pesanan');
        $this->db->where('id_pesanan', $id_pesanan);
        $row = $this->db->get('pesanan')->row();
        return $row ? $row->status_pesanan : null;
    }
    // =============================================
    // DASHBOARD STATISTICS
    // =============================================

    public function countOrdersToday($id_pemilik)
    {
        $this->db->from($this->table);
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('DATE(pesanan.tgl_masuk)', date('Y-m-d'));
        $this->db->where('pesanan.deleted_at IS NULL');
        return $this->db->count_all_results();
    }

    public function countOrdersThisMonth($id_pemilik)
    {
        $this->db->from($this->table);
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('YEAR(pesanan.tgl_masuk)', date('Y'));
        $this->db->where('MONTH(pesanan.tgl_masuk)', date('m'));
        $this->db->where('pesanan.deleted_at IS NULL');
        return $this->db->count_all_results();
    }


    public function countPendingPickups($id_pemilik)
    {
        $this->db->from($this->table);
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('pesanan.status_pesanan', 'siap_diambil');
        $this->db->where('pesanan.deleted_at IS NULL');
        return $this->db->count_all_results();
    }

    public function getRecentOrders($limit, $id_pemilik)
    {
        $this->db->select('
            pesanan.*,
            pelanggan.nama AS nama_pelanggan,
            layanan.nama_layanan
        ');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left');
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
        
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('pesanan.deleted_at IS NULL');
        
        $this->db->order_by('pesanan.tgl_masuk', 'DESC');
        $this->db->limit($limit);
        
        return $this->db->get()->result();
    }

    public function getServiceVolume($id_pemilik)
    {
        $this->db->select('layanan.nama_layanan, COUNT(pesanan.id_pesanan) as total');
        $this->db->from($this->table);
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
        
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('pesanan.deleted_at IS NULL');
        
        $this->db->group_by('layanan.id_layanan, layanan.nama_layanan');
        $this->db->order_by('total', 'DESC');
        $this->db->limit(5); // Top 5 services
        
        return $this->db->get()->result();
    }
}
