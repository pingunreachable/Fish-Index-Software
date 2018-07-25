<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Fish Index Software - Data Query</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>



<div id="header">
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="mapvisual.php">Map Visualization</a><li>
    <li><a href="graphvisual.php">Graph Visualization</a></li>
    <li><a href="history.php">Data Query</a></li>
    <li><a href="samples.php">Historical Data</a></li>
	<!--<li><a href="http://www.murdoch.edu.au">RESERVED</a></li>-->
    <!--<li><a href="http://www.murdoch.edu.au">RESERVED</a></li>-->
    <li><a href="http://www.murdoch.edu.au">Site Information</a></li>
    <li class="last"><a href="http://www.murdoch.edu.au/Research-capabilities/Centre-for-Fish-Fisheries-and-Aquatic-Ecosystems-Research/">About Us</a></li>
  </ul>
  
  <h1>Fish Index Software</h1>
  
  <p class="secondtext">An ICT333</br>Information Technology Project</p>
  
  
</div>

<div id="body">

  <div id="center">
 
									<!-- Insert all contents in here START--> 
									<div id="other_contents"> 

<?php include '../dbconnect.php'; ?>
<?php
$selection = $_POST['customquery'];

	//$temp = mysqli_real_escape_string();
	
	$result = mysqli_query($link, "SELECT * FROM sample"); 

	echo "<table border='1'>
	<tr>
	<th>Sample Type</th>
	<th>Sample Site Code</th>
	<th>Sample Method</th>
	<th>Sample Date</th>
	<th>Sample Notes</th>
	<th>Sample Sample ID</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['sample_type'] . "</td>";
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['method'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['notes'] . "</td>";
	  echo "<td>" . $row['sample_id'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";



?>
									 </div> 
 
 

 
  </div>

</div>



<div id="footer">
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="mapvisual.php">Map Visualization</a><li>
    <li><a href="graphvisual.php">Graph Visualization</a></li>
    <li><a href="history.php">Data Query</a></li>
    <li><a href="samples.php">Historical Data</a></li>
	<!--<li><a href="http://www.murdoch.edu.au">RESERVED</a></li>-->
    <!--<li><a href="http://www.murdoch.edu.au">RESERVED</a></li>-->
    <li><a href="http://www.murdoch.edu.au">Site Information</a></li>
    <li class="last"><a href="http://www.murdoch.edu.au/Research-capabilities/Centre-for-Fish-Fisheries-and-Aquatic-Ecosystems-Research/">About Us</a></li>
  </ul>
 
</div>
</body>
</html>