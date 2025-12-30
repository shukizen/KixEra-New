<?php
/**
 * Currency Helper
 * Helper untuk format mata uang dengan dukungan multi-currency
 */

if (!function_exists('format_currency')) {
    /**
     * Format amount based on current currency setting
     * @param float $amount - Amount in IDR (base currency)
     * @param string|null $currency - Override currency, null uses session
     * @return string - Formatted currency string
     */
    function format_currency($amount, $currency = null) {
        $CI =& get_instance();
        
        if ($currency === null) {
            $currency = $CI->session->userdata('mata_uang') ?? 'IDR';
        }
        
        // Exchange rates (approximate, base: IDR)
        $rates = get_exchange_rates();
        
        // Currency symbols and formatting
        $formats = [
            'IDR' => ['symbol' => 'Rp ', 'decimals' => 0, 'dec_sep' => ',', 'thousand_sep' => '.'],
            'USD' => ['symbol' => '$ ', 'decimals' => 2, 'dec_sep' => '.', 'thousand_sep' => ','],
        ];
        
        // Convert amount from IDR to target currency
        $converted_amount = $amount;
        if ($currency !== 'IDR' && isset($rates[$currency])) {
            $converted_amount = $amount / $rates[$currency];
        }
        
        // Get format settings
        $format = $formats[$currency] ?? $formats['IDR'];
        
        // Format the number
        $formatted = number_format(
            $converted_amount, 
            $format['decimals'], 
            $format['dec_sep'], 
            $format['thousand_sep']
        );
        
        return $format['symbol'] . $formatted;
    }
}

if (!function_exists('get_exchange_rates')) {
    /**
     * Get exchange rates (IDR as base)
     * These are approximate rates and should be updated regularly
     * @return array
     */
    function get_exchange_rates() {
        return [
            'IDR' => 1,
            'USD' => 15500,    // 1 USD = 15,500 IDR
            'EUR' => 17000,    // 1 EUR = 17,000 IDR
            'SGD' => 11500,    // 1 SGD = 11,500 IDR
            'MYR' => 3500,     // 1 MYR = 3,500 IDR
        ];
    }
}

if (!function_exists('format_number')) {
    /**
     * Format number with locale-aware separators
     * @param float $number
     * @param int $decimals
     * @return string
     */
    function format_number($number, $decimals = 0) {
        $CI =& get_instance();
        $currency = $CI->session->userdata('mata_uang') ?? 'IDR';
        
        // Use different separator based on currency locale
        if (in_array($currency, ['USD', 'SGD', 'MYR'])) {
            return number_format($number, $decimals, '.', ',');
        }
        
        return number_format($number, $decimals, ',', '.');
    }
}

if (!function_exists('get_currency_symbol')) {
    /**
     * Get currency symbol
     * @param string|null $currency
     * @return string
     */
    function get_currency_symbol($currency = null) {
        $CI =& get_instance();
        
        if ($currency === null) {
            $currency = $CI->session->userdata('mata_uang') ?? 'IDR';
        }
        
        $symbols = [
            'IDR' => 'Rp',
            'USD' => '$',
            'EUR' => '€',
            'SGD' => 'S$',
            'MYR' => 'RM',
        ];
        
        return $symbols[$currency] ?? 'Rp';
    }
}

if (!function_exists('get_current_currency')) {
    /**
     * Get current currency code
     * @return string
     */
    function get_current_currency() {
        $CI =& get_instance();
        return $CI->session->userdata('mata_uang') ?? 'IDR';
    }
}