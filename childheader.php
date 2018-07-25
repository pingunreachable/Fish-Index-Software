<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <!--php file the contains the header of the web page (used for php files that are within another directory)-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Fish Index Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="d3master/d3.min.js"></script>
<link href="mapVisual.css" rel="stylesheet" type="text/css"/>
<link href="../style.css" rel="stylesheet" type="text/css" />
    <!--<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>-->
</head>
<body>


<!--Buttons of the web page header -->
<div id="header">
  <ul>
    <li><a href="../index.php">Home</a></li>
 <?php if ($_COOKIE["user"] == "Guest" || $_COOKIE["user"] == "Admin") { echo "<li><a href='../mapvisual.php'>Map Visualization</a></li>";} ?>
 <?php if ($_COOKIE["user"] == "Guest" || $_COOKIE["user"] == "Admin") { echo "<li><a href='../graphvisual.php'>Graph Visualization</a></li>";} ?>
 <?php if ($_COOKIE["user"] == "Guest" || $_COOKIE["user"] == "Admin") { echo "<li><a href='../history.php'>Data & Metrics Query</a></li>";} ?>
 <?php if ($_COOKIE["user"] == "Admin") { echo "<li><a href='../samples.php'>Data Entry</a></li>";} ?>
<!--<li><a href="http://www.murdoch.edu.au">RESERVED</a></li>-->
<!--<li><a href="http://www.murdoch.edu.au">RESERVED</a></li>-->
    <li><a href="../aboutus.php">About Us</a></li>
  <?php if ($_COOKIE["user"] == "") { echo " <li class='last'><a href='../login.php'>Login</a></li>";} else { echo " <li class='last'><a href='../logout.php'>" . $_COOKIE["user"] . "(Logout)</a></li>";}  ?>
  </ul>
 
 <!--Title of the web page --> 
   <h1>Fish Index Software</h1>
  
  <p class="secondtext">An ICT333</br>Information Technology Project</p>
  
  
</div>

<div id="body">

  <div id="center">
 

