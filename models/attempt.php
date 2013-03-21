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

	}//end of log() method



	//get attempt details by attemptId
	function get_attempt_details ($attemptId) {

		//execute sql query on the database
		$sql = "select 
					a.UserID, a.AttemptID, a.RouteId, b.RouteName, 
					a.StartDateTime, a.EffortRating, a.AttemptStatus
				from 
					Attempt a, Route b
				where 
					a.RouteID = b.RouteID
				and a.AttemptID = $attemptId";

		$db = new Data();//create new data/connect object

		$results = $db -> run($sql);

		foreach ($results as $result) {
			$attempt = array (
				'routeId' 		=> $result['RouteID'],
				'attemptId' 	=> $result['AttemptID'],
				'userId' 		=> $result['UserID'],
				'routeName' 	=> $result['RouteName'],
				'startDateTime' => $result['StartDateTime'],
				'effortRatng' 	=> $result['EffortRating'],
				'status' 		=> $result['AttemptStatus']
				);

		}//end of foreach
		
		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($attempt); //display attempt details data in JSON format

	}//end of get_attempt_details() method




	//method to delete attempt report from user's climbs
	function delete_attempt($attemptId) {

		$sql = "delete from Attempt where AttemptID = $attemptId";

		$db = new Data();
		$db->run($sql);

	}//end of delete_attempt() method



	function update_attempt($attemptId, $status) {

		$sql = "Update 
					Attempt 
				Set 
					AttemptStatus = '$status'
				Where 
					AttemptID = '$attemptId'
				";

		$db = new Data();
		$db -> run($sql);


		$data = array('success' => true);


		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display routes data in JSON format

	}//end of update_attempt() method



	//method to produce a listing of all user attempts by user ID
	function list_attempts_by_user($user) {

		//execute sql query on the DB to get route data
		$sql = "select a.AttemptID, a.UserID, a.RouteID, 
						convert(varchar, a.StartDateTime, 100) as StartDateTime,
						
						a.EffortRating, a.AttemptStatus,
						CONCAT(b.FirstName, ' ', b.LastName) AS UserName, 
						c.RouteName, c.RouteType, c.Grade,
						d.CragName, e.AreaName
				from 
					Attempt a, [User] b, Route c, Crag d, Area e 
				where 
				    e.AreaID  = d.AreaID
				and d.CragID  = c.CragID
				and c.RouteID = a.RouteID
				and a.UserID  = b.UserID 
				and a.UserID  = '$user'
				Order by a.StartDateTime DESC";

				
		$db = new Data(); //create connection object

		$results = $db->run($sql); //execute the sql query and assign the results of the query to 'results' variable

		$attempts = array();//create "attempts" array


		//loop through the query results to create an array "attempt"
		foreach ($results as $result) {

			$attempt = array (
				'attemptId' => $result['AttemptID'],
				'userId' => $result['UserID'],
				'userName' => $result['UserName'],
				'routeId' => $result['RouteID'],
				'routeName' => $result['RouteName'],
				'routeType' => $result['RouteType'],
				'grade' => $result['Grade'],
				'areaName' => $result['AreaName'],
				'cragName' => $result['CragName'],
				'startDateTime' => $result['StartDateTime'],
				'effortRating' => $result['EffortRating'],
				'attemptStatus' => $result['AttemptStatus'],
				);

			array_push($attempts, $attempt);//stack the array

		}//close foreach loop

		$data = array('attempts' => $attempts); //assign "attempts" array to a $data object

		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display routes data in JSON format

	}//close list_attempts_by_user() method



}//end of class

?>