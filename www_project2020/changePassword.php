<?php 
    //session_start();
    include("profileManagement.php");
    $username = $_SESSION['username'];
    $oldPassword = $_POST['currentPWD'];
    $newPassword = $_POST['newPWD'];
    $newPasswordConf = $_POST['newPWDconf'];

    if($newPassword != $newPasswordConf){
        echo '<script>alert("Passwords do not match!")</script>';
        //header('refresh:0.1; url= profileManagement.php');
        exit;
    }
    
    $uppercase = preg_match('@[A-Z]@', $newPassword);
    $number    = preg_match('@[0-9]@', $newPassword);
    $specialChars = preg_match('@[^\w]@', $newPassword);
    
    if(!$uppercase || !$number || !$specialChars || strlen($temp_password) < 8) {
        echo '<script>alert("Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.")</script>';
        exit;
    }


    include('db_connection.php');
    $pwdQuery = "SELECT password FROM user WHERE username='$username'";
    $result = $mysql_con->query($pwdQuery);
    $currentPWD = $result->fetch_assoc()["password"];

    if (!$currentPWD)
        die('Invalid query: ' . $mysql_con->error);
    else{
        if ($currentPWD != $oldPassword){
            echo '<script>alert("Wrong Password!")</script>';
            //header('refresh:0.1; url= profileManagement.php');
        }
        else{
            $my_query = "UPDATE user SET password='$newPassword' WHERE username='$username'";
            $result = $mysql_con->query($my_query);
            if (!$result)
                die('Invalid query: ' . $mysql_con->error);
            else{
                echo '<script>alert("Password updated succesfully!")</script>';
                //header('refresh:0.1; url= profileManagement.php');
            }
        }
    }
    $mysql_con->close();