<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Response Time Analysis</title>
		<link rel="stylesheet" href="newstyles.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
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
				<div class="chart-wrapper">
					<div style="position: absolute; top: 0; left: 0; width:80%; height: 100%;">
						<canvas id="timingsChart"></canvas>
					</div>
					<div class="filters">
                        <form>
                            <h2 id="content_types">Content Types:</h2>
                            <button type="button" onclick="selectAllCheckboxes('content_types', true)">Select All Content Types</button>
                            <button type="button" onclick="selectAllCheckboxes('content_types', false)">Deselect All Content Types</button>

                            <h2>Days:</h2>
                            <label><input type="checkbox" name="day" value="Monday">Monday</label><br>
                            <label><input type="checkbox" name="day" value="Tuesday">Tuesday</label><br>
                            <label><input type="checkbox" name="day" value="Wednesday">Wednesday</label><br>
                            <label><input type="checkbox" name="day" value="Thursday">Thursday</label><br>
                            <label><input type="checkbox" name="day" value="Friday">Friday</label><br>
                            <label><input type="checkbox" name="day" value="Saturday">Saturday</label><br>
                            <label><input type="checkbox" name="day" value="Sunday">Sunday</label><br>
                            <button type="button" onclick="selectAllCheckboxes('day', true)">Select All Days</button>
                            <button type="button" onclick="selectAllCheckboxes('day', false)">Deselect All Days</button>

                            <h2 id="methods">Methods:</h2>
                            <button type="button" onclick="selectAllCheckboxes('methods', true)">Select All Methods</button>
                            <button type="button" onclick="selectAllCheckboxes('methods', false)">Deselect All Methods</button>

                            <h2 id="isps">ISP Filter:</h2>
                            <button type="button" onclick="selectAllCheckboxes('isps', true)">Select All ISPs</button>
                            <button type="button" onclick="selectAllCheckboxes('isps', false)">Deselect All ISPs</button><br>
                            <input type="submit" value="Apply Filters">
                        </form>
					</div>
				</div>
		</div>
        <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script src="/scripts/timingAnalysis.js"></script>
	</body>
</html>