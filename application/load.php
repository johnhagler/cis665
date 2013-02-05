<?php
class Load {
	function view($file_name, $data = null) {
		if ( is_array($data) ) {
			extract($data);
		}
		include 'views/header.php';
		include 'views/' . $file_name;
		include 'views/footer.php';
	}

	function populate($obj) {

		$reflect = new ReflectionClass($obj);

		$props   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);

		foreach ($props as $prop) {
			$name = $prop->getName();
			$value = $_REQUEST[$name];
			$obj->{$name} = $value;
		}

		

	}

}

?>