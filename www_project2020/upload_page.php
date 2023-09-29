<html>
    <head>
        <meta charset="utf-8">
        <title>Upload</title>
		<link rel="stylesheet" href="newstyles.css">
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
                <form class="form" name="File Form">
                    Filename: <input type="file" name="file" id="inputfile"><br>
                    <input type="button" value="Download" id="download"><br>
                    <input type="button" value="Upload" id="upload">
                </form>
            </div>
        </div>

        <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="scripts/har_reader.js" defer></script>
    </body>
</html>