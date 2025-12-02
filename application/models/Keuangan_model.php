<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan_model extends CI_Model {
    
    private $table_pemasukan = 'pemasukan';
    private $table_pengeluaran = 'pengeluaran';
    private $table_bukti = 'bukti_transaksi';
    
    public function __construct() {
        parent::__construct();
    }
    
    // ========== PEMASUKAN ==========
    
    // Get all pemasukan by owner
    public function getAllPemasukan($id_owner, $start_date = null, $end_date = null) {
        $this->db->select('pemasukan.*, karyawan.nama as nama_karyawan, pesanan.id_pesanan');
        $this->db->from($this->table_pemasukan);
        $this->db->join('karyawan', 'karyawan.id_karyawan = pemasukan.id_karyawan', 'left');
        $this->db->join('pesanan', 'pesanan.id_pesanan = pemasukan.id_pesanan', 'left');
        $this->db->where('pemasukan.id_owner', $id_owner);
        
        if ($start_date && $end_date) {
            $this->db->where('pemasukan.tgl_transaksi >=', $start_date);
            $this->db->where('pemasukan.tgl_transaksi <=', $end_date);
        }
        
        $this->db->where('pemasukan.deleted_at IS NULL');
        $this->db->order_by('pemasukan.tgl_transaksi', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get pemasukan by ID
    public function getPemasukanById($id_pemasukan) {
        $this->db->where('id_pemasukan', $id_pemasukan);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_pemasukan);
        return $query->row();
    }
    
    // Insert pemasukan
    public function insertPemasukan($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table_pemasukan, $data);
        return $this->db->insert_id();
    }
    
    // Update pemasukan
    public function updatePemasukan($id_pemasukan, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_pemasukan', $id_pemasukan);
        return $this->db->update($this->table_pemasukan, $data);
    }
    
    // Delete pemasukan
    public function deletePemasukan($id_pemasukan) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_pemasukan', $id_pemasukan);
        return $this->db->update($this->table_pemasukan, $data);
    }
    
    // Get total pemasukan
    public function getTotalPemasukan($id_owner, $start_date = null, $end_date = null) {
        $this->db->select_sum('jumlah');
        $this->db->where('id_owner', $id_owner);
        
        if ($start_date && $end_date) {
            $this->db->where('tgl_transaksi >=', $start_date);
            $this->db->where('tgl_transaksi <=', $end_date);
        }
        
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_pemasukan);
        $result = $query->row();
        return $result->jumlah ?? 0;
    }
    
    // ========== PENGELUARAN ==========
    
    // Get all pengeluaran by owner
    public function getAllPengeluaran($id_owner, $start_date = null, $end_date = null) {
        $this->db->select('pengeluaran.*, karyawan.nama as nama_karyawan');
        $this->db->from($this->table_pengeluaran);
        $this->db->join('karyawan', 'karyawan.id_karyawan = pengeluaran.id_karyawan', 'left');
        $this->db->where('pengeluaran.id_owner', $id_owner);
        
        if ($start_date && $end_date) {
            $this->db->where('pengeluaran.tgl_transaksi >=', $start_date);
            $this->db->where('pengeluaran.tgl_transaksi <=', $end_date);
        }
        
        $this->db->where('pengeluaran.deleted_at IS NULL');
        $this->db->order_by('pengeluaran.tgl_transaksi', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get pengeluaran by ID
    public function getPengeluaranById($id_pengeluaran) {
        $this->db->where('id_pengeluaran', $id_pengeluaran);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_pengeluaran);
        return $query->row();
    }
    
    // Insert pengeluaran
    public function insertPengeluaran($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table_pengeluaran, $data);
        return $this->db->insert_id();
    }
    
    // Update pengeluaran
    public function updatePengeluaran($id_pengeluaran, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_pengeluaran', $id_pengeluaran);
        return $this->db->update($this->table_pengeluaran, $data);
    }
    
    // Delete pengeluaran
    public function deletePengeluaran($id_pengeluaran) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_pengeluaran', $id_pengeluaran);
        return $this->db->update($this->table_pengeluaran, $data);
    }
    
    // Get total pengeluaran
    public function getTotalPengeluaran($id_owner, $start_date = null, $end_date = null) {
        $this->db->select_sum('jumlah');
        $this->db->where('id_owner', $id_owner);
        
        if ($start_date && $end_date) {
            $this->db->where('tgl_transaksi >=', $start_date);
            $this->db->where('tgl_transaksi <=', $end_date);
        }
        
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_pengeluaran);
        $result = $query->row();
        return $result->jumlah ?? 0;
    }
    
    // Get by kategori
    public function getPengeluaranByKategori($id_owner, $kategori, $start_date = null, $end_date = null) {
        $this->db->where('id_owner', $id_owner);
        $this->db->where('kategori', $kategori);
        
        if ($start_date && $end_date) {
            $this->db->where('tgl_transaksi >=', $start_date);
            $this->db->where('tgl_transaksi <=', $end_date);
        }
        
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_pengeluaran);
        return $query->result();
    }
    
    // ========== COMBINED KEUANGAN ==========
    
    // Get laporan keuangan (pemasukan & pengeluaran)
    public function getLaporanKeuangan($id_owner, $start_date, $end_date) {
        $query = $this->db->query("
            SELECT 
                DATE(tgl_transaksi) as tanggal,
                'pemasukan' as jenis,
                nama_transaksi,
                kategori,
                jumlah,
                keterangan
            FROM pemasukan
            WHERE id_owner = ? 
                AND tgl_transaksi >= ? 
                AND tgl_transaksi <= ?
                AND deleted_at IS NULL
            
            UNION ALL
            
            SELECT 
                DATE(tgl_transaksi) as tanggal,
                'pengeluaran' as jenis,
                nama_transaksi,
                kategori,
                jumlah,
                keterangan
            FROM pengeluaran
            WHERE id_owner = ? 
                AND tgl_transaksi >= ? 
                AND tgl_transaksi <= ?
                AND deleted_at IS NULL
            
            ORDER BY tanggal DESC, jenis ASC
        ", [$id_owner, $start_date, $end_date, $id_owner, $start_date, $end_date]);
        
        return $query->result();
    }
    
    // Get summary keuangan
    public function getSummaryKeuangan($id_owner, $start_date = null, $end_date = null) {
        $pemasukan = $this->getTotalPemasukan($id_owner, $start_date, $end_date);
        $pengeluaran = $this->getTotalPengeluaran($id_owner, $start_date, $end_date);
        
        return [
            'total_pemasukan' => $pemasukan,
            'total_pengeluaran' => $pengeluaran,
            'laba_rugi' => $pemasukan - $pengeluaran
        ];
    }
    
    // ========== BUKTI TRANSAKSI ==========
    
    // Get bukti by pemasukan
    public function getBuktiByPemasukan($id_pemasukan) {
        $this->db->where('id_pemasukan', $id_pemasukan);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_bukti);
        return $query->result();
    }
    
    // Get bukti by pengeluaran
    public function getBuktiByPengeluaran($id_pengeluaran) {
        $this->db->where('id_pengeluaran', $id_pengeluaran);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_bukti);
        return $query->result();
    }
    
    // Insert bukti transaksi
    public function insertBukti($data) {
        $data['tgl_upload'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table_bukti, $data);
    }
    
    // Delete bukti
    public function deleteBukti($id_bukti) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_bukti', $id_bukti);
        return $this->db->update($this->table_bukti, $data);
    }
}

?>