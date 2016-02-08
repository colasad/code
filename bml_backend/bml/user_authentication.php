<?php

	$failed = FALSE;

	if ($_POST){

		if (empty($_POST['username']) || empty($_POST['password'])){

			$failed = TRUE;

		} else {

			require_once('library.php');

		try {

			// Check user credentials
			//
			$auth = Zend_Auth::getInstance();
			$adapter = new Zend_Auth_Adapter_DbTable($dbRead, 'users', 'username', 'password', 'sha1(?)', 'email');
			$adapter->setIdentity($_POST['username']);
			$adapter->setCredential($_POST['password']);
			$result = $auth->authenticate($adapter);

			if ($result->isValid()){

				$storage = $auth->getStorage();
				$storage->write($adapter->getResultRowObject(array('username', 'first_name', 'surname', 'email')));
				header('Location: clients_only.php');
				exit;

			} else {

				$failed = TRUE;
			}


		} catch (exception $e){

			echo $e->getMessage();
		}


	}
}

	if (isset($_GET['logout'])){

		require_once('library.php');
		try{

			$auth = Zend_Auth::getInstance();
			$auth->clearIdentity();
			header('Location: index.php');
			exit;

		} catch (Excpetion $e){

			echo $e->getMessage();

		}

	}	
?>