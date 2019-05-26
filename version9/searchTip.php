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

	include('processes/session.php');

	$output='';
	if(isset($_POST['search'])){
		$searched = mysqli_real_escape_string($connection, $_POST["search"]);
		$restaurant = mysqli_real_escape_string($connection, $_POST["restaurant"]);
		$queryRestaurantID = "SELECT id FROM Restaurants WHERE name = '$restaurant'";
		$resultRestaurantID = mysqli_query($connection, $queryRestaurantID);
		if($resultRestaurantID->num_rows == 1){
			$row = $resultRestaurantID -> fetch_assoc();
			$restaurantID = $row["id"];
			$query = "SELECT title, content FROM Tips WHERE restaurantid = '$restaurantID' AND (title LIKE '%$searched%' OR content LIKE '%$searched%')";
			$result = $connection -> query($query);
			$count = $result-> num_rows;
			if($count == 0){
				$output = "<h2>There were no matching tips to your search</h2>";
			}
			else{
				$resultSearch = mysqli_query($connection, $query);
				while($row = $resultSearch-> fetch_assoc()){
					$title = $row['title'];
					$content = $row['content'];
					$output .= '<div id="tipbox"><p><h2>Title: '.$title.'<br>Tip: '.$content.'</h2></p></div>';
					
				}
			}
		}
	}
?>
<!doctype html>
	<html>
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Search for Tips</title>
			<link href="assets/css/tipStyle.css" rel="stylesheet" type="text/css">
			<link href="assets/css/start.css" rel="stylesheet" type="text/css">
		</head>
		<body>
		<div id="mainwrapper">
		  <header> 
			<div id="logo"> <img src="assets/img/cutlery.png" alt="site logo" id="logo-img"> <h1>Restaurant Tips</h1></div>
			<nav> <a href="register.php" title="Link">Sign up</a> <a href="login.php" title="Link">Log in</a><a href="loggedOut.php" title="Link">Log out</a> </nav>
		  </header>
		<div id="content">
			<section id="mainContent"> 
				<div class="search-box">
				  <h1>Search for tips here</h1>
					<p> Just fill in a search word and choose what restarurant the tip should concern.</p>
					<form name = "inputForm" action="searchTip.php" onsubmit = "return validateForm()" method = "post">
						<br><input type="text" id="search" name="search" placeholder="Search for tips here..">
						<br><select name="restaurant">
								<option value="Basilico">Basilico</option>
								<option value="Frenchi">Frenchi</option>
								<option value="Iberico">Iberico</option>
								<option value="Aaltos">Aaltos</option>
							</select>
						<br><input type="submit" value="Search"><br>
					</form>
					<aside class="searchResult"> 
						<p>Search results..</p>
						<?php print ("$output"); ?>
					</aside>
				</div>
			</section>
			<section id="sidebar"> 
				<div id="namebar"><h4>Restaurant Tips</h4></div>
				<div id="startimage"><img src="assets/img/trensstallen.jpg"/></div>
				<nav>
					<ul>
						<li><a href="start.php" title="Link">Home</a></li>
						<li><a href="searchTip.php" title="Link">Search for Tips</a></li>
						<li><a href="postTip.php" title="Link">Post a tip</a></li>
						<li><a href="basilico.php" title="Link">Basilico</a></li>
						<li><a href="frenchi.php" title="Link">Frenchi</a></li>
						<li><a href="#" title="Link">Iberico</a></li>
						<li><a href="#" title="Link">Aaltos</a></li>
						<li><a href="#" title="Link">Contact us</a></li>
					</ul>
				</nav>
			</section>
		</div>
		<div id="footerbar">copyright @ Group 2. All rights reserved</div>
		</div>
	</body>
</html>
