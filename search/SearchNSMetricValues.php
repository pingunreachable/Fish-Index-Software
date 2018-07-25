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
//if 0 or 10 it doesn't place any decimal places
function setDecimal($num, $dec)
{
if ($num == 0) 
	{
    $var = 0;
	} 
	elseif ($num == 10) 
	{
    $var = 10;
	} 
	else 
	{
    $var = sprintf('%0.' . $dec . 'f', $num);
	}
return $var;
}


?>


<!-- Title of the page -->
<center><h1>Search Nearshore Metric Values</h1></center>

<!-- Search box -->
<form action="SearchNSMetricValues.php" method="post">
<center><table border='1'>
	<tr>
	<th>Site code</th>
	<th>Date</th>
	<th>No species</th>
	<th>Prop Trop Spec</th>
	<th>No Trop Spec</th>
	</tr>
	<tr>
	<td><input type='text' name='site_code' value='<?php echo $_POST['site_code'] ?>'> </td>
	<td><input type='text' name='date' value='<?php echo $_POST['date'] ?>'> </td>
	<td><input type='text' name='No_species' value='<?php echo $_POST['No_species'] ?>'> </td>
	<td><input type='text' name='Prop_trop_spec' value='<?php echo $_POST['Prop_trop_spec'] ?>'> </td>
	<td><input type='text' name='No_trop_spec' value='<?php echo $_POST['No_trop_spec'] ?>'> </td>
	</tr>
</table></center>
<center><table border='1'>
	<tr>
	<th>No Trop Gen</th>
	<th>Prop Detr</th>
	<th>Prop Benthic</th>
	<th>No Benthic</th>
	<th>Prop Est Spawn</th>
	</tr>
	<tr>
	<td><input type='text' name='No_trop_gen' value='<?php echo $_POST['No_trop_gen'] ?>'> </td>
	<td><input type='text' name='Prop_detr' value='<?php echo $_POST['Prop_detr'] ?>'> </td>
	<td><input type='text' name='Prop_benthic' value='<?php echo $_POST['Prop_benthic'] ?>'> </td>
	<td><input type='text' name='No_benthic' value='<?php echo $_POST['No_benthic'] ?>'> </td>
	<td><input type='text' name='Prop_est_spawn' value='<?php echo $_POST['Prop_est_spawn'] ?>'> </td>
	</tr>
</table></center>
<center><table border='1'>
	<tr>
	<th>No Est Spawn</th>
	<th>Prop P Olorum</th>
	<th>Tot No P Olorum</th>
	</tr>
	<tr>
	<td><input type='text' name='No_est_spawn' value='<?php echo $_POST['No_est_spawn'] ?>'> </td>
	<td><input type='text' name='Prop_P_olorum' value='<?php echo $_POST['Prop_P_olorum'] ?>'> </td>
	<td><input type='text' name='Tot_no_P_olorum' value='<?php echo $_POST['Tot_no_P_olorum'] ?>'> </td>
	</tr>
</table></center>
<center><input type='submit' name='submit' value='Search'> </center>
</form> 
<br>


<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Table that display the search information -->
<?php
	$result = mysqli_query($link,"SELECT * FROM NSMetricValues WHERE 
(site_code LIKE '%" . $_POST['site_code'] ."%')
 AND 
(date LIKE '%" . $_POST['date'] ."%')
 AND 
(No_species LIKE '%" . $_POST['No_species'] ."%')
 AND 
(Prop_trop_spec LIKE '%" . $_POST['Prop_trop_spec'] ."%')
 AND 
(No_trop_spec LIKE '%" . $_POST['No_trop_spec'] ."%')
 AND 
(No_trop_gen LIKE '%" . $_POST['No_trop_gen'] ."%')
 AND 
(Prop_detr LIKE '%" . $_POST['Prop_detr'] ."%')
 AND 
(Prop_benthic LIKE '%" . $_POST['Prop_benthic'] ."%')
 AND 
(No_benthic LIKE '%" . $_POST['No_benthic'] ."%')
 AND 
(Prop_est_spawn LIKE '%" . $_POST['Prop_est_spawn'] ."%')
 AND 
(No_est_spawn LIKE '%" . $_POST['No_est_spawn'] ."%')
 AND 
(Prop_P_olorum LIKE '%" . $_POST['Prop_P_olorum'] ."%')
 AND 
(Tot_no_P_olorum LIKE '%" . $_POST['Tot_no_P_olorum'] ."%')
"); 

	echo "<center><table border='1'>
	<tr>
	<th>Site code</th>
	<th>Date</th>
	<th>No species</th>
	<th>Prop Trop Spec</th>
	<th>No Trop Spec</th>
	<th>No Trop Gen</th>
	<th>Prop Detr</th>
	<th>Prop Benthic</th>
	<th>No Benthic</th>
	<th>Prop Est Spawn</th>
	<th>No Est Spawn</th>
	<th>Prop P Olorum</th>
	<th>Tot No P Olorum</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['No_species'] . "</td>";
	  echo "<td>" . setDecimal($row['Prop_trop_spec'], 2) . "</td>";
	  echo "<td>" . $row['No_trop_spec'] . "</td>";
	  echo "<td>" . $row['No_trop_gen'] . "</td>";
	  echo "<td>" . setDecimal($row['Prop_detr'], 2) . "</td>";
	  echo "<td>" . setDecimal($row['Prop_benthic'], 2) . "</td>";
	  echo "<td>" . $row['No_benthic'] . "</td>";
	  echo "<td>" . setDecimal($row['Prop_est_spawn'], 2) . "</td>";
	  echo "<td>" . $row['No_est_spawn'] . "</td>";
	  echo "<td>" . setDecimal($row['Prop_P_olorum'], 2) . "</td>";
	  echo "<td>" . $row['Tot_no_P_olorum'] . "</td>";
	  echo "</tr>";
	}
	echo "</table></center>";

?>

<br>
<!-- Back button -->
<center><form><input type='button' name='Back' value='Back' onClick="location.href='../history.php'"></form></center>


<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>
