<?php
	$uname = "dbtrain_1036";
	$pass = "xotlno";
	$host = "dbtrain.im.uu.se";
	$dbname = "dbtrain_1036";
	
	$connection =  new mysqli($host, $uname, $pass, $dbname);
	
	if($connection -> connect_error)
	{
		die("Connection failed: ".$connection.connect_error);
	}
	else{
		echo "Connection worked.";
	}
	
	function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
	}
	
	$email = mysqli_real_escape_string($connection, $_POST["email"]);
	$password = mysqli_real_escape_string($connection, $_POST["password"]);
	$salt = generateRandomString();
	
	$cryptedPassword = crypt($password, $salt);
	
	$queryError = "SELECT email FROM Webusers WHERE email = '$email'"; //check so a user does not already exist
	$resultError = mysqli_query($connection, $queryError);
	if(mysqli_num_rows($resultError) > 0){
		echo "registration failed";
		header("Refresh: 0; URL=../confirms/registrationFailed.php");
	}
	else{
	
		if(empty(trim($email)) !== true && empty(trim($password)) !== true){ //checks so the strings are not empty
			if(strpos($email, '@') !== false){
				$query = "INSERT INTO Webusers(email, password, salt) VALUES('$email', '$cryptedPassword', '$salt')";
			}
		}
		$connection -> query($query);
	
		echo "<br/>";
		echo $query;
		echo "<br>successful registration!";
	
		header("Refresh: 0; URL=../confirms/registrationSuccess.php");
	}
?>
