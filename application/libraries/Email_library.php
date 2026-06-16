<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Email Library
 * 
 * Library untuk mengirim email via SMTP Gmail
 */
class Email_library
{

    protected $CI;
    protected $config;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('email');

        // Load email config manually
        $this->config = [
            'protocol' => 'smtp',
            'smtp_host' => getenv('SMTP_HOST') ?: 'smtp.gmail.com', // Remove ssl:// prefix
            'smtp_port' => getenv('SMTP_PORT') ?: 587,
            'smtp_user' => getenv('SMTP_USER') ?: 'hattajunior1@gmail.com',
            'smtp_pass' => getenv('SMTP_PASS') ?: 'tgfqgvfywpldlyvt',
            'smtp_timeout' => getenv('SMTP_TIMEOUT') ?: 30,
            'smtp_crypto' => getenv('SMTP_CRYPTO') ?: 'tls', // This handles the encryption
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'newline' => "\r\n",
            'crlf' => "\r\n"
        ];

        // Initialize email with config
        $this->CI->email->initialize($this->config);
    }

    /**
     * Kirim email verifikasi registrasi
     * 
     * @param string $to Email tujuan
     * @param string $name Nama penerima
     * @param string $code Kode verifikasi
     * @return array Response
     */
    public function send_registration_verification($to, $name, $code)
    {
        $subject = '🔐 Kode Verifikasi Registrasi KixEra';

        $message = $this->get_email_template('verification', [
            'name' => $name,
            'code' => $code,
            'purpose' => 'registrasi'
        ]);

        return $this->send($to, $subject, $message);
    }

    /**
     * Kirim email reset password
     * 
     * @param string $to Email tujuan
     * @param string $name Nama penerima
     * @param string $reset_link Link reset password
     * @return array Response
     */
    public function send_password_reset($to, $name, $reset_link)
    {
        $subject = '🔑 Reset Password - KixEra';

        $message = $this->get_email_template('password_reset', [
            'name' => $name,
            'reset_link' => $reset_link
        ]);

        return $this->send($to, $subject, $message);
    }

    /**
     * Kirim email generic
     * 
     * @param string $to Email tujuan
     * @param string $subject Subject email
     * @param string $message Body email (HTML)
     * @return array Response
     */
    public function send($to, $subject, $message)
    {
        try {
            $mail_driver = strtolower(getenv('MAIL_DRIVER') ?: getenv('EMAIL_DRIVER') ?: 'smtp');

            if ($mail_driver === 'brevo_api') {
                return $this->send_via_brevo_api($to, $subject, $message);
            }

            $this->CI->email->clear();

            $from_email = getenv('MAIL_FROM_EMAIL') ?: 'hattajunior1@gmail.com';
            $from_name = getenv('MAIL_FROM_NAME') ?: 'KixEra';

            $this->CI->email->from($from_email, $from_name);
            $this->CI->email->to($to);
            $this->CI->email->subject($subject);
            $this->CI->email->message($message);

            if ($this->CI->email->send()) {
                log_message('info', "Email sent successfully to: {$to}");
                return [
                    'success' => true,
                    'message' => 'Email berhasil dikirim'
                ];
            } else {
                $error = $this->CI->email->print_debugger(['headers', 'subject', 'body']);
                log_message('error', "Email send failed: {$error}");
                return [
                    'success' => false,
                    'message' => 'Gagal mengirim email',
                    'debug' => $error
                ];
            }
        } catch (Exception $e) {
            log_message('error', 'Email exception: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Kirim email via Brevo Transactional Email API.
     */
    private function send_via_brevo_api($to, $subject, $message)
    {
        $api_key = getenv('BREVO_API_KEY');
        $api_url = getenv('BREVO_API_URL') ?: 'https://api.brevo.com/v3/smtp/email';
        $from_email = getenv('MAIL_FROM_EMAIL') ?: 'hattajunior1@gmail.com';
        $from_name = getenv('MAIL_FROM_NAME') ?: 'KixEra';

        if (empty($api_key)) {
            log_message('error', 'Brevo API send failed: BREVO_API_KEY is empty');
            return [
                'success' => false,
                'message' => 'Gagal mengirim email',
                'debug' => 'BREVO_API_KEY belum diset'
            ];
        }

        $payload = [
            'sender' => [
                'email' => $from_email,
                'name' => $from_name
            ],
            'to' => [
                [
                    'email' => $to
                ]
            ],
            'subject' => $subject,
            'htmlContent' => $message
        ];

        $ch = curl_init($api_url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'api-key: ' . $api_key,
                'content-type: application/json'
            ],
            CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE),
            CURLOPT_TIMEOUT => getenv('BREVO_API_TIMEOUT') ?: 30,
            CURLOPT_SSL_VERIFYPEER => true
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            log_message('error', 'Brevo API cURL error: ' . $curl_error);
            return [
                'success' => false,
                'message' => 'Gagal mengirim email',
                'debug' => $curl_error
            ];
        }

        if ($http_code < 200 || $http_code >= 300) {
            log_message('error', 'Brevo API send failed HTTP ' . $http_code . ': ' . $response);
            return [
                'success' => false,
                'message' => 'Gagal mengirim email',
                'debug' => $response
            ];
        }

        log_message('info', "Email sent successfully via Brevo API to: {$to}");
        return [
            'success' => true,
            'message' => 'Email berhasil dikirim'
        ];
    }

    /**
     * Get email template
     * 
     * @param string $template Template name
     * @param array $data Data untuk template
     * @return string HTML email
     */
    private function get_email_template($template, $data = [])
    {
        $templates = [
            'verification' => $this->template_verification($data),
            'password_reset' => $this->template_password_reset($data)
        ];

        return $templates[$template] ?? '';
    }

    /**
     * Template email verifikasi - Design Profesional
     */
    private function template_verification($data)
    {
        $name = htmlspecialchars($data['name'] ?? 'User');
        $code = htmlspecialchars($data['code'] ?? '000000');
        $purpose = htmlspecialchars($data['purpose'] ?? 'verifikasi');
        $year = date('Y');

        return "
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>
<body style='margin: 0; padding: 0; background-color: #f8fafc; font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica, Arial, sans-serif;'>
    <table role='presentation' width='100%' cellpadding='0' cellspacing='0' style='background-color: #f8fafc; padding: 40px 20px;'>
        <tr>
            <td align='center'>
                <table role='presentation' width='100%' style='max-width: 480px; background: #ffffff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.08);'>
                    
                    <!-- Header -->
                    <tr>
                        <td style='padding: 40px 40px 30px 40px; text-align: center; border-bottom: 1px solid #f1f5f9;'>
                            <h1 style='margin: 0; font-size: 28px; font-weight: 700; color: #0f172a; letter-spacing: -0.5px;'>KixEra</h1>
                        </td>
                    </tr>
                    
                    <!-- Body -->
                    <tr>
                        <td style='padding: 40px;'>
                            <p style='margin: 0 0 24px 0; font-size: 16px; color: #334155; line-height: 1.6;'>
                                Halo <strong style='color: #0f172a;'>{$name}</strong>,
                            </p>
                            <p style='margin: 0 0 32px 0; font-size: 15px; color: #64748b; line-height: 1.6;'>
                                Gunakan kode berikut untuk menyelesaikan proses {$purpose} akun Anda:
                            </p>
                            
                            <!-- OTP Code Box -->
                            <div style='background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%); border: 1px solid #d1fae5; border-radius: 12px; padding: 32px; text-align: center; margin: 0 0 32px 0;'>
                                <p style='margin: 0 0 12px 0; font-size: 11px; font-weight: 600; color: #059669; text-transform: uppercase; letter-spacing: 2px;'>Kode Verifikasi</p>
                                <p style='margin: 0; font-size: 36px; font-weight: 700; color: #047857; letter-spacing: 10px; font-family: Monaco, Consolas, monospace;'>{$code}</p>
                            </div>
                            
                            <!-- Info -->
                            <table role='presentation' width='100%' cellpadding='0' cellspacing='0' style='background: #f8fafc; border-radius: 8px; padding: 16px;'>
                                <tr>
                                    <td style='padding: 12px 16px;'>
                                        <p style='margin: 0 0 8px 0; font-size: 13px; color: #64748b;'>
                                            <span style='color: #ef4444; font-weight: 600;'>Penting:</span> Kode ini berlaku selama <strong>5 menit</strong>.
                                        </p>
                                        <p style='margin: 0; font-size: 13px; color: #64748b;'>
                                            Jangan berikan kode ini kepada siapapun.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style='padding: 24px 40px; background: #f8fafc; border-top: 1px solid #f1f5f9; border-radius: 0 0 16px 16px;'>
                            <p style='margin: 0 0 8px 0; font-size: 12px; color: #94a3b8; text-align: center;'>
                                Jika Anda tidak melakukan permintaan ini, abaikan email ini.
                            </p>
                            <p style='margin: 0; font-size: 11px; color: #cbd5e1; text-align: center;'>
                                &copy; {$year} KixEra. All rights reserved.
                            </p>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
        ";
    }

    /**
     * Template email reset password
     */
    private function template_password_reset($data)
    {
        $name = htmlspecialchars($data['name'] ?? 'User');
        $reset_link = htmlspecialchars($data['reset_link'] ?? '#');

        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        </head>
        <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;'>
            <div style='max-width: 500px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
                <!-- Header -->
                <div style='background: linear-gradient(135deg, #10b981, #14b8a6); padding: 30px; text-align: center;'>
                    <h1 style='color: white; margin: 0; font-size: 24px;'>🔑 Reset Password</h1>
                    <p style='color: rgba(255,255,255,0.9); margin: 10px 0 0 0;'>KixEra</p>
                </div>
                
                <!-- Body -->
                <div style='padding: 30px;'>
                    <p style='color: #333; font-size: 16px; margin: 0 0 15px 0;'>Halo <strong>{$name}</strong>,</p>
                    <p style='color: #666; font-size: 14px; margin: 0 0 25px 0;'>
                        Kami menerima permintaan untuk reset password akun KixEra Anda.
                        Klik tombol di bawah untuk membuat password baru:
                    </p>
                    
                    <!-- Button -->
                    <div style='text-align: center; margin: 0 0 25px 0;'>
                        <a href='{$reset_link}' style='display: inline-block; background: linear-gradient(135deg, #10b981, #14b8a6); color: white; text-decoration: none; padding: 14px 30px; border-radius: 8px; font-weight: bold; font-size: 14px;'>
                            Reset Password
                        </a>
                    </div>
                    
                    <p style='color: #666; font-size: 13px; margin: 0 0 10px 0;'>⏰ Link berlaku selama <strong>1 jam</strong>.</p>
                    <p style='color: #666; font-size: 13px; margin: 0;'>Jika tombol tidak berfungsi, copy link berikut:</p>
                    <p style='color: #10b981; font-size: 12px; word-break: break-all; margin: 10px 0 0 0;'>{$reset_link}</p>
                </div>
                
                <!-- Footer -->
                <div style='background: #f9fafb; padding: 20px; text-align: center; border-top: 1px solid #e5e7eb;'>
                    <p style='color: #9ca3af; font-size: 12px; margin: 0;'>
                        Jika Anda tidak meminta reset password, abaikan email ini.
                    </p>
                    <p style='color: #9ca3af; font-size: 11px; margin: 10px 0 0 0;'>
                        &copy; " . date('Y') . " KixEra. All rights reserved.
                    </p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
}
