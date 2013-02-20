<?php

require_once '../models/db.php';

$db = new Data();

$files = list_files('.','.sql');

$drops = array();
$creates = array();
$inserts = array();


echo '<pre>';

foreach($files as $file) {
	
	if (strpos($file, 'drop') == true) {
		array_push($drops, $file);
	} else if (strpos($file, 'create') == true) {
		array_push($creates, $file);
	} else if (strpos($file, 'insert') == true) {
		array_push($inserts, $file);
	}
	
}

echo 'Dropping tables' . PHP_EOL;
foreach($drops as $drop) {
	echo '     ' . $drop . PHP_EOL;
	$db->run(list_file_contents($drop));
}

sleep(5);

echo 'Creating tables' . PHP_EOL;
foreach($creates as $create) {
	echo '     ' . $create . PHP_EOL;
	$db->run(list_file_contents($create));
}

sleep(5);

echo 'Inserting records' . PHP_EOL;
foreach($inserts as $insert) {
	echo '     ' . $insert . PHP_EOL;
	$db->run(list_file_contents($insert));
}


echo '</pre>';

function list_files($dir, $ext) {
	$files = array();
	if ($handle = opendir($dir)) {
	    while (false !== ($entry = readdir($handle))) {

	        if ($entry != "." && $entry != "..") {
	        	
	        	if (isset($ext)) {
	        		$ext_len = strlen($ext);
	        		if (substr($entry,strlen($entry)-$ext_len,$ext_len) == $ext) {
	        			array_push($files, $dir . '/' . $entry);
	        		}

	        	} else {
	        		array_push($files, $dir . '/' . $entry);
	        	}

	        }
	    }
	    closedir($handle);
	}
	return $files;
}



function list_file_contents($file_name) {

	$file = fopen($file_name, "r");

	while(!feof($file))  {
		$contents = $contents . fgets($file) . PHP_EOL;
		
	}
	fclose($file);

	return $contents;

}

?>