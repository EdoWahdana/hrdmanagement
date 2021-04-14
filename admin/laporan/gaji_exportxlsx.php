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
$activeSheet->getSheetView()->setZoomScale(75);

// Set width column
$activeSheet->getDefaultColumnDimension()->setWidth(30);
$activeSheet->getColumnDimension('A')->setWidth(5);
$activeSheet->getColumnDimension('C')->setWidth(20);
$activeSheet->getColumnDimension('E')->setWidth(20);
$activeSheet->getColumnDimension('F')->setWidth(50);
$activeSheet->getColumnDimension('G')->setWidth(10);
$activeSheet->getColumnDimension('H')->setWidth(5);
$activeSheet->getColumnDimension('I')->setWidth(5);
$activeSheet->getColumnDimension('J')->setWidth(10);

$activeSheet->setCellValue('A2', 'No');
$activeSheet->setCellValue('B2', 'Nama');
$activeSheet->setCellValue('C2', 'Nopeg');
$activeSheet->setCellValue('D2', 'No. NPWP');
$activeSheet->setCellValue('E2', 'KTP');
$activeSheet->setCellValue('F2', 'Projek');
$activeSheet->setCellValue('G2', 'Status');
$activeSheet->setCellValue('H2', 'JK');
$activeSheet->setCellValue('I2', 'ST');
$activeSheet->setCellValue('J2', 'Periode');
$activeSheet->setCellValue('K2', 'Gaji Pokok');
$activeSheet->setCellValue('L2', 'Tunjangan, DHT, Lembur dll');
$activeSheet->setCellValue('M2', 'Iuran BPJS Kesehatan');
$activeSheet->setCellValue('N2', 'Iuran BPJS Ketenagakerjaan');
$activeSheet->setCellValue('O2', 'Jumlah');
$activeSheet->setCellValue('P2', 'Gaji Setahun');
$activeSheet->setCellValue('Q2', 'Bonus, Tantiem, THR dll');
$activeSheet->setCellValue('R2', 'Penghasilan Bruto Setahun');
$activeSheet->setCellValue('S2', 'Biaya Jabatan yang Digunakan');
$activeSheet->setCellValue('T2', 'Penghasilan Neto Setahun');
$activeSheet->setCellValue('U2', 'PTKP');
$activeSheet->setCellValue('V2', 'Penghasilan Kena Pajak');
$activeSheet->setCellValue('W2', 'Pph Setahun');
$activeSheet->setCellValue('X2', 'Pph Sebulan');
$activeSheet->setCellValue('Y2', 'Take Home Pay');

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
$activeSheet->getStyle('A2:Y2')->applyFromArray($headerStyle);

// Ambil data id periodeyang dikirimkan
$id = $_GET['id'];

// SQL Query untuk semua periode
if($id == "semua") 
	$sql = "SELECT * FROM v_gaji"; 
else 
	$sql = "SELECT * FROM v_gaji WHERE id_periode=$id";

$exec = mysqli_query($conn, $sql);

if(mysqli_num_rows($exec) > 0) {
	$i = 4;
	while($data = mysqli_fetch_array($exec)) {
		// Isi kolom tabel dengan data dari database
		$activeSheet->setCellValue('A'.$i, $i-1);
		$activeSheet->setCellValue('B'.$i, $data['nama']);
		$activeSheet->setCellValue('C'.$i, $data['no_karyawan']);
		$activeSheet->setCellValue('D'.$i, $data['no_npwp']);
		$activeSheet->setCellValue('E'.$i, $data['nik']);
		$activeSheet->setCellValue('F'.$i, $data['projek']);
		$activeSheet->setCellValue('G'.$i, $data['status_kerja']);
		$activeSheet->setCellValue('H'.$i, $data['jk']);
		$activeSheet->setCellValue('I'.$i, $data['kode']);
		$activeSheet->setCellValue('J'.$i, $data['bulan'] . " - " . $data['tahun']);
		$activeSheet->setCellValue('K'.$i, $data['gaji_pokok']);
		$activeSheet->setCellValue('L'.$i, $data['tunjangan_dht']);
		$activeSheet->setCellValue('M'.$i, $data['tunjangan_bpjs_ks']);
		$activeSheet->setCellValue('N'.$i, $data['tunjangan_bpjs_kj']);
		$activeSheet->setCellValue('O'.$i, $data['sebulan']);
		$activeSheet->setCellValue('P'.$i, $data['setahun']);
		$activeSheet->setCellValue('Q'.$i, $data['bonus']);
		$activeSheet->setCellValue('R'.$i, $data['bruto']);
		$activeSheet->setCellValue('S'.$i, $data['biaya_jabatan']);
		$activeSheet->setCellValue('T'.$i, $data['neto']);
		$activeSheet->setCellValue('U'.$i, $data['ptkp']);
		$activeSheet->setCellValue('V'.$i, $data['neto'] - $data['ptkp']);
		$activeSheet->setCellValue('W'.$i, $data['pph']);
		$activeSheet->setCellValue('X'.$i, $data['pph'] / 12);
		$activeSheet->setCellValue('Y'.$i, $data['thp']);

		// Style Number Format
		$activeSheet->getStyle('E'.$i)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
		$activeSheet->getStyle('K'.$i.':Y'.$i)->getNumberFormat()->setFormatCode('#,##0');
		
		$i++;
	}
}

$filename = "gaji.xlsx";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='. $filename);
header('Cache-Control: max-age=0');

ob_end_clean();
$excel_writer->save('php://output');