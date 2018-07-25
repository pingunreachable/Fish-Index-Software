<?php include '../dbconnect.php'; ?>
<?php

	// retrieve metric score from Offshore data from database
	$result = mysqli_query($link,"SELECT * FROM OSFinalScores"); 
	
	$data = array();

	for($x = 0; $x < mysqli_num_rows($result); $x++)
	{
		$data[] = mysqli_fetch_assoc($result);
	}
	
	//convert data into json array
	echo json_encode($data);

?>
