<?php
	include "../../php/sql-statements.php";

	$db = new DB();

	$id = $_POST['id'];
	$request = $db->getRows('request_details', array('where'=>array('request_no'=>$id)));
	$requestTypes = $db->getRows('request_type', array('where'=>array('request_type_id'=>$request[0]['request_type_id'])));
	$assigned = $db->getRows('users', array('where'=>array('account_id'=>$request[0]['assigned_to'])));

	$out = array(
		'request_no'=>$request[0]['request_no'],
		'type'=>$requestTypes[0]['type'],
		'category'=>$requestTypes[0]['category'],
		'subcategory'=>$requestTypes[0]['subcategory'],
		'description'=>$request[0]['description'],
		'assigned_to'=>$assigned[0]['firstname'].' '. $assigned[0]['lastname']
	);

	echo json_encode($out);
?>