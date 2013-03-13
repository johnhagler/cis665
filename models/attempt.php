<?php


/* CIS665 - PHP Project - ClimbIt Application
*	Team: John Hagler, Anna Chernyavskaya
* 	Date: March 24, 2013
*	Purpose: attempt.php  - Attempt class - contains methods and CRUD functions related to logging user's climbing attempts
* 	Uses: base.php
* 	Extends: BaseModel
*/



require_once 'base.php'; //contains common methods

class Attempt extends BaseModel {

	public $attempt_id;
	public $route_id;
	public $user_id;
	public $attempt_date;
	public $attempt_time;
	public $effort;
	public $status;

	public function __construct() {
		$user = $_SESSION['user'];
		$this->user_id = $user->user_id;
	}


	public function log() {

		$attempt_datetime = $this->attempt_date . ' ' . $this->attempt_time;		

		$sql = "insert into Attempt 
			(RouteID, UserID, StartDateTime, EffortRating, AttemptStatus)
			
			values (
				'$this->route_id', 
				'$this->user_id', 
				'$attempt_datetime', 
				'$this->effort', 
				'$this->status'
			)

		";

		$db = new Data();
		$db->run($sql);


	}

}

?>