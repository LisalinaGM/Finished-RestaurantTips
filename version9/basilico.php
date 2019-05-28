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
	$activeEmail = $_SESSION['login_user'];
	$queryUser = "SELECT userid FROM Webusers WHERE email = '$activeEmail'";
	$resultUserID = mysqli_query($connection, $queryUser);
	$rowUserID = $resultUserID->fetch_assoc();
	$userID = $rowUserID['userid'];
	
	$queryAdmin = "SELECT adminid FROM Admin WHERE userid = '$userID'";
	$resultAdmin = $connection -> query($queryAdmin);
	$count = $resultAdmin-> num_rows;
	$activeRestaurant = "Basilico";
	$queryPosition = "SELECT latitude, longitude FROM Restaurants WHERE name = '$activeRestaurant'";
	$resultPosition = $connection->query($queryPosition);
	$rowPosition = $resultPosition -> fetch_assoc();
	$latitude = $rowPosition['latitude'];
	$longitude = $rowPosition['longitude'];
	
	echo $latitude;
	echo "<br>";
	echo $longitude;
?>
<!doctype html>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.js"></script>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Basilico</title>
		<link href="assets/css/start.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="mainwrapper">
		  <header> 
				<div id="logo"> <img src="assets/img/cutlery.png" alt="site logo" id="logo-img"> <h1>Restaurant Tips</h1>
					</div>
			<nav> <a href="register.php" title="Link">Sign up</a> <a href="login.php" title="Link">Log in</a><a href="loggedOut.php" title="Link">Log out</a> </nav>
		  </header>
		  <div id="content">
			<section id="mainContent"> 
				<h1>Basilico</h1>
				<h3>An Italian Restaurant</h3>
				<div id="bannerImage"><img src="assets/img/italian.jpg" alt=""/></div>
				<p>Next to Linnéträdgården you can find this charming ristorante. Here you get the full and real Italian experience
				with authentic food and complementary wine in a genuine environment. They have the possibility to take up to 50 guests and can also provide catering on request.</p>
				<p>Orci nulla pellentesque dignissim enim sit. Aliquam sem et tortor consequat id porta. Commodo viverra maecenas accumsan lacus vel facilisis volutpat est velit. Nulla posuere sollicitudin aliquam ultrices. Egestas congue quisque egestas diam in arcu cursus euismod quis. Sollicitudin tempor id eu nisl nunc mi. Tellus id interdum velit laoreet id donec ultrices tincidunt. Eu consequat ac felis donec et odio. In fermentum posuere urna nec tincidunt praesent. Nulla pellentesque dignissim enim sit. Vitae aliquet nec ullamcorper sit amet. Convallis aenean et tortor at risus viverra adipiscing at. Mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare.</p>
				<p>Magna etiam tempor orci eu lobortis elementum nibh tellus. Nisi scelerisque eu ultrices vitae. Et ultrices neque ornare aenean euismod elementum nisi quis eleifend. Diam donec adipiscing tristique risus nec feugiat in fermentum. Tincidunt praesent semper feugiat nibh sed pulvinar proin. Commodo ullamcorper a lacus vestibulum sed arcu. Arcu vitae elementum curabitur vitae nunc sed. Scelerisque in dictum non consectetur a. Mauris nunc congue nisi vitae suscipit tellus mauris a. Non odio euismod lacinia at quis risus sed vulputate.</p>
				<p>Visit the homepage for the restaurant here: <a href="http://www.basilico.se/" title="Link">Basilico</a></p>
				<p>Read the tips from others below:</p>
				
				<div id="map"></div>
				<p><a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a></p>
			<script>
			  var map = L.map('map').setView([<?php echo $latitude; ?>, <?php echo $longitude ?>], 13); //Longitut/latitut hämtas hit. Funkar när man istället skriver 59.861632, 17.633269
			  L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=P2iACt3rAspoasQ6yeaY',{
				tileSize: 512, 
				zoomOffset: -1,
				minZoom: 1,
				attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
				crossOrigin: true
			  }).addTo(map);
			  L.marker([<?php echo $latitude; ?>, <?php echo $longitude ?>]).addTo(map) //longitut /lattitut hämtas hit
			.bindPopup('This is the location of the restaurant!')
			.openPopup();
			</script>
				
			<aside id="commentsSection"> 
				<h1>Tips</h1>
					<?php
						$sql = "SELECT tipid, title, content, email FROM Tips, Restaurants, Webusers WHERE Tips.restaurantid = Restaurants.id AND Restaurants.name = '$activeRestaurant'
								AND Webusers.userid = Tips.userid";
						$result = $connection->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) { 
								print("<p><h2>TipID: ". $row["tipid"]."<br>Tip: ". $row["title"]. "</h2><h4>Posted by: ".$row["email"]."</h4>  <h3> ".$row["content"]. "</h3><br> </p>");
							}
							if($count > 0){
								print("<form name = inputForm action=processes/deleteTip.php onsubmit = return validateForm() method = post>
								<br><input type=text id=delete name=delete placeholder= TipID.. > 
								<input type=submit value = Delete>");
							}
						}
						$connection->close();
					?> 
			 </aside>
			</section>
			<section id="sidebar"> 
			  <div id="startimage"><img src="assets/img/trensstallen.jpg" alt=""/></div>
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
