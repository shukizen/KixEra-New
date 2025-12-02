<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Time Helper
 *
 * Helper functions for time formatting
 */

if (!function_exists('time_ago')) {
    /**
     * Convert timestamp to "time ago" format
     *
     * @param string $datetime
     * @return string
     */
    function time_ago($datetime) {
        $time = time() - strtotime($datetime);

        if ($time < 60) return 'baru saja';
        if ($time < 3600) return floor($time/60) . ' menit yang lalu';
        if ($time < 86400) return floor($time/3600) . ' jam yang lalu';
        if ($time < 2592000) return floor($time/86400) . ' hari yang lalu';
        if ($time < 31104000) return floor($time/2592000) . ' bulan yang lalu';
        
        return floor($time/31104000) . ' tahun yang lalu';
    }
}

if (!function_exists('format_date_indo')) {
    /**
     * Format date to Indonesian format
     *
     * @param string $date
     * @param bool $show_time
     * @return string
     */
    function format_date_indo($date, $show_time = false) {
        if (empty($date) || $date == '0000-00-00' || $date == '0000-00-00 00:00:00') {
            return '-';
        }

        $months = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $timestamp = strtotime($date);
        $day = date('d', $timestamp);
        $month = $months[(int)date('m', $timestamp)];
        $year = date('Y', $timestamp);

        $formatted = "$day $month $year";

        if ($show_time) {
            $time = date('H:i', $timestamp);
            $formatted .= " $time";
        }

        return $formatted;
    }
}

if (!function_exists('days_between')) {
    /**
     * Calculate days between two dates
     *
     * @param string $date1
     * @param string $date2
     * @return int
     */
    function days_between($date1, $date2) {
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);
        
        return floor(($timestamp2 - $timestamp1) / (60 * 60 * 24));
    }
}

if (!function_exists('is_today')) {
    /**
     * Check if date is today
     *
     * @param string $date
     * @return bool
     */
    function is_today($date) {
        return date('Y-m-d', strtotime($date)) == date('Y-m-d');
    }
}

if (!function_exists('is_yesterday')) {
    /**
     * Check if date is yesterday
     *
     * @param string $date
     * @return bool
     */
    function is_yesterday($date) {
        return date('Y-m-d', strtotime($date)) == date('Y-m-d', strtotime('-1 day'));
    }
}