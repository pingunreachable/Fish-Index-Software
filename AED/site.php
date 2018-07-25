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
echo "<h1>Site</h1>";

//if action is blank or the add button has been selected do the code with the semi-colons
if ($_POST['action'] == "" OR $_POST['action'] == "Add Site")
{

//Inserting information table
echo "

<form action='site.php' method='post'>

<p>To add a new site, fill in the form and press the add site button.</p>

<table border='1'>
<tr>
  <td>Code</td>
  <td><input type='text' name='site_code' maxlength='10' value='" . $_POST['site_code'] . "'> </td>
 </tr>
<tr>
  <td>Latitude</td>
  <td><input type='text' name='latitude' maxlength='15' value='" . $_POST['latitude'] . "'> </td>
 </tr>
 <tr>
  <td>Longitude</td>
  <td><input type='text' name='longitude' maxlength='15' value='" . $_POST['longitude'] . "'> </td>
 </tr>
 <tr>
  <td>Description</td>
  <td><input type='text' name='description'value='" . $_POST['description'] . "'> </td>
 </tr>
   <td>Zone</td>
  <td>
";

	echo "<select id='zone_code' name='zone_code'>";
	$result = mysqli_query($link,"SELECT * FROM zone"); 
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row['zone_code'] . "'>" . $row['zone_name'] . "</option>";
	}
	echo "</select>";
echo "
</td>
 </tr> 
</table>
<input type='submit' name='action' value='Add Site'> 
</form> 
<br>

";

//if the below data isn't entered then don't add the information to the database
if ($_POST['site_code'] != "" AND $_POST['latitude'] != "" AND $_POST['longitude'] != "")
{
//if action is add do the code with the semi-colons
//$result is the insert SQL string used to add the data
if ($_POST['action'] == "Add Site")
{
	$result = "INSERT INTO site  (site_code, latitude, longitude, description, zone_code) VALUES('" . $_POST['site_code'] . "', '" . $_POST['latitude'] . "', '" . $_POST['longitude'] . "', '" . $_POST['description'] . "', '" . $_POST['zone_code'] . "');"; 
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo "<br>";
//Prints to the screen that the record has been added
echo "<h1>Site Added</h1>";
echo "<br>";
mysqli_query($link,$result);
}
}




}
?>


<?php
//if action update or delete has been selected do the code with the semi-colons
if ($_POST['action'] == "Update Site" OR $_POST['action'] == "Delete Site" OR $_POST['action'] == "Select Site")
{
//if the below data isn't entered then don't don't update or delete the information to the database
if ($_POST['site_code'] != "" AND $_POST['latitude'] != "" AND $_POST['longitude'] != "")
{
//if action update has been selected update the database with the information entered
//$result is the insert SQL string used to update the data
if ($_POST['action'] == "Update Site")
{
	$result = "UPDATE site SET latitude='" . $_POST['latitude'] . "', longitude='" . $_POST['longitude'] . "', description='" . $_POST['description'] . "', zone_code='" . $_POST['zone_code'] . "' WHERE site_code='" . $_POST['site_code'] . "'"; 
	mysqli_query($link,$result);
}

//if action delete has been selected delete the selected record from the database
//$result is the insert SQL string used to delete the record
if ($_POST['action'] == "Delete Site")
{
	$result = "DELETE FROM site WHERE site_code='" . $_POST['site_code'] . "'";
	mysqli_query($link,$result);
}
}

}

?>


<!-- The drop down box used to select a record to be updated or deleted -->
<form action='site.php' method='post'>

<p>To edit or delete a site, select a site from the list and press the select site button.</p>

<table border='1'>
<tr>
  <td>ID</td>
  <td>
	<?php
	echo "<select id='site_code' name='site_code'>";
	$result = mysqli_query($link,"SELECT * FROM site"); 
	while($row = mysqli_fetch_array($result)) {
		if($_POST['site_code'] == $row['site_code'])
		{
		echo "<option selected='selected' value='" . $row['site_code'] . "'>" . $row['site_code'] . " / " . $row['latitude'] . " / " . $row['longitude'] . " / " . $row['zone_code'] . "</option>";
		}
		else
		{
		echo "<option value='" . $row['site_code'] . "'>" . $row['site_code'] . " / " . $row['latitude'] . " / " . $row['longitude'] . " / " . $row['zone_code'] .  "</option>";
		}
	}
	echo "</select>";
	?>
</td>
<td>
<input type='submit' name='action' value='Select Site'> 
</td>
 </tr>
</table>
<input type='hidden' name='type' value='Edit'> 

</form> 
<br>



<?php
//if action back button has been selected, reload the web page
if ($_POST['action'] == 'Back to Add Site')
{
$_POST = array();
header('Location:site.php'); 
}
?>




<?php




//if action update or delete or select record has been selected do the code with the semi-colons
if ($_POST['action'] == "Update Site" OR $_POST['action'] == "Delete Site" OR $_POST['action'] == "Select Site")
{
//if the below data isn't entered then don't display the messages
if ($_POST['site_code'] != "" AND $_POST['latitude'] != "" AND $_POST['longitude'] != "")
{
if ($_POST['action'] == "Update Site")
{
//Display the update messages
echo "<br>";
echo "<h1>Site Updated</h1>";
echo "<br>";
}

//Display the delete messages
if ($_POST['action'] == "Delete Site")
{
echo "<br>";
echo "<h1>Site Deleted</h1>";
echo "<br>";
}
}

$result = mysqli_query($link,"SELECT * FROM site WHERE site_code='" . $_POST['site_code'] . "'");
$therow = mysqli_fetch_array($result);

// Table that display the information for the selected record
echo "
<form action='site.php' method='post'>

<p>To edit or delete a site, change the data and press the update site button or to delete press the delete site button.</p>

<table border='1'>
<tr>
  <td>Code</td>
  <td><input type='text' readonly name='site_code' maxlength='10' value='" . $therow['site_code'] . "'> </td>
 </tr>
<tr>
  <td>Latitude</td>
  <td><input type='text' name='latitude' maxlength='15' value='" . $therow['latitude'] . "'> </td>
 </tr>
 <tr>
  <td>Longitude</td>
  <td><input type='text' name='longitude' maxlength='15' value='" . $therow['longitude'] . "'> </td>
 </tr>
 <tr>
  <td>Description</td>
  <td><input type='text' name='description'value='" . $therow['description'] . "'> </td>
 </tr>
 <tr>
  <td>Zone Code</td>
  <td>
";

	echo "<select id='zone_code' name='zone_code'>";
	$result = mysqli_query($link,"SELECT * FROM zone"); 
	while($row = mysqli_fetch_array($result)) {
		if($therow['zone_code'] == $row['zone_code'])
		{
		echo "<option selected='selected' value='" . $row['zone_code'] . "'>" . $row['zone_name'] . "</option>";
		}
		else
		{
		echo "<option value='" . $row['zone_code'] . "'>" . $row['zone_name'] . "</option>";
		}
	}
	echo "</select>";
echo "
</td>
 </tr>
 
 
 
</table>";
//the Update and Delete buttons
echo "
<input type='submit' name='action' value='Update Site'>
<input type='submit' name='action' value='Delete Site'> 
</form> 

<br>";
//the back button
echo "
<a href='site.php'><button>Back to Add Site </button></a>



<br>
";

}

?>


<br>
<!-- Back button -->
<form><input type='button' name='Back' value='Finished with Site' onClick="location.href='../samples.php'"></form>

</center>

<!-- Footer of the web page -->
<?php include '../childfooter.php'; ?>