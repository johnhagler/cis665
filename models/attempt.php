<?php

require_once 'base.php';

class Attempt extends BaseModel {

	public $attempt_id;
	public $route_id;
	public $user_id;
	public $attempt_date;
	public $attempt_time;
	public $status;

	public function __construct() {

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