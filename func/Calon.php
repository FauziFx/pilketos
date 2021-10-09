<?php  

// Tampil
function calonTampil(){
	global $mysqli;

	$query  = "SELECT * FROM calon";
	$result = $mysqli->query($query) ;

	return $result;
}

// Tambah
function calonTambah($nama, $kelas, $organisasi, $visi, $misi, $fotobaru){
	global $mysqli;

	$sql = $mysqli->prepare("INSERT INTO calon (nama, kelas, organisasi, visi, misi, foto) VALUES (?, ?, ?, ?, ?, ?)");
	$sql->bind_param('ssssss', $nama, $kelas, $organisasi, $visi, $misi, $fotobaru);

	return $sql->execute();
}

// Ubah Edit
function calonEdit1($nama, $kelas, $organisasi, $visi, $misi, $fotobaru, $_id){
	global $mysqli;

	$sql = $mysqli->prepare("UPDATE calon SET nama=?, kelas=?, organisasi=?, visi=?, misi=?, foto=? WHERE id=?");
	$sql->bind_param('ssssssi', $nama, $kelas, $organisasi, $visi, $misi, $fotobaru, $_id);

	return $sql->execute();
}

function calonEdit2($nama, $kelas, $organisasi, $visi, $misi, $_id){
	global $mysqli;

	$sql = $mysqli->prepare("UPDATE calon SET nama=?, kelas=?, organisasi=?, visi=?, misi=? WHERE id=?");
	$sql->bind_param('sssssi', $nama, $kelas, $organisasi, $visi, $misi, $_id);

	return $sql->execute();
}

// Hapus
function calonHapus($_id){
	global $mysqli;

	$sql = $mysqli->prepare("DELETE FROM calon WHERE id=?");
	$sql->bind_param('i', $_id);

	return $sql->execute();
}

// Hapus
function calonHapusSemua(){
	global $mysqli;

	$sql = $mysqli->prepare("DELETE FROM calon");
	
	return $sql->execute();
}

?>