<?php  

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'dbpilketos';

$mysqli = new mysqli($host, $user, $pass, $db);

if($mysqli->connect_errno){
	echo $mysqli->connect_error;
}

?>