<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Export Keuangan Controller untuk Kixera Shoes
 * Enhanced Version dengan Template Design
 */
class Export_keuangan extends CI_Controller {

    // Color Palette
    private $colors = [
        'brand_green' => '30CC95',      // Hijau Utama
        'dark_green' => '0F766E',       // Hijau Tua
        'white' => 'FDFDFD',            // Background Utama
        'light_gray' => 'DADEDE',       // Background Card
        'pastel_green' => '9CC1B8',     // Hijau Pastel
        'red_accent' => '843C39',       // Merah Aksen
        'black' => '000000',            // Teks Gelap
        'success' => '10B981',          // Success (Pemasukan)
        'danger' => 'EF4444'            // Danger (Pengeluaran)
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Export_keuangan_model', 'keuangan_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        
    }

    public function index()
    {
        echo "Export Keuangan Controller - Pemilik<br>";
        echo "Available endpoints:<br>";
        echo "1. /pemilik/export_keuangan/export/excel<br>";
        echo "2. /pemilik/export_keuangan/export/csv<br>";
        echo "3. /pemilik/export_keuangan/export/pdf<br>";
    }

    public function test()
    {
        echo "<h1>Export Keuangan Test</h1>";
        echo "<p>Controller berjalan dengan baik!</p>";
        echo '<a href="' . site_url('pemilik/export_keuangan/export/excel?export_type=all&id_cabang=1&date_start=2025-01-01&date_end=2025-12-31') . '">Test Excel Export</a><br>';
    }

    public function export($format = 'excel')
    {
        try {
            if (!in_array($format, ['excel', 'csv', 'pdf'])) {
                show_error('Format export tidak valid.');
            }
            
            $filters = $this->get_export_filters();
            $export_type = $this->get_export_type();
            
            if (empty($filters) && $export_type == 'all') {
                $filters = [
                    'date_start' => date('Y-m-01'),
                    'date_end' => date('Y-m-t')
                ];
            }
            
            $data = $this->prepare_export_data($filters, $export_type);
            
            switch($format) {
                case 'excel':
                    $this->export_to_excel($data, $export_type);
                    break;
                case 'csv':
                    $this->export_to_csv($data, $export_type);
                    break;
                case 'pdf':
                    $this->export_to_pdf($data, $export_type);
                    break;
            }
            
        } catch (Exception $e) {
            log_message('error', 'Export error: ' . $e->getMessage());
            show_error('Gagal mengexport data: ' . $e->getMessage());
        }
    }

