<div class="row">
	<div class="twelve columns panel radius">
		<h1>Sign Up</h1>
	</div>
</div>



<div class="row">
	<div class="twelve columns">
		<form id="signup" action="?">
			<input type="hidden" name="q" value="signup">
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Name:</label>
				</div>
				<div class="ten mobile-three columns">
					<div class="row">
						<div class="four columns">
							<input type="text" name="first_name" placeholder="First name">
						</div>
						<div class="four columns end">
							<input type="text" name="last_name" placeholder="Last name">
						</div>
					</div>
					
					
				</div>
			</div>
			<div class="row">
			    <div class="two mobile-one columns">
			      <label class="right inline">Email:</label>
			    </div>
			    <div id="email" class="ten mobile-three columns">
			      <input type="email" name="user_id" class="eight" autofocus />
			      <small style="display:none" class="error eight"></small>
			    </div>
			 </div>
			 <div class="row">
			    <div class="two mobile-one columns">
			      <label class="right inline">Password:</label>
			    </div>
			    <div class="five mobile-three columns end">
			      <input type="password" name="password" class="eight" />
			    </div>
			 </div>
			 <div class="row">
			 	<div class="ten offset-by-two mobile-four columns">
			 		<input type="submit" name="submit" value="Sign me up!" class="button button-large even radius">
			 	</div>
			 </div>
		</form>
	</div>
</div>


<script type="text/javascript">
	$("input[name=user_id]").change(function(){
		var user_id = $(this).val();

		$.getJSON('?q=check_user&user_id=' + user_id, function(user) {

			if (!user.unique) {
				$("#email input").addClass("error");
				$("#email small").html(user_id + ' is already being used').show();
				
			} else {
				$("#email input").removeClass("error");
				$("#email small").html('').hide();
			}

	    });

	});
</script>