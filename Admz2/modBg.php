<?php include 'chkLogin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta content="text/html; charset=UTF-8" http-equiv="content-type">
 <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php

	//Will return the next/before sequence of given seq.
	//$curr = given sequence
	//$dir = 1:up , 2:down
	//$imgType = 1:bg, 2:des
	function getSeq($curr, $dir, $imgtype) {
	  $intSeq=-1;
	  $strQuery = "SELECT Seq FROM BG WHERE IMGTYPE=$imgtype  ";
	  if($dir == 1)
		 $strQuery = $strQuery."AND Seq < $curr ORDER BY Seq DESC ";
	  else
		 $strQuery = $strQuery."AND Seq > $curr ORDER BY Seq ASC ";
	  $strQuery = $strQuery." LIMIT 1 ";
	  //echo "<br>".$strQuery. "<br>";
	  $rs = mysql_query($strQuery)or die(mysql_error());
	  if ( mysql_affected_rows() > 0) {
			while($info = mysql_fetch_array( $rs )) {
				$intSeq =  $info['Seq'];
			}
	  }
	  return $intSeq;
	}

	$imgType=1;
	$strCaption = "Background";
	if ( isset($_GET['imgType'])) {
		$imgType = $_GET['imgType'];
		if ($imgType == 2)
			$strCaption = "Design";
	}

	//Move Delete
	if ( isset($_GET['bgid'])) {
		$id = htmlspecialchars($_GET['bgid']);
		if (is_numeric($id)) {

		    $rs = mysql_query("SELECT * FROM BG where Id=$id AND imgType=$imgType")or die(mysql_error());
			while($info = mysql_fetch_array( $rs )) {
			 $Filename='../img/bg/'.$info['Name'];
			 $sequence= $info['Seq'];
			}
			if ( mysql_affected_rows() > 0) {
				$del = mysql_query("delete FROM BG where Id=$id  AND imgType=$imgType")or die(mysql_error());
				if (mysql_affected_rows() > 0) {
					unlink($Filename);
		    		echo ("<br><font color=red>Image Deleted !!!!.</font><br>");
		    	    //Update Sequence , Move all one up.
		    	    $maxSequence   = mysql_result(mysql_query("SELECT MAX(SEQ) FROM BG  WHERE imgType=$imgType"), 0);
					for ($i = $sequence; $i < $maxSequence ; $i++) {
						$oldSeq = $i + 1;
						$newSeq = $i;
						$update = mysql_query("update BG set Seq=$newSeq where Seq=$oldSeq  AND imgType=$imgType")or die(mysql_error());
  				   }
		    	}
		    }
		}
	}
	//Move up
	else if ( isset($_GET['bgidup'])) {
		$bgidup = htmlspecialchars($_GET['bgidup']);
		if (is_numeric($bgidup)) {
			//Get Curr Seq
			$rs1 = mysql_query("SELECT Seq FROM BG where Id=$bgidup  AND imgType=$imgType")or die(mysql_error());
			while($info = mysql_fetch_array( $rs1 )) {
				$curSeq= $info['Seq'];
			}
			if ( $curSeq > 1 ) {
				//$newSeq = $curSeq - 1;
				$newSeq = getSeq($curSeq, 1, $imgType);
			   //Find img with new Sequence
			   $rs2 = mysql_query("SELECT Id FROM BG where Seq=$newSeq AND imgType=$imgType")or die(mysql_error());
			   if ( mysql_affected_rows() > 0) {
			   	while($info = mysql_fetch_array( $rs2 )) {
			   			$existingId= $info['Id'];
			   	}
			   	//echo ("<br>update BG set Seq=$newSeq where Id=$bgidup     AND imgType=$imgType");
			   	//echo ("<br>update BG set Seq=$curSeq where Id=$existingId AND imgType=$imgType ");
			   	$up1 = mysql_query("update BG set Seq=$newSeq where Id=$bgidup     AND imgType=$imgType")or die(mysql_error());
			   	$up2 = mysql_query("update BG set Seq=$curSeq where Id=$existingId AND imgType=$imgType")or die(mysql_error());
			   }
			}
	   }
	}
	//Move down
	else if ( isset($_GET['bgiddown'])) {
		$bgiddown = htmlspecialchars($_GET['bgiddown']);
		if (is_numeric($bgiddown)) {

			//Get total rows
			echo("<br>SELECT MAX(SEQ) FROM BG  WHERE imgType=$imgType");
			$maxSeq   = mysql_result(mysql_query("SELECT MAX(SEQ) FROM BG  WHERE imgType=$imgType"), 0);

			//Get Curr Seq
			echo ("SELECT Seq FROM BG where Id=$bgiddown  AND imgType=$imgType");
			$rs1 = mysql_query("SELECT Seq FROM BG where Id=$bgiddown  AND imgType=$imgType")or die(mysql_error());
			while($info = mysql_fetch_array( $rs1 )) {
				$curSeq= $info['Seq'];
			}
			if ( $curSeq < $maxSeq ) {
				//$newSeq = $curSeq + 1;
				$newSeq = getSeq($curSeq, 2, $imgType);
			   //Find img with new Sequence
			   echo ("<br>SELECT Id FROM BG where Seq=$newSeq  AND imgType=$imgType");
			   $rs2 = mysql_query("SELECT Id FROM BG where Seq=$newSeq  AND imgType=$imgType")or die(mysql_error());
			   if ( mysql_affected_rows() > 0) {
			   		while($info = mysql_fetch_array( $rs2 )) {
			   			$existingId= $info['Id'];
			   		}
			   	//echo ("update BG set Seq=$newSeq where Id=$bgiddown   AND imgType=$imgType");
			   	//echo ("<br>update BG set Seq=$curSeq where Id=$existingId AND imgType=$imgType");
			   	$up1 = mysql_query("update BG set Seq=$newSeq where Id=$bgiddown   AND imgType=$imgType")or die(mysql_error());
			   	$up2 = mysql_query("update BG set Seq=$curSeq where Id=$existingId AND imgType=$imgType")or die(mysql_error());
			   }
			}

		}
	}
