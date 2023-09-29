<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Home Page</title>
		<link rel="stylesheet" href="newstyles.css">
	</head>
	
	<body>
		<div class="container">
			<div class="nav-wrapper">
				<div id="hidden_admin" class="nav-element">
					<?php
						include('checkRole.php');
						if($admin==true)
							echo "<a href=adminPanel.php>View as Admin</a>";
					?>
				</div>
				<div id="homepage_link" class="nav-element">
					<a href="homepage.php">Home</a>
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

					<a href="profileManagement.php">
						<div class="sector-wrapper">
							<div class="img-background" style="background-image:url(images/profile_management.svg)"></div>
							
							<div class="img-text-wrapper">
								<div class="sector-title">Profile Management</div>
								<div class="sector-info">Manage your profile, change your usename/password or delete your profile</div>
							</div>
						</div>
					</a>

					<a href="ipHeatmap.php">
						<div class="sector-wrapper">
							<div class="img-background" style="background-image:url(images/map.svg)"></div>
							
							<div class="img-text-wrapper">
								<div class="sector-title">IP Heatmap</div>
								<div class="sector-info">Map with graphical repressentation of 
								the areas servers you got responses from were located at</div>
							</div>
						</div>
					</a>
					
					<a href="upload_page.php">
						<div class="sector-wrapper">
							<div class="img-background" style="background-image:url(images/file_upload.svg)"></div>
							
							<div class="img-text-wrapper">
								<div class="sector-title">Upload</div>
								<div class="sector-info">Filter a new har file and download or upload it to the database.</div>
							</div>
						</div>
					</a>

					<a href="about.php">
						<div class="sector-wrapper">
							<div class="img-background" style="background-image:url(images/about_page.svg)"></div>
							
							<div class="img-text-wrapper">
								<div class="sector-title">About this project</div>
								<div class="sector-info">A few words about the making of this project, as well as the developers themselves</div>
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