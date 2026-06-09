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
        
        // Fallback: if id_paket not in session, try to get from database
        if (empty($id_paket)) {
            $id_pemilik = $this->CI->session->userdata('id_pemilik');
            if ($id_pemilik) {
                $owner = $this->CI->db->select('id_paket')->get_where('pemilik', ['id_pemilik' => $id_pemilik])->row();
                if ($owner && !empty($owner->id_paket)) {
                    $id_paket = $owner->id_paket;
                    // Cache it in session for future requests
                    $this->CI->session->set_userdata('id_paket', (int)$id_paket);
                }
            }
        }

        // Cast to int since session values may be strings
        $id_paket = (int)$id_paket;
        
        // Default to Basic features if no package set
        if (!isset($this->package_features[$id_paket])) {
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
