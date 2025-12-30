<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fonnte Library
 * 
 * Library untuk mengirim pesan WhatsApp melalui Fonnte API
 * Digunakan untuk verifikasi login admin (2FA)
 */
class Fonnte_library {
    
    protected $CI;
    protected $api_token;
    protected $api_url;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->api_token = $this->CI->config->item('fonnte_api_token');
        $this->api_url = $this->CI->config->item('fonnte_api_url');
    }
    
    /**
     * Kirim pesan WhatsApp
     * 
     * @param string $phone Nomor telepon tujuan (format: 628xxx atau 08xxx)
     * @param string $message Isi pesan
     * @return array Response dari API
     */
    public function send_message($phone, $message) {
        // Normalize phone number
        $phone = $this->normalize_phone($phone);
        
        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62', // Indonesia
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: ' . $this->api_token
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            log_message('error', 'Fonnte API cURL Error: ' . $err);
            return [
                'success' => false,
                'message' => 'Failed to connect to WhatsApp API',
                'error' => $err
            ];
        }
        
        $result = json_decode($response, true);
        
        log_message('info', 'Fonnte API Response: ' . $response);
        
        return [
            'success' => isset($result['status']) && $result['status'] == true,
            'message' => $result['reason'] ?? 'Unknown response',
            'raw_response' => $result
        ];
    }
    
    /**
     * Kirim kode verifikasi
     * 
     * @param string $phone Nomor telepon
     * @param string $code Kode verifikasi 6 digit
     * @return array Response
     */
    public function send_verification_code($phone, $code) {
        $message = "*KixEra Admin Verification*\n\n";
        $message .= "Kode verifikasi Anda: *{$code}*\n\n";
        $message .= "⚠️ Kode ini berlaku selama 5 menit.\n";
        $message .= "Jangan berikan kode ini kepada siapapun.\n\n";
        $message .= "_Jika Anda tidak melakukan login, abaikan pesan ini._";
        
        return $this->send_message($phone, $message);
    }
    
    /**
     * Normalize nomor telepon ke format 628xxx
     * 
     * @param string $phone Nomor telepon
     * @return string Nomor yang sudah dinormalize
     */
    protected function normalize_phone($phone) {
        // Hapus spasi dan karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Jika mulai dengan 0, ganti dengan 62
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // Jika tidak mulai dengan 62, tambahkan
        if (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
    
    /**
     * Mask nomor telepon untuk tampilan (privacy)
     * Contoh: 081234567890 -> 0812****7890
     * 
     * @param string $phone Nomor telepon
     * @return string Nomor yang sudah di-mask
     */
    public function mask_phone($phone) {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Convert 628xxx to 08xxx for display
        if (substr($phone, 0, 2) === '62') {
            $phone = '0' . substr($phone, 2);
        }
        
        $length = strlen($phone);
        if ($length <= 4) {
            return $phone;
        }
        
        $visible_start = 4;
        $visible_end = 4;
        $masked_count = $length - $visible_start - $visible_end;
        
        if ($masked_count <= 0) {
            return $phone;
        }
        
        return substr($phone, 0, $visible_start) . str_repeat('*', $masked_count) . substr($phone, -$visible_end);
    }
}
