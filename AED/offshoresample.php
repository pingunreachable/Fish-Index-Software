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
echo "<h1>Offshore Sample</h1>";

//if action is blank or the add button has been selected do the code with the semi-colons
if ($_POST['action'] == "" OR $_POST['action'] == "Add offshoresample")
{

//Inserting information table
echo "

<form action='offshoresample.php' method='post'>

<p>To add a new offshoresample, fill in the form and press the add offshoresample button.</p>

<table border='1'>
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
</table>
<input type='submit' name='action' value='Add offshoresample'> 
</form> 
<br>

";

//if the below data isn't entered then don't add the information to the database
if ($_POST['sals'] != "" AND $_POST['temps'] != "" AND $_POST['dos'] != "")
{
//if action is add do the code with the semi-colons
//$result is the insert SQL string used to add the data
if ($_POST['action'] == "Add offshoresample")
{
	$result = "INSERT INTO sample  (sample_type, site_code, method, date, notes, sample_id) VALUES('" . $_POST['sample_type'] . "', '" . $_POST['site_code'] . "', '" . $_POST['method'] . "', '" . $_POST['date'] . "', '" . $_POST['notes'] . "', NULL);"; 
mysqli_query($link,$result);

$lastID =  mysqli_insert_id($link);

	$result = "INSERT INTO offshoresample  (sals, temps, dos, salb, tempb, dob, sample_id) VALUES('" . $_POST['sals'] . "', '" . $_POST['temps'] . "', '" . $_POST['dos'] . "', '" . $_POST['salb'] . "', '" . $_POST['tempb'] . "', '" . $_POST['dob'] . "', '" . $lastID  . "');"; 
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo "<br>";
//Prints to the screen that the record has been added
echo "<h1>Offshore Sample Added</h1>";
echo "<br>";
mysqli_query($link,$result);
}
}




}
?>


<?php
//if action update or delete has been selected do the code with the semi-colons
if ($_POST['action'] == "Update offshoresample" OR $_POST['action'] == "Delete offshoresample" OR $_POST['action'] == "Select offshoresample")
{
//if the below data isn't entered then don't don't update or delete the information to the database
if ($_POST['sals'] != "" AND $_POST['temps'] != "" AND $_POST['dos'] != "")
{
//if action update has been selected update the database with the information entered
//$result is the insert SQL string used to update the data
if ($_POST['action'] == "Update offshoresample")
{
	$result = "UPDATE sample SET sample_type='" . $_POST['sample_type'] . "', site_code='" . $_POST['site_code'] . "', method='" . $_POST['method'] . "', date='" . $_POST['date'] . "', notes='" . $_POST['notes'] . "' WHERE sample_id='" . $_POST['sample_id'] . "'"; 
	mysqli_query($link,$result);

	$result = "UPDATE offshoresample SET sals='" . $_POST['sals'] . "', temps='" . $_POST['temps'] . "', dos='" . $_POST['dos'] . "', salb='" . $_POST['salb'] . "', tempb='" . $_POST['tempb'] . "', dob='" . $_POST['dob'] . "' WHERE sample_id='" . $_POST['sample_id'] . "'"; 
	mysqli_query($link,$result);
}

//if action delete has been selected delete the selected record from the database
//$result is the insert SQL string used to delete the record
if ($_POST['action'] == "Delete offshoresample")
{
	$result = "DELETE FROM offshoresample WHERE sample_id='" . $_POST['sample_id'] . "'";
	mysqli_query($link,$result);

	$result = "DELETE FROM sample WHERE sample_id='" . $_POST['sample_id'] . "'";
	mysqli_query($link,$result);
}
}
}

?>


<!-- The drop down box used to select a record to be updated or deleted -->
<form action='offshoresample.php' method='post'>

<p>To edit or delete a offshoresample, select a offshoresample from the list and press the select offshoresample button.</p>

<table border='1'>
<tr>
  <td>ID</td>
  <td>
	<?php
	echo "<select id='sample_id' name='sample_id'>";
	$result = mysqli_query($link,"SELECT * FROM offshoresample JOIN sample on offshoresample.sample_id = sample.sample_id WHERE sample_type='Offshore'"); 
	while($row = mysqli_fetch_array($result)) {
		if($_POST['sample_id'] == $row['sample_id'])
		{
		echo "<option selected='selected' value='" . $row['sample_id'] . "'>" . $row['sample_id'] . " / " . $row['site_code'] . " / " . $row['method'] . " / " . $row['date'] . "</option>";
		}
		else
		{
		echo "<option value='" . $row['sample_id'] . "'>" . $row['sample_id'] . " / " . $row['site_code'] . " / " . $row['method'] . " / " . $row['date'] . "</option>";
		}
	}
	echo "</select>";
	?>
