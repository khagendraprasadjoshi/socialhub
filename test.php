
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/profile.css">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
    <style>
        body {
            background: rgba(209, 204, 204, 0.281) !important;

        }
    </style>
</head>

<body>
  
<script src="http://localhost/socialhub/js/jquery.js"></script>
<header>
        <ul>
           <a href="profile.php"> <div class="logo">

            </div></a>
            <li class="search">
            
                <input type="text" name="search_value" id="val"  />
                
                <button class="search"><i class="fa fa-search"></i></button>
              
            </li>

        </ul>
        <ul class="right">
            <li>
                <div class="profile_pic"></div>
            </li>

            <li class=""> <a href="profile_set.php">

         Sanjit
                </a></li>

            <li><a href="index.php">Home</a></li>
            <li><a href="">Create</a></li>
            <li><a href="friend_request.php">Friend Requests<span class="badge"></span></a></li>
            <li><a href="">Messages<span class="badge"></span></a></li>
            <li><a href="">Notifications<span class="badge"></span></a></li>
            <li><a href="">Logout</a></li>
        </ul>
    </header>
   
   
    <section class="main">
    <div class="search_section">
  <img class="loading" src="http://localhost/socialhub/img/loading.gif"/>
</div>
    </section>
    <script>
$(document).ready(function () {
    var search = document.querySelector('button.search');
 var load = $('img.loading');
 load.hide();

 
			search.addEventListener("click",function()
			{
                alert($("#val").val());
                load.show();

                
     
		

            });

});

           
            </script>
</body>

</html>