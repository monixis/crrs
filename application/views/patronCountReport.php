<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<style>
	td {width: 120px;}
</style>
<table id="resTable" style="width: 300px; margin-left:100px;">
	<thead>
		<tr>
			<th>Time</th>
			<th>Total Patron Count</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($hours as $row1) {
			$hours = $row1 -> time;
			$patronCount = $row1 -> patroncount;	
		?> 
		<tr><td><?php echo $hours; ?></td><td><?php echo $patronCount; ?></td></tr>
		<?php
		}
		?>
	</tbody>
</table>