<?php

require_once("koneksi.php");

$id = $_POST['id'];

$sql = "SELECT * FROM absensi WHERE id_karyawan='$id'";
$data = mysqli_fetch_array(mysqli_query($conn, $sql));

var_dump(json_encode($data));