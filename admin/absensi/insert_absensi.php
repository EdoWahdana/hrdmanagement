<?php 

include('../../conn.php');

session_start();
 
if( isset($_POST['input']) ) {
    $id = $_POST['id_karyawan'];
    $periode = $_POST['periode'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $sql = "INSERT INTO absensi (
                id_karyawan,
                id_periode,
                id_kategori_absensi,
                jumlah,
                tanggal
            ) VALUES (
                '$id',
                '$periode',
                '$kategori',
                '$jumlah',
                '$tanggal'
            )";

    // Execute insert into absensi
    $insert = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

    if(mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['insert_success'] == 'sukses';
        header('location: absensi.php');
    } else {
        $_SESSION['insert_success'] == 'gagal';
        header('location: absensi.php');
    }
}