<?php
/* Database connection start */
include "koneksi.php";
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'no_karyawan',
	1 => 'nama',
	2 => 'gaji_pokok',
	3 => 'projek'
);

// getting total number records without any search
$sql = "SELECT id_karyawan, no_karyawan, nama, gaji_pokok, projek";
$sql.=" FROM v_karyawan";
$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT id_karyawan, no_karyawan, nama, gaji_pokok, projek";
	$sql.=" FROM v_karyawan";
	$sql.=" WHERE no_karyawan LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nama LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR gaji_projek LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR projek LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$totalFiltered = mysqli_num_rows($query);

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));
	
} else {	

	$sql = "SELECT id_karyawan, no_karyawan, nama, gaji_pokok, projek";
	$sql.=" FROM v_karyawan";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));   
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {
	$nestedData=array(); 

	$nestedData[] = $row["no_karyawan"];
    $nestedData[] = $row["nama"];
    $nestedData[] = 'Rp. '.strrev(implode('.',str_split(strrev(strval($row["gaji_pokok"])),3)));
    $nestedData[] = $row["projek"];
    $nestedData[] = '<td><center>
                     <a href="detail-gaji.php?id='.$row['id_karyawan'].'"  data-toggle="tooltip" title="View Detail" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-search"></i> </a>
                     <a href="edit-gaji.php?id='.$row['id_karyawan'].'"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-primary"> <i class="glyphicon glyphicon-edit"></i> </a>
				     <a href="gaji.php?aksi=delete&id='.$row['id_karyawan'].'"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama'].'?\')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"> </i> </a>
	                 </center></td>';		
	
	$data[] = $nestedData;
    
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data
			);

echo json_encode($json_data);

?>
