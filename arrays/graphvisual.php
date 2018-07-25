<?php 
   if (isset($_COOKIE['user'])) 
      echo ""; 
       
   else { 
   header ( "Location: ../login.php" ); } 
?> 


    <script type="text/javascript" src="d3master/d3.min.js"></script>
	<script type="text/javascript" src="Radarplot.js"> </script>


<?php include '../dbconnect.php'; ?>

<div id="other_contents">


<?php 
/* Create dropdown list*/
echo "<form action='graphvisual.php' method='post'>
<table border='1'>
<tr>";

/* 
	Fill dropdown list with site codes of estuary
	The selected site will return string value of the site code
*/
echo "  <td>Site Code</td>
  <td>";

	echo "<select id='site_code' name='site_code'>";
	$result = mysqli_query($link,"SELECT * FROM site"); 
	while($row = mysqli_fetch_array($result)) {
		if($row['site_code'] == $_POST['site_code'])
		{
			echo "<option selected='selected' value='" . $row['site_code'] . "'>" . $row['site_code'] . "</option>";
		}
		else
		{
			echo "<option value='" . $row['site_code'] . "'>" . $row['site_code'] . "</option>";
		}
	}
	echo "</select>";
echo "</td>
<td>
<input type='submit' name='action' value='Select'> 
</td>
 </tr> 
 </table>
</form> 
";
?>

<?php 
/*Once hit the submit button, the file will output the value: selected site code as string* /
if ($_POST['action'] == "submit" )
{
//echo "site code = " . $_POST['site_code'];
echo "<br>";
//echo "sample type = " . $_POST['sample_type'];
}
?>

<?php
/* 	The spider chart/ radarplot will be drawn as div id = chart
	the file will pass the value from the dropdown box to script file to 
	process the string value obtained by clicking the site code on dropdown list
*/
?>
<div id="chart">	
    <script type="text/javascript" id="mysitecode" src="script.js" site_code = '<?php echo $_POST['site_code']; ?>'>  </script>
</div>
</div>
	


