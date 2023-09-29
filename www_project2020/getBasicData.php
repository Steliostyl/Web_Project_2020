<?php
    $answer = [];
    include("db_connection.php");

    // Get number of users
    $my_query = "SELECT COUNT(*) AS userCount FROM user";
    $result = $mysql_con->query($my_query);
    if (!$result)
        die('Invalid query: ' . $mysql_con->error);
    else if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc())
                $answer['userCount'] = $row["userCount"];
    }
    
    // Get number of distinct ISPs and domains
    $my_query = "SELECT COUNT(DISTINCT userISP) AS ispCount,
    COUNT(DISTINCT url) AS urlCount 
    FROM har_file";

    $result = $mysql_con->query($my_query);
    if (!$result)
        die('Invalid query: ' . $mysql_con->error);
    else if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()){
                $answer['ispCount'] = $row["ispCount"];
                $answer['urlCount'] = $row["urlCount"];
            }
    }
    
    // Get number of methods by method
    $my_query = "SELECT method, COUNT(id) as total 
    FROM har_file GROUP BY method ORDER BY COUNT(id) DESC";
    $result = $mysql_con->query($my_query);
    if (!$result)
        die('Invalid query: ' . $mysql_con->error);
    else if ($result->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $result->fetch_assoc()){
                $methods[$i] = $row;
                $i++;
            }
            $answer['methods'] = $methods;
    }
    
    // Get number of methods by status
    $my_query = "SELECT status, COUNT(id) as total 
    FROM har_file GROUP BY status ORDER BY COUNT(id) DESC";
    $result = $mysql_con->query($my_query);
    if (!$result)
        die('Invalid query: ' . $mysql_con->error);
    else if ($result->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $result->fetch_assoc()){
                $status[$i] = $row;
                $i++;
            }
            $answer['status'] = $status;
    }

    // Get average age
    $my_query = "SELECT content_type, AVG(id) as average 
    FROM har_file WHERE content_type IS NOT NULL
    GROUP BY content_type ORDER BY AVG(id) DESC";
    $result = $mysql_con->query($my_query);
    if (!$result)
        die('Invalid query: ' . $mysql_con->error);
        else if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while($row = $result->fetch_assoc()){
                    $age[$i] = $row;
                    $i++;
                }
                $answer['age'] = $age;
        }

    echo json_encode($answer); 