<?php 

include('../../conn.php');

session_start();
 
if( isset($_POST['input']) ) {
    $id = $_POST['id_karyawan'];
    $periode = $_POST['periode'];
    $sakit = 0;
    $izin = 0;
    $cuti = 0;
    $tk = 0;
    $backup = 0;
    $lembur_holiday = 0;
    $lembur_reguler = 0;

    $sql = "INSERT INTO absensi (
                id_karyawan,
                id_periode,
                jumlah_sakit,
                jumlah_izin,
                jumlah_cuti,
                jumlah_tk,
                jumlah_backup,
                jumlah_lembur_holiday,
                jumlah_lembur_reguler
            ) VALUES (
                '$id',
                '$periode',
                '$sakit',
                '$izin',
                '$cuti',
                '$tk',
                '$backup',
                '$lembur_holiday',
                '$lembur_reguler'   
            )";

    // Execute insert into absensi
    $insert = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

    if(mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['insert_success'] == 'sukses';
        header(mysqli_error($koneksi));
    } else {
        $_SESSION['insert_success'] == 'gagal';
        header(mysqli_error($koneksi));
    }
}