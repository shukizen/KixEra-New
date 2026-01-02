<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket_validator {

    protected $CI;

    // Feature definitions based on package ID
    protected $package_features = [
        // Basic (id=1)
        1 => [
            'max_cabang' => 1,
            'max_karyawan' => 2,
            'ai_recommendation' => false,
            'whatsapp_integration' => false,
            'priority_support' => false
        ],
        // Professional (id=2)
        2 => [
            'max_cabang' => 3,
            'max_karyawan' => 10,
            'ai_recommendation' => true,
            'whatsapp_integration' => false,
            'priority_support' => true
        ],
        // Bisnis (id=3)
        3 => [
            'max_cabang' => 999999, // Unlimited
            'max_karyawan' => 999999, // Unlimited
            'ai_recommendation' => true,
            'whatsapp_integration' => true,
            'priority_support' => true // 24/7 phone support effectively covers priority
        ]
    ];

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
    }

    /**
     * Get features for the current logged in user's package
     */
    public function get_current_features() {
        $id_paket = $this->CI->session->userdata('id_paket');
        
        // Default to Basic features if no package set (or handle as error/restricted)
        if (!isset($this->package_features[$id_paket])) {
            // Fallback for trial or expired or unknown, maybe similar to Basic or strictly nothing?
            // For now, let's safe default to Basic limits but maybe with flags
             return $this->package_features[1]; 
        }

        return $this->package_features[$id_paket];
    }

    public function can_use_ai() {
        $features = $this->get_current_features();
        return $features['ai_recommendation'];
    }

    public function can_use_whatsapp() {
        $features = $this->get_current_features();
        return $features['whatsapp_integration'];
    }

    public function get_max_cabang() {
        $features = $this->get_current_features();
        return $features['max_cabang'];
    }

    public function get_max_karyawan() {
        $features = $this->get_current_features();
        return $features['max_karyawan'];
    }

    /**
     * Check if user can add more branches
     * @param int $current_count Current number of branches user has
     */
    public function can_add_cabang($current_count) {
        $max = $this->get_max_cabang();
        return $current_count < $max;
    }

    /**
     * Check if user can add more employees
     * @param int $current_count Current number of employees user has
     */
    public function can_add_karyawan($current_count) {
        $max = $this->get_max_karyawan();
        return $current_count < $max;
    }
}
