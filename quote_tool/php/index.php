<?php
	require_once 'library.php';
	
		// Get randomÍ quote
		//
		$select = $dbRead->select()->from('quotes', array('quote'))->order("rand()")->limit (1);
		$result = $select->query();
		
		while ($row = $result->fetch()) {
     		print(json_encode($row['quote']));
		}
	
?>