<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helpdesk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Helpdesk_model');
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }

    /**
     * Main helpdesk page
     */
    public function index()
    {
        $data['page_title'] = 'Helpdesk - KixEra';
        $data['user'] = $this->auth_library->get_user();
        $data['stats'] = $this->Helpdesk_model->getStats();
        $data['tickets'] = $this->Helpdesk_model->getAllTickets();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin', $data);
        $this->load->view('admin/helpdesk/index', $data);
        $this->load->view('template/footer');
    }

    /**
     * Get tickets with filters (AJAX)
     */
    public function get_tickets()
    {
        header('Content-Type: application/json');
        
        $filters = [
            'status' => $this->input->get('status'),
            'kategori' => $this->input->get('kategori'),
            'prioritas' => $this->input->get('prioritas'),
            'search' => $this->input->get('search')
        ];
        
        $tickets = $this->Helpdesk_model->getAllTickets($filters);
        
        echo json_encode([
            'success' => true,
            'data' => $tickets
        ]);
    }

    /**
     * Get single ticket with messages (AJAX)
     */
    public function get_ticket($id)
    {
        header('Content-Type: application/json');
        
        $ticket = $this->Helpdesk_model->getTicketById($id);
        
        if ($ticket) {
            $messages = $this->Helpdesk_model->getMessages($id);
            
            echo json_encode([
                'success' => true,
                'data' => [
                    'ticket' => $ticket,
                    'messages' => $messages
                ]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Ticket tidak ditemukan'
            ]);
        }
    }

    /**
     * Update ticket status (AJAX)
     */
    public function update_status($id)
    {
        header('Content-Type: application/json');
        
        $status = $this->input->post('status');
        
        if (empty($status)) {
            echo json_encode([
                'success' => false,
                'message' => 'Status tidak valid'
            ]);
            return;
        }
        
        $result = $this->Helpdesk_model->updateTicket($id, ['status' => $status]);
        
        if ($result) {
            // Log activity
            $this->logActivity('update_ticket_status', 'Update status ticket #' . $id . ' ke ' . $status);
            
            echo json_encode([
                'success' => true,
                'message' => 'Status berhasil diperbarui'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal memperbarui status'
            ]);
        }
    }

    /**
     * Reply to ticket (AJAX)
     */
    public function reply($id)
    {
        header('Content-Type: application/json');
        
        $pesan = $this->input->post('pesan');
        $user = $this->auth_library->get_user();
        
        if (empty($pesan)) {
            echo json_encode([
                'success' => false,
                'message' => 'Pesan tidak boleh kosong'
            ]);
            return;
        }
        
        $data = [
            'id_ticket' => $id,
            'id_user' => $user->id_user,
            'pesan' => $pesan,
            'is_admin' => 1
        ];
        
        $message_id = $this->Helpdesk_model->addMessage($data);
        
        if ($message_id) {
            // Update ticket status to in_progress if it was open
            $ticket = $this->Helpdesk_model->getTicketById($id);
            if ($ticket && $ticket->status === 'open') {
                $this->Helpdesk_model->updateTicket($id, ['status' => 'in_progress']);
            }
            
            // Log activity
            $this->logActivity('reply_ticket', 'Membalas ticket #' . $id);
            
            echo json_encode([
                'success' => true,
                'message' => 'Balasan berhasil dikirim'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mengirim balasan'
            ]);
        }
    }

    /**
     * Delete ticket (AJAX)
     */
    public function delete($id)
    {
        header('Content-Type: application/json');
        
        $result = $this->Helpdesk_model->deleteTicket($id);
        
        if ($result) {
            // Log activity
            $this->logActivity('delete_ticket', 'Menghapus ticket #' . $id);
            
            echo json_encode([
                'success' => true,
                'message' => 'Ticket berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus ticket'
            ]);
        }
    }

    /**
     * Get stats (AJAX)
     */
    public function get_stats()
    {
        header('Content-Type: application/json');
        
        $stats = $this->Helpdesk_model->getStats();
        
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
