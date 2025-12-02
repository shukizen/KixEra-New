<?php
if (!function_exists('format_currency')) {
    function format_currency($amount) {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('format_number')) {
    function format_number($number, $decimals = 0) {
        return number_format($number, $decimals, ',', '.');
    }
}