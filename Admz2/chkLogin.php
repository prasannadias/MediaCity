<?php include 'connect.php'; ?>
<?php
if (!empty($_SERVER['HTTP_REFERER'])) {
	$ref = $_SERVER['HTTP_REFERER'];
	$refData = parse_url($ref);
	if($refData['host'] !== $_SERVER['SERVER_NAME'])
	 die("");
}
else
 die("");

//Checks if there is a login cookie
if(isset($_COOKIE['ID_my_site']))
{
  $username = $_COOKIE['ID_my_site'];
  $pass = $_COOKIE['Key_my_site'];

  $check = mysql_query("SELECT * FROM LGUSER WHERE username = '$username'")or die(mysql_error());
  while($info = mysql_fetch_array( $check )) {
  	if ($pass != $info['password']) {
		header("Location: lgform.php");
		die();
  	}
  }
}
else {
 header("Location: lgform.php");
 die();
}
?>
