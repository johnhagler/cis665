<?php


function run_remote_query($sql) {
	// create a new cURL resource
	$ch = curl_init();

	// set URL and other appropriate options
	curl_setopt($ch, CURLOPT_URL, "http://localhost:8888/cis665/?q=list_areas");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	// grab URL and pass it to the browser
	$content = curl_exec($ch);

	// close cURL resource, and free up system resources
	curl_close($ch);

	echo '<pre>';
	echo $content . '<br>';

	print_r(json_decode($content,true));

	echo '</pre>';


}

run_remote_query();


?>