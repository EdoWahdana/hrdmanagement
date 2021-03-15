<?php

define('FPDF_FONTPATH','../vendor/setasign/fpdf/font');
require_once('../vendor/setasign/fpdf/fpdf.php');
require_once('koneksi.php');


// Ambil data dari tabel view gaji
$id = $_GET['id'];
$sql = "SELECT * FROM v_gaji WHERE id_gaji='$id'";
$data = mysqli_fetch_array(mysqli_query($conn, $sql));

// Ambil data tabel periode
$sql = "SELECT * FROM absensi WHERE id_karyawan='$data[id_karyawan]' AND id_periode='$data[id_periode]'";
$absensi = mysqli_fetch_array(mysqli_query($conn, $sql));

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
$pdf->Cell(60, 10, 'Tanggal : ', '', 0, 'R');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(30, 10, date('d - M - Y', strtotime($data['tanggal'])), '', 0, 'R');
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

$pdf->SetLineWidth(.4);
$pdf->Line(0, 50, $pdf->GetPageWidth(), 50);
$pdf->Ln();
$pdf->Line(0, 50, $pdf->GetPageWidth(), 50);

$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(60, 20, 'DATA ABSENSI', '', 0, 'C');
$pdf->Line(20, 60, 60, 60);
$pdf->Line(70, 55, 70, 100); // Garis Vertical
$pdf->Cell(70, 20, 'PENDAPATAN', '', 0, 'C');
$pdf->Line(80, 60, 130, 60);
$pdf->Line(140, 55, 140, 100); //Garis Vertical
$pdf->Cell(70, 20, 'POTONGAN', '', 0, 'C');
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


$pdf->SetXY(75, 65); //Geser Kanan ke kolom Pendapatan
$pdf->Cell(40, 5, 'Gaji Pokok', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($data['gaji_pokok'])),3))), 0, 1);
$pdf->SetXY(75, 70); //Geser Kanan ke kolom Pendapatan
$pdf->Cell(40, 5, 'Bonus', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval(intval($data['bonus']/12))),3))), 0, 1);
$pdf->SetXY(75, 75); //Geser Kanan ke kolom Pendapatan
$pdf->Cell(40, 5, 'Tunjangan', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($data['tunjangan'])),3))), 0, 1);
$pdf->SetXY(75, 80); //Geser Kanan ke kolom Pendapatan
$pdf->Cell(40, 5, 'BPJS Kesehatan', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($data['bpjs_ks'])),3))), 0, 1);
$pdf->SetXY(75, 85); //Geser Kanan ke kolom Pendapatan
$pdf->Cell(40, 5, 'BPJS Ketenagakerjaan', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($data['bpjs_kj'])),3))), 0, 1);

$pdf->SetXY(145, 65); //Geser Kanan ke kolom Potongan
$pdf->Cell(40, 5, 'Potongan', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval($data['potongan'])),3))), 0, 1);
$pdf->SetXY(145, 70); //Geser Kanan ke kolom Potongan
$pdf->Cell(40, 5, 'Biaya Jabatan', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval(intval($data['biaya_jabatan']/12))),3))), 0, 1);
$pdf->SetXY(145, 75); //Geser Kanan ke kolom Potongan
$pdf->Cell(40, 5, 'Pph21', 0, 0);
$pdf->Cell(30, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval(intval($data['pph']/12))),3))), 0, 1);

// Hitung jumlah pendapatan dan potongan
$pendapatan = $data['gaji_pokok'] + intval($data['bonus']/12) + $data['tunjangan'] + $data['bpjs_ks'] + $data['bpjs_kj'];
$potongan = $data['potongan'] + intval($data['biaya_jabatan']/12) + intval($data['pph']/12);

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
$pdf->Cell(50, 5, 'Rp. '.strrev(implode('.',str_split(strrev(strval(intval($pendapatan - $potongan))),3))), 0, 1);


$pdf->Output();

?>