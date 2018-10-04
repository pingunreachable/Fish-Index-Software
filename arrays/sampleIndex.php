<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="d3master/d3.min.js"></script>
    <style type="text/css">

<?php
//Style sheet for google map overlay with declaring div id as map
//500 x 500 size
?>
 html, body, #map {
  height: 500px;
  width: 500px;
  margin: 0;
  padding: 0;
}
.sites, .sites svg {
  position: absolute;
}

<?php
// Text will be written as SVG (scalar vector graphics)
// color will be red with black outline
// font: san-serif in bole with size 11 
?>
.sites svg {
  width: 60px;
  height: 20px;
  margin-left: auto;
  margin-right: auto;
 stroke: black;
stroke-width: 0.5px;
fill: red;
  font: 11px sans-serif.bold();
}

<?php
// parameter for dots drawn the google map overlay
// shape will be circle with color orange with black outline
?>
.sites circle {
  fill: orange;
  stroke: black;
  stroke-width: 1.5px;
}

<?php
// Transition made to circle upon hovering with mouse:
// - change to rad color and mouse will change to pointer
?>
.sites circle:hover{
	fill: red;
	cursor: pointer;
}
    </style>
  </head>
  <body>
<?php include '../dbconnect.php'; ?>

<div id="other_contents">


<?php 
echo "<form action='sampleIndex.php' method='post'>
<table border='1'>
<tr>";
echo "<td>Season</td>
  <td>";
echo "<select id='sample_type' name='sample_type'>";
/*
	Season dropdown box
	- returns Summer or Autumn in string
*/
if($_POST['sample_type'] == 'Summer' || $_POST['sample_type'] == 'Autumn')
		{
		echo "<option selected='selected' value='Summer'>Summer</option>";
		echo "<option value='Autumn'>Autumn</option>";
		}
		else
		{
		echo "<option value='Summer'>Summer</option>";
		echo "<option selected='selected' value='Autumn'>Autumn</option>";
		}

	echo "</select>";
echo "</td>";
echo "  <td>Code</td>
  <td>";

// Fill dropdown list with site codes of estuary
//The selected site will return string value of the site code

	echo "<select id='site_code' name='site_code'>";
	$result = mysqli_query($link,"SELECT * FROM site"); 
	if($_POST['site_code'] == 'All')
	{
		echo "<option selected='selected' value='All'>All Sites</option>";
	}
	else
	{
		echo "<option value='All'>All Sites</option>";
	}
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
<td> <input type='submit' name='action' value='submit'> </td>
 </tr> 
 </table>
 
</form> 
";
?>

<?php 
/*
	Once submit is hit, it will output 2 values:
	- site code (string)
	- season (string)
*/
if ($_POST['action'] == "submit" )
{
//echo "site code = " . $_POST['site_code'];
echo "<br>";
//echo "sample type = " . $_POST['sample_type'];
}
?>

<?php
/*
	call the script file to draw the google map overlay to webpage
	pass in site code and season value to script file to process
	the data from the dropdown box
*/ 
?>
    <div id="map"></div>
	<script type="text/javascript" id="season" src = "MakeMap.js" sample_type = '<?php echo $_POST['sample_type']; ?>' site_code = ' <?php echo $_POST['site_code']; ?>'></script>
   </body>
</html>


