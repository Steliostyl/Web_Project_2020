<?php
    class entry{
        public $sessionUsername;
        public $startedDateTime;
        public $wait;
        public $method;
        public $url;
        public $status;
        public $statusText;
        public $content_type;
        public $cache_control;
        public $pragma;
        public $expires;
        public $age;
        public $last_modified;
        public $host;
        public $serverIPgeolocation;
        public $userISP;
        public $userGeolocation;
        
        public function __construct($sessionUsername){
            $this->sessionUsername = $sessionUsername;
            $this->startedDateTime = null;
            $this->serverIPAddress = null;
            $this->wait = null;
            $this->method = null;
            $this->url = null;
            $this->status = null;
            $this->statusText = null;
            $this->content_type = null;
            $this->cache_control = null;
            $this->pragma = null;
            $this->expires = null;
            $this->age = null;
            $this->last_modified = null;
            $this->host = null;
            $this->serverIPgeolocation = null;
            $this->userISP = null;
            $this->userGeolocation = null;
        }
        // Function to reset object variables
        public function nullify(){
            $this->startedDateTime = null;
            $this->serverIPAddress = null;
            $this->wait = null;
            $this->method = null;
            $this->url = null;
            $this->status = null;
            $this->statusText = null;
            $this->content_type = null;
            $this->cache_control = null;
            $this->pragma = null;
            $this->expires = null;
            $this->age = null;
            $this->last_modified = null;
            $this->host = null;
            $this->serverIPgeolocation = null;
            $this->userISP = null;
            $this->userGeolocation = null;
        }
    }

    function convertDateTime($name, $toConvert){
        $date = strtotime($toConvert);
        //echo $name . ": " . strval(date('Y-m-d H:i:s',$date)) . "\r\n";
        return strval(date('Y-m-d H:i:s',$date));
    }
    // Insert entry to the database
    function insert($newEntry) {
        include("db_connection.php");
        $my_query = "INSERT INTO har_file(user_username, startedDateTime, serverIPAddress, wait, method, 
        url, status, statusText, content_type, cache_control, pragma, expires, age, last_modified, host, 
        serverIPgeolocation, userISP, userGeolocation) 
        VALUES(
            '$newEntry->sessionUsername',
            " . ($newEntry->startedDateTime==NULL ? "NULL" : "'$newEntry->startedDateTime'") . ",
            " . ($newEntry->serverIPAddress==NULL ? "NULL" : "'$newEntry->serverIPAddress'") . ",
            " . ($newEntry->wait==NULL ? "NULL" : "'$newEntry->wait'") . ",
            " . ($newEntry->method==NULL ? "NULL" : "'$newEntry->method'") . ",
            " . ($newEntry->url==NULL ? "NULL" : "'$newEntry->url'") . ",
            " . ($newEntry->status==NULL ? "NULL" : "'$newEntry->status'") . ",
            " . ($newEntry->statusText==NULL ? "NULL" : "'$newEntry->statusText'") . ",
            " . ($newEntry->content_type==NULL ? "NULL" : "'$newEntry->content_type'") . ",
            " . ($newEntry->cache_control==NULL ? "NULL" : "'$newEntry->cache_control'") . ",
            " . ($newEntry->pragma==NULL ? "NULL" : "'$newEntry->pragma'") . ",
            " . ($newEntry->expires==NULL ? "NULL" : "'$newEntry->expires'") . ",
            " . ($newEntry->age==NULL ? "NULL" : "'$newEntry->age'") . ",
            " . ($newEntry->last_modified==NULL ? "NULL" : "'$newEntry->last_modified'") . ",
            " . ($newEntry->host==NULL ? "NULL" : "'$newEntry->host'") . ",
            " . ($newEntry->serverIPgeolocation==NULL ? "NULL" : "ST_GeomFromText('$newEntry->serverIPgeolocation')") . ",
            " . ($newEntry->userISP==NULL ? "NULL" : "'$newEntry->userISP'") . ",
            ST_GeomFromText('$newEntry->userGeolocation')
        )";
        //echo $my_query;
        $result = $mysql_con->query($my_query);
        if (!$result)
            die('Invalid query: ' . $mysql_con->error);
        $mysql_con->close();
    }

    session_start();
    include("db_connection.php");
    $lastUpload = date('Y-m-d H:i:s');
    $sesUsername = $_SESSION["username"];
    
    $my_query = "UPDATE user 
    SET uploadCount = uploadCount + 1, lastUpload='$lastUpload'  
    WHERE username='$sesUsername'";
    
    $result = $mysql_con->query($my_query);
    if (!$result)
        die('Invalid query: ' . $mysql_con->error);
    $mysql_con->close();

    date_default_timezone_set("Europe/Athens");
    $_FILES["file"]["name"] = $_SESSION['username'] . date("Y-m-d-His") . ".har";
    move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/".$_FILES["file"]["name"]);
    echo "File uploaded succesfully" . "\r\n";

    // Get entries from file
    $json = file_get_contents("uploads/" . $_FILES["file"]["name"]);
    $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($json, TRUE)),
        RecursiveIteratorIterator::SELF_FIRST);

    // Crate an (almost) empty entry object
    $newEntry = new entry($_SESSION["username"]);
    $firstTime = true;
    foreach ($jsonIterator as $key => $value) {
        // New entry, userGeo or serverGeo
        if (is_array($value)) {
            // New Entry
            if(!$firstTime){
                insert($newEntry);
                $newEntry->nullify();
            }
            else 
                $firstTime = false;
        } else {
            if($key === "startedDateTime"){
                $newEntry->startedDateTime = convertDateTime("startedDateTime",$value);
            }
            else if($key === 'serverIPAddress')
                $newEntry->serverIPAddress = $value;
            else if($key === 'wait')
                $newEntry->wait = $value;
            else if($key === 'method')
                $newEntry->method = $value;
            else if($key === 'url')
                $newEntry->url = $value;
            else if($key === 'status')
                $newEntry->status = $value;
            else if($key === 'statusText')
                $newEntry->statusText = $value;
            else if($key === 'content_type')
                $newEntry->content_type = $value;
            else if($key === 'cache_control')
                $newEntry->cache_control = $value;
            else if($key === 'pragma')
                $newEntry->pragma = $value;
            else if($key === 'expires'){
                if($value!='' && $value!='null'){
                    $newEntry->expires = convertDateTime("expires", $value);
                }
            }
            else if($key === 'age'){
                if($value!="")
                    $newEntry->age = $value;
            }
            else if($key === 'last_modified'){
                if($value!='' && $value!='null'){
                    $newEntry->last_modified = convertDateTime("last_modified", $value);
                }
            }
            else if($key === 'host'){
                if($value!='' && $value!='null')
                    $newEntry->host = $value;
            }
            else if($key === 'userISP')
                $newEntry->userISP = $value;
            else if($key === 'serverIPgeolocation')
                $newEntry->serverIPgeolocation = $value;
            else if($key === 'userGeolocation')
                $newEntry->userGeolocation = $value;
        }
    }