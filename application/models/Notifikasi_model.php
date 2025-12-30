<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model {
    
    private $table = 'notifikasi';
    private $table_chatbot = 'chatbot_log';
    private $table_cs = 'customer_service';
    
    public function __construct() {
        parent::__construct();
    }
    
    // ========== NOTIFIKASI ==========
    
    // Get unread notifications for Owner
    public function getUnreadByOwner($id_owner) {
        $this->db->where('type', 'pemilik');
        $this->db->where('id_user', $id_owner);
        $this->db->where('status', 'unread');
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    // Get all notifications for Owner
    public function getAllByOwner($id_owner, $limit = 50) {
        $this->db->where('type', 'pemilik');
        $this->db->where('id_user', $id_owner);
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    // Get unread notifications for Admin
    public function getUnreadAdmin() {
        $this->db->where('type', 'admin');
        $this->db->where('status', 'unread');
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    // Get all notifications for Admin
    public function getAllAdmin($limit = 50) {
        $this->db->where('type', 'admin');
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    // Insert notification
    public function insertNotification($data) {
        // Ensure defaults
        if (!isset($data['created_at'])) $data['created_at'] = date('Y-m-d H:i:s');
        if (!isset($data['status'])) $data['status'] = 'unread';
        return $this->db->insert($this->table, $data);
    }
    
    // Mark as read
    public function markAsRead($id_notifikasi) {
        $data = ['status' => 'read', 'updated_at' => date('Y-m-d H:i:s')];
        $this->db->where('id_notifikasi', $id_notifikasi);
        return $this->db->update($this->table, $data);
    }
    
    // Mark all as read for Owner
    public function markAllAsRead($id_owner) {
        $data = ['status' => 'read', 'updated_at' => date('Y-m-d H:i:s')];
        $this->db->where('type', 'pemilik');
        $this->db->where('id_user', $id_owner);
        $this->db->where('status', 'unread');
        return $this->db->update($this->table, $data);
    }

    // Mark all as read for Admin
    public function markAllAsReadAdmin() {
        $data = ['status' => 'read', 'updated_at' => date('Y-m-d H:i:s')];
        $this->db->where('type', 'admin');
        $this->db->where('status', 'unread');
        return $this->db->update($this->table, $data);
    }
    
    // Count unread for Owner
    public function countUnread($id_owner) {
        $this->db->where('type', 'pemilik');
        $this->db->where('id_user', $id_owner);
        $this->db->where('status', 'unread');
        $this->db->where('deleted_at IS NULL');
        return $this->db->count_all_results($this->table);
    }

    // Count unread for Admin
    public function countUnreadAdmin() {
        $this->db->where('type', 'admin');
        $this->db->where('status', 'unread');
        $this->db->where('deleted_at IS NULL');
        return $this->db->count_all_results($this->table);
    }
    
    // ========== CHATBOT LOG ==========
    
    // Insert chat log
    public function insertChatLog($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table_chatbot, $data);
    }
    
    // Get chat history
    public function getChatHistory($id_owner, $limit = 50) {
        $this->db->where('id_owner', $id_owner);
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('tgl_chat', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get($this->table_chatbot);
        return $query->result();
    }
    
    // Get chat by pelanggan
    public function getChatByPelanggan($id_pelanggan, $limit = 20) {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('tgl_chat', 'ASC');
        $this->db->limit($limit);
        $query = $this->db->get($this->table_chatbot);
        return $query->result();
    }
    
    // ========== CUSTOMER SERVICE ==========
    
    // Get all tickets
    public function getAllTickets() {
        $this->db->select('customer_service.*, owner.nama_usaha, karyawan.nama as nama_karyawan');
        $this->db->from($this->table_cs);
        $this->db->join('owner', 'owner.id_owner = customer_service.id_owner', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = customer_service.id_karyawan', 'left');
        $this->db->where('customer_service.deleted_at IS NULL');
        $this->db->order_by('customer_service.tgl_dibuat', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get tickets by owner
    public function getTicketsByOwner($id_owner) {
        $this->db->where('id_owner', $id_owner);
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('tgl_dibuat', 'DESC');
        $query = $this->db->get($this->table_cs);
        return $query->result();
    }
    
    // Get ticket by ID
    public function getTicketById($id_ticket) {
        $this->db->select('customer_service.*, owner.nama_usaha, owner.email, owner.no_telp');
        $this->db->from($this->table_cs);
        $this->db->join('owner', 'owner.id_owner = customer_service.id_owner', 'left');
        $this->db->where('customer_service.id_ticket', $id_ticket);
        $this->db->where('customer_service.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->row();
    }
    
    // Insert ticket
    public function insertTicket($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table_cs, $data);
    }
    
    // Update ticket
    public function updateTicket($id_ticket, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_ticket', $id_ticket);
        return $this->db->update($this->table_cs, $data);
    }
    
    // Close ticket
    public function closeTicket($id_ticket) {
        $data = [
            'status' => 'ditutup',
            'tgl_ditutup' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_ticket', $id_ticket);
        return $this->db->update($this->table_cs, $data);
    }
}
?>