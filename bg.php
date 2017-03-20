<!-- **** preload all bg images *** -->
<div class="earlyLoad">
	<?php include './content/bgimg/bgimg.txt'; ?>
</div>
<!-- *** -->

<!-- **** Variables for displaying title and text of bg images *** -->
<script type="text/javascript">
	<?php
	  $fileName="./content/bgimg/bgtxt.txt";
	  if (file_exists($fileName))
		include $fileName;
	?>

  	document.getElementById("bgImg").src = bgImages[1];
  	document.getElementById("bgInfotext").innerHTML = bgText[1] ;
</script>
<!-- *** -->