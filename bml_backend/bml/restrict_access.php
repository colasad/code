<?php

	require_once('library.php');

	try{

		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()){

			$identity =$auth->getIdentity();
		} else {

			header('Location: index.php');
			//exit;
		}

	} catch (Exception $e){

		echo $e->getMessage();
	}
?>