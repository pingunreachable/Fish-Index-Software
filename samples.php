<?php 
   if ($_COOKIE['user'] == "Admin") 
      echo ""; 
       
   else { 
   header ( "Location: login.php" ); } 
?> <!--php script to check valid cookies if not user will be redirected to the login page-->

<?php include 'header.php'; ?> <!--php function that called the HTML header information contains in that php file-->

    <h2>Data Entry</h2>
	
    <p class="centertxt"> <!--Insert short explaination of this page's purpose here-->
		This page allows the administrator to input, update and delete information about the area, fish or samples. Alternatively the administrator can enter all of the information relating to once session of sampling.
	</p>
 
									<!-- Insert all contents in here START--> 
									<div id="other_contents"> 


<?php if (isset($_COOKIE["user"])) {
echo "<script type='text/javascript'>
function goToNewPage()
{
	if (document.getElementById('AED').value != '')
	{
	var url = document.getElementById('AED').value;
	}
	else
	{
	var url = 'samples.php';
	}

	if (url != '')
  	{
	location.href=url;
  	}
}
</script>";

 echo "<div title=\"Select a set of data from the list in order to add, edit or delete data of that type.\"><p class =\"normaltxt\">Modify Fish, Area or Sample Information:</p></div>
<form title=\"Select a set of data from the list in order to add, edit or delete data of that type.\"><p class =\"normaltxt\" name='AEDtables' id='AEDtables'>						
	<select id='AED' name='select_AED'>
	  <option  value='' disabled selected>--Fish Data Sets--</option>	  
	  <option value='AED/habitatgroup.php'>Habitat</option>
	  <option value='AED/lifehistorygroup.php'>Life History</option>
	  <option value='AED/trophicgroup.php'>Trophic Group</option>
	  <option value='AED/species.php'>Species</option>
	  <option value='AED/speciessample.php'>Species Samples</option>
	  <option disabled>&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473</option>
	  <option disabled>--Sample Data Sets--</option>
	  <option value='AED/nearshoresample.php'>Nearshore Samples</option>
	  <option value='AED/offshoresample.php'>Offshore Samples</option>
	  <option disabled>&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473&#9473</option>
	  <option disabled>--Area Data Sets--</option>
	  <option value='AED/site.php'>Sites</option>
	  <option value='AED/zone.php'>Zones</option>	  
	</select>
<input type='button' value='Search' onclick='goToNewPage()'>
</form>";

	
 echo "<form title=\"This allows you to enter all of the information relating to a session of sampling.\" name='EnterSample' id='EnterSample'>  
</form>

<p class =\"normaltxt\">Enter data from sampling session:</p>	

<form><input type='button' name='Enter Sampling Session' value='Enter Sampling Session' onClick=location.href='AED/samplingSession.php'></form>";

} 
else { echo "<br><h3>Please Login to access Data Entry page</h3>"; } 
?>


									 </div> 
									<!-- Insert all contents in here END-->
 
 

 
<?php include 'footer.php'; ?> <!--php function that called the HTML footer information contains in that php file-->