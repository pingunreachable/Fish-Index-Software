<?php include '../dbconnect.php'; ?>
<?php

	// retrieve index score from Nearshore data from database
	$result = mysqli_query($link,"SELECT * FROM NSZoneScores"); 
	
	$data = array();

	for($x = 0; $x < mysqli_num_rows($result); $x++)
	{
		$data[] = mysqli_fetch_assoc($result);
	}
	
	// convert into json array
	echo json_encode($data);

?>