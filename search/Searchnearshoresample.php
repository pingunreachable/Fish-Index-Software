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
<center><h1>Search Nearshore Sample</h1></center>

<!-- Search box -->
<form action="Searchnearshoresample.php" method="post">
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
	<th>Sal</th>
	<th>Temp</th>
	<th>Do</th>
	</tr>
	<tr>
	<td><input type='text' name='notes' value='<?php echo $_POST['notes'] ?>'> </td>
	<td><input type='text' name='sal' value='<?php echo $_POST['sal'] ?>'> </td>
	<td><input type='text' name='temp' value='<?php echo $_POST['temp'] ?>'> </td>
	<td><input type='text' name='do' value='<?php echo $_POST['do'] ?>'> </td>
	</tr>
</table></center>
<center><input type='submit' name='submit' value='Search'> </center>
</form> 
<br>


<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Table that display the search information -->
<?php
	$result = mysqli_query($link," SELECT * FROM nearshoresample JOIN sample on nearshoresample.sample_id = sample.sample_id WHERE 
(nearshoresample.sample_id LIKE '%" . $_POST['sample_id'] ."%')
 AND 
(site_code LIKE '%" . $_POST['site_code'] ."%')
 AND 
(method LIKE '%" . $_POST['method'] ."%')
 AND 
(date LIKE '%" . $_POST['date'] ."%')
 AND 
(notes LIKE '%" . $_POST['notes'] ."%')
 AND 
(sal LIKE '%" . $_POST['sal'] ."%')
 AND 
(temp LIKE '%" . $_POST['temp'] ."%')
 AND 
(do LIKE '%" . $_POST['do'] ."%')
"); 

	echo "<center><table border='1'>
	<tr>
	<!--<th>ID</th>-->
	<th>Site Code</th>
	<th>Method</th>
	<th>Date</th>
	<th>Notes</th>
	<th>Sal</th>
	<th>Temp</th>
	<th>Do</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  /*echo "<td>" . $row['sample_id'] . "</td>";*/
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['method'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['notes'] . "</td>";
	  echo "<td>" . setDecimal($row['sal'], 1) . "</td>";
	  echo "<td>" . setDecimal($row['temp'], 1) . "</td>";
	  echo "<td>" . setDecimal($row['do'], 1) . "</td>";
	  echo "</tr>";
	}
	echo "</table></center>";

?>

<br>
<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>
