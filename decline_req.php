<?php
session_start();
include 'db.php';
$true = "1";
$req_frnd = $_GET["req_name"];
// echo $req_frnd;
// echo $username;
$add_friend = $db->query("DELETE  FROM `friends` WHERE `username`='$req_frnd' AND `friends_array` = '$username'");
// echo $username;



if($add_friend)
{
header("location:friend_request.php");
}


?>