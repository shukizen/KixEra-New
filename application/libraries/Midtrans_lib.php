<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Midtrans Library for CodeIgniter
 * 
 * Library wrapper untuk integrasi Midtrans Snap API
 * tanpa menggunakan Composer (standalone)
 */
class Midtrans_lib {
    
    protected $CI;
    protected $server_key;
    protected $client_key;
    protected $is_production;
    protected $is_sanitized;
    protected $is_3ds;
    protected $api_url;
    protected $snap_url;
    
    public function __construct() {
        $this->CI =& get_instance();
        
        // Load config
        $this->CI->config->load('midtrans_config');
        
        // Set properties from config
        $this->server_key = $this->CI->config->item('midtrans_server_key');
        $this->client_key = $this->CI->config->item('midtrans_client_key');
        $this->is_production = $this->CI->config->item('midtrans_is_production');
        $this->is_sanitized = $this->CI->config->item('midtrans_is_sanitized');
        $this->is_3ds = $this->CI->config->item('midtrans_is_3ds');
        $this->api_url = $this->CI->config->item('midtrans_api_url');
        $this->snap_url = $this->CI->config->item('midtrans_snap_url');
    }
    
    /**
     * Get Client Key untuk digunakan di frontend
     */
    public function get_client_key() {
        return $this->client_key;
    }
    
    /**
     * Get Snap URL untuk include di frontend
     */
    public function get_snap_url() {
        return $this->snap_url;
    }
    
    /**
     * Generate Snap Token untuk pembayaran
     * 
     * @param array $transaction_details Detail transaksi (order_id, gross_amount)
     * @param array $customer_details Detail customer (first_name, email, phone)
     * @param array $item_details Detail item yang dibeli
     * @return array Response dari Midtrans
     */
    public function get_snap_token($transaction_details, $customer_details, $item_details = []) {
        $params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details
        ];
        
        if (!empty($item_details)) {
            $params['item_details'] = $item_details;
        }
        
        // Enable callback URLs
        $params['callbacks'] = [
            'finish' => base_url('pembayaran/finish')
        ];
        
