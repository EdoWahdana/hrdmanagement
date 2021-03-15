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
	2 => 'projek',
	3 => 'bulan',
	4 => 'tahun'
);

// getting total number records without any search
$sql = "SELECT * FROM v_gaji";
$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT * FROM v_gaji";
	$sql.=" WHERE no_karyawan LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nama LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR projek LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR bulan LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR tahun LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$totalFiltered = mysqli_num_rows($query);

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));
	
} else {	

	$sql = "SELECT * FROM v_gaji";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));   
	
}

// Membuat variabel array untuk menyimpan nama bulan
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

$data = array();
while( $row=mysqli_fetch_array($query) ) {
	$nestedData=array(); 

	$nestedData[] = $row["no_karyawan"];
    $nestedData[] = $row["nama"];
    $nestedData[] = $row["projek"];
    $nestedData[] = $bulan[$row["bulan"] - 1];
    $nestedData[] = $row["tahun"];
    $nestedData[] = '<td><center>
                     <a href="detail-gaji.php?id='.$row['id_gaji'].'"  data-toggle="tooltip" title="View Detail" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-search"></i> Detail </a>
				     <a href="gaji.php?aksi=delete&id='.$row['id_gaji'].'"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama'].'?\')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"> </i> </a>
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
