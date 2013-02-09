<?php



$q = $_REQUEST['q'];

if ($q == 'listRoutes') {
	listRoutes();
}
if ($q == 'popularRoutes') {
	popularRoutes();
}
if ($q == 'newRoutes') {
	newRoutes();
}
if ($q == 'list_areas') {
	list_areas();
}
if ($q == 'list_crags') {
	list_crags_by_area($_REQUEST['area']);
}
if ($q == 'list_routes') {
	list_routes_by_crag($_REQUEST['crag']);
}

if ($q == 'list_route_details') {
	list_route_details($_REQUEST['route']);
}

function list_areas() {
	$data = array ('areas'=>
		array(
			array(
				'name'=>'Central Oregon'
				),
			array(
				'name'=>'Northern Cali'
				),
			array(
				'name'=>'Central Cali'
				),
			)
		);
	header('Content-type: application/json');
	echo json_encode($data);
}

function list_crags_by_area($area) {
	if ($area == 'Central Oregon') {
		$data = array ('crags'=>
		array(
			array(
				'name'=>'Stein\'s Piller'
				),
			array(
				'name'=>'Dry Creek Canyon'
				),
			array(
				'name'=>'Smith Rock'
				),
			)
		);
	}

	if ($area == 'Northern Cali') {
		$data = array ('crags'=>
		array(
			array(
				'name'=>'Sea Crag'
				),
			array(
				'name'=>'Castle Rock'
				),
			array(
				'name'=>'Bidwell Park'
				),
			)
		);
	}

	if ($area == 'Central Cali') {
		$data = array ('crags'=>
		array(
			array(
				'name'=>'Cabrillo Peak'
				),
			array(
				'name'=>'Pirates Cove'
				),
			array(
				'name'=>'Twin Rocks'
				),
			)
		);
	}
	
	header('Content-type: application/json');
	echo json_encode($data);
}

function list_routes_by_crag($crag) {
	
	$data = array ('routes'=>
	array(
		array(
			'name'=>'Route A' . rand(1,9)
			),
		array(
			'name'=>'Route B' . rand(1,9)
			),
		array(
			'name'=>'Route C' . rand(1,9)
			),
		)
	);
	
	
	header('Content-type: application/json');
	echo json_encode($data);
}

function list_route_details($route) {
	$data = array ('name'=>$route);
	
	header('Content-type: application/json');
	echo json_encode($data);
}


function popularRoutes() {
	$data = array ( 'routes' =>
		array (
			array(
				'area'=>'Central Oregon',
				'crag'=>'Smith Rock',
				'route'=>'Route A'
				),
			array(
				'area'=>'Central Oregon',
				'crag'=>'Smith Rock',
				'route'=>'Route B'
				),
			array(
				'area'=>'Northern Cali',
				'crag'=>'Blackstone',
				'route'=>'Sunriser'
				)
			)
		);
	header('Content-type: application/json');
	echo json_encode($data);
}
function newRoutes() {
	$data = array ( 'routes' =>
		array (
			array(
				'area'=>'Northern Cali',
				'crag'=>'Blackstone',
				'route'=>'Sunriser'
				),
			array(
				'area'=>'Central Oregon',
				'crag'=>'Smith Rock',
				'route'=>'Snake run'
				),
			array(
				'area'=>'Colorado',
				'crag'=>'Red Rocks',
				'route'=>'Crimson Peak'
				)
			)
		);
	header('Content-type: application/json');
	echo json_encode($data);
}

function listRoutes() {

	$data = array (
		'cols' => 
			array(
				array(
					'name' => 'area',
					'title' => 'Area',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'crag',
					'title' => 'Crag',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'route',
					'title' => 'Route',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'stoneType',
					'title' => 'Stone Type',
					'sortStyle' => 'alpha'
				),
				array(
					'name' => 'approachTime',
					'title' => 'Time to Approach',
					'sortStyle' => 'numeric'
				)
			),
		rows =>
			array (
				array (
					'area' => 'Central Oregon',
					'crag' => 'Smith Rock',
					'route' => 'Route A',
					'routeId' => '625c65a3-d31c-4799-bd9b-62a53da06f68',
					'stoneType' => 'Sandstone',
					'approachTime' => 30
				),
				array (
					'area' => 'Oregon Coast',
					'crag' => 'Black Rock',
					'route' => 'To the Top!',
					'routeId' => 'c3aa69be-8158-459d-9c96-75adc5544615',
					'stoneType' => 'Granite',
					'approachTime' => 12
				),
				array (
					'area' => 'Central Oregon',
					'crag' => 'Smith Rock',
					'route' => 'Route B',
					'routeId' => 'b7e02fa4-a796-40e0-9162-e4bdf6c829ca',
					'stoneType' => 'Sandstone',
					'approachTime' => 22
				),
				array (
					'area' => 'Central Oregon',
					'crag' => 'Smith Rock',
					'route' => 'Route C',
					'routeId' => '7510294f-1ac0-4611-b008-c5c2803b86c2',
					'stoneType' => 'Sandstone',
					'approachTime' => 26
				),
				array (
					'area' => 'Northern California',
					'crag' => 'Wildnerss Peaks',
					'route' => 'Straight up',
					'routeId' => 'ec8d15be-2b34-4eb3-95dd-1846fd59525e',
					'stoneType' => 'Granite',
					'approachTime' => 23
				)
			)
		);
	header('Content-type: application/json');
	echo json_encode($data);
}

?>