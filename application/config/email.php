<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Email Configuration
 * 
 * Konfigurasi SMTP untuk pengiriman email via Gmail
 */

// Gmail SMTP Settings
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'rizkipangestu291@gmail.com';
$config['smtp_pass'] = 'cavnyevbynbatenq'; // App Password (tanpa spasi)
$config['smtp_timeout'] = 30;
$config['smtp_crypto'] = 'ssl';

// Email Settings
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";

// From Address (default sender)
$config['from_email'] = 'rizkipangestu291@gmail.com';
$config['from_name'] = 'KixEra';
