<?php  

// Jumlah Pemilih
function JumlahPemilih(){
	$result = mysqli_num_rows(dataTampil());

	return $result;
}

// Sudah Memilih
function sudahMemilih(){
	global $mysqli;

	$query = "SELECT * FROM data WHERE status='1'";
	$result= $mysqli->query($query);

	return mysqli_num_rows($result);
}

// Belum Memilih
function belumMemilih(){
	global $mysqli;

	$query = "SELECT * FROM data WHERE status='0'";
	$result= $mysqli->query($query);

	return mysqli_num_rows($result);
}

?>