<?php  

require_once '../../func/Database.php';
require_once '../../func/Calon.php';

$nama       = @$_POST['nama'];
$kelas      = @$_POST['kelas'];
$organisasi = @$_POST['organisasi'];
$visi       = @$_POST['visi'];
$misi       = @$_POST['misi'];

$foto     = @$_FILES['foto']['name'];
$tmp      = @$_FILES['foto']['tmp_name'];
$fotobaru = date('dmYHis').$foto;
$path       = '../../assets/img/Calon/'.$fotobaru;

if ( $_POST['type'] == 'insert' ) {

	if (calonTambah($nama, $kelas, $organisasi, $visi, $misi, $fotobaru)) {
		move_uploaded_file($tmp, $path);

		ob_start();
		include "calon-view.php";
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

}else if( $_POST['type'] == 'update' ) {

	$_id   = @$_POST['data-id'];
	$_foto = @$_POST['data-foto'];

	if (!empty($foto)) {
		if (calonEdit1($nama, $kelas, $organisasi, $visi, $misi, $fotobaru, $_id)) {
			$file = '../../assets/img/Calon/'.$_foto;
			if(is_file($file)) unlink($file);
			move_uploaded_file($tmp, $path);

			ob_start();
			include "calon-view.php";
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
		if (calonEdit2($nama, $kelas, $organisasi, $visi, $misi, $_id)) {
			ob_start();
			include "calon-view.php";
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
	}

}else if( $_POST['type'] == 'delete' ){

	$_id   = @$_POST['data-id'];
	$_foto = @$_POST['data-foto'];

	if (calonHapus($_id)) {
		$file = '../../assets/img/Calon/'.$_foto;
		if(is_file($file)) unlink($file);

		ob_start();
		include "calon-view.php";
		$html = ob_get_contents();
		ob_end_clean();
		
		$response = array(
		'status'=>'sukses',
		'html'=>$html
		);
	}

}else if( $_POST['type'] == 'deleteAll' ){

	if(calonHapusSemua()){
		$files = glob('../../assets/img/Calon/*');

		foreach ($files as $file) {
			if(is_file($file)) unlink($file);
		}

		ob_start();
		include "calon-view.php";
		$html = ob_get_contents();
		ob_end_clean();
		
		$response = array(
		'status'=>'sukses',
		'html'=>$html
		);
	}

}

echo json_encode($response);
?>