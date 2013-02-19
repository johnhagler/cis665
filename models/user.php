<?php

require_once 'base.php';

class User extends BaseModel {

	public $user_id;
	public $first_name;
	public $last_name;
	public $user_city;
	public $user_state;
	

	function __construct() {

	}

	public function get_user_info ($user_id) {

		$user = new User();

		$db = new Data();
		$sql = "select * from `User` where `UserID` = '" . $user_id . "'";
		$results = $db->run($sql);


		if (count($results) > 0) {
			$result = $results[0];
			
			$user->user_id = $result['UserID'];
			$user->first_name = $result['FirstName'];
			$user->last_name = $result['LastName'];
		}


		return $user;
				
	}

	public function isAuthenticated() {
		if( isset($_SESSION['user']) ) {
			return true;
		} else {
			return false;
		}
	}

	public function check_unique() {
		$this->populate();

		$db = new Data();
		$sql = "select * from `User` where `UserID` = '" . $this->user_id . "'";
		$results = $db->run($sql);


		if (count($results) > 0) {
			$json = array ('unique'=>false);
		} else {
			$json = array ('unique'=>true);
		}
		

		header('Content-type: application/json');
		echo json_encode($json);
	}


	public function login() {

		$result;

		$user_id = $_REQUEST['user'];	

		$db = new Data();
		$sql = "select * from `User` where `UserID` = '" . $user_id . "'";
		$result = $db->run($sql);


		if (count($result) > 0) {
			$hashed_password = $result[0]['Password'];
		} else {
			return false;
		}
		
		if (crypt($_REQUEST['password'], $hashed_password) == $hashed_password) {
			
			//if the hashes match, then set the seesion var
			
			
			//get a filled out user object
			$user = $this->get_user_info($user_id);
			
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