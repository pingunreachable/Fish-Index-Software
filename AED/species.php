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
echo "<h1>Species</h1>";

//if action is blank or the add button has been selected do the code with the semi-colons
if ($_POST['action'] == "" OR $_POST['action'] == "Add Species")
{

//Inserting information table
echo "

<form action='species.php' method='post'>

<p>To add a new species, fill in the form and press the add species button.</p>

<table border='1'>
<tr>
  <td>Species Code</td>
  <td><input type='text' name='species_code' maxlength='6' value='" . $_POST['species_code'] . "'> </td>
 </tr>
<tr>
  <td>Scientific Name</td>
  <td><input type='text' name='species_name'value='" . $_POST['species_name'] . "'> </td>
 </tr>
<tr>
  <td>Common Name</td>
  <td><input type='text' name='common_name' value='" . $_POST['common_name'] . "'> </td>
 </tr>
<tr>
  <td>Habitat Code</td>
  <td>
";

	echo "<select id='habitat_code' name='habitat_code'>";
	$result = mysqli_query($link,"SELECT * FROM habitatgroup"); 
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row['group_code'] . "'>" . $row['group_name'] . "</option>";
	}
	echo "</select>";
echo "
</td>
 </tr>
<tr>
  <td>Life History Code</td>
  <td>
";
	echo "<select id='lifehistory_code' name='lifehistory_code'>";
	$result = mysqli_query($link,"SELECT * FROM lifehistorygroup"); 
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row['group_code'] . "'>" . $row['group_name'] . "</option>";
	}
	echo "</select>";
echo "
</td>
 </tr>
<tr>
  <td>Tropic Code</td>
  <td>
";
	echo "<select id='trophic_code' name='trophic_code'>";
	$result = mysqli_query($link,"SELECT * FROM trophicgroup"); 
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row['group_code'] . "'>" . $row['group_name'] . "</option>";
	}
	echo "</select>";
echo "
</td>
 </tr>
</table>
<input type='submit' name='action' value='Add Species'> 
</form> 
<br>

";

//if the below data isn't entered then don't add the information to the database
if ($_POST['species_code'] != "" AND $_POST['species_name'] != "" AND $_POST['common_name'] != "" )
{
//if action is add do the code with the semi-colons
//$result is the insert SQL string used to add the data
if ($_POST['action'] == "Add Species")
{
	$result = "INSERT INTO species (species_id, species_code, species_name, common_name, habitat_code, lifehistory_code, trophic_code) VALUES(NULL,'" . $_POST['species_code'] . "', '" . $_POST['species_name'] . "', '" . $_POST['common_name'] . "', '" . $_POST['habitat_code'] . "', '" . $_POST['lifehistory_code'] . "', '" . $_POST['trophic_code'] . "');"; 
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo "<br>";
//Prints to the screen that the record has been added
echo "<h1>Species Added</h1>";
echo "<br>";
mysqli_query($link,$result);
}
}




}
?>


<?php
//if action update or delete has been selected do the code with the semi-colons
if ($_POST['action'] == "Update Species" OR $_POST['action'] == "Delete Species" OR $_POST['action'] == "Select Species")
{
//if the below data isn't entered then don't don't update or delete the information to the database
if ($_POST['species_code'] != "" AND $_POST['species_name'] != "" AND $_POST['common_name'] != "" )
{
//if action update has been selected update the database with the information entered
//$result is the insert SQL string used to update the data
if ($_POST['action'] == "Update Species")
{
	$result = "UPDATE species SET species_code='" . $_POST['species_code'] . "', species_name='" . $_POST['species_name'] . "', common_name='" . $_POST['common_name'] . "', habitat_code='" . $_POST['habitat_code'] . "', lifehistory_code='" . $_POST['lifehistory_code'] . "', trophic_code='" . $_POST['trophic_code'] ."' WHERE species_id='" . $_POST['species_id'] . "'"; 
	mysqli_query($link,$result);
}

//if action delete has been selected delete the selected record from the database
//$result is the insert SQL string used to delete the record
if ($_POST['action'] == "Delete Species")
{
	$result = "DELETE FROM species WHERE species_id='" . $_POST['species_id'] . "'";
	mysqli_query($link,$result);
}
}

}

?>

<!-- The drop down box used to select a record to be updated or deleted -->
<form action='species.php' method='post'>

<p>To edit or delete a species, select a specie from the list and press the select species button.</p>

<table border='1'>
<tr>
  <td>ID</td>
  <td>
	<?php
	echo "<select id='species_id' name='species_id'>";
	$result = mysqli_query($link,"SELECT * FROM species"); 
	while($row = mysqli_fetch_array($result)) {
		if($_POST['species_id'] == $row['species_id'])
		{
		echo "<option selected='selected' value='" . $row['species_id'] . "'>" . $row['species_id'] . " / " . setZeros($row['species_code'], 6)  . " / " . $row['species_name'] . " / " . $row['common_name'] . "</option>";
		}
		else
		{
		echo "<option value='" . $row['species_id'] . "'>" . $row['species_id'] . " / " . setZeros($row['species_code'], 6)  . " / " . $row['species_name'] . " / " . $row['common_name'] . "</option>";
		}
	}
	echo "</select>";
	?>
