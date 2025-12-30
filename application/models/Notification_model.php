<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

    private $table = 'notifications';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Create a new notification
     */
    public function create($data) {
        $notification = [
            'id_pemilik' => $data['id_pemilik'],
            'title' => $data['title'],
            'message' => isset($data['message']) ? $data['message'] : null,
            'type' => isset($data['type']) ? $data['type'] : 'general',
            'related_id' => isset($data['related_id']) ? $data['related_id'] : null,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        return $this->db->insert($this->table, $notification);
    }

    /**
     * Get recent notifications for owner
     */
    public function get_recent($id_pemilik, $limit = 10) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_pemilik', $id_pemilik);
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        
        return $this->db->get()->result();
    }

    /**
     * Get unread count
     */
    public function get_unread_count($id_pemilik) {
        $this->db->where('id_pemilik', $id_pemilik);
        $this->db->where('is_read', 0);
        $this->db->where('deleted_at IS NULL');
        
        return $this->db->count_all_results($this->table);
    }

    /**
     * Mark notification as read
     */
    public function mark_as_read($id_notification) {
        $data = [
            'is_read' => 1,
            'read_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id_notification', $id_notification);
        return $this->db->update($this->table, $data);
    }

    /**
     * Mark all notifications as read for owner
     */
    public function mark_all_as_read($id_pemilik) {
        $data = [
            'is_read' => 1,
            'read_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id_pemilik', $id_pemilik);
        $this->db->where('is_read', 0);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete notification (soft delete)
     */
    public function soft_delete($id_notification) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        
        $this->db->where('id_notification', $id_notification);
        return $this->db->update($this->table, $data);
    }

    /**
     * Get notification by ID
     */
    public function get_by_id($id_notification) {
        $this->db->where('id_notification', $id_notification);
        $this->db->where('deleted_at IS NULL');
        
        return $this->db->get($this->table)->row();
    }
}
