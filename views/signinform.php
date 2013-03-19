<form id="login-modal" action="?" method="get">
	<input type="hidden" name="q" value="login">
	<input type="hidden" name="forward" value="<?=$_REQUEST['q'] ?>">
	<input type="hidden" name="route_id" value="<?=$_REQUEST['route_id'] ?>">
	<input type="email" name="user" placeholder="Email Address">
	<input type="password" name="password" placeholder="Password">
	<input type="submit" class="button button medium radius" value="Login">
</form>