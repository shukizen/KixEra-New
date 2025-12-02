<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Termin Service
 * Handles all termin-related business logic
 */
class Termin_service {
    
    private $CI;
    private $termin_schema;
    
    public function __construct() 
    {
        $this->CI =& get_instance();
        $this->CI->load->model(['Proyek_model', 'Termin_model']);
        $this->CI->load->database();
        
        // Load termin schema from config
        $this->termin_schema = $this->get_termin_schema();
    }
    
    /**
     * Get standardized termin schema
     */
    private function get_termin_schema()
    {
        return [
            1 => [
                'name' => 'SPH + Design',
                'payment_percent' => 5.00,
                'modal_percent' => 70.00,
                'margin_percent' => 30.00,
                'description' => 'Survey, Penawaran Harga, dan Desain'
            ],
            2 => [
                'name' => 'Kedatangan Material',
                'payment_percent' => 25.00,
                'modal_percent' => 70.00,
                'margin_percent' => 30.00,
                'description' => 'Pengadaan dan kedatangan material'
            ],
            3 => [
                'name' => 'Proses Pengerjaan',
                'payment_percent' => 35.00,
                'modal_percent' => 70.00,
                'margin_percent' => 30.00,
                'description' => 'Pelaksanaan konstruksi utama'
            ],
            4 => [
                'name' => 'Tahap Penyelesaian',
                'payment_percent' => 30.00,
                'modal_percent' => 70.00,
                'margin_percent' => 30.00,
                'description' => 'Finishing dan penyelesaian akhir'
            ],
            5 => [
                'name' => 'Garansi (Retensi)',
                'payment_percent' => 5.00,
                'modal_percent' => 30.00,
                'margin_percent' => 70.00,
                'description' => 'Masa garansi dan retensi'
            ]
        ];
    }
    
