<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_sistem_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get activity logs with filtering
     */
    public function getActivityLogs($filters = [], $limit = 50) {
        $this->db->select('al.*, u.username, u.role');
        $this->db->from('activity_log al');
        $this->db->join('users u', 'al.id_user = u.id_user', 'left');
        
        if (isset($filters['type']) && !empty($filters['type'])) {
            $this->db->where('al.activity', $filters['type']);
        }
        
        if (isset($filters['search']) && !empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('al.description', $filters['search']);
            $this->db->or_like('u.username', $filters['search']);
            $this->db->or_like('al.activity', $filters['search']);
            $this->db->group_end();
        }
        
        if (isset($filters['date_from']) && !empty($filters['date_from'])) {
            $this->db->where('DATE(al.created_at) >=', $filters['date_from']);
        }
        
        if (isset($filters['date_to']) && !empty($filters['date_to'])) {
            $this->db->where('DATE(al.created_at) <=', $filters['date_to']);
        }
        
        $this->db->order_by('al.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * Get system statistics
     */
    public function getSystemStats() {
        // Total users
        $this->db->where('deleted_at IS NULL');
        $total_users = $this->db->count_all_results('users');
        
        // Active users today
        $this->db->where('deleted_at IS NULL');
        $this->db->where('DATE(updated_at)', date('Y-m-d'));
        $active_today = $this->db->count_all_results('users');
        
        // Total pemilik
        $this->db->where('deleted_at IS NULL');
        $total_pemilik = $this->db->count_all_results('pemilik');
        
        // Active subscriptions
        $this->db->where('deleted_at IS NULL');
        $this->db->where('status_pembayaran', 'sukses');
        $this->db->where('tgl_akhir_langganan >=', date('Y-m-d'));
        $active_subscriptions = $this->db->count_all_results('transaksi_langganan');
        
        // Total activity logs today
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        $logs_today = $this->db->count_all_results('activity_log');
        
        // Total activity logs this week
        $this->db->where('created_at >=', date('Y-m-d', strtotime('-7 days')));
        $logs_week = $this->db->count_all_results('activity_log');
        
        return [
            'total_users' => $total_users,
            'active_today' => $active_today,
            'total_pemilik' => $total_pemilik,
            'active_subscriptions' => $active_subscriptions,
            'logs_today' => $logs_today,
            'logs_week' => $logs_week
        ];
    }
    
    /**
     * Get activity types for filter
     */
    public function getActivityTypes() {
        $this->db->select('DISTINCT(activity) as type');
        $this->db->from('activity_log');
        $this->db->where('activity IS NOT NULL');
        $this->db->order_by('activity', 'ASC');
        return $this->db->get()->result();
    }
    
    /**
     * Get server info
     */
    public function getServerInfo() {
        return [
            'php_version' => phpversion(),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'mysql_version' => $this->db->query('SELECT VERSION() as version')->row()->version,
            'max_upload_size' => ini_get('upload_max_filesize'),
            'max_post_size' => ini_get('post_max_size'),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time'),
            'codeigniter_version' => CI_VERSION,
            'server_time' => date('Y-m-d H:i:s'),
            'timezone' => date_default_timezone_get()
        ];
    }
    
    /**
     * Get database info
     */
    public function getDatabaseInfo() {
        // Get database size
        $db_name = $this->db->database;
        $query = $this->db->query("SELECT 
            ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb 
            FROM information_schema.TABLES 
            WHERE table_schema = ?", [$db_name]);
        $db_size = $query->row()->size_mb ?? 0;
        
        // Count tables
        $tables_query = $this->db->query("SELECT COUNT(*) as count FROM information_schema.TABLES WHERE table_schema = ?", [$db_name]);
        $table_count = $tables_query->row()->count ?? 0;
        
        return [
            'database_name' => $db_name,
            'database_size' => $db_size . ' MB',
            'table_count' => $table_count
        ];
    }
    
    /**
     * Get login history (last 10 logins)
     */
    public function getLoginHistory($limit = 10) {
        $this->db->select('al.*, u.username, u.role');
        $this->db->from('activity_log al');
        $this->db->join('users u', 'al.id_user = u.id_user', 'left');
        $this->db->where('al.activity_type', 'login');
        $this->db->order_by('al.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * Delete old logs
     */
    public function deleteOldLogs($days = 30) {
        $this->db->where('created_at <', date('Y-m-d H:i:s', strtotime("-{$days} days")));
        $affected = $this->db->delete('activity_log');
        return $this->db->affected_rows();
    }
}