?>

<center> <h1> Configure <?php echo ($strCaption) ?> images </h1> </center>

<table width=100% align=left border=0>
<tr>
	<td align=left valign=top width=300>
		<?php include 'adLinks.php'; ?>
	</td>
	<td align=left>

		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
		<table cellspacing=0 cellpadding=5 border=1>
		<tr>
		 <td width=15><b>Id</b></td>
		 <td width=15><b>Sequence</b></td>
		 <td width=50><b>Name</b></td>
		 <td width=50><b>Thumbnail</b></td>
		 <td width=80><b>Title</b></td>
		 <td width=35><b>Delete</b></td>
		 <td width=15><b>Up</b></td>
		 <td width=15><b>Down</b></td>
		 <td width=15><b>Edit</b></td>
		</tr>
<?php
	$rs = mysql_query("SELECT * FROM BG WHERE imgType=$imgType order by Seq  ")or die(mysql_error());
    $total = mysql_affected_rows();
    $count = 1;
	while($info = mysql_fetch_array( $rs )) {


		echo ('<tr>');
		echo ('<td>'.$info['ID'].'</td>');
		echo ('<td>'.$info['Seq'].'</td>');
		echo (' <td>'.$info['Name'].'</td>');
		echo (' <td><img src="../img/bg/'.$info['Name'].'" height=100 width=200></td>');
		echo (' <td>'.$info['Title'].'</td>');
		echo (' <td>');
		 if ( $total > 1 )
		  echo('<a href="modBg.php?bgid='.$info['ID'].'&imgType='.$imgType.'">Delete</a>');
		echo ('</td>');

		echo (' <td>');
		if ( $count > 1 )
			echo ('<a href="modBg.php?bgidup='.$info['ID'].'&imgType='.$imgType.'"><img src="../img/up.jpg" border=0></a>');
		echo ('</td>');


		echo (' <td>');
		if ( $count < $total )
			echo ('<a href="modBg.php?bgiddown='.$info['ID'].'&imgType='.$imgType.'"><img src="../img/down.jpg" border=0></a>');
		echo ('</td>');

		echo (' <td>');
		echo('<a href="editBg.php?id='.$info['ID'].'&imgType='.$imgType.'">Edit</a>');
		echo ('</td>');

		echo ('</tr>');

		$count = $count + 1;

	}

?>
		</table>

	</td>
</tr>
</table>

<br/><br/>
</form>
</body>
</html>