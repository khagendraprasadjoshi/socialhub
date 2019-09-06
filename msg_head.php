<?php


session_start();
include 'db.php';

$msg_query = $db->query("SELECT distinct `user`,`user_to` from `message` where (`user_to` = '$username') or (`user` = '$username') order by `date` DESC");
$msg_row = $msg_query->fetchAll(PDO::FETCH_OBJ);
$count = $msg_query->rowCount();
print_r($count);
for($i=0;$i<=$count-1;$i++)
{
    $user = $msg_row[$i]->{"user"};
    $user_to = $msg_row[$i]->{"user_to"};
    
echo $user_to.' </br>';
}

?>