<?php 

include('../conn.php');

session_start();

if(isset($_GET['aksi']) == 'delete') {
    $id = $_GET['id'];
    $delete = "DELETE FROM gaji WHERE id_gaji='$id';";
    $sql = mysqli_query($koneksi, $delete);
    if($sql) {
        $_SESSION['delete_success'] = 'sukses';
        header('location: karyawan.php');
    } else {
        $_SESSION['delete_fail'] = 'gagal';
        header('location: karyawan.php');
    }
}