<?php
	
	// Set path to the Zend library on system
	//
	$library = '../../php/ZendFramework/library';
	set_include_path(get_include_path() . PATH_SEPARATOR . $library);
	// Get Zend Autoloader
	//
	require_once('Zend/Loader/Autoloader.php');
	try {
		// Create instance of Autoloader
		//
		Zend_Loader_Autoloader::getInstance();Í
		// Write Privileges
		/*
		$write = array ('host' => 'localhost',
				'username' => '???????',
				'password' => '???????',
				'dbname' => '???????');*/
		
		// Read privileges
		//
		$read = array ('host' => 'localhost',
				'username' => '???????',
				'password' => '???????',
				'dbname' => '???????');
		
		
		// DB Adapter
		/*
		$dbWrite = new Zend_Db_Adapter_Pdo_Mysql($write);*/
		$dbRead = new Zend_Db_Adapter_Pdo_Mysql($read);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	
	// Used to tst user account privileges
	//
	/*if ($dbWrite->getConnection()){
		echo 'Write Connection Established'. '<br />';
	}
	if ($dbRead->getConnection()){
		echo 'Read Connection Established' . '<br />';
	}*/

?>