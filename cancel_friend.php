<?php
session_start();
require_once 'db.php';
$friend_username = $_REQUEST["friend_username"];
echo $friend_username;
$search = $_GET["search"];
$username = $_SESSION["user_name"];
echo $username;
$check_friend = $db->prepare("SELECT * from `friends` where `username` = ? and `friends_array`=?");
$check_friend->execute(array($username,$friend_username));
$date = date("Y-m-d H:i:s");
echo $check_friend->rowCount();
if($check_friend->rowCount()==1)
{
$add_friend = $db->query("DELETE FROM `friends` where `username`='$username' and `friends_array`='$friend_username' and `accepted`='0' ");

if($add_friend)
{
header("location:search.php?search=".$search."");
}
}
else{
    echo "Failed";
  
    
}

?>