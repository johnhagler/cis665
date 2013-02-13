<?php
require_once 'user.php';
require_once 'area.php';
require_once 'crag.php';
require_once 'route.php';

class Data {

	
	public $servername;
	public $username;
	public $password;
	public $database_name;


	public function __construct() {
		// define connection parameters
		$this->servername = '?';
		$this->username = 'climber';
		$this->password = 'secret';
		
		$this->database_name = 'CLIMBITDB';

	}


	public function run($sql) {

		$link = mssql_connect($servername, $username, $password);

		if (!$link || mssql_select_db($database_name, $link)) {
		    die('Something went wrong while connecting to MSSQL');
		}

		$statement = mssql_query($sql);
		$result = mssql_fetch_array($statement);

		mssql_free_result($statement);

		mssql_close($link);

	}

	public function load($results, $class) {
		$objects = array();


		foreach($results as $result) {
			$class_name = get_class($class);
						
			if ($class_name == 'User') {
				$object = new User();	
			}
			if ($class_name == 'Area') {
				$object = new Area();	
			}
			if ($class_name == 'Crag') {
				$object = new Crag();	
			}
			if ($class_name == 'Route') {
				$object = new Route();	
			}
			
			foreach (BaseModel::getClassProperties($class) as $prop) {

				try {
					$name = $prop->getName();
					$value = $result[$name];
					$prop->setValue($object,$value);
				} catch (Exception $e) {
					
				}
			
			}
			
			array_push($objects, $object);
		}

		if (count($objects) == 1) {
			return $objects[0];
		} else {
			return $objects;	
		}
		

	}



}

//Defined error handler to allow error to pass
set_error_handler('exceptions_error_handler');

function exceptions_error_handler($severity, $message, $filename, $lineno) {
  if (error_reporting() == 0) {
    return;
  }
  if (error_reporting() & $severity) {
    //throw new ErrorException($message, 0, $severity, $filename, $lineno);
  }
}





function list_areas() {
	$data = array ('areas'=>
		array(
			array(
				'name'=>'Central Oregon'
				),
			array(
				'name'=>'Northern Cali'
				),
			array(
				'name'=>'Central Cali'
				),
			)
		);
	header('Content-type: application/json');
	echo json_encode($data);
}

function list_crags_by_area($area) {
	if ($area == 'Central Oregon') {
		$data = array ('crags'=>
		array(
			array(
				'name'=>'Stein\'s Piller'
				),
			array(
				'name'=>'Dry Creek Canyon'
				),
			array(
				'name'=>'Smith Rock'
				),
			)
		);
	}

	if ($area == 'Northern Cali') {
		$data = array ('crags'=>
		array(
			array(
				'name'=>'Sea Crag'
				),
			array(
				'name'=>'Castle Rock'
				),
			array(
				'name'=>'Bidwell Park'
				),
			)
		);
	}

	if ($area == 'Central Cali') {
		$data = array ('crags'=>
		array(
			array(
				'name'=>'Cabrillo Peak'
				),
			array(
				'name'=>'Pirates Cove'
				),
			array(
				'name'=>'Twin Rocks'
				),
			)
		);
	}
	
	header('Content-type: application/json');
	echo json_encode($data);
}

function list_routes_by_crag($crag) {
	
	$data = array ('routes'=>
	array(
		array(
			'name'=>'Route A' . rand(1,9)
			),
		array(
			'name'=>'Route B' . rand(1,9)
			),
		array(
			'name'=>'Route C' . rand(1,9)
			),
		)
	);
	
	
	header('Content-type: application/json');
	echo json_encode($data);
}

function list_route_details($route) {
	$data = array ('name'=>$route);
	
	header('Content-type: application/json');
	echo json_encode($data);
}


function popular_routes() {
	$data = array ( 'routes' =>
		array (
			array(
				'area'=>'Central Oregon',
				'crag'=>'Smith Rock',
				'route'=>'Route A'
				),
			array(
				'area'=>'Central Oregon',
				'crag'=>'Smith Rock',
				'route'=>'Route B'
				),
			array(
				'area'=>'Northern Cali',
				'crag'=>'Blackstone',
				'route'=>'Sunriser'
				)
			)
		);
	header('Content-type: application/json');
	echo json_encode($data);
}
function new_routes() {
	$data = array ( 'routes' =>
		array (
			array(
				'area'=>'Northern Cali',
				'crag'=>'Blackstone',
				'route'=>'Sunriser'
				),
			array(
				'area'=>'Central Oregon',
				'crag'=>'Smith Rock',
				'route'=>'Snake run'
				),
			array(
				'area'=>'Colorado',
				'crag'=>'Red Rocks',
				'route'=>'Crimson Peak'
				)
			)
		);
	header('Content-type: application/json');
	echo json_encode($data);
}

function list_routes() {

	$data = array (
		'cols' => 
			array(
				array(
					'name' => 'area',
					'title' => 'Area',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'crag',
					'title' => 'Crag',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'route',
					'title' => 'Route',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'stoneType',
					'title' => 'Stone Type',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'approachTime',
					'title' => 'Time to Approach',
					'sortStyle' => 'numeric'
				)
			),
		'rows' =>
			array (
				array (
					'area' => 'Central Oregon',
					'crag' => 'Smith Rock',
					'route' => 'Route A',
					'routeId' => '625c65a3-d31c-4799-bd9b-62a53da06f68',
					'stoneType' => 'Sandstone',
					'approachTime' => 30
				),
				array (
					'area' => 'Oregon Coast',
					'crag' => 'Black Rock',
					'route' => 'To the Top!',
					'routeId' => 'c3aa69be-8158-459d-9c96-75adc5544615',
					'stoneType' => 'Granite',
					'approachTime' => 12
				),
				array (
					'area' => 'Central Oregon',
					'crag' => 'Smith Rock',
					'route' => 'Route B',
					'routeId' => 'b7e02fa4-a796-40e0-9162-e4bdf6c829ca',
					'stoneType' => 'Sandstone',
					'approachTime' => 22
				),
				array (
					'area' => 'Central Oregon',
					'crag' => 'Smith Rock',
					'route' => 'Route C',
					'routeId' => '7510294f-1ac0-4611-b008-c5c2803b86c2',
					'stoneType' => 'Sandstone',
					'approachTime' => 26
				),
				array (
					'area' => 'Northern California',
					'crag' => 'Wildnerss Peaks',
					'route' => 'Straight up',
					'routeId' => 'ec8d15be-2b34-4eb3-95dd-1846fd59525e',
					'stoneType' => 'Granite',
					'approachTime' => 23
				)
			)
		);
	header('Content-type: application/json');
	echo json_encode($data);
}

?>