<?php

require_once 'application/load.php';
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

		} else if ($q == 'browse') {
			$this->browse_routes();

		} else if ($q == 'planit') {
			$this->planit();

		} else if ($q == 'climbit') {
			$this->climbit();

		} else if ($q == 'signup') {
			$this->signup();
		} else if ($q == 'check_user') {
			$this->check_user();
		} else if ($q == 'q') {
			$this->testReflect();
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

	function browse_routes() {
		Load::view('browse_routes.php');

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