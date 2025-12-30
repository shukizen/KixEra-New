<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekomendasi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Load libraries and models
        $this->load->library('auth_library');
        $this->load->library('session');
        $this->load->library('gemini_library');
        
        $this->load->model('Rekomendasi_model');
        $this->load->model('Pesanan_model');
        $this->load->model('Keuangan_model');
        $this->load->model('Pelanggan_model');
        $this->load->model('Owner_model');
        
        // Require owner role
        $this->auth_library->require_role('owner');
    }
    
    /**
     * Index - Main recommendation page
     */
    public function index() {
        // Get id_pemilik
        $id_pemilik = $this->get_owner_id();
        
        if (!$id_pemilik) {
            show_error('Owner ID not found', 403);
            return;
        }
        
        // Get business data for display
        $data['business_data'] = $this->get_business_data($id_pemilik);
        
        // Get latest recommendations
        $data['latest_recommendations'] = $this->Rekomendasi_model->get_latest($id_pemilik, 5);
        
        // Load views
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/rekomendasi/index', $data);
        $this->load->view('template/footer');
    }
    
    /**
     * Generate - AJAX endpoint to generate new recommendation
     */
    public function generate() {
        // Set JSON header
        header('Content-Type: application/json');
        
        try {
            // Validate AJAX request
            if (!$this->input->is_ajax_request()) {
                echo json_encode(['success' => false, 'message' => 'Invalid request']);
                return;
            }
            
            // Get id_pemilik
            $id_pemilik = $this->get_owner_id();
            
            if (!$id_pemilik) {
                echo json_encode(['success' => false, 'message' => 'Owner ID not found']);
                return;
            }
            
            // Get business data
            $business_data = $this->get_business_data($id_pemilik);
            
            // Read JSON body (frontend sends as application/json)
            $json_input = file_get_contents('php://input');
            $request_data = json_decode($json_input, true);
            
            // Check if custom prompt is provided
            $custom_prompt = isset($request_data['custom_prompt']) ? trim($request_data['custom_prompt']) : '';
            
            // Log for debugging
            log_message('debug', 'Rekomendasi::generate - Mode: ' . ($custom_prompt ? 'CUSTOM' : 'AUTO'));
            if ($custom_prompt) {
                log_message('debug', 'Custom Prompt: ' . substr($custom_prompt, 0, 100));
            }
            
            // Generate insights using Gemini API
            if (!empty($custom_prompt)) {
                // Use custom prompt mode
                $insights = $this->gemini_library->generate_custom_insights($business_data, $custom_prompt);
            } else {
                // Use automatic analysis mode
                $insights = $this->gemini_library->generate_business_insights($business_data);
            }
            
            if ($insights === false) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to generate insights. Please try again.'
                ]);
                return;
            }
            
            // Save to database
            $save_data = [
                'id_pemilik' => $id_pemilik,
                'recommendation' => $insights['recommendation'],
                'insights' => $insights['insights'],
                'impact' => $insights['impact'],
                'business_data' => $business_data,
                'status' => 'new'
            ];
            
            $id_rekomendasi = $this->Rekomendasi_model->insert_recommendation($save_data);
            
            if ($id_rekomendasi) {
                $insights['id_rekomendasi'] = $id_rekomendasi;
            }
            
            echo json_encode([
                'success' => true,
                'data' => $insights
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'Rekomendasi::generate - ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Save - AJAX endpoint to save recommendation
     */
    public function save() {
        header('Content-Type: application/json');
        
        try {
            if (!$this->input->is_ajax_request()) {
                echo json_encode(['success' => false, 'message' => 'Invalid request']);
                return;
            }
            
            $id_pemilik = $this->get_owner_id();
            $id_rekomendasi = $this->input->post('id_rekomendasi');
            
            if (!$id_pemilik || !$id_rekomendasi) {
                echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
                return;
            }

            // Reconnect DB to prevent "MySQL server has gone away" error
            if ($this->db->conn_id === FALSE || $this->db->pconnect == FALSE) {
                $this->db->reconnect();
            }
            
            // Update status to saved
            $result = $this->Rekomendasi_model->update_status($id_rekomendasi, 'saved', $id_pemilik);
            
            echo json_encode([
                'success' => $result,
                'message' => $result ? 'Recommendation saved successfully' : 'Failed to save recommendation'
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'Rekomendasi::save - ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'An error occurred']);
        }
    }
    
    /**
     * History - Get recommendation history
     */
    public function history() {
        header('Content-Type: application/json');
        
        try {
            $id_pemilik = $this->get_owner_id();
            
            if (!$id_pemilik) {
                echo json_encode(['success' => false, 'message' => 'Owner ID not found']);
                return;
            }
            
            $limit = $this->input->get('limit') ?? 10;
            $offset = $this->input->get('offset') ?? 0;
            
            $filters = [];
            if ($this->input->get('status')) {
                $filters['status'] = $this->input->get('status');
            }
            
            $recommendations = $this->Rekomendasi_model->get_history($id_pemilik, $filters, $limit, $offset);
            $total = $this->Rekomendasi_model->count_recommendations($id_pemilik, $filters);
            
            echo json_encode([
                'success' => true,
                'data' => $recommendations,
                'total' => $total
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'Rekomendasi::history - ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'An error occurred']);
        }
    }
    
    /**
     * Get Owner ID from session
     * 
     * @return int|null Owner ID
     */
    protected function get_owner_id() {
        $id_pemilik = $this->session->userdata('id_pemilik');
        
        if (empty($id_pemilik)) {
            $id_user = $this->session->userdata('id_user');
            if ($id_user) {
                $owner = $this->db->get_where('pemilik', ['id_user' => $id_user])->row();
                if ($owner) {
                    $id_pemilik = $owner->id_pemilik;
                }
            }
        }
        
        return $id_pemilik;
    }
    
    /**
     * Get Business Data
     * 
     * Aggregate business metrics for AI analysis
     * 
     * @param int $id_pemilik Owner ID
     * @return array Business data
     */
    protected function get_business_data($id_pemilik) {
        $data = [];
        
        // Total orders today
        $data['total_orders_today'] = $this->Pesanan_model->countOrdersToday($id_pemilik);
        
        // Total orders this month
        $data['total_orders_month'] = $this->Pesanan_model->countOrdersThisMonth($id_pemilik);
        
        // Monthly revenue
        $revenue_filters = [
            'id_pemilik' => $id_pemilik,
            'bulan' => date('m'),
            'tahun' => date('Y')
        ];
        $data['monthly_revenue'] = $this->Keuangan_model->get_total_pemasukan($revenue_filters);
        
        // Revenue growth
        $last_month_date = date('Y-m-d', strtotime('first day of last month'));
        $revenue_filters_last = [
            'id_pemilik' => $id_pemilik,
            'bulan' => date('m', strtotime($last_month_date)),
            'tahun' => date('Y', strtotime($last_month_date))
        ];
        $last_month_revenue = $this->Keuangan_model->get_total_pemasukan($revenue_filters_last);
        
        if ($last_month_revenue > 0) {
            $data['revenue_growth'] = round((($data['monthly_revenue'] - $last_month_revenue) / $last_month_revenue) * 100, 1);
        } else {
            $data['revenue_growth'] = $data['monthly_revenue'] > 0 ? 100 : 0;
        }
        
        // Active customers
        $data['active_customers'] = $this->Pelanggan_model->countActiveCustomers($id_pemilik);
        
        // Pending pickups
        $data['pending_pickups'] = $this->Pesanan_model->countPendingPickups($id_pemilik);
        
        // Top services
        $service_volume = $this->Pesanan_model->getServiceVolume($id_pemilik);
        $data['top_services'] = [];
        if (!empty($service_volume)) {
            foreach (array_slice($service_volume, 0, 3) as $service) {
                $data['top_services'][] = $service->nama_layanan ?? 'Unknown';
            }
        }
        
        // Branch performance
        $branches = $this->Keuangan_model->get_all_cabang($id_pemilik);
        $data['branch_performance'] = [];
        foreach ($branches as $branch) {
            $f = ['id_cabang' => $branch->id_cabang, 'bulan' => date('m'), 'tahun' => date('Y')];
            $rev = $this->Keuangan_model->get_total_pemasukan($f);
            if ($rev > 0) {
                $data['branch_performance'][] = [
                    'label' => $branch->nama_cabang,
                    'value' => $rev
                ];
            }
        }
        
        // Average order value
        if ($data['total_orders_month'] > 0) {
            $data['avg_order_value'] = round($data['monthly_revenue'] / $data['total_orders_month'], 0);
        } else {
            $data['avg_order_value'] = 0;
        }
        
        return $data;
    }
}
