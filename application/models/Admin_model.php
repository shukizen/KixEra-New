<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model {
    
    private $table = 'admin';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Get admin by user ID
    public function getAdminByUserId($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    // Get all admins
    public function getAllAdmins() {
        $this->db->select('admin.*, users.username, users.status');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id_user = admin.id_user', 'left');
        $this->db->where('admin.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Insert admin
    public function insertAdmin($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }
    
    // Update admin
    public function updateAdmin($id_admin, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_admin', $id_admin);
        return $this->db->update($this->table, $data);
    }

    // ========================================
    // DASHBOARD STATISTICS & ANALYTICS
    // ========================================

    /**
     * Get main dashboard statistics
     */
    public function get_main_statistics() {
        $stats = array();
        
        // Total Pemilik (Business Owners)
        $this->db->where('deleted_at IS NULL');
        $stats['total_pemilik'] = $this->db->count_all_results('pemilik');
        
        // Total Pemilik Active (with active subscription)
        $this->db->where('status_langganan', 'aktif');
        $this->db->where('deleted_at IS NULL');
        $stats['total_pemilik_active'] = $this->db->count_all_results('pemilik');
        
        // Total Revenue (from subscription transactions)
        $this->db->select_sum('jumlah_bayar');
        $this->db->where('status_pembayaran', 'sukses');
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get('transaksi_langganan');
        $result = $query->row();
        $stats['total_revenue'] = $result->jumlah_bayar ?? 0;
        
        // Monthly Revenue (current month)
        $this->db->select_sum('jumlah_bayar');
        $this->db->where('status_pembayaran', 'sukses');
        $this->db->where('MONTH(tgl_transaksi)', date('m'));
        $this->db->where('YEAR(tgl_transaksi)', date('Y'));
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get('transaksi_langganan');
        $result = $query->row();
        $stats['monthly_revenue'] = $result->jumlah_bayar ?? 0;
        
        // Pending Transactions
        $this->db->where('status_pembayaran', 'pending');
        $this->db->where('deleted_at IS NULL');
        $stats['pending_transactions'] = $this->db->count_all_results('transaksi_langganan');
        
        // Total Cabang
        $this->db->where('deleted_at IS NULL');
        $stats['total_cabang'] = $this->db->count_all_results('cabang');
        
        // Total Karyawan
        $this->db->where('deleted_at IS NULL');
        $stats['total_karyawan'] = $this->db->count_all_results('karyawan');
        
        // Total Pesanan (All orders in system)
        $this->db->where('deleted_at IS NULL');
        $stats['total_pesanan'] = $this->db->count_all_results('pesanan');
        
        // Calculate growth percentages (compare with last month)
        $stats['growth'] = $this->calculate_growth_percentages();
        
        return $stats;
    }
    
    /**
     * Calculate growth percentages
     */
    private function calculate_growth_percentages() {
        $growth = array();
        
        // Revenue growth
        $current_month_revenue = $this->get_revenue_by_month(date('Y'), date('m'));
        $last_month_revenue = $this->get_revenue_by_month(date('Y'), date('m', strtotime('-1 month')));
        
        if ($last_month_revenue > 0) {
            $growth['revenue'] = round((($current_month_revenue - $last_month_revenue) / $last_month_revenue) * 100, 1);
        } else {
            $growth['revenue'] = 0;
        }
        
        // User growth
        $current_month_users = $this->get_users_by_month(date('Y'), date('m'));
        $last_month_users = $this->get_users_by_month(date('Y'), date('m', strtotime('-1 month')));
        
        if ($last_month_users > 0) {
            $growth['users'] = round((($current_month_users - $last_month_users) / $last_month_users) * 100, 1);
        } else {
            $growth['users'] = $current_month_users > 0 ? 100 : 0;
        }
        
        return $growth;
    }
    
    /**
     * Get revenue by specific month
     */
    private function get_revenue_by_month($year, $month) {
        $this->db->select_sum('jumlah_bayar');
        $this->db->where('status_pembayaran', 'sukses');
        $this->db->where('YEAR(tgl_transaksi)', $year);
        $this->db->where('MONTH(tgl_transaksi)', $month);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get('transaksi_langganan');
        $result = $query->row();
        return $result->jumlah_bayar ?? 0;
    }
    
    /**
     * Get new users by specific month
     */
    private function get_users_by_month($year, $month) {
        $this->db->where('YEAR(created_at)', $year);
        $this->db->where('MONTH(created_at)', $month);
        $this->db->where('deleted_at IS NULL');
        return $this->db->count_all_results('pemilik');
    }
    
    /**
     * Get subscription analytics
     */
    public function get_subscription_analytics() {
        $analytics = array(
            'aktif' => 0,
            'nonaktif' => 0,
            'trial' => 0,
            'by_package' => array(),
            'expiring_soon' => 0
        );
        
        // Count by subscription status
        $this->db->select('status_langganan, COUNT(*) as count');
        $this->db->where('deleted_at IS NULL');
        $this->db->group_by('status_langganan');
        $query = $this->db->get('pemilik');
        
        foreach ($query->result() as $row) {
            $analytics[$row->status_langganan] = $row->count;
        }
        
        // Count by package
        $this->db->select('pl.nama_paket, COUNT(DISTINCT p.id_pemilik) as count');
        $this->db->from('pemilik p');
        $this->db->join('transaksi_langganan tl', 'p.id_pemilik = tl.id_pemilik AND tl.status_pembayaran = "sukses"', 'left');
        $this->db->join('paket_langganan pl', 'tl.id_paket = pl.id_paket', 'left');
        $this->db->where('p.deleted_at IS NULL');
        $this->db->where('tl.deleted_at IS NULL');
        $this->db->group_by('pl.nama_paket');
        $query = $this->db->get();
        
        $analytics['by_package'] = array();
        foreach ($query->result() as $row) {
            if ($row->nama_paket) {
                $analytics['by_package'][$row->nama_paket] = $row->count;
            }
        }
        
        // Expiring soon (within 7 days)
        $this->db->select('COUNT(DISTINCT p.id_pemilik) as count');
        $this->db->from('pemilik p');
        $this->db->join('transaksi_langganan tl', 'p.id_pemilik = tl.id_pemilik AND tl.status_pembayaran = "sukses"', 'left');
        $this->db->where('p.status_langganan', 'aktif');
        $this->db->where('p.deleted_at IS NULL');
        $this->db->where('DATEDIFF(tl.tgl_akhir_langganan, CURDATE()) <= 7');
        $this->db->where('DATEDIFF(tl.tgl_akhir_langganan, CURDATE()) > 0');
        $result = $this->db->get()->row();
        $analytics['expiring_soon'] = $result ? $result->count : 0;
        
        return $analytics;
    }
    
    /**
     * Get revenue data for charts
     */
    public function get_revenue_data() {
        // Get last 6 months revenue
        $data = array(
            'labels' => array(),
            'values' => array()
        );
        
        for ($i = 5; $i >= 0; $i--) {
            $date = strtotime("-$i month");
            $year = date('Y', $date);
            $month = date('m', $date);
            $month_name = date('M', $date);
            
            $revenue = $this->get_revenue_by_month($year, $month);
            
            $data['labels'][] = $month_name;
            $data['values'][] = $revenue;
        }
        
        return $data;
    }
    
    /**
     * Get recent transactions
     */
    public function get_recent_transactions($limit = 10) {
        $this->db->select('tl.*, pm.nama_usaha, pm.nama as nama_pemilik, pl.nama_paket');
        $this->db->from('transaksi_langganan tl');
        $this->db->join('pemilik pm', 'tl.id_pemilik = pm.id_pemilik');
        $this->db->join('paket_langganan pl', 'tl.id_paket = pl.id_paket');
        $this->db->where('tl.deleted_at IS NULL');
        $this->db->order_by('tl.tgl_transaksi', 'DESC');
        $this->db->limit($limit);
        
        return $this->db->get()->result();
    }
    
    /**
     * Get system alerts
     */
    public function get_system_alerts() {
        $alerts = array();
        
        // Pending payments alert
        $this->db->where('status_pembayaran', 'pending');
        $this->db->where('deleted_at IS NULL');
        $pending_count = $this->db->count_all_results('transaksi_langganan');
        
        if ($pending_count > 0) {
            $alerts[] = array(
                'type' => 'warning',
                'icon' => 'fa-clock',
                'title' => 'Pembayaran Pending',
                'message' => "$pending_count transaksi menunggu konfirmasi pembayaran",
                'link' => base_url('admin/penagihan')
            );
        }
        
        // Expiring subscriptions
        $this->db->select('COUNT(*) as count');
        $this->db->from('pemilik p');
        $this->db->join('transaksi_langganan tl', 'p.id_pemilik = tl.id_pemilik AND tl.status_pembayaran = "sukses"', 'left');
        $this->db->where('p.status_langganan', 'aktif');
        $this->db->where('p.deleted_at IS NULL');
        $this->db->where('DATEDIFF(tl.tgl_akhir_langganan, CURDATE()) <= 7');
        $this->db->where('DATEDIFF(tl.tgl_akhir_langganan, CURDATE()) > 0');
        $expiring = $this->db->get()->row()->count;
        
        if ($expiring > 0) {
            $alerts[] = array(
                'type' => 'info',
                'icon' => 'fa-calendar-times',
                'title' => 'Langganan Akan Berakhir',
                'message' => "$expiring langganan akan berakhir dalam 7 hari",
                'link' => base_url('admin/paket_langganan')
            );
        }
        
        // New registrations today
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        $this->db->where('deleted_at IS NULL');
        $new_today = $this->db->count_all_results('pemilik');
        
        if ($new_today > 0) {
            $alerts[] = array(
                'type' => 'success',
                'icon' => 'fa-user-plus',
                'title' => 'Pendaftaran Baru',
                'message' => "$new_today pemilik usaha baru mendaftar hari ini",
                'link' => base_url('admin/manajemen_pengguna')
            );
        }
        
        return $alerts;
    }
    
    /**
     * Get top owners by revenue
     */
    public function get_top_owners($limit = 5) {
        $this->db->select('pm.nama_usaha, pm.nama, pm.email, SUM(tl.jumlah_bayar) as total_revenue, COUNT(tl.id_transaksi_langganan) as transaction_count');
        $this->db->from('pemilik pm');
        $this->db->join('transaksi_langganan tl', 'pm.id_pemilik = tl.id_pemilik AND tl.status_pembayaran = "sukses"');
        $this->db->where('pm.deleted_at IS NULL');
        $this->db->where('tl.deleted_at IS NULL');
        $this->db->group_by('pm.id_pemilik');
        $this->db->order_by('total_revenue', 'DESC');
        $this->db->limit($limit);
        
        return $this->db->get()->result();
    }
    
    /**
     * Get monthly growth data
     */
    public function get_monthly_growth() {
        $growth = array();
        
        // Get new users per month (last 6 months)
        for ($i = 5; $i >= 0; $i--) {
            $date = strtotime("-$i month");
            $year = date('Y', $date);
            $month = date('m', $date);
            $month_name = date('M', $date);
            
            $count = $this->get_users_by_month($year, $month);
            
            $growth['labels'][] = $month_name;
            $growth['values'][] = $count;
        }
        
        return $growth;
    }
    
    /**
     * Get package distribution
     */
    public function get_package_distribution() {
        $this->db->select('pl.nama_paket, COUNT(DISTINCT tl.id_pemilik) as count');
        $this->db->from('transaksi_langganan tl');
        $this->db->join('paket_langganan pl', 'tl.id_paket = pl.id_paket');
        $this->db->where('tl.status_pembayaran', 'sukses');
        $this->db->where('tl.deleted_at IS NULL');
        $this->db->group_by('pl.id_paket');
        
        $result = $this->db->get()->result();
        
        $distribution = array(
            'labels' => array(),
            'values' => array()
        );
        
        foreach ($result as $row) {
            $distribution['labels'][] = $row->nama_paket;
            $distribution['values'][] = $row->count;
        }
        
        return $distribution;
    }

}
?>