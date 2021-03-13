<?php

include('../conn.php');

session_start();

if(isset($_POST['input'])) {

    // Definisikan variabel untuk input ke dalam tabel gaji
    $id = $_POST['id_karyawan'];
    $periode = $_POST['periode'];
    $tanggal = $_POST['tanggal'];
    $bonus = $_POST['bonus'];
    $bpjs_ks = $_POST['bpjs_ks'];
    $bpjs_kj = $_POST['bpjs_kj'];
    $ph = $_POST['ph'];
    $potongan = 0;
    $tunjangan = 0;
    $pph;

    // Definisikan variabel untuk menyimpan data
    $dataKaryawan;
    $dataInsentif;

    // Ambil data insentif menggunakan id karyawan
    $sql = "SELECT * FROM karyawan_new WHERE id_karyawan='$id'";
    $exec = mysqli_query($koneksi, $sql);
    $dataKaryawan = mysqli_fetch_array($exec);
    
    // Definisikan variabel yang berisi id untuk periode dan insentif
    $id_projek = $dataKaryawan['id_projek'];
    $id_role = $dataKaryawan['id_role'];
    $id_ptkp = $dataKaryawan['id_ptkp'];

    // Ambil data insentif berdasarkan id_projek dan id_role
    $sql = "SELECT * FROM insentif WHERE id_projek='$id_projek' AND id_role='$id_role'";
    $exec = mysqli_query($koneksi, $sql);
    $dataInsentif = mysqli_fetch_array($exec);

    // Ambil data absensi berdasarkan id_karyawan
    $sql = "SELECT * FROM absensi WHERE id_karyawan='$id'";
    $exec = mysqli_query($koneksi, $sql);
    $dataAbsensi = mysqli_fetch_array($exec);

    // Lakukan kalkulasi potongan sesuai jenis insentif
    $potongan += $dataInsentif['sakit'] * $dataAbsensi['jumlah_sakit'];
    $potongan += $dataInsentif['izin'] * $dataAbsensi['jumlah_izin'];
    $potongan += $dataInsentif['cuti'] * $dataAbsensi['jumlah_cuti'];
    $potongan += $dataInsentif['tk'] * $dataAbsensi['jumlah_tk'];
    
    // Lakukan kalkulasi tunjangan sesuai jenis insentif
    $tunjangan += $dataInsentif['backup'] * $dataAbsensi['jumlah_backup'];
    $tunjangan += $dataInsentif['lembur_holiday'] * $dataAbsensi['jumlah_lembur_holiday'] * $ph;
    $tunjangan += ($dataKaryawan['gaji_pokok'] / 173) * ($dataAbsensi['jumlah_lembur_reguler'] * 2 - $ph);

    
}