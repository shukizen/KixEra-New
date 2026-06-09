<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Google OAuth 2.0 Library
 * 
 * Library untuk handle Google OAuth 2.0 authentication
 * Menggunakan OAuth 2.0 endpoint resmi Google (tanpa Google+ API yang deprecated)
 * TIDAK MEMERLUKAN composer require google/apiclient
 * Menggunakan native PHP cURL untuk HTTP requests
 * 
 * @package    KixEra
 * @subpackage Libraries
 * @category   Authentication
 * @author     KixEra Team
 */
class Google_oauth {
    
    protected $CI;
    protected $client_id;
    protected $client_secret;
    protected $redirect_uri;
    protected $oauth_url;
    protected $token_url;
    protected $userinfo_url;
    protected $scopes;
    protected $access_type;
    protected $prompt;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->CI =& get_instance();
        
        // Load konfigurasi Google OAuth
        $this->CI->config->load('google_config');
        
        // Set properties dari config
        $this->client_id = $this->CI->config->item('google_client_id');
        $this->client_secret = $this->CI->config->item('google_client_secret');
        $this->redirect_uri = $this->CI->config->item('google_redirect_uri');
        $this->oauth_url = $this->CI->config->item('google_oauth_url');
        $this->token_url = $this->CI->config->item('google_token_url');
        $this->userinfo_url = $this->CI->config->item('google_userinfo_url');
        $this->scopes = $this->CI->config->item('google_scopes');
        $this->access_type = $this->CI->config->item('google_access_type');
        $this->prompt = $this->CI->config->item('google_prompt');
        
        // Validasi konfigurasi
        if (empty($this->client_id) || $this->client_id === 'YOUR_CLIENT_ID.apps.googleusercontent.com') {
            log_message('error', 'Google OAuth: Client ID belum diset di google_config.php');
        }
        
