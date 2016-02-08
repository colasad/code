<?php

	require_once('request_reset_unsub.php');

?>
<!DOCTYPE html>
<html>
  <head>
  <title>Unsubscribe</title>
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
     	    			             
               <?php if ($result) {?>
					<h3>Request Received</h3>
					<p>A message has been sent to your registered email address for confirmation. Close tab to continue.</p>
				<?php } else { ?>
                    <h3>Unsubscribe</h3>
                    
                    <form id="form1" name="form1" method="post" action="">
                      <ul>
                          <li>
                                <label class="forgotten">To unsubscribe, please enter the email address used when registering.</a></label>
                          </li>
                          <br />
                          <li>
                            <div>
                                <input type="text" name="email" id="email" size="45" />
                            </div>
                          </li>
                          <li>
                          	<div>
                            	<input type="submit" name="unsub" id="unsub" value="Submit" />
                          	</div>
                          </l1>
                      </ul>
                    </form>
                    <?php  if ($errors) { ?>
                        <p class="login_error">Sorry, there is no record of that email address on file.</p>
                    <?php }
                    }?>

		  
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
