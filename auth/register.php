<?php
try{
    $dbconn = new PDO("mysql:host=localhost;dbname=fb","root","");
    
    } catch(PDOException $e){
        echo $e->getMessage();
    }
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
  $fname = str_replace(" ",'',$fname);
  $fname = ucfirst($fname);
  $_SESSION["fname"] = $fname;
  $lname = $_POST["lname"];
  $lname = strip_tags($lname);
  $lname = str_replace(" ",'',$lname);
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

$query1 = $dbconn->prepare("SELECT * FROM `users` WHERE `email` = ?");
$query1->execute(array($email));
$query2 = $dbconn->prepare("SELECT * FROM `users` WHERE `username` = ?");
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
    $Query = $dbconn->prepare("INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `username`,`password`,`date`) VALUES (?,?,?,?,?,?,?)");
$Query->execute(array(NULL,$fname,$lname,$email,$username,md5($password),$date));
if($Query){
  array_push($error_array,"Registered Successfully") ;
  $_SESSION["user"]=$fname;
  $_SESSION["user_name"]=$username;
 header("location:fb/profile.php");
} 
else{
  array_push($error_array,"Error in Creating Account") ;
}
  }

}
}
?>