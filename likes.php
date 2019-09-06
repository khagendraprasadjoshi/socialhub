<?php
session_start();
include 'db.php';
$page = $_GET["page"];
$post_id = $_GET["post_id"];
$likes = $_GET["likes"];


$date = date("Y-m-d H:i:s");

$true = "1";
$false = "0";
    $sql2 = $db->query("SELECT * FROM `likes` where `post_id` = '$post_id' and `likers`='$username'");

// echo $sql2->rowCount();
$row = $sql2->fetchAll(PDO::FETCH_OBJ);
// echo $likes;

$c= $row[0]->{"liked"};
// echo $c;


if($sql2->rowCount()==0)
{
    // echo "HEY";
 
    $sql = $db->query("INSERT INTO `likes` (`post_id`,`likers`,`date`,`liked`) VALUES('$post_id','$username','$date','$true')");
    //     $likes +=1; 
   
    $likes+=1;
}
else if($c===$true && $sql2->rowCount()==1)
{
    $sql1 = $db->query("UPDATE  `likes` set `liked` ='$false' where `post_id` = '$post_id' and `likers`='$username'");
    $likes-=1;
}


else if($sql2->rowCount()==1 && $c===$false)
{
    $true= "1";
   
    $sql1 = $db->query("UPDATE  `likes` set `liked` ='$true' where `post_id` = '$post_id' and `likers`='$username'");
    $likes +=1; 
}

// else if($sql2->rowCount()==0 && $c===$true)
// {
    
//     $sql = $db->query("UPDATE  `likes` set `liked` ='$false' where `post_id` = '$post_id' and `likers`='$username'");
//     $likes -=1; 
// }

$sql1 = $db->query("UPDATE `posts` SET `likes` = $likes
WHERE `post_id` = '$post_id'");

if($sql1)
{
header("location:".$page);
}







?>