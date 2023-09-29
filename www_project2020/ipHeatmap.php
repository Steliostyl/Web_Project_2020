<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>IP Heatmap</title>
		<link rel="stylesheet" href="newstyles.css">
		<link rel="stylesheet" href="scripts/leaflet/leaflet.css"/>
	</head>
	
	<body>
		<div class="container">
			<div class="nav-wrapper">
				<div class="nav-element">
					<a href="homepage.php">Home</a>
				</div>
				<div class="nav-element">
					<a href="profileManagement.php"><?php session_start(); echo $_SESSION['username']; ?></a>
				</div>
				<div class="nav-element">
					<a href="logoff.php">Log off</a>
				</div>
			</div>
			
			<div class="content-wrapper">
				<div clas="map" id="map"></div>
			</div>
		</div>
		<?php
			if (!isset($_SESSION['username'])){
				echo '<script>alert("You are not signed in.<br>Please log in to continue")</script>';
				header('refresh:0.1; url= index.php');
			}
		?>
        <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
		<script src="scripts/leaflet/leaflet.js"></script>
		<script src="scripts/heatmap/heatmap.js"></script>
		<script src="scripts/heatmap/leaflet-heatmap/leaflet-heatmap.js"></script>
		<script src="scripts/heatmap.js"></script>
	</body>
</html>