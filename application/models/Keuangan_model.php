<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan_model extends CI_Model {
    
    private $table_pemasukan = 'pemasukan';
    private $table_pengeluaran = 'pengeluaran';
    private $table_bukti = 'bukti_transaksi';
    
    public function __construct() {
        parent::__construct();
    }
    
    // =============================================
    // PEMASUKAN METHODS
    // =============================================

    public function insert_pemasukan($data) {
        $insert_data = array(
            'id_cabang' => $data['id_cabang'],
            'nama_transaksi' => $data['nama_transaksi'],
            'kategori' => $data['kategori'], // Ini bukan ENUM lagi, bisa any string
            'jumlah' => $data['jumlah'],
            'tgl_transaksi' => $data['tgl_transaksi'],
            'id_pesanan' => isset($data['id_pesanan']) ? $data['id_pesanan'] : NULL,
            'keterangan' => isset($data['keterangan']) ? $data['keterangan'] : NULL,
            'id_karyawan' => isset($data['id_karyawan']) ? $data['id_karyawan'] : NULL,
            'created_at' => date('Y-m-d H:i:s')
        );
        
        $this->db->insert('pemasukan', $insert_data);
        return $this->db->insert_id();
    }

    public function update_pemasukan($id_pemasukan, $data) {
        $update_data = array(
            'id_cabang' => $data['id_cabang'],
            'nama_transaksi' => $data['nama_transaksi'],
            'kategori' => $data['kategori'],
            'jumlah' => $data['jumlah'],
            'tgl_transaksi' => $data['tgl_transaksi'],
            'keterangan' => isset($data['keterangan']) ? $data['keterangan'] : NULL,
            'updated_at' => date('Y-m-d H:i:s')
        );
        
        if (isset($data['id_pesanan'])) {
            $update_data['id_pesanan'] = $data['id_pesanan'];
        }
        
        $this->db->where('id_pemasukan', $id_pemasukan);
        $this->db->where('deleted_at IS NULL');
        return $this->db->update('pemasukan', $update_data);
    }

    public function delete_pemasukan($id_pemasukan) {
        $this->db->where('id_pemasukan', $id_pemasukan);
        return $this->db->update('pemasukan', array('deleted_at' => date('Y-m-d H:i:s')));
    }

    public function get_pemasukan_by_id($id_pemasukan) {
        $this->db->select('p.*, c.nama_cabang, k.nama as nama_karyawan, ps.kode_pesanan');
        $this->db->from('pemasukan p');
        $this->db->join('cabang c', 'c.id_cabang = p.id_cabang', 'left');
        $this->db->join('karyawan k', 'k.id_karyawan = p.id_karyawan', 'left');
        $this->db->join('pesanan ps', 'ps.id_pesanan = p.id_pesanan', 'left');
        $this->db->where('p.id_pemasukan', $id_pemasukan);
        $this->db->where('p.deleted_at IS NULL');
        return $this->db->get()->row();
    }

    public function get_all_pemasukan($filters = array()) {
        $this->db->select('p.*, c.nama_cabang, k.nama as nama_karyawan, ps.kode_pesanan');
        $this->db->from('pemasukan p');
        $this->db->join('cabang c', 'c.id_cabang = p.id_cabang', 'left');
        $this->db->join('karyawan k', 'k.id_karyawan = p.id_karyawan', 'left');
        $this->db->join('pesanan ps', 'ps.id_pesanan = p.id_pesanan', 'left');
        $this->db->where('p.deleted_at IS NULL');
        
        $this->apply_transaksi_filters('p', $filters);
        
        $this->db->order_by('p.tgl_transaksi', 'DESC');
        return $this->db->get()->result();
    }

    // =============================================
    // PENGELUARAN METHODS
    // =============================================

    public function insert_pengeluaran($data) {
        $insert_data = array(
            'id_cabang' => $data['id_cabang'],
            'nama_transaksi' => $data['nama_transaksi'],
            'kategori' => $data['kategori'],
            'jumlah' => $data['jumlah'],
            'tgl_transaksi' => $data['tgl_transaksi'],
            'keterangan' => isset($data['keterangan']) ? $data['keterangan'] : NULL,
            'id_karyawan' => isset($data['id_karyawan']) ? $data['id_karyawan'] : NULL,
            'created_at' => date('Y-m-d H:i:s')
        );
        
        $this->db->insert('pengeluaran', $insert_data);
        return $this->db->insert_id();
    }

    public function update_pengeluaran($id_pengeluaran, $data) {
        $update_data = array(
            'id_cabang' => $data['id_cabang'],
            'nama_transaksi' => $data['nama_transaksi'],
            'kategori' => $data['kategori'],
            'jumlah' => $data['jumlah'],
            'tgl_transaksi' => $data['tgl_transaksi'],
            'keterangan' => isset($data['keterangan']) ? $data['keterangan'] : NULL,
            'updated_at' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('id_pengeluaran', $id_pengeluaran);
        $this->db->where('deleted_at IS NULL');
        return $this->db->update('pengeluaran', $update_data);
    }

    public function delete_pengeluaran($id_pengeluaran) {
        $this->db->where('id_pengeluaran', $id_pengeluaran);
        return $this->db->update('pengeluaran', array('deleted_at' => date('Y-m-d H:i:s')));
    }

    public function get_pengeluaran_by_id($id_pengeluaran) {
        $this->db->select('p.*, c.nama_cabang, k.nama as nama_karyawan');
        $this->db->from('pengeluaran p');
        $this->db->join('cabang c', 'c.id_cabang = p.id_cabang', 'left');
        $this->db->join('karyawan k', 'k.id_karyawan = p.id_karyawan', 'left');
        $this->db->where('p.id_pengeluaran', $id_pengeluaran);
        $this->db->where('p.deleted_at IS NULL');
        return $this->db->get()->row();
    }

    public function get_all_pengeluaran($filters = array()) {
        $this->db->select('p.*, c.nama_cabang, k.nama as nama_karyawan');
        $this->db->from('pengeluaran p');
        $this->db->join('cabang c', 'c.id_cabang = p.id_cabang', 'left');
        $this->db->join('karyawan k', 'k.id_karyawan = p.id_karyawan', 'left');
        $this->db->where('p.deleted_at IS NULL');
        
        $this->apply_transaksi_filters('p', $filters);
        
        $this->db->order_by('p.tgl_transaksi', 'DESC');
        return $this->db->get()->result();
    }

    // =============================================
    // GABUNGAN TRANSAKSI (PEMASUKAN & PENGELUARAN)
    // =============================================

    public function get_all_transaksi($filters = array()) {
        // Query untuk pemasukan
        $this->db->select("
            p.id_pemasukan as id_transaksi,
            'pemasukan' as tipe_transaksi,
            p.nama_transaksi,
            p.kategori,
            p.jumlah,
            p.tgl_transaksi,
            p.keterangan,
            c.nama_cabang,
            k.nama as nama_karyawan,
            b.id_bukti,
            b.nama_file as bukti_file
        ");
        $this->db->from('pemasukan p');
        $this->db->join('cabang c', 'c.id_cabang = p.id_cabang', 'left');
        $this->db->join('karyawan k', 'k.id_karyawan = p.id_karyawan', 'left');
        $this->db->join('bukti_transaksi b', 'b.id_pemasukan = p.id_pemasukan AND b.deleted_at IS NULL', 'left');
        $this->db->where('p.deleted_at IS NULL');
        
        $this->apply_transaksi_filters('p', $filters);
        
        $query_pemasukan = $this->db->get_compiled_select();
        
        // Query untuk pengeluaran
        $this->db->select("
            p.id_pengeluaran as id_transaksi,
            'pengeluaran' as tipe_transaksi,
            p.nama_transaksi,
            p.kategori,
            p.jumlah,
            p.tgl_transaksi,
            p.keterangan,
            c.nama_cabang,
            k.nama as nama_karyawan,
            b.id_bukti,
            b.nama_file as bukti_file
        ");
        $this->db->from('pengeluaran p');
        $this->db->join('cabang c', 'c.id_cabang = p.id_cabang', 'left');
        $this->db->join('karyawan k', 'k.id_karyawan = p.id_karyawan', 'left');
        $this->db->join('bukti_transaksi b', 'b.id_pengeluaran = p.id_pengeluaran AND b.deleted_at IS NULL', 'left');
        $this->db->where('p.deleted_at IS NULL');
        
        $this->apply_transaksi_filters('p', $filters);
        
        $query_pengeluaran = $this->db->get_compiled_select();
        
        // Union kedua query
        $union_query = $this->db->query("
            ($query_pemasukan)
            UNION ALL
            ($query_pengeluaran)
            ORDER BY tgl_transaksi DESC
        ");
        
        return $union_query->result();
    }

    // =============================================
    // STATISTIK & SUMMARY
    // =============================================

    public function get_total_pemasukan($filters = array()) {
        $this->db->select_sum('jumlah');
        $this->db->from('pemasukan');
        $this->db->where('deleted_at IS NULL');
        $this->apply_transaksi_filters('', $filters);
        $result = $this->db->get()->row();
        return $result->jumlah ? $result->jumlah : 0;
    }

    public function get_total_pengeluaran($filters = array()) {
        $this->db->select_sum('jumlah');
        $this->db->from('pengeluaran');
        $this->db->where('deleted_at IS NULL');
        $this->apply_transaksi_filters('', $filters);
        $result = $this->db->get()->row();
        return $result->jumlah ? $result->jumlah : 0;
    }

    public function get_net_profit($filters = array()) {
        $total_pemasukan = $this->get_total_pemasukan($filters);
        $total_pengeluaran = $this->get_total_pengeluaran($filters);
        return $total_pemasukan - $total_pengeluaran;
    }

    public function get_jumlah_transaksi($tipe, $filters = array()) {
        $table = ($tipe == 'pemasukan') ? 'pemasukan' : 'pengeluaran';
        
        $this->db->select('COUNT(*) as total');
        $this->db->from($table);
        $this->db->where('deleted_at IS NULL');
        $this->apply_transaksi_filters('', $filters);
        
        $result = $this->db->get()->row();
        return $result->total ? $result->total : 0;
    }

    public function get_rata_rata($tipe, $filters = array()) {
        $table = ($tipe == 'pemasukan') ? 'pemasukan' : 'pengeluaran';
        
        $this->db->select('AVG(jumlah) as rata_rata');
        $this->db->from($table);
        $this->db->where('deleted_at IS NULL');
        $this->apply_transaksi_filters('', $filters);
        
        $result = $this->db->get()->row();
        return $result->rata_rata ? $result->rata_rata : 0;
    }

    public function get_summary_by_kategori($tipe, $filters = array()) {
        $table = ($tipe == 'pemasukan') ? 'pemasukan' : 'pengeluaran';
        
        $this->db->select('kategori, SUM(jumlah) as total, COUNT(*) as jumlah_transaksi');
        $this->db->from($table);
        $this->db->where('deleted_at IS NULL');
        $this->apply_transaksi_filters('', $filters);
        $this->db->group_by('kategori');
        $this->db->order_by('total', 'DESC');
        
        return $this->db->get()->result();
    }

    // =============================================
    // GRAFIK & CHART DATA
    // =============================================

    public function get_grafik_pemasukan($tahun, $id_cabang = null, $id_pemilik = null) {
        $this->db->select('MONTH(tgl_transaksi) as bulan, SUM(jumlah) as total, COUNT(*) as jumlah_transaksi');
        $this->db->from('pemasukan');
        $this->db->join('cabang', 'cabang.id_cabang = pemasukan.id_cabang', 'left'); // Add join for owner check
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('pemasukan.deleted_at IS NULL');
        
        if ($id_cabang) {
            $this->db->where('pemasukan.id_cabang', $id_cabang);
        }

        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        $this->db->group_by('MONTH(tgl_transaksi)');
        $this->db->order_by('bulan', 'ASC');
        
        return $this->db->get()->result();
    }

    public function get_grafik_pengeluaran($tahun, $id_cabang = null, $id_pemilik = null) {
        $this->db->select('MONTH(tgl_transaksi) as bulan, SUM(jumlah) as total, COUNT(*) as jumlah_transaksi');
        $this->db->from('pengeluaran');
        $this->db->join('cabang', 'cabang.id_cabang = pengeluaran.id_cabang', 'left'); // Add join for owner check
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $this->db->where('pengeluaran.deleted_at IS NULL');
        
        if ($id_cabang) {
            $this->db->where('pengeluaran.id_cabang', $id_cabang);
        }

        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }
        
        $this->db->group_by('MONTH(tgl_transaksi)');
        $this->db->order_by('bulan', 'ASC');
        
        return $this->db->get()->result();
    }

    public function get_tahun_list() {
        $current_year = date('Y');
        $years = array();
        
        // Get earliest year from pemasukan
        $query_pemasukan = $this->db->query("SELECT MIN(YEAR(tgl_transaksi)) as min_year FROM pemasukan WHERE deleted_at IS NULL");
        $min_year_pemasukan = $query_pemasukan->row()->min_year;
        
        // Get earliest year from pengeluaran
        $query_pengeluaran = $this->db->query("SELECT MIN(YEAR(tgl_transaksi)) as min_year FROM pengeluaran WHERE deleted_at IS NULL");
        $min_year_pengeluaran = $query_pengeluaran->row()->min_year;
        
        $min_year = min($min_year_pemasukan, $min_year_pengeluaran);
        
        if (!$min_year) {
            $min_year = $current_year;
        }
        
        for ($year = $current_year; $year >= $min_year; $year--) {
            $years[] = $year;
        }
        
        return $years;
    }

    // =============================================
    // CABANG
    // =============================================

    // =============================================
    // CABANG
    // =============================================

    public function get_all_cabang($id_pemilik = null) {
        $this->db->select('*');
        $this->db->from('cabang');
        $this->db->where('deleted_at IS NULL');
        $this->db->where('status', 'aktif');
        if ($id_pemilik) {
            $this->db->where('id_pemilik', $id_pemilik);
        }
        $this->db->order_by('nama_cabang', 'ASC');
        return $this->db->get()->result();
    }

    // =============================================
    // BUKTI TRANSAKSI METHODS
    // =============================================

    public function insert_bukti_transaksi($data) {
        $insert_data = array(
            'id_pemasukan' => isset($data['id_pemasukan']) ? $data['id_pemasukan'] : NULL,
            'id_pengeluaran' => isset($data['id_pengeluaran']) ? $data['id_pengeluaran'] : NULL,
            'nama_file' => $data['nama_file'],
            'path_file' => $data['path_file'],
            'ukuran_file' => isset($data['ukuran_file']) ? $data['ukuran_file'] : NULL,
            'tipe_file' => isset($data['tipe_file']) ? $data['tipe_file'] : NULL,
            'tgl_upload' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        );
        
        $this->db->insert('bukti_transaksi', $insert_data);
        return $this->db->insert_id();
    }

    public function update_bukti_transaksi($id_bukti, $data) {
        $update_data = array(
            'nama_file' => $data['nama_file'],
            'path_file' => $data['path_file'],
            'ukuran_file' => isset($data['ukuran_file']) ? $data['ukuran_file'] : NULL,
            'tipe_file' => isset($data['tipe_file']) ? $data['tipe_file'] : NULL,
            'tgl_upload' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('id_bukti', $id_bukti);
        $this->db->where('deleted_at IS NULL');
        return $this->db->update('bukti_transaksi', $update_data);
    }

    public function delete_bukti_transaksi($id_bukti) {
        $this->db->where('id_bukti', $id_bukti);
        return $this->db->update('bukti_transaksi', array('deleted_at' => date('Y-m-d H:i:s')));
    }

    public function get_bukti_transaksi_by_id($id_bukti) {
        $this->db->where('id_bukti', $id_bukti);
        $this->db->where('deleted_at IS NULL');
        return $this->db->get('bukti_transaksi')->row();
    }

    public function get_bukti_by_pemasukan($id_pemasukan) {
        $this->db->where('id_pemasukan', $id_pemasukan);
        $this->db->where('deleted_at IS NULL');
        return $this->db->get('bukti_transaksi')->row();
    }

    public function get_bukti_by_pengeluaran($id_pengeluaran) {
        $this->db->where('id_pengeluaran', $id_pengeluaran);
        $this->db->where('deleted_at IS NULL');
        return $this->db->get('bukti_transaksi')->row();
    }

    // =============================================
    // HELPER METHODS
    // =============================================

    private function apply_transaksi_filters($table_alias, $filters) {
        $prefix = $table_alias ? $table_alias . '.' : '';
        
        // RBAC: If id_pemilik is set in filters, restrict query to owner's branches
        if (isset($filters['id_pemilik']) && !empty($filters['id_pemilik'])) {
             // Subquery to get branches owned by this user
            $this->db->where($prefix . 'id_cabang IN (SELECT id_cabang FROM cabang WHERE id_pemilik = ' . $this->db->escape($filters['id_pemilik']) . ')', NULL, FALSE);
        }

        if (isset($filters['id_cabang']) && !empty($filters['id_cabang'])) {
            $this->db->where($prefix . 'id_cabang', $filters['id_cabang']);
        }
        
        if (isset($filters['kategori']) && !empty($filters['kategori'])) {
            $this->db->where($prefix . 'kategori', $filters['kategori']);
        }
        
        if (isset($filters['tgl_mulai']) && !empty($filters['tgl_mulai'])) {
            $this->db->where($prefix . 'tgl_transaksi >=', $filters['tgl_mulai']);
        }
        
        if (isset($filters['tgl_akhir']) && !empty($filters['tgl_akhir'])) {
            $this->db->where($prefix . 'tgl_transaksi <=', $filters['tgl_akhir']);
        }
        
        // PENTING: Tambahkan kondisi untuk tahun DAN bulan secara terpisah
        if (isset($filters['tahun']) && !empty($filters['tahun'])) {
            $this->db->where('YEAR(' . $prefix . 'tgl_transaksi)', $filters['tahun']);
        }
        
        if (isset($filters['bulan']) && !empty($filters['bulan'])) {
            $this->db->where('MONTH(' . $prefix . 'tgl_transaksi)', $filters['bulan']);
        }
    }
}
?>