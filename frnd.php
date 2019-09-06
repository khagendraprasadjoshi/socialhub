<?php
session_start();
$user = $_SESSION["user_name"];
include_once 'db.php';
$friends =$db->prepare("SELECT * FROM `friends`");
    $friends->execute();
    // $user_array = "'".$user."'";  
    // echo $user_array;
    if($friends->rowCount()>0)
    {
    $row = $friends->fetchAll(PDO::FETCH_OBJ);
    print_r($row);
$k = 0;
    for ($k = 0;$k<=$friends->rowCount()-1;$k++)
    {
        
        echo $row[$k]->{"friends_array"};

    }
}

?>