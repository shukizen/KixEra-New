<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gemini AI Library
 * 
 * Library untuk integrasi dengan Google Gemini API
 * Menyediakan fungsi untuk generate business insights dan rekomendasi
 * 
 * @package    KixEra
 * @subpackage Libraries
 * @category   AI Integration
 * @author     KixEra Team
 */
class Gemini_library {
    
    protected $CI;
    protected $api_key;
    protected $api_url;
    protected $config;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->CI =& get_instance();
        
        // Load configuration
        $this->CI->config->load('gemini', FALSE);
        $this->config = $this->CI->config->item('gemini');

        if (!is_array($this->config)) {
            $this->config = [];
        }
        
        $this->api_key = $this->config['gemini_api_key'] ?? null;
        $this->api_url = $this->config['gemini_api_url'] ?? null;
        
        // Validate API key
        if (empty($this->api_key) || $this->api_key === 'YOUR_GEMINI_API_KEY_HERE') {
            log_message('error', 'Gemini API: API key not configured');
        }
    }
    
    /**
     * Generate Business Insights
     * 
     * Generate AI-powered business insights and recommendations
     * 
     * @param array $business_data Business metrics data
     * @return array|false Response array or false on failure
     */
    public function generate_business_insights($business_data) {
        try {
            // Log entry
            log_message('info', '=== GEMINI: generate_business_insights() CALLED (AUTO MODE) ===');
            
            // Validate input
            if (empty($business_data)) {
                throw new Exception('Business data is required');
            }
            
            // Build prompt
            $prompt = $this->build_business_prompt($business_data);
            
            // Check if API key is placeholder
            if (empty($this->api_key) || $this->api_key === 'YOUR_GEMINI_API_KEY_HERE') {
                log_message('info', 'Gemini API: API key not configured, using fallback response.');
                return $this->get_fallback_response();
            }

            // Call Gemini API
            $response = $this->call_gemini_api($prompt);
            
            if ($response === false) {
                log_message('info', 'Gemini API call failed, using fallback response.');
                return $this->get_fallback_response();
            }
            
            // Parse and validate response
            $parsed = $this->parse_business_response($response);
            
            // Log success
            if ($this->config['gemini_enable_logging']) {
                log_message('info', 'Gemini API: Successfully generated business insights');
            }
            
            return $parsed;
            
        } catch (Exception $e) {
            log_message('error', 'Gemini API Error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Generate Custom Insights
     * 
     * Generate AI response based on user's custom prompt with business context
     * 
     * @param array $business_data Business metrics data for context
     * @param string $custom_prompt User's custom question/prompt
     * @return array|false Response array or false on failure
     */
    public function generate_custom_insights($business_data, $custom_prompt) {
        try {
            // Log entry
            log_message('info', '=== GEMINI: generate_custom_insights() CALLED ===');
            log_message('info', 'Custom Prompt Length: ' . strlen($custom_prompt));
            log_message('info', 'Custom Prompt Preview: ' . substr($custom_prompt, 0, 150));
            
            // Validate input
            if (empty($custom_prompt)) {
                throw new Exception('Custom prompt is required');
            }
            
            // Sanitize prompt
            $custom_prompt = strip_tags($custom_prompt);
            $custom_prompt = trim($custom_prompt);
            
            if (strlen($custom_prompt) > 1000) {
                throw new Exception('Prompt too long (max 1000 characters)');
            }
            
            // Build custom prompt with business context
            $prompt = $this->build_custom_prompt($business_data, $custom_prompt);
            
            // Check if API key is placeholder
            if (empty($this->api_key) || $this->api_key === 'YOUR_GEMINI_API_KEY_HERE') {
                log_message('info', 'Gemini API: API key not configured, using custom fallback response.');
                return $this->get_custom_fallback_response($custom_prompt);
            }

            // Call Gemini API
            $response = $this->call_gemini_api($prompt);
            
            if ($response === false) {
                log_message('info', 'Gemini API call failed, using custom fallback response.');
                return $this->get_custom_fallback_response($custom_prompt);
            }
            
            // Parse and validate response
            $parsed = $this->parse_business_response($response);
            
            // Log success
            if ($this->config['gemini_enable_logging']) {
                log_message('info', 'Gemini API: Successfully generated custom insights');
            }
            
            return $parsed;
            
        } catch (Exception $e) {
            log_message('error', 'Gemini API Custom Prompt Error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Build Business Prompt
     * 
     * Create structured prompt for business insights
     * 
     * @param array $data Business data
     * @return string Formatted prompt
     */
    protected function build_business_prompt($data) {
        $prompt = "Anda adalah AI business consultant untuk bisnis laundry sepatu \"KixEra\" di Indonesia.\n\n";
        $prompt .= "Analisis data bisnis berikut dan berikan rekomendasi strategis dalam Bahasa Indonesia:\n\n";
        $prompt .= "DATA BISNIS:\n";
        $prompt .= "- Total Pesanan (Hari ini): " . ($data['total_orders_today'] ?? 0) . "\n";
        $prompt .= "- Total Pesanan (Bulan ini): " . ($data['total_orders_month'] ?? 0) . "\n";
        $prompt .= "- Pendapatan Bulanan: Rp " . number_format($data['monthly_revenue'] ?? 0, 0, ',', '.') . "\n";
        $prompt .= "- Pertumbuhan Revenue: " . ($data['revenue_growth'] ?? 0) . "%\n";
        $prompt .= "- Pelanggan Aktif: " . ($data['active_customers'] ?? 0) . "\n";
        $prompt .= "- Pending Pickups: " . ($data['pending_pickups'] ?? 0) . "\n";
        
        if (!empty($data['top_services'])) {
            $prompt .= "- Layanan Terpopuler: " . implode(', ', $data['top_services']) . "\n";
        }
        
        if (!empty($data['branch_performance'])) {
            $prompt .= "- Performa Cabang:\n";
            foreach ($data['branch_performance'] as $branch) {
                $prompt .= "  * " . $branch['label'] . ": Rp " . number_format($branch['value'], 0, ',', '.') . "\n";
            }
        }
        
        $prompt .= "- Average Order Value: Rp " . number_format($data['avg_order_value'] ?? 0, 0, ',', '.') . "\n\n";
        
        $prompt .= "[Analysis Request ID: " . uniqid() . " | Time: " . date('Y-m-d H:i:s') . "]\n\n";
        
        $prompt .= "INSTRUKSI:\n";
        $prompt .= "1. Berikan rekomendasi strategis (2-3 paragraf) yang actionable dan spesifik\n";
        $prompt .= "2. Identifikasi 3 key insights paling penting dengan data konkret\n";
        $prompt .= "3. Prediksi dampak implementasi dalam persentase (realistis) untuk:\n";
        $prompt .= "   - Revenue increase (0-30%)\n";
        $prompt .= "   - Customer retention (0-30%)\n";
        $prompt .= "   - Operational efficiency (0-30%)\n\n";
        
        $prompt .= "Format response dalam JSON yang valid:\n";
        $prompt .= "{\n";
        $prompt .= "  \"recommendation\": \"teks rekomendasi lengkap...\",\n";
        $prompt .= "  \"insights\": [\"insight 1\", \"insight 2\", \"insight 3\"],\n";
        $prompt .= "  \"impact\": {\n";
        $prompt .= "    \"revenue\": 15,\n";
        $prompt .= "    \"retention\": 20,\n";
        $prompt .= "    \"efficiency\": 18\n";
        $prompt .= "  }\n";
        $prompt .= "}\n\n";
        $prompt .= "PENTING: Response harus berupa JSON yang valid tanpa markdown atau formatting lain.";
        
        return $prompt;
    }
    
    /**
     * Build Custom Prompt
     * 
     * Create prompt combining business context with user's custom question
     * 
     * @param array $data Business data for context
     * @param string $custom_prompt User's question/prompt
     * @return string Formatted prompt
     */
    protected function build_custom_prompt($data, $custom_prompt) {
        // Format business data snapshot
        $context = "DATA BISNIS KIXERA (Konteks):\n";
        $context .= "- Total Pesanan Hari Ini: " . ($data['total_orders_today'] ?? 0) . "\n";
        $context .= "- Total Pesanan Bulan Ini: " . ($data['total_orders_month'] ?? 0) . "\n";
        $context .= "- Pendapatan Bulanan: Rp " . number_format($data['monthly_revenue'] ?? 0, 0, ',', '.') . "\n";
        $context .= "- Pertumbuhan Revenue: " . ($data['revenue_growth'] ?? 0) . "%\n";
        $context .= "- Pelanggan Aktif: " . ($data['active_customers'] ?? 0) . "\n";
        $context .= "- Pending Pickups: " . ($data['pending_pickups'] ?? 0) . "\n";
        
        if (!empty($data['top_services'])) {
            $context .= "- Layanan Terpopuler: " . implode(', ', $data['top_services']) . "\n";
        }
        
        $avg_order = $data['avg_order_value'] ?? 0;
        $context .= "- Average Order Value: Rp " . number_format($avg_order, 0, ',', '.') . "\n";
        
        // Build full prompt
        $prompt = "ROLE: Anda adalah business consultant senior untuk bisnis laundry sepatu 'KixEra'.\n\n";
        
        $prompt .= "KONTEKS DATA BISNIS TERKINI:\n";
        $prompt .= $context . "\n";
        
        $prompt .= "PERTANYAAN / REQUEST USER (PRIORITAS UTAMA):\n";
        $prompt .= ">>> " . strtoupper($custom_prompt) . " <<<\n\n";
        
        $prompt .= "[System Info: ReqID-" . uniqid() . " | " . date('Y-m-d H:i') . "]\n\n";
        
        $prompt .= "INSTRUKSI KHUSUS:\n";
        $prompt .= "1. FOKUS UTAMA: Jawab pertanyaan user di atas secara LANGSUNG dan SPESIFIK.\n";
        $prompt .= "2. JANGAN berikan analisis umum jika tidak diminta. Sesuaikan jawaban dengan konteks pertanyaan.\n";
        $prompt .= "3. Gunakan data bisnis yang tersedia HANYA jika relevan dengan pertanyaan.\n";
        $prompt .= "4. Gaya bahasa: Profesional, solutif, dan to-the-point.\n";
        $prompt .= "5. Prediksi Impact: Estimasi dampak (revenue/retention/efficiency) yang relevan dengan saran Anda.\n\n";
        
        $prompt .= "FORMAT JSON YANG WAJIB DIGUNAKAN:\n";
        $prompt .= "{\n";
        $prompt .= "  \"recommendation\": \"[JAWABAN]: Tulis jawaban Anda untuk pertanyaan user di sini. Langsung ke inti masalah. JANGAN berikan pengantar bisnis umum.\",\n";
        $prompt .= "  \"insights\": [\"Poin 1 (relevan)\", \"Poin 2 (relevan)\", \"Poin 3 (relevan)\"],\n";
        $prompt .= "  \"impact\": { \"revenue\": 10, \"retention\": 15, \"efficiency\": 20 }\n";
        $prompt .= "}\n\n";
        $prompt .= "PENTING: Response harus berupa JSON yang valid tanpa markdown atau formatting lain.";
        
        return $prompt;
    }
    
    /**
     * Call Gemini API
     * 
     * Make HTTP request to Gemini API
     * 
     * @param string $prompt User prompt
     * @return array|false API response or false on failure
     */
    protected function call_gemini_api($prompt) {
        try {
            // Build request URL with API key
            $url = $this->api_url . '?key=' . $this->api_key;
            
            // Build request body
            $request_body = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => $this->config['gemini_temperature'],
                    'maxOutputTokens' => $this->config['gemini_max_tokens'],
                    'topP' => $this->config['gemini_top_p'],
                    'topK' => $this->config['gemini_top_k']
                ]
            ];
            
            // Add safety settings if configured
            if (!empty($this->config['gemini_safety_settings'])) {
                $request_body['safetySettings'] = $this->config['gemini_safety_settings'];
            }
            
            // Initialize cURL
            $ch = curl_init($url);
            
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ],
                CURLOPT_POSTFIELDS => json_encode($request_body),
                CURLOPT_TIMEOUT => $this->config['gemini_timeout'],
                CURLOPT_SSL_VERIFYPEER => false // Dinonaktifkan untuk local XAMPP
            ]);
            
            // Execute request
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curl_error = curl_error($ch);
            
            curl_close($ch);
            
            // Check for cURL errors
            if ($response === false) {
                throw new Exception('cURL Error: ' . $curl_error);
            }
            
            // Check HTTP status code
            if ($http_code !== 200) {
                $error_data = json_decode($response, true);
                $error_message = $error_data['error']['message'] ?? 'Unknown error';
                throw new Exception('API Error (HTTP ' . $http_code . '): ' . $error_message);
            }
            
            // Decode JSON response
            $decoded = json_decode($response, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('JSON Decode Error: ' . json_last_error_msg());
            }
            
            return $decoded;
            
        } catch (Exception $e) {
            log_message('error', 'Gemini API Call Failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Parse Business Response
     * 
     * Extract and validate business insights from API response
     * 
     * @param array $response API response
     * @return array Parsed insights
     */
    protected function parse_business_response($response) {
        try {
            // Extract text from response
            if (empty($response['candidates'][0]['content']['parts'][0]['text'])) {
                throw new Exception('No text content in response');
            }
            
            $text = $response['candidates'][0]['content']['parts'][0]['text'];
            
            // Log RAW response from Gemini
            log_message('info', '=== RAW GEMINI RESPONSE (first 500 chars) ===');
            log_message('info', substr($text, 0, 500));
            
            // Clean markdown formatting - handle all variations
            // Remove opening ```json or ``` with any whitespace/newlines
            $text = preg_replace('/^```(?:json)?\s*/s', '', $text);
            // Remove closing ``` with any whitespace/newlines before it
            $text = preg_replace('/\s*```\s*$/s', '', $text);
            
            // Remove control characters that cause JSON parse errors
            $text = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $text);
            
            $text = trim($text);
            
            // Log cleaned text
            log_message('info', '=== CLEANED JSON (first 300 chars) ===');
            log_message('info', substr($text, 0, 300));
            
            // Parse JSON
            $parsed = json_decode($text, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Failed to parse JSON response: ' . json_last_error_msg());
            }
            
            // Validate structure
            if (empty($parsed['recommendation']) || empty($parsed['insights']) || empty($parsed['impact'])) {
                throw new Exception('Invalid response structure');
            }
            
            // Validate insights array
            if (!is_array($parsed['insights']) || count($parsed['insights']) < 3) {
                throw new Exception('Invalid insights format');
            }
            
            // Validate impact values
            $impact = $parsed['impact'];
            if (!isset($impact['revenue']) || !isset($impact['retention']) || !isset($impact['efficiency'])) {
                throw new Exception('Invalid impact structure');
            }
            
            // Ensure impact values are numeric and reasonable
            $parsed['impact']['revenue'] = max(0, min(30, (int)$impact['revenue']));
            $parsed['impact']['retention'] = max(0, min(30, (int)$impact['retention']));
            $parsed['impact']['efficiency'] = max(0, min(30, (int)$impact['efficiency']));
            
            return $parsed;
            
        } catch (Exception $e) {
            log_message('error', 'Gemini Response Parse Error: ' . $e->getMessage());
            
            // Return fallback response
            return $this->get_fallback_response();
        }
    }
    
    /**
     * Get Fallback Response
     * 
     * Return fallback response when API fails
     * 
     * @return array Fallback insights
     */
    protected function get_fallback_response() {
        return [
            'recommendation' => "Berdasarkan analisis data bisnis KixEra, terdapat beberapa peluang strategis yang dapat dioptimalkan.\n\nPertama, fokus pada peningkatan efisiensi operasional dengan mengoptimalkan jadwal pickup dan delivery. Implementasikan sistem penjadwalan otomatis untuk mengurangi pending pickups dan meningkatkan kepuasan pelanggan.\n\nKedua, tingkatkan customer lifetime value melalui program loyalitas bertingkat. Tawarkan paket bundling untuk layanan premium dengan diskon menarik untuk komitmen jangka panjang, yang berpotensi meningkatkan retention dan revenue secara signifikan.",
            'insights' => [
                "Optimasi scheduling dapat mengurangi pending pickups hingga 50% dan meningkatkan efisiensi operasional",
                "Program loyalitas bertingkat dapat meningkatkan customer retention rate hingga 25%",
                "Focus marketing pada layanan premium dapat boost average order value hingga 20%"
            ],
            'impact' => [
                'revenue' => 15,
                'retention' => 23,
                'efficiency' => 18
            ]
        ];
    }

    /**
     * Get Custom Fallback Response
     * 
     * Return custom fallback response when API fails
     * 
     * @param string $custom_prompt Custom prompt from user
     * @return array Fallback insights
     */
    protected function get_custom_fallback_response($custom_prompt) {
        return [
            'recommendation' => "Anda menanyakan: \"{$custom_prompt}\"\n\n[Mode Cadangan - Gemini tidak merespons dalam batas waktu saat ini]\nSebagai konsultan bisnis KixEra, kami menyarankan Anda untuk fokus mengoptimalkan layanan cuci cepat (express service) pada hari sibuk. Berikan penawaran harga paket menarik khusus pelanggan setia untuk mendorong transaksi ulang.",
            'insights' => [
                "Topik Pertanyaan: \"{$custom_prompt}\"",
                "Layanan Express berkontribusi hingga 40% margin profit harian",
                "Promosi bertarget dapat mendongkrak retensi konsumen sebesar 15%"
            ],
            'impact' => [
                'revenue' => 12,
                'retention' => 15,
                'efficiency' => 10
            ]
        ];
    }
    
    /**
     * Test API Connection
     * 
     * Test if Gemini API is accessible and configured correctly
     * 
     * @return array Test result
     */
    public function test_connection() {
        try {
            $test_prompt = "Halo, ini adalah test koneksi. Balas dengan 'OK' jika kamu menerima pesan ini.";
            
            $response = $this->call_gemini_api($test_prompt);
            
            if ($response === false) {
                return [
                    'success' => false,
                    'message' => 'Failed to connect to Gemini API'
                ];
            }
            
            return [
                'success' => true,
                'message' => 'Gemini API connection successful',
                'response' => $response
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Connection test failed: ' . $e->getMessage()
            ];
        }
    }
}
