<?php 
session_start();
include 'db.php';
if(isset($_SESSION["user"]))
{
  header("location:profile.php");
}
else{

$error_array = array("");


$username = "";
$password = "";


if(isset($_POST["submit"]))
{


  $username = $_POST["username"];

  $username = strip_tags($username);
  $username = str_replace(" ",'',$username);
  $username = strtolower($username);
  $_SESSION["username"] = $username;
  $password = $_POST["pass"];
  $password = strip_tags($password);
  $password = str_replace(" ",'',$password);
  $password = md5($password);
  
//  echo $password;

if($username=="" && $password=="")
{
array_push($error_array,"Don't Keep The Input Field Empty !!! ") ;
}

else{


$query1 = $db->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
$query1->execute(array($username,$password));

if($query1->rowCount()==1){

 
  $row2 = $query1->fetchAll(PDO::FETCH_OBJ);


// foreach($row2 as $name)
// {
// echo $name["fname"];
// }
  array_push($error_array,"Logged in Successfully") ;
$_SESSION["user"]=$row2[0]->{"fname"};
$_SESSION["user_name"]=$row2[0]->{"username"};
 header("location:profile.php");
}

  else{
    array_push($error_array,"Invalid Username Or Password") ;


  }

}
}
// $Query = $db->prepare("UPDATE users SET name = ? WHERE id = ?");
// $Query->execute(array($name,$id));
// if($Query){
// 	echo "record is updated";
// } else {
// 	echo "sorry";
// }


// $Query = $db->prepare("DELETE FROM users WHERE id = ?");
// $Query->execute(array($id));
// if($Query){
// 	echo "record is successfully deleted";
// } else {
// 	echo "sorry";
// }


// $Query = $db->prepare("SELECT * FROM users");
// $Query->execute();
// if($Query->rowCount() > 0){
//   $rows = $Query->fetchAll(PDO::FETCH_OBJ);
//   echo "<pre>";
//   print_r($rows);
// } else {
// 	echo "Sorry we dont have any records";
// }












}

 ?>
 <html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Signup</title>
<style>
form
{
 
}
</style>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <form action="login.php" method="post">

  <?php
  foreach($error_array as $error)
  {
    echo $error;
  }
  ?>
  <h1>LOGIN</h1>
  
<input type="text" name="username" id="email"  placeholder = "xyz@email.com" <?php  if(isset($_SESSION["username"]))
{echo "value =".$_SESSION["username"];

}?>>
<input type="password" name="pass" id="pass"  placeholder = "Password" >

<!-- <input type="date" name="date" id="date" value ="
 -->
<!-- <div class="radio-group">
  <div class="radio-block">
  <input type="radio" name="gender" id="gender" value="Male"><label for="gender">Male</label></div>
<div class="radio-block"><input type="radio" name="gender" id="gender" value="Female"><label for="gender">Female</label></div>
</div> -->
<button type="submit" name="submit">LOGIN</button>
<a href="index.php">Don't Have Account ?</a>
  </form>
</body>
</html>