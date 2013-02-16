<?php

require_once 'application/load.php';
require_once 'models/db.php';
require_once 'models/user.php';


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

		} else if ($q == 'planit') {
			$this->planit();

		} else if ($q == 'climbit') {
			$this->climbit();

		} else if ($q == 'signup') {
			$this->signup();

		} else if ($q == 'check_user') {
			$this->check_user();

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

	function planit() {
		Load::view('planit.php');

	}

	function climbit() {
		Load::view('climbit.php');

	}

	function signup() {
		Load::view('signup.php');

	}

	function unauthorized() {
		Load::view('unauthorized.php');
	}

	//move this method to user.php
	function check_user() {

		$usr = new User();
		$usr->populate();

		if ($usr->user_id == 'abc') {
			$json = array ('unique'=>false);
		} else {
			$json = array ('unique'=>true);
		}

		header('Content-type: application/json');
		echo json_encode($json);
	}

}

?>