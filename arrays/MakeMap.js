
// Create the Google Map
// Center it's coordinate to Swan River, Perth
// Zoom the map to 11 so the entire estuary is visible
var map = new google.maps.Map(d3.select("#map").node(), {
  zoom: 11,
  center: new google.maps.LatLng(-31.9536111, 115.90333333333333),
  mapTypeId: google.maps.MapTypeId.TERRAIN
});

//Following will obtain the value from the drop down box
// values obtained are Summer or Autumn in string
var scriptPram = document.getElementById('season');
var season = scriptPram.getAttribute('sample_type');
var siteCode = scriptPram.getAttribute('site_code');

//create Google map overlay to diaplay map
var overlay = new google.maps.OverlayView();

// call function for drawing map
drawMap(season, siteCode);

// function: drawMap
// parameter(s):	season value in string: SU_AU
//	      	site_code in string: siteCode;
// Author: Yasuhiro Tamura
// When it obtains the season value from the dropdown box, the function will access the json data
// from the php file to display sites and index score on to the google map. 
function drawMap(SU_AU, siteCode){
d3.json("mapData.php", function(data) {
  
//if the season value did not returned the value, it will automatically 
//assign season to summer.  
if(SU_AU == "")
{
	SU_AU = "Summer";
}


//remove whitespace at the beginning or at the end

siteCode = siteCode.trim();
if((siteCode == "")||(siteCode == null))
{
	siteCode = "All";
}

// Empty arrays and integers to keep iteration in check;
var Site = [];
var SummerSet = [];
var AutumnSet = [];
var i = 0;
var j = 0;

//forEach will iterate through all dataset in the php file so user can do whatever
//they want to data.
	 data.forEach(function(d) {
		//convert date to actual date class for all data
		d.date = new Date(d.date);

		//convert latitude and longitude to decimal format
		d.latitude = parse_gpsLat(d.latitude);
       		d.longitude = parse_gps(d.longitude);
		
		
		//assign data to Summer set data array when month is before April.
		if(d.date.getMonth()+1 < 3 )
		{
			SummerSet[i] = {
				index_score:d.Final_Index_Score,	
				latitude:d.latitude,
				longitude:d.longitude,
				date:d.date,
				site_code:d.site_code				
			};
			i++;
		}
	
		//same as if-statement above but this time displaying Autumn data
		if(d.date.getMonth()+1 >= 3 )
		{
			AutumnSet[j] = {
				index_score:d.Final_Index_Score,	
				latitude:d.latitude,
				longitude:d.longitude,
				date:d.date,
				site_code:d.site_code		
				
			};
			j++;
		}		
   	 });

	//if user selects Summer on dropdown box it 	
	if(SU_AU == "Summer")
	{	
		//if user did not selected specific site; draw all sites
		if(siteCode != "All")
		{
			for(var s = 0; s < SummerSet.length; s++)
			{
				//if the site code matches in the array
				if(siteCode == SummerSet[s].site_code)
				{
					//assign that data to empty array
					Site =  [SummerSet[s]];	
					console.log(Site);
				}
					
			}

			if(Site == [])
			{
				alert("Site data does not exist");
			}
			else
				drawOnMap(Site);
				//draw that single site
				
		}
		else
			// draw all site on summer season
			drawOnMap(SummerSet);
	}
	
	if(SU_AU == "Autumn")
	{	
		if(siteCode != "All")
		{
			console.log(siteCode);
			for(var s = 0; s < AutumnSet.length; s++)
			{
				if(siteCode == AutumnSet[s].site_code)
				{
					Site = [AutumnSet[s]];
					console.log(Site);
				}
			}
			
			if(Site == [])
			{
				alert("Site data does not exist");
			}
			else
				drawOnMap(Site);
		}
		else
			drawOnMap(AutumnSet);
	}

	//parse_gps(input)
	//input: longitude in [degrees,min,sec]
	//Author: John
	//This function will convert the GPS coordinate in degrees, minutes and seconds
	//format onto the decimals which is compatible for google API function:
	//google.maps.LatLng(Latitude, Longitude)
 	function parse_gps( input ) {
		var parts = input.split(',');
		var D = parts[0];
		var M = parts[1];
		var S = parts[2];
		var dec = parseFloat(D) + parseFloat(M/60) + parseFloat(S/(60*60));

		return dec;
   	}
	
	//parse_gps(input)
	//input: latitude in [degrees,min,sec]
	//Author: John
	//This function will convert the GPS coordinate in degrees, minutes and seconds
	//format onto the decimals which is compatible for google API function:
	//google.maps.LatLng(Latitude, Longitude)
	//the only difference is that the returned latitude in converted in negative
	function parse_gpsLat( input ) {
		var parts = input.split(',');
		var D = parts[0];
		var M = parts[1];
		var S = parts[2];
		var dec = parseFloat(-D) + parseFloat(-M/60) + parseFloat(-S/(60*60));
		
		return dec;
    	}

	// Bind our overlay to the map
	overlay.setMap(map);
	});
}
	
