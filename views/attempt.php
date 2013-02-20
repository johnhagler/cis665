<div class="row">
	<div class="twelve columns panel radius">
		<h1>Log your climb</h1>
	</div>
</div>

<div class="row">
	<div class="twelve columns">
		<h2>Route B</h2>
		<h3 class="subheader"><small>Central Oregon, Smith Rock</small></h3>
	</div>
</div>
<form id="attempt-form" action="?" method="post">
	<input type="hidden" name="q" value="log_attempt">
	<input type="hidden" id="status" name="status" value="" >
	<input type="hidden" id="route_id" name="route_id" value="123" >
	<input type="hidden" id="user_id" name="user_id" value="<?=$user_id ?>" >

	<div class="row">
		<div class="twleve columns">
			<div class="row collapse">
			      <div class="four mobile-one columns">
			        <span class="prefix">Climb Date</span>
			      </div>
			      <div class="four mobile-two columns">
			        <input type="date" name="attempt_date" value="<?php echo date('Y\-m\-d') ?>">
			      </div>
			      <div class="four mobile-one columns">
			        <input type="time" name="attempt_time" value="<?php echo date('H\:i\:s') ?>">
			      </div>
			    </div>
			</div>
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

	
</script>
