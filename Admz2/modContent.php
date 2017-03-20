<?php include 'chkLogin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta content="text/html; charset=UTF-8" http-equiv="content-type">
 <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<center> <h1> Modify Content </h1> </center>

<table width=100% align=left border=0>
<tr>
	<td align=left valign=top width=300>
		<?php include 'adLinks.php'; ?>
	</td>
	<td align=left valign=top>
	<?php
		if (isset($_POST['submit'])) {
			echo ("<center> <h1> Content Modified</h1> Do Click on PUBLISH link to publish the contents.</center> ");
			$filename = "../content/draft/txt/".htmlspecialchars($_POST['pg']);
			file_put_contents($filename, $_POST['content']);
		}
		else if ( isset($_GET['pg'])) {
			$filename = "../content/draft/txt/".htmlspecialchars($_GET['pg']);
			$str = "Add Contents";
			if (file_exists($filename))
				$str = file_get_contents($filename);
	?>
	 <!-- *** Content **-->
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

	<form  <?php echo $_SERVER['PHP_SELF']?>" method="post" >
    	<textarea name="content" cols=10 rows=30><?php echo $str ?></textarea>
    	<br><br>
    	<input type="hidden" name="pg" value="<?php echo ($_GET['pg']) ?>">
    	<input type="submit" name="submit" value="Submit">
	</form>


	<?php
	}
	?>


	 <!-- ** -->
	</td>
</tr>
</table>


</body>
</html>
