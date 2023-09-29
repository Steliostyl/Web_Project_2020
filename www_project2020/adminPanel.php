<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Home Page</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="newstyles.css">
	</head>
	
	<body>
		<?php
			include('checkRole.php');
			if($admin!=true)
				header('homepage.php');
		?>
		<div class="container">
			<div class="nav-wrapper">
				<div id="Guest View" class="nav-element">
					<a href="homepage.php">View as Guest</a>
				</div>
				<div id="homepage_link" class="nav-element">
					<a href="adminPanel.php">Home</a>
				</div>
				<div class="nav-element">
					<a href="profileManagement.php"><?php echo $_SESSION['username']; ?></a>
				</div>
				<div class="nav-element">
					<a href="logoff.php">Log off</a>
				</div>
			</div>
			
			<div class="content-wrapper">
				<div class="sectors-wrapper">

					<a href="basicDataAnalysis.php">
						<div class="sector-wrapper">
							<div class="img-background" style="background-image:url(images/basic_data_analysis.svg)"></div>
							
							<div class="img-text-wrapper">
								<div class="sector-title">Basic Data Analysis</div>
								<div class="sector-info">Check basic statistics about users and their entries on the system</div>
							</div>
						</div>
					</a>

					<a href="admin_heatmap.php">
						<div class="sector-wrapper">
							<div class="img-background" style="background-image:url(images/map.svg);"></div>
							
							<div class="img-text-wrapper">
								<div class="sector-title">IP Heatmap</div>
								<div class="sector-info">Map with graphical repressentation connecting
                                users with the area servers they got responses from were located at</div>
							</div>
						</div>
					</a>
					
					<a href="httpHeadersAnalysis.php">
						<div class="sector-wrapper">
							<div class="img-background" style="background-image:url(images/http_analysis.svg)"></div>
							
							<div class="img-text-wrapper">
								<div class="sector-title">HTTP Analysis</div>
								<div class="sector-info">Cache information tables concerning HTTP headers</div>
							</div>
						</div>
					</a>

					<a href="timingsAnalysis.php">
						<div class="sector-wrapper">
							<div class="img-background" style="background-image:url(images/timings_analysis.svg)"></div>
							
							<div class="img-text-wrapper">
								<div class="sector-title">Timings Analysis</div>
								<div class="sector-info">A graph that represents the average request response 
                                time for every hour of the day</div>
							</div>
						</div>
					</a>

				</div>
			</div>
		</div>
		<script>
			document.getElementById('homepage_link').style.background='rgb(25,25,25)';
			const sectors  = document.querySelectorAll('.sector-wrapper');
			sectors.forEach(sector => {
					sector.addEventListener('mouseover',() =>{
						sector.childNodes[1].classList.add('img-darken');
					})
					sector.addEventListener('mouseout',() =>{
						sector.childNodes[1].classList.remove('img-darken');
					})
				})
		</script>
	</body>
</html>