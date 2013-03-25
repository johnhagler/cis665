<?php


/* CIS665 - PHP Project - ClimbIt Application
*	Team: John Hagler, Anna Chernyavskaya
* 	Date: March 24, 2013
*	Purpose: db.php - Data class - contains methods to connect to sql and retrieve data from the ClimbItDB database
*/




class Data {

	private $_serverName;
	private $_uName;
	private $_pWord;
	private $_db;

	public function __construct() {

		$this->_serverName = 'bussql2012-cis';
	    $this->_uName = 'climber';
	    $this->_pWord = 'secret';
	    $this->_db = 'ClimbItDB';		

	}

	public function run($sql) {

		return $this->_executeQuery($sql);

	} //end of run() method


	private function _dbConnect() {

	    
	    try {
	        //instantiate a PDO object and set connection properties
	        $conn_string = "sqlsrv:Server=$this->_serverName; Database=$this->_db";
	        $conn = new PDO(
	        	$conn_string, 
	        	$this->_uName, 
	        	$this->_pWord, 
	        	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	        
	        //return connection object

	        return $conn;
	    }
	    // if connection fails
	    
	    catch (PDOException $e) {
	        die('Connection failed: ' . $e->getMessage());
	    }
	}

	//method to execute a query - the SQL statement to be executed, is passed to it

	private function _executeQuery($query) {
	    // call the dbConnect function

	    $conn = $this->_dbConnect();

	    try {
	        // execute query and assign results to a PDOStatement object

	        $stmt = $conn->query($query);

	        do {
	            if ($stmt->columnCount() > 0)  // if rows with columns are returned
	            {
	                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  //retreive the rows as an associative array
	            }
	        } 
	        while ($stmt->nextRowset());  // if multiple queries are executed, repeat the process for each set of results


	        $this->_dbDisconnect($conn);

	        return $results;
	    }

	    catch (PDOException $e) {
	        //if execution fails
	        $this->_dbDisconnect($conn);
	        die ('Query failed: ' . $e->getMessage());
	    }
	}


	private function _dbDisconnect($conn) {
	    // closes the specfied connection and releases associated resources

	    $conn = null;
	    
	}



} //end of class Data

?>
