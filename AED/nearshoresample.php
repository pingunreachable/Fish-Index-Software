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
echo "<h1>Nearshore Sample</h1>";

//if action is blank or the add button has been selected do the code with the semi-colons
if ($_POST['action'] == "" OR $_POST['action'] == "Add nearshoresample")
{

//Inserting information table
echo "

<form action='nearshoresample.php' method='post'>

<p>To add a new nearshoresample, fill in the form and press the add nearshoresample button.</p>

<table border='1'>
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
</table>
<input type='submit' name='action' value='Add nearshoresample'> 
</form> 
<br>

";

//if the below data isn't entered then don't add the information to the database
if ($_POST['sal'] != "" AND $_POST['temp'] != "" AND $_POST['do'] != "")
{
//if action is add do the code with the semi-colons
//$result is the insert SQL string used to add the data
if ($_POST['action'] == "Add nearshoresample")
{
	$result = "INSERT INTO sample  (sample_type, site_code, method, date, notes, sample_id) VALUES('" . $_POST['sample_type'] . "', '" . $_POST['site_code'] . "', '" . $_POST['method'] . "', '" . $_POST['date'] . "', '" . $_POST['notes'] . "', NULL);"; 
mysqli_query($link,$result);

$lastID =  mysqli_insert_id($link);

	$result = "INSERT INTO nearshoresample  (sal, temp, do, sample_id) VALUES('" . $_POST['sal'] . "', '" . $_POST['temp'] . "', '" . $_POST['do'] . "', '" . $lastID . "');"; 
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo "<br>";
//Prints to the screen that the record has been added
echo "<h1>Nearshore Sample Added</h1>";
echo "<br>";
mysqli_query($link,$result);
}
}





}
?>


<?php
//if action update or delete has been selected do the code with the semi-colons
if ($_POST['action'] == "Update nearshoresample" OR $_POST['action'] == "Delete nearshoresample" OR $_POST['action'] == "Select nearshoresample")
{
//if the below data isn't entered then don't don't update or delete the information to the database
if ($_POST['sal'] != "" AND $_POST['temp'] != "" AND $_POST['do'] != "")
{
//if action update has been selected update the database with the information entered
//$result is the insert SQL string used to update the data
if ($_POST['action'] == "Update nearshoresample")
{
	$result = "UPDATE sample SET sample_type='" . $_POST['sample_type'] . "', site_code='" . $_POST['site_code'] . "', method='" . $_POST['method'] . "', date='" . $_POST['date'] . "', notes='" . $_POST['notes'] . "' WHERE sample_id='" . $_POST['sample_id'] . "'"; 
	mysqli_query($link,$result);

	$result = "UPDATE nearshoresample SET sal='" . $_POST['sal'] . "', temp='" . $_POST['temp'] . "', do='" . $_POST['do'] . "' WHERE sample_id='" . $_POST['sample_id'] . "'"; 
	mysqli_query($link,$result);
}

//if action delete has been selected delete the selected record from the database
//$result is the insert SQL string used to delete the record
if ($_POST['action'] == "Delete nearshoresample")
{
	$result = "DELETE FROM nearshoresample WHERE sample_id='" . $_POST['sample_id'] . "'";
	mysqli_query($link,$result);

	$result = "DELETE FROM sample WHERE sample_id='" . $_POST['sample_id'] . "'";
	mysqli_query($link,$result);
}
}

}

	?>

<!-- The drop down box used to select a record to be updated or deleted -->
<form action='nearshoresample.php' method='post'>

<p>To edit or delete a nearshoresample, select a nearshoresample from the list and press the select nearshoresample button.</p>

<table border='1'>
<tr>
  <td>ID</td>
  <td>
	<?php
	echo "<select id='sample_id' name='sample_id'>";
	$result = mysqli_query($link,"SELECT * FROM nearshoresample JOIN sample on nearshoresample.sample_id = sample.sample_id WHERE sample_type='Nearshore'"); 
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
<input type='submit' name='action' value='Select nearshoresample'> 
</td>
 </tr>
</table>
<input type='hidden' name='type' value='Edit'> 

</form> 
<br>



<?php
//if action back button has been selected, reload the web page
if ($_POST['action'] == 'Back to Add nearshoresample')
{
$_POST = array();
header('Location:nearshoresample.php'); 
}
?>




<?php

//if action update or delete or select record has been selected do the code with the semi-colons
if ($_POST['action'] == "Update nearshoresample" OR $_POST['action'] == "Delete nearshoresample" OR $_POST['action'] == "Select nearshoresample")
{

//if the below data isn't entered then don't display the messages
if ($_POST['sal'] != "" AND $_POST['temp'] != "" AND $_POST['do'] != "")
{
//Display the update messages
if ($_POST['action'] == "Update nearshoresample")
{
echo "<br>";
echo "<h1>Nearshore Sample Updated</h1>";
echo "<br>";
}

//Display the delete messages
if ($_POST['action'] == "Delete nearshoresample")
{
echo "<br>";
echo "<h1>Nearshore Sample Deleted</h1>";
echo "<br>";
}
}

$result = mysqli_query($link,"SELECT * FROM nearshoresample JOIN sample on nearshoresample.sample_id = sample.sample_id WHERE nearshoresample.sample_id='" . $_POST['sample_id'] . "'");
$therow = mysqli_fetch_array($result);

// Table that display the information for the selected record
echo "
<form action='nearshoresample.php' method='post'>

<p>To edit or delete a nearshoresample, change the data and press the update nearshoresample button or to delete press the delete nearshoresample button.</p>

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
  <td>Sal</td>
  <td><input type='text' name='sal'value='" . $therow['sal'] . "'> </td>
 </tr>
 <tr>
  <td>Temp</td>
  <td><input type='text' name='temp'value='" . $therow['temp'] . "'> </td>
 </tr>
 <tr>
  <td>Do</td>
  <td><input type='text' name='do'value='" . $therow['do'] . "'> </td>
 </tr>
 
</table>";
//the Update and Delete buttons
echo "
<input type='submit' name='action' value='Update nearshoresample'>
<input type='submit' name='action' value='Delete nearshoresample'> 
</form> 

<br>";
//the back button
echo "
<a href='nearshoresample.php'><button>Back to Add nearshoresample </button></a>



<br>
";

}

?>


<br>
<!-- Back button -->
<form><input type='button' name='Back' value='Finished with Nearshore Sample' onClick="location.href='../samples.php'"></form>

</center>

<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>