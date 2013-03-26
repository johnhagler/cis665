<div class="row">
	<div class="twelve columns panel radius">
		<h1>Log your climb</h1>
	</div>
</div>

<div class="row">
	<div class="twelve columns">
		<h2 id="route-name"></h2>
		<h3 class="subheader"><small id="location"></small></h3>
	</div>
</div>
<form id="attempt-form" action="?q=log_attempt" method="post">
	<input type="hidden" name="q" value="log_attempt">
	<input type="hidden" id="status" name="status" value="" >
	<input type="hidden" id="route_id" name="route_id" value="" >


	<div class="row">
		<div class="twelve columns">
			<div class="row collapse">
			      <div class="four mobile-one columns">
			        <span class="prefix">Climb Date</span>
			      </div>
			      <div class="four mobile-two columns">
			        <input type="text" name="attempt_date" id="attempt_date" value="<?php echo date('Y\-m\-d') ?>">
			      </div>
			      <div class="four mobile-one columns">
			        <input type="text" name="attempt_time" id="attempt_time" value="<?php echo date('H\:i') ?>">
			      </div>
			    </div>
			</div>
		</div>
	</div>

	<div class="row" style="margin-bottom:1em;">
		<div class="four mobile-one columns">
			<h3 style="margin-top:6px;">Rating</h3>
		</div>
		<div class="eight mobile-three centered columns">
			<div id="rate" class="rating">
				<input type="hidden" name="effort" value="0">
				<span data-rate="1">&#9733;</span>
				<span data-rate="2">&#9733;</span>
				<span data-rate="3">&#9733;</span>
				<span data-rate="4">&#9733;</span>
				<span data-rate="5">&#9733;</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="four columns">
			<h3>How'd it go?</h3>
		</div>
		<div class="eight columns">
			<textarea name="user_notes" id="user_notes" cols="30" rows="4"></textarea>
		</div>
	</div>

	<div class="row">
		<div class="twelve columns text-center">
			<ul class="button-group radius even two-up">
			  <li><a href="#" id="summit" class="button button-large " style="font-size:2em;padding:.5em;">
			  		<i class="foundicon-flag"></i>&nbsp;Summit&nbsp;<i class="foundicon-flag"></i>
			  </a></li>
			  <li><a href="#" id="nogo" class="button button-large " style="font-size:2em;padding:.5em;">
			  	<i class="foundicon-error"></i>&nbsp;No&nbsp;go&nbsp;<i class="foundicon-error"></i>
			  </a></li>
			</ul>
		</div>
	</div>

</form>


<script>

	$('#attempt_date').datepicker({ dateFormat: "yy-mm-dd" });
	$('#attempt_time').timepicker();

	var timeoutID;
 
	function delayedSubmit() {
		window.clearTimeout(timeoutID);
	    timeoutID = window.setTimeout(submitForm, 2000);
	}
	 
	function submitForm() {
	  $("#attempt-form").submit();
	}


	$('#summit').click(function () {
		$('#status').val('summit');
		$(this).addClass('success').removeClass('secondary');
		$('#nogo').removeClass('alert').addClass('secondary');
		delayedSubmit();
	});
	$('#nogo').click(function () {
		$('#status').val('nogo');
		$(this).addClass('alert').removeClass('secondary');
		$('#summit').removeClass('success').addClass('secondary');
		delayedSubmit();
	});

	$("#rate span").click(function(){
		var rate = $(this).data('rate');

		$('input[name=effort]').val(rate);
		

		$('span[data-rate]').removeClass('rate-active');
		
		if (rate >= 1) {
			$('#rate span[data-rate=1]').addClass('rate-active');
		}
		if (rate >= 2) {
			$('#rate span[data-rate=2]').addClass('rate-active');
		}
		if (rate >= 3) {
			$('#rate span[data-rate=3]').addClass('rate-active');
		}
		if (rate >= 4) {
			$('#rate span[data-rate=4]').addClass('rate-active');
		}
		if (rate == 5) {
			$('#rate span[data-rate=5]').addClass('rate-active');
		}
	});

	$("#rate span").hover(function(){
		var rate = $(this).data('rate');

		//$('span[data-rate]').removeClass('rate-hover');
		
		if (rate >= 1) {
			$('#rate span[data-rate=1]').toggleClass('rate-hover');
		}
		if (rate >= 2) {
			$('#rate span[data-rate=2]').toggleClass('rate-hover');
		}
		if (rate >= 3) {
			$('#rate span[data-rate=3]').toggleClass('rate-hover');
		}
		if (rate >= 4) {
			$('#rate span[data-rate=4]').toggleClass('rate-hover');
		}
		if (rate == 5) {
			$('#rate span[data-rate=5]').toggleClass('rate-hover');
		}
	});


	

	(function(){
		vars = App.getUrlParams();	
		$.getJSON('?q=list_route_details&routeId=' + vars.route_id, function(json) {
			$('#route-name').html(json.routeName);
			$('#location').html(json.areaName + ', ' + json.cragName);
			$("input[name=route_id]").val(json.routeId);
		});



	})();


</script>	