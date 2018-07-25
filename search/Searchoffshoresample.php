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
//Function to set the number of decimal places a number has
//$num the number entered into the function
//$dec the number of decimal places
function setDecimal($num, $dec)
{
if ($num == 0) 
	{
    $var = 0;
	} 
	else 
	{
    $var = sprintf('%0.' . $dec . 'f', $num);
	}
return $var;
}


?>

<!-- Title of the page -->
<center><h1>Search Offshore Sample</h1></center>

<!-- Search box -->
<form action="Searchoffshoresample.php" method="post">
<center><table border='1'>
	<tr>
	<!--<th>ID</th>-->
	<th>Site Code</th>
	<th>Method</th>
	<th>Date</th>
	</tr>
	<tr>
	<!--<td><input type='text' name='sample_id' value='<?php echo $_POST['sample_id'] ?>'> </td>-->
	<td><input type='text' name='site_code' value='<?php echo $_POST['site_code'] ?>'> </td>
	<td><input type='text' name='method' value='<?php echo $_POST['method'] ?>'> </td>
	<td><input type='text' name='date' value='<?php echo $_POST['date'] ?>'> </td>
	</tr>
</table></center>
<center><table border='1'>
	<tr>
	<th>Notes</th>
	<th>Sals</th>
	<th>Temps</th>
	<th>Dos</th>
	</tr>
	<tr>
	<td><input type='text' name='notes' value='<?php echo $_POST['notes'] ?>'> </td>
	<td><input type='text' name='sals' value='<?php echo $_POST['sals'] ?>'> </td>
	<td><input type='text' name='temps' value='<?php echo $_POST['temps'] ?>'> </td>
	<td><input type='text' name='dos' value='<?php echo $_POST['dos'] ?>'> </td>
	</tr>
</table></center>
<center><table border='1'>
	<tr>
	<th>Salb</th>
	<th>Tempb</th>
	<th>Dob</th>
	</tr>
	<tr>
	<td><input type='text' name='salb' value='<?php echo $_POST['salb'] ?>'> </td>
	<td><input type='text' name='tempb' value='<?php echo $_POST['tempb'] ?>'> </td>
	<td><input type='text' name='dob' value='<?php echo $_POST['dob'] ?>'> </td>
	</tr>
</table></center>
<center><input type='submit' name='submit' value='Search'> </center>
</form> 
<br>


<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Table that display the search information -->
<?php
	$result = mysqli_query($link,"SELECT * FROM offshoresample JOIN sample on offshoresample.sample_id = sample.sample_id WHERE 
(offshoresample.sample_id LIKE '%" . $_POST['sample_id'] ."%')
 AND 
(site_code LIKE '%" . $_POST['site_code'] ."%')
 AND 
(method LIKE '%" . $_POST['method'] ."%')
 AND 
(date LIKE '%" . $_POST['date'] ."%')
 AND 
(notes LIKE '%" . $_POST['notes'] ."%')
 AND 	
(sals LIKE '%" . $_POST['sals'] ."%')
 AND 
(temps LIKE '%" . $_POST['temps'] ."%')
 AND 
(dos LIKE '%" . $_POST['dos'] ."%')
 AND 
(salb LIKE '%" . $_POST['salb'] ."%')
 AND 
(tempb LIKE '%" . $_POST['tempb'] ."%')
 AND 
(dob LIKE '%" . $_POST['dob'] ."%')
"); 

	echo "<center><table border='1'>
	<tr>
	<!--<th>ID</th>-->
	<th>Site Code</th>
	<th>Method</th>
	<th>Date</th>
	<th>Notes</th>
	<th>Sals</th>
	<th>Temps</th>
	<th>Dos</th>
	<th>Salb</th>
	<th>Tempb</th>
	<th>Dob</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  /*echo "<td>" . $row['sample_id'] . "</td>";*/
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['method'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['notes'] . "</td>";
	  echo "<td>" . setDecimal($row['sals'], 1) . "</td>";
	  echo "<td>" . setDecimal($row['temps'], 1) . "</td>";
	  echo "<td>" . setDecimal($row['dos'], 1) . "</td>";
	  echo "<td>" . setDecimal($row['salb'], 1) . "</td>";
	  echo "<td>" . setDecimal($row['tempb'], 1) . "</td>";
	  echo "<td>" . setDecimal($row['dob'], 1) . "</td>";
	  echo "</tr>";
	}
	echo "</table></center>";

?>

<br>
<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>
