<?php  

require_once '../../func/Database.php';
require_once '../../func/Admin.php';

if ( $_POST['type'] == 'insert' ) {
	$nama = @$_POST['nama'];
	$user = trim(@$_POST['user']);
	$pass = trim(@$_POST['pass']);
	$mail = trim(@$_POST['mail']);

	if(cek_nama($user)){
		if (adminTambah($nama, $user, $pass, $mail)) {
			ob_start();
		  include "admin-view.php";
		  $html = ob_get_contents();
		  ob_end_clean();
		  
		  $response = array(
				'status'=>'sukses',
				'html'=>$html
		  );
		}else{
			$response = array(
				'status'=>'gagal'
		  );
		}
	}else{
		$response = array(
			'status'=>'nama'
	  );
	}

}else if ( $_POST['type'] == 'delete' ) {

	$id = $_POST['id'];

	if($id != 1){
		if (adminHapus($id)) {
		  ob_start();
		  include "admin-view.php";
		  $html = ob_get_contents();
		  ob_end_clean();
		  
		  $response = array(
				'status'=>'sukses',
				'html'=>$html
		  );
		}else{
			$response = array(
				'status'=>'gagal'
		  );
		}
	}else{
		$response = array(
			'status'=>'gagal'
	  );
	}

}else if ( $_POST['type'] == 'update' ) {

	$id   = @$_POST['id'];
	$nama = @$_POST['nama'];
	$user = trim(@$_POST['user']);
	$passL= trim(@$_POST['passL']);
	$passB= trim(@$_POST['passB']);
	$mail = trim(@$_POST['mail']);

	$pass = adminTampilID($id);

	if(password_verify($passL, $pass)){
		if(adminUbah($nama, $user, $passB, $mail, $id)){
			ob_start();
		  include "admin-view.php";
		  $html = ob_get_contents();
		  ob_end_clean();
		  
		  $response = array(
				'status'=>'sukses',
				'html'=>$html
		  );
		}else{
			$response = array(
				'status'=>'gagal'
		  );
		}
	}else{
	  $response = array(
			'status'=>'pass'
	  );
	}

}

echo json_encode($response);
?>