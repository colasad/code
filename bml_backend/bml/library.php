<?php

// Set path to the Zend library on system
//
$library = '../php/ZendFramework/library';
set_include_path(get_include_path() . PATH_SEPARATOR . $library);


// Get Zend Autoloader
//
require_once('Zend/Loader/Autoloader.php');


try {
	// Create instance of Autoloader
	//
	Zend_Loader_Autoloader::getInstance();

	// Write Privileges
	//
	$write = array ('host' => 'localhost',
			'username' => 'eggmedia_cWrite',
			'password' => 'cWrite99',
			'dbname' => 'eggmedia_client');
	
	// Read privileges
	//
	$read = array ('host' => 'localhost',
			'username' => 'eggmedia_cRead',
			'password' => 'cRead99',
			'dbname' => 'eggmedia_client');
	
	
	// DB Adapter
	//
	$dbWrite = new Zend_Db_Adapter_Pdo_Mysql($write);
	$dbRead = new Zend_Db_Adapter_Pdo_Mysql($read);

} catch (Exception $e) {
	echo $e->getMessage();
}

/*if ($dbWrite->getConnection()){
	echo 'Write OK'. '<br />';
}
if ($dbRead->getConnection()){
	echo 'Read OK' . '<br />';
}*/

?>