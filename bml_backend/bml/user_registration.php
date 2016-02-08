<?php

  $errors = array();
  
  if ($_POST) {
    
    require_once('library.php');
    
    try{
      
    $val = new Zend_Validate_Alpha(TRUE);
      
    // Validate first name
    //	
      $val = new Zend_Validate_Regex('/^[a-z]+[-\'a-z]+$/i');
      
      if (!$val->isValid($_POST['first_name'])) {

      	$errors['first_name'] = '<p class="add_user_error">' . 'Required field, with no numbers' . '</p>';

      }
    
    // Validate surname
    //	
      $val = new Zend_Validate_Regex('/^[a-z]+[-\'a-z]+$/i');
      
      if (!$val->isValid($_POST['surname'])) {

      	$errors['surname'] = '<p class="add_user_error">' . 'Required field, with no numbers' . '</p>';

      }
      // Validate username
      //
      $val = new Zend_Validate();
      $length = new Zend_Validate_StringLength(6,15);
      $val->addValidator($length);
      $val->addValidator(new Zend_Validate_Alnum());
      if (!$val->isValid($_POST['username'])) {

      	$errors['username'] = '<p class="add_user_error">' . 'User name must be 6-15 letters or numbers' . '</p>';

      } else {
      // Check if username already exists
      //	
      	$sql = $dbRead->quoteInto('SELECT user_id FROM users WHERE username = ?', $_POST['username']);
      	$result = $dbRead->fetchAll($sql);

      	if ($result){

      		$errors['username'] = '<p class="add_user_error">' . $_POST['username'] . ' already exists' . '</p>';
      	
      	}
      }

      // Validate password
      //
      $length->setMin(8);
      $val = new Zend_Validate();
      $val->addValidator($length);
      $val->addValidator(new Zend_Validate_Alnum());
      if (!$val->isValid($_POST['password'])) {

      	$errors['password'] = '<p class="add_user_error">' . 'Password must be 8-15 characters' . '</p>';

      }
      
      // Confirm passwords
      //
      $val = new Zend_Validate_Identical($_POST['password']);
      if (!$val->isValid($_POST['conf_password'])) {

      	$errors['conf_password'] = '<p class="add_user_error">' . 'Passwords don\'t match' . '</p>';

      }

      // Validate email
      //
      $val = new Zend_Validate_EmailAddress();
      if (!$val->isValid($_POST['email'])) {

      	$errors['email'] = '<p class="add_user_error">' . 'Invalid email address' . '</p>';

      }

      // If all data validated, then add new user
      //
      if (!$errors){

      	$data = array('first_name' => $_POST['first_name'],
      					'surname' => $_POST['surname'],
      					'username' => $_POST['username'],
      					'email' => $_POST['email'],
      					'password' => sha1($_POST['password']));

      	$dbWrite->insert('users', $data);
      	header('Location: login.php');
      }
    } catch (Exception $e){
      
	echo $e->getMessage();
      
    }
    
    
  }
  

?>