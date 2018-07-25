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
<center><h1>Search Site</h1></center>

<!-- Search box -->
<form action="Searchsite.php" method="post">
<center><table border='1'>
	<tr>
	<th>Site Code</th>
	<th>Latitude</th>
	<th>Longitude</th>
	<th>Zone Code</th>
	<th>Description</th>
	</tr>
	<tr>
	<td><input type='text' name='site_code' value='<?php echo $_POST['site_code'] ?>'> </td>
	<td><input type='text' name='latitude' value='<?php echo $_POST['latitude'] ?>'> </td>
	<td><input type='text' name='longitude' value='<?php echo $_POST['longitude'] ?>'> </td>
	<td><input type='text' name='zone_code' value='<?php echo $_POST['zone_code'] ?>'> </td>
	<td><input type='text' name='description' value='<?php echo $_POST['description'] ?>'> </td>
	</tr>
</table></center>
<center><input type='submit' name='submit' value='Search'> </center>
</form> 
<br>


<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Table that display the search information -->
<?php
	$result = mysqli_query($link,"SELECT * FROM site WHERE 
(site_code LIKE '%" . $_POST['site_code'] ."%')
 AND 
(latitude LIKE '%" . $_POST['latitude'] ."%')
 AND 
(longitude LIKE '%" . $_POST['longitude'] ."%')
 AND  
(zone_code LIKE '%" . $_POST['zone_code'] ."%')
 AND  
(description LIKE '%" . $_POST['description'] ."%')
"); 
	
	echo "<center><table border='1'>
	<tr>
	<th>Site Code</th>
	<th>Latitude</th>
	<th>Longitude</th>	
	<th>Zone Code</th>
	<th>Description</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['latitude'] . "</td>";
	  echo "<td>" . $row['longitude'] . "</td>";
	  echo "<td>" . $row['zone_code'] . "</td>";
	  echo "<td>" . $row['description'] . "</td>";
	  echo "</tr>";
	}
	echo "</table></center>";

?>

<br>
<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>