</td>
<td>
<input type='submit' name='action' value='Select offshoresample'> 
</td>
 </tr>
</table>
<input type='hidden' name='type' value='Edit'> 

</form> 
<br>



<?php
//if action back button has been selected, reload the web page
if ($_POST['action'] == 'Back to Add offshoresample')
{
$_POST = array();
header('Location:offshoresample.php'); 
}
?>




<?php




//if action update or delete or select record has been selected do the code with the semi-colons
if ($_POST['action'] == "Update offshoresample" OR $_POST['action'] == "Delete offshoresample" OR $_POST['action'] == "Select offshoresample")
{
//if the below data isn't entered then don't display the messages
if ($_POST['sals'] != "" AND $_POST['temps'] != "" AND $_POST['dos'] != "")
{
//Display the update messages
if ($_POST['action'] == "Update offshoresample")
{
echo "<br>";
echo "<h1>Offshore Sample Updated</h1>";
echo "<br>";
}

//Display the delete messages
if ($_POST['action'] == "Delete offshoresample")
{
echo "<br>";
echo "<h1>Offshore Sample Deleted</h1>";
echo "<br>";
}
}


$result = mysqli_query($link,"SELECT * FROM offshoresample JOIN sample on offshoresample.sample_id = sample.sample_id WHERE offshoresample.sample_id='" . $_POST['sample_id'] . "'");
$therow = mysqli_fetch_array($result);

// Table that display the information for the selected record
echo "
<form action='offshoresample.php' method='post'>

<p>To edit or delete a offshoresample, change the data and press the update offshoresample button or to delete press the delete offshoresample button.</p>

<table border='1'>
<tr>
  <td>ID</td>
  <td><input type='text' readonly name='sample_id' value='" . $therow['sample_id'] . "'> 
  </td>
 </tr>
  <tr>
  <td>Type</td>
  <td><input type='text' readonly name='sample_type' value='" . $therow['sample_type'] . "'> 
  </td>
 </tr>
 <tr>
  <td>Code</td>
  <td>
 ";

	echo "<select id='site_code' name='site_code'>";
	$result = mysqli_query($link,"SELECT * FROM site"); 
	while($row = mysqli_fetch_array($result)) {
		if($therow['site_code'] == $row['site_code'])
		{
		echo "<option selected='selected' value='" . $row['site_code'] . "'>" . $row['site_code'] . "</option>";
		}
		else
		{
		echo "<option value='" . $row['site_code'] . "'>" . $row['site_code'] . "</option>";
		}
	}
	echo "</select>";
echo "
</td>
 </tr> 
<tr>
  <td>Method</td>
  <td>
   ";
  	echo "<select id='method' name='method'>";
	if($therow['method'] == '21m seine')
	{
		echo "<option selected='selected' value='21m seine'>21m seine</option>";
		echo "<option value='Gill'>Gill</option>";
	}
	elseif ($therow['method'] == 'Gill')
	{
		echo "<option value='21m seine'>21m seine</option>";
		echo "<option selected='selected' value='Gill'>Gill</option>";
	}
  	echo "</select>";
echo " 
  </td>  
 </tr>
 <tr>
  <td>Date</td>
  <td><input type='text' name='date'value='" . $therow['date'] . "'> 
  <br>Requires year-month-day format example ( 2014-01-01 )</br> </td>
 </tr>
 <tr>
  <td>Notes</td>
  <td><input type='text' name='notes'value='" . $therow['notes'] . "'> </td>
 </tr>
<tr>
  <td>Sals</td>
  <td><input type='text' name='sals'value='" . $therow['sals'] . "'> </td>
 </tr>
 <tr>
  <td>Temps</td>
  <td><input type='text' name='temps'value='" . $therow['temps'] . "'> </td>
 </tr>
 <tr>
  <td>Dos</td>
  <td><input type='text' name='dos'value='" . $therow['dos'] . "'> </td>
 </tr>
<tr>
  <td>Salb</td>
  <td><input type='text' name='salb'value='" . $therow['salb'] . "'> </td>
 </tr>
 <tr>
  <td>Tempb</td>
  <td><input type='text' name='tempb'value='" . $therow['tempb'] . "'> </td>
 </tr>
 <tr>
  <td>Dob</td>
  <td><input type='text' name='dob'value='" . $therow['dob'] . "'> </td>
 </tr>
</table>";
//the Update and Delete buttons
echo "
<input type='submit' name='action' value='Update offshoresample'>
<input type='submit' name='action' value='Delete offshoresample'> 
</form> 

<br>";
//the back button
echo "
<a href='offshoresample.php'><button>Back to Add offshoresample </button></a>



<br>
";

}

?>


<br>
<!-- Back button -->
<form><input type='button' name='Back' value='Finished with Offshore Sample' onClick="location.href='../samples.php'"></form>

</center>

<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>