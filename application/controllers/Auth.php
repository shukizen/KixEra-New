<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function login() {

        
        // Show login view
        $this->load->view('auth/login');
    }
    
    public function google() {
        // Google OAuth logic
    }
    public function register() {
        $this->load->view('auth/register');
    }
}