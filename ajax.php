<?php
session_start();
include 'db.php';
;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="http://localhost/socialhub/js/jquery.js"></script>
	<title>Ajax</title>
</head>
<body>

<button type="submit">Get Data</button>
<div class="data"></div>

<script>
	var user = '<?php echo $username; ?>';

	$(document).ready(function() {

			var button = document.querySelector('button');
			button.addEventListener("click",function()
			{
				$.ajax({
			url: "add.php",
			type: "POST",
			data: "user=" + user,
			cache:false,

			success: function(data) {
			
				$('.data').html(data);
			}
		});
			});

	
		
	});
        
        </script>	
</body>
</html>

