  <form id="login-modal" action="?" method="post">
  		<input type="hidden" name="q" value="login">
  		<input type="hidden" name="forward" value="<?=$_REQUEST['q'] ?>">
     	<input type="email" name="user" placeholder="Email Address">
      	<input type="password" name="password" placeholder="Password">
      	<input type="submit" class="button button medium radius" value="Login">
  </form>