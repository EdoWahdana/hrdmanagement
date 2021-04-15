<?php

include('../conn.php');

session_start();

// Ini perhitungan pph berdasarkan data dari excel mas yandi
function itungPph($npwp, $neto, $kena_pajak) {
    $pph = 0;
    if( $neto <= 150000000 ){
        if( $npwp == '' )
            $pph += ($kena_pajak * 0.05) * 0.2;
        else 
            $pph += $kena_pajak * 0.05;
    } 
    if( $neto > 150000000 && $neto <= 250000000 ) {
        if( $npwp == '' ){
            $pph += ($kena_pajak * 0.05) * 0.2;
            $pph += ($kena_pajak * 0.15) * 0.2;
        } else {
            $pph += $kena_pajak * 0.05;
            $pph += $kena_pajak * 0.15;
        }
    }
    // } else if ( $neto > 250000000 && $neto <= 500000000 ) {
    //     if( $npwp == '' )
    //         $pph = ($kena_pajak * 0.25) * 0.2;
    //     else 
    //         $pph = $kena_pajak * 0.25;
    // } else if ( $neto > 500000000 ) {
    //     if( $npwp == '' )
    //         $pph = ($kena_pajak * 0.30) * 0.2;
    //     else 
    //         $pph = $kena_pajak * 0.30;
    // }

    return $pph;
}

