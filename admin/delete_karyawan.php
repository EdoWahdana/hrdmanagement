<?php 

include('../conn.php');

session_start();

if(isset($_GET['aksi']) == 'delete') {
    $id = $_GET['id'];
    $delete = "DELETE FROM karyawan_new WHERE id_karyawan='$id';
                DELETE FROM tunjangan WHERE id_karyawan='$id';";
    $sql = mysqli_multi_query($koneksi, $delete);
    if($sql) {
        $_SESSION['delete_success'] = 'sukses';
        header('location: karyawan.php');
    } else {
        $_SESSION['delete_fail'] = 'gagal';
        header('location: karyawan.php');
    }
}