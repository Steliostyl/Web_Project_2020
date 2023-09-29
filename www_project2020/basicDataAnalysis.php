<html>
    <head>
        <meta charset="utf-8">
        <title>Admin - Basic Data Analysis</title>
		<link rel="stylesheet" href="newstyles.css">
    </head>
    <?php
        include('checkSession.php');
    ?>
    <body>
        <div class="container">
            <div class="nav-wrapper">
                <div class="nav-element">
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
                <div>
                    <table id="basicDataTable">
                        <tr>
                            <th colspan="2">Basic Data</th>
                        </tr>   
                    </table>
                    <table id="methodsTable">
                        <tr>
                            <th colspan="2">Εntries using different Methods</th>
                        </tr>   
                    </table>
                    
                    <table id="statusTable">
                        <tr>
                            <th colspan="2">Εntries with different Status Codes</th>
                        </tr>   
                    </table>
                    
                    <table id="ageTable">
                        <tr>
                            <th colspan="2">Average age of objects with different Content Types</th>
                        </tr>   
                    </table>
                </div>
            </div>
        </div>

        <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="scripts/basicDataAnalysis.js"></script>
    </body>
</html>