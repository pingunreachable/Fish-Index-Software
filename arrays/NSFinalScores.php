<?php include '../dbconnect.php'; ?>
<?php

	// retrieve data from Nearshore data
	$result = mysqli_query($link,"SELECT * FROM NSFinalScores"); 
	
	$data = array();

	for($x = 0; $x < mysqli_num_rows($result); $x++)
	{
		$data[] = mysqli_fetch_assoc($result);
	}
	
	// convert array into json array
	echo json_encode($data);

?>



