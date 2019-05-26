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
?>
<!doctype html>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
   		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css" />
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.js"></script>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>frenchi</title>
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
					<h1>Frenchi</h1>
					<h3>Restaurant, Bar & Café</h3>
					<div id="bannerImage"><img src="assets/img/frenchi.jpg" alt="picture of the restaurant"/></div>
					<p> Frenchi is a restaurant that serves food inspired by the French and Asian kitchen. The restaurant is open from lunch to the late evening. 
						You can enjoy a nice fika or a have a glass of wine on the outside dining area that's open during spring and summer. 
						Otherwise the dining area is large with seating for a party over 40 persons. The restaurant is located in the centre of Uppsala.</p>

					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Leo vel fringilla est ullamcorper. Euismod in pellentesque massa placerat duis ultricies lacus. Amet dictum sit amet justo. Iaculis urna id volutpat lacus laoreet non curabitur. At tempor commodo ullamcorper a lacus. Nisl vel pretium lectus quam id. Vel pharetra vel turpis nunc eget lorem dolor sed. Cursus risus at ultrices mi tempus imperdiet nulla. Vel orci porta non pulvinar neque laoreet. Dictumst quisque sagittis purus sit amet volutpat consequat mauris nunc. Et odio pellentesque diam volutpat commodo. Ultrices neque ornare aenean euismod elementum nisi quis. Eget magna fermentum iaculis eu non diam phasellus vestibulum. Ornare arcu odio ut sem nulla pharetra diam sit amet. In hendrerit gravida rutrum quisque non. Adipiscing diam donec adipiscing tristique risus nec. Scelerisque eleifend donec pretium vulputate sapien nec sagittis aliquam. Nunc sed blandit libero volutpat sed cras. Ultrices eros in cursus turpis massa.</p>
					<p> Visit the home page for the restaurant on this link here, <a href="https://frenchi.se/">Frenchi.</a> </p>
					<p>Read the tips from others below:</p>
		
		<div id="map"></div>
		<p><a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a></p>
    		<script>
      		var map = L.map('map').setView([59.859111, 17.639168], 13); //Longitut/latitut hämtas hit
      		L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=P2iACt3rAspoasQ6yeaY',{
       		tileSize: 512, 
        	zoomOffset: -1,
        	minZoom: 1,
        	attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
        	crossOrigin: true
      		}).addTo(map);
      		L.marker([59.859111, 17.639168]).addTo(map) //longitut /lattitut hämtas hit
    		.bindPopup('Här ligger restaurangen!')
    		.openPopup();
    		</script>
	 
	 <aside id="commentsSection"> 
        <h1>Tips</h1>
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
				
				$activeRestaurant = "Frenchi";
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
	  <div id="footerbar"> copyright @ Group 2. All rights reserved</div>
	</div>
	</body>
</html>
