<?php 

include('../../conn.php');

// Fungsi tambah hari sakit
if(isset($_POST['field'])) {
    $koneksi = $koneksi;
    $id = $_POST['id'];
    $field = $_POST['field'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $tabelTanggal = $_POST['tabel'];

    // Update data pada tabel absensi
    $absensiSql = "UPDATE absensi SET $field='$jumlah' WHERE id_absensi='$id'";
    $execSql = mysqli_query($koneksi, $absensiSql);

    // Cek keberhasilan perintah
    if(mysqli_affected_rows($koneksi) > 0) {
        // Insert data kedalam tabel tanggal
        $sql = "INSERT INTO $tabelTanggal (id_absensi, tanggal) VALUES ('$id', '$tanggal')";
        $exec = mysqli_query($koneksi, $sql);
        
        if(mysqli_affected_rows($koneksi) > 0) 
            echo json_encode('Sukses');
        else 
            echo json_encode('Gagal');

    } else {
        echo json_encode('Gagal');
    }
}


// Eksekusi fungsi update
// if(isset($_POST['field']))    
    // echo json_encode($_POST['jumlah']);
    // updateAbsensi($koneksi);



//  Ini fungsi untuk update semua field

//   if(isset($_POST['update'])) {
//      $id = $_POST['id_absensi'];
//      $sakit = $_POST['jumlah_sakit'];
//      $izin = $_POST['jumlah_izin'];
//      $cuti = $_POST['jumlah_cuti'];
//      $tk = $_POST['jumlah_tk'];
//      $backup = $_POST['jumlah_backup'];
//      $lembur_holiday = $_POST['jumlah_lembur_holiday'];
//      $lembur_reguler = $_POST['jumlah_lembur_reguler'];

//      $sql = "UPDATE absensi SET jumlah_sakit='$sakit', 
//              jumlah_izin='$izin', 
//              jumlah_cuti='$cuti', 
//              jumlah_tk='$tk', 
//              jumlah_backup='$backup', 
//              jumlah_lembur_holiday='$lembur_holiday', 
//              jumlah_lembur_reguler='$lembur_reguler' 
//              WHERE id_absensi='$id'";

//      // Eksekusi perintah update
//      $exec = mysqli_query($koneksi, $sql);

//      // Cek keberhasilan perintah
//      if(mysqli_affected_rows($koneksi) > 0) {
//          $_SESSION['update_success'] == 'sukses';
//          header("location: absensi.php");
//      } else {
//          $_SESSION['update_fail'] == 'gagal';
//          header("location: absensi.php");
//     }

//  }
