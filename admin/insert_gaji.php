<?php

include('../conn.php');

session_start();

// Ini perhitungan pph berdasarkan data dari excel mas yandi
function itungPph($npwp, $neto, $kena_pajak) {
    if( $neto <= 150000000 ){
        if( $npwp == '' )
            $pph = ($kena_pajak * 0.05) * 0.2;
        else 
            $pph = $kena_pajak * 0.05;
    } else if( $neto > 150000000 && $neto <= 250000000 ) {
        if( $npwp == '' )
            $pph = ($kena_pajak * 0.15) * 0.2;
        else 
            $pph = $kena_pajak * 0.15;
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
    $id = $_POST['id_karyawan'];
    $periode = $_POST['periode'];
    $tanggal = $_POST['tanggal'];
    $bonus = $_POST['bonus'];
    $bpjs_ks = intval($_POST['bpjs_ks']);
    $bpjs_kj = intval($_POST['bpjs_kj']);
    $ph = $_POST['ph'];
    $potongan = 0;
    $tunjangan = 0;
    $pph;
    

    // Definisikan variabel untuk menyimpan data
    $dataKaryawan;
    $dataInsentif;

    // Ambil data insentif menggunakan id karyawan
    $sql = "SELECT * FROM karyawan_new WHERE id_karyawan='$id'";
    $exec = mysqli_query($koneksi, $sql);
    $dataKaryawan = mysqli_fetch_array($exec);

    // Definisikan variabel untuk menampung data gaji pokok karyawan
    $gaji_pokok = $dataKaryawan['gaji_pokok'];
    
    // Definisikan variabel yang berisi id untuk periode dan insentif
    $id_projek = $dataKaryawan['id_projek'];
    $id_role = $dataKaryawan['id_role'];
    $id_ptkp = $dataKaryawan['id_ptkp'];


    // Ambil data insentif berdasarkan id_projek dan id_role
    $sql = "SELECT * FROM insentif WHERE id_projek='$id_projek' AND id_role='$id_role'";
    $exec = mysqli_query($koneksi, $sql);
    $dataInsentif = mysqli_fetch_array($exec);

    // Ambil data absensi berdasarkan id_karyawan
    $sql = "SELECT * FROM absensi WHERE id_karyawan='$id'";
    $exec = mysqli_query($koneksi, $sql);
    $dataAbsensi = mysqli_fetch_array($exec);

    // Ambil data PTKP berdasarkan id_ptkp 
    $sql = "SELECT * FROM ptkp WHERE id_ptkp='$id_ptkp'";
    $exec = mysqli_query($koneksi, $sql);
    $dataPtkp = mysqli_fetch_array($exec);


    // Lakukan kalkulasi potongan sesuai jenis insentif
    $potongan += ($dataInsentif['sakit'] * $dataAbsensi['jumlah_sakit']);
    $potongan += ($dataInsentif['izin'] * $dataAbsensi['jumlah_izin']);
    $potongan += ($dataInsentif['cuti'] * $dataAbsensi['jumlah_cuti']);
    $potongan += ($dataInsentif['tk'] * $dataAbsensi['jumlah_tk']);
    
    // Lakukan kalkulasi tunjangan sesuai jenis insentif
    $tunjangan += ($dataInsentif['backup'] * $dataAbsensi['jumlah_backup']);
    $tunjangan += (($dataInsentif['lembur_holiday'] * $dataAbsensi['jumlah_lembur_holiday']) * floatval(number_format($ph, 1)));
    $tunjangan += ($gaji_pokok / 173) * ($dataAbsensi['jumlah_lembur_reguler'] * 2 - floatval(number_format('0.5', 1)));

    // Gaji sebulan kotor
    $sebulan = $dataKaryawan['gaji_pokok'] + $bpjs_ks + $bpjs_kj + $tunjangan - $potongan;
    
    // Gaji Setahun dan tambah dengan bonus/tantiem/gratifikasi
    $setahun = $sebulan * 12; 
    
    // Gaji bruto dalam setahun
    $bruto = $setahun + $bonus;

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

    // Masukan data ke dalam tabel gaji
    // $sql = "INSERT INTO gaji (
    //             id_karyawan,
    //             id_periode,
    //             tanggal,
    //             tunjangan,
    //             potongan,
    //             bonus,
    //             bpjs_ks,
    //             bpjs_kj,
    //             sebulan,
    //             setahun,
    //             bruto,
    //             biaya_jabatan,
    //             neto,
    //             pph
    //         )
    //         VALUES (
    //             '$id',
    //             '$periode',
    //             '$tanggal',
    //             '$tunjangan',
    //             '$potongan',
    //             '$bonus',
    //             '$bpjs_ks',
    //             '$bpjs_kj',
    //             '$sebulan',
    //             '$setahun',
    //             '$bruto',
    //             '$biaya_jabatan',
    //             '$neto',
    //             '$pph'
    //         );";

    //         $insert = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

    //         if(mysqli_affected_rows($koneksi) > 0) {
    //             $_SESSION['insert_success'] == 'sukses';
    //             header('location: gaji.php');
    //         } else {
    //             $_SESSION['insert_success'] == 'gagal';
    //             header('location: gaji.php');
    //         }
    
    // Debugging
    echo '<pre>';
    var_dump(
        "\n ID : " . $id,
        "\n Periode : " . $periode,
        "\n Tanggal : " . $tanggal,
        "\n Bonus : " . $bonus,
        "\n Kesehatan : " . $bpjs_ks,
        "\n Ketenagakerjaan : " . $bpjs_kj,
        "\n PH : " . $ph,
        "\n Potongan : " . $potongan,
        "\n Tunjangan : " . intval($tunjangan),
        "\n Sebulan : " . intval($sebulan),
        "\n Setahun :  " . intval($setahun),
        "\n bruto :  " . intval($bruto),
        "\n biaya jabatan :  " . intval($biaya_jabatan),
        "\n neto : " . intval($neto),
        "\n kena pajak : " . intval($kena_pajak),
        "\n PPH : " . intval($pph),
    );
    echo '<pre>';
}