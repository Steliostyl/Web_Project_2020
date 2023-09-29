<?php
    include('checkSession.php');
    if(!isset($_SESSION['admin'])){
        $username = $_SESSION['username'];
        include('db_connection.php');
        $my_query = "SELECT role FROM user WHERE username='$username'";
        $result = $mysql_con->query($my_query);
        $admin = false;
        if (!$result)
            die('Invalid query: ' . $mysql_con->error);
        else if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()){
                    if($row['role']=='admin'){
                        $admin = true;
                        $_SESSION['admin'] = true;
                    }
                    else $_SESSION['admin'] = false;
                }
        }
    }
    else $admin = $_SESSION['admin'];