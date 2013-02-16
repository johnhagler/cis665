<?php include 'templates/route_details.php'; ?>

<div class="row">
	<div class="twelve columns">
		<div id="route-details"></div>		
	</div>
</div>
	


<?php 
$route = $_REQUEST['route'];
?>

<script>
	var detailTmpl = Handlebars.compile($("#route-details-template").html());
	$.getJSON('?q=list_route_details&route=<?=$route ?>', function(json) {
		$('#route-details').html(detailTmpl(json));
	});
</script>