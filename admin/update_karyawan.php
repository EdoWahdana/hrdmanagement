<?php 

include("../conn.php");

session_start();

function getFileType($file, $fieldName) {
    $allowedFileType = ['jpg', 'jpeg', 'png', 'gif'];
    $filenameArray = explode('.', $file[$fieldName]['name']);
    $fileType = strtolower(end($filenameArray));

    if(in_array($fileType, $allowedFileType)) {
        return $fileType;
    } else {
        return;
    }
}

function getNewFileName($file, $fieldName) {
    return md5(time() . $file[$fieldName]['name']);
}

function uploadFile($fieldName, $folderName) {
    if(isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] == UPLOAD_ERR_OK) {
        $fileTmp = $_FILES[$fieldName]['tmp_name'];
        $newFileName = getNewFileName($_FILES, $fieldName) . '.' . getFileType($_FILES, $fieldName);
        $newPath = $folderName . $newFileName;

        if(move_uploaded_file($fileTmp, $newPath)) {
            $message = 'Foto Berhasil Diupload';
            return $newFileName;
        } else {
            $message = 'Foto GAGAL Diupload';
            return;
        } 
    }
}

if(isset($_POST['update'])) {

    // Ambil nilai inputan dari file edit-karyawan
    $id_karyawan = $_POST['id_karyawan'];
    $nik = $_POST['nik'];
    $no_kk = $_POST['no_kk'];
    $no_karyawan = $_POST['no_karyawan'];
    $no_npwp = $_POST['no_npwp'];
    $no_rekening = $_POST['no_rekening'];
    $nama = $_POST['nama'];
    $status_kerja = $_POST['status'];
    $projek = $_POST['projek'];
    $role = $_POST['role'];
    $departemen = $_POST['departemen'];
    $jabatan =  $_POST['jabatan'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $tanggal_habis = $_POST['tanggal_habis'];
    $metode = $_POST['metode'];
    $id_ptkp = $_POST['ptkp']; 

    // Ambil inputan untuk tabel tunjangan
    $gapok = intval(preg_replace('/\D/', '', $_POST['gaji_pokok']));
    $dht = intval(preg_replace('/\D/', '', $_POST['tunjangan_dht']));
    $bpjs_ks = intval(preg_replace('/\D/', '', $_POST['tunjangan_bpjs_ks']));
    $bpjs_kj = intval(preg_replace('/\D/', '', $_POST['tunjangan_bpjs_kj']));
    $shift = intval(preg_replace('/\D/', '', $_POST['tunjangan_shift']));
    $transport = intval(preg_replace('/\D/', '', $_POST['tunjangan_transport']));

    // Jika tidak upload foto baru maka ambil string foto yang telah tersimpan di dalam database
    $foto = $_POST['hidden_foto'];
    $foto_ktp = $_POST['hidden_foto_ktp'];
    $foto_kk = $_POST['hidden_foto_kk'];
    $foto_npwp = $_POST['hidden_foto_npwp'];
    $foto_buku = $_POST['hidden_foto_buku'];
    $foto_bpjs_ks = $_POST['hidden_foto_bpjs_ks'];
    $foto_bpjs_kj = $_POST['hidden_foto_bpjs_kj'];
    
    // Jika ada file yang diupload, ambil nama file baru
    // Validasi dan upload file foto karyawan
    if($_FILES['foto']['tmp_name'] != '') {
        $foto = uploadFile('foto', 'foto_karyawan/');
    }
    
    // Validasi dan upload file foto ktp
    if($_FILES['foto_ktp']['tmp_name'] != '') {
        $foto_ktp = uploadFile('foto_ktp', 'foto_ktp/');
    }
    
    // Validasi dan upload file foto kk
    if($_FILES['foto_kk']['tmp_name'] != '') {
        $foto_kk = uploadFile('foto_kk', 'foto_kk/');
    }
    
    // Validasi dan upload file foto npwp
    if($_FILES['foto_npwp']['tmp_name'] != '') {
        $foto_npwp = uploadFile('foto_npwp', 'foto_npwp/');
    }
    
    // Validasi dan upload file foto buku rekening
    if($_FILES['foto_buku']['tmp_name'] != '') {
        $foto_buku = uploadFile('foto_buku', 'foto_buku_rekening/');
    }
    
    // Validasi dan upload file foto bpjs kesehatan
    if($_FILES['foto_bpjs_ks']['tmp_name'] != '') {
        $foto_bpjs_ks = uploadFile('foto_bpjs_ks', 'foto_bpjs_kesehatan/');
    }
    
    // Validasi dan upload file foto bpjs ketenagakerjaan
    if($_FILES['foto_bpjs_kj']['tmp_name'] != '') {
        $foto_bpjs_kj = uploadFile('foto_bpjs_kj', 'foto_bpjs_ketenagakerjaan/');
    }

    // Buat perintah SQL untuk update data
    $update = "UPDATE karyawan_new SET 
                nik='$nik', 
                no_kk='$no_kk', 
                no_karyawan='$no_karyawan', 
                no_npwp='$no_npwp', 
                no_rekening='$no_rekening', 
                nama='$nama', 
                status_kerja='$status_kerja',
                id_projek='$projek', 
                id_role='$role', 
                departemen='$departemen', 
                jabatan='$jabatan', 
                tanggal_masuk='$tanggal_masuk', 
                tanggal_habis='$tanggal_habis', 
                metode='$metode', 
                foto='$foto',
                foto_ktp='$foto_ktp',
                foto_kk='$foto_kk',
                foto_npwp='$foto_npwp',
                foto_buku_rekening='$foto_buku',
                foto_bpjs_ks='$foto_bpjs_ks',
                foto_bpjs_kj='$foto_bpjs_kj',
                id_ptkp='$id_ptkp'
                WHERE id_karyawan='$id_karyawan';";

    // Eksekusi perintah update karyawan_new
    $executeUpdate = mysqli_query($koneksi, $update) or die(mysqli_error($koneksi));

    // Buat perintah untuk update data tunjangan
    $updateTunjangan = "UPDATE tunjangan SET 
                        gaji_pokok='$gapok',
                        tunjangan_dht='$dht',
                        tunjangan_bpjs_ks='$bpjs_ks',
                        tunjangan_bpjs_kj='$bpjs_kj',
                        tunjangan_shift='$shift',
                        tunjangan_transport='$transport'
                        WHERE id_karyawan='$id_karyawan';";

    // Eksekusi perintah update tabel tunjangan
    $executeTunjangan = mysqli_query($koneksi, $updateTunjangan) or die(mysqli_error($koneksi));

    // Cek keberhasilan perintah
    if(mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['update_success'] == 'sukses';
        header("location: karyawan.php");
    } else {
        $_SESSION['update_fail'] == 'gagal';
        header("location: karyawan.php");
    }

}