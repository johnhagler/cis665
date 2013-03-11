<?php

require_once 'crag.php';
require_once 'db.php';
require_once 'base.php';


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


	//method to produce a listing of all routes by crag name
	public function list_routes_by_crag($crag) {

		//execute sql query on the DB to get route data
		$sql = "select *
				from Route
				";


		$db = new Data(); //create connection object

		$results = $db->run($sql); //execute the sql query and assign the results of the query to 'results' variable

		$routes = array();//create "routes" array


		//loop through the query results to create a md array "route"
		foreach ($results as $result) {

			$route = array (
				'routeId' => $result['RouteID'],
				'routeName' => $result['RouteName'],
				'grade' => $result['Grade'],
				'pitches' => $result['Pitches'],
				'height' => $result['Height'],
				'addDate' => $result['AddDate']
				);
		}//close foreach loop


		array_push($routes, $route);//stack the array

		$data = array('routes' => $routes); //assign "routes" array to a $data object

		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display routes data in JSON format

	}//close list_routes method





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
		}//end of routeName if clause

		if ($area != '')
		{
			$sql .= "and c.AreaName like '%$area%'";
		}//end of area if clause

		if ($crag != '')
		{
			$sql .= "and b.CragName like '%$crag%'";
		}//end of crag if clause

		if ($grade != '')
		{
			$sql .= "and a.Grade like '%$grade%'";
		}//end of grade if clause


		$sql .= "order by a.RouteName, b.CragName, C.AreaName"; 


		$db = new Data(); //create connection object

		return $data = $db->run($sql); //execute the sql query and assign the results of the query to 'results' variable


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




	//method to search routes by route name
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





}//end of Route class

?>