<?php 
    session_start();
    $username = $_SESSION['username'];
    $answer = [];
    $i = 0;
    include("db_connection.php");
    $my_query = "SELECT wait, content_type, startedDateTime, method, userISP
    FROM har_file 
    WHERE wait IS NOT NULL";

    $content_types_query = "SELECT DISTINCT content_type
    FROM har_file WHERE wait IS NOT NULL";

    $method_query = "SELECT DISTINCT method
    FROM har_file WHERE wait IS NOT NULL";

    $userISP_query = "SELECT DISTINCT userISP
    FROM har_file WHERE wait IS NOT NULL";


    $result = $mysql_con->query($my_query);
    if (!$result)
        die('Invalid query: ' . $mysql_con->error);
    else if ($result->num_rows > 0) {
            // output data of each row
            $temp = [];
            while($row = $result->fetch_assoc()){
                $answer[$i] = $row;
                $i += 1;
            }
    } 
    else
        echo "0 results";

    $result = $mysql_con->query($content_types_query);
    if (!$result)
        die('Invalid query: ' . $mysql_con->error);
    else if ($result->num_rows > 0) {
            // output data of each row
            $temp = [];
            while($row = $result->fetch_assoc()){
                $content_types[$i] = $row;
                $i += 1;
            }
    } 
    else
        echo "0 results";

    $result = $mysql_con->query($method_query);
    if (!$result)
        die('Invalid query: ' . $mysql_con->error);
    else if ($result->num_rows > 0) {
            // output data of each row
            $temp = [];
            while($row = $result->fetch_assoc()){
                $method_types[$i] = $row;
                $i += 1;
            }
    } 
    else
        echo "0 results";

    $result = $mysql_con->query($userISP_query);
    if (!$result)
        die('Invalid query: ' . $mysql_con->error);
    else if ($result->num_rows > 0) {
            // output data of each row
            $temp = [];
            while($row = $result->fetch_assoc()){
                $userISPs[$i] = $row;
                $i += 1;
            }
    } 
    else
        echo "0 results";

    $mysql_con->close();

    // Create an associative array to hold the values
    $final_response = array(
        'answer' => $answer,
        'content_types' => $content_types,
        'methods' => $method_types,
        'isps' => $userISPs
    );

    echo json_encode($final_response);
    