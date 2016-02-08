<?php
	require_once('reset_password_unsub.php');
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Login</title>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400, 600' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
  	<link href='css/styles.css'rel='stylesheet' />
  </head>
  <body>
    <div class="header">
      <div class="container">
        <ul class="nav">
        	<a href="/" title="Log in">Home</a>
        	<a href="login.php" title="Log in">Login</a>
          	<a href="add_user.php" title="Register">Register</a>
            <a href="unsubscribe.php" title="Unsubscribe">Unsubscribe</a>
        	<!--<a href="comments.php" title="Contact">Contact</a>-->
            <a href="http://twitter.com/buffalomedialab" target="_blank"><img src="images/twitter_logo.png" style="padding-left: 10px;" align="right"></a>
        </ul>
        
      </div>
    </div>

    <div class="supporting">
    	<div class="container">
     	
    		<?php if (isset($_POST['cancel'])) { ?>
			<h3>Cancelled</h3>
                <p>Your request to be removed from our records has been cancelled.</p>
                <?php } elseif ($success) { ?>
                
                <h3>Record Deleted</h3>
                <p>Your details have been removed from our records. If you wish to resubscribe, please <a href="add_user.php">register</a> again.</p>
                <?php } elseif ($_SESSION['nomatch']) { ?>
                
                <h3>Error</h3>
                <p>Sorry, there was an error. Make sure you used the complete URL in the email you received. The URL can be used to change your password only once. If necessary, <a href="forgotten.php">submit another request</a>.</p>
                <?php } else { ?>
                
                <h3>Confirm Unsubscription</h3>
                <form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <p>Please confirm that you want your details removed from our records</p>
                <p>
                    <input type="submit" name="confirm" id="confirm" value="Confirm" />
		    		<input type="submit" name="cancel" id="cancel" value="Cancel" />
		  		</p>
		</form>
		<?php } ?>

		  
		</div>	
    </div>  
	
    </div>
      <div class="clearfix"></div>
    </div>
   
    <div class="footer">
   	 <div class="container">
    	 <p>&copy; 2014 Buffalo Media Lab</p>
     </div>
  	</div>
  </body>
</html>

