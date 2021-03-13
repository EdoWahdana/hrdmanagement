<?php 

include "koneksi.php";

// Ambil data karyawan dari tabel karyawan_new
$sql = "SELECT * FROM v_karyawan";
$exec = mysqli_query($conn, $sql);
$dataKaryawan = mysqli_fetch_array($exec);

$no_pegawai = $dataKaryawan['no_karyawan'];
$nik = $dataKaryawan['nik'];
$nama = $dataKaryawan['nama'];
$jk = $dataKaryawan['jk'];
$projek = $dataKaryawan['projek'];
$gaji_pokok = $dataKaryawan['gaji_pokok'];
