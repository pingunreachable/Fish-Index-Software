<?php include 'header.php'; ?>

    <h2>Login</h2>

    <p class="centertxt">
	Guest Login is required for users to be able to view information, (There isn't any password.) <br> 	
	Admin Login is required for users to be able to view, add, edit and delete information.
	</p>
 	
 
									<!-- Insert all contents in here START--> 
									<div id="other_contents"> 


<!--php script to accept and check for user credentials  -->
<?php
$thePassword = $_ENV['PASSWORD'];
$password = $_POST['pass'];
$username = $_POST['username'];

if ($username == "Admin" && $password == $thePassword) { 

	setcookie("user", "Admin", time()+3600);
	header("Location: index.php");
}

if ($username == "Guest") { 

	setcookie("user", "Guest", time()+3600);
	header("Location: index.php");
}

?>
<html>

<form name="form1" action='login.php' method='post'> 
	<table border='0'> 
		<tr><td>Username:</td><td>
			<select id='username' name='username'>
<?php
if ($_POST['username'] == "Admin")
{
echo "<option value='Guest'>Guest</option><option selected value='Admin'>Admin</option>";
}
else
{
echo "<option selected value='Guest'>Guest</option><option value='Admin'>Admin</option>";
}
?>
			</select> 
		</td></tr> 
		<tr><td>Password:</td><td> 
			<input type='password' name='pass' maxlength='50'> 
		</td></tr> 
		<tr><td colspan='2' align='right'> 
		<?php 
		if ($password != $thePassword && $username == "Admin") { 
		echo "Password Incorrect!<br>";
		}
		?>
		<input type='submit' name='submit' value='Login'> 
		</td></tr> 
	</table> 
</form> 



 </div> 
									<!-- Insert all contents in here END-->
 
 

 

<?php include 'footer.php'; ?>
