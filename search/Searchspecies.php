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
<?php

function setZeros($num, $dec)
{
return sprintf('%0' . $dec .'d', $num);
}

?>


<!-- Title of the page -->
<center><h1>Search Species</h1></center>

<!-- Search box -->
<form action="Searchspecies.php" method="post">
<center><table border='1'>
	<tr>
	<!--<th>ID</th>-->
	<th>Species Code</th>
	<th>Species Scientific Name</th>
	<th>Species Common Name</th>
	</tr>
	<tr>
	<!--<td><input type='text' name='species_id' value='<?php echo $_POST['species_id'] ?>'> </td>-->
	<td><input type='text' name='species_code' value='<?php echo $_POST['species_code'] ?>'> </td>
	<td><input type='text' name='species_name' value='<?php echo $_POST['species_name'] ?>'> </td>
	<td><input type='text' name='common_name' value='<?php echo $_POST['common_name'] ?>'> </td>
	</tr>
</table></center>
<center><table border='1'>
	<tr>
	<th>Habitat Code</th>
	<th>Life History Code</th>
	<th>Trophic Code</th>
	</tr>
	<tr>
	<td><input type='text' name='habitat_code' value='<?php echo $_POST['habitat_code'] ?>'> </td>
	<td><input type='text' name='lifehistory_code' value='<?php echo $_POST['lifehistory_code'] ?>'> </td>
	<td><input type='text' name='trophic_code' value='<?php echo $_POST['trophic_code'] ?>'> </td>
	</tr>
</table></center>
<center><input type='submit' name='submit' value='Search'> </center>
</form> 
<br>


<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Table that display the search information -->
<?php
	$result = mysqli_query($link,"SELECT * FROM species WHERE 
(species_id LIKE '%" . $_POST['species_id'] ."%')
 AND 
(species_code LIKE '%" . $_POST['species_code'] ."%')
 AND 
(species_name LIKE '%" . $_POST['species_name'] ."%')
 AND 
(common_name LIKE '%" . $_POST['common_name'] ."%')
 AND 
(habitat_code LIKE '%" . $_POST['habitat_code'] ."%')
 AND 
(lifehistory_code LIKE '%" . $_POST['lifehistory_code'] ."%')
 AND 
(trophic_code LIKE '%" . $_POST['trophic_code'] ."%')
"); 

	echo "<center><table border='1'>
	<tr>
	<!--<th>ID</th>-->
	<th>Species Code</th>
	<th>Species Scientific Name</th>
	<th>Species Common Name</th>
	<th>Habitat Code</th>
	<th>Life History Code</th>
	<th>Trophic Code</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  /*echo "<td>" . $row['species_id'] . "</td>";*/
	  echo "<td>" . setZeros($row['species_code'], 6) . "</td>";
	  echo "<td>" . $row['species_name'] . "</td>";
	  echo "<td>" . $row['common_name'] . "</td>";
	  echo "<td>" . $row['habitat_code'] . "</td>";
	  echo "<td>" . $row['lifehistory_code'] . "</td>";
	  echo "<td>" . $row['trophic_code'] . "</td>";
	  echo "</tr>";
	}
	echo "</table></center>";

?>

<br>
<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>