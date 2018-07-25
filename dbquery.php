<?php include 'header.php'; ?>

 
									<!-- Insert all contents in here START--> 
									<div id="other_contents"> 

<?php include 'dbconnect.php'; ?>
<?php
$selection = $_POST['select_tables'];

//Checks to see what option has been selected and read tables from database and outputs it into tables
if ("OSMetricValues" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM offshoresample");
	
	echo "<table border='1'>
	<tr>
	<th>Salinity (Surface)</th>
	<th>Temperature (Surface)</th>
	<th>Dissolved Oxygen (Surface)</th>
	<th>Salinity (Bottom)</th>
	<th>Temperature (Bottom)</th>
	<th>Dissolved Oxygen (Bottom)</th>
	<th>Sample ID</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['sals'] . "</td>";
	  echo "<td>" . $row['temps'] . "</td>";
	  echo "<td>" . $row['dos'] . "</td>";
	  echo "<td>" . $row['salb'] . "</td>";
	  echo "<td>" . $row['tempb'] . "</td>";
	  echo "<td>" . $row['dob'] . "</td>";
	  echo "<td>" . $row['sample_id'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}	

elseif ("NSMetricValues" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM nearshoresample");
	
	echo "<table border='1'>
	<tr>
	<th>Salinity</th>
	<th>Temperature</th>
	<th>Dissolved Oxygen</th>
	<th>Sample ID</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['sal'] . "</td>";
	  echo "<td>" . $row['temp'] . "</td>";
	  echo "<td>" . $row['do'] . "</td>";
	  echo "<td>" . $row['sample_id'] . "</td>";
	} 
	echo "</table>";
}

elseif ("habitatgroup" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM habitatgroup"); 

	echo "<table border='1'>
	<tr>
	<th>Habitat Code</th>
	<th>Habitat Name</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['group_code'] . "</td>";
	  echo "<td>" . $row['group_name'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("lifehistorygroup" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM lifehistorygroup"); 

	echo "<table border='1'>
	<tr>
	<th>Life History Code</th>
	<th>Life History Name</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['group_code'] . "</td>";
	  echo "<td>" . $row['group_name'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("nearshoresample" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM nearshoresample"); 
	
	echo "<table border='1'>
	<tr>
	<th>Nearshore Sample Sal</th>
	<th>Nearshore Sample Temp</th>
	<th>Nearshore Sample Do</th>
	<th>Nearshore Sample Sample ID</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['sal'] . "</td>";
	  echo "<td>" . $row['temp'] . "</td>";
	  echo "<td>" . $row['do'] . "</td>";
	  echo "<td>" . $row['sample_id'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("offshoresample" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM offshoresample"); 

	echo "<table border='1'>
	<tr>
	<th>Offshore Sample Sals</th>
	<th>Offshore Sample Temps</th>
	<th>Offshore Sample Dos</th>
	<th>Offshore Sample Salb</th>
	<th>Offshore Sample Tempb</th>
	<th>Offshore Sample Dob</th>
	<th>Offshore Sample Sample ID</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['sals'] . "</td>";
	  echo "<td>" . $row['temps'] . "</td>";
	  echo "<td>" . $row['dos'] . "</td>";
	  echo "<td>" . $row['salb'] . "</td>";
	  echo "<td>" . $row['tempb'] . "</td>";
	  echo "<td>" . $row['dob'] . "</td>";
	  echo "<td>" . $row['sample_id'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("sample" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM sample"); 

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
}

elseif ("site" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM site"); 

	echo "<table border='1'>
	<tr>
	<th>Site Code</th>
	<th>Site Latitude</th>
	<th>Site Longitude</th>
	<th>Site Description</th>
	<th>Site Zone Code</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['latitude'] . "</td>";
	  echo "<td>" . $row['longitude'] . "</td>";
	  echo "<td>" . $row['description'] . "</td>";
	  echo "<td>" . $row['zone_code'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("species" == $selection) {
	$result = mysqli_query($link,"SELECT * FROM species"); 

	echo "<table border='1'>
	<tr>
	<th>Species ID</th>
	<th>Species Code</th>
	<th>Species Name</th>
	<th>Species Common Name</th>
	<th>Species Habitat Code</th>
	<th>Species Life History Code</th>
	<th>Species Tropic Code</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['species_id'] . "</td>";
	  echo "<td>" . $row['species_code'] . "</td>";
	  echo "<td>" . $row['species_name'] . "</td>";
	  echo "<td>" . $row['common_name'] . "</td>";
	  echo "<td>" . $row['habitat_code'] . "</td>";
	  echo "<td>" . $row['lifehistory_code'] . "</td>";
	  echo "<td>" . $row['trophic_code'] . "</td>";
	  echo "</tr>";
	} 
	echo "</table>";
}

elseif ("speciessample" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM speciessample"); 

	echo "<table border='1'>
	<tr>
	<th>Species Sample Sample ID</th>
	<th>Species Sample Species ID</th>
	<th>Species Sample Total Number</th>
	<th>Species Sample Returned</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['sample_id'] . "</td>";
	  echo "<td>" . $row['species_id'] . "</td>";
	  echo "<td>" . $row['total_number'] . "</td>";
	  echo "<td>" . $row['returned'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("trophicgroup" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM trophicgroup"); 

	echo "<table border='1'>
	<tr>
	<th>Trophic Code</th>
	<th>Trophic Name</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['group_code'] . "</td>";
	  echo "<td>" . $row['group_name'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("zone" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM zone"); 

	echo "<table border='1'>
	<tr>
	<th>Zone Code</th>
	<th>Zone Name</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['zone_code'] . "</td>";
	  echo "<td>" . $row['zone_name'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

?>
									 </div> 
 
 


<br>
<form><input type='button' name='Back' value='Back' onClick="location.href='samples.php'"></form>

<?php include 'footer.php'; ?>