


<div class="row">
	<div class="twelve columns">
		<h1>List Areas</h1>
	</div>
</div>



<div class="row">
	<div class="twelve columns">
			
		<table>
			<tr>
				<th>Area Name</th>
			</tr>
			<?php
				foreach($data as $row) {
			?>
			<tr>
				<td><?=$row['AreaName'] ?></td>
			</tr>
			<?php } ?>
		</table>



	</div>
</div>
