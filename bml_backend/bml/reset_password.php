<?php
	session_start();
	$errors = array();
	$success = FALSE;
	$_SESSION['nomatch'] = TRUE;
	
	require_once('library.php');
	
	try {
	  if (isset($_GET['id']) && isset($_GET['token'])) {
	
		$id = $dbRead->quote($_GET['id']);
		$token = $dbRead->quote($_GET['token']);
		$sql = "SELECT user_id FROM users WHERE user_id = $id AND token = $token";
		$result = $dbRead->fetchRow($sql);
		if ($result) {
	      $_SESSION['user_id'] = $_GET['id'];
		  $_SESSION['token'] = $_GET['token'];
		  $_SESSION['nomatch'] = FALSE;
		} 
	  }
	  if (isset($_POST['reset'])) {
		
		// password reset code goes here
		//
		$val = new Zend_Validate();
		$val->addValidator(new Zend_Validate_StringLength(8,15));
		$val->addValidator(new Zend_Validate_Alnum());
		if (!$val->isValid($_POST['password'])) {
		  $errors['password'] = 'Use 8-15 letters or numbers only';
		}
		$val = new Zend_Validate_Identical($_POST['password']);
		if (!$val->isValid($_POST['conf_password'])) {
		  $errors['conf_password'] = "Passwords don't match";
		}
		if (!$errors) {
		  // update the password
		  $data = array('password' => sha1($_POST['password']),
		                'token'    => NULL);
		  $where['user_id = ?'] = $_SESSION['user_id'];
		  $where['token = ?'] = $_SESSION['token'];
		  $success = $dbWrite->update('users', $data, $where);
		  unset($_SESSION['user_id']);
		  unset($_SESSION['token']);
		  unset($_SESSION['nomatch']);
		}
	  }
	} catch (Exception $e) {
	  echo $e->getMessage();
	}
?>