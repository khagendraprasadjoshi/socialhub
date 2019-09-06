<?php 
session_start();

if(isset($_SESSION["user"]))
{
  header("location:profile.php");
}
else{
 include 'db.php';
$error_array = array("");


$fname = "";
$lname = "";
$email = "";
$password = "";
$cpassword = "";
if(isset($_POST["submit"]))
{

  $fname = $_POST["fname"];
  $fname = strip_tags($fname);
 
  $fname = ucfirst($fname);
  $_SESSION["fname"] = $fname;
  $lname = $_POST["lname"];
  $lname = strip_tags($lname);
 
  $lname = ucfirst($lname);
  $_SESSION["lname"] = $lname;
  $email = $_POST["email"];
  $email = strip_tags($email);
  $email = str_replace(" ",'',$email);
  $email = strtolower($email);
  $_SESSION["email"] = $email;
  $password = $_POST["pass"];
  $password = strip_tags($password);
  $password = str_replace(" ",'',$password);
  
  $cpassword = $_POST["cpass"];
  $cpassword = strip_tags($cpassword);
  $cpassword = str_replace(" ",'',$cpassword);
  $date = date("Y-m-d H:i:s");
if($fname == "" && $lname =="" && $email=="" && $password=="" && $cpassword=="")
{
array_push($error_array,"Don't Keep The Input Field Empty !!! ") ;
}
else if($password!=$cpassword)
{
  array_push($error_array,"Both The Password Should Be Same !!! ") ;
 
}
else{
$username = strtolower($fname."_".$lname).rand(0,10000);

$query1 = $db->prepare("SELECT * FROM `users` WHERE `email` = ?");
$query1->execute(array($email));
$query2 = $db->prepare("SELECT * FROM `users` WHERE `username` = ?");
$query2->execute(array($username));
if($query2->rowCount() > 0 || $query1->rowCount()>0){
  // $row1 = $query2->fetchAll(PDO::FETCH_OBJ);
  // echo "<pre>";
  // print_r($row1);
  // $row2 = $query1->fetchAll(PDO::FETCH_OBJ);
  // echo "<pre>";
  // print_r($row2);
  array_push($error_array,"Email or Username already in Use") ;

 
}

  else{
// echo $date;
    // echo "No records";
    $Query = $db->prepare("INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `username`,`password`,`date`) VALUES (?,?,?,?,?,?,?)");
$Query->execute(array(NULL,$fname,$lname,$email,$username,md5($password),$date));
if($Query){
  array_push($error_array,"Registered Successfully") ;
  $_SESSION["user"]=$fname;
  $_SESSION["user_name"]=$username;
 header("location:profile.php");
} 
else{
  array_push($error_array,"Error in Creating Account") ;
}
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

  <form action="index.php" method="post">

  <?php
  foreach($error_array as $error)
  {
    echo $error;
  }
  ?>
  <h1>Create an Account</h1>
  <input type="text" name="fname" id="fname" placeholder = "First Name" value ="<?php if(isset($_SESSION["fname"]))
{echo $_SESSION["fname"];
}?>">
<input type="text" name="lname" id="lname"  placeholder = "Last Name" value ="<?php if(isset($_SESSION["lname"]))
{echo $_SESSION["lname"];
}?>">
<input type="email" name="email" id="email"  placeholder = "xyz@email.com" value ="<?php if(isset($_SESSION["email"]))
{echo $_SESSION["email"];
}?>">
<input type="password" name="pass" id="pass"  placeholder = "Password" >
<input type="password" name="cpass" id="pass"  placeholder = "Confirm Password" >
<!-- <input type="date" name="date" id="date" value ="
  <?php 
  echo $_POST["date"];
  ?>"> -->
<!-- <div class="radio-group">
  <div class="radio-block">
  <input type="radio" name="gender" id="gender" value="Male"><label for="gender">Male</label></div>
<div class="radio-block"><input type="radio" name="gender" id="gender" value="Female"><label for="gender">Female</label></div>
</div> -->
<button type="submit" name="submit">Create Account</button>
  <a href="login.php">Already Have Account</a>
  </form>
</body>
</html>