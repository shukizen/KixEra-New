<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_operasional_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get overall operational statistics
     */
    public function getStats() {
        // Total pesanan
        $total_pesanan = $this->db->count_all_results('pesanan');
        
        // Pesanan hari ini
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        $pesanan_hari_ini = $this->db->count_all_results('pesanan');
        
        // Total pelanggan
        $this->db->where('deleted_at IS NULL');
        $total_pelanggan = $this->db->count_all_results('pelanggan');
        
        // Total layanan
        $this->db->where('deleted_at IS NULL');
        $total_layanan = $this->db->count_all_results('layanan');
        
        // Total cabang
        $this->db->where('deleted_at IS NULL');
        $total_cabang = $this->db->count_all_results('cabang');
        
        // Total karyawan
        $this->db->where('deleted_at IS NULL');
        $total_karyawan = $this->db->count_all_results('karyawan');
        
        // Total inventori (items)
        $total_inventori = $this->db->count_all_results('inventori');
        
        // Pemilik aktif
        $this->db->where('deleted_at IS NULL');
        $total_pemilik = $this->db->count_all_results('pemilik');
        
        return [
            'total_pesanan' => $total_pesanan,
            'pesanan_hari_ini' => $pesanan_hari_ini,
            'total_pelanggan' => $total_pelanggan,
            'total_layanan' => $total_layanan,
            'total_cabang' => $total_cabang,
            'total_karyawan' => $total_karyawan,
            'total_inventori' => $total_inventori,
            'total_pemilik' => $total_pemilik
        ];
    }
    
    /**
     * Get recent pesanan
     */
    public function getRecentPesanan($limit = 10) {
        $this->db->select('p.*, pel.nama as nama_pelanggan, c.nama_cabang');
        $this->db->from('pesanan p');
        $this->db->join('pelanggan pel', 'p.id_pelanggan = pel.id_pelanggan', 'left');
        $this->db->join('cabang c', 'p.id_cabang = c.id_cabang', 'left');
        $this->db->order_by('p.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * Get pemilik with their stats
     */
    public function getPemilikWithStats($limit = 10) {
        $this->db->select('pm.*, u.username, u.status,
            (SELECT COUNT(*) FROM cabang c WHERE c.id_pemilik = pm.id_pemilik AND c.deleted_at IS NULL) as jumlah_cabang,
            (SELECT COUNT(*) FROM karyawan k JOIN cabang c2 ON k.id_cabang = c2.id_cabang WHERE c2.id_pemilik = pm.id_pemilik AND k.deleted_at IS NULL) as jumlah_karyawan');
        $this->db->from('pemilik pm');
        $this->db->join('users u', 'pm.id_user = u.id_user', 'left');
        $this->db->where('pm.deleted_at IS NULL');
        $this->db->order_by('pm.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * Get cabang summary by pemilik
     */
    public function getCabangSummary() {
        $this->db->select('pm.nama as nama_pemilik, pm.nama_usaha, COUNT(c.id_cabang) as jumlah_cabang');
        $this->db->from('pemilik pm');
        $this->db->join('cabang c', 'pm.id_pemilik = c.id_pemilik AND c.deleted_at IS NULL', 'left');
        $this->db->where('pm.deleted_at IS NULL');
        $this->db->group_by('pm.id_pemilik');
        $this->db->order_by('jumlah_cabang', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
    
    /**
     * Get layanan summary
     */
    public function getLayananSummary() {
        $this->db->select('l.*, c.nama_cabang, pm.nama_usaha');
        $this->db->from('layanan l');
        $this->db->join('cabang c', 'l.id_cabang = c.id_cabang', 'left');
        $this->db->join('pemilik pm', 'c.id_pemilik = pm.id_pemilik', 'left');
        $this->db->where('l.deleted_at IS NULL');
        $this->db->order_by('l.created_at', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
    
    /**
     * Get pesanan stats by status
     */
    public function getPesananByStatus() {
        $this->db->select('status_pesanan as status, COUNT(*) as jumlah');
        $this->db->from('pesanan');
        $this->db->group_by('status_pesanan');
        return $this->db->get()->result();
    }
    
    /**
     * Get monthly pesanan trend
     */
    public function getMonthlyPesananTrend() {
        $this->db->select('MONTH(created_at) as bulan, YEAR(created_at) as tahun, COUNT(*) as jumlah');
        $this->db->from('pesanan');
        $this->db->where('created_at >=', date('Y-m-d', strtotime('-6 months')));
        $this->db->group_by('YEAR(created_at), MONTH(created_at)');
        $this->db->order_by('tahun', 'ASC');
        $this->db->order_by('bulan', 'ASC');
        return $this->db->get()->result();
    }
}
