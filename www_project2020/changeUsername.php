<?php
    //session_start();
    include("profileManagement.php");
    $oldUsername = $_SESSION['username'];
    $newUsername = $_POST['newusername'];
    $password = $_POST['password'];

    include('db_connection.php');
    $pwdQuery = "SELECT password FROM user WHERE username='$oldUsername'";
    $result = $mysql_con->query($pwdQuery);
    $currentPWD = $result->fetch_assoc()["password"];

    if (!$currentPWD)
        die('Invalid query: ' . $mysql_con->error);
    else{
        if ($currentPWD != $password)
            echo "<script> alert('Wrong Password!\r\n'); </script>";
        else{
            $my_query = "UPDATE user SET username='$newUsername' WHERE username='$oldUsername'";
            $result = $mysql_con->query($my_query);
            if (!$result)
                die('Invalid query: ' . $mysql_con->error);
            else{
                echo '<script>alert("Username updated succesfully!")</script>';
                $_SESSION["username"] = $newUsername;
                header('refresh:0.1; url= profileManagement.php');
            }
        }
    }
    $mysql_con->close();