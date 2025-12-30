<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helpdesk_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get all tickets with filters
     */
    public function getAllTickets($filters = []) {
        $this->db->select('t.*, u.username, 
            (SELECT COUNT(*) FROM helpdesk_messages m WHERE m.id_ticket = t.id_ticket) as total_messages');
        $this->db->from('helpdesk_tickets t');
        $this->db->join('users u', 't.id_user = u.id_user', 'left');
        
        // Apply filters
        if (!empty($filters['status'])) {
            $this->db->where('t.status', $filters['status']);
        }
        
        if (!empty($filters['kategori'])) {
            $this->db->where('t.kategori', $filters['kategori']);
        }
        
        if (!empty($filters['prioritas'])) {
            $this->db->where('t.prioritas', $filters['prioritas']);
        }
        
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('t.subject', $filters['search']);
            $this->db->or_like('u.username', $filters['search']);
            $this->db->group_end();
        }
        
        $this->db->order_by('t.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get single ticket with messages
     */
    public function getTicketById($id) {
        $this->db->select('t.*, u.username');
        $this->db->from('helpdesk_tickets t');
        $this->db->join('users u', 't.id_user = u.id_user', 'left');
        $this->db->where('t.id_ticket', $id);
        return $this->db->get()->row();
    }
    
    /**
     * Get messages for a ticket
     */
    public function getMessages($ticket_id) {
        $this->db->select('m.*, u.username');
        $this->db->from('helpdesk_messages m');
        $this->db->join('users u', 'm.id_user = u.id_user', 'left');
        $this->db->where('m.id_ticket', $ticket_id);
        $this->db->order_by('m.created_at', 'ASC');
        return $this->db->get()->result();
    }
    
    /**
     * Create new ticket
     */
    public function createTicket($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('helpdesk_tickets', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update ticket
     */
    public function updateTicket($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        if (isset($data['status']) && $data['status'] === 'closed') {
            $data['closed_at'] = date('Y-m-d H:i:s');
        }
        
        $this->db->where('id_ticket', $id);
        return $this->db->update('helpdesk_tickets', $data);
    }
    
    /**
     * Add message to ticket
     */
    public function addMessage($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('helpdesk_messages', $data);
        
        // Update ticket updated_at
        $this->db->where('id_ticket', $data['id_ticket']);
        $this->db->update('helpdesk_tickets', ['updated_at' => date('Y-m-d H:i:s')]);
        
        return $this->db->insert_id();
    }
    
    /**
     * Delete ticket and its messages
     */
    public function deleteTicket($id) {
        // Delete messages first
        $this->db->where('id_ticket', $id);
        $this->db->delete('helpdesk_messages');
        
        // Delete ticket
        $this->db->where('id_ticket', $id);
        return $this->db->delete('helpdesk_tickets');
    }
    
    /**
     * Get statistics
     */
    public function getStats() {
        $result = [];
        
        // Total tickets
        $result['total'] = $this->db->count_all('helpdesk_tickets');
        
        // Open tickets
        $this->db->where('status', 'open');
        $result['open'] = $this->db->count_all_results('helpdesk_tickets');
        
        // In progress
        $this->db->where('status', 'in_progress');
        $result['in_progress'] = $this->db->count_all_results('helpdesk_tickets');
        
        // Resolved
        $this->db->where('status', 'resolved');
        $result['resolved'] = $this->db->count_all_results('helpdesk_tickets');
        
        // Closed
        $this->db->where('status', 'closed');
        $result['closed'] = $this->db->count_all_results('helpdesk_tickets');
        
        // Urgent tickets
        $this->db->where('prioritas', 'urgent');
        $this->db->where_in('status', ['open', 'in_progress']);
        $result['urgent'] = $this->db->count_all_results('helpdesk_tickets');
        
        return $result;
    }
}
