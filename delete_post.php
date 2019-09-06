<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=fb","root","");
    
    } catch(PDOException $e){
        echo $e->getMessage();
    }
$post_id = $_GET["post_id"];
$page = $_GET["page"];
$true="1";
$sql = $db->query("UPDATE  `posts`
SET `deleted`='$true'
WHERE `post_id` = '$post_id'");

 
$sql1 = $db->query("DELETE  FROM `likes`  where `post_id` = '$post_id'");
if($sql && $sql1)
{
header("location:".$page);
}

?>