<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Profile Management</title>
		<link rel="stylesheet" href="newstyles.css">
	</head>
	<body>
		<?php 
			session_start();
			$sesUsername = $_SESSION["username"];
			if (!isset($_SESSION['username'])){
				echo '<script>alert("You are not signed in.\r\nPlease sign in to continue");</script>';
				header('refresh:0.1; url= index.php');
			}
			include("db_connection.php");
			$my_query = "SELECT uploadCount, lastUpload FROM user WHERE username = '$sesUsername'";
			$result = $mysql_con->query($my_query);
			//$lastUpload = ;
			while($row = $result->fetch_assoc()){
				$lastUpload = $row["lastUpload"];
				$uploadCount = $row["uploadCount"];
			}
		?>
		<div class="container">
			<div class="nav-wrapper">
				<div class="nav-element">
					<a href="homepage.php">Home</a>
				</div>
				<div id='profile_link' class="nav-element">
					<a href="profileManagement.php"><?php echo $_SESSION['username']; ?></a>
				</div>
				<div class="nav-element">
					<a href="logoff.php">Log off</a>
				</div>
			</div>
			
			<div class="content-wrapper">
				<form class="form" id="profManForm" name="Profile Management" method="post">
					Last upload made on: <?php echo $lastUpload; ?><br>
					Total uploads: <?php echo $uploadCount; ?><br>
					<span>Logged in as:</span> <span class='username'><?php echo $_SESSION['username']; ?></span><br>
					<input type=button id='changeUsername_button' value='Change Username'></input><br>
					<input type=button id='changePassword_button' value='Change Password'></input>
				</form>
			</div>
		</div>
		<script>
			document.getElementById('profile_link').style.background='rgb(25,25,25)';
		</script>
		<script type="text/javascript" src="scripts/profileManagement.js" defer></script>
	</body>
</html>