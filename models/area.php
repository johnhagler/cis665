<?php

/* CIS665 - PHP Project - ClimbIt Application
*	Team: John Hagler, Anna Chernyavskaya
* 	Date: March 24, 2013
*	Purpose: area.php -  Area class - contains methods and CRUD functions related to climbing 'Area'
* 	Uses: base.php, db.php
*/

require_once 'base.php'; //contains common methods
require_once 'db.php';//contains sql connection methods


class Area extends BaseModel {

	//declare class variables
	public $area;
	public $stonetype;


	//class constructor method
	function __construct() {
	}

	//method to retrieve a list of areas from the database - all areas stored in db
	public function list_areas() {

		//execute a sql query to return area data from the database
		$sql = "select AreaID, AreaName, AreaDescrShort, AreaCity, AreaState, StoneTypeName, ApproachTime
				from Area, StoneType 
				where Area.StoneTypeID = StoneType.StoneTypeID";

		//create a new data object
		$db = new Data();	

		//run a sql query and store results in $result variable
		$result = $db->run($sql);	

		//create "areas" array
		$areas = array();

		//loop thru query results and store in "area" array
		foreach ($result as $result) {

			$area = array (
				'areaId'=>$result['AreaID'],
				'name'=>$result['AreaName'],
				'descr'=>$result['AreaDescrShort'],
				'city'=>$result['AreaCity'],
				'state'=>$result['AreaState'],
				'stoneType' => $result['StoneTypeName'],
				'approachTime'=>$result['ApproachTime']
				);

			array_push($areas, $area);

		}//end of foreach loop


		$data = array('areas' => $areas);

		header('Content-type: application/json');//designate the content to be in JSON format
		echo json_encode($data);//display crags in JSON format
		
	}//end of list_areas method


}//end of class


?>