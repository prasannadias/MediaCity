 <?php include 'chkLogin.php'; ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <link rel="stylesheet" href="../css/style.css">
 </head>
 <body>
 <?php


   	//Publish background images
   	$imgFile='../content/bgimg/bgimg.txt';
   	$txtFile='../content/bgimg/bgtxt.txt';
   	$imgStr1 = '';
   	$imgStr2 = '';
   	$imgTxt = '';
   	$count  = 1;
   	$rs = mysql_query("SELECT * FROM BG WHERE IMGTYPE=1 order by Seq")or die(mysql_error());
 	while($info = mysql_fetch_array( $rs )) {
   	   $imgStr1 = $imgStr1.'<img src="./img/bg/'.$info['Name'].'" alt="" />'."\r\n";
   	   $desc = trim(preg_replace('/\s\s+/', ' ', $info['Description1']));
	   $desc = str_replace('"','\"',$desc);
	   $title = str_replace('"','\"',$info['Title']);
 	   $imgTxt  = $imgTxt.'bgText['.$count.']= "<h2>'.$title.'</h2><p>'.$desc.' </p>";'."\r\n";
 	   $imgStr2 = $imgStr2.'bgImages['.$count.']="./img/bg/'.$info['Name'].'";'."\r\n";
        $count++;
 	}
	$imgStr2  = $imgStr2."\r\n".'totalImg = '.mysql_affected_rows().';'."\r\n";
 	$imgTxt = $imgTxt."\r\n".$imgStr2;
 	file_put_contents($imgFile,$imgStr1);
 	file_put_contents($txtFile,$imgTxt);


	//Assign bg image to each page
	$rs = mysql_query("SELECT * FROM PGS order by ID")or die(mysql_error());
	while($info = mysql_fetch_array( $rs )) {

		if ($info['ENABLED'] > 0) {
			$rs1 = mysql_query("SELECT BGID FROM PGSBG where PGSID=".$info['ID'])or die(mysql_error());
			if (mysql_affected_rows() > 0) {
				while($info1 = mysql_fetch_array( $rs1 )) {
					$rs2 = mysql_query("SELECT Name  FROM BG where ID=".$info1['BGID'])or die(mysql_error());
					if (mysql_affected_rows() > 0) {
						while($info2 = mysql_fetch_array( $rs2 )) {
							$str='<img class="bgImg" src="./img/bg/'.$info2['Name'].'" alt="" id="bgImg"/>';
							$fileName = "../content/bgimg/".$info['IMGFILE1'];
							file_put_contents($fileName,$str);
						}
					}
				}
			}
		}
	}



   	//Publish design images
   	$File1='../content/bgimg/desimg.txt';
   	$File2='../content/bgimg/desimginfo.txt';
   	$File3='../content/bgimg/desimginfotxt.txt';

   	$imgStr1 = '';
   	$imgStr2 = '';
	$imgTxt1 = '';
	$imgTxt2 = '';
   	$count   = 1 ;
   	$rs = mysql_query("SELECT * FROM BG WHERE IMGTYPE=2 order by Seq")or die(mysql_error());
 	while($info = mysql_fetch_array( $rs )) {

		//For des img
		$imgStr1 = $imgStr1.'<div class="desClass">'."\r\n";
 		$imgStr1 = $imgStr1.'<a href="stylesInfo.php?id='.$count.'"><img src="./img/bg/'.$info['Name'].'" class="desImg" alt=""></a><br/>'."\r\n";
		$imgStr1 = $imgStr1.'<a href="stylesInfo.php?id='.$count.'"> '.$info['Title'].'</a>'."\r\n";
    	$imgStr1 = $imgStr1.'</div>'."\r\n";

 	    //For des info img
	    $imgStr2 = $imgStr2.'<a href="javascript:repImg('.$count.')"><img src="./img/bg/'.$info['Name'].'" class="desImgInfoThumb" alt="'.$info['Name'].'"></a>'."\r\n";

		//For des info txt
		$desc = trim(preg_replace('/\s\s+/', ' ', $info['Description1']));
		$desc = str_replace('"','\"',$desc);
		$title = str_replace('"','\"',$info['Title']);
		$imgTxt1 = $imgTxt1.'desText['.$count.'] = "<h3>'.$title.'</h3><p>'.$desc.'</p>";'."\r\n";
		$imgTxt2 = $imgTxt2.'desImages['.$count.']    ="./img/bg/'.$info['Name'].'";'."\r\n";
		$count++;
 	}
 	$imgTxt1  = $imgTxt1.$imgTxt2;
 	file_put_contents($File1,$imgStr1);
 	file_put_contents($File2,$imgStr2);
 	file_put_contents($File3,$imgTxt1);








 ?>

 <table width=100% align=left border=0>
 <tr>
 	<td align=left valign=top width=300>
 		<?php include 'adLinks.php'; ?>
 	</td>
 	<td align=left>
 	 <!-- *** Content **-->

 		<cener><h2>Background images published</h2></center>





 	 <!-- ** -->
 	</td>
 </tr>
</table>




 </body>
</html>