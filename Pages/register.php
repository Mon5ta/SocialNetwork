<?php 

	session_start();

	require '../SQL/connection.php';

	$name = "";
	$surname = "";
	$username = "";
	$email = "";
	$password = "";
	$emailConfirm = "";
	$passwordConfirm = "";

	$error_array = array();

	if (isset($_POST['register'])) {

		$name = strip_tags($_POST['name']);
		$name = str_replace(' ','',$name);
		$name = ucfirst(strtolower($name));
		$_SESSION['name'] = $name;

		$surname = strip_tags($_POST['surname']);
		$surname = str_replace(' ','',$surname);
		$surname = ucfirst(strtolower($surname));
		$_SESSION['surname'] = $surname;

		$username = strip_tags($_POST['username']);
		$username = str_replace(' ','',$username);
		$_SESSION['username'] = $username;

		$email = strip_tags($_POST['email']);
		$email = str_replace(' ','',$email);

		$emailConfirm = strip_tags($_POST['emailConfirm']);
		$emailConfirm = str_replace(' ','',$emailConfirm);

		$password = strip_tags($_POST['password']);
		$password = str_replace(' ','',$password);

		$passwordConfirm = strip_tags($_POST['passwordConfirm']);
		$passwordConfirm = str_replace(' ','',$passwordConfirm);

			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

				if ($email === $emailConfirm) {

					$email = filter_var($email, FILTER_SANITIZE_EMAIL);

					$query = "SELECT email FROM users WHERE email = '$email';";
	
					$result = mysqli_query($connect, $query);
	
					$numRows = mysqli_num_rows($result);
	
					if ($numRows === 1) 
						array_push($error_array, "Email already in use<br>") ;

				}  else 
					array_push($error_array, "Email adresses don't match<br>");

			} else
				array_push($error_array, "Invalid email address.<br>");
	
			if ($password === $passwordConfirm) {

				if (preg_match('/[^a-zA-Z0-9]/', $password)) 
					array_push($error_array, "Password must contain only letters or numbers<br>");

			} else
				array_push($error_array, "Passwords don't match<br>");

			if (strlen($name) > 50 || strlen($name) < 2)
				array_push($error_array, "First name length must be between 2 and 50 characters long<br>");

			if (strlen($surname) > 50 || strlen($surname) < 2)
				array_push($error_array, "Last name length must be between 2 and 50 characters long<br>");

			if (strlen($username) > 100 || strlen($surname) < 5){
				array_push($error_array, "Username length must be between 5 and 50 characters long<br>");
			} else {
				$query = "SELECT username FROM users WHERE username = '$username';";
	
				$result = mysqli_query($connect, $query);
	
				$numRows = mysqli_num_rows($result);
	
				if ($numRows === 1) 
					array_push($error_array, "Username already in use<br>") ;
			}

			if (strlen($password) > 100 || strlen($password) < 8)
				array_push($error_array, "Password must be between 8 and 60 characters long<br>");

			if (empty($error_array)) {
				$password = md5($password); //u can actually encrypt whatever you want but i choose to encrypt only password cause we are on a simple demo ;p

 				$profilePicture = "../Assets/Profile Pictures/Defaults/user.png";

 				$insert = mysqli_query($connect,"INSERT INTO users (name,surname,username,email,passwd,profile_pic,likes,posts) VALUES ('$name','$surname','$username','$email','$password','$profilePicture',0,0);");

 				array_push($error_array,"<span style='color: #00FF00;'>You are all set! You will get redirected to our home page in a few seconds!</span><br>");


				unset($_SESSION['name']);
				unset($_SESSION['surname']);
				unset($_SESSION['username']);

			}

		}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome to Moutskabook</title>
</head>
<body>
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
			if(isset($_SESSION['username'])) {
				echo $_SESSION['username'];
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
</body>
</html>