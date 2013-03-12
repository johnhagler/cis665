<?php

<<<<<<< HEAD
require_once 'crag.php';
require_once 'db.php';
require_once 'base.php';
=======

/* CIS665 - PHP Project - ClimbIt Application
*	Team: John Hagler, Anna Chernyavskaya
* 	Date: March 24, 2013
*	Purpose: route.php - Route class - contains methods and CRUD functions related to a climbing 'Route'
* 	Uses: crag.php, db.php
*	Extends: Crag class
*/


require_once 'crag.php'; //contains parent class 
require_once 'db.php'; //contains sql connection methods
>>>>>>> mass commit


class Route extends Crag {

	public $route_id; 
	public $route_name;
	public $route_descr;
	public $route_type;
	public $pitches;
	public $grade;
	public $height;
	public $add_date;

	
	//class constructor
	function __construct() {
	}


<<<<<<< HEAD
	//method to produce a listing of all routes by crag name
	public function list_routes_by_crag($crag) {
=======
	//method to produce a listing of all routes by crag name (uses crag id as parameter)
	function list_routes_by_crag($crag) {
>>>>>>> mass commit

		//execute sql query on the DB to get route data
		$sql = "select *
				from Route
<<<<<<< HEAD
				";
=======
				where cragId = $crag";
>>>>>>> mass commit


		$db = new Data(); //create connection object

		$results = $db->run($sql); //execute the sql query and assign the results of the query to 'results' variable

		$routes = array();//create "routes" array


		//loop through the query results to create a md array "route"
		foreach ($results as $result) {

			$route = array (
				'routeId' => $result['RouteID'],
				'routeName' => $result['RouteName'],
<<<<<<< HEAD
=======
				'routeDescr' => $result['RouteDescr'],
>>>>>>> mass commit
				'grade' => $result['Grade'],
				'pitches' => $result['Pitches'],
				'height' => $result['Height'],
				'addDate' => $result['AddDate']
				);
<<<<<<< HEAD
		}//close foreach loop


		array_push($routes, $route);//stack the array
=======

			array_push($routes, $route);//stack the array

		}//close foreach loop
>>>>>>> mass commit

		$data = array('routes' => $routes); //assign "routes" array to a $data object

		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display routes data in JSON format

	}//close list_routes method



<<<<<<< HEAD


	//method to list all details about the route by route name
	function list_route_details($route) {

		//execute sql query on the database
		$sql = "select DISTINCT a.RouteName,a.RouteDescr, a.Grade, a.Pitches, a.Height, a.Rating, a.AddDate
				from Route a, Crag b, Area c
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				order by a.AddDate";

		$db = new Data();//create new data/connect object

		return $results = $db->run($sql); //execute query and assign results to a $results object

	}//end of list_route_detailed method



