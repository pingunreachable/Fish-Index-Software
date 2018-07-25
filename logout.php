<html>

<body>
<!--Logout php script where user will be logged out after the cookie expires in 1 hour -->
	<?php 
		$past = time() - 100; 
		setcookie("user", gone, $past); 
		header("Location: login.php"); 
	?> 
	   
</body>

</html>