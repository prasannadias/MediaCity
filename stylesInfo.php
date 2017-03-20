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
<?php
  $id=1;
  if ( isset($_GET['id']))
   $id = $_GET['id'];
?>
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
	<div class="content">

	<div class="desInfoTxt" id="desInfoTxt">
	</div>

	<div class="desClassInfo">
	  <img id="mainImg" name="mainImg" src="" class="desImgInfo" alt="">
    </div>

	<div class="desInfoThumb">
		<a href="#" onClick="arrowClicked(1)"><div id="arrowL2" class="arrowL"></div></a>
		<?php include './content/bgimg/desimginfo.txt'; ?>
		<a href="#" onClick="arrowClicked(2)"><div id="arrowR2" class="arrowR"></div></a>

	</div>

<!--
	  <a href="javascript:repImg(1)"><img src="./img/bg/design56.jpg" class="desImgInfoThumb" alt=""></a>
-->

	</div>
	<!--Footer -->
	<div class="footer">
		<?php include 'menu3.php'; ?>
	</div>
 </div>

</div>
<script type="text/javascript">
	var desText   = new Array();
	var desImages = new Array();
	<?php include './content/bgimg/desimginfotxt.txt'; ?>
	//desText[1]= "<p>Desc 56</p>";
	//desImages[1]="./img/bg/design56.jpg";
	var currId = <?php echo($id) ?>;
	document.getElementById("mainImg").src = desImages[currId];
	document.getElementById("desInfoTxt").innerHTML = desText[currId] ;
	function repImg(id) {
		document.getElementById("mainImg").src = desImages[id];
		document.getElementById("desInfoTxt").innerHTML = desText[id] ;
	}
</script>
</body>
</html>