<?php

session_start();
if(!isset($_SESSION["user_name"]))
{
header("location:login.php");
}
// $username = "";
$username = $_SESSION["user_name"];

try{
$db = new PDO("mysql:host=localhost;dbname=fb","root","");

} catch(PDOException $e){
    echo $e->getMessage();
}
if(isset($_REQUEST["user"]) && isset($_REQUEST["page"]))
{
$user_get = $_REQUEST["user"];
$page_get = $_REQUEST["page"];

post_display($user_get,$page_get);
}
function post_display($user,$page)
{
   
    $username = $_SESSION["user_name"];
    try{
    $db = new PDO("mysql:host=localhost;dbname=fb","root","");
    
    } catch(PDOException $e){
        echo $e->getMessage();
    }
    $true="1";
    $profile = $db->prepare("INSERT INTO `profile` (`username`) VALUES(?)");
    $profile->execute(array($username));
    $friends =$db->prepare("SELECT * FROM `friends` WHERE `username`= ? AND `accepted`=?");
    $friends->execute(array($username,$true));
    $user_array = "'".$user."'";  
    // echo $user_array;
    if($friends->rowCount()>0)
    {
    $row = $friends->fetchAll(PDO::FETCH_OBJ);
$k = 0;
    for ($k = 0;$k<=$friends->rowCount()-1;$k++)
    {
        
    $user_array.=",'".$row[$k]->{"friends_array"}."'";

    }
    
    // echo $user_array;
    // echo $frnd_username;
    }
    else{
       ;

    }
    $false="0";
    $query1 = $db->query("SELECT * FROM `posts` WHERE `username` in($user_array) and `deleted`='$false'");
   
    if($query1->rowCount()>0){
 
     $i = 0;
        $row2 = $query1->fetchAll(PDO::FETCH_OBJ);
    for($i = $query1->rowCount()-1;$i>=0;$i--)
    {
        
        $date_time_now = date("Y-m-d H:i:s");
                        $start_date = new DateTime($row2[$i]->{"date"});
                        $end_date = new DateTime($date_time_now); //Current time
                        $interval = $start_date->diff($end_date); //Difference between dates 
                        if($interval->y >= 1) {
                            if($interval->y == 1)
                                $time_message = $interval->y . " year ago"; //1 year ago
                            else 
                                $time_message = $interval->y . " years ago"; //1+ year ago
                        }
                        else if ($interval-> m >= 1) {
                            if($interval->d == 0) {
                                $days = " ago";
                            }
                            else if($interval->d == 1) {
                                $days = $interval->d . " day ago";
                            }
                            else {
                                $days = $interval->d . " days ago";
                            }
    
    
                            if($interval->m == 1) {
                                $time_message = $interval->m . " month". $days;
                            }
                            else {
                                $time_message = $interval->m . " months". $days;
                            }
    
                        }
                        else if($interval->d >= 1) {
                            if($interval->d == 1) {
                                $time_message = "Yesterday";
                            }
                            else {
                                $time_message = $interval->d . " days ago";
                            }
                        }
                        else if($interval->h >= 1) {
                            if($interval->h == 1) {
                                $time_message = $interval->h . " hour ago";
                            }
                            else {
                                $time_message = $interval->h . " hours ago";
                            }
                        }
                        else if($interval->i >= 1) {
                            if($interval->i == 1) {
                                $time_message = $interval->i . " minute ago";
                            }
                            else {
                                $time_message = $interval->i . " minutes ago";
                            }
                        }
                        else {
                            if($interval->s < 30) {
                                $time_message = "Just now";
                            }
                            else {
                                $time_message = $interval->s . " seconds ago";
                            }
                        }
                        
        $img = $row2[$i]->{"post_img"};
        $post_id = $row2[$i]->{"post_id"};
        $caption = $row2[$i]->{"caption"};
        $usr = $row2[$i]->{"username"};
    $post = '<div class="post">
    <div class="post_header">
        <div class="post_header_left">
            <div class="post_username_pic"></div>
            <div class="user_block">
                <h5>'.$usr.'</h5>
                <h5 class="time">'.$time_message.'</h5>
            </div>
       
    
    
        </div>
        <div class="post_header_right">
        <a href="delete_post.php?post_id='.$post_id.'&page='.$page.'"> <div class="dot"></div></a>
        

        
            
    
    
       </div>
    
    </div>
    
    <div class="post_desc">';
    echo $post;
    if($caption!="")
        {
        echo '<h4>'.$caption.'</h4>';
        }
        if($img!="")
        {
        echo '<div class="post_pic">
        <img src="http://localhost/fb/'.$row2[$i]->{"post_img"}.
        '">
        </div>';
        }
    echo '</div>
    <div class="post_reacts">
        <a href="likes.php?page='.$page.'&post_id='.$post_id.'&likes='.$row2[$i]->{"likes"}.'" class="like">'.$row2[$i]->{"likes"}.' LIKES</a>';
    
    // echo    "var like = document.querySelectorAll('button.like');";
    
    // echo '  like.addEventListener("click", function(){
    // // e.preventDefault();
    // // alert("fuck");
    //   });
    //   </script>
    echo '</div>

    
    </div>
    
    ';
    
     }
    }
     else{
         
      echo "<h3>No Posts Available</h3>";   
         
     }
     
    }
  
    
   
if(isset($_SESSION["user"])&&isset($_SESSION["user_name"]))

{
    
    // echo $_SESSION["user_name"];
   
}

   
if(isset($_POST["submit"]))
{

    $caption = $_POST["caption"];
    $post_id = $username."-posts".rand(1,1000);
    $post_img = "";
    $likes = 0;
    $comments = 0;
    $date = date("Y-m-d H:i:s");
    // $username = $_SESSION["user_name"];
    if($_FILES['image']['name']!="")
    {
    $folder ="uploads/posts/"; 

    $image = $_FILES['image']['name']; 

    $path = $folder . $image ; 

    $target_file=$folder.basename($_FILES["image"]["name"]);

    
    $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

    
    $allowed=array('jpeg','png' ,'jpg','gif'); $filename=$_FILES['image']['name']; 

    $ext=pathinfo($filename, PATHINFO_EXTENSION); 
    if(!in_array($ext,$allowed) ) 

    { 

    echo "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
    $path = "";
    }

    else{ 

    move_uploaded_file( $_FILES['image'] ['tmp_name'], $path); 

    // $sth=$con->prepare("insert into users(image)values(:image) "); 

    // $sth->bindParam(':image',$image); 

    // $sth->execute(); 

    } 
    }
    else{
        $path = "";  
    }


if($caption!="" || $path !="")
{
    $Query = $db->prepare("INSERT INTO `posts` (`post_id`, `caption`, `post_img`, `likes`, `comments`,`username`,`date`) VALUES (?,?,?,?,?,?,?)");
    $Query->execute(array($post_id,$caption,$path,$likes,$comments,$username,$date));
    if($Query)
    {
        // echo "Success";
        
    }
    else{
        echo "Failure";
    }


}
else{

}






}
    

?>
