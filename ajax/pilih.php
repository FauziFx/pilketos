<?php  
session_start();

require_once '../func/Database.php';
require_once '../func/Calon.php';
require_once '../func/Pilih.php';

if ($_POST['type'] == 'login') {
  
  $nis  = $_POST['nis'];
  $nama = $_POST['nama'];

  if (loginUser($nis, $nama)) {
    $response = array(
      'status'=>'ada'
    );
    $_SESSION['user'] = $nama;
  }else{
    $response = array(
      'status'=>'tidak ada'
    );
  }

}else if($_POST['type'] == 'pilih'){

  $id_calon  = $_POST['id_calon'];
  $session = $_SESSION['user'];
  
  if(pilih($session, $id_calon)){
    logout();
    $response = array(
      'status'=>'sukses'
    );
  }else{
    $response = array(
      'status'=>'gagal'
    );
  }

}

echo json_encode($response);
?>