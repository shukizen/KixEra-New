<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Keuangan Helper
 * 
 * Helper functions for financial formatting and calculations
 * Save this as: application/helpers/keuangan_helper.php
 */

if (!function_exists('format_rupiah')) {
    /**
     * Format number to Indonesian Rupiah format
     * 
     * @param float $value The numeric value to format
     * @param bool $show_currency Whether to show "Rp " prefix (default: true)
     * @param int $decimals Number of decimal places (default: 0)
     * @return string Formatted currency string
     */
    function format_rupiah(float $value, bool $show_currency = true, int $decimals = 0): string
    {
        if ($value === null || $value === '') {
            return $show_currency ? 'Rp 0' : '0';
        }
        
        $formatted = number_format($value, $decimals, ',', '.');
        
        return $show_currency ? 'Rp ' . $formatted : $formatted;
    }
}

if (!function_exists('format_number_short')) {
    /**
     * Format large numbers with K, M, B suffix
     * 
     * @param float $value The numeric value to format
     * @param int $decimals Number of decimal places (default: 1)
     * @return string Formatted number with suffix
     */
    function format_number_short(float $value, int $decimals = 1): string
    {
        if ($value === null || $value === '') {
            return '0';
        }
        
        $abs_value = abs($value);
        $sign = $value < 0 ? '-' : '';
        
        if ($abs_value >= 1000000000) {
            // Billions
            return $sign . number_format($abs_value / 1000000000, $decimals) . 'B';
        } elseif ($abs_value >= 1000000) {
            // Millions
            return $sign . number_format($abs_value / 1000000, $decimals) . 'M';
        } elseif ($abs_value >= 1000) {
            // Thousands
            return $sign . number_format($abs_value / 1000, $decimals) . 'K';
        }
        
        return $sign . number_format($abs_value, 0);
    }
}

if (!function_exists('format_rupiah_short')) {
    /**
     * Format currency with short notation (K, M, B)
     * 
     * @param float $value The numeric value to format
     * @param int $decimals Number of decimal places (default: 1)
     * @return string Formatted currency string with suffix
     */
    function format_rupiah_short(float $value, int $decimals = 1): string
    {
        if ($value === null || $value === '') {
            return 'Rp 0';
        }
        
        return 'Rp ' . format_number_short($value, $decimals);
    }
}

if (!function_exists('percentage_format')) {
    /**
     * Format percentage with proper styling
     * 
     * @param float $value The percentage value (0-100)
     * @param int $decimals Number of decimal places (default: 1)
     * @return string Formatted percentage
     */
    function percentage_format(float $value, int $decimals = 1): string
    {
        if ($value === null || $value === '') {
            return '0%';
        }
        
        return number_format($value, $decimals, ',', '.') . '%';
    }
}

if (!function_exists('get_status_badge_class')) {
    /**
     * Get CSS classes for status badges based on value
     * 
     * @param string $status The status value
     * @param float|null $value Optional numeric value for comparison
     * @return string CSS classes for badge
     */
    function get_status_badge_class(string $status, ?float $value = null): string
    {
        switch (strtolower($status)) {
            case 'positive':
            case 'profit':
            case 'surplus':
                return 'bg-green-100 text-green-800';
            
            case 'negative':
            case 'loss':
            case 'deficit':
                return 'bg-red-100 text-red-800';
            
            case 'neutral':
            case 'break_even':
                return 'bg-gray-100 text-gray-800';
            
            case 'warning':
                return 'bg-yellow-100 text-yellow-800';
            
            default:
                // Use value-based logic if status is unclear
                if ($value !== null) {
                    if ($value > 0) {
                        return 'bg-green-100 text-green-800';
                    } elseif ($value < 0) {
                        return 'bg-red-100 text-red-800';
                    } else {
                        return 'bg-gray-100 text-gray-800';
                    }
                }
                return 'bg-gray-100 text-gray-800';
        }
    }
}

if (!function_exists('get_trend_icon')) {
    /**
     * Get trend icon based on value comparison
     * 
     * @param float $current Current value
     * @param float $previous Previous value
     * @return string Lucide icon name
     */
    function get_trend_icon(float $current, float $previous): string
    {
        if ($current > $previous) {
            return 'trending-up';
        } elseif ($current < $previous) {
            return 'trending-down';
        } else {
            return 'minus';
        }
    }
}

if (!function_exists('calculate_percentage_change')) {
    /**
     * Calculate percentage change between two values
     * 
     * @param float $current Current value
     * @param float $previous Previous value
     * @return float Percentage change
     */
    function calculate_percentage_change(float $current, float $previous): float
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        
        return (($current - $previous) / abs($previous)) * 100;
    }
}

if (!function_exists('format_month_year')) {
    /**
     * Format month-year string for display
     * 
     * @param string $month_str Month string in Y-m format
     * @param string $format Output format (default: 'M Y')
     * @return string Formatted month-year
     */
    function format_month_year(string $month_str, string $format = 'M Y'): string
    {
        try {
            $date = DateTime::createFromFormat('Y-m', $month_str);
            if ($date === false) {
                // Try with day appended
                $date = DateTime::createFromFormat('Y-m-d', $month_str . '-01');
            }
            
            if ($date !== false) {
                return $date->format($format);
            }
            
            return $month_str; // Return original if parsing fails
        } catch (Exception $e) {
            return $month_str; // Return original on error
        }
    }
}