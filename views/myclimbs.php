<div class="row">
	<div class="twelve columns panel radius">
		<h1>My Climbs</h1>
		<h3><small>Look at all that climbing you did!  You ROCK!</small></h3>
	</div>
</div>
<style>
a.remove:hover {
	color:#c60f13;
}
</style>

<div class="row">
	<div class="twelve columns">
		<table class="twelve">
			<tr>
				<th><a href="#">Area</a></th>
				<th><a href="#">Crag</a></th>
				<th><a href="#">Route</a></th>
				<th><a href="#">Difficulty</a></th>
				<th><a href="#">Type</a></th>
				<th><a href="#">Grade</a></th>
				<th><a href="#">Attempts</a></th>
				<th><a href="#">Summits</a></th>
				<th><a href="#">Rating</a></th>
				<th></th>
			</tr>

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="padding:0;" >
					<ul class="button-group radius" style="margin:0;">
						<li><a href="" class="button tiny secondary">
							<i class="foundicon-flag"></i>
						</a></li>
						<li><a href="" class="button tiny alert">
							<i class="foundicon-error"></i>
						</a></li>
						<li><a href="" class="button tiny secondary remove">
							<i class="foundicon-remove"></i>
						</a></li>
					</ul>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="padding:0;" >
					<ul class="button-group radius" style="margin:0;">
						<li><a href="" class="button tiny secondary">
							<i class="foundicon-flag"></i>
						</a></li>
						<li><a href="" class="button tiny alert">
							<i class="foundicon-error"></i>
						</a></li>
						<li><a href="" class="button tiny secondary remove">
							<i class="foundicon-remove"></i>
						</a></li>
					</ul>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="padding:0;" >
					<ul class="button-group radius" style="margin:0;">
						<li><a href="" class="button tiny secondary">
							<i class="foundicon-flag"></i>
						</a></li>
						<li><a href="" class="button tiny alert">
							<i class="foundicon-error"></i>
						</a></li>
						<li><a href="" class="button tiny secondary remove">
							<i class="foundicon-remove"></i>
						</a></li>
					</ul>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="padding:0;" >
					<ul class="button-group radius" style="margin:0;">
						<li><a href="" class="button tiny secondary">
							<i class="foundicon-flag"></i>
						</a></li>
						<li><a href="" class="button tiny alert">
							<i class="foundicon-error"></i>
						</a></li>
						<li><a href="" class="button tiny secondary remove">
							<i class="foundicon-remove"></i>
						</a></li>
					</ul>
				</td>


		</table>
	</div>
</div>


<script>
	$('a.remove').click(function(){
		$(this).parents('tr').remove();
		return false;
	});


</script>