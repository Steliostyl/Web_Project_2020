<?php
    include('index.php');
    if (isset($_SESSION['username'])){
        echo "Already logged in as ".$_SESSION['username']."<br>";
        header( "refresh:2; url=homepage.php" );
    }
    else
        include('db_connection.php');
        if (strlen($_POST['username']) < 1 || strlen($_POST['password']) < 8){
            echo '<script>alert("Invalid credentials.");</script>';
            //header( "refresh:2; url=index.php" );
            exit;
        }
        else{
            $temp_username = $_POST['username'];
            $temp_password = $_POST['password'];
            $my_query = "SELECT * FROM user WHERE username='$temp_username'";
            $result = $mysql_con->query($my_query);
    
            if (!$result)
                die('Invalid query: ' . $mysql_con->error . '\n');
            else 
                if (mysqli_num_rows($result)==0){
                    echo '<script>alert("User not found! Try checking your spelling.");</script>';
                    exit;
                }
                else
                    while($row = $result->fetch_array()){
                        if($row['password']==$temp_password){
                            session_start();
                            $_SESSION["username"] = $temp_username;
                            if($row['role']=='admin')
                                header('Location: adminPanel.php');
                            else
                                header('Location: homepage.php');
                            exit;
                        }
                        else{
                            echo '<script>alert("Wrong Password.\r\n");</script>';
                            exit;
                        }
                    }
            }
    $mysql_con->close();