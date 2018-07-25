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

//Function to set the number of characters a number has
//if less then 6 places 0's in front
//$num the number entered into the function
//$dec the number of characters the number should have
function setZeros($num, $dec)
{
return sprintf('%0' . $dec .'d', $num);
}


// Title of the page 
echo "<h1>Species Sample</h1>";

//if action is blank or the add button has been selected do the code with the semi-colons
if ($_POST['action'] == "" OR $_POST['action'] == "Add speciessample")
{

//Inserting information table
echo "

<form action='speciessample.php' method='post'>

<p>To add a new speciessample, fill in the form and press the add speciessample button.</p>

<table border='1'>
<tr>
  <td>Sample ID</td>
  <td>
";

	echo "<select id='sample_id' name='sample_id'>";
	$result = mysqli_query($link,"SELECT * FROM sample"); 
	while($row = mysqli_fetch_array($result)) 
	{
		echo "<option value='" . $row['sample_id'] . "'>" . $row['sample_id'] . " / " . $row['site_code'] . " / " . $row['method'] . " / " . $row['date'] . "</option>";
	}

	echo "</select>";
echo "
</td>
 </tr>
<tr>
  <td>Species ID</td>
    <td>
";

	echo "<select id='species_id' name='species_id'>";
	$result = mysqli_query($link,"SELECT * FROM species"); 
	while($row = mysqli_fetch_array($result)) 
	{
		echo "<option value='" . $row['species_id'] . "'>" . $row['species_id'] . " / " . setZeros($row['species_code'], 6)  . " / " . $row['species_name'] . " / " . $row['common_name'] . "</option>";
	}

	echo "</select>";
echo "
</td>
 </tr>
 <tr>
  <td>Total Number</td>
  <td><input type='text' name='total_number'value='" . $_POST['total_number'] . "'> </td>
 </tr>
 <tr>
  <td>Returned</td>
  <td><input type='text' name='returned'  maxlength='5' value='" . $_POST['returned'] . "'> </td>
 </tr>
 </table>
<input type='submit' name='action' value='Add speciessample'> 
</form> 
<br>

";

//if the below data isn't entered then don't add the information to the database
if ($_POST['sample_id'] != "" AND $_POST['species_id'] != "" )
{
//if action is add do the code with the semi-colons
//$result is the insert SQL string used to add the data
if ($_POST['action'] == "Add speciessample")
{
	$result = "INSERT INTO speciessample  (sample_id, species_id, total_number, returned) VALUES('" . $_POST['sample_id'] . "', '" . $_POST['species_id'] . "', '" . $_POST['total_number'] . "', '" . $_POST['returned'] . "');"; 
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo "<br>";
//Prints to the screen that the record has been added
echo "<h1>Species Sample Added</h1>";
echo "<br>";
mysqli_query($link,$result);
}
}




}
?>


<?php
//if action update or delete has been selected do the code with the semi-colons
if ($_POST['action'] == "Update speciessample" OR $_POST['action'] == "Delete speciessample" OR $_POST['action'] == "Select speciessample")
{
//if the below data isn't entered then don't don't update or delete the information to the database
if ($_POST['sample_id'] != "" AND $_POST['species_id'] != "" )
{
//if action update has been selected update the database with the information entered
//$result is the insert SQL string used to update the data
if ($_POST['action'] == "Update speciessample")
{
	$result = "UPDATE speciessample SET total_number='" . $_POST['total_number'] . "', returned='" . $_POST['returned'] . "' WHERE sample_id='" . $_POST['sample_id'] . "' AND species_id='" . $_POST['species_id'] . "'"; 
	mysqli_query($link,$result);
}

//if action delete has been selected delete the selected record from the database
//$result is the insert SQL string used to delete the record
if ($_POST['action'] == "Delete speciessample")
{
	$result = "DELETE FROM speciessample WHERE sample_id='" . $_POST['sample_id'] . "' AND species_id='" . $_POST['species_id'] . "'"; 
	mysqli_query($link,$result);
}
}

}

?>

<!-- The drop down box used to select a record to be updated or deleted -->
<form action='speciessample.php' method='post'>

<p>To edit or delete a speciessample, select a speciessample from the list and press the select speciessample button.</p>

