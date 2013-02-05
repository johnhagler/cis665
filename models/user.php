<?php

class User {

	public $userID;
	public $first_name;
	public $last_name;

	function __construct() {

	}

	public function get_user_info ($userID) {

		//create a new user object
		$user = new User();

		//fill out the user details (from DB)
		$user->userID = $userID;
		$user->first_name = 'John';
		$user->last_name = 'Hagler';

		return $user;
				
	}

	public function isAuthenticated() {
		if( isset($_SESSION['user']) ) {
			return true;
		} else {
			return false;
		}
	}


	public function login() {

		$result;

		$userID = $_REQUEST['user'];	

		//Query the DB to see if the user exists

		//if there is a record returned, get the password hash


		$hashed_password = 'pspSeBAWey.NM';

		
		if (crypt($_REQUEST['password'], $hashed_password) == $hashed_password) {
			
			//if the hashes match, then set the seesion var
			

			//get a filled out user object
			$user = $this->get_user_info($userID);
			
			$_SESSION['user'] = $user;

			$result = true;	
		} else {
			$result = false;
		}

		return $result;
	}

	public function logout() {
		$_SESSION['user'] = null;
	}

}

?>