<?php
/* Database connection start */
include "../koneksi.php";
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'nama',
	1 => 'bulan',
	2 => 'tahun',
	3 => 'jumlah_sakit',
	4 => 'jumlah_izin',
	5 => 'jumlah_cuti',
	6 => 'jumlah_tk',
	7 => 'jumlah_backup',
	8 => 'jumlah_lembur_holiday',
	9 => 'jumlah_lembur_reguler'
);

// Ambil data absensi
$sql = "SELECT * FROM v_absensi";
$query=mysqli_query($conn, $sql) or die("ajaxin-grid-dataabsensi.php: get absensi 1");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

// Ubah data id_periode menjadi nama Bulan dan Tahun


if( !empty($requestData['search']['value']) ) {
	$sql = "SELECT * FROM v_absensi";
	$sql.=" WHERE nama LIKE '".$requestData['search']['value']."%' ";   
	$sql.=" OR bulan LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR tahun LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR jumlah_sakit LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR jumlah_izin LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR jumlah_cuti LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR jumlah_tk LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR jumlah_backup LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR jumlah_lembur_holiday LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR jumlah_lembur_reguler LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-dataabsensi.php: get absensi 2");
	$totalFiltered = mysqli_num_rows($query); 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajaxin-grid-dataabsensi.php: get absensi"); // again run query with limit
	
} else {	
	$sql = "SELECT * FROM v_absensi";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));   
	
}

// Membuat variabel array untuk menyimpan nama bulan
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

$data = array();
while( $row=mysqli_fetch_array($query) ) {
	$nestedData=array(); 

	$nestedData[] = $row["nama"];
    $nestedData[] = $bulan[$row['bulan']-1];
    $nestedData[] = $row["tahun"];
    $nestedData[] = $row["jumlah_sakit"];
    $nestedData[] = $row["jumlah_izin"];
    $nestedData[] = $row["jumlah_cuti"];
    $nestedData[] = $row["jumlah_tk"];
    $nestedData[] = $row["jumlah_backup"];
    $nestedData[] = $row["jumlah_lembur_holiday"];
    $nestedData[] = $row["jumlah_lembur_reguler"];
    $nestedData[] = '<td><center>
                     <a href="edit-absensi.php?id='.$row['id_absensi'].'"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-primary"> <i class="glyphicon glyphicon-edit"></i> Update Absensi</a>
				     <a href="delete-absensi.php?id='.$row['id_absensi'].'"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data absensi '.$row['nama'].'?\')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"> </i> </a>
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
