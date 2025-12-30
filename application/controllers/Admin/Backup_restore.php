<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup_restore extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Backup_model');
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }

    /**
     * Main backup/restore page
     */
    public function index()
    {
        $data['page_title'] = 'Backup & Restore - KixEra';
        $data['user'] = $this->auth_library->get_user();
        $data['stats'] = $this->Backup_model->getDbStats();
        $data['backups'] = $this->Backup_model->getBackups();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/backup_restore/index', $data);
        $this->load->view('template/footer');
    }

    /**
     * Create new backup (AJAX)
     */
    public function create_backup()
    {
        header('Content-Type: application/json');
        
        $result = $this->Backup_model->createBackup();
        
        if ($result['success']) {
            // Log activity
            $this->logActivity('backup', 'Membuat backup database: ' . $result['filename']);
            
            echo json_encode([
                'success' => true,
                'message' => 'Backup berhasil dibuat',
                'data' => $result
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => $result['error'] ?? 'Gagal membuat backup'
            ]);
        }
    }

    /**
     * Restore from backup (AJAX)
     */
    public function restore_backup()
    {
        header('Content-Type: application/json');
        
        $filename = $this->input->post('filename');
        
        if (empty($filename)) {
            echo json_encode([
                'success' => false,
                'message' => 'Nama file tidak valid'
            ]);
            return;
        }
        
        $result = $this->Backup_model->restoreBackup($filename);
        
        if ($result['success']) {
            // Log activity
            $this->logActivity('restore', 'Restore database dari: ' . $filename);
            
            echo json_encode([
                'success' => true,
                'message' => 'Restore berhasil. ' . $result['executed'] . ' statement dieksekusi.',
                'data' => $result
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => $result['error'] ?? 'Gagal restore database'
            ]);
        }
    }

    /**
     * Delete backup file (AJAX)
     */
    public function delete_backup()
    {
        header('Content-Type: application/json');
        
        $filename = $this->input->post('filename');
        
        if (empty($filename)) {
            echo json_encode([
                'success' => false,
                'message' => 'Nama file tidak valid'
            ]);
            return;
        }
        
        $result = $this->Backup_model->deleteBackup($filename);
        
        if ($result['success']) {
            // Log activity
            $this->logActivity('delete_backup', 'Menghapus backup: ' . $filename);
            
            echo json_encode([
                'success' => true,
                'message' => 'Backup berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => $result['error'] ?? 'Gagal menghapus backup'
            ]);
        }
    }

    /**
     * Download backup file
     */
    public function download($filename)
    {
        $filepath = $this->Backup_model->getBackupPath() . $filename;
        
        // Security check
        if (strpos($filename, '..') !== false || !file_exists($filepath)) {
            show_404();
            return;
        }
        
        // Log activity
        $this->logActivity('download_backup', 'Mengunduh backup: ' . $filename);
        
        // Force download
        $this->load->helper('download');
        force_download($filename, file_get_contents($filepath));
    }

    /**
     * Upload backup file (AJAX)
     */
    public function upload_backup()
    {
        header('Content-Type: application/json');
        
        if (!isset($_FILES['backup_file'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Tidak ada file yang diupload'
            ]);
            return;
        }
        
        $config['upload_path'] = $this->Backup_model->getBackupPath();
        $config['allowed_types'] = 'sql';
        $config['max_size'] = 50000; // 50MB
        $config['file_name'] = 'upload_' . date('Y-m-d_H-i-s') . '.sql';
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('backup_file')) {
            $upload_data = $this->upload->data();
            
            // Log activity
            $this->logActivity('upload_backup', 'Mengupload backup: ' . $upload_data['file_name']);
            
            echo json_encode([
                'success' => true,
                'message' => 'File berhasil diupload',
                'filename' => $upload_data['file_name']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => $this->upload->display_errors('', '')
            ]);
        }
    }

    /**
     * Get backups list (AJAX)
     */
    public function get_backups()
    {
        header('Content-Type: application/json');
        
        $backups = $this->Backup_model->getBackups();
        
        echo json_encode([
            'success' => true,
            'data' => $backups
        ]);
    }

    /**
     * Get stats (AJAX)
     */
    public function get_stats()
    {
        header('Content-Type: application/json');
        
        $stats = $this->Backup_model->getDbStats();
        
        echo json_encode([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Log activity helper
     */
    private function logActivity($activity, $description)
    {
        $user = $this->auth_library->get_user();
        
        $this->db->insert('activity_log', [
            'id_user' => $user->id_user ?? 0,
            'activity' => $activity,
            'description' => $description,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
