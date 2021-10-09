<?php  

// Tampil
function dataTampil(){
	global $mysqli;

	$query  = "SELECT * FROM data";
	$result = $mysqli->query($query);

	return $result;
}

// Tambah
function dataTambah($a, $b ,$c){
	global $mysqli;

	$sql = $mysqli->prepare("INSERT INTO data (nis, nama, kelas, status) VALUES (?, ?, ?, ?)");
	$sql->bind_param('sssi', $a, $b ,$c, $s);
	$s = 0;

	return $sql->execute();
}

// Hapus
function dataHapus(){
	global $mysqli;

	$sql = $mysqli->prepare("DELETE FROM data");
	
	return $sql->execute();
}

?>