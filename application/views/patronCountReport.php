<link rel="stylesheet" type="text/css" href="./styles/main.css" />
<style>
	td {width: 120px;}
</style>

		<?php
		if($hours!= null) { ?>
			<table id="resTable" style="width: 300px; margin-left:100px;">
				<thead>
					<tr>
						<th>Room Number</th>
						<th>Time</th>
						<th>Total Patron Count</th>
						<th>Primary Patron Email</th>
					</tr>
				</thead>
				<tbody>
			<?php
		foreach ($hours as $row1) {
			$roomNum = $row1 -> roomNum;
			$hours = $row1 -> time;
			$patronCount = $row1 -> patroncount;
			$resEmail = $row1 -> resEmail;
		?>
		<tr>
			<td><?php echo $roomNum; ?></td>
			<td><?php echo $hours; ?></td>
			<td><?php echo $patronCount; ?></td>
			<td><?php echo $resEmail; ?></td>
		</tr>
		<?php
	}}
	else {
		echo "<h2>No bookings made.<h2>";
	}
		?>
	</tbody>
</table>