    private function get_export_filters()
    {
        $filters = array();
        $sources = [$_POST, $_GET];
        
        foreach ($sources as $source) {
            if (!empty($source['search'])) $filters['search'] = trim($source['search']);
            if (!empty($source['id_cabang'])) $filters['id_cabang'] = $source['id_cabang'];
            if (!empty($source['kategori'])) $filters['kategori'] = $source['kategori'];
            if (!empty($source['transaction_type'])) $filters['transaction_type'] = $source['transaction_type'];
            if (!empty($source['date_start'])) $filters['date_start'] = $source['date_start'];
            if (!empty($source['date_end'])) $filters['date_end'] = $source['date_end'];
            
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

    private function prepare_export_data($filters, $export_type)
    {
        $data = array(
            'filters' => $filters,
            'export_type' => $export_type,
            'generated_at' => date('d/m/Y H:i:s'),
            'generated_by' => $this->session->userdata('nama_lengkap') ?? 'System',
            'period_info' => $this->get_period_info($filters),
            'company_info' => $this->get_company_info()
        );

        $cabang_id = !empty($filters['id_cabang']) ? $filters['id_cabang'] : null;
        $data['summary'] = $this->keuangan_model->get_financial_summary($cabang_id);

        if (empty($data['summary'])) {
            $data['summary'] = [
                'total_income' => 0,
                'total_expenses' => 0,
                'net_profit' => 0
            ];
        }

        switch ($export_type) {
            case 'income_only':
                $data['transactions'] = $this->keuangan_model->get_filtered_transactions_by_type($filters, 'income');
                $data['title'] = 'Laporan Pemasukan';
                break;
                
            case 'expense_only':
                $data['transactions'] = $this->keuangan_model->get_filtered_transactions_by_type($filters, 'expense');
                $data['expense_breakdown'] = $this->keuangan_model->get_expense_breakdown(12, $cabang_id);
                $data['title'] = 'Laporan Pengeluaran';
                break;
                
            case 'profit_loss':
                $data['profit_loss'] = $this->keuangan_model->get_monthly_profit_loss($filters);
                $data['title'] = 'Laporan Laba Rugi Per Cabang';
                break;
                
            case 'cabang_summary':
                $data['cabang_summary'] = $this->keuangan_model->get_saldo_per_cabang($cabang_id);
                $data['title'] = 'Laporan Saldo Per Cabang';
                break;
                
            default:
                $data['transactions'] = $this->keuangan_model->get_filtered_transactions($filters);
                $data['income_transactions'] = $this->keuangan_model->get_filtered_transactions_by_type($filters, 'income');
                $data['expense_transactions'] = $this->keuangan_model->get_filtered_transactions_by_type($filters, 'expense');
                $data['expense_breakdown'] = $this->keuangan_model->get_expense_breakdown(12, $cabang_id);
                $data['cabang_summary'] = $this->keuangan_model->get_saldo_per_cabang($cabang_id);
                $data['title'] = 'Laporan Keuangan Lengkap';
                break;
        }

        return $data;
    }

    private function get_company_info()
    {
        $pemilik_id = $this->session->userdata('pemilik_id');
        
        if ($pemilik_id) {
            $pemilik = $this->keuangan_model->get_pemilik_by_id($pemilik_id);
            if ($pemilik) {
                return [
                    'nama_perusahaan' => $pemilik['nama_usaha'] ?? 'Kixera Shoes',
                    'alamat' => $pemilik['alamat_usaha'] ?? 'Jl. Mawar No.1',
                    'telepon' => $pemilik['no_telp'] ?? '08123456780',
                    'nama_pemilik' => $pemilik['nama'] ?? 'Owner'
                ];
            }
        }
        
        return [
            'nama_perusahaan' => 'Kixera Shoes',
            'alamat' => 'Jl. Mawar No.1',
            'telepon' => '08123456780',
            'nama_pemilik' => 'Owner'
        ];
    }

    private function get_period_info($filters)
    {
        if (!empty($filters['date_start']) && !empty($filters['date_end'])) {
            return date('d M Y', strtotime($filters['date_start'])) . ' - ' . date('d M Y', strtotime($filters['date_end']));
        }
        return 'Semua Periode';
    }

    private function generate_filename($title, $extension)
    {
        $date = date('Ymd_His');
        $cleanTitle = preg_replace('/[^a-zA-Z0-9_-]/', '_', $title);
        return $cleanTitle . '_' . $date . '.' . $extension;
    }

    // ==================== EXCEL EXPORT WITH ENHANCED DESIGN ====================

    private function export_to_excel($data, $export_type)
    {
        try {
            if (!class_exists('\PhpOffice\PhpSpreadsheet\Spreadsheet')) {
                $this->export_to_csv($data, $export_type);
                return;
            }
            
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            
            $spreadsheet->getProperties()
                ->setCreator($data['company_info']['nama_perusahaan'])
                ->setTitle($data['title'])
                ->setDescription('Laporan Keuangan - ' . $data['company_info']['nama_perusahaan']);
            
            switch ($export_type) {
                case 'all':
                    $this->create_complete_workbook($spreadsheet, $data);
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
                case 'cabang_summary':
                    $this->create_cabang_summary_sheet($spreadsheet, $data);
                    break;
            }
            
            $filename = $this->generate_filename($data['title'], 'xlsx');
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
            
        } catch (Exception $e) {
            log_message('error', 'Excel export error: ' . $e->getMessage());
            $this->export_to_csv($data, $export_type);
        }
    }

    private function create_complete_workbook($spreadsheet, $data)
    {
        // Sheet 1: Dashboard/Summary
        $this->create_dashboard_sheet($spreadsheet, $data);
        
        // Sheet 2: Semua Transaksi
        if (!empty($data['transactions'])) {
            $sheet = $spreadsheet->createSheet(1);
            $sheet->setTitle('Semua Transaksi');
            $this->populate_transactions_sheet($sheet, $data['transactions'], 'all', $data);
        }
        
        // Sheet 3: Pemasukan
        if (!empty($data['income_transactions'])) {
            $sheet = $spreadsheet->createSheet(2);
            $sheet->setTitle('Pemasukan');
            $this->populate_transactions_sheet($sheet, $data['income_transactions'], 'income', $data);
        }
        
        // Sheet 4: Pengeluaran
        if (!empty($data['expense_transactions'])) {
            $sheet = $spreadsheet->createSheet(3);
            $sheet->setTitle('Pengeluaran');
            $this->populate_transactions_sheet($sheet, $data['expense_transactions'], 'expense', $data);
        }
        
        // Sheet 5: Analisis Pengeluaran
        if (!empty($data['expense_breakdown'])) {
            $sheet = $spreadsheet->createSheet(4);
            $sheet->setTitle('Analisis Pengeluaran');
            $this->populate_expense_breakdown_sheet($sheet, $data['expense_breakdown'], $data);
        }
        
        $spreadsheet->setActiveSheetIndex(0);
    }

    private function create_dashboard_sheet($spreadsheet, $data)
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Dashboard');
        
        $row = 1;
        
        // ===== HEADER SECTION =====
        // Logo/Brand Area dengan background hijau utama
        $sheet->mergeCells('A1:H2');
        $sheet->setCellValue('A1', strtoupper($data['company_info']['nama_perusahaan']));
        $sheet->getStyle('A1:H2')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 20,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['brand_green']]
            ]
        ]);
        $sheet->getRowDimension('1')->setRowHeight(30);
        $sheet->getRowDimension('2')->setRowHeight(20);
        
        $row = 4;
        
        // Subtitle dengan background hijau tua
        $sheet->mergeCells('A4:H4');
        $sheet->setCellValue('A4', $data['title']);
        $sheet->getStyle('A4')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['dark_green']]
            ]
        ]);
        $sheet->getRowDimension('4')->setRowHeight(25);
        
        $row = 6;
        
        // ===== INFO SECTION dengan border hijau pastel =====
        $sheet->setCellValue('A6', 'Informasi Laporan');
        $sheet->getStyle('A6:D6')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['pastel_green']]
            ]
        ]);
        $sheet->mergeCells('A6:D6');
        
        $infoData = [
            ['Tanggal Cetak', $data['generated_at']],
            ['Dicetak Oleh', $data['generated_by']],
            ['Periode', $data['period_info']],
            ['Alamat', $data['company_info']['alamat']],
            ['Telepon', $data['company_info']['telepon']]
        ];
        
        $row = 7;
        foreach ($infoData as $info) {
            $sheet->setCellValue('A' . $row, $info[0]);
            $sheet->setCellValue('B' . $row, $info[1]);
            $sheet->getStyle('A' . $row)->getFont()->setBold(true);
            $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => $this->colors['light_gray']]
                    ]
                ]
            ]);
            $row++;
        }
        
        $row += 2;
        
        // ===== RINGKASAN KEUANGAN =====
        $sheet->setCellValue('A' . $row, 'RINGKASAN KEUANGAN');
        $sheet->mergeCells('A' . $row . ':H' . $row);
        $sheet->getStyle('A' . $row)->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['dark_green']]
            ]
        ]);
        $sheet->getRowDimension($row)->setRowHeight(30);
        
        $row++;
        
        // Card-style summary boxes
        $summaryBoxes = [
            [
                'label' => 'TOTAL PEMASUKAN',
                'value' => $data['summary']['total_income'],
                'color' => $this->colors['brand_green'],
                'icon' => '↗'
            ],
            [
                'label' => 'TOTAL PENGELUARAN',
                'value' => $data['summary']['total_expenses'],
                'color' => $this->colors['red_accent'],
                'icon' => '↘'
            ],
            [
                'label' => 'SALDO BERSIH',
                'value' => $data['summary']['net_profit'],
                'color' => $data['summary']['net_profit'] >= 0 ? $this->colors['brand_green'] : $this->colors['red_accent'],
                'icon' => $data['summary']['net_profit'] >= 0 ? '✓' : '✗'
            ]
        ];
        
        $col = 1; // Column A
        foreach ($summaryBoxes as $box) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
            $endCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1);
            
            // Header box
            $sheet->mergeCells($colLetter . $row . ':' . $endCol . $row);
            $sheet->setCellValue($colLetter . $row, $box['icon'] . ' ' . $box['label']);
            $sheet->getStyle($colLetter . $row . ':' . $endCol . $row)->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 10,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $box['color']]
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                        'color' => ['rgb' => $box['color']]
                    ]
                ]
            ]);
            
            // Value box
            $sheet->mergeCells($colLetter . ($row + 1) . ':' . $endCol . ($row + 1));
            $sheet->setCellValue($colLetter . ($row + 1), 'Rp ' . number_format($box['value'], 0, ',', '.'));
            $sheet->getStyle($colLetter . ($row + 1) . ':' . $endCol . ($row + 1))->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 14,
                    'color' => ['rgb' => $box['color']]
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $this->colors['white']]
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                        'color' => ['rgb' => $box['color']]
                    ]
                ]
            ]);
            $sheet->getRowDimension($row + 1)->setRowHeight(35);
            
            $col += 3; // Skip 3 columns for spacing
        }
        
        $row += 3;
        
        // Margin & Performance Metrics
        $margin = $data['summary']['total_income'] > 0 ? 
                 ($data['summary']['net_profit'] / $data['summary']['total_income']) * 100 : 0;
        
        $sheet->setCellValue('A' . $row, 'Margin Keuntungan');
        $sheet->setCellValue('B' . $row, number_format($margin, 2) . '%');
        $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray([
            'font' => ['bold' => true, 'size' => 11],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['pastel_green']]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => $this->colors['dark_green']]
                ]
            ]
        ]);
        
        // Auto-size columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Add footer note
        $row += 4;
        $sheet->mergeCells('A' . $row . ':H' . $row);
        $sheet->setCellValue('A' . $row, '📊 Laporan ini dibuat secara otomatis oleh Sistem Keuangan ' . $data['company_info']['nama_perusahaan']);
        $sheet->getStyle('A' . $row)->applyFromArray([
            'font' => ['italic' => true, 'size' => 9, 'color' => ['rgb' => '666666']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
        ]);
    }
