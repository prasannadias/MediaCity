 <?php include 'chkLogin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta content="text/html; charset=UTF-8" http-equiv="content-type">
 <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php
	$mode=0;
 	if (isset($_POST['submit'])) {

				$id         = $_POST['id'];
 				$imgType      = $_POST['imgType'];
 				$Title        = $_POST['bgTitle'];
				$Desc         = $_POST['bgDesc'];

				$up = mysql_query("UPDATE BG SET IMGTYPE=$imgType,Title='$Title',Description1='$Desc' where Id=$id")or die(mysql_error());
				$mode = 2;


	}
	else {

	  $name    = "";
	  $imgtype = 1;
	  $title   = "";
	  $desc1   = "";


	 if(isset($_GET['id'])) {
		$id= $_GET['id'];
		//echo ("<br>SELECT * FROM BG where ID=$id<br>");
		$rs = mysql_query("SELECT * FROM BG where ID=$id")or die(mysql_error());
		if ( mysql_affected_rows() > 0) {
			while($info = mysql_fetch_array( $rs )) {
				$name    = $info['Name'];
				$imgtype = $info['IMGTYPE'];
				$title   = $info['Title'];
				$desc1   = $info['Description1'];
				$mode=1;
			}
		}
     }
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
<center> <h1> Edit Image information </h1> </center>
<table width=100% align=left border=0>
<tr>
	<td align=left valign=top width=300>
		<?php include 'adLinks.php'; ?>
	</td>
	<td align=left>
	 <!-- *** Content **-->
		<?php if($mode == 1) { ?>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
		<table cellspacing=0 cellpadding=10 border=0 height=200>
		<tr>
		  <td valign=top>
		   Image type
		  </td>
		  <td valign=top>
		      <select id="imgType" Name="imgType">
		   		<option value ="1" <?php if($imgtype==1) echo("selected"); ?> >Background Image</option>
		   		<option value ="2" <?php if($imgtype==2) echo("selected"); ?>>Design Image</option>
		      </select>
		  </td>
		</tr>
		<tr>
		  <td valign=top>
		   Title
		  </td>
		  <td valign=top>
		   <input type=Text Name="bgTitle" size=50  maxlength=40 value="<?php echo($title) ?>">
		  </td>
		</tr>
		<tr>
		  <td valign=top>
		   Description
		  </td>
		  <td valign=top>
		   <textarea Name="bgDesc" rows=10 cols=50 ><?php echo($desc1) ?></textarea>
		  </td>
		</tr>
		<tr>
		  <td valign=top>
		   Image Name
		  </td>
		  <td valign=top>
		   <b><?php echo($name) ?></b>
		  </td>
		</tr>
		<tr>
		  <td valign=top>
		   Image
		  </td>
		  <td valign=top>
		   <img src="../img/bg/<?php echo($name) ?>" height=300 width=400>;
		  </td>
		</tr>
		<tr>
		  <td valign=top colspan=2 align=right>
		   <input type="hidden" name="id" value="<?php echo($id) ?>">
		   <input type="submit" name="submit" value="Modify">
		  </td>
		</tr>

		</table>




		</form>
		<?php
		 }
		 if ($mode ==2)
			echo ("<br/><font color=red><center><h2>Image Modified !!!</h2></center></font>");
		?>

	 <!-- ** -->
	</td>
</tr>
</table>



</body>
</html>