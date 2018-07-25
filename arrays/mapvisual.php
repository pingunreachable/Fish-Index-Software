<?php
   if (isset($_COOKIE['user']))
      echo "";

   else {
   header ( "Location: ../login.php" ); }
?>

<?php include '../childheader.php'; ?>
<?php include '../dbconnect.php'; ?>

 <h2>Map Visualization</h2>
    <p class="centertxt">
                This page shows how the calculated metrics and other data of interest will be displayed using Google Maps.
    </p>
<div id="other_contents">
<?php 
echo "<form action='mapvisual.php' method='post'>
<table border='1'>
<tr>";
echo "<td>Season</td>
  <td>";
echo "<select id='sample_type' name='sample_type'>";

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
<td> <input type='submit' name='action' value='submit'> </td>
 </tr> 
 </table>
 
</form> 
";
?>

<?php 
if ($_POST['action'] == "submit" )
{
echo "site code = " . $_POST['site_code'];
echo "<br>";
echo "sample type = " . $_POST['sample_type'];
}
?>

    <div id="map">
	<script type="text/javascript" id="season" src = "MakeMap.js" sample_type = '<?php echo $_POST['sample_type']; ?>' site_code = ' <?php echo $_POST['site_code']; ?>'></script>
    </div>
</div>
<?php include '../childfooter.php'; ?>
