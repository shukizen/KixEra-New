<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{

    private $table = 'pesanan';
    private $table_detail = 'detail_pesanan';
    private $table_progres = 'progres_pesanan';
    private $table_nota = 'nota';

    public function __construct()
    {
        parent::__construct();
    }
    public function getAllPesananByOwner($id_pemilik)
    {
        $this->db->select('
            pesanan.*,
            pelanggan.nama AS nama_pelanggan,
            pelanggan.no_telp,
            layanan.nama_layanan,
            karyawan.nama AS nama_karyawan,
            cabang.nama_cabang
        ');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left');
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = pesanan.id_karyawan', 'left');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang', 'left');

        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('pesanan.deleted_at IS NULL');

        return $this->db->get()->result();
    }

    public function insertNota($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table_nota, $data);
    }

    public function generateNoNota()
    {
        $this->db->select('no_nota');
        $this->db->from($this->table_nota);
        $this->db->like('no_nota', 'NOTA-' . date('Ymd'), 'after');
        $this->db->order_by('no_nota', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $last_nota = $query->row()->no_nota;
            $last_number = (int) substr($last_nota, -4);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        return 'NOTA-' . date('Ymd') . '-' . str_pad($new_number, 4, '0', STR_PAD_LEFT);
    }

    public function getNotaById($id_nota)
    {
        $this->db->where('id_nota', $id_nota);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table_nota);
        return $query->row();
    }

    // Update pesanan
    public function updatePesanan($id_pesanan, $data)
    {
        // Check if status is being updated
        $status_changed = false;
        $new_status = null;
        $old_status = null;

        if (isset($data['status_pesanan'])) {
            $old_status = $this->getCurrentStatus($id_pesanan);
            $new_status = $data['status_pesanan'];
            if ($old_status !== $new_status) {
                $status_changed = true;
            }
        }

        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_pesanan', $id_pesanan);
        $result = $this->db->update($this->table, $data);

        if ($result && $status_changed) {
            $pesanan = $this->getPesananById($id_pesanan);
            if ($pesanan) {
                // Integrasi pengurangan/pengembalian stok otomatis
                $this->load->model('Inventori_model');
                if ($new_status === 'dalam_proses') {
                    $this->Inventori_model->kurangi_stok_layanan($pesanan->id_layanan, $pesanan->id_cabang, $pesanan->nomor_pesanan, $pesanan->jumlah_item);
                } elseif ($new_status === 'dibatalkan' && $old_status === 'dalam_proses') {
                    $this->Inventori_model->kembalikan_stok_layanan($pesanan->id_layanan, $pesanan->id_cabang, $pesanan->nomor_pesanan, $pesanan->jumlah_item);
                }

                $cabang = $this->db->select('id_pemilik, nama_cabang')->get_where('cabang', ['id_cabang' => $pesanan->id_cabang])->row();
                if ($cabang) {
                    $status_labels = [
                        'diterima' => 'Diterima',
                        'dalam_proses' => 'Dalam Proses',
                        'selesai' => 'Selesai',
                        'siap_diambil' => 'Siap Diambil',
                        'sudah_diambil' => 'Sudah Diambil',
                        'dibatalkan' => 'Dibatalkan'
                    ];
                    $status_text = $status_labels[$new_status] ?? $new_status;
                    $notif_type = 'order';
                    if ($new_status === 'siap_diambil' || $new_status === 'sudah_diambil') {
                        $notif_type = 'pickup';
                    }

                    $this->load->model('Notification_model');
                    $this->Notification_model->create([
                        'id_pemilik' => $cabang->id_pemilik,
                        'title' => 'Status Pesanan Diperbarui',
                        'message' => 'Status pesanan #' . $pesanan->nomor_pesanan . ' di cabang ' . $cabang->nama_cabang . ' berubah menjadi: ' . $status_text . '.',
                        'type' => $notif_type,
                        'related_id' => $id_pesanan
                    ]);
                }
            }
        }

        return $result;
    }

    // Soft delete pesanan
    public function deletePesanan($id_pesanan)
    {
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->update($this->table, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getPesananById($id_pesanan, $id_pemilik = null)
    {
        $this->db->select('
            pesanan.*,
            pelanggan.nama AS nama_pelanggan,
            pelanggan.no_telp,
            layanan.nama_layanan,
            karyawan.nama AS nama_karyawan,
            cabang.nama_cabang,
            (SELECT COUNT(*) FROM detail_pesanan WHERE detail_pesanan.id_pesanan = pesanan.id_pesanan AND (foto_sesudah IS NULL OR foto_sesudah = "")) as pending_photos
        ');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left');
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = pesanan.id_karyawan', 'left');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang', 'left');

        $this->db->where('pesanan.id_pesanan', $id_pesanan);
        $this->db->where('pesanan.deleted_at IS NULL');

        if ($id_pemilik) {
            $this->db->where('cabang.id_pemilik', $id_pemilik);
        }

        return $this->db->get()->row();
    }

    // Verify ownership helper
    public function verify_ownership($id_pesanan, $id_pemilik)
    {
        $this->db->select('pesanan.id_pesanan');
        $this->db->from('pesanan');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
        $this->db->where('pesanan.id_pesanan', $id_pesanan);
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    // Get pesanan detail from view (includes all joins)
    public function getPesananDetailFromView($id_pesanan)
    {
        $this->db->select('
            v.*, 
            p.nomor_pesanan,
            p.status_pembayaran,
            p.metode_pembayaran,
            p.catatan,
            p.created_at,
            p.updated_at
        ');
        $this->db->from('v_pesanan_detail v');
        $this->db->join('pesanan p', 'p.id_pesanan = v.id_pesanan', 'left');
        $this->db->where('v.id_pesanan', $id_pesanan);
        $query = $this->db->get();
        return $query->row();
    }

    // Get detail items for a pesanan
    public function getDetailPesanan($id_pesanan)
    {
        $this->db->where('id_pesanan', $id_pesanan);
        $this->db->where('deleted_at IS NULL');
        return $this->db->get('detail_pesanan')->result();
    }

    // Get progress/timeline for a pesanan
    public function getProgresPesanan($id_pesanan)
    {
        $this->db->select('progres_pesanan.*, karyawan.nama as nama_karyawan');
        $this->db->from('progres_pesanan');
        $this->db->join('karyawan', 'karyawan.id_karyawan = progres_pesanan.id_karyawan', 'left');
        $this->db->where('progres_pesanan.id_pesanan', $id_pesanan);
        $this->db->where('progres_pesanan.deleted_at IS NULL');
        $this->db->order_by('progres_pesanan.tgl_update', 'ASC');
        return $this->db->get()->result();
    }

    // Insert new progress record
    public function insertProgres($id_pesanan, $status, $deskripsi = null, $id_karyawan = null)
    {
        $data = [
            'id_pesanan' => $id_pesanan,
            'status' => $status,
            'deskripsi' => $deskripsi ?? $this->getStatusDescription($status),
            'id_karyawan' => $id_karyawan,
            'tgl_update' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('progres_pesanan', $data);
    }

    // Get default description for status
    private function getStatusDescription($status)
    {
        $descriptions = [
            'diterima' => 'Pesanan diterima',
            'dalam_proses' => 'Pesanan sedang diproses',
            'selesai' => 'Pesanan selesai dikerjakan',
            'siap_diambil' => 'Pesanan siap untuk diambil',
            'sudah_diambil' => 'Pesanan sudah diambil oleh pelanggan',
            'dibatalkan' => 'Pesanan dibatalkan'
        ];
        return $descriptions[$status] ?? 'Status diperbarui';
    }

    // Get current status of a pesanan
    public function getCurrentStatus($id_pesanan)
    {
        $this->db->select('status_pesanan');
        $this->db->where('id_pesanan', $id_pesanan);
        $row = $this->db->get('pesanan')->row();
        return $row ? $row->status_pesanan : null;
    }

    // Get all pesanan by cabang (untuk karyawan)
    public function getAllPesananByCabang($id_cabang)
    {
        $this->db->select('
            pesanan.*,
            pelanggan.nama AS nama_pelanggan,
            pelanggan.no_telp,
            layanan.nama_layanan,
            layanan.harga AS harga_layanan,
            karyawan.nama AS nama_karyawan,
            cabang.nama_cabang,
            (SELECT COUNT(*) FROM detail_pesanan WHERE detail_pesanan.id_pesanan = pesanan.id_pesanan AND (foto_sesudah IS NULL OR foto_sesudah = "")) as pending_photos
        ');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left');
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = pesanan.id_karyawan', 'left');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang', 'left');

        $this->db->where('pesanan.id_cabang', $id_cabang);
        $this->db->where('pesanan.deleted_at IS NULL');
        $this->db->order_by('pesanan.created_at', 'DESC');

        return $this->db->get()->result();
    }

    // Insert pesanan baru
    public function insertPesanan($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        if (empty($data['nomor_pesanan'])) {
            $data['nomor_pesanan'] = $this->generateNomorPesanan();
        }

        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            $cabang = $this->db->select('id_pemilik, nama_cabang')->get_where('cabang', ['id_cabang' => $data['id_cabang']])->row();
            if ($cabang) {
                $this->load->model('Notification_model');
                $this->Notification_model->create([
                    'id_pemilik' => $cabang->id_pemilik,
                    'title' => 'Pesanan Baru #' . $data['nomor_pesanan'],
                    'message' => 'Pesanan baru ' . $data['nomor_pesanan'] . ' diterima di cabang ' . $cabang->nama_cabang . '.',
                    'type' => 'order',
                    'related_id' => $insert_id
                ]);
            }
        }

        return $insert_id;
    }

    // Generate nomor pesanan unik
    public function generateNomorPesanan()
    {
        $prefix = 'PES-' . date('Ymd') . '-';

        $this->db->select('nomor_pesanan');
        $this->db->from($this->table);
        $this->db->like('nomor_pesanan', $prefix, 'after');
        $this->db->order_by('nomor_pesanan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $last = $query->row()->nomor_pesanan;
            $last_number = (int) substr($last, -3);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        return $prefix . str_pad($new_number, 3, '0', STR_PAD_LEFT);
    }

    // Insert detail pesanan
    public function insertDetailPesanan($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('detail_pesanan', $data);
        return $this->db->insert_id();
    }

    // Get detail pesanan by id_pesanan
    public function getDetailPesananByPesananId($id_pesanan)
    {
        $this->db->select('detail_pesanan.*, layanan.nama_layanan');
        $this->db->from('detail_pesanan');
        $this->db->join('layanan', 'layanan.id_layanan = detail_pesanan.id_layanan', 'left');
        $this->db->where('detail_pesanan.id_pesanan', $id_pesanan);
        $this->db->where('detail_pesanan.deleted_at IS NULL');
        return $this->db->get()->result();
    }

    // Update detail pesanan
    public function updateDetailPesanan($id_detail, $data)
    {
        $this->db->where('id_detail', $id_detail);
        return $this->db->update('detail_pesanan', $data);
    }

    // =============================================
    // DASHBOARD STATISTICS
    // =============================================

    public function countOrdersToday($id_pemilik)
    {
        $this->db->from($this->table);
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('DATE(pesanan.tgl_masuk)', date('Y-m-d'));
        $this->db->where('pesanan.deleted_at IS NULL');
        return $this->db->count_all_results();
    }

    public function countOrdersThisMonth($id_pemilik)
    {
        $this->db->from($this->table);
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('YEAR(pesanan.tgl_masuk)', date('Y'));
        $this->db->where('MONTH(pesanan.tgl_masuk)', date('m'));
        $this->db->where('pesanan.deleted_at IS NULL');
        return $this->db->count_all_results();
    }


    public function countPendingPickups($id_pemilik)
    {
        $this->db->from($this->table);
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');
        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('pesanan.status_pesanan', 'siap_diambil');
        $this->db->where('pesanan.deleted_at IS NULL');
        return $this->db->count_all_results();
    }

    public function getRecentOrders($limit, $id_pemilik)
    {
        $this->db->select('
            pesanan.*,
            pelanggan.nama AS nama_pelanggan,
            layanan.nama_layanan
        ');
        $this->db->from($this->table);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan', 'left');
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');

        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('pesanan.deleted_at IS NULL');

        $this->db->order_by('pesanan.tgl_masuk', 'DESC');
        $this->db->limit($limit);

        return $this->db->get()->result();
    }

    public function getServiceVolume($id_pemilik)
    {
        $this->db->select('layanan.nama_layanan, COUNT(pesanan.id_pesanan) as total');
        $this->db->from($this->table);
        $this->db->join('layanan', 'layanan.id_layanan = pesanan.id_layanan', 'left');
        $this->db->join('cabang', 'cabang.id_cabang = pesanan.id_cabang');

        $this->db->where('cabang.id_pemilik', $id_pemilik);
        $this->db->where('pesanan.deleted_at IS NULL');

        $this->db->group_by('layanan.id_layanan, layanan.nama_layanan');
        $this->db->order_by('total', 'DESC');
        $this->db->limit(5); // Top 5 services

        return $this->db->get()->result();
    }

    /**
     * Confirm payment and trigger revenue entry
     * @param int $id_pesanan
     * @param string $metode_pembayaran (tunai, debit, qris)
     * @param int|null $id_karyawan
     * @return bool
     */
    public function confirmPayment($id_pesanan, $metode_pembayaran = null, $id_karyawan = null)
    {
        // Get pesanan data
        $pesanan = $this->getPesananById($id_pesanan);
        if (!$pesanan) {
            return false;
        }

        // Check if already paid
        if (isset($pesanan->status_pembayaran) && $pesanan->status_pembayaran === 'sudah_bayar') {
            return true; // Already paid, no need to process again
        }

        // Update payment status
        $data = [
            'status_pembayaran' => 'sudah_bayar',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Update metode_pembayaran if provided
        if ($metode_pembayaran) {
            $data['metode_pembayaran'] = $metode_pembayaran;
        }

        $this->db->where('id_pesanan', $id_pesanan);
        $updated = $this->db->update($this->table, $data);

        if ($updated) {
            // Create notification for payment
            $cabang = $this->db->select('id_pemilik, nama_cabang')->get_where('cabang', ['id_cabang' => $pesanan->id_cabang])->row();
            if ($cabang) {
                $this->load->model('Notification_model');
                $this->Notification_model->create([
                    'id_pemilik' => $cabang->id_pemilik,
                    'title' => 'Pembayaran Diterima',
                    'message' => 'Pembayaran untuk pesanan #' . $pesanan->nomor_pesanan . ' di cabang ' . $cabang->nama_cabang . ' sebesar Rp ' . number_format($pesanan->total_harga, 0, ',', '.') . ' telah diterima.',
                    'type' => 'payment',
                    'related_id' => $id_pesanan
                ]);
            }

            // Trigger revenue entry
            $CI = &get_instance();
            $CI->load->model('Keuangan_model');

            $pemasukan_data = [
                'id_cabang' => $pesanan->id_cabang,
                'nama_transaksi' => 'Pembayaran Pesanan #' . $pesanan->nomor_pesanan,
                'kategori' => 'pesanan',
                'jumlah' => $pesanan->total_harga,
                'tgl_transaksi' => date('Y-m-d'),
                'id_pesanan' => $id_pesanan,
                'keterangan' => 'Pembayaran ' . ($metode_pembayaran ?? $pesanan->metode_pembayaran ?? 'tunai') . ' - ' . ($pesanan->nama_pelanggan ?? 'Pelanggan'),
                'id_karyawan' => $id_karyawan
            ];

            $CI->Keuangan_model->insert_pemasukan($pemasukan_data);

            // Add progress timeline entry for payment
            $metode_label = [
                'tunai' => 'Tunai',
                'debit' => 'Debit/Transfer',
                'qris' => 'QRIS'
            ];
            $metode_text = $metode_label[$metode_pembayaran ?? $pesanan->metode_pembayaran] ?? 'Tunai';
            $this->insertProgres(
                $id_pesanan,
                'pembayaran',
                'Pembayaran ' . $metode_text . ' - Rp ' . number_format($pesanan->total_harga, 0, ',', '.'),
                $id_karyawan
            );
        }

        return $updated;
    }
}
