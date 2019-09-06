<?php
session_start();
include 'db.php';
$user = $username;
$user_to = $_REQUEST["user_to"];
$msg = $_REQUEST["msg"];
$date = date("Y-m-d H:i:s");
$msg_id = $user."-".$user_to."-".$date."-".rand(1,1000000);

if(isset($msg) && $msg !=="")
{
    $msg_query = $db->prepare("INSERT INTO `message` (`user`,`user_to`,`date`,`content`,`msg_id`) VALUES(?,?,?,?,?)");
$msg_query->execute(array($user,$user_to,$date,$msg,$msg_id));

include 'msg.php';
}
?>