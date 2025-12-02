<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Pesanan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('template/header', );
        $this->load->view('template/sidebar', );
        $this->load->view('pemilik/pesanan/index', );
        $this->load->view('template/footer');
    }
}