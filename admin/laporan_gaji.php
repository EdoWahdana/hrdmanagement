<?php

define('FPDF_FONTPATH','../vendor/setasign/fpdf/font');
require_once('../vendor/setasign/fpdf/fpdf.php');
require_once('koneksi.php');


// Ambil data dari tabel view gaji
$id = $_GET['id'];
$sql = "SELECT * FROM v_gaji WHERE id_gaji='$id'";
$data = mysqli_fetch_array(mysqli_query($conn, $sql));

// Ambil data tabel periode
$sql = "SELECT * FROM v_absensi WHERE id_karyawan='$data[id_karyawan]' AND id_periode='$data[id_periode]'";
$absensi = mysqli_fetch_array(mysqli_query($conn, $sql));
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

$pdf = new FPDF('L', 'mm', array(215, 140));
$pdf->AddPage();

$pdf->SetFont('Courier', 'B', 20);
$pdf->SetFillColor(200);
$pdf->Cell(0, 10, 'LAPORAN GAJI KARYAWAN', '', 0, 'C', true);
$pdf->SetLineWidth(.4);
$pdf->Line(0, 20, $pdf->GetPageWidth(), 20);
$pdf->Ln();

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(100, 10, $data['no_karyawan'] .'    -    '. $data['nama'], '', 0);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(60, 10, 'Periode : ', '', 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(30, 10, $bulan[$data['bulan'] - 1] .'-'. $data['tahun'], '', 0, 'R');
$pdf->Ln();

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(25, 5, 'Projek       :   ', 0, 0);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(50, 5,  $data['projek'], 0, 1);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(25, 5, 'Posisi         :   ', 0, 0);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(25, 5, $data['role'], 0, 0);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(25, 5, 'Status         :   ', 0, 0);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(50, 5, $data['status_kerja'], 0, 1);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(25, 5, 'Alamat       :   ', 0, 0);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(70, 5, $data['alamat'], 0, 1);

$pdf->SetLineWidth(.4);
$pdf->Line(0, 50, $pdf->GetPageWidth(), 50);
$pdf->Ln();
$pdf->Line(0, 50, $pdf->GetPageWidth(), 50);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(60, 15, 'DATA ABSENSI', '', 0, 'C');
$pdf->Line(20, 60, 60, 60);
$pdf->Line(70, 55, 70, 100); // Garis Vertical
$pdf->Cell(70, 15, 'PENDAPATAN', '', 0, 'C');
$pdf->Line(80, 60, 130, 60);
$pdf->Line(140, 55, 140, 100); //Garis Vertical
$pdf->Cell(70, 15, 'POTONGAN', '', 0, 'C');
$pdf->Line(150, 60, 200, 60);

$pdf->Ln();

$pdf->SetFont('Times', '', 10);
$pdf->Cell(50, 5, 'Sakit (hari)', 0, 0);
$pdf->Cell(40, 5, $absensi['jumlah_sakit'], 0, 1);
$pdf->Cell(50, 5, 'Izin (hari)', 0, 0);
$pdf->Cell(40, 5, $absensi['jumlah_izin'], 0, 1);
$pdf->Cell(50, 5, 'Cuti (hari)', 0, 0);
$pdf->Cell(40, 5, $absensi['jumlah_cuti'], 0, 1);
$pdf->Cell(50, 5, 'Tanpa Keterangan (hari)', 0, 0);
$pdf->Cell(40, 5, $absensi['jumlah_tk'], 0, 1);
$pdf->Cell(50, 5, 'Backup Kekosongan (hari)', 0, 0);
$pdf->Cell(40, 5, $absensi['jumlah_backup'], 0, 1);
$pdf->Cell(50, 5, 'Lembur Holiday (jam)', 0, 0);
$pdf->Cell(40, 5, $absensi['jumlah_lembur_holiday'], 0, 1);
$pdf->Cell(50, 5, 'Lembur Reguler (jam)', 0, 0);
$pdf->Cell(40, 5, $absensi['jumlah_lembur_reguler'], 0, 1);

// Kolom pendapatan yang ditampilkan
$pendapatan_gaji_pokok = $data['gaji_pokok'];
$total_tunjangan = $data['tunjangan_dht'] + $data['tunjangan_bpjs_ks'] + $data['tunjangan_bpjs_kj'] + $data['tunjangan_shift'] + $data['tunjangan_transport'];
$total_lembur = $data['lembur_backup'] + $data['lembur_holiday'] + $data['lembur_reguler'] + $data['lembur_lain'];

// Kolom potongan yang ditampilkan
$potongan_absensi = $data['potongan_sakit'] + $data['potongan_izin'] + $data['potongan_cuti'] + $data['potongan_tk'] + $data['potongan_sp'];
$potongan_bpjs_ks = $data['tunjangan_bpjs_ks'] * 0.01;
$potongan_bpjs_kj = $data['tunjangan_bpjs_kj'] * 0.03;
$potongan_pph21 = intval($data['pph'] / 12);
$potongan_diksar = $data['potongan_diksar'];
$potongan_lain = $data['potongan_lain'] + $data['biaya_jabatan'];

$pdf->SetXY(75, 65); //Geser Kanan ke kolom Pendapatan
$pdf->Cell(40, 5, 'Gaji Pokok', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($pendapatan_gaji_pokok)),3))), 0, 1);
$pdf->SetXY(75, 70); //Geser Kanan ke kolom Pendapatan
$pdf->Cell(40, 5, 'Total Tunjangan', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($total_tunjangan)),3))), 0, 1);
$pdf->SetXY(75, 75); //Geser Kanan ke kolom Pendapatan
$pdf->Cell(40, 5, 'Total Lembur', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($total_lembur)),3))), 0, 1);
// $pdf->SetXY(75, 80); //Geser Kanan ke kolom Pendapatan
// $pdf->Cell(40, 5, 'BPJS Kesehatan', 0, 0);
// $pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($data['tunjangan_bpjs_ks'])),3))), 0, 1);
// $pdf->SetXY(75, 85); //Geser Kanan ke kolom Pendapatan
// $pdf->Cell(40, 5, 'Lembur Lain', 0, 0);
// $pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($data['lembur_lain'] + $data['lembur_backup'] + $data['lembur_holiday'] + $data['lembur_reguler'] + $data['bonus'])),3))), 0, 1);

