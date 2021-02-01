<?php 

	if (isset($_POST['login'])) {

			if (isset($_POST['login_username_email']) && isset($_POST['login_password'])) {

				$_SESSION['loginAttemptUser'] = $_POST['login_username_email'];
	
			if (filter_var($_POST['login_username_email'], FILTER_VALIDATE_EMAIL)){
				$login_email = filter_var($_POST['login_username_email'], FILTER_SANITIZE_EMAIL);
				$login_email = strip_tags($login_email);
				$login_email = str_replace(' ','',$login_email);
				$query = "SELECT * FROM users WHERE email = '$login_email'";
			}
			else {
				$login_username = strip_tags($_POST['login_username_email']);
				$login_username = str_replace(' ','',$login_username);
				$query = "SELECT * FROM users WHERE username = '$login_username'";
			}
	
			if (!preg_match('/[^a-zA-Z0-9]/', $_POST['login_password'])) {
				$login_password = $_POST['login_password'];
				$login_password = strip_tags($_POST['login_password']);
				$login_password = str_replace(' ','',$login_password);
			}
	
			$response = mysqli_query($connect, $query);
	
			if (mysqli_num_rows($response) === 1 ) {
	
    	        $row = mysqli_fetch_assoc($response);
	
    	        if ( password_verify( md5($login_password) , $row['passwd']) ) {
	
    	        	$_SESSION['username'] = $row['username'];

    	        	if ($row['user_closed'] === 'YES') {
    	        		
    	        		$query = "UPDATE users SET user_closed = 'NO' WHERE username = '$row[username]'";

    	        		mysqli_query($connect,$query);

    	        	}

    	        	mysqli_close($connect);

    	        	$redirect = "../index.php";

    	            header ("Refresh: 2;URL='$redirect'");

    	            exit();
	
    	        } else {
    	        	array_push($error_array, "Username or password is incorrect!<br>");
    	        }
	
			}  else {
    	        array_push($error_array, "Username or password is incorrect!<br>");
    	    }
			
		}

	} 
?>