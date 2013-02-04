<?php

class User {

	public $userID;
	public $first_name;
	public $last_name;

	function __construct() {

	}

	public function user_info () {


		
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

		$user = $_REQUEST['user'];	

		//Query the DB to see if the user exists

		//if there is a record returned, get the password hash


		$hashed_password = 'pspSeBAWey.NM';

		
		if (crypt($_REQUEST['password'], $hashed_password) == $hashed_password) {
			
			//if the hashes match, then set the seesion var
			
			$this->user_info();
			$user_obj = new User();
			$user_obj->first_name = 'John';
			$user_obj->last_name = 'Hagler';

			$_SESSION['user'] = $user_obj;	

			

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