<?php include '../dbconnect.php'; ?>
<?php

	// retrieve data from Nearshore data
	$query = "SELECT site.site_code, site.latitude, site.longitude, NSFinalScores.date, NSFinalScores.Final_Index_Score FROM site JOIN NSFinalScores ON site.site_code = NSFinalScores.site_code";
	
	$result = mysqli_query($link, $query); 
	
	$data1 = array();
	
	for($x = 0; $x < mysqli_num_rows($result); $x++)
	{
		$data1[] = mysqli_fetch_assoc($result);
	}
	
	// retrieve data from Offshore data
	$query = "SELECT site.site_code, site.latitude, site.longitude, OSFinalScores.date, OSFinalScores.Final_Index_Score FROM site JOIN OSFinalScores ON site.site_code = OSFinalScores.site_code";
	
	$result = mysqli_query($link, $query); 
	
	$data2 = array();
	
	for($x = 0; $x < mysqli_num_rows($result); $x++)
	{
		$data2[] = mysqli_fetch_assoc($result);
	}
	
	// merge arrays into single array
	$final =array_merge($data1, $data2);

	//convert the array into json data
	echo json_encode($final);



?>
