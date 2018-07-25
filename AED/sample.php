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
echo "<h1>Sample</h1>";

//if action is blank or the add button has been selected do the code with the semi-colons
if ($_POST['action'] == "" OR $_POST['action'] == "Add Sample")
{

//Inserting information table
echo "

<form action='sample.php' method='post'>

<p>To add a new sample, fill in the form and press the add sample button.</p>

<table border='1'>
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
   <td>Code</td>
  <td>
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
</table>
<input type='submit' name='action' value='Add Sample'> 
</form> 
<br>

";

//if the below data isn't entered then don't add the information to the database
if ($_POST['sample_type'] != "" AND $_POST['site_code'] != "" AND $_POST['method'] != "")
{
//if action is add do the code with the semi-colons
//$result is the insert SQL string used to add the data
if ($_POST['action'] == "Add Sample")
{
	$result = "INSERT INTO sample  (sample_type, site_code, method, date, notes, sample_id) VALUES('" . $_POST['sample_type'] . "', '" . $_POST['site_code'] . "', '" . $_POST['method'] . "', '" . $_POST['date'] . "', '" . $_POST['notes'] . "', NULL);"; 
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo "<br>";
//Prints to the screen that the record has been added
echo "<h1>Sample Added</h1>";
echo "<br>";
mysqli_query($link,$result);
}
}




}
?>


<?php

//if action update or delete has been selected do the code with the semi-colons
if ($_POST['action'] == "Update Sample" OR $_POST['action'] == "Delete Sample" OR $_POST['action'] == "Select Sample")
{
//if the below data isn't entered then don't don't update or delete the information to the database
if ($_POST['sample_id'] != "" AND $_POST['sample_type'] != "" AND $_POST['site_code'] != "")
{
//if action update has been selected update the database with the information entered
//$result is the insert SQL string used to update the data
if ($_POST['action'] == "Update Sample")
{
	$result = "UPDATE sample SET sample_type='" . $_POST['sample_type'] . "', site_code='" . $_POST['site_code'] . "', method='" . $_POST['method'] . "', date='" . $_POST['date'] . "', notes='" . $_POST['notes'] . "' WHERE sample_id='" . $_POST['sample_id'] . "'"; 
	mysqli_query($link,$result);
}

//if action delete has been selected delete the selected record from the database
//$result is the insert SQL string used to delete the record
if ($_POST['action'] == "Delete Sample")
{
	$result = "DELETE FROM sample WHERE sample_id='" . $_POST['sample_id'] . "'";
	mysqli_query($link,$result);
}
}
}

?>



<!-- The drop down box used to select a record to be updated or deleted -->
<form action='sample.php' method='post'>

<p>To edit or delete a sample, select a sample from the list and press the select sample button.</p>

<table border='1'>
<tr>
  <td>ID</td>
  <td>
	<?php
	echo "<select id='sample_id' name='sample_id'>";
	$result = mysqli_query($link,"SELECT * FROM sample"); 
	while($row = mysqli_fetch_array($result)) {
		if($_POST['sample_id'] == $row['sample_id'])
		{
		echo "<option selected='selected' value='" . $row['sample_id'] . "'>" . $row['sample_id'] . " / " . $row['sample_type'] . " / " . $row['site_code'] . " / " . $row['method'] . " / " . $row['date'] . "</option>";
		}
		else
		{
		echo "<option value='" . $row['sample_id'] . "'>" . $row['sample_id'] . " / " . $row['sample_type'] . " / " . $row['site_code'] . " / " . $row['method'] . " / " . $row['date'] . "</option>";
		}
	}
	echo "</select>";
	?>
</td>
<td>
<input type='submit' name='action' value='Select Sample'> 
</td>
 </tr>
</table>
<input type='hidden' name='type' value='Edit'> 

</form> 
<br>



<?php
//if action back button has been selected, reload the web page
if ($_POST['action'] == 'Back to Add Sample')
{
$_POST = array();
header('Location:sample.php'); 
}
?>




<?php



//if action update or delete or select record has been selected do the code with the semi-colons
if ($_POST['action'] == "Update Sample" OR $_POST['action'] == "Delete Sample" OR $_POST['action'] == "Select Sample")
{

if ($_POST['sample_id'] != "" AND $_POST['sample_type'] != "" AND $_POST['site_code'] != "")
{
//if the below data isn't entered then don't display the messages
if ($_POST['action'] == "Update Sample")
{
//Display the update messages
echo "<br>";
echo "<h1>Sample Updated</h1>";
echo "<br>";
}

//Display the delete messages
if ($_POST['action'] == "Delete Sample")
{
echo "<br>";
echo "<h1>Sample Deleted</h1>";
echo "<br>";
}
}

$result = mysqli_query($link,"SELECT * FROM sample WHERE sample_id='" . $_POST['sample_id'] . "'");
$therow = mysqli_fetch_array($result);

// Table that display the information for the selected record
echo "
<form action='sample.php' method='post'>

<p>To edit or delete a sample, change the data and press the update sample button or to delete press the delete sample button.</p>

<table border='1'>
<tr>
  <td>ID</td>
  <td><input type='text' readonly name='sample_id' value='" . $therow['sample_id'] . "'> </td>
 </tr> 
 <tr>
  <td>Type</td>
  <td>
   ";
  	echo "<select id='sample_type' name='sample_type'>";
	if($therow['sample_type'] == 'Nearshore')
	{
		echo "<option selected='selected' value='Nearshore'>Nearshore</option>";
		echo "<option value='Offshore'>Offshore</option>";
	}
	elseif ($therow['sample_type'] == 'Offshore')
	{
		echo "<option value='Nearshore'>Nearshore</option>";
		echo "<option selected='selected' value='Offshore'>Offshore</option>";
	}
  	echo "</select>";
echo " 
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
</table>";
//the Update and Delete buttons
echo "
<input type='submit' name='action' value='Update Sample'>
<input type='submit' name='action' value='Delete Sample'> 
</form> 

<br>";
//the back button
echo "
<a href='sample.php'><button>Back to Add sample </button></a>



<br>
";

}

?>


<br>
<!-- Back button -->
<form><input type='button' name='Back' value='Finished with Sample' onClick="location.href='../samples.php'"></form>

</center>

<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>