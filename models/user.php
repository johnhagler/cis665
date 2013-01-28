<?php

class User {

	public $userID;
	public $first_name;
	public $last_name;

	function __construct() {
		$this->userID = 0;
		$this->first_name = 'John';
		$this->last_name = 'Hagler';
	}

}

?>