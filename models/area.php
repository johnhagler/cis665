<?php

require_once 'base.php';
require_once 'db.php';

class Area extends BaseModel {


	public $area_id;
	public $area_name;
	public $area_descr;
	public $area_state;
	public $area_city; 


	function __construct() {

	}


	public function list_areas() {


		$sql = "select * from [Area]";

		$db = new Data();	
		$results = $db->run($sql);	


		$areas = array();

		foreach ($results as $result) {

			$area = array (
				'areaId'=>$result['AreaID'],
				'name'=>$result['AreaName'],
				'descr'=>$result['AreaDescr'],
				'city'=>$result['AreaCity'],
				'state'=>$result['AreaState'],
				'approachTime'=>$result['ApproachTime']
				);

			array_push($areas, $area);

		}

		//echo '<pre>';
		//print_r($results);
		//echo '</pre>';

		$data = array( 'areas' => $areas);

		header('Content-type: application/json');
		echo json_encode($data);
		
	}


}


?>