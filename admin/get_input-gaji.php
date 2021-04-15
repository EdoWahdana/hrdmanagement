<?php

include("koneksi.php");

// Deklarasi variabel untuk menyimpan hasil query
$result = [];
$output = [];
$kontrak;

// Ambil data dari ajax di input-gaji.php 
$id_karyawan = $_GET['id_karyawan'];
$id_periode = $_GET['id_periode'];
$ph = $_GET['ph'];

// Ambil data tanggal habis kontrak untuk notifikasi di halaman input-gaji.php
$sql = "SELECT tanggal_masuk, tanggal_habis FROM karyawan_new WHERE id_karyawan='$id_karyawan'";
$tanggal = mysqli_fetch_array(mysqli_query($conn, $sql));
$tanggal_masuk = new DateTime($tanggal['tanggal_masuk']);
$tanggal_habis = new DateTime($tanggal['tanggal_habis']);

if($tanggal_habis != '')
    $kontrak = date_diff($tanggal_masuk, $tanggal_habis);
else
    $kontrak = 0;

// Ambil data jumlah sakit, izin, cuti, tk, backup, holiday, reguler dari tabel absensi berdasarkan id_karyawan dan id_periode
$sql = "SELECT 
            (SELECT IFNULL(SUM(jumlah),0) FROM absensi WHERE id_karyawan='$id_karyawan' AND id_periode='$id_periode' AND id_kategori_absensi=1) AS jumlah_sakit, 
            (SELECT IFNULL(SUM(jumlah),0) FROM absensi WHERE id_karyawan='$id_karyawan' AND id_periode='$id_periode' AND id_kategori_absensi=2) AS jumlah_izin, 
            (SELECT IFNULL(SUM(jumlah),0) FROM absensi WHERE id_karyawan='$id_karyawan' AND id_periode='$id_periode' AND id_kategori_absensi=3) AS jumlah_cuti, 
            (SELECT IFNULL(SUM(jumlah),0) FROM absensi WHERE id_karyawan='$id_karyawan' AND id_periode='$id_periode' AND id_kategori_absensi=4) AS jumlah_tk, 
            (SELECT IFNULL(SUM(jumlah),0) FROM absensi WHERE id_karyawan='$id_karyawan' AND id_periode='$id_periode' AND id_kategori_absensi=5) AS jumlah_backup, 
            (SELECT IFNULL(SUM(jumlah),0) FROM absensi WHERE id_karyawan='$id_karyawan' AND id_periode='$id_periode' AND id_kategori_absensi=6) AS jumlah_holiday, 
            (SELECT IFNULL(SUM(jumlah),0) FROM absensi WHERE id_karyawan='$id_karyawan' AND id_periode='$id_periode' AND id_kategori_absensi=7) AS jumlah_reguler; ";
$result += mysqli_fetch_array(mysqli_query($conn, $sql));

// Ambil data gaji pokok untuk perhitungan lembur reguler
$sql = "SELECT * FROM tunjangan WHERE id_karyawan='$id_karyawan';";
$result += mysqli_fetch_array(mysqli_query($conn, $sql));

// Ambil data insentif
$sql = "SELECT sakit, izin, cuti, tk, backup, lembur_holiday FROM insentif WHERE id_projek=(SELECT id_projek FROM karyawan_new WHERE id_karyawan='$id_karyawan') AND id_role=(SELECT id_role FROM karyawan_new WHERE id_karyawan='$id_karyawan');";
$result += mysqli_fetch_array(mysqli_query($conn, $sql));

$output['kontrak'] = $kontrak->days;
$output['potongan_sakit'] = $result['jumlah_sakit'] * $result['sakit'];
$output['potongan_izin'] = $result['jumlah_izin'] * $result['izin'];
$output['potongan_cuti'] = $result['jumlah_cuti'] * $result['cuti'];
$output['potongan_tk'] = $result['jumlah_tk'] * $result['tk'];
$output['potongan_bpjs_ks'] = $result['tunjangan_bpjs_ks'] * 0.01;
$output['potongan_bpjs_kj'] = $result['tunjangan_bpjs_kj'] * 0.03;
$output['lembur_backup'] = $result['jumlah_backup'] * $result['backup'];
$output['lembur_holiday'] = ($result['jumlah_holiday'] * $result['lembur_holiday']) * floatval(number_format($ph, 1));
$output['lembur_reguler'] = intval(($result['gaji_pokok'] / 173) * max(($result['jumlah_reguler'] * 2 - floatval(number_format('0.5', 1))), 0));

echo json_encode($output);
