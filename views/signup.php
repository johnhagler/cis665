<div class="row">
	<div class="twelve columns panel radius">
		<h1>Sign Up</h1>
	</div>
</div>



<div class="row">
	<div class="twelve columns">
		<form id="signup" action="?q=signup" method="post">
			<input type="hidden" name="q" value="signup">
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Name</label>
				</div>
				<div class="ten mobile-three columns">
					<div class="row">
						<div class="four columns">
							<label for="first_name" style="display:none">First Name</label>
							<input type="text" id="first_name" name="first_name" placeholder="First name" autofocus>
						</div>
						<div class="four columns end">
							<label for="first_name" style="display:none">Last Name</label>
							<input type="text" id="last_name" name="last_name" placeholder="Last name">
						</div>
					</div>
					
					
				</div>
			</div>
			<div class="row">
			    <div class="two mobile-one columns">
			      <label for="user_id" class="right inline">Email</label>
			    </div>
			    <div id="email" class="ten mobile-three columns">
			      <input type="email" id="user_id" name="user_id" class="eight" />
			      <small style="display:none" class="error eight"></small>
			    </div>
			 </div>
			 <div class="row">
			    <div class="two mobile-one columns">
			      <label for="password" class="right inline">Password</label>
			    </div>
			    <div class="five mobile-three columns end">
			      <input type="password" id="password" name="password" class="eight" />
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
	
$(document).ready(function() {
  $.ajaxSetup({ cache: false });
});
	
	var submit = true;

	var validate = function () {
		submit = true;
		submit = App.Validate.required($('input[name=first_name]'));
		submit = App.Validate.required($('input[name=last_name]'));
		submit = App.Validate.required($('input[name=user_id]'));
		submit = App.Validate.minLength($('input[name=password]'), 6);
		return submit;
	}

	var disableSubmit = function () {
		$("#signup input[type=submit]").prop('disabled',false);
	}
	var enableSubmit = function () {
		$("#signup input[type=submit]").prop('disabled',true);
	}


	
	$("form#signup").submit(function (){
		return validate();
	});

	$("input[name=user_id]").change(function(){
		var user_id = $(this).val();
		
		if ((submit = App.Validate.required($(this)))) {

			$.getJSON('?q=user_check_unique&user_id=' + user_id, function(user) {

				if (!user.unique) {
					$("#email input").addClass("error");
					$("#email small").html(user_id + ' is already being used').show();
					enableSubmit();
					submit = false;
				} else {
					$("#email input").removeClass("error");
					$("#email small").html('').hide();
					disableSubmit();
					submit = true;
				}

		    });
		} else {
			submit = false;
		}

	});

	$('input[name=first_name], input[name=last_name]').change(function() {
		submit = App.Validate.required($(this));
	});

	$('input[name=password]').change(function (){
		submit = App.Validate.minLength($(this),6);
	});




	
</script>