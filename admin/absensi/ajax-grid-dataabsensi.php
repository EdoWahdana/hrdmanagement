<?php
/* Database connection start */
include "../koneksi.php";
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'no_karyawan',
    1 => 'nama', 
	2 => 'projek',
	3 => 'bulan',
	4 => 'tahun',
);

// getting total number records without any search
$sql = "SELECT id_karyawan, id_periode, no_karyawan, nama, projek, bulan, tahun";
$sql.=" FROM v_absensi";
$query = mysqli_query($conn, $sql) or die("ajaxin-grid-data.php: get Karyawan");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) { 
	// if there is a search parameter
	$sql = "SELECT id_karyawan, id_periode, no_karyawan, nama, projek, bulan, tahun";
	$sql.=" FROM v_absensi";
	$sql.=" WHERE no_karyawan LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nama LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR projek LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get Karyawan");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajaxin-grid-data.php: get Karyawan"); // again run query with limit
	
} else {	

	$sql = "SELECT id_karyawan, id_periode, no_karyawan, nama, projek, bulan, tahun";
	$sql.=" FROM v_absensi";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajaxin-grid-data.php: get Karyawan");   
	
}

// Membuat variabel array untuk menyimpan nama bulan
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["no_karyawan"];
	$nestedData[] = $row["nama"];
	$nestedData[] = $row["projek"];
	$nestedData[] = $bulan[$row["bulan"] - 1];
	$nestedData[] = $row["tahun"];
    $nestedData[] = '<td><center>
					 <a href="detail-absensi.php?idKaryawan='.$row['id_karyawan'].'&idPeriode='.$row['id_periode'].'"  data-toggle="tooltip" title="Detail" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-search"></i> Detail </a>
	                 </center></td>';		
	
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
