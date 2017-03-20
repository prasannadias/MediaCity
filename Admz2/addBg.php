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
 		if (!empty($_FILES["bgFile"]) && !empty($_POST['bgTitle']) && !empty($_POST['bgDesc']) ) {


 			$fieSize = (int)$_FILES["bgFile"]["size"];

 			if($fieSize > 0 ) {
 				$imgType      = $_POST['imgType'];
 				$Title        = $_POST['bgTitle'];
				$Desc         = $_POST['bgDesc'];
				$maxseqid        = mysql_result(mysql_query("SELECT MAX(SEQ) FROM BG"), 0);
				$maxseqid        = $maxseqid + 1;

				$maxid        = mysql_result(mysql_query("SELECT MAX(ID) FROM BG"), 0);
				$maxid        = $maxid + 1;

				$imgName      = 'bg'.$maxid.'.jpg';
				if ( $imgType == 2 ) {
					$imgName      = 'design'.$maxid.'.jpg';
				}


				$tmpImgname   = $_FILES["bgFile"]["tmp_name"];

	  			//echo "Upload: " . $_FILES["bgFile"]["name"] . "<br>";
	   			//echo "Type: " . $_FILES["bgFile"]["type"] . "<br>";
	   			//echo "Size: " . ($_FILES["bgFile"]["size"] / 1024) . " kB<br>";
	   			//echo "Stored in: " . $_FILES["bgFile"]["tmp_name"];

				$success = move_uploaded_file($tmpImgname, "../img/bg/".$imgName);
		    	if ($success) {

				$check = mysql_query("INSERT into BG (`Name`,`Seq`,`Title`,`Description1`,`Description2`,`IMGTYPE` ) VALUES ('$imgName',$maxseqid, '$Title', '$Desc', '', $imgType) ")or die(mysql_error());

				if ($check)
					echo ("<font color=red>Image added !!!</font>");
    			}



	   		}

		}
		else
		echo ("<font color=red>All fields are mandatory !!!</font>");



	}


?>


<script type="text/javascript" src="./util/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({
	selector: "textarea",
	plugins: [
	"advlist autolink lists link image charmap print preview anchor",
	"searchreplace visualblocks code fullscreen",
	"textcolor",
	"insertdatetime media table contextmenu paste moxiemanager"
	],
	fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
</script>

<center> <h1> Add Background images </h1> </center>
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
		   Image type
		  </td>
		  <td valign=top>
		      <select id="imgType" Name="imgType">
		   		<option value ="1">Background Image</option>
		   		<option value ="2">Design Image</option>
		      </select>
		  </td>
		</tr>
		<tr>
		  <td valign=top>
		   Title
		  </td>
		  <td valign=top>
		   <input type=Text Name="bgTitle" size=50  maxlength=40 value="Title">
		  </td>
		</tr>
		<tr>
		  <td valign=top>
		   Description
		  </td>
		  <td valign=top>
		   <textarea Name="bgDesc" rows=10 cols=50 >Description</textarea>
		  </td>
		</tr>
		<tr>
		  <td valign=top>
		   Image
		  </td>
		  <td valign=top>
		   <input type=file Name="bgFile">
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