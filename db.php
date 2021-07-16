<?php
try{
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $cleardb_url = parse_url("mysql://b8c897ce16c12f:8b4d1434@eu-cdbr-west-01.cleardb.com/heroku_44b65294202021c?reconnect=true");
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
    $db = new PDO("mysql:host=".$cleardb_server.";dbname=".$cleardb_db,$cleardb_username,$cleardb_password);
    if(isset($_SESSION["user_name"]))
    {
    $username = $_SESSION["user_name"];
    }
    } catch(PDOException $e){
        echo $e->getMessage();
    }

// $active_group = 'default';
// $query_builder = TRUE;
// // Connect to DB
// $db = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
?>