private function populate_transactions_sheet($sheet, $transactions, $type, $data)
{
    $row = 1;
    // Header with company branding
    $sheet->mergeCells('A1:H2');
    $sheet->setCellValue('A1', strtoupper($data['company_info']['nama_perusahaan']));
    $sheet->getStyle('A1:H2')->applyFromArray([
        'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => 'FFFFFF']],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => $this->colors['brand_green']]
        ]
    ]);
    $sheet->getRowDimension('1')->setRowHeight(25);
    $row = 3;
    // Title
    $title = $type == 'income' ? 'LAPORAN PEMASUKAN' : ($type == 'expense' ? 'LAPORAN PENGELUARAN' : 'SEMUA TRANSAKSI');
    $sheet->mergeCells('A3:H3');
    $sheet->setCellValue('A3', $title);
    $sheet->getStyle('A3')->applyFromArray([
        'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => $this->colors['dark_green']]
        ]
    ]);
    $row = 5;
    // Info
    $sheet->setCellValue('A5', 'Periode: ' . $data['period_info']);
    $sheet->setCellValue('E5', 'Dicetak: ' . $data['generated_at']);
    $row = 7;
    // Table Headers
    $headers = ['No', 'Tanggal', 'Cabang', 'Tipe', 'Kategori', 'Nama Transaksi', 'Jumlah (Rp)', 'Keterangan'];
    foreach ($headers as $col => $header) {
        $cellAddr = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row;
        $sheet->setCellValue($cellAddr, $header);
    }
    $headerColor = $type == 'income' ? $this->colors['brand_green'] : 
                  ($type == 'expense' ? $this->colors['red_accent'] : $this->colors['dark_green']);
    $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray([
        'font' => ['bold' => true, 'size' => 10, 'color' => ['rgb' => 'FFFFFF']],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => $headerColor]
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => 'FFFFFF']
            ]
        ]
    ]);
    $sheet->getRowDimension($row)->setRowHeight(25);
    $row++;
    
    // Data rows
    $no = 1;
    $totalIncome = 0;
    $totalExpense = 0;
    
    foreach ($transactions as $trans) {
        $isIncome = isset($trans['transaction_type']) && $trans['transaction_type'] == 'pemasukan';
        $amount = $trans['jumlah'];
        
        $sheet->setCellValue('A' . $row, $no);
        $sheet->setCellValue('B' . $row, date('d/m/Y', strtotime($trans['tanggal'])));
        $sheet->setCellValue('C' . $row, $trans['nama_cabang'] ?? '-');
        $sheet->setCellValue('D' . $row, $trans['tipe_display'] ?? ($isIncome ? 'Pemasukan' : 'Pengeluaran'));
        $sheet->setCellValue('E' . $row, $trans['kategori'] ?? '-');
        $sheet->setCellValue('F' . $row, $trans['deskripsi'] ?? $trans['nama_transaksi'] ?? '-');
        
        // Format amount with sign indicator
        $formattedAmount = $isIncome ? $amount : -$amount;
        $sheet->setCellValue('G' . $row, $formattedAmount);
        
        $sheet->setCellValue('H' . $row, $trans['keterangan'] ?? '-');
        
        // Format currency with accounting format (negative in parentheses)
        $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('_-[$Rp]* #,##0_ ;_-[$Rp]* \(#,##0\);_-[$Rp]* "-"_ ;_-@_ ');
        
        // Alternating row colors
        $bgColor = ($no % 2 == 0) ? $this->colors['white'] : 'F9FAFB';
        $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $bgColor]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => $this->colors['light_gray']]
                ]
            ]
        ]);
        
        // Warna font berdasarkan tipe transaksi
        $amountColor = $isIncome ? $this->colors['success'] : $this->colors['danger'];
        $sheet->getStyle('G' . $row)->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color($amountColor));
        
        // Accumulate totals
        if ($isIncome) {
            $totalIncome += $amount;
        } else {
            $totalExpense += $amount;
        }
        
        $no++;
        $row++;
    }
    
    // ===== FOOTER: SUBTOTALS & NET TOTAL =====
    $startFooterRow = $row;
    
    // Subtotal Pemasukan
    $sheet->mergeCells('A' . $row . ':F' . $row);
    $sheet->setCellValue('A' . $row, 'TOTAL PEMASUKAN');
    $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
        'font' => ['bold' => true, 'size' => 11],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => $this->colors['light_gray']]
        ],
        'borders' => [
            'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
        ]
    ]);
    $sheet->setCellValue('G' . $row, $totalIncome);
    $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('_-[$Rp]* #,##0_ ;_-[$Rp]* \(#,##0\);_-[$Rp]* "-"_ ;_-@_ ');
    $sheet->getStyle('G' . $row)->applyFromArray([
        'font' => ['bold' => true, 'color' => ['rgb' => $this->colors['success']]],
        'borders' => [
            'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
        ]
    ]);
    $sheet->mergeCells('H' . $row . ':H' . $row);
    $sheet->getStyle('H' . $row)->applyFromArray([
        'borders' => [
            'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
        ]
    ]);
    $row++;
    
    // Subtotal Pengeluaran
    $sheet->mergeCells('A' . $row . ':F' . $row);
    $sheet->setCellValue('A' . $row, 'TOTAL PENGELUARAN');
    $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
        'font' => ['bold' => true, 'size' => 11],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => $this->colors['light_gray']]
        ],
        'borders' => [
            'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
        ]
    ]);
    $sheet->setCellValue('G' . $row, -$totalExpense); // Negative value for expenses
    $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('_-[$Rp]* #,##0_ ;_-[$Rp]* \(#,##0\);_-[$Rp]* "-"_ ;_-@_ ');
    $sheet->getStyle('G' . $row)->applyFromArray([
        'font' => ['bold' => true, 'color' => ['rgb' => $this->colors['danger']]],
        'borders' => [
            'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
        ]
    ]);
    $sheet->mergeCells('H' . $row . ':H' . $row);
    $sheet->getStyle('H' . $row)->applyFromArray([
        'borders' => [
            'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
        ]
    ]);
    $row++;
    
    // Net Total (Saldo Bersih)
    $netTotal = $totalIncome - $totalExpense;
    
    $sheet->mergeCells('A' . $row . ':F' . $row);
    $sheet->setCellValue('A' . $row, 'SALDO BERSIH');
    $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
        'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => $netTotal >= 0 ? $this->colors['brand_green'] : $this->colors['red_accent']]
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => 'FFFFFF']
            ]
        ]
    ]);
    
    $sheet->setCellValue('G' . $row, $netTotal);
    $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('_-[$Rp]* #,##0_ ;_-[$Rp]* \(#,##0\);_-[$Rp]* "-"_ ;_-@_ ');
    $sheet->getStyle('G' . $row)->applyFromArray([
        'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => $netTotal >= 0 ? $this->colors['white'] : $this->colors['white']]],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => $netTotal >= 0 ? $this->colors['brand_green'] : $this->colors['red_accent']]
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => 'FFFFFF']
            ]
        ]
    ]);
    
    $sheet->mergeCells('H' . $row . ':H' . $row);
    $sheet->getStyle('H' . $row)->applyFromArray([
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => $netTotal >= 0 ? $this->colors['brand_green'] : $this->colors['red_accent']]
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => 'FFFFFF']
            ]
        ]
    ]);
    
    // Auto-size columns
    foreach (range('A', 'H') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    
    // Add note for net total
    $row += 2;
    $sheet->mergeCells('A' . $row . ':H' . $row);
    $sheet->setCellValue('A' . $row, '💡 Saldo Bersih = Total Pemasukan - Total Pengeluaran');
    $sheet->getStyle('A' . $row)->applyFromArray([
        'font' => ['italic' => true, 'size' => 9],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => $this->colors['pastel_green']]
        ]
    ]);
}

    private function populate_expense_breakdown_sheet($sheet, $expense_breakdown, $data)
    {
        $row = 1;
        
        // Header
        $sheet->mergeCells('A1:E2');
        $sheet->setCellValue('A1', strtoupper($data['company_info']['nama_perusahaan']));
        $sheet->getStyle('A1:E2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['brand_green']]
            ]
        ]);
        
        $row = 3;
        $sheet->mergeCells('A3:E3');
        $sheet->setCellValue('A3', 'ANALISIS PENGELUARAN');
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['dark_green']]
            ]
        ]);
        
        $row = 5;
        $sheet->setCellValue('A5', 'Periode: ' . $data['period_info']);
        
        $row = 7;
        
        // Table Headers
        $headers = ['No', 'Kategori', 'Jumlah Transaksi', 'Total (Rp)', 'Persentase (%)'];
        foreach ($headers as $col => $header) {
            $cellAddr = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1) . $row;
            $sheet->setCellValue($cellAddr, $header);
        }
        
        $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray([
            'font' => ['bold' => true, 'size' => 10, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['red_accent']]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF']
                ]
            ]
        ]);
        
        $row++;
        
        // Data rows
        $no = 1;
        $totalPercentage = 0;
        $totalAmount = 0;
        
        foreach ($expense_breakdown as $item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item['kategori'] ?? '-');
            $sheet->setCellValue('C' . $row, $item['count'] ?? 0);
            $sheet->setCellValue('D' . $row, $item['total'] ?? 0);
            $sheet->setCellValue('E' . $row, ($item['percentage'] ?? 0) . '%');
            
            // Format currency
            $sheet->getStyle('D' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode('0.00');
            
            // Alternating row colors
            $bgColor = ($no % 2 == 0) ? $this->colors['white'] : 'F9FAFB';
            $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray([
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $bgColor]
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => $this->colors['light_gray']]
                    ]
                ]
            ]);
            
            $totalPercentage += $item['percentage'] ?? 0;
            $totalAmount += $item['total'] ?? 0;
            $no++;
            $row++;
        }
        
        // Footer: Total
        $sheet->mergeCells('A' . $row . ':C' . $row);
        $sheet->setCellValue('A' . $row, 'TOTAL SEMUA KATEGORI');
        $sheet->getStyle('A' . $row . ':C' . $row)->applyFromArray([
            'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['red_accent']]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF']
                ]
            ]
        ]);
        
        $sheet->setCellValue('D' . $row, 'Rp ' . number_format($totalAmount, 0, ',', '.'));
        $sheet->getStyle('D' . $row)->applyFromArray([
            'font' => ['bold' => true, 'size' => 11],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFFFF']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => $this->colors['red_accent']]
                ]
            ]
        ]);
        
        $sheet->setCellValue('E' . $row, number_format($totalPercentage, 2) . '%');
        $sheet->getStyle('E' . $row)->applyFromArray([
            'font' => ['bold' => true, 'size' => 11],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFFFF']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => $this->colors['red_accent']]
                ]
            ]
        ]);
        
        // Auto-size columns
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Add chart note
        $row += 3;
        $sheet->mergeCells('A' . $row . ':E' . $row);
        $sheet->setCellValue('A' . $row, '📈 Data ini dapat divisualisasikan dalam bentuk pie chart untuk analisis lebih lanjut');
        $sheet->getStyle('A' . $row)->applyFromArray([
            'font' => ['italic' => true, 'size' => 9, 'color' => ['rgb' => '666666']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
        ]);
    }

    // ==================== CSV EXPORT ====================
    private function export_to_csv($data, $export_type)
    {
        $filename = $this->generate_filename($data['title'], 'csv');
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fputs($output, "\xEF\xBB\xBF"); // UTF-8 BOM
        
        // Write header info
        fputcsv($output, [$data['company_info']['nama_perusahaan']]);
        fputcsv($output, [$data['title']]);
        fputcsv($output, ['Periode:', $data['period_info']]);
        fputcsv($output, ['Dicetak:', $data['generated_at']]);
        fputcsv($output, []); // Empty line
        
        switch ($export_type) {
            case 'all':
                $this->write_transactions_to_csv($output, $data['transactions'], 'Semua Transaksi');
                break;
            case 'income_only':
                $this->write_transactions_to_csv($output, $data['transactions'], 'Pemasukan');
                break;
            case 'expense_only':
                $this->write_transactions_to_csv($output, $data['transactions'], 'Pengeluaran');
                break;
            case 'profit_loss':
                $this->write_profit_loss_to_csv($output, $data);
                break;
            case 'cabang_summary':
                $this->write_cabang_summary_to_csv($output, $data);
                break;
        }
        
        fclose($output);
        exit;
    }

    private function write_transactions_to_csv($handle, $transactions, $title)
    {
        fputcsv($handle, ['=== ' . $title . ' ===']);
        fputcsv($handle, ['No', 'Tanggal', 'Cabang', 'Tipe', 'Kategori', 'Deskripsi', 'Jumlah (Rp)', 'Keterangan']);
        
        $no = 1;
        $total = 0;
        
        foreach ($transactions as $trans) {
            fputcsv($handle, [
                $no++,
                date('d/m/Y', strtotime($trans['tanggal'])),
                $trans['nama_cabang'] ?? '-',
                $trans['tipe_display'] ?? '-',
                $trans['kategori'] ?? '-',
                $trans['deskripsi'] ?? '-',
                number_format($trans['jumlah'], 0, ',', '.'),
                $trans['keterangan'] ?? '-'
            ]);
            $total += $trans['jumlah'];
        }
        
        fputcsv($handle, []); // Empty line
        fputcsv($handle, ['TOTAL', '', '', '', '', '', number_format($total, 0, ',', '.'), '']);
    }

    private function write_profit_loss_to_csv($handle, $data)
    {
        fputcsv($handle, ['=== Laporan Laba Rugi Per Cabang ===']);
        fputcsv($handle, ['No', 'Cabang', 'Pemasukan (Rp)', 'Pengeluaran (Rp)', 'Laba/Rugi (Rp)']);
        
        $no = 1;
        foreach ($data['profit_loss'] as $item) {
            fputcsv($handle, [
                $no++,
                $item['nama_cabang'] ?? '-',
                number_format($item['total_income'], 0, ',', '.'),
                number_format($item['total_expense'], 0, ',', '.'),
                number_format($item['net_profit'], 0, ',', '.')
            ]);
        }
    }

    private function write_cabang_summary_to_csv($handle, $data)
    {
        fputcsv($handle, ['=== Laporan Saldo Per Cabang ===']);
        fputcsv($handle, ['No', 'Cabang', 'Total Pemasukan', 'Total Pengeluaran', 'Saldo']);
        
        $no = 1;
        foreach ($data['cabang_summary'] as $item) {
            fputcsv($handle, [
                $no++,
                $item['nama_cabang'] ?? '-',
                number_format($item['total_pemasukan'], 0, ',', '.'),
                number_format($item['total_pengeluaran'], 0, ',', '.'),
                number_format($item['saldo'], 0, ',', '.')
            ]);
        }
    }

    // ==================== PDF EXPORT ====================
    private function export_to_pdf($data, $export_type)
    {
        // Fallback to CSV if PDF library not available
        $this->export_to_csv($data, $export_type);
    }

    // ==================== HELPER METHODS ====================
    private function create_income_sheet($spreadsheet, $data)
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Pemasukan');
        $this->populate_transactions_sheet($sheet, $data['transactions'], 'income', $data);
    }

    private function create_expense_sheet($spreadsheet, $data)
    {
        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('Pengeluaran');
        $this->populate_transactions_sheet($sheet, $data['transactions'], 'expense', $data);
    }

    private function create_profit_loss_sheet($spreadsheet, $data)
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laba Rugi');
        $this->populate_profit_loss_sheet($sheet, $data);
    }

    private function create_cabang_summary_sheet($spreadsheet, $data)
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Saldo Cabang');
        $this->populate_cabang_summary_sheet($sheet, $data);
    }

    private function populate_profit_loss_sheet($sheet, $data)
    {
        // Implementation for profit loss sheet
        $row = 1;
        
        $sheet->mergeCells('A1:E2');
        $sheet->setCellValue('A1', strtoupper($data['company_info']['nama_perusahaan']));
        $sheet->getStyle('A1:E2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['brand_green']]
            ]
        ]);
        
        $row = 3;
        $sheet->mergeCells('A3:E3');
        $sheet->setCellValue('A3', 'LAPORAN LABA RUGI PER CABANG');
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['dark_green']]
            ]
        ]);
        
        // ... (rest of implementation)
    }

    private function populate_cabang_summary_sheet($sheet, $data)
    {
        // Implementation for cabang summary sheet
        $row = 1;
        
        $sheet->mergeCells('A1:E2');
        $sheet->setCellValue('A1', strtoupper($data['company_info']['nama_perusahaan']));
        $sheet->getStyle('A1:E2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => $this->colors['brand_green']]
            ]
        ]);
        
        // ... (rest of implementation)
    }
}