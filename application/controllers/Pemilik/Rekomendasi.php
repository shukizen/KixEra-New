<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Rekomendasi extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('template/header', );
        $this->load->view('template/sidebar', );
        $this->load->view('pemilik/rekomendasi/index', );
        $this->load->view('template/footer');
    }
}