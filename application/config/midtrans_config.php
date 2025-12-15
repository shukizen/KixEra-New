<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Midtrans Payment Gateway Configuration
|--------------------------------------------------------------------------
|
| Konfigurasi untuk integrasi Midtrans Snap API
|
*/

// Midtrans Server Key (gunakan Sandbox key untuk testing)
$config['midtrans_server_key'] = 'SB-Mid-server-ccsm2ziDa00TI2R473-w_Ec9';

// Midtrans Client Key
$config['midtrans_client_key'] = 'SB-Mid-client-wmkO_f69div7oz3s';

// Set ke FALSE untuk Sandbox, TRUE untuk Production
$config['midtrans_is_production'] = FALSE;

// Sanitize input
$config['midtrans_is_sanitized'] = TRUE;

// Enable 3D Secure
$config['midtrans_is_3ds'] = TRUE;

// Midtrans API URLs
$config['midtrans_snap_url'] = $config['midtrans_is_production'] 
    ? 'https://app.midtrans.com/snap/snap.js' 
    : 'https://app.sandbox.midtrans.com/snap/snap.js';

$config['midtrans_api_url'] = $config['midtrans_is_production']
    ? 'https://api.midtrans.com'
    : 'https://api.sandbox.midtrans.com';
