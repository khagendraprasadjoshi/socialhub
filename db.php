<?php


try{
 
    $db = new PDO("mysql:host=localhost;dbname=fb","root","");
    if(isset($_SESSION["user_name"]))
    {
    $username = $_SESSION["user_name"];
    }
    } catch(PDOException $e){
        echo $e->getMessage();
    }
?>