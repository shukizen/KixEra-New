<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    // ========== DASHBOARD STATISTICS ==========
    
    // Get dashboard statistics for owner
    public function getDashboardStats($id_owner) {
        $stats = [];
        
        // Total pesanan hari ini
        $this->db->where('id_owner', $id_owner);
        $this->db->where('DATE(tgl_masuk)', date('Y-m-d'));
        $this->db->where('deleted_at IS NULL');
        $stats['pesanan_hari_ini'] = $this->db->count_all_results('pesanan');
        
        // Pesanan aktif (dalam proses)
        $this->db->where('id_owner', $id_owner);
        $this->db->where_in('status_pesanan', ['diterima', 'dalam_proses']);
        $this->db->where('deleted_at IS NULL');
        $stats['pesanan_aktif'] = $this->db->count_all_results('pesanan');
        
        // Total pelanggan
        $this->db->select('COUNT(DISTINCT pesanan.id_pelanggan) as total');
        $this->db->from('pesanan');
        $this->db->where('id_owner', $id_owner);
        $this->db->where('pesanan.deleted_at IS NULL');
        $query = $this->db->get();
        $stats['total_pelanggan'] = $query->row()->total;
        
        // Pendapatan bulan ini
        $this->db->select_sum('jumlah');
        $this->db->where('id_owner', $id_owner);
        $this->db->where('MONTH(tgl_transaksi)', date('m'));
        $this->db->where('YEAR(tgl_transaksi)', date('Y'));
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get('pemasukan');
        $stats['pendapatan_bulan_ini'] = $query->row()->jumlah ?? 0;
        
        // Pengeluaran bulan ini
        $this->db->select_sum('jumlah');
        $this->db->where('id_owner', $id_owner);
        $this->db->where('MONTH(tgl_transaksi)', date('m'));
        $this->db->where('YEAR(tgl_transaksi)', date('Y'));
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get('pengeluaran');
        $stats['pengeluaran_bulan_ini'] = $query->row()->jumlah ?? 0;
        
        // Laba bulan ini
        $stats['laba_bulan_ini'] = $stats['pendapatan_bulan_ini'] - $stats['pengeluaran_bulan_ini'];
        
        // Item stok menipis
        $this->db->where('id_owner', $id_owner);
        $this->db->where('stok_tersedia < stok_minimal');
        $this->db->where('deleted_at IS NULL');
        $stats['stok_menipis'] = $this->db->count_all_results('inventori');
        
        // Notifikasi belum dibaca
        $this->db->where('id_owner', $id_owner);
        $this->db->where('status', 'terkirim');
        $this->db->where('deleted_at IS NULL');
        $stats['notifikasi_unread'] = $this->db->count_all_results('notifikasi');
        
        return $stats;
    }
    
    // ========== CHART DATA ==========
    
    // Get monthly revenue chart data
    public function getMonthlyRevenue($id_owner, $year = null) {
        if (!$year) $year = date('Y');
        
        $this->db->select('MONTH(tgl_transaksi) as bulan, SUM(jumlah) as total');
        $this->db->where('id_owner', $id_owner);
        $this->db->where('YEAR(tgl_transaksi)', $year);
        $this->db->where('deleted_at IS NULL');
        $this->db->group_by('MONTH(tgl_transaksi)');
        $this->db->order_by('bulan', 'ASC');
        $query = $this->db->get('pemasukan');
        return $query->result();
    }
    
    // Get pesanan statistics by status
    public function getPesananStatsByStatus($id_owner) {
        $query = $this->db->query("
            SELECT 
                status_pesanan,
                COUNT(*) as jumlah
            FROM pesanan
            WHERE id_owner = ? AND deleted_at IS NULL
            GROUP BY status_pesanan
        ", [$id_owner]);
        
        return $query->result();
    }
    
    // ========== LAPORAN ==========
    
    // Laporan keuangan bulanan
    public function getLaporanKeuanganBulanan($id_owner, $bulan, $tahun) {
        $query = $this->db->query("
            SELECT 
                DATE(tgl_transaksi) as tanggal,
                SUM(CASE WHEN kategori = 'pesanan' THEN jumlah ELSE 0 END) as pemasukan_pesanan,
                SUM(CASE WHEN kategori = 'lainnya' THEN jumlah ELSE 0 END) as pemasukan_lainnya,
                (SELECT SUM(jumlah) FROM pengeluaran 
                 WHERE id_owner = ? AND DATE(tgl_transaksi) = DATE(pemasukan.tgl_transaksi) 
                 AND deleted_at IS NULL) as pengeluaran_total
            FROM pemasukan
            WHERE id_owner = ? 
            AND MONTH(tgl_transaksi) = ? 
            AND YEAR(tgl_transaksi) = ?
            AND deleted_at IS NULL
            GROUP BY DATE(tgl_transaksi)
            ORDER BY tgl_transaksi ASC
        ", [$id_owner, $id_owner, $bulan, $tahun]);
        
        return $query->result();
    }
    
    // Laporan pesanan per periode
    public function getLaporanPesanan($id_owner, $start_date, $end_date) {
        $this->db->select('pesanan.*, pelanggan.nama as nama_pelanggan, 
                          layanan.nama_layanan, karyawan.nama as nama_karyawan');
        $this->db->from('pesanan');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left');
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = pesanan.id_karyawan', 'left');
        $this->db->where('pesanan.id_owner', $id_owner);
        $this->db->where('DATE(pesanan.tgl_masuk) >=', $start_date);
        $this->db->where('DATE(pesanan.tgl_masuk) <=', $end_date);
        $this->db->where('pesanan.deleted_at IS NULL');
        $this->db->order_by('pesanan.tgl_masuk', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Laporan performa karyawan
    public function getLaporanPerformaKaryawan($id_owner, $start_date, $end_date) {
        $query = $this->db->query("
            SELECT 
                k.id_karyawan,
                k.nama,
                k.jabatan,
                COUNT(DISTINCT p.id_pesanan) as total_pesanan,
                COUNT(DISTINCT CASE WHEN p.status_pesanan = 'sudah_diambil' THEN p.id_pesanan END) as pesanan_selesai,
                SUM(p.total_harga) as total_revenue,
                AVG(TIMESTAMPDIFF(HOUR, p.tgl_masuk, p.tgl_selesai)) as avg_waktu_pengerjaan
            FROM karyawan k
            LEFT JOIN pesanan p ON p.id_karyawan = k.id_karyawan 
                AND DATE(p.tgl_masuk) >= ? AND DATE(p.tgl_masuk) <= ?
                AND p.deleted_at IS NULL
            WHERE k.id_owner = ? AND k.deleted_at IS NULL
            GROUP BY k.id_karyawan
            ORDER BY total_pesanan DESC
        ", [$start_date, $end_date, $id_owner]);
        
        return $query->result();
    }
    
    // Get top services
    public function getTopServices($id_owner, $limit = 5) {
        $query = $this->db->query("
            SELECT 
                l.id_layanan,
                l.nama_layanan,
                l.harga,
                COUNT(p.id_pesanan) as total_pesanan,
                SUM(p.total_harga) as total_pendapatan
            FROM layanan l
            LEFT JOIN pesanan p ON p.id_layanan = l.id_layanan AND p.deleted_at IS NULL
            WHERE l.id_owner = ? AND l.deleted_at IS NULL
            GROUP BY l.id_layanan
            ORDER BY total_pesanan DESC
            LIMIT ?
        ", [$id_owner, $limit]);
        
        return $query->result();
    }
}

?>
