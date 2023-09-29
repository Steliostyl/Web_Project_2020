<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>About</title>
		<link rel="stylesheet" href="newstyles.css">
	</head>
	
    <?php
        include('checkSession.php');
    ?>
	<body>
		<div class="container">
			<div class="nav-wrapper">
				<div class="nav-element">
					<a href="homepage.php">Home</a>
				</div>
				<div class="nav-element">
					<a href="profilePage.php"><?php echo $_SESSION['username']; ?></a>
				</div>
				<div class="nav-element">
					<a href="logoff.php">Log off</a>
				</div>
			</div>
			
			<div class="content-wrapper">

			</div>
		</div>
	</body>
</html>