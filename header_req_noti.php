<?php
session_start();
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

echo $counts;

?>