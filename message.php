<?php

session_start();
include 'db.php';
$user_to = $_REQUEST["user_to"];
$username;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="http://localhost/fb/css/message_sect.css">
    <link rel="stylesheet" href="http://localhost/fb/css/header.css">
    <link rel="stylesheet" href="http://localhost/fb/css/profile.css">
    <style>
        body {
            background: rgba(209, 204, 204, 0.281) !important;

        }
    </style>
</head>

<body>
    <?php
include 'header.php';
    ?>
    <div class="message_sect_part">
   
   <div class="right sect">
   <h4><?php $user_query = $db->query("SELECT  * from `users` where `username` = '$user_to'");
$user_row =   $user_query->fetchAll(PDO::FETCH_OBJ);
$count_user =   $user_query->rowCount();
$user_name = $user_row[0]->{"fname"}.' '.$user_row[0]->{"lname"}; 
echo $user_name;?></h4>
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
    <?php
    $usr = $username
       ?>
 
 <script>
        $(document).ready(function () {

            var search = document.querySelector('button.search');

            $('.msg_thread').animate({scrollTop:$('.msg_thread')[0].scrollHeight},200);

			search.addEventListener("click",function()
			{
location.redirect("search.php");
            });
            get_message();

            setInterval(() => {
                get_message();
                get_message_head();

            }, 500);
             
            var user = "<?php echo $usr; ?>";
               var user_to = "<?php echo $user_to; ?>";
            // var user_to = "samy_das3003";
            
        function get_message()
        {
            // $('.msg_sect_right').animate({scrollTop:$('.msg_sect_right')[0].scrollHeight},200);
           
            $.ajax({
			url: "message_thread.php",
			type: "GET",
			data: "user ="+user+"&user_to="+user_to+"&seen=0",
			cache:false,

			success: function(data) {
                $('.msg_thread').html(data);

			// location.reload();
			}
        });
        }
var sent = document.querySelector('button.send');

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
            $('.msg_thread').animate({scrollTop:$('.msg_thread')[0].scrollHeight},200);
        //     msg_array=new Array("Hello","How are you?","What's Up?","Good Morning","Good Night","I'm fine","It's nice to meet you","Call You Later","I will reply in a minute");
        //    var rand =Math.floor(Math.random(0)*msg_array.length-2);
     
        //    msg = msg_array[rand];
        var msg = $("#msg_content").val();
            $.ajax({
			url: "message_fun.php",
			type: "POST",
			data: "user ="+user+"&user_to="+user_to+"&msg="+msg,
			cache:false,

			success: function(data) {
                $('.msg_thread').html(data);
               
              
			// location.reload();
			}
		});
        }

        function get_message_head()
        {
            $.ajax({
			url: "message_head.php",
			type: "POST",
			data: "user ="+user+"&user_to="+user_to,
			cache:false,

			success: function(data) {
                $('.message_left').html(data);
              
			// location.reload();
			}
		});
        }
        });
   
    </script>
</body>

</html>