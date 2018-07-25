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
<center><h1>Search Species Sample</h1></center>

<!-- Search box -->
<form action="Searchspeciessample.php" method="post">
<center><table border='1'>
	<tr>
	<th>Sample Type</th>
	<th>Site Code</th>
	<th>Sample Method</th>
	<th>Sample Date</th>
	<th>Species Code</th>
	</tr>
	<tr>
	<td><input type='text' name='sample_type' value='<?php echo $_POST['sample_type'] ?>'> </td>
	<td><input type='text' name='site_code' value='<?php echo $_POST['site_code'] ?>'> </td>
	<td><input type='text' name='method' value='<?php echo $_POST['method'] ?>'> </td>
	<td><input type='text' name='date' value='<?php echo $_POST['date'] ?>'> </td>
	<td><input type='text' name='species_code' value='<?php echo $_POST['species_code'] ?>'> </td>
	</tr>
</table></center>
<center><table border='1'>
	<tr>
	<th>Species Scientific Name</th>
	<th>Species Common Name</th>
	<th>Total Number</th>
	<th>Returned</th>
	</tr>
	<tr>
	<td><input type='text' name='species_name' value='<?php echo $_POST['species_name'] ?>'> </td>
	<td><input type='text' name='common_name' value='<?php echo $_POST['common_name'] ?>'> </td>
	<td><input type='text' name='total_number' value='<?php echo $_POST['total_number'] ?>'> </td>
	<td><input type='text' name='returned' value='<?php echo $_POST['returned'] ?>'> </td>
	</tr>
</table></center>
<center><input type='submit' name='submit' value='Search'> </center>
</form> 
<br>


<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Table that display the search information -->
<?php
	$result = mysqli_query($link,"SELECT * FROM speciessample JOIN sample on speciessample.sample_id = sample.sample_id JOIN species on speciessample.species_id = species.species_id WHERE 
(sample_type LIKE '%" . $_POST['sample_type'] ."%')
 AND 
(site_code LIKE '%" . $_POST['site_code'] ."%')
 AND 
(method LIKE '%" . $_POST['method'] ."%')
 AND 
(date LIKE '%" . $_POST['date'] ."%')
 AND 
(species_code LIKE '%" . $_POST['species_code'] ."%')
 AND 
(species_name LIKE '%" . $_POST['species_name'] ."%')
 AND 
(common_name LIKE '%" . $_POST['common_name'] ."%')
 AND 
(total_number LIKE '%" . $_POST['total_number'] ."%')
 AND 
(returned LIKE '%" . $_POST['returned'] ."%')
"); 

	echo "<center><table border='1'>
	<tr>
	<th>Sample Type</th>
	<th>Site Code</th>
	<th>Sample Method</th>
	<th>Sample Date</th>
	<th>Species Code</th>
	<th>Species Scientific Name</th>
	<th>Species Common Name</th>
	<th>Total Number</th>
	<th>Returned</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['sample_type'] . "</td>";
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['method'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . setZeros($row['species_code'], 6) . "</td>";
	  echo "<td>" . $row['species_name'] . "</td>";
	  echo "<td>" . $row['common_name'] . "</td>";
	  echo "<td>" . $row['total_number'] . "</td>";
	  echo "<td>" . $row['returned'] . "</td>";
	  echo "</tr>";
	}
	echo "</table></center>";

?>

<br>
<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>