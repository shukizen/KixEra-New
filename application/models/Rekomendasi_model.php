<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Rekomendasi Model
 * 
 * Model untuk mengelola data rekomendasi AI
 * 
 * @package    KixEra
 * @subpackage Models
 * @category   AI Recommendations
 */
class Rekomendasi_model extends CI_Model {
    
    protected $table = 'rekomendasi_ai';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Insert Recommendation
     * 
     * Simpan rekomendasi baru ke database
     * 
     * @param array $data Recommendation data
     * @return int|false Insert ID or false on failure
     */
    public function insert_recommendation($data) {
        try {
            $insert_data = [
                'id_pemilik' => $data['id_pemilik'],
                'recommendation_text' => $data['recommendation'],
                'insights' => json_encode($data['insights']),
                'impact_prediction' => json_encode($data['impact']),
                'business_data_snapshot' => isset($data['business_data']) ? json_encode($data['business_data']) : null,
                'status' => $data['status'] ?? 'new',
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert($this->table, $insert_data);
            
            if ($this->db->affected_rows() > 0) {
                return $this->db->insert_id();
            }
            
            return false;
            
        } catch (Exception $e) {
            log_message('error', 'Rekomendasi_model::insert_recommendation - ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Get Latest Recommendations
     * 
     * Ambil rekomendasi terbaru untuk pemilik
     * 
     * @param int $id_pemilik Owner ID
     * @param int $limit Number of records
     * @return array Recommendations
     */
    public function get_latest($id_pemilik, $limit = 5) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_pemilik', $id_pemilik);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $results = $query->result();
            
            // Decode JSON fields
            foreach ($results as &$row) {
                $row->insights = json_decode($row->insights, true);
                $row->impact_prediction = json_decode($row->impact_prediction, true);
                $row->business_data_snapshot = json_decode($row->business_data_snapshot, true);
            }
            
            return $results;
        }
        
        return [];
    }
    
    /**
     * Get Recommendation by ID
     * 
     * Ambil detail rekomendasi berdasarkan ID
     * 
     * @param int $id_rekomendasi Recommendation ID
     * @param int $id_pemilik Owner ID (for security)
     * @return object|null Recommendation object or null
     */
    public function get_by_id($id_rekomendasi, $id_pemilik = null) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_rekomendasi', $id_rekomendasi);
        
        if ($id_pemilik !== null) {
            $this->db->where('id_pemilik', $id_pemilik);
        }
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            
            // Decode JSON fields
            $row->insights = json_decode($row->insights, true);
            $row->impact_prediction = json_decode($row->impact_prediction, true);
            $row->business_data_snapshot = json_decode($row->business_data_snapshot, true);
            
            return $row;
        }
        
        return null;
    }
    
    /**
     * Update Status
     * 
     * Update status rekomendasi
     * 
     * @param int $id_rekomendasi Recommendation ID
     * @param string $status New status (new, saved, implemented, archived)
     * @param int $id_pemilik Owner ID (for security)
     * @return bool Success status
     */
    public function update_status($id_rekomendasi, $status, $id_pemilik = null) {
        $allowed_statuses = ['new', 'saved', 'implemented', 'archived'];
        
        if (!in_array($status, $allowed_statuses)) {
            return false;
        }
        
        $this->db->where('id_rekomendasi', $id_rekomendasi);
        
        if ($id_pemilik !== null) {
            $this->db->where('id_pemilik', $id_pemilik);
        }
        
        $this->db->update($this->table, [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        return $this->db->affected_rows() > 0;
    }
    
    /**
     * Get History
     * 
     * Ambil riwayat rekomendasi dengan filter
     * 
     * @param int $id_pemilik Owner ID
     * @param array $filters Optional filters (status, date_from, date_to)
     * @param int $limit Number of records
     * @param int $offset Offset for pagination
     * @return array Recommendations
     */
    public function get_history($id_pemilik, $filters = [], $limit = 10, $offset = 0) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_pemilik', $id_pemilik);
        
        // Apply filters
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }
        
        if (!empty($filters['date_from'])) {
            $this->db->where('created_at >=', $filters['date_from']);
        }
        
        if (!empty($filters['date_to'])) {
            $this->db->where('created_at <=', $filters['date_to']);
        }
        
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $results = $query->result();
            
            // Decode JSON fields
            foreach ($results as &$row) {
                $row->insights = json_decode($row->insights, true);
                $row->impact_prediction = json_decode($row->impact_prediction, true);
                $row->business_data_snapshot = json_decode($row->business_data_snapshot, true);
            }
            
            return $results;
        }
        
        return [];
    }
    
    /**
     * Count Recommendations
     * 
     * Hitung total rekomendasi untuk pemilik
     * 
     * @param int $id_pemilik Owner ID
     * @param array $filters Optional filters
     * @return int Count
     */
    public function count_recommendations($id_pemilik, $filters = []) {
        $this->db->from($this->table);
        $this->db->where('id_pemilik', $id_pemilik);
        
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }
        
        if (!empty($filters['date_from'])) {
            $this->db->where('created_at >=', $filters['date_from']);
        }
        
        if (!empty($filters['date_to'])) {
            $this->db->where('created_at <=', $filters['date_to']);
        }
        
        return $this->db->count_all_results();
    }
    
    /**
     * Delete Recommendation
     * 
     * Hapus rekomendasi (soft delete dengan archive)
     * 
     * @param int $id_rekomendasi Recommendation ID
     * @param int $id_pemilik Owner ID (for security)
     * @return bool Success status
     */
    public function delete_recommendation($id_rekomendasi, $id_pemilik = null) {
        // Soft delete by setting status to archived
        return $this->update_status($id_rekomendasi, 'archived', $id_pemilik);
    }
}
