<?php
/* Database connection start */
include "koneksi.php";
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'nik',
    1 => 'nama', 
	2 => 'tanggal',
	3 => 'departemen',
	4 => 'jabatan',
	5 => 'status',
    6 => 'gapok',
    7 => 'bpjs',
    8 => 'lembur',
    9 => 'norek'
);

// getting total number records without any search
$sql = "SELECT nik, nama, tanggal, departemen, jabatan, status, gapok, bpjs, lembur, norek";
$sql.=" FROM gaji";
$query=mysqli_query($conn, $sql) or die("ajaxin-grid-data.php: get Gaji");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT nik, nama, tanggal, departemen, jabatan, status, gapok, bpjs, lembur, norek";
	$sql.=" FROM gaji";
	$sql.=" WHERE nik LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR nama LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR tanggal LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR departemen LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR jabatan LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR status LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR gapok LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR bpjs LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR lembur LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR norek LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-datagaji.php: get Gaji");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajaxin-grid-data.php: get Gaji"); // again run query with limit
	
} else {	

	$sql = "SELECT nik, nama, tanggal, departemen, jabatan, status, gapok, bpjs, lembur, norek";
	$sql.=" FROM gaji";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajaxin-grid-data.php: get Gaji");   
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["nik"];
    $nestedData[] = $row["nama"];
	$nestedData[] = $row["tanggal"];
	$nestedData[] = $row["departemen"];
	$nestedData[] = $row["jabatan"];
	$nestedData[] = $row["status"];
	$nestedData[] = $row["gapok"];
	$nestedData[] = $row["bpjs"];
	$nestedData[] = $row["lembur"];
	$nestedData[] = $row["norek"];
    $nestedData[] = '<td><center>
                     <a href="detail-gaji.php?id='.$row['nik'].'"  data-toggle="tooltip" title="View Detail" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-search"></i> </a>
                     <a href="edit-gaji.php?id='.$row['nik'].'"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-primary"> <i class="glyphicon glyphicon-edit"></i> </a>
				     <a href="gaji.php?aksi=delete&id='.$row['nik'].'"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama'].'?\')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"> </i> </a>
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
