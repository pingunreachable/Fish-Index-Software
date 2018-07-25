<?php 
   if (isset($_COOKIE['user'])) 
      echo ""; 
       
   else { 
   header ( "Location: login.php" ); } 
?> <!--php script to check valid cookies if not user will be redirected to the login page-->

<?php include 'header.php'; ?> <!--php function that called the HTML header information contains in that php file-->

    <h2>Search Database</h2>
	
    <p class="centertxt"> <!--Insert short explaination of this page's purpose here-->
		This page allows you to view the information about the fish and areas that have been sampled. It also allows you to view the scores and values calculated from the sampling information.
	</p>
 
									<!-- Insert all contents in here START--> 
									<div id="other_contents"> 
<script type="text/javascript">
function goToNewPage(type)
 {
  if (type == "table")
  {
	if (document.getElementById('tables').value != "")
	{
	var url = document.getElementById('tables').value;
	}
	else
	{
	var url = "history.php";
	}
  }
  if (type == "score")
  {
	if (document.getElementById('scores').value != "")
	{
	var url = document.getElementById('scores').value;
	}
	else
	{
	var url = "history.php";
	}
  }
  if (url != "")
  {
	location.href=url;
  }	
 }
</script> <!--Javascript to redirect users to the appropriate results page-->
									
									
<div title="Select a set of data from the list in order to view the corresponding data."><p class ="normaltxt">View Fish, Area or Sample Information:</p></div>
<form title="Select a set of data from the list in order to view the corresponding data." name="searchtables" id="searchtables">						
	<select id="tables" name="select_tables">
	  <option  value="" disabled selected>--Fish Data Sets--</option>
	  <option value="search/Searchhabitatgroup.php">Habitat</option>
	  <option value="search/Searchlifehistorygroup.php">Life History</option>
	  	  <option value="search/Searchtrophicgroup.php">Trophic Group</option>
	  	  <option value="search/Searchspecies.php">Species</option>
		  <option value="search/Searchspeciessample.php">Species Samples</option>
	  <option disabled>&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473</option>
	  <option disabled>--Sample Data Sets--</option>
	  <option value="search/Searchnearshoresample.php">Nearshore Samples</option>
	  <option value="search/Searchoffshoresample.php">Offshore Samples</option>
	  <option disabled>&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473</option>

	  <option disabled>--Area Data Sets--</option>
	  <option value="search/Searchsite.php">Sites</option>
	  <option value="search/Searchzone.php">Zones</option>	  
	</select>
<input type="button" value="Search" onclick="goToNewPage('table')">
</form> <!--Dropdown box for user to select tables-->

<br><div title="Select a set of data from the list in order to view the corresponding data."><p class="normaltxt">View the Metrics of Interest:</p>

<form title="Select a set of data from the list in order to view the corresponding data." name="searchscores" id="searchtables">
	<select id="scores" name="select_scores">
	  <option value="" disabled selected>--Nearshore Data Sets--</option>
	  
	  <option value="search/SearchNSFinalScores.php">NS Final Scores</option>
	  <option value="search/SearchNSMetricValues.php">NS Metric Values</option>	  
	  <!--<option value="search/SearchNSMetricScores.php">NS Metric Scores</option>--> <!--Commented out just in case it is needed in the future-->
	  <!--<option value="search/SearchNSZoneScores.php">NS Zone Scores</option>--> <!--Commented out just in case it is needed in the future-->
	<option disabled>&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473</option>

	  <option disabled>--Offshore Data Sets--</option> 
	  
	  <option value="search/SearchOSFinalScores.php">OS Final Scores</option>
         <option value="search/SearchOSMetricValues.php">OS Metric Values</option>
	  <!--<option value="search/SearchOSMetricScores.php">OS Metric Scores</option>--> <!--Commented out just in case it is needed in the future-->
	  <!--<option value="search/SearchOSZoneScores.php">OS Zone Scores</option>--> <!--Commented out just in case it is needed in the future-->
	</select>
<input type="button" value="Search" onclick="goToNewPage('score')">
</form> <!--Dropdown box for user to select views from database-->
					
									
									 </div> 
									<!-- Insert all contents in here END-->
 
 

 
<?php include 'footer.php'; ?> <!--php function that called the HTML footer information contains in that php file-->
