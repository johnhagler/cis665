<?php


/* CIS665 - PHP Project - ClimbIt Application
*	Team: John Hagler, Anna Chernyavskaya
* 	Date: March 24, 2013
*	Purpose: user.php class - contains methods related to User access 
* 	Uses: base.php
*	Extends: BaseModel
*/


require_once 'base.php';

class User extends BaseModel {

	public $user_id;
	public $first_name;
	public $last_name;
	public $password;
	public $submit;


	function __construct() {
	}


	public function get_user_info ($user_id) {

		$user = new User();

		$db = new Data();
		$sql = "select * from [User] where [UserID] = '" . $user_id . "'";
		$results = $db->run($sql);


		if (count($results) > 0) {
			$result = $results[0];
			
			$user->user_id = $result['UserID'];
			$user->first_name = $result['FirstName'];
			$user->last_name = $result['LastName'];
		}


		return $user;
				
	}//end of get_user_info() method


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
		$sql = "select * from [User] where [UserID] = '" . $this->user_id . "'";
		$results = $db->run($sql);
		

		if (count($results) > 0) {
			$json = array ('unique'=>false);
		} else {
			$json = array ('unique'=>true);
		}
		
		header('Content-type: application/json');
		echo json_encode($json);

	}//end of check_unique() method



	public function login() {

		$result;

		$user_id = $_REQUEST['user'];	

		$db = new Data();
		$sql = "select * from [User] where [UserID] = '" . $user_id . "'";
		$result = $db->run($sql);


		if (count($result) > 0) {
			$hashed_password = $result[0]['Password'];
		} else {
			return false;
		}
		
		if (md5($_REQUEST['password']) == $hashed_password) {
			
			//if the hashes match, then set the seesion var
			
			
			//get a filled out user object
			$user = $this->get_user_info($user_id);
			
			$_SESSION['user'] = $user;

			$result = true;	
		} else {
			$result = false;
		}

		return $result;

	}// end of login() method


	public function logout() {
		$_SESSION['user'] = null;
	}//end of logout() method


	public function create_new() {

		$hashed_password = md5($this->password);
		
		$sql = "insert into [User] values ('" 
			. $this->user_id . "','" 
			. $this->first_name . "','" 
			. $this->last_name . "','"
			. $hashed_password . "'"
			.")";

		$db = new Data();
		$db->run($sql);

		$_SESSION['user'] = $this;

	}//end of create_new() method


}//end of User Class

?>