if(isset($_POST['input'])) {

    // Definisikan variabel untuk input ke dalam tabel gaji
    // $bpjs_kj = intval(preg_replace('/\D/', '', $_POST['bpjs_kj']));
    $id = $_POST['id_karyawan'];
    $periode = $_POST['periode'];
    $ph = $_POST['ph'];
    $sp = intval($_POST['sp']);
    $bonus = intval(preg_replace('/\D/', '', $_POST['bonus']));
    $lembur_backup = intval(preg_replace('/\D/', '', $_POST['lembur_backup']));
    $lembur_holiday = intval(preg_replace('/\D/', '', $_POST['lembur_holiday']));
    $lembur_reguler = intval(preg_replace('/\D/', '', $_POST['lembur_reguler']));
    $lembur_lain = intval(preg_replace('/\D/', '', $_POST['lembur_lain']));
    $potongan_sakit = intval(preg_replace('/\D/', '', $_POST['potongan_sakit']));
    $potongan_izin = intval(preg_replace('/\D/', '', $_POST['potongan_izin']));
    $potongan_cuti = intval(preg_replace('/\D/', '', $_POST['potongan_cuti']));
    $potongan_tk = intval(preg_replace('/\D/', '', $_POST['potongan_tk']));
    $potongan_bpjs_ks = intval(preg_replace('/\D/', '', $_POST['potongan_bpjs_ks']));
    $potongan_bpjs_kj = intval(preg_replace('/\D/', '', $_POST['potongan_bpjs_kj']));
    $potongan_lain = intval(preg_replace('/\D/', '', $_POST['potongan_lain']));
    $potongan_diksar = intval(preg_replace('/\D/', '', $_POST['potongan_diksar']));
    $potongan = 0;
    $tunjangan = 0;
    $pph = 0;
    $thp = 0;

    // Ambil data karyawan menggunakan id karyawan
    $sql = "SELECT * FROM v_karyawan WHERE id_karyawan='$id'";
    $exec = mysqli_query($koneksi, $sql);
    $dataKaryawan = mysqli_fetch_array($exec);

    // Definisikan variabel untuk menampung data tunjangan karyawan
    $kode_ptkp = $dataKaryawan['kode'];
    $gaji_pokok = $dataKaryawan['gaji_pokok'];
    $tunjangan_dht = $dataKaryawan['tunjangan_dht'];
    $tunjangan_bpjs_ks = $dataKaryawan['tunjangan_bpjs_ks'];
    $tunjangan_bpjs_kj = $dataKaryawan['tunjangan_bpjs_kj'];
    $tunjangan_shift = $dataKaryawan['tunjangan_shift'];
    $tunjangan_transport = $dataKaryawan['tunjangan_transport'];

    // Ambil data PTKP berdasarkan id_ptkp 
    $sql = "SELECT * FROM ptkp WHERE kode='$kode_ptkp'";
    $exec = mysqli_query($koneksi, $sql);
    $dataPtkp = mysqli_fetch_array($exec);


    // Lakukan kalkulasi potongan sesuai jenis insentif
    $potongan += $sp;
    $potongan += $potongan_sakit;
    $potongan += $potongan_izin;
    $potongan += $potongan_cuti;
    $potongan += $potongan_tk;
    $potongan += $potongan_bpjs_ks;
    $potongan += $potongan_bpjs_kj;
    $potongan += $potongan_diksar;
    $potongan += $potongan_lain;
    
    // Lakukan kalkulasi tunjangan sesuai jenis insentif
    $tunjangan += $tunjangan_shift;
    $tunjangan += $tunjangan_transport;
    $tunjangan += $tunjangan_dht;
    $tunjangan += $tunjangan_bpjs_ks;
    $tunjangan += $tunjangan_bpjs_kj;
    $tunjangan += $lembur_backup;
    $tunjangan += $lembur_holiday;
    $tunjangan += $lembur_reguler;
    $tunjangan += $lembur_lain;

    // Gaji sebulan kotor
    $sebulan = $gaji_pokok + $tunjangan - $potongan;
    
    // Gaji Setahun 
    $setahun = $sebulan * 12; 
    
    // Gaji bruto dalam setahun
    $bruto = $setahun;

    // Kalkulasi biaya jabatan untuk pegawai tetap
    if( $dataKaryawan['status_kerja'] == "Tetap" ) {
        $biaya_jabatan = $bruto * 0.05;
        $biaya_jabatan > 6000000 ? $biaya_jabatan = 6000000 : $biaya_jabatan = $biaya_jabatan;
        $neto = $bruto - $biaya_jabatan;
    } else if ( $dataKaryawan['status_kerja'] == "Kontrak") {
        $biaya_jabatan = 0;
        $neto = $bruto;
    }

    // Kalkulasi biaya PTKP
    $kena_pajak = $neto - $dataPtkp['ptkp'];
    if( $kena_pajak > 0 ) 
        $pph = itungPph($dataKaryawan['no_npwp'], $neto, $kena_pajak);

    // Kalkulasi Take Home Pay perbulan
    $thp = (($neto / 12) - ($pph / 12));

    // Masukan data ke dalam tabel gaji
    $sql = "INSERT INTO gaji (
                id_karyawan,
                id_periode,
                bonus,
                lembur_backup,
                lembur_holiday,
                lembur_reguler,
                lembur_lain,
                potongan_sakit,
                potongan_izin,
                potongan_cuti,
                potongan_tk,
                potongan_lain,
                potongan_diksar,
                potongan_sp,
                sebulan,
                setahun,
                bruto,
                biaya_jabatan,
                neto,
                pph,
                thp
            )
            VALUES (
                '$id',
                '$periode',
                '$bonus',
                '$lembur_backup',
                '$lembur_holiday',
                '$lembur_reguler',
                '$lembur_lain',
                '$potongan_sakit',
                '$potongan_izin',
                '$potongan_cuti',
                '$potongan_tk',
                '$potongan_lain',
                '$potongan_diksar',
                '$sp',
                '$sebulan',
                '$setahun',
                '$bruto',
                '$biaya_jabatan',
                '$neto',
                '$pph',
                '$thp'
            );";

            $insert = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

            if(mysqli_affected_rows($koneksi) > 0) {
                $_SESSION['insert_success'] == 'sukses';
                header('location: gaji.php');
            } else {
                $_SESSION['insert_success'] == 'gagal';
                header('location: gaji.php');
            }
}