<?php


$files_string = $_POST['files'];

$dir = 'uploads';

$file_name = array();

if(is_dir($dir)){
	if($open = opendir($dir)){
		while (($f = readdir($open)) !== false) {
			//echo "\n+".$f."+\n";
			array_push($file_name, $f);
		}
		closedir($open);
	}
}


$json = json_decode($files_string);

$item = array("id","onserver");

$files = array();
foreach ($json as $json_item) {
	if(in_array($json_item->fileHash, $file_name)){
		$value = array($json_item->fileId,true);
	}else{
		$value = array($json_item->fileId,false);
	}
	
	$temp = array_combine($item, $value);
	array_push($files, $temp);
}

$return = array(
	'files' => $files
	);

echo json_encode($return);
?>