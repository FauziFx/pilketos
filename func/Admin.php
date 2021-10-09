<?php  

// Tambah Admin
function adminTambah($nama, $user, $pass, $mail){
	global $mysqli;

	$pass = password_hash($pass, PASSWORD_DEFAULT);
	$sql = $mysqli->prepare("INSERT INTO admin (nama, username, password, email) VALUES (?, ?, ?, ?)");
	$sql->bind_param('ssss', $nama, $user, $pass, $mail);

	return $sql->execute();
}

// Tampil admin
function adminTampil(){
	global $mysqli;

	$query = "SELECT * FROM admin";
	$result = $mysqli->query($query);

	return $result;
}

function adminTampilSession($session){
	global $mysqli;

	$query = "SELECT * FROM admin WHERE username='$session'";
	$result = $mysqli->query($query);
	$results = mysqli_fetch_assoc($result)['nama'];

	return $results;
}

function adminTampilID($id){
	global $mysqli;

	$query = "SELECT * FROM admin WHERE id='$id'";
	$result = $mysqli->query($query);
	$results = mysqli_fetch_assoc($result);

	return $results['password'];
}

// Edit Admin
function adminUbah($nama, $user, $passB, $mail, $id){
	global $mysqli;

	$passB = password_hash($passB, PASSWORD_DEFAULT);
	$sql = $mysqli->prepare("UPDATE admin SET nama=?, username=?, password=?, email=? Where id=?");
	$sql->bind_param('ssssi', $nama, $user, $passB, $mail, $id);

	return $sql->execute();
}

// Hapus Admin
function adminHapus($id){
	global $mysqli;

	$sql = $mysqli->prepare("DELETE FROM admin WHERE id=? AND status=?");
	$sql->bind_param('ii', $id, $status);
	$status = 0;

	return $sql->execute();
}

//Uji nama kembar
function cek_nama($user){
	global $mysqli;

	$query = "SELECT * FROM admin WHERE username='$user'";
	$result = $mysqli->query($query);
	if($result){
		if(mysqli_num_rows($result) == 0) return true;
		else return false;
	}
}

//Login
function user_admin($user){
	global $mysqli;

	$query = "SELECT * FROM admin WHERE username='$user'";
	if($result = $mysqli->query($query)){
		if(mysqli_num_rows($result) != 0) return true;
		else return false;
	}
}

function pass_admin($user, $pass){
	global $mysqli;

	$query  = "SELECT password FROM admin WHERE username='$user'";
	$result = $mysqli->query($query);
	$hash   = mysqli_fetch_assoc($result)['password'];

	if(password_verify($pass, $hash)) return true;
	else return false;
}

?>