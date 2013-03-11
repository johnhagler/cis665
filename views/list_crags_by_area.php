

<div class="row">
	<div class="twelve columns">
		<h1>List Crags by Area</h1>
	</div>
</div>


<div class="row">
	<div class="twelve columns">

		<table>
			<tr>
				<th> Crag Name</th>
			</tr>

			<?php
				foreach($data as $row) {
			?>
			<tr>
				<td><?=$row['CragName'] ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>	

