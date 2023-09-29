<!DOCTYPE html>
<html>
	<head>
		<meta charset=UTF-8>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login - Signup</title>
		<link rel="stylesheet" href="newstyles.css">
	</head>
	
	<body>
		<div class="nav-wrapper">
			<div class="nav-element">
				<input type=button id="login" value="Login">
			</div>
			<div class="nav-element">
				<input type=button id="signup" value="Sign Up">
			</div>
		</div>

		<div class="content-wrapper" id="content-wrapper">
			<div class="background"></div>
			<div class="content" id="welcome">Welcome to our website</div>
			<?php
				$pageUrl = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				if(strpos($pageUrl, "login=false")){
					echo '<div class="error">Not logged in</div>';
				}
				session_start();
				if (isset($_SESSION['username'])){
					echo "Already logged in as ".$_SESSION['username']."<br>";
					header( "Location: homepage.php" );
				}
			?>
		</div>
		<script type="text/javascript" src="scripts/index_forms.js" defer></script>
	</body>
</html>