<h3>Page Content</h3>
 <ul>
<?php

	$rs = mysql_query("SELECT * FROM PGS order by ID")or die(mysql_error());
	while($info = mysql_fetch_array( $rs )) {

		if ($info['ENABLED'] > 0)
			echo("<li><a href='modContent.php?pg=".$info['TEXTFILE1']."'>".$info['NAME']."</a></li>");

	}


?>
 <li><a href='publishTxt.php'>PUBLISH</a></li>
 </ul>

 <h3>Background / Design Images</h3>
 <ul>
 <li><a href='addBg.php'>Add Background / Design Images</a></li>
 <li><a href='modBg.php?imgType=1'>Modify Background Images</a></li>
 <li><a href='modBg.php?imgType=2'>Modify Design Images</a></li>
 <li><a href='assignBg.php'>Assign Background Images</a></li>
 <li><a href='publishBg.php'>PUBLISH</a></li>
 </ul>

 <br><br>
