<?php

class Controller {
	public $load;
	public $user;

	function __construct() {

		$this->load = new Load();
		$this->user = new User();

		session_start();
		
		$secured = array('planit','climbit');
		
		$q = $_REQUEST['q'];

		if ( $this->user->isAuthenticated() ) {
			//cool beans...
		} else {
			//check to make sure they're not asking for anything secure
			
			if (in_array($q, $secured)) {
				//unauthenticated user requesting a secured page
				//route them to the signup page
				$this->signup();
				return;
			} 

		} 

		if ($q == 'login') {
			$success = $this->login();

			if ($success) {
				$q = $_REQUEST['forward'];
			} else {
				$this->load->view('login.php');
			}
			

		} else if ($q == 'logout') {
			$this->logout();
			$q = 'home';
		}

		



		if ($q == '' || $q == 'home') {
			$this->home();	

		} else if ($q == 'findit') {
			$this->findit();

		} else if ($q == 'planit') {
			$this->planit();

		} else if ($q == 'climbit') {
			$this->climbit();

		} else if ($q == 'signup') {
			$this->signup();

		}

	}

	
	function login() {
		$user = new User();

		$authenticated = $user->login();

		// if the authentication attempt is unsuccessful, to to the full login page
		return $authenticated;

	}



	function logout() {
		$this->user->logout();

	}

	function home() {
		$this->load->view('splash.php', $data);

	}

	function findit() {
		$this->load->view('findit.php', $data);

	}

	function planit() {
		$this->load->view('planit.php', $data);

	}

	function climbit() {
		$this->load->view('climbit.php', $data);

	}

	function signup() {
		$this->load->view('signup.php', $data);

	}


}

?>