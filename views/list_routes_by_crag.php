

<div class="row">
	<div class="twelve columns">
		<h1>List Routes by Crag</h1>
	</div>
</div>


<div class="row">
	<div class="twelve columns">

		<table>
			<tr>
				<th> Route Name</th>
			</tr>

			<?php
				foreach($data as $row) {
			?>
			<tr>
				<td><?=$row['RouteName'] ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>	