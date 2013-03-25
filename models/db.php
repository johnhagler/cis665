<?php


/* CIS665 - PHP Project - ClimbIt Application
*	Team: John Hagler, Anna Chernyavskaya
* 	Date: March 24, 2013
*	Purpose: db.php - Data class - contains methods to connect to sql and retrieve data from the ClimbItDB database
* 	Uses: user.php, area.php, crag.php, route.php
*	Extends: 
*/


require_once 'user.php';
require_once 'area.php';
require_once 'crag.php';
require_once 'route.php';



class Data {


	
	public function run($sql) {
		return $this->run_remote_query($sql);
	} //end of run() method



	function run_remote_query($sql) {

		$url = "http://www.business.colostate.edu/john.l.hagler11/db.php";
		// create a new cURL resource
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    	curl_setopt($ch, CURLOPT_POSTFIELDS, array("sql"=>$sql));

		$content = curl_exec($ch);

		// close cURL resource, and free up system resources
		curl_close($ch);
		//print_r($content);
		return json_decode($content,true);

	}//end of run_remote_query method


} //end of class Data

?>