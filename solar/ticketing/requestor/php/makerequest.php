<?php
	session_start();
	include '../../php/sql-statements.php';

	$db = new DB();

	$type = $_POST['request-type'];
	$category = $_POST['request-category'];
	$subcategory = $_POST['request-subcategory'];
	$description = $_POST['request-description'];

	$reqid = $db->getRows('request_type', array('where'=>array('type'=>$type, 'category'=>$category, 'subcategory'=>$subcategory), 'select'=>'request_type_id'));

	$user = $db->getRows('users', array('where'=>array('google_id'=>$_SESSION['gid'])));

	$lastAssigned = $db->getRows('request_details', array('select'=>'assigned_to', 'order_by'=>'request_no DESC', 'limit'=>1));

	if(!$lastAssigned || $lastAssigned == ""){
		$lastAssigned = $db->getRows('users', array('select'=>'account_id AS assigned_to', 'limit'=>1));
		$nextAssigned[0][0] = $lastAssigned[0]['assigned_to'];
	}else{
		$nextAssigned = $db->getRows2('users', array('select'=>'min(account_id)', 'where'=>array('user_type_id >='=>2, 'account_id >'=>$lastAssigned[0]['assigned_to'])));
		if(!$nextAssigned[0][0] || $nextAssigned[0][0] == ""){
			$nextAssigned[0][0] = $lastAssigned[0]['assigned_to'];
		}
	}

	$userData = array(
		'request_type_id'=>$reqid[0]['request_type_id'],
		'description'=>$description,
		'status'=>'in progress',
		'assigned_to'=>$nextAssigned[0][0],
		'requested_by'=>$user[0]['account_id']
	);

	$insert = $db->insert('request_details', $userData);

	if(!$insert){
		echo $insert;
	}else{
		$out = array(
			'request_no'=>$insert,
			'type'=>$type,
			'category'=>$category,
			'subcategory'=>$subcategory,
			'name'=>$user[0]['firstname']. ' ' . $user[0]['lastname'],
			'status'=>'success'
		);
		echo json_encode($out); 
	}
?>