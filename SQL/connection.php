<?php 

	session_start();

	ob_start();

	$timezone = date_default_timezone_set("Europe/Athens");

	$connect = mysqli_connect("localhost", "Agent47", "CreateA5trongPa55word", "sonedb");

	if (mysqli_connect_errno()) {
		echo "Failed to connect : " . mysqli_connect_errno();
	}

 ?>