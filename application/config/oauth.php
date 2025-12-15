<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| OAuth Configuration
|--------------------------------------------------------------------------
| Letakkan file ini di application/config/oauth.php
|
| Cara mendapatkan kredensial Google OAuth:
| 1. Buka https://console.cloud.google.com/
| 2. Buat project baru atau pilih project yang ada
| 3. Aktifkan Google+ API
| 4. Buat OAuth 2.0 Client ID di Credentials
| 5. Authorized redirect URIs: http://localhost/KixEra/auth/google
|
*/

$config['google'] = [
    'client_id' => 'YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com',
    'client_secret' => 'YOUR_GOOGLE_CLIENT_SECRET',
    'redirect_uri' => base_url('auth/google'),
    'application_name' => 'KixEra'
];

// Facebook OAuth (opsional)
$config['facebook'] = [
    'app_id' => 'YOUR_FACEBOOK_APP_ID',
    'app_secret' => 'YOUR_FACEBOOK_APP_SECRET',
    'redirect_uri' => base_url('auth/facebook'),
];

// GitHub OAuth (opsional)
$config['github'] = [
    'client_id' => 'YOUR_GITHUB_CLIENT_ID',
    'client_secret' => 'YOUR_GITHUB_CLIENT_SECRET',
    'redirect_uri' => base_url('auth/github'),
];