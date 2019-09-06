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
if($check_friend->rowCount()==0)
{
$add_friend = $db->prepare("INSERT INTO `friends` (`username`,`friends_array`,`date`) VALUES(?,?,?)");
$add_friend->execute(array($username,$friend_username,$date));
if($add_friend)
{
header("location:search.php?search=".$search."");
}
}
else{
    echo "Failed";
  
    
}

?>