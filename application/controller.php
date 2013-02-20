<?php

require_once 'application/load.php';
require_once 'models/db.php';
require_once 'models/user.php';
require_once 'models/attempt.php';


class Controller {

	public $user;

	function __construct() {


		$this->user = new User();

		session_start();
		
		$secured = array('planit','climbit');
		
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

		} else if ($q == 'findit') {
			$this->findit();
		
		} else if ($q == 'search') {
			$this->search();

		} else if ($q == 'route_details') {
			$this->route_details();

		} else if ($q == 'browse') {
			$this->browse();

		} else if ($q == 'attempt') {
			$this->attempt();

		} else if ($q == 'log_attempt') {
			$this->log_attempt();

		} else if ($q == 'climbit') {
			$this->myclimbs();

		} else if ($q == 'signup') {
			$this->signup();

		} else if ($q == 'user_check_unique') {
			$this->user_check_unique();

		} else if($q == 'new_routes') {
			new_routes();
		} else if($q == 'popular_routes') {
			popular_routes();
		} else if($q == 'list_routes') {
			list_routes();
		} else if($q == 'list_areas') {
			list_areas();
		} else if($q == 'list_crags_by_area') {
			list_crags_by_area($_REQUEST['area']);
		} else if($q == 'list_routes_by_crag') {
			list_routes_by_crag($_REQUEST['crag']);
		} else if($q == 'list_route_details') {
			list_route_details($_REQUEST['route']);
		} else if($q == 'echo') {
			echo json_encode($_REQUEST);
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

	function findit() {
		Load::view('findit.php');

	}

	function search() {
		Load::view('search.php');

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
		$attempt->log();

		Load::view('myclimbs.php');

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