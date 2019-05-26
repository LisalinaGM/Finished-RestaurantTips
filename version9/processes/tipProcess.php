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
	session_start();
	$title = mysqli_real_escape_string($connection, $_POST["title"]);
	$email = $_SESSION['login_user'];
	$content = mysqli_real_escape_string($connection, $_POST["tip"]);
	$restaurant = mysqli_real_escape_string($connection, $_POST["restaurant"]);
	
	if(empty(trim($title)) !== true && empty(trim($content)) !== true){//checks so the strings are not empty
		if(strpos($email, '@') !== false){
			$queryUserID = "SELECT userid FROM Webusers WHERE email = '$email'";
			$resultUserID = mysqli_query($connection, $queryUserID);
			$queryRestaurantID = "SELECT id FROM Restaurants WHERE name = '$restaurant'";
			$resultRestaurantID = mysqli_query($connection, $queryRestaurantID);
			if($resultUserID->num_rows == 1 && $resultRestaurantID->num_rows == 1){
				$row = $resultUserID->fetch_assoc();
				$rowTwo = $resultRestaurantID -> fetch_assoc();
				$restaurantID = $rowTwo["id"];
				$userID = $row["userid"];
				$query = "INSERT INTO Tips (title, content, userid, restaurantid) VALUES('$title', '$content', '$userID', '$restaurantID')";
				
				echo $restaurant;
				$connection -> query($query);
			}
			else{
			echo "failed";
			}
		}
		echo "<br/>";
	}
	else{
		echo "<br/>";
		echo "failed";
	}
	
	
	header("Refresh: 0; URL=../start.php");
?>
