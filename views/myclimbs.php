<div class="row">
	<div class="twelve columns panel radius">
		<h1>My Climbs</h1>
		<h3><small id="message"></small></h3>
	</div>
</div>

<div class="row" id="stats">
	<script type="x-template" id="stats-template">
		<div class="three columns text-centered" id="stats">
			{{thirtyDays}} climbs in last 30 days
		</div>
		<div class="three columns text-centered" id="stats">
			{{sixtyDays}} climbs in last 60 days
		</div>
		<div class="three columns text-centered" id="stats">
			{{allTime}} climbs overall
		</div>
		<div class="three columns text-centered" id="stats">
			{{summits}} climbs summited, {{summitPct}} success!
		</div>
	</script>
</div>

<div class="row">
	<div class="twelve columns">
		<table class="twelve" id="list-attempts"></table>
	</div>
</div>


<script>






var statsTmpl;

var getStats = function () {
	
	$.getJSON('?q=get_attempt_statistics', function(json) {
		if (statsTmpl === undefined) {
			statsTmpl = Handlebars.compile($('#stats-template').html());
		}
		$('#stats').html(statsTmpl(json));

	});
}

var removeHandler = function () {

	var self = this;

	var id = $(this).parents('tr').data('attempt-id');

	var url = '?q=remove_attempt&attempt_id=' + id;

	$.post(url, function(data){

		if (data.success) {
			$(self).parents('tr').remove();	
			getStats();
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


	var url = '?q=update_attempt&attempt_id=' + id + '&status=' + newStatus;
	$.post(url, function(data){
	
		if (data.success) {
			highlightIndividualStatus($(td));	
			getStats();
		} else {
			alert('sorry, the server is down AGAIN!!!!!');
		}
	

	});

}

var highlightRating = function () {
	$('#list-attempts tbody tr td[data-rating]').each( function (){
		
		highlightIndividualRating(this);

	});
}

var highlightIndividualRating = function (el) {
	var rating = $(el).data('rating');

	$(el).find('[data-rate]').removeClass('rate-active');

	if (rating >= 1) {
		$(el).find('[data-rate=1]').addClass('rate-active');
	}
	if (rating >= 2) {
		$(el).find('[data-rate=2]').addClass('rate-active');
	}
	if (rating >= 3) {
		$(el).find('[data-rate=3]').addClass('rate-active');
	}
	if (rating >= 4) {
		$(el).find('[data-rate=4]').addClass('rate-active');
	}
	if (rating == 5) {
		$(el).find('[data-rate=5]').addClass('rate-active');
	}
}

var updateRatingHandler = function () {
	var td = $(this).parents('td');
	var rating = $(this).data('rate');
	var id = $(td).parent('tr').data('attempt-id');

	
	$(td).data('rating', rating);

	highlightIndividualRating($(td));	

	
	var url = '?q=update_attempt&attempt_id=' + id + '&effort=' + rating;
	$.post(url, function(data){
	
		if (data.success) {
			highlightIndividualRating($(td));	
		} else {
			alert('sorry, the server is down AGAIN!!!!!');
		}
	

	});
	

}



getStats();

$.getJSON('?q=list_attempts', function(json) {
	
	$('#message').html(json.message);

	if (json.attempts.length > 0) {

		$.get('views/templates/list_attempts.html', function(data) {
			var detailTmpl = Handlebars.compile(data);
			$('#list-attempts').html(detailTmpl(json));
			$('#list-attempts tbody tr td[data-rating] span').click(updateRatingHandler);
			$('#list-attempts tbody tr td[data-attempt-status] li').click(updateStatusHandler);
			$('#list-attempts tbody tr td li.remove').click(removeHandler);
			
			highlightStatus();
			highlightRating();
		});

	}

});


</script>