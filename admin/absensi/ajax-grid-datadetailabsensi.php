<?php
/* Database connection start */
include "../koneksi.php";
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

// Ambil varriabel input hidden dari file detail-absensi
$id_karyawan = $_POST['id_karyawan'];
$id_periode = $_POST['id_periode'];

$columns = array( 
// datatable column index  => database column name
	0 => 'kategori',
	1 => 'jumlah',
	2 => 'tanggal',
);

// Ambil data absensi
$sql = "SELECT ka.kategori, a.jumlah, a.tanggal 
        FROM absensi a, kategori_absensi ka
        WHERE a.id_karyawan='$id_karyawan' AND a.id_periode='$id_periode' AND a.id_kategori_absensi=ka.id_kategori_absensi";
$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

// Ubah data id_periode menjadi nama Bulan dan Tahun


if( !empty($requestData['search']['value']) ) {
    $sql = "SELECT ka.kategori, a.jumlah, a.tanggal
            FROM absensi a, kategori_absensi ka";     
	$sql.=" WHERE ka.kategori LIKE '".$requestData['search']['value']."%' ";      
	$sql.=" OR a.tanggal LIKE '".$requestData['search']['value']."%' ";      
	$query=mysqli_query($conn, $sql) or die("ajax-grid-dataabsensi.php: get absensi 2");
	$totalFiltered = mysqli_num_rows($query); 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajaxin-grid-dataabsensi.php: get absensi"); // again run query with limit
	
} else {	
	$sql = "SELECT ka.kategori, a.jumlah, a.tanggal 
            FROM absensi a, kategori_absensi ka
            WHERE a.id_karyawan='$id_karyawan' AND a.id_periode='$id_periode' AND a.id_kategori_absensi=ka.id_kategori_absensi";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));   
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {
	$nestedData=array(); 

	$nestedData[] = $row["kategori"];
	$nestedData[] = $row["jumlah"];
	$nestedData[] = $row["tanggal"];
    
	$data[] = $nestedData;
    
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
