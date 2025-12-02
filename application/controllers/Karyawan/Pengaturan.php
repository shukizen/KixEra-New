<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('template/header', );
              $this->load->view('template/sidebarkaryawan', );
        $this->load->view('karyawan/pengaturan/index', );
        $this->load->view('template/footer');
    }
}