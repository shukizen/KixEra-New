<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup_model extends CI_Model {
    
    private $backup_path;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbutil();
        
        // Set backup directory path
        $this->backup_path = FCPATH . 'backups/';
        
        // Create backup directory if not exists
        if (!is_dir($this->backup_path)) {
            mkdir($this->backup_path, 0755, true);
        }
    }
    
    /**
     * Create database backup
     */
    public function createBackup($filename = null) {
        // Generate filename if not provided
        if (!$filename) {
            $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        }
        
        $filepath = $this->backup_path . $filename;
        
        // Get database configuration
        $db_config = $this->db->database;
        $db_host = $this->db->hostname;
        $db_user = $this->db->username;
        $db_pass = $this->db->password;
        
        // Use mysqldump for backup
        $mysqldump_path = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';
        
        if (file_exists($mysqldump_path)) {
            // Build mysqldump command
            $command = sprintf(
                '"%s" --host=%s --user=%s %s %s > "%s"',
                $mysqldump_path,
                escapeshellarg($db_host),
                escapeshellarg($db_user),
                $db_pass ? '--password=' . escapeshellarg($db_pass) : '',
                escapeshellarg($db_config),
                $filepath
            );
            
            exec($command, $output, $return_var);
            
            if ($return_var === 0 && file_exists($filepath) && filesize($filepath) > 0) {
                return [
                    'success' => true,
                    'filename' => $filename,
                    'filepath' => $filepath,
                    'size' => filesize($filepath),
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }
        }
        
        // Fallback: Use CodeIgniter's dbutil
        $prefs = [
            'tables'        => [],                  // Array of tables to backup
            'ignore'        => [],                  // List of tables to omit
            'format'        => 'txt',               // gzip, zip, txt
            'filename'      => $filename,
            'add_drop'      => TRUE,                // Add DROP TABLE statements
            'add_insert'    => TRUE,                // Add INSERT statements
            'newline'       => "\n",                // Newline character
            'foreign_key_checks' => FALSE           // Disable foreign key checks
        ];
        
        $backup = $this->dbutil->backup($prefs);
        
        if ($backup) {
            // Write to file
            $this->load->helper('file');
            if (write_file($filepath, $backup)) {
                return [
                    'success' => true,
                    'filename' => $filename,
                    'filepath' => $filepath,
                    'size' => filesize($filepath),
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }
        }
        
        return ['success' => false, 'error' => 'Gagal membuat backup'];
    }
    
    /**
     * Restore database from backup file
     */
    public function restoreBackup($filename) {
        $filepath = $this->backup_path . $filename;
        
        if (!file_exists($filepath)) {
            return ['success' => false, 'error' => 'File backup tidak ditemukan'];
        }
        
        // Read SQL file
        $sql = file_get_contents($filepath);
        
        if (empty($sql)) {
            return ['success' => false, 'error' => 'File backup kosong'];
        }
        
        // Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        
        // Split SQL into statements
        $statements = $this->parseSqlStatements($sql);
        $executed = 0;
        $errors = [];
        
        foreach ($statements as $statement) {
            $statement = trim($statement);
            if (!empty($statement)) {
                try {
                    if ($this->db->query($statement)) {
                        $executed++;
                    }
                } catch (Exception $e) {
                    $errors[] = $e->getMessage();
                }
            }
        }
        
        // Re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
        
        return [
            'success' => true,
            'executed' => $executed,
            'errors' => $errors
        ];
    }
    
    /**
     * Parse SQL file into individual statements
     */
    private function parseSqlStatements($sql) {
        // Remove comments
        $sql = preg_replace('/--.*$/m', '', $sql);
        $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);
        
        // Split by semicolon
        $statements = [];
        $current = '';
        $lines = explode("\n", $sql);
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            $current .= ' ' . $line;
            
            if (substr($line, -1) === ';') {
                $statements[] = trim($current);
                $current = '';
            }
        }
        
        if (!empty(trim($current))) {
            $statements[] = trim($current);
        }
        
        return $statements;
    }
    
    /**
     * Get list of backup files
     */
    public function getBackups() {
        $backups = [];
        
        if (is_dir($this->backup_path)) {
            $files = scandir($this->backup_path);
            
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                    $filepath = $this->backup_path . $file;
                    $backups[] = (object)[
                        'filename' => $file,
                        'size' => filesize($filepath),
                        'created_at' => date('Y-m-d H:i:s', filemtime($filepath))
                    ];
                }
            }
            
            // Sort by date descending
            usort($backups, function($a, $b) {
                return strtotime($b->created_at) - strtotime($a->created_at);
            });
        }
        
        return $backups;
    }
    
    /**
     * Delete a backup file
     */
    public function deleteBackup($filename) {
        $filepath = $this->backup_path . $filename;
        
        // Security check - prevent directory traversal
        if (strpos($filename, '..') !== false || strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
            return ['success' => false, 'error' => 'Nama file tidak valid'];
        }
        
        if (file_exists($filepath) && pathinfo($filepath, PATHINFO_EXTENSION) === 'sql') {
            if (unlink($filepath)) {
                return ['success' => true];
            }
        }
        
        return ['success' => false, 'error' => 'Gagal menghapus file'];
    }
    
    /**
     * Get database statistics
     */
    public function getDbStats() {
        $stats = [];
        
        // Get database size
        $query = $this->db->query("
            SELECT 
                table_schema AS 'database',
                ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS 'size_mb'
            FROM information_schema.TABLES 
            WHERE table_schema = ?
            GROUP BY table_schema
        ", [$this->db->database]);
        
        $result = $query->row();
        $stats['database_size'] = $result ? $result->size_mb . ' MB' : '0 MB';
        
        // Get table count
        $query = $this->db->query("
            SELECT COUNT(*) as table_count 
            FROM information_schema.TABLES 
            WHERE table_schema = ?
        ", [$this->db->database]);
        
        $result = $query->row();
        $stats['table_count'] = $result ? $result->table_count : 0;
        
        // Get backup directory size
        $backups = $this->getBackups();
        $total_size = 0;
        foreach ($backups as $backup) {
            $total_size += $backup->size;
        }
        $stats['backup_size'] = round($total_size / 1024 / 1024, 2) . ' MB';
        $stats['backup_count'] = count($backups);
        
        return $stats;
    }
    
    /**
     * Get backup file path
     */
    public function getBackupPath() {
        return $this->backup_path;
    }
}
