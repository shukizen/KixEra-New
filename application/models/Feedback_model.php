<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_model extends CI_Model {
    
    private $table = 'feedback_pelanggan';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Get feedback by pesanan
    public function getFeedbackByPesanan($id_pesanan) {
        $this->db->select('feedback_pelanggan.*, pelanggan.nama as nama_pelanggan');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = feedback_pelanggan.id_pelanggan', 'left');
        $this->db->where('feedback_pelanggan.id_pesanan', $id_pesanan);
        $this->db->where('feedback_pelanggan.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->row();
    }
    
    // Get all feedback for owner
    public function getAllFeedbackByOwner($id_owner) {
        $this->db->select('feedback_pelanggan.*, pelanggan.nama as nama_pelanggan, 
                          pesanan.id_pesanan, layanan.nama_layanan');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = feedback_pelanggan.id_pelanggan', 'left');
        $this->db->join('pesanan', 'pesanan.id_pesanan = feedback_pelanggan.id_pesanan', 'left');
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->where('pesanan.id_owner', $id_owner);
        $this->db->where('feedback_pelanggan.deleted_at IS NULL');
        $this->db->order_by('feedback_pelanggan.tgl_feedback', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Insert feedback
    public function insertFeedback($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }
    
    // Get average rating
    public function getAverageRating($id_owner) {
        $this->db->select_avg('rating');
        $this->db->from($this->table);
        $this->db->join('pesanan', 'pesanan.id_pesanan = feedback_pelanggan.id_pesanan', 'left');
        $this->db->where('pesanan.id_owner', $id_owner);
        $this->db->where('feedback_pelanggan.deleted_at IS NULL');
        $query = $this->db->get();
        $result = $query->row();
        return round($result->rating ?? 0, 2);
    }
    
    // Get feedback statistics
    public function getFeedbackStats($id_owner) {
        $query = $this->db->query("
            SELECT 
                COUNT(*) as total_feedback,
                AVG(rating) as avg_rating,
                SUM(CASE WHEN rating >= 4 THEN 1 ELSE 0 END) as feedback_positif,
                SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as feedback_netral,
                SUM(CASE WHEN rating <= 2 THEN 1 ELSE 0 END) as feedback_negatif,
                SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as rating_5,
                SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as rating_4,
                SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as rating_3,
                SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as rating_2,
                SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as rating_1
            FROM feedback_pelanggan f
            INNER JOIN pesanan p ON p.id_pesanan = f.id_pesanan
            WHERE p.id_owner = ? AND f.deleted_at IS NULL
        ", [$id_owner]);
        
        return $query->row();
    }
    
    // Get recent feedback
    public function getRecentFeedback($id_owner, $limit = 10) {
        $this->db->select('feedback_pelanggan.*, pelanggan.nama as nama_pelanggan, 
                          pesanan.id_pesanan');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = feedback_pelanggan.id_pelanggan', 'left');
        $this->db->join('pesanan', 'pesanan.id_pesanan = feedback_pelanggan.id_pesanan', 'left');
        $this->db->where('pesanan.id_owner', $id_owner);
        $this->db->where('feedback_pelanggan.deleted_at IS NULL');
        $this->db->order_by('feedback_pelanggan.tgl_feedback', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }
}
?>