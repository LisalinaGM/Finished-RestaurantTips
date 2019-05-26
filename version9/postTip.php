<?php
include('processes/session.php');
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Post Tip</title>
		<link href="assets/css/tipStyle.css" rel="stylesheet" type="text/css">
		<link href="assets/css/start.css" rel="stylesheet" type="text/css">
		<script src = "assets/js/tipValidation.js"></script>
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
					<h1>Write your tip to other users here!</h1>
					<p> Fill in the title of your tip, your email-address, select what restaurant the tip concerns and then write your thoughts down.
						Once you click on the submit-button your tip will be posted at the side of the restaurant you have chosen.</p>
						<form name = "inputForm" action="processes/tipProcess.php" onsubmit = "return validateForm()" method = "post">
							<br><label for="title">Tip title</label>
							<br><input type="text" id="title" name="title" placeholder="ex. Good atmosphere at this restaurant">
							<br><label for="restaurant">Restaurant</label>
							<br><select name="restaurant">
								<option value="Basilico">Basilico</option>
								<option value="Frenchi">Frenchi</option>
								<option value="Iberico">Iberico</option>
								<option value="Aaltos">Aaltos</option>
								</select>
							<br><label for="comment">Tip</label>
							<br><textarea id="tip" name="tip" placeholder="Write your tip here.. (max 500 characters)" style="height:150px"></textarea>
							<br><input type="submit" value="Submit">
						</form>
				</div>	
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
