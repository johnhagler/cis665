<div class="row">
	<div class="twelve columns panel radius">
		<h1>Login</h1>
	</div>
</div>

<div class="row">
	<div class="six columns centered">
		<div class="alert-box alert">Invalid username or password</div>
		<form id="login-modal" action="?" method="post">
	  		<input type="hidden" name="q" value="login">
	  		<input type="hidden" name="forward" value="<?=$_REQUEST['forward'] ?>">
	     	<input type="email" name="user" placeholder="Email Address" autofocus >
	      	<input type="password" name="password" placeholder="Password">
	      	<input type="submit" class="button button medium radius" value="Login">
	  </form>
	</div>
</div>