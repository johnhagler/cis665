<?php
class Load {
	public static function view($file_name, $data = null) {
		if ( is_array($data) ) {
			extract($data);
		}

		include 'views/header.php';
		include 'views/' . $file_name;
		include 'views/footer.php';

	}

}

?>