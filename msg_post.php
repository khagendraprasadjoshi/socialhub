<?php
session_start();
include 'db.php';
$user = $username;
$user_to = '.$_REQUEST["user_to"].';
$msg_query = $db->query("SELECT * from `message` where (`user` = '$user' and `user_to` = '$user_to') or (`user` = '$user_to' and `user_to` = '$user') order by `date` ASC");
$msg_row = $msg_query->fetchAll(PDO::FETCH_OBJ);
$count = $msg_query->rowCount();

for($i = 0;$i<=$count-1;$i++)
{
$msg_content = $msg_row[$i]->{"content"};
$msg_user = $msg_row[$i]->{"user"};
$msg_user_to = $msg_row[$i]->{"user_to"};

$start_date = new DateTime($msg_row[$i]->{"date"});


$time_message = "9:30 PM";


if($msg_user===$username)
{
echo'
<div class="sent">'.$msg_content.'<i>'.$time_message.'</i>
</div>'; 
}
else{
echo'
<div class="rec">'.$msg_content.'<i>'.$time_message.'</i>
</div>'
; 
}
}

?>