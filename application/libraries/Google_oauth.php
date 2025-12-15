<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Google OAuth Library
 * Letakkan file ini di application/libraries/Google_oauth.php
 * 
 * Install Google API Client terlebih dahulu:
 * composer require google/apiclient:"^2.0"
 */

class Google_oauth {
    
    protected $CI;
    private $client;
    private $config;
    
    public function __construct() {
        $this->CI =& get_instance();
        
        // Load config
        $this->CI->load->config('oauth');
        $this->config = $this->CI->config->item('google');
        
        // Initialize Google Client
        $this->init_client();
    }
    
    /**
     * Initialize Google Client
     */
    private function init_client() {
        // Check if Google Client library exists
        if (!class_exists('Google_Client')) {
            log_message('error', 'Google API Client not found. Run: composer require google/apiclient');
            return false;
        }
        
        $this->client = new Google_Client();
        $this->client->setClientId($this->config['client_id']);
        $this->client->setClientSecret($this->config['client_secret']);
        $this->client->setRedirectUri($this->config['redirect_uri']);
        $this->client->addScope('email');
        $this->client->addScope('profile');
        
        return true;
    }
    
    /**
     * Get authorization URL
     */
    public function get_auth_url() {
        if (!$this->client) {
            return false;
        }
        
        return $this->client->createAuthUrl();
    }
    
    /**
     * Redirect to Google OAuth
     */
    public function redirect() {
        $auth_url = $this->get_auth_url();
        
        if ($auth_url) {
            redirect($auth_url);
        } else {
            show_error('Google OAuth not configured properly');
        }
    }
    
    /**
     * Get user info from Google
     */
    public function get_user_info() {
        if (!$this->client) {
            return false;
        }
        
        $code = $this->CI->input->get('code');
        
        if (!$code) {
            return false;
        }
        
        try {
            // Exchange authorization code for access token
            $token = $this->client->fetchAccessTokenWithAuthCode($code);
            
            if (isset($token['error'])) {
                log_message('error', 'Google OAuth error: ' . $token['error']);
                return false;
            }
            
            $this->client->setAccessToken($token);
            
            // Get user info
            $google_service = new Google_Service_Oauth2($this->client);
            $user_info = $google_service->userinfo->get();
            
            return [
                'id' => $user_info->id,
                'email' => $user_info->email,
                'name' => $user_info->name,
                'given_name' => $user_info->givenName,
                'family_name' => $user_info->familyName,
                'picture' => $user_info->picture,
                'verified_email' => $user_info->verifiedEmail
            ];
            
        } catch (Exception $e) {
            log_message('error', 'Google OAuth exception: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Revoke token (logout from Google)
     */
    public function revoke() {
        if ($this->client && $this->client->getAccessToken()) {
            $this->client->revokeToken();
        }
    }
}