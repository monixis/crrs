<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
	<head>
		<title>Reserve Form Success</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
		<link rel="stylesheet" href="./styles/main.css" />
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
	</head>

	<body>

		<div id="confirmations"></div><h1 style="color: #b31b1b; font-size: 32px; text-align: center;"><?php echo $header;?></h1>
		<p style="font-size: 20px; text-align: center; text-decoration: bold;"><?php echo $info;?></p><br/>


	</body>
<?php
if($slotid>0) {
	$slotId = $slotid;

	$reservation = parse_ini_file('reservation.ini');
	$size = sizeof($reservation);
	if ($size == 0) {
		$data['tentativeSlots'] = null;
	}
	$tentativeIni = array();
	for ($i = 0; $i < $size; $i++) {
		if ($slotId == $reservation[$i]) {
			$i = $i + 5;

		} else if ($i < $size) {
			array_push($tentativeIni, $reservation[$i]);
		}
	}
	$newSize = sizeof($tentativeIni);
	if ($newSize == 0) {
		fopen("reservation.ini", 'w');
	}
	if ($newSize > 0) {
		$fp = fopen("reservation.ini", 'w');

		for ($i = 0; $i < $newSize; $i++) {
			if ($tentativeIni[$i] != null) {
				$string = "$i = $tentativeIni[$i] \n";
				fwrite($fp, $string);
			}
		}
	}
}
?>
</html>
