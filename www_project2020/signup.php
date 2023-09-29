<?php
    include("index.php");
    $temp_username = $_POST['new_username'];
    $temp_password = $_POST['new_password'];
    $temp_password2 = $_POST['new_password2'];
    $temp_email = $_POST['new_email'];

    $uppercase = preg_match('@[A-Z]@', $temp_password);
    $number    = preg_match('@[0-9]@', $temp_password);
    $specialChars = preg_match('@[^\w]@', $temp_password);

    if($temp_password != $temp_password2){
        echo '<script>alert("Passwords dont match!")</script>'; 
        //header('refresh:2;url= index.php');
        exit;
    }
    else if(!$uppercase || !$number || !$specialChars || strlen($temp_password) < 8) {
        echo '<script>alert("Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.")</script>';
        //header('refresh:2;url= index.php');
        exit;
    }

    include('db_connection.php');
    $my_query = "INSERT INTO user(username, password, email) VALUES('$temp_username', '$temp_password','$temp_email')";
    //echo $my_query;
    $result = $mysql_con->query($my_query);

    if (!$result)
        die('Invalid query: ' . $mysql_con->error);
    else{
        echo '<script>alert("User created succesfully!");</script>'; 
        session_start();
        $_SESSION["username"] = $temp_username;
        header('refresh:0.1; url= homepage.php');
    }
    $mysql_con->close();