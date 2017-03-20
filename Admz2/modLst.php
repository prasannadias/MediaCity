<?php include 'chkLogin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta content="text/html; charset=UTF-8" http-equiv="content-type">
 <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include 'paginator.php'; ?>
<?php
	//Move Delete
	if ( isset($_GET['bgid'])) {
		$id = htmlspecialchars($_GET['bgid']);
		if (is_numeric($id)) {

		    $rs = mysql_query("SELECT * From LST where Id=$id")or die(mysql_error());
			while($info = mysql_fetch_array( $rs )) {
			 $Filename='../img/lst/'.$info['Name'];
			 $sequence= $info['Seq'];
			}
			if ( mysql_affected_rows() > 0) {
				$del = mysql_query("delete From LST where Id=$id")or die(mysql_error());
				if (mysql_affected_rows() > 0) {
					unlink($Filename);
		    		echo ("<br><font color=red>Image Deleted !!!!.</font><br>");
		    	    //Update Sequence , Move all one up.
		    	    $maxSequence   = mysql_result(mysql_query("SELECT MAX(SEQ) From LST"), 0);
					for ($i = $sequence; $i < $maxSequence ; $i++) {
						$oldSeq = $i + 1;
						$newSeq = $i;
						$update = mysql_query("update lst set Seq=$newSeq where Seq=$oldSeq")or die(mysql_error());
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
			$rs1 = mysql_query("SELECT Seq From LST where Id=$bgidup")or die(mysql_error());
			while($info = mysql_fetch_array( $rs1 )) {
				$curSeq= $info['Seq'];
			}
			if ( $curSeq > 1 ) {
				$newSeq = $curSeq - 1;
			   //Find img with new Sequence
			   $rs2 = mysql_query("SELECT Id From LST where Seq=$newSeq")or die(mysql_error());
			   while($info = mysql_fetch_array( $rs2 )) {
			   		$existingId= $info['Id'];
			   }
			   $up1 = mysql_query("update LST set Seq=$newSeq where Id=$bgidup")or die(mysql_error());
			   $up2 = mysql_query("update LST set Seq=$curSeq where Id=$existingId")or die(mysql_error());
			}
	   }
	}
	//Move down
	else if ( isset($_GET['bgiddown'])) {
		$bgiddown = htmlspecialchars($_GET['bgiddown']);
		if (is_numeric($bgiddown)) {

			//Get total rows
			$maxSeq   = mysql_result(mysql_query("SELECT MAX(SEQ) From LST"), 0);

			//Get Curr Seq
			$rs1 = mysql_query("SELECT Seq From LST where Id=$bgiddown")or die(mysql_error());
			while($info = mysql_fetch_array( $rs1 )) {
				$curSeq= $info['Seq'];
			}
			if ( $curSeq < $maxSeq ) {
				$newSeq = $curSeq + 1;
			   //Find img with new Sequence
			   $rs2 = mysql_query("SELECT Id From LST where Seq=$newSeq")or die(mysql_error());
			   while($info = mysql_fetch_array( $rs2 )) {
			   		$existingId= $info['Id'];
			   }
			   $up1 = mysql_query("update LST set Seq=$newSeq where Id=$bgiddown")or die(mysql_error());
			   $up2 = mysql_query("update LST set Seq=$curSeq where Id=$existingId")or die(mysql_error());
			}

		}
	}



?>

<center> <h1> Configure Design images </h1> </center>

<table width=100% align=left border=0>
<tr>
	<td align=left valign=top width=300>
		<?php include 'adLinks.php'; ?>
	</td>
	<td align=left>

<?php

	$allrows   = mysql_result(mysql_query("SELECT Count(*) From LST"), 0);
	if (empty($_GET['ipp']))
		$_GET['ipp'] = "";

	if (empty($_GET['page']))
		$_GET['page'] = 1;

	$pages = new Paginator;
	$pages->items_total = $allrows;
	$pages->mid_range = 9;
	$pages->paginate();

?>

		<table cellspacing=10 cellpadding=20 border=0>
		<tr>
		<td>
		<?php
			echo $pages->display_pages();
		?>
		</td>
		<td>
		<?php
			echo "Page $pages->current_page of $pages->num_pages";
		?>
		</td>
		</tr>
		</table>
		<table cellspacing=0 cellpadding=5 border=1>
		<tr>
		 <td width=15><b>Id</b></td>
		 <td width=15><b>Sequence</b></td>
		 <td width=50><b>Name</b></td>
		 <td width=50><b>Thumbnail</b></td>
		 <td width=80><b>Title</b></td>
		 <td width=80><b>Address</b></td>
		 <td width=80><b>Description</b></td>
		 <td width=35><b>Delete</b></td>
		 <td width=15><b>Up</b></td>
		 <td width=15><b>Down</b></td>
		</tr>
<?php

	$rs = mysql_query("SELECT * From LST order by Seq $pages->limit")or die(mysql_error());
    $total = mysql_affected_rows();
    $count = 1;

   	$last=false;
	while($info = mysql_fetch_array( $rs )) {

    	$first=false;
		if($count == 1 && (int)$_GET['page']==1)
			$first = true;

		if ($allrows == ( (((int)$_GET['page']-1) * $pages->items_per_page) + $count) )
			$last = true;

		echo ('<tr>');
		echo ('<td>'.$info['ID'].'</td>');
		echo ('<td>'.$info['Seq'].'</td>');
		echo (' <td>'.$info['Name'].'</td>');
		echo (' <td><img src="../img/lst/'.$info['Name'].'" height=60 width=60></td>');
		echo (' <td>'.$info['Title'].'</td>');
		echo (' <td>'.$info['Address'].'</td>');
		echo (' <td>'.$info['Description1'].'</td>');

		echo (' <td>');
		 if ( $total > 1 )
		  echo('<a href="modLst.php?bgid='.$info['ID'].'">Delete</a>');
		echo ('</td>');

		echo (' <td>');
		if ( !$first)
			echo ('<a href="modLst.php?bgidup='.$info['ID'].'"><img src="../img/up.jpg" border=0></a>');
		echo ('</td>');


		echo (' <td>');
		if ( !$last )
			echo ('<a href="modLst.php?bgiddown='.$info['ID'].'"><img src="../img/down.jpg" border=0></a>');
		echo ('</td>');

		echo ('</tr>');

		$count = $count + 1;

	}

?>
		</table>
				<table cellspacing=0 cellpadding=20 border=0>
				<tr>
				<td>
				<?php
					echo $pages->display_pages();
				?>
				</td>
				<td>
				<?php
					echo "Page $pages->current_page of $pages->num_pages";
				?>
				</td>
				</tr>
		</table>
	</td>
</tr>
</table>

<br><br><br><br>
</body>
</html>