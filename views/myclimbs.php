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
			$('#list-attempts tbody tr td li.remove').click(removeHandler);
			$('#list-attempts tbody tr td[data-attempt-status] li').click(updateStatusHandler);
			highlightStatus();
		});

	});
})();


var removeHandler = function () {

	var self = this;

	var id = $(this).parents('tr').data('attempt-id');

	var url = '?q=remove_attempt&attempt_id=' + id;

	$.post(url, function(data){

		if (data.success) {
			$(self).parents('tr').remove();	
		} else {
			alert('sorry, the server is down AGAIN!!!!!');
		}

	});

}


var highlightStatus = function () {
	$('#list-attempts tbody tr td[data-attempt-status]').each( function (){
		
		highlightIndividualStatus(this);

	});
}

var highlightIndividualStatus = function (el) {

	var status = $(el).data('attempt-status');

	$(el).find('li').addClass('secondary');

	if (status == 'nogo') {
		$(el).find('.' + status).removeClass('secondary').addClass('alert');
	} else if (status == 'summit') {
		$(el).find('.' + status).removeClass('secondary').addClass('success');
	}

}

var updateStatusHandler = function () {
	var td = $(this).parents('td');
	var status = $(td).data('attempt-status');
	var id = $(td).parent('tr').data('attempt-id');

	var newStatus = status == 'summit' ? 'nogo' : 'summit';
	$(td).data('attempt-status', newStatus);


	var url = '?q=update_attempt&attemptId=' + id + '&status=' + newStatus;
	$.post(url, function(data){
	
		if (data.success) {
			highlightIndividualStatus($(td));	
		} else {
			alert('sorry, the server is down AGAIN!!!!!');
		}
	

	});



}



</script>