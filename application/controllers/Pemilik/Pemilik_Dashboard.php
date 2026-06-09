<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemilik_Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('auth_library');
        $this->load->library('session');
        $this->load->model('Notification_model');
        
        // Require owner role
        $this->auth_library->require_role('owner');
    }
    public function index()  {
        // Get id_pemilik
        $id_pemilik = $this->session->userdata('id_pemilik');
        if (empty($id_pemilik)) {
            $id_user = $this->session->userdata('id_user');
            if ($id_user) {
                $owner = $this->db->get_where('pemilik', ['id_user' => $id_user])->row();
                if ($owner) $id_pemilik = $owner->id_pemilik;
            }
        }
        
        // Load Models
        $this->load->model('Pesanan_model');
        $this->load->model('Keuangan_model');
        $this->load->model('Pelanggan_model');

        // 1. Stats Cards Data
        $data['total_orders_today'] = $this->Pesanan_model->countOrdersToday($id_pemilik);
        $data['pending_pickups'] = $this->Pesanan_model->countPendingPickups($id_pemilik);
        $data['active_customers'] = $this->Pelanggan_model->countActiveCustomers($id_pemilik);
        
        // Revenue (Current Month)
        $revenue_filters = [
            'id_pemilik' => $id_pemilik,
            'bulan' => date('m'),
            'tahun' => date('Y')
        ];
        $data['monthly_revenue'] = $this->Keuangan_model->get_total_pemasukan($revenue_filters);

        // Revenue (Last Month)
        $last_month_date = date('Y-m-d', strtotime('first day of last month'));
        $revenue_filters_last = [
            'id_pemilik' => $id_pemilik,
            'bulan' => date('m', strtotime($last_month_date)),
            'tahun' => date('Y', strtotime($last_month_date))
        ];
        $last_month_revenue = $this->Keuangan_model->get_total_pemasukan($revenue_filters_last);
        
        // Calculate Growth %
        if ($last_month_revenue > 0) {
            $data['revenue_growth'] = (($data['monthly_revenue'] - $last_month_revenue) / $last_month_revenue) * 100;
        } else {
            $data['revenue_growth'] = $data['monthly_revenue'] > 0 ? 100 : 0;
        }

        // 2. Charts Data
        // Service Volume
        $data['service_volume'] = $this->Pesanan_model->getServiceVolume($id_pemilik);
        
        // Branch Performance (Revenue by Branch) - Reuse grafikCabang from Pelanggan_model? Or fetch from Keuangan?
        // Let's use Keuangan_model directly with manual query or iteration if no specific method exists.
        // Actually, let's look at `Keuangan_model::get_grafik_pemasukan`. It groups by month.
        // We need by *Branch*.
        // Let's iterate available branches and get revenue for each? 
        // Efficient way: `Keuangan_model` doesn't have `getRevenueByBranch`. 
        // Let's add simple inline query or use existing `get_all_cabang` and loop (dashboard usually has few branches).
        $branches = $this->Keuangan_model->get_all_cabang($id_pemilik);
        $branch_performance = [];
        foreach ($branches as $branch) {
            $f = ['id_cabang' => $branch->id_cabang, 'bulan' => date('m'), 'tahun' => date('Y')];
            $rev = $this->Keuangan_model->get_total_pemasukan($f);
            if ($rev > 0) {
                 $branch_performance[] = ['label' => $branch->nama_cabang, 'value' => $rev];
            }
        }
        $data['branch_performance'] = $branch_performance;

        // Revenue Trend (Last 6 Months)
        $revenue_trend = $this->Keuangan_model->get_grafik_pemasukan(date('Y'), null, $id_pemilik);
        // This returns current year only. For 6 months crossing year boundary, we might need 2 queries or adjust model.
        // For now, let's just show current year trend.
        $data['revenue_trend'] = $revenue_trend;

        // 3. Recent Orders
        $data['recent_orders'] = $this->Pesanan_model->getRecentOrders(5, $id_pemilik);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/index', $data);
        $this->load->view('template/footer');
    }

    /**
     * Get notifications (AJAX endpoint)
     */
    public function get_notifications() {
        // Set header first
        header('Content-Type: application/json');
        
        // Test basic response first
        $id_pemilik = $this->session->userdata('id_pemilik');
        
        if (empty($id_pemilik)) {
            $id_user = $this->session->userdata('id_user');
            if ($id_user) {
                $owner = $this->db->get_where('pemilik', ['id_user' => $id_user])->row();
                if ($owner) $id_pemilik = $owner->id_pemilik;
            }
        }

        if (empty($id_pemilik)) {
            echo json_encode([
                'success' => false,
                'message' => 'ID Pemilik tidak ditemukan',
                'notifications' => [],
                'unread_count' => 0
            ]);
            return;
        }
        
        // Check if table exists
        if (!$this->db->table_exists('notifications')) {
            echo json_encode([
                'success' => false,
                'error' => 'Table notifications tidak ditemukan',
                'notifications' => [],
                'unread_count' => 0
            ]);
            return;
        }
        
        // Fetch owner preferences to filter notifications
        $owner_settings = $this->db->select('notif_pesanan, notif_stok, notif_laporan')
            ->get_where('pemilik', ['id_pemilik' => $id_pemilik])
            ->row();

        $exclude_types = [];
        if ($owner_settings) {
            if ($owner_settings->notif_pesanan === '0') {
                $exclude_types = array_merge($exclude_types, ['order', 'payment', 'pickup']);
            }
            if ($owner_settings->notif_stok === '0') {
                $exclude_types = array_merge($exclude_types, ['stock', 'stok']);
            }
            if ($owner_settings->notif_laporan === '0') {
                $exclude_types = array_merge($exclude_types, ['report', 'laporan']);
            }
        }

        $where_exclude = '';
        if (!empty($exclude_types)) {
            $escaped_types = array_map(function($t) { return $this->db->escape($t); }, $exclude_types);
            $where_exclude = " AND type NOT IN (" . implode(',', $escaped_types) . ")";
        }

        // Simple query without model
        $query = $this->db->query("SELECT * FROM notifications WHERE id_pemilik = ? AND deleted_at IS NULL{$where_exclude} ORDER BY created_at DESC LIMIT 10", [$id_pemilik]);
        $notifications = $query->result();
        
        $count_query = $this->db->query("SELECT COUNT(*) as count FROM notifications WHERE id_pemilik = ? AND is_read = 0 AND deleted_at IS NULL{$where_exclude}", [$id_pemilik]);
        $unread_count = $count_query->row()->count;

        echo json_encode([
            'success' => true,
            'notifications' => $notifications,
            'unread_count' => (int)$unread_count
        ]);
    }

    /**
     * Mark notification as read (AJAX endpoint)
     */
    public function mark_notification_read($id) {
        $this->load->model('Notification_model');
        
        $result = $this->Notification_model->mark_as_read($id);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Notifikasi ditandai sudah dibaca' : 'Gagal menandai notifikasi'
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function mark_all_read() {
        $id_pemilik = $this->session->userdata('id_pemilik');
        if (empty($id_pemilik)) {
            $id_user = $this->session->userdata('id_user');
            if ($id_user) {
                $owner = $this->db->get_where('pemilik', ['id_user' => $id_user])->row();
                if ($owner) $id_pemilik = $owner->id_pemilik;
            }
        }

        $this->load->model('Notification_model');
        $result = $this->Notification_model->mark_all_as_read($id_pemilik);

        header('Content-Type: application/json');
        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Semua notifikasi ditandai sudah dibaca' : 'Gagal menandai notifikasi'
        ]);
    }
}