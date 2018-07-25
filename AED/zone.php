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
echo "<h1>Zone</h1>";

//if action is blank or the add button has been selected do the code with the semi-colons
if ($_POST['action'] == "" OR $_POST['action'] == "Add Zone")
{

//Inserting information table
echo "

<form action='zone.php' method='post'>

<p>To add a new zone, fill in the form and press the add zone button.</p>

<table border='1'>
<tr>
  <td>Code</td>
  <td><input type='text' name='zone_code' maxlength='4' value='" . $_POST['zone_code'] . "'> </td>
 </tr>
<tr>
  <td>Name</td>
  <td><input type='text' name='zone_name'value='" . $_POST['zone_name'] . "'> </td>
 </tr>
</table>
<input type='submit' name='action' value='Add Zone'> 
</form> 
<br>

";

//if the below data isn't entered then don't add the information to the database
if ($_POST['zone_code'] != "" AND $_POST['zone_name'] != "")
{
//if action is add do the code with the semi-colons
//$result is the insert SQL string used to add the data
if ($_POST['action'] == "Add Zone")
{
	$result = "INSERT INTO zone  (zone_code, zone_name) VALUES('" . $_POST['zone_code'] . "', '" . $_POST['zone_name'] . "');"; 
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo "<br>";
//Prints to the screen that the record has been added
echo "<h1>Zone  Added</h1>";
echo "<br>";
mysqli_query($link,$result);
}
}




}
?>


<?php
//if action update or delete has been selected do the code with the semi-colons
if ($_POST['action'] == "Update Zone" OR $_POST['action'] == "Delete Zone" OR $_POST['action'] == "Select Zone")
{
//if the below data isn't entered then don't don't update or delete the information to the database
if ($_POST['zone_code'] != "" AND $_POST['zone_name'] != "" )
{
//if action update has been selected update the database with the information entered
//$result is the insert SQL string used to update the data
if ($_POST['action'] == "Update Zone")
{
	$result = "UPDATE zone SET zone_name='" . $_POST['zone_name'] . "' WHERE zone_code='" . $_POST['zone_code'] . "'"; 
	mysqli_query($link,$result);
}

//if action delete has been selected delete the selected record from the database
//$result is the insert SQL string used to delete the record
if ($_POST['action'] == "Delete Zone")
{
	$result = "DELETE FROM zone WHERE zone_code='" . $_POST['zone_code'] . "'";
	mysqli_query($link,$result);
}
}

}

?>

<!-- The drop down box used to select a record to be updated or deleted -->
<form action='zone.php' method='post'>

<p>To edit or delete a zone, select a zone from the list and press the select zone button.</p>

<table border='1'>
<tr>
  <td>ID</td>
  <td>
	<?php
	echo "<select id='zone_code' name='zone_code'>";
	$result = mysqli_query($link,"SELECT * FROM zone"); 
	while($row = mysqli_fetch_array($result)) {
		if($_POST['zone_code'] == $row['zone_code'])
		{
		echo "<option selected='selected' value='" . $row['zone_code'] . "'>" . $row['zone_code'] . " / " . $row['zone_name'] . "</option>";
		}
		else
		{
		echo "<option value='" . $row['zone_code'] . "'>" . $row['zone_code'] . " / " . $row['zone_name'] .   "</option>";
		}
	}
	echo "</select>";
	?>
</td>
<td>
<input type='submit' name='action' value='Select Zone'> 
</td>
 </tr>
</table>
<input type='hidden' name='type' value='Edit'> 

</form> 
<br>



<?php
//if action back button has been selected, reload the web page
if ($_POST['action'] == 'Back to Add Zone')
{
$_POST = array();
header('Location:zone.php'); 
}
?>




<?php




//if action update or delete or select record has been selected do the code with the semi-colons
if ($_POST['action'] == "Update Zone" OR $_POST['action'] == "Delete Zone" OR $_POST['action'] == "Select Zone")
{
//if the below data isn't entered then don't display the messages
if ($_POST['zone_code'] != "" AND $_POST['zone_name'] != "" )
{
//Display the update messages
if ($_POST['action'] == "Update Zone")
{
echo "<br>";
echo "<h1>Zone Updated</h1>";
echo "<br>";
}

//Display the delete messages
if ($_POST['action'] == "Delete Zone")
{
echo "<br>";
echo "<h1>Zone Deleted</h1>";
echo "<br>";
}
}

$result = mysqli_query($link,"SELECT * FROM zone WHERE zone_code='" . $_POST['zone_code'] . "'");
$therow = mysqli_fetch_array($result);

// Table that display the information for the selected record
echo "
<form action='zone.php' method='post'>

<p>To edit or delete a zone, change the data and press the update zone button or to delete press the delete zone button.</p>

<table border='1'>
<tr>
  <td>Code</td>
  <td><input type='text' readonly name='zone_code'  maxlength='4' value='" . $therow['zone_code'] . "'> </td>
 </tr>
<tr>
  <td>Name</td>
  <td><input type='text' name='zone_name' value='" . $therow['zone_name'] . "'> </td>
 </tr>
<tr>
</table>";
//the Update and Delete buttons
echo "
<input type='submit' name='action' value='Update Zone'>
<input type='submit' name='action' value='Delete Zone'> 
</form> 

<br>";
//the back button
echo "
<a href='zone.php'><button>Back to Add Zone </button></a>



<br>
";

}

?>


<br>
<!-- Back button -->
<form><input type='button' name='Back' value='Finished with Zone' onClick="location.href='../samples.php'"></form>

</center>

<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>