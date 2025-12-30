<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Verification Code Model
 * 
 * Model untuk manajemen kode verifikasi OTP
 */
class Verification_code_model extends CI_Model {
    
    protected $table = 'verification_codes';
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Generate kode verifikasi baru
     * 
     * @param int $id_user ID user
     * @param string $phone Nomor telepon
     * @param string $purpose Tujuan verifikasi (admin_login, password_reset)
     * @return string|false Kode 6 digit atau false jika gagal
     */
    public function generate_code($id_user, $phone, $purpose = 'admin_login') {
        // Invalidasi kode lama
        $this->invalidate_old_codes($id_user, $purpose);
        
        // Generate kode 6 digit
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Hitung waktu expired (dari config)
        $expire_seconds = $this->config->item('verification_code_expire') ?: 300;
        $expires_at = date('Y-m-d H:i:s', time() + $expire_seconds);
        
        $data = [
            'id_user' => $id_user,
            'code' => $code,
            'phone_number' => $phone,
            'purpose' => $purpose,
            'is_used' => 0,
            'expires_at' => $expires_at,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->db->insert($this->table, $data)) {
            return $code;
        }
        
        return false;
    }
    
    /**
     * Verifikasi kode yang dimasukkan
     * 
     * @param int $id_user ID user
     * @param string $code Kode yang dimasukkan
     * @param string $purpose Tujuan verifikasi
     * @return array Status verifikasi
     */
    public function verify_code($id_user, $code, $purpose = 'admin_login') {
        $verification = $this->db->select('*')
            ->from($this->table)
            ->where('id_user', $id_user)
            ->where('code', $code)
            ->where('purpose', $purpose)
            ->where('is_used', 0)
            ->order_by('created_at', 'DESC')
            ->limit(1)
            ->get()
            ->row_array();
        
        if (!$verification) {
            return [
                'success' => false,
                'message' => 'Kode verifikasi tidak valid'
            ];
        }
        
        // Cek apakah sudah expired
        if (strtotime($verification['expires_at']) < time()) {
            return [
                'success' => false,
                'message' => 'Kode verifikasi sudah kadaluarsa. Silakan minta kode baru.'
            ];
        }
        
        // Tandai kode sebagai sudah digunakan
        $this->db->where('id_code', $verification['id_code'])
            ->update($this->table, [
                'is_used' => 1,
                'used_at' => date('Y-m-d H:i:s')
            ]);
        
        return [
            'success' => true,
            'message' => 'Verifikasi berhasil'
        ];
    }
    
    /**
     * Cek apakah sudah bisa kirim ulang kode
     * 
     * @param int $id_user ID user
     * @param string $purpose Tujuan verifikasi
     * @return bool True jika sudah bisa kirim ulang
     */
    public function can_resend($id_user, $purpose = 'admin_login') {
        $cooldown = $this->config->item('verification_code_resend_cooldown') ?: 90;
        $cooldown_time = date('Y-m-d H:i:s', time() - $cooldown);
        
        $last_code = $this->db->select('created_at')
            ->from($this->table)
            ->where('id_user', $id_user)
            ->where('purpose', $purpose)
            ->order_by('created_at', 'DESC')
            ->limit(1)
            ->get()
            ->row();
        
        if (!$last_code) {
            return true;
        }
        
        return strtotime($last_code->created_at) <= strtotime($cooldown_time);
    }
    
    /**
     * Hitung sisa waktu cooldown dalam detik
     * 
     * @param int $id_user ID user
     * @param string $purpose Tujuan verifikasi
     * @return int Sisa waktu dalam detik, 0 jika sudah bisa kirim
     */
    public function get_resend_countdown($id_user, $purpose = 'admin_login') {
        $cooldown = $this->config->item('verification_code_resend_cooldown') ?: 90;
        
        $last_code = $this->db->select('created_at')
            ->from($this->table)
            ->where('id_user', $id_user)
            ->where('purpose', $purpose)
            ->order_by('created_at', 'DESC')
            ->limit(1)
            ->get()
            ->row();
        
        if (!$last_code) {
            return 0;
        }
        
        $elapsed = time() - strtotime($last_code->created_at);
        $remaining = $cooldown - $elapsed;
        
        return max(0, $remaining);
    }
    
    /**
     * Invalidasi kode lama yang belum digunakan
     * 
     * @param int $id_user ID user
     * @param string $purpose Tujuan verifikasi
     * @return void
     */
    public function invalidate_old_codes($id_user, $purpose = 'admin_login') {
        $this->db->where('id_user', $id_user)
            ->where('purpose', $purpose)
            ->where('is_used', 0)
            ->update($this->table, ['is_used' => 1]);
    }
    
    /**
     * Bersihkan kode yang sudah expired (untuk cron job)
     * 
     * @return int Jumlah kode yang dihapus
     */
    public function cleanup_expired() {
        $this->db->where('expires_at <', date('Y-m-d H:i:s'))
            ->or_where('is_used', 1)
            ->delete($this->table);
        
        return $this->db->affected_rows();
    }
}
