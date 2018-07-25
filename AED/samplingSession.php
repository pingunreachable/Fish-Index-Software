<!-- Checks to see if a user (admin) is logged in, if not page is redirected to login page -->
<?php 
   if ($_COOKIE['user'] == "Admin") 
      echo ""; 
       
   else { 
   header ( "Location: ../login.php" ); } 
?> 


<!-- Header of the webpage -->
<?php include '../childheader.php'; ?>

<!-- Link to the database -->
<?php include '../dbconnect.php'; ?>

<?php

echo "<center>";

// Title of the page 
echo "<h1>Sampling Session</h1>";
?>

<?php
//if action is blank do the code with the semi-colons
if ($_POST['action'] == "")
{
//Drop down box with the sample types within
	echo "<h1>Sample Session Type Selection</h1>";
	echo "<form action='samplingSession.php' method='post'>

	<p>Please Select the Type of Sample that you want to created:</p>

	<center><table border='1'>
	 <tr>
	  <td>Type</td>
	  <td>
		<select id='sample_type' name='sample_type'>
		<option value='Nearshore'>Nearshore</option>
		<option value='Offshore'>Offshore</option>
		</select>
	  </td>
	 </tr>
	<tr>
	</table></center>

	<input type='submit' name='action' value='Create New Selected Sample'> 
	</form> 
	";
}
?>

<?php
//if action is create new sample do the code with the semi-colons
if ($_POST['action'] == "Create New Selected Sample")
{
//if sample type is near shore do the code with the semi-colons
	if($_POST['sample_type'] == "Nearshore")
	{
	// The form use the enter information for the near shore sample 
	echo "<h1>Nearshore Sample Session</h1>";
	echo "<form action='samplingSession.php' method='post'>

	<p>Please Fill in the Form Below:</p>

	<center><table border='1'>
	<tr>
	   <td>Code</td>
	  <td>
	  <input type='hidden' readonly name='sample_type' value='Nearshore'>
	  
	  ";
		echo "<select id='site_code' name='site_code'>";
		$result = mysqli_query($link,"SELECT * FROM site"); 
		while($row = mysqli_fetch_array($result)) {
			echo "<option value='" . $row['site_code'] . "'>" . $row['site_code'] . "</option>";
		}
		echo "</select>";
	echo "
	</td>
	  </tr> 
	<tr>
	  <td>Method</td>
	  <td>	
		<select id='method' name='method'>
		<option value='21m seine'>21m seine</option>
		<option value='Gill'>Gill</option>
		</select>
	  </td>
	 </tr>
	 <tr>
	  <td>Date</td>
	  <td><input type='text' name='date'value='" . $_POST['date'] . "'> 
	   <br>Requires year-month-day format example ( 2014-01-01 )</br></td>
	 </tr>
	 <tr>
	  <td>Notes</td>
	  <td><input type='text' name='notes'value='" . $_POST['notes'] . "'> </td>
	 </tr>
	<tr>
	  <td>Sal</td>
	  <td><input type='text' name='sal'value='" . $_POST['sal'] . "'> </td>
	 </tr>
	<tr>
	  <td>Temp</td>
	  <td><input type='text' name='temp'value='" . $_POST['temp'] . "'> </td>
	 </tr>
	 <tr>
	  <td>Do</td>
	  <td><input type='text' name='do'value='" . $_POST['do'] . "'> </td>
	 </tr>
	</table></center>
	
	<input type='submit' name='action' value='Create Nearshore Sample'> 
	</form> 
	";
	}
	
	
//if sample type is off shore do the code with the semi-colons	
	if($_POST['sample_type'] == "Offshore")
	{
	// The form use the enter information for the off shore sample 
	echo "<h1>Offshore Sample Session</h1>";
	echo "<form action='samplingSession.php' method='post'>

	<p>Please Fill in the Form Below:</p>

	<center><table border='1'>
	<tr>
	   <td>Code</td>
	  <td>
	  <input type='hidden' readonly name='sample_type' value='Offshore'>
	  
	  ";
		echo "<select id='site_code' name='site_code'>";
		$result = mysqli_query($link,"SELECT * FROM site"); 
		while($row = mysqli_fetch_array($result)) {
			echo "<option value='" . $row['site_code'] . "'>" . $row['site_code'] . "</option>";
		}
		echo "</select>";
	echo "
	</td>
	  </tr> 
	<tr>
	  <td>Method</td>
	  <td>	
		<select id='method' name='method'>
		<option value='21m seine'>21m seine</option>
		<option value='Gill'>Gill</option>
		</select>
	  </td>
	 </tr>
	 <tr>
	  <td>Date</td>
	  <td><input type='text' name='date'value='" . $_POST['date'] . "'> 
	   <br>Requires year-month-day format example ( 2014-01-01 )</br></td>
	 </tr>
	 <tr>
	  <td>Notes</td>
	  <td><input type='text' name='notes'value='" . $_POST['notes'] . "'> </td>
	 </tr>
	 <tr>
	  <td>Sals</td>
	  <td><input type='text' name='sals'value='" . $_POST['sals'] . "'> </td>
	 </tr>
	<tr>
	  <td>Temps</td>
	  <td><input type='text' name='temps'value='" . $_POST['temps'] . "'> </td>
	 </tr>
	 <tr>
	  <td>Dos</td>
	  <td><input type='text' name='dos'value='" . $_POST['dos'] . "'> </td>
	 </tr>
	 <tr>
	  <td>Salb</td>
	  <td><input type='text' name='salb'value='" . $_POST['salb'] . "'> </td>
	 </tr>
	 <tr>
	  <td>Tempb</td>
	  <td><input type='text' name='tempb'value='" . $_POST['tempb'] . "'> </td>
	 </tr>
	 <tr>
	  <td>Dob</td>
	  <td><input type='text' name='dob'value='" . $_POST['dob'] . "'> </td>
	 </tr>
	</table></center>
	
	<input type='submit' name='action' value='Create Offshore Sample'> 
	</form> 
	";
	}

}
?>