//function: drawOnMap
//parameter (array of objects; [object])
//draws the SVG (scalar vector graphics) on google map overlay from the data sent from   
//DrawMap(season, site_code) function. 
//This function wil handle all drawing and data visualization
 function drawOnMap(d_Data)
 {

  overlay.onAdd = function() {
    var layer = d3.select(this.getPanes().overlayMouseTarget).append("div")
        .attr("class", "sites");
		
 
    // Draw each marker as a separate SVG element.	
    overlay.draw = function() {
     	 var projection = this.getProjection(),
          padding = 10;
		  
	var circle_Rad = 3.5; // radius of dots on the map
	
     	 var marker = layer.selectAll("svg")
          .data(d3.entries(d_Data))
          .each(transform) // update existing markers
        .enter().append("svg:svg")
          .each(transform)
          .attr("class", "marker");
		  
	// Add a circle
	 marker.append("svg:circle")
          .attr("r", circle_Rad)
          .attr("cx", padding)
          .attr("cy", padding)
		  .on("mouseover", MouseOVER_Expand)	// this says "every time one of these circles is moused over, use this function
		.on("click", function(d){
				//check if site code is from NearShore or OffShore to grade
				//with correct scoring.
				if(d.value.site_code.slice(-1).toUpperCase() == "G")
				{
					OSGrade(d.value.index_score); 
				}
				else
					NSGrade(d.value.index_score);
						
			})
		  .on("mouseout", MouseOUT_Extract);
      // Add a label.
      marker.append("svg:text")
          .attr("x", padding + 7)
          .attr("y", padding)
          .attr("dy", ".31em")
          .text(function(d) { return d.value.site_code;});
		  
		//function: MouseOver_Expand
		//parameter: d (data derived from drawOnMap([object]))
		//when mouse is over the dots on map, it will expand the radius to notify user
		//which site has been selected
		function MouseOVER_Expand(d){
				 d3.select(this).transition()
                            		.duration(100)
                            		.attr("r",circle_Rad * 2) //increase the size of circle upon hovering mouse over
			}
		
		//function: MouseOUT_Extract
		//parameter: N/A
		//revert the change made on MouseOver_Expand function
		function MouseOUT_Extract(){
				d3.select(this).transition()
                            		.duration(100)
                           		.attr("r",circle_Rad) // sets the size back to it is
			}
		
		//function: OSGrade
		//parameter: OSindex_score 
		//give appropriate grade depending on the index score on OffShore sites (hense OS)
		function OSGrade(OSindex_score)
		{
			var grade = "";
			if(OSindex_score > 70.7)
			{
				alert("Score: " + OSindex_score + "\nGrade: A");
				return "A";
			}			

			if((OSindex_score > 58.4) && (OSindex_score <= 70.7))
			{
				alert("Score: " + OSindex_score + "\nGrade: B");
				return "B";
			}

			if((OSindex_score > 50.6)  && (OSindex_score <= 58.4))
			{
				alert("Score: " + OSindex_score + "\nGrade: C");
				return "C";
			}

			if((OSindex_score > 36.8) && (OSindex_score <= 50.6))
			{
				alert("Score: " + OSindex_score + "\nGrade: D");
				return "D";
			}

			if(OSindex_score < 36.8)
			{
				alert("Score: " + OSindex_score + "\nGrade: E");
				return "E";
			}
			
			return "No Grade";
		}
	
		//function: NSGrade
		//parameter: NSindex_score 
		//give appropriate grade depending on the index score on NearShore sites (hense NS)
		function NSGrade(NSindex_score)
		{
			var grade = "";

			if(NSindex_score > 74.5)
			{	
				alert("Score: " + NSindex_score + "\nGrade: A");
				return "A";
			}			

			if((NSindex_score > 64.6) && (NSindex_score <= 74.5))
			{
				alert("Score: " + NSindex_score + "\nGrade: B");
				return "B";
			}

			if((NSindex_score > 57.1) && (NSindex_score <= 64.6))
			{
				alert("Score: " + NSindex_score + "\nGrade: C");
				return "C";
			}

			if((NSindex_score > 45.5) && (NSindex_score <= 57.1))
			{
				alert("Score: " + NSindex_score + "\nGrade: D");
				return "D";
			}

			if(NSindex_score < 45.5)
			{
				alert("Score: " + NSindex_score + "\nGrade: E");
				return "E";
			}
			
			return "No Grade";
		}
 	
	//function: transform
	//parameter: d (derived data from drawOnMap function)
	//monitor the SVG dots drawn and prevent them from moving
	//even zoom or padding has changed upon user interaction.
      	function transform(d) {
        	d = new google.maps.LatLng(d.value.latitude, d.value.longitude);
        	d = projection.fromLatLngToDivPixel(d);

       	 	return d3.select(this)
            		.style("left", (d.x - padding) + "px")
           		 .style("top", (d.y - padding) + "px");
			
			
      }
    };
  };
}
 
  
  