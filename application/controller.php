<?php

/* CIS665 - PHP Project - ClimbIt Application
*	Team: John Hagler, Anna Chernyavskaya
* 	Date: March 24, 2013
*	Purpose: controller.php - Controller class of the model-view-controller model 
* 	Uses: load.php, db.php, user.php, attempt.php, crag.php, area.php, route.php
* 	Extends: 
*/


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
		$reflectionMethod = new ReflectionMethod('Controller', $q);
		$reflectionMethod->invoke($this, null);	
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

<<<<<<< HEAD
		

		if ($q == '') {
			//set default query parm
			$q = 'home';
		} 
=======
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
>>>>>>> changes to methods in controller.php 3/21

		//route to the appropriate function
		$this->route($q);

<<<<<<< HEAD
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
=======
		} else if ($q == 'findit') {
			$this->findit();
		
		} else if ($q == 'search') { //main search screen
			$this->search();

		} else if ($q == 'search_routes') { //search page - display of routes by user's multi-criteria input
			$this->search_routes();
		
		} else if ($q == 'route_details') { //display full route details
			$this->route_details();

		} else if ($q == 'browse') { //find a route page/browse option
			$this->browse();

		//&&&&&&&&& NOT USED &&&&&&&&&&&&&&&
		} else if ($q == 'list_areas') { 
			$this->list_areas();
		//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

		} else if ($q == 'list_attempts') { //MyClimbs page, list of climber's attempts
			$this->list_attempts();

		} else if ($q == 'log_attempt') { //option to log a climbing attempt from the route_details page
			$this->log_attempt();
			
		} else if ($q == 'update_attempt') { //myClimbs page, option to update the status of a previously logged attempt
			$this->update_attempt();

		} else if ($q == 'remove_attempt') { //myClimbs page, option to delete a previously logged attempt record
			$this->remove_attempt();

		} else if ($q == 'climbit') { //load myClimbs main page
			$this->myclimbs();

		} else if ($q == 'signup') {
			$this->signup();
>>>>>>> changes to methods in controller.php 3/21

		if (isset($_SESSION['user'])) {
			$user = $_SESSION['user'];
			$user->get_user_info($user->user_id);
			$json = json_encode(array('user'=>$user));
		} else {
			$json = json_encode(array('user'=>null));
		}
		
		header('Content-type: application/json');
		echo $json;
	}

<<<<<<< HEAD
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


=======
		} else if($q == 'new_routes') { //splash page - lists three most recently added routes based on add date
			$this->new_routes();

		} else if($q == 'popular_routes') { //splash page - lists three most popular routes based on user rating
			$this->popular_routes();

		//&&&&&&&&& NOT USED &&&&&&&&&&&&&&&
		} else if($q == 'list_routes') { //
			$this->list_routes();
		//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

		} else if($q == 'list_crags_by_area') { //browse page - second panel - listing of routes by area
			$this->list_crags_by_area();

		} else if($q == 'list_routes_by_crag') {//browse page - third panel - listing of routes by crag
			$this->list_routes_by_crag();

		} else if($q == 'list_route_details') { //browse page - forth pane - listing of route details by routeid
			$this->list_route_details();
>>>>>>> changes to methods in controller.php 3/21


<<<<<<< HEAD
=======
		} else if($q == 'remote') {
			$this->remote();
>>>>>>> changes to methods in controller.php 3/21


<<<<<<< HEAD
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
=======
	}//end of __construct() method

	

	function login() {
		$authenticated = $this->user->login();

		// if the authentication attempt is unsuccessful, to to the full login page
		return $authenticated;

	}//end of login() method


	function logout() {
		$this->user->logout();
	}//end of logout() method
>>>>>>> changes to methods in controller.php 3/21


