<?php
    class Geolocations{
        public $lat;
        public $lon;
        public $count;
        public function __construct($lat,$lon,$count){
            $this->lat = $lat;
            $this->lon = $lon;
            $this->count = $count;
        }
    }

    function getGeolocations(){
        session_start();
        $username = $_SESSION['username'];
        $geoTable = [];
        $i = 0;
        include("db_connection.php");
        $my_query = "SELECT ST_X(serverIPgeolocation) as lat, 
        ST_Y(serverIPgeolocation) as lon , COUNT(id) as cnt
        FROM har_file 
        WHERE user_username='$username'
        GROUP BY serverIPgeolocation";

        $result = $mysql_con->query($my_query);
        if (!$result)
            die('Invalid query: ' . $mysql_con->error);
        else if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()){
                    if($row["lat"]!=null && $row["lat"]!="" && $row["lat"]!=" "){
                        $newGeo = new Geolocations($row["lat"], $row["lon"], $row["cnt"]);
                        $geoTable[$i]=$newGeo;
                        $i+=1;
                    }
                    //echo  $row["lat"] . " " . $row["lon"] . " " . $row["cnt"] . "<br>";
                }
        } 
        else
            echo "0 results";
        $mysql_con->close();
        echo json_encode($geoTable);
    }
    getGeolocations();