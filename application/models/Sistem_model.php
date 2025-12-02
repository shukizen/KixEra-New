<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistem_model extends CI_Model {
    
    private $table_log = 'log_aktivitas';
    private $table_backup = 'backup_data';
    private $table_konten = 'konten';
    
    public function __construct() {
        parent::__construct();
    }
    
    // ========== LOG AKTIVITAS ==========
    
    // Insert log
    public function insertLog($data) {
        $data['ip_address'] = $this->input->ip_address();
        $data['user_agent'] = $this->input->user_agent();
        $data['tgl_aktivitas'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table_log, $data);
    }
    
    // Get logs by user
    public function getLogsByUser($id_user, $limit = 100) {
        $this->db->where('id_user', $id_user);
        $this->db->order_by('tgl_aktivitas', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get($this->table_log);
        return $query->result();
    }
    
    // Get all logs (admin)
    public function getAllLogs($start_date = null, $end_date = null, $limit = 500) {
        $this->db->select('log_aktivitas.*, users.username, users.role');
        $this->db->from($this->table_log);
        $this->db->join('users', 'users.id_user = log_aktivitas.id_user', 'left');
        
        if ($start_date && $end_date) {
            $this->db->where('DATE(log_aktivitas.tgl_aktivitas) >=', $start_date);
            $this->db->where('DATE(log_aktivitas.tgl_aktivitas) <=', $end_date);
        }
        
        $this->db->order_by('log_aktivitas.tgl_aktivitas', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }
    
    // Filter logs
    public function filterLogs($filters) {
        $this->db->select('log_aktivitas.*, users.username, users.role');
        $this->db->from($this->table_log);
        $this->db->join('users', 'users.id_user = log_aktivitas.id_user', 'left');
        
        if (isset($filters['id_user'])) {
            $this->db->where('log_aktivitas.id_user', $filters['id_user']);
        }
        
        if (isset($filters['aktivitas'])) {
            $this->db->like('log_aktivitas.aktivitas', $filters['aktivitas']);
        }
        
        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            $this->db->where('DATE(log_aktivitas.tgl_aktivitas) >=', $filters['start_date']);
            $this->db->where('DATE(log_aktivitas.tgl_aktivitas) <=', $filters['end_date']);
        }
        
        $this->db->order_by('log_aktivitas.tgl_aktivitas', 'DESC');
        $this->db->limit($filters['limit'] ?? 100);
        $query = $this->db->get();
        return $query->result();
    }
    
    // ========== BACKUP DATA ==========
    
    // Get all backups
    public function getAllBackups() {
        $this->db->select('backup_data.*, owner.nama_usaha, admin.nama as nama_admin');
        $this->db->from($this->table_backup);
        $this->db->join('owner', 'owner.id_owner = backup_data.id_owner', 'left');
        $this->db->join('admin', 'admin.id_admin = backup_data.id_admin', 'left');
        $this->db->where('backup_data.deleted_at IS NULL');
        $this->db->order_by('backup_data.tgl_backup', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Insert backup record
    public function insertBackup($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table_backup, $data);
    }
    
    // Delete backup
    public function deleteBackup($id_backup) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_backup', $id_backup);
        return $this->db->update($this->table_backup, $data);
    }
    
    // Get backup by ID
    public function getBackupById($id_backup) {
        $this->db->where('id_backup', $id_backup);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_backup);
        return $query->row();
    }
    
    // ========== KONTEN ==========
    
    // Get all published content
    public function getPublishedContent($jenis = null) {
        $this->db->where('status', 'publish');
        if ($jenis) {
            $this->db->where('jenis_konten', $jenis);
        }
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('urutan', 'ASC');
        $query = $this->db->get($this->table_konten);
        return $query->result();
    }
    
    // Get all content (admin)
    public function getAllContent() {
        $this->db->select('konten.*, admin.nama as nama_admin');
        $this->db->from($this->table_konten);
        $this->db->join('admin', 'admin.id_admin = konten.id_admin', 'left');
        $this->db->where('konten.deleted_at IS NULL');
        $this->db->order_by('konten.updated_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get content by ID
    public function getContentById($id_konten) {
        $this->db->where('id_konten', $id_konten);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_konten);
        return $query->row();
    }
    
    // Insert content
    public function insertContent($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table_konten, $data);
    }
    
    // Update content
    public function updateContent($id_konten, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_konten', $id_konten);
        return $this->db->update($this->table_konten, $data);
    }
    
    // Delete content
    public function deleteContent($id_konten) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_konten', $id_konten);
        return $this->db->update($this->table_konten, $data);
    }
}
?>