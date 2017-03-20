<?php include 'connect.php'; ?>
<!DOCTYPE html>
 <html lang="en">
 <head>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <link rel="stylesheet" href="../css/style.css">
 </head>
 <body>
 <?php
 //if the login form is submitted
 if (isset($_POST['submit']))
 {  // if form has been submitted
    // makes sure they filled it in
 	if(!$_POST['username'] | !$_POST['pass']) {
 		echo('<font color=red>You did not fill in a required field.</font>');
 	}
    else
    {
      // checks it against the database
      $check = mysql_query("SELECT * FROM LGUSER WHERE username = '".$_POST['username']."'")or die(mysql_error());

      //Gives error if user dosent exist
      $check2 = mysql_num_rows($check);

      if ($check2 == 0)
      {
 	   echo('<br><br><h1><font color=red>Login failed !!!!</font></h1>');
      }
	  //*************
	  else
	  {
          while($info = mysql_fetch_array( $check ))
          {
    		 $_POST['pass'] = stripslashes($_POST['pass']);
    		 $info['password'] = stripslashes($info['password']);
    		 $_POST['pass'] = hash('sha256', $_POST['pass']);

    		 //gives error if the password is wrong
 			 if ($_POST['pass'] != $info['password'])
 			 {
 				echo('Login failed.');
 	 		 }
     		 else
     		 {
      			//if login is ok then we add a cookie
 	  			$_POST['username'] = stripslashes($_POST['username']);
      			$hour = time() + 3600;

      			setcookie(ID_my_site, $_POST['username'], $hour);
      			setcookie(Key_my_site, $_POST['pass'], $hour);

      			//then redirect them to the members area
      			header("Location: adHome.php");
     		}
    	  }
	  }
	  //*************
   }
 }
?>
 <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
 <table border="0">
 <tr><td colspan=2><h1>Login</h1></td></tr>
 <tr><td>Username:</td><td>
 <input type="text" name="username" maxlength="40">
 </td></tr>
 <tr><td>Password:</td><td>
 <input type="password" name="pass" maxlength="50">
 </td></tr>
 <tr><td colspan="2" align="right">
 <input type="submit" name="submit" value="Login">
 </td></tr>
 </table>
 </form>
</body>
</html>