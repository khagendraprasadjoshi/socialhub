<?php
$i = 0;
if($count>0)
{
for($i = 0;$i<=$count-1;$i++)
{$user = $req_row[$i]->{"username"};
    $time_req = timedef($req_row[$i]->{"date"});
    $user_query = $db->query("SELECT  * from `users` where `username` = '$user'");
    $user_row =   $user_query->fetchAll(PDO::FETCH_OBJ);
    $count_user =   $user_query->rowCount();
    $user_name = $user_row[0]->{"fname"}.' '.$user_row[0]->{"lname"};
echo '<div class="req_bar">
    <div class="name_goup">
    <div class="img_circle"></div>
    <span>'.$user_name.'</span>
    </div>
    <h6>'.$time_req.'</h6>
    <div class="button_group">
    <a  class="accept"   href="accept_req.php?req_name='.$user.'"><i class="fa fa-tick-right"></i>Accept</a>
    <a  value="'.$user.'" href="decline_req.php?req_name='.$user.'" class="decline">Decline</a>
    </div>
</div>
';
}

}
else
{
   echo '<span>No Friend Requests Available</span>';
}
echo '</div>';
  ?>

  