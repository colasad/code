<?php
	require_once('library.php');
	$errors = array();

	try {
	 
	  $public_key = '6LfeneMSAAAAAK3fEbrQNNJGr93eGrRXfehA-tGs';
	  $private_key = '6LfeneMSAAAAABRYmV5zuUe9AO4i9wppVJAclRlM';
	  $recaptcha = new Zend_Service_ReCaptcha($public_key, $private_key);
	  
 	  if (isset($_POST['send'])) {
	
		// validate the user input
		//
		if (empty($_POST['recaptcha_response_field'])) {
		  $errors['recaptcha'] = 'reCAPTCHA field is required';
		} else {
		  $result = $recaptcha->verify($_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);
		  if (!$result->isValid()) {
			$errors['recaptcha'] = 'Try again';
		  }
		}
	
	
		// Validate nmae
		//
		$val = new Zend_Validate_Alnum(TRUE);
		if (!$val->isValid($_POST['name'])) {
		  $errors['name'] = 'Name is required';
		}
	
		// Validate email address
		//
		$val = new Zend_Validate_EmailAddress();
		if (!$val->isValid($_POST['email'])) {
		  $errors['email'] = 'Email address is required';
		}
	
		// Validate comments
		//
		$val = new Zend_Validate_StringLength(10);
		if (!$val->isValid($_POST['comments'])) {
		  $errors['comments'] = 'Required';
		}
	
	
	if (!$errors) {
	   // connect to mail
	   //
	   require_once('mail_connector.php');
	   // create and send the email
	   //
	   $mail = new Zend_Mail('UTF-8');
	   
	   $mail->addTo('dgcolasanti@gmail.com', '');
	   $mail->addTo('colasad@hotmail.com', '');
	   
	   $mail->setFrom('admin@buffalomedialab.com', 'BuffaloMediaLab');
		
	   $mail->setSubject('Comments from BuffaloMediaLab');
	   
	   $mail->setReplyTo($_POST['email'], $_POST['name']);
	   
	   $text = "Name: {$_POST['name']}\r\n\r\n";
	   $text .= "Email: {$_POST['email']}\r\n\r\n";
	   $text .= "Comments: {$_POST['comments']}";
	   
	   $html = "<p><strong>Name: </strong><a href='mailto:{$_POST['email']}'>{$_POST['name']}</a></p>";
	   $html .= '<p><strong>Comments: </strong>' . nl2br($_POST['comments']) . '</p>';
	   $mail->setBodyText($text, 'UTF-8');
	   $mail->setBodyHtml($html, 'UTF-8');
	   $success = $mail->send();
	   if (!$success) {
	     $errors = TRUE;
	   }
	}
  }
} catch (Exception $e) {
  echo $e->getMessage();
}