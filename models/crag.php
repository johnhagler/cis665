<?php

<<<<<<< HEAD
require_once 'base.php';
require_once 'db.php';
=======

>>>>>>> mass commit

/* CIS665 - PHP Project - ClimbIt Application
*	Team: John Hagler, Anna Chernyavskaya
* 	Date: March 24, 2013
*	Purpose: crag.php - Crag class - contains methods and CRUD functions related to climbing 'Crag' (tier 2)
* 	Uses: base.php, db.php
*	Extends: Area
*/


require_once 'base.php'; //contains common methods
require_once 'db.php'; //contains sql connection methods

<<<<<<< HEAD
	function __construct() {
=======

class Crag extends Area {

>>>>>>> mass commit

	//class constructor
	function __construct() { 
	}

<<<<<<< HEAD
	public function list_crags_by_area($area) {

		//execute sql query on the DB to get crag data
		$sql = "select * from Crag"; 
=======
	//method to generate a listing of crags from the sql db based on Area ID
	public function list_crags_by_area($area) { 

		//execute sql query on the DB to get crag data
		$sql = "select * from Crag where AreaID = $area"; 
>>>>>>> mass commit


		$db = new Data(); //create new Data object

		$results = $db -> run($sql); //execute sql query and return results to "results"

		$crags = array();//create crags array

		foreach ($results as $result) {
			$crag = array (
				'cragId' => $result['CragID'],
				'cragName' => $result['CragName'],
				'cragDescr' => $result['CragDescr']
				);

<<<<<<< HEAD

		array_push($crags, $crag);
=======
		array_push($crags, $crag); //stack the array
>>>>>>> mass commit

		} //close foreach loop

		$data = array('crags' => $crags);//assign the result of array to $data


<<<<<<< HEAD

=======
>>>>>>> mass commit
		header('Content-type: application/json');//designate the content to be in JSON format
		echo json_encode($data); //display crags in JSON format
		
	}//end of list_crags_by_area method
<<<<<<< HEAD
=======

	
>>>>>>> mass commit
}//end of class


?>