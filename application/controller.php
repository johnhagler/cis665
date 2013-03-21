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

	function __construct() {


		$this->user = new User();

		session_start();
		
		$secured = array('planit','climbit','log_attempt');
		
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

		if ($q == 'login') {

			$success = $this->login();

			if ($success) {
				$q = $_REQUEST['forward'];
				if ($q == 'logout') {
					$q = 'home';
				}
			} else {
				Load::view('login.php');
			}
			

		} else if ($q == 'logout') {
			$this->logout();
			$q = 'home';
		}


		if ($q == '' || $q == 'home') {
			$this->home();	

		} else if ($q == 'user_details') {
			$this->user_details();

		} else if ($q == 'findit') {
			$this->findit();
		
		} else if ($q == 'search') {
			$this->search();

		} else if ($q == 'search_routes') { //search page - display of routes by user's multi-criteria input

      		$area = isset($_REQUEST['area']) ? $_REQUEST['area'] : '';
			$crag = isset($_REQUEST['crag']) ? $_REQUEST['crag'] : '';
			$stonetype = isset($_REQUEST['stonetype']) ? $_REQUEST['stonetype'] : '';		
      		$route = isset($_REQUEST['route']) ? $_REQUEST['route'] : '';
			$grade = isset($_REQUEST['grade']) ? $_REQUEST['grade'] : '';
			$pitches = isset($_REQUEST['pitches']) ? $_REQUEST['pitches'] : '';
			$rating = isset($_REQUEST['rating']) ? $_REQUEST['rating'] : '';

			$r = new Route();
			$r->search_routes_multi($route, $area, $crag, $stonetype, $grade, $pitches, $rating);	

		
		} else if ($q == 'route_details') {
			$this->route_details();

		} else if ($q == 'browse') {
			$this->browse();
		} else if ($q == 'list_areas') {
			$this->list_areas();

		} else if ($q == 'list_attempts') {
			
			$user = $_SESSION['user'];
			
			$attempt = new Attempt();
			$attempt->list_attempts_by_user($user->user_id);

		} else if ($q == 'log_attempt') {
			$this->log_attempt();
			

		//&&&&&&&&&&&&&&&&&&&&&&&&&
		} else if ($q == 'update_attempt') {
			$this->update_attempt();

		} else if ($q == 'remove_attempt') {
			$this->remove_attempt();



		} else if ($q == 'climbit') {
			$this->myclimbs();



		} else if ($q == 'signup') {
			$this->signup();

		} else if ($q == 'user_check_unique') {
			$this->user_check_unique();

		} else if($q == 'new_routes') {
			$route = new Route();
			$route->new_routes();

		} else if($q == 'popular_routes') {
			$route = new Route();
			$route->popular_routes();

		} else if($q == 'list_routes') {
			$route = new Route();
			$route -> list_routes();

		} else if($q == 'list_crags_by_area') { //browse page - second panel - listing of routes by area
			$crag = new Crag();
			$crag -> list_crags_by_area($_REQUEST['areaId']);

		} else if($q == 'list_routes_by_crag') {//browse page - third panel - listing of routes by crag
			$route = new Route();
			$route -> list_routes_by_crag($_REQUEST['cragId']);

		} else if($q == 'list_route_details') { //browse page - forth pane - listing of route details by routeid
			$route = new Route();
			$route -> list_route_details($_REQUEST['routeId']);

		} else if($q == 'echo') {
			echo json_encode($_REQUEST);

		} else if($q == 'remote') {
			$db = new Data();
			echo $db->remote($_REQUEST['sql']);

		} 


	}

	
	function login() {

		$authenticated = $this->user->login();

		// if the authentication attempt is unsuccessful, to to the full login page
		return $authenticated;

	}



	function logout() {
		$this->user->logout();

	}

	function home() {
		Load::view('splash.php');

	}

	function user_details() {
		$json;
		if (isset($_SESSION['user'])) {
			$user = $_SESSION['user'];
			$user->get_user_info($user->user_id);
			$json = json_encode($user);
		} else {
			$json = null;
		}
		
		header('Content-type: application/json');
		echo $json;
	}


	function findit() {
		Load::view('findit.php');

	}


	function search() { 
		Load::view('search.php');

	}

	function list_areas() {
		$area = new Area();
		$area->list_areas();

	}


	function route_details() {
		Load::view('route_details.php');
	}


	function browse() {
		Load::view('browse.php');

	}

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


	function unauthorized() {
		Load::view('unauthorized.php');
	}

	//move this method to user.php
	function user_check_unique() {

		$user = new User();
		$user->check_unique();

	}

}

?>