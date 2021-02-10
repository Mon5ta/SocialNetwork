<?php
	require 'SQL/connection.php';
	if (isset($_SESSION['username'])) {
		$userLoggedIN = $_SESSION['username'];
		$userDetailsQuery = mysqli_query($connect,"SELECT * FROM users WHERE username='$userLoggedIN'");
		$user = mysqli_fetch_array($userDetailsQuery);
	} else {
		header("Location: Pages/register.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="Assets/CSS/style.css">
	<link rel="stylesheet" href="Assets/Icons/fa/font-awesome-4.7.0/css/font-awesome.min.css">
	<title>SocialNetwork</title>
</head>
<body>
	<div class="upperNavBar">
		<div class="logo">
			<a href="index.php">SocialNetwork</a>
		</div>
		<nav>
			<div class="name">
				<a href="#">
				<?php 
					echo $user['name'];
				?>
			</a>
			</div>
			<a href="index.php">
				<i class="fa fa-home fa-2x" aria-hidden="true"></i>
			</a>
			<a href="#">
				<i class="fa fa-users fa-2x" aria-hidden="true"></i>
			</a>
			<a href="#">
				<i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
			</a>
			<a href="#">
				<i class="fa fa-bell fa-2x" aria-hidden="true"></i>
			</a>
			<a href="#">
				<i class="fa fa-cog fa-2x" aria-hidden="true"></i>
			</a>
		</nav>
	</div>