<div id="target"></div>

<div class="row">
	<div class="twelve columns">
		<div id="route-details"></div>		
	</div>
</div>

<script>

(function(){
	var vars = App.getUrlParams();

	$.getJSON('?q=list_route_details&routeId=' + vars.routeId, function(json) {

		$.get('views/templates/route_details.html', function(data) {
			var detailTmpl = Handlebars.compile(data);
			$('#route-details').html(detailTmpl(json));
		});

	});
})();
	
</script>