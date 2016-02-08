<?php
  
  require_once('user_authentication.php');

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
     	
    		<h3>User Login</h3>
    				             
                <form id="form" name="form" method="POST">
                    <ul>
                        <li>
                            <label for="username">Username</label>
                            <div>
                                <input type="text" name="username" id="username" />
                            </div>
                        </li>
                        <l1>
                            <label for="password">Password</label>
                            <div>
                                <input type="password" name="password" id="password" />
                            </div>
                        </li>
                        <li>
                            <div>
                                <input type="submit" name="signin" id="signin" value="Submit" />
                            </div>
                        </li>
                        <li>
                            <label class="forgotten">Forgot your password? <a href="forgotten.php">Click here</a></label>
                        </li>
                    </ul>
                </form>
                
                <?php if ($failed) { ?>
              		<p class="login_error">Login failed. Please check username and password.</p>
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
