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

    // Ambil value dari inputan untuk tabel karyawan
    $nik = $_POST['nik'];
    $nokk = $_POST['nokk'];
    $nok = $_POST['nok'];
    $no_npwp = $_POST['no_npwp'];
    $no_rekening = $_POST['no_rekening'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $status_kerja = $_POST['status'];
    $ptkp = $_POST['ptkp'];
    $projek = $_POST['projek'];
    $role = $_POST['role'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $tanggal_masuk = $_POST['tanggal'];
    $tanggal_habis = isset($_POST['habis']) ? $_POST['habis'] : $_POST['habis'] = '';
    $metode = $_POST['metode'];
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $level = $_POST['level'];

    // Ambil value inputan untuk tabel tunjangan
    $gapok = intval(preg_replace('/\D/', '', $_POST['gapok']));
    $dht = intval(preg_replace('/\D/', '', $_POST['dht']));
    $bpjs_ks = intval(preg_replace('/\D/', '', $_POST['bpjs_ks']));
    $bpjs_kj = intval(preg_replace('/\D/', '', $_POST['bpjs_kj']));
    $shift = intval(preg_replace('/\D/', '', $_POST['shift']));
    $transport = intval(preg_replace('/\D/', '', $_POST['transport']));

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

    //Insert data into karyawan_new table
    $karyawanSql = "INSERT INTO karyawan_new (
                nik, 
                no_kk, 
                no_karyawan, 
                no_npwp,
                no_rekening,
                nama, 
                jk,
                status_kerja,
                departemen, 
                jabatan,
                tanggal_masuk, 
                tanggal_habis,
                metode,
                foto, 
                foto_ktp, 
                foto_kk, 
                foto_npwp, 
                foto_buku_rekening, 
                foto_bpjs_ks, 
                foto_bpjs_kj, 
                username, 
                password, 
                level, 
                id_projek, 
                id_role,
                id_ptkp)
            VALUES (
                '$nik', 
                '$nokk', 
                '$nok', 
                '$no_npwp',
                '$no_rekening',
                '$nama',
                '$jk', 
                '$status_kerja',
                '$departemen', 
                '$jabatan', 
                '$tanggal_masuk', 
                '$tanggal_habis', 
                '$metode', 
                '$foto', 
                '$foto_ktp', 
                '$foto_kk', 
                '$foto_npwp', 
                '$foto_buku', 
                '$foto_bpjs_ks', 
                '$foto_bpjs_kj', 
                '$username', 
                '$password', 
                '$level', 
                '$projek', 
                '$role',
                '$ptkp');";
    // Execute insert into karyawan_new
    $insert = mysqli_query($koneksi, $karyawanSql) or die(mysqli_error($koneksi));
    $last_id = mysqli_insert_id($koneksi);

    $tunjanganSql = "INSERT INTO tunjangan (
                id_karyawan,
                gaji_pokok,
                tunjangan_dht,
                tunjangan_bpjs_ks,
                tunjangan_bpjs_kj,
                tunjangan_shift,
                tunjangan_transport
            ) VALUES (
                '$last_id',
                '$gapok',
                '$dht',
                '$bpjs_ks',
                '$bpjs_kj',
                '$shift',
                '$transport'
            );";
    // Execute insert into tunjangan
    $insert = mysqli_query($koneksi, $tunjanganSql) or die(mysqli_error($koneksi));

    if(mysqli_affected_rows($koneksi) > 0) {
        $_SESSION['insert_success'] == 'sukses';
        header('location: karyawan.php');
    } else {
        $_SESSION['insert_success'] == 'gagal';
        header('location: karyawan.php');
    }
}