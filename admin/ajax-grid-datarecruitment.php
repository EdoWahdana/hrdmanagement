<?php
/* Database connection start */
include "koneksi.php";
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'idpelamar',
    1 => 'namalengkap', 
	2 => 'alamat',
	3 => 'tanggal_interview',
	4 => 'nomorhp',
	5 => 'posisi',
    6 => 'status'
);

// getting total number records without any search
$sql = "SELECT idpelamar, namalengkap, alamat, tanggal_interview, nomorhp, posisi, status";
$sql.=" FROM recruitment";
$query=mysqli_query($conn, $sql) or die("ajaxin-grid-data.php: get Recruitment");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT idpelamar, namalengkap, alamat, tanggal_interview, nomorhp, posisi, status";
	$sql.=" FROM recruitment";
	$sql.=" WHERE idpelamar LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR idpelamar LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR namalengkap LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR alamat LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR tanggal_interview LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nomorhp LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR posisi LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR status LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-datarecruitment.php: get Recruitment");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajaxin-grid-data.php: get Recruitment"); // again run query with limit
	
} else {	

	$sql = "SELECT idpelamar, namalengkap, alamat, tanggal_interview, nomorhp, posisi, status";
	$sql.=" FROM recruitment";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajaxin-grid-data.php: get Recruitment");   
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["idpelamar"];
    $nestedData[] = $row["namalengkap"];
	$nestedData[] = $row["alamat"];
	$nestedData[] = $row["tanggal_interview"];
	$nestedData[] = $row["nomorhp"];
	$nestedData[] = $row["posisi"];
	$nestedData[] = $row["status"];
    $nestedData[] = '<td><center>
                     <a href="detail-recruitment.php?id='.$row['idpelamar'].'"  data-toggle="tooltip" title="View Detail" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-search"></i> </a>
                     <a href="edit-recruitment.php?id='.$row['idpelamar'].'"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-primary"> <i class="glyphicon glyphicon-edit"></i> </a>
				     <a href="recruitment.php?aksi=delete&id='.$row['idpelamar'].'"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['namalengkap'].'?\')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"> </i> </a>
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
