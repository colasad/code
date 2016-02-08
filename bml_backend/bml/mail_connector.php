<?php

try{

	// email host
	//
	$mailhost = 'mail.buffalomedialab.com';

	$mailconfig = array('auth' => 'login' ,
						'username' => 'admin@buffalomedialab.com',
						'password' => 'admin61' );


	$transport = new Zend_Mail_Transport_Smtp($mailhost, $mailconfig);

	Zend_Mail::setDefaultTransport($transport);



} catch (Excpetion $e){
	echo 'error!';
	echo $e->getMessage();
} 

?>