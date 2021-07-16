<?php
session_start();
include 'db.php';


if(!isset($_SESSION["user_name"]))
{
header("location:login.php");
}
$username = $_SESSION["user_name"];

if(isset($_GET["search"]))
{
$search = $_GET["search"];
}
if(isset($search) && $search!=null)
{
// echo $search;
$search = $search.'%';
$search1 = '%'.$search;
$user = $_SESSION["user_name"];

$query = $db->query("SELECT * FROM `users` WHERE `fname` LIKE  '$search' AND `username` NOT IN('$user') ");

if($query->rowCount()>0)
{
    $row = $query->fetchAll(PDO::FETCH_OBJ);
    // print_r($row);
}
//Select Friends Who Accepted Friend Request...
$query_frnd = $db->query("SELECT * FROM `friends` WHERE `username`='$username' AND accepted='1' ");
$friends_arr = array("");

if($query_frnd->rowCount()>0)
{
    $row_frnd = $query_frnd->fetchAll(PDO::FETCH_OBJ);
    $i = 0;
for($i=0;$i<=$query_frnd->rowCount()-1;$i++)
{
    $usr = $row_frnd[$i]->{"friends_array"};
 array_push($friends_arr,$usr);
}
  
}
//Select Friends Who did not Accept Friend Request...
$query_not_accept= $db->query("SELECT * FROM `friends` WHERE `username`='$username' AND accepted='0' ");
$friends_arr_not = array("");
if($query_not_accept->rowCount()>0)
{
    $row_frnds = $query_not_accept->fetchAll(PDO::FETCH_OBJ);
    $i = 0;
for($i=0;$i<=$query_not_accept->rowCount()-1;$i++)
{
    $usrs = $row_frnds[$i]->{"friends_array"};
 array_push($friends_arr_not,$usrs);

}

}
}








?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/profile.css">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
    <style>
        body {
            background: rgba(209, 204, 204, 0.281) !important;

        }
    </style>
</head>

<body>
<?php
include 'db.php';
$true = "0";
$req = $db->prepare("SELECT * FROM `friends` where `friends_array` =? and `accepted`=?");
$req->execute(array($username,$true));

if($req->rowCount()>0)
{
    $req_row = $req->fetchAll(PDO::FETCH_OBJ);
    // print_r($req_row);
    $counts = $req->rowCount();
}
else{
    $counts = 0;
}
?>

<script src="http://localhost/socialhub/js/jquery.js"></script>
<?php
include 'header.php' ?>

    <section class="main">
    <div class="search_section">
 <?php   if(isset($_GET["search"]))
  {
echo '<h1>Search Results For '; 

    echo '<i>'.$_GET["search"].'</i>'; 
  
}
if(isset($_GET["search"])&& is_null($_GET["search"]))
{
    echo "<i>Don't Keep The Search Bar Empty</i>";
}
?></h1>
<?php

if(isset($_REQUEST["search"]) && $_REQUEST["search"]==!null)
{
if($query->rowCount()>0)

{


$i = 0;
for($i=0;$i<=$query->rowCount()-1;$i++)
{
 
    
echo '<div class="sects">';
    
    $fnames = $row[$i]->{"fname"};
    $lnames = $row[$i]->{"lname"};
    $username = $row[$i]->{"username"};
   if(in_array($username,$friends_arr))
   {
       $a =       '<a href="message.php?user_to='.$username.'"  class="freinds">
                 
       Message
                           
                        </a>';
   }
   else if(in_array($username,$friends_arr_not))
   {
    $a =  ' <a href="cancel_friend.php?friend_username='.$username.'&search='.$_REQUEST["search"].'" class="freinds">
                 
 Request Sent
                        
                     </a>'; 
   }
   else{
    $a =  ' <a href="add_friend.php?friend_username='.$username.'&search='.$_REQUEST["search"].'" class="freinds">
                 
    ADD FRIEND
                        
                     </a>';
   }
                echo'<div class="sect 1">
                    <div class="img_prof"></div>
                    <span>'.$fnames.' '.$lnames.'</span>'.$a.
                   
                '</div>
                </div>';
                
} 






}



 


else{
    echo '<h3> No Friends Found</h3>';
}

}
?>
</div>
    </section>
    <script>
// $(document).ready(function () {
//     var search = document.querySelector('button.search');
//  var load = $('img.loading');
//  load.hide();

 
// 			search.addEventListener("click",function()
// 			{
//                 load.show();

//                 var search_val = $("#val").val(); 
          
            
// 				$.ajax({
// 			url: "search_fun.php",
// 			type: "POST",
// 			data: "search="+search_val,
// 			cache:false,

// 			success: function(data) {
//                 load.hide();
// 				$('.search_section').html(data);
// 			}
// 		});
		

//             });

// });

           
            </script>
</body>

</html>