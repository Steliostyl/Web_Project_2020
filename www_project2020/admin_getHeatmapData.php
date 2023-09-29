<?php
    function getGeolocations(){
        session_start();
        $username = $_SESSION['username'];
        $flowMapTable = [];
        $rows= [];
        $i = 0;
        include("db_connection.php");
        $my_query = "SELECT * FROM 
        (SELECT 
        user_username,
        ST_X(userGeolocation) as origin_lat,
        ST_Y(userGeolocation) as origin_lon,
        ST_X(serverIPgeolocation) as destination_lat, 
        ST_Y(serverIPgeolocation) as destination_lon, 
        COUNT(id) as cnt
        FROM    har_file
        GROUP BY serverIPgeolocation) AS req
        ORDER BY req.user_username DESC";

        $result = $mysql_con->query($my_query);
        if (!$result)
            die('Invalid query: ' . $mysql_con->error);
        else if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()){
                    if($row["user_username"]!=null && $row["origin_lat"]!="" && $row["origin_lon"]!=" "&& $row["destination_lat"]!=" "&& $row["destination_lon"]!=" "){
                        $flowMap['username'] = $row["user_username"];
                        $flowMap['origin_lat'] = $row["origin_lat"];
                        $flowMap['origin_lon'] = $row["origin_lon"];
                        $flowMap['destination_lat'] = $row["destination_lat"];
                        $flowMap['destination_lon'] = $row["destination_lon"];
                        $flowMapTable[$i]=$flowMap;
                        $i+=1;
                        $rows[$i] = $row;
                    }
                    //echo  $row["lat"] . " " . $row["lon"] . " " . $row["cnt"] . "<br>";
                }
        } 
        else
            echo "0 results";
        $mysql_con->close();
        echo json_encode($rows);
    }
    getGeolocations();