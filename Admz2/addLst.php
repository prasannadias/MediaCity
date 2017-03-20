 <?php include 'chkLogin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta content="text/html; charset=UTF-8" http-equiv="content-type">
 <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php

 	if (isset($_POST['submit'])) {
 		if (!empty($_FILES["lstFile"]) && !empty($_POST['lstTitle']) && !empty($_POST['lstDesc']) ) {


 			$fieSize = (int)$_FILES["lstFile"]["size"];

 			if($fieSize > 0 ) {
 				$Title        = $_POST['lstTitle'];
				$Desc         = $_POST['lstDesc'];

				$Addr ="";
				if(!empty($_POST['lstTitle']))
					$Addr         = $_POST['lstAddr'];

				$maxseqid        = mysql_result(mysql_query("SELECT MAX(SEQ) FROM LST"), 0);
				$maxseqid        = $maxseqid + 1;

				$maxid        = mysql_result(mysql_query("SELECT MAX(ID) FROM LST"), 0);
				$maxid        = $maxid + 1;
				$imgName      = 'lst'.$maxid.'.jpg';

				$tmpImgname   = $_FILES["lstFile"]["tmp_name"];

	  			//echo "Upload: " . $_FILES["bgFile"]["name"] . "<br>";
	   			//echo "Type: " . $_FILES["bgFile"]["type"] . "<br>";
	   			//echo "Size: " . ($_FILES["bgFile"]["size"] / 1024) . " kB<br>";
	   			//echo "Stored in: " . $_FILES["bgFile"]["tmp_name"];

				$success = move_uploaded_file($tmpImgname, "../img/lst/".$imgName);
		    	if ($success) {

				$check = mysql_query("INSERT into LST (`Name`,`Seq`,`Title`, `Address`, `Description1`,`Description2` ) VALUES ('$imgName',$maxseqid, '$Title', '$Addr', '$Desc', '') ")or die(mysql_error());

				if ($check)
					echo ("<font color=red>List added !!!</font>");
    			}



	   		}

		}
		else
		echo ("<font color=red>All fields are mandatory !!!</font>");



	}


?>




<center> <h1> Add Design images </h1> </center>
<table width=100% align=left border=0>
<tr>
	<td align=left valign=top width=300>
		<?php include 'adLinks.php'; ?>
	</td>
	<td align=left>
	 <!-- *** Content **-->

		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
		<table cellspacing=0 cellpadding=10 border=0 height=200>
		<tr>
		  <td valign=top>
		   Title
		  </td>
		  <td valign=top>
		   <input type=Text Name="lstTitle" size=50  maxlength=40 value=a>
		  </td>
		</tr>
		<tr>
		  <td valign=top>
		   Address
		  </td>
		  <td valign=top>
		   <textarea Name="lstAddr" rows=5 cols=40 >a</textarea>
		  </td>
		</tr>
		<tr>
		  <td valign=top>
		   Description
		  </td>
		  <td valign=top>
		   <textarea Name="lstDesc" rows=10 cols=50 >a</textarea>
		  </td>
		</tr>
		<tr>
		  <td valign=top>
		   Image
		  </td>
		  <td valign=top>
		   <input type=file Name="lstFile">
		  </td>
		</tr>
		<tr>
		  <td valign=top colspan=2 align=right>
		   <input type="submit" name="submit" value="Upload">
		  </td>
		</tr>

		</table>




		</forM

	 <!-- ** -->
	</td>
</tr>
</table>

</body>
</html>