<?php
//if action is create near shore insert the data into the database
if ($_POST['action'] == "Create Nearshore Sample")
{
$result = "INSERT INTO sample  (sample_type, site_code, method, date, notes, sample_id) VALUES('" . $_POST['sample_type'] . "', '" . $_POST['site_code'] . "', '" . $_POST['method'] . "', '" . $_POST['date'] . "', '" . $_POST['notes'] . "', NULL);"; 
mysqli_query($link,$result);

$lastID =  mysqli_insert_id($link);

$result = "INSERT INTO nearshoresample  (sal, temp, do, sample_id) VALUES('" . $_POST['sal'] . "', '" . $_POST['temp'] . "', '" . $_POST['do'] . "', '" . $lastID . "');"; 
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
mysqli_query($link,$result);


//Display the records for the sample
echo "<p>Nearshore - Sample Created</p>";
	
$result = mysqli_query($link," SELECT * FROM nearshoresample JOIN sample on nearshoresample.sample_id = sample.sample_id WHERE 
(nearshoresample.sample_id LIKE '%" . $lastID ."%')
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

	$the_sample_id = "";
	
	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  /*echo "<td>" . $row['sample_id'] . "</td>";*/
	  $the_sample_id = $row['sample_id'];
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['method'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['notes'] . "</td>";
	  echo "<td>" . $row['sal'] . "</td>";
	  echo "<td>" . $row['temp'] . "</td>";
	  echo "<td>" . $row['do'] . "</td>";
	  echo "</tr>";
	}
	echo "</table></center>";
	
	echo "<br>
	<form action='samplingSession.php' method='post'>
	<input type='hidden' name='sample_id' value='" . $the_sample_id . "'> 
	<input type='hidden' name='sample_type' value='Nearshore'> 
	<input type='submit' name='action' value='Add Species'> 
	</form> 

";


}
?>

<?php
//if action is create off shore insert the data into the database
if ($_POST['action'] == "Create Offshore Sample")
{
$result = "INSERT INTO sample  (sample_type, site_code, method, date, notes, sample_id) VALUES('" . $_POST['sample_type'] . "', '" . $_POST['site_code'] . "', '" . $_POST['method'] . "', '" . $_POST['date'] . "', '" . $_POST['notes'] . "', NULL);"; 
mysqli_query($link,$result);

$lastID =  mysqli_insert_id($link);

$result = "INSERT INTO offshoresample  (sals, temps, dos, salb, tempb, dob, sample_id) VALUES('" . $_POST['sals'] . "', '" . $_POST['temps'] . "', '" . $_POST['dos'] . "', '" . $_POST['salb'] . "', '" . $_POST['tempb'] . "', '" . $_POST['dob'] . "', '" . $lastID  . "');"; 
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
mysqli_query($link,$result);

//Display the records for the sample
echo "<p>Nearshore - Sample Created</p>";

$result = mysqli_query($link,"SELECT * FROM offshoresample JOIN sample on offshoresample.sample_id = sample.sample_id WHERE 
(offshoresample.sample_id LIKE '%" . $lastID ."%')
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
	
	$the_sample_id = "";
	
	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  /*echo "<td>" . $row['sample_id'] . "</td>";*/
	  $the_sample_id = $row['sample_id'];
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['method'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['notes'] . "</td>";
	  echo "<td>" . $row['sals'] . "</td>";
	  echo "<td>" . $row['temps'] . "</td>";
	  echo "<td>" . $row['dos'] . "</td>";
	  echo "<td>" . $row['salb'] . "</td>";
	  echo "<td>" . $row['tempb'] . "</td>";
	  echo "<td>" . $row['dob'] . "</td>";
	  echo "</tr>";
	}
	echo "</table></center>";

	echo "<br>
	<form action='samplingSession.php' method='post'>
	<input type='hidden' name='sample_id' value='" . $the_sample_id . "'> 
	<input type='hidden' name='sample_type' value='Offshore'> 
	<input type='submit' name='action' value='Add Species'> 
	</form> 
	
";

}
?>

<?php
//if action is Add Species insert the Species into the sample
if ($_POST['action'] == "Add Species")
{
//if SQLSpeciesAdded is yes insert the Species into the database
		if ($_POST['SQLSpeciesAdded'] == "YES")
		{	
			$result = "INSERT INTO speciessample  (sample_id, species_id, total_number, returned) VALUES('" . $_POST['sample_id'] . "', '" . $_POST['species_id'] . "', '" . $_POST['total_number'] . "', '" . $_POST['returned'] . "');"; 
			if (!$result) {
				die('Invalid query: ' . mysql_error());
			}

			mysqli_query($link,$result);
	}
//print add specie message and the species in the sample
	echo "<h1>Add Species to Sample Session</h1>";	
	echo "<br>";
	echo "<form action='samplingSession.php' method='post'>

	<p>Please Fill in the Form Below:</p>

	<table border='1'>
	<tr>
	  <td>Species</td>
		<td>
	";

		echo "<select id='species_id' name='species_id'>";

		$result = mysqli_query($link,"SELECT * FROM species WHERE species_id NOT IN (SELECT species_id from speciessample WHERE sample_id = '" . $_POST['sample_id']  . "');"); 
		while($row = mysqli_fetch_array($result)) 
		{
			echo "<option value='" . $row['species_id'] . "'>" . $row['species_code'] . " / " . $row['species_name']  . " / " . $row['common_name'] . "</option>";
		}

		echo "</select>";
	echo "
	</td>
	 </tr>
	 <tr>
	  <td>Total Number</td>
	  <td><input type='text' name='total_number' value=''> </td>
	 </tr>
	 <tr>
	  <td>Returned</td>
	  <td><input type='text' name='returned' value=''> </td>
	 </tr>
	 </table>
	<input type='hidden' name='sample_id' value='" . $_POST['sample_id'] . "'> 
	<input type='hidden' name='sample_type' value='" . $_POST['sample_type'] . "'> 
	<input type='hidden' name='SQLSpeciesAdded' value='YES'> 
	<input type='submit' name='action' value='Add Species'> 
	</form> 
	";
//display species for the sample
		if ($_POST['SQLSpeciesAdded'] == "YES")
		{	
		echo "<br>";
		echo "<p>Current Sample Information</p>";

			if($_POST['sample_type'] == "Offshore")
			{
				$result = mysqli_query($link," SELECT * FROM offshoresample JOIN sample on offshoresample.sample_id = sample.sample_id WHERE 
				(offshoresample.sample_id = '" . $_POST['sample_id'] ."')
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
				  echo "<td>" . $row['sals'] . "</td>";
				  echo "<td>" . $row['temps'] . "</td>";
				  echo "<td>" . $row['dos'] . "</td>";
				  echo "<td>" . $row['salb'] . "</td>";
				  echo "<td>" . $row['tempb'] . "</td>";
				  echo "<td>" . $row['dob'] . "</td>";
				  echo "</tr>";
				}
				echo "</table></center>";
			}
		
			if($_POST['sample_type'] == "Nearshore")
			{
				$result = mysqli_query($link," SELECT * FROM nearshoresample JOIN sample on nearshoresample.sample_id = sample.sample_id WHERE 
				(nearshoresample.sample_id = '" . $_POST['sample_id'] ."')
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
				  echo "<td>" . $row['sal'] . "</td>";
				  echo "<td>" . $row['temp'] . "</td>";
				  echo "<td>" . $row['do'] . "</td>";
				  echo "</tr>";
				}
				echo "</table></center>";
			}
		
		
			echo "<p>Species - Added to Sample</p>";

				$result = mysqli_query($link,"SELECT * FROM speciessample JOIN species on speciessample.species_id = species.species_id WHERE
	(speciessample.sample_id = '" . $_POST['sample_id']  . "');"); 
			
			echo "<center><table border='1'>
			<tr>
			<th>Species Code</th>
			<th>Species Scientific Name</th>
			<th>Species Common Name</th>
			<th>Total Number</th>
			<th>Returned</th>
			</tr>";

		while($row = mysqli_fetch_array($result)) {
			  echo "<tr>";
			  echo "<td>" . $row['species_code'] . "</td>";
			  echo "<td>" . $row['species_name'] . "</td>";
			  echo "<td>" . $row['common_name'] . "</td>";
			  echo "<td>" . $row['total_number'] . "</td>";
			  echo "<td>" . $row['returned'] . "</td>";
			  echo "</tr>";
		}
		echo "</table></center>";
			
	}	
	
}
?>



<br>
<!-- Back button -->
<form><input type='button' name='Back' value='Finished with Sampling Session' onClick="location.href='../samples.php'"></form>

</center>

<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>