        if (empty($this->client_secret) || $this->client_secret === 'YOUR_CLIENT_SECRET') {
            log_message('error', 'Google OAuth: Client Secret belum diset di google_config.php');
        }
    }
    
    /**
     * Generate Google OAuth URL
     * URL ini akan redirect user ke halaman login Google
     * 
     * @return string Google OAuth URL
     */
    public function get_login_url() {
        // Generate state untuk CSRF protection
        $state = bin2hex(random_bytes(16));
        $this->CI->session->set_userdata('google_oauth_state', $state);
        
        // Build parameter untuk OAuth
        $params = [
            'client_id' => $this->client_id,
            'redirect_uri' => $this->redirect_uri,
            'response_type' => 'code',
            'scope' => implode(' ', $this->scopes),
            'access_type' => $this->access_type,
            'state' => $state,
            'prompt' => $this->prompt
        ];
        
        // Return URL lengkap
        return $this->oauth_url . '?' . http_build_query($params);
    }
    
    /**
     * Redirect to Google OAuth
     */
    public function redirect() {
        $auth_url = $this->get_login_url();
        redirect($auth_url);
    }
    
    /**
     * Validate state parameter (CSRF protection)
     * 
     * @param string $state State dari callback
     * @return bool True jika valid, False jika tidak
     */
    public function validate_state($state) {
        $session_state = $this->CI->session->userdata('google_oauth_state');
        
        // Clear state dari session
        $this->CI->session->unset_userdata('google_oauth_state');
        
        // Validasi
        if (empty($state) || empty($session_state)) {
            return false;
        }
        
        return hash_equals($session_state, $state);
    }
    
    /**
     * Exchange authorization code untuk access token
     * 
     * @param string $code Authorization code dari Google
     * @return array|false Array berisi access_token, atau false jika gagal
     */
    public function get_access_token($code) {
        // Data untuk POST request
        $post_data = [
            'code' => $code,
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $this->redirect_uri,
            'grant_type' => 'authorization_code'
        ];
        
        // Kirim POST request ke Google token endpoint
        $response = $this->http_post($this->token_url, $post_data);
        
        if ($response === false) {
            log_message('error', 'Google OAuth: Gagal mendapatkan access token');
            return false;
        }
        
        $result = json_decode($response, true);
        
        // Cek apakah ada error
        if (isset($result['error'])) {
            log_message('error', 'Google OAuth Token Error: ' . $result['error']);
            return false;
        }
        
        // Return access token dan data lainnya
        return $result;
    }
    
    /**
     * Dapatkan informasi user dari Google
     * 
     * @param string $access_token Access token
     * @return array|false Array berisi user info, atau false jika gagal
     */
    public function get_user_info($access_token = null) {
        if (!$access_token) {
            // Coba ambil dari parameter yang sudah di-set sebelumnya
            log_message('error', 'Google OAuth: Access token required');
            return false;
        }
        
        // Kirim GET request dengan access token di header
        $url = $this->userinfo_url . '?access_token=' . $access_token;
        
        $response = $this->http_get($url);
        
        if ($response === false) {
            log_message('error', 'Google OAuth: Gagal mendapatkan user info');
            return false;
        }
        
        $user_info = json_decode($response, true);
        
        // Cek apakah ada error
        if (isset($user_info['error'])) {
            log_message('error', 'Google OAuth User Info Error: ' . $user_info['error']['message']);
            return false;
        }
        
        // Normalize data user
        $normalized = [
            'google_id' => $user_info['id'] ?? null,
            'email' => $user_info['email'] ?? null,
            'verified_email' => $user_info['email_verified'] ?? false,
            'name' => $user_info['name'] ?? null,
            'given_name' => $user_info['given_name'] ?? null,
            'family_name' => $user_info['family_name'] ?? null,
            'picture' => $user_info['picture'] ?? null,
            'locale' => $user_info['locale'] ?? null
        ];
        
        return $normalized;
    }
    
    /**
     * Complete OAuth flow
     * Shortcut method untuk handle semua proses OAuth
     * 
     * @param string $code Authorization code
     * @param string $state State parameter
     * @return array|false User info atau false jika gagal
     */
    public function authenticate($code, $state) {
        // 1. Validasi state (CSRF protection)
        if (!$this->validate_state($state)) {
            log_message('error', 'Google OAuth: Invalid state parameter (possible CSRF attack)');
            return false;
        }
        
        // 2. Exchange code untuk token
        $token_data = $this->get_access_token($code);
        if ($token_data === false) {
            return false;
        }
        
        // 3. Dapatkan user info menggunakan access token
        $user_info = $this->get_user_info($token_data['access_token']);
        if ($user_info === false) {
            return false;
        }
        
        return $user_info;
    }
    
    /**
     * HTTP POST request
     * 
     * @param string $url URL tujuan
     * @param array $data Data untuk POST
     * @return string|false Response body atau false jika error
     */
    private function http_post($url, $data) {
        $ch = curl_init($url);
        
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded'
            ],
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_TIMEOUT => 30
        ]);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);
        
        if ($response === false) {
            log_message('error', 'cURL Error: ' . $error);
            return false;
        }
        
        if ($http_code >= 400) {
            log_message('error', 'HTTP Error ' . $http_code . ': ' . $response);
            return false;
        }
        
        return $response;
    }
    
    /**
     * HTTP GET request
     * 
     * @param string $url URL tujuan
     * @return string|false Response body atau false jika error
     */
    private function http_get($url) {
        $ch = curl_init($url);
        
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_TIMEOUT => 30
        ]);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);
        
        if ($response === false) {
            log_message('error', 'cURL Error: ' . $error);
            return false;
        }
        
        if ($http_code >= 400) {
            log_message('error', 'HTTP Error ' . $http_code . ': ' . $response);
            return false;
        }
        
        return $response;
    }
    
    /**
     * Revoke access token
     * Untuk logout dari Google
     * 
     * @param string $access_token Access token yang akan di-revoke
     * @return bool True jika berhasil
     */
    public function revoke_token($access_token) {
        $url = 'https://oauth2.googleapis.com/revoke?token=' . $access_token;
        
        $response = $this->http_post($url, []);
        
        return $response !== false;
    }
}