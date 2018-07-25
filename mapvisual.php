<?php 
   if (isset($_COOKIE['user'])) 
      echo ""; 
       
   else { 
   header ( "Location: login.php" ); } 
?> <!--php script to check valid cookies if not user will be redirected to the login page-->

<?php include 'header.php'; ?> <!--php function that called the HTML header information contains in that php file-->

    <h2>Map Visualization</h2>
	
    <p class="centertxt"> <!--Insert short explaination of this page's purpose here--> 
		This page shows how the calculated metrics and other data of interest will be displayed using Google Maps.
	</p>
 
									<!-- Insert all contents in here START--> 
									<div id="other_contents"> 

<iframe src="arrays/sampleIndex.php" width="600px" height="600px" frameborder="0" align="center"></iframe> 
<!--Inline frame is used to embed sampleIndex.php stored in arrays folder within the current HTML/php document-->

									</div> 
									<!-- Insert all contents in here END-->

<?php include 'footer.php'; ?> <!--php function that called the HTML footer information contains in that php file-->
