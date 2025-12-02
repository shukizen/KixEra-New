<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Keuangan Export Controller - COMPLETE VERSION
 * 
 * Include:
 * 1. Export General (dengan filter) - Excel/PDF
 * 2. Export Per Proyek - Excel/PDF
 * 
 * EXACT COPY dari semua fungsi export di Keuangan.php
 */
class Export_keuangan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keuangan_model');
        $this->load->model('Proyek_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    // ==================== EXPORT GENERAL (dengan filter) ====================

    /**
     * Export functionality - ORIGINAL ADVANCED VERSION (EXACT COPY)
     * URL: keuangan_export/export/excel atau keuangan_export/export/pdf
     */
    public function export($format = 'excel')
    {
        try {
            if (!in_array($format, ['excel', 'pdf'])) {
                show_error('Format export tidak valid');
            }
            
            // Get filters from both GET and POST (POST has priority for form submission)
            $filters = $this->get_export_filters();
            $export_type = $this->get_export_type();
            
            // Log untuk debugging
            log_message('info', 'Export dengan filters: ' . json_encode($filters));
            log_message('info', 'Export type: ' . $export_type);
            
            $data = $this->prepare_enhanced_export_data($filters, $export_type);
            
            if ($format == 'excel') {
                $this->export_to_structured_excel($data, $export_type);
            } else {
                $this->export_to_working_pdf($data, $export_type);
            }
        } catch (Exception $e) {
            log_message('error', 'Export error: ' . $e->getMessage());
            show_error('Gagal mengexport data keuangan: ' . $e->getMessage());
        }
    }

    private function get_export_filters()
    {
        $filters = array();
        
        // Prioritas: POST > GET
        $sources = [$_POST, $_GET];
        
        foreach ($sources as $source) {
            if (!empty($source['search'])) $filters['search'] = trim($source['search']);
            if (!empty($source['project_id'])) $filters['project_id'] = $source['project_id'];
            if (!empty($source['category'])) $filters['category'] = $source['category'];
            if (!empty($source['transaction_type'])) $filters['transaction_type'] = $source['transaction_type'];
            if (!empty($source['date_start'])) $filters['date_start'] = $source['date_start'];
            if (!empty($source['date_end'])) $filters['date_end'] = $source['date_end'];
            if (!empty($source['amount_min'])) $filters['amount_min'] = $source['amount_min'];
            if (!empty($source['amount_max'])) $filters['amount_max'] = $source['amount_max'];
            
            // Break setelah menemukan data dari POST jika ada
            if ($source === $_POST && !empty(array_filter($filters))) {
                break;
            }
        }
        
        return $filters;
    }

    private function get_export_type()
    {
        return !empty($_POST['export_type']) ? $_POST['export_type'] : 
               (!empty($_GET['export_type']) ? $_GET['export_type'] : 'all');
    }

    private function prepare_enhanced_export_data($filters, $export_type)
    {
        $data = array(
            'filters' => $filters,
            'export_type' => $export_type,
            'generated_at' => date('Y-m-d H:i:s'),
            'generated_by' => $this->session->userdata('nama_lengkap'),
            'period_info' => $this->get_period_info($filters),
            'filter_summary' => $this->get_filter_summary($filters)
        );

        // Get summary dengan filter
        $project_id = !empty($filters['project_id']) ? $filters['project_id'] : null;
        $data['summary'] = $this->Keuangan_model->get_financial_summary($project_id);

        switch ($export_type) {
            case 'income_only':
                $data['transactions'] = $this->get_filtered_transactions_by_type($filters, 'income');
                $data['title'] = 'Laporan Pemasukan' . $this->get_filter_title_suffix($filters);
                break;
                
            case 'expense_only':
                $data['transactions'] = $this->get_filtered_transactions_by_type($filters, 'expense');
                $data['expense_breakdown'] = $this->Keuangan_model->get_expense_breakdown(12, $project_id);
                $data['title'] = 'Laporan Pengeluaran' . $this->get_filter_title_suffix($filters);
                break;
                
            case 'profit_loss':
                $data['profit_loss'] = $this->Keuangan_model->get_monthly_profit_loss($filters);
                $data['title'] = 'Laporan Laba Rugi Per Proyek' . $this->get_filter_title_suffix($filters);
                break;
                
            default: // all
                $all_transactions = $this->Keuangan_model->get_filtered_transactions($filters);
                $data['transactions'] = $all_transactions;
                $data['income_transactions'] = $this->get_filtered_transactions_by_type($filters, 'income');
                $data['expense_transactions'] = $this->get_filtered_transactions_by_type($filters, 'expense');
                $data['expense_breakdown'] = $this->Keuangan_model->get_expense_breakdown(12, $project_id);
                $data['title'] = 'Laporan Keuangan Lengkap' . $this->get_filter_title_suffix($filters);
                break;
        }

        return $data;
    }

    // ==================== EXPORT PER PROYEK ====================

    /**
     * Export Project Excel - Per proyek (EXACT COPY)
     * URL: keuangan_export/project_excel/{project_id}
     */
    public function project_excel($project_id)
    {
        try {
            $project = $this->Proyek_model->get_project_by_id($project_id);
            if (!$project) {
                show_404();
            }
            
            $data = $this->prepare_project_export_data($project_id);
            
            $filename = 'Keuangan_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $project['nama_proyek']) . '_' . date('Y-m-d_H-i-s') . '.csv';
            
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            
            $output = fopen('php://output', 'w');
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Project header
            fputcsv($output, ['LAPORAN KEUANGAN PROYEK']);
            fputcsv($output, [$project['nama_proyek']]);
            fputcsv($output, ['Klien: ' . $project['nama_klien']]);
            fputcsv($output, ['Periode: ' . date('d/m/Y', strtotime($project['tgl_mulai'])) . ' - ' . date('d/m/Y', strtotime($project['deadline']))]);
            fputcsv($output, []);
            
            // Project summary
            fputcsv($output, ['=== RINGKASAN PROYEK ===']);
            fputcsv($output, ['Anggaran Total', 'Rp ' . number_format($project['anggaran'], 0, ',', '.')]);
            fputcsv($output, ['Total Dibayar', 'Rp ' . number_format($data['total_paid'], 0, ',', '.')]);
            fputcsv($output, ['Belum Dibayar', 'Rp ' . number_format($project['anggaran'] - $data['total_paid'], 0, ',', '.')]);
            fputcsv($output, ['Margin Terealisasi', 'Rp ' . number_format($data['total_margin_realized'], 0, ',', '.')]);
            fputcsv($output, []);
            
            // Income records
            if (!empty($data['income_records'])) {
                fputcsv($output, ['=== PEMASUKAN PROYEK ===']);
                fputcsv($output, ['Tanggal', 'Sumber', 'Jumlah', 'Termin', 'Keterangan']);
                
                foreach ($data['income_records'] as $income) {
                    fputcsv($output, [
                        date('d/m/Y', strtotime($income['tanggal'])),
                        $income['sumber'],
                        'Rp ' . number_format($income['jumlah'], 0, ',', '.'),
                        $income['termin'] ? 'Termin ' . $income['termin'] : '-',
                        $income['keterangan']
                    ]);
                }
                fputcsv($output, []);
            }
            
            // Expense records
            if (!empty($data['expense_records'])) {
                fputcsv($output, ['=== PENGELUARAN PROYEK ===']);
                fputcsv($output, ['Tanggal', 'Kategori', 'Deskripsi', 'Jumlah', 'Termin', 'Keterangan']);
                
                foreach ($data['expense_records'] as $expense) {
                    fputcsv($output, [
                        date('d/m/Y', strtotime($expense['tanggal'])),
                        $expense['kategori'],
                        $expense['keterangan'],
                        'Rp ' . number_format($expense['jumlah'], 0, ',', '.'),
                        $expense['termin'] ? 'Termin ' . $expense['termin'] : '-',
                        $expense['keterangan']
                    ]);
                }
            }
            
            fclose($output);
            
        } catch (Exception $e) {
            log_message('error', 'Export project Excel error: ' . $e->getMessage());
            show_error('Gagal mengexport data keuangan proyek.');
        }
    }

    /**
     * Export Project PDF - Per proyek (EXACT COPY)
     * URL: keuangan_export/project_pdf/{project_id}
     */
    public function project_pdf($project_id)
    {
        try {
            $project = $this->Proyek_model->get_project_by_id($project_id);
            if (!$project) {
                show_404();
            }
            
            $data = $this->prepare_project_export_data($project_id);
            
            $this->export_project_to_pdf($data, $project);
            
        } catch (Exception $e) {
            log_message('error', 'Export project PDF error: ' . $e->getMessage());
            show_error('Gagal mengexport PDF keuangan proyek.');
        }
    }

    /**
     * Prepare project export data (EXACT COPY)
     */
    private function prepare_project_export_data($project_id)
    {
        $project = $this->Proyek_model->get_project_by_id($project_id);
        $termins = $this->get_project_termins($project_id);
        $income_records = $this->get_income_by_project($project_id);
        $expense_records = $this->get_expense_by_project($project_id);
        
        $financial_summary = $this->calculate_financial_summary($project_id, $termins);
        
        return array_merge([
            'project' => $project,
            'termins' => $termins,
            'income_records' => $income_records,
            'expense_records' => $expense_records,
            'generated_at' => date('Y-m-d H:i:s'),
            'generated_by' => $this->session->userdata('nama_lengkap')
        ], $financial_summary);
    }

    /**
     * Export project to PDF (EXACT COPY)
     */
    private function export_project_to_pdf($data, $project)
    {
        $filename = 'Keuangan_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $project['nama_proyek']) . '_' . date('Y-m-d_H-i-s') . '.html';
        
        header('Content-Type: text/html; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $html = '<!DOCTYPE html>
        <html>
        <head>
            <title>Laporan Keuangan Proyek - ' . htmlspecialchars($project['nama_proyek']) . '</title>
            <meta charset="utf-8">
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; font-size: 12px; }
                .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 20px; }
                table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 11px; }
                th { background: #f2f2f2; font-weight: bold; }
                .income { color: #10b981; font-weight: bold; }
                .expense { color: #ef4444; font-weight: bold; }
            </style>
        </head>
        <body>';
        
        // Header
        $html .= '<div class="header">
            <h1>LAPORAN KEUANGAN PROYEK</h1>
            <h3>PT. GASNI ADITAMA KONSTRUKSI</h3>
            <p>Generated: ' . $data['generated_at'] . ' by ' . $data['generated_by'] . '</p>
        </div>';
        
        // Project info
        $html .= '<h3>INFORMASI PROYEK</h3>';
        $html .= '<table><tr><td>Nama Proyek:</td><td>' . htmlspecialchars($project['nama_proyek']) . '</td></tr>';
        $html .= '<tr><td>Klien:</td><td>' . htmlspecialchars($project['nama_klien'] ?? 'N/A') . '</td></tr>';
        $html .= '<tr><td>Anggaran:</td><td class="income">Rp ' . number_format($project['anggaran'], 0, ',', '.') . '</td></tr></table>';
        
        $html .= '</body></html>';
        
        echo $html;
    }

    /**
     * Get project termins (EXACT COPY)
     */
    private function get_project_termins($project_id)
    {
        if (!$this->db->table_exists('termin_progress')) {
            return [];
        }
        
        $this->db->select('*');
        $this->db->from('termin_progress');
        $this->db->where('proyek_id', $project_id);
        $this->db->order_by('termin', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get income by project (EXACT COPY)
     */
    private function get_income_by_project($project_id)
    {
        return $this->Keuangan_model->get_income_by_project($project_id);
    }

    /**
     * Get expense by project (EXACT COPY)
     */
    private function get_expense_by_project($project_id)
    {
        return $this->Keuangan_model->get_expenses_by_project($project_id);
    }

    /**
     * Calculate financial summary (EXACT COPY)
     */
    private function calculate_financial_summary($project_id, $termins)
    {
        $total_paid = 0;
        $total_modal_realized = 0;
        $total_margin_realized = 0;
        $completed_termins = 0;
        
        foreach ($termins as $termin) {
            if (in_array($termin['status'], ['confirmed', 'completed'])) {
                $total_paid += $termin['jumlah_pembayaran'];
                $total_modal_realized += $termin['jumlah_modal'];
                $total_margin_realized += $termin['jumlah_margin'];
                
                if ($termin['status'] == 'completed') {
                    $completed_termins++;
                }
            }
        }
        
        // Get total income and expense
        $project_summary = $this->Keuangan_model->get_financial_summary($project_id);
        
        return [
            'total_paid' => $total_paid,
            'total_modal_realized' => $total_modal_realized,
            'total_margin_realized' => $total_margin_realized,
            'completed_termins' => $completed_termins,
            'total_income' => $project_summary['total_income'],
            'total_expense' => $project_summary['total_expenses']
        ];
    }

    // ==================== HELPER METHODS ====================

    private function get_filter_title_suffix($filters)
    {
        $suffix_parts = array();
        
        if (!empty($filters['project_id'])) {
            $project = $this->Proyek_model->get_project_by_id($filters['project_id']);
            if ($project) {
                $suffix_parts[] = $project['nama_proyek'];
            }
        }
        
        if (!empty($filters['date_start']) && !empty($filters['date_end'])) {
            $suffix_parts[] = date('M Y', strtotime($filters['date_start'])) . ' - ' . date('M Y', strtotime($filters['date_end']));
        }
        
        return !empty($suffix_parts) ? ' (' . implode(' | ', $suffix_parts) . ')' : '';
    }

    private function get_filter_summary($filters)
    {
        $summary = array();
        
        if (!empty($filters['project_id'])) {
            $project = $this->Proyek_model->get_project_by_id($filters['project_id']);
            $summary['Proyek'] = $project ? $project['nama_proyek'] : 'Tidak ditemukan';
        }
        
        if (!empty($filters['transaction_type'])) {
            $summary['Tipe Transaksi'] = $filters['transaction_type'] == 'income' ? 'Pemasukan' : 'Pengeluaran';
        }
        
        if (!empty($filters['category'])) {
            $summary['Kategori'] = $filters['category'];
        }
        
        if (!empty($filters['date_start'])) {
            $summary['Tanggal Mulai'] = date('d/m/Y', strtotime($filters['date_start']));
        }
        
        if (!empty($filters['date_end'])) {
            $summary['Tanggal Akhir'] = date('d/m/Y', strtotime($filters['date_end']));
        }
        
        if (!empty($filters['search'])) {
            $summary['Pencarian'] = $filters['search'];
        }
        
        return $summary;
    }

    private function get_period_info($filters)
    {
        if (!empty($filters['date_start']) && !empty($filters['date_end'])) {
            return $filters['date_start'] . ' sampai ' . $filters['date_end'];
        }
        return 'Semua periode';
    }

    private function generate_filename($title, $extension)
    {
        $date = date('Y-m-d_H-i-s');
        $cleanTitle = preg_replace('/[^a-zA-Z0-9_-]/', '_', $title);
        return $cleanTitle . '_' . $date . '.' . $extension;
    }

    private function get_filtered_transactions_by_type($filters, $type)
    {
        $type_filters = $filters;
        $type_filters['transaction_type'] = $type;
        return $this->Keuangan_model->get_filtered_transactions($type_filters);
    }

    // ==================== EXCEL EXPORT METHODS ====================

    /**
     * Excel export dengan template yang terstruktur - EXACT COPY
     */
    private function export_to_structured_excel($data, $export_type)
    {
        try {
            // Cek apakah PhpSpreadsheet tersedia
            if (!class_exists('\PhpOffice\PhpSpreadsheet\Spreadsheet')) {
                $this->export_to_csv_fallback($data, $export_type);
                return;
            }
            
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            
            // Set metadata
            $spreadsheet->getProperties()
                ->setCreator('PT. GASNI ADITAMA KONSTRUKSI')
                ->setTitle($data['title'])
                ->setDescription('Laporan Keuangan - Financial Management System');
            
            // Export berdasarkan tipe
            switch ($export_type) {
                case 'all':
                    $this->create_complete_financial_workbook($spreadsheet, $data);
                    break;
                case 'income_only':
                    $this->create_income_sheet($spreadsheet, $data);
                    break;
                case 'expense_only':
                    $this->create_expense_sheet($spreadsheet, $data);
                    break;
                case 'profit_loss':
                    $this->create_profit_loss_sheet($spreadsheet, $data);
                    break;
                default:
                    $this->create_complete_financial_workbook($spreadsheet, $data);
            }
            
            // Generate filename
            $filename = $this->generate_filename($data['title'], 'xlsx');
            
            // Set headers
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
            
        } catch (Exception $e) {
            log_message('error', 'Structured Excel export error: ' . $e->getMessage());
            $this->export_to_csv_fallback($data, $export_type);
        }
    }

    /**
     * Membuat workbook lengkap dengan multiple sheets - EXACT COPY
     */
    private function create_complete_financial_workbook($spreadsheet, $data)
    {
        // Sheet 1: Summary
        $this->create_summary_sheet($spreadsheet, $data);
        
        // Sheet 2: Transactions
        if (!empty($data['transactions'])) {
            $transactionSheet = $spreadsheet->createSheet(1);
            $transactionSheet->setTitle('All Transactions');
            $this->populate_transaction_sheet($transactionSheet, $data['transactions'], 'Semua Transaksi');
        }
        
        // Sheet 3: Income Only
        if (!empty($data['income_transactions'])) {
            $incomeSheet = $spreadsheet->createSheet(2);
            $incomeSheet->setTitle('Income');
            $this->populate_income_sheet($incomeSheet, $data['income_transactions']);
        }
        
        // Sheet 4: Expense Only
        if (!empty($data['expense_transactions'])) {
            $expenseSheet = $spreadsheet->createSheet(3);
            $expenseSheet->setTitle('Expenses');
            $this->populate_expense_sheet($expenseSheet, $data['expense_transactions'], $data['expense_breakdown'] ?? []);
        }
        
        // Sheet 5: Profit Loss
        if (!empty($data['profit_loss'])) {
            $profitSheet = $spreadsheet->createSheet(4);
            $profitSheet->setTitle('Profit Loss');
            $this->populate_profit_loss_sheet($profitSheet, $data['profit_loss']);
        }
        
        // Aktifkan sheet pertama
        $spreadsheet->setActiveSheetIndex(0);
    }

    /**
     * Membuat sheet summary - EXACT COPY
     */
    private function create_summary_sheet($spreadsheet, $data)
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Summary');
        
        $row = 1;
        
        // Header perusahaan dengan styling
        $sheet->setCellValue('A1', 'PT. GASNI ADITAMA KONSTRUKSI');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => '000000']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
        ]);
        $sheet->mergeCells('A1:F1');
        
        $row = 3;
        $sheet->setCellValue('A3', strtoupper($data['title']));
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '333333']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
        ]);
        $sheet->mergeCells('A3:F3');
        
        $row = 5;
        
        // Info laporan
        $sheet->setCellValue('A5', 'Generated:');
        $sheet->setCellValue('B5', $data['generated_at']);
        $sheet->setCellValue('A6', 'By:');
        $sheet->setCellValue('B6', $data['generated_by']);
        
        $row = 8;
        
        // Summary box dengan styling
        $sheet->setCellValue('A8', 'RINGKASAN KEUANGAN');
        $sheet->getStyle('A8')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'FFC300']],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
        ]);
        $sheet->mergeCells('A8:D8');
        
        $summaryData = [
            ['Total Pemasukan', 'Rp ' . number_format($data['summary']['total_income'], 0, ',', '.'), 'INCOME', ''],
            ['Total Pengeluaran', 'Rp ' . number_format($data['summary']['total_expenses'], 0, ',', '.'), 'EXPENSE', ''],
            ['Saldo Bersih', 'Rp ' . number_format($data['summary']['net_profit'], 0, ',', '.'), 'NET', ''],
            ['Margin Keuntungan', number_format($data['summary']['total_income'] > 0 ? ($data['summary']['net_profit'] / $data['summary']['total_income']) * 100 : 0, 2) . '%', 'MARGIN', '']
        ];
        
        $row = 9;
        foreach ($summaryData as $summaryRow) {
            $sheet->setCellValue('A' . $row, $summaryRow[0]);
            $sheet->setCellValue('B' . $row, $summaryRow[1]);
            
            // Styling berdasarkan tipe
            $styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]];
            
            if ($summaryRow[2] == 'INCOME') {
                $styleArray['font'] = ['color' => ['rgb' => '10B981']];
            } elseif ($summaryRow[2] == 'EXPENSE') {
                $styleArray['font'] = ['color' => ['rgb' => 'EF4444']];
            } elseif ($summaryRow[2] == 'NET') {
                $styleArray['font'] = ['bold' => true];
            }
            
            $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray($styleArray);
            $row++;
        }
        
        // Auto-resize columns
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    /**
     * Sheet untuk income saja - EXACT COPY
     */
    private function create_income_sheet($spreadsheet, $data)
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Income Report');
        
        $this->add_sheet_header($sheet, 'LAPORAN PEMASUKAN', $data);
        $this->populate_income_sheet($sheet, $data['transactions']);
    }

    /**
     * Sheet untuk expense saja - EXACT COPY
     */
    private function create_expense_sheet($spreadsheet, $data)
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Expense Report');
        
        $this->add_sheet_header($sheet, 'LAPORAN PENGELUARAN', $data);
        $this->populate_expense_sheet($sheet, $data['transactions'], $data['expense_breakdown'] ?? []);
    }

    /**
     * Sheet untuk profit loss - EXACT COPY
     */
    private function create_profit_loss_sheet($spreadsheet, $data)
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Profit Loss Report');
        
        $this->add_sheet_header($sheet, 'LAPORAN LABA RUGI PER PROYEK', $data);
        $this->populate_profit_loss_sheet($sheet, $data['profit_loss']);
    }

    /**
     * Menambahkan header standar ke sheet - EXACT COPY
     */
    private function add_sheet_header($sheet, $title, $data)
    {
        // Company header
        $sheet->setCellValue('A1', 'PT. GASNI ADITAMA KONSTRUKSI');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
        ]);
        $sheet->mergeCells('A1:H1');
        
        // Title
        $sheet->setCellValue('A3', $title);
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
        ]);
        $sheet->mergeCells('A3:H3');
        
        // Metadata
        $sheet->setCellValue('A5', 'Generated: ' . $data['generated_at']);
        $sheet->setCellValue('A6', 'By: ' . $data['generated_by']);
    }

    /**
     * Populate sheet dengan data transaksi - EXACT COPY
     */
    private function populate_transaction_sheet($sheet, $transactions, $title)
    {
        $this->add_sheet_header($sheet, $title, ['generated_at' => date('Y-m-d H:i:s'), 'generated_by' => 'System']);
        
        $row = 8;
        
        // Headers
        $headers = ['No', 'Tanggal', 'Proyek', 'Tipe', 'Kategori', 'Deskripsi', 'Jumlah', 'Saldo'];
        
        foreach ($headers as $col => $header) {
            $cellAddress = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row;
            $sheet->setCellValue($cellAddress, $header);
            $sheet->getStyle($cellAddress)->applyFromArray([
                'font' => ['bold' => true],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'E5E7EB']],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
            ]);
        }
        
        $row++;
        
        // Data
        $no = 1;
        foreach ($transactions as $transaction) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, date('d/m/Y', strtotime($transaction['tanggal'])));
            $sheet->setCellValue('C' . $row, $transaction['nama_proyek']);
            $sheet->setCellValue('D' . $row, $transaction['transaction_type'] == 'income' ? 'Pemasukan' : 'Pengeluaran');
            $sheet->setCellValue('E' . $row, $transaction['kategori']);
            $sheet->setCellValue('F' . $row, $transaction['deskripsi']);
            $sheet->setCellValue('G' . $row, $transaction['jumlah']);
            $sheet->setCellValue('H' . $row, $transaction['running_balance'] ?? 0);
            
            // Format currency
            $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode('#,##0');
            
            // Color coding
            if ($transaction['transaction_type'] == 'income') {
                $sheet->getStyle('D' . $row . ':G' . $row)->applyFromArray(['font' => ['color' => ['rgb' => '10B981']]]);
            } else {
                $sheet->getStyle('D' . $row . ':G' . $row)->applyFromArray(['font' => ['color' => ['rgb' => 'EF4444']]]);
            }
            
            $row++;
            $no++;
        }
        
        // Auto-resize columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    /**
     * Populate sheet dengan data income - EXACT COPY
     */
    private function populate_income_sheet($sheet, $incomeTransactions)
    {
        $row = 8;
        
        // Headers
        $headers = ['No', 'Tanggal', 'Proyek', 'Sumber', 'Kategori', 'Jumlah', 'Keterangan'];
        
        foreach ($headers as $col => $header) {
            $cellAddress = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row;
            $sheet->setCellValue($cellAddress, $header);
            $sheet->getStyle($cellAddress)->applyFromArray([
                'font' => ['bold' => true],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'DCFCE7']],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
            ]);
        }
        
        $row++;
        
        // Data
        $no = 1;
        $total = 0;
        
        foreach ($incomeTransactions as $income) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, date('d/m/Y', strtotime($income['tanggal'])));
            $sheet->setCellValue('C' . $row, $income['nama_proyek']);
            $sheet->setCellValue('D' . $row, $income['deskripsi']);
            $sheet->setCellValue('E' . $row, $income['kategori']);
            $sheet->setCellValue('F' . $row, $income['jumlah']);
            $sheet->setCellValue('G' . $row, $income['keterangan']);
            
            $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('F' . $row)->applyFromArray(['font' => ['color' => ['rgb' => '10B981']]]);
            
            $total += $income['jumlah'];
            $row++;
            $no++;
        }
        
        // Total row
        $sheet->setCellValue('E' . $row, 'TOTAL PEMASUKAN:');
        $sheet->setCellValue('F' . $row, $total);
        $sheet->getStyle('E' . $row . ':F' . $row)->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'DCFCE7']]
        ]);
        $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
        
        // Auto-resize columns
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    /**
     * Populate sheet dengan data expense dan breakdown - EXACT COPY
     */
    private function populate_expense_sheet($sheet, $expenseTransactions, $expenseBreakdown)
    {
        $row = 8;
        
        // Breakdown section jika ada
        if (!empty($expenseBreakdown)) {
            $sheet->setCellValue('A' . $row, 'BREAKDOWN PER KATEGORI');
            $sheet->getStyle('A' . $row)->applyFromArray([
                'font' => ['bold' => true, 'size' => 12],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'FEE2E2']]
            ]);
            $sheet->mergeCells('A' . $row . ':E' . $row);
            
            $row++;
            
            // Breakdown headers
            $breakdownHeaders = ['Kategori', 'Jumlah Transaksi', 'Total Amount', 'Rata-rata', 'Persentase'];
            foreach ($breakdownHeaders as $col => $header) {
                $cellAddress = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row;
                $sheet->setCellValue($cellAddress, $header);
                $sheet->getStyle($cellAddress)->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'FEE2E2']],
                    'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
                ]);
            }
            
            $row++;
            
            // Breakdown data
            foreach ($expenseBreakdown as $breakdown) {
                $sheet->setCellValue('A' . $row, $breakdown['kategori']);
                $sheet->setCellValue('B' . $row, $breakdown['count']);
                $sheet->setCellValue('C' . $row, $breakdown['total']);
                $sheet->setCellValue('D' . $row, $breakdown['avg_amount']);
                $sheet->setCellValue('E' . $row, $breakdown['percentage'] . '%');
                
                $sheet->getStyle('C' . $row . ':D' . $row)->getNumberFormat()->setFormatCode('#,##0');
                $row++;
            }
            
            $row += 2; // Spacing
        }
        
        // Detail transactions
        $sheet->setCellValue('A' . $row, 'DETAIL PENGELUARAN');
        $sheet->getStyle('A' . $row)->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'FEE2E2']]
        ]);
        $sheet->mergeCells('A' . $row . ':G' . $row);
        
        $row++;
        
        // Headers
        $headers = ['No', 'Tanggal', 'Proyek', 'Kategori', 'Deskripsi', 'Jumlah', 'Keterangan'];
        
        foreach ($headers as $col => $header) {
            $cellAddress = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row;
            $sheet->setCellValue($cellAddress, $header);
            $sheet->getStyle($cellAddress)->applyFromArray([
                'font' => ['bold' => true],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'FEE2E2']],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
            ]);
        }
        
        $row++;
        
        // Data
        $no = 1;
        $total = 0;
        
        foreach ($expenseTransactions as $expense) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, date('d/m/Y', strtotime($expense['tanggal'])));
            $sheet->setCellValue('C' . $row, $expense['nama_proyek']);
            $sheet->setCellValue('D' . $row, $expense['kategori']);
            $sheet->setCellValue('E' . $row, $expense['deskripsi']);
            $sheet->setCellValue('F' . $row, $expense['jumlah']);
            $sheet->setCellValue('G' . $row, $expense['keterangan']);
            
            $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('F' . $row)->applyFromArray(['font' => ['color' => ['rgb' => 'EF4444']]]);
            
            $total += $expense['jumlah'];
            $row++;
            $no++;
        }
        
        // Total row
        $sheet->setCellValue('E' . $row, 'TOTAL PENGELUARAN:');
        $sheet->setCellValue('F' . $row, $total);
        $sheet->getStyle('E' . $row . ':F' . $row)->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'FEE2E2']]
        ]);
        $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
        
        // Auto-resize columns
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    /**
     * Populate sheet dengan data profit loss - EXACT COPY
     */
    private function populate_profit_loss_sheet($sheet, $profitLossData)
    {
        $row = 8;
        
        // Headers
        $headers = ['No', 'Nama Proyek', 'Anggaran', 'Pemasukan', 'Pengeluaran', 'Laba/Rugi', 'Margin %', 'Status'];
        
        foreach ($headers as $col => $header) {
            $cellAddress = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row;
            $sheet->setCellValue($cellAddress, $header);
            $sheet->getStyle($cellAddress)->applyFromArray([
                'font' => ['bold' => true],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'E0E7FF']],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
            ]);
        }
        
        $row++;
        
        // Data
        $no = 1;
        $totalIncome = 0;
        $totalExpense = 0;
        
        foreach ($profitLossData as $project) {
            $netProfit = $project['total_income'] - $project['total_expense'];
            $margin = $project['total_income'] > 0 ? ($netProfit / $project['total_income']) * 100 : 0;
            $status = $netProfit >= 0 ? 'PROFIT' : 'LOSS';
            
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $project['nama_proyek']);
            $sheet->setCellValue('C' . $row, $project['anggaran']);
            $sheet->setCellValue('D' . $row, $project['total_income']);
            $sheet->setCellValue('E' . $row, $project['total_expense']);
            $sheet->setCellValue('F' . $row, $netProfit);
            $sheet->setCellValue('G' . $row, number_format($margin, 2) . '%');
            $sheet->setCellValue('H' . $row, $status);
            
            // Format currency
            $sheet->getStyle('C' . $row . ':F' . $row)->getNumberFormat()->setFormatCode('#,##0');
            
            // Color coding
            if ($netProfit >= 0) {
                $sheet->getStyle('F' . $row . ':H' . $row)->applyFromArray(['font' => ['color' => ['rgb' => '10B981']]]);
            } else {
                $sheet->getStyle('F' . $row . ':H' . $row)->applyFromArray(['font' => ['color' => ['rgb' => 'EF4444']]]);
            }
            
            $totalIncome += $project['total_income'];
            $totalExpense += $project['total_expense'];
            
            $row++;
            $no++;
        }
        
        // Total row
        $totalNetProfit = $totalIncome - $totalExpense;
        $totalMargin = $totalIncome > 0 ? ($totalNetProfit / $totalIncome) * 100 : 0;
        $totalStatus = $totalNetProfit >= 0 ? 'PROFIT' : 'LOSS';
        
        $sheet->setCellValue('B' . $row, 'TOTAL');
        $sheet->setCellValue('D' . $row, $totalIncome);
        $sheet->setCellValue('E' . $row, $totalExpense);
        $sheet->setCellValue('F' . $row, $totalNetProfit);
        $sheet->setCellValue('G' . $row, number_format($totalMargin, 2) . '%');
        $sheet->setCellValue('H' . $row, $totalStatus);
        
        $sheet->getStyle('B' . $row . ':H' . $row)->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'E0E7FF']]
        ]);
        $sheet->getStyle('D' . $row . ':F' . $row)->getNumberFormat()->setFormatCode('#,##0');
        
        // Auto-resize columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }

    // ==================== PDF EXPORT METHODS ====================

    /**
     * PDF export yang bekerja dengan TCPDF yang sudah terinstall
     */
    private function export_to_working_pdf($data, $export_type)
    {
        try {
            // Cek apakah TCPDF atau mPDF available
            if (class_exists('\Mpdf\Mpdf')) {
                $this->generate_pdf_with_mpdf($data, $export_type);
            } elseif (class_exists('TCPDF')) {
                $this->generate_pdf_with_tcpdf($data, $export_type);
            } else {
                // Fallback ke HTML jika library PDF tidak ada
                $this->export_to_html_fallback($data, $export_type);
            }
        } catch (Exception $e) {
            log_message('error', 'PDF export error: ' . $e->getMessage());
            $this->export_to_html_fallback($data, $export_type);
        }
    }

    /**
     * Generate PDF dengan mPDF
     */
    private function generate_pdf_with_mpdf($data, $export_type)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16
        ]);
        
        $mpdf->SetTitle($data['title']);
        $mpdf->SetAuthor('PT. GASNI ADITAMA KONSTRUKSI');
        
        $html = $this->build_pdf_html($data, $export_type);
        $mpdf->WriteHTML($html);
        
        $filename = 'Laporan_Keuangan_' . date('Y-m-d_H-i-s') . '.pdf';
        $mpdf->Output($filename, 'D');
    }

    /**
     * Generate PDF dengan TCPDF
     */
    private function generate_pdf_with_tcpdf($data, $export_type)
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        $pdf->SetCreator('PT. GASNI ADITAMA KONSTRUKSI');
        $pdf->SetTitle($data['title']);
        $pdf->SetMargins(15, 27, 15);
        $pdf->SetAutoPageBreak(TRUE, 25);
        
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 10);
        
        $html = $this->build_pdf_html($data, $export_type);
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $filename = 'Laporan_Keuangan_' . date('Y-m-d_H-i-s') . '.pdf';
        $pdf->Output($filename, 'D');
    }

    /**
     * Build HTML untuk PDF - EXACT COPY
     */
    private function build_pdf_html($data, $export_type)
    {
        $html = '<style>
            body { font-family: Arial, sans-serif; font-size: 10px; }
            .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
            .company { font-size: 16px; font-weight: bold; margin-bottom: 5px; }
            .title { font-size: 14px; font-weight: bold; color: #666; }
            .summary { background: #f8f9fa; padding: 10px; margin: 15px 0; }
            table { width: 100%; border-collapse: collapse; margin: 10px 0; }
            th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
            th { background: #f2f2f2; font-weight: bold; }
            .income { color: #28a745; }
            .expense { color: #dc3545; }
            .text-right { text-align: right; }
        </style>';
        
        $html .= '<div class="header">
            <div class="company">PT. GASNI ADITAMA KONSTRUKSI</div>
            <div class="title">' . strtoupper($data['title']) . '</div>
            <p>Generated: ' . $data['generated_at'] . ' by ' . $data['generated_by'] . '</p>
        </div>';
        
        $html .= '<div class="summary">
            <h3>RINGKASAN KEUANGAN</h3>
            <table>
                <tr><td>Total Pemasukan:</td><td class="income text-right">Rp ' . number_format($data['summary']['total_income'], 0, ',', '.') . '</td></tr>
                <tr><td>Total Pengeluaran:</td><td class="expense text-right">Rp ' . number_format($data['summary']['total_expenses'], 0, ',', '.') . '</td></tr>
                <tr><td><strong>Saldo Bersih:</strong></td><td class="text-right"><strong>Rp ' . number_format($data['summary']['net_profit'], 0, ',', '.') . '</strong></td></tr>
            </table>
        </div>';
        
        if (!empty($data['transactions'])) {
            $html .= '<h3>DETAIL TRANSAKSI</h3>
            <table>
                <tr><th>Tanggal</th><th>Proyek</th><th>Tipe</th><th>Kategori</th><th>Deskripsi</th><th>Jumlah</th></tr>';
            
            foreach ($data['transactions'] as $transaction) {
                $typeClass = $transaction['transaction_type'] == 'income' ? 'income' : 'expense';
                $html .= '<tr>
                    <td>' . date('d/m/Y', strtotime($transaction['tanggal'])) . '</td>
                    <td>' . htmlspecialchars($transaction['nama_proyek']) . '</td>
                    <td class="' . $typeClass . '">' . ($transaction['transaction_type'] == 'income' ? 'Pemasukan' : 'Pengeluaran') . '</td>
                    <td>' . htmlspecialchars($transaction['kategori']) . '</td>
                    <td>' . htmlspecialchars($transaction['deskripsi']) . '</td>
                    <td class="' . $typeClass . ' text-right">Rp ' . number_format($transaction['jumlah'], 0, ',', '.') . '</td>
                </tr>';
            }
            
            $html .= '</table>';
        }
        
        return $html;
    }

    // ==================== FALLBACK METHODS ====================

    /**
     * Fallback ke CSV jika Excel library tidak ada
     */
    private function export_to_csv_fallback($data, $export_type)
    {
        $filename = 'Laporan_Keuangan_' . date('Y-m-d_H-i-s') . '.csv';
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
        
        // Header
        fputcsv($output, ['PT. GASNI ADITAMA KONSTRUKSI']);
        fputcsv($output, [strtoupper($data['title'])]);
        fputcsv($output, []);
        fputcsv($output, ['Generated:', $data['generated_at']]);
        fputcsv($output, ['By:', $data['generated_by']]);
        fputcsv($output, []);
        
        // Summary
        fputcsv($output, ['RINGKASAN KEUANGAN']);
        fputcsv($output, ['Total Pemasukan', 'Rp ' . number_format($data['summary']['total_income'], 0, ',', '.')]);
        fputcsv($output, ['Total Pengeluaran', 'Rp ' . number_format($data['summary']['total_expenses'], 0, ',', '.')]);
        fputcsv($output, ['Saldo Bersih', 'Rp ' . number_format($data['summary']['net_profit'], 0, ',', '.')]);
        fputcsv($output, []);
        
        // Data headers
        fputcsv($output, ['Tanggal', 'Proyek', 'Tipe', 'Kategori', 'Deskripsi', 'Jumlah', 'Keterangan']);
        
        // Data
        if (!empty($data['transactions'])) {
            foreach ($data['transactions'] as $transaction) {
                fputcsv($output, [
                    date('d/m/Y', strtotime($transaction['tanggal'])),
                    $transaction['nama_proyek'],
                    $transaction['transaction_type'] == 'income' ? 'Pemasukan' : 'Pengeluaran',
                    $transaction['kategori'],
                    $transaction['deskripsi'],
                    'Rp ' . number_format($transaction['jumlah'], 0, ',', '.'),
                    $transaction['keterangan']
                ]);
            }
        }
        
        fclose($output);
    }

    /**
     * Fallback ke HTML jika PDF library tidak ada
     */
    private function export_to_html_fallback($data, $export_type)
    {
        $filename = 'Laporan_Keuangan_' . date('Y-m-d_H-i-s') . '.html';
        
        header('Content-Type: text/html; charset=utf-8');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        
        echo $this->build_pdf_html($data, $export_type);
    }
}