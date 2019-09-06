

<?php
session_start();
include 'db.php';
$msg_query = $db->query("SELECT distinct `user`,`user_to` from `message` where (`user_to` = '$username') order by `date` DESC");
$msg_row = $msg_query->fetchAll(PDO::FETCH_OBJ);

$count = $msg_query->rowCount();


for($i=0;$i<=$count-1;$i++)
{
    $user = $msg_row[$i]->{"user"};
    $user_to = $msg_row[$i]->{"user_to"};
    $seen="0";
    $count_query = $db->query("SELECT  * from `message` where `user` = '$user' and `seen`='$seen'");
$count_row =   $count_query->fetchAll(PDO::FETCH_OBJ);
$count_msg =   $count_query->rowCount();
$user_query = $db->query("SELECT  * from `users` where `username` = '$user'");
$user_row =   $user_query->fetchAll(PDO::FETCH_OBJ);
$count_user =   $user_query->rowCount();
$user_name = $user_row[0]->{"fname"}.' '.$user_row[0]->{"lname"};
echo '<div class="msg_feed" value="'.$user.'"><div class="user_image"></div>
       <span>'.$user_name.'</span>
       <a class="see_msg" href="message.php?user_to='.$user.'"><span class="badge_dark">'.$count_msg.'</span><span>
        New Messages </span></a>
       </div>';
//       echo' <script>
//               $(document).ready(function () {
//                      var msg = document.querySelector(".see_msg");
//         msg.addEventListener("click",function()
// 			{
	
           
//        	var user_to = "'.$user_to.'";
//                 $.ajax({
// 			url: "msg_thread.php",
// 			type: "GET",
// 			data: "user_to="+user_to,
// 			cache:false,

// 			success: function(data) {
//                 $(".right.sect").html(data);
              
// 			// location.reload();
// 			}
//               });
//        });
//               });
//        </script>';
}
       ?>
       