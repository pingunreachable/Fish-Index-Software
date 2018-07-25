<?php include 'header.php'; ?>

									<!-- Insert all contents in here START--> 
									<div id="other_contents"> 

<?php include 'dbconnect.php'; ?>
<?php
$selection = $_POST['select_scores'];

if ("NSMetricValues" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM NSMetricValues"); 

	echo "<table border='1'>
	<tr>
	<th>Sample ID</th>
	<th>Site code</th>
	<th>Date</th>
	<th>No species</th>
	<th>Prop Trop Spec</th>
	<th>No_trop_spec</th>
	<th>No_trop_gen</th>
	<th>Prop_detr</th>
	<th>Prop_benthic</th>
	<th>No_benthic</th>
	<th>Prop_est_spawn</th>
	<th>No_est_spawn</th>
	<th>Prop_P_olorum</th>
	<th>Tot_no_P_olorum</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['sample_id'] . "</td>";
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['No_species'] . "</td>";
	  echo "<td>" . $row['Prop_trop_spec'] . "</td>";
	  echo "<td>" . $row['No_trop_spec'] . "</td>";
	  echo "<td>" . $row['No_trop_gen'] . "</td>";
	  echo "<td>" . $row['Prop_detr'] . "</td>";
	  echo "<td>" . $row['Prop_benthic'] . "</td>";
	  echo "<td>" . $row['No_benthic'] . "</td>";
	  echo "<td>" . $row['Prop_est_spawn'] . "</td>";
	  echo "<td>" . $row['No_est_spawn'] . "</td>";
	  echo "<td>" . $row['Prop_P_olorum'] . "</td>";
	  echo "<td>" . $row['Tot_no_P_olorum'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("NSMetricScores" == $selection){
	$result = mysqli_query($link,"SELECT * FROM NSMetricScores"); 

	echo "<table border='1'>
	<tr>
	<th>Sample ID</th>
	<th>Site code</th>
	<th>Date</th>
	<th>No species</th>
	<th>Prop Trop Spec</th>
	<th>No_trop_spec</th>
	<th>No_trop_gen</th>
	<th>Prop_detr</th>
	<th>Prop_benthic</th>
	<th>No_benthic</th>
	<th>Prop_est_spawn</th>
	<th>No_est_spawn</th>
	<th>Prop_P_olorum</th>
	<th>Tot_no_P_olorum</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['sample_id'] . "</td>";
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['No_species'] . "</td>";
	  echo "<td>" . $row['Prop_trop_spec'] . "</td>";
	  echo "<td>" . $row['No_trop_spec'] . "</td>";
	  echo "<td>" . $row['No_trop_gen'] . "</td>";
	  echo "<td>" . $row['Prop_detr'] . "</td>";
	  echo "<td>" . $row['Prop_benthic'] . "</td>";
	  echo "<td>" . $row['No_benthic'] . "</td>";
	  echo "<td>" . $row['Prop_est_spawn'] . "</td>";
	  echo "<td>" . $row['No_est_spawn'] . "</td>";
	  echo "<td>" . $row['Prop_P_olorum'] . "</td>";
	  echo "<td>" . $row['Tot_no_P_olorum'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("NSFinalScores" == $selection){
	$result = mysqli_query($link,"SELECT * FROM NSFinalScores"); 

	echo "<table border='1'>
	<tr>
	<th>Site code</th>
	<th>Date</th>
	<th>No species</th>
	<th>Prop Trop Spec</th>
	<th>No_trop_spec</th>
	<th>No_trop_gen</th>
	<th>Prop_detr</th>
	<th>Prop_benthic</th>
	<th>No_benthic</th>
	<th>Prop_est_spawn</th>
	<th>No_est_spawn</th>
	<th>Prop_P_olorum</th>
	<th>Tot_no_P_olorum</th>
	<th>Sum_of_Scores</th>
	<th>Final_Index_Score</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['No_species'] . "</td>";
	  echo "<td>" . $row['Prop_trop_spec'] . "</td>";
	  echo "<td>" . $row['No_trop_spec'] . "</td>";
	  echo "<td>" . $row['No_trop_gen'] . "</td>";
	  echo "<td>" . $row['Prop_detr'] . "</td>";
	  echo "<td>" . $row['Prop_benthic'] . "</td>";
	  echo "<td>" . $row['No_benthic'] . "</td>";
	  echo "<td>" . $row['Prop_est_spawn'] . "</td>";
	  echo "<td>" . $row['No_est_spawn'] . "</td>";
	  echo "<td>" . $row['Prop_P_olorum'] . "</td>";
	  echo "<td>" . $row['Tot_no_P_olorum'] . "</td>";
	  echo "<td>" . $row['Sum_of_Scores'] . "</td>";
	  echo "<td>" . $row['Final_Index_Score'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("NSZoneScores" == $selection){
	$result = mysqli_query($link,"SELECT * FROM NSZoneScores"); 

	echo "<table border='1'>
	<tr>
	<th>CESU</th>
	<th>CEAU</th>
	<th>LSCESU</th>
	<th>LSCEAU</th>
	<th>MSESU</th>
	<th>MSEAU</th>
	<th>USESU</th>
	<th>USEAU</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['CESU'] . "</td>";
	  echo "<td>" . $row['CEAU'] . "</td>";
	  echo "<td>" . $row['LSCESU'] . "</td>";
	  echo "<td>" . $row['LSCEAU'] . "</td>";
	  echo "<td>" . $row['MSESU'] . "</td>";
	  echo "<td>" . $row['MSEAU'] . "</td>";
	  echo "<td>" . $row['USESU'] . "</td>";
	  echo "<td>" . $row['USEAU'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("OSMetricValues" == $selection) { 
	$result = mysqli_query($link,"SELECT * FROM OSMetricValues"); 

	echo "<table border='1'>
	<tr>
	<th>Sample ID</th>
	<th>Site code</th>
	<th>Date</th>
	<th>No species</th>
	<th>Shannon_Weiner</th>
	<th>No_trop_spec</th>
	<th>No_trop_gen</th>
	<th>Prop_detr</th>
	<th>Prop_benthic</th>
	<th>Prop_est_spawn</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['sample_id'] . "</td>";
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['No_species'] . "</td>";
	  echo "<td>" . $row['Shannon_Weiner'] . "</td>";
	  echo "<td>" . $row['No_trop_spec'] . "</td>";
	  echo "<td>" . $row['No_trop_gen'] . "</td>";
	  echo "<td>" . $row['Prop_detr'] . "</td>";
	  echo "<td>" . $row['Prop_benthic'] . "</td>";
	  echo "<td>" . $row['Prop_est_spawn'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("OSMetricScores" == $selection){

	$result = mysqli_query($link,"SELECT * FROM OSMetricScores"); 

	echo "<table border='1'>
	<tr>
	<th>Sample ID</th>
	<th>Site code</th>
	<th>Date</th>
	<th>No species</th>
	<th>Shannon_Weiner</th>
	<th>No_trop_spec</th>
	<th>No_trop_gen</th>
	<th>Prop_detr</th>
	<th>Prop_benthic</th>
	<th>Prop_est_spawn</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['sample_id'] . "</td>";
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['No_species'] . "</td>";
	  echo "<td>" . $row['Shannon_Weiner'] . "</td>";
	  echo "<td>" . $row['No_trop_spec'] . "</td>";
	  echo "<td>" . $row['No_trop_gen'] . "</td>";
	  echo "<td>" . $row['Prop_detr'] . "</td>";
	  echo "<td>" . $row['Prop_benthic'] . "</td>";
	  echo "<td>" . $row['Prop_est_spawn'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("OSFinalScores" == $selection){
	$result = mysqli_query($link,"SELECT * FROM OSFinalScores"); 

	echo "<table border='1'>
	<tr>
	<th>Site code</th>
	<th>Date</th>
	<th>No species</th>
	<th>Shannon_Weiner</th>
	<th>No_trop_spec</th>
	<th>No_trop_gen</th>
	<th>Prop_detr</th>
	<th>Prop_benthic</th>
	<th>Prop_est_spawn</th>
	<th>Sum_of_Scores</th>
	<th>Final_Index_Score</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['site_code'] . "</td>";
	  echo "<td>" . $row['date'] . "</td>";
	  echo "<td>" . $row['No_species'] . "</td>";
	  echo "<td>" . $row['Shannon_Weiner'] . "</td>";
	  echo "<td>" . $row['No_trop_spec'] . "</td>";
	  echo "<td>" . $row['No_trop_gen'] . "</td>";
	  echo "<td>" . $row['Prop_detr'] . "</td>";
	  echo "<td>" . $row['Prop_benthic'] . "</td>";
	  echo "<td>" . $row['Prop_est_spawn'] . "</td>";
	  echo "<td>" . $row['Sum_of_Scores'] . "</td>";
	  echo "<td>" . $row['Final_Index_Score'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

elseif ("OSZoneScores" == $selection){
	$result = mysqli_query($link,"SELECT * FROM OSZoneScores"); 

	echo "<table border='1'>
	<tr>
	<th>CESU</th>
	<th>CEAU</th>
	<th>LSCESU</th>
	<th>LSCEAU</th>
	<th>MSESU</th>
	<th>MSEAU</th>
	<th>USESU</th>
	<th>USEAU</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
	  echo "<tr>";
	  echo "<td>" . $row['CESU'] . "</td>";
	  echo "<td>" . $row['CEAU'] . "</td>";
	  echo "<td>" . $row['LSCESU'] . "</td>";
	  echo "<td>" . $row['LSCEAU'] . "</td>";
	  echo "<td>" . $row['MSESU'] . "</td>";
	  echo "<td>" . $row['MSEAU'] . "</td>";
	  echo "<td>" . $row['USESU'] . "</td>";
	  echo "<td>" . $row['USEAU'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
}

?>
									 </div> 
 
 

<br>
<form><input type='button' name='Back' value='Back' onClick="location.href='samples.php'"></form>

<?php include 'footer.php'; ?>