</td>
<td>
<input type='submit' name='action' value='Select Species'> 
</td>
 </tr>
</table>
<input type='hidden' name='type' value='Edit'> 

</form> 
<br>

<?php
//if action back button has been selected, reload the web page
if ($_POST['action'] == 'Back to Add Species')
{
$_POST = array();
header('Location:species.php'); 
}
?>




<?php



//if action update or delete or select record has been selected do the code with the semi-colons
if ($_POST['action'] == "Update Species" OR $_POST['action'] == "Delete Species" OR $_POST['action'] == "Select Species")
{
//if the below data isn't entered then don't display the messages
if ($_POST['species_code'] != "" AND $_POST['species_name'] != "" AND $_POST['common_name'] != "" )
{
if ($_POST['action'] == "Update Species")
{
//Display the update messages
echo "<br>";
echo "<h1>Species Updated</h1>";
echo "<br>";
}

//Display the delete messages
if ($_POST['action'] == "Delete Species")
{
echo "<br>";
echo "<h1>Species Deleted</h1>";
echo "<br>";
}
}

$result = mysqli_query($link,"SELECT * FROM species WHERE species_id='" . $_POST['species_id'] . "'");
$therow = mysqli_fetch_array($result);

// Table that display the information for the selected record
echo "
<form action='species.php' method='post'>

<p>To edit or delete a species, change the data and press the update species button or to delete press the delete specie button.</p>

<table border='1'>
<tr>
  <td>ID</td>
  <td><input type='text' readonly name='species_id' value='" . $therow['species_id'] . "'> </td>
 </tr>
<tr>
  <td>Code</td>
  <td><input type='text' name='species_code' maxlength='6' value='" . setZeros($therow['species_code'], 6)  . "'> </td>
 </tr>
<tr>
  <td>Scientific Name</td>
  <td><input type='text' name='species_name' value='" . $therow['species_name'] . "'> </td>
 </tr>
<tr>
  <td>Common Name</td>
  <td><input type='text' name='common_name' value='" . $therow['common_name'] . "'> </td>
 </tr>
<tr>
  <td>Habitat Code</td>
  <td>
";

	echo "<select id='habitat_code' name='habitat_code'>";
	$result = mysqli_query($link,"SELECT * FROM habitatgroup"); 
	while($row = mysqli_fetch_array($result)) {
		if($therow['habitat_code'] == $row['group_code'])
		{
		echo "<option selected='selected' value='" . $row['group_code'] . "'>" . $row['group_name'] . "</option>";
		}
		else
		{
		echo "<option value='" . $row['group_code'] . "'>" . $row['group_name'] . "</option>";
		}
	}
	echo "</select>";
echo "
</td>
 </tr>
<tr>
  <td>Life History Code</td>
  <td>
";
	echo "<select id='lifehistory_code' name='lifehistory_code'>";
	$result = mysqli_query($link,"SELECT * FROM lifehistorygroup"); 
	while($row = mysqli_fetch_array($result)) {
		if($therow['lifehistory_code'] == $row['group_code'])
		{
		echo "<option selected='selected' value='" . $row['group_code'] . "'>" . $row['group_name'] . "</option>";
		}
		else
		{
		echo "<option value='" . $row['group_code'] . "'>" . $row['group_name'] . "</option>";
		}
	}
	echo "</select>";
echo "
</td>
 </tr>
<tr>
  <td>Tropic Code</td>
  <td>
";
	echo "<select id='trophic_code' name='trophic_code'>";
	$result = mysqli_query($link,"SELECT * FROM trophicgroup"); 
	while($row = mysqli_fetch_array($result)) {
		if($therow['trophic_code'] == $row['group_code'])
		{
		echo "<option selected='selected' value='" . $row['group_code'] . "'>" . $row['group_name'] . "</option>";
		}
		else
		{
		echo "<option value='" . $row['group_code'] . "'>" . $row['group_name'] . "</option>";
		}
	}
	echo "</select>";
echo "
</td>
 </tr>
</table>";
//the Update and Delete buttons
echo "
<input type='submit' name='action' value='Update Species'>
<input type='submit' name='action' value='Delete Species'> 
</form> 

<br>";
//the back button
echo "
<a href='species.php'><button>Back to Add Species </button></a>



<br>
";

}

?>


<br>
<!-- Back button -->
<form><input type='button' name='Back' value='Finished with Species' onClick="location.href='../samples.php'"></form>

</center>

<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>