<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
  <title>Radar chart</title>
    <script type="text/javascript" src="d3master/d3.min.js"></script>
	<script type="text/javascript" src="Radarplot.js"> </script>
	
	<style>
		body {
		  overflow: hidden;
		  margin: 0;
		  font-size: 14px;
		  font-family: "Helvetica Neue", Helvetica;
		}

		#chart {
		  position: absolute;
		  top: 50px;
		  left: 100px;
		}	

	</style>
  </head>
  <body>

<?php include '../dbconnect.php'; ?>

<?php 
echo "<form action='radarplot.php' method='post'>
<table border='1'>
<tr>";
/*echo "<td>Method</td>
  <td>	
    <select id='sample_type' name='sample_type'>
	<option value='Nearshore'>Nearshore</option>
	<option value='Offshore'>Offshore</option>
	</select>
  </td>";
  */
echo "  <td>Code</td>
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
 </tr> 
 </table>
<input type='submit' name='action' value='submit'> 
</form> 
";
?> 

<?php 
if ($_POST['action'] == "submit" )
{
//echo "site code = " . $_POST['site_code'];
echo "<br>";
//echo "sample type = " . $_POST['sample_type'];
}
?>

 <div id="body">
	  <div id="chart"></div>
    </div>
	
    <script type="text/javascript" id="mysitecode" src="script.js" site_code = '<?php echo $_POST['site_code']; ?>'>  </script>
  </body>
</html>


