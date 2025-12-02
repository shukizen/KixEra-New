<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model {
    
    private $table = 'pesanan';
    private $table_detail = 'detail_pesanan';
    private $table_progres = 'progres_pesanan';
    private $table_nota = 'nota';
    
    public function __construct() {
        parent::__construct();
    }

    public function getAllPesananByOwner($id_owner) {
        $this->db->select('pesanan.*, pelanggan.nama as nama_pelanggan, 
                          pelanggan.no_telp, layanan.nama_layanan, 
                          karyawan.nama as nama_karyawan');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left');
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->join('owner', 'owner.id_owner = pesanan.id_owner', 'left');
        $this->db->where('nota.id_pesanan', $id_pesanan);
        $this->db->where('nota.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->row();
    }

    public function insertNota($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table_nota, $data);
    }

    public function generateNoNota() {
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

    public function getNotaById($id_nota) {
        $this->db->where('id_nota', $id_nota);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_nota);
        return $query->row();
    }
} 
?>