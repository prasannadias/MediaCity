<?php include 'chkLogin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta content="text/html; charset=UTF-8" http-equiv="content-type">
 <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<table width=100% align=left border=0>
<tr>
	<td align=left valign=top width=300>
		<?php include 'adLinks.php'; ?>
	</td>
	<td align=left>
	 <!-- *** Content **-->

<?php
	$srcFolder ="../content/draft/txt/*";
	$dstFolder ="../content/txt/";
	shell_exec("cp -r $srcFolder $dstFolder");
?>

 <cener><h2>Content published</h2></center>

	 <!-- ** -->
	</td>
</tr>
</table>


</body>
</html>
