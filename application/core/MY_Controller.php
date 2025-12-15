<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Controller
 * Letakkan file ini di application/core/MY_Controller.php
 */

class MY_Controller extends CI_Controller {
    
    protected $user;
    protected $role;
    protected $subscription;
    
    public function __construct() {
        parent::__construct();
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Get current user
        $this->user = $this->auth_library->get_user();
        $this->role = $this->session->userdata('role');
    }
    
    /**
     * Check if feature is available
     */
    protected function check_feature($feature_name, $redirect = true) {
        if (!$this->auth_library->has_feature($feature_name)) {
            if ($redirect) {
                $this->session->set_flashdata('error', 
                    'Fitur ini tidak tersedia dalam paket Anda. Silakan upgrade.'
                );
                redirect('owner/subscription');
            }
            return false;
        }
        return true;
    }
    
    /**
     * Check usage limit
     */
    protected function check_limit($limit_type, $redirect = true) {
        $result = $this->auth_library->check_limit($limit_type);
        
        if (!$result['allowed']) {
            if ($redirect) {
                $this->session->set_flashdata('error', $result['message']);
                redirect('owner/subscription');
            }
            return false;
        }
        return true;
    }
}

/**
 * Admin Controller - untuk halaman admin
 */
class Admin_Controller extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Require admin role
        $this->auth_library->require_role('admin');
    }
}

/**
 * Owner Controller - untuk halaman owner
 */
class Owner_Controller extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Require owner role
        $this->auth_library->require_role('owner');
        
        // Get subscription info
        $this->subscription = $this->session->userdata('subscription');
        
        // Check if subscription is active
        if (!$this->subscription || !$this->subscription['active']) {
            $this->session->set_flashdata('error', 
                'Langganan Anda tidak aktif. Silakan perpanjang langganan.'
            );
            redirect('owner/subscription');
        }
        
        // Show warning if expiring soon
        if ($this->subscription['status'] === 'expiring_soon') {
            $this->session->set_flashdata('warning', 
                $this->subscription['message']
            );
        }
    }
}

/**
 * Karyawan Controller - untuk halaman karyawan
 */
class Karyawan_Controller extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Require karyawan role
        $this->auth_library->require_role('karyawan');
    }
}