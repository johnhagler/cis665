<?php


/* CIS665 - PHP Project - ClimbIt Application
*	Team: John Hagler, Anna Chernyavskaya
* 	Date: March 24, 2013
*	Purpose: db.php - Data class - contains methods to connect to sql and retrieve data from the ClimbItDB database
* 	Uses: user.php, area.php, crag.php, route.php
*	Extends: 
*/


require_once 'user.php';
require_once 'area.php';
require_once 'crag.php';
require_once 'route.php';



class Data {

	
	public $servername;
	public $username;
	public $password;
	public $database_name;


	public function __construct() {
		// define connection parameters
		
		$this->servername = 'localhost:8889';
		$this->username = 'root';
		$this->password = 'root';
		
		$this->database_name = 'ClimbItDB';
		
	}//end of function_construct()




	public function runMySql($sql) {

		$link = mysql_connect('localhost', 'root', 'root');

		if (!$link) {
		    die('Not connected : ' . mysql_error());
		}


		// make foo the current db
		$db_selected = mysql_select_db('ClimbItDB', $link);
		if (!$db_selected) {
		    die ('Can\'t use foo : ' . mysql_error());
		}


		$results = mysql_query($sql);

		echo mysql_error();

		if (($error = mysql_error()) != '') {
			return $error;
			echo $error;
		}

		echo mysql_error();

		$rows = array();
		while ($row = mysql_fetch_assoc($results)) {
		    array_push($rows, $row);
		}

		mysql_free_result($results);

		mysql_close($link);


		return json_encode($rows);
		
		
	}//end of runMySql() method


	
	public function run($sql) {
		return $this->run_remote_query($sql);
	} //end of run() method



	public function load($results, $class) {
		$objects = array();

		foreach($results as $result) {
			$class_name = get_class($class);
						
			if ($class_name == 'User') {
				$object = new User();	
			}
			if ($class_name == 'Area') {
				$object = new Area();	
			}
			if ($class_name == 'Crag') {
				$object = new Crag();	
			}
			if ($class_name == 'Route') {
				$object = new Route();	
			}
			
			foreach (BaseModel::getClassProperties($class) as $prop) {

				try {
					$name = $prop->getName();
					$value = $result[$name];
					$prop->setValue($object,$value);
				} catch (Exception $e) {
					
				}//end of try/catch
			
			}//end of Inner foreach loop
			
			array_push($objects, $object);
		}//end of Outer foreach loop

		if (count($objects) == 1) {
			return $objects[0];
		} else {
			return $objects;	
		}//end of if/else
		
	}//end of load() method



	function run_remote_query($sql) {

		$url = "http://www.business.colostate.edu/john.l.hagler11/db.php";
		// create a new cURL resource
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    	curl_setopt($ch, CURLOPT_POSTFIELDS, array("sql"=>$sql));

		$content = curl_exec($ch);

		// close cURL resource, and free up system resources
		curl_close($ch);
		//print_r($content);
		return json_decode($content,true);

	}//end of run_remote_query method


} //end of class Data

?>