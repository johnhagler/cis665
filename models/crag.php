<?php

require_once 'base.php';
require_once 'db.php';

class Crag extends Area {


	function __construct() {

	}

	public function list_crags_by_area($area) {

		//execute sql query on the DB to get crag data
		$sql = "select * from Crag"; 


		$db = new Data(); //create new Data object

		$results = $db -> run($sql); //execute sql query and return results to "results"

		$crags = array();//create crags array

		foreach ($results as $result) {
			$crag = array (
				'cragId' => $result['CragID'],
				'cragName' => $result['CragName'],
				'cragDescr' => $result['CragDescr']
				);


		array_push($crags, $crag);

		} //close foreach loop

		$data = array('crags' => $crags);//assign the result of array to $data



		header('Content-type: application/json');//designate the content to be in JSON format
		echo json_encode($data); //display crags in JSON format
		
	}//end of list_crags_by_area method
}//end of class


?>