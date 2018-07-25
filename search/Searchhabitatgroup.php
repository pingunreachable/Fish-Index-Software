<!-- Checks to see if a user (either guest or admin) is logged in, if not page is redirected to login page -->
<?php 
   if (isset($_COOKIE['user'])) 
      echo ""; 
       
   else { 
   header ( "Location: ../login.php" ); } 
?> 



<!-- Header of the webpage -->
<?php include '../childheader.php'; ?>



<!-- Link to the database -->
<?php include '../dbconnect.php'; ?>

<!-- Title of the page -->
<center><h1>Search Habitat</h1></center>


<!-- Search box -->
<form action="Searchhabitatgroup.php" method="post">
<center><table border='1'>
	<tr>
	<th>Habitat Code</th>
	<th>Name</th>
	</tr>
	<tr>
	<td><input type='text' name='group_code' value='<?php echo $_POST['group_code'] ?>'> </td>
	<td><input type='text' name='group_name' value='<?php echo $_POST['group_name'] ?>'> </td>
	</tr>
</table></center>
<center><input type='submit' name='submit' value='Search'> </center>
</form> 
<br>


<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Table that display the search information -->
<?php
	$result = mysqli_query($link,"SELECT * FROM habitatgroup WHERE 
(group_code LIKE '%" . $_POST['group_code'] ."%')
 AND 
(group_name LIKE '%" . $_POST['group_name'] ."%')"
); 
	
	echo "<center><table border='1'>
	<tr>
	<th>Code</th>
	<th>Name</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['group_code'] . "</td>";
	  echo "<td>" . $row['group_name'] . "</td>";
	  echo "</tr>";
	}
	echo "</table></center>";

?>

<br>
<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>