<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Langganan_model extends CI_Model {
    
    private $table = 'transaksi_langganan';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Get transactions by owner
    public function getTransactionsByOwner($id_owner) {
        $this->db->select('transaksi_langganan.*, paket_langganan.nama_paket, paket_langganan.durasi_hari');
        $this->db->from($this->table);
        $this->db->join('paket_langganan', 'paket_langganan.id_paket = transaksi_langganan.id_paket', 'left');
        $this->db->where('transaksi_langganan.id_owner', $id_owner);
        $this->db->where('transaksi_langganan.deleted_at IS NULL');
        $this->db->order_by('transaksi_langganan.tgl_transaksi', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get active subscription
    public function getActiveSubscription($id_owner) {
        $this->db->select('transaksi_langganan.*, paket_langganan.nama_paket, 
                          paket_langganan.durasi_hari, paket_langganan.fitur_aktif');
        $this->db->from($this->table);
        $this->db->join('paket_langganan', 'paket_langganan.id_paket = transaksi_langganan.id_paket', 'left');
        $this->db->where('transaksi_langganan.id_owner', $id_owner);
        $this->db->where('transaksi_langganan.status_pembayaran', 'sukses');
        $this->db->where('transaksi_langganan.tgl_akhir_langganan >=', date('Y-m-d'));
        $this->db->where('transaksi_langganan.deleted_at IS NULL');
        $this->db->order_by('transaksi_langganan.tgl_akhir_langganan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }
    
    // Check if subscription is active
    public function isSubscriptionActive($id_owner) {
        $subscription = $this->getActiveSubscription($id_owner);
        return $subscription !== null;
    }
    
    // Get expiring subscriptions (untuk reminder)
    public function getExpiringSubscriptions($days = 7) {
        $this->db->select('transaksi_langganan.*, owner.nama, owner.email, owner.no_telp, 
                          paket_langganan.nama_paket');
        $this->db->from($this->table);
        $this->db->join('owner', 'owner.id_owner = transaksi_langganan.id_owner', 'left');
        $this->db->join('paket_langganan', 'paket_langganan.id_paket = transaksi_langganan.id_paket', 'left');
        $this->db->where('transaksi_langganan.status_pembayaran', 'sukses');
        $this->db->where('DATEDIFF(transaksi_langganan.tgl_akhir_langganan, CURDATE()) <=', $days);
        $this->db->where('transaksi_langganan.tgl_akhir_langganan >=', date('Y-m-d'));
        $this->db->where('transaksi_langganan.deleted_at IS NULL');
        $query = $this->db->get();
        return $query->result();
    }
    
    // Insert transaction
    public function insertTransaction($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    // Update transaction
    public function updateTransaction($id_transaksi, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id_transaksi_langganan', $id_transaksi);
        return $this->db->update($this->table, $data);
    }
    
    // Update transaction status
    public function updateTransactionStatus($id_transaksi, $status) {
        $data = [
            'status_pembayaran' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_transaksi_langganan', $id_transaksi);
        return $this->db->update($this->table, $data);
    }
    
    // Get transaction by payment code
    public function getByPaymentCode($kode_pembayaran) {
        $this->db->where('kode_pembayaran', $kode_pembayaran);
        $this->db->where('deleted_at IS NULL');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    // Generate payment code
    public function generatePaymentCode() {
        return 'PAY-' . date('YmdHis') . '-' . rand(1000, 9999);
    }
    
    // Get all transactions (admin)
    public function getAllTransactions($limit = 100) {
        $this->db->select('transaksi_langganan.*, owner.nama_usaha, owner.email, 
                          paket_langganan.nama_paket');
        $this->db->from($this->table);
        $this->db->join('owner', 'owner.id_owner = transaksi_langganan.id_owner', 'left');
        $this->db->join('paket_langganan', 'paket_langganan.id_paket = transaksi_langganan.id_paket', 'left');
        $this->db->where('transaksi_langganan.deleted_at IS NULL');
        $this->db->order_by('transaksi_langganan.tgl_transaksi', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }
}
?>   