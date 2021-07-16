<?php
require 'posts.php';
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

    <div class="sidebar-left"></div>
        <div class="post-section">
            <div class="post-upload">
                <div class="profile_pic_large"></div>
                <form class="posts" method="POST"  enctype="multipart/form-data">
                    <div class="uploads">
                        <textarea name="caption" id="" cols="30" rows="5" placeholder="Write Something"></textarea>
                        <input href="" class="image" type="file" value="Upload Image" name="image">
                    </div>
                    <button class="button" name="submit">Upload</button>
                </form>
            </div>
            
            <div class="posts_list">
<img class="loading" src="http://localhost/socialhub/img/loading.gif"/>

<div class="end">
    </div>

</div>
          <!--  <div class="post">
                <div class="post_header">
                    <div class="post_header_left">
                        <div class="post_username_pic"></div>
                        <div class="user_block">
                            <h5>Sanjit</h5>
                            <h5 class="time">Yeasterday at 9:30</h5>
                        </div>
                   


                    </div>
                    <div class="post_header_right">
                        <div class="dot"></div>

                    </div>

                </div>

                <div class="post_desc">
                    <h4>Hello, How are You ?</h4>
                    <div class="post_pic">
                        <img src="" alt="" srcset="">
                    </div>
                </div>
                <div class="post_reacts">
                    <a href="">0 LIKES</a>
                </div>
            </div>
  -->
        </div>
      
        <div class="notification">
            <div class="noti_header">

            </div>
             
        </div>
       
    </section>
   <script>

$(document).ready(function () {
    var user = "<?php echo $username; ?>";
  var page = 'profile.php';

	$.ajax({
			url: "posts.php",
			type: "POST",
			data: "user="+user+"&page="+page,
			cache:false,

			success: function(data) {
                load.hide();
				$('.posts_list').html(data);
			}
		});
		

    var upload = document.querySelector('button.button');
 var load = $('img.loading');
 load.hide();
 
			upload.addEventListener("click",function()
			{
                load.show();

                
            // alert(search_val);
            
				$.ajax({
			url: "posts.php",
			type: "POST",
			data: $('form.posts').serialize(),
			cache:false,

			success: function(data) {
                load.hide();
			// location.reload();
			}
		});
		

            });
           

});

           

   </script>
</body>

</html>