<?php  

require_once '../../func/Database.php';
require_once '../../func/Data.php';

$type = $_POST['type'];

if ( $type == 'insert' ) {

	$name   = $_FILES["file"]["name"];
	$lokasi = $_FILES["file"]["tmp_name"];
	$upload = move_uploaded_file($_FILES["file"]["tmp_name"],$name);
	if($upload){
		set_include_path(get_include_path() . PATH_SEPARATOR . '../Classes/');
		include 'PHPExcel/IOFactory.php';


		// This is the file path to be uploaded.
		$inputFileName = $name; 
		try {
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}


		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


		for($i=2;$i<=$arrayCount;$i++){
			$a = ($allDataInSheet[$i]["A"]);
			$b = ($allDataInSheet[$i]["B"]);
			$c = ($allDataInSheet[$i]["C"]);

			if (dataTambah($a, $b ,$c)) {
				@unlink ("$inputFileName");

				ob_start();
			  include "data-view.php";
			  $html = ob_get_contents();
			  ob_end_clean();
			  
			  $response = array(
			    'status'=>'sukses'
			  );
			}else{
				$response = array(
			    'status'=>'gagal'
			  );
			}
		}
	}

}else if ( $_POST['type'] == 'delete' ) {

	if( dataHapus() ){
		
		ob_start();
	  include "data-view.php";
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