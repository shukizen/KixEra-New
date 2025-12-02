<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karyawan_dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('template/header', );
        $this->load->view('template/sidebarkaryawan', );
        $this->load->view('karyawan/index', );
        $this->load->view('template/footer');
    }
}