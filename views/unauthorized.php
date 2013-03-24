<div class="row">
	<div class="twelve columns">
		<h1>Hold on just a sec...</h1>
	</div>
</div>

<div class="row">
	<div class="six columns">
		<h3>Already signed up?</h3>
		<form id="login-modal" action="?" method="post">
			<input type="hidden" name="q" value="login">
			<input type="hidden" name="forward">
			<input type="hidden" name="route_id">
			<input type="email" name="user" placeholder="Email Address">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" class="button button medium radius" value="Login">
		</form>
	</div>
	<div class="six columns">
		<h3>You new around here?</h3>
		<div class="text-center">
			
			<a href="?q=signup" class="button large radius">Sign up now!</a>
			
		</div>
	</div>
</div>
<script type="text/javascript">
	(function (){
		var params = App.getUrlParams();
		$('input[name=forward]').val(params.q);
		$('input[name=route_id]').val(params.route_id);
   	})();
</script>