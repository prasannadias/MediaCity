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
  $fileName="./content/bgimg/bgimgstyles.txt";
  if (file_exists($fileName))
	include $fileName;
?>

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

 <div class="bottom2">
 	<!--Content -->
	<div class="content2">
	<?php
	$fileName="./content/txt/styles.txt";
	if (file_exists($fileName))
		include $fileName;

	$fileName="./content/bgimg/desimg.txt";
	if (file_exists($fileName))
		include $fileName;

	?>

	<!--
	<div class="desClass">
	  <a href="stylesInfo.php?id=56"><img src="./img/bg/design56.jpg" class="desImg" alt=""></a><br/>
	  <a href="stylesInfo.php?id=56"> Design 1</a>
    </div>
	-->

	</div>
	<!--Footer -->
	<div class="footer">
		<?php include 'menu3.php'; ?>
	</div>
 </div>

</div>

</body>
</html>