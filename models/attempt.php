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
	public $status;

	public function __construct() {
		$user = $_SESSION['user'];
		$this->user_id = $user->user_id;
	}

	public function parse_date_time() {
		$this->attempt_date = str_replace("-", "", $this->attempt_date);
		$this->attempt_time = str_replace(":", "", $this->attempt_time);
	}

	public function log() {

		$this->parse_date_time();

		$sql = "insert into `Attempt` values ("
			. "null,"
			. "'" . $this->route_id . "',"
			. "'" . $this->user_id . "',"
			. $this->attempt_date . ","
			. $this->attempt_time . ","
			. "'" . $this->status . "'"
			. ")";


		$db = new Data();
		$db->run($sql);


	}

}

?>