    /**
     * Create all termins for a new project
     */
    public function create_project_termins($project_id, $project_budget)
    {
        try {
            $this->CI->db->trans_start();
            
            foreach ($this->termin_schema as $termin_number => $schema) {
                $termin_data = $this->calculate_termin_amounts($project_budget, $schema);
                $termin_data['proyek_id'] = $project_id;
                $termin_data['termin'] = $termin_number;
                $termin_data['nama_termin'] = $schema['name'];
                $termin_data['status'] = 'pending';
                $termin_data['created_by'] = $this->CI->session->userdata('user_id');
                $termin_data['created_at'] = date('Y-m-d H:i:s');
                
                $this->CI->db->insert('termin_progress', $termin_data);
            }
            
            $this->CI->db->trans_complete();
            
            if ($this->CI->db->trans_status() === FALSE) {
                throw new Exception('Failed to create termins');
            }
            
            return true;
            
        } catch (Exception $e) {
            log_message('error', 'Termin Service - Create project termins error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Calculate termin financial amounts
     */
    private function calculate_termin_amounts($budget, $schema)
    {
        $payment_amount = $budget * ($schema['payment_percent'] / 100);
        $modal_amount = $payment_amount * ($schema['modal_percent'] / 100);
        $margin_amount = $payment_amount * ($schema['margin_percent'] / 100);
        
        return [
            'persentase_pembayaran' => $schema['payment_percent'],
            'jumlah_pembayaran' => $payment_amount,
            'persentase_modal' => $schema['modal_percent'],
            'persentase_margin' => $schema['margin_percent'],
            'jumlah_modal' => $modal_amount,
            'jumlah_margin' => $margin_amount
        ];
    }
    
    /**
     * Confirm termin with all business logic
     */
    public function confirm_termin($project_id, $termin_number, $user_id = null)
    {
        try {
            $this->CI->db->trans_start();
            
            // Validate inputs
            if (!$project_id || !$termin_number) {
                throw new Exception('Missing required parameters');
            }
            
            if (!isset($this->termin_schema[$termin_number])) {
                throw new Exception('Invalid termin number');
            }
            
            // Get project data
            $project = $this->CI->Proyek_model->get_project_by_id($project_id);
            if (!$project) {
                throw new Exception('Project not found');
            }
            
            // Check if termin already exists
            $existing_termin = $this->get_termin($project_id, $termin_number);
            
            if ($existing_termin && $existing_termin['status'] !== 'pending') {
                throw new Exception('Termin already processed');
            }
            
            // Calculate amounts
            $schema = $this->termin_schema[$termin_number];
            $amounts = $this->calculate_termin_amounts($project['anggaran'], $schema);
            
            // Create or update termin
            $termin_data = array_merge($amounts, [
                'nama_termin' => $schema['name'],
                'status' => 'confirmed',
                'tanggal_konfirmasi' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($existing_termin) {
                $this->CI->db->where('id', $existing_termin['id']);
                $this->CI->db->update('termin_progress', $termin_data);
                $termin_id = $existing_termin['id'];
            } else {
                $termin_data = array_merge($termin_data, [
                    'proyek_id' => $project_id,
                    'termin' => $termin_number,
                    'created_by' => $user_id ?: $this->CI->session->userdata('user_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                $this->CI->db->insert('termin_progress', $termin_data);
                $termin_id = $this->CI->db->insert_id();
            }
            
            // Record financial transactions
            $this->record_termin_transactions($project_id, $termin_number, $amounts, $user_id);
            
            $this->CI->db->trans_complete();
            
            if ($this->CI->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }
            
            // Log the action
            $this->log_termin_action($project_id, $termin_number, 'confirmed', $user_id);
            
            return [
                'success' => true,
                'termin_id' => $termin_id,
                'message' => "Termin {$termin_number} berhasil dikonfirmasi"
            ];
            
        } catch (Exception $e) {
            $this->CI->db->trans_rollback();
            log_message('error', 'Termin Service - Confirm termin error: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Record financial transactions for termin confirmation
     */
    private function record_termin_transactions($project_id, $termin_number, $amounts, $user_id)
    {
        $schema = $this->termin_schema[$termin_number];
        $current_user = $user_id ?: $this->CI->session->userdata('user_id');
        $current_date = date('Y-m-d');
        
        // Record income (payment from client)
        $income_data = [
            'proyek_id' => $project_id,
            'tanggal' => $current_date,
            'jumlah' => $amounts['jumlah_pembayaran'],
            'sumber' => "Pembayaran Termin {$termin_number} - {$schema['name']}",
            'keterangan' => "Pembayaran termin {$termin_number} ({$schema['payment_percent']}% dari anggaran)",
            'termin' => $termin_number,
            'jenis_pemasukan' => 'pembayaran_klien',
            'is_confirmed' => 1,
            'created_by' => $current_user,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->CI->db->insert('pemasukan', $income_data);
        
        // Record modal expense if applicable
        if ($amounts['jumlah_modal'] > 0) {
            $modal_data = [
                'proyek_id' => $project_id,
                'tanggal' => $current_date,
                'jumlah' => $amounts['jumlah_modal'],
                'kategori' => 'modal_proyek',
                'keterangan' => "Modal proyek termin {$termin_number} ({$schema['modal_percent']}% dari pembayaran)",
                'termin' => $termin_number,
                'jenis_pengeluaran' => 'modal_proyek',
                'is_confirmed' => 1,
                'created_by' => $current_user,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->CI->db->insert('pengeluaran', $modal_data);
        }
        
        // Record margin if applicable
        if ($amounts['jumlah_margin'] > 0) {
            $margin_data = [
                'proyek_id' => $project_id,
                'tanggal' => $current_date,
                'jumlah' => $amounts['jumlah_margin'],
                'kategori' => 'keuntungan',
                'keterangan' => "Margin keuntungan termin {$termin_number} ({$schema['margin_percent']}% dari pembayaran)",
                'termin' => $termin_number,
                'jenis_pengeluaran' => 'margin_keuntungan',
                'is_confirmed' => 1,
                'created_by' => $current_user,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->CI->db->insert('pengeluaran', $margin_data);
        }
    }
    
    /**
     * Get termin by project and termin number
     */
    private function get_termin($project_id, $termin_number)
    {
        $this->CI->db->where('proyek_id', $project_id);
        $this->CI->db->where('termin', $termin_number);
        return $this->CI->db->get('termin_progress')->row_array();
    }
    
    /**
     * Get project termin summary
     */
    public function get_project_termin_summary($project_id)
    {
        $this->CI->db->select('
            COUNT(*) as total_termin,
            SUM(CASE WHEN status = "confirmed" OR status = "completed" THEN 1 ELSE 0 END) as paid_termin,
            SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed_termin,
            SUM(CASE WHEN status = "confirmed" OR status = "completed" THEN jumlah_pembayaran ELSE 0 END) as total_paid,
            SUM(jumlah_pembayaran) as total_contract_value
        ');
        $this->CI->db->from('termin_progress');
        $this->CI->db->where('proyek_id', $project_id);
        return $this->CI->db->get()->row_array();
    }
    
    /**
     * Get next available termin for project
     */
    public function get_next_termin($project_id)
    {
        $this->CI->db->select('*');
        $this->CI->db->from('termin_progress');
        $this->CI->db->where('proyek_id', $project_id);
        $this->CI->db->where('status', 'pending');
        $this->CI->db->order_by('termin', 'ASC');
        $this->CI->db->limit(1);
        return $this->CI->db->get()->row_array();
    }
    
    /**
     * Validate termin business rules
     */
    public function validate_termin_confirmation($project_id, $termin_number)
    {
        $errors = [];
        
        // Check if previous termin is confirmed (except for termin 1)
        if ($termin_number > 1) {
            $previous_termin = $this->get_termin($project_id, $termin_number - 1);
            if (!$previous_termin || !in_array($previous_termin['status'], ['confirmed', 'completed'])) {
                $errors[] = "Termin sebelumnya harus dikonfirmasi terlebih dahulu";
            }
        }
        
        // Special validation for garansi termin (termin 5)
        if ($termin_number == 5) {
            $termin_4 = $this->get_termin($project_id, 4);
            if ($termin_4 && $termin_4['status'] == 'completed') {
                $completed_date = strtotime($termin_4['tanggal_selesai']);
                $one_month_later = strtotime('+1 month', $completed_date);
                
                if (time() < $one_month_later) {
                    $errors[] = "Termin garansi hanya dapat dikonfirmasi 1 bulan setelah termin 4 selesai";
                }
            } else {
                $errors[] = "Termin 4 harus diselesaikan terlebih dahulu";
            }
        }
        
        return $errors;
    }
    
    /**
     * Complete termin
     */
    public function complete_termin($termin_id, $user_id = null)
    {
        try {
            $termin = $this->CI->Termin_model->get_termin_by_id($termin_id);
            if (!$termin) {
                throw new Exception('Termin not found');
            }
            
            if ($termin['status'] !== 'confirmed') {
                throw new Exception('Termin must be confirmed before completion');
            }
            
            $update_data = [
                'status' => 'completed',
                'tanggal_selesai' => date('Y-m-d H:i:s'),
                'completed_by' => $user_id ?: $this->CI->session->userdata('user_id'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->CI->db->where('id', $termin_id);
            $result = $this->CI->db->update('termin_progress', $update_data);
            
            if ($result) {
                $this->log_termin_action($termin['proyek_id'], $termin['termin'], 'completed', $user_id);
                return ['success' => true, 'message' => 'Termin berhasil diselesaikan'];
            } else {
                throw new Exception('Failed to update termin status');
            }
            
        } catch (Exception $e) {
            log_message('error', 'Termin Service - Complete termin error: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    /**
     * Log termin actions for audit trail
     */
    private function log_termin_action($project_id, $termin_number, $action, $user_id)
    {
        $log_data = [
            'project_id' => $project_id,
            'termin_number' => $termin_number,
            'action' => $action,
            'user_id' => $user_id ?: $this->CI->session->userdata('user_id'),
            'timestamp' => date('Y-m-d H:i:s'),
            'ip_address' => $this->CI->input->ip_address()
        ];
        
        // This would require a termin_log table
        // $this->CI->db->insert('termin_log', $log_data);
        log_message('info', "Termin Action - Project: {$project_id}, Termin: {$termin_number}, Action: {$action}");
    }
    
    /**
     * Get termin schema for display
     */
    public function get_termin_schema_for_project($project_budget = null)
    {
        $schema = $this->termin_schema;
        
        if ($project_budget) {
            foreach ($schema as $number => &$termin) {
                $amounts = $this->calculate_termin_amounts($project_budget, $termin);
                $termin = array_merge($termin, $amounts);
            }
        }
        
        return $schema;
    }
}
?>