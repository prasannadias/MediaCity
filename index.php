<!DOCTYPE html>
<html lang="en">
<head>
 <meta content="text/html; charset=UTF-8" http-equiv="content-type">
 <title>Media City Realty</title>
 <link rel="stylesheet" href="./css/style.css">
 <link rel="stylesheet" href="./css/menu1.css">
 <link rel="stylesheet" href="./css/menu2.css">
 <script type="text/javascript" src="./js/script.js"></script>
</head>
<body>

<!-- Background Images stuff-->
<?php include 'bg.php'; ?>
<?php
  $fileName="./content/bgimg/bgimgindex.txt";
  if (file_exists($fileName))
	include $fileName;
?>
<a href="#" onClick="arrowClicked(1)"><div id="arrowL" class="arrowL"></div></a>
<a href="#" onClick="arrowClicked(2)"><div id="arrowR" class="arrowR"></div></a>


<div class="board">

 <!-- Header -->
 <div class="header">
    <div class="logo"><a href="index.php"><img src="./img/logo.png" alt="Home" /></a></div>
    <div class="menuarea">
 	  <div class="menubar1">
	   <?php include 'menu1.php'; ?>
  	  </div>
  	  <div class="menubar2">
  	  	<?php include 'menu2.php'; ?>
  	  </div>
  	</div>
 </div>

 <!-- BG info -->
 <div class="bgInfo">
	<div class="bgInfotext" id="bgInfotext">
	<h2>Title1</h2><p>Description 1 </p>
	</div>
 </div>
<script type="text/javascript">
  	//document.getElementById("bgImg").src = bgImages[1];
  	//document.getElementById("bgInfotext").innerHTML = bgText[1] ;
</script>
<!-- *** -->

 <div class="bottom">
 	<!--Content -->
	<div class="content">
	<?php
	$fileName="./content/txt/index.txt";
	if (file_exists($fileName))
		include $fileName;
	?>
	</div>
	<!--Footer -->
	<div class="footer">
		<?php include 'menu3.php'; ?>
	</div>
 </div>

</div>

</body>
</html>