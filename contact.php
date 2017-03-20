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
  $fileName="./content/bgimg/bgimgcontact.txt";
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

	<?php
	 if (isset($_POST['submit'])) {

		if (!empty($_POST['myName']))
			$myName = $_POST['myName'];
		if (!empty($_POST['myEmail']))
			$myEmail = $_POST['myEmail'];
		if (!empty($_POST['myPhone']))
			$myPhone = $_POST['myPhone'];
		if (!empty($_POST['myComments']))
			$myComments = $_POST['myComments'];

		$message = "TEST";
		$message = $message."\r\n\r\n Name    :".$myName;
		$message = $message."\r\n\r\n Email   :".$myEmail;
		$message = $message."\r\n\r\n Phone   :".$myPhone;
		$message = $message."\r\n\r\n Comments:".$myComments;
		mail('clifton.gonsalves@gmail.com', 'Mail from ', $message);

		echo "<p/><p/><div class=messages><p> Thank you for contacting us. We will get back to you soon. </p></div>";




	  }
	  else {
	  	$fileName="./content/txt/contact.txt";
		if (file_exists($fileName))
		include $fileName;
	?>

		<!-- Form -->
		<div class="contactForm">
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<h3>Contact Us</h3>
			<div><span>Full Name:</span><input type="text" name="myName"></div>
			<div><span>E-mail:</span><input type="text" name="myEmail"></div>
			<div><span>Phone(optional):</span><input type="text" name="myPhone"></div>
			<div><span>Comments:</span><textarea cols="" rows="" name="myComments"></textarea></div>
			<div><input type="submit" name='submit' alt="submit" value="Submit"></div>

		</form>
		</div>
		<!-- Form -->
	<?php
	 }
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