<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Keuangan_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('auth_library');
        $this->load->library('session');
        
        // Require owner role
        $this->auth_library->require_role('owner');
    }

    // Helper to get id_pemilik
    private function get_id_pemilik() {
        $id_pemilik = $this->session->userdata('id_pemilik');
        if (empty($id_pemilik)) {
            // Fallback: get from database using id_user (correct key)
            $id_user = $this->session->userdata('id_user');
            if ($id_user) {
                $owner = $this->db->get_where('pemilik', ['id_user' => $id_user])->row();
                if ($owner) return $owner->id_pemilik;
            }
        }
        return $id_pemilik;
    }

    // Helper to verify branch ownership
    private function verify_branch_ownership($id_cabang, $id_pemilik) {
        if (!$id_pemilik) return false;
        
        // Optimize: could cache this or use a specific model method
        // For now, fetch valid branches and check ID
        $valid_branches = $this->Keuangan_model->get_all_cabang($id_pemilik);
        foreach ($valid_branches as $branch) {
            if ($branch->id_cabang == $id_cabang) return true;
        }
        return false;
    }

    // ========== MAIN INDEX ==========
    public function index() {
        $id_pemilik = $this->get_id_pemilik();
        
        // Default ke tahun ini, tapi tidak filter bulan (tampilkan semua bulan dalam tahun)
        $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');
        $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : null; // Ubah ke null
        
        $filters = array(
            'tahun' => $tahun,
            'id_pemilik' => $id_pemilik // Enforce owner filter
        );
        
        // Hanya tambahkan bulan jika user memilih bulan tertentu
        if ($bulan) {
            $filters['bulan'] = $bulan;
        }
        
        if ($this->input->get('id_cabang')) {
            $id_cabang = $this->input->get('id_cabang');
            // Check ownership
             if ($this->verify_branch_ownership($id_cabang, $id_pemilik)) {
                 $filters['id_cabang'] = $id_cabang;
             }
        }
        
        if ($this->input->get('kategori')) {
            $filters['kategori'] = $this->input->get('kategori');
        }
        
        $data['total_pemasukan'] = $this->Keuangan_model->get_total_pemasukan($filters);
        $data['total_pengeluaran'] = $this->Keuangan_model->get_total_pengeluaran($filters);
        $data['net_profit'] = $this->Keuangan_model->get_net_profit($filters);
        $data['transaksi'] = $this->Keuangan_model->get_all_transaksi($filters);
        
        $data['tahun_list'] = $this->Keuangan_model->get_tahun_list();
        $data['selected_tahun'] = $tahun;
        $data['selected_bulan'] = $bulan;
        $data['cabang_list'] = $this->Keuangan_model->get_all_cabang($id_pemilik);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pemilik/keuangan/index', $data);
        $this->load->view('template/footer');
    }
    
    // ========== PEMASUKAN ==========
    
    public function add_pemasukan() {
        header('Content-Type: application/json');
        
        $id_pemilik = $this->get_id_pemilik();
        $this->form_validation->set_rules('id_cabang', 'Cabang', 'required|numeric');
        $this->form_validation->set_rules('nama_transaksi', 'Nama Transaksi', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('tgl_transaksi', 'Tanggal', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => strip_tags(validation_errors())
            ]);
            return;
        }

        $id_cabang = $this->input->post('id_cabang');
        if (!$this->verify_branch_ownership($id_cabang, $id_pemilik)) {
            echo json_encode(['success' => false, 'message' => 'Cabang tidak valid']);
            return;
        }
        
        $data = [
            'id_cabang' => $id_cabang,
            'nama_transaksi' => $this->input->post('nama_transaksi'),
            'kategori' => $this->input->post('kategori'),
            'jumlah' => $this->input->post('jumlah'),
            'tgl_transaksi' => $this->input->post('tgl_transaksi'),
            'id_pesanan' => $this->input->post('id_pesanan', true) ?: NULL,
            'keterangan' => $this->input->post('keterangan', true) ?: NULL,
            'id_karyawan' => $this->input->post('id_karyawan', true) ?: NULL
        ];
        
        $id = $this->Keuangan_model->insert_pemasukan($data);
        
        if ($id) {
            // Upload bukti transaksi jika ada
            if (!empty($_FILES['bukti_transaksi']['name'])) {
                $upload_result = $this->upload_bukti_transaksi('pemasukan', $id);
                if (!$upload_result['success']) {
                    echo json_encode([
                        'success' => false,
                        'message' => $upload_result['message']
                    ]);
                    return;
                }
            }
            
            echo json_encode([
                'success' => true,
                'message' => 'Pemasukan berhasil ditambahkan',
                'id' => $id
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menambahkan pemasukan'
            ]);
        }
    }
    
    public function get_pemasukan($id) {
        header('Content-Type: application/json');
        
        try {
            $id_pemilik = $this->get_id_pemilik();
            
            // If we can't identify the owner, return error (don't crash)
            if (!$id_pemilik) {
                echo json_encode([
                    'success' => false, 
                    'message' => 'Sesi tidak valid atau ID Pemilik tidak ditemukan. Silakan login ulang.'
                ]);
                return;
            }

            $item = $this->Keuangan_model->get_pemasukan_by_id($id);
            
            if ($item) {
                // Verify ownership via branch
                if (!$this->verify_branch_ownership($item->id_cabang, $id_pemilik)) {
                     echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
                     return;
                }

                // Get bukti transaksi
                $bukti = $this->Keuangan_model->get_bukti_by_pemasukan($id);
                $item->bukti_transaksi = $bukti;
                
                echo json_encode([
                    'success' => true,
                    'data' => $item
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Get Pemasukan Error: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
    
    public function update_pemasukan($id) {
        header('Content-Type: application/json');
        
        $id_pemilik = $this->get_id_pemilik();
        
        // Verify exist & ownership
        $existing = $this->Keuangan_model->get_pemasukan_by_id($id);
        if (!$existing || !$this->verify_branch_ownership($existing->id_cabang, $id_pemilik)) {
            echo json_encode(['success' => false, 'message' => 'Akses ditolak atau data tidak ditemukan']);
            return;
        }

        $this->form_validation->set_rules('id_cabang', 'Cabang', 'required|numeric');
        $this->form_validation->set_rules('nama_transaksi', 'Nama Transaksi', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('tgl_transaksi', 'Tanggal', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => strip_tags(validation_errors())
            ]);
            return;
        }

        $id_cabang = $this->input->post('id_cabang');
        if (!$this->verify_branch_ownership($id_cabang, $id_pemilik)) {
            echo json_encode(['success' => false, 'message' => 'Cabang tujuan tidak valid']);
            return;
        }
        
        $data = [
            'id_cabang' => $id_cabang,
            'nama_transaksi' => $this->input->post('nama_transaksi'),
            'kategori' => $this->input->post('kategori'),
            'jumlah' => $this->input->post('jumlah'),
            'tgl_transaksi' => $this->input->post('tgl_transaksi'),
            'id_pesanan' => $this->input->post('id_pesanan', true) ?: NULL,
            'keterangan' => $this->input->post('keterangan', true) ?: NULL,
            'id_karyawan' => $this->input->post('id_karyawan', true) ?: NULL
        ];
        
        if ($this->Keuangan_model->update_pemasukan($id, $data)) {
            // Upload bukti transaksi jika ada
            if (!empty($_FILES['bukti_transaksi']['name'])) {
                $this->upload_bukti_transaksi('pemasukan', $id);
            }
            
            echo json_encode([
                'success' => true,
                'message' => 'Pemasukan berhasil diupdate'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mengupdate pemasukan'
            ]);
        }
    }
    
    public function delete_pemasukan($id) {
        header('Content-Type: application/json');
        
        try {
            $id_pemilik = $this->get_id_pemilik();
            
            if (!$id_pemilik) {
                echo json_encode(['success' => false, 'message' => 'Sesi tidak valid. Silakan login ulang.']);
                return;
            }

            // Verify exist & ownership
            $existing = $this->Keuangan_model->get_pemasukan_by_id($id);
            if (!$existing) {
                 echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
                 return;
            }
            
            if (!$this->verify_branch_ownership($existing->id_cabang, $id_pemilik)) {
                echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
                return;
            }
            
            if ($this->Keuangan_model->delete_pemasukan($id)) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Pemasukan berhasil dihapus'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal menghapus pemasukan'
                ]);
            }
        } catch (\Throwable $e) {
             log_message('error', 'Delete Pemasukan Error: ' . $e->getMessage());
             echo json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
             ]);
        }
    }
    
    // ========== PENGELUARAN ==========
    
    public function add_pengeluaran() {
        header('Content-Type: application/json');
        
        $id_pemilik = $this->get_id_pemilik();
        $this->form_validation->set_rules('id_cabang', 'Cabang', 'required|numeric');
        $this->form_validation->set_rules('nama_transaksi', 'Nama Transaksi', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('tgl_transaksi', 'Tanggal', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => strip_tags(validation_errors())
            ]);
            return;
        }
        
        $id_cabang = $this->input->post('id_cabang');
        if (!$this->verify_branch_ownership($id_cabang, $id_pemilik)) {
            echo json_encode(['success' => false, 'message' => 'Cabang tidak valid']);
            return;
        }

        $data = [
            'id_cabang' => $id_cabang,
            'nama_transaksi' => $this->input->post('nama_transaksi'),
            'kategori' => $this->input->post('kategori'),
            'jumlah' => $this->input->post('jumlah'),
            'tgl_transaksi' => $this->input->post('tgl_transaksi'),
            'keterangan' => $this->input->post('keterangan', true) ?: NULL,
            'id_karyawan' => $this->input->post('id_karyawan', true) ?: NULL
        ];
        
        $id = $this->Keuangan_model->insert_pengeluaran($data);
        
        if ($id) {
            // Upload bukti transaksi jika ada
            if (!empty($_FILES['bukti_transaksi']['name'])) {
                $upload_result = $this->upload_bukti_transaksi('pengeluaran', $id);
                if (!$upload_result['success']) {
                    echo json_encode([
                        'success' => false,
                        'message' => $upload_result['message']
                    ]);
                    return;
                }
            }
            
            echo json_encode([
                'success' => true,
                'message' => 'Pengeluaran berhasil ditambahkan',
                'id' => $id
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menambahkan pengeluaran'
            ]);
        }
    }
    
    public function get_pengeluaran($id) {
        header('Content-Type: application/json');
        $item = $this->Keuangan_model->get_pengeluaran_by_id($id);
        
        if ($item) {
             // Verify ownership via branch
            $id_pemilik = $this->get_id_pemilik();
            if (!$this->verify_branch_ownership($item->id_cabang, $id_pemilik)) {
                 echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
                 return;
            }

            // Get bukti transaksi
            $bukti = $this->Keuangan_model->get_bukti_by_pengeluaran($id);
            $item->bukti_transaksi = $bukti;
            
            echo json_encode([
                'success' => true,
                'data' => $item
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
    
    public function update_pengeluaran($id) {
        header('Content-Type: application/json');
        
        $id_pemilik = $this->get_id_pemilik();
        // Verify exist & ownership
        $existing = $this->Keuangan_model->get_pengeluaran_by_id($id);
        if (!$existing || !$this->verify_branch_ownership($existing->id_cabang, $id_pemilik)) {
            echo json_encode(['success' => false, 'message' => 'Akses ditolak atau data tidak ditemukan']);
            return;
        }

        $this->form_validation->set_rules('id_cabang', 'Cabang', 'required|numeric');
        $this->form_validation->set_rules('nama_transaksi', 'Nama Transaksi', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('tgl_transaksi', 'Tanggal', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => strip_tags(validation_errors())
            ]);
            return;
        }
        
        $id_cabang = $this->input->post('id_cabang');
        if (!$this->verify_branch_ownership($id_cabang, $id_pemilik)) {
            echo json_encode(['success' => false, 'message' => 'Cabang tujuan tidak valid']);
            return;
        }

        $data = [
            'id_cabang' => $id_cabang,
            'nama_transaksi' => $this->input->post('nama_transaksi'),
            'kategori' => $this->input->post('kategori'),
            'jumlah' => $this->input->post('jumlah'),
            'tgl_transaksi' => $this->input->post('tgl_transaksi'),
            'keterangan' => $this->input->post('keterangan', true) ?: NULL,
            'id_karyawan' => $this->input->post('id_karyawan', true) ?: NULL
        ];
        
        if ($this->Keuangan_model->update_pengeluaran($id, $data)) {
            // Upload bukti transaksi jika ada
            if (!empty($_FILES['bukti_transaksi']['name'])) {
                $this->upload_bukti_transaksi('pengeluaran', $id);
            }
            
            echo json_encode([
                'success' => true,
                'message' => 'Pengeluaran berhasil diupdate'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mengupdate pengeluaran'
            ]);
        }
    }
    
    public function delete_pengeluaran($id) {
        header('Content-Type: application/json');
        
        $id_pemilik = $this->get_id_pemilik();
        // Verify exist & ownership
        $existing = $this->Keuangan_model->get_pengeluaran_by_id($id);
        if (!$existing || !$this->verify_branch_ownership($existing->id_cabang, $id_pemilik)) {
            echo json_encode(['success' => false, 'message' => 'Akses ditolak atau data tidak ditemukan']);
            return;
        }

        if ($this->Keuangan_model->delete_pengeluaran($id)) {
            echo json_encode([
                'success' => true,
                'message' => 'Pengeluaran berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus pengeluaran'
            ]);
        }
    }
    
    // ========== BUKTI TRANSAKSI ==========
    
    private function upload_bukti_transaksi($tipe, $id_transaksi) {
        $config['upload_path'] = './uploads/bukti_transaksi/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;
        
        // Create directory if not exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('bukti_transaksi')) {
            return [
                'success' => false,
                'message' => $this->upload->display_errors('', '')
            ];
        }
        
        $upload_data = $this->upload->data();
        
        $bukti_data = [
            'id_' . $tipe => $id_transaksi,
            'nama_file' => $upload_data['orig_name'],
            'path_file' => 'uploads/bukti_transaksi/' . $upload_data['file_name'],
            'ukuran_file' => $upload_data['file_size'] * 1024,
            'tipe_file' => $upload_data['file_ext']
        ];
        
        // Check if bukti already exists
        $existing_bukti = $tipe === 'pemasukan' ? 
            $this->Keuangan_model->get_bukti_by_pemasukan($id_transaksi) :
            $this->Keuangan_model->get_bukti_by_pengeluaran($id_transaksi);
        
        if ($existing_bukti) {
            // Delete old file
            if (file_exists('./' . $existing_bukti->path_file)) {
                unlink('./' . $existing_bukti->path_file);
            }
            // Update bukti
            $this->Keuangan_model->update_bukti_transaksi($existing_bukti->id_bukti, $bukti_data);
        } else {
            // Insert new bukti
            $this->Keuangan_model->insert_bukti_transaksi($bukti_data);
        }
        
        return ['success' => true];
    }
    
    // ========== GRAFIK & CHART DATA ==========

    public function get_grafik_gabungan() {
        header('Content-Type: application/json');
        
        try {
            $id_pemilik = $this->get_id_pemilik();
            $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');
            $id_cabang = $this->input->get('id_cabang') ? $this->input->get('id_cabang') : null;
            
            // Validate branch
            if ($id_cabang && !$this->verify_branch_ownership($id_cabang, $id_pemilik)) {
                 $id_cabang = null; // Ignore invalid branch filter, fallback to all owned branches
            }

            // Filters logic in model will handle empty id_cabang but MUST respect id_pemilik not explicitly passed to this method!
            // Wait, Keuangan_model::get_grafik_pemasukan DOES NOT accept id_pemilik natively. 
            // I need to update get_grafik_pemasukan in Keuangan_model first or pass it there?
            // Actually I missed updating get_grafik_pemasukan/pengeluaran in the Model step.
            // But I can simulate it by passing $id_cabang if user selected one, 
            // OR if user selected NONE, I must pass a list of valid branches?
            // Cleaner way: Update model to accept id_pemilik or verify ownership inside.
            
            // Let's assume I will fix model in next step or use what I have.
            // Model methods `get_grafik_pemasukan` currently only take `id_cabang`.
            // If `id_cabang` is null, it returns GLOBAL data. THIS IS A BUG.
            // I need to patch `get_grafik_pemasukan` in model too.
            // For now, I will proceed with controller update, and then go back to model to fix the chart methods.
            
            $pemasukan = $this->Keuangan_model->get_grafik_pemasukan($tahun, $id_cabang, $id_pemilik);
            $pengeluaran = $this->Keuangan_model->get_grafik_pengeluaran($tahun, $id_cabang, $id_pemilik);
            
            $grafik_data = array();
            for ($i = 1; $i <= 12; $i++) {
                $data_bulan = array(
                    'bulan' => $i,
                    'nama_bulan' => $this->get_nama_bulan($i),
                    'pemasukan' => 0,
                    'pengeluaran' => 0,
                    'laba_rugi' => 0
                );
                
                foreach ($pemasukan as $row) {
                    if ($row->bulan == $i) {
                        $data_bulan['pemasukan'] = (float)$row->total;
                        break;
                    }
                }
                
                foreach ($pengeluaran as $row) {
                    if ($row->bulan == $i) {
                        $data_bulan['pengeluaran'] = (float)$row->total;
                        break;
                    }
                }
                
                $data_bulan['laba_rugi'] = $data_bulan['pemasukan'] - $data_bulan['pengeluaran'];
                
                $grafik_data[] = $data_bulan;
            }
            
            echo json_encode(array(
                'success' => true,
                'data' => $grafik_data,
                'tahun' => $tahun
            ));
                
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ));
        }
    }

    public function get_summary_kategori() {
        header('Content-Type: application/json');
        
        try {
            $id_pemilik = $this->get_id_pemilik();
            $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');
            $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : null;
            $id_cabang = $this->input->get('id_cabang') ? $this->input->get('id_cabang') : null;
            $tipe = $this->input->get('tipe') ? $this->input->get('tipe') : 'pengeluaran';
            
            // Validate branch
             if ($id_cabang && !$this->verify_branch_ownership($id_cabang, $id_pemilik)) {
                 $id_cabang = null;
            }
            
            $filters = array(
                'tahun' => $tahun,
                'id_pemilik' => $id_pemilik // This works because get_summary_by_kategori uses apply_transaksi_filters
            );
            
            if ($bulan) $filters['bulan'] = $bulan;
            if ($id_cabang) $filters['id_cabang'] = $id_cabang;
            
            $data = $this->Keuangan_model->get_summary_by_kategori($tipe, $filters);
            
            echo json_encode(array(
                'success' => true,
                'data' => $data,
                'tipe' => $tipe,
                'periode' => ($bulan ? $this->get_nama_bulan($bulan) . ' ' : '') . $tahun
            ));
                
        } catch (\Throwable $e) {
            echo json_encode(array(
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ));
        }
    }

    private function get_nama_bulan($bulan) {
        $nama_bulan = array(
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        );
        
        return isset($nama_bulan[$bulan]) ? $nama_bulan[$bulan] : '';
    }
    public function test() {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'Controller Keuangan berfungsi!',
        'base_url' => base_url(),
        'timestamp' => date('Y-m-d H:i:s')
    ]);
}

public function test_insert() {
    header('Content-Type: application/json');
    
    // Test data
    $data = [
        'id_cabang' => 1,
        'nama_transaksi' => 'Test Transaksi',
        'kategori' => 'Penjualan',
        'jumlah' => 50000,
        'tgl_transaksi' => date('Y-m-d'),
        'keterangan' => 'Testing insert'
    ];
    
    $id = $this->Keuangan_model->insert_pemasukan($data);
    
    echo json_encode([
        'success' => $id ? true : false,
        'message' => $id ? 'Test insert berhasil' : 'Test insert gagal',
        'id' => $id,
        'data' => $data
    ]);
}
}
?>