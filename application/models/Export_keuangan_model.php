<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export_keuangan_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ==================== SUMMARY & ANALYTICS ====================
    public function get_financial_summary($id_pemilik = null, $cabang_id = null)
    {
        // Query untuk total pemasukan - filter by owner's branches
        $this->db->select('COALESCE(SUM(p.jumlah), 0) as total_income');
        $this->db->from('pemasukan p');
        $this->db->join('cabang c', 'p.id_cabang = c.id_cabang');
        if ($id_pemilik) {
            $this->db->where('c.id_pemilik', $id_pemilik);
        }
        if ($cabang_id) {
            $this->db->where('p.id_cabang', $cabang_id);
        }
        $query_income = $this->db->get();
        $income = $query_income->row_array();
        
        // Query untuk total pengeluaran - filter by owner's branches
        $this->db->select('COALESCE(SUM(pg.jumlah), 0) as total_expenses');
        $this->db->from('pengeluaran pg');
        $this->db->join('cabang c', 'pg.id_cabang = c.id_cabang');
        if ($id_pemilik) {
            $this->db->where('c.id_pemilik', $id_pemilik);
        }
        if ($cabang_id) {
            $this->db->where('pg.id_cabang', $cabang_id);
        }
        $query_expense = $this->db->get();
        $expense = $query_expense->row_array();
        
        $result = [
            'total_income' => $income['total_income'] ?? 0,
            'total_expenses' => $expense['total_expenses'] ?? 0
        ];
        
        $result['net_profit'] = $result['total_income'] - $result['total_expenses'];
        
        return $result;
    }

    // ==================== TRANSACTION DATA ====================
    public function get_filtered_transactions($filters = array())
    {
        $transaction_type = isset($filters['transaction_type']) ? $filters['transaction_type'] : null;
        
        if ($transaction_type == 'income') {
            return $this->get_income_transactions($filters);
        } elseif ($transaction_type == 'expense') {
            return $this->get_expense_transactions($filters);
        } else {
            return $this->get_all_transactions($filters);
        }
    }

    private function get_all_transactions($filters)
    {
        // Query pemasukan
        $this->db->select("
            'pemasukan' as transaction_type,
            p.id_pemasukan as id,
            p.nama_transaksi as deskripsi,
            p.kategori,
            p.jumlah,
            p.tgl_transaksi as tanggal,
            c.nama_cabang,
            p.keterangan,
            p.created_at,
            'Pemasukan' as tipe_display
        ");
        $this->db->from('pemasukan p');
        $this->db->join('cabang c', 'p.id_cabang = c.id_cabang');
        $this->apply_common_filters($filters, 'p');
        $query_pemasukan = $this->db->get_compiled_select();
        $this->db->reset_query();
        
        // Query pengeluaran
        $this->db->select("
            'pengeluaran' as transaction_type,
            pg.id_pengeluaran as id,
            pg.nama_transaksi as deskripsi,
            pg.kategori,
            pg.jumlah,
            pg.tgl_transaksi as tanggal,
            c.nama_cabang,
            pg.keterangan,
            pg.created_at,
            'Pengeluaran' as tipe_display
        ");
        $this->db->from('pengeluaran pg');
        $this->db->join('cabang c', 'pg.id_cabang = c.id_cabang');
        $this->apply_common_filters($filters, 'pg');
        $query_pengeluaran = $this->db->get_compiled_select();
        
        // Gabungkan dengan UNION
        $union_query = $this->db->query("
            ($query_pemasukan) 
            UNION ALL 
            ($query_pengeluaran) 
            ORDER BY tanggal DESC, created_at DESC
        ");
        
        return $union_query->result_array();
    }

    private function get_income_transactions($filters)
    {
        $this->db->select("
            'pemasukan' as transaction_type,
            p.id_pemasukan as id,
            p.nama_transaksi as deskripsi,
            p.kategori,
            p.jumlah,
            p.tgl_transaksi as tanggal,
            c.nama_cabang,
            p.keterangan,
            p.created_at,
            'Pemasukan' as tipe_display
        ");
        $this->db->from('pemasukan p');
        $this->db->join('cabang c', 'p.id_cabang = c.id_cabang');
        $this->apply_common_filters($filters, 'p');
        $this->db->order_by('p.tgl_transaksi', 'DESC');
        $this->db->order_by('p.created_at', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    private function get_expense_transactions($filters)
    {
        $this->db->select("
            'pengeluaran' as transaction_type,
            pg.id_pengeluaran as id,
            pg.nama_transaksi as deskripsi,
            pg.kategori,
            pg.jumlah,
            pg.tgl_transaksi as tanggal,
            c.nama_cabang,
            pg.keterangan,
            pg.created_at,
            'Pengeluaran' as tipe_display
        ");
        $this->db->from('pengeluaran pg');
        $this->db->join('cabang c', 'pg.id_cabang = c.id_cabang');
        $this->apply_common_filters($filters, 'pg');
        $this->db->order_by('pg.tgl_transaksi', 'DESC');
        $this->db->order_by('pg.created_at', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    private function apply_common_filters($filters, $table_alias)
    {
        // Filter by owner's branches if id_pemilik is provided
        if (!empty($filters['id_pemilik'])) {
            $this->db->where('c.id_pemilik', $filters['id_pemilik']);
        }
        
        if (!empty($filters['id_cabang'])) {
            $this->db->where($table_alias . '.id_cabang', $filters['id_cabang']);
        }
        
        if (!empty($filters['kategori'])) {
            $this->db->where($table_alias . '.kategori', $filters['kategori']);
        }
        
        if (!empty($filters['date_start'])) {
            $this->db->where($table_alias . '.tgl_transaksi >=', $filters['date_start']);
        }
        
        if (!empty($filters['date_end'])) {
            $this->db->where($table_alias . '.tgl_transaksi <=', $filters['date_end']);
        }
        
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like($table_alias . '.nama_transaksi', $filters['search']);
            $this->db->or_like($table_alias . '.keterangan', $filters['search']);
            $this->db->group_end();
        }
    }

    // ==================== ANALYTICS METHODS ====================
    public function get_expense_breakdown($months = 12, $id_pemilik = null, $cabang_id = null)
    {
        $this->db->select("
            pg.kategori,
            COUNT(*) as count,
            SUM(pg.jumlah) as total,
            AVG(pg.jumlah) as avg_amount
        ");
        
        $this->db->from('pengeluaran pg');
        $this->db->join('cabang c', 'pg.id_cabang = c.id_cabang');
        
        if ($id_pemilik) {
            $this->db->where('c.id_pemilik', $id_pemilik);
        }
        if ($cabang_id) {
            $this->db->where('pg.id_cabang', $cabang_id);
        }
        
        $date_limit = date('Y-m-d', strtotime("-$months months"));
        $this->db->where('pg.tgl_transaksi >=', $date_limit);
        
        $this->db->group_by('pg.kategori');
        $this->db->order_by('total', 'DESC');
        
        $query = $this->db->get();
        $result = $query->result_array();
        
        // Calculate percentages
        $total_sum = 0;
        foreach ($result as $row) {
            $total_sum += $row['total'];
        }
        
        foreach ($result as &$row) {
            $row['percentage'] = $total_sum > 0 ? round(($row['total'] / $total_sum) * 100, 2) : 0;
        }
        
        return $result;
    }

    public function get_monthly_profit_loss($filters = array())
    {
        $this->db->select("
            c.id_cabang,
            c.nama_cabang,
            COALESCE(SUM(p.jumlah), 0) as total_income,
            COALESCE(SUM(pg.jumlah), 0) as total_expense,
            (COALESCE(SUM(p.jumlah), 0) - COALESCE(SUM(pg.jumlah), 0)) as net_profit
        ");
        
        $this->db->from('cabang c');
        $this->db->join('pemasukan p', 'c.id_cabang = p.id_cabang', 'left');
        $this->db->join('pengeluaran pg', 'c.id_cabang = pg.id_cabang', 'left');
        
        // Filter by owner's branches
        if (!empty($filters['id_pemilik'])) {
            $this->db->where('c.id_pemilik', $filters['id_pemilik']);
        }
        
        if (!empty($filters['date_start'])) {
            $this->db->group_start();
            $this->db->where('p.tgl_transaksi >=', $filters['date_start']);
            $this->db->or_where('pg.tgl_transaksi >=', $filters['date_start']);
            $this->db->group_end();
        }
        
        if (!empty($filters['date_end'])) {
            $this->db->group_start();
            $this->db->where('p.tgl_transaksi <=', $filters['date_end']);
            $this->db->or_where('pg.tgl_transaksi <=', $filters['date_end']);
            $this->db->group_end();
        }
        
        $this->db->group_by('c.id_cabang, c.nama_cabang');
        $this->db->order_by('net_profit', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_saldo_per_cabang($id_pemilik = null, $cabang_id = null)
    {
        $this->db->select("
            c.id_cabang,
            c.nama_cabang,
            COALESCE(SUM(p.jumlah), 0) as total_pemasukan,
            COALESCE(SUM(pg.jumlah), 0) as total_pengeluaran,
            (COALESCE(SUM(p.jumlah), 0) - COALESCE(SUM(pg.jumlah), 0)) as saldo
        ");
        
        $this->db->from('cabang c');
        $this->db->join('pemasukan p', 'c.id_cabang = p.id_cabang', 'left');
        $this->db->join('pengeluaran pg', 'c.id_cabang = pg.id_cabang', 'left');
        
        if ($id_pemilik) {
            $this->db->where('c.id_pemilik', $id_pemilik);
        }
        if ($cabang_id) {
            $this->db->where('c.id_cabang', $cabang_id);
        }
        
        $this->db->group_by('c.id_cabang, c.nama_cabang');
        $this->db->order_by('saldo', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    // ==================== GETTER METHODS ====================
    public function get_filtered_transactions_by_type($filters, $type)
    {
        $type_filters = $filters;
        $type_filters['transaction_type'] = $type;
        return $this->get_filtered_transactions($type_filters);
    }

    public function get_all_cabang()
    {
        $this->db->select("*");
        $this->db->from('cabang');
        $this->db->where('status', 'aktif');
        $this->db->where('deleted_at IS NULL');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_cabang_by_id($cabang_id)
    {
        $this->db->select("*");
        $this->db->from('cabang');
        $this->db->where('id_cabang', $cabang_id);
        $this->db->where('deleted_at IS NULL');
        
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_pemilik_by_id($pemilik_id)
    {
        $this->db->select("*");
        $this->db->from('pemilik');
        $this->db->where('id_pemilik', $pemilik_id);
        $this->db->where('deleted_at IS NULL');
        
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_income_categories()
    {
        $this->db->select('DISTINCT(kategori) as kategori');
        $this->db->from('pemasukan');
        $this->db->order_by('kategori', 'ASC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_expense_categories()
    {
        $this->db->select('DISTINCT(kategori) as kategori');
        $this->db->from('pengeluaran');
        $this->db->order_by('kategori', 'ASC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    // ==================== EXPORT METHODS ====================
    public function get_transactions_for_export($filters = array())
    {
        return $this->get_filtered_transactions($filters);
    }

    public function get_monthly_summary($cabang_id = null, $year = null)
    {
        if (!$year) {
            $year = date('Y');
        }
        
        $result = array();
        
        for ($month = 1; $month <= 12; $month++) {
            // Get income for month
            $this->db->select('COALESCE(SUM(jumlah), 0) as total');
            $this->db->from('pemasukan');
            $this->db->where('YEAR(tgl_transaksi)', $year);
            $this->db->where('MONTH(tgl_transaksi)', $month);
            if ($cabang_id) {
                $this->db->where('id_cabang', $cabang_id);
            }
            $query = $this->db->get();
            $income = $query->row_array();
            
            // Get expense for month
            $this->db->select('COALESCE(SUM(jumlah), 0) as total');
            $this->db->from('pengeluaran');
            $this->db->where('YEAR(tgl_transaksi)', $year);
            $this->db->where('MONTH(tgl_transaksi)', $month);
            if ($cabang_id) {
                $this->db->where('id_cabang', $cabang_id);
            }
            $query = $this->db->get();
            $expense = $query->row_array();
            
            $result[] = array(
                'month' => $month,
                'month_name' => date('F', mktime(0, 0, 0, $month, 1)),
                'income' => (float)($income['total'] ?? 0),
                'expense' => (float)($expense['total'] ?? 0),
                'profit' => (float)($income['total'] ?? 0) - (float)($expense['total'] ?? 0)
            );
        }
        
        return $result;
    }

    public function get_total_transactions($filters = array())
    {
        $transaction_type = isset($filters['transaction_type']) ? $filters['transaction_type'] : null;
        $count = 0;
        
        if (!$transaction_type || $transaction_type == 'income') {
            $this->db->select('COUNT(*) as total');
            $this->db->from('pemasukan p');
            $this->apply_common_filters($filters, 'p');
            $query = $this->db->get();
            $result = $query->row_array();
            $count += $result['total'] ?? 0;
        }
        
        if (!$transaction_type || $transaction_type == 'expense') {
            $this->db->select('COUNT(*) as total');
            $this->db->from('pengeluaran pg');
            $this->apply_common_filters($filters, 'pg');
            $query = $this->db->get();
            $result = $query->row_array();
            $count += $result['total'] ?? 0;
        }
        
        return $count;
    }
}