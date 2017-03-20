<?php
  ob_start();
  mysql_connect("127.0.0.1", "SX1", "SX1") or die(mysql_error());
  mysql_select_db("sx1") or die(mysql_error());
?>


