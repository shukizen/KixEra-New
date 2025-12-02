<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Helper untuk format keuangan
 */

if (!function_exists('format_rupiah')) {
    /**
     * Format angka ke format Rupiah Indonesia (IDR)
     * @param float $angka
     * @return string
     */
    function format_rupiah($angka) {
        if ($angka === null || $angka === '') {
            return 'Rp 0';
        }
        // Pastikan input adalah angka
        $angka = (float) $angka;
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('format_rupiah_js')) {
    /**
     * Fungsi utilitas JavaScript untuk format Rupiah (bisa disisipkan ke view)
     * @return string
     */
    function format_rupiah_js() {
        return "
        <script>
        if (typeof window.FinancialUtils === 'undefined') {
            window.FinancialUtils = {};
        }
        window.FinancialUtils.formatRupiah = function(angka) {
            if (angka === null || angka === '' || isNaN(angka)) {
                return 'Rp 0';
            }
            // Gunakan Intl.NumberFormat untuk hasil paling akurat
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(angka);
        };
        </script>
        ";
    }
}