<?php 

include "koneksi.php";

$requestData = $_REQUEST;

$columns = [
    0 => 'projek',
    1 => 'role',
    2 => 'sakit',
    3 => 'izin',
    4 => 'cuti',
    5 => 'tk',
    6 => 'bakcup',
    7 => 'lembur_holiday',
];

// Ambil semua data dari tabel insentif yang INNER JOIN dengan tabel projek dan role untuk ditampilkan ke dalam Datatable
$sql = "SELECT id_insentif, projek, role, sakit, izin, cuti, tk, backup, lembur_holiday FROM v_insentif";
$exec = mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($exec);
$totalFiltered = $totalData;

if(!empty($requestData['search']['value'])) {
    $sql ="SELECT id_insentif, projek, role, sakit, izin, cuti, tk, backup, lembur_holiday FROM v_insentif";
    $sql.=" WHERE projek LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR role LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR sakit LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR izin LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR cuti LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR tk LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR backup LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR lembur_holiday LIKE '".$requestData['search']['value']."%' ";
    $exec = mysqli_query($conn, $sql);
    $totalFiltered = mysqli_num_rows($exec);

    $sql .= " ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $exec = mysqli_query($conn, $sql) or die("ajax-grid-rulegaji.php: get Insentif");    
} else {
    $sql = "SELECT id_insentif, projek, role, sakit, izin, cuti, tk, backup, lembur_holiday FROM v_insentif";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $exec = mysqli_query($conn, $sql);
}

$data = array();
while($row = mysqli_fetch_array($exec)) {
    $nestedData=array(); 
    
	$nestedData[] = $row["projek"];
    $nestedData[] = $row["role"];
	$nestedData[] = $row["sakit"];
	$nestedData[] = $row["izin"];
	$nestedData[] = $row["cuti"];
	$nestedData[] = $row["tk"];
	$nestedData[] = $row["backup"];
	$nestedData[] = $row["lembur_holiday"];
    $nestedData[] = '<td><center>
                     <a href="detail-karyawan.php?id='.$row['id_insentif'].'"  data-toggle="tooltip" title="View Detail" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-search"></i> </a>
                     <a href="edit-karyawan.php?id='.$row['id_insentif'].'"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-primary"> <i class="glyphicon glyphicon-edit"></i> </a>
				     <a href="delete_karyawan.php?aksi=delete&id='.$row['id_insentif'].'"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['projek'].' dengan role '.$row['role'].'?\')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"> </i> </a>
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

