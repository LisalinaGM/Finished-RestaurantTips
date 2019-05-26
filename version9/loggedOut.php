<?php
session_start();
session_destroy();
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Now logged out</title>
		<link href="assets/css/start.css" rel="stylesheet" type="text/css">
		<link href="assets/css/tipStyle.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="mainwrapper">
			<header> 
				<div id="logo"> <img src="assets/img/cutlery.png" alt="site logo" id="logo-img"> <h1>Restaurant Tips</h1></div>
				<nav> <a href="register.php" title="Link">Sign up</a> <a href="login.php" title="Link">Log in</a><a href="loggedOut" title="Link">Log out</a> </nav>
			</header>
				<div id="content">
					<section id="mainContent"> 
						<div class="confirm-box">
							<h1> You are now logged out!
							<br><p>Welcome back another time!</p></h1>
						</div> 
						<aside id="authorInfo">  </aside>
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
				</div>
				<div id="footerbar">copyright @ Group 2. All rights reserved</div>
		</div>
	</body>
</html>
