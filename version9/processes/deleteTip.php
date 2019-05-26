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

	$tipID = mysqli_real_escape_string($connection, $_POST["delete"]);
	if(empty(trim($tipID)) !== true){
		$queryDelete = "DELETE FROM Tips WHERE tipid = '$tipID'";
		$connection -> query($queryDelete);
	}
	header("Refresh: 0; URL=../start.php");
?>
