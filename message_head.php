<?php
session_start();
include 'db.php';
$friends =$db->prepare("SELECT * FROM `friends` WHERE `username`= ?");
$friends->execute(array($username));
$user_array = "'".$username."'";  
// echo $user_array;
if($friends->rowCount()>0)
{
$row = $friends->fetchAll(PDO::FETCH_OBJ);
$k = 0;
for ($k = 0;$k<=$friends->rowCount()-1;$k++)
{
    
$user_array.=",'".$row[$k]->{"friends_array"}."'";

}

}
$msg_query = $db->query("SELECT  * from `message` where (`user_to` in($user_array)) or (`user` = '$username') order by `date` DESC");
$msg_row = $msg_query->fetchAll(PDO::FETCH_OBJ);
$count = $msg_query->rowCount();
echo '<h1>Messages</h1>';
for($i=0;$i<=$count-1;$i++)
{
    if($msg_row[$i]->{"user"}!=$username)
    {
echo'
               
                <hr>
                <div class="msg_sect">
                    <div class="msg_bar">
                        

                        <div class="msg">
                            <span>'.$msg_row[$i]->{"user_to"}.':</span>
                            <p>'.$msg_row[$i]->{"content"}.'</p>
                        </div>
                        <i>Yesterday</i>
                    </div>
                 
                </div>';
    }
    else{
                 echo'    <hr>
                <div class="msg_sect">
                    <div class="msg_bar">
                        

                        <div class="msg">
                            <span>'.$msg_row[$i]->{"user_to"}.':</span>
                            <p>'.$msg_row[$i]->{"content"}.'</p>
                        </div>
                        <i>Yesterday</i>
                    </div>
                 
                </div>';    
    }
}
      
    




?>