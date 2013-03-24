<footer class="row">
	<div class="twelve columns">
		<hr>
		<div class="row">
			<div class="six columns">
				<p>Coast to Coast Designs Inc. &copy; 2013</p>
			</div>
			<div class="six columns">
				<ul class="inline-list right">
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">Facebook</a></li>
					<li><a href="#">Twitter</a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>

<div id="myModal" class="reveal-modal">
  <h2>Hi there, glad you're back!</h2>
  <form id="login-modal" action="?" method="post">
  		<input type="hidden" name="q" value="login">
  		<input type="hidden" name="forward">
     	<input type="email" name="user" placeholder="Email Address">
      	<input type="password" name="password" placeholder="Password">
      	<input type="submit" class="button button medium radius" value="Login">
  </form>
</div>

<script type="text/javascript">
	$("#login").click(function (){
		$('input[name=forward]').val(App.getUrlParams()['q']);
    	$("#myModal").reveal();
    	$("#login-modal input[name=user]").focus();
    	return false;
   	});
</script>

</body>
</html>