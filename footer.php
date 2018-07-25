<!--php file the contains the footer of the web page-->
  </div>

</div>


<!--Buttons of the web page footer -->
<div id="footer">
  <ul>
    <li><a href="index.php">Home</a>|</li>
 <?php if ($_COOKIE["user"] == "Guest" || $_COOKIE["user"] == "Admin") { echo "<li><a href='mapvisual.php'>Map Visualization</a></li>";} ?>
 <?php if ($_COOKIE["user"] == "Guest" || $_COOKIE["user"] == "Admin") { echo "<li><a href='graphvisual.php'>Graph Visualization</a></li>";} ?>
 <?php if ($_COOKIE["user"] == "Guest" || $_COOKIE["user"] == "Admin") { echo "<li><a href='history.php'>Data & Metrics Query</a></li>";} ?>
 <?php if ($_COOKIE["user"] == "Admin") { echo "<li><a href='samples.php'>Data Entry</a></li>";} ?>
<!--<li><a href="http://www.murdoch.edu.au">RESERVED</a></li>-->
<!--<li><a href="http://www.murdoch.edu.au">RESERVED</a></li>-->
    <li><a href="aboutus.php">About Us</a>|</li>
  <?php if ($_COOKIE["user"] == "") { echo " <li class='last'><a href='login.php'>Login</a></li>";} else { echo " <li class='last'><a href='logout.php'>" . $_COOKIE["user"] . "(Logout)</a></li>";}  ?>
  </ul>

  <img src="images/Murdoch_logo2.jpg" alt="Murdoch University Logo" border="0" class="logo" />
  
<p class="copyright">&copy;FIS Consultancy 2014. Murdoch University.</p>

<p class="design">Original HTML/CSS Template Designed By : <a href="http://www.templateworld.com">Template World</a></p>

<p class="info">This website is best viewed at 1366x768 resolution using the Mozilla Firefox web browser.</p>
 
</div>
</body>
</html>