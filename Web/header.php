<?php
	session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="This is an example of a meta description. This will often show up in search results">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="/build/tailwind.css">
</head>
<body>
	<header>
		<nav>
			<!--
			<a href="#">
				<img src="img/logo.png" alt="logo">
			</a>
			-->
			<ul>
				<li><a href="index.php">Home</a></li>
				
				<?php

				if(isset($_SESSION['userId'])){
					
					echo '<li><a href="panel.php">User Panel</a></li>';

					if ($_SESSION['rankId'] == 3){
						echo '<li><a href="admin.php">Admin Panel</a></li>';
					}
					else{
						echo '<li><a href="#"> Test </a></li>';
					}
						/*				
					$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

					if (strpos($url,'panel') !== false) {
						echo '<li><a href="#"> Test </a></li>';
					} else {
						echo 'No cars.';
					}
					*/

				}
				?>

			</ul>
			<div class="header nav-login">
				<?php
				if (isset($_SESSION['userId'])) {
					echo '<form action="includes/logout.inc.php" method="post">
						<button type="submit" name="logout-submit">Logout</button>
					</form>';
				}
				else {
					echo '<form action="includes/login.inc.php" method="post">
						<input type="text" name="mailuid" placeholder="Username/E-mail...">
						<input type="password" name="pwd" placeholder="Password...">
						<button type="submit" name="login-submit">Login</button>
					</form>
					<form action="signup.php">
						<button type="submit">Signup</a>
					</form>';
				}
				 ?>
			</div>
		</nav>
	</header>
