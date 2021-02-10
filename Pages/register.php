<?php 
	require '../SQL/connection.php';
	require 'Forms_Handlers/register_handler.php';
	require 'Forms_Handlers/login_handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome to SocialNetwork</title>
	<link rel="stylesheet" href="../Assets/CSS/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="../Assets/Javascript/register.js"></script>
</head>
<body>

	<?php 

		if (isset($_POST['register'])) {
			echo '<script>
					$(document).ready(function(){
					$("#first").hide();
					$("#second").show();
					});
				  </script>';
		}

	?>

	<div class="wrapper">
		<div class="loginBox">
			<div class="heading">
				<h1>SocialNetwork</h1>
				Become awesome!
			</div>
				<div id="first">
					<form action="register.php" method="POST">
						<?php
							if (in_array("Username or password is incorrect!<br>", $error_array))
								echo "Username or password is incorrect!<br>";
						?>
						 <input type="text" name="login_username_email" placeholder="Username" value="<?php
							if(isset($_SESSION['loginAttemptUser'])) {
								echo $_SESSION['loginAttemptUser'];
							}
						?>" required><br>
						 <input type="password" name="login_password" placeholder="Password"  required><br>
						 <input type="submit" name="login" value="Login">
					</form>
					<br>
						<a href="#" id="register" class="register">Need an account? Sign up here!</a>
				</div>
				<div id="second">
					<form action="register.php" method="POST">
						<input type="text" name="name" placeholder="First Name" value="<?php
							if(isset($_SESSION['name'])) {
								echo $_SESSION['name'];
							}
						?>" required>
						<br>
						<?php
							if (in_array("First name length must be between 2 and 50 characters long<br>", $error_array))
								echo "First name length must be between 2 and 50 characters long<br>";
						?>
						<input type="text" name="surname" placeholder="Last Name" value="<?php
							if(isset($_SESSION['surname'])) {
								echo $_SESSION['surname'];
							}
						?>" required>
						<br>
						<?php
							if (in_array("Last name length must be between 2 and 50 characters long<br>", $error_array))
								echo "Last name length must be between 2 and 50 characters long<br>";
						?>
						<input type="text" name="username" placeholder="Username" value="<?php
							if(isset($_SESSION['regusername'])) {
								echo $_SESSION['regusername'];
							}
						?>" required>
						<br>
						<?php
							if (in_array("Username length must be between 5 and 50 characters long<br>", $error_array))
								echo "Username length must be between 5 and 50 characters long<br>";
							if (in_array("Username already in use<br>", $error_array))
								echo "Username already in use<br>";
						?>
						<input type="email" name="email" placeholder="Email" required>
						<br>
						<?php
							if (in_array("Invalid email address.<br>", $error_array))
								echo "Invalid email address.<br>";
				
							if (in_array("Email adresses don't match<br>", $error_array))
								echo "Email adresses don't match<br>";
				
							if (in_array("Email already in use<br>", $error_array))
								echo "Email already in use<br>";
						?>
						<input type="email" name="emailConfirm" placeholder="Confirm Email" required>
						<br>
						<?php
							if (in_array("Email adresses don't match<br>", $error_array))
								echo "Email adresses don't match<br>";
						?>
						<input type="password" name="password" placeholder="Password" required>
						<br>
						<?php
							if (in_array("Password must contain only letters or numbers<br>", $error_array))
								echo "Password must contain only letters or numbers<br>";
				
							if (in_array("Passwords don't match<br>", $error_array))
								echo "Passwords don't match<br>";
				
							if (in_array("Password must be between 8 and 60 characters long<br>", $error_array))
								echo "Password must be between 8 and 60 characters long<br>";
						?>
						<input type="password" name="passwordConfirm" placeholder="Confirm Password" required>
						<br>
						<?php
							if (in_array("Password must contain only letters or numbers<br>", $error_array))
								echo "Password must contain only letters or numbers<br>";
				
							if (in_array("Passwords don't match<br>", $error_array))
								echo "Passwords don't match<br>";
				
							if (in_array("Password must be between 8 and 60 characters long<br>", $error_array))
								echo "Password must be between 8 and 60 characters long<br>";
						?>
						<input type="submit" name="register" value="Register">
					</form>
					<br>
					<?php
							if (in_array("<span style='color: #00FF00;'>You are all set! You will get redirected to our home page in a few seconds!</span><br>", $error_array)){
				
								echo "<span style='color: #00FF00;'>You are all set! You will get redirected to our home page in a few seconds!</span><br>";
				
								$redirect = '../index.php';
				
			 					header ("Refresh: 2;URL='$redirect'");
							}
					?>
						<a href="#" id="login" class="login">Already have an account? Sign in here!</a>
					<br>
				</div>
		</div>
	</div>
</body>
</html>