        return $this->_request_snap_token($params);
    }
    
    /**
     * Create transaction dengan full params
     * 
     * @param array $params Full transaction parameters
     * @return array Response dari Midtrans
     */
    public function create_transaction($params) {
        return $this->_request_snap_token($params);
    }
    
    /**
     * Verify notification dari Midtrans webhook
     * 
     * @param object|array $notification Data notification dari Midtrans
     * @return object Verified notification data
     */
    public function verify_notification($notification) {
        if (is_string($notification)) {
            $notification = json_decode($notification);
        }
        
        if (is_array($notification)) {
            $notification = (object) $notification;
        }
        
        // Get order status from Midtrans API untuk verifikasi
        $order_id = $notification->order_id;
        $status = $this->get_transaction_status($order_id);
        
        return $status;
    }
    
    /**
     * Get transaction status dari Midtrans
     * 
     * @param string $order_id Order ID transaksi
     * @return object|null Status transaksi
     */
    public function get_transaction_status($order_id) {
        $url = $this->api_url . '/v2/' . $order_id . '/status';
        
        $response = $this->_curl_request($url, null, 'GET');
        
        if ($response && isset($response->status_code)) {
            return $response;
        }
        
        return null;
    }
    
    /**
     * Map Midtrans transaction status ke status internal
     * 
     * @param string $transaction_status Status dari Midtrans
     * @param string $fraud_status Fraud status dari Midtrans
     * @return string Status internal (pending/sukses/gagal)
     */
    public function map_transaction_status($transaction_status, $fraud_status = null) {
        switch ($transaction_status) {
            case 'capture':
                if ($fraud_status == 'accept') {
                    return 'sukses';
                }
                return 'pending';
                
            case 'settlement':
                return 'sukses';
                
            case 'pending':
                return 'pending';
                
            case 'deny':
            case 'expire':
            case 'cancel':
                return 'gagal';
                
            default:
                return 'pending';
        }
    }
    
    /**
     * Request Snap Token dari Midtrans API
     * 
     * @param array $params Transaction parameters
     * @return array Response dengan snap_token atau error
     */
    private function _request_snap_token($params) {
        $url = $this->api_url . '/snap/v1/transactions';
        
        // Log request untuk debugging
        log_message('info', 'Midtrans Request URL: ' . $url);
        log_message('info', 'Midtrans Request Params: ' . json_encode($params));
        
        $response = $this->_curl_request($url, $params, 'POST');
        
        // Log response untuk debugging
        log_message('info', 'Midtrans Response: ' . json_encode($response));
        
        if ($response && isset($response->token)) {
            return [
                'success' => true,
                'snap_token' => $response->token,
                'redirect_url' => $response->redirect_url ?? null
            ];
        }
        
        // Handle berbagai jenis error
        $error_messages = [];
        if ($response === null) {
            $error_messages[] = 'Tidak dapat terhubung ke server Midtrans. Periksa koneksi internet.';
        } elseif (isset($response->error_messages) && is_array($response->error_messages)) {
            $error_messages = $response->error_messages;
        } elseif (isset($response->status_message)) {
            $error_messages[] = $response->status_message;
        } else {
            $error_messages[] = 'Unknown error from Midtrans';
        }
        
        return [
            'success' => false,
            'error' => $error_messages,
            'raw_response' => $response
        ];
    }
    
    /**
     * Execute cURL request ke Midtrans API
     * 
     * @param string $url API URL
     * @param array|null $data Request body
     * @param string $method HTTP method
     * @return object|null Response dari API
     */
    private function _curl_request($url, $data = null, $method = 'POST') {
        // Cek apakah cURL tersedia
        if (!function_exists('curl_init')) {
            log_message('info', 'Midtrans: cURL not available, using file_get_contents fallback');
            return $this->_stream_request($url, $data, $method);
        }
        
        $ch = curl_init();
        
        // Set URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 30 second timeout
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10 second connection timeout
        
        // Set headers
        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($this->server_key . ':')
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Set method and data
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($data) {
                $json_data = json_encode($data);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
                log_message('debug', 'Midtrans POST Data: ' . $json_data);
            }
        }
        
        // SSL verification - tetap aktif untuk keamanan, tapi gunakan CA bundle
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        
        // Jika ada masalah SSL di Windows/XAMPP, gunakan ini:
        $cacert_path = APPPATH . 'third_party/cacert.pem';
        if (file_exists($cacert_path)) {
            curl_setopt($ch, CURLOPT_CAINFO, $cacert_path);
        } else {
            // Fallback: disable SSL verify untuk development (tidak disarankan untuk production)
            if (!$this->is_production) {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            }
        }
        
        // Execute request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        $errno = curl_errno($ch);
        
        curl_close($ch);
        
        // Log detail untuk debugging
        log_message('info', "Midtrans cURL HTTP Code: {$http_code}");
        
        if ($error) {
            log_message('error', "Midtrans cURL Error ({$errno}): {$error}");
            log_message('error', "URL: {$url}");
            return null;
        }
        
        if (empty($response)) {
            log_message('error', 'Midtrans: Empty response from server');
            return null;
        }
        
        $decoded = json_decode($response);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'Midtrans: Invalid JSON response: ' . $response);
            return null;
        }
        
        return $decoded;
    }
    
    /**
     * Fallback: HTTP request menggunakan file_get_contents dengan stream context
     * Digunakan jika cURL tidak tersedia
     * 
     * @param string $url API URL
     * @param array|null $data Request body
     * @param string $method HTTP method
     * @return object|null Response dari API
     */
    private function _stream_request($url, $data = null, $method = 'POST') {
        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($this->server_key . ':')
        ];
        
        $options = [
            'http' => [
                'method' => $method,
                'header' => implode("\r\n", $headers),
                'timeout' => 30,
                'ignore_errors' => true // Get response even on HTTP errors
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
        
        if ($data && $method === 'POST') {
            $json_data = json_encode($data);
            $options['http']['content'] = $json_data;
            $options['http']['header'] .= "\r\nContent-Length: " . strlen($json_data);
            log_message('debug', 'Midtrans Stream POST Data: ' . $json_data);
        }
        
        $context = stream_context_create($options);
        
        log_message('info', 'Midtrans Stream Request to: ' . $url);
        
        $response = @file_get_contents($url, false, $context);
        
        if ($response === false) {
            $error = error_get_last();
            log_message('error', 'Midtrans Stream Error: ' . ($error['message'] ?? 'Unknown error'));
            return null;
        }
        
        log_message('info', 'Midtrans Stream Response: ' . $response);
        
        $decoded = json_decode($response);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'Midtrans Stream: Invalid JSON response: ' . $response);
            return null;
        }
        
        return $decoded;
    }
    
    /**
     * Sanitize input untuk mencegah XSS
     */
    public function sanitize($input) {
        if (!$this->is_sanitized) {
            return $input;
        }
        
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = $this->sanitize($value);
            }
            return $input;
        }
        
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
}
