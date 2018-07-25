
//Grab the GET param
 var scriptPram = document.getElementById('mysitecode');
 var site_code = scriptPram.getAttribute('site_code');

//function: checkSite
//parameter(s): site_code
//get the site selected from the dropdown box and depending on 
//whether it is from offshore or nearshore, it will go to radarplot drawing to 
//draw appropriate axis
//if site code is not selected in any way, it will assign site code to CE1

checkSite(site_code);

function checkSite(site_code)
{
	if(site_code == "")
	{
		site_code = "CE1";
	}

	if(site_code.slice(-1).toUpperCase() == "G")
	{
		drawOSplot(site_code);
	}
	else
		drawNSplot(site_code);
	
}


//function: 
//parameter(s): var string: site_code
//draw radaplot for Nearshore site by assigning data to Summer set and Autumn set
//array manually.
//Could have done array assignment in separate function

function drawNSplot(site_code){

	d3.json("NSFinalScores.php", function(data){
		var radarplot1 = [];
		var dataset1 = [];
		data.forEach(function(d) {
			//convert date from database to appropriate date object
			d.date = new Date(d.date);
	
	
			var i, j = 0;
			if(site_code == d.site_code)
			{
				if(d.date.getMonth()+1 < 3 )
				{
					radarplot1 = [{axis:" No_species", value:d.No_species},
						{axis:"No_trop_gen", value:d.No_trop_gen},
						{axis:"No_trop_spec", value:d.No_trop_spec},
						{axis:"Prop_benthic", value:d.Prop_benthic},
						{axis:"Prop_detr", value:d.Prop_detr},
						{axis:"Prop_est_spawn", value:d.Prop_est_spawn},
						{axis:"Tot_no_P_olorum", value:d.Tot_no_P_olorum},
						];
				
					dataset1[0] = radarplot1;
				}
		
				if(d.date.getMonth()+1 > 3 )
				{
					radarplot1 = [{axis:" No_species", value:d.No_species},
						{axis:"No_trop_gen", value:d.No_trop_gen},
						{axis:"No_trop_spec", value:d.No_trop_spec},
						{axis:"Prop_benthic", value:d.Prop_benthic},
						{axis:"Prop_detr", value:d.Prop_detr},
						{axis:"Prop_est_spawn", value:d.Prop_est_spawn},
						{axis:"Tot_no_P_olorum", value:d.Tot_no_P_olorum},
					];

					dataset1[1] = radarplot1;
				}

			}

		
		});
		PlotData(dataset1);
	});
}


//function: drawOSplot
//parameter(s): site_code
//draw radaplot for Offshore site by assigning data to Summer set and Autumn set
//array manually.
//Same as drawNSplot but one of axis is different;
//	- NS: Tot_no_P_olorum
//	- OS: Shannon_Weiner

function drawOSplot(site_code){
	d3.json("OSFinalScores.php", function(data){
		var radarplot1 = [];

		var dataset1 =[];
		data.forEach(function(d) {
			//convert date from database to appropriate date object
			d.date = new Date(d.date);
	
	
			var i, j = 0;
			if(site_code == d.site_code)
			{		
				if(d.date.getMonth()+1 < 3 )
				{
					radarplot1 = [{axis:" No_species", value:d.No_species},
						{axis:"No_trop_gen", value:d.No_trop_gen},
						{axis:"No_trop_spec", value:d.No_trop_spec},
						{axis:"Prop_benthic", value:d.Prop_benthic},
						{axis:"Prop_detr", value:d.Prop_detr},
						{axis:"Prop_est_spawn", value:d.Prop_est_spawn},
						{axis:"Shannon_Weiner", value:d.Shannon_Weiner},
					];

					dataset1[0] = radarplot1;
				}
		
				if(d.date.getMonth()+1 > 3 )
				{
		
					radarplot1 = [{axis:" No_species", value:d.No_species},
						{axis:"No_trop_gen", value:d.No_trop_gen},
						{axis:"No_trop_spec", value:d.No_trop_spec},
						{axis:"Prop_benthic", value:d.Prop_benthic},
						{axis:"Prop_detr", value:d.Prop_detr},
						{axis:"Prop_est_spawn", value:d.Prop_est_spawn},
						{axis:"Shannon_Weiner", value:d.Shannon_Weiner},
					];

					dataset1[1] = radarplot1;
				}

			}
	

		});
		PlotData(dataset1);

	});
}	

//function: PlotData
//parameter(s): dataset: Array of Array of objects
//Draw the radarplot based from the dataset (2 dimensional array containing Summer and Autumn metric
//scores)

function PlotData(dataset)
{
	var LegendOptions = ["Summer", "Autumn"];
 	var colorscale = d3.scale.category10();
  	var w = 500, h = 500;
 	var mycfg = {
 		 w: w,
 		 h: h,
  		 maxValue: 10.0,
 		 levels: 10,
 		 ExtraWidthX: 300
 	}

	RadarChart.draw("#chart", dataset, mycfg);

	var svg = d3.select('#chart')
		.selectAll('svg')
		.append('svg')
		.attr("width", w+300)
		.attr("height", h);

	//Create the title for the legend
	var text = svg.append("text")
		.attr("class", "title")
		.attr('transform', 'translate(90,0)') 
		.attr("x", w - 70)
		.attr("y", 10)
		.attr("font-size", "12px")
		.attr("fill", "#404040")
		.text(""); // write something here
		
	//Initiate Legend	
	var legend = svg.append("g")
		.attr("class", "legend")
		.attr("height", 100)
		.attr("width", 200)
		.attr('transform', 'translate(90,20)') ;
		//Create colour squares
		legend.selectAll('rect')
		  .data(LegendOptions)
		  .enter()
		  .append("rect")
		  .attr("x", w - 65)
		  .attr("y", function(d, i){return i * 20;})
		  .attr("width", 10)
		  .attr("height", 10)
		  .style("fill", function(d, i){return colorscale(i);});
		//Create text next to squares
		legend.selectAll('text')
		  .data(LegendOptions)
		  .enter()
		  .append("text")
		  .attr("x", w - 52)
		  .attr("y", function(d, i){return i * 20 + 9;})
		  .attr("font-size", "11px")
		  .attr("fill", "#737373")
		  .text(function(d) {return d;});	
		  
	
	//Options for the Radar chart, other than default
	
}