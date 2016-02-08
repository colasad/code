<?php
$errors = FALSE;
$result = FALSE;
if ($_POST) {
  require_once('library.php');
  require_once('mail_connector.php');
  try {

  	// Validate email]
  	//
  	$val = new Zend_Validate_EmailAddress();
  	if (!$val->isValid($_POST['email'])){

  		$errors = TRUE;
  	}

  	if (!$errors){

  		$sql = $dbRead->quoteInto('SELECT user_id, first_name, surname, email from users WHERE email=?', $_POST['email'] );
  		$result = $dbRead->fetchRow($sql);

  		if (!$result){

  			// email does not exist
  			//
  			$errors = TRUE;

  		} else {

  			// Create token and update record
  			//
  			$token = md5(uniqid(mt_rand(), TRUE));
  			$data = array('token' => $token);
  			$dbWrite->update('users', $data, "user_id = {$result['user_id']}");
  		}

  	  $mail = new Zend_Mail('UTF-8');
	  $mail->addTo($result['email'], "{$result['first_name']} {$result['family_name']}");
	  $mail->setSubject('Instructions for resetting your password');
	  $mail->setFrom('admin@buffalomedialab.com', 'Admin @ BuffaloMediaLab');
	  $link = "http://buffalomedialab.com/reset.php?id={$result['user_id']}&token=$token";
	  $message = "Click the following link to reset your password. This link can be used once only. $link";
	  $mail->setBodyText($message, 'UTF-8');
	  $mail->send();
  	}
	
  } catch (Exception $e) {
	echo $e->getMessage();
  }
}