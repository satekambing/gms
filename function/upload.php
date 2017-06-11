<?php
$output_dir = "../files/";
require_once ('../config/koneksi.php');
if(isset($_FILES["myfile"]))
{
	$ret = array();
	// console.log('tes');
//	This is for custom errors;
/*	$custom_error= array();
	$custom_error['jquery-upload-file-error']="File already exists";
	echo json_encode($custom_error);
	die();
*/

  // $x = $_POST['tags']??'kosong';
	$error =$_FILES["myfile"]["error"];
	$label = "";
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData()
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{

 	 	$fileName = $_FILES["myfile"]["name"];
		$pecahfile= (explode(".", $fileName));
		$ext 			= $pecahfile[1];
		$nopol   =  $_POST['nopol'];
		if(isset($_POST['tags']) && !$_POST['tags'] == ""){
			$unik     = rand(0,999);
			$label = $_POST['tags'];
			// $fileName = '~'.$label.'.'.$ext;
			$fileName = $nopol.'-ada-'.$label.'.'.$ext;

      if(!file_exists($output_dir.$nopol)){
				mkdir($output_dir.$nopol, 0777);
				$fileName = $nopol.DIRECTORY_SEPARATOR.$label.'.'.$ext;
			}
		}
 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
    	$ret[]= $fileName;

			$sql  = "INSERT INTO foto_kendaraan (label, nama_file, nopol, folder) ";
			$sql .= "VALUES ('$label', '$fileName','$nopol','$nopol')";
			mysqli_query($koneksi, $sql);
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	$fileName = $_FILES["myfile"]["name"][$i];
			$ext 			= $_FILES["myfile"]["type"][$i];

			if(isset($_POST['tags'][$i])){
				$fileName = $_POST['tags'][$i].$ext;
			}
		move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.'x'.$fileName);
	  	$ret[]= $fileName;
	  }

	}
    echo json_encode($ret);
 }
 ?>
