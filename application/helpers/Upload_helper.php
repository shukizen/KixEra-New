<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Helper upload file di CodeIgniter
 *
 * @param string $field       Nama field input file (mis: 'bukti_file')
 * @param string $path        Lokasi folder upload (wajib absolute path, mis: FCPATH.'uploads/.../')
 * @param string $allowed     Jenis file yang diizinkan (default: pdf|jpg|jpeg|png)
 * @param int    $max_size    Ukuran maksimum file (KB). Default 5120 (5MB)
 * @return array              [bool $success, mixed $dataOrError]
 *                            - Jika sukses: [true, array $filedata]
 *                            - Jika gagal:  [false, string $errorMessage]
 */
if (!function_exists('do_upload_file')) {
    function do_upload_file($field, $path, $allowed = 'pdf|jpg|jpeg|png', $max_size = 5120) {
        $CI =& get_instance();

        // Buat folder jika belum ada
        if (!is_dir($path)) {
            @mkdir($path, 0775, true);
        }

        $config = [
            'upload_path'   => $path,
            'allowed_types' => $allowed,
            'max_size'      => $max_size,
            'encrypt_name'  => TRUE,
        ];

        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload($field)) {
            return [false, $CI->upload->display_errors('', '')];
        }

        return [true, $CI->upload->data()];
    }
}
