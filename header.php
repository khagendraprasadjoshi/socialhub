

<script src="http://localhost/socialhub/js/jquery.js"></script>
<header>
        <ul class="left">
           <a href="profile.php"> <div class="logo">

            </div></a>
            <li class="search">
            <form action="search.php" method="get">
                <input type="text" name="search" id="val"  />
                
                <button class="search"><i class="fa fa-search"></i></button>
              </form>
            </li>

        </ul>
        <ul class="right">
        <li>
<div class="profile_pic"></div>
</li>

<li class=""> <a href="profile_set.php">

    <?php
  
echo $_SESSION["user"];
include 'db.php';
?>
</a></li>

<li><a href="index.php">Home</a></li>
<li><a href="">Create</a></li>
<li><a href="friend_request.php" class="frnd_req">Friend Requests<span class="badge"></span></a></li>
<li><a href="message_section.php" class="msg">Messages<span class="badge"></span></a></li>
<li><a href="">Notifications<span class="badge"></span></a></li>
<li><a href="logout.php">Logout</a></li>
        </ul>
    </header>
    <script>


$(document).ready(function () {
var user = "<?php echo $username; ?>";
get_msg_bar();
get_req_bar();
setInterval(() => {
    get_msg_bar();
              get_req_bar();

            }, 500);

            function get_msg_bar()
            {
	$.ajax({
			url: "header_req_noti.php",
			type: "POST",
			data: "user ="+user,
			cache:false,

			success: function(data) {
                $('.frnd_req>.badge').html(data);
              
			// location.reload();
			}
		});
            }
            function get_req_bar()
            {
	$.ajax({
			url: "header_msg_noti.php",
			type: "POST",
			data: "user ="+user,
			cache:false,

			success: function(data) {
                $('.msg>.badge').html(data);
              
			// location.reload();
			}
		});
            }
        var msg = document.querySelector('.msg_sect');
        msg.addEventListener("click",function()
			{
	
            });
            });
           



           

    </script>
   
