<?php
session_start();
include 'db.php';



$seen="0";
$msg = $db->query("SELECT * FROM `message` where `user_to` = '$username' and `seen`='$seen'");


if($msg->rowCount()>0)
{
    // $msg_row = $msg->fetchAll(PDO::FETCH_OBJ);
    // print_r($msg_row);
    $count_msg = $msg->rowCount();
}
else{
    $count_msg = 0;
}
echo $count_msg;

?>