<?php


/* CIS665 - PHP Project - ClimbIt Application
*	Team: John Hagler, Anna Chernyavskaya
* 	Date: March 24, 2013
*	Purpose: route.php - Route class - contains methods and CRUD functions related to a climbing 'Route'
* 	Uses: crag.php, db.php
*	Extends: Crag class
*/


require_once 'crag.php'; //contains parent class 
require_once 'db.php'; //contains sql connection methods


class Route extends Crag {

	public $route;
	public $grade;
	public $pitches;
	public $rating;
	
	//class constructor
	function __construct() {
	}


	//method to produce a listing of all routes by crag name (uses crag id as parameter)
	function list_routes_by_crag($crag) {

		//execute sql query on the DB to get route data
		$sql = "select *
				from Route a, Grade b
				where a.cragId = $crag
				and a.GradeID = b.GradeID";


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
				'gradeId' => $result['GradeID'],
				'pitches' => $result['Pitches'],
				'height' => $result['Height'],
				'rating' => $result['Rating'],
				'addDate' => $result['AddDate']
				);

			array_push($routes, $route);//stack the array

		}//close foreach loop

		$data = array('routes' => $routes); //assign "routes" array to a $data object

		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display routes data in JSON format

	}//close list_routes method




	//method to produce a listing of all routes by crag name
	function new_routes() {

		//execute sql query on the DB to get route data
		$sql = "select TOP 3 a.RouteID, a.RouteName, a.GradeID, d.Grade, a.AddDate, c.AreaName, b.CragName
				from Route a, Crag b, Area c, Grade d
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				and a.GradeID = d.GradeID
				Order by AddDate DESC"; 


		$db = new Data(); //create connection object

		$results = $db->run($sql); //execute the sql query and assign the results of the query to 'results' variable

		$newroutes = array();//create "routes" array


		//loop through the query results to create a md array "route"
		foreach ($results as $result) {

			$newroute = array (
				'areaName' => $result['AreaName'],
				'cragName' => $result['CragName'],
				'routeId' => $result['RouteID'],
				'routeName' => $result['RouteName'],
				'gradeId' => $result['GradeID'],
				'grade' => $result['Grade'],
				'addDate' => $result['AddDate']
				);

			array_push($newroutes, $newroute);//stack the array

		}//close foreach loop


		$data = array('newroutes' => $newroutes); //assign "routes" array to a $data object

		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display routes data in JSON format

	}//close new_routes() method





	//method to produce a listing of all routes by crag name
	function popular_routes() {

		//execute sql query on the DB to get route data
		$sql = "select TOP 3 a.RouteID, a.RouteName, a.GradeID, d.Grade, c.AreaName, b.CragName, a.Rating
				from Route a, Crag b, Area c, Grade d
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				and a.GradeID = d.GradeID
				Order by Rating DESC"; 


		$db = new Data(); //create connection object

		$results = $db->run($sql); //execute the sql query and assign the results of the query to 'results' variable

		$poproutes = array();//create "routes" array


		//loop through the query results to create a md array "route"
		foreach ($results as $result) {

			$poproute = array (
				'areaName' => $result['AreaName'],
				'cragName' => $result['CragName'],
				'routeId' => $result['RouteID'],
				'routeName' => $result['RouteName'],
				'gradeId' => $result['GradeID'],
				'grade' => $result['Grade'],
				'rating' => $result['Rating']
				);

			array_push($poproutes, $poproute);//stack the array

		}//close foreach loop


		$data = array('poproutes' => $poproutes); //assign "routes" array to a $data object

		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display routes data in JSON format

	}//close popular_routes() method







	//method to list all details about the route by route name
	function list_route_details($routeId) {

		//execute sql query on the database
		$sql = "select 
				a.RouteID, a.RouteName,a.RouteDescr, 
				a.GradeID, d.Grade, a.Pitches, a.Height, a.Rating, a.AddDate,
				c.AreaName, b.CragName, c.AreaImage
				from RouteRating a, Crag b, Area c, Grade d
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				and a.GradeID = d.GradeID
				and a.RouteID = $routeId";

		$db = new Data();//create new data/connect object

		$results = $db -> run($sql);

		foreach ($results as $result) {
			$rating = $result['Rating'];
			if ($rating == 0) {
				$rating = '--';
			}
			$route = array (
				'routeId' 		=> $result['RouteID'],
				'routeName' 	=> $result['RouteName'],
				'routeDescr' 	=> $result['RouteDescr'],
				'areaName' 		=> $result['AreaName'],
				'cragName' 		=> $result['CragName'],
				'gradeId'		=> $result['GradeID'],
				'grade' 		=> $result['Grade'],
				'pitches' 		=> $result['Pitches'],
				'height' 		=> $result['Height'],
				'rating'		=> $rating,
				'ratingNum'		=> $result['Rating'],
				'addDate' 		=> $result['AddDate'],
				'areaImage' 	=> $result['AreaImage']
				);

		}//end of foreach
		
		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($route); //display route details data in JSON format

	}//end of list_route_details method




	function search_routes_multi () {

		$sql = "select a.RouteID, c.AreaName, b.CragName, a.RouteName, a.RouteDescr, a.GradeID, e.Grade, a.Pitches, 
				a.Height, a.Rating, a.AddDate, d.StoneTypeName, c.ApproachTime
				from RouteRating a, Crag b, Area c, StoneType d, Grade e
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				and a.GradeID = e.GradeID
				and c.StoneTypeID = d.StoneTypeID";

		if ($this->route != '') {
			$sql .= " and a.RouteName like '%$this->route%'";
		}//end of routeName if clause

		if ($this->area != '') {
			$sql .= " and c.AreaName like '%$this->area%'";
		}//end of area if clause

		if ($this->crag != '') {
			$sql .= " and b.CragName like '%$this->crag%'";
		}//end of crag if clause

		if ($this->stonetype != '') {
			$sql .= " and d.StoneTypeName like '%$this->stonetype%'";
		}//end of stonetype if clause

		if ($this->grade != '') {
			$sql .= " and e.Grade like '%$this->grade%'";
		}//end of grade if clause

		if ($this->pitches != '') {
			$sql .= " and a.Pitches like '%$this->pitches%'";
		}//end of pitches if clause

		if ($this->rating != '') {
			$sql .= " and a.Rating = $this->rating";
		}//end of "rating" if clause


		$sql .= " order by a.RouteName, b.CragName, C.AreaName"; 



		$db = new Data(); //create connection object


		$result = $db -> run($sql);//execute the sql query and assign the results of the query to 'results' variable

		
		$resultc = count($result);//determine if any records were returned from the search query


		//if no records were returned, display an "search error" message 
		if ($resultc == '0') {

			$cols = array('title'=>"SEARCH ERROR:");

			$row = array('routeName' => "Oops...sorry, we could not find any routes matching your search criteria. Please try again...");

			$data = array('cols' => $cols, 'rows' => $row);
		}//end of "if" clause for no matching search records


		//Otherwise, if matching search records were found
		else
		{
// build columns array
		$cols = 
			array(
				array(
					'name' => 'areaName',
					'title' => 'Area',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'cragName',
					'title' => 'Crag',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'stonetype',
					'title' => 'Stone Type',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'routeName',
					'title' => 'Route',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'gradeId',
					'title' => 'Grade',
					'sortStyle' => 'numeric'
				),
				array(
					'name' => 'pitches',
					'title' => 'Pitches',
					'sortStyle' => 'numeric'
				),
				array(
					'name' => 'ratingNum',
					'title' => 'Rating',
					'sortStyle' => 'numeric'
				)
			);
		


		$routes = array();

		foreach ($result as $result) {

			$rating = $result['Rating'];

			if ($rating == 0) {
				$rating = '--';
			}

			$route = array (

				'routeId' => $result['RouteID'],
				'areaName' => $result['AreaName'],
				'cragName' => $result['CragName'],
				'stonetype' => $result['StoneTypeName'],
				'routeName' => $result['RouteName'],
				'routeDescr' => $result['RouteDescr'],
				'approachTime' => $result['ApproachTime'],
				'gradeId' 	=> $result['GradeID'],
				'grade' => $result['Grade'],
				'pitches' => $result['Pitches'],
				'height' => $result['Height'],
				'rating' => $rating,
				'ratingNum' => $result['Rating'],
				'addDate' => $result['AddDate']
				);

			array_push($routes, $route);//stack the array
		}//end of foreach

	$data = array('cols' => $cols, 'rows' => $routes); //execute query and assign results to $data


	}//end of if/else for match results

	
	header('Content-type: application/json'); //designate the content to be in JSON format
	echo json_encode($data); //display route details data in JSON format


	}//end of "search_routes_multi" method




	
	//method to search routes by route name
	function search_routes_by_name($route_name) {

		$sql = "select c.AreaName, b.CragName, a.RouteName,a.GradeID, d. Grade, a.Pitches, a.Height, a.Rating
				from Route a, Crag b, Area c, Grade d
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				and a.Route = d.Grade
				and a.RouteName like '%$route_name%'
				Order By a.RouteName, b.CragName, c.AreaName";

		$db = new Data();//

		return $results = $db->run($sql);

	}//end of search_routes_by_name method





	//method to search routes by route name  
	function search_routes_by_grade($grade) {

		$sql = "select c.AreaName, b.CragName, a.RouteName,a.GradeId, d.Grade, a.Pitches, a.Height, a.Rating
				from Route a, Crag b, Area c, Grade d
				where a.CragID = b.CragID
				and b.AreaID = c.AreaID
				and a.Grade like '%$grade%'
				Order By d.Grade, a.RouteName";

		$db = new Data();//

		return $results = $db->run($sql);

	}//end of search_routes_by_name method

}//end of Route class

?>
