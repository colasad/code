<?php

	require_once('restrict_access.php');

?>
<!DOCTYPE html>
<html>
  <head>
  <title>Registered Client Content</title>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400, 600' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
  	<link href='css/styles.css'rel='stylesheet' />
    <!-- Latest compiled and minified CSS-->
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

	<!-- Optional theme-->
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
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
        	<div class="row">
     	    		
                <h3>Client Information</h3>
                <p><strong>Contact:</strong><?php echo " " . "$identity->first_name $identity->surname"; ?> | <a href="login.php?logout" title="Log out">Logout</a><br />
                <strong>Username:</strong> <?php echo " " . "$identity->username"; ?><br />
                <strong>Email:</strong> <?php echo " " . "$identity->email"; ?></p>
                        
                <p>This content is specific to your account. Other registered users do not have access to your account information or resources.</p>
       		</div>	
            
        <div class="row">
                                             
                                                 
                        <div class="panel panel-default col-sm-4">
                            <div class="panel-heading">
                                <h4 class="panel-title">Client Resources</h4>
                            </div>
                                  
                            <div class="panel-body">
                                <p><a href="#" title="Website Documentation">Website Documentation</a></p>
                            </div>
                        </div>
                                   
                                                 
                        <div class="panel panel-default col-sm-4">
                            <div class="panel-heading">
                                <h4 class="panel-title">Support Resources</h4>
                            </div>
                           
                            <div class="panel-body">
                                <p><a href="#" title="Technical Documentation">Technical Documentation</a></p>
                            </div>
                           
                        </div>
                               
                        <div class="panel panel-default col-sm-4">
                            <div class="panel-heading">
                                <h4 class="panel-title">Work Orders</h4ß>
                            </div>
                            <div class="panel-body">
                                <p><a href="#" title="Open order status">Open Orders</a></p>
                            </div>
                        </div>
                                    
      	  </div><!-- end row -->
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
