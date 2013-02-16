<?php

require_once 'crag.php';


class Route extends Crag {

	
	public $route_id; 
	public $route_name;
	public $route_descr;
	public $route_type;
	public $location_lat;
	public $location_lon;
	public $pitches;
	public $grade;
	public $route_rating;

	
	function __construct() {

	}

	public function list_routes() {

	}

}

?>