<table border='1'>
<tr>
  <td>ID</td>
  <td>
	<?php
	$part = split ("\/", $_POST['sample_species_id']); 
	echo "<select id='sample_species_id' name='sample_species_id'>";
	$result = mysqli_query($link,"SELECT * FROM speciessample JOIN sample on speciessample.sample_id = sample.sample_id JOIN species on speciessample.species_id = species.species_id "); 
	while($row = mysqli_fetch_array($result)) {
		if(($row['sample_id'] == $part[0]) && ($row['species_id'] == $part[1]))
		{
		echo "<option selected='selected' value='" . $row['sample_id'] . "/" . $row['species_id'] . "'>" . $row['sample_id'] . " / " . $row['site_code'] . " / " . $row['method'] . " / " . $row['date'] . " / " . $row['species_id'] . " / " . setZeros($row['species_code'], 6)  . " / " . $row['species_name'] . " / " . $row['common_name'] .  "</option>";
		}
		else
		{
		echo "<option value='" . $row['sample_id'] . "/" . $row['species_id'] . "'>" . $row['sample_id'] . " / " . $row['site_code'] . " / " . $row['method'] . " / " . $row['date'] . " / " . $row['species_id'] . " / " . setZeros($row['species_code'], 6)  . " / " . $row['species_name'] . " / " . $row['common_name'] .  "</option>";
		}
	}
	echo "</select>";
	?>
	
	
</td>
<td>
<input type='submit' name='action' value='Select speciessample'> 
</td>
 </tr>
</table>
<input type='hidden' name='type' value='Edit'> 

</form> 
<br>



<?php
//if action back button has been selected, reload the web page
if ($_POST['action'] == 'Back to Add speciessample')
{
$_POST = array();
header('Location:speciessample.php'); 
}
?>




<?php




//if action update or delete or select record has been selected do the code with the semi-colons
if ($_POST['action'] == "Update speciessample" OR $_POST['action'] == "Delete speciessample" OR $_POST['action'] == "Select speciessample")
{
//if the below data isn't entered then don't display the messages
if ($_POST['sample_id'] != "" AND $_POST['species_id'] != "" )
{
if ($_POST['action'] == "Update speciessample")
{
//Display the update messages
echo "<br>";
echo "<h1>Species Sample Updated</h1>";
echo "<br>";
}

//Display the delete messages
if ($_POST['action'] == "Delete speciessample")
{
echo "<br>";
echo "<h1>Species Sample Deleted</h1>";
echo "<br>";
}
}

$part = split ("\/", $_POST['sample_species_id']); 

$result = mysqli_query($link,"SELECT * FROM speciessample JOIN sample on speciessample.sample_id = sample.sample_id JOIN species on speciessample.species_id = species.species_id WHERE speciessample.sample_id='" . $part[0] . "' AND speciessample.species_id='" . $part[1] . "'");
$therow = mysqli_fetch_array($result);

// Table that display the information for the selected record
echo "
<form action='speciessample.php' method='post'>

<p>To edit or delete a speciessample, change the data and press the update speciessample button or to delete press the delete speciessample button.</p>

<table border='1'>
<tr>
  <td>Sample ID</td>
<td><select name='theSampleID'>
	<option disabled selected value=''>" . $therow['sample_id'] . " / " . $therow['site_code'] . " / " . $therow['method'] . " / " . $therow['date'] . "</option>
</select> 
  <input type='hidden' name='sample_id' value='" . $therow['sample_id'] . "'> 
  </td>
 </tr>
<tr>
  <td>Species ID</td>
  <td><select name='theSpeciesId'>
	<option disabled selected value=''>" . $therow['species_id'] . " / " . setZeros($therow['species_code'], 6)  . " / " . $therow['species_name'] . " / " . $therow['common_name'] . "</option>
</select> 
  <input type='hidden' name='species_id' value='" . $therow['species_id'] . "'> 
  </td>
 </tr>
 <tr>
  <td>Total Number</td>
  <td><input type='text' name='total_number'value='" . $therow['total_number'] . "'> </td>
 </tr>
 <tr>
  <td>Returned</td>
  <td><input type='text' name='returned' maxlength='5' value='" . $therow['returned'] . "'> </td>
 </tr>
 
</table>";
//the Update and Delete buttons
echo "
<input type='hidden' name='sample_species_id' value='" . $_POST['sample_species_id'] . "'>
<input type='submit' name='action' value='Update speciessample'>
<input type='submit' name='action' value='Delete speciessample'> 
</form> 

<br>";
//the back button
echo "
<a href='speciessample.php'><button>Back to Add speciessample </button></a>



<br>
";

}

?>


<br>
<!-- Back button -->
<form><input type='button' name='Back' value='Finished with Species Sample' onClick="location.href='../samples.php'"></form>

</center>

<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>