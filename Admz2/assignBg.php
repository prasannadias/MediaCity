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

		echo ("<font color=red>Background images assigned!!!</font>");

		foreach ($_POST as $key => $value) {

		 if(!strncmp($key, "BgImgList", strlen("BgImgList"))) {
			$PGID = substr($key,9);
			//echo ("<br>$key:$value:$PGID");
			$rs = mysql_query("SELECT ID FROM PGSBG Where PGSID=$PGID")or die(mysql_error());
			if ( mysql_affected_rows() > 0)
				$rs1 = mysql_query("UPDATE PGSBG SET PGSID=$PGID,BGID=$value Where PGSID=$PGID")or die(mysql_error());
				//echo ("<br>UPDATE PGSBG SET PGSID=$PGID,BGID=$value Where ID=$value");
			else
				$rs1 = mysql_query("INSERT INTO PGSBG (PGSID, BGID) VALUES ($PGID, $value)")or die(mysql_error());
				//echo ("<br>INSERT INTO PGSBG (PGSID, BGID) VALUES ($PGID, $value)");

			//$filename = "../content/bgimg/".htmlspecialchars($key).".txt";
			//file_put_contents($filename, '<img class="bgImg" src="./img/bg/'.$value.'" alt="" id="bgImg"/>');
         }
		}
   }

?>

<center> <h1> Assign Background images to pages</h1> </center>
<table width=100% align=left border=0>
<tr>
	<td align=left valign=top width=300>
		<?php include 'adLinks.php'; ?>
	</td>
	<td align=left>
	 <!-- *** Content **-->
<?php
		$rs = mysql_query("SELECT * FROM BG order by Seq")or die(mysql_error());
		$dropdownStr = "";
		$imgStr = "\r\n";
		$dispImg = "";
		$count = 1;
		while($info = mysql_fetch_array( $rs )) {
			$dropdownStr=$dropdownStr.'<option value ="'.$info['ID'].'">'.$info['Title'].' -- '.$info['Name'].'</option>' ;
			$imgStr = $imgStr.'var imgvar'.$info['ID'].' = "../img/bg/'.$info['Name'].'";'."\r\n";
			if ($count == 1)
			 $dispImg = $info['Name'];
			$count ++;
		}
?>
		<script type="text/javascript">
			<?php echo ($imgStr); ?>
		</script>

		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
		<table cellspacing=0 cellpadding=10 border=1 height=200>
<?php
		$rs = mysql_query("SELECT * FROM PGS order by ID")or die(mysql_error());
		while($info = mysql_fetch_array( $rs )) {
			if ($info['ENABLED'] > 0) {

			  $rs1 = mysql_query("SELECT Name FROM BG where ID in (Select BGID from PGSBG where PGSID=".$info['ID'].")")or die(mysql_error());
			  if ( mysql_affected_rows() > 0 ) {
			  	while($info1 = mysql_fetch_array( $rs1 )) {
 					$dispImg = $info1['Name'];
			  	}
			  }

              echo('<tr><td valign=top>'.$info['NAME'].'</td>');
			  echo('<td valign=top><img name ="imgname'.$info['ID'].'" id ="imgname'.$info['ID'].'" height="100" width="200" src="../img/bg/'.$dispImg.'"</td>');
			  echo('<td><fieldset><select id="BgImgList'.$info['ID'].'" name="BgImgList'.$info['ID'].'" onchange="chgImg('.$info['ID'].')">'.$dropdownStr.'</select></fieldset></td></tr>');



			}
		}
?>
		<tr><td colspan=3 align=right>
			  <input type="submit" id="submit" name="submit" value="Submit">
		</td></tr>
		</table>
		</form>
		<script type="text/javascript">
<?php
		$rs = mysql_query("SELECT * FROM PGSBG Where BGID in (Select ID from BG)")or die(mysql_error());
		while($info = mysql_fetch_array( $rs ))
			echo ('document.getElementById("BgImgList'.$info['PGSID'].'").value = '.$info['BGID'].';');
?>
		function chgImg(x)
		{
			var selobj = eval(document.getElementById("BgImgList"+x));
			var imgobj = eval(document.getElementById("imgname"+x));
			y = selobj.value;
			var newimg = window["imgvar"+y];
			imgobj.src = newimg;
		}

		</script>
	 <!-- ** -->
	</td>
</tr>
</table>

</body>
</html>