<<<<<<< HEAD
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
=======
	function home() {
		Load::view('splash.php');
	}//end of home() method


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
	}//end of user_details() method


	function findit() {
		Load::view('findit.php');
	}//end of findit() method


	function search() { 
		Load::view('search.php');
	}//end of search() method


	function search_routes() {
      		$area = isset($_REQUEST['area']) ? $_REQUEST['area'] : '';
			$crag = isset($_REQUEST['crag']) ? $_REQUEST['crag'] : '';
			$stonetype = isset($_REQUEST['stonetype']) ? $_REQUEST['stonetype'] : '';		
      		$route = isset($_REQUEST['route']) ? $_REQUEST['route'] : '';
			$grade = isset($_REQUEST['grade']) ? $_REQUEST['grade'] : '';
			$pitches = isset($_REQUEST['pitches']) ? $_REQUEST['pitches'] : '';
			$rating = isset($_REQUEST['rating']) ? $_REQUEST['rating'] : '';

			$r = new Route();
			$r->search_routes_multi($route, $area, $crag, $stonetype, $grade, $pitches, $rating);	
	}//end of search_routes() method

>>>>>>> changes to methods in controller.php 3/21

	function list_areas() {
		$area = new Area();
		$area->list_areas();
	}//end of list_areas() method

<<<<<<< HEAD
	function list_crags_by_area() {
		$crag = new Crag();
		$crag -> populate();
		$crag -> list_crags_by_area($_REQUEST['areaId']);
	}
=======

	function route_details() {
		Load::view('route_details.php');
	}//end of route_details() method


	function new_routes() {
		$route = new Route();
		$route->new_routes();
	}//end of new_routes() method


	function popular_routes() {
		$route = new Route();
		$route->popular_routes();
	}//end of popular_routes() method


	function list_routes() {
		$route = new Route();
		$route -> list_routes();
	}//end list_routes() method
>>>>>>> changes to methods in controller.php 3/21

	function list_routes_by_crag() {
		$route = new Route();
		$route -> populate();
		$route -> list_routes_by_crag($_REQUEST['cragId']);
	}		
	//------------------------------------------------




<<<<<<< HEAD


	//------------------------------------------------
	// Shared functions
	function list_route_details() {
		//browse page - forth pane - listing of route details by routeid
		$route = new Route();
		$route -> populate();
		$route -> list_route_details($_REQUEST['routeId']);
	}
	//------------------------------------------------


=======
	function browse() {
		Load::view('browse.php');
	}//end of browse() method

>>>>>>> changes to methods in controller.php 3/21



	//------------------------------------------------
	// Attempts (My Climbs)
	function attempt() {
		Load::view('attempt.php');
	}//end of attempt() method


	function list_attempts() {
			$user = $_SESSION['user'];
			
			$attempt = new Attempt();
			$attempt->list_attempts_by_user($user->user_id);
	}//list_attempts() method


	function log_attempt() {

		$attempt = new Attempt();
		$attempt->populate();

		if (isset($attempt->status)) {
			$attempt->log();
			Load::view('myclimbs.php');
		} else {
			Load::view('attempt.php');
		}
	}//end of log_attempt() method

	
	function update_attempt() {

		$attempt = new Attempt();
		if(isset($_REQUEST['attemptId'])) {
			$attempt->update_attempt($_REQUEST['attemptId'],  $_REQUEST['status']);
		}
	}//end of update_attempt() method


	function remove_attempt() {
		$attempt = new Attempt();
		$attempt->populate();
		$attempt->remove_attempt();
	}//end of remove_attempt() method


	function myclimbs() {
		Load::view('myclimbs.php');
	}//end of myclimbs() method


	function list_crags_by_area() {
		$crag = new Crag();
		$crag -> list_crags_by_area($_REQUEST['areaId']);
	}//end of list_crags_by_area() method


	function list_routes_by_crag() {
		$route = new Route();
		$route -> list_routes_by_crag($_REQUEST['cragId']);
	}//end of list_routes_by_crag() method


	function list_route_details() {
		$route = new Route();
		$route -> list_route_details($_REQUEST['routeId']);
	}//end of list_route_details() method


	function remote() {
		$db = new Data();
		echo $db->remote($_REQUEST['sql']);
	}//end of remote() method


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
	}//end of signup() method


<<<<<<< HEAD
=======
	function unauthorized() {
		Load::view('unauthorized.php');
	}//end of unauthorized() method


>>>>>>> changes to methods in controller.php 3/21
	//move this method to user.php
	function user_check_unique() {

		$user = new User();
		$user->check_unique();

	}//end of user_check_unique() method

}//end of controller class

?>