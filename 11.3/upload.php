<?php
date_default_timezone_set('PRC');
if (!isset($_POST['act']) || $_POST['act']!='videoUp') {
	echo json_encode(array(
			'status'=>0
		));
}
$files=$_FILES['video'];
$type=$files['type'];
$b=explode('/',$type);

$paths='uploads/'.uniqid().".".$b[1];


if(move_uploaded_file($files['tmp_name'],$paths)){
	echo json_encode(array(
			'status'=>1,
			'path'=>$paths,
			'name'=>$files['name']
		));
}else{
		echo json_encode(array(
			'status'=>0
		));
}