$pdf->SetXY(145, 65); //Geser Kanan ke kolom Potongan
$pdf->Cell(40, 5, 'Potongan Absensi', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($potongan_absensi)),3))), 0, 1);
$pdf->SetXY(145, 70); //Geser Kanan ke kolom Potongan
$pdf->Cell(40, 5, 'Potongan BPJS', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval(intval($potongan_bpjs_ks + $potongan_bpjs_kj))),3))), 0, 1);
$pdf->SetXY(145, 75); //Geser Kanan ke kolom Potongan
$pdf->Cell(40, 5, 'Potongan Pph21', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($potongan_pph21)),3))), 0, 1);
$pdf->SetXY(145, 80); //Geser Kanan ke kolom Potongan
$pdf->Cell(40, 5, 'Potongan Diksar', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($potongan_diksar)),3))), 0, 1);
$pdf->SetXY(145, 85); //Geser Kanan ke kolom Potongan
$pdf->Cell(40, 5, 'Potongan Lain', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($potongan_lain)),3))), 0, 1);

// Hitung jumlah pendapatan dan potongan
$pendapatan = $pendapatan_gaji_pokok + $total_tunjangan + $total_lembur;
$potongan = $potongan_absensi + $potongan_bpjs_ks + $potongan_bpjs_kj + $potongan_pph21 + $potongan_diksar + $potongan_lain;

$pdf->SetFont('Times', 'B', 10);
$pdf->SetXY(75, 100); //Geser Kolom Total Pendapatan
$pdf->Cell(35, 5, 'Total Pendapatan : ', 0, 0);
$pdf->Cell(40, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($pendapatan)),3))), 0, 1);

$pdf->SetXY(145, 100); //Geser Kolom Total Potongan
$pdf->Cell(35, 5, 'Total Potongan : ', 0, 0);
$pdf->Cell(40, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($potongan)),3))), 0, 1);

$pdf->Line(10, 107, $pdf->GetPageWidth()-10, 107);

// Tampilkan Nilai Take Home Pay
$pdf->SetFont('Times', 'B', 14);
$pdf->SetTextColor(127);
$pdf->SetXY(100, 110);
$pdf->Cell(50, 5, 'Take Home Pay : ', 0, 0);
$pdf->Cell(50, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($data['thp'])),3))), 0, 1);


$pdf->Output();

?>