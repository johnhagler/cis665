<div class="row">
	<div class="twelve columns panel radius">
		<h1>My Climbs</h1>
		<h3><small>Look at all that climbing you did!  You ROCK!</small></h3>
	</div>
</div>
<style>
a.remove:hover {
	color:#c60f13;
}
</style>

<div class="row">
	<div class="twelve columns">
		<table class="twelve" id="list-attempts">
			

		</table>
	</div>
</div>


<script>

(function(){
	
	$.getJSON('?q=list_attempts', function(json) {

		$.get('views/templates/list_attempts.html', function(data) {
			var detailTmpl = Handlebars.compile(data);
			$('#list-attempts').html(detailTmpl(json));
			$('.remove').click(removeHandler);
			updateStatus();
		});

	});
})();

var removeHandler = function () {
	$(this).parents('tr').remove();
	return false;
}

var updateStatus = function () {
	$('#list-attempts tbody tr td[data-attempt-status]').each( function (){
		var status = $(this).data('attempt-status');

		if (status == 'nogo') {
			$(this).find('.' + status).removeClass('secondary').addClass('alert');
		} else if (status == 'summit') {
			$(this).find('.' + status).removeClass('secondary').addClass('success');
		}
		
		

	});
}



</script>