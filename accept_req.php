<?php
session_start();
include 'db.php';
$true = "1";
$req_frnd = $_GET["req_name"];
echo $req_frnd;
echo $username;
$add_friend = $db->prepare("UPDATE  `friends` SET `accepted` = ? WHERE `username`=? AND `friends_array` = ?");
// echo $username;
$add_friend->execute(array($true,$req_frnd,$username));
$date = date("Y-m-d H:i:s");
$add_friends = $db->prepare("INSERT INTO `friends` (`username`,`friends_array`,`date`,`accepted`) VALUES(?,?,?,?)");
$add_friends->execute(array($username,$req_frnd,$date,$true));
echo "completed";
if($add_friend && $add_friends)
{
header("location:friend_request.php");
}


?>