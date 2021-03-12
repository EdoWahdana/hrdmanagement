<?php 

include('../conn.php');

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

if(isset($_POST['input'])) {

    // Ambil value dari inputan
    $nik = $_POST['nik'];
    $nokk = $_POST['nokk'];
    $nok = $_POST['nok'];
    $nama = $_POST['nama'];
    $projek = $_POST['projek'];
    $role = $_POST['role'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $tanggal_masuk = $_POST['tanggal'];
    $gapok = (int) $_POST['gapok'];
    $bpjs = (int) $_POST['bpjs'];
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $level = $_POST['level'];

    //Upload foto karyawan
    $foto = uploadFile('foto', 'foto_karyawan/');
    //Upload foto ktp
    $foto_ktp = uploadFile('foto_ktp', 'foto_ktp/');
    //Upload foto kk
    $foto_kk = uploadFile('foto_kk', 'foto_kk/');
    //Upload foto npwp
    $foto_npwp = uploadFile('foto_npwp', 'foto_npwp/');
    //Upload foto buku rekening
    $foto_buku = uploadFile('foto_buku', 'foto_buku_rekening/');
    //Upload foto bpjs kesehatan
    $foto_bpjs_ks = uploadFile('foto_bpjs_ks', 'foto_bpjs_kesehatan/');
    //Upload foto bpjs ketenagakerjaan
    $foto_bpjs_kj = uploadFile('foto_bpjs_kj', 'foto_bpjs_ketenagakerjaan/');    

    //Insert data into database
    $sql = "INSERT INTO karyawan_new (nik, no_kk, no_karyawan, nama, departemen, jabatan, gaji_pokok, bpjs, foto, foto_ktp, foto_kk, foto_npwp, foto_buku_rekening, foto_bpjs_ks, foto_bpjs_kj, username, password, level, id_projek, id_role)
            VALUES ('$nik', '$nokk', '$nok', '$nama', '$departemen', '$jabatan', '$gapok', '$bpjs', '$foto', '$foto_ktp', '$foto_kk', '$foto_npwp', '$foto_buku', '$foto_bpjs_ks', '$foto_bpjs_kj', '$username', '$password', '$level', '$projek', '$role')";

    $insert = mysqli_query($koneksi, $sql) or die(mysqli_error());

    if(mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['insert_success'] == 'sukses';
        header('location: karyawan.php');
    } else {
        $_SESSION['insert_success'] == 'gagal';
        header('location: karyawan.php');
    }
}