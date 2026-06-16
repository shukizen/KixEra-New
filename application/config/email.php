<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Email Configuration
 * 
 * Konfigurasi SMTP untuk pengiriman email via Gmail
 */

// Gmail SMTP Settings
$config['protocol'] = 'smtp';
$config['smtp_host'] = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
$config['smtp_port'] = getenv('SMTP_PORT') ?: 587;
$config['smtp_user'] = getenv('SMTP_USER') ?: 'hattajunior1@gmail.com';
$config['smtp_pass'] = getenv('SMTP_PASS') ?: 'tgfqgvfywpldlyvt'; // App Password (tanpa spasi)
$config['smtp_timeout'] = getenv('SMTP_TIMEOUT') ?: 30;
$config['smtp_crypto'] = getenv('SMTP_CRYPTO') ?: 'tls';

// Email Settings
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";

// From Address (default sender)
$config['from_email'] = getenv('MAIL_FROM_EMAIL') ?: 'hattajunior1@gmail.com';
$config['from_name'] = getenv('MAIL_FROM_NAME') ?: 'KixEra';
