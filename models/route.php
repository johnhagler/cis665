<?php

<<<<<<< HEAD
require_once 'crag.php';
=======
require_once 'base.php';

class Route extends BaseModel {
	
	public $route_id; 
	public $route_name;
	public $route_descr;
	public $route_type;
	public $location_lat;
	public $location_lon;
	public $pitches;
	public $grade;
	public $route_rating;

>>>>>>> Updates to user.php, route.php, New area.php, crag.php

class Route extends Crag {
	
	function __construct() {

	}

	public function list_routes {

	}

}

?>