<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Pesanan_model');
        $this->load->model('Karyawan_model');
        $this->load->model('Pelanggan_model');
        $this->load->model('Layanan_model');
        $this->load->library('session');
    }

    public function index()
    {
        // Get karyawan data from session
        $user_id = $this->session->userdata('user_id');
        $id_karyawan = $this->session->userdata('id_karyawan');
        $id_cabang = $this->session->userdata('id_cabang');

        // If not in session, try to get from database
        if (empty($id_cabang) && !empty($user_id)) {
            $karyawan = $this->Karyawan_model->getKaryawanByUserId($user_id);
            if ($karyawan) {
                $id_karyawan = $karyawan->id_karyawan;
                $id_cabang = $karyawan->id_cabang;
            }
        }

        // Fallback for testing - get first karyawan's cabang
        if (empty($id_cabang)) {
            $first_karyawan = $this->db->get('karyawan')->row();
            if ($first_karyawan) {
                $id_cabang = $first_karyawan->id_cabang;
                $id_karyawan = $first_karyawan->id_karyawan;
            }
        }

        // Get pesanan data
        $data['pesanan'] = $this->Pesanan_model->getAllPesananByCabang($id_cabang);

        // Get cabang info
        $cabang = $this->db->where('id_cabang', $id_cabang)->get('cabang')->row();
        $data['cabang'] = $cabang;
        $id_pemilik = $cabang ? $cabang->id_pemilik : null;

        // Status list
        $data['status_list'] = [
            'diterima' => 'Diterima',
            'dalam_proses' => 'Dalam Proses',
            'selesai' => 'Selesai',
            'siap_diambil' => 'Siap Diambil',
            'sudah_diambil' => 'Sudah Diambil',
            'dibatalkan' => 'Dibatalkan',
        ];

        // Get lists for form dropdowns - pelanggan difilter berdasarkan cabang
        $data['pelanggan_list'] = $this->Pelanggan_model->getAllPelangganForCabang($id_cabang);
        $data['layanan_list'] = $this->Layanan_model->getAllLayananByOwner($id_pemilik);

        // Store cabang and karyawan id for use in views/forms
        $data['id_cabang'] = $id_cabang;
        $data['id_karyawan'] = $id_karyawan;

        // Calculate statistics
        $pesanan = $data['pesanan'];
        $today = date('Y-m-d');
        
        $data['stats'] = [
            'today' => count(array_filter($pesanan, function($p) use ($today) {
                return date('Y-m-d', strtotime($p->tgl_masuk)) === $today;
            })),
            'selesai' => count(array_filter($pesanan, function($p) {
                return in_array($p->status_pesanan, ['selesai', 'siap_diambil', 'sudah_diambil']);
            })),
            'proses' => count(array_filter($pesanan, function($p) {
                return $p->status_pesanan === 'dalam_proses';
            })),
            'diterima' => count(array_filter($pesanan, function($p) {
                return $p->status_pesanan === 'diterima';
            })),
            'dibatalkan' => count(array_filter($pesanan, function($p) {
                return $p->status_pesanan === 'dibatalkan';
            })),
        ];

        $this->load->view('karyawan/pesanan/index', $data);
    }

    // Detail pesanan page
    public function detail($id = null)
    {
        if (!$id) {
            redirect('karyawan/pesanan');
        }

        // Get karyawan data from session
        $id_cabang = $this->session->userdata('id_cabang');
        $user_id = $this->session->userdata('user_id');

        // If not in session, try to get from database
        if (empty($id_cabang) && !empty($user_id)) {
            $karyawan = $this->Karyawan_model->getKaryawanByUserId($user_id);
            if ($karyawan) {
                $id_cabang = $karyawan->id_cabang;
            }
        }

        // Get pesanan data
        $pesanan = $this->Pesanan_model->getPesananById($id);
        
        if (!$pesanan) {
            redirect('karyawan/pesanan');
        }

        // Get detail items
        $detail_items = $this->Pesanan_model->getDetailPesanan($id);

        // Get progres list
        $progres_list = $this->Pesanan_model->getProgresPesanan($id);

        $data = [
            'pesanan' => $pesanan,
            'detail_items' => $detail_items,
            'progres_list' => $progres_list
        ];

        $this->load->view('karyawan/pesanan/detail', $data);
    }

    // Store new pesanan
    public function store()
    {
        // Handle FormData (multipart/form-data) instead of JSON
        $input = $this->input->post();

        // Validate required fields
        $required = ['id_pelanggan', 'id_layanan', 'jumlah_item', 'total_harga'];
        foreach ($required as $field) {
            if (empty($input[$field])) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['status' => 'error', 'message' => "Field $field wajib diisi"]));
            }
        }

        // Prepare data
        $data = [
            'id_cabang' => $input['id_cabang'],
            'id_pelanggan' => $input['id_pelanggan'],
            'id_layanan' => $input['id_layanan'],
            'id_karyawan' => $input['id_karyawan'] ?? null,
            'tgl_masuk' => $input['tgl_masuk'] ?? date('Y-m-d H:i:s'),
            'tgl_estimasi_selesai' => $input['tgl_estimasi_selesai'] ?? null,
            'jumlah_item' => $input['jumlah_item'],
            'total_harga' => $input['total_harga'],
            'status_pesanan' => 'diterima',
            'catatan' => $input['catatan'] ?? null,
        ];

        $id_pesanan = $this->Pesanan_model->insertPesanan($data);

        if ($id_pesanan) {
            // Add initial progress
            $this->Pesanan_model->insertProgres($id_pesanan, 'diterima', 'Pesanan diterima', $data['id_karyawan']);
            
            // Parse detail items from JSON string
            $detail_items = [];
            if (!empty($input['detail_items'])) {
                $detail_items = json_decode($input['detail_items'], true) ?: [];
            }
            
            // Insert detail items with foto upload
            $jumlah = (int) $input['jumlah_item'];
            for ($i = 0; $i < $jumlah; $i++) {
                $detail = $detail_items[$i] ?? [];
                $foto_sebelum = null;
                
                // Handle foto upload
                $foto_key = 'foto_sebelum_' . ($i + 1);
                if (!empty($_FILES[$foto_key]['name'])) {
                    $foto_sebelum = $this->uploadFoto($foto_key, $id_pesanan, $i + 1);
                }
                
                $detail_data = [
                    'id_pesanan' => $id_pesanan,
                    'id_layanan' => $input['id_layanan'],
                    'jenis_sepatu' => $detail['jenis_sepatu'] ?? null,
                    'warna' => $detail['warna'] ?? null,
                    'kondisi_awal' => $detail['kondisi_awal'] ?? null,
                    'catatan_khusus' => $detail['catatan_khusus'] ?? null,
                    'foto_sebelum' => $foto_sebelum,
                ];
                $this->Pesanan_model->insertDetailPesanan($detail_data);
            }
            
            $pesanan = $this->Pesanan_model->getPesananById($id_pesanan);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'success', 'message' => 'Pesanan berhasil ditambahkan', 'data' => $pesanan]));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => 'error', 'message' => 'Gagal menyimpan pesanan']));
    }

    // Upload foto helper
    private function uploadFoto($field_name, $id_pesanan, $item_number)
    {
        $upload_path = './uploads/pesanan/' . $id_pesanan . '/';
        
        // Create directory if not exists
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        
        $config = [
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|gif|webp',
            'max_size' => 5120, // 5MB
            'file_name' => 'sebelum_' . $item_number . '_' . time(),
        ];
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload($field_name)) {
            $upload_data = $this->upload->data();
            return 'uploads/pesanan/' . $id_pesanan . '/' . $upload_data['file_name'];
        }
        
        return null;
    }

    // Get pesanan by ID
    public function get($id)
    {
        $pesanan = $this->Pesanan_model->getPesananById($id);

        if (!$pesanan) {
            $resp = ['status' => 'error', 'message' => 'Pesanan tidak ditemukan'];
        } else {
            // Get detail items
            $detail_items = $this->Pesanan_model->getDetailPesananByPesananId($id);
            $resp = [
                'status' => 'success', 
                'data' => $pesanan,
                'detail_items' => $detail_items
            ];
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resp));
    }

    // Update pesanan via JSON
    public function update_json()
    {
        $raw = $this->input->raw_input_stream;
        $input = json_decode($raw, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Invalid JSON']));
        }

        $id = isset($input['id_pesanan']) ? $input['id_pesanan'] : null;
        if (empty($id)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Missing id_pesanan']));
        }

        // Whitelist fields
        $allowed = ['id_pelanggan', 'id_layanan', 'id_karyawan', 'tgl_masuk', 'total_harga', 'status_pesanan', 'jumlah_item', 'tgl_estimasi_selesai', 'catatan'];
        $data = [];
        foreach ($allowed as $f) {
            if (isset($input[$f])) $data[$f] = $input[$f];
        }

        // Check if status changed
        $new_status = isset($data['status_pesanan']) ? $data['status_pesanan'] : null;
        $old_status = $this->Pesanan_model->getCurrentStatus($id);

        $ok = $this->Pesanan_model->updatePesanan($id, $data);

        if ($ok) {
            // Add progress if status changed
            if ($new_status && $new_status !== $old_status) {
                $id_karyawan = isset($input['id_karyawan']) ? $input['id_karyawan'] : null;
                $this->Pesanan_model->insertProgres($id, $new_status, null, $id_karyawan);
            }

            $updated = $this->Pesanan_model->getPesananById($id);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'success', 'message' => 'Pesanan berhasil diperbarui', 'data' => $updated]));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => 'error', 'message' => 'Gagal memperbarui pesanan']));
    }

    // Update pesanan via FormData (with file upload)
    public function update()
    {
        $input = $this->input->post();
        
        $id = isset($input['id_pesanan']) ? $input['id_pesanan'] : null;
        if (empty($id)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Missing id_pesanan']));
        }

        // Whitelist fields
        $allowed = ['id_pelanggan', 'id_layanan', 'id_karyawan', 'tgl_masuk', 'total_harga', 'status_pesanan', 'jumlah_item', 'tgl_estimasi_selesai', 'catatan'];
        $data = [];
        foreach ($allowed as $f) {
            if (isset($input[$f])) $data[$f] = $input[$f];
        }

        // Check if status changed
        $new_status = isset($data['status_pesanan']) ? $data['status_pesanan'] : null;
        $old_status = $this->Pesanan_model->getCurrentStatus($id);
        
        // Get karyawan id from session
        $id_karyawan = $this->session->userdata('id_karyawan');

        $ok = $this->Pesanan_model->updatePesanan($id, $data);

        if ($ok) {
            // Add progress if status changed
            if ($new_status && $new_status !== $old_status) {
                $this->Pesanan_model->insertProgres($id, $new_status, null, $id_karyawan);
            }
            
            // Update detail items
            if (!empty($input['detail_items'])) {
                $detail_items = json_decode($input['detail_items'], true) ?: [];
                foreach ($detail_items as $index => $detail) {
                    if (!empty($detail['id_detail'])) {
                        $detail_data = [
                            'jenis_sepatu' => $detail['jenis_sepatu'] ?? null,
                            'warna' => $detail['warna'] ?? null,
                            'kondisi_awal' => $detail['kondisi_awal'] ?? null,
                            'catatan_khusus' => $detail['catatan_khusus'] ?? null,
                        ];
                        $this->Pesanan_model->updateDetailPesanan($detail['id_detail'], $detail_data);
                    }
                }
            }
            
            // Upload foto sesudah if provided
            for ($i = 1; $i <= 10; $i++) {
                $foto_key = 'foto_sesudah_' . $i;
                $detail_id_key = 'detail_id_' . $i;
                
                if (!empty($_FILES[$foto_key]['name']) && !empty($input[$detail_id_key])) {
                    $foto_path = $this->uploadFotoSesudah($foto_key, $id, $i);
                    if ($foto_path) {
                        $this->Pesanan_model->updateDetailPesanan($input[$detail_id_key], ['foto_sesudah' => $foto_path]);
                    }
                }
            }

            $updated = $this->Pesanan_model->getPesananById($id);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'success', 'message' => 'Pesanan berhasil diperbarui', 'data' => $updated]));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => 'error', 'message' => 'Gagal memperbarui pesanan']));
    }

    // Upload foto sesudah helper
    private function uploadFotoSesudah($field_name, $id_pesanan, $item_number)
    {
        $upload_path = './uploads/pesanan/' . $id_pesanan . '/';
        
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        
        $config = [
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|gif|webp',
            'max_size' => 5120,
            'file_name' => 'sesudah_' . $item_number . '_' . time(),
        ];
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload($field_name)) {
            $upload_data = $this->upload->data();
            return 'uploads/pesanan/' . $id_pesanan . '/' . $upload_data['file_name'];
        }
        
        return null;
    }

    // Delete pesanan
    public function delete()
    {
        $id = $this->input->post('id_pesanan');
        if (empty($id)) {
            // Try JSON input
            $raw = $this->input->raw_input_stream;
            $input = json_decode($raw, true);
            $id = isset($input['id_pesanan']) ? $input['id_pesanan'] : null;
        }

        if (empty($id)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Missing id_pesanan']));
        }

        $deleted = $this->Pesanan_model->deletePesanan($id);

        if ($deleted) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'success', 'message' => 'Pesanan berhasil dihapus']));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => 'error', 'message' => 'Gagal menghapus pesanan']));
    }

    // Quick status change
    public function quick_status()
    {
        $raw = $this->input->raw_input_stream;
        $input = json_decode($raw, true);

        $id = isset($input['id_pesanan']) ? $input['id_pesanan'] : null;
        $new_status = isset($input['status_pesanan']) ? $input['status_pesanan'] : null;

        if (empty($id) || empty($new_status)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Missing required fields']));
        }

        // Validate status
        $valid_statuses = ['diterima', 'dalam_proses', 'selesai', 'siap_diambil', 'sudah_diambil', 'dibatalkan'];
        if (!in_array($new_status, $valid_statuses)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'Invalid status']));
        }

        // Get old status and update
        $old_status = $this->Pesanan_model->getCurrentStatus($id);
        
        $data = ['status_pesanan' => $new_status];
        
        // Set related date fields
        if ($new_status === 'selesai' && $old_status !== 'selesai') {
            $data['tgl_selesai'] = date('Y-m-d H:i:s');
        }
        if ($new_status === 'sudah_diambil' && $old_status !== 'sudah_diambil') {
            $data['tgl_diambil'] = date('Y-m-d H:i:s');
        }

        $ok = $this->Pesanan_model->updatePesanan($id, $data);

        if ($ok) {
            // Add progress
            $id_karyawan = $this->session->userdata('id_karyawan');
            $this->Pesanan_model->insertProgres($id, $new_status, null, $id_karyawan);

            $status_labels = [
                'dalam_proses' => 'Dalam Proses',
                'selesai' => 'Selesai',
                'siap_diambil' => 'Siap Diambil',
                'sudah_diambil' => 'Sudah Diambil'
            ];

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'success', 
                    'message' => 'Status berhasil diubah ke ' . ($status_labels[$new_status] ?? $new_status)
                ]));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => 'error', 'message' => 'Gagal mengubah status']));
    }
}