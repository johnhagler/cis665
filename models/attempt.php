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
	public $user_notes;

	public function __construct() {
		$user = $_SESSION['user'];
		$this->user_id = $user->user_id;
	}


	public function log() {

		$attempt_datetime = $this->attempt_date . ' ' . $this->attempt_time;		

		$sql = "insert into Attempt 
			(RouteID, UserID, StartDateTime, EffortRating, AttemptStatus, UserNotes)
			
			values (
				'$this->route_id', 
				'$this->user_id', 
				'$attempt_datetime', 
				'$this->effort', 
				'$this->status',
				'$this->user_notes'
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
					a.StartDateTime, a.EffortRating, a.AttemptStatus, a.UserNotes
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
				'status' 		=> $result['AttemptStatus'],
				'userNotes'		=> $result['UserNotes']
				);

		}//end of foreach
		
		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($attempt); //display attempt details data in JSON format

	}//end of get_attempt_details() method




	//method to delete attempt report from user's climbs
	function remove_attempt() {

		$sql = "delete from Attempt where AttemptID = $this->attempt_id";

		$db = new Data();
		$db->run($sql);

		$data = array('success' => true);

		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display routes data in JSON format

	}//end of remove_attempt() method




	function update_attempt() {


		$sql = "Update 
					Attempt 
				Set ";

		if ($this->status != '') {
			$sql .= " AttemptStatus = '$this->status',";
		}
		if ($this->attempt_date != '' || $this->attempt_time != '') {
			$sql .= " StartDateTime = '$this->attempt_date $this->attempt_time',";
		}		
		if ($this->effort != '') {
			$sql .= " EffortRating = '$this->effort',";
		}			
		if ($this->user_notes != '') {
			$sql .= " UserNotes = '$this->user_notes',";
		}			
		
		//strip off the last comma
		$sql = substr_replace($sql, '', -1, strlen($sql));

		$sql .= " Where  AttemptID = '$this->attempt_id' ";

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
						
						a.EffortRating, a.AttemptStatus, a.UserNotes,
						CONCAT(b.FirstName, ' ', b.LastName) AS UserName, 
						c.RouteName, c.RouteType, f.Grade,
						d.CragName, e.AreaName
				from 
					Attempt a, [User] b, Route c, Crag d, Area e, Grade f
				where 
				    e.AreaID  = d.AreaID
				and d.CragID  = c.CragID
				and c.RouteID = a.RouteID
				and a.UserID  = b.UserID 
				and c.GradeID = f.GradeID
				and a.UserID  = '$user'
				Order by a.StartDateTime DESC";

				
		$db = new Data(); //create connection object

		$results = $db->run($sql); //execute the sql query and assign the results of the query to 'results' variable

		$attempts = array();//create "attempts" array

		$message = '';
		if (count($results) == 0) {
			$message = 'You haven\'t done any climbing yet.  Get to it!';
		} else {
			$message = 'Look at all that climbing you did.  You rock!';
		}

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
				'userNotes' 	=> $result['UserNotes']
				);

			array_push($attempts, $attempt);//stack the array

		}//close foreach loop

		$data = array(
			'attempts' => $attempts,   //assign "attempts" array to a $data object
			'message' => $message
			); 

		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display routes data in JSON format

	}//close list_attempts_by_user() method

	function get_attempt_statistics($user_id) {

		$sql = "
			select
			sum(THIRTY) as THIRTY,
			sum(SIXTY) as SIXTY,
			sum(ALLTIME) as ALLTIME,
			sum(SUMMITS) AS SUMMITS,

			cast(sum(SUMMITS) as decimal) /
			cast(sum(ALLTIME) as decimal) * 100 as SUMMIT_PCT

			from (
			select
			case when startdatetime > (getdate() - 30) then 1 else 0 end as THIRTY,
			case when startdatetime > (getdate() - 60) then 1 else 0 end as SIXTY,
			1 as ALLTIME,
			case when AttemptStatus = 'summit' then 1 else 0 end as SUMMITS
			from attempt
			where UserID = '$user_id'
			) as a

		";
		
		$db = new Data();

		$results = $db->run($sql);

		foreach ($results as $result) {

			$data = array (
				'thirtyDays' => number_format($result['THIRTY'],0,'.',','),
				'sixtyDays' => number_format($result['SIXTY'],0,'.',','),
				'allTime' => number_format($result['ALLTIME'],0,'.',','),
				'summits' => number_format($result['SUMMITS'],0,'.',','),
				'summitPct' => number_format($result['SUMMIT_PCT'],0,'.',',') . '%'
				);
		}


		header('Content-type: application/json'); //designate the content to be in JSON format
		echo json_encode($data); //display routes data in JSON format
	}



}//end of class

?>