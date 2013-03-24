<?php

require_once 'application/load.php';
require_once 'models/db.php';
require_once 'models/user.php';
require_once 'models/attempt.php';
require_once 'models/crag.php';
require_once 'models/area.php';
require_once 'models/route.php';

class Controller {

	public $user;

	function route($q) {
		try {
			$reflectionMethod = new ReflectionMethod('Controller', $q);
			$reflectionMethod->invoke($this, null);	
		} catch (Exception $e) {
			$this->home();
		}

	}

	function run_app() {


		$this->user = new User();

		session_start();
		
		$secured = array('myclimbs','log_attempt');

		$q = (isset($_REQUEST['q'])) ? $_REQUEST['q'] : '';

		if ( $this->user->isAuthenticated() ) {
			//cool beans...
		} else {
			//check to make sure they're not asking for anything secure
			
			if (in_array($q, $secured)) {
				//unauthenticated user requesting a secured page
				$this->unauthorized();
				return;
			} 

		} 

		

		if ($q == '') {
			//set default query parm
			$q = 'home';
		} 

		//route to the appropriate function
		$this->route($q);

	}

	



	//------------------------------------------------
	// Login/logout functions
	function login() {

		$authenticated = $this->user->login();

		if ($authenticated) {
			$q = $_REQUEST['forward'];
			if ($q == 'logout') {
				$this->home();
			} else {
				$this->route($q);
			}
			
		} else {
			Load::view('login.php');
		}

	}

	function logout() {
		$this->user->logout();
		$this->home();
	}

	function unauthorized() {
		Load::view('unauthorized.php');
	}

	//------------------------------------------------




	//------------------------------------------------
	// Home (Splash) Page
	function home() {
		Load::view('splash.php');
	}

	function user_details() {
		$json;

		if (isset($_SESSION['user'])) {
			$user = $_SESSION['user'];
			$user->get_user_info($user->user_id);
			$json = json_encode(array('user'=>$user));
		} else {
			$json = json_encode(array('user'=> null));
		}
		
		header('Content-type: application/json');
		echo $json;
	}

	function route_details() {
		Load::view('route_details.php');
	}

	function new_routes() {
		$route = new Route();
		$route->new_routes();
	}

	function popular_routes() {
		$route = new Route();
		$route->popular_routes();
	}

	//------------------------------------------------






	//------------------------------------------------
	// Find a Route (choose Search or Browse)
	function findit() {
		Load::view('findit.php');

	}
	//------------------------------------------------






	//------------------------------------------------
	// Search Page
	function search() { 
		Load::view('search.php');

	}

	function search_routes() {
		$route = new Route();
		$route -> populate();
		$route -> search_routes_multi();	

	}
	//------------------------------------------------






	//------------------------------------------------
	// Browse Page
	function browse() {
		Load::view('browse.php');
	}

	function list_areas() {
		$area = new Area();
		$area->list_areas();

	}

	function list_crags_by_area() {
		$crag = new Crag();
		$crag -> populate();
		$crag -> list_crags_by_area($_REQUEST['areaId']);
	}

	function list_routes_by_crag() {
		$route = new Route();
		$route -> populate();
		$route -> list_routes_by_crag($_REQUEST['cragId']);
	}		
	//------------------------------------------------






	//------------------------------------------------
	// Shared functions
	function list_route_details() {
		//browse page - forth pane - listing of route details by routeid
		$route = new Route();
		$route -> populate();
		$route -> list_route_details($_REQUEST['routeId']);
	}
	//------------------------------------------------





	//------------------------------------------------
	// Attempts (My Climbs)
	function attempt() {
		Load::view('attempt.php');

	}

	function log_attempt() {

		$attempt = new Attempt();
		$attempt->populate();

		if (isset($attempt->status)) {
			$attempt->log();
			Load::view('myclimbs.php');
		} else {
			Load::view('attempt.php');
		}

	}

	
	function update_attempt() {

		$attempt = new Attempt();
		if(isset($_REQUEST['attemptId'])) {
			
			$attempt->update_attempt($_REQUEST['attemptId'],  $_REQUEST['status']);

		}
	}


	function remove_attempt() {
		$attempt = new Attempt();
		$attempt->populate();
		$attempt->remove_attempt();
	}



	function myclimbs() {
		Load::view('myclimbs.php');

	}

	function list_attempts() {
		$user = $_SESSION['user'];
		$attempt = new Attempt();
		$attempt->list_attempts_by_user($user->user_id);

	}
	//------------------------------------------------



	//------------------------------------------------
	// Signup
	function signup() {
		$user = new User();
		$user->populate();

		if ($user->submit != '') {
			$user->create_new();
			Load::view('splash.php');	

		} else {
			Load::view('signup.php');	
			
		}
		
	}


	//move this method to user.php
	function user_check_unique() {

		$user = new User();
		$user->check_unique();

	}

}

?>