<?php
require 'user.php';

class Model {

	public function user_info () {
		
		$user = new User();
		$user->userID = 178934;
		
		return get_object_vars($user);
		
	}

}

?>