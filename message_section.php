<?php
session_start();
?>

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

<body>
<?php
include 'header.php';
    ?>
    <section class="main">

   <div class="message_sect_part">
   <div class="left">
       <h1>Messages</h1>
       <div class="msg_sect">
       
       </div>
   </div>
 
       
    </section>
   <script>

$(document).ready(function () {
   
var user = "<?php echo $username; ?>";
get_msg_bar();
setInterval(() => {
    get_msg_bar();
              

            }, 500);

            function get_msg_bar()
            {
	$.ajax({
			url: "msg_content.php",
			type: "POST",
			data: "user ="+user,
			cache:false,

			success: function(data) {
                $('.msg_sect').html(data);
              
			// location.reload();
			}
		});
            }
       
            });
           



           

   </script>

</body>

</html>