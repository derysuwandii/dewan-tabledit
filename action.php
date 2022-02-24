<?php  
include 'koneksi.php';

$input = filter_input_array(INPUT_POST);

$nama_lengkap = mysqli_real_escape_string($db1, $input["nama_lengkap"]);
$alamat = mysqli_real_escape_string($db1, $input["alamat"]);
$jenkel = mysqli_real_escape_string($db1, $input["jenkel"]);
$jabatan = mysqli_real_escape_string($db1, $input["jabatan"]);
$umur = mysqli_real_escape_string($db1, $input["umur"]);
$id = mysqli_real_escape_string($db1, $input["id"]);

if($input["action"] === 'edit'){
	$query = "UPDATE tbl_karyawan SET nama_lengkap=?, alamat=?, jenkel=?, jabatan=?, umur=? WHERE id=?";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param('sssssi', $nama_lengkap, $alamat, $jenkel, $jabatan, $umur, $id);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM tbl_karyawan WHERE id=?";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param('i', $id);
	$dewan1->execute();
}

echo json_encode($input);
?>