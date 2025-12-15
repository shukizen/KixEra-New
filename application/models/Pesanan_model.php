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
        return $this->db->delete($this->table);
    }

    public function getPesananById($id_pesanan)
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

        return $this->db->get()->row();
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
}
