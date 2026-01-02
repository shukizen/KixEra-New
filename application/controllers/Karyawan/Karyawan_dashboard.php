<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require karyawan role
        $this->auth_library->require_role('karyawan');
    }
    
    public function index() {
        $data['page_title'] = 'Dashboard Karyawan - KixEra';
        $data['user'] = $this->auth_library->get_user();
        
        // Get karyawan statistics
        $id_cabang = $this->session->userdata('id_cabang');
        $id_karyawan = $this->session->userdata('id_karyawan');
        
        $data['cabang'] = $this->get_cabang_info($id_cabang);
        $data['pesanan_hari_ini'] = $this->get_pesanan_hari_ini($id_cabang);
        $data['pesanan_pending'] = $this->get_pesanan_pending($id_cabang);
        $data['pesanan_proses'] = $this->get_pesanan_proses($id_cabang);
        
        // Get recent orders for this branch
        $data['recent_orders'] = $this->get_recent_orders($id_cabang);
        
        // Get chart data (Orders this week)
        $data['chart_data'] = $this->get_daily_orders_chart($id_cabang);
        
        // Get recent activities (Orders + Inventory Alerts)
        $data['activities'] = $this->get_recent_activities($id_cabang);
        
        // Load the main view which will handle the layout structure
        $this->load->view('karyawan/index', $data);
    }
    
    private function get_cabang_info($id_cabang) {
        $this->db->select('c.*, p.nama_usaha');
        $this->db->from('cabang c');
        $this->db->join('pemilik p', 'c.id_pemilik = p.id_pemilik');
        $this->db->where('c.id_cabang', $id_cabang);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    private function get_pesanan_hari_ini($id_cabang) {
        $this->db->where('id_cabang', $id_cabang);
        $this->db->where('DATE(tgl_masuk)', date('Y-m-d'));
        return $this->db->count_all_results('pesanan');
    }
    
    private function get_pesanan_pending($id_cabang) {
        $this->db->where('id_cabang', $id_cabang);
        $this->db->where('status_pesanan', 'pending');
        return $this->db->count_all_results('pesanan');
    }
    
    private function get_pesanan_proses($id_cabang) {
        $this->db->where('id_cabang', $id_cabang);
        $this->db->where('status_pesanan', 'proses');
        return $this->db->count_all_results('pesanan');
    }
    
    private function get_recent_orders($id_cabang, $limit = 10) {
        $this->db->select('p.*, pl.nama as nama_pelanggan');
        $this->db->from('pesanan p');
        $this->db->join('pelanggan pl', 'p.id_pelanggan = pl.id_pelanggan', 'left');
        $this->db->where('p.id_cabang', $id_cabang);
        $this->db->order_by('p.tgl_masuk', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    private function get_daily_orders_chart($id_cabang) {
        $data = [];
        // Get last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $day_name = [$title = date('D', strtotime($date))]; // Mon, Tue...
            
            // INDONESIAN DAY NAMES
            $day_map = [
                'Sun' => 'Min', 'Mon' => 'Sen', 'Tue' => 'Sel', 'Wed' => 'Rab', 
                'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab'
            ];
            $label = $day_map[$title] ?? $title;
            
            $count = $this->db->where('id_cabang', $id_cabang)
                            ->where('DATE(tgl_masuk)', $date)
                            ->count_all_results('pesanan');
            
            $data[] = [
                'date' => $date,
                'label' => $label,
                'count' => $count
            ];
        }
        return $data;
    }
    
    private function get_recent_activities($id_cabang) {
        $activities = [];
        
        // 1. Recent Order Activities (Status changes or New orders)
        // Taking top 5 recent modified orders
        $this->db->select('p.id_pesanan, p.status_pesanan, p.updated_at, pl.nama as nama_pelanggan, k.nama as nama_karyawan');
        $this->db->from('pesanan p');
        $this->db->join('pelanggan pl', 'p.id_pelanggan = pl.id_pelanggan', 'left');
        $this->db->join('karyawan k', 'p.id_karyawan = k.id_karyawan', 'left'); // Who handled it?
        $this->db->where('p.id_cabang', $id_cabang);
        $this->db->order_by('p.updated_at', 'DESC');
        $this->db->limit(5);
        $orders = $this->db->get()->result();
        
        foreach($orders as $o) {
            $msg = "";
            $icon = "fa-check-circle";
            $color = "emerald";
            
            if ($o->status_pesanan == 'diterima') {
                $msg = "Pesanan #{$o->id_pesanan} baru diterima dari {$o->nama_pelanggan}";
                $icon = "fa-shopping-bag";
                $color = "blue";
            } elseif ($o->status_pesanan == 'selesai') {
                $handler = $o->nama_karyawan ? "oleh {$o->nama_karyawan}" : "";
                $msg = "Pesanan #{$o->id_pesanan} telah diselesaikan $handler";
                $icon = "fa-check-circle";
                $color = "emerald";
            } elseif ($o->status_pesanan == 'siap_diambil') {
                $msg = "Pesanan #{$o->id_pesanan} siap diambil";
                $icon = "fa-box";
                $color = "purple";
            } else {
                $msg = "Update pesanan #{$o->id_pesanan}: " . ucfirst($o->status_pesanan);
                $icon = "fa-info-circle";
                $color = "gray";
            }
            
            $activities[] = [
                'type' => 'order',
                'message' => $msg,
                'time' => $o->updated_at,
                'icon' => $icon,
                'color' => $color
            ];
        }
        
        // 2. Low Stock Alerts
        $this->db->select('nama_item, stok_tersedia');
        $this->db->from('inventori');
        $this->db->where('id_cabang', $id_cabang);
        $this->db->where('stok_tersedia <=', 5); // Warning threshold hardcoded or fetch from col?
        // Using stok_minimal column comparison properly
        // $this->db->where('stok_tersedia <=', 'stok_minimal', FALSE); --> CI3 doesn't support col comparison easily in where() string sometimes?
        // Let's use simple query string for safety
        $this->db->where("stok_tersedia <= stok_minimal", NULL, FALSE);
        $this->db->limit(3);
        $low_stock = $this->db->get()->result();
        
        foreach($low_stock as $item) {
            $activities[] = [
                'type' => 'stock',
                'message' => "Stok {$item->nama_item} hampir habis (Sisa: {$item->stok_tersedia})",
                'time' => date('Y-m-d H:i:s'), // Current time as it's an active alert
                'icon' => "fa-exclamation-triangle",
                'color' => "yellow"
            ];
        }
        
        // Sort by time DESC
        usort($activities, function($a, $b) {
            $timeA = !empty($a['time']) ? strtotime($a['time']) : 0;
            $timeB = !empty($b['time']) ? strtotime($b['time']) : 0;
            return $timeB - $timeA;
        });
        
        return array_slice($activities, 0, 7); // Return top 7
    }
}