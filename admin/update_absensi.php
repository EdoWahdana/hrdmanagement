<?php 

include "../conn.php";

if(isset($_POST['update'])) {
    $id = $_POST['id_absensi'];
    $sakit = $_POST['jumlah_sakit'];
    $izin = $_POST['jumlah_izin'];
    $cuti = $_POST['jumlah_cuti'];
    $tk = $_POST['jumlah_tk'];
    $backup = $_POST['jumlah_backup'];
    $lembur_holiday = $_POST['jumlah_lembur_holiday'];
    $lembur_reguler = $_POST['jumlah_lembur_reguler'];

    $sql = "UPDATE absensi SET jumlah_sakit='$sakit', 
            jumlah_izin='$izin', 
            jumlah_cuti='$cuti', 
            jumlah_tk='$tk', 
            jumlah_backup='$backup', 
            jumlah_lembur_holiday='$lembur_holiday', 
            jumlah_lembur_reguler='$lembur_reguler' 
            WHERE id_absensi='$id'";

    // Eksekusi perintah update
    $exec = mysqli_query($koneksi, $sql);

    // Cek keberhasilan perintah
    if(mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['update_success'] == 'sukses';
        header("location: absensi.php");
    } else {
        $_SESSION['update_fail'] == 'gagal';
        header("location: absensi.php");
    }

}