<?php


require_once ("db.php");
require_once ("route.php");



		$route_name = $_POST['route_name'];
		$area = $_POST['area'];
		$crag = $_POST['crag'];
		$grade = $_POST['grade'];


		//call search_routes_multi method
		$route_list = search_routes_multi($route_name, $area, $crag, $grade);


		//count the number of returned records
		$search_results = count($route_list);

		echo "Number of Matches: " . $search_results;


		echo "<section";

		if ($search_results == 0)
		{
			echo "<br/> Sorry. No matches found. Please try your search again.";
		}
		else
		{
			$display = 
			"<table>
				<caption> $search_results were found </caption>
				<thead>
					<tr> 
						<th> Route Name</th>";

			foreach ($search_results as $route) 
			{
				extract($route);
					$routeNum++;
					$display .= $route_name;
			}

		}





?>