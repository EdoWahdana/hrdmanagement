<?php 

require_once "../../vendor/autoload.php";
require_once "../koneksi.php";

// setlocale(LC_ALL, 'en_US');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$excel_writer = new Xlsx($spreadsheet);

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();

// Set zoom level
$activeSheet->getSheetView()->setZoomScale(85);

// Set width column
$activeSheet->getDefaultColumnDimension()->setWidth(30);
$activeSheet->getColumnDimension('A')->setWidth(5);
$activeSheet->getColumnDimension('B')->setWidth(10);
$activeSheet->getColumnDimension('C')->setWidth(20);
$activeSheet->getColumnDimension('D')->setWidth(30);
$activeSheet->getColumnDimension('E')->setWidth(40);
$activeSheet->getColumnDimension('F')->setWidth(20);
$activeSheet->getColumnDimension('G')->setWidth(10);

$activeSheet->setCellValue('A2', 'No');
$activeSheet->setCellValue('B2', 'No. Pegawai');
$activeSheet->setCellValue('C2', 'NIK');
$activeSheet->setCellValue('D2', 'Nama');
$activeSheet->setCellValue('E2', 'Projek');
$activeSheet->setCellValue('F2', 'No. Rekening');
$activeSheet->setCellValue('G2', 'Metode Pembayaran');
// Style untuk header tabel
$headerStyle = [
	'font' => [
		'bold' => true
	],
	'alignment' => [
		'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
	],
	'borders' => [
        'allborders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$activeSheet->getStyle('A2:G2')->applyFromArray($headerStyle);


$sql = "SELECT no_karyawan, nik, nama, projek, no_rekening, metode FROM v_karyawan"; 
$exec = mysqli_query($conn, $sql);

if(mysqli_num_rows($exec) > 0) {
	$i = 4;
	while($data = mysqli_fetch_array($exec)) {
		// Isi kolom tabel dengan data dari database
		$activeSheet->setCellValue('A'.$i, $i-1);
		$activeSheet->setCellValue('B'.$i, $data['no_karyawan']);
		$activeSheet->setCellValue('C'.$i, $data['nik']);
		$activeSheet->setCellValue('D'.$i, $data['nama']);
		$activeSheet->setCellValue('E'.$i, $data['projek']);
		$activeSheet->setCellValue('F'.$i, $data['no_rekening']);
		$activeSheet->setCellValue('G'.$i, $data['metode']);
        
        // Style Number Format
        $activeSheet->getColumnDimension('A:G')->setAutoSize(true);
        $activeSheet->getStyle('A'.$i.':G'.$i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
		$activeSheet->getStyle('C'.$i)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
		$activeSheet->getStyle('F'.$i)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);

		$i++;
	}
}

$filename = "convert-bank.xlsx";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='. $filename);
header('Cache-Control: max-age=0');

ob_end_clean();
$excel_writer->save('php://output');