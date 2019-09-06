<?php
session_start();
include 'db.php';
$user = $username;
$user_to = $_REQUEST["user_to"];

$seen="1";
$msg_query = $db->query("UPDATE  `message` set `seen`='$seen' where `user` = '$user_to' and `user_to` = '$user'");




echo'
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/message_sect.css">
    <style>
        body {
            background: rgba(209, 204, 204, 0.281) !important;

        }
    </style>
</head>

<body>';

include 'header.php';
    
   echo' <section class="main">

   <div class="message_sect_part">
   
   <div class="right sect">
   <h4>'.$user_to.'</h4>
   <div class="msg_sect_right">
   <div class="msg_thread">
  ';


       
echo'
</div>
<div class="message_post">
   <textarea  id="msg_content" cols="30" rows="10" placeholder="Enter a message..."></textarea>
   <button class="send">Send <i class="fa fa-send"></i></button>
</div>
</div> </div>
       
    </section>
   <script>

$(document).ready(function () {
var user = "'.$username.'";

               var user_to = "'.$user_to.'";
               $.ajax({
                url: "msg_post.php",
                type: "POST",
                data: "user_to ="+user_to,
                cache:false,
    
                success: function(data) {
                    $(".msg_thread).html(data);
                  
                // location.reload();
                }
            });

    var sent = document.querySelector("button.send");

    sent.addEventListener("click",function()
                {
                  
                    var msg1 = $("#msg_content").val();
                    if(msg1!="")
                    {
            get_messages();
                    }
       
            
            });
    function get_messages()
        {
           
  
        var msg = $("#msg_content").val();
            $.ajax({
			url: "message_fun.php",
			type: "POST",
			data: "user ="+user+"&user_to="+user_to+"&msg="+msg,
			cache:false,

			success: function(data) {
                $(".msg_thread").html(data);
              
			// location.reload();
			}
		});
        }
    });


           

   </script>
   <script src="http://localhost/fb/js/jquery.js"></script>
</body>

</html>';

   ?>