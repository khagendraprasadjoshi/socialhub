<?php
session_start();
if(!isset($_SESSION["user_name"]))
{
header("location:login.php");
}
include 'db.php';
$true = "0";
$req = $db->prepare("SELECT * FROM `friends` where `friends_array` =? and `accepted`=?");
$req->execute(array($username,$true));
if($req->rowCount()>0)
{
    $req_row = $req->fetchAll(PDO::FETCH_OBJ);
    // print_r($req_row);
    $count = $req->rowCount();
}
else{
    $count = 0;
}
function timedef($date)
{
    $date_time_now = date("Y-m-d H:i:s");
                        $start_date = new DateTime($date);
                        $end_date = new DateTime($date_time_now); //Current time
                        $interval = $start_date->diff($end_date); //Difference between dates 
                        if($interval->y >= 1) {
                            if($interval->y == 1)
                                return $time_message = $interval->y . " year ago"; //1 year ago
                            else 
                                return $time_message = $interval->y . " years ago"; //1+ year ago
                        }
                        else if ($interval-> m >= 1) {
                            if($interval->d == 0) {
                                $days = " ago";
                            }
                            else if($interval->d == 1) {
                                $days = $interval->d . " day ago";
                            }
                            else {
                                $days = $interval->d . " days ago";
                            }
    
    
                            if($interval->m == 1) {
                                return $time_message = $interval->m . " month". $days;
                            }
                            else {
                                return $time_message = $interval->m . " months". $days;
                            }
    
                        }
                        else if($interval->d >= 1) {
                            if($interval->d == 1) {
                                return $time_message = "Yesterday";
                            }
                            else {
                                return $time_message = $interval->d . " days ago";
                            }
                        }
                        else if($interval->h >= 1) {
                            if($interval->h == 1) {
                                return $time_message = $interval->h . " hour ago";
                            }
                            else {
                                return $time_message = $interval->h . " hours ago";
                            }
                        }
                        else if($interval->i >= 1) {
                            if($interval->i == 1) {
                                return $time_message = $interval->i . " minute ago";
                            }
                            else {
                                return $time_message = $interval->i . " minutes ago";
                            }
                        }
                        else {
                            if($interval->s < 30) {
                                return $time_message = "Just now";
                            }
                            else {
                                return $time_message = $interval->s . " seconds ago";
                            }
                        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/profile.css">
    <script src="http://localhost/fb/js/jquery.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <style>
        body {
            background: rgba(209, 204, 204, 0.281) !important;

        }
    </style>
</head>

<body>
    <?php
include_once 'header.php';
    ?>
    <section class="main">
        <div class="sect_left">
            <h2>Friend Requests</h2>
 


            <hr>
            <h4>Recent Requests</h4>
            <?php
include 'requests.php';

?>

            <div class="sect_right">
                <h2>Suggested Friends</h2>
                <hr>
            </div>
            <div class="data"></div>
    </section>
</body>
<script>


    $(document).ready(function () {



                });
</script>

</html>