	//method to search routes by multiple criteria
	function search_routes_multi ($route_name, $area, $crag, $grade, $rating) {


		$sql = "select c.AreaName, b.CragName, a.RouteName,a.Grade, a.Pitches, a.Height, a.Rating
				from Route a, Crag b, Area c
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID";


		if ($route_name != '')
		{
			$sql .= "and a.RouteName like '%$route_name%'";
=======
	//#################################################################################################
	//###################################  NEED TO COMPLETE ###########################################

	//method to produce a listing of all routes by crag name
	function new_routes() {

		//execute sql query on the DB to get route data
		$sql = "select "; 


		$db = new Data(); //create connection object

		$results = $db->run($sql); //execute the sql query and assign the results of the query to 'results' variable

		$routes = array();//create "routes" array


		//loop through the query results to create a md array "route"
		foreach ($results as $result) {

			$route = array (
				'routeId' => $result['RouteID'],
				'routeName' => $result['RouteName'],
				'routeDescr' => $result['RouteDescr'],
				'grade' => $result['Grade'],
				'pitches' => $result['Pitches'],
				'height' => $result['Height'],
				'addDate' => $result['AddDate']
				);

			array_push($routes, $route);//stack the array

		}//close foreach loop


		$data = array('routes' => $routes); //assign "routes" array to a $data object

		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display routes data in JSON format

	}//close new_routes() method




	//method to list all details about the route by route name
	function list_route_details($routeId) {

		//execute sql query on the database
		$sql = "select a.RouteID, a.RouteName,a.RouteDescr, a.Grade, a.Pitches, a.Height, a.Rating, a.AddDate
				from Route a, Crag b, Area c
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				and a.RouteID = $routeId";

		$db = new Data();//create new data/connect object

		$result = $db -> run($sql);

		foreach ($result as $result) {
			$route = array (
				'routeId' => $result['RouteID'],
				'routeName' => $result['RouteName'],
				'routeDescr' => $result['RouteDescr'],
				'grade' => $result['Grade'],
				'pitches' => $result['Pitches'],
				'height' => $result['Height'],
				'addDate' => $result['AddDate']
				);

		}//end of foreach
		
		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($route); //display route details data in JSON format

	}//end of list_route_details method




function search_routes_multi ($route, $area, $crag, $grade, $rating) {

		$sql = "select a.RouteID, c.AreaName, b.CragName, a.RouteName, a.RouteDescr, a.Grade, a.Pitches, 
				a.Height, a.Rating, a.AddDate, d.StoneTypeName, c.ApproachTime
				from Route a, Crag b, Area c, StoneType d
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				and c.StoneTypeID = d.StoneTypeID";

		if ($route != '')
		{
			$sql .= " and a.RouteName like '%$route%'";
>>>>>>> mass commit
		}//end of routeName if clause

		if ($area != '')
		{
<<<<<<< HEAD
			$sql .= "and c.AreaName like '%$area%'";
=======
			$sql .= " and c.AreaName like '%$area%'";
>>>>>>> mass commit
		}//end of area if clause

		if ($crag != '')
		{
<<<<<<< HEAD
			$sql .= "and b.CragName like '%$crag%'";
=======
			$sql .= " and b.CragName like '%$crag%'";
>>>>>>> mass commit
		}//end of crag if clause

		if ($grade != '')
		{
<<<<<<< HEAD
			$sql .= "and a.Grade like '%$grade%'";
		}//end of grade if clause


		$sql .= "order by a.RouteName, b.CragName, C.AreaName"; 
=======
			$sql .= " and a.Grade like '%$grade%'";
		}//end of grade if clause

		if ($rating != '')
		{
			$sql .= " and a.Rating like '%$rating%'";
		}


		$sql .= " order by a.RouteName, b.CragName, C.AreaName"; 

>>>>>>> mass commit


		$db = new Data(); //create connection object

<<<<<<< HEAD
		return $data = $db->run($sql); //execute the sql query and assign the results of the query to 'results' variable


=======

		$result = $db -> run($sql);//execute the sql query and assign the results of the query to 'results' variable

// build columns array
		$cols = 
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
					'name' => 'stoneType',
					'title' => 'Stone Type',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'route',
					'title' => 'Route',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'approachTime',
					'title' => 'Time to Approach',
					'sortStyle' => 'numeric'
				)
			);
		


		$routes = array();

		foreach ($result as $result) {
			$route = array (
				'routeId' => $result['RouteID'],
				'areaName' => $result['AreaName'],
				'cragName' => $result['CragName'],
				'stoneType' => $result['StoneTypeName'],
				'routeName' => $result['RouteName'],
				'routeDescr' => $result['RouteDescr'],
				'approachTime' => $result['ApproachTime'],
				'grade' => $result['Grade'],
				'pitches' => $result['Pitches'],
				'height' => $result['Height'],
				'addDate' => $result['AddDate']
				);

			array_push($routes, $route);//stack the array
		}//end of foreach
		

		$data = array('cols' => $cols, 'rows' => $routes); //execute query and assign results to $data


		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display route details data in JSON format

>>>>>>> mass commit
	}//end of "search_routes_multi" method




	
	//method to search routes by route name
	function search_routes_by_name($route_name) {

		$sql = "select c.AreaName, b.CragName, a.RouteName,a.Grade, a.Pitches, a.Height, a.Rating
				from Route a, Crag b, Area c
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				and a.RouteName like '%$route_name%'
				Order By a.RouteName, b.CragName, c.AreaName";

		$db = new Data();//

		return $results = $db->run($sql);

	}//end of search_routes_by_name method




<<<<<<< HEAD
	//method to search routes by route name
=======

	//method to search routes by route name  
>>>>>>> mass commit
	function search_routes_by_grade($grade) {

		$sql = "select c.AreaName, b.CragName, a.RouteName,a.Grade, a.Pitches, a.Height, a.Rating
				from Route a, Crag b, Area c
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				and a.Grade like '%$grade%'
				Order By a.Grade, a.RouteName";

		$db = new Data();//

		return $results = $db->run($sql);

	}//end of search_routes_by_name method



<<<<<<< HEAD

	//method to search routes by route name
	function search_routes_by_grange($grade1, $grade2) {

		$sql = "select c.AreaName, b.CragName, a.RouteName,a.Grade, a.Pitches, a.Height, a.Rating
				from Route a, Crag b, Area c
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				and a.Grade between '%$grade1%' and '%$grade2%'    
				Order By a.Grade, a.RouteName";
				//NEED TO UPDATE GRADE RANGE TO CONVERT

		$db = new Data();//

		return $results = $db->run($sql);

	}//end of search_routes_by_name method




=======
>>>>>>> mass commit

}//end of Route class

?>