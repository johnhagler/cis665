<?php
class Load {
	
	public static function view($file_name, $title) {
		include 'views/header.php';
		include 'views/' . $file_name;
		include 'views/footer.php';

	}

}

?>